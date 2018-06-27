<?php
error_reporting(-1);
ini_set('display_errors', 'On');
ini_set('mssql.charset', 'UTF-8');
include("secret.php");
$server = SERVER;
$username = USERNAME;
$password = PASSWORD;

$tbx = '<?xml version="1.0" encoding="UTF-8"?>
<!DOCTYPE martif PUBLIC "ISO 12200:1999A//DTD MARTIF core (DXFcdV04)//EN" "TBXcdv04.dtd">
<martif type="TBX" xml:lang="en">
  <martifHeader>
    <fileDesc>
      <sourceDesc>
        <p>TerminoRel</p>
      </sourceDesc>
    </fileDesc>
  </martifHeader>
  <text>
    <body>';


$conn = mssql_connect($server, $username, $password);
if ($conn) {
    mssql_select_db("terminorel", $conn);
    $query = mssql_query("SELECT * FROM termgroup WHERE termlexid LIKE '%fr'", $conn);
    $num_rows = mssql_num_rows($query);
    if ($num_rows > 0) {
        while ($row = mssql_fetch_assoc($query)) {
            $term = $row['termtext'];
            $lang = explode("-", $row['termlexid'])[3];
            $langroup_source = $row['langroup'];
            $result = mssql_query("SELECT termid FROM langroup WHERE id=$langroup_source", $conn);
            $termid = mssql_fetch_assoc($result)['termid'];
            $result = mssql_query("SELECT id FROM langroup WHERE termid=$termid AND lang=1", $conn);
            $langroup_target = mssql_fetch_assoc($result)['id'];
            $result = mssql_query("SELECT termtext FROM termgroup WHERE langroup=$langroup_target", $conn);
            $translation = mssql_fetch_assoc($result)['termtext'];
            $tbx .= '
      <termEntry>
        <langSet xml:lang="fr">
          <tig>
            <term>'.$term.'</term>
          </tig>
        </langSet>
        <langSet xml:lang="en">
          <tig>
            <term>'.$translation.'</term>
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

file_put_contents('tbx/btulb.tbx', $tbx);
echo "Glossaire exporté en TBX avec succès : <a href='tbx/btulb.tbx'>btulb.tbx</a>";