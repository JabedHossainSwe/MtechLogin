<?php
session_start();
$lang = $_SESSION['lang'];
?>
<!DOCTYPE html>
<html>

<head>

	<meta charset="utf-8">
	<meta name="viewport" content="initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0,target-densitydpi=device-dpi, user-scalable=no" />


	<title>Dashboard</title>

	<link href="assets/css/bootstrap.min.css" rel="stylesheet">
	<link href="assets/font-awesome/css/font-awesome.css" rel="stylesheet">
	<link href="assets/css/animate.css" rel="stylesheet">
	<link href="assets/css/style.css" rel="stylesheet">
	<!-- Data Table -->
	<link href="assets/css/plugins/dataTables/datatables.min.css" rel="stylesheet">
	<!-- Date  -->
	<link href="assets/css/plugins/datapicker/datepicker3.css" rel="stylesheet">
	<link href="assets/css/plugins/iCheck/custom.css" rel="stylesheet">
	<!-- Clock  -->
	<link href="assets/css/plugins/clockpicker/clockpicker.css" rel="stylesheet">
	<!-- Chosen -->
	<link href="assets/css/plugins/chosen/bootstrap-chosen.css" rel="stylesheet">
	<!-- Toastr style -->
	<link href="assets/css/plugins/toastr/toastr.min.css" rel="stylesheet">
	<!-- Select 2 -->
	<link href="assets/css/plugins/select2/select2.min.css" rel="stylesheet">
	<!-- Swithcer -->
	<link href="assets/css/plugins/switchery/switchery.css" rel="stylesheet">
	<!-- Animate Css -->
	<link href="assets/css/animate.css" rel="stylesheet">
	<link href="assets/css/custom.css" rel="stylesheet">
	<style>
		.direction {
			<?php if ($lang == 1) {
				echo " direction: ltr;";
			} else {
				echo "direction: rtl;";
			} ?>
		}

		.direction-ltr {
			direction: ltr !important;
		}

		.direction-rtl {
			direction: rtl !important;
		}
	</style>
</head>

<body class="pace-done mini-navbar">

	<div id="wrapper" class="direction">
		<?php
		include("top-header.php");

		?>


		<?php include_once("config/functions.php"); ?>
		<?php include_once("config/main_functions.php"); ?>





		<div id="page-wrapper" class="gray-bg">
			<?php
			include("sidebar.php");

			?>
			<div class="row wrapper border-bottom white-bg page-heading pb-2">
				<!-- <div class="col-lg-10"> -->
				<h2 class="font-weight-bold"><span class="en">Supplier Account Statement</span><span class="ar"><?= getArabicTitle('Supplier Account Statement') ?></span></h2>

				<!-- </div> -->
			</div>
			<div class="wrapper wrapper-content animated fadeInRight">
				<div class="row mb-3">
					<!-- <div class="col-md-6 col-8">
						<button type="button" class="btn btn-w-m btn-default eng">English</button>
						<button type="button" class="btn btn-w-m btn-default ara">Arabic</button>
					</div> -->
					<div class="col-12">
						<button type="button" class=" btn btn-w-m btn-outline-primary float-right" id="filter"><span class="en">Filters</span><span class="ar"><?= getArabicTitle('Filters') ?></span></button>
					</div>

				</div>
				<div class="row">
					<div class="col-lg-12">
						<div class="ibox">
							<div class="ibox-title">
								<div class="row">
									<!-- <div class="col-md-9"> -->
									<h5 class="mr-4"><span class="en">Filters</span><span class="ar">
											<?= getArabicTitle('Filters') ?>
										</span></h5>
									<!-- </div> -->

								</div>

								<div class="ibox-tools no_envent" style="display: none">
									<a class="collapse-link filter_act">
										<i class="fa fa-chevron-down"></i>
									</a>
								</div>
							</div>
							<form action="" id="" method="get" class="ibox-content filter_container" onsubmit="return validate_form();">
								<input type="text" id="report_type" name="report_type" value="general" hidden>
								<input type="number" id="selected_lang" name="selected_lang" value="<?php !empty($_GET['selected_lang']) ? $_GET['selected_lang'] : '1' ?>" hidden>
								<div class="row">
									<div class="col-6">
										<div class="row">
											<div class="col-md-4">
												<h4><span class="en">Branch Selection</span><span class="ar">
														<?= getArabicTitle('Branch Selection') ?>
													</span></h4>
											</div>

											<div class="col-md-8">
												<div class="form-group">
													<div>
														<select id="branchs" name="branch" class="select2_demo_1 form-control" tabindex="4" required>
															<option value="0">All Branches</option>
															<?php
															$Bracnhes = Run("Select * from " . dbObject . "Branch order by BName ASC");
															$ABoveBranches = $_GET['branch'];
															while ($getBranches = myfetch($Bracnhes)) {
																$selected = "";
																if ($getBranches->Bid == $ABoveBranches) {
																	$selected = "Selected";
																}
															?>
																<option value="<?php echo $getBranches->Bid; ?>" <?php echo $selected; ?>><?php echo $getBranches->BName; ?></option>

															<?php
															}

															?>

														</select>

													</div>
												</div>
											</div>
										</div>
									</div>
									<div class="col-6">
										<div class="row">
											<div class="col-md-4">
												<h4><span class="en">Supplier</span><span class="ar">
														<?= getArabicTitle('Supplier') ?>
													</span></h4>
											</div>
											<div class="col-md-2 col-4">
												<div class="form-group">
													<input type="text" value="<?php echo $_GET['SuppId'] ?>" id="SuppId" name="SuppId" readonly class="form-control" required>
												</div>
											</div>
											<div class="col-md-6 col-8">
												<div class="form-group">
													<div>
														<select id="SpName" name="SpName" class="select2_demo_1 form-control" tabindex="4" onChange="setmyValue(this.value,'SuppId')">

															<?php
															if (isset($_GET['SuppId']) && !empty($_GET['SuppId'])) {
															?>
																<option value="<?php echo $_GET['SuppId']; ?>" selected> <?php echo getSupplierDetails($_GET['SuppId'])->CCode; ?> -
																	<?php echo getSupplierDetails($_GET['SuppId'])->CName; ?>
																</option>
															<?php
															}
															?>
														</select>
													</div>
												</div>
											</div>
										</div>
									</div>
									<div class="col-md-6">
										<div class="row">
											<div class="col-md-4">
												<h4><span class="en">From Bill No</span><span class="ar">
														<?= getArabicTitle('From Bill No') ?>
													</span></h4>
											</div>
											<div class="col-md-8">
												<div class="form-group">
													<input value="<?php echo $_GET['from_bill_no']; ?>" id="from_bill_no" name="from_bill_no" type="text" class="form-control">

												</div>
											</div>
										</div>
									</div>
									<div class="col-md-6">
										<div class="row">
											<div class="col-md-4">
												<h4><span class="en">To Bill No </span><span class="ar">
														<?= getArabicTitle('To Bill No') ?>
													</span></h4>
											</div>
											<div class="col-md-8">
												<div class="form-group"><input id="to_bill_no" value="<?php echo $_GET['to_bill_no']; ?>" name="to_bill_no" type="text" class="form-control"></div>
											</div>
										</div>
									</div>
									<div class="col-md-6">
										<div class="row">
											<div class="col-md-4">
												<h4><span class="en">From Date</span><span class="ar">
														<?= getArabicTitle('From Date') ?>
													</span>
												</h4>
											</div>
											<div class="col-md-8">
												<div class="form-group">
													<div class="input-group date">
														<span class="input-group-addon">
															<i class="fa fa-calendar"></i></span>
														<input id="from_date" name="from_date" type="text" class="form-control" value="<?php echo $_GET['from_date'] ?>" autocomplete="off">
													</div>
												</div>
											</div>
										</div>
									</div>
									<div class="col-md-6">
										<div class="row">
											<div class="col-md-4">
												<h4><span class="en">To Date</span><span class="ar">
														<?= getArabicTitle('To Date') ?>
													</span> </h4>
											</div>
											<div class="col-md-8">
												<div class="form-group">
													<div class="input-group date">
														<span class="input-group-addon">
															<i class="fa fa-calendar"></i></span>
														<input id="to_date" name="to_date" type="text" class="form-control" value="<?php echo $_GET['to_date'] ?>" autocomplete="off">
													</div>
												</div>
											</div>
										</div>
									</div>

									<div class="col-12 row justify-content-center mt-5">
										<div class="col-md-2"><button type="button" class="btn btn-block btn-lg btn-outline-danger" onClick="location.reload()"><span class="en">Exit</span><span class="ar">
													<?= getArabicTitle('Exit') ?>
												</span>
											</button>
										</div>
										<div class="col-md-2">
											<button type="submit" class="btn btn-block btn-lg btn-outline-success" id="seles_report_search" value="Search"><span class="en">Search</span><span class="ar"><?= getArabicTitle('Search') ?></span>
											</button>
										</div>
									</div>
								</div>
							</form>
						</div>
					</div>
				</div>

				<?php
				if (isset($_GET['report_type']) && $_GET['report_type'] == 'general') {

				?>
					<div class="ibox">
						<h2><span class="en float-left">Supplier Account Statement</span><span class="ar float-right"><?= getArabicTitle('Supplier Account Statement') ?></span></h2>
						<div class="ibox-content this_ar">

							<div class="table-responsive">


								<div class="row">
									<div class="col-lg-12" id="sales_report">

										<?php
										include('newpagination/paginator.class.php');


										////////// Form Filters/////
										//////////////// Branches Filter//////////////
										if (isset($_GET['branch']) && !empty($_GET['branch'])) {
											$branch = $_GET['branch'];
											$bid = $branch;
										}


										if (isset($_GET['from_date']) && !empty($_GET['from_date'])) {
											$from_date = urldecode($_GET['from_date']);
											$from_date = date("Y-m-d", strtotime($from_date));
											$dt = $from_date;
										}
										if (isset($_GET['to_date']) && !empty($_GET['to_date'])) {
											$to_date = urldecode($_GET['to_date']);
											$to_date = date("Y-m-d", strtotime($to_date));
											$dt2 = $to_date;
										}
										if (isset($_GET['from_bill_no']) && !empty($_GET['from_bill_no'])) {
											$from_bill_no = urldecode($_GET['from_bill_no']);
											$FBillno = $from_bill_no;
										}

										if (isset($_GET['to_bill_no']) && !empty($_GET['to_bill_no'])) {
											$to_bill_no = urldecode($_GET['to_bill_no']);
											$TBillno = $to_bill_no;
										}

										if (isset($_GET['SuppId']) && !empty($_GET['SuppId'])) {
											$customer_id = urldecode($_GET['SuppId']);
											$SuppId = $customer_id;
										}



										$FBillno = !empty($FBillno) ? $FBillno : '0';
										$TBillno = !empty($TBillno) ? $TBillno : '0';
										$dt = !empty($dt) ? $dt : NULL;
										$dt2 = !empty($dt2) ? $dt2 : NULL;
										$SuppId = !empty($SuppId) ? $SuppId : '0';
										$LanguageId = $_SESSION['lang'] == 1 ? '2' : '1';
										//Main query
										//$LanguageId = 2;

										$pages = new Paginator;

										$mainStoreProcedure = "EXEC " . dbObject . "GetSuppStatement @bid='" . $bid . "',@FBillno='" . $FBillno . "',@TBillno='" . $TBillno . "',@dtF='" . $dt . "',@dtT='" . $dt2 . "',@SuppId='" . $SuppId . "',@lngId='" . $LanguageId . "'";
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
											<div class="col-md-2 col-sm-4 col-lg-2">
												<div class="d-grid gap-2 col-12 ">
													<b><span class="en">Debit</span><span class="ar"><?= getArabicTitle('Debit') ?></span></b><br />
													<button style="width: 130px; text-align: left" type="button" class="btn btn-<?php echo ($fetchAllTotals['Debit'] < 0) ? 'danger' : 'info'; ?> m-r-sm"><?php echo AmountValue($fetchAllTotals['Debit']); ?></button>
												</div>
											</div>
											<div class="col-md-2 col-sm-4 col-lg-2">
												<div class="d-grid gap-2 col-12 ">
													<b><span class="en">Credit</span><span class="ar"><?= getArabicTitle('Credit') ?></span></b><br />
													<button style="width: 130px; text-align: left" type="button" class="btn btn-<?php echo ($fetchAllTotals['Credit'] < 0) ? 'danger' : 'info'; ?> m-r-sm"><?php echo AmountValue($fetchAllTotals['Credit']); ?></button>
												</div>
											</div>
											<?php if (!empty($_GET['SuppId'])) { ?>
												<div class="col-md-2 col-sm-4 col-lg-2">
													<div class="d-grid gap-2 col-12 ">
														<b><span class="en">Balance</span><span class="ar"><?= getArabicTitle('Balance') ?></span></b><br />
														<button style="width: 130px; text-align: left" type="button" class="btn btn-<?php echo ($fetchAllTotals['Balance'] < 0) ? 'danger' : 'info'; ?> m-r-sm"><?php echo AmountValue($fetchAllTotals['Balance']); ?></button>
													</div>
												</div>
											<?php } ?>
										</div>

										<hr>
										<div class="col-md-12 col-sm-12 col-lg-12 mb-4 text-center">
											<div class="d-grid gap-2 col-12 pl-0">
												<button style="width: 130px;" type="button" class="btn btn-w-m btn-outline-primary" id="reportPRint" onclick="PrintPopup('<?= $print ?>', 'Supplier Account Statement', 'accountStatement')"><i class="fa fa-print" aria-hidden="true"></i></button>
											</div>
										</div>
										<hr>
										<!-- Listing -->
										<table class="table table-striped table-bordered dt-responsive table-hover">
											<thead>
												<tr>
													<th><span class="en">TrnsType</span><span class="ar"><?= getArabicTitle('TrnsType') ?></span></th>
													<th><span class="en">Billno</span><span class="ar"><?= getArabicTitle('BillNo') ?></span></th>
													<th><span class="en">Billdate</span><span class="ar"><?= getArabicTitle('BillDate') ?></span></th>
													<th><span class="en">RefNo</span><span class="ar"><?= getArabicTitle('RefNo') ?></span></th>
													<th><span class="en">Notes</span><span class="ar"><?= getArabicTitle('Notes') ?></span></th>
													<th><span class="en">Debit</span><span class="ar"><?= getArabicTitle('Debit') ?></span></th>
													<th><span class="en">Credit</span><span class="ar"><?= getArabicTitle('Credit') ?></span></th>
													<th><span class="en">Balance</span><span class="ar"><?= getArabicTitle('Balance') ?></span></th>
												</tr>
											</thead>
											<tbody>
												<?php
												if ($pages->items_total > 0) {
													$cnt = 1;
													while ($single = myfetch($result)) {
														echo '<tr>'; ?>

														<td><span class="text-warp"><?php echo $single->TrnsType; ?> </span></td>
														<td><span class="text-warp"><?php echo $single->Billno; ?> </span></td>
														<td><span class="text-warp"><?php echo DateValue($single->Billdate); ?> </span></td>
														<td><span class="text-warp"><?php echo $single->RefNo; ?> </span></td>
														<td><span class="text-warp"><?php echo AmountValue($single->Notes); ?> </span></td>
														<td><span class="text-warp"><?php echo AmountValue($single->Debit); ?> </span></td>
														<td><span class="text-warp"><?php echo AmountValue($single->Credit); ?> </span></td>
														<td><span class="text-warp"><?php echo AmountValue($single->Balance); ?> </span></td>

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













									</div>
								</div>

							</div>

						</div>
					</div>
				<?php
				}
				?>


			</div>


			<?php
			include("footer.php");
			?>
		</div>
	</div>
	</div>
	</div>





</body>

</html>
<script src="include/reports/supplier/js.js"></script>
<?php
if (isset($_GET['report_type']) && $_GET['report_type'] == 'general') {
?>
	<script>
		$(document).ready(function() {

			$(".filter_act").click();
			$(".no_envent").toggleClass("displayB");
		});
	</script>

<?php
}
?>