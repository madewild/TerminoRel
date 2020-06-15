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

#include("functions.php");
include("../static/header.php");
?>
<h3>Espace d'administration<h3>
<form class="form" action="" method="get" onsubmit="return validate()">
    <fieldset>
        <legend>Vos critères de recherche</legend>
        <nav id="form"><ul>
            <li><label for="domain">Fiche</label>
            <select name="fiche">
                <?php
                $conn = sqlsrv_connect($server, $conninfo);
                if ($conn) {
                    $query = sqlsrv_query($conn, "SELECT * FROM termgroup ORDER BY termtext", array(), array("Scrollable" => 'static'));
                    while ($row = sqlsrv_fetch_array($query)) {
                        echo '<option value="'.$row["termtext"].'">'.$row["termtext"].'</option>';
                    }
                }
                ?>
            </select></li>
        </ul></nav>
    </fieldset>
</form><br>