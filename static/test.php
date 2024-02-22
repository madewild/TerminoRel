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
$table = 'termgroup';
$query = "SELECT * FROM " . $table . " LIMIT 10";

if (strpos($path, 'dev') !== false) {
    $database = "terminoreldev";
} else {
    $database = "terminorel";
}
echo '<p>Using database <b>' . $database . '</b> with user <b>' . $username . '</b></p>';
echo '<p>Sample data from table <b>' . $table . '</b>:</p>';

$conn = mysqli_connect($server, $username, $password) or die("Unable to connect to '$server'");
$conn -> set_charset("utf8");
mysqli_select_db($conn, $database) or die("Could not open the database '$database'");
$result = mysqli_query($conn, $query);
while ($row = mysqli_fetch_assoc($result)) {
    printf("ID: %s - Text: %s <br>", $row['id'], $row['termtext']);
}
echo "<br>";
?>