<?php
session_start();
error_reporting(0);
include("../../config/connection.php");
$bid = $_POST['bid'];
$sbid = $_POST['sbid'];
$billno = $_POST['billno'];

$insertion = Run("update " . dbObject . "Customeradvance set IsDeleted = 1 where billno = '".$billno."' and bid = '" . $bid . "' and sbid = '" . $sbid . "'");
?>

<script>
    toastr.success('Advance Deleted Successfully.');
    loadlisting();
</script>