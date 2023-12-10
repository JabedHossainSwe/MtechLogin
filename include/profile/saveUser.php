<?php
session_start();
error_reporting(0);
include("../../config/main_connection.php");
include("../../config/connection.php");
if($_POST)
{

$companyId = addslashes($_POST['id']);
$qst = RunMain("Select * from " . dbObjectMain . "Companies where id = '".$companyId."'");
$myq = myfetch($qst);
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
$qu = RunMain("Select count(id) as ttl from " . dbObjectMain . "Logins where email = '".$email."' ");
$CheckCount = myfetch($qu)->ttl;
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

$getId = RunMain("select max(id) as Idx from " . dbObjectMain . "Logins");
$idx = myfetchMain($getId)->Idx;
if($idx=='')
{
$idx = "1";
}
else
{
$idx = $idx+1;
}


$status = "1";
$isPaid = "1";
$isDeleted = "0";
$is_completed = "1";

$addedBy = "User";
$dateInsertion = date("Y-m-d h:i:s");
///////////// FIle Uploading/////////////


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
$logo = $site_name."/user_images/noimage.png";	
}


$isAdmin = 0;
$isLoggedIn = 0;
$ispublish = 0;


$insertion = "
INSERT INTO " . dbObjectMain . "Logins
(id ,code ,companyId ,companyCode,name,email,password,isAdmin,addedBy,isDeleted,img,status,dateInsertion,usertype,uiType,Type)
Values 
('".$idx."' ,'".$code."','".$companyId."','".$companyCode."' ,'".$name."','".$email."','".$password."' ,'".$isMaster."' ,'".$addedBy."','".$isDeleted."' ,'".$logo."','".$status."','".$dateInsertion."','".$usertype."','".$uiType."','".$Type."') ";

$insert = RunMain($insertion)	;


//send_registration_email($email,$company,$password);



$max = Run("select max(Cid) as maxCid,max(CCode) as maxC from Emp");
$getB = $max->fetchObject()	;
$Cid = 	$getB->maxCid+1;
$CCode = $getB->maxC+1;
if($CCode<100)
{
$CCode = "00".$CCode;
}
$isAdmin=0;
$isSuperVisor=0;
$isWorker=0;
$isLogedin=0;
$SectionId=$section;
$Qsbid = Run("exec SPGetSBid @Bid=".$branch);
$sbid = $Qsbid->fetchObject()->sbid;

$qv = "exec SPGetDefCode @MaxPlusOneId=$Cid,@Bid=$branch,@SBid=$sbid,@CurBid=$branch";
$Qdef = Run($qv);
$defCode = $Qdef->fetchObject()->DefCode;

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



$insq = "Insert Into Emp(Cid,CCode,CName,Description,DeptID,Pass,BID,FixedBranch,isAdmin,SectionId,userType,isDeleted,WebCode,uiType,email,isWeb,img,isSuperVisor,isWorker,sbid,mbid,defCode,isLogedin) Values ('".$Cid."','".$CCode."','".$name."','".$description."','".$department."','".$password."','".$branch."','".$isFixBranch."','".$isAdmin."','".$section."','".$usertype."','".$isDeleted."','".$code."','".$uiType."','".$email."','1','".$logo."','".$isSuperVisor."','".$isWorker."','".$sbid."','".$branch."','".$defCode."','".$isLogedin."')  ";	
$Insert = Run($insq);
$secondInsertion = "exec InsertExportDetWeb @FMBid=$branch,@FSBid=$sbid,@UValue=$Cid,@tbleName='EmpExportWeb',@sTyp=1";
$Insert = Run($secondInsertion);

}
?>
<script>
toastr.success('User Saved Successfully.');
document.getElementById('closed').click();
loadEmployees();


</script>