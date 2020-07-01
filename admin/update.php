<?php 
include("../static/header.php");

$termlexid = htmlspecialchars($_GET['update']);
$conn = sqlsrv_connect($server, $conninfo);
if ($conn) {
    $query = sqlsrv_query($conn, "SELECT * FROM termgroup WHERE termlexid LIKE '$termlexid'", array(), array("Scrollable" => 'static'));
    $row = sqlsrv_fetch_array($query);
}

$path = $_SERVER['REQUEST_URI'];
$barepath = strtok($path, '?');
$fullpath = $barepath . "?fiche=" . $termlexid;

echo "<p><a href='" . $fullpath . "'>Retour à la fiche</a></p>";

echo "<h3>Modifier la fiche</h3>";
echo '<form class="form" action="" method="get"><fieldset><nav id="form"><ul>';
echo "<li><label for='term'>Terme principal en français</label> ";
echo '<input type="text" class="input" id="term" name="term" value="' . $row['termtext'] . '" size="70"></li>';

$variant = $row['variant'];
$mf = False;
if($variant != NULL) {
    echo "<li><label for='variant'>Variante</label> ";
    echo '<input type="text" class="input" id="variant" name="variant" value="' . $variant . '" size="70"></li>';
    $mf = True;
}

$langroup_source = $row['langroup'];
$result = sqlsrv_query($conn, "SELECT * FROM termgroup WHERE langroup=$langroup_source AND abbrev=1", array(), array("Scrollable" => 'static'));
$row2 = sqlsrv_fetch_array($result);
if($row2) {
    $acro = $row2['termtext'];
    echo "<li><label for='abrev'>Abréviation</label> ";
    echo '<input type="text" class="input" id="abrev" name="abrev" value="' . $acro . '" size="70"></li>';
}

$pos_id = $row['pos'];
if($pos_id == 1) {
    $pos = "nom";
} else if($pos_id == 6) {
    $pos = "adjectif"; // Also add Verbe
} else {
    $pos = "locution";
}
echo "<li><label for='catgram'>Catégorie grammaticale</label> ";
echo '<input type="text" class="input" id="catgram" name="catgram" value="' . $pos . '" size="70"></li>';

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
echo "<li><label for='gender'>Genre</label> ";
echo '<input type="text" class="input" id="gender" name="gender" value="' . $gender . '" size="70"></li>';

$number_id = $row['number'];
if($number_id == 12) {
    $number = "pluriel";
} else {
    $number = "singulier";
}
echo "<li><label for='number'>Nombre</label> ";
echo '<input type="text" class="input" id="number" name="number" value="' . $number . '" size="70"></li>';

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
    echo "<li><label for='def'>Définition</label> ";
    echo '<input type="text" class="input" id="def" name="def" value="' . $definition . '" size="70"></li>';
    echo "<li><label for='sourcedef'>Source de la définition</label> ";
    echo '<input type="text" class="input" id="sourcedef" name="sourcedef" value="' . $bib_title_def . ", " . $source_text_def . '" size="70"></li>';
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
    echo "<li><label for='exp'>Explication</label> ";
    echo '<input type="text" class="input" id="exp" name="exp" value="' . $explanation . '" size="70"></li>';
    echo "<li><label for='sourceexp'>Source de l'explication</label> ";
    echo '<input type="text" class="input" id="sourceexp" name="sourceexp" value="' . $bib_title_exp . ", " . $source_text_exp . '" size="70"></li>';
}
echo "</table>";

echo '<li><input type="submit" value="Sauvegarder"></li>';
echo "</ul></nav></fieldset></form>";

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
?>