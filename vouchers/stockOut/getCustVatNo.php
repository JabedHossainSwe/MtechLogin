<?php
session_start();
error_reporting(0);
include("../../config/connection.php");
$customer_id = addslashes(trim($_POST['customer_id']));

$abx = "select VatNo from ".dbObject."CustFile where isdeleted=0 and Cid=$customer_id";
$NewSp = Run($abx);
$getV = myfetch($NewSp);
$VatNo = $getV->VatNo;
$VatNo = !empty($VatNo) ? $VatNo: '0';

?>
<script>
  $(document).ready(function() {
    $("#cVatNo").val('<?= $VatNo ?>');
  });
</script>