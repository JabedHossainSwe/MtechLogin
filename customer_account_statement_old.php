<?php
session_start();
$lang = $_SESSION['lang'];
?>
<!DOCTYPE html>
<html>

<head lang="ar,en">


	<meta name="viewport" content="initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0,target-densitydpi=device-dpi, user-scalable=no" />

	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">


	<title>Customer Account Report</title>
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
	<div id="wrapper" class="direction">
		<div id="page-wrapper" class="gray-bg">
			<div class="row border-bottom white-bg justify-content-between">
				<?php
				include("header.php");
				header("Content-Type: text/plain");

				?>
			</div>
			<div class="row wrapper border-bottom white-bg page-heading pb-2">
				<div class="col-lg-12">
					<h2 class="font-weight-bold"><span class="float-left en">Customer Account Report</span><span class="float-right ar"><?= getArabicTitle('Customer Account Report') ?></span></h2>
				</div>
			</div>
			<div class="wrapper wrapper-content animated fadeInRight">
				<div class="row mb-1">
					<div class="col-12">
						<button type="button" class="btn btn-w-m btn-success en float-left" id="filter">Filters</button>
						<button type="button" class="btn btn-w-m btn-success ar float-right" id="filter"><?= getArabicTitle('Filters')?></button>
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
											<div class="col-md-2">
												<h4><span class="en">Branch Selection</span><span class="ar"><?= getArabicTitle('Branch Selection') ?></span></h4>
											</div>

											<div class="col-md-10">
												<div class="form-group">
													<div>
														<select id="branchs" name="branch[]" class="select2_demo_1 form-control">
															<?php
															$Bracnhes = Run("Select * from " . dbObject . "Branch order by BName ASC");
															$ABoveBranches  = $_GET['branch'];
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
											<div class="col-md-2">
												<h4><span class="en">Customer</span><span class="ar"><?= getArabicTitle('Customer') ?></span></h4>
											</div>

											<div class="col-10">
												<div class="form-group">
													<div id="">
														<select id="customer_name" name="SpName" class="select2_demo_1 form-control">
															<?php
															if (!empty($_GET['SpName'])) {
																$sp = $_GET['SpName'];
																$getSupplierDetails = getCustomerDetails($sp);
															?>
																<option value="<?= $getSupplierDetails->Cid ?>" selected><?= $getSupplierDetails->CCode . ' - ' . $getSupplierDetails->CName ?></option>
															<?php

															}

															?>
														</select>
													</div>
												</div>
											</div>
										</div>
									</div>


									<div class="col-md-4">
										<div class="row">
											<div class="col-md-4">
												<h4><span class="en">From Date</span><span class="ar"><?= getArabicTitle('From Date') ?></span></h4>
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
									<div class="col-md-4">
										<div class="row">
											<div class="col-md-4">
												<h4><span class="en">To Date</span><span class="ar"><?= getArabicTitle('To Date') ?></span></h4>
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























									<div class="col-md-4 pt-2 toggle_orderby">
										<div class="row">
											<div class="col-md-4">
												<h4><span class="en">Is Combined</span><span class="ar"><?= getArabicTitle('Vat Type') ?></span></h4>
											</div>
											<div class="col-md-8">
												<div class="row">
													<div class="col-md-3 col-6">
														<div class="i-checks"><label class="">
																<div class="iradio_square-green ">
																	<div class="iradio_square-green">
																		<input type="radio" <?php if ($_GET['IsCombined'] == '0') {
																								echo 'checked="checked"';
																							} ?> value="0" name="IsCombined">
																	</div>
																	<ins class="iCheck-helper"></ins>
																</div> <i></i> <span class="en">No</span><span class="ar">تفاصيل</span>
															</label>
														</div>
													</div>
													<div class="col-md-3 col-6">
														<div class="i-checks"><label class="">
																<div class="iradio_square-green ">
																	<div class="iradio_square-green">
																		<input type="radio" value="1" name="IsCombined" <?php if ($_GET['IsCombined'] == '1'  || $_GET['IsCombined'] == '') {
																															echo 'checked="checked"';
																														} ?>>
																	</div>
																	<ins class="iCheck-helper"></ins>
																</div> <i></i> <span class="en">Yes</span><span class="ar">تفاصيل</span>
															</label>
														</div>
													</div>

												</div>



											</div>
										</div>
									</div>


									<div class="col-12">
										<div class="row justify-content-center mt-5">
											<div class="col-md-3"><button type="button" class="btn btn-block btn-lg btn-danger" onClick="location.reload()"><span class="en">Exit</span><span class="ar"><?= getArabicTitle('Exit') ?></span>
												</button>
											</div>
											<div class="col-md-3">
												<button type="submit" class="btn btn-block btn-lg btn-success" id="seles_report_search" value="Search"><span class="en">Search</span><span class="ar">البحث </span>
												</button>
											</div>
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
						<h2>Customer Accout Statement</h2>
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

											$bid  = $branchIds;
										}
										if (empty($_GET['branch'])) {
											$branchesArray = array();
											$Bracnhes = Run("Select * from " . dbObject . "Branch order by BName ASC");
											while ($getBranches = myfetch($Bracnhes)) {
												array_push($branchesArray, $getBranches->Bid);
											}
											$branchIds = implode(",", $branchesArray);
											$bid  = $branchIds;
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
											$SuppId = $customer_id;
										}





										$dt = !empty($dt) ? $dt : NULL;
										$dt2 = !empty($dt2) ? $dt2 : NULL;
										$Cids = !empty($SuppId) ? $SuppId : '';
										$LanguageId = !empty($_GET['selected_lang']) ? $_GET['selected_lang'] : '2';
										//Main query
										//$LanguageId = 2;

										$pages = new Paginator;

										$mainStoreProcedure = "EXEC  " . dbObject . "GetCustomerStatement    @bid='" . $bid . "',@dt='" . $dt . "',@dt2='" . $dt2 . "',@CustId ='" . $Cids . "',@LanguageId ='" . $LanguageId . "'";
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


										?>


										<div class="row">


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


													<button type="button" class="btn btn-<?php echo $class; ?> m-r-sm"><?php echo AmountValue($value); ?></button>
													<b><?php echo $key; ?></b>
												</div>
											<?php
											}

											?>








										</div>
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

															<td><span class="text-warp"><?php echo $value; ?> </span></td>
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

	<script src="include/reports/customer/js.js"></script>
	<script>
		var elem = document.querySelector('.js-switch');
		var switchery = new Switchery(elem, {
			color: '#1AB394'
		});


		//$(".js-switch").siblings(".switchery").css("width", "70px")
		//.prepend("<span class='text_add'>All</span>").find("small").css("left", "0");

		$("#branch_all_select").on('change', function() {
			if ($(this).is(':checked')) {
				$("#branchs").attr("disabled", "disabled");
				$("#branchs").siblings().find(".select2-selection").css("background", "#e9ecef !important");
				$("#branchs").empty().trigger('change')
			} else {
				$("#branchs").removeAttr("disabled", "disabled");
				$("#branchs").siblings().find(".select2-selection").css("background", "#fff !important")

			}
		})







		$(document).ready(function() {
			$("#Cids").select2({
				width: '100%',
				closeOnSelect: true,
				placeholder: '',

			});



		});
	</script>
</body>

</html>