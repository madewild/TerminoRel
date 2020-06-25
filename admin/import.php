<?php 
include("../static/header.php");

$conn = sqlsrv_connect($server, $conninfo);

$path = $_SERVER['REQUEST_URI'];
$barepath = strtok($path, '?');

echo "<p><a href='" . $barepath . "'>Retour à l'accueil de l'administration</a></p>";
?>

<h3>Import d'un fichier XML</h3>
<form action="" method="post" enctype="multipart/form-data">
  <p>Choisissez un fichier :
  <input type="file" name="fileToUpload" id="fileToUpload">
  <input type="submit" value="OK" name="upload"></p>
</form>