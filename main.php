<?php
#include("static/maintenance.php");
if(isset($_GET['term'])) {
    include("results.php");
} else if(isset($_GET['glossary'])) {
    include("glossary.php");
} else if(isset($_GET['page'])) {
   if($_GET['page'] == 'about') {
      include("static/about.php");
   } else if($_GET['page'] == 'help') {
      include("static/help.php");
   } else if($_GET['page'] == 'copyright') {
      include("static/copyright.php");
   } else if($_GET['page'] == 'contact') {
      include("static/contact.php");
   } else if($_GET['page'] == 'test') {
    include("static/test.php");
   } else {
      include("static/error.php");
   }
} else {
    include("home.php");
}
include("static/footer.php");
?>