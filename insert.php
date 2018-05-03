<?php
error_reporting(-1);
ini_set('display_errors', 'On');
ini_set('mssql.charset', 'UTF-8');
include("secret.php");
$server = SERVER;
$username = USERNAME;
$password = PASSWORD;
$conn = mssql_connect($server, $username, $password);
if ($conn) {
    mssql_select_db("terminorel", $conn);
    $xml = simplexml_load_file("xml/biblio.xml");
    foreach($xml->entrée as $doc)
    {
        $ref = $doc['id'];
        $title = $doc->titre;
        $type = $doc->type;
        $date = $doc->date;
        $source = $doc->source;
        $service = $doc->service;
        $url = $doc->url;
        //$auteur = $doc->auteur;
        $filename = $doc->nomFichier;
        echo $ref . '<br>' . $title . '<br>' . $type . '<br>' . $date . '<br>' . $source . '<br>' . $service . '<br>' . $url . '<br>' . $filename;
        //$title = utf8_decode($title);
        $query = mssql_query("INSERT INTO biblio (reference, title, typedoc, datedoc, source, service, url, filename) VALUES ($ref, N'$title', N'$type', $date, N'$source', N'$service', N'$url', N'$filename')", $conn);
    }
}
?>