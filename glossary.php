<?php 
error_reporting(-1);
ini_set('display_errors', 'On');
ini_set('mssql.charset', 'UTF-8');
include("secret.php");
$server = SERVER;
$username = USERNAME;
$password = PASSWORD;

$glossary = $_GET['glossary'];
$sort = $_GET['sort'];
?>

<h2>Glossaires de l'ULB</h2>

<p><a href="/">Retour à l'écran initial</a></p><br>

<?php
$conn = mssql_connect($server, $username, $password);
if ($conn) {
    mssql_select_db("terminorel", $conn);
    $query = mssql_query("SELECT * FROM termgroup WHERE termlexid LIKE '%$sort' ORDER BY termtext", $conn);
    $num_rows = mssql_num_rows($query);
    echo "<b>" . $num_rows . " entrées</b> trouvées<br><br>";
    echo "<b>Domaine : Titres et fonctions</b><br><br>";
    if($sort == "fr") {
        $other_code = "en";
        $other_lang = "l'anglais";
    } else {
        $other_code = "fr";
        $other_lang = "le français";
    }
    echo "<a href='?glossary=" . $glossary . "&sort=" . $other_code . "'>Trier en se basant sur " . $other_lang . "</a>";
    if ($num_rows > 0) {
        echo "<table class='results_table'>";
        while ($row = mssql_fetch_assoc($query)) {
            echo "<tr>";
            $lang = strtoupper(explode("-", $row['termlexid'])[3]);
            echo "<td><span class='source_lang'>" . $lang . "</span></td>";
            echo "<td><span class='term_text'>" . $row['termtext'] . "</span>";
            $variant = $row['variant'];
            if($variant != NULL) {
                echo " (<span class='term_text'>" . $variant . "</span>)";
            }
            echo "</td></tr><tr>";
            $langroup_source = $row['langroup'];
            $result = mssql_query("SELECT termid FROM langroup WHERE id=$langroup_source", $conn);
            $termid = mssql_fetch_assoc($result)['termid'];
            if($sort == "fr") {
                $cible_id = 1;
            } else {
                $cible_id = 0;
            }
            $result = mssql_query("SELECT id FROM langroup WHERE termid=$termid AND lang=$cible_id", $conn);
            $langroup_target = mssql_fetch_assoc($result)['id'];
            $results = mssql_query("SELECT termtext, qualifier FROM termgroup WHERE langroup=$langroup_target", $conn);
            while ($row = mssql_fetch_assoc($results)) {
                $translation = $row['termtext'];
                $qualifier = $row['qualifier'];
                if($qualifier == 5) {
                    $status = "";
                } else {
                    $status = " (recommandé)";
                }
                echo "<tr><td><span class='target_lang'>EN</span></td>";
                echo "<td><b>" . $translation . "</b>" . $status . "</td></tr>";
            }
            echo "<tr><td colspan='2'></td></tr>";
        }
        echo "</table>";
    }
    else {
        echo "Glossaire inconnu";
    }
}
?>

<?php include('footer.php'); ?>