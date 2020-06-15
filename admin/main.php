<?php
if(isset($_GET['fiche'])) {
    include("details.php");
} else {
    include("termlist.php");
}
include("../static/footer.php");
?>