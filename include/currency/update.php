<?php
session_start();
error_reporting(0);
include("../../config/connection.php");

$CurrencyID = addslashes($_POST['CurrencyID']);
$CurrencyName = addslashes($_POST['CurrencyName']);
$CurrencyRate = addslashes($_POST['CurrencyRate']);
$DefaultCurrency = addslashes($_POST['DefaultCurrency']);



$myq2 = Run("Select count(CurrencyID) as tlo from ".dbObject."Currency where CurrencyName='".$CurrencyName."' and CurrencyID!='".$CurrencyID."'");

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
if($DefaultCurrency=='1')
{
$insertion = Run("Update ".dbObject."Currency  set DefaultCurrency='0' ");	
}
//////////// Insertion/////////////
$insertion = Run("Update ".dbObject."Currency  set CurrencyName='".$CurrencyName."',CurrencyRate='".$CurrencyRate."' ,DefaultCurrency='".$DefaultCurrency."' where CurrencyID = '".$CurrencyID."' ");
?>

<script>
toastr.success('Currency Updated Successfully.');
document.getElementById('closed').click();
loadlisting();


</script>


