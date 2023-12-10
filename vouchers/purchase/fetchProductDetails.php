<?php
session_start();
error_reporting(0);
include("../../config/connection.php");
$code = addslashes(trim($_POST['code']));
$Bid = addslashes(trim($_POST['Bid']));
$Uid = addslashes(trim($_POST['Uid']));

  $sp = "EXECUTE ".dbObject."GetProductSearchByCodeUnitWeb  @pCode='$code' ,@bid='$Bid',@uid='".$Uid."'";
$QueryMax = Run($sp);
$getDetails = myfetch($QueryMax);
$Pid = $getDetails->pid;
$Uid = $getDetails->UID;
$PCode = $getDetails->pcode;
$pname = $getDetails->pname;
$ParaName = $getDetails->ParaName;
$SPrice = $getDetails->SPrice;
$SPrice2 = $getDetails->SPrice;
//$PPrice = $getDetails->PPrice;
$total = $getDetails->PPrice;
$level3 = $getDetails->level3;
$PPrice = $level3;

//$PPrice = $getDetails->PPrice;
$IsVat = $getDetails->IsVat;
$vatPer = $getDetails->vatPer;
$vatAmt = $getDetails->vatAmt;
$cpp = $getDetails->PPrice;
$acp = $getDetails->PPrice;
$altCode = $getDetails->PBarcode;
$vatSprice = $getDetails->vatSPrice;
$CostPrice = $getDetails->CostPrice;
$LSPrice = $getDetails->level2;
$Lprice = $getDetails->level2;





if($IsVat=="1")
{
$SPrice = $PPrice;
$total = $total;
$vatAmt = $vatAmt;	



$NewSp = Run("Exec ".dbObject."GetVatValueFromSalPrice @vatPer=$vatPer,@SPrice=$SPrice");
$getV = myfetch($NewSp);
$vatAmt = round($getV->vatAmt,2);	
if($total==0)
{
$total = $getV->total;	
}


}

if($IsVat==0)
{
$total = $PPrice;
$vatAmt = 0;
$vatPer = 0;
}

$vatPTotal = $total + $vatAmt;

?>


<script>
// $( document ).ready(function() {
$("#price").val('<?=$PPrice?>');
$("#price").prop("readonly", false);
$("#total").val('<?=$total?>');
$("#total").prop("readonly", true);
$("#vatPer").val('<?=$vatPer?>');
$("#vatAmt").val('<?=$vatAmt?>');
$("#isVat").val('<?=$IsVat?>');
//$("#qty").val('1');
$("#cpp").val('<?=$cpp?>');
$("#acp").val('<?=$acp?>');
$("#lprice").val('<?=$Lprice?>');
$("#Pid").val('<?=$Pid?>');
$("#altCode").val('<?=$altCode?>');
$("#SPrice").val('<?=$SPrice2?>');
$("#vatSprice").val('<?=$vatSprice?>');
$("#CostPrice").val('<?=$CostPrice?>');
$("#LSPrice").val('<?=$LSPrice?>');
$("#grand_total").val('<?=$vatPTotal?>');

<?php
if($IsVat!=0)
{
?>

Pricecalculations('<?=$total?>','vatSprice');
<?php
}
?>
// });
</script>


