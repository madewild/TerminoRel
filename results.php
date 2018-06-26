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
    <input type="hidden" name="type[]" value="<?php echo $types; ?>">
    <input type="submit" value="Rechercher"><br>
</form>

<div class="glossary_footer">
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
        echo "<table>";
        while ($row = mssql_fetch_assoc($query)) {
            echo "<tr>";
            $lang = strtoupper(explode("-", $row['termlexid'])[3]);
            echo "<td>" . $lang . "</td>";
            echo "<td>" . $row['termtext'];
            $variant = $row['variant'];
            if($variant != NULL) {
                echo " (" . $variant . ")";
            }
            echo "</td></tr>";
        }
        echo "</table>";
    }
    else {
        echo "Aucun résultat pour " . $term;
    }
}
?>

<?php include('footer.php'); ?>