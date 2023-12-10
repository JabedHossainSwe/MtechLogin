<?php
session_start();
error_reporting(0);
include("../../config/connection.php");
// include("../../config/functions.php");
include("../../config/main_connection.php");
include("../../config/main_functions.php");
include("../../Lib/qrCode/qrlib.php");

// print_r($_POST);
// die();
$BillDate = addslashes(trim($_POST['bill_date_time']));
$BillDate = !empty($BillDate) ? $BillDate : '0';

$CSID = addslashes(trim($_POST['customer_id']));
$CSID = !empty($CSID) ? $CSID : '0';

$Comments = addslashes(trim($_POST['remarks']));
$Comments = !empty($Comments) ? $Comments : '0';

$reference = addslashes(trim($_POST['reference']));
$reference = !empty($reference) ? $reference : '0';

$user = addslashes(trim($_POST['user']));
$user = !empty($user) ? $user : '0';

$SPFNo = addslashes(trim($_POST['SPFNo']));
$SPFNo = !empty($SPFNo) ? $SPFNo : '0';

$attention = addslashes(trim($_POST['attention']));
$attention = !empty($attention) ? $attention : '0';

$paymentTerms = addslashes(trim($_POST['paymentTerms']));
$paymentTerms = !empty($paymentTerms) ? $paymentTerms : '0';

$deliveryTime = addslashes(trim($_POST['deliveryTime']));
$deliveryTime = !empty($deliveryTime) ? $deliveryTime : '0';

$validity = addslashes(trim($_POST['validity']));
$validity = !empty($validity) ? $validity : '0';

$stockBr = addslashes(trim($_POST['stockBr']));
$stockBr = !empty($stockBr) ? $stockBr : '0';

$stockAll = addslashes(trim($_POST['stockAll']));
$stockAll = !empty($stockAll) ? $stockAll : '0';

$Bid = addslashes(trim($_POST['Bid']));
$Bid = !empty($Bid) ? $Bid : '0';

$row_count = addslashes(trim($_POST['row_count']));
$row_count = !empty($row_count) ? $row_count : '0';

$Total = addslashes(trim($_POST['total']));
$Total = !empty($Total) ? $Total : '0';

$disPer = addslashes(trim($_POST['disPer']));
$disPer = !empty($disPer) ? $disPer : '0';

$disAmt = addslashes(trim($_POST['disAmt']));
$disAmt = !empty($disAmt) ? $disAmt : '0';


$sbid = "2";
$bQ = Run("Select * from " . dbObject . "Branch where Bid = '" . $Bid . "'");
$getBData = myfetch($bQ);
if ($getBData->ismain == '1') {
  $sbid = "1";
}

$NetTotal = addslashes(trim($_POST['netTotal']));
$NetTotal = !empty($NetTotal) ? $NetTotal : '0';


$totVat = addslashes(trim($_POST['totVat']));
$totVat = !empty($totVat) ? $totVat : '0';

$vatPTotal = addslashes(trim($_POST['vatNetTotal']));
$vatPTotal = !empty($vatPTotal) ? $vatPTotal : '0';

$Bank1 = addslashes(trim($_POST['Bank1']));
$Bank1 = !empty($Bank1) ? $Bank1 : '0';

$BankName1 = addslashes(trim($_POST['BankName1']));
$BankName1 = !empty($BankName1) ? $BankName1 : '0';

$sal_amount1 = addslashes(trim($_POST['sal_amount1']));
$sal_amount1 = !empty($sal_amount1) ? $sal_amount1 : '0';

$Bank2 = addslashes(trim($_POST['Bank2']));
$Bank2 = !empty($Bank2) ? $Bank2 : '0';

$BankName2 = addslashes(trim($_POST['BankName2']));
$BankName2 = !empty($BankName2) ? $BankName2 : '0';

$sal_amount2 = addslashes(trim($_POST['sal_amount2']));
$sal_amount2 = !empty($sal_amount2) ? $sal_amount2 : '0';

$bankrows = addslashes(trim($_POST['bankrows']));
$bankrows = !empty($bankrows) ? $bankrows : '0';

$RefNo = addslashes(trim($_POST['reference']));
$RefNo = !empty($RefNo) ? $RefNo : '0';

$getCurrentEmpData = getCurrentEmpData($_SESSION['storeCode']);
$EmpID = $getCurrentEmpData->Cid;


$getLoginUserCompanyData = getLoginUserCompanyData($_SESSION['id']);

$counter = 1;
$autono = 1;
// $vatPerTotal = 0;
$SalDetail = '';


while ($counter <= $row_count) {
  $Pid = $_POST['Pid' . $counter];
  $Pid = !empty($Pid) ? $Pid : '0';

  $unit = $_POST['unit' . $counter];
  $unit = !empty($unit) ? $unit : '0';

  $code = $_POST['code' . $counter];
  $code = !empty($code) ? $code : '0';

  $Uid = $_POST['Uid' . $counter];
  $Uid = !empty($Uid) ? $Uid : '0';

  $PCode = $_POST['PCode' . $counter];
  $PCode = !empty($PCode) ? $PCode : '0';
  
  $getproduct = "select * from Productpricecode where Pid='$Pid' and Uid='$Uid' and bid='$Bid'";
  
  $Queryproduct = Run($getproduct);
  $product = myfetch($Queryproduct);
  
  
  $salPrice =$product->SPrice;
  $leastSPrice =$product->LSPrice;
  $purPrice =$product->PPrice;
  $costPrice =$product->CostPrice;

  $Bonus = 0;


  $qty = $_POST['qty' . $counter];
  $qty = !empty($qty) ? $qty : '0';

  $Sprice = $_POST['Sprice' . $counter];
  $Price = !empty($Sprice) ? $Sprice : '0';

  $vatAmt = $_POST['vatAmt' . $counter] / $qty;
  $vatAmt = !empty($vatAmt) ? $vatAmt : '0';

  $vatPer = $_POST['vatPer' . $counter];
  $vatPer = !empty($vatPer) ? $vatPer : '0';

  $vatSprice = $_POST['vatSprice' . $counter];
  $vatSprice = !empty($vatSprice) ? $vatSprice : '0';

  $QtyInLowQty = "dbo.GetQtyInLow(" . $Uid . "," . $qty . ")";

  $QtyInLowQty = !empty($QtyInLowQty) ? $QtyInLowQty : '';

  $vatTotal = $_POST['vatTotal' . $counter];
  $vatTotal = !empty($vatTotal) ? $vatTotal : '0';


  $onlyVat = 0;
  if ($vatAmt != '0') {
    $onlyVat = $vatSprice;
  }

  if ($PCode != '0' && $PCode != '') {
    $delimeter = 'µ';

    $currentRow = $CSID.",".$Bid.",".$Pid.",".$PCode.",".$Uid.",".$qty.",".$Bonus.",".$QtyInLowQty.",".$Price.",".$Total.",".$disAmt.",".$NetTotal.",".$EmpID.",".$EmpID.",".$vatPer.",".$vatAmt.",".$vatTotal.",".$vatPTotal.",".$salPrice.",".$leastSPrice.",".$purPrice.",".$costPrice.",".$autono;

    $SalDetail = $SalDetail . $delimeter . $currentRow;
    $autono++;
  }
  $counter++;
}

$SalDetail =  ltrim($SalDetail, $delimeter);

   $quotationSp = "EXECUTE ".dbObject."[InsertQuotation]
  @BillDate='".$BillDate."'
  ,@Bid=$Bid
  ,@CSID=$CSID
  ,@SPType=1
  ,@Total=$Total
  ,@Discount=$disAmt
  ,@DiscountPer='".$disPer."'
  ,@NetTotal=$NetTotal
  ,@EmpID=$EmpID
  ,@totalVat=$totVat
  ,@vatPTotal=$vatPTotal
  ,@RefNo='".$RefNo."'
  ,@Comments='".$Comments."'
  ,@spfNo='".$SPFNo."'
  ,@posid=1000
  ,@PurDetail='".$SalDetail."'
  ,@Attention=$attention
  ,@PaymentTerms=$paymentTerms
  ,@DeliveryPeriod='".$deliveryTime."'
  ,@Validity=$validity
  ,@sbid=$sbid
  ,@IsExpImp=0";

$execute = Run($quotationSp);
$getData = myfetch($execute);
$SBBillno = $getData->InsertedBillno;
?>


<script>
  $(document).ready(function() {
    <?php
    if ($getData->InsertedBillno != '') {
    ?>
    toastr.success('Voucher Saved Successfully...<?=$getData->InsertedBillno?>');
    reloadVoucherAgainstBill('<?=$Bid?>','<?=$SBBillno?>');
      // location.reload();
    <?php
    }
    ?>

  });
</script>