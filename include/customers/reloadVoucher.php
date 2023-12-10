<?php
session_start();
error_reporting(0);
include("../../config/connection.php");
$Bid = $_POST['Bid'];
$CCode = $_POST['CCode'];
$checkBill = Run("Select * from " . dbObject . "CustFile where bid=$Bid and Cid = $CCode and IsDeleted = 0");

if (myfetch($checkBill)->Cid == "") {
?>
    <script>
        $("#CCode").css("border", "2px solid red");
        toastr.error('Product Do Not Exists.');
    </script>
<?php
    die();
}

?>

<script>
    $("#CCode").css("border", "1px solid green");
    toastr.success('Loading Product...');
    editVoucher('<?= $Bid ?>', '<?= $CCode ?>');
</script>