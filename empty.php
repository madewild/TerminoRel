<h2>Glossaires de l'ULB</h2>

<p><a href="http://terminorel.ulb.be">Revenir à l'écran de recherche initial</a></p><br>

<form class="form" action="#" method="post">
    <input type="text" class="input" name="term" size="60">
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

<span class="red">Veuillez entrer au moins un caractère !</span>

<?php include('footer.php'); ?>