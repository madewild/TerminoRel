<?php
include("../../static/header.php");
ob_implicit_flush(); // force flushing after each call to display inserts in real time

$conn = mysqli_connect($server, $conninfo);
if ($conn) {
    $query = mysqli_query($conn, "TRUNCATE TABLE contextgroup");
    $query = mysqli_query($conn, "TRUNCATE TABLE termgroup");
    $query = mysqli_query($conn, "TRUNCATE TABLE langroup");
    $query = mysqli_query($conn, "TRUNCATE TABLE term");
    $domains = array("P01", "P02");
    foreach($domains as $domain) {
        $xml = simplexml_load_file("../../xml/".$domain.".xml");
        foreach($xml->{'DC-209-terminologicalEntry'} as $doc)
        {
            $ref = $doc['DC-206-entryIdentifier'];
            echo $ref . ' ajouté' . str_pad("",4096," ") . '<br>';

            foreach($doc->{'DC-489-subjectField'} as $subject)
            {
                $cdu = $subject['cdu'];
                $level = $subject['niveau'];
                $subject = str_replace("'", "''", $subject);
                $query = mysqli_query($conn, "SELECT id from subject where level=$level and text=N'$subject'");
                if (mysqli_num_rows($query) > 0) {
                    $subject_id = mysqli_fetch_assoc($query)['id'];
                }
                else {
                    $query = mysqli_query($conn, "INSERT INTO subject (cdu, level, text) VALUES (N'$cdu', $level, N'$subject')");
                    $subject_id = mysqli_insert_id($conn);
                }
                $query2 = mysqli_query($conn, "SELECT * from subjectfield where term=N'$ref' and subject=$subject_id");
                if (mysqli_num_rows($query2) == 0) {
                    $query3 = mysqli_query($conn, "INSERT INTO subjectfield (term, subject) VALUES ($ref, $subject_id)");
                }
            }

            $owner = $doc->{'DC-494-subsetOwner'};
            $owner_name = $owner['nom'];
            $query = mysqli_query($conn, "SELECT id from subsetowner where name=N'$owner_name'");
            if (mysqli_num_rows($query) > 0) {
                $owner_id = mysqli_fetch_assoc($query)['id'];
            }
            else {
                $query = mysqli_query($conn, "INSERT INTO subsetowner (name) VALUES (N'$owner_name')");
                $owner_id = mysqli_insert_id($conn);
            }

            $creator = $doc->{'DC-162-createdBy'};
            $creator_name = str_replace("'", "''", $creator);
            $query = mysqli_query($conn, "SELECT id from creator where name=N'$creator_name'");
            if (mysqli_num_rows($query) > 0) {
                $creator_id = mysqli_fetch_assoc($query)['id'];
            }
            else {
                $query = mysqli_query($conn, "INSERT INTO creator (name) VALUES (N'$creator_name')");
                $creator_id = mysqli_insert_id($conn);
            }

            $date = $doc->{'DC-274-inputDate'};
            $query = mysqli_query($conn, "SELECT id from term where reference=N'$ref'");
            if (mysqli_num_rows($query) > 0) {
                echo "Référence déjà présente (doublon)<br>";
                $term_id = mysqli_fetch_assoc($query)['id'];
            }
            else {
                $query = mysqli_query($conn, "INSERT INTO term (reference, subsetowner, createdby, inputdate) VALUES (N'$ref', $owner_id, $creator_id, N'$date')");
                $term_id = mysqli_insert_id($conn);
            }

            foreach($doc->{'DC-435-relatedConcept'} as $rel)
            {
                $toref = $rel['DC-461-see'];
                $query = mysqli_query($conn, "SELECT fromref, toref from related where fromref='$ref' and toref='$toref'");
                if (mysqli_num_rows($query) == 0) {
                    $query = mysqli_query($conn, "INSERT INTO related (fromref, toref) VALUES ('$ref', '$toref')");
                }
            }

            foreach($doc->langGrp as $lgrp) 
            {
                $lang = $lgrp->attributes("xml", TRUE)->lang;

                $dgrp = $lgrp->definitionGrp;
                $def = $dgrp->{'DC-168-definition'};
                $def = clean($def);

                $egrp = $lgrp->explicGrp;
                $exp = $egrp->{'DC-223-explanation'};
                $exp = clean($exp);

                $query = mysqli_query($conn, "SELECT id from langroup where termid=N'$term_id' and lang=N'$lang'");
                if (mysqli_num_rows($query) > 0) {
                    echo "Ce terme a déjà une entrée pour la langue " . $lang . "<br>";
                    $langroup_id = mysqli_fetch_assoc($query)['id'];
                }
                else {
                    $query = mysqli_query($conn, "INSERT INTO langroup (termid, lang, definition, explanation) VALUES ($term_id, N'$lang', N'$def', N'$exp')");
                    $langroup_id = mysqli_insert_id($conn);
                }
                if (!empty($dgrp)) {
                    foreach($dgrp->{'DC-1968-source'} as $source)
                    {
                        $bibref = $source['biblio'];
                        $source_text = str_replace("'", "''", $source);
                        $query = mysqli_query($conn, "SELECT id from biblio where reference=N'$bibref'");
                        if (mysqli_num_rows($query) > 0) {
                            $bib_id = mysqli_fetch_assoc($query)['id'];
                        }
                        $query = mysqli_query($conn, "SELECT id from source where biblio=$bib_id and text=N'$source_text' and type='def' and termid=$term_id");
                        if (mysqli_num_rows($query) > 0) {
                            $source_id = mysqli_fetch_assoc($query)['id'];
                        }
                        else {
                            $query = mysqli_query($conn, "INSERT INTO source (biblio, text, type, termid, contextgroup) VALUES ($bib_id, N'$source_text', 'def', $term_id, NULL)");
                            $source_id = mysqli_insert_id($conn);
                        }
                    }
                }
                if (!empty($egrp)) {
                    foreach($egrp->{'DC-1968-source'} as $source)
                    {
                        $bibref = $source['biblio'];
                        $source_text = str_replace("'", "''", $source);
                        $query = mysqli_query($conn, "SELECT id from biblio where reference=N'$bibref'");
                        if (mysqli_num_rows($query) > 0) {
                            $bib_id = mysqli_fetch_assoc($query)['id'];
                        }
                        $query = mysqli_query($conn, "SELECT id from source where biblio=$bib_id and text=N'$source_text' and type='exp' and termid=$term_id");
                        if (mysqli_num_rows($query) > 0) {
                            $source_id = mysqli_fetch_assoc($query)['id'];
                        }
                        else {
                            $query = mysqli_query($conn, "INSERT INTO source (biblio, text, type, termid, contextgroup) VALUES ($bib_id, N'$source_text', 'exp', $term_id, NULL)");
                            $source_id = mysqli_insert_id($conn);
                        }
                    }
                }

                foreach($lgrp->termGrp as $tgrp)
                {
                    $term = $tgrp->{'DC-508-term'};
                    $termlexid = $term['DC-301-lexTermIdentifier'];
                    $status = $term['DC-280-languagePlanningQualifier'];
                    $query = mysqli_query($conn, "SELECT id from terminfo where dcvalue=N'$status'");
                    if (mysqli_num_rows($query) > 0) {
                        while ($row = mysqli_fetch_assoc($query)) {
                            $status_id = $row['id'];
                        }
                    }
                    else {
                        if(empty($status)) {
                            $status_id = 0;
                        } else {
                            $query = mysqli_query($conn, "INSERT INTO terminfo (dcvalue) VALUES (N'$status')");
                            $status_id = mysqli_insert_id($conn);
                        }
                    }

                    $auth = $term['DC-374-normativeAuthorization'];
                    $query = mysqli_query($conn, "SELECT id from terminfo where dcvalue=N'$auth'");
                    if (mysqli_num_rows($query) > 0) {
                        while ($row = mysqli_fetch_assoc($query)) {
                            $auth_id = $row['id'];
                        }
                    }
                    else {
                        if(empty($auth)) {
                            $auth_id = 0;
                        } else {
                            $query = mysqli_query($conn, "INSERT INTO terminfo (dcvalue) VALUES (N'$auth')");
                            $auth_id = mysqli_insert_id($conn);
                        }
                    }
                    
                    $termtext = clean($term);

                    $variant = $tgrp->{'DC-330-variant'};
                    $fem = clean($variant);

                    $graminfo = $tgrp->{'DC-250-grammaticalInfo'};
                    $pos = $graminfo['DC-396-partOfSpeech'];
                    $query = mysqli_query($conn, "SELECT id from terminfo where dcvalue=N'$pos'");
                    if (mysqli_num_rows($query) > 0) {
                        while ($row = mysqli_fetch_assoc($query)) {
                            $pos_id = $row['id'];
                        }
                    }
                    else {
                        $query = mysqli_query($conn, "INSERT INTO terminfo (dcvalue) VALUES (N'$pos')");
                        $pos_id = mysqli_insert_id($conn);
                    }

                    $gender = $graminfo['DC-245-grammaticalGender'];
                    $query = mysqli_query($conn, "SELECT id from terminfo where dcvalue=N'$gender'");
                    if (mysqli_num_rows($query) > 0) {
                        while ($row = mysqli_fetch_assoc($query)) {
                            $gender_id = $row['id'];
                        }
                    }
                    else {
                        if(empty($gender)) {
                            $gender_id = 0;
                        } else {
                            $query = mysqli_query($conn, "INSERT INTO terminfo (dcvalue) VALUES (N'$gender')");
                            $gender_id = mysqli_insert_id($conn);
                        }
                    }

                    $number = $graminfo['DC-251-grammaticalNumber'];
                    $query = mysqli_query($conn, "SELECT id from terminfo where dcvalue=N'$number'");
                    if (mysqli_num_rows($query) > 0) {
                        while ($row = mysqli_fetch_assoc($query)) {
                            $number_id = $row['id'];
                        }
                    }
                    else {
                        if(empty($number)) {
                            $number_id = 0;
                        } else {
                            $query = mysqli_query($conn, "INSERT INTO terminfo (dcvalue) VALUES (N'$number')");
                            $number_id = mysqli_insert_id($conn);
                        }
                    }

                    $abbrev = $tgrp->{'DC-64-abbreviatedFormFor'};
                    if(empty($abbrev)) {
                        $is_abbrev = 0;
                    } else {
                        $is_abbrev = 1;
                    }

                    $query = mysqli_query($conn, "SELECT id from termgroup where langroup=$langroup_id and termlexid=N'$termlexid' and termtext=N'$termtext' and pos=$pos_id");
                    if (mysqli_num_rows($query) > 0) {
                        while ($row = mysqli_fetch_assoc($query)) {
                            $termgroup_id = $row['id'];
                        }
                    }
                    else {
                        $query = mysqli_query($conn, "INSERT INTO termgroup (langroup, termlexid, termtext, variant, pos, gender, number, qualifier, auth, abbrev) VALUES ($langroup_id, N'$termlexid', N'$termtext', N'$fem', $pos_id, $gender_id, $number_id, $status_id, $auth_id, $is_abbrev)");
                        $termgroup_id = mysqli_insert_id($conn);
                    }

                    foreach($tgrp->contextGrp as $cgrp)
                    {
                        $context = $cgrp->{'DC-149-context'};
                        $context = clean($context);
                        $query = mysqli_query($conn, "SELECT id from contextgroup where termgroup=$termgroup_id and context=N'$context'");
                        if (mysqli_num_rows($query) > 0) {
                            while ($row = mysqli_fetch_assoc($query)) {
                                $contextgroup_id = $row['id'];
                            }
                        }
                        else {
                            $query = mysqli_query($conn, "INSERT INTO contextgroup (termgroup, context) VALUES ($termgroup_id, N'$context')");
                            $contextgroup_id = mysqli_insert_id($conn);
                        }
                        $source = $cgrp->{'DC-1968-source'};
                        $bibref = $source['biblio'];
                        $source_text = clean($source);
                        $query = mysqli_query($conn, "SELECT id from biblio where reference=N'$bibref'");
                        if (mysqli_num_rows($query) > 0) {
                            while ($row = mysqli_fetch_assoc($query)) {
                                $bib_id = $row['id'];
                            }
                        }
                        $query = mysqli_query($conn, "SELECT id from source where biblio=$bib_id and text=N'$source_text' and type='con' and termid=$term_id and contextgroup=$contextgroup_id");
                        if (mysqli_num_rows($query) > 0) {
                            while ($row = mysqli_fetch_assoc($query)) {
                                $source_id = $row['id'];
                            }
                        }
                        else {
                            $query = mysqli_query($conn, "INSERT INTO source (biblio, text, type, termid, contextgroup) VALUES ($bib_id, N'$source_text', 'con', $term_id, $contextgroup_id)");
                            $source_id = mysqli_insert_id($conn);
                        }
                    }
                }
            }
        }
    }
} else {
    echo "Connection could not be established.<br />";
    die( print_r( mysqli_errors(), true));
}
include("export.php");
?>