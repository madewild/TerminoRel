<?php
include("../static/header.php");
ob_implicit_flush(); // force flushing after each call to display inserts in real time

$target_dir = "../xml/";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$fileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

$xml_string = file_get_contents($_FILES["fileToUpload"]["tmp_name"]);
libxml_use_internal_errors(true);
$xml = simplexml_load_string($xml_string);

$path = $_SERVER['REQUEST_URI'] . "?import=xml";

echo "<p><a href='" . $path . "'>Retour à l'import de fichier XML</a></p>";
echo "<p>";

// Check if file already exists
if (file_exists($target_file)) {
  echo "Ce nom de fichier existe déjà. ";
  $uploadOk = 0;
}

// Check file size
 else if ($_FILES["fileToUpload"]["size"] > 500000) {
  echo "Ce fichier est trop volumineux. ";
  $uploadOk = 0;
}

// Allow certain file formats
else if($fileType != "xml" ) {
  echo "Seul le format XML est autorisé. ";
  $uploadOk = 0;
}

// Validate XML
else if(!$xml) {
  echo "Ce fichier XML n'est pas valide. ";
  $uploadOk = 0;
}

// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
  echo "Le fichier n'a pas pu être uploadé.";
// if everything is ok, try to upload file
} else {
  if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
    echo "Le fichier ". basename( $_FILES["fileToUpload"]["name"]). " a bien été uploadé.";
  } else {
    echo "Une erreur est survenue lors de l'upload...";
  }
}
echo "</p>";

if ($uploadOk && file_exists($target_file)) {
    $conn = mysqli_connect($server, $username, $password) or die("Unable to connect to '$server'");
    $conn -> set_charset("utf8");
    mysqli_select_db($conn, $database) or die("Could not open the database '$database'");
    foreach($xml->{'DC-209-terminologicalEntry'} as $doc)
    {
        $ref = $doc['DC-206-entryIdentifier'];
        $importOk = 1;
        echo '<p><b>' . $ref . '</b> en cours de traitement...' . str_pad("",4096," ");
        $query = "SELECT id from term where reference=N'$ref'";
        $result = mysqli_query($conn, $query);
        $new_syns = 0;
        if (mysqli_num_rows($result) > 0) {
            echo "<br>Identifiant existant";
            $same_entry = 1;
            foreach($doc->langGrp as $lgrp) {
                foreach($lgrp->termGrp as $tgrp) {
                    $term = $tgrp->{'DC-508-term'};
                    $termtext = clean($term);
                    $termlexid = $term['DC-301-lexTermIdentifier'];
                    $query2 = "SELECT termtext from termgroup where termlexid=N'$termlexid'";
                    $result2 = mysqli_query($conn, $query2);
                    if (mysqli_num_rows($result2) == 0) {
                        $lang = strtoupper(explode("-", $termlexid)[3]);
                        echo "<br>Nouveau synonyme " . $lang . " : <b>" . $termtext . "</b>";
                        $new_syns++;
                    } else {
                        $dbtermtext = mysqli_fetch_assoc($result2)['termtext'];
                        if ($dbtermtext != $termtext) {
                            $same_entry = 0;
                        }
                    }
                }
            }
            if (!$same_entry) {
                echo "<br>Doublon détecté !";
                $importOk = 0;
            }
            else if (!$new_syns) {
                echo "<br>Aucun nouveau synonyme";
                $importOk = 0;
            }
        } else {
            echo "<br>Nouvel identifiant";
            foreach($doc->langGrp as $lgrp) {
                foreach($lgrp->termGrp as $tgrp) {
                    $term = $tgrp->{'DC-508-term'};
                    $termtext = clean($term);
                    $termlexid = $term['DC-301-lexTermIdentifier'];
                    $dom = strtoupper(explode("-", $termlexid)[0]);
                    $query3 = "SELECT termlexid from termgroup where termlexid like '$dom%01-fr' and termtext=N'$termtext'";
                    $result3 = mysqli_query($conn, $query3);
                    if (mysqli_num_rows($result3) > 0) {
                        $dbtermlexid = mysqli_fetch_assoc($result3)['termlexid'];
                        $duplicate = explode("-", $dbtermlexid)[0] . "-" . explode("-", $dbtermlexid)[1];
                        echo("<br>Le terme <b>" . $termtext . "</b> existe déjà dans le domaine " . $dom . " (entrée " . $duplicate . ") !");
                        $importOk = 0;
                        $duplicate_term = $termtext;
                    }
                }
            }
        }
        if ($importOk) {
            if ($new_syns) {
                $word = "Mise à jour";
            } else {
                $word = "Importation";
            }
            echo("<br><span style='color: lightgreen'>" . $word . " réussie.</span>");
        } else {
            if(isset($duplicate_term)) {
                echo("<br><span id='fail' style='color: tomato'>Importation annulée.</span>");
            } else {
                echo("<br><span style='color: tomato'>Importation annulée.</span>");
            }
        }
        echo "</p>";
    }
}
if(isset($duplicate_term)) {
    echo "<script>
    if (confirm('Forcer la réimportation de \"" . $duplicate_term . "\" ?')) {
        $('#fail').html('Importation <b>forcée</b>.');
    }
    </script>";
}
?>