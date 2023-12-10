<?php
session_start();
error_reporting(0);
include("../../config/connection.php");
$id = $_POST['id'];


$insertion = Run("delete from ".dbObject."Sections where Cid = '".$id."'");
?>

<script>
toastr.success('Section Deleted Successfully.');
loadlisting();
</script>