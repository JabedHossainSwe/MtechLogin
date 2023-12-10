<?php
session_start();
error_reporting(0);
include("../../../config/connection.php");
// include("../../../config/functions.php");
include("../../../config/main_functions.php");
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
$detailsSp = Run("EXECUTE " . dbObject . "[SPSalQuotationDetSelectWeb] @Billno=$Billno,@Bid=$Bid,@sBid=$sBid");
// die("hi");
// die();
// $detailsSp = Run($tt);
while ($getDetails = myfetch($detailsSp)) {
	// print_r($getDetails);
	// die();
	$Pcode = $getDetails->PCode;
	$Pid = $getDetails->Pid;
	$unit_name = $getDetails->ParaName;
	$bonus = $getDetails->Bonus;
	$price = $getDetails->Price;
	$total = $getDetails->Total;
	// die();
	// $disPer = $getDetails->DisPer;
	$disAmt = $getDetails->Discount;
	$net_total = $getDetails->NetTotal;
	// $cpp = $getDetails->cpp;
	// $acp = $getDetails->acp;
	// $Sprice = $getDetails->sPrice;
	$product = $getDetails->pname;
	$vatPer = $getDetails->vatPer;
	$vatAmt = $getDetails->vatAmt;
	$vatTotal = $getDetails->vatTotal;
	$grand_total = $getDetails->vatTotal + $getDetails->Price;
	// $altCode = $getDetails->altCode;
	// $actPrice = $getDetails->actPrice;
	// $SCPer = $getDetails->SCPer;
	// $CPrice = $getDetails->costprice;
	// $lprice = $getDetails->leastSPrice;
	$vatPTotal = $getDetails->vatPTotal;
	$unit_id = $getDetails->Uid;

	// $vatSPrice = $getDetails->vatSPrice;
	// $LSPrice = $getDetails->leastSPrice;
	$qty = $getDetails->Qty;


	$query = Run("Select * from " . dbObject . "Product where Pcode = '" . $Pcode . "'");
	$fetch = myfetch($query);
	$product_name = $fetch->PName;
?>

	<tr id="row_<?php echo $row_count ?>">
		<td><?= $row_count ?></td>
		<td><input type="hidden" name="code<?php echo $row_count ?>" id="code<?php echo $row_count ?>" value="<?php echo $Pcode ?>"><?php echo $Pcode ?></td>
		<td><input type="hidden" name="product_name<?php echo $row_count ?>" id="product_name<?php echo $row_count ?>" value="<?php echo $product_name ?>"><?php echo $product_name ?></td>
		<td><input type="hidden" name="unit<?php echo $row_count ?>" id="unit<?php echo $row_count ?>" value="<?php echo $unit_id ?>"><?php echo $unit_name ?></td>
		<td><input type="hidden" name="qty<?php echo $row_count ?>" class="t_qty" id="qty<?php echo $row_count ?>" value="<?php echo $qty ?>"><?php echo $qty ?></td>
		<td>
			<input type="hidden" name="Sprice<?php echo $row_count ?>" class="" id="Sprice<?php echo $row_count ?>" value="<?php echo $price ?>"><?php echo $price ?>
		</td>
		<td><input type="hidden" name="vatPer<?php echo $row_count ?>" class="t_vat_per" id="vatPer<?php echo $row_count ?>" value="<?php echo $vatPer ?>"><?php echo $vatPer ?></td>
		<td>
			<input type="hidden" name="vatAmt<?php echo $row_count ?>" class="t_vatAmt" id="vatAmt<?php echo $row_count ?>" value="<?php echo $vatAmt ?>"><?php echo $vatAmt ?>
			<input type="hidden" name="rowvatAmt<?php echo $row_count ?>" id="rowvatAmt<?php echo $row_count ?>" value="<?php echo $vatAmt * $qty ?>" class="form-control tot_rowvatAmt">
		</td>

		<td>
			<input type="hidden" name="vatSprice<?php echo $row_count ?>" class="t_Sprice" id="vatSprice<?php echo $row_count ?>" value="<?php echo $total ?>"><?php echo $total ?>
			<input type="hidden" name="netT<?php echo $row_count ?>" id="netT<?php echo $row_count ?>" value="<?= $total ?>" class="tot_Sprice">
		</td>
		<td><input type="hidden" name="vatTotal<?php echo $row_count ?>" class="t_vat_per" id="vatTotal<?php echo $row_count ?>" value="<?php echo $vatTotal ?>"><?php echo $vatTotal ?></td>

		<td><i class="fa fa-pencil" onclick="edit_row(<?php echo $row_count ?>)"></i>&nbsp;&nbsp;&nbsp;<i class="fa fa-trash" onclick="delete_row(<?php echo $row_count ?>)"></i></td>

		<input type="hidden" name="Pid<?php echo $row_count ?>" id="Pid<?php echo $row_count ?>" value="<?= $Pid ?>">
		<input type="hidden" name="PCode<?php echo $row_count ?>" id="PCode<?php echo $row_count ?>" value="<?php echo $Pcode ?>">
		<input type="hidden" name="unit<?php echo $row_count ?>" id="unit<?php echo $row_count ?>" value="<?php echo $unit_name ?>">
		<input type="hidden" name="Uid<?php echo $row_count ?>" id="Uid<?php echo $row_count ?>" value="<?php echo $unit_id ?>">
		<input type="hidden" name="autono<?php echo $row_count ?>" id="autono<?php echo $row_count ?>" value="<?php echo $row_count ?>">

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