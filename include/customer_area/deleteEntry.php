<?php
session_start();
error_reporting(0);
include("../../config/connection.php");
$id = $_POST['id'];


$insertion = Run("delete from ".dbObject."CustArea where GId = '".$id."'");
?>

<script>
toastr.success('Area Deleted Successfully.');
loadlisting();
</script>