<?php
session_start();
error_reporting(0);
include("../../config/connection.php");
$code = addslashes(trim($_POST['code']));
$Bid = addslashes(trim($_POST['Bid']));
$Uid = addslashes(trim($_POST['Uid']));

$region = $_SESSION['region'];
if($region=='1')
{
$sp = "EXECUTE ".dbObject."GetProductSearchByCodeUnitWeb  @pCode='$code' ,@bid='$Bid',@uid='".$Uid."'";
}
if($region=="2")
{
$sp = "EXECUTE ".dbObject."GetProductSearchByCodeUnitWeb  @pCode='$code' ,@bid='$Bid',@uid='".$Uid."'";
}
$QueryMax = Run($sp);
$getDetails = myfetch($QueryMax);
$Pid = $getDetails->pid;
$Uid = $getDetails->UID;
$PCode = $getDetails->pcode;
$pname = $getDetails->pname;
$ParaName = $getDetails->ParaName;
$SPrice = $getDetails->SPrice;
$vatSPrice = $getDetails->vatSPrice;
$level3 = $getDetails->level3;
$PPrice = $getDetails->PPrice;


?>


<script>
$( document ).ready(function() {
$("#Sprice").val('<?=$SPrice?>');
$("#Sprice").prop("readonly", false);
$("#qty").val('1');
$("#total").val('<?=$SPrice?>');
$("#netTotal").val('<?=$SPrice?>');

});
</script>

