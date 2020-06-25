<?php
if(isset($_GET['fiche'])) {
    include("details.php");
} else if(isset($_GET['update'])){
    include("update.php");
} else if(isset($_GET['delete'])){
    include("delete.php");
} else if(isset($_GET['import'])){
    include("import.php");
} else if(isset($_POST["OK"])) {
    include("upload.php");
} else {
    include("home.php");
}
include("../static/footer.php");
?>