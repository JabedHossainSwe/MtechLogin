<?php
session_start();
error_reporting(0);
include("../../config/connection.php");
// include("../../config/functions.php");
$GId = addslashes($_POST['GId']);
$Code = addslashes($_POST['Code']);
$NameEng = addslashes($_POST['NameEng']);
$NameArb = addslashes($_POST['NameArb']);

if($NameArb=='')
{
	$NameArb=$NameEng;
}
$MainGid = addslashes($_POST['MainGid']);
$vatPer = addslashes($_POST['vatPer']);

$isVat = 0;
if($_POST['is_vat'] == "on"){
	$isVat = 1;	
}
$getCurrentEmpData = getCurrentEmpData($_SESSION['storeCode']);
$empid = $getCurrentEmpData->Cid;
$bid = $getCurrentEmpData->BID;

/// Double Check For Branch Name////
$myq2 = Run("Select count(GId) as tlo from ".dbObject."Expense where NameEng='".$NameEng."'");
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

$defCode = $GId."-S".$sbid."-M".$bid;

$vatPer = !empty($vatPer) ? $vatPer : 0;
//////////// Insertion/////////////
$insertion = Run("Insert into ".dbObject."Expense (GId,Code,NameEng,NameArb,bid,CodeOld,sbid,IsPublished,IsVat,vatPer,ispurchase) Values ('".$GId."','".$Code."','".$NameEng."','".$NameArb."','".$bid."','".$defCode."','".$sbid."','0','".$isVat."', '".$vatPer."', '0')");
?>

<script>
toastr.success('Group Saved Successfully.');
document.getElementById('closed').click();
loadlisting();


</script>


