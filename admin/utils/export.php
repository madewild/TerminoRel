<?php

if (basename(__FILE__) == basename($_SERVER['SCRIPT_FILENAME'])) {
    # direct usage of export, not included by insert_term
    include("../../static/header.php");
 }

$domains = array("P", "P01", "P02");

foreach($domains as $domain) {
  $tbx = '<?xml version="1.0" encoding="UTF-8"?>
  <!DOCTYPE martif SYSTEM "TBXBasiccoreStructV02.dtd">
  <martif type="TBX-Basic" xml:lang="en">
    <martifHeader>
      <fileDesc>
        <titleStmt>
          <title>Terminorel – Glossaires de l’Université Libre de Bruxelles (Belgique)</title>
          <note>Ce document est un glossaire destiné à aider les traducteurs et rédacteurs de textes de l’Université Libre de
          Bruxelles pour le traitement vers l’anglais de textes rédigés en langue française (français de Belgique).</note>
        </titleStmt>
        <sourceDesc>
          <p>Le contenu du document a été élaboré avec l’aide du centre de recherche Tradital (http://tradital.ulb.be/) de la
          Faculté de Lettres, Traduction et Communication (http://www.ulb.ac.be/facs/ltc/index.html) de l’Université Libre de
          Bruxelles (Belgique). Il est placé sous le régime de la licence Creative Commons 4.0, BY-NC-SA.</p>
        </sourceDesc>
      </fileDesc>
    </martifHeader>
    <text>
      <body>';
    
    $conn = mysqli_connect($server, $username, $password) or die("Unable to connect to '$server'");
    $conn -> set_charset("utf8");
    mysqli_select_db($conn, $database) or die("Could not open the database '$database'");

    if ($conn) {
      $query = "SELECT * FROM term WHERE reference LIKE '$domain%'";
      $result = mysqli_query($conn, $query);
      $num_rows = mysqli_num_rows($result);
      if ($num_rows > 0) {
          while ($row = mysqli_fetch_assoc($result)) {
              $termid = $row['id'];
              $ref = $row['reference'];
              $tbx .= '
        <termEntry id ="' . $ref . '">';
              
              $query2 = "SELECT * FROM subjectfield where term LIKE '$ref'";
              $result2 = mysqli_query($conn, $query2);
              while ($row2 = mysqli_fetch_assoc($result2)) {
                $subjectid = $row2['subject'];
                $query3 = "SELECT text FROM subject where id=$subjectid";
                $result3 = mysqli_query($conn, $query3);
                $subject = mysqli_fetch_assoc($result3)['text'];
                $tbx .= '
          <descrip type="subjectField">' . $subject . '</descrip>';
              }
              $tbx .= '
          <langSet xml:lang="fr-BE">';

              $query4 = "SELECT id FROM langroup WHERE termid=$termid AND lang LIKE 'fr%'";
              $result4 = mysqli_query($conn, $query4);
              $langroup_source = mysqli_fetch_assoc($result4)['id'];
              $query5 = "SELECT * FROM termgroup WHERE langroup=$langroup_source";
              $result5 = mysqli_query($conn, $query5);
              while ($termgroup = mysqli_fetch_assoc($result5)) {
                $term = $termgroup['termtext'];
                $tbx .= '
              <tig>
                <term>' . $term . '</term>';

                $variant = $termgroup['variant'];
                if($variant != NULL) {
                  $tbx .= '
                <note>Forme féminine : ' . $variant . '</note>';
                } else {
                  $tbx .= '
                <note>Terme épicène</note>';
                }

                $posid = $termgroup['pos'];
                $query6 = "SELECT dcvalue FROM terminfo WHERE id=$posid";
                $result6 = mysqli_query($conn, $query6);
                $dcvalue = mysqli_fetch_assoc($result6)['dcvalue'];
                $pos = explode("-", $dcvalue)[2];

                $tbx .= '
                <termNote type="partOfSpeech">' . $pos . '</termNote>';

                $gendid = $termgroup['gender'];
                $query7 = "SELECT dcvalue FROM terminfo WHERE id=$gendid";
                $result7 = mysqli_query($conn, $query7);
                $dcvalue = mysqli_fetch_assoc($result7)['dcvalue'];
                if($dcvalue) {
                  if($dcvalue == "DC-246-masculine_or_DC-247-feminine") {
                    $gender = "other";
                  } else {
                    $gender = explode("-", $dcvalue)[2];
                  }
                } else {
                  $gender = "";
                }

                $tbx .= '
                <termNote type="grammaticalGender">' . $gender . '</termNote>
              </tig>';
              }
              
              $tbx .= '
          </langSet>
          <langSet xml:lang="en-GB">';

              $query8 = "SELECT id FROM langroup WHERE termid=$termid AND lang LIKE 'en%'";
              $result8 = mysqli_query($conn, $query8);
              $langroup_target = mysqli_fetch_assoc($result8)['id'];

              $query_recom = "SELECT * FROM termgroup WHERE langroup=$langroup_target AND qualifier!=5";
              $results_recom = mysqli_query($conn, $query_recom);
              $query_prop = "SELECT * FROM termgroup WHERE langroup=$langroup_target AND qualifier=5";
              $results_prop = mysqli_query($conn, $query_prop);
              $num_recom = mysqli_num_rows($results_recom);
              
              $tig = print_trad($results_recom, "approuvé");
              if($num_recom == 0) {
                $tig = print_trad($results_prop, "suggéré");
              }

              $tbx .= $tig;

              $tbx .= '
          </langSet>
        </termEntry>';
          }
      }
  } else {
    echo "Connection could not be established.<br />";
    die( print_r( mysqli_errors(), true));
  }

  $tbx .= '
      </body>
    </text>
  </martif>';

  file_put_contents('../../tbx/'.$domain.'.tbx', $tbx);
  echo "Glossaire " . $domain ." exporté en TBX avec succès." . str_pad('',4096,' ') . "<br>";

  $zip = new ZipArchive;
  //echo "Current directory is " . getcwd();
  if ($zip->open('../../tbx/'.$domain.'.zip') === TRUE) {
      $zip->addFile('../../tbx/'.$domain.'.tbx', $domain.'.tbx');
      $zip->close();
      echo 'La compression ZIP a réussi.' . str_pad("",4096," ") . '<br>';
  } else {
      echo 'La compression ZIP a échoué.' . str_pad("",4096," ") . '<br>';
  }
}
?>