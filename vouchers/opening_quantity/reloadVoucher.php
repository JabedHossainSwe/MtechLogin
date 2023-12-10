<?php
session_start();
error_reporting(0);
include("../../config/connection.php");
$Bid = $_POST['Bid'];
$Billno = $_POST['Billno'];
// echo "Select * from " . dbObject . "DataOut where Bid=$Bid and Billno = $Billno";
// die();
$checkBill = Run("Select * from " . dbObject . "OpeningQuantity where Bid=$Bid and BillNo = $Billno and IsDeleted = 0");

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