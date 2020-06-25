<?php
if(isset($_GET['fiche'])) {
    include("details.php");
} else if(isset($_GET['termlexid'])){
    include("update.php");
} else if(isset($_GET['import'])){
    include("import.php");
} else {
    include("termlist.php");
}
include("../static/footer.php");
?>