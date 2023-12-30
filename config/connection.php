<?php
session_start();
error_reporting(0);

include("functions.php");

define('dbObject', '['.$_SESSION['dbName'].'].[dbo].');

function Run($var)
{

$server = '217.76.50.216\VMI826410\SQLEXPRESS';


$user = $_SESSION['dbUser'];
$pass = $_SESSION['dbPass'];
//Define Port
$port='Port='.$_SESSION['dbPort'];
$database = $_SESSION['dbName'];
$dbHost = $_SESSION['dbHost'];
if($dbHost=='154.53.40.18')
{
$server = $dbHost;
}
else
{
$server = $server.",".$_SESSION['dbPort'];
}
$conn = new PDO( "sqlsrv:server=$server; Database = $database", $user, $pass);  
$conn->setAttribute( PDO::SQLSRV_ATTR_ENCODING, PDO::ERRMODE_EXCEPTION );  
$stmt = $conn->query("SET NOCOUNT ON 
;".$var) or die(print_r($conn->errorInfo()));  
; 
return $stmt;
}


function myfetch($var)
{
$row = $var->fetchObject();
return $row;
}

function colfetch($var)
{
$row = $var->fetchAll(PDO::FETCH_ASSOC);
return $row;
}
function colcount($var)
{
$row = $var->columnCount();
return $row;
}



include_once("./functions.php");

?>