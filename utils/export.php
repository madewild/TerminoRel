<?php
error_reporting(-1);
ini_set('display_errors', 'On');
ini_set('mssql.charset', 'UTF-8');
include("../static/secret.php");
$server = SERVER;
$username = USERNAME;
$password = PASSWORD;

function print_trad($results, $type) {
  $tig = '';
  while ($row = mssql_fetch_assoc($results)) {
    $translation = $row['termtext'];
    $tig .= '
          <tig>
            <term>' . $translation . '</term>
            <note>Terme ' . $type . '</note>
          </tig>';
  return $tig;

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

$conn = mssql_connect($server, $username, $password);
if ($conn) {
    mssql_select_db("terminorel", $conn);
    $query = mssql_query("SELECT * FROM term", $conn);
    $num_rows = mssql_num_rows($query);
    if ($num_rows > 0) {
        while ($row = mssql_fetch_assoc($query)) {
            $termid = $row['id'];
            $ref = $row['reference'];
            $tbx .= '
      <termEntry id ="' . $ref . '">';
            $result = mssql_query("SELECT * FROM subjectfield where term LIKE '$ref'", $conn);
            while ($row2 = mssql_fetch_assoc($result)) {
              $subjectid = $row2['subject'];
              $result2 = mssql_query("SELECT text FROM subject where id=$subjectid", $conn);
              $subject = mssql_fetch_assoc($result2)['text'];
              $tbx .= '
        <descrip type="subjectField">' . $subject . '</descrip>';
            }
            $tbx .= '
        <langSet xml:lang="fr-BE">';

            $result = mssql_query("SELECT id FROM langroup WHERE termid=$termid AND lang=0", $conn);
            $langroup_source = mssql_fetch_assoc($result)['id'];
            $result2 = mssql_query("SELECT * FROM termgroup WHERE langroup=$langroup_source", $conn);
            $num_rows_bis = mssql_num_rows($result2);
            echo($num_rows_bis);
            while ($termgroup = mssql_fetch_assoc($result2)) {
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
              $result = mssql_query("SELECT dcvalue FROM terminfo WHERE id=$posid", $conn);
              $dcvalue = mssql_fetch_assoc($result)['dcvalue'];
              $pos = explode("-", $dcvalue)[2];

              $tbx .= '
              <termNote type="partOfSpeech">' . $pos . '</termNote>';

              $gendid = $termgroup['gender'];
              $result = mssql_query("SELECT dcvalue FROM terminfo WHERE id=$gendid", $conn);
              $dcvalue = mssql_fetch_assoc($result)['dcvalue'];
              if($dcvalue == "DC-246-masculine_or_DC-247-feminine") {
                $gender = "other";
              } else {
                $gender = explode("-", $dcvalue)[2];
              }

              $tbx .= '
              <termNote type="grammaticalGender">' . $gender . '</termNote>
            </tig>';
            }
            
            $tbx .= '
        </langSet>
        <langSet xml:lang="en-GB">';

            $result = mssql_query("SELECT id FROM langroup WHERE termid=$termid AND lang=1", $conn);
            $langroup_target = mssql_fetch_assoc($result)['id'];

            $results_recom = mssql_query("SELECT * FROM termgroup WHERE langroup=$langroup_target AND qualifier!=5", $conn);
            $results_prop = mssql_query("SELECT * FROM termgroup WHERE langroup=$langroup_target AND qualifier=5", $conn);
            $num_recom = mssql_num_rows($results_recom);
            
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

file_put_contents('../tbx/titres_fonctions.tbx', $tbx);
echo "Glossaire exporté en TBX avec succès.<br>";

$zip = new ZipArchive;
if ($zip->open('../tbx/titres_fonctions.zip') === TRUE) {
    $zip->addFile('../tbx/titres_fonctions.tbx', 'titres_fonctions.tbx');
    $zip->close();
    echo 'La compression ZIP a réussi.';
} else {
    echo 'La compression ZIP a échoué.';
}

?>