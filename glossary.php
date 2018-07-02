<?php 
error_reporting(-1);
ini_set('display_errors', 'On');
ini_set('mssql.charset', 'UTF-8');
include("secret.php");
$server = SERVER;
$username = USERNAME;
$password = PASSWORD;

$glossary = htmlspecialchars($_GET['glossary']);
?>

<h2>Glossaires de l'ULB</h2>

<p><a href="http://terminorel.ulb.be">Retour à l'écran initial</a></p><br>

<?php
$conn = mssql_connect($server, $username, $password);
if ($conn) {
    mssql_select_db("terminorel", $conn);
    $query = mssql_query("SELECT * FROM termgroup WHERE termlexid LIKE '%fr'", $conn);
    $num_rows = mssql_num_rows($query);
    echo "<b>" . $num_rows . " entrées</b> trouvées<br><br>";
    echo "<b>Domaine : Titres et fonctions</b><br><br>";
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
            $result = mssql_query("SELECT id FROM langroup WHERE termid=$termid AND lang=1", $conn);
            $langroup_target = mssql_fetch_assoc($result)['id'];
            $result = mssql_query("SELECT termtext FROM termgroup WHERE langroup=$langroup_target", $conn);
            $translation = mssql_fetch_assoc($result)['termtext'];
            echo "<td><span class='target_lang'>EN</span></td>";
            echo "<td><b>" . $translation . "</b></td></tr>";
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