<?php 
include("../static/header.php");

$conn = sqlsrv_connect($server, $conninfo);

$path = $_SERVER['REQUEST_URI'];
$barepath = strtok($path, '?');

echo "<p><a href='" . $barepath . "'>Retour à l'accueil de l'administration</a></p>";

echo "<h3>Import d'un fichier XML</h3>";

?>