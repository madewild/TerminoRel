<html>
<head>
<title>TerminoRel</title>
<meta charset="UTF-8">
</head>
<body>
<?php
include("../../static/header.php");

$conn = mysqli_connect($server, $conninfo);
if ($conn) {
    $query = mysqli_query($conn, "SELECT * FROM biblio", array(), array("Scrollable" => 'static'));
    if ($query) {
        echo '<table><tr><th>ID</th><th>Titre</th><th>Type</th><th>Date</th><th>Source</th><th>Service</th></tr>';
        while ($row = mysqli_fetch_array($query))
        {
            $ref = $row['reference'];
            $title = $row['title'];
            $type = $row['typedoc'];
            $date = $row['datedoc'];
            $source = $row['source'];
            $service = $row['service'];
            echo '<tr><td>'.$ref.'</td><td>'.$title.'</td><td>'.$type.'</td><td>'.$date.'</td><td>'.$source.'</td><td>'.$service.'</td></tr>';
        }
        echo '</table>';
    }
}
?>
</body>
</html>
