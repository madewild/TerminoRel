<html>
<head>
<title>TerminoRel</title>
<meta charset="UTF-8">
</head>
<body>
<?php
error_reporting(-1);
ini_set('display_errors', 'On');
ini_set('mssql.charset', 'UTF-8');
include("../static/secret.php");
$server = SERVER;
$username = USERNAME;
$password = PASSWORD;

$conninfo = array(
    "Database" => "terminorel",
    "UID" => $username,
    "PWD" => $password
);

$conn = sqlsrv_connect($server, $conninfo);
if ($conn) {
    $query = sqlsrv_query("SELECT * FROM biblio", $conn);
    if ($query) {
        echo '<table><tr><th>ID</th><th>Titre</th><th>Type</th><th>Date</th><th>Source</th><th>Service</th></tr>';
        while ($row = sqlsrv_fetch_assoc($query))
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
