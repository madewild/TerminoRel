<?php

function clean($string) {
    $string = str_replace("'", "''", $string);
    $string = str_replace("\n", " ", $string);
    $string = preg_replace('/\s\s+/', ' ', $string);
    return $string;
}

function sqlsrv_insert_id($conn) {
    $id = 0; 
    $res = sqlsrv_query($conn, "SELECT @@identity AS id", array(), array("Scrollable" => 'static')); 
    if ($row = sqlsrv_fetch_array($res)) { 
        $id = $row["id"]; 
    }
    return $id; 
}

function print_trad($results, $type) {
    $tig = '';
    while ($row = sqlsrv_fetch_array($results)) {
      $translation = $row['termtext'];
      $tig .= '
            <tig>
              <term>' . $translation . '</term>
              <note>Terme ' . $type . '</note>
            </tig>';
    }
    return $tig;
  }

function show_trad($conn, $results, $lang_trad, $type) {
    $counter = sqlsrv_num_rows($results);
    while ($row = sqlsrv_fetch_array($results)) {
        $color = "";
        if($type == "à éviter") { // quick fix, to improve later
            echo "<br>";
            $color = "tomato";
        }
        $translation = $row['termtext'];
        $variant = $row['variant'];
        echo "<details><summary><span title='Cliquez sur le terme pour voir un exemple.' style='color: " . $color . "'><b>" . $translation;
        if($variant != NULL and $lang_trad == 'fr') {
            echo " | " . $variant;
        }
        echo "</b> (terme " . $type . ")";
        echo "</span></summary>";
        $termgroup = $row['id'];
        $result = sqlsrv_query($conn, "SELECT id, context FROM contextgroup WHERE termgroup=$termgroup", array(), array("Scrollable" => 'static'));
        $row = sqlsrv_fetch_array($result);
        $contextgroup = $row['id'];
        $context = $row['context'];
        if(!empty($context)) {
            $result = sqlsrv_query($conn, "SELECT * FROM source WHERE contextgroup=$contextgroup", array(), array("Scrollable" => 'static'));
            $row = sqlsrv_fetch_array($result);
            $bib_id = $row['biblio'];
            $source_text_con = $row['text'];
            $result = sqlsrv_query($conn, "SELECT title FROM biblio WHERE id=$bib_id", array(), array("Scrollable" => 'static'));
            $bib_title_con = sqlsrv_fetch_array($result)['title'];
            echo "<br><u>Exemple d'usage</u> : « " . $context . " » (<i>" . $bib_title_con . "</i>, " . $source_text_con . ")";
        } else {
            echo "<br>Pas d'exemple d'usage pour ce terme.";
        }
        echo "</details>";
        if(--$counter > 0) {
            echo "<br>";
        }
    }
}

function show_trad_admin($conn, $results, $type) {
    while ($row = sqlsrv_fetch_array($results)) {
        $translation = $row['termtext'];
        echo "<table><tr><td><b>Traduction " . $type . "</b></td><td>" . $translation . "</td></tr>";
        $termgroup = $row['id'];
        $result = sqlsrv_query($conn, "SELECT id, context FROM contextgroup WHERE termgroup=$termgroup", array(), array("Scrollable" => 'static'));
        $row = sqlsrv_fetch_array($result);
        $contextgroup = $row['id'];
        $context = $row['context'];
        if(!empty($context)) {
            $result = sqlsrv_query($conn, "SELECT * FROM source WHERE contextgroup=$contextgroup", array(), array("Scrollable" => 'static'));
            $row = sqlsrv_fetch_array($result);
            $bib_id = $row['biblio'];
            $source_text_con = $row['text'];
            $result = sqlsrv_query($conn, "SELECT title FROM biblio WHERE id=$bib_id", array(), array("Scrollable" => 'static'));
            $bib_title_con = sqlsrv_fetch_array($result)['title'];
            echo "<tr><td><b>Exemple d'usage</b></td><td>" . $context . "</td></tr>";
            echo "<tr><td><b>Source de l'example</b></td><td>" . $bib_title_con . ", " . $source_text_con . "</td></tr>";
        echo "</table>";
        } 
    }
}

?>