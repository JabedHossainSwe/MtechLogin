<?php
session_start();
error_reporting(0);
include("../../config/connection.php");
include("../../config/main_connection.php");
// include("../../config/functions.php");
include("../../config/main_functions.php");
// include("../../Lib/qrCode/qrlib.php");
// print_r($_POST);
// die();
$getLoginUserCompanyData = getLoginUserCompanyData($_SESSION['id']);
$Bid = addslashes(trim($_POST['Bid']));
// $CSID = addslashes(trim($_POST['customer_id']));
$SPType = addslashes(trim($_POST['SPType']));
// $posid = "1";

$Comments = $_POST['remarks'];
$Comments = !empty($Comments) ? $Comments : '';

$BillDate = addslashes(trim($_POST['bill_date_time']));

$NetTotal = addslashes(trim($_POST['total']));
$row_count = addslashes(trim($_POST['row_count']));
$counter = 1;
$autono = 1;
$SalDetail = '';

$getCurrentEmpData = getCurrentEmpData($_SESSION['storeCode']);
$EmpID = $getCurrentEmpData->Cid;
$ResEmpID = $getCurrentEmpData->Cid;

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


  $moreQty = $_POST['moreQty' . $counter];
  $moreQty = !empty($moreQty) ? $moreQty : '0';

  $lessQty = $_POST['lessQty' . $counter];
  $lessQty = !empty($lessQty) ? $lessQty : '0';

  $Sprice = $_POST['Sprice' . $counter];
  $Price = !empty($Sprice) ? $Sprice : '0';

  $compQty = $_POST['compQty' . $counter];
  $compQty = !empty($compQty) ? $compQty : '0';

  $phyQty = $_POST['phyQty' . $counter];
  $phyQty = !empty($phyQty) ? $phyQty : '0';

  $Total = $Price * $moreQty;
  $Discount = $Price * $lessQty;

  $QtyInLowQty = "dbo.GetQtyInLow(" . $Uid . "," . $moreQty . ")";
  $QtyInLowQty = !empty($QtyInLowQty) ? $QtyInLowQty : '';


  if ($PCode != '0' && $PCode != '') {
    //// New Sp Values///

    $vvT = $vatPer * $qty;
    $vatPerTotal = $vatPerTotal + $vvt;

    $productBalance = Run("GetSpProductBalanceTrnsWeb  @pid =$PCode, @bid =$Bid");
    $Pbalance = myfetch($productBalance);

    $CCPS = $getDetails->PPrice;
    $spriceDet = $getDetails->SPrice;
    $ppriceDet = $getDetails->level3;

    $qtyData = Run("[GetInventoryPlsMinsCal] @CompQty=$compQty,@PhyQty= $phyQty");
    $fetchQty = myfetch($qtyData);

    // die();
    $delimeter = 'µ';

    $currentRow = $Bid . "," . $Pid . "," . $Uid . "," . $compQty . "," . $phyQty . "," . $fetchQty->MoreQty . "," . $fetchQty->LessQty . "," . $Price . "," . $Total . "," . $Discount . "," . $NetTotal . "," . $QtyInLowQty . "," . $CCPS . "," . $Price . "," . $ppriceDet . "," . $EmpID . "," . $ResEmpID . "," . $autono;

    //  @PurDetail='bid,Pid,Uid,dbBalance(Computer Qty-Value of GetSpProductBalanceTrnsWeb),physBala (Physical Qty- User Input),
    //  Qty(More Qty Value of GetInventoryPlsMinsCal),Bonus (Less Qty Value of GetInventoryPlsMinsCal),
    //  Price,Total(More Qty * Price),Discount(Less Qty * Price),NetTotal(More+Less Qty),QtyInLowQty,CCPS(PPrice),spriceDet(sPrice),ppriceDet(level3),EmpID,ResEmpID,Autono'

    $SalDetail = $SalDetail . $delimeter . $currentRow;
    $autono++;
  }
  $counter++;
}

$SalDetail =  ltrim($SalDetail, $delimeter);


$inventorySp = "EXECUTE " . dbObject . "[InsertInventoryWeb]
@BillDate='$BillDate'
,@Bid=$Bid
,@Total=$NetTotal
,@NetTotal=$NetTotal
,@EmpID=$EmpID
,@ResEmpID=$EmpID
,@Comments='" . $Comments . "'
,@PurDetail='$SalDetail'
,@sbid=$sbid
,@IsExpImp=0";

// die();

$execute = Run($inventorySp);
// $getData = myfetch($execute);
// $SBBillno = $getData->InsertedBillno;


if ($execute) { ?>


  <script>
    location.reload();
  </script>
<?php }
?>