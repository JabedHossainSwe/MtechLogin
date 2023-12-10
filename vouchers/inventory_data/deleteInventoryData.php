<?php
session_start();
error_reporting(0);
include("../../config/connection.php");
// include("../../config/functions.php");
$Bid = addslashes(trim($_POST['Bid']));
$Billno = addslashes(trim($_POST['Billno']));
$sBid = addslashes(trim($_POST['sBid']));

$exe = "exec " . dbObject . "[DeleteInventoryWeb] @BillNo=$Billno, @Bid=$Bid, @sbid=$sBid, @IsExpImp=0";
$storeProcedure = Run($exe);

if ($storeProcedure) { ?>
    <script>
        toastr.success('Deleted Successfully...');
        location.reload();
    </script>
<?php } ?>