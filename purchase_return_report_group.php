<?php
session_start();
$lang = $_SESSION['lang'];
?>
<!DOCTYPE html>
<html>

<head>

	<meta charset="utf-8">
	<meta name="viewport"
		content="initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0,target-densitydpi=device-dpi, user-scalable=no" />


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
			<div class="row wrapper border-bottom white-bg page-heading pb-2">
				<div class="col-lg-4">
					<h2 class="font-weight-bold"><span class="en">Purchase Return Report (Group)</span><span class="ar"><?= getArabicTitle('Purchase Return Report (Group)') ?></span></h2>
				</div>
				<div class="col-lg-2">
					<a href="purchase_return_report_general.php">
						<div style="padding: 12px 20px!important;background: #7de9d3 !important; color: black;"
							class="widget style1 ">
							<div class="row vertical-align">

								<div class="col-12 text-center">
									<h4 class="font-bold"><span class="en">General</span><span class="ar"><?= getArabicTitle('General') ?></span></h4>
								</div>
							</div>
						</div>
					</a>
				</div>
				<div class="col-lg-2">
					<a href="purchase_return_report_detail.php">

						<div style="padding: 12px 20px!important;background: #7de9d3 !important; color: black;"
							class="widget style1">
							<div class="row vertical-align">

								<div class="col-12 text-center">
									<h4 class="font-bold"><span class="en">Detail</span><span class="ar"><?= getArabicTitle('Detail') ?></span></h4>
								</div>
							</div>
						</div>
					</a>
				</div>
				<div class="col-lg-2">
					<a href="purchase_return_report_group.php">

						<div style="padding: 12px 20px!important;" class="widget style1 navy-bg">
							<div class="row vertical-align">

								<div class="col-12 text-center">
									<h4 class="font-bold"><span class="en">Group</span><span class="ar"><?= getArabicTitle('Group') ?></span></h4>
								</div>
							</div>
						</div>
					</a>
				</div>

			</div>
			<div class="wrapper wrapper-content animated fadeInRight">
				<!-- <div class="row mb-3">
					<div class="col-md-6 col-6">
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
									<div class="col-md-9">
										<h5 class="mr-4"><span class="en float-left">Filters</span><span class="ar float-right">
												<?= getArabicTitle('Filters') ?>
											</span></h5>
									</div>

								</div>

								<div class="ibox-tools no_envent" style="display: none">
									<a class="collapse-link filter_act">
										<i class="fa fa-chevron-down"></i>
									</a>
								</div>
							</div>
							<form action="" id="" method="get" class="ibox-content  filter_container">
								<input type="text" id="report_type" name="report_type" value="general" hidden>
								<input type="number" id="selected_lang" name="selected_lang"
									value="<?php !empty($_GET['selected_lang']) ? $_GET['selected_lang'] : '1' ?>" hidden>
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


													<input type="checkbox" id="branch_all_select" name="branch_all_select" <?php if ($_GET['branch_all_select'] == 'on') {
														echo "checked";
													} ?> class="js-switch" />
												</div>
											</div>
											<div class="col-md-7">
												<div class="form-group">
													<div>
														<select id="branchs" name="branch[]" class="select2_demo_1 form-control" tabindex="4"
															multiple>
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
									<div class="col-md-6 pt-2">
										<div class="row">
											<div class="col-md-4">
												<h4><span class="en">Transaction Type</span><span class="ar">
														<?= getArabicTitle('Transaction Type') ?>
													</span></h4>
											</div>
											<div class="col-md-8">
												<div class="row">
													<div class="col-md-4 col-6">
														<div class="i-checks"><label class="">
																<div class="iradio_square-green ">
																	<div class="iradio_square-green">
																		<input type="radio" <?php if ($_GET['transaction_type'] == '1') {
																			echo "Checked";
																		} ?>
																			value="1" name="transaction_type">
																	</div>
																	<ins class="iCheck-helper"></ins>
																</div> <i></i> <span class="en">Cash </span><span class="ar">
																	<?= getArabicTitle('Cash') ?>
																</span>
															</label>
														</div>
													</div>
													<div class="col-md-4 col-6">
														<div class="i-checks"><label class="">
																<div class="iradio_square-green ">
																	<div class="iradio_square-green">
																		<input type="radio" value="2" name="transaction_type" <?php if ($_GET['transaction_type'] == '2') {
																			echo "Checked";
																		} ?>>
																	</div>
																	<ins class="iCheck-helper"></ins>
																</div> <i></i> <span class="en">Credit </span><span class="ar">
																	<?= getArabicTitle('Credit') ?>
																</span>
															</label>
														</div>
													</div>
													<div class="col-md-4 col-6">
														<div class="i-checks"><label class="">
																<div class="iradio_square-green ">
																	<div class="iradio_square-green">
																		<input type="radio" value="0" name="transaction_type" <?php if ($_GET['transaction_type'] == '0' || $_GET['transaction_type'] == '') {
																			echo "Checked";
																		} ?>>
																	</div>
																	<ins class="iCheck-helper"></ins>
																</div> <i></i> <span class="en">All</span><span class="ar">
																	<?= getArabicTitle('All') ?>
																</span>
															</label>
														</div>
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
													<input value="<?php echo $_GET['from_bill_no']; ?>" id="from_bill_no" name="from_bill_no"
														type="text" class="form-control">

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
												<div class="form-group"><input id="to_bill_no" value="<?php echo $_GET['to_bill_no']; ?>"
														name="to_bill_no" type="text" class="form-control"></div>
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
														<input id="from_date" name="from_date" type="text" class="form-control"
															value="<?php echo $_GET['from_date'] ?>" autocomplete="off">
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
														<input id="to_date" name="to_date" type="text" class="form-control"
															value="<?php echo $_GET['to_date'] ?>" autocomplete="off">
													</div>
												</div>
											</div>
										</div>
									</div>
									<div class="col-4">
										<div class="row">
											<div class="col-md-4">
												<h4><span class="en">From Product</span><span class="ar">
														<?= getArabicTitle('From Product') ?>
													</span></h4>
											</div>

											<div class="col-md-2 col-4">
												<div class="form-group"><input id="from_product_id" name="from_product_id" type="text"
														class="form-control" value="<?php echo $_GET['from_product_id'] ?>" readonly></div>
											</div>
											<div class="col-md-6 col-8">
												<div class="form-group">
													<div>
														<select id="from_product_name" name="from_product_name" class="select2_demo_1 form-control"
															tabindex="4" onChange="setmyValue(this.value,'from_product_id')">
															<?php
															if (isset($_GET['from_product_id']) && !empty($_GET['from_product_id'])) {
																?>
																<option value="<?php echo $_GET['from_product_id']; ?>" selected> <?php echo getProductDetails($_GET['from_product_id'])->CName; ?> -
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
									<div class="col-4">
										<div class="row">
											<div class="col-md-4">
												<h4><span class="en">To Product</span><span class="ar">
														<?= getArabicTitle('To Product') ?>
													</span>
												</h4>
											</div>
											<div class="col-md-2 col-4">
												<div class="form-group"><input id="to_product_id" name="to_product_id" type="text"
														class="form-control" readonly value="<?php echo $_GET['to_product_id'] ?>"></div>
											</div>
											<div class="col-md-6 col-8">
												<div class="form-group">
													<div>
														<select id="to_product_name" name="to_product_name" class="select2_demo_1 form-control"
															onChange="setmyValue(this.value,'to_product_id')">
															<option value="">Select</option>
															<?php
															if (isset($_GET['to_product_id']) && !empty($_GET['to_product_id'])) {
																?>
																<option value="<?php echo $_GET['to_product_id']; ?>" selected> <?php echo getProductDetails($_GET['to_product_id'])->CName; ?> -
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
									<div class="col-4">
										<div class="row">
											<div class="col-md-4">
												<h4><span class="en">Product Group</span><span class="ar">
														<?= getArabicTitle('Product Group') ?>
													</span></h4>
											</div>
											<div class="col-md-2 col-4">
												<div class="form-group"><input id="product_group_id" name="product_group_id" type="text"
														class="form-control" value="<?php echo $_GET['product_group_id'] ?>"></div>
											</div>
											<div class="col-md-6 col-8">
												<div class="form-group">
													<div>
													<?php if ($lang == 1) {
														$placeholder ="Product Group";
													} else {
														$placeholder = getArabicTitle('Product Group');
													} ?>
														<select id="product_group_name" name="product_group_name" data-placeholder="<?= $placeholder ?>"
															class="select2_demo_1 form-control" onChange="setmyValue(this.value,'product_group_id')">
															<?php
															if (isset($_GET['product_group_id']) && !empty($_GET['product_group_id'])) {
																?>
																<option value="<?php echo $_GET['product_group_id']; ?>" selected> <?php echo getProductGroupDetails($_GET['product_group_id'])->CName; ?> -
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
											<div class="col-md-2">
												<h4><span class="en">User</span><span class="ar">
														<?= getArabicTitle('User') ?>
													</span></h4>
											</div>
											<div class="col-md-2 col-4">
												<div class="form-group">
													<input type="text" value="<?php echo $_GET['user_id'] ?>" id="user_id" name="user_id" readonly
														class="form-control">
												</div>
											</div>
											<div class="col-md-7 col-8">
												<div class="form-group">
													<div>
														<select id="user_name" name="user_name" class="select2_demo_1 form-control" tabindex="4"
															onChange="setmyValue(this.value,'user_id')">

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
												<h4><span class="en">Customer</span><span class="ar">
														<?= getArabicTitle('Customer') ?>
													</span>
												</h4>
											</div>
											<div class="col-md-2 col-4">
												<div class="form-group"><input id="customer_id" name="customer_id" type="text" readonly
														class="form-control" value="<?php echo $_GET['customer_id'] ?>"></div>
											</div>
											<div class="col-md-7 col-8">
												<div class="form-group">
													<div>
														<select id="customer_name" name="customer_name" class="select2_demo_1 form-control"
															tabindex="4" onChange="setmyValue(this.value,'customer_id')">
															<?php
															if (isset($_GET['customer_id']) && !empty($_GET['customer_id'])) {
																?>
																<option value="<?php echo $_GET['customer_id']; ?>" selected>
																	<?php echo getCustomerDetails($_GET['customer_name'])->CName; ?>
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

									<div class="col-md-6 pt-2 toggle_orderby">
										<div class="row">
											<div class="col-md-2">
												<h4><span class="en">Order By</span><span class="ar">
														<?= getArabicTitle('Order By') ?>
													</span>
												</h4>
											</div>
											<div class="col-md-10">
												<div class="row">
													<div class="col-md-4 col-6">
														<div class="i-checks"><label class="">
																<div class="iradio_square-green ">
																	<div class="iradio_square-green">
																		<input type="radio" <?php if ($_GET['OrderBy'] == 'Billno') {
																			echo 'checked="checked"';
																		} ?> value="Billno" name="OrderBy">
																	</div>
																	<ins class="iCheck-helper"></ins>
																</div> <i></i> <span class="en">Bill Number</span><span class="ar">
																	<?= getArabicTitle('Bill Number') ?>
																</span>
															</label>
														</div>
													</div>
													<div class="col-md-4 col-6">
														<div class="i-checks"><label class="">
																<div class="iradio_square-green ">
																	<div class="iradio_square-green">
																		<input type="radio" value="Billdate" name="OrderBy" <?php if ($_GET['OrderBy'] == 'Billdate' || $_GET['OrderBy'] == '') {
																			echo 'checked="checked"';
																		} ?>>
																	</div>
																	<ins class="iCheck-helper"></ins>
																</div> <i></i> <span class="en">Bill Date </span><span class="ar">
																	<?= getArabicTitle('Bill Date') ?>
																</span>
															</label>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>



									<div class="col-md-6 pt-2 toggle_orderby">
										<div class="row">
											<div class="col-md-4">
												<h4><span class="en">Vat Type</span><span class="ar">
														<?= getArabicTitle('Vat Type') ?>
													</span>
												</h4>
											</div>
											<div class="col-md-8">
												<div class="row">
													<div class="col-md-4 col-6">
														<div class="i-checks"><label class="">
																<div class="iradio_square-green ">
																	<div class="iradio_square-green">
																		<input type="radio" <?php if ($_GET['VatType'] == '0' || $_GET['VatType'] == '') {
																			echo 'checked="checked"';
																		} ?> value="0" name="VatType">
																	</div>
																	<ins class="iCheck-helper"></ins>
																</div> <i></i> <span class="en">All</span><span class="ar">
																	<?= getArabicTitle('All') ?>
																</span>
															</label>
														</div>
													</div>
													<div class="col-md-4 col-6">
														<div class="i-checks"><label class="">
																<div class="iradio_square-green ">
																	<div class="iradio_square-green">
																		<input type="radio" value="1" name="VatType" <?php if ($_GET['VatType'] == '1') {
																			echo 'checked="checked"';
																		} ?>>
																	</div>
																	<ins class="iCheck-helper"></ins>
																</div> <i></i> <span class="en">With GST </span><span class="ar">
																	<?= getArabicTitle('With GST') ?>
																</span>
															</label>
														</div>
													</div>
													<div class="col-md-4 col-6">
														<div class="i-checks"><label class="">
																<div class="iradio_square-green ">
																	<div class="iradio_square-green">
																		<input type="radio" value="2" name="VatType" <?php if ($_GET['VatType'] == '2') {
																			echo 'checked="checked"';
																		} ?>>
																	</div>
																	<ins class="iCheck-helper"></ins>
																</div> <i></i> <span class="en">Non GST </span><span class="ar">
																	<?= getArabicTitle('Non GST') ?>
																</span>
															</label>
														</div>
													</div>
												</div>



											</div>
										</div>
									</div>






									<div class="col-12 row justify-content-center mt-5">
											<div class="col-md-2"><button type="button" class="btn btn-block btn-lg btn-outline-danger"
													onClick="location.reload()"><span class="en">Exit</span><span class="ar"><?= getArabicTitle('Exit') ?>
													</span>
												</button>
											</div>
											<div class="col-md-2">
												<button type="submit" class="btn btn-block btn-lg btn-outline-success" id="seles_report_search"
													value="Search"><span class="en">Search</span><span class="ar">
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
						<h2 class="en float-left">Group</h2>
						<h2 class="ar float-right"><?= getArabicTitle('Group') ?></h2>
						<div class="ibox-content this_ar">

							<div class="table-responsive">


								<div class="row">
									<div class="col-lg-12" id="sales_report">

										<?php
										include('newpagination/paginator.class.php');

										if (isset($_GET['transaction_type'])) {
											$transaction_type = urldecode($_GET['transaction_type']);
											$SpType = $transaction_type;

										}



										/// ORder By Clauses///////
										if (isset($_GET['OrderBy']) && !empty($_GET['OrderBy'])) {
											$OrderByx = urldecode($_GET['OrderBy']);
											$OrderBy = $OrderByx;
										}

										////////// Form Filters/////
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



										if (isset($_GET['from_bill_no']) && !empty($_GET['from_bill_no'])) {
											$from_bill_no = urldecode($_GET['from_bill_no']);
											$FBillno = $from_bill_no;


										}

										if (isset($_GET['to_bill_no']) && !empty($_GET['to_bill_no'])) {
											$to_bill_no = urldecode($_GET['to_bill_no']);
											$TBillno = $to_bill_no;
										}

										if (isset($_GET['customer_id']) && !empty($_GET['customer_id'])) {
											$customer_id = urldecode($_GET['customer_id']);
											$CustSupId = $customer_id;


										}

										if (isset($_GET['user_id']) && !empty($_GET['user_id'])) {
											$user_id = urldecode($_GET['user_id']);
											$UsrId = !empty($user_id) ? $user_id : '0';


										}
										if (isset($_GET['product_group_id']) && !empty($_GET['product_group_id'])) {
											$product_group_id = urldecode($_GET['product_group_id']);
											$PGroupId = !empty($product_group_id) ? $product_group_id : '0';
										}

										if (isset($_GET['from_product_id']) && !empty($_GET['from_product_id'])) {
											$from_product_id = urldecode($_GET['from_product_id']);
											$FPid = $from_product_id;

										}

										if (isset($_GET['to_product_id']) && !empty($_GET['to_product_id'])) {
											$to_product_id = urldecode($_GET['to_product_id']);
											$TPrid = $to_product_id;
										}

										$LanguageId = $_GET['selected_lang'];



										$distinct = "";
										$GrB = "";
										$SpType = !empty($SpType) ? $SpType : '0';
										$FBillno = !empty($FBillno) ? $FBillno : '0';
										$TBillno = !empty($TBillno) ? $TBillno : '0';

										$dt = !empty($dt) ? $dt : NULL;
										$dt2 = !empty($dt2) ? $dt2 : NULL;
										$CustSupId = !empty($CustSupId) ? $CustSupId : '0';
										$PurType = !empty($_REQUEST['PurType ']) ? $_REQUEST['PurType '] : '0';
										$PurChaser = !empty($_REQUEST['PurChaser ']) ? $_REQUEST['PurChaser '] : '0';
										$VatType = !empty($_REQUEST['VatType']) ? $_REQUEST['VatType'] : '0';
										$UsrId = !empty($UsrId) ? $UsrId : '0';
										$FPid = !empty($FPid) ? $FPid : '0';
										$TPrid = !empty($TPrid) ? $TPrid : '0';
										$PGroupId = !empty($PGroupId) ? $TPrid : '0';

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

										$LanguageId = !empty($LanguageId) ? $LanguageId : '1';

										$OrderBy = !empty($OrderBy) ? $OrderBy : '';


										//Main query
									
										$pages = new Paginator;



										$GroupByType = 0;
										$OrderBy = 'Billno';

										include("include/reports/purchase/purchase_return_group/index.php");









										?>













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
<script src="include/reports/purchase/js.js"></script>
<?php
if (isset($_GET['report_type']) && $_GET['report_type'] == 'general') {
	?>
	<script>
		$(document).ready(function () {

			$(".filter_act").click();
			$(".no_envent").toggleClass("displayB");
		});
	</script>

	<?php
}
?>