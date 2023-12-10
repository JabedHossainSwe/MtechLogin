<?php
session_start();
error_reporting(0);
include("../../config/connection.php");
$id = $_POST['id'];


$insertion = Run("delete from ".dbObject."Units where ParaID = '".$id."'");
?>

<script>
toastr.success('Unit Deleted Successfully.');
loadlisting();
</script>