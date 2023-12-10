<?php
$mainStoreProcedure = "EXEC " . dbObject . "[VATGeneralReport]
@LanguageID = $lang,
@BID = $bid,			
@FromDate = N'$dt',
@ToDate = N'$dt2'";

$initialLimit = ",@FRecNo=0,@ToRecNo=15";
$DataType = ",@DataType=1";

///// Get Total Count/////
$sql_ = $mainStoreProcedure . $DataType . $initialLimit;
$sql_forms = Run($sql_);
$tolrec = myfetch($sql_forms)->RecNo;

$pages->default_ipp = 15;
$pages->items_total = $tolrec;
$pages->mid_range = 9;
$pages->paginate();

$DataType = ",@DataType=3";
$initialLimit = "," . $pages->limit;

///// Main Query/////
$mmQ = $mainStoreProcedure . $DataType . $initialLimit;
// die();
$print = urlencode($mmQ);
$result = Run($mmQ);
?>


<div class="col-md-12 col-sm-12 col-lg-12 mb-4 text-center">
	<div class="d-grid gap-2 col-12 pl-0">
		<button style="width: 130px;" type="button" class="btn btn-w-m btn-outline-primary" id="reportPRint" onclick="PrintPopup('<?= $print ?>', 'Vat Report General', 'vatReportGeneral')"><i class="fa fa-print" aria-hidden="true"></i></button>
	</div>
</div>
<hr>
<!-- Listing -->
<table class="table table-striped table-bordered dt-responsive table-hover">
	<thead>
		<tr>
			<th><span class="en">S.N</span><span class="ar"><?= getArabicTitle('S.N') ?></span></th>
			<th><span class="en">Invoice Date</span><span class="ar"><?= getArabicTitle('Invoice Date') ?></span></th>
			<th><span class="en">Net Sale</span><span class="ar"><?= getArabicTitle('Net Sale') ?></span></th>
			<th><span class="en">Net Sale Vat</span><span class="ar"><?= getArabicTitle('Net Sale Vat') ?></span></th>
			<th><span class="en">Grand Total</span><span class="ar"><?= getArabicTitle('Grand Total') ?></span></th>
			<th><span class="en">Net Purchase</span><span class="ar"><?= getArabicTitle('Net Purchase') ?></span></th>
			<th><span class="en">Net Purchase Vat</span><span class="ar"><?= getArabicTitle('Net Purchase Vat') ?></span></th>
			<th><span class="en">Grand Total</span><span class="ar"><?= getArabicTitle('Grand Total') ?></span></th>
			<th><span class="en">Net Expense</span><span class="ar"><?= getArabicTitle('Net Expense') ?></span></th>
			<th><span class="en">Net Expense Vat</span><span class="ar"><?= getArabicTitle('Net Expense Vat') ?></span></th>
			<th><span class="en">Grand Total</span><span class="ar"><?= getArabicTitle('Grand Total') ?></span></th>
			<th><span class="en">Vat Payable</span><span class="ar"><?= getArabicTitle('Vat Payable') ?></span></th>
		</tr>
	</thead>
	<tbody>

		<?php
		if ($pages->items_total > 0) {
			$cnt = 1;
			while ($single  =   myfetch($result)) {
				echo '<tr>'; ?>

				<td><span class="text-warp"><?php echo $cnt; ?> </span></td>
				<td><span class="text-warp"><?php echo DateValue($single->trnsDate); ?> </span></td>
				<td><span class="text-warp"><?php echo AmountValue($single->NetVatableSale); ?> </span></td>
				<td><span class="text-warp"><?php echo AmountValue($single->NetsalTotalVat); ?> </span></td>
				<td><span class="text-warp"><?php echo AmountValue($single->NetVatPlusTotalSal); ?> </span></td>
				<td><span class="text-warp"><?php echo AmountValue($single->NetVatablePur); ?> </span></td>
				<td><span class="text-warp"><?php echo AmountValue($single->NetPurTotalVat); ?> </span></td>
				<td><span class="text-warp"><?php echo AmountValue($single->NetVatPlusTotalPur); ?> </span></td>
				<td><span class="text-warp"><?php echo AmountValue($single->NetVatableExp); ?> </span></td>
				<td><span class="text-warp"><?php echo AmountValue($single->NetExpTotalVat); ?> </span></td>
				<td><span class="text-warp"><?php echo AmountValue($single->NetVatPlusTotalExp); ?> </span></td>
				<td><span class="text-warp"><?php echo AmountValue($single->VatPayable); ?> </span></td>

				<?php
				?>
				</tr>
			<?php
				$cnt++;
			}
		} else {
			?>
			<tr>
				<td colspan="12" class="text-center">
					<h2><strong><span class="en">No Record(s) Found..</span><span class="ar"><?= getArabicTitle('No Record(s) Found..') ?></span></strong></h2>
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