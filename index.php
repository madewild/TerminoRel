<html>
<head>
<title>TerminoRel</title>
<meta charset="UTF-8">
</head>
<body>
<?php
//phpinfo();
error_reporting(-1);
ini_set('display_errors', 'On');
ini_set('mssql.charset', 'UTF-8');
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
