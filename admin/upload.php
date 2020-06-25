<?php
include("../static/header.php");

$target_dir = "../xml/";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$fileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

$path = $_SERVER['REQUEST_URI'] . "?import=xml";

echo "<p><a href='" . $path . "'>Retour à l'import de fichier XML</a></p>";
echo "<p>";

// Check if file already exists
if (file_exists($target_file)) {
  echo "Ce nom de fichier existe déjà. ";
  $uploadOk = 0;
}

// Check file size
if ($_FILES["fileToUpload"]["size"] > 500000) {
  echo "Ce fichier est trop volumineux. ";
  $uploadOk = 0;
}

// Allow certain file formats
if($fileType != "xml" ) {
  echo "Seul le format XML est autorisé. ";
  $uploadOk = 0;
}

// Validate XML
$xml = new XMLReader;
$xml->open($_FILES["fileToUpload"]["tmp_name"]);
$xml->setParserProperty(XMLReader::VALIDATE, true);
if (not($xml->isValid())) {
  echo "Ce fichier XML n'est pas valide. ";
  $uploadOk = 0;
}

// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
  echo "Le fichier n'a pas pu être uploadé.";
// if everything is ok, try to upload file
} else {
  if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
    echo "Le fichier ". basename( $_FILES["fileToUpload"]["name"]). " a bien été uploadé.";
  } else {
    echo "Une erreur est survenue lors de l'upload...";
  }
}
echo "</p>";
?>