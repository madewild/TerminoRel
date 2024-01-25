<?php
echo "<h2>TerminoRel – Glossaires académiques de l'ULB pour la rédaction de textes en anglais</h2>";

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
ini_set('pcre.jit', '0');

include("functions.php");
include("secret2.php");

$server = SERVER;
$username = USERNAME;
$password = PASSWORD;
$path = $_SERVER['REQUEST_URI'];

if (strpos($path, 'dev') !== false) {
    $database = "terminoreldev";
} else {
    $database = "terminorel";
}
?>