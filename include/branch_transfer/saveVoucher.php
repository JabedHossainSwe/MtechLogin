<?php
session_start();
error_reporting(0);
include("../../config/connection.php");
// include("../../config/functions.php");
// print_r($_POST);
// print_r($_SESSION);
// die();  
$bill_no = addslashes(trim($_POST['bill_no']));
$BillDate = addslashes(trim($_POST['bill_date_time']));
$RefNo1 = addslashes(trim($_POST['RefNo1']));
$RefNo1 = !empty($RefNo1) ? $RefNo1 : '0';

$CSID = addslashes(trim($_POST['Bid']));
$EmpID = addslashes(trim($_POST['EmpID']));
$remarks = addslashes(trim($_POST['remarks']));
$nrows = addslashes(trim($_POST['nrows']));
$f_total = 0;
$trnsPriceType = addslashes(trim($_POST['trnsPriceType']));
$getCurrentEmpData = getCurrentEmpData($_SESSION['storeCode']);
// $empid = $getCurrentEmpData->Cid;
$Bid = $getCurrentEmpData->BID;

$purInvNo = addslashes(trim($_POST['purInvNo']));
$purInvNo = !empty($purInvNo) ? $purInvNo : 'null';

$sbid = "2";
$bQ = Run("Select * from " . dbObject . "Branch where Bid = '" . $Bid . "'");
$getBData = myfetch($bQ);
if ($getBData->ismain == '1') {
    $sbid = "1";
}

$query = Run("Select * from " . dbObject . "SupplierFile where Cid = '" . $CustomerID . "'");
$query = Run("EXECUTE " . dbObject . "[GetBrnTrnsPrcType]  @lngID=2");
$CustomerName = myfetch($query)->CName;

$SalDetail = '';


$counter = 1;
while ($counter <= $nrows) {
    $Pcode = $_POST['Pcode' . $counter];
    $Pcode = !empty($Pcode) ? $Pcode : '0';

    $Uid = $_POST['Uid' . $counter];
    $Uid = !empty($Uid) ? $Uid : '0';

    $Qty = $_POST['Qty' . $counter];
    $Qty = !empty($Qty) ? $Qty : '0';

    $Pid = $_POST['Pid' . $counter];
    $Pid = !empty($Pid) ? $Pid : '0';

    $Price = $_POST['Price' . $counter];
    $Price = !empty($Price) ? $Price : '0';

    $Sprice = $_POST['Sprice' . $counter];
    $Sprice = !empty($Sprice) ? $Sprice : '0';

    $Total = $_POST['Total' . $counter];
    $Total = !empty($Total) ? $Total : '0';

    $AltCode = $_POST['AltCode' . $counter];
    $AltCode = !empty($AltCode) ? $AltCode : '0';

    $vatSprice = $_POST['vatSprice' . $counter];
    $vatSprice = !empty($vatSprice) ? $vatSprice : '0';

    $LeastSPrice = $_POST['LeastSPrice' . $counter];
    $LeastSPrice = !empty($LeastSPrice) ? $LeastSPrice : '0';

    $counter++;

    $QtyInLowQty = "".dbObject."GetQtyInLow(" . $Uid . "," . $Qty . ")";

    $QtyInLowQty = !empty($QtyInLowQty) ? $QtyInLowQty : '';

    $delimeter = 'µ';

    $ppc = '' . $PCode . '';

    $currentRow = "$CSID,$Bid,$Pid,$Uid,$Pcode,$Qty,$Price,$Total,$Total,$QtyInLowQty,$EmpID,$EmpID,$counter,$Price,$Price,$Sprice,Null,null,null,null,null,$AltCode,null,$trnsPriceType,$vatSprice,$LeastSPrice";
$f_total = $f_total+$Total;

    $SalDetail = $SalDetail . $delimeter . $currentRow;
}

$SalDetail =  ltrim($SalDetail,$delimeter);

 $transferSp = "EXECUTE [dbo].[InsertBranchTransferWeb]
@BillDate='$BillDate'
,@Bid=$Bid
,@CSID=$CSID
,@Total=$f_total
,@NetTotal=$f_total
,@EmpID=$EmpID
,@SalDetail='$SalDetail'
,@RefNo='".$RefNo1."'
,@Comments='".$remarks."'
,@purInvNo=$purInvNo
,@ExpiryDet=null
,@trnsPriceType=1
,@sbid=$sbid
,@IsExpImp=0";

$execute = Run($transferSp);
?>

<script>
    toastr.success('Issue Payment Saved Successfully.');
    location.reload();
</script>