<?php
session_start();
error_reporting(0);
include("../../config/connection.php");
include("../../config/main_connection.php");
// include("../../config/functions.php");
include("../../config/main_functions.php");
include("../../Lib/qrCode/qrlib.php");

// print_r($_POST);
// die();
$getLoginUserCompanyData = getLoginUserCompanyData($_SESSION['id']);



$Billno = addslashes(trim($_POST['bill_no']));
$Bid = addslashes(trim($_POST['Bid']));
$billDate = addslashes(trim($_POST['bill_date_time']));
$Comments = addslashes(trim($_POST['remarks']));
$f_total_int = addslashes(trim($_POST['f_total_int']));
$f_dis_per = addslashes(trim($_POST['f_dis_per']));
$f_dis_amt = addslashes(trim($_POST['f_dis_amt']));
$f_net_total = addslashes(trim($_POST['f_net_total']));
$totalVat = addslashes(trim($_POST['f_total_vat']));
$grandTotal = addslashes(trim($_POST['f_grand_total']));

$vatPTotal = $grandTotal;
$vatPTotal = !empty($vatPTotal) ? $vatPTotal : '0';

// new added

$RefNo = addslashes(trim($_POST['RefNo1']));
$RefNo = !empty($RefNo) ? $RefNo : '0';
$row_count = addslashes(trim($_POST['row_count']));
$PurDetail = '';



$FvatTotal  = 0;


$CSID = addslashes(trim($_POST['supplier_name']));
$CSID = !empty($CSID) ? $CSID : '0';

$sbid = "2";
$bQ = Run("Select * from " . dbObject . "Branch where Bid = '" . $Bid . "'");
$getBData = myfetch($bQ);
if ($getBData->ismain == '1') {
  $sbid = "1";
}

$counter = 1;
$autono = 1;


while ($counter <= $row_count) {
  $Pid = $_POST['Pid' . $counter];
  $Pid = !empty($Pid) ? $Pid : '0';

  $Uid = $_POST['unit' . $counter];
  $Uid = !empty($Uid) ? $Uid : '0';

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

  $SPrice = $_POST['SPrice' . $counter];
  $SPrice = !empty($SPrice) ? $SPrice : '0';

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

  $getCurrentEmpData = getCurrentEmpData($_SESSION['storeCode']);
  $EmpID = $getCurrentEmpData->Cid;
  $ResEmpID = $EmpID;


  if ($PCode != '0' && $PCode != '') {

    $delimeter = 'µ';
    $QtyInLowQty = "dbo.GetQtyInLow(" . $Uid . "," . $Qty . ")";
    $QtyInLowQty = !empty($QtyInLowQty) ? $QtyInLowQty : '';

    $currentRow = $CSID . "," . $Bid . "," . $Pid . "," . $Uid . "," . $Qty . "," . $QtyInLowQty . "," . $price . "," . $total . "," . $disAmt . "," . $net_total . "," . $altCode . "," . $EmpID . "," . $ResEmpID . "," . $vatPer . "," . $vatAmt . "," . $vattotal . "," . $vatPTotal . "," . $autono;
    // die();

    $PurDetail = $PurDetail . $delimeter . $currentRow;
    $autono++;
  }

  $counter++;
}

$PurDetail =  ltrim($PurDetail, $delimeter);

  $purchaseOrderSP = "EXECUTE ".dbObject."[UpdateDataInOrder]
  @Billno=$Billno
  ,@BillDate='".$billDate."'
  ,@Bid=$Bid
  ,@CSID=$CSID
  ,@Total=$f_total_int
  ,@Discount=$f_dis_amt
  ,@DiscountPer=$f_dis_per
  ,@NetTotal=$f_net_total
  ,@EmpID=$EmpID
  ,@ResEmpID=$ResEmpID
  ,@RefNo=$RefNo
  ,@Comments='".$Comments."'
  ,@PurDetail='" . $PurDetail . "'
  ,@totalVat=$totalVat
  ,@vatPTotal=$vatPTotal
  ,@sbid=$sbid
  ,@IsExpImp=0";

$execute = Run($purchaseOrderSP);
$InsertDataInWeb = myfetch($execute);

$SBBillno = $InsertDataInWeb->InsertedBillno;


if ($execute) { ?>
<script>
  $(document).ready(function() {

    toastr.success('Voucher Saved Successfully...');
    reloadVoucherAgainstBill('<?=$Bid?>','<?=$SBBillno?>');
      // location.reload();

  });
</script>
<?php }
?>