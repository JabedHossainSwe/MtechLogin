<?php
session_start();
error_reporting(0);
include("../../config/connection.php");
$cid = addslashes(trim($_POST['cid']));
$que = "Select custAreaId from " . dbObject . "CustFile where cid='" . $cid . "' ";
$getQ = myfetch(Run($que));
$custAreaId = $getQ->custAreaId;
?>

<script>
    $(document).ready(function() {
        $("#cus_area").val('<?= $custAreaId ?>');
    });
</script>