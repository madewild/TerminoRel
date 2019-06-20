<?php 
error_reporting(-1);
ini_set('display_errors', 'On');
include("static/secret.php");
$server = SERVER;
$username = USERNAME;
$password = PASSWORD;

$term = htmlspecialchars($_GET['term']);
$clean_term = str_replace("'", "''", $term);
$source = htmlspecialchars($_GET['source']);
$cible = htmlspecialchars($_GET['target']);
$fulldomain = htmlspecialchars($_GET['domain']);
$result_explode = explode('-', $fulldomain);
$refcode = $result_explode[0];
$domaine = $result_explode[1];

if(isset($_GET['status'])) {
    $restriction = htmlspecialchars($_GET['status']);
} else {
    $restriction = "none";
}

include("functions.php");
include("static/header.php");
include('static/retour.php'); 
?>

<form class="form" action="#" method="get" onsubmit="return validate()">
    <input type="text" class="input" id="term" name="term" size="60" value="<?php echo $term ?>">
    <input type="hidden" name="source" value="<?php echo $source; ?>">
    <input type="hidden" name="target" value="<?php echo $cible; ?>">
    <input type="hidden" name="domain" value="<?php echo $fulldomain; ?>">
    <input type="submit" value="Rechercher"><br>
</form>

<div class="smaller_text">
    Langues : <?php echo $source ?> > <?php echo $cible ?>
    | Domaine : <?php echo $domaine ?>
</div><br>

<?php
$conninfo = array(
    "Database" => "terminorel",
    "UID" => $username,
    "PWD" => $password,
    "CharacterSet" => "UTF-8"
);

$conn = sqlsrv_connect($server, $conninfo);
if ($conn) {
    //echo "<b>Domaine : " . $domaine . "</b><br><br>";

    $query = sqlsrv_query($conn, "SELECT * FROM termgroup WHERE termlexid LIKE '$refcode%$source' AND (termtext LIKE '%$clean_term%' OR variant LIKE '%$clean_term%' ) ORDER BY termtext", array(), array("Scrollable" => 'static'));
    
    // Total number of results to display
    $num_rows = sqlsrv_num_rows($query);

    // How many items to list per page
    $limit = 10;

    // How many pages will there be
    $pages = ceil($num_rows / $limit);

    // What page are we currently on?
    $page = min($pages, filter_input(INPUT_GET, 'page', FILTER_VALIDATE_INT, array(
        'options' => array(
            'default'   => 1,
            'min_range' => 1,
        ),
    )));

    // Calculate the offset for the query
    $offset = ($page - 1)  * $limit;

    // Some information to display to the user
    $start = $offset + 1;
    $end = min(($offset + $limit), $num_rows);

    // The "back" link
    $prevlink = ($page > 1) ? '<a href="?term='.$term.'&source='.$source.'&target='.$cible.'&domain='.$fulldomain.'&page=1" title="Première page">&laquo;</a> <a href="?term='.$term.'&source='.$source.'&target='.$cible.'&domain='.$fulldomain.'&page=' . ($page - 1) . '" title="Page précedente">&lsaquo;</a>' : '<span class="disabled">&laquo;</span> <span class="disabled">&lsaquo;</span>';

    // The "forward" link
    $nextlink = ($page < $pages) ? '<a href="?term='.$term.'&source='.$source.'&target='.$cible.'&domain='.$fulldomain.'&page=' . ($page + 1) . '" title="Page suivante">&rsaquo;</a> <a href="?term='.$term.'&source='.$source.'&target='.$cible.'&domain='.$fulldomain.'&page=' . $pages . '" title="Dernière page">&raquo;</a>' : '<span class="disabled">&rsaquo;</span> <span class="disabled">&raquo;</span>';

    if($num_rows == 0) {
        echo "<b>Aucune entrée</b> trouvée pour <b>" . $term . "</b><br><br>";
    } else if($num_rows == 1) {
        echo "<b>1 entrée</b> trouvée pour <b>" . $term . "</b><br><br>";
    } else {
        echo "<b>" . $num_rows . " entrées</b> trouvées pour <b>" . $term . "</b><br><br>";
    }
    if ($num_rows > 0) {
        // Display the paging information
        echo '<div id="paging"><p>', $prevlink, ' Page ', $page, ' sur ', $pages, ' (entrées ', $start, '-', $end, ') ', $nextlink, ' </p></div>';

        echo "<table class='results_table'>";
        $query = sqlsrv_query($conn, "SELECT * FROM termgroup WHERE termlexid LIKE '$refcode%$source' AND (termtext LIKE '%$clean_term%' OR variant LIKE '%$clean_term%' ) ORDER BY termtext OFFSET '$offset' ROWS FETCH NEXT '$limit' ROWS ONLY", array(), array("Scrollable" => 'static'));
        if($query === FALSE) {
            if( ($errors = sqlsrv_errors() ) != null) {  
                foreach( $errors as $error) {  
                    echo "SQLSTATE: ".$error[ 'SQLSTATE']."\n";  
                    echo "code: ".$error[ 'code']."\n";  
                    echo "message: ".$error[ 'message']."\n";  
                }  
            } else {
                echo "no error!"
            }
        }
        while ($row = sqlsrv_fetch_array($query)) {
            echo "<tr>";
            $lang = strtoupper(explode("-", $row['termlexid'])[3]);
            $mf = False;
            echo "<td width='45'>" . $lang . "</td>";
            echo "<td><details><summary>";
            echo "<span title='Cliquez sur le terme pour voir sa définition.'>" . $row['termtext'];
            $variant = $row['variant'];
            if($variant != NULL) {
                echo " | ";
                echo $variant;
                $mf = True;
            }

            $langroup_source = $row['langroup'];
            $abbrev = $row['abbrev'];
            if($abbrev == 1) {
                $result = sqlsrv_query($conn, "SELECT * FROM termgroup WHERE langroup=$langroup_source", array(), array("Scrollable" => 'static'));
                $row2 = sqlsrv_fetch_array($result);
                $termtextfull = $row2['termtext'];
                $termtextfull_variant = $row2['variant'];
                echo " (" . $termtextfull . " | " . $termtextfull_variant . ")";
                $mf = True;
            } else {
                $result = sqlsrv_query($conn, "SELECT * FROM termgroup WHERE langroup=$langroup_source AND abbrev=1", array(), array("Scrollable" => 'static'));
                $row2 = sqlsrv_fetch_array($result);
                if($row2) {
                    $acro = $row2['termtext'];
                    echo " (" . $acro . ")";
                }
            }
            echo "</span></summary>";

            $pos_id = $row['pos'];
            if($pos_id == 1) {
                $pos = "Nom";
            } else {
                $pos = "Adjectif";
            }
            $gender_id = $row['gender'];
            if($gender_id == 4 or $mf) {
                $gender = "masculin ou féminin";
            } else if($gender_id == 2) {
                $gender = "masculin";
            } else if($gender_id == 8) {
                $gender = "féminin";
            } else {
                $gender = "";
            }

            echo "<br>" . $pos . " " . $gender . "<br>";

            $result = sqlsrv_query($conn, "SELECT termid FROM langroup WHERE id=$langroup_source", array(), array("Scrollable" => 'static'));
            $termid = sqlsrv_fetch_array($result)['termid'];

            $result = sqlsrv_query($conn, "SELECT definition FROM langroup WHERE termid=$termid AND lang LIKE 'fr%'", array(), array("Scrollable" => 'static'));
            $definition = sqlsrv_fetch_array($result)['definition'];
            if(!empty($definition)) {
                $result = sqlsrv_query($conn, "SELECT * FROM source WHERE termid=$termid AND type='def'", array(), array("Scrollable" => 'static'));
                $row = sqlsrv_fetch_array($result);
                $bib_id = $row['biblio'];
                $source_text_def = $row['text'];
                $result = sqlsrv_query($conn, "SELECT title FROM biblio WHERE id=$bib_id", array(), array("Scrollable" => 'static'));
                $bib_title_def = sqlsrv_fetch_array($result)['title'];
                echo "<br><u>Définition</u> : " . $definition . " (<i>" . $bib_title_def . "</i>, " . $source_text_def . ")";
            }

            $result = sqlsrv_query($conn, "SELECT explanation FROM langroup WHERE termid=$termid AND lang LIKE '$source%'", array(), array("Scrollable" => 'static'));
            $explanation = sqlsrv_fetch_array($result)['explanation'];
            if(!empty($explanation)) {
                $result = sqlsrv_query($conn, "SELECT * FROM source WHERE termid=$termid AND type='exp'", array(), array("Scrollable" => 'static'));
                $row = sqlsrv_fetch_array($result);
                $bib_id = $row['biblio'];
                $source_text_exp = $row['text'];
                $result = sqlsrv_query($conn, "SELECT title FROM biblio WHERE id=$bib_id", array(), array("Scrollable" => 'static'));
                $bib_title_exp = sqlsrv_fetch_array($result)['title'];
                echo "<br><br><u>Explication</u> : " . $explanation . " (<i>" . $bib_title_exp . "</i>, " . $source_text_exp . ")";
            }

            echo "</details></td></tr>";

            $result = sqlsrv_query($conn, "SELECT id FROM langroup WHERE termid=$termid AND lang LIKE '$cible%'", array(), array("Scrollable" => 'static'));
            $langroup_target = sqlsrv_fetch_array($result)['id'];
            $results_pref = sqlsrv_query($conn, "SELECT * FROM termgroup WHERE langroup=$langroup_target AND auth=7", array(), array("Scrollable" => 'static'));
            if($results_pref === FALSE) {
                print_r(sqlsrv_errors(), true);
                print_r($langroup_target);
            }
            $results_admi = sqlsrv_query($conn, "SELECT * FROM termgroup WHERE langroup=$langroup_target AND auth IN (0,9)", array(), array("Scrollable" => 'static'));
            $results_depr = sqlsrv_query($conn, "SELECT * FROM termgroup WHERE langroup=$langroup_target AND auth=10", array(), array("Scrollable" => 'static'));

            $num_pref = sqlsrv_num_rows($results_pref);
            echo "<tr><td>" . strtoupper($cible) . "</td><td>";
            if($num_pref == 0 and $restriction == "approved_only") {
                echo "Aucune traduction approuvée.";
            } else {
                show_trad($conn, $langroup_target, $results_pref, $cible, "privilégié");
                if($num_pref == 0) {
                    show_trad($conn, $langroup_target, $results_admi, $cible, "admis");
                    show_trad($conn, $langroup_target, $results_depr, $cible, "à éviter");
                }
            }
            echo "</td></tr>";

            if(--$num_rows > 0) {
                echo "<tr><th></th></tr><tr><th></th></tr>";
            }
        }
        echo "</table>";
    }
    else {
        echo "Aucun résultat pour " . $term;
    }
}
?>