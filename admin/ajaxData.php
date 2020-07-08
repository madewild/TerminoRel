<?php 
include("../static/header.php");
 
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