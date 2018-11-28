<?php 
error_reporting(-1);
ini_set('display_errors', 'On');
ini_set('mssql.charset', 'UTF-8');
include("secret.php");
$server = SERVER;
$username = USERNAME;
$password = PASSWORD;

$term = htmlspecialchars($_POST['term']);
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
?>

<h2>Glossaires de l'ULB</h2>

<p><a href="/">Retour à l'écran initial</a></p><br>

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
    }
    ?>
    <input type="submit" value="Rechercher"><br>
</form>

<div class="smaller_text">
    Langues : <?php echo $source ?> > <?php echo $cible ?> |
    Domaine : <?php echo $domaine ?> |
    Informations additionnelles : <?php 
        if(isset($types)) {
            $typestring = implode(", ", $types);
            echo $typestring;
        } else {
            echo "Aucune";
            $types = [];
        }
    ?>
</div><br>

<?php
$conn = mssql_connect($server, $username, $password);
if ($conn) {
    mssql_select_db("terminorel", $conn);
    $query = mssql_query("SELECT * FROM termgroup WHERE termlexid LIKE '%$source' AND termtext LIKE '%$term%' ORDER BY termtext", $conn);
    $num_rows = mssql_num_rows($query);
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
        while ($row = mssql_fetch_assoc($query)) {
            echo "<tr>";
            $lang = strtoupper(explode("-", $row['termlexid'])[3]);
            $pos_id = $row['pos'];
            if($pos_id == 1) {
                $pos = "nom";
            } else {
                $pos = "adjectif";
            }
            $gender_id = $row['gender'];
            if($gender_id == 2) {
                $gender = "masculin";
            } else if($gender_id == 4) {
                $gender = "masculin ou féminin";
            } else {
                $gender = "";
            }
            echo "<td><span class='source_lang'>" . $lang . "</span></td>";
            echo "<td>" . $row['termtext'] . "<div class='tooltip'><sup>?</sup><span class='tooltiptext'>" . $pos . " " . $gender . "</span></div>";
            $variant = $row['variant'];
            if($variant != NULL) {
                echo " | <span class='term_text'>" . $variant . "</span>";
            }

            $langroup_source = $row['langroup'];
            $abbrev = $row['abbrev'];
            if($abbrev == 1) {
                $result = mssql_query("SELECT * FROM termgroup WHERE langroup=$langroup_source", $conn);
                $termtextfull = mssql_fetch_assoc($result)['termtext'];
                echo " (<span class='term_text'>" . $termtextfull . "</span>)";
            }
            echo "</td></tr>";
            
            $result = mssql_query("SELECT termid FROM langroup WHERE id=$langroup_source", $conn);
            $termid = mssql_fetch_assoc($result)['termid'];

            $result = mssql_query("SELECT id FROM lang WHERE code LIKE '$source%'", $conn);
            $source_id = mssql_fetch_assoc($result)['id'];

            $result = mssql_query("SELECT id FROM lang WHERE code LIKE '$cible%'", $conn);
            $cible_id = mssql_fetch_assoc($result)['id'];

            if(in_array("Définition", $types)) {
                $result = mssql_query("SELECT definition FROM langroup WHERE termid=$termid AND lang=0", $conn);
                $definition = mssql_fetch_assoc($result)['definition'];
                if(!empty($definition)) {
                    $result = mssql_query("SELECT * FROM source WHERE termid=$termid AND type='def'", $conn);
                    $row = mssql_fetch_assoc($result);
                    $bib_id = $row['biblio'];
                    $source_text = $row['text'];
                    $result = mssql_query("SELECT title FROM biblio WHERE id=$bib_id", $conn);
                    $bib_title = mssql_fetch_assoc($result)['title'];
                    echo "<tr><td colspan='2'>Définition : " . $definition . "(<i>" . $bib_title . "</i>, " . $source_text . ")</td></tr>";
                }
            }

            if(in_array("Explication", $types)) {
                $result = mssql_query("SELECT explanation FROM langroup WHERE termid=$termid AND lang=$source_id", $conn);
                $explanation = mssql_fetch_assoc($result)['explanation'];
                if(!empty($explanation)) {
                    $result = mssql_query("SELECT * FROM source WHERE termid=$termid AND type='exp'", $conn);
                    $row = mssql_fetch_assoc($result);
                    $bib_id = $row['biblio'];
                    $source_text = $row['text'];
                    $result = mssql_query("SELECT title FROM biblio WHERE id=$bib_id", $conn);
                    $bib_title = mssql_fetch_assoc($result)['title'];
                    echo "<tr><td colspan='2'>Explication : " . $explanation . "(<i>" . $bib_title . "</i>, " . $source_text . ")</td></tr>";
                }
            }

            $result = mssql_query("SELECT id FROM langroup WHERE termid=$termid AND lang=$cible_id", $conn);
            $langroup_target = mssql_fetch_assoc($result)['id'];
            if($restriction == "approved_only") {
                $results = mssql_query("SELECT termtext, qualifier FROM termgroup WHERE langroup=$langroup_target and qualifier!=5", $conn);
            } else {
                $results = mssql_query("SELECT termtext, qualifier FROM termgroup WHERE langroup=$langroup_target", $conn);
            }
            $num_results = mssql_num_rows($results);
            if($num_results == 0) {
                echo "<tr><td><span class='target_lang'>EN</span></td>";
                echo "<td>Aucune traduction approuvée.</tr>";
            } else {
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
            }

            if(in_array("Exemple", $types)) {
                $result = mssql_query("SELECT id FROM termgroup WHERE langroup=$langroup_target", $conn);
                $termgroup = mssql_fetch_assoc($result)['id'];
                $result = mssql_query("SELECT id, context FROM contextgroup WHERE termgroup=$termgroup", $conn);
                $row = mssql_fetch_assoc($result);
                $contextgroup = $row['id'];
                $context = $row['context'];
                if(!empty($context)) {
                    $result = mssql_query("SELECT * FROM source WHERE contextgroup=$contextgroup", $conn);
                    $row = mssql_fetch_assoc($result);
                    $bib_id = $row['biblio'];
                    $source_text = $row['text'];
                    $result = mssql_query("SELECT title FROM biblio WHERE id=$bib_id", $conn);
                    $bib_title = mssql_fetch_assoc($result)['title'];
                    echo "<tr><td colspan='2'>Exemple d'usage : « " . $context . " » (<i>" . $bib_title . "</i>, " . $source_text . ")</td></tr>";
                }
            }

            echo "<tr><td colspan='2'><hr style='border: solid 0.5px grey; height: 0px'></td></tr>";
        }
        echo "</table>";
    }
    else {
        echo "Aucun résultat pour " . $term;
    }
}
?>

<?php include('footer.php'); ?>