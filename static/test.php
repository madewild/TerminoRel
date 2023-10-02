<h2>Page de test</h2>

<?php include('static/retour.php'); ?>

<?php
error_reporting(-1);
ini_set('display_errors', 'On');
ini_set('pcre.jit', '0');
include("secret2.php");

$server = SERVER;
$username = USERNAME;
$password = PASSWORD;
$path = $_SERVER['REQUEST_URI'];
$table = 'terminfo';
$query = "SELECT * FROM " . $table;

if (strpos($path, 'dev') !== false) {
    $database = "terminoreldev";
} else {
    $database = "terminorel";
}
echo '<p>Using database <b>' . $database . '</b></p>';
echo '<p>Sample data from table <b>' . $table . '</b>:</p>';

$conn = mysqli_connect($server, $username, $password) or die("Unable to connect to '$server'");
mysqli_select_db($conn, $database) or die("Could not open the database '$database'");
$result = mysqli_query($conn, $query);
while ($row = mysqli_fetch_array($result, MYSQLI_NUM)) {
    printf("ID: %s  Name: %s <br>", $row[0], $row[1]);
}
echo "";
?>