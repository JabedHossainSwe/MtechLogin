<?php

$pos_id = "1992";

$mainStoreProcedure = "EXEC  " . dbObject . "GetSalesReturnGroup  @bid='" . $bid . "',@SpType='" . $SpType . "',@FBillno='" . $FBillno . "',@TBillno='" . $TBillno . "',@dt='" . $dt . "',@dt2='" . $dt2 . "',@CustSupId='" . $CustSupId . "',@UsrId='" . $UsrId . "',@LanguageId='" . $LanguageId . "'";
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

$mmQ = $mainStoreProcedure . $DataType . $initialLimit;


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
			<b><span class="en">Total</span><span class="ar"><?= getArabicTitle('Total') ?></span></b><br />
			<button style="width: 130px; text-align: left" type="button" class="btn btn-<?php echo ($fetchAllTotals['Total'] < 0) ? 'danger':'info'; ?> m-r-sm"><?php echo AmountValue($fetchAllTotals['Total']); ?></button>
		</div>
	</div>
	
	<div class="col-md-2 col-sm-4 col-lg-2">
		<div class="d-grid gap-2 col-12 ">
			<b><span class="en">Discount</span><span class="ar"><?= getArabicTitle('Discount') ?></span></b><br />
			<button style="width: 130px; text-align: left" type="button" class="btn btn-<?php echo ($fetchAllTotals['Discount'] < 0) ? 'danger':'info'; ?> m-r-sm"><?php echo AmountValue($fetchAllTotals['Discount']); ?></button>
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
			<b><span class="en">CostTotal</span><span class="ar"><?= getArabicTitle('CostTotal') ?></span></b><br />
			<button style="width: 130px; text-align: left" type="button" class="btn btn-<?php echo ($fetchAllTotals['CostTotal'] < 0) ? 'danger':'info'; ?> m-r-sm"><?php echo AmountValue($fetchAllTotals['CostTotal']); ?></button>
		</div>
	</div>
	<div class="col-md-2 col-sm-4 col-lg-2">
		<div class="d-grid gap-2 col-12 ">
			<b><span class="en">VatTotal</span><span class="ar"><?= getArabicTitle('VatTotal') ?></span></b><br />
			<button style="width: 130px; text-align: left" type="button" class="btn btn-<?php echo ($fetchAllTotals['VatTotal'] < 0) ? 'danger':'info'; ?> m-r-sm"><?php echo AmountValue($fetchAllTotals['VatTotal']); ?></button>
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
		<button style="width: 130px;" type="button" class="btn btn-w-m btn-outline-primary" id="reportPRint" onclick="PrintPopup('<?= $print ?>', 'Sales Return Group', 'SaleRetunGroup')"><i class="fa fa-print" aria-hidden="true"></i></button>
	</div>
</div>
<hr>
<!-- Listing -->
<table class="table table-striped table-bordered dt-responsive table-hover ">
	<thead>
		<tr>
			<th><span class="en">Product Group</span><span class="ar"><?= getArabicTitle('Product Group') ?></span></th>
			<th><span class="en">Total</span><span class="ar"><?= getArabicTitle('Total') ?></span></th>
			<th><span class="en">Discount</span><span class="ar"><?= getArabicTitle('Discount') ?></span></th>
			<th><span class="en">Discount%</span><span class="ar"><?= getArabicTitle('Discount') ?>%</span></th>
			<th><span class="en">NetTotal</span><span class="ar"><?= getArabicTitle('NetTotal') ?></span></th>
			<th><span class="en">CostTotal</span><span class="ar"><?= getArabicTitle('CostTotal') ?></span></th>
			<th><span class="en">VatTotal</span><span class="ar"><?= getArabicTitle('VatTotal') ?></span></th>
			<th><span class="en">GrandTotal</span><span class="ar"><?= getArabicTitle('GrandTotal') ?></span></th>
		</tr>
	</thead>
	<tbody>

	<?php
	if ($pages->items_total > 0) {
		$cnt = 1;
		while ($single  =   myfetch($result)) {
			echo '<tr>'; ?>

			<td><span class="text-warp"><?php echo $single->NameArb; ?> </span></td>
			<td><span class="text-warp"><?php echo AmountValue($single->Total); ?> </span></td>
			<td><span class="text-warp"><?php echo AmountValue($single->Discount); ?> </span></td>
			<td><span class="text-warp"><?php echo AmountValue($single->Disper); ?> </span></td>
			<td><span class="text-warp"><?php echo AmountValue($single->NetTotal); ?> </span></td>
			<td><span class="text-warp"><?php echo AmountValue($single->CostTotal); ?> </span></td>
			<td><span class="text-warp"><?php echo AmountValue($single->VatTotal); ?> </span></td>
			<td><span class="text-warp"><?php echo AmountValue($single->GrandTotal); ?> </span></td>

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
					<h2><strong><span class="en">No Record(s) Found..</span><span class="ar"><?= getArabicTitle('No Record(s) Found..') ?></span></strong></h2>
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