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

echo "<h3>Fiche détaillée 
<img title='Modifier la fiche' src='icons/edit.png' style='width:32px;height:33px'> 
<img title='Supprimer la fiche' src='icons/delete.png' style='width:32px;height:32px'></h3>";
echo "<fieldset>";
echo "<p>Terme principal en français : <b>" . $termtext . "</b></p>";
echo "</fieldset>";
?>