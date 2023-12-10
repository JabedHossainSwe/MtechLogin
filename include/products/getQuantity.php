<?php
session_start();
error_reporting(0);
include("../../config/connection.php");
$uid = $_POST['uid'];
if ($uid != '') {
	$qst = Run("Select * from units where ParaID = '" . $uid . "'");
	$mainPara = myfetch($qst);
	echo $mainPara->ParaValue;
}
?>