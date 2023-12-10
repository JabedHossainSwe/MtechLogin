<?php
session_start();
error_reporting(0);
include("../../config/connection.php");
// include("../../config/functions.php");
include("../../config/main_functions.php");
$Bid = addslashes(trim($_POST['Bid']));
$Billno = addslashes(trim($_POST['Billno']));
$sBid = addslashes(trim($_POST['sBid']));
$Bid = !empty($Bid) ? $Bid : '2';
$Billno = !empty($Billno) ? $Billno : '0';
$Billno = (int)$Billno;
$sBid = !empty($sBid) ? $sBid : '1';
$LanguageId = $_REQUEST['LanguageId'];
$LanguageId = !empty($LanguageId) ? $LanguageId : '1';

// echo "EXECUTE " . dbObject . "[SPSalQuotationDetSelectWeb] @Billno=$Billno,@Bid=$Bid,@sBid=$sBid";
$row_count = 1;
$detailsSp = Run("EXECUTE " . dbObject . "[SPDataInOrderDetSelectWeb] @Billno=$Billno,@Bid=$Bid,@sBid=$sBid");
// die("hi");
// die();
// $detailsSp = Run($tt);
while ($getDetails = myfetch($detailsSp)) {
	// print_r($getDetails);
	// die();
	$Pcode = $getDetails->PCode;
	$Pid = $getDetails->Pid;
	$unit_name = $getDetails->UnitName;
	$qty = $getDetails->Qty;
	$price = $getDetails->Price;
	$total = $getDetails->Total;
	$disAmt = $getDetails->Discount;
	$net_total = $getDetails->NetTotal;
	$product = $getDetails->pname;
	$vatPer = $getDetails->vatPer;
	$vatAmt = $getDetails->vatAmt;
	$vatTotal = $getDetails->vatTotal;
	$vatPTotal = $getDetails->vatTotal + $getDetails->Total;
	$unit_id = $getDetails->Uid;

	$query = Run("Select * from " . dbObject . "Product where Pcode = '" . $Pcode . "'");
	$fetch = myfetch($query);
	$product_name = $fetch->PName;
?>

	<tr id="row_<?php echo $row_count ?>">
		<td><?= $row_count ?></td>
		<td><input type="hidden" name="code<?php echo $row_count ?>" id="code<?php echo $row_count ?>" value="<?php echo $Pcode ?>"><?php echo $Pcode ?></td>
		<td><input type="hidden" name="product_name<?php echo $row_count ?>" id="product_name<?php echo $row_count ?>" value="<?php echo $product_name ?>"><?php echo $product_name ?></td>
		<td><input type="hidden" name="unit_name<?php echo $row_count ?>" id="unit_name<?php echo $row_count ?>" value="<?php echo $unit_name ?>"><?php echo $unit_name ?></td>
		<td><input type="hidden" name="qty<?php echo $row_count ?>" class="t_qty" id="qty<?php echo $row_count ?>" value="<?php echo $qty ?>"><?php echo $qty ?></td>
		<td><input type="hidden" name="price<?php echo $row_count ?>" class="t_price" id="price<?php echo $row_count ?>" value="<?php echo $price ?>"><?php echo $price ?></td>
		<td><input type="hidden" name="total<?php echo $row_count ?>" class="t_total" id="total<?php echo $row_count ?>" value="<?php echo $total ?>"><?php echo $total ?></td>
		<td><input type="hidden" name="altCode<?php echo $row_count ?>" class="t_altCode" id="altCode<?php echo $row_count ?>" value="<?php echo $altCode ?>"><?php echo $altCode ?></td>
		<td><input type="hidden" name="vatPer<?php echo $row_count ?>" class="t_vatPer" id="vatPer<?php echo $row_count ?>" value="<?php echo $vatPer ?>"><?php echo $vatPer ?></td>
		<td><input type="hidden" name="vatAmt<?php echo $row_count ?>" class="t_vatAmt" id="vatAmt<?php echo $row_count ?>" value="<?php echo $vatAmt ?>"><?php echo $vatAmt ?></td>
		<td><input type="hidden" name="vattotal<?php echo $row_count ?>" class="t_vattotal" id="vattotal<?php echo $row_count ?>" value="<?php echo $vatTotal ?>"><?php echo $vatTotal ?></td>
		<td><input type="hidden" name="vatPTotal<?php echo $row_count ?>" class="t_vatPTotal" id="vatPTotal<?php echo $row_count ?>" value="<?php echo $vatPTotal ?>"><?php echo $vatPTotal ?></td>
		<td>
			<i class="fa fa-pencil" onclick="edit_row(<?php echo $row_count ?>)"></i>&nbsp;&nbsp;&nbsp;<i class="fa fa-trash" onclick="delete_row(<?php echo $row_count ?>)"></i>
			<input type="hidden" id="Pid<?php echo $row_count ?>" name="Pid<?php echo $row_count ?>" value="<?= $Pid; ?>">
			<input type="hidden" id="unit<?php echo $row_count ?>" name="unit<?php echo $row_count ?>" value="<?php echo $unit_id ?>">
		</td>

	</tr>
	<script>
		$(document).ready(function() {
			$("#row_count").val(<?= $row_count ?>);
		});
	</script>
<?php
	$row_count++;
}
?>