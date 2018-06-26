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

<p><a href="http://terminorel.ulb.be">Revenir à l'écran de recherche initial</a></p><br>

<form class="form" action="#" method="post">
    <input type="text" class="input" name="term" size="60" value="<?php echo $term ?>">
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
    Type d'information : <?php 
        if(empty($types)) {
            echo "Aucun";
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
    $query = mssql_query("SELECT * FROM termgroup WHERE termlexid LIKE '%$source_code' AND termtext LIKE '%$term%'", $conn);
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
            echo "</td></tr><tr>";
            $langroup_source = $row['langroup'];
            $result = mssql_query("SELECT termid FROM langroup WHERE id=$langroup_source", $conn);
            $termid = mssql_fetch_assoc($result)['termid'];
            $result = mssql_query("SELECT id FROM langroup WHERE termid=$termid AND lang=1", $conn);
            $langroup_target = mssql_fetch_assoc($result)['id'];
            $result = mssql_query("SELECT termtext FROM termgroup WHERE langroup=$langroup_target", $conn);
            $translations = mssql_fetch_assoc($result)['termtext'];
            echo "<td><span class='target_lang'>EN</span></td>";
            echo "<td><b>" . $translations . "</b></td></tr><tr></tr>";
        }
        echo "</table>";
    }
    else {
        echo "Aucun résultat pour " . $term;
    }
}
?>

<?php include('footer.php'); ?>