<?php

$mainStoreProcedure = "EXEC  " . dbObject . "GetProdDetStock @bid='" . $bid . "',
@dt='" . $dt . "',
@dt2='" . $dt2 . "',
@FItemCode='" . $FItemCode . "',
@TItemCode='" . $TItemCode . "', 
@ItemType='" . $ItemType . "', 
@suppid='" . $suppid . "', 
@supGids='" . $supGids . "',
@pids='" . $pids . "',
@Gids='" . $Gids . "',
@CBid='" . $CBid . "',
@condCriteria='" . $condCriteria . "',
@PurInv='" . $PurInv . "', 
@Ismultiunit='" . $Ismultiunit . "', @ProdGrpCombine='" . $ProdGrpCombine . "', @IsDelvEffectStock='" . $IsDelvEffectStock . "', @IsPurEfctStock='" . $IsPurEfctStock . "', 
@FPid='" . $FPid . "', 
@TPid='" . $TPid . "', 
@CrPrice='" . $CrPrice . "', @IsMultiProduction='" . $IsMultiProduction . "', @PromotionBillNo='" . $PromotionBillNo . "', @OrderyBy='" . $OrderyBy . "', 
@LanguageId='" . $LanguageId . "' ";
$initialLimit = ",@FRecNo=0,@ToRecNo=15";
$DataType = ",@DataType=1";



///// Get Total Count/////
$sql_ = $mainStoreProcedure . $DataType . $initialLimit;
$sql_forms = Run($sql_);
$tolrec = myfetch($sql_forms)->RecNo;








///// Get SUM/////
$DataType = ",@DataType=2";
$sumQuery = Run($mainStoreProcedure . $DataType . $initialLimit);
$fetchAllTotals = colfetch($sumQuery)[0];









$pages->default_ipp = 15;
$pages->items_total = $tolrec;
$pages->mid_range = 9;
$pages->paginate();

$DataType = ",@DataType=3";
$initialLimit = "," . $pages->limit;

///// Main Query/////
$mmQ = $mainStoreProcedure . $DataType . $initialLimit;
$result = Run($mmQ);
$print = urlencode($mmQ);


?>
<div class="row mb-2">
	<div class="col-md-2 col-sm-4 col-lg-2">
		<div class="d-grid gap-2 col-12 ">
			<b><span class="en">Balance</span><span class="ar"><?= getArabicTitle('Balance') ?></span></b>
			<button style="width: 130px; text-align: left" type="button" class="btn btn-<?php echo ($fetchAllTotals['Balance'] < 0) ? 'danger' : 'info'; ?> m-r-sm"><?php echo AmountValue($fetchAllTotals['Balance']); ?></button>
		</div>
	</div>

	<div class="col-md-2 col-sm-4 col-lg-2">
		<div class="d-grid gap-2 col-12 ">
			<b><span class="en">Open Qty</span><span class="ar"><?= getArabicTitle('Open Qty') ?></span></b>
			<button style="width: 130px; text-align: left" type="button" class="btn btn-<?php echo ($fetchAllTotals['OpenQty'] < 0) ? 'danger' : 'info'; ?> m-r-sm"><?php echo AmountValue($fetchAllTotals['OpenQty']); ?></button>
		</div>
	</div>
	<div class="col-md-2 col-sm-4 col-lg-2">
		<div class="d-grid gap-2 col-12 ">
			<b><span class="en">Carry Forword Balance</span><span class="ar"><?= getArabicTitle('Carry Forword Balance') ?></span></b>
			<button style="width: 130px; text-align: left" type="button" class="btn btn-<?php echo ($fetchAllTotals['CarryForwordBalance'] < 0) ? 'danger' : 'info'; ?> m-r-sm"><?php echo AmountValue($fetchAllTotals['CarryForwordBalance']); ?></button>
		</div>
	</div>
	<div class="col-md-2 col-sm-4 col-lg-2">
		<div class="d-grid gap-2 col-12 ">
			<b><span class="en">Purchase Qty</span><span class="ar"><?= getArabicTitle('Purchase Qty') ?></span></b>
			<button style="width: 130px; text-align: left" type="button" class="btn btn-<?php echo ($fetchAllTotals['PurQty'] < 0) ? 'danger' : 'info'; ?> m-r-sm"><?php echo AmountValue($fetchAllTotals['PurQty']); ?></button>
		</div>
	</div>
	<div class="col-md-2 col-sm-4 col-lg-2">
		<div class="d-grid gap-2 col-12 ">
			<b><span class="en">Purchase Return Qty</span><span class="ar"><?= getArabicTitle('Purchase Return Qty') ?></span></b>
			<button style="width: 130px; text-align: left" type="button" class="btn btn-<?php echo ($fetchAllTotals['PurRetQty'] < 0) ? 'danger' : 'info'; ?> m-r-sm"><?php echo AmountValue($fetchAllTotals['PurRetQty']); ?></button>
		</div>
	</div>

	<div class="col-md-2 col-sm-4 col-lg-2">
		<div class="d-grid gap-2 col-12 ">
			<b><span class="en">Sales Qty</span><span class="ar"><?= getArabicTitle('Sales Qty') ?></span></b>
			<button style="width: 130px; text-align: left" type="button" class="btn btn-<?php echo ($fetchAllTotals['SalesQty'] < 0) ? 'danger' : 'info'; ?> m-r-sm"><?php echo AmountValue($fetchAllTotals['SalesQty']); ?></button>
		</div>
	</div>

	<div class="col-md-2 col-sm-4 col-lg-2">
		<div class="d-grid gap-2 col-12 ">
			<b><span class="en">Sale Return Qty</span><span class="ar"><?= getArabicTitle('Sale Return Qty') ?></span></b>
			<button style="width: 130px; text-align: left" type="button" class="btn btn-<?php echo ($fetchAllTotals['SalRetQty'] < 0) ? 'danger' : 'info'; ?> m-r-sm"><?php echo AmountValue($fetchAllTotals['SalRetQty']); ?></button>
		</div>
	</div>

	<div class="col-md-2 col-sm-4 col-lg-2">
		<div class="d-grid gap-2 col-12 ">
			<b><span class="en">Branch Transferedt Qty</span><span class="ar"><?= getArabicTitle('Branch Transferedt Qty') ?></span></b>
			<button style="width: 130px; text-align: left" type="button" class="btn btn-<?php echo ($fetchAllTotals['TrnsferedtQty'] < 0) ? 'danger' : 'info'; ?> m-r-sm"><?php echo AmountValue($fetchAllTotals['TrnsferedtQty']); ?></button>
		</div>
	</div>

	<div class="col-md-2 col-sm-4 col-lg-2">
		<div class="d-grid gap-2 col-12 ">
			<b><span class="en">Branch Received Qty</span><span class="ar"><?= getArabicTitle('Branch Received Qty') ?></span></b>
			<button style="width: 130px; text-align: left" type="button" class="btn btn-<?php echo ($fetchAllTotals['TrnsferReceivedQty'] < 0) ? 'danger' : 'info'; ?> m-r-sm"><?php echo AmountValue($fetchAllTotals['TrnsferReceivedQty']); ?></button>
		</div>
	</div>

	<div class="col-md-2 col-sm-4 col-lg-2">
		<div class="d-grid gap-2 col-12 ">
			<b><span class="en">Production Qty</span><span class="ar"><?= getArabicTitle('Production Qty') ?></span></b>
			<button style="width: 130px; text-align: left" type="button" class="btn btn-<?php echo ($fetchAllTotals['ProductionQTy'] < 0) ? 'danger' : 'info'; ?> m-r-sm"><?php echo AmountValue($fetchAllTotals['ProductionQTy']); ?></button>
		</div>
	</div>

	<div class="col-md-2 col-sm-4 col-lg-2">
		<div class="d-grid gap-2 col-12 ">
			<b><span class="en">Production Decomposed Qty</span><span class="ar"><?= getArabicTitle('Production Decomposed Qty') ?></span></b>
			<button style="width: 130px; text-align: left" type="button" class="btn btn-<?php echo ($fetchAllTotals['ProductinDeComQty'] < 0) ? 'danger' : 'info'; ?> m-r-sm"><?php echo AmountValue($fetchAllTotals['ProductinDeComQty']); ?></button>
		</div>
	</div>

	<div class="col-md-2 col-sm-4 col-lg-2">
		<div class="d-grid gap-2 col-12 ">
			<b><span class="en">Stock Receiving Qty</span><span class="ar"><?= getArabicTitle('Stock Receiving Qty') ?></span></b>
			<button style="width: 130px; text-align: left" type="button" class="btn btn-<?php echo ($fetchAllTotals['StockReceivingQty'] < 0) ? 'danger' : 'info'; ?> m-r-sm"><?php echo AmountValue($fetchAllTotals['StockReceivingQty']); ?></button>
		</div>
	</div>

	<div class="col-md-2 col-sm-4 col-lg-2">
		<div class="d-grid gap-2 col-12 ">
			<b><span class="en">Delivery Qty</span><span class="ar"><?= getArabicTitle('Delivery Qty') ?></span></b>
			<button style="width: 130px; text-align: left" type="button" class="btn btn-<?php echo ($fetchAllTotals['DeliveryQTy'] < 0) ? 'danger' : 'info'; ?> m-r-sm"><?php echo AmountValue($fetchAllTotals['DeliveryQTy']); ?></button>
		</div>
	</div>

	<div class="col-md-2 col-sm-4 col-lg-2">
		<div class="d-grid gap-2 col-12 ">
			<b><span class="en">Adjustments Qty</span><span class="ar"><?= getArabicTitle('Adjustments Qty') ?></span></b>
			<button style="width: 130px; text-align: left" type="button" class="btn btn-<?php echo ($fetchAllTotals['AdjustQty'] < 0) ? 'danger' : 'info'; ?> m-r-sm"><?php echo AmountValue($fetchAllTotals['AdjustQty']); ?></button>
		</div>
	</div>

	<div class="col-md-2 col-sm-4 col-lg-2">
		<div class="d-grid gap-2 col-12 ">
			<b><span class="en">Stock Out Qty</span><span class="ar"><?= getArabicTitle('Stock Out Qty') ?></span></b>
			<button style="width: 130px; text-align: left" type="button" class="btn btn-<?php echo ($fetchAllTotals['StockOut'] < 0) ? 'danger' : 'info'; ?> m-r-sm"><?php echo AmountValue($fetchAllTotals['StockOut']); ?></button>
		</div>
	</div>

	<div class="col-md-2 col-sm-4 col-lg-2">
		<div class="d-grid gap-2 col-12 ">
			<b><span class="en">Avg Cost Total</span><span class="ar"><?= getArabicTitle('Avg Cost Total') ?></span></b>
			<button style="width: 130px; text-align: left" type="button" class="btn btn-<?php echo ($fetchAllTotals['AvgCostTotal'] < 0) ? 'danger' : 'info'; ?> m-r-sm"><?php echo AmountValue($fetchAllTotals['AvgCostTotal']); ?></button>
		</div>
	</div>

	<div class="col-md-2 col-sm-4 col-lg-2">
		<div class="d-grid gap-2 col-12 ">
			<b><span class="en">Sale Price Total</span><span class="ar"><?= getArabicTitle('Sale Price Total') ?></span></b>
			<button style="width: 130px; text-align: left" type="button" class="btn btn-<?php echo ($fetchAllTotals['SalPriceTotal'] < 0) ? 'danger' : 'info'; ?> m-r-sm"><?php echo AmountValue($fetchAllTotals['SalPriceTotal']); ?></button>
		</div>
	</div>

	<div class="col-md-2 col-sm-4 col-lg-2">
		<div class="d-grid gap-2 col-12 ">
			<b><span class="en">Purchase Price Total</span><span class="ar"><?= getArabicTitle('Purchase Price Total') ?></span></b>
			<button style="width: 130px; text-align: left" type="button" class="btn btn-<?php echo ($fetchAllTotals['PurPriceTotal'] < 0) ? 'danger' : 'info'; ?> m-r-sm"><?php echo AmountValue($fetchAllTotals['PurPriceTotal']); ?></button>
		</div>
	</div>

	<div class="col-md-2 col-sm-4 col-lg-2">
		<div class="d-grid gap-2 col-12 ">
			<b><span class="en">Decomposed Raw Material</span><span class="ar"><?= getArabicTitle('Decomposed Raw Material') ?></span></b>
			<button style="width: 130px; text-align: left" type="button" class="btn btn-<?php echo ($fetchAllTotals['ProductionDecomRawmaterialDeCom'] < 0) ? 'danger' : 'info'; ?> m-r-sm"><?php echo AmountValue($fetchAllTotals['ProductionDecomRawmaterialDeCom']); ?></button>
		</div>
	</div>

	<div class="col-md-2 col-sm-4 col-lg-2">
		<div class="d-grid gap-2 col-12 ">
			<b><span class="en">Product Raw Material Qty</span><span class="ar"><?= getArabicTitle('Product Raw Material Qty') ?></span></b>
			<button style="width: 130px; text-align: left" type="button" class="btn btn-<?php echo ($fetchAllTotals['ProductionRawMaterialQty'] < 0) ? 'danger' : 'info'; ?> m-r-sm"><?php echo AmountValue($fetchAllTotals['ProductionRawMaterialQty']); ?></button>
		</div>
	</div>

</div>


<!-- <div class="row">
		<div class="col-md-4 col-sm-4 col-lg-4">
			<button style=" text-align: left" type="button" class="btn btn-<?php echo ($fetchAllTotals['PurPriceTotal'] < 0) ? 'danger' : 'info'; ?> m-r-sm"><?php echo AmountValue($fetchAllTotals['PurPriceTotal']); ?></button>
			<b><span class="en">PurPriceTotal</span><span class="ar"><?= getArabicTitle('PurPriceTotal') ?></span></b>
			<b><?php echo $key; ?></b>
		</div>
</div> -->
<hr>
<div class="col-md-12 col-sm-12 col-lg-12 mb-4 text-center">
	<div class="d-grid gap-2 col-12 pl-0">
		<button style="" type="button" class="btn btn-w-m btn-outline-primary" id="reportPRint" onclick="PrintPopup('<?= $print ?>', 'Product Stock Report')"><i class="fa fa-print" aria-hidden="true"></i></button>
	</div>
</div>
<hr>
<!-- Listing -->
<table class="table table-striped table-bordered dt-responsive table-hover ">
	<thead>
		<tr>
			<th><span class="en">Code</span><span class="ar"><?= getArabicTitle('Code') ?></span></th>
			<th><span class="en">Product Name</span><span class="ar"><?= getArabicTitle('Product Name') ?></span></th>
			<th><span class="en">Unit</span><span class="ar"><?= getArabicTitle('Unit') ?></span></th>
			<th><span class="en">Multi Unit Balance</span><span class="ar"><?= getArabicTitle('Multi Unit Balance') ?></span></th>
			<th><span class="en">Balance</span><span class="ar"><?= getArabicTitle('Balance') ?></span></th>
			<th><span class="en">Open Qty</span><span class="ar"><?= getArabicTitle('Open Qty') ?></span></th>
			<th><span class="en">Carry Forword Balance</span><span class="ar"><?= getArabicTitle('Carry Forword Balance') ?></span></th>
			<th><span class="en">Purchase Qty</span><span class="ar"><?= getArabicTitle('Purchase Qty') ?></span> </th>
			<th><span class="en">Purchase Return Qty</span><span class="ar"><?= getArabicTitle('Purchase Return Qty') ?></span></th>
			<th><span class="en">Stock Out Qty</span><span class="ar"><?= getArabicTitle('Stock Out Qty') ?></span></th>
			<th><span class="en">Sales Qty</span><span class="ar"><?= getArabicTitle('Sales Qty') ?></span> </th>
			<th><span class="en">Sale Return Qty</span><span class="ar"><?= getArabicTitle('Sale Return Qty') ?></span></th>
			<th><span class="en">Branch Transfer Qty</span><span class="ar"><?= getArabicTitle('Branch Transfer Qty') ?></span> </th>
			<th><span class="en">Branch Received Qty</span><span class="ar"><?= getArabicTitle('Branch Received Qty') ?></span></th>
			<th><span class="en">Production Qty</span><span class="ar"><?= getArabicTitle('Production Qty') ?></span></th>
			<th><span class="en">Production Raw Material Qty</span><span class="ar"><?= getArabicTitle('Production Raw Material Qty') ?></span></th>
			<th><span class="en">Production Decompose Qty</span><span class="ar"><?= getArabicTitle('Production Decompose Qty') ?></span></th>
			<th><span class="en">Production Decompose Raw Material</span><span class="ar"><?= getArabicTitle('Production Decompose Raw Material') ?></span></th>
			<th><span class="en">Stock Receiving Qty</span><span class="ar"><?= getArabicTitle('Stock Receiving Qty') ?></span></th>
			<th><span class="en">Delivery Qty</span><span class="ar"><?= getArabicTitle('Delivery Qty') ?></span></th>
			<th><span class="en">Adjustment Qty</span><span class="ar"><?= getArabicTitle('Adjustment Qty') ?></span></th>
			<th><span class="en">Sale Qty In</span><span class="ar"><?= getArabicTitle('Sale Qty In') ?></span></th>
			<th><span class="en">Sale Qty Out</span><span class="ar"><?= getArabicTitle('Sale Qty Out') ?></span></th>
			<th><span class="en">Average Cost</span><span class="ar"><?= getArabicTitle('Average Cost') ?></span></th>
			<th><span class="en">Average Cost Total</span><span class="ar"><?= getArabicTitle('Average Cost Total') ?></span></th>
			<th><span class="en">Sale Price</span><span class="ar"><?= getArabicTitle('Sale Price') ?></span></th>
			<th><span class="en">Sale Price Total</span><span class="ar"><?= getArabicTitle('Sale Price Total') ?></span></th>
			<th><span class="en">Purchase Price</span><span class="ar"><?= getArabicTitle('Purchase Price') ?></span></th>
			<th><span class="en">Purchase Price Total</span><span class="ar"><?= getArabicTitle('Purchase Price Total') ?></span></th>
		</tr>
	</thead>
	<tbody>
		<?php
		if ($pages->items_total > 0) {
			$cnt = 1;
			while ($single  =   myfetch($result)) {
				echo '<tr>'; ?>

				<td><span class="text-warp"><?php echo $single->ProductCode; ?> </span></td>
				<td><span class="text-warp"><?php echo $single->ProductName; ?> </span></td>
				<td><span class="text-warp"><?php echo $single->UnitName; ?> </span></td>
				<td><span class="text-warp"><?php echo AmountValue($single->ProductDesc); ?> </span></td>
				<td><span class="text-warp"><?php echo AmountValue($single->Balance); ?> </span></td>
				<td><span class="text-warp"><?php echo AmountValue($single->OpenQty); ?> </span></td>
				<td><span class="text-warp"><?php echo AmountValue($single->CarryForwordBalance); ?> </span></td>
				<td><span class="text-warp"><?php echo AmountValue($single->PurQty); ?> </span></td>
				<td><span class="text-warp"><?php echo AmountValue($single->PurRetQty); ?> </span></td>
				<td><span class="text-warp"><?php echo AmountValue($single->StockOut); ?> </span></td>
				<td><span class="text-warp"><?php echo AmountValue($single->SalesQty); ?> </span></td>
				<td><span class="text-warp"><?php echo AmountValue($single->SalRetQty); ?> </span></td>
				<td><span class="text-warp"><?php echo AmountValue($single->TrnsferedtQty); ?> </span></td>
				<td><span class="text-warp"><?php echo AmountValue($single->TrnsferReceivedQty); ?> </span></td>
				<td><span class="text-warp"><?php echo AmountValue($single->ProductionQTy); ?> </span></td>
				<td><span class="text-warp"><?php echo AmountValue($single->ProductionRawMaterialQty); ?> </span></td>
				<td><span class="text-warp"><?php echo AmountValue($single->ProductinDeComQty); ?> </span></td>
				<td><span class="text-warp"><?php echo AmountValue($single->ProductionDecomRawmaterialDeCom); ?> </span></td>
				<td><span class="text-warp"><?php echo AmountValue($single->StockReceivingQty); ?> </span></td>
				<td><span class="text-warp"><?php echo AmountValue($single->DeliveryQTy); ?> </span></td>
				<td><span class="text-warp"><?php echo AmountValue($single->AdjustQty); ?> </span></td>
				<td><span class="text-warp"><?php echo AmountValue($single->SalQtyIn); ?> </span></td>
				<td><span class="text-warp"><?php echo AmountValue($single->SalQtyOut); ?> </span></td>
				<td><span class="text-warp"><?php echo AmountValue($single->AvgCost); ?> </span></td>
				<td><span class="text-warp"><?php echo AmountValue($single->AvgCostTotal); ?> </span></td>
				<td><span class="text-warp"><?php echo AmountValue($single->SalePrice); ?> </span></td>
				<td><span class="text-warp"><?php echo AmountValue($single->SalPriceTotal); ?> </span></td>
				<td><span class="text-warp"><?php echo AmountValue($single->PurPrice); ?> </span></td>
				<td><span class="text-warp"><?php echo AmountValue($single->PurPriceTotal); ?> </span></td>

				<?php
				?>
				</tr>
			<?php
				$cnt++;
			}
		} else {
			?>
			<tr>
				<td colspan="11" class="text-center">
					<h2><strong><span class="en">No Record(s) Found..</span><span class="ar">..<?= getArabicTitle('No Record(s) Found') ?></span></strong></h2>
				</td>
			</tr>
		<?php

		}

		?>


	</tbody>

</table>

<!-- /Listing -->

<div class="clearfix"></div>



<!-- bottom pagination -->

<div class="row marginTop">

	<div class="col-sm-12 paddingLeft pagerfwt">

		<?php if ($pages->items_total > 0) { ?>

			<?php echo $pages->display_pages(); ?>

			<?php echo $pages->display_items_per_page(); ?>

			<?php echo $pages->display_jump_menu(); ?>

		<?php }


		?>
	</div>

	<div class="clearfix"></div>

</div>

<!-- /bottom pagination -->



<div class="clearfix"></div>

<div class="clearfix"></div>

<script>
	$(document).ready(function() {
		var lang = document.getElementById("selected_lang").value;
		changeLanguage(lang);
	});
</script>