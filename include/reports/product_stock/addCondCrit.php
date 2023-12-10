<?php
session_start();
error_reporting(0);
include("../../../config/functions.php");
$cond_typ = addslashes($_POST['cond_typ']);

$cond_op = addslashes($_POST['cond_op']);

$cond_val = addslashes($_POST['cond_val']);
 $conditionCriteria = addslashes($_POST['condCriteria']);

//unset($_SESSION['cnd']);
$newVal = $cond_typ.$cond_op.$cond_val;

if($conditionCriteria=='')
{
	$cnd = $newVal;
}

else
{
 $cnd = $conditionCriteria."µ".$cond_typ.$cond_op.$cond_val;
}


?>
<div class="row">
	<div class="col-12">
<textarea class="form-control" id="popCnd" name="popCnd" rows="7" cols="60" style="min-width: 100%">
<?=$cnd?></textarea>
</div></div>

