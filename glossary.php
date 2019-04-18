<?php 
error_reporting(-1);
ini_set('display_errors', 'On');
ini_set('mssql.charset', 'UTF-8');
include("static/secret.php");
$server = SERVER;
$username = USERNAME;
$password = PASSWORD;

$glossary = htmlspecialchars($_GET['glossary']);
$sort = htmlspecialchars($_GET['sort']);

echo "<h2>TerminoRel – Glossaire
académique de l’ULB pour la rédaction de textes en anglais</h2>";

if($sort == "fr") {
        $other_code = "en";
        $other_lang = "l'anglais";
    } else {
        $other_code = "fr";
        $other_lang = "le français";
    }

echo "<p><a href='/'>Retour à l'écran initial</a> | ";
echo "<a href='?glossary=" . $glossary . "&sort=" . $other_code . "'>Trier en se basant sur " . $other_lang . "</a></p><br>";

$conninfo = array(
    "Database" => "terminorel",
    "UID" => $username,
    "PWD" => $password
);

$conn = sqlsrv_connect($server, $conninfo);
if ($conn) {
    $query = sqlsrv_query("SELECT * FROM termgroup WHERE termlexid LIKE '%$sort' ORDER BY termtext", $conn);
    $num_rows = sqlsrv_num_rows($query);
    echo "<b>Domaine : Titres et fonctions</b><br><br>";
    echo "<b>" . $num_rows . " entrées</b> trouvées<br><br>";
    
    if ($num_rows > 0) {
        echo "<table class='results_table'>";
        while ($row = sqlsrv_fetch_assoc($query)) {
            echo "<tr>";
            $lang = strtoupper(explode("-", $row['termlexid'])[3]);
            echo "<td><span class='source_lang'>" . $lang . "</span></td>";
            echo "<td>" . $row['termtext'] . "";
            $variant = $row['variant'];
            if($variant != NULL) {
                echo " | " . $variant;
            }

            $langroup_source = $row['langroup'];
            $abbrev = $row['abbrev'];
            if($abbrev == 1) {
                $result = sqlsrv_query("SELECT * FROM termgroup WHERE langroup=$langroup_source", $conn);
                $row = sqlsrv_fetch_assoc($result);
                $termtextfull = $row['termtext'];
                $termtextfull_variant = $row['variant'];
                echo " (" . $termtextfull . " | " . $termtextfull_variant . ")";
            } else {
                $result = sqlsrv_query("SELECT * FROM termgroup WHERE langroup=$langroup_source AND abbrev=1", $conn);
                $row = sqlsrv_fetch_assoc($result);
                if($row) {
                    $acro = $row['termtext'];
                    echo " (" . $acro . ")";
                }
            }

            echo "</td></tr><tr>";
            $result = sqlsrv_query("SELECT termid FROM langroup WHERE id=$langroup_source", $conn);
            $termid = sqlsrv_fetch_assoc($result)['termid'];
            if($sort == "fr") {
                $cible_id = 1;
            } else {
                $cible_id = 0;
            }
            $result = sqlsrv_query("SELECT id FROM langroup WHERE termid=$termid AND lang=$cible_id", $conn);
            $langroup_target = sqlsrv_fetch_assoc($result)['id'];
            $results_recom = sqlsrv_query("SELECT * FROM termgroup WHERE langroup=$langroup_target AND qualifier!=5", $conn);
            $results_prop = sqlsrv_query("SELECT * FROM termgroup WHERE langroup=$langroup_target AND qualifier=5", $conn);
            $num_recom = sqlsrv_num_rows($results_recom);
            while ($row = sqlsrv_fetch_assoc($results_recom)) {
                $translation = $row['termtext'];
                $lang_trad = strtoupper(explode("-", $row['termlexid'])[3]);
                $variant = $row['variant'];
                echo "<tr><td><span class='target_lang'>" . $lang_trad . "</span></td>";
                    echo "<td><b>" . $translation;
                    if($variant != NULL) {
                        echo " | " . $variant;
                    }
                    echo "</b> (terme recommandé)</td></tr>";
            }
            if($num_recom == 0) {
                while ($row = sqlsrv_fetch_assoc($results_prop)) {
                    $translation = $row['termtext'];
                    $lang_trad = strtoupper(explode("-", $row['termlexid'])[3]);
                    $variant = $row['variant'];
                    echo "<tr><td><span class='target_lang'>" . $lang_trad . "</span></td>";
                    echo "<td><b>" . $translation;
                    if($variant != NULL) {
                        echo " | " . $variant;
                    }
                    echo "</b> (terme suggéré)</td></tr>";
                }
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
