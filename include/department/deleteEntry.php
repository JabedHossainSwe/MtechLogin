<?php
session_start();
error_reporting(0);
include("../../config/connection.php");
$id = $_POST['id'];


$insertion = Run("delete from ".dbObject."Dept where Cid = '".$id."'");
?>

<script>
toastr.success('Department Deleted Successfully.');
loadlisting();
</script>