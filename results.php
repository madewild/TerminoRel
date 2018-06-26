<h2>Glossaires de l'ULB</h2>

<p><a href="index.php">Revenir à l'écran de recherche initial</a></p>

<form class="form" action="index.php" method="post">
        <input type="text" class="input" name="term" size="60" value="<?php echo htmlspecialchars($_POST['term']); ?>">
        <input type="submit" value="Rechercher"></p>
</form><br>

Langues : <?php echo htmlspecialchars($_POST['source']); ?> > <?php echo htmlspecialchars($_POST['cible']); ?>