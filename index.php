<html>
<head>
<title>Terminorel</title>
</head>
<body>
<?php
//phpinfo();
error_reporting(-1);
ini_set('display_errors', 'On');
include("secret.php");
$server = SERVER;
$username = USERNAME;
$password = PASSWORD;
$conn = mssql_connect($server, $username, $password);
if ($conn) {
    mssql_select_db("terminorel", $conn);
    $query = mssql_query("SELECT * FROM biblio", $conn);
    if ($query) {
        $array = mssql_fetch_array($query, MSSQL_NUM);
        foreach($array as $key => $value)
        {
            echo $key." has the value ". $value ."<br />";
        }
    }
}
?>
</body>
</html>
