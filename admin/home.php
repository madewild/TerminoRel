<?php include("../static/header.php"); ?>
<h3>Espace d'administration</h3>
<form class="form" action="" method="get">
    <fieldset>
        <legend>
        Sélectionnez une fiche à modifier
        <a href="#" onclick="return confirm('Prochainement disponible...');"><img title='Créer une nouvelle fiche' src='icons/create.png' style='width:24px;height:24px'></a>
        </legend>
        <nav id="form">
            <ul>
                <li>
                    <label for="domain">Domaine</label>
                    <select id="domain" name="domain">
                        <option value="P01">Titres et fonctions</option>
                        <option value="P02">Enseignement supérieur</option>
                    </select>
                </li>
                <li>
                    <label for="fiche">Fiche</label>
                    <select id="fiche" name="fiche">
                        <?php
                        $conn = sqlsrv_connect($server, $conninfo);
                        if ($conn) {
                            $query = sqlsrv_query($conn, "SELECT * FROM termgroup WHERE termlexid LIKE 'P01%01-fr' ORDER BY termtext", array(), array("Scrollable" => 'static'));
                            while ($row = sqlsrv_fetch_array($query)) {
                                echo '<option value="'.$row["termlexid"].'">'.$row["termtext"].'</option>';
                            }
                        }
                        ?>
                    </select>
                </li>
                <li><input type="submit" value="Afficher"></li>
            </ul>
        </nav>
        <legend><a href="?import=xml">Importez un nouveau fichier XML</a></legend>
    </fieldset>
</form><br>
