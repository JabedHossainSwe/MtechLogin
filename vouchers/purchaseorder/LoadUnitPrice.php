<?php
session_start();
error_reporting(0);
include("../../config/connection.php");
$code = addslashes(trim($_POST['code']));
$Bid = addslashes(trim($_POST['Bid']));
$Uid = addslashes(trim($_POST['Uid']));

// $region = $_SESSION['region'];
// if($region=='1')
// {
// $sp = "EXECUTE ".dbObject."GetProductSearchByCodeUnitWeb  @pCode='$code' ,@bid='$Bid',@uid='".$Uid."'";
// }
// if($region=="2")
// {
// $sp = "EXECUTE ".dbObject."GetProductSearchByCodeUnitWeb  @pCode='$code' ,@bid='$Bid',@uid='".$Uid."'";
// }
// $QueryMax = Run($sp);
// $getDetails = myfetch($QueryMax);
// $Pid = $getDetails->pid;
// $PCode = $getDetails->pcode;


//  $que = "Select ppc.uid, paraname from productpricecode ppc, units U, 
// product P where ppc.pid=p.pid and ppc.uid=u.paraid and ppc.bid='".$Bid."' and pcode='".$PCode."' and ppc.uid = '".$Uid."' ";
// $getQ = myfetch(Run($que));
//  $ParaName = $getQ->paraname;





// $pname = $getDetails->pname;
// $SPrice = $getDetails->SPrice;
// $vatSPrice = $getDetails->vatSPrice;
// $level3 = $getDetails->level3;
// $PPrice = $getDetails->PPrice;
// $IsVat = $getDetails->IsVat;
// $vatPer = $getDetails->vatPer;
// $vatAmt = $getDetails->vatAmt;











// if($IsVat=="1")
// {
// $SPrice = $SPrice;
// $vatSprice = $vatSPrice;
// $vatAmt = $vatAmt;	



// $NewSp = Run("Exec ".dbObject."GetVatValueFromSalPrice @vatPer=$vatPer,@SPrice=$SPrice");
// $getV = myfetch($NewSp);
// $vatAmt = round($getV->vatAmt,2);	
// if($vatSPrice==0)
// {
// $vatSprice = $getV->vatSprice;	
// }


// }

// if($IsVat==0)
// {
// $vatSprice = $SPrice;
// $vatAmt = 0;
// $vatPer = 0;
// }


?>


<script>
// $( document ).ready(function() {
// $("#Sprice").val('<?=$PPrice?>');
// // $("#unit").val('<?=$ParaName?>');
// $("#unit_name").val('<?=$ParaName?>');
// $("#Sprice").prop("readonly", false);
// $("#vatSprice").val('<?=$PPrice?>');
// $("#vatSprice").prop("readonly", true);
// $("#vatPer").val('<?=$vatPer?>');
// $("#vatAmt").val('<?=$vatAmt?>');
// $("#isVat").val('<?=$IsVat?>');
// $("#qty").val('1');

// <?php
// if($IsVat!=0)
// {
// ?>

// Pricecalculations('<?=$PPrice?>','Sprice')
// <?php
// }
// ?>

// });
</script>


<?php
$sp = "EXECUTE ".dbObject."GetProductSearchByCodeUnitWeb  @pCode='$code' ,@bid='$Bid',@uid='".$Uid."'";
$QueryMax = Run($sp);
$getDetails = myfetch($QueryMax);
$Pid = $getDetails->pid;
$Uid = $getDetails->UID;
$PCode = $getDetails->pcode;
$pname = $getDetails->pname;
$ParaName = $getDetails->ParaName;
$SPrice = $getDetails->SPrice;
$PPrice = $getDetails->PPrice;
$total = $getDetails->PPrice;
$level3 = $getDetails->level3;
$PPrice = $getDetails->PPrice;
$IsVat = $getDetails->IsVat;
$vatPer = $getDetails->vatPer;
$vatAmt = $getDetails->vatAmt;
$cpp = $getDetails->PPrice;
$acp = $getDetails->PPrice;
$altCode = $getDetails->PBarcode;
$vatSprice = $getDetails->vatSprice;
$CostPrice = $getDetails->CostPrice;
$LSPrice = $getDetails->LSPrice;


$qry = "select * from productpricecode where Pid = '$Pid' and Uid= '$Uid' and bid= '$Bid'";
$QueryLprice = Run($qry);
$getProductDetail = myfetch($QueryLprice);


$Lprice = $getProductDetail->LSPrice;



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


?>


<script>
// $( document ).ready(function() {
$("#price").val('<?=$PPrice?>');
$("#price").prop("readonly", false);
$("#total").val('<?=$total?>');
$("#total").prop("readonly", true);
$("#vatPer").val('<?=$vatPer?>');
$("#vatAmt").val('<?=$vatAmt?>');
$("#disPer").val(0);
$("#disAmt").val(0);
$("#isVat").val('<?=$IsVat?>');
$("#qty").val('1');
$("#cpp").val('<?=$cpp?>');
$("#acp").val('<?=$acp?>');
$("#lprice").val('<?=$Lprice?>');
$("#Pid").val('<?=$Pid?>');
$("#altCode").val('<?=$altCode?>');
$("#SPrice").val('<?=$SPrice?>');
$("#vatSprice").val('<?=$vatSprice?>');
$("#CostPrice").val('<?=$CostPrice?>');
$("#LSPrice").val('<?=$LSPrice?>');
$("#SCPer").val(0);

<?php
if($IsVat!=0)
{
?>

Pricecalculations('<?=$total?>','price')
<?php
}
?>

// });
</script>
