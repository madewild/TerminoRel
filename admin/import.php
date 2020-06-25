<?php 
include("../static/header.php");

$termlexid = htmlspecialchars($_GET['fiche']);
$conn = sqlsrv_connect($server, $conninfo);
if ($conn) {
    $query = sqlsrv_query($conn, "SELECT * FROM termgroup WHERE termlexid LIKE '$termlexid'", array(), array("Scrollable" => 'static'));
    $row = sqlsrv_fetch_array($query);
}

$path = $_SERVER['REQUEST_URI'];
$barepath = strtok($path, '?');

echo "<p><a href='" . $barepath . "'>Retour à l'accueil de l'administration</a></p>";

echo "<h3>Import d'un fichier XML</h3>";

?>