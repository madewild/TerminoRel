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
$mf = False;
if($variant != NULL) {
    echo "<tr><td>Variante</td><td><b>" . $variant . "</b></td></tr>";
    $mf = True;
}

$langroup_source = $row['langroup'];
$result = sqlsrv_query($conn, "SELECT * FROM termgroup WHERE langroup=$langroup_source AND abbrev=1", array(), array("Scrollable" => 'static'));
$row2 = sqlsrv_fetch_array($result);
if($row2) {
    $acro = $row2['termtext'];
    echo "<tr><td>Abréviation</td><td><b>" . $acro . "</b></td></tr>";
}

$pos_id = $row['pos'];
if($pos_id == 1) {
    $pos = "nom";
} else if($pos_id == 6) {
    $pos = "adjectif"; // Also add Verbe
} else {
    $pos = "locution";
}
echo "<tr><td>Catégorie grammaticale</td><td><b>" . $pos . "</b></td></tr>";

$gender_id = $row['gender'];
if($gender_id == 4 or $mf) {
    $gender = "masculin ou féminin";
} else if($gender_id == 2) {
    $gender = "masculin";
} else if($gender_id == 8) {
    $gender = "féminin";
} else {
    $gender = "";
}
echo "<tr><td>Genre</td><td><b>" . $gender . "</b></td></tr>";

$number_id = $row['number'];
if($number_id == 12) {
    $number = "pluriel";
} else {
    $number = "singulier";
}
echo "<tr><td>Nombre</td><td><b>" . $number . "</b></td></tr>";

$result = sqlsrv_query($conn, "SELECT definition FROM langroup WHERE termid=$termid AND lang LIKE 'fr%'", array(), array("Scrollable" => 'static'));
$definition = sqlsrv_fetch_array($result)['definition'];
if(!empty($definition)) {
    $result = sqlsrv_query($conn, "SELECT * FROM source WHERE termid=$termid AND type='def'", array(), array("Scrollable" => 'static'));
    $row = sqlsrv_fetch_array($result);
    $bib_id = $row['biblio'];
    $source_text_def = $row['text'];
    $result = sqlsrv_query($conn, "SELECT title FROM biblio WHERE id=$bib_id", array(), array("Scrollable" => 'static'));
    $bib_title_def = sqlsrv_fetch_array($result)['title'];
    echo "<tr><td>Définition</td><td>" . $definition . " (<i>" . $bib_title_def . "</i>, " . $source_text_def . ")</td></tr>";
}

$result = sqlsrv_query($conn, "SELECT explanation FROM langroup WHERE termid=$termid AND lang LIKE '$source%'", array(), array("Scrollable" => 'static'));
$explanation = sqlsrv_fetch_array($result)['explanation'];
if(!empty($explanation)) {
    $result = sqlsrv_query($conn, "SELECT * FROM source WHERE termid=$termid AND type='exp'", array(), array("Scrollable" => 'static'));
    $row = sqlsrv_fetch_array($result);
    $bib_id = $row['biblio'];
    $source_text_exp = $row['text'];
    $result = sqlsrv_query($conn, "SELECT title FROM biblio WHERE id=$bib_id", array(), array("Scrollable" => 'static'));
    $bib_title_exp = sqlsrv_fetch_array($result)['title'];
    echo "<tr><td>Explication</td><td>" . $explanation . " (<i>" . $bib_title_exp . "</i>, " . $source_text_exp . ")</td></tr>";
}

echo "</table>";
?>