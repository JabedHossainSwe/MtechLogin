<?php
session_start();
error_reporting(0);
include("../../config/connection.php");
$code = addslashes(trim($_POST['code']));

$query = Run("Select * from ".dbObject."Expense where GId = '".$code."'");
$fetch = myfetch($query);
$NameEng = $fetch->NameEng;


$expense = addslashes($_POST['expense']);
$amount = addslashes($_POST['amount']);
$vatAmount = addslashes($_POST['vatAmount']);
$vatPer = addslashes($_POST['vatPer']);
$bnkid = addslashes($_POST['bnkid']);

$bnQ = Run("Select * from bank where id = '".$bnkid."'");
$bnkName = myfetch($bnQ)->NameEng;

$isVat = addslashes($_POST['isVat']);


$row_count = addslashes($_POST['row_count']);
?>

<tr id="row_<?php echo $row_count ?>">
<td><?=$row_count?></td>
<td><input type="hidden" name="code<?php echo $row_count ?>" id="code<?php echo $row_count ?>" value="<?php echo $code ?>"><?php echo $code ?></td>
<td>
<input type="hidden" name="expense<?php echo $row_count ?>" id="expense<?php echo $row_count ?>" value="<?php echo $NameEng ?>">

<?php echo $NameEng ?></td>
<td>
<input type="hidden" name="amount<?php echo $row_count ?>" class="t_amount" id="amount<?php echo $row_count ?>" value="<?php echo $amount ?>">
<?php echo $amount ?></td>
<td>
<input type="hidden" name="vatAmount<?php echo $row_count ?>" class="t_vatAmt" id="vatAmount<?php echo $row_count ?>" value="<?php echo $vatAmount ?>">
<?php echo $vatAmount ?></td>
<td>
<input type="hidden" name="bnkid<?php echo $row_count ?>" class="" id="bnkid<?php echo $row_count ?>" value="<?php echo $bnkid ?>">
<input type="hidden" name="bnkName<?php echo $row_count ?>" class="" id="bnkName<?php echo $row_count ?>" value="<?php echo $bnkName ?>">

<?php echo $bnkName ?></td>
<td><input type="hidden" name="isVat<?php echo $row_count ?>" class="" id="isVat<?php echo $row_count ?>" value="<?php echo $isVat ?>"><input type="hidden" name="vatPer<?php echo $row_count ?>" class="t_vatPer" id="vatPer<?php echo $row_count ?>" value="<?php echo $vatPer ?>">
<?=$isVat?>
</td>
<td><i class="fa fa-pencil" onclick="edit_row(<?php echo $row_count ?>)"></i>&nbsp;&nbsp;&nbsp;<i class="fa fa-trash" onclick="delete_row(<?php echo $row_count ?>)"></i></td>
	<script>
$( document ).ready(function() {
salesTotalCalculation()
});
</script>
</tr>

