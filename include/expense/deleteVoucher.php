<?php
session_start();
error_reporting(0);
include("../../config/connection.php");
$bid = $_POST['bid'];
$billno = $_POST['billno'];


$insertion = Run("update ".dbObject."ExpenseData set IsDeleted = '1' where Bid = '".$bid."' and ExpNo = '".$billno."'");
$deleteion = Run("update ".dbObject."ExpenseDataDetail set IsDeleted = '1' where Bid = '".$bid."' and ExpNo = '".$billno."'");

if($deleteion){ ?>
    <script>
    toastr.success('Expense Voucher Deleted Successfully.');
    location.reload();
    </script>

<?php }
?>
