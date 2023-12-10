<?php
session_start();
error_reporting(0);
include("../../config/connection.php");

$CurrencyID = addslashes($_POST['CurrencyID']);
$CurrencyName = addslashes($_POST['CurrencyName']);
$CurrencyRate = addslashes($_POST['CurrencyRate']);

/// Double Check For Branch Name////
$myq2 = Run("Select count(CurrencyID) as tlo from ".dbObject."Currency where CurrencyName='".$CurrencyName."'");
if(myfetch($myq2)->tlo>0)
{
?>
<script>
document.getElementById('CurrencyName').focus();
document.getElementById('CurrencyName_error').innerHTML="* Name Already Exsists.";
document.getElementById('CurrencyName').style.border="1px Solid Red";
</script>
<?php
	die();
}
?>
<script>
document.getElementById('CurrencyName_error').innerHTML="";
document.getElementById('CurrencyName').style.border="1px Solid Green";
</script>

<?php
//////////// Insertion/////////////
$insertion = Run("Insert into ".dbObject."Currency (CurrencyID,CurrencyName,CurrencyRate) Values ('".$CurrencyID."','".$CurrencyName."','".$CurrencyRate."')");
?>

<script>
toastr.success('Currency Saved Successfully.');
document.getElementById('closed').click();
loadlisting();


</script>


