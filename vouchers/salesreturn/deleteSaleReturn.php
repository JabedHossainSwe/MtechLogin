<?php
session_start();
error_reporting(0);
include("../../config/connection.php");
// include("../../config/functions.php");
$Bid = addslashes(trim($_POST['Bid']));
$Billno = addslashes(trim($_POST['Billno']));
$sBid = addslashes(trim($_POST['sBid']));

$sbid = "2";
$bQ = Run("Select * from " . dbObject . "Branch where Bid = '".$Bid."'");
$getBData = myfetch($bQ);
if($getBData->ismain=='1')
{
	$sbid = "1";
}

$exe = "exec " . dbObject . "[DeleteSaleReturnWeb] @BillNo=$Billno, @Bid=$Bid, @sbid=$sBid, @IsExpImp=0, @GetBill=1";
$storeProcedure = Run($exe);

if ($storeProcedure) { ?>
    <script>
        toastr.success('Deleted Successfully...');
        location.reload();
    </script>
<?php } ?>