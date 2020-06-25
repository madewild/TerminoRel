<?php 
include("../static/header.php");

$termlexid = htmlspecialchars($_GET['delete']);
echo "La fiche " . $termlexid . " n'a heureusement PAS été supprimée !<br>"
?>