<?php
$path = $_SERVER['REQUEST_URI'];
$barepath = strtok($path, '?');
echo "<p><a href='" . $barepath . "'>Retour à la page d'accueil</a></p>";
?>
