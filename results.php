<h2>Glossaires de l'ULB</h2>

<a href="index.php">Revenir à l'écran de recherche initial</a>

<form class="form" action="index.php" method="post">
        <input type="text" class="input" name="term" size="60" value="<?php echo htmlspecialchars($_POST['term']); ?>">
        <input type="submit" value="Rechercher"></p>
</form><br>

Langues : 
<?php 
$source = htmlspecialchars($_POST['source']);
$code_full = explode(" - ", $source);
echo $code_full[1];
?>