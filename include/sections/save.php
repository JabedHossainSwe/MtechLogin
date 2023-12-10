<?php
session_start();
error_reporting(0);
include("../../config/connection.php");
// include("../../config/functions.php");

$getCurrentEmpData = getCurrentEmpData($_SESSION['storeCode']);
$empid = $getCurrentEmpData->Cid;
$bid = $getCurrentEmpData->BID;
$Cid = addslashes($_POST['Cid']);
$CCode = addslashes($_POST['CCode']);
$CName = addslashes($_POST['CName']);
$Description = addslashes($_POST['Description']);
if($Description=='')
{
	$Description = $CName;
}
/// Double Check For Branch Name////
$myq2 = Run("Select count(Cid) as tlo from ".dbObject."Sections where CName='".$CName."'");
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
$dateAdd = date("Y-m-d H:i:s");
$sbid = "2";
$bQ = Run("Select * from " . dbObject . "Branch where Bid = '".$bid."'");
$getBData = myfetch($bQ);
if($getBData->ismain=='1')
{
	$sbid = "1";
}
//////////// Insertion/////////////
$insertion = Run("Insert into ".dbObject."Sections (Cid,CCode,CName,Description,bid,CodeOld,sbid,curMbid,dateAdd,empid) Values ('".$Cid."','".$CCode."','".$CName."','".$Description."','".$bid."','".$CCode."','".$sbid."','".$bid."','".$dateAdd."','".$empid."')");
?>

<script>
toastr.success('Section Saved Successfully.');
document.getElementById('closed').click();
loadlisting();


</script>


