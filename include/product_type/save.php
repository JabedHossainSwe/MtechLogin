<?php
session_start();
error_reporting(0);
include("../../config/connection.php");
// include("../../config/functions.php");

$Cid = addslashes($_POST['Cid']);
$CCode = addslashes($_POST['CCode']);
$CName = addslashes($_POST['CName']);
$Description = addslashes($_POST['Description']);


if($Description=='')
{
	$Description = $CName;
}
$getCurrentEmpData = getCurrentEmpData($_SESSION['storeCode']);
$empid = $getCurrentEmpData->Cid;
$bid = $getCurrentEmpData->BID;
/// Double Check For Branch Name////
$myq2 = Run("Select count(Cid) as tlo from ".dbObject."ProductType where CName='".$CName."'");
if(myfetch($myq2)->tlo>0)
{
?>
<script>
document.getElementById('CName').focus();
document.getElementById('CName_error').innerHTML="* Name Already Exsists.";
document.getElementById('CName').style.border="1px Solid Red";
</script>
<?php
	die();
}
?>
<script>
document.getElementById('CName_error').innerHTML="";
document.getElementById('CName').style.border="1px Solid Green";
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
//////////// Insertion/////////////
$insertion = Run("Insert into ".dbObject."ProductType (Cid,CCode,CName,Description,bid,CodeOld,sbid,curMbid,dateAdd,empid) Values ('".$Cid."','".$CCode."','".$CName."','".$Description."','".$bid."','".$CCode."','".$sbid."','".$bid."','".$dateAdd."','".$empid."')");
?>

<script>
toastr.success('Type Saved Successfully.');
document.getElementById('closed').click();
loadlisting();


</script>


