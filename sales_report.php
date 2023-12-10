<?php
session_start();
$lang = $_SESSION['lang'];
?>
<!DOCTYPE html>
<html>

<head>

	<meta charset="utf-8">
	<meta name="viewport" content="initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0,target-densitydpi=device-dpi, user-scalable=no" />


	<title>Sales Report</title>



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

<body class="top-navigation">

	<div id="wrapper">
		<div id="page-wrapper" class="gray-bg">
			<div class="row border-bottom white-bg justify-content-between">
				<?php
				include("header.php");

				?>
			</div>
			<div class="row wrapper border-bottom white-bg page-heading pb-2">
				<div class="col-lg-12">
					<h2 class="font-weight-bold"><span class="float-left en">Sales Report</span><span class="float-right ar"><?= getArabicTitle('Sales Report') ?></span></h2>

				</div>
			</div>
			<div class="wrapper wrapper-content animated fadeInRight">
				<div class="row mb-1">
					<div class="col-md-6 col-4">
						<button type="button" class=" btn btn-w-m btn-outline-primary float-right" id="filter"><span class="en">Filters</span><span class="ar"><?= getArabicTitle('Filters') ?></span></button>

					</div>

				</div>
				<div class="row">
					<div class="col-lg-12">
						<div class="ibox">
							<div class="ibox-title">
								<div class="row">
									<div class="col-md-9">
										<h5 class="mr-4"><span class="en">Filters</span><span class="ar"><?= getArabicTitle('Filters') ?></span></h5>
									</div>
									<div class="col-md-3">
										<div class="form-group m-0">
											<select class="form-control" id="report_type_option" name="report_type_option">
												<option value="general">General</option>
												<option value="details">Details</option>
												<option value="group">Group</option>
												<?php /*?><option value="summery_by_date">Summery By Date</option><?php */ ?>
											</select>
										</div>
									</div>
								</div>

								<div class="ibox-tools no_envent" style="display: none">
									<a class="collapse-link filter_act">
										<i class="fa fa-chevron-down"></i>
									</a>
								</div>
							</div>
							<form action="javascript:validate_form()" id="sales_report_form" method="post" class="ibox-content filter_container">
								<input type="text" id="report_type" name="report_type" value="general" hidden>
								<input type="number" id="selected_lang" name="selected_lang" value="1" hidden>
								<div class="row">
									<div class="col-12">
										<div class="row">
											<div class="col-md-2">
												<h4><span class="en">Branch Selection</span><span class="ar"><?= getArabicTitle('Branch
														Selection') ?></span></h4>
											</div>
											<div class="col-md-2">
												<div class="form-group">
													<input type="checkbox" id="branch_all_select" name="branch_all_select" class="js-switch" />
												</div>
											</div>
											<div class="col-md-8">
												<div class="form-group">
													<div>
														<select id="branch" name="branch[]" class="select2_demo_1 form-control" tabindex="4" multiple>


														</select>

													</div>
												</div>
											</div>
										</div>
									</div>
									<div class="col-md-6">
										<div class="row">
											<div class="col-md-4">
												<h4><span class="en">From Bill No</span><span class="ar"><?= getArabicTitle('From Bill
														No') ?></span></h4>
											</div>
											<div class="col-md-8">
												<div class="form-group"><input value="0" id="from_bill_no" name="from_bill_no" type="text" class="form-control"></div>
											</div>
										</div>
									</div>
									<div class="col-md-6">
										<div class="row">
											<div class="col-md-4">
												<h4><span class="en">To Bill No </span><span class="ar"><?= getArabicTitle('To Bill No') ?></span></h4>
											</div>
											<div class="col-md-8">
												<div class="form-group"><input id="to_bill_no" value="0" name="to_bill_no" type="text" class="form-control"></div>
											</div>
										</div>
									</div>
									<div class="col-md-6">
										<div class="row">
											<div class="col-md-4">
												<h4><span class="en">From Date</span><span class="ar"><?= getArabicTitle('From Date') ?></span></h4>
											</div>
											<div class="col-md-8">
												<div class="form-group">
													<div class="input-group date">
														<span class="input-group-addon">
															<i class="fa fa-calendar"></i></span>
														<input id="from_date" name="from_date" type="text" class="form-control" value="" autocomplete="off">
													</div>
												</div>
											</div>
										</div>
									</div>
									<div class="col-md-6">
										<div class="row">
											<div class="col-md-4">
												<h4><span class="en">To Date</span><span class="ar"><?= getArabicTitle('To Date') ?></span></h4>
											</div>
											<div class="col-md-8">
												<div class="form-group">
													<div class="input-group date">
														<span class="input-group-addon">
															<i class="fa fa-calendar"></i></span>
														<input id="to_date" name="to_date" type="text" class="form-control" value="" autocomplete="off">
													</div>
												</div>
											</div>
										</div>
									</div>
									<div class="col-6">
										<div class="row">
											<div class="col-md-4">
												<h4><span class="en">Customer</span><span class="ar"><?= getArabicTitle('Customer') ?></span></h4>
											</div>
											<div class="col-md-2 col-4">
												<div class="form-group"><input id="customer_id" name="customer_id" type="text" class="form-control" value="0" readonly></div>
											</div>
											<div class="col-md-6 col-8">
												<div class="form-group">
													<div>
														<select id="customer_name" name="customer_name" class="select2_demo_1 form-control" tabindex="4" onChange="setmyValue(this.value,'customer_id')">


														</select>
													</div>
												</div>
											</div>
										</div>
									</div>
									<div class="col-6">
										<div class="row">
											<div class="col-md-4">
												<h4><span class="en">User</span><span class="ar"><?= getArabicTitle('User') ?></span></h4>
											</div>
											<div class="col-md-2 col-4">
												<div class="form-group">
													<input type="text" value="0" id="user_id" name="user_id" class="form-control" readonly>
												</div>
											</div>
											<div class="col-md-6 col-8">
												<div class="form-group">
													<div>
														<select id="user_name" name="user_name" class="select2_demo_1 form-control" tabindex="4" onChange="setmyValue(this.value,'user_id')">


														</select>
													</div>
												</div>
											</div>
										</div>
									</div>
									<div class="col-6">
										<div class="row">
											<div class="col-md-4">
												<h4><span class="en">From Product</span><span class="ar"><?= getArabicTitle('From
														Product') ?></span></h4>
											</div>
											<div class="col-md-2 col-4">
												<div class="form-group"><input id="from_product_id" name="from_product_id" type="text" class="form-control" value="0"></div>
											</div>
											<div class="col-md-6 col-8">
												<div class="form-group">
													<div>
														<select id="from_product_name" name="from_product_name" class="select2_demo_1 form-control" tabindex="4" onChange="setmyValue(this.value,'from_product_id')">

														</select>
													</div>
												</div>
											</div>
										</div>
									</div>
									<div class="col-6">
										<div class="row">
											<div class="col-md-4">
												<h4><span class="en">To Product</span><span class="ar"><?= getArabicTitle('To Product') ?></span></h4>
											</div>
											<div class="col-md-2 col-4">
												<div class="form-group"><input id="to_product_id" name="to_product_id" type="text" class="form-control" value="0"></div>
											</div>
											<div class="col-md-6 col-8">
												<div class="form-group">
													<div>
														<select id="to_product_name" name="to_product_name" class="select2_demo_1 form-control" onChange="setmyValue(this.value,'to_product_id')">
															<option value="">Select</option>

														</select>
													</div>
												</div>
											</div>
										</div>
									</div>
									<div class="col-6">
										<div class="row">
											<div class="col-md-4">
												<h4><span class="en">Product Group</span><span class="ar"><?= getArabicTitle('Product
														Group') ?></span></h4>
											</div>
											<div class="col-md-2 col-4">
												<div class="form-group"><input id="product_group_id" name="product_group_id" type="text" class="form-control" value="0"></div>
											</div>
											<div class="col-md-6 col-8">
												<div class="form-group">
													<div>
														<select id="product_group_name" name="product_group_name" data-placeholder="Product Group" class="select2_demo_1 form-control" onChange="setmyValue(this.value,'product_group_id')">

														</select>
													</div>
												</div>
											</div>
										</div>
									</div>
									<div class="col-md-6">
										<div class="row">
											<div class="col-md-4">
												<h4><span class="en">Amount</span><span class="ar"><?= getArabicTitle('Amount') ?></span></h4>
											</div>
											<div class="col-md-2 col-6">
												<div class="form-group">
													<select name="amount_type" id="amount_type" class="form-control">
														<option value="="> = </option>
														<option value=">" selected> > </option>
														<option value="<">
															< </option>
														<option value="<>"> !=
														</option>

													</select>


												</div>
											</div>
											<div class="col-md-6 col-6">
												<div class="form-group"><input id="amount" name="amount" type="text" class="form-control" value="0"></div>
											</div>
										</div>
									</div>
									<div class="col-md-12 pt-2 toggle_orderby">
										<div class="row">
											<div class="col-md-2">
												<h4><span class="en">Order By</span><span class="ar"><?= getArabicTitle('Order By') ?></span></h4>
											</div>
											<div class="col-md-10">
												<div class="row">
													<div class="col-md-3 col-6">
														<div class="i-checks"><label class="">
																<div class="iradio_square-green ">
																	<div class="iradio_square-green">
																		<input type="radio" checked="checked" value="Billno" name="OrderBy">
																	</div>
																	<ins class="iCheck-helper"></ins>
																</div> <i></i> <span class="en">Bill Number</span><span class="ar"><?= getArabicTitle('Bill Number') ?></span></span>
															</label>
														</div>
													</div>
													<div class="col-md-3 col-6">
														<div class="i-checks"><label class="">
																<div class="iradio_square-green ">
																	<div class="iradio_square-green">
																		<input type="radio" value="Billdate" name="OrderBy">
																	</div>
																	<ins class="iCheck-helper"></ins>
																</div> <i></i> <span class="en">Bill Date </span><span class="ar"><?= getArabicTitle('Bill Date') ?></span></span>
															</label>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
									<div class="col-md-12 pt-2 toggle_groupbytype">
										<div class="row">
											<div class="col-md-2">
												<h4><span class="en">Group By Type</span><span class="ar"><?= getArabicTitle('Group By Type') ?></span></h4>
											</div>
											<div class="col-md-10">
												<div class="row">
													<div class="col-md-3 col-6">
														<div class="i-checks"><label class="">
																<div class="iradio_square-green ">
																	<div class="iradio_square-green">
																		<input type="radio" checked="checked" value="0" name="GroupByType">
																	</div>
																	<ins class="iCheck-helper"></ins>
																</div> <i></i> <span class="en">Group By None</span><span class="ar"><?= getArabicTitle('Group By None') ?></span>
															</label>
														</div>
													</div>
													<div class="col-md-3 col-6">
														<div class="i-checks"><label class="">
																<div class="iradio_square-green ">
																	<div class="iradio_square-green">
																		<input type="radio" value="1" name="GroupByType">
																	</div>
																	<ins class="iCheck-helper"></ins>
																</div> <i></i> <span class="en">Group by Customer </span><span class="ar"><?= getArabicTitle('Group by Customer') ?></span>
															</label>
														</div>
													</div>
													<div class="col-md-3 col-6">
														<div class="i-checks"><label class="">
																<div class="iradio_square-green ">
																	<div class="iradio_square-green">
																		<input type="radio" value="2" name="GroupByType">
																	</div>
																	<ins class="iCheck-helper"></ins>
																</div> <i></i> <span class="en">Group by Bill Date</span><span class="ar"><?= getArabicTitle('Group by Bill Date') ?></span>
															</label>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
									<div class="col-md-12 pt-2">
										<div class="row">
											<div class="col-md-2">
												<h4><span class="en">Transaction Type</span><span class="ar"><?= getArabicTitle('Transaction Type') ?></span></h4>
											</div>
											<div class="col-md-10">
												<div class="row">
													<div class="col-md-3 col-6">
														<div class="i-checks"><label class="">
																<div class="iradio_square-green ">
																	<div class="iradio_square-green">
																		<input type="radio" checked="" value="1" name="transaction_type">
																	</div>
																	<ins class="iCheck-helper"></ins>
																</div> <i></i> <span class="en">Cash </span><span class="ar"><?= getArabicTitle('Cash') ?></span>
															</label>
														</div>
													</div>
													<div class="col-md-3 col-6">
														<div class="i-checks"><label class="">
																<div class="iradio_square-green ">
																	<div class="iradio_square-green">
																		<input type="radio" value="2" name="transaction_type">
																	</div>
																	<ins class="iCheck-helper"></ins>
																</div> <i></i> <span class="en">Credit </span><span class="ar"><?= getArabicTitle('Credit') ?></span>
															</label>
														</div>
													</div>
													<div class="col-md-3 col-6">
														<div class="i-checks"><label class="">
																<div class="iradio_square-green ">
																	<div class="iradio_square-green">
																		<input type="radio" value="0" name="transaction_type">
																	</div>
																	<ins class="iCheck-helper"></ins>
																</div> <i></i> <span class="en">All</span><span class="ar"><?= getArabicTitle('All') ?></span>
															</label>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
									<!-- <div class="col-md-12 pt-2">
<div class="row">
<div class="col-md-2">
	<h4><span class="en">Report Type</span><span class="ar"><?= getArabicTitle('Report
			Type') ?></span></h4>
</div>
<div class="col-md-10">
	<div class="row">
		<div class="col-md-3 col-6">
			<div class="i-checks"><label class="">
					<div class="iradio_square-green ">
						<div class="iradio_square-green">
							<input type="radio" checked="checked"
								value="general" name="report_type">
						</div>
						<ins class="iCheck-helper"></ins>
					</div> <i></i> <span class="en">General </span><span
						class="ar">') ?></span>
				</label>
			</div>
		</div>
		<div class="col-md-3 col-6">
			<div class="i-checks"><label class="">
					<div class="iradio_square-green ">
						<div class="iradio_square-green">
							<input type="radio" value="details"
								name="report_type">
						</div>
						<ins class="iCheck-helper"></ins>
					</div> <i></i> <span class="en">Details </span><span
						class="ar">') ?></span>
				</label>
			</div>
		</div>
		<div class="col-md-3 col-6">
			<div class="i-checks"><label class="">
					<div class="iradio_square-green ">
						<div class="iradio_square-green">
							<input type="radio" value="group"
								name="report_type">
						</div>
						<ins class="iCheck-helper"></ins>
					</div> <i></i> <span class="en">Group</span><span
						class="ar">') ?></span>
				</label>
			</div>
		</div>
		<div class="col-md-3 col-6">
			<div class="i-checks"><label class="">
					<div class="iradio_square-green">
						<div class="iradio_square-green">
							<input type="radio" value="summery_by_date"
								name="report_type">
						</div>
						<ins class="iCheck-helper"></ins>
					</div> <i></i> <span class="en"> Summery By
						Date</span><span class="ar"><?= getArabicTitle('') ?></span>
				</label>
			</div>
		</div>
	</div>
</div>
</div>
</div> -->
									<div class="col-12">
										<div class="row justify-content-center mt-5">
											<div class="col-md-3"><button type="button" class="btn btn-block btn-lg btn-danger"><span class="en">Exit</span><span class="ar"><?= getArabicTitle('Exit') ?></span>
												</button>
											</div>
											<div class="col-md-3"><button type="submit" class="btn btn-block btn-lg btn-success" id="seles_report_search"><span class="en">Search</span><span class="ar">البحث </span>
												</button>
											</div>
										</div>
									</div>
								</div>
							</form>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-lg-12" id="sales_report">

					</div>
				</div>
			</div>
			<?php
			include("footer.php");
			?>
		</div>
	</div>

	<script src="vouchers/reports/sales_report/sales_report.js"></script>

</body>

</html>