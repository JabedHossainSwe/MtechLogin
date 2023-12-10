<?php
session_start();
error_reporting(0);
include("../../config/connection.php");
$code = addslashes(trim($_POST['code']));
$Bid = addslashes(trim($_POST['Bid']));
$Uid = addslashes(trim($_POST['Uid']));
$id = addslashes(trim($_POST['id']));

$sp = "EXECUTE " . dbObject . "GetProductSearchByCodeUnitWeb  @pCode='$code' ,@bid='$Bid',@uid='" . $Uid . "'";

$QueryMax = Run($sp);
$getDetails = myfetch($QueryMax);
$altCode = $getDetails->pBarcode;
$Price = $getDetails->CostPrice;
?>


<script>
    $(document).ready(function() {
        $("#Qty<?= $id ?>").val('1');
        $("#Price<?= $id ?>").val('<?= $Price ?>');
        $("#Total<?= $id ?>").val('<?= $Price ?>');
        $("#AltCode<?= $id ?>").val('<?= $altCode ?>');

        calculateTotQty();
        calculateTotal(<?= $id ?>);
    });
</script>