<?php
$mainStoreProcedure = "	EXEC " . dbObject . "[VatDetailReport]
@LanguageID = $lang,
@BID = $bid,			
@FromDate = '$dt',
@ToDate = '$dt2',
@ISNOVAT = $noVat";

// $initialLimit = ",@FRecNo=0,@ToRecNo=15";
// $DataType = ",@DataType=1";

///// Get Total Count/////
// $sql_ = $mainStoreProcedure . $DataType . $initialLimit;
// $sql_ = $mainStoreProcedure . $DataType;
// $sql_forms = Run($sql_);
// $tolrec = myfetch($sql_forms)->RecNo;
// $tolrec = 100;

// $pages->default_ipp = 15;
// $pages->items_total = $tolrec;
// $pages->mid_range = 9;
// $pages->paginate();

$DataType = ",@DataType=3";
// $initialLimit = "," . $pages->limit;

///// Main Query/////
// $mmQ = $mainStoreProcedure . $DataType . $initialLimit;
$mmQ = $mainStoreProcedure . $DataType;
$print = urlencode($mmQ);
$result = Run($mmQ);
$result1 = Run($mmQ);
$count = count(colfetch($result1));
?>


<div class="col-md-12 col-sm-12 col-lg-12 mb-4 text-center">
	<div class="d-grid gap-2 col-12 pl-0">
		<button style="width: 130px;" type="button" class="btn btn-w-m btn-outline-primary" id="reportPRint" onclick="PrintPopup('<?= $print ?>', 'Vat Detail Report', 'vatDetailReport')"><i class="fa fa-print" aria-hidden="true"></i></button>
	</div>
</div>
<hr>
<!-- Listing -->
<table class="table table-striped table-bordered dt-responsive table-hover">
	<thead>
		<tr>
			<th><span class="en">Description</span><span class="ar"><?= getArabicTitle('Description') ?></span></th>
			<th><span class="en">Customer/Supplier</span><span class="ar"><?= getArabicTitle('Customer/Supplier') ?></span></th>
			<th><span class="en">Vat Number</span><span class="ar"><?= getArabicTitle('Vat Number') ?></span></th>
			<th><span class="en">Bill No</span><span class="ar"><?= getArabicTitle('Bill No') ?></span></th>
			<th><span class="en">Bill Date</span><span class="ar"><?= getArabicTitle('Bill Date') ?></span></th>
			<th><span class="en">Total</span><span class="ar"><?= getArabicTitle('Total') ?></span></th>
			<th><span class="en">Discount</span><span class="ar"><?= getArabicTitle('Discount') ?></span></th>
			<th><span class="en">Net Total</span><span class="ar"><?= getArabicTitle('Net Total') ?></span></th>
			<th><span class="en">Vat Amount</span><span class="ar"><?= getArabicTitle('Vat Amount') ?></span></th>
			<th><span class="en">Grand Total</span><span class="ar"><?= getArabicTitle('Grand Total') ?></span></th>
		</tr>
	</thead>
	<tbody>

		<?php
		if ($count) {
			// $cnt = 1;
			while ($single  =   myfetch($result)) {
				echo '<tr>'; ?>

				<td><span class="text-warp en"><?php echo $single->TrnsTypeDesc; ?></span><span class="text-warp ar"><?php echo getArabicTitle($single->TrnsTypeDesc); ?></span></td>
				<td><span class="text-warp"><?php echo $single->CustSuppName; ?> </span></td>
				<td><span class="text-warp"><?php echo $single->VatNo; ?> </span></td>
				<td><span class="text-warp"><?php echo $single->sbBillno; ?> </span></td>
				<td><span class="text-warp"><?php echo DateValue($single->Billdate); ?> </span></td>
				<td><span class="text-warp"><?php echo AmountValue($single->TotalAmount); ?> </span></td>
				<td><span class="text-warp"><?php echo AmountValue($single->VatDisTotal); ?> </span></td>
				<td><span class="text-warp"><?php echo AmountValue($single->TotalAmtVatable); ?> </span></td>
				<td><span class="text-warp"><?php echo AmountValue($single->NetAmount); ?> </span></td>
				<td><span class="text-warp"><?php echo AmountValue($single->totalVat); ?> </span></td>

				<?php
				?>
				</tr>
			<?php
				// $cnt++;
			}
		} else {
			?>
			<tr>
				<td colspan="10" class="text-center">
					<h2><strong><span class="en">No Record(s) Found..</span><span class="ar"><?= getArabicTitle('No Record(s) Found..') ?></span></strong></h2>
				</td>
			</tr>
		<?php
		} ?>
	</tbody>
</table>

<!-- /Listing -->

<!-- <div class="clearfix"></div> -->



<!-- bottom pagination -->

<!-- <div class="row marginTop">

	<div class="col-sm-12 paddingLeft pagerfwt">

		<?php if ($pages->items_total > 0) { ?>

			<?php echo $pages->display_pages(); ?>

			<?php echo $pages->display_items_per_page(); ?>

			<?php echo $pages->display_jump_menu(); ?>

		<?php } ?>

	</div>

	<div class="clearfix"></div>

</div> -->

<!-- /bottom pagination -->



<div class="clearfix"></div>

<div class="clearfix"></div>

<script>
	$(document).ready(function () {
		var lang = document.getElementById("selected_lang").value;
		changeLanguage(lang);
	});
</script>