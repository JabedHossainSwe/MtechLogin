<?php
session_start();
error_reporting(0);
include("../../config/connection.php");
include("../../config/main_connection.php");
include("../../config/main_functions.php");
// include("../../config/functions.php");
include("../../Lib/qrCode/qrlib.php");

$BillNo = addslashes(trim($_POST['bill_no']));


$getLoginUserCompanyData = getLoginUserCompanyData($_SESSION['id']);

$Bid = addslashes(trim($_POST['Bid']));
$CSID = addslashes(trim($_POST['customer_id']));
$CustomerName = getCustomerDetails($CSID)->CName;
$SPType = addslashes(trim($_POST['SPType']));
$posid = "1";
$RefNo1 = $_POST['RefNo1'];
$RefNo1 = !empty($RefNo1) ? $RefNo1: 'null';

$EmpID = $_POST['EmpID'];
$EmpID = !empty($EmpID) ? $EmpID: '0';

$bill_date_time = addslashes(trim($_POST['bill_date_time']));
$salesMan = addslashes(trim($_POST['salesMan']));
$salesMan = !empty($salesMan) ? $salesMan: '0';
$total = addslashes(trim($_POST['total']));
$TdisPer = addslashes(trim($_POST['fdisPer']));
$TdisAmt = addslashes(trim($_POST['fdisAmt']));
$FvatTotal = addslashes(trim($_POST['totVat']));
$TnetTotal = addslashes(trim($_POST['netTotal']));
$TtotVat = addslashes(trim($_POST['totVat']));
$TgrandTotal = addslashes(trim($_POST['grandTotal']));
//$Bank = addslashes(trim($_POST['Bank']));
$row_count = addslashes(trim($_POST['row_count']));
$sbBillno = addslashes(trim($_POST['sbBillno']));
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

$sbid = "2";
$bQ = Run("Select * from " . dbObject . "Branch where Bid = '".$Bid."'");
$getBData = myfetch($bQ);
if($getBData->ismain=='1')
{
	$sbid = "1";
}

// $delete = Run("exec " . dbObject . "[DeleteSaleWeb]@BillNo='".$BillNo."',@Bid='".$Bid."',@sbid='".$sbid."',@IsExpImp=0");




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
$sp = "EXECUTE ".dbObject."GetProductSearchByCode @pCode='$PCode' ,@bid='$Bid'";
}
if($region=="2")
{
$sp = "EXECUTE ".dbObject."Getproductsearchbycodeweb @pCode='$PCode' ,@bid='$Bid'";
}
$QueryMax = Run($sp);
$getDetails = myfetch($QueryMax);	



$qty = $_POST['qty'.$counter];	
$qty = !empty($qty) ? $qty: '0';

$Sprice = $getDetails->SPrice;	
$Sprice = !empty($Sprice) ? $Sprice: '0';
// $Total = $Price*$qty;
// $Discount = 0;

$Discount = $_POST['disAmt'.$counter];	
$Discount = !empty($Discount) ? $Discount: '0';

$Total = $_POST['total'.$counter];	
$Total = !empty($Total) ? $Total: '0';


$netT = $_POST['netT'.$counter];
$NetTotal = !empty($netT) ? $netT: '0';



$cpp = 	$getDetails->level3;
$cst = 	$getDetails->PPrice;
$CPrice = $getDetails->PPrice;
$CPrice = !empty($CPrice) ? $CPrice: '0';


$cpp = !empty($cpp) ? $cpp: '0';

$csp = $NetTotal-$cst;
$csp = !empty($csp) ? $csp: '0';

$QtyInLowQty = "dbo.GetQtyInLow(".$Uid.",".$qty.")";
$QtyInLowQty = !empty($QtyInLowQty) ? $QtyInLowQty: '';



$CSID = !empty($CSID) ? $CSID: 'null';

$ppriceDet = $getDetails->level3;
		$ppriceDet = !empty($ppriceDet) ? $ppriceDet: '0';

$spriceDet = $Sprice;
$spriceDet = !empty($spriceDet) ? $spriceDet: '0';


$vatAmt = $_POST['vatAmt'.$counter]/$qty;	
$vatAmt = !empty($vatAmt) ? $vatAmt: '0';

$vatPer = $_POST['vatPer'.$counter];	
$vatPer = !empty($vatPer) ? $vatPer: '0';
// $vatTotal = $vatAmt*$qty;

$vatTotal = $_POST['vatTotal'.$counter];	
$vatTotal = !empty($vatTotal) ? $vatTotal: '0';

// $vatPTotal = 	$NetTotal+$vatTotal;
$vatPTotal = $_POST['vatSprice'.$counter];	
$vatPTotal = !empty($vatPTotal) ? $vatPTotal: '0';

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
// $FvatTotal  = $FvatTotal +($vatTotal);
$TotalCost  = $TotalCost +($getDetails->PPrice*$qty);
$Price = $Sprice;
//if($vatAmt>0)
//{
//$Price = $vatSprice;
//}
// $Total = $Price*$qty;


$cpt = $CPrice*$qty;
$delimeter = 'µ';
	if($RefNo1)
	{
		$RefNo1 = "".$RefNo1."";
	}

		$ppc = ''.$PCode.'';
		$RefNofor = ''.$RefNo1.'';

$currentRow = $CSID.",''".$RefNofor."'',".$Pid.",".$Uid.",''".$ppc."'',".$qty.",".$QtyInLowQty.",".$Price.",".$Total.",".$Discount.",".$NetTotal.",".$vatPer.",".$vatAmt.",".$vatTotal.",".$vatPTotal.",".$VatPrice.",".$CPrice.",".$cpt.",".$ppriceDet.",".$spriceDet.",".$autono;	

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
 
$saleSp = "exec ".dbObject."InsertSaleReturnUpdateWeb
@BillNo = $BillNo
,@sbBillno = '".$sbBillno."'
,@Bid=$Bid
,@CSID=$CSID
,@SPType=$SPType
,@Total=$FTOtal
,@Discount=$TdisAmt
,@DiscountPer=$TdisPer
,@NetTotal=$TnetTotal
,@EmpID=$EmpID
,@totalCost=$TgrandTotal
,@totalVat=$FvatTotal
,@vatPTotal=$TgrandTotal
,@AvgVatPer=$AvgVatPer
,@NoVatDisTotal=$NoVatDisTotal
,@ToalAmtNoVat=$TotalAmtNoVat
,@VatDisTotal=$VatDisTotal
,@ToalAmtVatable=$ToalAmtVatable
,@RefNo='".$RefNo1."'
,@posid=$posid
,@SalDetail='".$SalDetail."'
,@SalPayment='".$salPayment."'
,@sbid='".$sbid."',@CustomerName='".$CustomerName."'
,@IsExpImp=0
,@GetBill =0
,@InvDTTime =0
,@Comments= ''";

$execute = Run($saleSp);
$getData = myfetch($execute);
$SBBillno = $getData->InsertedBillno;

// Include zetca
include("../../Lib/zetca/vendor/autoload.php");

use Salla\ZATCA\GenerateQrCode;
use Salla\ZATCA\Tags\InvoiceDate;
use Salla\ZATCA\Tags\InvoiceTaxAmount;
use Salla\ZATCA\Tags\InvoiceTotalAmount;
use Salla\ZATCA\Tags\Seller;
use Salla\ZATCA\Tags\TaxNumber;


//// Generate QR Code////
 $PNG_WEB_DIR = './QrCodes/';
 $PNG_TEMP_DIR = './QrCodes/';
//  $PNG_TEMP_DIR = '/QrCodes/';
    
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
$storeCode =$_SESSION['storeCode'];

$the_date = strtotime($bill_date_time);
date_default_timezone_set("UTC");
$date = date("Y-d-mTG:i:sz", $the_date);

// data:image/png;base64, .........
$displayQRCodeAsBase64 = GenerateQrCode::fromArray([
  new Seller($CustomerName), // seller name        
  new TaxNumber($vatno), // seller tax number
  new InvoiceDate($date), // invoice date as Zulu ISO8601 @see https://en.wikipedia.org/wiki/ISO_8601
  new InvoiceTotalAmount($TgrandTotal), // invoice total amount
  new InvoiceTaxAmount($FvatTotal) // invoice tax amount
  // TODO :: Support others tags
])->render();

function base64_to_jpeg($base64_string, $output_file) {
  // open the output file for writing
  $ifp = fopen( $output_file, 'wb' ); 

  // split the string on commas
  // $data[ 0 ] == "data:image/png;base64"
  // $data[ 1 ] == <actual base64 string>
  $data = explode( ',', $base64_string );

  // we could add validation here with ensuring count( $data ) > 1
  fwrite( $ifp, base64_decode( $data[ 1 ] ) );

  // clean up the file resource
  fclose( $ifp ); 

  return $output_file; 
}

$filename = $PNG_TEMP_DIR.'SalesReturn-'.$SBBillno.'-'.$Bid.'-'.$_SESSION['companyId'].'.png';
file_put_contents($filename, file_get_contents($displayQRCodeAsBase64));

$filename = $PNG_WEB_DIR.'SalesReturn-'.$SBBillno.'-'.$Bid.'-'.$_SESSION['companyId'].'.png';
file_put_contents($filename, file_get_contents($displayQRCodeAsBase64));

// $filename = $PNG_TEMP_DIR.'SaleReturn-'.$Billno-$storeCode.'.png';
// QRcode::png(($ddd), $filename, $errorCorrectionLevel, $matrixPointSize, 2); 

$PNG_TEMP_DIR = '../../../MtechMobile/includes/salesreturn/QrCodes/';
$filename = $PNG_TEMP_DIR.'SalesReturn-'.$SBBillno.'-'.$Bid.'-'.$_SESSION['companyId'].'.png';
file_put_contents($filename, file_get_contents($displayQRCodeAsBase64));

$PNG_WEB_DIR = '../../../MtechMobile/includes/salesreturn/QrCodes/';
$filename = $PNG_WEB_DIR.'SalesReturn-'.$SBBillno.'-'.$Bid.'-'.$_SESSION['companyId'].'.png';
file_put_contents($filename, file_get_contents($displayQRCodeAsBase64));

?>
<script>
$( document ).ready(function() {
<?php

?>
toastr.success('Voucher Updated Successfully...');

reloadVoucherAgainstBill('<?=$Bid?>','<?=$BillNo?>');
	
<?php

?>
});
</script>