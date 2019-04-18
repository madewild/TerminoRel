<?php
error_reporting(-1);
ini_set('display_errors', 'On');
include("../static/secret.php");
$server = SERVER;
$username = USERNAME;
$password = PASSWORD;

function sqlsrv_insert_id() { 
    $id = 0; 
    $res = sqlsrv_query("SELECT @@identity AS id"); 
    if ($row = sqlsrv_fetch_array($res)) { 
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

$conninfo = array(
    "Database" => "terminorel",
    "UID" => $username,
    "PWD" => $password,
    "CharacterSet" => "UTF-8"
);

$conn = sqlsrv_connect($server, $conninfo);
if ($conn) {
    $query = sqlsrv_query($conn, "TRUNCATE TABLE termgroup");
    $query = sqlsrv_query($conn, "TRUNCATE TABLE langroup");
    $query = sqlsrv_query($conn, "TRUNCATE TABLE term");
    $xml = simplexml_load_file("../xml/btulb.xml");
    foreach($xml->{'DC-209-terminologicalEntry'} as $doc)
    {
        $ref = $doc['DC-206-entryIdentifier'];
        echo 'Importing ' . $ref . '...<br>';

        foreach($doc->{'DC-489-subjectField'} as $subject)
        {
            $cdu = $subject['cdu'];
            $level = $subject['niveau'];
            $subject = str_replace("'", "''", $subject);
            $query = sqlsrv_query($conn, "SELECT id from subject where level=$level and text=N'$subject'");
            if (sqlsrv_num_rows($query) > 0) {
                $subject_id = sqlsrv_fetch_array($query)['id'];
            }
            else {
                $query = sqlsrv_query($conn, "INSERT INTO subject (cdu, level, text) VALUES (N'$cdu', $level, N'$subject')");
                $subject_id = sqlsrv_insert_id();
            }
            $query2 = sqlsrv_query($conn, "SELECT * from subjectfield where term=N'$ref' and subject=$subject_id");
            if (sqlsrv_num_rows($query2) == 0) {
                $query3 = sqlsrv_query($conn, "INSERT INTO subjectfield (term, subject) VALUES ($ref, $subject_id)");
            }
        }

        $owner = $doc->{'DC-494-subsetOwner'};
        $owner_name = $owner['nom'];
        $query = sqlsrv_query($conn, "SELECT id from subsetowner where name=N'$owner_name'");
        if (sqlsrv_num_rows($query) > 0) {
            $owner_id = sqlsrv_fetch_array($query)['id'];
        }
        else {
            $query = sqlsrv_query($conn, "INSERT INTO subsetowner (name) VALUES (N'$owner_name')");
            $owner_id = sqlsrv_insert_id();
        }

        $creator = $doc->{'DC-162-createdBy'};
        $creator_name = str_replace("'", "''", $creator);
        $query = sqlsrv_query($conn, "SELECT id from creator where name=N'$creator_name'");
        if (sqlsrv_num_rows($query) > 0) {
            $creator_id = sqlsrv_fetch_array($query)['id'];
        }
        else {
            $query = sqlsrv_query($conn, "INSERT INTO creator (name) VALUES (N'$creator_name')");
            $creator_id = sqlsrv_insert_id();
        }

        $date = $doc->{'DC-274-inputDate'};
        $query = sqlsrv_query($conn, "SELECT id from term where reference=N'$ref'");
        if (sqlsrv_num_rows($query) > 0) {
            echo "Reference already in DB<br>";
            $term_id = sqlsrv_fetch_array($query)['id'];
        }
        else {
            $query = sqlsrv_query($conn, "INSERT INTO term (reference, subsetowner, createdby, inputdate) VALUES (N'$ref', $owner_id, $creator_id, N'$date')");
            $term_id = sqlsrv_insert_id();
        }

        foreach($doc->{'DC-435-relatedConcept'} as $rel)
        {
            $toref = $rel['DC-461-see'];
            $query = sqlsrv_query($conn, "SELECT fromref, toref from related where fromref='$ref' and toref='$toref'");
            if (sqlsrv_num_rows($query) == 0) {
                $query = sqlsrv_query($conn, "INSERT INTO related (fromref, toref) VALUES ('$ref', '$toref')");
            }
        }

        foreach($doc->langGrp as $lgrp) 
        {
            $lang = $lgrp->attributes("xml", TRUE)->lang;
            $query = sqlsrv_query($conn, "SELECT id from lang where code=N'$lang'");
            if (sqlsrv_num_rows($query) > 0) {
                $lang_id = sqlsrv_fetch_array($query)['id'];
            }
            else {
                $query = sqlsrv_query($conn, "INSERT INTO lang (code) VALUES (N'$lang')");
                $lang_id = sqlsrv_insert_id();
            }

            $dgrp = $lgrp->definitionGrp;
            $def = $dgrp->{'DC-168-definition'};
            $def = clean($def);

            $egrp = $lgrp->explicGrp;
            $exp = $egrp->{'DC-223-explanation'};
            $exp = clean($exp);

            $query = sqlsrv_query($conn, "SELECT id from langroup where termid=N'$term_id' and lang=N'$lang_id'");
            if (sqlsrv_num_rows($query) > 0) {
                echo "This term has already an entry for " . $lang . "<br>";
                $langroup_id = sqlsrv_fetch_array($query)['id'];
            }
            else {
                $query = sqlsrv_query($conn, "INSERT INTO langroup (termid, lang, definition, explanation) VALUES ($term_id, $lang_id, N'$def', N'$exp')");
                $langroup_id = sqlsrv_insert_id();
            }
            if (!empty($dgrp)) {
                foreach($dgrp->{'DC-1968-source'} as $source)
                {
                    $bibref = $source['biblio'];
                    $source_text = str_replace("'", "''", $source);
                    $query = sqlsrv_query($conn, "SELECT id from biblio where reference=N'$bibref'");
                    if (sqlsrv_num_rows($query) > 0) {
                        $bib_id = sqlsrv_fetch_array($query)['id'];
                    }
                    $query = sqlsrv_query($conn, "SELECT id from source where biblio=$bib_id and text=N'$source_text' and type='def' and termid=$term_id");
                    if (sqlsrv_num_rows($query) > 0) {
                        $source_id = sqlsrv_fetch_array($query)['id'];
                    }
                    else {
                        $query = sqlsrv_query($conn, "INSERT INTO source (biblio, text, type, termid, contextgroup) VALUES ($bib_id, N'$source_text', 'def', $term_id, NULL)");
                        $source_id = sqlsrv_insert_id();
                    }
                }
            }
            if (!empty($egrp)) {
                foreach($egrp->{'DC-1968-source'} as $source)
                {
                    $bibref = $source['biblio'];
                    $source_text = str_replace("'", "''", $source);
                    $query = sqlsrv_query($conn, "SELECT id from biblio where reference=N'$bibref'");
                    if (sqlsrv_num_rows($query) > 0) {
                        $bib_id = sqlsrv_fetch_array($query)['id'];
                    }
                    $query = sqlsrv_query($conn, "SELECT id from source where biblio=$bib_id and text=N'$source_text' and type='exp' and termid=$term_id");
                    if (sqlsrv_num_rows($query) > 0) {
                        $source_id = sqlsrv_fetch_array($query)['id'];
                    }
                    else {
                        $query = sqlsrv_query($conn, "INSERT INTO source (biblio, text, type, termid, contextgroup) VALUES ($bib_id, N'$source_text', 'exp', $term_id, NULL)");
                        $source_id = sqlsrv_insert_id();
                    }
                }
            }

            foreach($lgrp->termGrp as $tgrp)
            {
                $term = $tgrp->{'DC-508-term'};
                $termlexid = $term['DC-301-lexTermIdentifier'];
                $status = $term['DC-280-languagePlanningQualifier'];
                $query = sqlsrv_query($conn, "SELECT id from terminfo where dcvalue=N'$status'");
                if (sqlsrv_num_rows($query) > 0) {
                    while ($row = sqlsrv_fetch_array($query)) {
                        $status_id = $row['id'];
                    }
                }
                else {
                    if(empty($status)) {
                        $status_id = 0;
                    } else {
                        $query = sqlsrv_query($conn, "INSERT INTO terminfo (dcvalue) VALUES (N'$status')");
                        $status_id = sqlsrv_insert_id();
                    }
                }

                $auth = $term['DC-374-normativeAuthorization'];
                $query = sqlsrv_query($conn, "SELECT id from terminfo where dcvalue=N'$auth'");
                if (sqlsrv_num_rows($query) > 0) {
                    while ($row = sqlsrv_fetch_array($query)) {
                        $auth_id = $row['id'];
                    }
                }
                else {
                    if(empty($auth)) {
                        $auth_id = 0;
                    } else {
                        $query = sqlsrv_query($conn, "INSERT INTO terminfo (dcvalue) VALUES (N'$auth')");
                        $auth_id = sqlsrv_insert_id();
                    }
                }
                
                $termtext = clean($term);

                $variant = $tgrp->{'DC-330-variant'};
                $fem = clean($variant);

                $graminfo = $tgrp->{'DC-250-grammaticalInfo'};
                $pos = $graminfo['DC-396-partOfSpeech'];
                $query = sqlsrv_query($conn, "SELECT id from terminfo where dcvalue=N'$pos'");
                if (sqlsrv_num_rows($query) > 0) {
                    while ($row = sqlsrv_fetch_array($query)) {
                        $pos_id = $row['id'];
                    }
                }
                else {
                    $query = sqlsrv_query($conn, "INSERT INTO terminfo (dcvalue) VALUES (N'$pos')");
                    $pos_id = sqlsrv_insert_id();
                }

                $gender = $graminfo['DC-245-grammaticalGender'];
                $query = sqlsrv_query($conn, "SELECT id from terminfo where dcvalue=N'$gender'");
                if (sqlsrv_num_rows($query) > 0) {
                    while ($row = sqlsrv_fetch_array($query)) {
                        $gender_id = $row['id'];
                    }
                }
                else {
                    if(empty($gender)) {
                        $gender_id = 0;
                    } else {
                        $query = sqlsrv_query($conn, "INSERT INTO terminfo (dcvalue) VALUES (N'$gender')");
                        $gender_id = sqlsrv_insert_id();
                    }
                }

                $abbrev = $tgrp->{'DC-64-abbreviatedFormFor'};
                if(empty($abbrev)) {
                    $is_abbrev = 0;
                } else {
                    $is_abbrev = 1;
                }

                $query = sqlsrv_query($conn, "SELECT id from termgroup where langroup=$langroup_id and termlexid=N'$termlexid' and termtext=N'$termtext' and pos=$pos_id");
                if (sqlsrv_num_rows($query) > 0) {
                    while ($row = sqlsrv_fetch_array($query)) {
                        $termgroup_id = $row['id'];
                    }
                }
                else {
                    $query = sqlsrv_query($conn, "INSERT INTO termgroup (langroup, termlexid, termtext, variant, pos, gender, qualifier, auth, abbrev) VALUES ($langroup_id, N'$termlexid', N'$termtext', N'$fem', $pos_id, $gender_id, $status_id, $auth_id, $is_abbrev)");
                    $termgroup_id = sqlsrv_insert_id();
                }

                foreach($tgrp->contextGrp as $cgrp)
                {
                    $context = $cgrp->{'DC-149-context'};
                    $context = clean($context);
                    $query = sqlsrv_query($conn, "SELECT id from contextgroup where termgroup=$termgroup_id and context=N'$context'");
                    if (sqlsrv_num_rows($query) > 0) {
                        while ($row = sqlsrv_fetch_array($query)) {
                            $contextgroup_id = $row['id'];
                        }
                    }
                    else {
                        $query = sqlsrv_query($conn, "INSERT INTO contextgroup (termgroup, context) VALUES ($termgroup_id, N'$context')");
                        $contextgroup_id = sqlsrv_insert_id();
                    }
                    $source = $cgrp->{'DC-1968-source'};
                    $bibref = $source['biblio'];
                    $source_text = clean($source);
                    $query = sqlsrv_query($conn, "SELECT id from biblio where reference=N'$bibref'");
                    if (sqlsrv_num_rows($query) > 0) {
                        while ($row = sqlsrv_fetch_array($query)) {
                            $bib_id = $row['id'];
                        }
                    }
                    $query = sqlsrv_query($conn, "SELECT id from source where biblio=$bib_id and text=N'$source_text' and type='con' and termid=$term_id and contextgroup=$contextgroup_id");
                    if (sqlsrv_num_rows($query) > 0) {
                        while ($row = sqlsrv_fetch_array($query)) {
                            $source_id = $row['id'];
                        }
                    }
                    else {
                        $query = sqlsrv_query($conn, "INSERT INTO source (biblio, text, type, termid, contextgroup) VALUES ($bib_id, N'$source_text', 'con', $term_id, $contextgroup_id)");
                        $source_id = sqlsrv_insert_id();
                    }
                }
            }
        }
    }
}
?>