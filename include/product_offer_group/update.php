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
$bid = addslashes($_POST['branch']);

/// Double Check For Branch Name////
$myq2 = Run("Select count(GId) as tlo from ".dbObject."OfferProductGroup where NameEng='".$NameEng."' and Gid !='".$GId."'");
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
$getCurrentEmpData = getCurrentEmpData($_SESSION['storeCode']);
$empid = $getCurrentEmpData->Cid;
//////////// Insertion/////////////
$insertion = Run("Update ".dbObject."OfferProductGroup  set NameEng='".$NameEng."',NameArb='".$NameArb."',dateEdit='".$dateEdit."',MainGid='".$MainGid."',empIdEdit='".$empid."' where Gid = '".$GId."' ");
?>

<script>
toastr.success('Group Updated Successfully.');
document.getElementById('closed').click();
loadlisting();


</script>


