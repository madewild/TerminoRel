<?php
include("../../static/header.php");

$conn = mysqli_connect($server, $username, $password) or die("Unable to connect to '$server'");
$conn -> set_charset("utf8");
mysqli_select_db($conn, $database) or die("Could not open the database '$database'");

if ($conn) {
    $query = "TRUNCATE TABLE biblio";
    $result = mysqli_query($conn, $query);
    $xml = simplexml_load_file("../../xml/biblio_v2.xml");
    foreach($xml->entrée as $doc)
    {
        $ref = $doc['id'];
        $title = $doc->titre;
        $title = clean($title);
        $type = $doc->type;
        $type = str_replace("'", "''", $type);
        $date = $doc->date;
        $source = $doc->source;
        $source = str_replace("'", "''", $source);
        $service = $doc->service;
        $service = str_replace("'", "''", $service);
        $url = $doc->url;
        $auteur = $doc->auteur;
        $auteur = str_replace("'", "''", $auteur);
        $filename = $doc->nomFichier;
        $filename = str_replace("'", "''", $filename);
        echo 'Importing ' . $ref . '...<br>';
        $query2 = "INSERT INTO biblio (reference, title, typedoc, datedoc, source, service, author, url, filename) VALUES (N'$ref', N'$title', N'$type', '$date', N'$source', N'$service', N'$auteur', N'$url', N'$filename')";
        $stmt = mysqli_query($conn, $query2);
        if( $stmt === false ) {
            die( print_r( mysqli_errors(), true));
       }
    }
}
?>