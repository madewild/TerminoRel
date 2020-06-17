<?php 
error_reporting(-1);
ini_set('display_errors', 'On');
include("../static/secret.php");
$server = SERVER;
$username = USERNAME;
$password = PASSWORD;

$conninfo = array(
    "Database" => "terminorel",
    "UID" => $username,
    "PWD" => $password,
    "CharacterSet" => "UTF-8"
);
 
if(!empty($_POST["domain_id"])){ 
    $domainid = $_POST["domain_id"];
    $conn = sqlsrv_connect($server, $conninfo);
    if ($conn) {
        $query = sqlsrv_query($conn, "SELECT * FROM termgroup WHERE termlexid LIKE '$domainid%01-fr' ORDER BY termtext", array(), array("Scrollable" => 'static'));
        while ($row = sqlsrv_fetch_array($query)) {
            echo '<option value="'.$row["termlexid"].'">'.$row["termtext"].'</option>';
        }
    }
}
?>