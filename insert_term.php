<?php
error_reporting(-1);
ini_set('display_errors', 'On');
ini_set('mssql.charset', 'UTF-8');
include("secret.php");
$server = SERVER;
$username = USERNAME;
$password = PASSWORD;
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
                $subjectid = $row['id'];
            }
        }
        else {
            $subjectid = mssql_query("INSERT INTO subject (cdu, level, text) OUTPUT Inserted.id VALUES (N'$cdu', $level, N'$subject')", $conn);
        }
        echo $subjectid . '<br>';
        //$query = mssql_query("INSERT INTO biblio (reference, title, typedoc, datedoc, source, service, url, filename) VALUES (N'$ref', N'$title', N'$type', '$date', N'$source', N'$service', N'$url', N'$filename')", $conn);
        echo 'Done!';
    }
}
?>