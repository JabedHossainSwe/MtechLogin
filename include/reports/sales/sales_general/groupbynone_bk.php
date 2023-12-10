<?php

$mainStoreProcedure = "EXEC  " . dbObject . "GetSalesGen @bid='" . $bid . "',@GroupByType='" . $GroupByType . "',@SpType='" . $SpType . "',@FBillno='" . $FBillno . "',@TBillno='" . $TBillno . "',@dt='" . $dt . "',@dt2='" . $dt2 . "',@CustSupId='" . $CustSupId . "',@UsrId='" . $UsrId . "',@CrAmount='" . $amount_type . "" . $CrAmount . "',@LanguageId='" . $LanguageId . "',@OrderBy='" . $OrderBy . "'";
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
$result = Run($mainStoreProcedure . $DataType . $initialLimit);

$mmQ = $mainStoreProcedure . $DataType . $initialLimit;
$print = urlencode($mmQ);


?>


<div class="row mb-2">


	<?php


	foreach ($fetchAllTotals as $key => $value) {
	?>
		<div class="col-md-2 col-sm-4 col-lg-2">

			<?php

			$class = "info";
			if ($value < 0) {
				$class = "danger";
			}
			?>

			<div class="d-grid gap-2 col-6 ">
				<b><?php echo $key; ?></b>
				<br />
				<button style="width: 130px; text-align: left" type="button" class="btn btn-<?php echo $class; ?> m-r-sm"><?php echo AmountValue($value); ?></button>

			</div>
		</div>
	<?php
	}

	?>








</div>

<hr>
<div class="col-md-12 col-sm-12 col-lg-12 mb-4 m-auto text-center">
	<div class="d-grid gap-2 col-12 pl-0">
		<button style="width: 130px;" type="button" class="btn btn-w-m btn-outline-primary" id="reportPRint" onclick="PrintPopup('<?= $print ?>', 'Sales Report General')"><i class="fa fa-print" aria-hidden="true"></i></button>
	</div>
</div>
<hr>
<!-- Listing -->
<table class="table table-striped table-bordered dt-responsive table-hover ">

	<?php
	if ($pages->items_total > 0) {
		$cnt = 1;
		while ($single  =   myfetch($result)) {
			if ($cnt == 1) {
	?>
				<thead>
					<tr>
						<?php
						foreach ($single as $dt => $dv) {
						?>
							<th><?= $dt ?></th>
						<?php
						}
						?>

					</tr>
				</thead>
				<tbody>
				<?php
			}



			echo '<tr>';

			foreach ($single as $key => $value) {

				if (strpos($value, ':') !== false) {
					$value = DateValue($value);
				}


				if (strpos($value, '.') !== false) {
					$value = AmountValue($value);
				}




				?>

					<td>
						<span class="text-warp"><?php echo $value; ?> </span>
						<?php if ($key == 'BillNo') {
						?>
							<!-- <button class="filter btn btn-block btn-outline-success" id="reportEmail" onclick="openPopup('<?= $value ?>','<?= $single->BranchName ?>','')"><i class="fa fa-envelope-o" aria-hidden="true"></i></button>
		<button class="filter btn btn-block btn-outline-success" id="reportPRint" onclick="openPrintPopup('<?= $value ?>','<?= $single->BranchName ?>')"><i class="fa fa-print" aria-hidden="true"></i></button> -->
						<?php } ?>
					</td>
				<?php
			}
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