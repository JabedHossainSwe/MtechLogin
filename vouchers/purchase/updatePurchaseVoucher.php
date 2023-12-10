<?php
session_start();
error_reporting(0);
include("../../config/connection.php");
include("../../config/main_connection.php");
include("../../config/main_functions.php");
include("../../Lib/qrCode/qrlib.php");

// print_r($_POST);
// die();
$getLoginUserCompanyData = getLoginUserCompanyData($_SESSION['id']);



$Bid = addslashes(trim($_POST['Bid']));
$sbBillno = addslashes(trim($_POST['sbBillno']));
$billNo = addslashes(trim($_POST['bill_no']));
$billDate = addslashes(trim($_POST['bill_date_time']));
$Comments = addslashes(trim($_POST['remarks']));
$f_total_int = addslashes(trim($_POST['f_total_int']));
$f_dis_per = addslashes(trim($_POST['f_dis_per']));
$f_dis_amt = addslashes(trim($_POST['f_dis_amt']));
$f_net_total = addslashes(trim($_POST['f_net_total']));
$totalVat = addslashes(trim($_POST['totalVat']));
$grandTotal = addslashes(trim($_POST['f_grand_total']));
$f_expense = addslashes(trim($_POST['f_expense']));
$SPType = addslashes(trim($_POST['SPType']));
$purchase_id = addslashes(trim($_POST['purchase_id']));
// die();
$purchase_id = !empty($purchase_id) ? $purchase_id : '0';

$vatPTotal = $grandTotal;
$vatPTotal = !empty($vatPTotal) ? $vatPTotal : '0';

// new added
$purchaser = addslashes(trim($_POST['purchaser']));

$RefNo = addslashes(trim($_POST['RefNo1']));
$RefNo = !empty($RefNo) ? $RefNo : '0';

$poNo = addslashes(trim($_POST['poNo']));
$poNo = !empty($poNo) ? $poNo : '0';

$supplier_id = addslashes(trim($_POST['supplier_id']));
$dis_per = addslashes(trim($_POST['dis_per']));
$dis_per = !empty($dis_per) ? $dis_per : '0';

$due = addslashes(trim($_POST['due']));
$due = !empty($due) ? $due : '0';

$PurType = addslashes(trim($_POST['PurType']));
$PurType = !empty($PurType) ? $PurType : '0';



$s_rc_no = addslashes(trim($_POST['s_rc_no']));
$due_date = addslashes(trim($_POST['due_date']));
$due_date = addslashes(trim($_POST['due_date']));
$row_count = addslashes(trim($_POST['row_count']));
$PurDetail = '';
$vatPerTotal = 0;

$IsNoVat  = 0;
$IsFixedVat   = 0;
$FixedVatPer    = 15;
$RowTotal    = 0;
$ToalRowAmtVatable    = 0;
$ToalRowAmtNoVat    = 0;


$RowVatPriceTotal = 0;
$ToalRowAmtVatable  = 0;
$FTOtal  = 0;
$FvatTotal  = 0;
$TotalCost  = 0;
$Price = 0;
$Total = 0;


$CSID = addslashes(trim($_POST['supplier_name']));
$CSID = !empty($CSID) ? $CSID : '0';

$sbid = "2";
$bQ = Run("Select * from " . dbObject . "Branch where Bid = '" . $Bid . "'");
$getBData = myfetch($bQ);
if ($getBData->ismain == '1') {
  $sbid = "1";
}

$counter = 1;

while ($counter <= $row_count) {
  // Not Found
  $Pid = $_POST['Pid' . $counter];
  $Pid = !empty($Pid) ? $Pid : '0';

  // Not Found
  $Uid = $_POST['unit' . $counter];
  $Uid = !empty($Uid) ? $Uid : '0';

  ///////////////////////

  $PCode = $_POST['code' . $counter];
  $PCode = !empty($PCode) ? $PCode : '0';

  $product_name = $_POST['product_name' . $counter];
  $PCode = !empty($PCode) ? $PCode : '';

  $unit = $_POST['unit' . $counter];
  $unit = !empty($unit) ? $unit : '0';

  $Qty = $_POST['qty' . $counter];
  $Qty = !empty($Qty) ? $Qty : '0';

  $bonus = $_POST['bonus' . $counter];
  $bonus = !empty($bonus) ? $bonus : '0';

  $price = $_POST['price' . $counter];
  $price = !empty($price) ? $price : '0';

  $unit = $_POST['unit' . $counter];
  $unit = !empty($unit) ? $unit : '0';

  $total = $_POST['total' . $counter];
  $total = !empty($total) ? $total : '0';

  $disPer = $_POST['disPer' . $counter];
  $disPer = !empty($disPer) ? $disPer : '0';

  $disAmt = $_POST['disAmt' . $counter];
  $disAmt = !empty($disAmt) ? $disAmt : '0';

  $net_total = $_POST['net_total' . $counter];
  $net_total = !empty($net_total) ? $net_total : '0';

  $cpp = $_POST['cpp' . $counter];
  $cpp = !empty($cpp) ? $cpp : '0';

  $acp = $_POST['acp' . $counter];
  $acp = !empty($acp) ? $acp : '0';

  $SPrice = $_POST['SPrice' . $counter];
  $SPrice = !empty($SPrice) ? $SPrice : '0';

  $lprice = $_POST['lprice' . $counter];
  $lprice = !empty($lprice) ? $lprice : '0';

  $vatPer = $_POST['vatPer' . $counter];
  $vatPer = !empty($vatPer) ? $vatPer : '0';

  $vatAmt = $_POST['vatAmt' . $counter];
  $vatAmt = !empty($vatAmt) ? $vatAmt : '0';

  $vattotal = $_POST['vattotal' . $counter];
  $vattotal = !empty($vattotal) ? $vattotal : '0';

  $grand_total = $_POST['grand_total' . $counter];
  $grand_total = !empty($grand_total) ? $grand_total : '0';

  $altCode = $_POST['altCode' . $counter];
  $altCode = !empty($altCode) ? $altCode : '0';

  $actPrice = $_POST['actPrice' . $counter];
  $actPrice = !empty($actPrice) ? $actPrice : '0';

  $SCPer = $_POST['SCPer' . $counter];
  $SCPer = !empty($SCPer) ? $SCPer : '0';

  $EmpID = $_POST['EmpID' . $counter];
  $EmpID = !empty($EmpID) ? $EmpID : '0';

  $ResEmpID = $_POST['ResEmpID' . $counter];
  $ResEmpID = !empty($ResEmpID) ? $ResEmpID : '0';

  $CPrice = $_POST['CPrice' . $counter];
  $CPrice = !empty($CPrice) ? $CPrice : '0';

  $bonusQTyValue = $_POST['bonus' . $counter];
  $bonusQTyValue = !empty($bonusQTyValue) ? $bonusQTyValue : '0';

  $IsStockCount = $_POST['IsStockCount' . $counter];
  $IsStockCount = !empty($IsStockCount) ? $IsStockCount : '0';

  $vatSprice = $_POST['vatSprice' . $counter];
  $vatSprice = !empty($vatSprice) ? $vatSprice : '0';

  $CostPrice = $_POST['CostPrice' . $counter];
  $CostPrice = !empty($CostPrice) ? $CostPrice : '0';

  $LSPrice = $_POST['LSPrice' . $counter];
  $LSPrice = !empty($LSPrice) ? $LSPrice : '0';

  $onlyVat = 0;
  if ($vatAmt != '0') {
    $onlyVat = $vatSprice;
  }

  if ($PCode != '0' && $PCode != '') {

    $RowTotal  = $RowTotal + $grand_total; 
    if($vatAmt>0)
    {
      $vatPerTotal = $vatPerTotal + $vattotal; //ok
      $RowVatPriceTotal = $RowVatPriceTotal + $grand_total; //ok

      $ToalRowAmtVatable  = $ToalRowAmtVatable + $net_total;//ok
    }
    else{
      $ToalRowAmtNoVat  = $ToalRowAmtNoVat + $net_total;//ok
    }
    $Total = $Total + $net_total; //ok
    
    
    
    $TotalCost  = $TotalCost + ($acp * $Qty);
    // $FTOtal  = $FTOtal + ($net_total);
    $FvatTotal  = $FvatTotal + $vattotal;

    // die();

    $bonusQTyValue1 = $Qty+$bonusQTyValue;
    $delimeter = 'µ';
    $QtyInLowQty = "dbo.GetQtyInLow(" . $Uid . "," . $bonusQTyValue1 . ")";

    $QtyInLowQty = !empty($QtyInLowQty) ? $QtyInLowQty : '';

    $QtyInLowQtyBOnus = "dbo.GetQtyInLow(" . $Uid . "," . $bonusQTyValue . ")";

    $QtyInLowQtyBOnus = !empty($QtyInLowQtyBOnus) ? $QtyInLowQtyBOnus : '';

    $ppc = '' . $PCode . '';

    //$currentRow = $CSID . "," . $Bid . "," . $Pid . "," . $Uid . "," . $Qty . "," . $bonus . "," . $price . "," . $total . "," . $disPer . "," . $disAmt . "," . $net_total . ",(" . $cpp . "," . $actPrice . "," . $acp . "," . $altCode . "," . $SCPer . "," . $Sprice . "," . $vatSprice . "," . $CostPrice . ",dbo.GetQtyInLow($Uid,$Qty)," . $counter . ",dbo.GetQtyInLow($Uid,bonusQTyValue)," . $EmpID . "," . $ResEmpID . "," . $CPrice . "," . $IsStockCount . "," . $LSPrice . "," . $vatPer . "," . $vatPer . "," . $vattotal . "," . $vatPTotal . ")";


    $currentRow = $CSID . "," . $Bid . "," . $Pid . "," . $Uid . "," . $Qty . "," . $bonus . "," . $price . "," . $total . "," . $disPer . "," . $disAmt . "," . $net_total . "," . $cpp . "," . $actPrice . "," . $acp . "," . $altCode . "," . $SCPer . "," . $SPrice . "," . $vatSprice . "," . $CostPrice . "," . $QtyInLowQty . "," . $counter . "," .
      $QtyInLowQtyBOnus . "," . $EmpID . "," . $ResEmpID . "," . $CPrice . "," . $IsStockCount . "," . $LSPrice . "," . $vatPer . "," . $vatAmt . "," . $vattotal . "," . $vatPTotal;
    // die();

    $PurDetail = $PurDetail . $delimeter . $currentRow;
    $autono++;
  }

  $counter++;
}

$PurDetail =  ltrim($PurDetail, $delimeter);
// die();
// Convert to purchase

// echo $Total.",".$Price;


$storeProcedure = "exec " . dbObject . " [GetPurCal] @IsNoVat ='" . $IsNoVat . "',@IsFixedVat ='" . $IsFixedVat . "',@FixedVatPer ='" . $FixedVatPer . "',@vatPerTotal='" . $vatPerTotal . "',@RowVatPriceTotal='" . $RowVatPriceTotal . "',@RowTotal='" . $RowTotal . "',
@ToalRowAmtNoVat ='" . $ToalRowAmtNoVat . "',@ToalRowAmtVatable ='" . $ToalRowAmtVatable . "',@Total ='" . $Total . "',@TotalCost ='" . $TotalCost . "',@DisPer='" . $f_dis_per . "',@DisAmt ='" . $f_dis_amt . "'";

$query = Run($storeProcedure);
$getSpData = myfetch($query);

$GProfit = $getSpData->GProfit;
$GProfit = !empty($GProfit) ? $GProfit : '0';


$NProfit = $getSpData->NProfit;
$NProfit = !empty($NProfit) ? $NProfit : '0';

$NetTotal = $getSpData->NetTotal;
$NetTotal = !empty($NetTotal) ? $NetTotal : '0';


$totalVat = $getSpData->totalVat;
$totalVat = !empty($totalVat) ? $totalVat : '0';


$NoVatDisTotal = $getSpData->NoVatDisTotal;
$NoVatDisTotal = !empty($NoVatDisTotal) ? $NoVatDisTotal : '0';

$TotalAmtNoVat = $getSpData->ToalAmtNoVat;
$TotalAmtNoVat = !empty($TotalAmtNoVat) ? $TotalAmtNoVat : '0';

$VatDisTotal = $getSpData->VatDisTotal;
$VatDisTotal = !empty($VatDisTotal) ? $VatDisTotal : '0';

$ToalAmtVatable = $getSpData->ToalAmtVatable;
$ToalAmtVatable = !empty($ToalAmtVatable) ? $ToalAmtVatable : '0';

$AvgVatPer = $getSpData->AvgVatPer;
$AvgVatPer = !empty($AvgVatPer) ? $AvgVatPer : '0';


$purPayment = '';
if ($SPType == '1') {
  $bankrows = $_POST['bankrows'];
  $cnt = 1;
  $id = 1;
  $remAmount  = $grandTotal;
  while ($cnt < $bankrows) {
    $paytype = $_POST['Bank' . $cnt];
    $amount = $_POST['sal_amount' . $cnt];
    $payname = $_POST['BankName' . $cnt];

    $delimeter = 'µ';
    if ($paytype != '' && $amount > 0) {

      //$remAmount = $remAmount-$amount;
      // $remAmount = $amount;
      $remAmount = !empty($remAmount) ? $remAmount : '0';

      $currentRow = $id . "," . $paytype . "," . $amount . ",''" . $payname . "''," . $remAmount;
      $purPayment = $purPayment . $delimeter . $currentRow;
      $purPayment =  ltrim($purPayment, $delimeter);
      $id++;
    }
    $cnt++;
  }
}



$qry = "EXECUTE[dbo].[UpdateDataInWeb]	
  @BillNo= $billNo
  ,@BillDate='$billDate'
  ,@Bid=$Bid
  ,@CSID=$CSID
  ,@Pur_id=$purchase_id
  ,@SPType=$SPType
  ,@Total=$f_total_int
  ,@Discount=$f_dis_amt
  ,@DiscountPer=$f_dis_per
  ,@NetTotal=$f_net_total
  ,@EmpID=$EmpID
  ,@ResEmpID=$ResEmpID
  ,@RefNo=$RefNo
  ,@poNo=$poNo
  ,@Comments='$Comments'
  ,@PurType=$PurType
  ,@stkRecNo=null
  ,@totalexpense=$f_expense
  ,@PurDetail='" . $PurDetail . "'
  ,@PurPayment='" . $purPayment . "'
  ,@ExpDetail=null
  ,@ExpHead=null
  ,@UpdateProdPriceDetail=null
  ,@supDisPer=$dis_per
  ,@dueDays=$due
  ,@totalVat=$totalVat
  ,@vatPTotal=$vatPTotal
  ,@IsNoVat=$IsNoVat
  ,@AvgVatPer=$AvgVatPer
  ,@NoVatDisTotal=$NoVatDisTotal
  ,@ToalAmtNoVat=$TotalAmtNoVat
  ,@VatDisTotal=$VatDisTotal
  ,@ToalAmtVatable=$ToalAmtVatable
  ,@IsUpdatePrice=1
  ,@sbid=$sbid
  ,@IsExpImp=0
  ,@sbBillno='$sbBillno'
  ,@BiggerUnitPrc=null
  ";
$execute = Run($qry);
$InsertDataInWeb = myfetch($execute);

$SBBillno = $InsertDataInWeb->InsertedBillno;

//// Generate QR Code////
$PNG_WEB_DIR = './QrCodes/';
$PNG_TEMP_DIR = './QrCodes/';

//html PNG location prefix
$PNG_WEB_DIR = './QrCodes/';
$vatno = $getLoginUserCompanyData->vat;
$CustomerName = $getLoginUserCompanyData->name;
$ddd = "Invoice Number: " . $SBBillno . "
  Sellers Name:" . $CustomerName . "
  Vat No: " . $vatno . "
  Invoice Date & Time: " . date("Y-m-d H:i a", strtotime($billDate)) . " 
  Invoice Vat Total: " . $FvatTotal . "
  Invoice Total (with Vat): " . $grandTotal . "
  ";
if (!file_exists($PNG_TEMP_DIR))
  mkdir($PNG_TEMP_DIR);

$errorCorrectionLevel = 'H';
if (isset($_REQUEST['level']) && in_array($_REQUEST['level'], array('L', 'M', 'Q', 'H')))
  $errorCorrectionLevel = $_REQUEST['level'];

$matrixPointSize = 4;
if (isset($_REQUEST['size']))
  $matrixPointSize = min(max((int)$_REQUEST['size'], 1), 10);

$filename = $PNG_TEMP_DIR . 'Purchase-' . $SBBillno . '-' . $Bid . '-' . $_SESSION['companyId'] . '.png';
// QRcode::png(($ddd), $filename, $errorCorrectionLevel, $matrixPointSize, 2); 

QRcode::png(($ddd), $filename, $errorCorrectionLevel, $matrixPointSize, 2);



if ($execute) { ?>
  <script>
toastr.success('Voucher Updated Successfully...');

reloadVoucherAgainstBill('<?=$Bid?>','<?=$SBBillno?>');  </script>
<?php }
?>