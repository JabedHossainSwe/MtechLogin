<?php
session_start();
error_reporting(0);
include("../../config/connection.php");
// include("../../config/functions.php");

$getCurrentEmpData = getCurrentEmpData($_SESSION['storeCode']);
$empid = $getCurrentEmpData->Cid;
$bid = $getCurrentEmpData->BID;
$Gid = addslashes($_POST['GId']);
$Code = addslashes($_POST['Code']);
$NameEng = addslashes($_POST['NameEng']);

$NameArb = addslashes($_POST['NameArb']);
if($NameArb=='')
{
	$NameArb = $NameEng;
}
$MainGid = addslashes($_POST['MainGid']);

/// Double Check For Branch Name////
$myq2 = Run("Select count(GId) as tlo from ".dbObject."OfferProductGroup where NameEng='".$NameEng."'");
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
$sbid = "2";
$bQ = Run("Select * from " . dbObject . "Branch where Bid = '".$bid."'");
$getBData = myfetch($bQ);
if($getBData->ismain=='1')
{
	$sbid = "1";
}

$dateAdd = date("Y-m-d H:i:s");
$defCode = $Gid."-S".$sbid."-M".$bid;
//////////// Insertion/////////////
$insertion = Run("Insert into ".dbObject."OfferProductGroup (Gid,Code,NameEng,NameArb,dateAdd,bid,defCode,sbid,empid,MainGid) Values ('".$Gid."','".$Code."','".$NameEng."','".$NameArb."','".$dateAdd."','".$bid."','".$defCode."','".$sbid."','".$empid."','".$MainGid."')");
?>

<script>
toastr.success('Group Saved Successfully.');
document.getElementById('closed').click();
loadlisting();


</script>


