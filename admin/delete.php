<?php 
include("../static/header.php");

$termlexid = htmlspecialchars($_GET['delete']);
$path = $_SERVER['REQUEST_URI'];
$barepath = strtok($path, '?');
$fullpath = $barepath . "?fiche=" . $termlexid;

echo "<p><a href='" . $fullpath . "'>Retour à la fiche</a></p>";
echo "<p>La fiche " . $termlexid . " n'a heureusement PAS été supprimée !</p>";
?>