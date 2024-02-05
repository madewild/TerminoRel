<?php
include("../../static/header.php");

$conn = mysqli_connect($server, $conninfo);
if ($conn) {
    $query = mysqli_query($conn, "TRUNCATE TABLE biblio", array(), array("Scrollable" => 'static'));
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
        $stmt = mysqli_query($conn, "INSERT INTO biblio (reference, title, typedoc, datedoc, source, service, author, url, filename) VALUES (N'$ref', N'$title', N'$type', '$date', N'$source', N'$service', N'$auteur', N'$url', N'$filename')", array(), array("Scrollable" => 'static'));
        if( $stmt === false ) {
            die( print_r( mysqli_errors(), true));
       }
    }
}
?>