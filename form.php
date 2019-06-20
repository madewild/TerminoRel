<?php include("static/header.php"); ?>

<h3>Rechercher un terme dans les glossaires</h3>
<form class="form" action="" method="post" onsubmit="return validate()">
    <fieldset>
        <legend>Vos critères de recherche</legend>
        <nav id="form"><ul><li><label for="term">
        <span title="Expression, mot ou partie de mot : 'rec' renverra recteur, directeur, recherche, etc.">
        Terme recherché &#9432;</span></label>
        <input type="text" class="input" id="term" name="term" size="70">
        <input type="submit" value="Rechercher"></li>
        <li><label for="source">Langue source</label>
        <select id="source" name="source">
            <option value="fr">français</option>
            <option value="en">anglais</option>
        </select>
        <label for="cible">Langue cible</label>
        <select id="cible" name="cible">
            <option value="en">anglais</option>
        </select></li>
        <li><label for="domaine">Domaine</label>
        <select name="domaine">
            <option value="P01-Titres et fonctions" >Titres et fonctions</option>
            <option value="P02-Enseignement supérieur">Enseignement supérieur</option>
        </select></li>
        <li><label for="status"><span title="Traductions validées officiellement par le comité terminologique de l'ULB.">
        Uniquement les traductions approuvées &#9432;</span></label>
        <input type="checkbox" name="status" value="approved_only"></li></ul></nav>
    </fieldset>
</form><br>

<h3>Afficher toutes les entrées d'un glossaire</h3>
<ul>
    <li>
        <form class="form" action="" method="get">
            <label for="glossary">Choisir un glossaire&nbsp;:</label>
            <select name="glossary">
                <option value="tf">Titres et fonctions</option>
                <option value="es">Enseignement supérieur</option>
            </select>
            <input type="hidden" name="sort" value="fr">
            <input type="submit" value="OK">
        </form>
    </li>
</ul>

<h3>Télécharger un glossaire</h3>
<ul>
    <li>
        <!--<form class="form" action="tbx/titres_fonctions.tbx" method="post">
            <label for="tbx">Télécharger un glossaire&nbsp;:</label>
            <select name="tbx">
                <option value="tf">Titres et fonctions</option>
            </select>
            <input type="submit" value="OK">
        </form>-->
        Télécharger un glossaire au format TBX (format destiné aux outils d'aide à la traduction) :
        <ul class="static">
            <li><a href='tbx/titres_fonctions.zip' download>Titres et fonctions</a></li>
            <li><a href='tbx/enseignement_superieur.zip' download>Enseignement supérieur</a></li>
        </ul>
    </li>
</ul>