<?php
session_start();
error_reporting(0);
include("../../config/connection.php");
$Bid = $_POST['Bid'];


$insertion = Run("update ".dbObject."Branch set Del='1' where Bid = '".$Bid."'");
?>

<script>
toastr.success('Branch Deleted Successfully.');
loadbranches();
</script>