<?php
session_start();
error_reporting(0);
include("../../config/connection.php");
$Bid = addslashes($_POST['Bid']);
$BDescription = addslashes($_POST['BDescription']);
$BName = addslashes($_POST['BName']);
$StartInvoiceNo = addslashes($_POST['StartInvoiceNo']);
$ismain = addslashes($_POST['ismain']);


/// Double Check For Branch Name////
$myq2 = Run("Select count(BName) as tlo from ".dbObject."Branch where BName='".$BName."' and Bid != '".$Bid."'");
 $cnt = myfetch($myq2)->tlo;
if($cnt>0)
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

if($ismain=="1")
{
$myq2 = Run("Select * from ".dbObject."Branch where ismain=1 ");
  $getBid = myfetch($myq2)->Bid;
	if($getBid!=''  && $getBid != $Bid )
	{
		?>
<script>
document.getElementById('ismain').focus();
document.getElementById('ismain_error').innerHTML="* Master Branch Already Exists.";
document.getElementById('ismain').style.border="1px Solid Red";
</script>
<?php
		
		die();
	}
	
}
?>
<script>
document.getElementById('ismain_error').innerHTML="";
document.getElementById('ismain').style.border="Green";
</script>
<?php


//////////// Insertion/////////////
 $qs = "update ".dbObject."Branch set BName='".$BName."',Bdescription='".$BDescription."',StartInvoiceNo='".$StartInvoiceNo."',ismain='".$ismain."' where Bid = '".$Bid."'";
$insertion = Run($qs);
?>

<script>
toastr.success('Branch Updated Successfully.');
document.getElementById('closed').click();
loadbranches();


</script>

