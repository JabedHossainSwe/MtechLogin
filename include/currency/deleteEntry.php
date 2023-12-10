<?php
session_start();
error_reporting(0);
include("../../config/connection.php");
$id = $_POST['id'];


$insertion = Run("delete from ".dbObject."Currency where CurrencyID = '".$id."'");
?>

<script>
toastr.success('Currency Deleted Successfully.');
loadlisting();
</script>