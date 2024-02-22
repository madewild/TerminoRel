<?php 
include("../static/header.php");

$termlexid = htmlspecialchars($_GET['update']);
$conn = mysqli_connect($server, $username, $password) or die("Unable to connect to '$server'");
$conn -> set_charset("utf8");
mysqli_select_db($conn, $database) or die("Could not open the database '$database'");

if ($conn) {
    $query = "SELECT * FROM termgroup WHERE termlexid LIKE '$termlexid'";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($result);
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
$query2 = "SELECT * FROM termgroup WHERE langroup=$langroup_source AND abbrev=1";
$result2 = mysqli_query($conn, $query2);
$row2 = mysqli_fetch_assoc($result2);
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

$query3 = "SELECT termid FROM langroup WHERE id=$langroup_source";
$result3 = mysqli_query($conn, $query3);
$termid = mysqli_fetch_asoc($result3)['termid'];

$query4 = "SELECT definition FROM langroup WHERE termid=$termid AND lang LIKE 'fr%'";
$result4 = mysqli_query($conn, $query4);
$definition = mysqli_fetch_assoc($result4)['definition'];
if(!empty($definition)) {
    $query5 = "SELECT * FROM source WHERE termid=$termid AND type='def'";
    $result5 = mysqli_query($conn, $query5);
    $row = mysqli_fetch_assoc($result5);
    $bib_id = $row['biblio'];
    $source_text_def = $row['text'];
    $query6 = "SELECT title FROM biblio WHERE id=$bib_id";
    $result6 = mysqli_query($conn, $query6);
    $bib_title_def = mysqli_fetch_assoc($result6)['title'];
    echo "<tr><td><label for='def'>Définition</label></td>";
    echo '<td><input type="text" class="input" id="def" name="def" value="' . $definition . '" size="150"></td></tr>';
    echo "<tr><td><label for='sourcedef'>Source de la définition</label></td>";
    echo '<td><input type="text" class="input" id="sourcedef" name="sourcedef" value="' . $bib_title_def . ", " . $source_text_def . '" size="150"></td></tr>';
}

$query7 = "SELECT explanation FROM langroup WHERE termid=$termid AND lang LIKE 'fr%'";
$result7 = mysqli_query($conn, $query7);
$explanation = mysqli_fetch_assoc($result7)['explanation'];
if(!empty($explanation)) {
    $query8 = "SELECT * FROM source WHERE termid=$termid AND type='exp'";
    $result8 = mysqli_query($conn, $query8);
    $row = mysqli_fetch_assoc($result8);
    $bib_id = $row['biblio'];
    $source_text_exp = $row['text'];
    $query9 = "SELECT title FROM biblio WHERE id=$bib_id";
    $result9 = mysqli_query($conn, $query9);
    $bib_title_exp = mysqli_fetch_assoc($result9)['title'];
    echo "<tr><td><label for='exp'>Explication</label></td>";
    echo '<td><input type="text" class="input" id="exp" name="exp" value="' . $explanation . '" size="150"></td></tr>';
    echo "<tr><td><label for='sourceexp'>Source de l'explication</label></td>";
    echo '<td><input type="text" class="input" id="sourceexp" name="sourceexp" value="' . $bib_title_exp . ", " . $source_text_exp . '" size="150"></td></tr>';
}
echo "</table>";

echo '<input type="submit" value="Sauvegarder">';
echo "</nav></fieldset></form>";

$query10 = "SELECT id FROM langroup WHERE termid=$termid AND lang LIKE 'en%'";
$result10 = mysqli_query($conn, $query10);
$langroup_target = mysqli_fetch_assoc($result10)['id'];
$query_pref = "SELECT * FROM termgroup WHERE langroup=$langroup_target AND auth=7";
$results_pref = mysqli_query($conn, $query_pref);
if($results_pref === FALSE) {
    print_r(mysqli_errors(), true);
    print_r($langroup_target);
}
$query_admi = "SELECT * FROM termgroup WHERE langroup=$langroup_target AND auth IN (0,9)";
$results_admi = mysqli_query($conn, $query_admi);
$query_depr = "SELECT * FROM termgroup WHERE langroup=$langroup_target AND auth=10";
$results_depr = mysqli_query($conn, $query_depr);

$num_pref = mysqli_num_rows($results_pref);
show_trad_admin($conn, $results_pref, "privilégiée");
show_trad_admin($conn, $results_admi, "admise");
show_trad_admin($conn, $results_depr, "à éviter");
?>