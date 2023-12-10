<?php
session_start();
error_reporting(0);
include("../../config/connection.php");
$id = $_POST['id'];


$insertion = Run("delete from ".dbObject."OfferProductGroup where Gid = '".$id."'");
?>

<script>
toastr.success('Group Deleted Successfully.');
loadlisting();
</script>