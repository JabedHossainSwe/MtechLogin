<?php

$serverName = "DESKTOP-8COBBVN";
$dbUsername = "";
$dbPassword = "";
$dbName     = "Mtech";


try {
   $conn = new PDO("sqlsrv:Server=$serverName;Database=$dbName", $dbUsername, $dbPassword);
   $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
   die("Error connecting to SQL Server: " . $e->getMessage());
}
