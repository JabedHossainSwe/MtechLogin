<?php
session_start();
error_reporting(0);
include("../../config/connection.php");
$Bid = $_POST['Bid'];
$Billno = $_POST['Billno'];
$sBid = $_POST['sBid'];
$checkBill = Run("Select * from " . dbObject . "DataOut where Bid=$Bid and Billno = $Billno and sbid=$sBid and IsDeleted = 0");

if (myfetch($checkBill)->Billno == "") {
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
    editVoucher('<?= $Bid ?>', '<?= $Billno ?>', '<?= $sBid ?>');
</script>