<?php
error_reporting(-1);
ini_set('display_errors', 'On');
ini_set('mssql.charset', 'UTF-8');
include("../static/secret.php");
$server = SERVER;
$username = USERNAME;
$password = PASSWORD;

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
            $result = mssql_query("SELECT id FROM langroup WHERE termid=$termid AND lang=0", $conn);
            $langroup_source = mssql_fetch_assoc($result)['id'];
            $result = mssql_query("SELECT * FROM termgroup WHERE langroup=$langroup_source", $conn);
            $termgroup = mssql_fetch_assoc($result);
            $term = $termgroup['termtext'];

            $tbx .= '
        <langSet xml:lang="fr-BE">
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
            <termNote type="grammaticalGender">' . $gender . '</termNote>';
            
            $tbx .= '
          </tig>
        </langSet>';

            $result = mssql_query("SELECT id FROM langroup WHERE termid=$termid AND lang=1", $conn);
            $langroup_target = mssql_fetch_assoc($result)['id'];
            $result = mssql_query("SELECT * FROM termgroup WHERE langroup=$langroup_target", $conn);
            $termgroup = mssql_fetch_assoc($result);
            $translation = $termgroup['termtext'];

            $tbx .= '
        <langSet xml:lang="en-UK">
          <tig>
            <term>' . $translation . '</term>';

            $qualifid = $termgroup['qualifier'];
            if($qualifid == 5) {
              $qualifier = "Terme suggéré";
            } else {
              $qualifier = "Terme approuvé";
            }

            $tbx .= '
            <note>' . $qualifier . '</note>';

            $tbx .= '
          </tig>
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
echo "Glossaire exporté avec succès.";
?>