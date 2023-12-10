<?php
session_start();
error_reporting(0);
include("../../config/connection.php");
// include("../../config/functions.php");
$vvl = $_POST['vvl'];

//echo "Select * from expense where GId = '".$vvl."'";
$qpt = Run("Select * from expense where GId = '".$vvl."'");
$getVat = myfetch($qpt);
 $isVat = $getVat->IsVat;
$vatPer = $getVat->vatPer;

$vat = "No";
if($isVat=="1")
{
	$vat = "Yes";
}
//$vatPer = '15';
?>

<script>
$(document).ready(function () {
document.getElementById('isVat').value = '<?php echo $vat; ?>';
document.getElementById('vatPer').value = '<?php echo $vatPer; ?>';
//document.getElementById('amount').value = '0';
//document.getElementById('vatAmount').value = '0';
$("#amount").attr("readonly", false); 
});
</script>


