<?php
session_start();
error_reporting(0);
include("../../config/connection.php");
$id = $_POST['id'];


$insertion = Run("update ".dbObject."Product set IsDeleted = '1' where PID = '".$id."'");
$insertion = Run("update ".dbObject."ProductPriceCode set IsDeleted = '1' where PID = '".$id."'");
$insertion = Run("update ".dbObject."OpenStock set IsDeleted = '1' where PID = '".$id."'");
?>

<script>
toastr.success('Product Deleted Successfully.');
location.reload();
</script>