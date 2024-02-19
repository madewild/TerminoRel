<?php 
include("../static/header.php");

$conn = mysqli_connect($server, $username, $password) or die("Unable to connect to '$server'");
$conn -> set_charset("utf8");

$path = $_SERVER['REQUEST_URI'];
$barepath = strtok($path, '?');

echo "<p><a href='" . $barepath . "'>Retour à l'accueil de l'administration</a></p>";
?>

<h3>Import d'un fichier XML</h3>
<form action="<?php echo $barepath; ?>" method="post" enctype="multipart/form-data">
  <p>Choisissez un fichier :
  <input type="file" name="fileToUpload" id="fileToUpload">
  <button type="submit" value="submit" name="submit">OK</button></p>
</form>