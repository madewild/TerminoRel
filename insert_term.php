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
            $query = mssql_query("INSERT INTO subject (cdu, level, text) VALUES (N'$cdu', $level, N'$subject')", $conn);
            $subject_id = mssql_insert_id();
        }
        echo 'Subject: ' . $subject_id . ' ' . $subject . ' (CDU ' . $cdu . ', level ' . $level . ')<br>';

        $owner = $doc->{'DC-494-subsetOwner'};
        $owner_name = $owner['nom'];
        $query = mssql_query("SELECT id from subsetowner where name=N'$owner_name'", $conn);
        if (mssql_num_rows($query) > 0) {
            while ($row = mssql_fetch_assoc($query)) {
                $owner_id = $row['id'];
            }
        }
        else {
            $query = mssql_query("INSERT INTO subsetowner (name) VALUES (N'$owner_name')", $conn);
            $owner_id = mssql_insert_id();
        }
        echo 'Subset Owner: ' . $owner_id . ' ' . $owner_name . '<br>';

        $creator = $doc->{'DC-162-createdBy'};
        $creator_name = str_replace("'", "''", $creator);
        $query = mssql_query("SELECT id from creator where name=N'$creator_name'", $conn);
        if (mssql_num_rows($query) > 0) {
            while ($row = mssql_fetch_assoc($query)) {
                $creator_id = $row['id'];
            }
        }
        else {
            $query = mssql_query("INSERT INTO creator (name) VALUES (N'$creator_name')", $conn);
            $creator_id = mssql_insert_id();
        }
        echo 'Created by: ' . $creator_id . ' ' . $creator_name . '<br>';

        $date = $doc->{'DC-274-inputDate'};
        $query = mssql_query("SELECT id from term where reference=N'$ref'", $conn);
        if (mssql_num_rows($query) > 0) {
            while ($row = mssql_fetch_assoc($query)) {
                echo "Reference already in DB<br>";
                $term_id = $row['id'];
            }
        }
        else {
            $query = mssql_query("INSERT INTO term (reference, subject, subsetowner, createdby, inputdate) VALUES (N'$ref', $subject_id, $owner_id, $creator_id, N'$date')", $conn);
            $term_id = mssql_insert_id();
            echo 'Term inserted with ID ' . $term_id . '<br>';
        }

        foreach($doc->langGrp as $lgrp) 
        {
            $lang = $lgrp->attributes("xml", TRUE)->lang;
            $query = mssql_query("SELECT id from lang where code=N'$lang'", $conn);
            if (mssql_num_rows($query) > 0) {
                while ($row = mssql_fetch_assoc($query)) {
                    $lang_id = $row['id'];
                }
            }
            else {
                $query = mssql_query("INSERT INTO lang (code) VALUES (N'$lang')", $conn);
                $lang_id = mssql_insert_id();
            }
            echo 'Language: ' . $lang_id . ' ' . $lang . '<br>';

            $dgrp = $lgrp->definitionGrp;
            $def = $dgrp->{'DC-168-definition'};
            $def = str_replace("'", "''", $def);
            $def = str_replace("\n", " ", $def);
            $def = str_replace("                     ", " ", $def);

            $egrp = $lgrp->explicGrp;
            $exp = $egrp->{'DC-223-explanation'};
            $exp = str_replace("'", "''", $exp);
            $exp = str_replace("\n", " ", $exp);
            $exp = str_replace("                     ", " ", $exp);

            $query = mssql_query("SELECT id from langroup where termid=N'$term_id' and lang=N'$lang_id'", $conn);
            if (mssql_num_rows($query) > 0) {
                while ($row = mssql_fetch_assoc($query)) {
                    echo "This term has already an entry for " . $lang . "<br>";
                }
            }
            else {
                $query = mssql_query("INSERT INTO langroup (termid, lang, definition, explanation) VALUES ($term_id, $lang_id, N'$def', N'$exp')", $conn);
                $langroup_id = mssql_insert_id();
            }

            foreach($dgrp->{'DC-1968-source'} as $source)
            {
                $bibref = $source['biblio'];
                $query = mssql_query("SELECT id from biblio where reference=N'$bibref'", $conn);
                if (mssql_num_rows($query) > 0) {
                    while ($row = mssql_fetch_assoc($query)) {
                        $bib_id = $row['id'];
                    }
                }
                $query = mssql_query("SELECT id from source where biblio=$bib_id and text=N'$source' and type='def' and termid=$term_id", $conn);
                if (mssql_num_rows($query) > 0) {
                    while ($row = mssql_fetch_assoc($query)) {
                        $source_id = $row['id'];
                    }
                }
                else {
                    $query = mssql_query("INSERT INTO source (biblio, text, type, termid) VALUES ($bib_id, N'$source', 'def',$term_id)", $conn);
                    $source_id = mssql_insert_id();
                }
                
            }
        }

        echo 'Done!<br><br>';
    }
}
?>