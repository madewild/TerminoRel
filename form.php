<h2>Glossaires de l'ULB</h2>

<h3>Rechercher</h3>
<form class="form" action="" method="post" onsubmit="return validate()">
    <fieldset>
        <legend>Vos critères de recherche</legend>
        <nav id="form"><ul><li><label for="term">Terme recherché</label><!--<span class="star">*</span>-->
        <input type="text" class="input" id="term" name="term" size="70">
        <input type="submit" value="Rechercher"></li>
        <li><label for="source">Langue source</label><!--<span class="star">*</span>-->
        <select id="source" name="source">
            <option value="fr">français</option>
            <option value="en">anglais</option>
        </select>
        <label for="cible">Langue cible</label><!--<span class="star">*</span>-->
        <select id="cible" name="cible">
            <option value="en">anglais</option>
        </select></li>
        <li><label for="domaine">Domaine</label>
        <select name="domaine">
            <option value="Titres et fonctions">Titres et fonctions</option>
        </select></li>
        <li><label for="status">Uniquement les termes approuvés</label>
        <input type="checkbox" name="status" value="approved_only"></li></ul></nav>
        <!--<br><p><label for="type">Informations additionnelles à afficher</label><br>
        <input type="checkbox" name="type[]" value="Définition"> Définition (en français)
        <input type="checkbox" name="type[]" value="Explication"> Explications supplémentaires (en français)
        <input type="checkbox" name="type[]" value="Exemple"> Exemple(s) d'usage (en langue cible)
        <p><span class="star">*</span> <i>Ce symbole indique que le champ est obligatoire.</i></p>-->
    </fieldset>
</form><br>

<h3>Accéder</h3>
<ul><li>
<form class="form" action="" method="get">
<label for="glossary">Accéder à un glossaire :</label>
<select name="glossary">
    <option value="tf">Titres et fonctions</option>
</select>
<input type="hidden" name="sort" value="fr">
<input type="submit" value="OK">
</li></ul>

<h3>Télécharger</h3>
<ul>
    <li>Télécharger le glossaire au format <a href='tbx/btulb.tbx' download>TBX</a> (format destiné aux outils d'aide à la traduction)</li>
</ul>

<?php 
include('footer.php'); 
include('export.php');
?>