<?php 
error_reporting(-1);
ini_set('display_errors', 'On');
include("../static/secret.php");
$server = SERVER;
$username = USERNAME;
$password = PASSWORD;

$termlexid = htmlspecialchars($_GET['fiche']);

$conninfo = array(
    "Database" => "terminorel",
    "UID" => $username,
    "PWD" => $password,
    "CharacterSet" => "UTF-8"
);

$conn = sqlsrv_connect($server, $conninfo);
if ($conn) {
    $query = sqlsrv_query($conn, "SELECT * FROM termgroup WHERE termlexid LIKE '$termlexid'", array(), array("Scrollable" => 'static'));
    $row = sqlsrv_fetch_array($query);
}

include("../static/header.php");

echo "<h3>Fiche détaillée &nbsp;&nbsp;&nbsp;
<img title='Modifier la fiche' src='icons/edit.png' style='width:24px;height:24px'> 
<img title='Supprimer la fiche' src='icons/delete.png' style='width:24px;height:24px'></h3>";
echo "<table>";
echo "<tr><td>Terme principal en français</td><td><b>" . $row['termtext'] . "</b></td></tr>";
$variant = $row['variant'];
if($variant != NULL) {
    echo "<tr><td>Variante</td><td><b>" . $variant . "</b></td></tr>";
}
echo "</table>";
?>