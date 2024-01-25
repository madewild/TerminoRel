<?php 
include("static/header.php");

$glossary = htmlspecialchars($_GET['glossary']);
$sort = htmlspecialchars($_GET['sort']);

if ($glossary == 'all') {
    $refcode = "P";
    $gloname = "Tous";
} else if($glossary == 'tf') {
    $refcode = "P01";
    $gloname = "Titres et fonctions";
} else if($glossary == 'es') {
    $refcode = "P02";
    $gloname = "Enseignement supérieur";
} else {
    die("Glossaire inconnu.");
}

include('static/retour.php');

if($sort == "fr") {
        $cible = "en";
        $other_lang = "l'anglais";
    } else {
        $cible = "fr";
        $other_lang = "le français";
    }

$conn = mysqli_connect($server, $username, $password) or die("Unable to connect to '$server'");
$conn -> set_charset("utf8");
mysqli_select_db($conn, $database) or die("Could not open the database '$database'");

if ($conn) {
    $query = "SELECT * FROM termgroup WHERE termlexid LIKE '$refcode%$sort' ORDER BY termtext";
    $result = mysqli_query($conn, $query);
    $num_rows = mysqli_num_rows($result);

    // How many items to list per page
    if(isset($_GET['limit'])) {
        $limit = htmlspecialchars($_GET['limit']);
    } else {
        $limit = 10;
    }

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
    $prevlink = ($page > 1) ? '<a href="?glossary='.$glossary.'&sort='.$sort.'&page=1&limit='.$limit.'" title="Première page">&laquo;</a> <a href="?glossary='.$glossary.'&sort='.$sort.'&page='.($page - 1).'&limit='.$limit.'" title="Page précedente">&lsaquo;</a>' : '<span class="disabled">&laquo;</span> <span class="disabled">&lsaquo;</span>';

    // The "forward" link
    $nextlink = ($page < $pages) ? '<a href="?glossary='.$glossary.'&sort='.$sort.'&page='.($page + 1).'&limit='.$limit.'" title="Page suivante">&rsaquo;</a> <a href="?glossary='.$glossary.'&sort='.$sort.'&page='.$pages.'&limit='.$limit.'" title="Dernière page">&raquo;</a>' : '<span class="disabled">&rsaquo;</span> <span class="disabled">&raquo;</span>';


    echo "<b>Domaine : " . $gloname . "</b> | ";
    echo "<a href='?glossary=" . $glossary . "&sort=" . $cible . "'>Trier en se basant sur " . $other_lang . "</a><br><br>";
    echo "<b>" . $num_rows . " entrées</b> trouvées<br><br>";
    
    if ($num_rows > 0) {
        // Display the paging information
        echo '<div id="paging"><p>', $prevlink, ' Page ', $page, ' sur ', $pages, ' (entrées ', $start, '-', $end, ') ', $nextlink, ' </p></div>';

        echo "<table class='results_table'>";
        $query = "SELECT * FROM termgroup WHERE termlexid LIKE '$refcode%$sort' ORDER BY termtext LIMIT $limit OFFSET $offset";
    	$result = mysqli_query($conn, $query);
        while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
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
                $result = mysqli_query($conn, "SELECT * FROM termgroup WHERE langroup=$langroup_source");
                $row2 = mysqli_fetch_array($result, MYSQLI_ASSOC);
                $termtextfull = $row2['termtext'];
                $termtextfull_variant = $row2['variant'];
                echo " (" . $termtextfull;
                if($termtextfull_variant) {
                    echo " | " . $termtextfull_variant;
                }
                echo ")";
                $mf = True;
            } else {
                $result = mysqli_query($conn, "SELECT * FROM termgroup WHERE langroup=$langroup_source AND abbrev=1");
                $row2 = mysqli_fetch_array($result, MYSQLI_ASSOC);
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

            $result = mysqli_query($conn, "SELECT termid FROM langroup WHERE id=$langroup_source");
            $termid = mysqli_fetch_array($result, MYSQLI_ASSOC)['termid'];

            $result = mysqli_query($conn, "SELECT definition FROM langroup WHERE termid=$termid AND lang LIKE 'fr%'");
            $definition = mysqli_fetch_array($result, MYSQLI_ASSOC)['definition'];
            if(!empty($definition)) {
                $result = mysqli_query($conn, "SELECT * FROM source WHERE termid=$termid AND type='def'");
                $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
                $bib_id = $row['biblio'];
                $source_text_def = $row['text'];
                $result = mysqli_query($conn, "SELECT title FROM biblio WHERE id=$bib_id");
                $bib_title_def = mysqli_fetch_array($result, MYSQLI_ASSOC)['title'];
                echo "<br><u>Définition</u> : " . $definition . " (<i>" . $bib_title_def . "</i>, " . $source_text_def . ")";
            }

            $result = mysqli_query($conn, "SELECT explanation FROM langroup WHERE termid=$termid AND lang LIKE '$sort%'");
            $explanation = mysqli_fetch_array($result, MYSQLI_ASSOC)['explanation'];
            if(!empty($explanation)) {
                $result = mysqli_query($conn, "SELECT * FROM source WHERE termid=$termid AND type='exp'");
                $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
                $bib_id = $row['biblio'];
                $source_text_exp = $row['text'];
                $result = mysqli_query($conn, "SELECT title FROM biblio WHERE id=$bib_id");
                $bib_title_exp = mysqli_fetch_array($result, MYSQLI_ASSOC)['title'];
                echo "<br><br><u>Explication</u> : " . $explanation . " (<i>" . $bib_title_exp . "</i>, " . $source_text_exp . ")";
            }

            echo "</details></td></tr>";

            $result = mysqli_query($conn, "SELECT id FROM langroup WHERE termid=$termid AND lang LIKE '$cible%'");
            $langroup_target = mysqli_fetch_array($result, MYSQLI_ASSOC)['id'];
            $results_pref = mysqli_query($conn, "SELECT * FROM termgroup WHERE langroup=$langroup_target AND auth=7");
            if($results_pref === FALSE) {
                print_r(mysqli_errors(), true);
                print_r($langroup_target);
            }
            $results_admi = mysqli_query($conn, "SELECT * FROM termgroup WHERE langroup=$langroup_target AND auth IN (0,9)");
            $results_depr = mysqli_query($conn, "SELECT * FROM termgroup WHERE langroup=$langroup_target AND auth=10");

            $num_pref = mysqli_num_rows($results_pref);
            echo "<tr><td>" . strtoupper($cible) . "</td><td>";
            show_trad($conn, $results_pref, $cible, "privilégié");
            if($num_pref == 0) {
                show_trad($conn, $results_admi, $cible, "admis");
                show_trad($conn, $results_depr, $cible, "à éviter");
            }
            echo "</td></tr>";

            if(--$num_rows > 0) {
                echo "<tr><th></th></tr><tr><th></th></tr>";
            }
        }
        echo "</table>";
        // Display the paging information
        echo '<div id="paging"><p>', $prevlink, ' Page ', $page, ' sur ', $pages, ' (entrées ', $start, '-', $end, ') ', $nextlink, ' </p></div>';

    }
    else {
        echo "Aucune entrée trouvée dans ce glossaire.";
    }
}
?>
