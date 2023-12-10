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
 $email = $_SESSION['email'];

$qu = RunMain("Select * from ".dbObjectMain."Companies where id = '" . $_SESSION['companyId'] . "'");



$cname = addslashes($_POST['cname']);	
$mobile = addslashes($_POST['mobile']);	
$phone = addslashes($_POST['phone']);	
$address = addslashes($_POST['address']);	
$vat = addslashes($_POST['vat']);

$cname_ar = addslashes($_POST['cname_ar']);
$mobile_ar = addslashes($_POST['mobile_ar']);
$phone_ar = addslashes($_POST['phone_ar']);
$address_ar = addslashes($_POST['address_ar']);
$vat_ar = addslashes($_POST['vat_ar']);


$myq2 = RunMain("Select * from ".dbObjectMain."Companies where id = '" . $_SESSION['companyId'] . "'");

$myq = myfetchMain($myq2);
	$logo = $myq->logo;
	if($_POST['file_upload']=='1')
	{
	$name_photo1=$_FILES['logo']['name'];
$temp_photo1=$_FILES['logo']['tmp_name'];

$newname = rand().$_SESSION['companyId'].$name_photo1;
		$newname=trim($newname);
if(move_uploaded_file($temp_photo1,"../../user_images/".$newname))
{
$logo = "Mtech/user_images/".$newname;
}
	
}

 $jj = "update ".dbObjectMain."Companies set mobile='".$mobile."',name='".$cname."',phone='".$phone."',address='".$address."',vat='".$vat."',mobile_ar='".$mobile_ar."',name_ar='".$cname_ar."',phone_ar='".$phone_ar."',address_ar='".$address_ar."',vat_ar='".$vat_ar."',logo='".$logo."',is_completed='1'  where id = '" . $_SESSION['companyId'] . "'";
$update = RunMain($jj);
		$_SESSION['is_completed']="1";
$_SESSION['name'] = $cname;
$_SESSION['name_ar']=$cname_ar;



  
//$insert = Run($update)	;
	printf("<script>location.href='profile.php?value=company'</script>");
die();


?>
