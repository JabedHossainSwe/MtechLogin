<?php
session_start();
error_reporting(0);
include("../../config/connection.php");
$id = $_POST['id'];


$insertion = Run("delete from ".dbObject."ProductType where Cid = '".$id."'");
?>

<script>
toastr.success('Type Deleted Successfully.');
loadlisting();
</script>