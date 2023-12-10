<?php
session_start();
error_reporting(0);
include("../../config/connection.php");
// include("../../config/functions.php");

$getCurrentEmpData = getCurrentEmpData($_SESSION['storeCode']);
$empid = $getCurrentEmpData->Cid;

$GId = addslashes($_POST['GId']);
$Code = addslashes($_POST['Code']);
$NameEng = addslashes($_POST['NameEng']);
$NameArb = addslashes($_POST['NameArb']);
if($NameArb=='')
{
	$NameArb = $NameEng;
}
$MainGid = addslashes($_POST['MainGid']);
$ParaValue = addslashes($_POST['ParaValue']);
if($MainGid=="")
{
$STP = "1";
}
else
{
	$STP ="2";
}

/// Double Check For Branch Name////
$myq2 = Run("Select count(ParaID) as tlo from ".dbObject."Units where ParaName='".$NameEng."' and ParaID !='".$GId."'");
if(myfetch($myq2)->tlo>0)
{
?>
<script>
document.getElementById('NameEng').focus();
document.getElementById('NameEng_error').innerHTML="* Name Already Exsists.";
document.getElementById('NameEng').style.border="1px Solid Red";
</script>
<?php
	die();
}
?>
<script>
document.getElementById('NameEng_error').innerHTML="";
document.getElementById('NameEng').style.border="1px Solid Green";
</script>

<?php
$dateEdit = date("Y-m-d H:i:s");
$defCode = $GId."-S".$bid."-M".$bid;

//////////// Insertion/////////////
if(empty($MainGid)){
	$qq = "Update ".dbObject."Units  set ParaName='".$NameEng."',ParaDescription='".$NameArb."',dateEdit='".$dateEdit."',ParentParaID=NULL ,ParaValue='".$ParaValue."',STP='".$STP."',empIdEdit='".$empid."' where ParaID = '".$GId."' ";
}
else{
	$qq = "Update ".dbObject."Units  set ParaName='".$NameEng."',ParaDescription='".$NameArb."',dateEdit='".$dateEdit."',ParentParaID='".$MainGid."' ,ParaValue='".$ParaValue."',STP='".$STP."',empIdEdit='".$empid."' where ParaID = '".$GId."' ";
}
$insertion = Run($qq);
?>

<script>
toastr.success('Unit Updated Successfully.');
document.getElementById('closed').click();
loadlisting();


</script>


