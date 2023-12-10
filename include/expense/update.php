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
	$NameArb = $NameEng;
}
$MainGid = addslashes($_POST['MainGid']);
$vatPer = addslashes($_POST['vatPer']);

$isVat = 0;
if($_POST['is_vat'] == "on"){
	$isVat = 1;	
}
$getCurrentEmpData = getCurrentEmpData($_SESSION['storeCode']);
$empid = $getCurrentEmpData->Cid;
/// Double Check For Branch Name////
$myq2 = Run("Select count(GId) as tlo from ".dbObject."Expense where NameEng='".$NameEng."' and GId !='".$GId."'");
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
$vatPer = !empty($vatPer) ? $vatPer : 0;

//////////// Insertion/////////////
$insertion = Run("Update ".dbObject."Expense set NameEng='".$NameEng."',NameArb='".$NameArb."',MainGid='".$MainGid."',IsVat = '".$isVat."',vatPer = '".$vatPer."' where GId = '".$GId."' ");
?>

<script>
toastr.success('Group Updated Successfully.');
document.getElementById('closed').click();
loadlisting();


</script>


