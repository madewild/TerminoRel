<h2>Page de test</h2>

<?php include('static/retour.php'); ?>

<p>Ceci est un test</p>

<?php
error_reporting(-1);
ini_set('display_errors', 'On');
ini_set('pcre.jit', '0');
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
echo 'Using database ' . $database;

$conn = mysqli_connect($server, $username, $password) or die("Unable to connect to '$server'");
mysqli_select_db($conn, $database) or die("Could not open the database '$database'");
$result = mysqli_query($conn, "SELECT * FROM terminfo");
while ($row = mysqli_fetch_array($result, MYSQLI_NUM)) {
    printf("ID: %s  Name: %s <br>", $row[0], $row[1]);
}
phpinfo();
?>