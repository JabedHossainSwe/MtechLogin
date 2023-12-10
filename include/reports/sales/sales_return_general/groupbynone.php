<?php

$mainStoreProcedure = "EXEC  " . dbObject . "GetSalesReturnGen @bid='" . $bid . "',@GroupByType='" . $GroupByType . "',@SpType='" . $SpType . "',@FBillno='" . $FBillno . "',@TBillno='" . $TBillno . "',@dt='" . $dt . "',@dt2='" . $dt2 . "',@CustSupId='" . $CustSupId . "',@UsrId='" . $UsrId . "',@IsNoVatOnInvoice='" . $IsNoVatOnInvoice . "',@LanguageId='" . $LanguageId . "',@OrderBy='" . $OrderBy . "'";
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
			<b><span class="en">Discount%</span><span class="ar"><?= getArabicTitle('Discount') ?>%</span></b><br />
			<button style="width: 130px; text-align: left" type="button" class="btn btn-<?php echo ($fetchAllTotals['disper'] < 0) ? 'danger':'info'; ?> m-r-sm"><?php echo AmountValue($fetchAllTotals['disper']); ?></button>
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
			<b><span class="en">TotalVat</span><span class="ar"><?= getArabicTitle('TotalVat') ?></span></b><br />
			<button style="width: 130px; text-align: left" type="button" class="btn btn-<?php echo ($fetchAllTotals['TotalVat'] < 0) ? 'danger':'info'; ?> m-r-sm"><?php echo AmountValue($fetchAllTotals['TotalVat']); ?></button>
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
		<button style="width: 130px;" type="button" class="btn btn-w-m btn-outline-primary" id="reportPRint" onclick="PrintPopup('<?= $print ?>', 'Sales Return General', 'saleReturnGeneralNone')"><i class="fa fa-print" aria-hidden="true"></i></button>
	</div>
</div>
<hr>
<!-- Listing -->
<table class="table table-striped table-bordered dt-responsive table-hover ">
	<thead>
		<tr>
			<th><span class="en">BillNo</span><span class="ar"><?= getArabicTitle('BillNo') ?></span></th>
			<th><span class="en">Bill Date / Time</span><span class="ar"><?= getArabicTitle('Bill Date / Time') ?></span></th>
			<th><span class="en">Customer</span><span class="ar"><?= getArabicTitle('Customer') ?></span></th>
			<th><span class="en">Total</span><span class="ar"><?= getArabicTitle('Total') ?></span></th>
			<th><span class="en">Discount</span><span class="ar"><?= getArabicTitle('Discount') ?></span></th>
			<th><span class="en">Discount%</span><span class="ar"><?= getArabicTitle('Discount') ?>%</span></th>
			<th><span class="en">NetTotal</span><span class="ar"><?= getArabicTitle('NetTotal') ?></span></th>
			<th><span class="en">TotalVat</span><span class="ar"><?= getArabicTitle('TotalVat') ?></span> </th>
			<th><span class="en">GrandTotal</span><span class="ar"><?= getArabicTitle('GrandTotal') ?></span></th>
			<th><span class="en">User</span><span class="ar"><?= getArabicTitle('User') ?></span></th>
			<th><span class="en">Branch</span><span class="ar"><?= getArabicTitle('Branch') ?></span> </th>
			<th><span class="en">Sale Type</span><span class="ar"><?= getArabicTitle('Sale Type') ?></span> </th>
		</tr>
	</thead>
	<tbody>
	<?php
	if ($pages->items_total > 0) {
		$cnt = 1;
		while ($single  =   myfetch($result)) {
			echo '<tr>'; ?>

			<td><span class="text-warp"><?php echo $single->BillNo; ?> </span></td>
			<td><span class="text-warp"><?php echo DateValueTime($single->BillDateTime); ?> </span></td>
			<td><span class="text-warp"><?php echo $single->CustSupName; ?> </span></td>
			<td><span class="text-warp"><?php echo AmountValue($single->Total); ?> </span></td>
			<td><span class="text-warp"><?php echo AmountValue($single->Discount); ?> </span></td>
			<td><span class="text-warp"><?php echo AmountValue($single->disper); ?> </span></td>
			<td><span class="text-warp"><?php echo AmountValue($single->NetTotal); ?> </span></td>
			<td><span class="text-warp"><?php echo AmountValue($single->TotalVat); ?> </span></td>
			<td><span class="text-warp"><?php echo AmountValue($single->GrandTotal); ?> </span></td>
			<td><span class="text-warp"><?php echo $single->UserName; ?> </span></td>
			<td><span class="text-warp"><?php echo $single->BranchName; ?> </span></td>
			<td><span class="text-warp"><?php echo $single->stype; ?> </span></td>

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