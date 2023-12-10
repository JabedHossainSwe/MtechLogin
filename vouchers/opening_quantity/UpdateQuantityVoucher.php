<?php
session_start();
error_reporting(0);
include("../../config/connection.php");
include("../../config/main_connection.php");
// include("../../config/functions.php");
include("../../config/main_functions.php");

$getLoginUserCompanyData = getLoginUserCompanyData($_SESSION['id']);
$Bid = addslashes(trim($_POST['Bid']));
$Billno = $_POST['bill_no'];
// die();
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

  $Sprice = $_POST['Sprice' . $counter];
  $Price = !empty($Sprice) ? $Sprice : '0';

  $oldQty = $_POST['oldQty' . $counter];
  $oldQty = !empty($oldQty) ? $oldQty : '0';

  $newQty = $_POST['newQty' . $counter];
  $newQty = !empty($newQty) ? $newQty : '0';

  $netTotal = $_POST['netTotal' . $counter];
  $netTotal = !empty($netTotal) ? $netTotal : '0';

  $Total = $Price * $qty;

  $QtyInLowQty = "dbo.GetQtyInLow(" . $Uid . "," . $newQty . ")";

  $QtyInLowQty = !empty($QtyInLowQty) ? $QtyInLowQty : '';

  if ($PCode != '0' && $PCode != '') {
    //// New Sp Values///

    $vvT = $vatPer * $qty;
    $vatPerTotal = $vatPerTotal + $vvt;

    $CCPS = $getDetails->PPrice;

    $delimeter = 'µ';

    $currentRow = $Bid . "," . $Pid . "," . $Uid . "," . $oldQty . "," . $newQty . "," . $Price . "," . $netTotal . "," . $QtyInLowQty . "," . $CCPS . "," . $EmpID . "," . $ResEmpID . "," . $autono;

    $SalDetail = $SalDetail . $delimeter . $currentRow;
    $autono++;
  }
  $counter++;
}

$SalDetail =  ltrim($SalDetail, $delimeter);

$openingSp = "EXECUTE  " . dbObject . "[UpdateOpenQuantityWeb]
@BillNo=$Billno
,@BillDate='$BillDate'
,@Bid=$Bid
,@NetTotal=$NetTotal
,@ResEmpID=$ResEmpID
,@Comments='" . $Comments . "'
,@PurDetail='$SalDetail'        
,@sbid=$sbid
,@IsExpImp=0";


$execute = Run($openingSp);
// $getData = myfetch($execute);


if ($execute) { ?>


  <script>
    location.reload();
  </script>
<?php }
?>