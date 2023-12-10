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





		<div id="page-wrapper" class="gray-bg">
			<?php
			include("sidebar.php");

			?>

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
							<form action="" id="" method="get" class="ibox-content filter_container">
								<input type="text" id="report_type" name="report_type" value="general" hidden>
								<input type="number" id="selected_lang" name="selected_lang" value="<?php !empty($_GET['selected_lang']) ? $_GET['selected_lang'] : '2' ?>" hidden>
								<div class="row">
									<div class="col-6">
										<div class="row">
											<div class="col-md-3">
												<h4><span class="en">Branch Selection</span><span class="ar">
														<?= getArabicTitle('Branch Selection') ?>
													</span></h4>
											</div>
											<div class="col-md-2">
												<div class="form-group">


													<input type="checkbox" id="branch_all_select" name="branch_all_select" <?php if ($_GET['branch_all_select'] == 'on' || $_GET['branch_all_select'] == '') {
																																echo "checked";
																															} ?> class="js-switch-branch" />
												</div>
											</div>
											<div class="col-md-7">
												<div class="form-group">
													<div>
														<select id="branchs" name="branch[]" class="select2_demo_1 form-control" tabindex="4" multiple disabled>
															<?php
															$Bracnhes = Run("Select * from " . dbObject . "Branch order by BName ASC");
															$ABoveBranches = $_GET['branch'];
															while ($getBranches = myfetch($Bracnhes)) {
																$selected = "";
																if (in_array($getBranches->Bid, $ABoveBranches) && $_GET['branch_all_select'] != 'on') {
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
											<div class="col-md-3">
												<h4><span class="en">Customer</span><span class="ar">
														<?= getArabicTitle('Customer') ?>
													</span></h4>
											</div>
											<div class="col-md-2">
												<div class="form-group">


													<input type="checkbox" id="supplier_all_select" name="supplier_all_select" <?php if (empty($_GET['SpName'])) {
																																	echo "checked='checked' ";
																																} ?> class="js-switch" />
												</div>
											</div>
											<div class="col-7">
												<div class="form-group">
													<div id="">
														<select id="SpName" name="SpName[]" class="select2_demo_1 form-control" multiple <?php if (empty($_GET['SpName'])) {
																																				echo "disabled";
																																			} ?>>
															<?php
															if (!empty($_GET['SpName'])) {
																foreach ($_GET['SpName'] as $sp) {
																	$getSupplierDetails = getCustomerDetails($sp);
															?>
																	<option value="<?= $getSupplierDetails->Cid ?>" selected><?= $getSupplierDetails->CCode . ' - ' . $getSupplierDetails->CName ?></option>
															<?php
																}
															}

															?>
														</select>
													</div>
												</div>
											</div>
										</div>
									</div>

									<div class="col-md-3">
										<div class="row">
											<div class="col-md-5">
												<h4><span class="en">From Date</span><span class="ar">
														<?= getArabicTitle('From Date') ?>
													</span>
												</h4>
											</div>
											<div class="col-md-7">
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
									<div class="col-md-3">
										<div class="row">
											<div class="col-md-5">
												<h4><span class="en">To Date</span><span class="ar">
														<?= getArabicTitle('To Date') ?>
													</span> </h4>
											</div>
											<div class="col-md-7">
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

									<div class="col-md-3">
										<div class="row">
											<div class="col-md-5">
												<h4><span class="en">From Bill No</span><span class="ar">
														<?= getArabicTitle('From Bill No') ?>
													</span></h4>
											</div>
											<div class="col-md-7">
												<div class="form-group">
													<input value="<?php echo $_GET['from_bill_no']; ?>" id="from_bill_no" name="from_bill_no" type="text" class="form-control">

												</div>
											</div>
										</div>
									</div>
									<div class="col-md-3">
										<div class="row">
											<div class="col-md-5">
												<h4><span class="en">To Bill No </span><span class="ar">
														<?= getArabicTitle('To Bill No') ?>
													</span></h4>
											</div>
											<div class="col-md-7">
												<div class="form-group"><input id="to_bill_no" value="<?php echo $_GET['to_bill_no']; ?>" name="to_bill_no" type="text" class="form-control"></div>
											</div>
										</div>
									</div>

									<div class="col-6">
										<div class="row">
											<div class="col-md-3">
												<h4><span class="en">User</span><span class="ar">
														<?= getArabicTitle('User') ?>
													</span></h4>
											</div>
											<div class="col-md-2 col-4">
												<div class="form-group">
													<input type="text" value="<?php echo $_GET['user_id'] ?>" id="user_id" name="user_id" class="form-control">
												</div>
											</div>
											<div class="col-md-7 col-8">
												<div class="form-group">
													<div>
														<select id="user_name" name="user_name" class="select2_demo_1 form-control" tabindex="4" onChange="setmyValue(this.value,'user_id')">

															<?php
															if (isset($_GET['user_id']) && !empty($_GET['user_id'])) {
															?>
																<option value="<?php echo $_GET['user_id']; ?>" selected> <?php echo getUserDetails($_GET['user_id'])->CCode; ?> -
																	<?php echo getUserDetails($_GET['user_id'])->CName; ?>
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
									<div class="col-6">
										<div class="row">
											<div class="col-md-3">
												<h4><span class="en">Sales Person</span><span class="ar">
														<?= getArabicTitle('User') ?>
													</span></h4>
											</div>
											<div class="col-md-2 col-4">
												<div class="form-group">
													<input type="text" value="<?php echo $_GET['SalmanId'] ?>" id="SalmanId" name="SalmanId" class="form-control">
												</div>
											</div>
											<div class="col-md-7 col-8">
												<div class="form-group">
													<div>
														<select id="SalmanId_name" name="SalmanId_name" class="select2_demo_1 form-control" tabindex="4" onChange="setmyValue(this.value,'SalmanId')">

															<?php
															if (isset($_GET['SalmanId']) && !empty($_GET['SalmanId'])) {
															?>
																<option value="<?php echo $_GET['SalmanId']; ?>" selected> <?php echo getUserDetails($_GET['SalmanId'])->CCode; ?> -
																	<?php echo getUserDetails($_GET['SalmanId'])->CName; ?>
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


									<div class="col-md-12 pt-2 toggle_groupbytype">
										<div class="row">
											<div class="col-md-2">
												<h4><span class="en">Group By Type</span><span class="ar">
														<?= getArabicTitle('Group By Type') ?>
													</span>
												</h4>
											</div>
											<div class="col-md-6">
												<div class="row">
													<div class="col-md-4 col-6">
														<div class="i-checks"><label class="">
																<div class="iradio_square-green ">
																	<div class="iradio_square-green">
																		<input type="radio" value="0" <?php if ($_GET['GroupByType'] == '' || $_GET['GroupByType'] == '0') {
																											echo "Checked";
																										} ?> name="GroupByType">
																	</div>
																	<ins class="iCheck-helper"></ins>
																</div> <i></i> <span class="en">Group By None</span><span class="ar">
																	<?= getArabicTitle('Group By None') ?>
																</span>
															</label>
														</div>
													</div>



													<div class="col-md-4 col-6">
														<div class="i-checks"><label class="">
																<div class="iradio_square-green ">
																	<div class="iradio_square-green">
																		<input type="radio" value="1" <?php if ($_GET['GroupByType'] == '1') {
																											echo "Checked";
																										} ?> name="GroupByType">
																	</div>
																	<ins class="iCheck-helper"></ins>
																</div> <i></i> <span class="en">Group By Customer</span><span class="ar">
																	<?= getArabicTitle('Group By Customer') ?>
																</span>
															</label>
														</div>
													</div>
													<div class="col-md-4 col-6">
														<div class="i-checks"><label class="">
																<div class="iradio_square-green ">
																	<div class="iradio_square-green">
																		<input type="radio" value="2" name="GroupByType" <?php if ($_GET['GroupByType'] == '2') {
																																echo "Checked";
																															} ?>>
																	</div>
																	<ins class="iCheck-helper"></ins>
																</div> <i></i> <span class="en">Group by BillDate </span><span class="ar">
																	<?= getArabicTitle('Group by BillDate') ?>
																</span>
															</label>
														</div>
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
											<button type="submit" class="btn btn-block btn-lg btn-outline-success" id="seles_report_search" value="Search"><span class="en">Search</span><span class="ar">
													<?= getArabicTitle('Search') ?>
												</span>
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
						<h2><span class="en float-left">Customer Issue Statement</span><span class="ar float-right"><?= getArabicTitle('Customer Issue Statement') ?></span></h2>
						<div class="ibox-content this_ar">

							<div class="table-responsive">


								<div class="row">
									<div class="col-lg-12" id="sales_report">

										<?php
										include('newpagination/paginator.class.php');


										////////// Form Filters/////
										//////////////// Branches Filter//////////////
										//////////////// Branches Filter//////////////
										if (isset($_GET['branch']) && !empty($_GET['branch'])) {
											$branch = $_GET['branch'];
											if (empty($branch)) {
												$branchesArray = array();
												$Bracnhes = Run("Select * from " . dbObject . "Branch order by BName ASC");
												while ($getBranches = myfetch($Bracnhes)) {
													array_push($branchesArray, $getBranches->Bid);
												}
												$branchIds = implode(",", $branchesArray);
											} else {
												$branchIds = implode(",", $branch);
											}

											$bid = $branchIds;
										}
										if (empty($_GET['branch'])) {
											$branchesArray = array();
											$Bracnhes = Run("Select * from " . dbObject . "Branch order by BName ASC");
											while ($getBranches = myfetch($Bracnhes)) {
												array_push($branchesArray, $getBranches->Bid);
											}
											$branchIds = implode(",", $branchesArray);
											$bid = $branchIds;
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


										if (isset($_GET['SpName']) && !empty($_GET['SpName'])) {
											$customer_id = ($_GET['SpName']);
											$SuppId = implode(",", $customer_id);
										}





										$FBillno = !empty($_GET['from_bill_no']) ? $_GET['from_bill_no'] : 0;
										$TBillno = !empty($_GET['to_bill_no']) ? $_GET['to_bill_no'] : 0;
										$UsrId = !empty($_GET['user_id']) ? $_GET['user_id'] : 0;
										$dt = !empty($dt) ? $dt : NULL;
										$dt2 = !empty($dt2) ? $dt2 : NULL;
										$CustSupId = !empty($SuppId) ? $SuppId : '0';
										$LanguageId = !empty($_GET['selected_lang']) ? $_GET['selected_lang'] : '2';
										$GroupByType = !empty($_GET['GroupByType']) ? $_GET['GroupByType'] : '0';
										$SalmanId = !empty($_GET['SalmanId']) ? $_GET['SalmanId'] : '0';

										//Main query
										//$LanguageId = 2;

										$pages = new Paginator;

										$mainStoreProcedure = "EXEC  " . dbObject . "GetCustomerPayments   @bid='" . $bid . "',@dt='" . $dt . "',@dt2='" . $dt2 . "',@CustSupId='" . $CustSupId . "',@LanguageId ='" . $LanguageId . "',@FBillno ='" . $FBillno . "',@TBillno ='" . $TBillno . "',@UsrId ='" . $UsrId . "',@GroupByType ='" . $GroupByType . "',@SalmanId ='" . $SalmanId . "'";
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

										if($_GET['GroupByType'] == 0){
											$pLink = 'customerIssueReportNone';
										}
										elseif($_GET['GroupByType'] == 1){
											$pLink = 'customerIssueReportCustomer';
										}
										elseif($_GET['GroupByType'] == 2){
											$pLink = 'customerIssueReportDate';
										}

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
													<button style="width: 130px; text-align: left" type="button" class="btn btn-<?php echo ($fetchAllTotals['DisPer'] < 0) ? 'danger':'info'; ?> m-r-sm"><?php echo AmountValue($fetchAllTotals['DisPer']); ?></button>
												</div>
											</div>
											<div class="col-md-2 col-sm-4 col-lg-2">
												<div class="d-grid gap-2 col-12 ">
													<b><span class="en">NetTotal</span><span class="ar"><?= getArabicTitle('NetTotal') ?></span></b><br />
													<button style="width: 130px; text-align: left" type="button" class="btn btn-<?php echo ($fetchAllTotals['NetTotal'] < 0) ? 'danger':'info'; ?> m-r-sm"><?php echo AmountValue($fetchAllTotals['NetTotal']); ?></button>
												</div>
											</div>
											
										</div>

										<hr>
										<div class="col-md-12 col-sm-12 col-lg-12 mb-4 text-center">
											<div class="d-grid gap-2 col-12 pl-0">
												<button style="width: 130px;" type="button" class="btn btn-w-m btn-outline-primary" id="reportPRint" onclick="PrintPopup('<?= $print ?>', 'Customer Issue Report', '<?= $pLink ?>')"><i class="fa fa-print" aria-hidden="true"></i></button>
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
													<th><span class="en">Bill Date</span><span class="ar"><?= getArabicTitle('Bill Date') ?></span></th>
													<?php if($_GET['GroupByType'] == 0 OR $_GET['GroupByType'] == 1){ ?>
														<th><span class="en">Customer</span><span class="ar"><?= getArabicTitle('Customer') ?></span></th>
														<?php } ?>
													<th><span class="en">Comments</span><span class="ar"><?= getArabicTitle('Comments') ?></span></th>
													<th><span class="en">Total</span><span class="ar"><?= getArabicTitle('Total') ?></span></th>
													<th><span class="en">Discount</span><span class="ar"><?= getArabicTitle('Discount') ?></span></th>
													<th><span class="en">Discount%</span><span class="ar"><?= getArabicTitle('Discount') ?>%</span></th>
													<th><span class="en">NetTotal</span><span class="ar"><?= getArabicTitle('NetTotal') ?></span></th>
													<th><span class="en">Branch</span><span class="ar"><?= getArabicTitle('Branch') ?></span></th>
												</tr>
											</thead>
											<tbody>
											<?php
											if ($pages->items_total > 0) {
												$cnt = 1;
												while ($single = myfetch($result)) {
													echo '<tr>'; ?>

													<?php if($_GET['GroupByType'] == 0){ ?>
														<td><span class="text-warp"><?php echo $single->billno; ?> </span></td>
													<?php } ?>
													<td><span class="text-warp"><?php echo DateValue($single->billdate); ?> </span></td>
													<?php if($_GET['GroupByType'] == 0 OR $_GET['GroupByType'] == 1){ ?>
														<td><span class="text-warp"><?php echo $single->CustSupName; ?> </span></td>
													<?php } ?>
														
													<td><span class="text-warp"><?php echo $single->Notes; ?> </span></td>
													<td><span class="text-warp"><?php echo AmountValue($single->Total); ?> </span></td>
													<td><span class="text-warp"><?php echo AmountValue($single->Discount); ?> </span></td>
													<td><span class="text-warp"><?php echo AmountValue($single->DisPer); ?> </span></td>
													<td><span class="text-warp"><?php echo AmountValue($single->NetTotal); ?> </span></td>
													<td><span class="text-warp"><?php echo $single->BrachName; ?> </span></td>
										
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

<script src="include/reports/customer/js.js"></script>
<script>
	$('#report_type_option').on('change', function() {
		const selected_value = $(this).find(":selected").val();
		$("#report_type").attr('value', selected_value);
		if (selected_value == "group") {
			$(".toggle_groupbytype,.toggle_orderby").css("display", "none");
		} else {
			$(".toggle_groupbytype,.toggle_orderby").css("display", "block");
		}
	});

	$(".ara").on("click", function() {
		$("#selected_lang").attr('value', '1');
		$("span.en").css("display", "none");
		$("span.ar").css("display", "block");
		$(".add_me").addClass("rv");
		$(".this_ar").addClass("tb");
	})

	$(".eng").on("click", function() {
		$("#selected_lang").attr('value', '2')
		$("span.en").css("display", "block");
		$("span.ar").css("display", "none");
		$(".add_me").removeClass("rv");
		$(".this_ar").removeClass("tb");

	})




	$(document).ready(function() {
		$('.i-checks').iCheck({
			checkboxClass: 'icheckbox_square-green',
			radioClass: 'iradio_square-green',
		});
	});

	$('.clockpicker').clockpicker({
		donetext: 'Select Time'
	});

	var mem = $('.date').datepicker({
		todayBtn: "linked",
		keyboardNavigation: false,
		forceParse: false,
		calendarWeeks: true,
		autoclose: true,
		dateFormat: 'yy-mm-dd',
	});



	var elem = document.querySelector('.js-switch-branch');
	var switchery = new Switchery(elem, {
		color: '#1AB394'
	});
	$(".js-switch-branch").siblings(".switchery").css("width", "70px")
		.prepend("<span class='text_add'>All</span>").find("small").css("left", "0");


	var elem = document.querySelector('.js-switch');
	var switchery = new Switchery(elem, {
		color: '#1AB394'
	});
	$(".js-switch").siblings(".switchery").css("width", "70px")
		.prepend("<span class='text_add'>All</span>").find("small").css("left", "0");



	$("#branch_all_select").on('change', function() {
		if ($(this).is(':checked')) {
			$("#branchs").attr("disabled", "disabled");


		} else {
			$("#branchs").removeAttr("disabled", "disabled");


		}
	});
	$("#supplier_all_select").on('change', function() {
		if ($(this).is(':checked')) {
			$("#SpName").attr("disabled", "disabled");


		} else {
			$("#SpName").removeAttr("disabled", "disabled");


		}
	});

	$(document).ready(function() {
		$("#branchs").select2({
			width: '100%',
		});
	})
</script>
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