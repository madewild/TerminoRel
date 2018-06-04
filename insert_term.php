<?php
error_reporting(-1);
ini_set('display_errors', 'On');
ini_set('mssql.charset', 'UTF-8');
include("secret.php");
$server = SERVER;
$username = USERNAME;
$password = PASSWORD;

function mssql_insert_id() { 
    $id = 0; 
    $res = mssql_query("SELECT @@identity AS id"); 
    if ($row = mssql_fetch_assoc($res)) { 
        $id = $row["id"]; 
    }
    return $id; 
} 

$conn = mssql_connect($server, $username, $password);
if ($conn) {
    mssql_select_db("terminorel", $conn);
    $xml = simplexml_load_file("xml/sample.xml");
    foreach($xml->{'DC-209-terminologicalEntry'} as $doc)
    {
        $ref = $doc['DC-206-entryIdentifier'];
        $subject = $doc->{'DC-489-subjectField'};
        $cdu = $subject['cdu'];
        $level = $subject['niveau'];
        $subject = str_replace("'", "''", $subject);
        echo 'Importing ' . $ref . '...<br>';
        $query = mssql_query("SELECT id from subject where cdu=$cdu and level=$level and text=N'$subject'", $conn);
        if (mssql_num_rows($query) > 0) {
            while ($row = mssql_fetch_assoc($query)) {
                $subject_id = $row['id'];
            }
        }
        else {
            $query = mssql_query("INSERT INTO subject (cdu, level, text) OUTPUT Inserted.id VALUES (N'$cdu', $level, N'$subject')", $conn);
            $subject_id = mssql_insert_id();
        }
        $owner = $doc->{'DC-494-subsetOwner'};
        $owner_name = $owner['name'];
        $query = mssql_query("SELECT id from subsetowner where name=N'$name'", $conn);
        if (mssql_num_rows($query) > 0) {
            while ($row = mssql_fetch_assoc($query)) {
                $owner_id = $row['id'];
            }
        }
        else {
            $query = mssql_query("INSERT INTO subject (cdu, level, text) OUTPUT Inserted.id VALUES (N'$cdu', $level, N'$subject')", $conn);
            $owner_id = mssql_insert_id();
        }
        echo $owner_id . ' ' . $owner_name . '<br>';
        echo 'Done!';
    }
}
?>