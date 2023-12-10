<?php

$pos_id = "1992";

$mainStoreProcedure = "EXEC  " . dbObject . "GetSalesGroup @bid='" . $bid . "',@SpType='" . $SpType . "',@FBillno='" . $FBillno . "',@TBillno='" . $TBillno . "',@dt='" . $dt . "',@dt2='" . $dt2 . "',@CustSupId='" . $CustSupId . "',@UsrId='" . $UsrId . "',@CrAmount='" . $amount_type . "" . $CrAmount . "',@LanguageId='" . $LanguageId . "',@PosId=" . $pos_id;
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
$print = urlencode($mmQ);
$result = Run($mmQ);

?>


<div class="row mb-2">
	<div class="col-md-2 col-sm-4 col-lg-2">
		<div class="d-grid gap-2 col-12 ">
			<b><span class="en">QTY</span><span class="ar"><?= getArabicTitle('QTY') ?></span></b><br />
			<button style="width: 130px; text-align: left" type="button" class="btn btn-<?php echo ($fetchAllTotals['QTY'] < 0) ? 'danger':'info'; ?> m-r-sm"><?php echo AmountValue($fetchAllTotals['QTY']); ?></button>
		</div>
	</div>
	
	<div class="col-md-2 col-sm-4 col-lg-2">
		<div class="d-grid gap-2 col-12 ">
			<b><span class="en">NetTotal</span><span class="ar"><?= getArabicTitle('NetTotal') ?></span></b><br />
			<button style="width: 130px; text-align: left" type="button" class="btn btn-<?php echo ($fetchAllTotals['NetTotal'] < 0) ? 'danger':'info'; ?> m-r-sm"><?php echo AmountValue($fetchAllTotals['NetTotal']); ?></button>
		</div>
	</div>
	<div class="col-md-2 col-sm-4 col-lg-2">
		<div class="d-grid gap-2 col-12 ">
			<b><span class="en">CostTot</span><span class="ar"><?= getArabicTitle('CostTot') ?></span></b><br />
			<button style="width: 130px; text-align: left" type="button" class="btn btn-<?php echo ($fetchAllTotals['CostTot'] < 0) ? 'danger':'info'; ?> m-r-sm"><?php echo AmountValue($fetchAllTotals['CostTot']); ?></button>
		</div>
	</div>
	<div class="col-md-2 col-sm-4 col-lg-2">
		<div class="d-grid gap-2 col-12 ">
			<b><span class="en">SrTotal</span><span class="ar"><?= getArabicTitle('SrTotal') ?></span></b><br />
			<button style="width: 130px; text-align: left" type="button" class="btn btn-<?php echo ($fetchAllTotals['SrTotal'] < 0) ? 'danger':'info'; ?> m-r-sm"><?php echo AmountValue($fetchAllTotals['SrTotal']); ?></button>
		</div>
	</div>
	<div class="col-md-2 col-sm-4 col-lg-2">
		<div class="d-grid gap-2 col-12 ">
			<b><span class="en">SrCost</span><span class="ar"><?= getArabicTitle('SrCost') ?></span></b><br />
			<button style="width: 130px; text-align: left" type="button" class="btn btn-<?php echo ($fetchAllTotals['SrCost'] < 0) ? 'danger':'info'; ?> m-r-sm"><?php echo AmountValue($fetchAllTotals['SrCost']); ?></button>
		</div>
	</div>
	<div class="col-md-2 col-sm-4 col-lg-2">
		<div class="d-grid gap-2 col-12 ">
			<b><span class="en">StkOutTotal</span><span class="ar"><?= getArabicTitle('StkOutTotal') ?></span></b><br />
			<button style="width: 130px; text-align: left" type="button" class="btn btn-<?php echo ($fetchAllTotals['StkOutTotal'] < 0) ? 'danger':'info'; ?> m-r-sm"><?php echo AmountValue($fetchAllTotals['StkOutTotal']); ?></button>
		</div>
	</div>
	<div class="col-md-2 col-sm-4 col-lg-2">
		<div class="d-grid gap-2 col-12 ">
			<b><span class="en">NetSale</span><span class="ar"><?= getArabicTitle('NetSale') ?></span></b><br />
			<button style="width: 130px; text-align: left" type="button" class="btn btn-<?php echo ($fetchAllTotals['NetSale'] < 0) ? 'danger':'info'; ?> m-r-sm"><?php echo AmountValue($fetchAllTotals['NetSale']); ?></button>
		</div>
	</div>
	<div class="col-md-2 col-sm-4 col-lg-2">
		<div class="d-grid gap-2 col-12 ">
			<b><span class="en">GCost</span><span class="ar"><?= getArabicTitle('GCost') ?></span></b><br />
			<button style="width: 130px; text-align: left" type="button" class="btn btn-<?php echo ($fetchAllTotals['GCost'] < 0) ? 'danger':'info'; ?> m-r-sm"><?php echo AmountValue($fetchAllTotals['GCost']); ?></button>
		</div>
	</div>
	<div class="col-md-2 col-sm-4 col-lg-2">
		<div class="d-grid gap-2 col-12 ">
			<b><span class="en">GProfit</span><span class="ar"><?= getArabicTitle('GProfit') ?></span></b><br />
			<button style="width: 130px; text-align: left" type="button" class="btn btn-<?php echo ($fetchAllTotals['GProfit'] < 0) ? 'danger':'info'; ?> m-r-sm"><?php echo AmountValue($fetchAllTotals['GProfit']); ?></button>
		</div>
	</div>
	<div class="col-md-2 col-sm-4 col-lg-2">
		<div class="d-grid gap-2 col-12 ">
			<b><span class="en">StockLoss</span><span class="ar"><?= getArabicTitle('StockLoss') ?></span></b><br />
			<button style="width: 130px; text-align: left" type="button" class="btn btn-<?php echo ($fetchAllTotals['StockLoss'] < 0) ? 'danger':'info'; ?> m-r-sm"><?php echo AmountValue($fetchAllTotals['StockLoss']); ?></button>
		</div>
	</div>
	<div class="col-md-2 col-sm-4 col-lg-2">
		<div class="d-grid gap-2 col-12 ">
			<b><span class="en">NetProfit</span><span class="ar"><?= getArabicTitle('NetProfit') ?></span></b><br />
			<button style="width: 130px; text-align: left" type="button" class="btn btn-<?php echo ($fetchAllTotals['NetProfit'] < 0) ? 'danger':'info'; ?> m-r-sm"><?php echo AmountValue($fetchAllTotals['NetProfit']); ?></button>
		</div>
	</div>
	<div class="col-md-2 col-sm-4 col-lg-2">
		<div class="d-grid gap-2 col-12 ">
			<b><span class="en">ProfitPer</span><span class="ar"><?= getArabicTitle('ProfitPer') ?></span></b><br />
			<button style="width: 130px; text-align: left" type="button" class="btn btn-<?php echo ($fetchAllTotals['ProfitPer'] < 0) ? 'danger':'info'; ?> m-r-sm"><?php echo AmountValue($fetchAllTotals['ProfitPer']); ?></button>
		</div>
	</div>
	<div class="col-md-2 col-sm-4 col-lg-2">
		<div class="d-grid gap-2 col-12 ">
			<b><span class="en">vatAmt</span><span class="ar"><?= getArabicTitle('vatAmt') ?></span></b><br />
			<button style="width: 130px; text-align: left" type="button" class="btn btn-<?php echo ($fetchAllTotals['vatAmt'] < 0) ? 'danger':'info'; ?> m-r-sm"><?php echo AmountValue($fetchAllTotals['vatAmt']); ?></button>
		</div>
	</div>
	<div class="col-md-2 col-sm-4 col-lg-2">
		<div class="d-grid gap-2 col-12 ">
			<b><span class="en">vatAmtSR</span><span class="ar"><?= getArabicTitle('vatAmtSR') ?></span></b><br />
			<button style="width: 130px; text-align: left" type="button" class="btn btn-<?php echo ($fetchAllTotals['vatAmtSR'] < 0) ? 'danger':'info'; ?> m-r-sm"><?php echo AmountValue($fetchAllTotals['vatAmtSR']); ?></button>
		</div>
	</div>
	<div class="col-md-2 col-sm-4 col-lg-2">
		<div class="d-grid gap-2 col-12 ">
			<b><span class="en">NetVat</span><span class="ar"><?= getArabicTitle('NetVat') ?></span></b><br />
			<button style="width: 130px; text-align: left" type="button" class="btn btn-<?php echo ($fetchAllTotals['NetVat'] < 0) ? 'danger':'info'; ?> m-r-sm"><?php echo AmountValue($fetchAllTotals['NetVat']); ?></button>
		</div>
	</div>
	<div class="col-md-2 col-sm-4 col-lg-2">
		<div class="d-grid gap-2 col-12 ">
			<b><span class="en">GrandTotal</span><span class="ar"><?= getArabicTitle('GrandTotal') ?></span></b><br />
			<button style="width: 130px; text-align: left" type="button" class="btn btn-<?php echo ($fetchAllTotals['GrandTotal'] < 0) ? 'danger':'info'; ?> m-r-sm"><?php echo AmountValue($fetchAllTotals['GrandTotal']); ?></button>
		</div>
	</div>
</div>


<hr>
<div class="col-md-12 col-sm-12 col-lg-12 mb-4 text-center">
	<div class="d-grid gap-2 col-12 pl-0">
		<button style="width: 130px;" type="button" class="btn btn-w-m btn-outline-primary" id="reportPRint" onclick="PrintPopup('<?= $print ?>', 'Sales Report Group', 'saleGroup')"><i class="fa fa-print" aria-hidden="true"></i></button>
	</div>
</div>
<hr>
<!-- Listing -->
<table class="table table-striped table-bordered dt-responsive table-hover ">
	<thead>
		<tr>
			<th><span class="en">Product Group</span><span class="ar"><?= getArabicTitle('Product Group') ?></span></th>
			<th><span class="en">QTY</span><span class="ar"><?= getArabicTitle('QTY') ?></span></th>
			<th><span class="en">NetTotal</span><span class="ar"><?= getArabicTitle('NetTotal') ?></span></th>
			<th><span class="en">Total Cost</span><span class="ar"><?= getArabicTitle('Total Cost') ?></span></th>
			<th><span class="en">SrTotal</span><span class="ar"><?= getArabicTitle('SrTotal') ?></span></th>
			<th><span class="en">SrCost</span><span class="ar"><?= getArabicTitle('SrCost') ?></span></th>
			<th><span class="en">StkOutTotal</span><span class="ar"><?= getArabicTitle('StkOutTotal') ?></span> </th>
			<th><span class="en">NetSale</span><span class="ar"><?= getArabicTitle('NetSale') ?></span></th>
			<th><span class="en">GCost</span><span class="ar"><?= getArabicTitle('GCost') ?></span></th>
			<th><span class="en">GProfit</span><span class="ar"><?= getArabicTitle('GProfit') ?></span> </th>
			<th><span class="en">StockLoss</span><span class="ar"><?= getArabicTitle('StockLoss') ?></span></th>
			<th><span class="en">NetProfit</span><span class="ar"><?= getArabicTitle('NetProfit') ?></span> </th>
			<th><span class="en">Profit%</span><span class="ar"><?= getArabicTitle('Profit') ?>%</span></th>
			<th><span class="en">vatAmt</span><span class="ar"><?= getArabicTitle('vatAmt') ?></span></th>
			<th><span class="en">vatAmtSR</span><span class="ar"><?= getArabicTitle('vatAmtSR') ?></span></th>
			<th><span class="en">NetVat</span><span class="ar"><?= getArabicTitle('NetVat') ?></span></th>
			<th><span class="en">(Vat+Sales)</span><span class="ar"><?= getArabicTitle('(Vat+Sales)') ?></span></th>
			<th><span class="en">AdvAmt</span><span class="ar"><?= getArabicTitle('AdvAmt') ?></span></th>
			<th><span class="en">GGTotal</span><span class="ar"><?= getArabicTitle('GGTotal') ?></span></th>
		</tr>
	</thead>
	<tbody>
	<?php
	if ($pages->items_total > 0) {
		$cnt = 1;
		while ($single  =   myfetch($result)) {
			echo '<tr>'; ?>

			<td><span class="text-warp"><?php echo $single->GroupName; ?> </span></td>
			<td><span class="text-warp"><?php echo AmountValue($single->QTY); ?> </span></td>
			<td><span class="text-warp"><?php echo AmountValue($single->NetTotal); ?> </span></td>
			<td><span class="text-warp"><?php echo AmountValue($single->CostTot); ?> </span></td>
			<td><span class="text-warp"><?php echo AmountValue($single->SrTotal); ?> </span></td>
			<td><span class="text-warp"><?php echo AmountValue($single->SrCost); ?> </span></td>
			<td><span class="text-warp"><?php echo AmountValue($single->StkOutTotal); ?> </span></td>
			<td><span class="text-warp"><?php echo AmountValue($single->NetSale); ?> </span></td>
			<td><span class="text-warp"><?php echo AmountValue($single->GCost); ?> </span></td>
			<td><span class="text-warp"><?php echo AmountValue($single->GProfit); ?> </span></td>
			<td><span class="text-warp"><?php echo AmountValue($single->StockLoss); ?> </span></td>
			<td><span class="text-warp"><?php echo AmountValue($single->NetProfit); ?> </span></td>
			<td><span class="text-warp"><?php echo AmountValue($single->ProfitPer); ?> </span></td>
			<td><span class="text-warp"><?php echo AmountValue($single->vatAmt); ?> </span></td>
			<td><span class="text-warp"><?php echo AmountValue($single->vatAmtSR); ?> </span></td>
			<td><span class="text-warp"><?php echo AmountValue($single->NetVat); ?> </span></td>
			<td><span class="text-warp"><?php echo AmountValue($single->GrandTotal); ?> </span></td>
			<td><span class="text-warp"><?php echo AmountValue($single->AdvAmt); ?> </span></td>
			<td><span class="text-warp"><?php echo AmountValue($single->GGTotal); ?> </span></td>

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

		<?php } ?>

	</div>

	<div class="clearfix"></div>

</div>

<!-- /bottom pagination -->



<div class="clearfix"></div>

<div class="clearfix"></div>
<script>
    $(document).ready(function () {
        var lang = document.getElementById("selected_lang").value;
        changeLanguage(lang);
    });
</script>