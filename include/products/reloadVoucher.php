<?php
session_start();
error_reporting(0);
include("../../config/connection.php");
$Bid = $_POST['Bid'];
$PCode = $_POST['PCode'];
$checkBill = Run("Select * from " . dbObject . "product where bidM=$Bid and PID = $PCode and IsDeleted = 0");

if (myfetch($checkBill)->PID == "") {
?>
    <script>
        $("#bill_no").css("border", "2px solid red");
        toastr.error('Product Do Not Exists.');
    </script>
<?php
    die();
}

?>

<script>
    $("#bill_no").css("border", "1px solid green");
    toastr.success('Loading Product...');
    editVoucher('<?= $Bid ?>', '<?= $PCode ?>');
</script>