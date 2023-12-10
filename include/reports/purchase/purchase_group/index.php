<?php
$PosId = "1992";

$mainStoreProcedure = "EXEC  " . dbObject . "GetPurGroup @bid='" . $bid . "',@PosId='" . $PosId . "',@SpType='" . $SpType . "',@FBillno='" . $FBillno . "',@TBillno='" . $TBillno . "',@dt='" . $dt . "',@dt2='" . $dt2 . "',@CustSupId='" . $CustSupId . "',@UsrId='" . $UsrId . "',@LanguageId='" . $LanguageId . "',@PurType ='" . $PurType . "',@PurChaser ='" . $PurChaser . "',@VatType  ='" . $VatType . "',@FPid='" . $FPid . "',@TPrid='" . $TPrid . "',@PGroupId='" . $PGroupId . "'";
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
			<b><span class="en">NetTotal</span><span class="ar"><?= getArabicTitle('NetTotal') ?></span></b><br />
			<button style="width: 130px; text-align: left" type="button" class="btn btn-<?php echo ($fetchAllTotals['NetTotal'] < 0) ? 'danger':'info'; ?> m-r-sm"><?php echo AmountValue($fetchAllTotals['NetTotal']); ?></button>
		</div>
	</div>
	
	<div class="col-md-2 col-sm-4 col-lg-2">
		<div class="d-grid gap-2 col-12 ">
			<b><span class="en">PurRetTotal</span><span class="ar"><?= getArabicTitle('PurRetTotal') ?></span></b><br />
			<button style="width: 130px; text-align: left" type="button" class="btn btn-<?php echo ($fetchAllTotals['PurRetTotal'] < 0) ? 'danger':'info'; ?> m-r-sm"><?php echo AmountValue($fetchAllTotals['PurRetTotal']); ?></button>
		</div>
	</div>
	<div class="col-md-2 col-sm-4 col-lg-2">
		<div class="d-grid gap-2 col-12 ">
			<b><span class="en">NetPurchase</span><span class="ar"><?= getArabicTitle('NetPurchase') ?></span></b><br />
			<button style="width: 130px; text-align: left" type="button" class="btn btn-<?php echo ($fetchAllTotals['NetPurchase'] < 0) ? 'danger':'info'; ?> m-r-sm"><?php echo AmountValue($fetchAllTotals['NetPurchase']); ?></button>
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
			<b><span class="en">VatTotalPurRet</span><span class="ar"><?= getArabicTitle('VatTotalPurRet') ?></span></b><br />
			<button style="width: 130px; text-align: left" type="button" class="btn btn-<?php echo ($fetchAllTotals['VatTotalPurRet'] < 0) ? 'danger':'info'; ?> m-r-sm"><?php echo AmountValue($fetchAllTotals['VatTotalPurRet']); ?></button>
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
		<button style="width: 130px;" type="button" class="btn btn-w-m btn-outline-primary" id="reportPRint" onclick="PrintPopup('<?= $print ?>', 'Purchase Report Group', 'purchaseGroup')"><i class="fa fa-print" aria-hidden="true"></i></button>
	</div>
</div>
<hr>
<!-- Listing -->
<table class="table table-striped table-bordered dt-responsive table-hover ">
	<thead>
		<tr>
			<th><span class="en">GroupName</span><span class="ar"><?= getArabicTitle('GroupName') ?></span></th>
			<th><span class="en">NetTotal</span><span class="ar"><?= getArabicTitle('NetTotal') ?></span></th>
			<th><span class="en">PurRetTotal</span><span class="ar"><?= getArabicTitle('PurRetTotal') ?></span></th>
			<th><span class="en">NetPurchase</span><span class="ar"><?= getArabicTitle('NetPurchase') ?></span></th>
			<th><span class="en">VatTotal</span><span class="ar"><?= getArabicTitle('VatTotal') ?></span></th>
			<th><span class="en">VatTotalPurRet</span><span class="ar"><?= getArabicTitle('VatTotalPurRet') ?></span></th>
			<th><span class="en">GrandTotal</span><span class="ar"><?= getArabicTitle('GrandTotal') ?></span> </th>
		</tr>
	</thead>
	<tbody>
	<?php
	if ($pages->items_total > 0) {
		$cnt = 1;
		while ($single  =   myfetch($result)) {
			echo '<tr>'; ?>

			<td><span class="text-warp"><?php echo $single->GroupName; ?> </span></td>
			<td><span class="text-warp"><?php echo AmountValue($single->NetTotal); ?> </span></td>
			<td><span class="text-warp"><?php echo AmountValue($single->PurRetTotal); ?> </span></td>
			<td><span class="text-warp"><?php echo AmountValue($single->NetPurchase); ?> </span></td>
			<td><span class="text-warp"><?php echo AmountValue($single->VatTotal); ?> </span></td>
			<td><span class="text-warp"><?php echo AmountValue($single->VatTotalPurRet); ?> </span></td>
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