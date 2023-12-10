<?php
session_start();
error_reporting(0);
include("../../config/main_connection.php");

include("../../config/connection.php");
if(empty($_SESSION['id']))
{
printf("<script>location.href='index.php?value=logout'</script>");
die();
}
 $customer_code = $_SESSION['customer_code'];
$name = addslashes($_POST['name']);
 $qp = "Select * from " . dbObjectMain . "Logins where code = '" . $_SESSION['storeCode'] . "'";
$MainQ = RunMain($qp);
$myq = myfetchMain($MainQ);

	$img = $myq->img;
	if($_POST['file_upload']=='1')
	{
	$name_photo1=$_FILES['file']['name'];
$temp_photo1=$_FILES['file']['tmp_name'];

$newname = $_SESSION['storeCode'].$name_photo1;
if(move_uploaded_file($temp_photo1,"../../user_images/".$newname))
{
$img = "devMtech/user_images/".$newname;
}
	
}	

  $update = "update ".dbObjectMain."Logins set name = '".$name."',img = '".$img."' where code = '" . $_SESSION['storeCode'] . "'    " ;
$insert = RunMain($update)	;


$update2 = "update Emp set CName = '".$name."',img = '".$img."' where WebCode = '" . $_SESSION['storeCode'] . "'    " ;
$insert = Run($update2)	;




printf("<script>location.href='profile.php?value=general'</script>");
die();


?>
