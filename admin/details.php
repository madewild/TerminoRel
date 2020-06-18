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

include("../functions.php");
include("../static/header.php");
$path = $_SERVER['REQUEST_URI'];
$barepath = strtok($path, '?');

echo "<p><a href='" . $barepath . "'>Retour à la sélection des fiches</a></p>";

echo "<h3>Fiche détaillée &nbsp;&nbsp;&nbsp;
<a href='" . $barepath . "?termlexid=" . $termlexid . "'><img title='Modifier la fiche' src='icons/edit.png' style='width:24px;height:24px'></a> 
<img title='Supprimer la fiche' src='icons/delete.png' style='width:24px;height:24px'></h3>";
echo "<table>";
echo "<tr><td><b>Terme principal en français</b></td><td>" . $row['termtext'] . "</td></tr>";
$variant = $row['variant'];
$mf = False;
if($variant != NULL) {
    echo "<tr><td><b>Variante</b></td><td>" . $variant . "</td></tr>";
    $mf = True;
}

$langroup_source = $row['langroup'];
$result = sqlsrv_query($conn, "SELECT * FROM termgroup WHERE langroup=$langroup_source AND abbrev=1", array(), array("Scrollable" => 'static'));
$row2 = sqlsrv_fetch_array($result);
if($row2) {
    $acro = $row2['termtext'];
    echo "<tr><td><b>Abréviation</b></td><td>" . $acro . "</td></tr>";
}

$pos_id = $row['pos'];
if($pos_id == 1) {
    $pos = "nom";
} else if($pos_id == 6) {
    $pos = "adjectif"; // Also add Verbe
} else {
    $pos = "locution";
}
echo "<tr><td><b>Catégorie grammaticale</b></td><td>" . $pos . "</td></tr>";

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
echo "<tr><td><b>Genre</b></td><td>" . $gender . "</td></tr>";

$number_id = $row['number'];
if($number_id == 12) {
    $number = "pluriel";
} else {
    $number = "singulier";
}
echo "<tr><td><b>Nombre</b></td><td>" . $number . "</td></tr>";

$result = sqlsrv_query($conn, "SELECT termid FROM langroup WHERE id=$langroup_source", array(), array("Scrollable" => 'static'));
$termid = sqlsrv_fetch_array($result)['termid'];

$result = sqlsrv_query($conn, "SELECT definition FROM langroup WHERE termid=$termid AND lang LIKE 'fr%'", array(), array("Scrollable" => 'static'));
$definition = sqlsrv_fetch_array($result)['definition'];
if(!empty($definition)) {
    $result = sqlsrv_query($conn, "SELECT * FROM source WHERE termid=$termid AND type='def'", array(), array("Scrollable" => 'static'));
    $row = sqlsrv_fetch_array($result);
    $bib_id = $row['biblio'];
    $source_text_def = $row['text'];
    $result = sqlsrv_query($conn, "SELECT title FROM biblio WHERE id=$bib_id", array(), array("Scrollable" => 'static'));
    $bib_title_def = sqlsrv_fetch_array($result)['title'];
    echo "<tr><td><b>Définition</b></td><td>" . $definition . "</td></tr>";
    echo "<tr><td><b>Source de la définition</b></td><td>" . $bib_title_def . ", " . $source_text_def . "</td></tr>";
}

$result = sqlsrv_query($conn, "SELECT explanation FROM langroup WHERE termid=$termid AND lang LIKE 'fr%'", array(), array("Scrollable" => 'static'));
$explanation = sqlsrv_fetch_array($result)['explanation'];
if(!empty($explanation)) {
    $result = sqlsrv_query($conn, "SELECT * FROM source WHERE termid=$termid AND type='exp'", array(), array("Scrollable" => 'static'));
    $row = sqlsrv_fetch_array($result);
    $bib_id = $row['biblio'];
    $source_text_exp = $row['text'];
    $result = sqlsrv_query($conn, "SELECT title FROM biblio WHERE id=$bib_id", array(), array("Scrollable" => 'static'));
    $bib_title_exp = sqlsrv_fetch_array($result)['title'];
    echo "<tr><td><b>Explication</b></td><td>" . $explanation . "</td></tr>";
    echo "<tr><td><b>Source de l'explication</b></td><td>" . $bib_title_exp . ", " . $source_text_exp . "</td></tr>";
}
echo "</table>";

$result = sqlsrv_query($conn, "SELECT id FROM langroup WHERE termid=$termid AND lang LIKE 'en%'", array(), array("Scrollable" => 'static'));
$langroup_target = sqlsrv_fetch_array($result)['id'];
$results_pref = sqlsrv_query($conn, "SELECT * FROM termgroup WHERE langroup=$langroup_target AND auth=7", array(), array("Scrollable" => 'static'));
if($results_pref === FALSE) {
    print_r(sqlsrv_errors(), true);
    print_r($langroup_target);
}
$results_admi = sqlsrv_query($conn, "SELECT * FROM termgroup WHERE langroup=$langroup_target AND auth IN (0,9)", array(), array("Scrollable" => 'static'));
$results_depr = sqlsrv_query($conn, "SELECT * FROM termgroup WHERE langroup=$langroup_target AND auth=10", array(), array("Scrollable" => 'static'));

$num_pref = sqlsrv_num_rows($results_pref);
show_trad_admin($conn, $results_pref, "privilégiée");
show_trad_admin($conn, $results_admi, "admise");
show_trad_admin($conn, $results_depr, "à éviter");

echo "</table>";
?>