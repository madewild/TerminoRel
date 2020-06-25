<?php
echo "<h2>TerminoRel – Glossaires académiques de l'ULB pour la rédaction de textes en anglais</h2>";

error_reporting(-1);
ini_set('display_errors', 'On');

include("functions.php");
include("secret.php");

$server = SERVER;
$username = USERNAME;
$password = PASSWORD;
$path = $_SERVER['REQUEST_URI'];

if (strpos($path, 'dev') !== false) {
    $database = "terminorel-dev";
} else {
    $database = "terminorel";
}

$conninfo = array(
    "Database" => $database,
    "UID" => $username,
    "PWD" => $password,
    "CharacterSet" => "UTF-8"
);
?>