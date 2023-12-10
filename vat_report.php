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
			<div class="row wrapper border-bottom white-bg page-heading pb-2">
				<div class="col-lg-4">
					<h2 class="font-weight-bold"><span class="en">Vat Report</span><span class="ar"><?= getArabicTitle('Vat Report') ?></span></h2>
				</div>


			</div>
			<div class="wrapper wrapper-content animated fadeInRight">
				<div class="row pb-3">
					<div class="col-12">
						<button type="button" class="btn btn-w-m btn-outline-primary float-right" id="filter"><span class="en">Filters</span><span class="ar">
								<?= getArabicTitle('Filters') ?>
							</span></h4></button>
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
								<input type="number" id="selected_lang" name="selected_lang" value="<?php !empty($_GET['selected_lang']) ? $_GET['selected_lang'] : '1' ?>" hidden>
								<div class="row">
									<div class="col-6">
										<div class="row">
											<div class="col-md-5">
												<h4><span class="en">Branch</span><span class="ar"><?= getArabicTitle('Branch') ?></span></h4>
											</div>

											<div class="col-md-7">
												<div class="form-group">
													<div>
														<select id="branch" name="branch" class="select2_demo_1 form-control" tabindex="4" required>
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
											<div class="col-md-4 col-6">
												<div class="i-checks"><label class="">
														<div class="iradio_square-green ">
															<div class="iradio_square-green">
																<input type="radio" <?php if ($_GET['report_type'] == '1') {echo "Checked";} ?> <?php if ($_GET['report_type'] == '') {echo "Checked";} ?> value="1" name="report_type" required>
															</div>
															<ins class="iCheck-helper"></ins>
														</div> <i></i> <span class="en">Summary </span><span class="ar">
															<?= getArabicTitle('Summary') ?>
														</span>
													</label>
												</div>
											</div>
											<div class="col-md-6 col-6">
												<div class="i-checks"><label class="">
														<div class="iradio_square-green ">
															<div class="iradio_square-green">
																<input type="radio" value="2" name="report_type" <?php if ($_GET['report_type'] == '2') {echo "Checked";} ?> required>
															</div>
															<ins class="iCheck-helper"></ins>
														</div> <i></i> <span class="en">General </span><span class="ar">
															<?= getArabicTitle('General') ?>
														</span>
													</label>
												</div>
											</div>

										</div>
									</div>

									<div class="col-md-6">
										<div class="row">
											<div class="col-md-5">
												<h4><span class="en">From Date</span><span class="ar"><?= getArabicTitle('From Date') ?></span>
												</h4>
											</div>
											<div class="col-md-7 ">
												<div class="form-group">
													<div class="input-group date">
														<span class="input-group-addon">
															<i class="fa fa-calendar"></i></span>
														<input id="from_date" name="from_date" type="text" class="form-control" value="<?php if(!empty($_GET['from_date'])){echo $_GET['from_date'];} else{echo date('Y-m-01'); } ?>" autocomplete="off" required>
													</div>
												</div>
											</div>
										</div>
									</div>

									<div class="col-md-6">
										<div class="row">
											<div class="col-md-5">
												<h4><span class="en">To Date</span><span class="ar"><?= getArabicTitle('To Date') ?></span> </h4>
											</div>
											<div class="col-md-7">
												<div class="form-group">
													<div class="input-group date">
														<span class="input-group-addon">
															<i class="fa fa-calendar"></i></span>
														<input id="to_date" name="to_date" type="text" class="form-control" value="<?php if(!empty($_GET['to_date'])){echo $_GET['to_date'];} else{echo date('Y-m-d'); } ?>" autocomplete="off" required>
													</div>
												</div>
											</div>
										</div>
									</div>

									<div class="col-12 row justify-content-center mt-5">
										<div class="col-md-2">
											<button type="button" class="btn btn-block btn-lg btn-outline-danger" onClick="location.reload()"><span class="en">Exit</span><span class="ar"><?= getArabicTitle('Exit') ?></span></button>
										</div>
										<div class="col-md-2">
											<button type="submit" class="btn btn-block btn-lg btn-outline-success" id="seles_report_search" value="Search"><span class="en">Search</span><span class="ar"><?= getArabicTitle('Search') ?></span></button>
										</div>
									</div>
								</div>
							</form>
						</div>
					</div>
				</div>

				<?php
				if (isset($_GET['report_type'])) {
				?>
					<div class="ibox">
						<div class="ibox-content this_ar">

							<div class="table-responsive">


								<div class="row">
									<div class="col-lg-12" id="sales_report">

										<?php
										include('newpagination/paginator.class.php');

										if (isset($_GET['branch']) && !empty($_GET['branch'])) {
											$branch = urldecode($_GET['branch']);
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


										$dt = !empty($dt) ? $dt : NULL;
										$dt2 = !empty($dt2) ? $dt2 : NULL;

										$pages = new Paginator;

										if ($_GET['report_type'] == '1') {
											$GroupByType = 2;
											include("include/reports/vat/vat_report/summery.php");
										}


										if ($_GET['report_type'] == '2') {
											$GroupByType = 1;
											include("include/reports/vat/vat_report/general.php");
										}



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
<script src="include/reports/vat/js.js"></script>
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