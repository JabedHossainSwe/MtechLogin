<?php
session_start();
error_reporting(0);
include("../../config/connection.php");
include("../../config/main_connection.php");
include("../../config/main_functions.php");
include("../../Lib/qrCode/qrlib.php");
// print_r($_POST);
// die();

$Bid = $_POST['Bid'];
$getLoginUserCompanyData = getLoginUserCompanyData($_SESSION['id']);

$CSID = addslashes(trim($_POST['customer_id']));
$SPType = addslashes(trim($_POST['SPType']));
$posid = "1";

$EmpID = $_POST['EmpID'];
$EmpID = !empty($EmpID) ? $EmpID : '0';

$bill_date_time = addslashes(trim($_POST['bill_date_time']));
$salesMan = addslashes(trim($_POST['salesMan']));
$salesMan = !empty($salesMan) ? $salesMan : '0';

$CustomerName = addslashes(trim($_POST['CustomerName']));
$CustomerName = !empty($CustomerName) ? $CustomerName : '';
$total = addslashes(trim($_POST['ftotal']));
$TdisPer = addslashes(trim($_POST['disPer']));
$TdisAmt = addslashes(trim($_POST['disAmt']));
$TnetTotal = addslashes(trim($_POST['fnetTotal']));
$Comments = addslashes(trim($_POST['remarks']));
$mobileNo = addslashes(trim($_POST['mobileNo']));
$faxNo = addslashes(trim($_POST['faxNo']));
$QuotNo = addslashes(trim($_POST['quoNo']));
$row_count = addslashes(trim($_POST['row_count']));
$counter = 1;
$autono = 1;
$SalDetail = '';

$sbid = "2";
$bQ = Run("Select * from " . dbObject . "Branch where Bid = '" . $Bid . "'");
$getBData = myfetch($bQ);
if ($getBData->ismain == '1') {
  $sbid = "1";
}

while ($counter <= $row_count) {
  $Pid = $_POST['Pid' . $counter];
  $Pid = !empty($Pid) ? $Pid : '0';
  $Uid = $_POST['Uid' . $counter];
  $Uid = !empty($Uid) ? $Uid : '0';

  $PCode = $_POST['PCode' . $counter];
  $PCode = !empty($PCode) ? $PCode : '0';

  $region = $_SESSION['region'];
  if ($region == '1') {
    $sp = "EXECUTE " . dbObject . "GetProductSearchByCodeUnitWebP  @pCode='$PCode' ,@bid='$Bid',@uid='$Uid'";
  }
  if ($region == "2") {
    $sp = "EXECUTE " . dbObject . "GetProductSearchByCodeUnitWeb @pCode='$PCode' ,@bid='$Bid',@uid='$Uid'";
  }

  $QueryMax = Run($sp);
  $getDetails = myfetch($QueryMax);

  $qty = $_POST['qty' . $counter];
  $qty = !empty($qty) ? $qty : '0';

  $Sprice = $_POST['Sprice' . $counter];
  $Price = !empty($Sprice) ? $Sprice : '0';

  $netT = $_POST['netT' . $counter];
  $NetTotal = !empty($netT) ? $netT : '0';

  $Total = $_POST['total' . $counter];
  $Total = !empty($Total) ? $Total : '0';

  $QtyInLowQty = "dbo.GetQtyInLow(" . $Uid . "," . $qty . ")";

  $QtyInLowQty = !empty($QtyInLowQty) ? $QtyInLowQty : '';

  $CPrice = $_POST['CPrice' . $counter];
  $CPrice = !empty($CPrice) ? $CPrice : '0';

  $CSID = !empty($CSID) ? $CSID : '0';
  $CPrice = !empty($CPrice) ? $CPrice : '0';

  $Bonus = 0;
  $Discount = 0;
  $IsStockCount = 0;
  $Colour = 'null';
  $Wieght_id = 'null';
  $model_Id = 'null';


  if ($PCode != '0' && $PCode != '') {

    $delimeter = 'µ';

    $currentRow = $CSID . "," . $Pid . "," . $Uid . "," . $PCode . "," . $qty . "," . $Bonus . "," . $QtyInLowQty . "," . $Price . "," . $Total. "," . $Discount. "," . $NetTotal. "," . $IsStockCount. "," . $Colour. "," . $Wieght_id. "," . $model_Id;

    // @SalDetail= CSID,Pid,Uid,PCode,qty,Bonus,QtyInLowQty,Price,Total,Discount,NetTotal,IsStockCount,Colour,Wieght_id,model_Id

    $SalDetail = $SalDetail . $delimeter . $currentRow;
    $autono++;
  }
  $counter++;
}

$SalDetail =  ltrim($SalDetail, $delimeter);
$salPayment = '';


$deliverySP = "EXECUTE " . dbObject . "[InsertDataDeliveryWeb]
@Bid=$Bid
,@CSID=$CSID
,@Total=$total
,@Discount=$TdisAmt
,@DiscountPer=$TdisPer
,@NetTotal=$TnetTotal
,@EmpID=$EmpID
,@RefNo=null
,@Comments='" . $Comments . "'
,@SalDetail='" . $SalDetail . "'
,@sbid='" . $sbid . "'
,@IsExpImp=0
,@cust_Area=0
,@drv_id=0
,@mobileno='" . $mobileNo . "'
,@faxNo='" . $faxNo . "'
,@QoutNo='" . $QuotNo . "'";
// die();

$execute = Run($deliverySP);
$getData = myfetch($execute);
$SBBillno = $getData->InsertedBillno;

if ($execute) { ?>


  <script>
    toastr.success('Voucher Saved Successfully...');
    location.reload();

    // reloadVoucherAgainstBill('<?= $Bid ?>', '<?= $SBBillno ?>');
  </script>
<?php }
?>