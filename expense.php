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
				<div class="col-lg-12">
					<h2 class="font-weight-bold"><span class="float-left en">Expense Report</span><span class="float-right ar"><?= getArabicTitle('Expense Report') ?></span></h2>

				</div>

			</div>
			<div class="wrapper wrapper-content animated fadeInRight">
				<div class="row mb-1">
					<div class="col-12">



						<button type="button" class=" btn btn-w-m btn-outline-primary float-right" id="filter">
							<span class="en">Filters</span><span class="ar">
								<?= getArabicTitle('Filters') ?>
							</span> </button>
					</div>

				</div>
				<div class="row">
					<div class="col-lg-12">
						<div class="ibox">

							<div class="ibox-tools no_envent" style="display: none">
								<a class="collapse-link filter_act">
									<i class="fa fa-chevron-down"></i>
								</a>
							</div>
							<form action="" id="sales_report_form" method="get" class="ibox-content filter_container">
								<input type="text" id="report_type" name="report_type" value="general" hidden>
								<input type="number" id="selected_lang" name="selected_lang"
									value="<?php !empty($_GET['selected_lang']) ? $_GET['selected_lang'] : '1' ?>" hidden>
								<div class="row">
									<div class="col-12">
										<div class="row">
											<div class="col-md-2">
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
											<div class="col-md-8">
												<div class="form-group">
													<div>
														<?php


														?>
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
									<div class="col-md-6">
										<div class="row">
											<div class="col-md-4">
												<h4><span class="en">From Bill No</span><span class="ar">
														<?= getArabicTitle('From Bill No') ?>
													</span></h4>
											</div>
											<div class="col-md-8">
												<div class="form-group">
													<input value="<?php echo $_GET['from_bill_no']; ?>" id="from_bill_no" name="from_bill_no"
														type="text" class="form-control">

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
												<div class="form-group"><input id="to_bill_no" value="<?php echo $_GET['to_bill_no']; ?>"
														name="to_bill_no" type="text" class="form-control"></div>
											</div>
										</div>
									</div>
									<div class="col-md-6">
										<div class="row">
											<div class="col-md-4">
												<h4><span class="en">From Date</span><span class="ar"><?= getArabicTitle('From Data') ?></span>
												</h4>
											</div>
											<div class="col-md-8">
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
														<input id="to_date" name="to_date" type="text" class="form-control"
															value="<?php echo $_GET['to_date'] ?>" autocomplete="off">
													</div>
												</div>
											</div>
										</div>
									</div>
									<div class="col-md-6 pt-2 toggle_orderby">
										<div class="row">
											<div class="col-md-4">
												<h4><span class="en">Order By</span><span class="ar"><?= getArabicTitle('Order By') ?></span>
												</h4>
											</div>
											<div class="col-md-8">
												<div class="row">
													<div class="col-md-6 col-6">
														<div class="i-checks"><label class="">
																<div class="iradio_square-green ">
																	<div class="iradio_square-green">
																		<input type="radio" <?php if ($_GET['OrderBy'] == 'Billno') {
																			echo 'checked="checked"';
																		} ?> value="ExpNo" name="OrderBy">
																	</div>
																	<ins class="iCheck-helper"></ins>
																</div>
																<i></i> <span class="en">Bill Number</span><span class="ar"><?= getArabicTitle('Bill Number') ?></span>
															</label>
														</div>
													</div>
													<div class="col-md-6 col-6">
														<div class="i-checks"><label class="">
																<div class="iradio_square-green ">
																	<div class="iradio_square-green">
																		<input type="radio" value="ExpDate" name="OrderBy" <?php if ($_GET['OrderBy'] == 'Billdate' || $_GET['OrderBy'] == '') {
																			echo 'checked="checked"';
																		} ?>>
																	</div>
																	<ins class="iCheck-helper"></ins>
																</div>
																<i></i> <span class="en">Bill Date </span><span class="ar"><?= getArabicTitle('Bill Date') ?></span>
															</label>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>

									<div class="col-12">
										<div class="row justify-content-center mt-5">
											<div class="col-md-2">
												<button type="button" class="btn btn-block btn-outline-danger" onClick="location.reload()"><span
														class="en">Exit</span><span class="ar"><?= getArabicTitle('Exit') ?></span>
												</button>
											</div>
											<div class="col-md-2">
												<button type="submit" class="filter btn btn-block btn-outline-success" id="seles_report_search"
													value="Search"><span class="en">Search</span><span class="ar"><?= getArabicTitle('Search') ?></span>
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
						<h2 class="float-left en">Expenses</h2>
						<h2 class="float-left en"><?= getArabicTitle('Expenses') ?></h2>

						<div class="ibox-content this_ar">

							<div class="table-responsive">


								<div class="row">
									<div class="col-lg-12" id="sales_report">

										<?php
										include('custom_newpagination/paginator.class.php');
		

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

										if($bid!='')
										{
											$condition.=" Where Bid IN ($bid)";
										}

										/// ORder By Clauses///////
										if (isset($_GET['OrderBy']) && !empty($_GET['OrderBy'])) {
											$OrderByx = urldecode($_GET['OrderBy']);


											$OrderBy = "Order By ".$OrderByx." DESC";
										}


										if (isset($_GET['from_date']) && !empty($_GET['from_date'])) {
											$from_date = urldecode($_GET['from_date']);
											$from_date = date("Y-m-d", strtotime($from_date));
											$dt = $from_date;

											$condition.="  And CAST(ExpDate AS date) >= '".$from_date."'";
											
										}


										if (isset($_GET['to_date']) && !empty($_GET['to_date'])) {
											$to_date = urldecode($_GET['to_date']);
											$to_date = date("Y-m-d", strtotime($to_date));
											$dt2 = $to_date;

											$condition.="  And CAST(ExpDate AS date) <= '".$to_date."'";
										}


										if (isset($_GET['from_bill_no']) && !empty($_GET['from_bill_no'])) {
											$from_bill_no = urldecode($_GET['from_bill_no']);
											$FBillno = $from_bill_no;

											$condition.="  And ExpNo >= '".$FBillno."'";

										}

										if (isset($_GET['to_bill_no']) && !empty($_GET['to_bill_no'])) {
											$to_bill_no = urldecode($_GET['to_bill_no']);
											$TBillno = $to_bill_no;

											$condition.="  And ExpNo <= '".$to_bill_no ."'";

										}

								


									


										//Main query
									
										$pages = new Paginator;
  $abc ="Select count(ExpNo) as totalrec from ExpenseData   $condition ";
										$rf = Run($abc);
										$tolrec = myfetch($rf)->totalrec;

										$pages->default_ipp = 20;
										$pages->items_total = $tolrec;
										$pages->mid_range = 9;
										$pages->paginate();

										//$initialLimit = ",".$pages->limit;

										$qpt = "Select * from ExpenseData $condition  $OrderBy " . $pages->limit . "";
										$result = Run($qpt);
										?>
										<div class="mb-3">
											<!-- Listing -->
											<table class="table table-striped table-bordered dt-responsive table-hover ">

												<?php
												if ($pages->items_total > 0) {
													?>
													<thead>
														<tr>
															<th><span class="en">SB Bill No</span><span class="ar"><?= getArabicTitle('SB Bill No') ?></span></th>
															<th><span class="en">Bill No</span><span class="ar"><?= getArabicTitle('Bill No') ?></span></th>
															<th><span class="en">Branch</span><span class="ar"><?= getArabicTitle('Branch') ?></span></th>
															<th><span class="en">GTotal</span><span class="ar"><?= getArabicTitle('GTotal') ?></span></th>
															<th><span class="en">IsVat</span><span class="ar"><?= getArabicTitle('IsVat') ?></span></th>
															<th><span class="en">VatPer</span><span class="ar"><?= getArabicTitle('VatPer') ?></span></th>
															<th><span class="en">Date</span><span class="ar"><?= getArabicTitle('Date') ?></span></th>
															<th><span class="en">Action</span><span class="ar"><?= getArabicTitle('Action') ?></span></th>
														</tr>
													</thead>
													<tbody>
														<?php
														while ($single = myfetch($result)) {

															$VatPer = "";
															if($single->IsVat == 1){
																 $VatPer = AmountValue($single->VatPer);
															}

														
															?>
															<tr>
																<td>
																	<?= $single->sbBillno ?>
																</td>
																<td>
																	<?= $single->ExpNo ?>
																</td>
																<td>
																	<?= GetBranchDetils($single->Bid)->BName ?>
																</td>
																<td>
																	<?= AmountValue($single->GTotal) ?>
																</td>
																<td>
																	<?= $single->IsVat ?>
																</td>
																<td>
																	<?= $VatPer ?>
																</td>
																<td>
																	<?= DateValue($single->ExpDate) ?>
																</td>
																<td align="center">
																	<a href="update_expense_data.php?bno=<?=$single->ExpNo?>&bid=<?=$single->Bid?>"><i class="fa fa-pencil-square-o"></i> </a>
																	&nbsp;

																	<a href="javascript:deleteVoucher('<?= $single->Bid ?>', '<?= $single->ExpNo ?>');"><i class="fa fa-times-circle-o"></i> </a>
																</td>
															</tr>
															<?php
															$cnt++;
														}
												} else {
													?>
														<tr>
															<td colspan="4" class="text-center">
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

												<div class="clearfix" id="deleteEntry"></div>

											</div>

											<!-- /bottom pagination -->
										</div>


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
<script src="include/expense/js.js"></script>
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

<script>
	var elem = document.querySelector('.js-switch');
	var switchery = new Switchery(elem, {
	color: '#1AB394'
	});
	$(".js-switch").siblings(".switchery").css("width", "70px")
	.prepend("<span class='text_add'>All</span>").find("small").css("left", "0");
</script>