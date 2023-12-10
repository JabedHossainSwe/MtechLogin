<?php
session_start();
error_reporting(0);
include("../../config/connection.php");
$Bid = addslashes($_POST['Bid']);
$BCode = addslashes($_POST['BCode']);
$BDescription = addslashes($_POST['BDescription']);
$BName = addslashes($_POST['BName']);
$StartInvoiceNo = addslashes($_POST['StartInvoiceNo']);

/// Double Check For Branch Name////
$myq2 = Run("Select count(BName) as tlo from ".dbObject."Branch where BName='".$BName."'");
if(myfetch($myq2)->tlo>0)
{
?>
<script>
document.getElementById('bname').focus();
document.getElementById('bname_error').innerHTML="* Branch Name Already Exsists.";
document.getElementById('bname').style.border="1px Solid Red";
</script>
<?php
	die();
}
?>
<script>
document.getElementById('bname_error').innerHTML="";
document.getElementById('bname').style.border="1px Solid Green";
</script>

<?php
//////////// Insertion/////////////
$insertion = Run("Insert into ".dbObject."Branch (Bid,BCode,BName,Bdescription,StartInvoiceNo,ismain) Values ('".$Bid."','".$BCode."','".$BName."','".$BDescription."','".$StartInvoiceNo."','0')");
?>

<script>
toastr.success('Branch Saved Successfully.');
document.getElementById('closed').click();
loadbranches();


</script>


