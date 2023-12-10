<?php
session_start();
error_reporting(0);
include("../../config/connection.php");

$GId = addslashes($_POST['GId']);
$Code = addslashes($_POST['Code']);
$NameEng = addslashes($_POST['NameEng']);
$NameArb = addslashes($_POST['NameArb']);

/// Double Check For Branch Name////
$myq2 = Run("Select count(GId) as tlo from ".dbObject."CustArea where NameEng='".$NameEng."'");
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
$insertion = Run("Insert into ".dbObject."CustArea (GId,Code,NameEng,NameArb,dateAdd) Values ('".$GId."','".$Code."','".$NameEng."','".$NameArb."','".$dateAdd."')");
?>

<script>
toastr.success('Area Saved Successfully.');
document.getElementById('closed').click();
loadlisting();


</script>


