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
        echo $doc->titre . "<br />";
    }
    //$query = mssql_query("INSERT INTO biblio VALUES", $conn);
}
?>