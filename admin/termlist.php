<?php 
error_reporting(-1);
ini_set('display_errors', 'On');
include("../static/secret.php");
$server = SERVER;
$username = USERNAME;
$password = PASSWORD;

$conninfo = array(
    "Database" => "terminorel",
    "UID" => $username,
    "PWD" => $password,
    "CharacterSet" => "UTF-8"
);

include("../static/header.php");
?>
<h3>Espace d'administration</h3>
<form class="form" action="" method="get">
    <fieldset>
        <legend>Vos critères de recherche</legend>
        <nav id="form">
            <ul>
                <li>
                    <label for="domain">Domaine</label>
                    <select name="domain">
                        <option value="P01">Titres et fonctions</option>
                        <option value="P02">Enseignement supérieur</option>
                    </select>
                </li>
                <li>
                    <label for="fiche">Fiche</label>
                    <select name="fiche">
                        <option value="">Choisissez un domaine</option>
                    </select>
                </li>
                <li><input type="submit" value="Afficher"></li>
            </ul>
        </nav>
    </fieldset>
</form><br>