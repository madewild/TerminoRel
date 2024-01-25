<?php

function clean($string) {
    $string = str_replace("'", "''", $string);
    $string = str_replace("\n", " ", $string);
    $string = preg_replace('/\s\s+/', ' ', $string);
    return $string;
}

function print_trad($results, $type) {
    $tig = '';
    while ($row = mysqli_fetch_assoc($result)) {
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
    $counter = mysqli_num_rows($results);
    while ($row = mysqli_fetch_assoc($results)) {
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
        $result = mysqli_query($conn, "SELECT id, context FROM contextgroup WHERE termgroup=$termgroup");
        $row = mysqli_fetch_assoc($result);
        if(!is_null($row)) {
            $contextgroup = $row['id'];
            $context = $row['context'];
            $result = mysqli_query($conn, "SELECT * FROM source WHERE contextgroup=$contextgroup");
            $row = mysqli_fetch_assoc($result);
            $bib_id = $row['biblio'];
            $source_text_con = $row['text'];
            $result = mysqli_query($conn, "SELECT title FROM biblio WHERE id=$bib_id");
            $bib_title_con = mysqli_fetch_assoc($result)['title'];
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
    while ($row = mysqli_fetch_assoc($result)) {
        $translation = $row['termtext'];
        echo "<table><tr><td><b>Traduction " . $type . "</b></td><td>" . $translation . "</td></tr>";
        $termgroup = $row['id'];
        $result = mysqli_query($conn, "SELECT id, context FROM contextgroup WHERE termgroup=$termgroup");
        $row = mysqli_fetch_assoc($result);
        $contextgroup = $row['id'];
        $context = $row['context'];
        if(!empty($context)) {
            $result = mysqli_query($conn, "SELECT * FROM source WHERE contextgroup=$contextgroup");
            $row = mysqli_fetch_assoc($result);
            $bib_id = $row['biblio'];
            $source_text_con = $row['text'];
            $result = mysqli_query($conn, "SELECT title FROM biblio WHERE id=$bib_id");
            $bib_title_con = mysqli_fetch_assoc($result)['title'];
            echo "<tr><td><b>Exemple d'usage</b></td><td>" . $context . "</td></tr>";
            echo "<tr><td><b>Source de l'example</b></td><td>" . $bib_title_con . ", " . $source_text_con . "</td></tr>";
        echo "</table>";
        } 
    }
}

?>