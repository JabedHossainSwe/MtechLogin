<?php

$mainStoreProcedure = "EXEC  " . dbObject . "GetExpenseGen @bid='" . $bid . "',@GroupByType='" . $GroupByType . "',@FBillno='" . $FBillno . "',@TBillno='" . $TBillno . "',@dt='" . $dt . "',@dt2='" . $dt2 . "',@CustSupId='" . $CustSupId . "',@UsrId='" . $UsrId . "',@LanguageId='" . $LanguageId . "',@ExpenseId=" . $ExpenseId;
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

if($_GET['GroupByType'] == 0){
	$pLink = 'expenseGeneralNone';
}
elseif($_GET['GroupByType'] == 1){
	$pLink = 'expenseGeneralExpense';
}
elseif($_GET['GroupByType'] == 2){
	$pLink = 'expenseGeneralDate';
}


?>


<div class="row mb-2">
	<?php if($_GET['GroupByType'] == 0){ ?>
	<div class="col-md-2 col-sm-4 col-lg-2">
		<div class="d-grid gap-2 col-12 ">
			<b><span class="en">Amount</span><span class="ar"><?= getArabicTitle('Amount') ?></span></b><br />
			<button style="width: 130px; text-align: left" type="button" class="btn btn-<?php echo ($fetchAllTotals['Amount'] < 0) ? 'danger':'info'; ?> m-r-sm"><?php echo AmountValue($fetchAllTotals['Amount']); ?></button>
		</div>
	</div>
	

	<div class="col-md-2 col-sm-4 col-lg-2">
		<div class="d-grid gap-2 col-12 ">
			<b><span class="en">VatAmount</span><span class="ar"><?= getArabicTitle('VatAmount') ?></span></b><br />
			<button style="width: 130px; text-align: left" type="button" class="btn btn-<?php echo ($fetchAllTotals['VatAmount'] < 0) ? 'danger':'info'; ?> m-r-sm"><?php echo AmountValue($fetchAllTotals['VatAmount']); ?></button>
		</div>
	</div>
	<?php } ?>

	<div class="col-md-2 col-sm-4 col-lg-2">
		<div class="d-grid gap-2 col-12 ">
			<b><span class="en">GTotal</span><span class="ar"><?= getArabicTitle('GTotal') ?></span></b><br />
			<button style="width: 130px; text-align: left" type="button" class="btn btn-<?php echo ($fetchAllTotals['GTotal'] < 0) ? 'danger':'info'; ?> m-r-sm"><?php echo AmountValue($fetchAllTotals['GTotal']); ?></button>
		</div>
	</div>

</div>

<hr>
<div class="col-md-12 col-sm-12 col-lg-12 mb-4 text-center">
	<div class="d-grid gap-2 col-12 pl-0">
		<button style="width: 130px;" type="button" class="btn btn-w-m btn-outline-primary" id="reportPRint" onclick="PrintPopup('<?= $print ?>', 'Expense Report General', '<?= $pLink ?>')"><i class="fa fa-print" aria-hidden="true"></i></button>
	</div>
</div>
<hr>
<!-- Listing -->
<table class="table table-striped table-bordered dt-responsive table-hover ">
	<thead>
		<tr>
			<?php if($_GET['GroupByType'] == 0){ ?>
				<th><span class="en">Bill No</span><span class="ar"><?= getArabicTitle('Bill No') ?></span></th>
			<?php } ?>

			<?php if($_GET['GroupByType'] == 0 OR $_GET['GroupByType'] == 2){ ?>
				<th><span class="en">Bill Date</span><span class="ar"><?= getArabicTitle('Bill Date') ?></span></th>
			<?php } ?>

			<?php if($_GET['GroupByType'] == 0){ ?>
				<th><span class="en">Amount</span><span class="ar"><?= getArabicTitle('Amount') ?></span></th>
				<th><span class="en">VatAmount</span><span class="ar"><?= getArabicTitle('VatAmount') ?></span></th>
			<?php } ?>

			<?php if($_GET['GroupByType'] == 1){ ?>
				<th><span class="en">ExpenseName</span><span class="ar"><?= getArabicTitle('ExpenseName') ?></span></th>
			<?php } ?>

			<th><span class="en">GTotal</span><span class="ar"><?= getArabicTitle('GTotal') ?></span></th>

			<?php if($_GET['GroupByType'] == 0){ ?>
				<th><span class="en">Remark</span><span class="ar"><?= getArabicTitle('Remark') ?></span></th>
				<th><span class="en">Supplier</span><span class="ar"><?= getArabicTitle('Supplier') ?></span> </th>
				<th><span class="en">User</span><span class="ar"><?= getArabicTitle('User') ?></span></th>
			<?php } ?>

			<th><span class="en">Branch</span><span class="ar"><?= getArabicTitle('Branch') ?></span></th>
		</tr>
	</thead>
	<tbody>
	<?php
	if ($pages->items_total > 0) {
		$cnt = 1;
		while ($single  =   myfetch($result)) {
			echo '<tr>'; ?>

			<?php if($_GET['GroupByType'] == 0){ ?>
				<td><span class="text-warp"><?php echo $single->Billno; ?> </span></td>
			<?php } ?>

			<?php if($_GET['GroupByType'] == 0 OR $_GET['GroupByType'] == 2){ ?>
				<td><span class="text-warp"><?php echo DateValue($single->BillDateTime); ?> </span></td>
			<?php } ?>

			<?php if($_GET['GroupByType'] == 0){ ?>
				<td><span class="text-warp"><?php echo AmountValue($single->Amount); ?> </span></td>
				<td><span class="text-warp"><?php echo AmountValue($single->VatAmount); ?> </span></td>
			<?php } ?>

			<?php if($_GET['GroupByType'] == 1){ ?>
				<td><span class="text-warp"><?php echo AmountValue($single->ExpenseName); ?> </span></td>
			<?php } ?>

			<td><span class="text-warp"><?php echo AmountValue($single->GTotal); ?> </span></td>

			<?php if($_GET['GroupByType'] == 0){ ?>
				<td><span class="text-warp"><?php echo AmountValue($single->Remark); ?> </span></td>
				<td><span class="text-warp"><?php echo AmountValue($single->SupName); ?> </span></td>
				<td><span class="text-warp"><?php echo $single->UserName; ?> </span></td>
			<?php } ?>

			<td><span class="text-warp"><?php echo $single->BranchName; ?> </span></td>

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