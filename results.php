<?php 
error_reporting(-1);
ini_set('display_errors', 'On');
include("static/secret.php");
$server = SERVER;
$username = USERNAME;
$password = PASSWORD;

$term = htmlspecialchars($_POST['term']);
$clean_term = str_replace("'", "''", $term);
$source = htmlspecialchars($_POST['source']);
$cible = htmlspecialchars($_POST['cible']);
$domaine = htmlspecialchars($_POST['domaine']);
if(isset($_POST['type'])) {
    $types = $_POST['type'];    
}
if(isset($_POST['status'])) {
    $restriction = htmlspecialchars($_POST['status']);
} else {
    $restriction = "none";
}

function show_trad($conn, $langroup_target, $results, $type) {
    while ($row = sqlsrv_fetch_array($results)) {
        $translation = $row['termtext'];
        $lang_trad = strtoupper(explode("-", $row['termlexid'])[3]);
        $variant = $row['variant'];
        echo "<tr><td><span class='target_lang'>" . $lang_trad . "</span></td>";
        echo "<td><details><summary><span title='Cliquez sur le terme pour voir un exemple.'><b>" . $translation;
        if($variant != NULL and $lang_trad == 'FR') {
            echo " | " . $variant;
        }
        echo "</b> (terme " . $type . ") &#9432;";
        echo "</span></summary>";
        $result = sqlsrv_query($conn, "SELECT id FROM termgroup WHERE langroup=$langroup_target");
        $termgroup = sqlsrv_fetch_array($result)['id'];
        $result = sqlsrv_query($conn, "SELECT id, context FROM contextgroup WHERE termgroup=$termgroup");
        $row = sqlsrv_fetch_array($result);
        $contextgroup = $row['id'];
        $context = $row['context'];
        if(!empty($context)) {
            $result = sqlsrv_query($conn, "SELECT * FROM source WHERE contextgroup=$contextgroup");
            $row = sqlsrv_fetch_array($result);
            $bib_id = $row['biblio'];
            $source_text_con = $row['text'];
            $result = sqlsrv_query($conn, "SELECT title FROM biblio WHERE id=$bib_id");
            $bib_title_con = sqlsrv_fetch_array($result)['title'];
            echo "<br><u>Exemple d'usage</u> : « " . $context . " » (<i>" . $bib_title_con . "</i>, " . $source_text_con . ")";
        } else {
            echo "<br>Pas d'exemple d'usage pour ce terme.";
        }
        echo "</details></td></tr>";
    }
}
?>

<h2>TerminoRel – Glossaires académiques de l’ULB pour la rédaction de textes en anglais</h2>

<?php include('static/retour.php'); ?>

<form class="form" action="#" method="post" onsubmit="return validate()">
    <input type="text" class="input" id="term" name="term" size="60" value="<?php echo $term ?>">
    <input type="hidden" name="source" value="<?php echo $source; ?>">
    <input type="hidden" name="cible" value="<?php echo $cible; ?>">
    <input type="hidden" name="domaine" value="<?php echo $domaine; ?>">
    <?php
    if(isset($types)) {
        foreach($types as $type) {
            echo '<input type="hidden" name="type[]" value="' . $type . '">';
        }
    } else {
        $types = [];
    }
    ?>
    <input type="submit" value="Rechercher"><br>
</form>

<div class="smaller_text">
    Langues : <?php echo $source ?> > <?php echo $cible ?>
    | Domaine : <?php echo $domaine ?>
    <!--| Informations additionnelles : -->
    <?php 
        /*if(isset($types)) {
            $typestring = implode(", ", $types);
            echo $typestring;
        } else {
            echo "Aucune";
        }*/
    ?>
</div><br>

<?php
$conninfo = array(
    "Database" => "terminorel",
    "UID" => $username,
    "PWD" => $password,
    "CharacterSet" => "UTF-8"
);

$conn = sqlsrv_connect($server, $conninfo);
if ($conn) {
    $query = sqlsrv_query($conn, "SELECT * FROM termgroup WHERE termlexid LIKE '%$source' AND (termtext LIKE '%$clean_term%' OR variant LIKE '%$clean_term%' ) ORDER BY termtext");
    $num_rows = sqlsrv_num_rows($query);
    if($num_rows == 0) {
        echo "Aucune entrée</b> trouvée pour <b>" . $term . "</b><br><br>";
    } else if($num_rows == 1) {
        echo "<b>1 entrée</b> trouvée pour <b>" . $term . "</b><br><br>";
    } else {
        echo "<b>" . $num_rows . " entrées</b> trouvées pour <b>" . $term . "</b><br><br>";
    }
    echo "<b>Domaine : " . $domaine . "</b><br><br>";
    if ($num_rows > 0) {
        echo "<table class='results_table'>";
        while ($row = sqlsrv_fetch_array($query)) {
            echo "<tr>";
            $lang = strtoupper(explode("-", $row['termlexid'])[3]);
            echo "<td><span class='source_lang'>" . $lang . "</span></td>";
            echo "<td><details><summary>";
            echo "<span title='Cliquez sur le terme pour voir sa définition.'>" . $row['termtext'];
            $variant = $row['variant'];
            if($variant != NULL) {
                echo " | ";
                echo $variant;
            }

            $langroup_source = $row['langroup'];
            $abbrev = $row['abbrev'];
            if($abbrev == 1) {
                $result = sqlsrv_query($conn, "SELECT * FROM termgroup WHERE langroup=$langroup_source");
                $row2 = sqlsrv_fetch_array($result);
                $termtextfull = $row2['termtext'];
                $termtextfull_variant = $row2['variant'];
                echo " (" . $termtextfull . " | " . $termtextfull_variant . ")";
            } else {
                $result = sqlsrv_query($conn, "SELECT * FROM termgroup WHERE langroup=$langroup_source AND abbrev=1");
                $row2 = sqlsrv_fetch_array($result);
                if($row2) {
                    $acro = $row2['termtext'];
                    echo " (" . $acro . ")";
                }
            }
            echo " &#9432;</span></summary>";

            $pos_id = $row['pos'];
            if($pos_id == 1) {
                $pos = "Nom";
            } else {
                $pos = "Adjectif";
            }
            /*$gender_id = $row['gender'];
            if($gender_id == 2) {
                $gender = "masculin";
            } else if($gender_id == 4) {
                $gender = "masculin ou féminin";
            } else {
                $gender = "";
            }*/

            echo "<br>" . $pos . " masculin ou féminin<br>";

            $result = sqlsrv_query($conn, "SELECT termid FROM langroup WHERE id=$langroup_source");
            $termid = sqlsrv_fetch_array($result)['termid'];

            $result = sqlsrv_query($conn, "SELECT definition FROM langroup WHERE termid=$termid AND lang=0");
            $definition = sqlsrv_fetch_array($result)['definition'];
            if(!empty($definition)) {
                $result = sqlsrv_query($conn, "SELECT * FROM source WHERE termid=$termid AND type='def'");
                $row = sqlsrv_fetch_array($result);
                $bib_id = $row['biblio'];
                $source_text_def = $row['text'];
                $result = sqlsrv_query($conn, "SELECT title FROM biblio WHERE id=$bib_id");
                $bib_title_def = sqlsrv_fetch_array($result)['title'];
                echo "<br><u>Définition</u> : " . $definition . " (<i>" . $bib_title_def . "</i>, " . $source_text_def . ")";
            }

            $result = sqlsrv_query($conn, "SELECT id FROM lang WHERE code LIKE '$source%'");
            $source_id = sqlsrv_fetch_array($result)['id'];

            $result = sqlsrv_query($conn, "SELECT explanation FROM langroup WHERE termid=$termid AND lang=$source_id");
            $explanation = sqlsrv_fetch_array($result)['explanation'];
            if(!empty($explanation)) {
                $result = sqlsrv_query($conn, "SELECT * FROM source WHERE termid=$termid AND type='exp'");
                $row = sqlsrv_fetch_array($result);
                $bib_id = $row['biblio'];
                $source_text_exp = $row['text'];
                $result = sqlsrv_query($conn, "SELECT title FROM biblio WHERE id=$bib_id");
                $bib_title_exp = sqlsrv_fetch_array($result)['title'];
                echo "<br><br><u>Explication</u> : " . $explanation . " (<i>" . $bib_title_exp . "</i>, " . $source_text_exp . ")";
            }

            echo "</details></td></tr>";

            if(in_array("Définition", $types)) {
                if(!empty($definition)) {
                    echo "<tr><td></td><td><u>Définition</u> : " . $definition . " (<i>" . $bib_title_def . "</i>, " . $source_text_def . ")</td></tr>";
                }
            }

            if(in_array("Explication", $types)) {
                if(!empty($explanation)) {
                    echo "<tr><td></td><td><u>Explication</u> : " . $explanation . " (<i>" . $bib_title_exp . "</i>, " . $source_text_exp . ")</td></tr>";
                }
            }

            $result = sqlsrv_query($conn, "SELECT id FROM lang WHERE code LIKE '$cible%'");
            $cible_id = sqlsrv_fetch_array($result)['id'];

            $result = sqlsrv_query($conn, "SELECT id FROM langroup WHERE termid=$termid AND lang=$cible_id");
            $langroup_target = sqlsrv_fetch_array($result)['id'];
            $results_recom = sqlsrv_query($conn, "SELECT * FROM termgroup WHERE langroup=$langroup_target AND qualifier!=5");
            $results_prop = sqlsrv_query($conn, "SELECT * FROM termgroup WHERE langroup=$langroup_target AND qualifier=5");
            $num_recom = sqlsrv_num_rows($results_recom);
            if($num_recom == 0 and $restriction == "approved_only") {
                echo "<tr><td><span class='target_lang'>EN</span></td>";
                echo "<td>Aucune traduction approuvée.</tr>";
            } else {
                show_trad($conn, $langroup_target, $results_recom, "recommandé");
                if($num_recom == 0) {
                    show_trad($conn, $langroup_target, $results_prop, "suggéré");
                }
            }

            if(in_array("Exemple", $types)) {
                if(!empty($context)) {
                    echo "<tr><td></td><td><u>Exemple d'usage</u> : « " . $context . " » (<i>" . $bib_title_con . "</i>, " . $source_text_con . ")</td></tr>";
                }
            }

            if(--$num_rows > 0) {
                echo "<tr><td colspan='2'><hr style='border: solid 0.5px silver; height: 0px'></td></tr>";
            }
        }
        echo "</table>";
    }
    else {
        echo "Aucun résultat pour " . $term;
    }
}
?>