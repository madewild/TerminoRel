<?php 
error_reporting(-1);
ini_set('display_errors', 'On');
include("../static/secret.php");
$server = SERVER;
$username = USERNAME;
$password = PASSWORD;

$termtext = htmlspecialchars($_GET['fiche']);

$conninfo = array(
    "Database" => "terminorel",
    "UID" => $username,
    "PWD" => $password,
    "CharacterSet" => "UTF-8"
);

include("../static/header.php");

echo "<h3>Fiche détaillée</h3>";
echo "<p>Terme principal en français : <b>" . $termtext . "</b></p>";
?>