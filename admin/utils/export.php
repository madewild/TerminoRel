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
    
    $conn = mysqli_connect($server, $conninfo);
    if ($conn) {
      $query = mysqli_query($conn, "SELECT * FROM term WHERE reference LIKE '$domain%'", array(), array("Scrollable" => 'static'));
      $num_rows = mysqli_num_rows($query);
      if ($num_rows > 0) {
          while ($row = mysqli_fetch_array($query)) {
              $termid = $row['id'];
              $ref = $row['reference'];
              $tbx .= '
        <termEntry id ="' . $ref . '">';
              $result = mysqli_query($conn, "SELECT * FROM subjectfield where term LIKE '$ref'", array(), array("Scrollable" => 'static'));
              while ($row2 = mysqli_fetch_array($result)) {
                $subjectid = $row2['subject'];
                $result2 = mysqli_query($conn, "SELECT text FROM subject where id=$subjectid", array(), array("Scrollable" => 'static'));
                $subject = mysqli_fetch_array($result2)['text'];
                $tbx .= '
          <descrip type="subjectField">' . $subject . '</descrip>';
              }
              $tbx .= '
          <langSet xml:lang="fr-BE">';

              $result = mysqli_query($conn, "SELECT id FROM langroup WHERE termid=$termid AND lang LIKE 'fr%'", array(), array("Scrollable" => 'static'));
              $langroup_source = mysqli_fetch_array($result)['id'];
              $result2 = mysqli_query($conn, "SELECT * FROM termgroup WHERE langroup=$langroup_source", array(), array("Scrollable" => 'static'));
              while ($termgroup = mysqli_fetch_array($result2)) {
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
                $result = mysqli_query($conn, "SELECT dcvalue FROM terminfo WHERE id=$posid", array(), array("Scrollable" => 'static'));
                $dcvalue = mysqli_fetch_array($result)['dcvalue'];
                $pos = explode("-", $dcvalue)[2];

                $tbx .= '
                <termNote type="partOfSpeech">' . $pos . '</termNote>';

                $gendid = $termgroup['gender'];
                $result = mysqli_query($conn, "SELECT dcvalue FROM terminfo WHERE id=$gendid", array(), array("Scrollable" => 'static'));
                $dcvalue = mysqli_fetch_array($result)['dcvalue'];
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

              $result = mysqli_query($conn, "SELECT id FROM langroup WHERE termid=$termid AND lang LIKE 'en%'", array(), array("Scrollable" => 'static'));
              $langroup_target = mysqli_fetch_array($result)['id'];

              $results_recom = mysqli_query($conn, "SELECT * FROM termgroup WHERE langroup=$langroup_target AND qualifier!=5", array(), array("Scrollable" => 'static'));
              $results_prop = mysqli_query($conn, "SELECT * FROM termgroup WHERE langroup=$langroup_target AND qualifier=5", array(), array("Scrollable" => 'static'));
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