<?php
session_start();
error_reporting(0);
include("../../config/connection.php");
include("../../config/main_connection.php");
// include("../../config/functions.php");
include("../../config/main_functions.php");
$Bid = $_POST['Bid'];
$Billno = $_POST['Billno'];

$sBid = "2";
$bQ = Run("Select * from " . dbObject . "Branch where Bid = '" . $Bid . "'");
$getBData = myfetch($bQ);
if ($getBData->ismain == '1') {
    $sBid = "1";
}

$checkBill = Run("Exec " . dbObject . "SPInventolrySelectWeb
@SrchBy=1
,@Billno=$Billno
,@Bid=$Bid
,@sBid=$sBid
,@LanguageId=1
,@FRecNo=1
,@ToRecNo=100");

if (myfetch($checkBill)->BillNo == "") {
?>
    <script>
        $("#bill_no").css("border", "2px solid red");
        toastr.error('Bill No Not Exists.');
    </script>
<?php
    die();
}

?>

<script>
    $("#bill_no").css("border", "1px solid green");
    toastr.success('Loading Voucher...');
    editVoucher('<?= $Bid ?>', '<?= $Billno ?>');
</script>