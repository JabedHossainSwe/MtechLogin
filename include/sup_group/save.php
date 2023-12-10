<?php
session_start();
error_reporting(0);
include("../../config/connection.php");

$GId = addslashes($_POST['GId']);
$Code = addslashes($_POST['Code']);
$NameEng = addslashes($_POST['NameEng']);
$NameArb = addslashes($_POST['NameArb']);
$MainGid = addslashes($_POST['MainGid']);
$bid = addslashes($_POST['branch']);

/// Double Check For Branch Name////
$myq2 = Run("Select count(GId) as tlo from ".dbObject."SupplierGroup where NameEng='".$NameEng."'");
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
//////////// Insertion/////////////

if(empty($MainGid)){
	$insertion = Run("Insert into ".dbObject."SupplierGroup (GId,Code,NameEng,NameArb,dateAdd,bid,MainGid) Values ('".$GId."','".$Code."','".$NameEng."','".$NameArb."','".$dateAdd."','".$bid."',NULL)");
}
else{
	$insertion = Run("Insert into ".dbObject."SupplierGroup (GId,Code,NameEng,NameArb,dateAdd,bid,MainGid) Values ('".$GId."','".$Code."','".$NameEng."','".$NameArb."','".$dateAdd."','".$bid."','".$MainGid."')");
}
?>

<script>
toastr.success('Group Saved Successfully.');
document.getElementById('closed').click();
loadlisting();


</script>


