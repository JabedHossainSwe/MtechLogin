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
				<div class="col-lg-12">
					<h2 class="font-weight-bold"><span class="float-left en">Employee Registration</span><span class="float-right ar"><?= getArabicTitle('Employee Registration') ?></span></h2>

				</div>
			</div>
			<div class="wrapper wrapper-content animated fadeInRight">
				<div class="row">
					<div class="col-lg-12">
						<div class="ibox">
							<div class="ibox-title">
								<div class="row">
									<div class="col-md-9">
										<h5 class="mr-4"><span class="en">Employee Details</span><span class="ar"><?= getArabicTitle('Employee Details') ?></span></h5>
									</div>

								</div>

								<div class="ibox-tools no_envent" style="display: none">
									<a class="collapse-link filter_act">
										<i class="fa fa-chevron-down"></i>
									</a>
								</div>
							</div>
							<form action="" id="" method="get" class="ibox-content">

								<input type="number" id="selected_lang" name="selected_lang" value="<?php !empty($_GET['selected_lang']) ? $_GET['selected_lang'] : '2' ?>" hidden>
								<div class="row">

									<div class="col-12">
										<div class="row">
											<div class="col-md-2">
												<h4><span class="en">Code</span><span class="ar"><?= getArabicTitle('Code') ?></span></h4>
											</div>

											<div class="col-3">
												<div class="form-group">
													<input value="" id="code" name="code" type="text" class="form-control" autocomplete="off">



												</div>
											</div>
											<div class="col-md-7">
												<div class="row">
													<div class="col-md-3 col-3">
														<div class="i-checks"><label class="">
																<div class="iradio_square-green ">
																	<div class="iradio_square-green">
																		<input type="radio" value="is_admin" name="emp_type">
																	</div>
																	<ins class="iCheck-helper"></ins>
																</div> <i></i> <span class="en">Is Admin</span><span class="ar"><?= getArabicTitle('Is Admin') ?></span></label>
														</div>
													</div>

													<div class="col-md-3 col-3">
														<div class="i-checks"><label class="">
																<div class="iradio_square-green ">
																	<div class="iradio_square-green">
																		<input type="radio" value="is_accountant" name="emp_type">
																	</div>
																	<ins class="iCheck-helper"></ins>
																</div> <i></i> <span class="en">Is Accountant</span><span class="ar"><?= getArabicTitle('Is Accountant') ?></span></label>
														</div>
													</div>

													<div class="col-md-3 col-3">
														<div class="i-checks"><label class="">
																<div class="iradio_square-green ">
																	<div class="iradio_square-green">
																		<input type="radio" value="is_supervisor" name="emp_type">
																	</div>
																	<ins class="iCheck-helper"></ins>
																</div> <i></i> <span class="en">Is Supervisor</span><span class="ar"><?= getArabicTitle('Is Supervisor') ?></span></label>
														</div>
													</div>

													<div class="col-md-3 col-3">
														<div class="i-checks"><label class="">
																<div class="iradio_square-green ">
																	<div class="iradio_square-green">
																		<input type="radio" value="is_worker" name="emp_type">
																	</div>
																	<ins class="iCheck-helper"></ins>
																</div> <i></i> <span class="en">Is Worker</span><span class="ar"><?= getArabicTitle('Is Worker') ?></span></label>
														</div>
													</div>

												</div>
											</div>



										</div>
									</div>

									<div class="col-12">
										<div class="row">
											<div class="col-md-2">
												<h4><span class="en">Name</span><span class="ar"><?= getArabicTitle('Name') ?></span></h4>
											</div>

											<div class="col-4">
												<div class="form-group">
													<input value="" id="name" name="name" type="text" class="form-control" autocomplete="off">



												</div>
											</div>

											<div class="col-md-2">
												<h4><span class="en">Description</span><span class="ar"><?= getArabicTitle('Description') ?></span></h4>
											</div>

											<div class="col-4">
												<div class="form-group">
													<textarea id="description" name="description" type="text" class="form-control"></textarea>
												</div>
											</div>


										</div>
									</div>

									<div class="col-12">
										<div class="row">

										</div>
									</div>

									<div class="col-12">
										<div class="row">
											<div class="col-md-2">
												<h4><span class="en">Department</span><span class="ar"><?= getArabicTitle('Department') ?></span></h4>
											</div>

											<div class="col-10">
												<div class="form-group">
													<div>
														<select id="department" name="department" class="select2_demo_1 form-control" tabindex="4" required>
															<option value="">Please Select Department</option>


														</select>

													</div>


												</div>
											</div>
										</div>
									</div>


									<div class="col-12">
										<div class="row">
											<div class="col-md-2">
												<h4><span class="en">Branch</span><span class="ar"><?= getArabicTitle('Branch') ?></span></h4>
											</div>

											<div class="col-6">
												<div class="form-group">
													<div>
														<select id="branchs" name="branch" class="select2_demo_1 form-control" tabindex="4" required>
															<option value="">Please Select Branch</option>
															<?php
															$Bracnhes = Run("Select * from " . dbObject . "Branch order by BName ASC");
															$ABoveBranches  = $_GET['branch'];
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

											<div class="col-md-4">
												<div class="row">
													<div class="col-md-12 col-12">
														<div class="i-checks"><label class="">
																<div class="iradio_square-green ">
																	<div class="iradio_square-green">
																		<input type="checkbox" value="fix_with_branch" name="fix_with_branch">
																	</div>
																	<ins class="iCheck-helper"></ins>
																</div> <i></i> <span class="en">Fix With Branch</span><span class="ar"><?= getArabicTitle('Fix With Branch') ?></span></label>
														</div>
													</div>

												</div>
											</div>




										</div>
									</div>


									<div class="col-12">
										<div class="row">
											<div class="col-md-2">
												<h4><span class="en">Password</span><span class="ar"><?= getArabicTitle('Password') ?></span></h4>
											</div>

											<div class="col-4">
												<div class="form-group">
													<input id="password" name="password" type="password" class="form-control" autocomplete="off">


												</div>
											</div>



											<div class="col-md-2">
												<h4><span class="en">Commission %</span><span class="ar"><?= getArabicTitle('Commission ') ?></span></h4>
											</div>

											<div class="col-4">
												<div class="form-group">
													<input id="commission_per" name="commission_per" type="text" class="form-control" autocomplete="off">


												</div>
											</div>



										</div>
									</div>

									<div class="col-12">
										<div class="row">
											<div class="col-md-2">
												<h4><span class="en">Section</span><span class="ar"><?= getArabicTitle('Section') ?></span></h4>
											</div>

											<div class="col-4">
												<div class="form-group">
													<input id="section" name="section" type="text" class="form-control" autocomplete="off">


												</div>
											</div>

											<div class="col-md-2">
												<h4><span class="en">Type</span><span class="ar"><?= getArabicTitle('Type') ?></span></h4>
											</div>

											<div class="col-4">
												<div class="form-group">
													<div>
														<select id="type" name="type" class="select2_demo_1 form-control" tabindex="4" required>
															<option value="">Please Select Type</option>


														</select>

													</div>


												</div>
											</div>



										</div>
									</div>
								</div>

								<hr />
								<h3 class="mr-4"><span class="en">Benifits</span><span class="ar"><?= getArabicTitle('Benifits') ?></span></h3>

								<div class="row">


									<div class="col-md-2">
										<h4><span class="en">Opening Balance</span><span class="ar"><?= getArabicTitle('Opening Balance') ?></span></h4>
									</div>

									<div class="col-2">
										<div class="form-group">
											<input id="opening_balance" name="opening_balance" type="text" class="form-control" autocomplete="off">


										</div>
									</div>

									<div class="col-md-2">
										<h4><span class="en">Opening Date</span><span class="ar"><?= getArabicTitle('Opening Date') ?></span></h4>
									</div>

									<div class="col-2">
										<div class="form-group">
											<div class="input-group date">
												<span class="input-group-addon">
													<i class="fa fa-calendar"></i></span>
												<input id="from_date" name="opening_date" type="text" class="form-control" autocomplete="off">
											</div>
										</div>
									</div>
									<div class="col-md-2">
										<h4><span class="en">Basic Salary</span><span class="ar"><?= getArabicTitle(' Basic Salary') ?></span></h4>
									</div>

									<div class="col-2">
										<div class="form-group">
											<input id="basic_salary" name="basic_salary" type="text" class="form-control" autocomplete="off">

										</div>
									</div>
								</div>



								<div class="row">


									<div class="col-md-2">
										<h4><span class="en">Food Allowance</span><span class="ar"><?= getArabicTitle('Food Allowance') ?></span></h4>
									</div>

									<div class="col-2">
										<div class="form-group">
											<input id="food_allowance" name="food_allowance" type="text" class="form-control" autocomplete="off">


										</div>
									</div>

									<div class="col-md-2">
										<h4><span class="en">Travel Allowance</span><span class="ar"><?= getArabicTitle('Travel Allowance') ?></span></h4>
									</div>

									<div class="col-2">
										<div class="form-group">
											<input id="travel_allowance" name="travel_allowance" type="text" class="form-control" autocomplete="off">

										</div>
									</div>
									<div class="col-md-2">
										<h4><span class="en">House Allowance</span><span class="ar"><?= getArabicTitle(' House Allowance') ?></span></h4>
									</div>

									<div class="col-2">
										<div class="form-group">
											<input id="house_allowance" name="house_allowance" type="text" class="form-control" autocomplete="off">

										</div>
									</div>
								</div>



								<div class="row">


									<div class="col-md-2">
										<h4><span class="en">COMM Allowance</span><span class="ar"><?= getArabicTitle('COMM Allowance') ?></span></h4>
									</div>

									<div class="col-2">
										<div class="form-group">
											<input id="comm_allowance" name="comm_allowance" type="text" class="form-control" autocomplete="off">


										</div>
									</div>

									<div class="col-md-2">

									</div>

									<div class="col-2">

									</div>
									<div class="col-md-2">
										<h4><span class="en">Others</span><span class="ar"><?= getArabicTitle(' Others') ?></span></h4>
									</div>

									<div class="col-2">
										<div class="form-group">
											<input id="others" name="others" type="text" class="form-control" autocomplete="off">

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
			include("footer.php");
			?>
		</div>
	</div>
	</div>
	</div>





</body>

</html>

<script src="include/reports/supplier/js.js"></script>
<script>
	$(document).ready(function() {
		$("#department").select2({
			width: '100%',
			closeOnSelect: true,
			placeholder: '',

		});

		$("#type").select2({
			width: '100%',
			closeOnSelect: true,
			placeholder: '',

		});

	});
</script>