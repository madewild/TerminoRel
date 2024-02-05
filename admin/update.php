<?php 
include("../static/header.php");

$termlexid = htmlspecialchars($_GET['update']);
$conn = mysqli_connect($server, $conninfo);
if ($conn) {
    $query = mysqli_query($conn, "SELECT * FROM termgroup WHERE termlexid LIKE '$termlexid'", array(), array("Scrollable" => 'static'));
    $row = mysqli_fetch_array($query);
}

$path = $_SERVER['REQUEST_URI'];
$barepath = strtok($path, '?');
$fullpath = $barepath . "?fiche=" . $termlexid;

echo "<p><a href='" . $fullpath . "'>Retour à la fiche</a></p>";

echo "<h3>Modifier la fiche</h3>";
echo '<form class="form" action="" method="get"><fieldset><nav id="form"><table>';
echo "<tr><td><label for='term'>Terme principal en français</label></td>";
echo '<td><input type="text" class="input" id="term" name="term" value="' . $row['termtext'] . '" size="150"></td></tr>';

$variant = $row['variant'];
$mf = False;
if($variant != NULL) {
    echo "<tr><td><label for='variant'>Variante</label></td>";
    echo '<td><input type="text" class="input" id="variant" name="variant" value="' . $variant . '" size="150"></td></tr>';
    $mf = True;
}

$langroup_source = $row['langroup'];
$result = mysqli_query($conn, "SELECT * FROM termgroup WHERE langroup=$langroup_source AND abbrev=1", array(), array("Scrollable" => 'static'));
$row2 = mysqli_fetch_array($result);
if($row2) {
    $acro = $row2['termtext'];
    echo "<tr><td><label for='abrev'>Abréviation</label></td>";
    echo '<td><input type="text" class="input" id="abrev" name="abrev" value="' . $acro . '" size="150"></td></tr>';
}

$pos_id = $row['pos'];
if($pos_id == 1) {
    $pos = "nom";
} else if($pos_id == 6) {
    $pos = "adjectif"; // Also add Verbe
} else {
    $pos = "locution";
}
echo "<tr><td><label for='catgram'>Catégorie grammaticale</label></td>";
echo '<td><input type="text" class="input" id="catgram" name="catgram" value="' . $pos . '" size="150"></td></tr>';

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
echo "<tr><td><label for='gender'>Genre</label></td>";
echo '<td><input type="text" class="input" id="gender" name="gender" value="' . $gender . '" size="150"></td></tr>';

$number_id = $row['number'];
if($number_id == 12) {
    $number = "pluriel";
} else {
    $number = "singulier";
}
echo "<tr><td><label for='number'>Nombre</label></td>";
echo '<td><input type="text" class="input" id="number" name="number" value="' . $number . '" size="150"></td></tr>';

$result = mysqli_query($conn, "SELECT termid FROM langroup WHERE id=$langroup_source", array(), array("Scrollable" => 'static'));
$termid = mysqli_fetch_array($result)['termid'];

$result = mysqli_query($conn, "SELECT definition FROM langroup WHERE termid=$termid AND lang LIKE 'fr%'", array(), array("Scrollable" => 'static'));
$definition = mysqli_fetch_array($result)['definition'];
if(!empty($definition)) {
    $result = mysqli_query($conn, "SELECT * FROM source WHERE termid=$termid AND type='def'", array(), array("Scrollable" => 'static'));
    $row = mysqli_fetch_array($result);
    $bib_id = $row['biblio'];
    $source_text_def = $row['text'];
    $result = mysqli_query($conn, "SELECT title FROM biblio WHERE id=$bib_id", array(), array("Scrollable" => 'static'));
    $bib_title_def = mysqli_fetch_array($result)['title'];
    echo "<tr><td><label for='def'>Définition</label></td>";
    echo '<td><input type="text" class="input" id="def" name="def" value="' . $definition . '" size="150"></td></tr>';
    echo "<tr><td><label for='sourcedef'>Source de la définition</label></td>";
    echo '<td><input type="text" class="input" id="sourcedef" name="sourcedef" value="' . $bib_title_def . ", " . $source_text_def . '" size="150"></td></tr>';
}

$result = mysqli_query($conn, "SELECT explanation FROM langroup WHERE termid=$termid AND lang LIKE 'fr%'", array(), array("Scrollable" => 'static'));
$explanation = mysqli_fetch_array($result)['explanation'];
if(!empty($explanation)) {
    $result = mysqli_query($conn, "SELECT * FROM source WHERE termid=$termid AND type='exp'", array(), array("Scrollable" => 'static'));
    $row = mysqli_fetch_array($result);
    $bib_id = $row['biblio'];
    $source_text_exp = $row['text'];
    $result = mysqli_query($conn, "SELECT title FROM biblio WHERE id=$bib_id", array(), array("Scrollable" => 'static'));
    $bib_title_exp = mysqli_fetch_array($result)['title'];
    echo "<tr><td><label for='exp'>Explication</label></td>";
    echo '<td><input type="text" class="input" id="exp" name="exp" value="' . $explanation . '" size="150"></td></tr>';
    echo "<tr><td><label for='sourceexp'>Source de l'explication</label></td>";
    echo '<td><input type="text" class="input" id="sourceexp" name="sourceexp" value="' . $bib_title_exp . ", " . $source_text_exp . '" size="150"></td></tr>';
}
echo "</table>";

echo '<input type="submit" value="Sauvegarder">';
echo "</nav></fieldset></form>";

$result = mysqli_query($conn, "SELECT id FROM langroup WHERE termid=$termid AND lang LIKE 'en%'", array(), array("Scrollable" => 'static'));
$langroup_target = mysqli_fetch_array($result)['id'];
$results_pref = mysqli_query($conn, "SELECT * FROM termgroup WHERE langroup=$langroup_target AND auth=7", array(), array("Scrollable" => 'static'));
if($results_pref === FALSE) {
    print_r(mysqli_errors(), true);
    print_r($langroup_target);
}
$results_admi = mysqli_query($conn, "SELECT * FROM termgroup WHERE langroup=$langroup_target AND auth IN (0,9)", array(), array("Scrollable" => 'static'));
$results_depr = mysqli_query($conn, "SELECT * FROM termgroup WHERE langroup=$langroup_target AND auth=10", array(), array("Scrollable" => 'static'));

$num_pref = mysqli_num_rows($results_pref);
show_trad_admin($conn, $results_pref, "privilégiée");
show_trad_admin($conn, $results_admi, "admise");
show_trad_admin($conn, $results_depr, "à éviter");
?>