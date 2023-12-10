<?php



$mainStoreProcedure = "EXEC  " . dbObject . "GetSalesDet @bid='" . $bid . "',@GroupByType='" . $GroupByType . "',@SpType='" . $SpType . "',@FBillno='" . $FBillno . "',@TBillno='" . $TBillno . "',@dt='" . $dt . "',@dt2='" . $dt2 . "',@CustSupId='" . $CustSupId . "',@UsrId='" . $UsrId . "',@CrAmount='" . $amount_type . "" . $CrAmount . "',@LanguageId='" . $LanguageId . "',@OrderBy='" . $OrderBy . "',@FPid='" . $FPid . "',@TPrid='" . $TPrid . "',@PGroupId='" . $PGroupId . "'";
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
			<b><span class="en">Quantity</span><span class="ar"><?= getArabicTitle('Quantity') ?></span></b><br />
			<button style="width: 130px; text-align: left" type="button" class="btn btn-<?php echo ($fetchAllTotals['Quantity'] < 0) ? 'danger' : 'info'; ?> m-r-sm"><?php echo AmountValue($fetchAllTotals['Quantity']); ?></button>
		</div>
	</div>

	<div class="col-md-2 col-sm-4 col-lg-2">
		<div class="d-grid gap-2 col-12 ">
			<b><span class="en">Bonus</span><span class="ar"><?= getArabicTitle('Bonus') ?></span></b><br />
			<button style="width: 130px; text-align: left" type="button" class="btn btn-<?php echo ($fetchAllTotals['Bonus'] < 0) ? 'danger' : 'info'; ?> m-r-sm"><?php echo AmountValue($fetchAllTotals['Bonus']); ?></button>
		</div>
	</div>
	<div class="col-md-2 col-sm-4 col-lg-2">
		<div class="d-grid gap-2 col-12 ">
			<b><span class="en">NetTotal</span><span class="ar"><?= getArabicTitle('NetTotal') ?></span></b><br />
			<button style="width: 130px; text-align: left" type="button" class="btn btn-<?php echo ($fetchAllTotals['NetTotal'] < 0) ? 'danger' : 'info'; ?> m-r-sm"><?php echo AmountValue($fetchAllTotals['NetTotal']); ?></button>
		</div>
	</div>
	<div class="col-md-2 col-sm-4 col-lg-2">
		<div class="d-grid gap-2 col-12 ">
			<b><span class="en">Cost Total</span><span class="ar"><?= getArabicTitle('Cost Total') ?></span></b><br />
			<button style="width: 130px; text-align: left" type="button" class="btn btn-<?php echo ($fetchAllTotals['CostTotal'] < 0) ? 'danger' : 'info'; ?> m-r-sm"><?php echo AmountValue($fetchAllTotals['CostTotal']); ?></button>
		</div>
	</div>
	<div class="col-md-2 col-sm-4 col-lg-2">
		<div class="d-grid gap-2 col-12 ">
			<b><span class="en">Profit</span><span class="ar"><?= getArabicTitle('Profit') ?></span></b><br />
			<button style="width: 130px; text-align: left" type="button" class="btn btn-<?php echo ($fetchAllTotals['Profit'] < 0) ? 'danger' : 'info'; ?> m-r-sm"><?php echo AmountValue($fetchAllTotals['Profit']); ?></button>
		</div>
	</div>
	<div class="col-md-2 col-sm-4 col-lg-2">
		<div class="d-grid gap-2 col-12 ">
			<b><span class="en">Vat Total</span><span class="ar"><?= getArabicTitle('Vat Total') ?></span></b><br />
			<button style="width: 130px; text-align: left" type="button" class="btn btn-<?php echo ($fetchAllTotals['vatTotal'] < 0) ? 'danger' : 'info'; ?> m-r-sm"><?php echo AmountValue($fetchAllTotals['vatTotal']); ?></button>
		</div>
	</div>
	<div class="col-md-2 col-sm-4 col-lg-2">
		<div class="d-grid gap-2 col-12 ">
			<b><span class="en">Net(Vat+S.Total)</span><span class="ar"><?= getArabicTitle('Net(Vat+S.Total)') ?></span></b><br />
			<button style="width: 130px; text-align: left" type="button" class="btn btn-<?php echo ($fetchAllTotals['vatPTotal'] < 0) ? 'danger' : 'info'; ?> m-r-sm"><?php echo AmountValue($fetchAllTotals['vatPTotal']); ?></button>
		</div>
	</div>
	<!-- <div class="col-md-2 col-sm-4 col-lg-2">
		<div class="d-grid gap-2 col-12 ">
			<b><span class="en">AdvTax</span><span class="ar"><?= getArabicTitle('AdvTax') ?></span></b><br />
			<button style="width: 130px; text-align: left" type="button" class="btn btn-<?php echo ($fetchAllTotals['AdvTax'] < 0) ? 'danger' : 'info'; ?> m-r-sm"><?php echo AmountValue($fetchAllTotals['AdvTax']); ?></button>
		</div>
	</div>
	<div class="col-md-2 col-sm-4 col-lg-2">
		<div class="d-grid gap-2 col-12 ">
			<b><span class="en">GGTotal</span><span class="ar"><?= getArabicTitle('GGTotal') ?></span></b><br />
			<button style="width: 130px; text-align: left" type="button" class="btn btn-<?php echo ($fetchAllTotals['GGTotal'] < 0) ? 'danger' : 'info'; ?> m-r-sm"><?php echo AmountValue($fetchAllTotals['GGTotal']); ?></button>
		</div>
	</div> -->
</div>

<hr>
<div class="col-md-12 col-sm-12 col-lg-12 mb-4 text-center">
	<div class="d-grid gap-2 col-12 pl-0">
		<button style="width: 130px;" type="button" class="btn btn-w-m btn-outline-primary" id="reportPRint" onclick="PrintPopup('<?= $print ?>', 'Sales Report Details', 'saleDetailProduct')"><i class="fa fa-print" aria-hidden="true"></i></button>
	</div>
</div>
<hr>
<!-- Listing -->
<table class="table table-striped table-bordered dt-responsive table-hover">
	<thead>
		<tr>
			<!-- <th><span class="en">BillNo</span><span class="ar"><?= getArabicTitle('BillNo') ?></span></th> -->
			<!-- <th><span class="en">Bill Date / Time</span><span class="ar"><?= getArabicTitle('Bill Date / Time') ?></span></th> -->
			<!-- <th><span class="en">Customer</span><span class="ar"><?= getArabicTitle('Customer') ?></span></th> -->
			<th><span class="en">Product Code</span><span class="ar"><?= getArabicTitle('Product Code') ?></span></th>
			<th><span class="en">Product Name</span><span class="ar"><?= getArabicTitle('Product Name') ?></span></th>
			<th><span class="en">Quantity</span><span class="ar"><?= getArabicTitle('Quantity') ?></span></th>
			<th><span class="en">Bonus</span><span class="ar"><?= getArabicTitle('Bonus') ?></span></th>
			<th><span class="en">Unit</span><span class="ar"><?= getArabicTitle('Unit') ?></span></th>
			<!-- <th><span class="en">Price</span><span class="ar"><?= getArabicTitle('Price') ?></span></th> -->
			<th><span class="en">Net Total</span><span class="ar"><?= getArabicTitle('Net Total') ?></span></th>
			<!-- <th><span class="en">SalesType</span><span class="ar"><?= getArabicTitle('SalesType') ?></span></th> -->
			<!-- <th><span class="en">Cost Price</span><span class="ar"><?= getArabicTitle('Cost Price') ?></span></th> -->
			<th><span class="en">Cost Total</span><span class="ar"><?= getArabicTitle('Cost Total') ?></span></th>
			<th><span class="en">Profit</span><span class="ar"><?= getArabicTitle('Profit') ?></span></th>
			<!-- <th><span class="en">Profit %</span><span class="ar"><?= getArabicTitle('Profit') ?> %</span></th> -->
			<!-- <th><span class="en">Vat Amount</span><span class="ar"><?= getArabicTitle('Vat Amount') ?></span></th> -->
			<th><span class="en">Vat Total</span><span class="ar"><?= getArabicTitle('Vat Total') ?></span></th>
			<th><span class="en">Net(Vat+S.Total)</span><span class="ar"><?= getArabicTitle('Net(Vat+S.Total)') ?></span></th>
			<!-- <th><span class="en">Vat %</span><span class="ar"><?= getArabicTitle('Vat') ?> %</span></th> -->
			<!-- <th><span class="en">GrandTotal</span><span class="ar"><?= getArabicTitle('GrandTotal') ?></span></th> -->
			<!-- <th><span class="en">AdvTaxPer</span><span class="ar"><?= getArabicTitle('AdvTaxPer') ?></span></th> -->
			<!-- <th><span class="en">AdvTax</span><span class="ar"><?= getArabicTitle('AdvTax') ?></span></th> -->
			<!-- <th><span class="en">GGTotal</span><span class="ar"><?= getArabicTitle('GGTotal') ?></span></th> -->
			<!-- <th><span class="en">UserName</span><span class="ar"><?= getArabicTitle('UserName') ?></span></th> -->
			<th><span class="en">Branch</span><span class="ar"><?= getArabicTitle('Branch') ?></span></th>
		</tr>
	</thead>
	<tbody>

		<?php
		if ($pages->items_total > 0) {
			$cnt = 1;
			while ($single  =   myfetch($result)) {
				echo '<tr>'; ?>

				<!-- <td><span class="text-warp"><?php echo $single->BillNo; ?> </span></td> -->
				<!-- <td><span class="text-warp"><?php echo DateValue($single->BillDateTime); ?> </span></td> -->
				<!-- <td><span class="text-warp"><?php echo $single->CustSupName; ?> </span></td> -->
				<td><span class="text-warp"><?php echo AmountValue($single->ProductCode); ?> </span></td>
				<td><span class="text-warp"><?php echo $single->ProductName; ?> </span></td>
				<td><span class="text-warp"><?php echo AmountValue($single->Quantity); ?> </span></td>
				<td><span class="text-warp"><?php echo AmountValue($single->Bonus); ?> </span></td>
				<td><span class="text-warp"><?php echo $single->UnitName; ?> </span></td>
				<!-- <td><span class="text-warp"><?php echo AmountValue($single->Price); ?> </span></td> -->
				<td><span class="text-warp"><?php echo AmountValue($single->NetTotal); ?> </span></td>
				<!-- <td><span class="text-warp"><?php echo $single->stype; ?> </span></td> -->
				<!-- <td><span class="text-warp"><?php echo AmountValue($single->CostPrice); ?> </span></td> -->
				<td><span class="text-warp"><?php echo AmountValue($single->CostTotal); ?> </span></td>
				<td><span class="text-warp"><?php echo AmountValue($single->Profit); ?> </span></td>
				<!-- <td><span class="text-warp"><?php echo AmountValue($single->ProfitPer); ?> </span></td> -->
				<!-- <td><span class="text-warp"><?php echo AmountValue($single->VatAmount); ?> </span></td> -->
				<td><span class="text-warp"><?php echo AmountValue($single->vatTotal); ?> </span></td>
				<td><span class="text-warp"><?php echo AmountValue($single->vatPTotal); ?> </span></td>
				<!-- <td><span class="text-warp"><?php echo AmountValue($single->VatPerCent); ?> </span></td> -->
				<!-- <td><span class="text-warp"><?php echo AmountValue($single->GrandTotal); ?> </span></td> -->
				<!-- <td><span class="text-warp"><?php echo AmountValue($single->AdvTaxPer); ?> </span></td> -->
				<!-- <td><span class="text-warp"><?php echo AmountValue($single->AdvTax); ?> </span></td> -->
				<!-- <td><span class="text-warp"><?php echo AmountValue($single->GGTotal); ?> </span></td> -->
				<!-- <td><span class="text-warp"><?php echo $single->UserName; ?> </span></td> -->
				<td><span class="text-warp"><?php echo $single->BName; ?> </span></td>

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
		} ?>
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