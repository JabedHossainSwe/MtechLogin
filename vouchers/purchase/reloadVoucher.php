<?php
session_start();
error_reporting(0);
include("../../config/connection.php");
$Bid = $_POST['Bid'];
$Billno = $_POST['Billno'];
// echo "Select * from " . dbObject . "DataOutReturn where Bid=$Bid and Billno = $Billno and IsDeleted = 0";
// die();
$checkBill = Run("Select * from " . dbObject . "DataIn where Bid=$Bid and Billno = $Billno and IsDeleted = 0");

// echo myfetch($checkBill)->Billno;
// die();
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