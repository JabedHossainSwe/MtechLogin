<?php
session_start();
error_reporting(0);
include("../../config/connection.php");
// include("../../config/functions.php");
$Gid = addslashes($_POST['GId']);
$Code = addslashes($_POST['Code']);
$NameEng = addslashes($_POST['NameEng']);
$NameArb = addslashes($_POST['NameArb']);
if($NameArb=='')
{
	$NameArb=$NameEng;
}
$MainGid = addslashes($_POST['MainGid']);
$getCurrentEmpData = getCurrentEmpData($_SESSION['storeCode']);
$empid = $getCurrentEmpData->Cid;
$bid = $getCurrentEmpData->BID;

/// Double Check For Branch Name////
$myq2 = Run("Select count(GId) as tlo from ".dbObject."ProductGroup where NameEng='".$NameEng."'");
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
$dateAdd = date("Y-m-d H:i:s");

$sbid = "2";
$bQ = Run("Select * from " . dbObject . "Branch where Bid = '".$bid."'");
$getBData = myfetch($bQ);
if($getBData->ismain=='1')
{
	$sbid = "1";
}

$defCode = $Gid."-S".$sbid."-M".$bid;
//////////// Insertion/////////////

if(empty($MainGid)){
	$insertion = Run("Insert into ".dbObject."ProductGroup (Gid,Code,NameEng,NameArb,dateAdd,bid,defCode,sbid,empid,IsPublished,MainGid) Values ('".$Gid."','".$Code."','".$NameEng."','".$NameArb."','".$dateAdd."','".$bid."','".$defCode."','".$sbid."','".$empid."','0',NULL)");
}
else{
	$insertion = Run("Insert into ".dbObject."ProductGroup (Gid,Code,NameEng,NameArb,dateAdd,bid,defCode,sbid,empid,IsPublished,MainGid) Values ('".$Gid."','".$Code."','".$NameEng."','".$NameArb."','".$dateAdd."','".$bid."','".$defCode."','".$sbid."','".$empid."','0','".$MainGid."')");
}
?>
<script>
toastr.success('Group Saved Successfully.');
document.getElementById('closed').click();
loadlisting();


</script>


