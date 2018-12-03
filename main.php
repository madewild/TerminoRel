<?php
if(isset($_POST['term'])) {
    include("results.php");
} else if(isset($_GET['glossary'])) {
    include("glossary.php");
} else if(isset($_GET['page'])) {
   if($_GET['page'] == 'about') {
      include("about.php");
   } else if($_GET['page'] == 'help') {
      include("help.php");
   } else if($_GET['page'] == 'copyright') {
      include("copyright.php");
   } else if($_GET['page'] == 'contact') {
      include("contact.php");
   } else {
      include("error.php");
   }
} else {
    include("form.php");
}
include("footer.php");
?>