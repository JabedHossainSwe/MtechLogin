<?php
$mainStoreProcedure = "EXECUTE " . dbObject . "[SaleVatReport] 
@LanguageID = $lang, 
@BID = $bid, 
@PayType = $pay_type, @FromDate = '$dt',
@ToDate = '$dt2', @CustomerCode = $customer_id";

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
$print = urlencode($mmQ);
$result = Run($mmQ);
?>


<div class="col-md-12 col-sm-12 col-lg-12 mb-4 text-center">
	<div class="d-grid gap-2 col-12 pl-0">
		<button style="width: 130px;" type="button" class="btn btn-w-m btn-outline-primary" id="reportPRint" onclick="PrintPopup('<?= $print ?>', 'Vat Sale Report', 'vatSaleReport')"><i class="fa fa-print" aria-hidden="true"></i></button>
	</div>
</div>
<hr>
<!-- Listing -->
<table class="table table-striped table-bordered dt-responsive table-hover">
	<thead>
		<tr>
			<th><span class="en">S.N</span><span class="ar"><?= getArabicTitle('S.N') ?></span></th>
			<th><span class="en">Invoice Date</span><span class="ar"><?= getArabicTitle('Invoice Date') ?></span></th>
			<th><span class="en">Sales Total</span><span class="ar"><?= getArabicTitle('Sales Total') ?></span></th>
			<th><span class="en">S.Discount</span><span class="ar"><?= getArabicTitle('S.Discount') ?></span></th>
			<th><span class="en">S.Net Total</span><span class="ar"><?= getArabicTitle('S.Net Total') ?></span></th>
			<th><span class="en">S.Vat Total</span><span class="ar"><?= getArabicTitle('S.Vat Total') ?></span></th>
			<th><span class="en">Grand Total</span><span class="ar"><?= getArabicTitle('Grand Total') ?></span></th>
			<th><span class="en">Return Total</span><span class="ar"><?= getArabicTitle('Return Total') ?></span></th>
			<th><span class="en">R.Discount</span><span class="ar"><?= getArabicTitle('R.Discount') ?></span></th>
			<th><span class="en">R.Net Total</span><span class="ar"><?= getArabicTitle('R.Net Total') ?></span></th>
			<th><span class="en">R.Vat Total</span><span class="ar"><?= getArabicTitle('R.Vat Total') ?></span></th>
			<th><span class="en">Grand Total</span><span class="ar"><?= getArabicTitle('Grand Total') ?></span></th>
			<th><span class="en">Net Sales Amount</span><span class="ar"><?= getArabicTitle('Net Sales Amount') ?></span></th>
			<th><span class="en">Net Vat Amount</span><span class="ar"><?= getArabicTitle('Net Vat Amount') ?></span></th>
		</tr>
	</thead>
	<tbody>

		<?php
		if ($pages->items_total > 0) {
			$cnt = 1;
			while ($single  =   myfetch($result)) {
				echo '<tr>'; ?>

				<td><span class="text-warp"><?php echo $cnt; ?> </span></td>
				<td><span class="text-warp"><?php echo DateValue($single->BillDate); ?> </span></td>
				<td><span class="text-warp"><?php echo AmountValue($single->SalTotal); ?> </span></td>
				<td><span class="text-warp"><?php echo AmountValue($single->DiscountSal); ?> </span></td>
				<td><span class="text-warp"><?php echo AmountValue($single->SalNetTotal); ?> </span></td>
				<td><span class="text-warp"><?php echo AmountValue($single->SalVatTotal); ?> </span></td>
				<td><span class="text-warp"><?php echo AmountValue($single->VatSalTotal); ?> </span></td>
				<td><span class="text-warp"><?php echo AmountValue($single->RetTotal); ?> </span></td>
				<td><span class="text-warp"><?php echo AmountValue($single->DiscountRet); ?> </span></td>
				<td><span class="text-warp"><?php echo AmountValue($single->RetNetTotal); ?> </span></td>
				<td><span class="text-warp"><?php echo AmountValue($single->RetVatTotal); ?> </span></td>
				<td><span class="text-warp"><?php echo AmountValue($single->VatRetTotal); ?> </span></td>
				<td><span class="text-warp"><?php echo AmountValue($single->NetSalesAmount); ?> </span></td>
				<td><span class="text-warp"><?php echo AmountValue($single->NetVatAmount); ?> </span></td>
													

				<?php
				?>
				</tr>
			<?php
				$cnt++;
			}
		} else {
			?>
			<tr>
				<td colspan="14" class="text-center">
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