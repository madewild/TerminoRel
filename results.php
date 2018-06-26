<?php $term = htmlspecialchars($_POST['term']); ?>
<h2>Glossaires de l'ULB</h2>

<p><a href="#">Revenir à l'écran de recherche initial</a></p><br>

<p><form class="form" action="index.php" method="post">
        <input type="text" class="input" name="term" size="60" value="<?php echo $term ?>">
        <input type="submit" value="Rechercher"><br>
        Langues : <?php echo htmlspecialchars($_POST['source']); ?> > <?php echo htmlspecialchars($_POST['cible']); ?> |
        Domaine : <?php echo htmlspecialchars($_POST['domaine']); ?> |
        Type d'information : <?php 
            $types = $_POST['type'];
            if(empty($types)) {
                echo "Aucun";
            } else {
                $typestring = implode(", ", $types);
                echo $typestring;
            }
        ?>
</form></p>

<p>X entrées trouvées pour <?php echo $term; ?></p>
