<?php
session_start();
error_reporting(0);
include("../../config/connection.php");
$Bid = addslashes(trim($_POST['Bid']));
$IsFree = addslashes(trim($_POST['IsFree']));
$Pid = addslashes(trim($_POST['Pid']));
$uid = addslashes(trim($_POST['uid']));
$prc = addslashes(trim($_POST['prc']));
$NetTotal = addslashes(trim($_POST['NetTotal']));
$qty = addslashes(trim($_POST['qty']));
$qty = !empty($qty) ? $qty : '0';
$IsDisEffectOnCost = addslashes(trim($_POST['IsDisEffectOnCost']));
$prcDiscount = addslashes(trim($_POST['prcDiscount']));
$ExpenseTotal = addslashes(trim($_POST['ExpenseTotal']));
$InvTotalCost = addslashes(trim($_POST['InvTotalCost']));
$CurRCostTotal = addslashes(trim($_POST['CurRCostTotal']));
$InvDisPer = addslashes(trim($_POST['InvDisPer']));
$SavedQtyAtEditTime = addslashes(trim($_POST['SavedQtyAtEditTime']));


$sp = "EXECUTE " . dbObject . "[GetCostPrice]
@Bid=$Bid
,@IsFree=$IsFree
,@pid=$Pid
,@uid=$uid
,@prc=$prc
,@NetTot=$NetTotal
,@qty=$qty
,@IsDisEffectOnCost=$IsDisEffectOnCost
,@prcDiscount=$prcDiscount
,@ExpenseTotal=$ExpenseTotal
,@InvTotalCost=$InvTotalCost
,@CurRCostTotal=$CurRCostTotal
,@InvDisPer=$InvDisPer
,@SavedQtyAtEditTime=$SavedQtyAtEditTime";

$QueryMax = Run($sp);
$getDetails = myfetch($QueryMax);
$acp = $getDetails->AvgCost;
?>


<script>
    $(document).ready(function() {
        var acp = <?= $acp ?>;
        acp = acp.toFixed(2)
        $("#acp").val(acp);
    });
</script>