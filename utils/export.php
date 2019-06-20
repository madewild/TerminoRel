<?php
error_reporting(-1);
ini_set('display_errors', 'On');
include("../static/secret.php");
$server = SERVER;
$username = USERNAME;
$password = PASSWORD;

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

$domains = array("P01", "P02");

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

      $conninfo = array(
        "Database" => "terminorel",
        "UID" => $username,
        "PWD" => $password,
        "CharacterSet" => "UTF-8"
    );
    
    $conn = sqlsrv_connect($server, $conninfo);
    if ($conn) {
      $query = sqlsrv_query($conn, "SELECT * FROM term WHERE reference LIKE '$domain%'", array(), array("Scrollable" => 'static'));
      $num_rows = sqlsrv_num_rows($query);
      if ($num_rows > 0) {
          while ($row = sqlsrv_fetch_array($query)) {
              $termid = $row['id'];
              $ref = $row['reference'];
              $tbx .= '
        <termEntry id ="' . $ref . '">';
              $result = sqlsrv_query($conn, "SELECT * FROM subjectfield where term LIKE '$ref'", array(), array("Scrollable" => 'static'));
              while ($row2 = sqlsrv_fetch_array($result)) {
                $subjectid = $row2['subject'];
                $result2 = sqlsrv_query($conn, "SELECT text FROM subject where id=$subjectid", array(), array("Scrollable" => 'static'));
                $subject = sqlsrv_fetch_array($result2)['text'];
                $tbx .= '
          <descrip type="subjectField">' . $subject . '</descrip>';
              }
              $tbx .= '
          <langSet xml:lang="fr-BE">';

              $result = sqlsrv_query($conn, "SELECT id FROM langroup WHERE termid=$termid AND lang LIKE 'fr%'", array(), array("Scrollable" => 'static'));
              $langroup_source = sqlsrv_fetch_array($result)['id'];
              $result2 = sqlsrv_query($conn, "SELECT * FROM termgroup WHERE langroup=$langroup_source", array(), array("Scrollable" => 'static'));
              while ($termgroup = sqlsrv_fetch_array($result2)) {
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
                $result = sqlsrv_query($conn, "SELECT dcvalue FROM terminfo WHERE id=$posid", array(), array("Scrollable" => 'static'));
                $dcvalue = sqlsrv_fetch_array($result)['dcvalue'];
                $pos = explode("-", $dcvalue)[2];

                $tbx .= '
                <termNote type="partOfSpeech">' . $pos . '</termNote>';

                $gendid = $termgroup['gender'];
                $result = sqlsrv_query($conn, "SELECT dcvalue FROM terminfo WHERE id=$gendid", array(), array("Scrollable" => 'static'));
                $dcvalue = sqlsrv_fetch_array($result)['dcvalue'];
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

              $result = sqlsrv_query($conn, "SELECT id FROM langroup WHERE termid=$termid AND lang LIKE 'en%'", array(), array("Scrollable" => 'static'));
              $langroup_target = sqlsrv_fetch_array($result)['id'];

              $results_recom = sqlsrv_query($conn, "SELECT * FROM termgroup WHERE langroup=$langroup_target AND qualifier!=5", array(), array("Scrollable" => 'static'));
              $results_prop = sqlsrv_query($conn, "SELECT * FROM termgroup WHERE langroup=$langroup_target AND qualifier=5", array(), array("Scrollable" => 'static'));
              $num_recom = sqlsrv_num_rows($results_recom);
              
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
  }

  $tbx .= '
      </body>
    </text>
  </martif>';

  file_put_contents('../tbx/'.$domain.'.tbx', $tbx);
  echo "Glossaire " . $domain ." exporté en TBX avec succès.<br>";

  $zip = new ZipArchive;
  if ($zip->open('../tbx/'.$domain.'.zip') === TRUE) {
      $zip->addFile('../tbx/'.$domain.'.tbx', $domain.'.tbx');
      $zip->close();
      echo 'La compression ZIP a réussi.';
  } else {
      echo 'La compression ZIP a échoué.';
  }
}
?>