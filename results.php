<?php 
$term = htmlspecialchars($_POST['term']);
$source = htmlspecialchars($_POST['source']);
$cible = htmlspecialchars($_POST['cible']);
$domaine = htmlspecialchars($_POST['domaine']);
$types = $_POST['type'];
?>

<h2>Glossaires de l'ULB</h2>

<p><a href="http://terminorel.ulb.be">Revenir à l'écran de recherche initial</a></p><br>

<p>
    <form class="form" action="#" method="post">
        <input type="text" class="input" name="term" size="60" value="<?php echo $term ?>">
        <input type="hidden" name="source" value="<?php echo $source; ?>">
        <input type="hidden" name="cible" value="<?php echo $cible; ?>">
        <input type="hidden" name="domaine" value="<?php echo $domaine; ?>">
        <input type="hidden" name="type[]" value="<?php echo $types; ?>">
        <input type="submit" value="Rechercher"><br>
        <div class="small">
        Langues : <?php echo $source ?> > <?php echo $cible ?> |
        Domaine : <?php echo $domaine ?> |
        Type d'information : <?php 
            if(empty($types)) {
                echo "Aucun";
            } else {
                $typestring = implode(", ", $types);
                echo $typestring;
            }
        ?>
        </div>
    </form>
</p>

<p>X entrées trouvées pour <?php echo $term; ?></p>
