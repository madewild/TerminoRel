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
        $title = str_replace("'", "''", $title);
        $type = $doc->type;
        $type = str_replace("'", "''", $type);
        $date = $doc->date;
        //$date = str_replace("-", "", $date);
        $source = $doc->source;
        $source = str_replace("'", "''", $source);
        $service = $doc->service;
        $service = str_replace("'", "''", $service);
        $url = $doc->url;
        //$auteur = $doc->auteur;
        $filename = $doc->nomFichier;
        $filename = str_replace("'", "''", $filename);
        echo 'Importing ' . $ref . '...';
        $query = mssql_query("INSERT INTO biblio (reference, title, typedoc, datedoc, source, service, url, filename) VALUES (N'$ref', N'$title', N'$type', '$date', N'$source', N'$service', N'$url', N'$filename')", $conn);
        echo 'Done!';
    }
}
?>