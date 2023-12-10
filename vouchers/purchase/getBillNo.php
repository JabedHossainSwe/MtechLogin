<?php
session_start();
error_reporting(0);
include("../../config/connection.php");
$Bid = addslashes(trim($_POST['Bid']));


$QueryMax = Run("Select max(BillNo) as Bno from " . dbObject . "datain Where bid = '$Bid'");
$getBillNo = myfetch($QueryMax)->Bno + 1;

?>

<script>
	$(document).ready(function() {
		$("#bill_no").val(<?= $getBillNo ?>);
		$("#prv_billno").val(<?= $getBillNo - 1 ?>);
		// $(".fa-forward").prop('disabled', true);
	});
</script>