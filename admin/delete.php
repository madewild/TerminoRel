<?php 
include("../static/header.php");

$termlexid = htmlspecialchars($_GET['delete']);
echo "<p>La fiche " . $termlexid . " n'a heureusement PAS été supprimée !</p>";
?>