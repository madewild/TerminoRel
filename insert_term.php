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

function clean($string) {
    $string = str_replace("'", "''", $string);
    $string = str_replace("\n", " ", $string);
    $string = preg_replace('/\s\s+/', ' ', $string);
    return $string;
}

$conn = mssql_connect($server, $username, $password);
if ($conn) {
    mssql_select_db("terminorel", $conn);
    $xml = simplexml_load_file("xml/btulb.xml");
    foreach($xml->{'DC-209-terminologicalEntry'} as $doc)
    {
        $ref = $doc['DC-206-entryIdentifier'];
        echo 'Importing ' . $ref . '...<br>';

        foreach($doc->{'DC-489-subjectField'} as $subject)
        {
            $cdu = $subject['cdu'];
            $level = $subject['niveau'];
            $subject = str_replace("'", "''", $subject);
            $query = mssql_query("SELECT id from subject where level=$level and text=N'$subject'", $conn);
            if (mssql_num_rows($query) > 0) {
                while ($row = mssql_fetch_assoc($query)) {
                    $subject_id = $row['id'];
                }
            }
            else {
                $query = mssql_query("INSERT INTO subject (cdu, level, text) VALUES (N'$cdu', $level, N'$subject')", $conn);
                $subject_id = mssql_insert_id();
            }
            //echo 'Subject: ' . $subject_id . ' ' . $subject . ' (CDU ' . $cdu . ', level ' . $level . ')<br>';
        }

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
        //echo 'Subset Owner: ' . $owner_id . ' ' . $owner_name . '<br>';

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
        //echo 'Created by: ' . $creator_id . ' ' . $creator_name . '<br>';

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
            //echo 'Term inserted with ID ' . $term_id . '<br>';
        }

        foreach($doc->{'DC-435-relatedConcept'} as $rel)
        {
            $toref = $rel['DC-461-see'];
            $query = mssql_query("SELECT fromref, toref from related where fromref='$ref' and toref='$toref'", $conn);
            if (mssql_num_rows($query) == 0) {
                $query = mssql_query("INSERT INTO related (fromref, toref) VALUES ('$ref', '$toref')", $conn);
            }
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
            //echo 'Language: ' . $lang_id . ' ' . $lang . '<br>';

            $dgrp = $lgrp->definitionGrp;
            $def = $dgrp->{'DC-168-definition'};
            $def = clean($def);

            $egrp = $lgrp->explicGrp;
            $exp = $egrp->{'DC-223-explanation'};
            $exp = clean($exp);

            $query = mssql_query("SELECT id from langroup where termid=N'$term_id' and lang=N'$lang_id'", $conn);
            if (mssql_num_rows($query) > 0) {
                while ($row = mssql_fetch_assoc($query)) {
                    echo "This term has already an entry for " . $lang . "<br>";
                    $langroup_id = $row['id'];
                }
            }
            else {
                $query = mssql_query("INSERT INTO langroup (termid, lang, definition, explanation) VALUES ($term_id, $lang_id, N'$def', N'$exp')", $conn);
                $langroup_id = mssql_insert_id();
            }
            if (!empty($dgrp)) {
                foreach($dgrp->{'DC-1968-source'} as $source)
                {
                    $bibref = $source['biblio'];
                    $source_text = str_replace("'", "''", $source);
                    $query = mssql_query("SELECT id from biblio where reference=N'$bibref'", $conn);
                    if (mssql_num_rows($query) > 0) {
                        while ($row = mssql_fetch_assoc($query)) {
                            $bib_id = $row['id'];
                        }
                    }
                    $query = mssql_query("SELECT id from source where biblio=$bib_id and text=N'$source_text' and type='def' and termid=$term_id", $conn);
                    if (mssql_num_rows($query) > 0) {
                        while ($row = mssql_fetch_assoc($query)) {
                            $source_id = $row['id'];
                        }
                    }
                    else {
                        $query = mssql_query("INSERT INTO source (biblio, text, type, termid, contextgroup) VALUES ($bib_id, N'$source_text', 'def', $term_id, NULL)", $conn);
                        $source_id = mssql_insert_id();
                    }
                }
            }
            if (!empty($egrp)) {
                foreach($egrp->{'DC-1968-source'} as $source)
                {
                    $bibref = $source['biblio'];
                    $source_text = str_replace("'", "''", $source);
                    $query = mssql_query("SELECT id from biblio where reference=N'$bibref'", $conn);
                    if (mssql_num_rows($query) > 0) {
                        while ($row = mssql_fetch_assoc($query)) {
                            $bib_id = $row['id'];
                        }
                    }
                    $query = mssql_query("SELECT id from source where biblio=$bib_id and text=N'$source_text' and type='exp' and termid=$term_id", $conn);
                    if (mssql_num_rows($query) > 0) {
                        while ($row = mssql_fetch_assoc($query)) {
                            $source_id = $row['id'];
                        }
                    }
                    else {
                        $query = mssql_query("INSERT INTO source (biblio, text, type, termid, contextgroup) VALUES ($bib_id, N'$source_text', 'exp', $term_id, NULL)", $conn);
                        $source_id = mssql_insert_id();
                    }
                }
            }

            foreach($lgrp->termGrp as $tgrp)
            {
                $term = $tgrp->{'DC-508-term'};
                $termlexid = $term['DC-301-lexTermIdentifier'];

                $status = $term['DC-280-languagePlanningQualifier'];
                if(!empty($status)) {
                    $query = mssql_query("SELECT id from terminfo where dcvalue=N'$status'", $conn);
                    if (mssql_num_rows($query) > 0) {
                        while ($row = mssql_fetch_assoc($query)) {
                            $status_id = $row['id'];
                        }
                    }
                    else {
                        $query = mssql_query("INSERT INTO terminfo (dcvalue) VALUES (N'$status')", $conn);
                        $status_id = mssql_insert_id();
                    }
                }
                
                $termtext = clean($term);

                $graminfo = $tgrp->{'DC-250-grammaticalInfo'};
                $pos = $graminfo['DC-396-partOfSpeech'];
                $query = mssql_query("SELECT id from terminfo where dcvalue=N'$pos'", $conn);
                if (mssql_num_rows($query) > 0) {
                    while ($row = mssql_fetch_assoc($query)) {
                        $pos_id = $row['id'];
                    }
                }
                else {
                    $query = mssql_query("INSERT INTO terminfo (dcvalue) VALUES (N'$pos')", $conn);
                    $pos_id = mssql_insert_id();
                }

                $gender = $graminfo['DC-245-grammaticalGender'];
                if(!empty($gender)) {
                    $query = mssql_query("SELECT id from terminfo where dcvalue=N'$gender'", $conn);
                    if (mssql_num_rows($query) > 0) {
                        while ($row = mssql_fetch_assoc($query)) {
                            $gender_id = $row['id'];
                        }
                    }
                    else {
                        $query = mssql_query("INSERT INTO terminfo (dcvalue) VALUES (N'$gender')", $conn);
                        $gender_id = mssql_insert_id();
                    }
                }

                $query = mssql_query("SELECT id from termgroup where langroup=$langroup_id and termlexid=N'$termlexid' and termtext=N'$termtext' and pos=$pos_id and gender=$gender_id and status=$status_id", $conn);
                if (mssql_num_rows($query) > 0) {
                    while ($row = mssql_fetch_assoc($query)) {
                        $termgroup_id = $row['id'];
                    }
                }
                else {
                    $query = mssql_query("INSERT INTO termgroup (langroup, termlexid, termtext, pos, gender, status) VALUES ($langroup_id, N'$termlexid', N'$termtext', $pos_id, $gender_id, $status_id)", $conn);
                    $termgroup_id = mssql_insert_id();
                }

                foreach($tgrp->contextGrp as $cgrp)
                {
                    $context = $cgrp->{'DC-149-context'};
                    $context = clean($context);
                    $query = mssql_query("SELECT id from contextgroup where termgroup=$termgroup_id and context=N'$context'", $conn);
                    if (mssql_num_rows($query) > 0) {
                        while ($row = mssql_fetch_assoc($query)) {
                            $contextgroup_id = $row['id'];
                        }
                    }
                    else {
                        $query = mssql_query("INSERT INTO contextgroup (termgroup, context) VALUES ($termgroup_id, N'$context')", $conn);
                        $contextgroup_id = mssql_insert_id();
                    }
                    $source = $cgrp->{'DC-1968-source'};
                    $bibref = $source['biblio'];
                    $source_text = clean($source);
                    $query = mssql_query("SELECT id from biblio where reference=N'$bibref'", $conn);
                    if (mssql_num_rows($query) > 0) {
                        while ($row = mssql_fetch_assoc($query)) {
                            $bib_id = $row['id'];
                        }
                    }
                    $query = mssql_query("SELECT id from source where biblio=$bib_id and text=N'$source_text' and type='con' and termid=$term_id and contextgroup=$contextgroup_id", $conn);
                    if (mssql_num_rows($query) > 0) {
                        while ($row = mssql_fetch_assoc($query)) {
                            $source_id = $row['id'];
                        }
                    }
                    else {
                        $query = mssql_query("INSERT INTO source (biblio, text, type, termid, contextgroup) VALUES ($bib_id, N'$source_text', 'con', $term_id, $contextgroup_id)", $conn);
                        $source_id = mssql_insert_id();
                    }
                }
            }
        }
    }
}
?>