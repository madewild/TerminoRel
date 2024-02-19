<?php 
include("../static/header.php");
 
if(!empty($_POST["domain_id"])){ 
    $domainid = $_POST["domain_id"];
    $conn = mysqli_connect($server, $username, $password) or die("Unable to connect to '$server'");
    $conn -> set_charset("utf8");
    mysqli_select_db($conn, $database) or die("Could not open the database '$database'");
    if ($conn) {
        $query = "SELECT * FROM termgroup WHERE termlexid LIKE '$domainid%01-fr' ORDER BY termtext";
        $main_result = mysqli_query($conn, $query);
        while ($row = mysqli_fetch_assoc($main_result)) {
            echo '<option value="'.$row["termlexid"].'">'.$row["termtext"].'</option>';
        }
    }
}
?>