<?php
session_start();
error_reporting(0);
include("../../config/connection.php");
include("../../config/main_connection.php");
include("../../config/main_functions.php");
include("../../Lib/qrCode/qrlib.php");
$getLoginUserCompanyData = getLoginUserCompanyData($_SESSION['id']);
$Bid = addslashes(trim($_POST['Bid']));
$CSID = addslashes(trim($_POST['customer_id']));
$SPType = addslashes(trim($_POST['SPType']));
$posid = "1";
$RefNo1 = $_POST['RefNo1'];
$RefNo1 = !empty($RefNo1) ? $RefNo1: '0';

$EmpID = $_POST['EmpID'];
$EmpID = !empty($EmpID) ? $EmpID: '0';

$bill_date_time = addslashes(trim($_POST['bill_date_time']));
$salesMan = addslashes(trim($_POST['salesMan']));
$salesMan = !empty($salesMan) ? $salesMan: '0';

$CustomerName = addslashes(trim($_POST['CustomerName']));
$CustomerName = !empty($CustomerName) ? $CustomerName: '';
$total = addslashes(trim($_POST['total']));
$TdisPer = addslashes(trim($_POST['disPer']));
$TdisAmt = addslashes(trim($_POST['disAmt']));
$TnetTotal = addslashes(trim($_POST['netTotal']));
$TtotVat = addslashes(trim($_POST['totVat']));
$TgrandTotal = addslashes(trim($_POST['grandTotal']));
//$Bank = addslashes(trim($_POST['Bank']));
$row_count = addslashes(trim($_POST['row_count']));
$counter =1;
$autono =1;
$vatPerTotal = 0;
$SalDetail = '';




$IsNoVat  = 0;
$IsFixedVat   = 0;
$FixedVatPer    = 15;
$RowTotal    = 0;
$ToalRowAmtVatable    = 0;
$ToalRowAmtNoVat    = 0;




while($counter<=$row_count)
{
$Pid = $_POST['Pid'.$counter];	
$Pid = !empty($Pid) ? $Pid: '0';
$Uid = $_POST['Uid'.$counter];	
$Uid = !empty($Uid) ? $Uid: '0';

 $PCode = $_POST['PCode'.$counter];	
$PCode = !empty($PCode) ? $PCode: '0';

$region = $_SESSION['region'];
if($region=='1')
{
$sp = "EXECUTE ".dbObject."GetProductSearchByCodeUnitWebP  @pCode='$PCode' ,@bid='$Bid',@uid='$Uid'";
}
if($region=="2")
{
$sp = "EXECUTE ".dbObject."GetProductSearchByCodeUnitWeb @pCode='$PCode' ,@bid='$Bid',@uid='$Uid'";
}
	
$QueryMax = Run($sp);
$getDetails = myfetch($QueryMax);	



$qty = $_POST['qty'.$counter];	
$qty = !empty($qty) ? $qty: '0';

$Sprice = $_POST['Sprice'.$counter];	
$Price = !empty($Sprice) ? $Sprice: '0';

$Total = $Price*$qty;
$Discount = 0;



$netT = $_POST['netT'.$counter];
$NetTotal = !empty($netT) ? $netT: '0';



$cpp = 	$getDetails->level3;
$cst = 	$getDetails->PPrice;



$cst = !empty($cst) ? $cst: '0';
$cpp = !empty($cpp) ? $cpp: '0';

$csp = $NetTotal-$cst;
$csp = !empty($csp) ? $csp: '0';

 $QtyInLowQty = "dbo.GetQtyInLow(".$Uid.",".$qty.")";

	$QtyInLowQty = !empty($QtyInLowQty) ? $QtyInLowQty: '';

$CPrice = $_POST['CPrice'.$counter];	
$CPrice = !empty($CPrice) ? $CPrice: '0';

$CSID = !empty($CSID) ? $CSID: '0';
$CPrice = !empty($CPrice) ? $CPrice: '0';

$ppriceDet = $getDetails->level3;
	$ppriceDet = !empty($ppriceDet) ? $ppriceDet: '0';

$spriceDet = $Sprice;


$vatAmt = $_POST['vatAmt'.$counter]/$qty;	
$vatAmt = !empty($vatAmt) ? $vatAmt: '0';

$vatPer = $_POST['vatPer'.$counter];	
$vatPer = !empty($vatPer) ? $vatPer: '0';
$vatTotal = $vatAmt*$qty;

$vatPTotal = 	$NetTotal+$vatTotal;
$VatPrice = $vatamt+$Sprice;

$vatSprice = $_POST['vatSprice'.$counter];	
$vatSprice = !empty($vatSprice) ? $vatSprice: '0';	


$onlyVat = 0;
if($vatAmt!='0')
{
$onlyVat = $vatSprice;
}



if($PCode!='0' && $PCode!='')
{
//// New Sp Values///

$vvT = $vatPer*$qty;
$vatPerTotal = $vatPerTotal+$vvt;





$RowVatPriceTotal = $RowVatPriceTotal+($vatSprice*$qty);
$RowTotal  = $RowTotal +($vatSprice*$qty);
$ToalRowAmtNoVat  = $ToalRowAmtNoVat +($Sprice*$qty);
$ToalRowAmtVatable  = $ToalRowAmtVatable +($onlyVat*$qty);
$FTOtal  = $FTOtal +($NetTotal);
$FvatTotal  = $FvatTotal +($vatTotal);
$TotalCost  = $TotalCost +($getDetails->PPrice*$qty);
$Price = $Sprice;
//if($vatAmt>0)
//{
//$Price = $vatSprice;
//}
$Total = $Price*$qty;



$delimeter = 'µ';	
	
	$ppc = ''.$PCode.'';
	
 $currentRow = $Pid.",".$Uid.",''".$ppc."'',".$qty.",".$Price.",".$Total.",".$Discount.",".$NetTotal.",".$cpp.",".$cst.",".$csp.",".$QtyInLowQty.",".$CPrice.",".$CSID.",".$ppriceDet.",".$spriceDet.",".$vatPer.",".$vatAmt.",".$vatTotal.",".$vatPTotal.",".$VatPrice.",".$autono;

$SalDetail = $SalDetail.$delimeter.$currentRow;	
$autono++;
}
$counter++;
}

$SalDetail =  ltrim($SalDetail,$delimeter);
$salPayment = '';



 $storeProcedure = "exec ".dbObject."GetSalCal @IsNoVat ='".$IsNoVat."',@IsFixedVat ='".$IsFixedVat."',@FixedVatPer ='".$FixedVatPer."',@vatPerTotal='".$vatPerTotal."',@RowVatPriceTotal='".$RowVatPriceTotal."',@RowTotal='".$RowTotal."',	@ToalRowAmtNoVat ='".$ToalRowAmtNoVat."',@ToalRowAmtVatable ='".$ToalRowAmtVatable."',@Total ='".$total."',@TotalCost ='".$TotalCost."',@DisPer='".$TdisPer."',@DisAmt ='".$TdisAmt."'";
$query = Run($storeProcedure);
$getSpData = myfetch($query);


$GProfit = $getSpData->GProfit;
$GProfit = !empty($GProfit) ? $GProfit: '0';


$NProfit = $getSpData->NProfit;
$NProfit = !empty($NProfit) ? $NProfit: '0';

$NetTotal = $getSpData->NetTotal;
$NetTotal = !empty($NetTotal) ? $NetTotal: '0';


$totalVat = $getSpData->totalVat;
$totalVat = !empty($totalVat) ? $totalVat: '0';



$vatPtotal = $getSpData->vatPtotal;
$vatPtotal = !empty($vatPtotal) ? $vatPtotal: '0';



$NoVatDisTotal = $getSpData->NoVatDisTotal;
$NoVatDisTotal = !empty($NoVatDisTotal) ? $NoVatDisTotal: '0';

$TotalAmtNoVat = $getSpData->ToalAmtNoVat;
$TotalAmtNoVat = !empty($TotalAmtNoVat) ? $TotalAmtNoVat: '0';

$VatDisTotal = $getSpData->VatDisTotal;
$VatDisTotal = !empty($VatDisTotal) ? $VatDisTotal: '0';

$ToalAmtVatable = $getSpData->ToalAmtVatable;
$ToalAmtVatable = !empty($ToalAmtVatable) ? $ToalAmtVatable: '0';

$AvgVatPer = $getSpData->AvgVatPer;
$AvgVatPer = !empty($AvgVatPer) ? $AvgVatPer: '0';

$salPayment = '';
if($SPType=='1')
{
 $bankrows = $_POST['bankrows'];
$cnt = 1;
$id =1;
$remAmount  = $TgrandTotal;
while($cnt<$bankrows)
{
$paytype = $_POST['Bank'.$cnt];	
$amount = $_POST['sal_amount'.$cnt];	
$payname = $_POST['BankName'.$cnt];	

$delimeter = 'µ';		
if($paytype!='' && $amount>0)
{

//$remAmount = $remAmount-$amount;
	$remAmount = $amount;
$remAmount = !empty($remAmount) ? $remAmount: '0';	

$currentRow = $id.",".$paytype.",".$amount.",''".$payname."'',".$remAmount;	
$salPayment = $salPayment.$delimeter.$currentRow;		
$id++;	
}
$cnt++;
}
}
 $salPayment =  ltrim($salPayment,$delimeter);
$NetTotal = $FTOtal-$TdisAmt;
$FvatTotalv = ($FvatTotal*$TdisPer)/100;
$FvatTotal = $FvatTotal-$FvatTotalv;
  $saleSp = "exec ".dbObject."InsertSaleWeb
@Bid=$Bid
,@CSID=$CSID
,@SPType=$SPType
,@Total=$FTOtal
,@Discount=$TdisAmt
,@DiscountPer=$TdisPer
,@NetTotal=$NetTotal
,@EmpID=$EmpID
,@PaidAmount=$TgrandTotal
,@changeAmt=0
,@GProfit=$GProfit
,@NProfit=$NProfit
,@totalCost=$TgrandTotal
,@totalVat=$FvatTotal
,@vatPTotal=$TgrandTotal
,@AvgVatPer=$AvgVatPer
,@NoVatDisTotal=$NoVatDisTotal
,@ToalAmtNoVat=$TotalAmtNoVat
,@VatDisTotal=$VatDisTotal
,@ToalAmtVatable=$ToalAmtVatable
,@RefNo1='".$RefNo1."'
,@posid=$posid
,@SalDetail='".$SalDetail."'
,@SalPayment='".$salPayment."'
,@sbid=1,@CustomerName='".$CustomerName."'
,@IsExpImp=0
,@GetBill =0
,@GetNewBill =0
,@GetSBBillno =null
,@InvDTTime =0" ;

$execute = Run($saleSp);
$getData = myfetch($execute);
$SBBillno = $getData->InsertedBillno;






//// Generate QR Code////
 $PNG_WEB_DIR = './QrCodes/';
 $PNG_TEMP_DIR = './QrCodes/';
    
    //html PNG location prefix
    $PNG_WEB_DIR = './QrCodes/';
$vatno= $getLoginUserCompanyData->vat;
$CustomerName= $getLoginUserCompanyData->name;
$ddd = "Invoice Number: ".$SBBillno."
Sellers Name:".$CustomerName."
Vat No: ".$vatno."
Invoice Date & Time: ".date("Y-m-d H:i a",strtotime($bill_date_time))." 
Invoice Vat Total: ".$FvatTotal."
Invoice Total (with Vat): ".$TgrandTotal."
";
 if (!file_exists($PNG_TEMP_DIR))
        mkdir($PNG_TEMP_DIR);

$errorCorrectionLevel = 'H';
if (isset($_REQUEST['level']) && in_array($_REQUEST['level'], array('L','M','Q','H')))
$errorCorrectionLevel = $_REQUEST['level'];    

$matrixPointSize = 4;
if (isset($_REQUEST['size']))
$matrixPointSize = min(max((int)$_REQUEST['size'], 1), 10);

$filename = $PNG_TEMP_DIR.'Sale-'.$SBBillno.'-'.$Bid.'-'.$_SESSION['companyId'].'.png';
QRcode::png(($ddd), $filename, $errorCorrectionLevel, $matrixPointSize, 2); 

?>


<script>
$( document ).ready(function() {
<?php
if($getData->InsertedBillno!='')
{
?>
location.reload();
<?php
}
?>

});

</script>