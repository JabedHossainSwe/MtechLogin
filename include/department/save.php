<?php
session_start();
error_reporting(0);
include("../../config/connection.php");

$Cid = addslashes($_POST['Cid']);
$CCode = addslashes($_POST['CCode']);
$CName = addslashes($_POST['CName']);
$Description = addslashes($_POST['Description']);

/// Double Check For Branch Name////
$myq2 = Run("Select count(Cid) as tlo from ".dbObject."Dept where CName='".$CName."'");
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
//////////// Insertion/////////////
$insertion = Run("Insert into ".dbObject."Dept (Cid,CCode,CName,Description) Values ('".$Cid."','".$CCode."','".$CName."','".$Description."')");
?>

<script>
toastr.success('Department Saved Successfully.');
document.getElementById('closed').click();
loadlisting();


</script>


