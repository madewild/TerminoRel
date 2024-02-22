<html>
<head>
<title>TerminoRel</title>
<meta charset="UTF-8">
</head>
<body>
<?php
include("../../static/header.php");

$conn = mysqli_connect($server, $username, $password) or die("Unable to connect to '$server'");
$conn -> set_charset("utf8");
mysqli_select_db($conn, $database) or die("Could not open the database '$database'");

if ($conn) {
    $query = "SELECT * FROM biblio";
    $result = mysqli_query($conn, $query);
    if ($result) {
        echo '<table><tr><th>ID</th><th>Titre</th><th>Type</th><th>Date</th><th>Source</th><th>Service</th></tr>';
        while ($row = mysqli_fetch_assoc($result))
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
