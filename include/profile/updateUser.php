<?php
session_start();
error_reporting(0);
include("../../config/main_connection.php");
include("../../config/connection.php");
if($_POST)
{
	$id = $_POST['id'];
	$qst = RunMain("Select * from ".dbObjectMain."Logins where id = '".$id."'");
$myqC = myfetchMain($qst);
 $companyId = $myqC->companyId;
 $img = $myqC->img;

$qst = RunMain("Select * from ".dbObjectMain."Companies where id = '".$companyId."'");
$myq = myfetchMain($qst);
$companyCode = (int)$myq->customer_id;
$code = addslashes($_POST['storeCode']);
$name = addslashes($_POST['name']);	
$email = strtolower(addslashes($_POST['email']));	
$password = addslashes($_POST['password']);	
$description = addslashes($_POST['description']);	
$branch = addslashes($_POST['branch']);	
$department = addslashes($_POST['department']);	
$section = addslashes($_POST['section']);	
$isFixBranch = addslashes($_POST['isFixBranch']);
if($isFixBranch=='')
{
$isFixBranch=0;
}
else
{
$isFixBranch=1;

}
	$usertype = implode(",",$_POST['usertype']);	
$uiType = implode(",",$_POST['uiType']);	
$Type = implode(",",$_POST['Type']);	
$isMaster = addslashes($_POST['isMaster']);	


	////////// Duplication Check/////////
$qu = RunMain("Select count(id) as ttl from ".dbObjectMain."Logins where email = '".$email."' and id!='".$id."' ");
$CheckCount = myfetchMain($qu)->ttl;
if($CheckCount>0)
{
?>	
<script>	
	
document.getElementById('email').focus();
document.getElementById('email_error').innerHTML="* Email Already Exists";
document.getElementById('email').style.border="1px Solid Red";
document.getElementById('email').focus();
</script>
<?php	
die();	
}
?>
<script>
document.getElementById('email_error').innerHTML="";
document.getElementById('email').style.border="1px Solid Green";
</script>
<?php

$idx = $id;


$status = "1";
$isPaid = "1";
$isDeleted = "0";
$is_completed = "1";


	
$isAdmin = 0;
$isLoggedIn = 0;
$ispublish = 0;
	
	
	
	
	$name_photo1=$_FILES['file']['name'];
$temp_photo1=$_FILES['file']['tmp_name'];
$req_uri = $_SERVER['REQUEST_URI'];
$path = substr($req_uri,0,strrpos($req_uri,'/'));
$explode = explode("/",$path);
$site_name = $explode[1];
$newname = $email.$name_photo1;
if(move_uploaded_file($temp_photo1,"../../user_images/".$newname))
{
$logo = $site_name."/user_images/".$newname;	
}
else
{
	$logo = $myqC->img;
}
	

	
	
	
$updation = "
update ".dbObjectMain."Logins set
name='".$name."',email='".$email."',password='".$password."',isAdmin='".$isMaster."',img='".$logo."',usertype='".$usertype."',uiType='".$uiType."',Type='".$Type."' where id = '".$id."'
";
$insert = RunMain($updation)	;
//send_registration_email($email,$company,$password);




	$isAdmin=0;
	$isSuperVisor=0;
	$isWorker=0;
	$isLogedin=0;
	$SectionId=$section;
$explode = explode(",",$Type);
if (in_array("isAdmin", $explode, TRUE))
{
$isAdmin=1;
}
if (in_array("isSuperVisor", $explode, TRUE))
{
$isSuperVisor=1;
}
if (in_array("isWorker", $explode, TRUE))
{
$isWorker=1;
}	
if (in_array("isAccountant", $explode, TRUE))
{
$isLogedin=1;
}
	
	 $update = "update Emp Set CName='".$name."',Description='".$description."',DeptID='".$department."',Pass='".$password."',BID='".$branch."',FixedBranch='".$isFixBranch."',isAdmin='".$isAdmin."',SectionId='".$section."',userType='".$usertype."',uiType='".$uiType."',email='".$email."',img='".$logo."',isSuperVisor='".$isSuperVisor."',isWorker='".$isWorker."',isLogedin='".$isLogedin."' where WebCode = '".$code."' ";
	
	
	
	
	
  
$Insert = Run($update);


}
?>
<script>
toastr.success('User Updated Successfully.');
document.getElementById('closed').click();
loadEmployees();


</script>