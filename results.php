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
    Information supplémentaire : <?php 
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
            echo "<td><span class='source_lang'>" . $lang . "</span></td>";
            echo "<td><span class='term_text'>" . $row['termtext'] . "</span>";
            $variant = $row['variant'];
            if($variant != NULL) {
                echo " (<span class='term_text'>" . $variant . "</span>)";
            }
            echo "</td></tr>";

            $langroup_source = $row['langroup'];
            $result = mssql_query("SELECT termid FROM langroup WHERE id=$langroup_source", $conn);
            $termid = mssql_fetch_assoc($result)['termid'];

            $result = mssql_query("SELECT id FROM lang WHERE code LIKE '$source%'", $conn);
            $source_id = mssql_fetch_assoc($result)['id'];

            $result = mssql_query("SELECT id FROM lang WHERE code LIKE '$cible%'", $conn);
            $cible_id = mssql_fetch_assoc($result)['id'];

            if(in_array("Définition", $types)) {
                $result = mssql_query("SELECT definition FROM langroup WHERE termid=$termid AND lang=0", $conn);
                $definition = mssql_fetch_assoc($result)['definition'];
                echo "<tr><td colspan='2'>" . $definition . "</td></tr>";
            }

            if(in_array("Explication", $types)) {
                $result = mssql_query("SELECT explanation FROM langroup WHERE termid=$termid AND lang=$source_id", $conn);
                $explanation = mssql_fetch_assoc($result)['explanation'];
                echo "<tr><td colspan='2'>" . $explanation . "</td></tr>";
            }

            $result = mssql_query("SELECT id FROM langroup WHERE termid=$termid AND lang=$cible_id", $conn);
            $langroup_target = mssql_fetch_assoc($result)['id'];
            if($restriction == "approved_only") {
                $results = mssql_query("SELECT termtext, qualifier FROM termgroup WHERE langroup=$langroup_target and qualifier!=5", $conn);
            } else {
                $results = mssql_query("SELECT termtext, qualifier FROM termgroup WHERE langroup=$langroup_target", $conn);
            }
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

            if(in_array("Exemple", $types)) {
                $result = mssql_query("SELECT id FROM termgroup WHERE langroup=$langroup_target", $conn);
                $termgroup = mssql_fetch_assoc($result)['id'];
                $result = mssql_query("SELECT id, context FROM contextgroup WHERE termgroup=$termgroup", $conn);
                $row = mssql_fetch_assoc($result);
                $contextgroup = $row['id'];
                $context = $row['context'];
                if(not(empty($context))) {
                    $result = mssql_query("SELECT * FROM source WHERE contextgroup=$contextgroup", $conn);
                    $row = mssql_fetch_assoc($result);
                    $bib_id = $row['biblio'];
                    $source_text = $row['text'];
                    $result = mssql_query("SELECT title FROM biblio WHERE id=$bib_id", $conn);
                    $bib_title = mssql_fetch_assoc($result)['title'];
                    echo "<tr><td colspan='2'>" . $context . "(" . $bib_title . ", " . $source_text . ")</td></tr>";
                }
            }

            echo "<tr><td colspan='2'></td></tr>";
        }
        echo "</table>";
    }
    else {
        echo "Aucun résultat pour " . $term;
    }
}
?>

<?php include('footer.php'); ?>