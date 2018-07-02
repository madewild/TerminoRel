<h2>Glossaires de l'ULB</h2>

<h3>Rechercher</h3>
<form class="form" action="#" method="post" onsubmit="return validate()">
    <fieldset>
        <legend>Vos critères de recherche</legend>
        <p><label for="term">Terme recherché</label><span class="star">*</span>
        <input type="text" class="input" id="term" name="term" size="80" value="assistant">
        <input type="submit" value="Rechercher"></p>
        <p><label for="source">Langue source</label><span class="star">*</span>
        <select name="source">
            <option value="fr - français">fr - français</option>
            <option value="en - English">en - English</option>
        </select></p>
        <p><label for="cible">Langues cibles</label><span class="star">*</span>
        <input type="checkbox" name="cible" value="English" checked="checked"> en
        <input type="checkbox" name="cible" value="français"> fr
        <input type="checkbox" name="cible" value="other"> ...
        <input type="checkbox" name="cible" value="toutes"> Toutes</p>
        <p><label for="domaine">Domaine</label>
        <select name="domaine">
            <option value="Titres et fonctions">Titres et fonctions</option>
        </select></p>
        <p><label for="type">Type d'information</label><br>
        <input type="checkbox" name="type[]" value="Traduction" checked="checked"> Traduction
        <input type="checkbox" name="type[]" value="Synonyme" checked="checked"> Synonymes et acronymes
        <input type="checkbox" name="type[]" value="Définition"> Définition (en français)
        <input type="checkbox" name="type[]" value="Exemple" checked="checked"> Exemple d'usage
        <input type="checkbox" name="type[]" value="Toutes"> Toutes les informations</p><br>
        <p><span class="star">*</span> <i>Ce symbole indique que le champ est obligatoire.</i></p>
    </fieldset>
</form><br>

<h3>Accéder</h3>
<ul>
    <li>Accéder au glossaire <a href="http://terminorel.ulb.be/?glossary=tf">Titres et fonctions</a></li>
</ul>

<h3>Télécharger</h3>
<ul>
    <li>Télécharger le glossaire au format <a href='tbx/btulb.tbx' download>TBX</a> (format destiné aux outils d'aide à la traduction)</li>
</ul>

<?php 
include('footer.php'); 
include('export.php');
?>