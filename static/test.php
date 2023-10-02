<h2>Page de test</h2>

<?php include('static/retour.php'); ?>

<p>Ceci est un test</p>

<?php
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

$connect = mysql_connect($server, $username, $password) or die("Unable to connect to '$server'");
mysql_select_db($database) or die("Could not open the database '$database'");
$result = mysql_query("SELECT * FROM terminfo");
while ($row = mysql_fetch_array($result, MYSQL_NUM)) {
    printf("ID: %s  Name: %s <br>", $row[0], $row[1]);
}
?>