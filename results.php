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
$code_full = explode(" - ", $source);
$source_code = $code_full[0];
$source_full = $code_full[1];
$cible = htmlspecialchars($_POST['cible']);
$domaine = htmlspecialchars($_POST['domaine']);
$types = $_POST['type'];
?>

<h2>Glossaires de l'ULB</h2>

<p><a href="/">Retour à l'écran initial</a></p><br>

<form class="form" action="#" method="post" onsubmit="return validate()">
    <input type="text" class="input" id="term" name="term" size="60" value="<?php echo $term ?>">
    <input type="hidden" name="source" value="<?php echo $source; ?>">
    <input type="hidden" name="cible" value="<?php echo $cible; ?>">
    <input type="hidden" name="domaine" value="<?php echo $domaine; ?>">
    <?php
    foreach($types as $type) {
        echo '<input type="hidden" name="type[]" value="' . $type . '">';
    }
    ?>
    <input type="submit" value="Rechercher"><br>
</form>

<div class="smaller_text">
    Langues : <?php echo $source_full ?> > <?php echo $cible ?> |
    Domaine : <?php echo $domaine ?> |
    Information supplémentaire : <?php 
        if(empty($types)) {
            echo "Aucune";
        } else {
            $typestring = implode(", ", $types);
            echo $typestring;
        }
    ?>
</div><br>

<?php
$conn = mssql_connect($server, $username, $password);
if ($conn) {
    mssql_select_db("terminorel", $conn);
    $query = mssql_query("SELECT * FROM termgroup WHERE termlexid LIKE '%$source_code' AND termtext LIKE '%$term%' ORDER BY termtext", $conn);
    $num_rows = mssql_num_rows($query);
    echo "<b>" . $num_rows . " entrées</b> trouvées pour <b>" . $term . "</b><br><br>";
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
            $result = mssql_query("SELECT id FROM langroup WHERE termid=$termid AND lang=1", $conn);
            $langroup_target = mssql_fetch_assoc($result)['id'];
            $result = mssql_query("SELECT termtext FROM termgroup WHERE langroup=$langroup_target", $conn);
            $translation = mssql_fetch_assoc($result)['termtext'];

            if(in_array("Définition", $types)) {
                $result = mssql_query("SELECT definition FROM langroup WHERE termid=$termid AND lang=0", $conn);
                $definition = mssql_fetch_assoc($result)['definition'];
                echo "<tr><td colspan='2'>" . $definition . "</td></tr>";
            }

            if(in_array("Contexte", $types)) {
                $result = mssql_query("SELECT explanation FROM langroup WHERE termid=$termid AND lang=0", $conn);
                $explanation = mssql_fetch_assoc($result)['explanation'];
                echo "<tr><td colspan='2'>" . $explanation . "</td></tr>";
            }

            // $explanation = mssql_fetch_assoc($result)['explanation'];

            echo "<tr><td><span class='target_lang'>EN</span></td>";
            echo "<td><b>" . $translation . "</b></td></tr>";
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