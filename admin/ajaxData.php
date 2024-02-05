<?php 
include("../static/header.php");
 
if(!empty($_POST["domain_id"])){ 
    $domainid = $_POST["domain_id"];
    $conn = mysqli_connect($server, $conninfo);
    if ($conn) {
        $query = mysqli_query($conn, "SELECT * FROM termgroup WHERE termlexid LIKE '$domainid%01-fr' ORDER BY termtext", array(), array("Scrollable" => 'static'));
        while ($row = mysqli_fetch_array($query)) {
            echo '<option value="'.$row["termlexid"].'">'.$row["termtext"].'</option>';
        }
    }
}
?>