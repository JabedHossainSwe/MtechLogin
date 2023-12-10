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
				<div class="row wrapper border-bottom white-bg page-heading pb-2">
					<div class="col-lg-12">
						<h2 class="font-weight-bold float-left en">Edit Profile</h2>
						<h2 class="font-weight-bold float-right ar"><?= getArabicTitle('Edit Profile') ?></h2>
					</div>
				</div>
				<!-- <div class="row mt-2">
					<div class="col-12">
						<button type="button" class="btn btn-w-m btn-default eng">English</button>
						<button type="button" class="btn btn-w-m btn-default ara">Arabic</button>
					</div>
				</div> -->
				<div class="wrapper wrapper-content animated fadeInRight ecommerce">
					<?php
					if (!empty($_GET['value'])) {
					?>
						<div class="alert alert-success alert-dismissable">
							<button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
							<?php
							if ($_GET['value'] == 'password') {
								echo "Congratulations! Password Updated.";
							}

							if ($_GET['value'] == 'general') {
								echo "Congratulations! General Info Updated.";
							}

							if ($_GET['value'] == 'company') {

								echo "Congratulations! Company Info Updated.";
							}

							?>
						</div>


					<?php
					}
					?>
					<div class="row">

						<div class="col-lg-12">
							<div class="tabs-container">
								<ul class="nav nav-tabs">
									<?php
									if ($_SESSION['isAdmin'] == '1') {
									?>
										<li><a class="nav-link active" data-toggle="tab" href="#tab-1"><span class="en">Company Info</span><span class="ar"><?= getArabicTitle('Company Info') ?></span></a></li>
										<li><a class="nav-link" data-toggle="tab" href="#tab-branches"><span class="en">Branches</span><span class="ar"><?= getArabicTitle('Branches') ?></span></a></li>
										<li><a class="nav-link" data-toggle="tab" onClick="loadEmployees()" href="#tab-4"><span class="en">User Management</span><span class="ar"><?= getArabicTitle('User Management') ?></span></a></li>
									<?php
									}
									?>

									<li><a class="nav-link  <?php if ($_SESSION['isAdmin'] == '0') {echo "active";} ?> " data-toggle="tab" href="#tab-2"><span class="en">Personal Information</span><span class="ar"><?= getArabicTitle('Personal Information') ?></span></a></li>


									<li><a class="nav-link" data-toggle="tab" href="#tab-3"><span class="en">Change Password</span><span class="ar"><?= getArabicTitle('Change Password') ?></span></a></li>

								</ul>
								<div class="tab-content">
									<?php
									if ($_SESSION['isAdmin'] == '1') {
									?>
										<div id="tab-1" class="tab-pane active">
											<div class="panel-body">
												<form action="javascript:save_company_info()" class="form-horizontal form-bordered form-label-stripped inputform" id="save_company_info_form">
													<?php
													$MainQ = RunMain("Select * from " . dbObjectMain . "Companies where id = '" . $_SESSION['companyId'] . "'");
													$mymaster = myfetchMain($MainQ);
													?>
													<div class="row">
														<div class="col-md-4">
															<h4><span class="en">Company Name(en)</span><span class="ar"><?= getArabicTitle('Company Name(en)') ?></span>
															</h4>
														</div>
														<div class="col-md-8">
															<div class="form-group">
																<input value="<?= $mymaster->name ?>" id="cname" name="cname" type="text" class="form-control">
																<span class="help-block errorDiv" id="cname_error"></span>

															</div>
														</div>
													</div>
													<div class="row">
														<div class="col-md-4">
															<h4><span class="en">Company Name(ar)</span><span class="ar"><?= getArabicTitle('Company Name(ar)') ?></span>
															</h4>
														</div>
														<div class="col-md-8">
															<div class="form-group">
																<input value="<?= $mymaster->name_ar ?>" dir="rtl" id="cname_ar" name="cname_ar" type="text" class="form-control">
																<span class="help-block errorDiv" id="cname_ar_error"></span>
															</div>
														</div>
													</div>

													<div class="row">
														<div class="col-md-4">
															<h4><span class="en">Mobile(en)</span><span class="ar"><?= getArabicTitle('Mobile(en)') ?></span>
															</h4>
														</div>
														<div class="col-md-8">
															<div class="form-group">
																<input value="<?= $mymaster->mobile ?>" id="mobile" name="mobile" type="text" class="form-control">
																<span class="help-block errorDiv" id="mobile_error"></span>

															</div>
														</div>
													</div>
													<div class="row">
														<div class="col-md-4">
															<h4><span class="en">Mobile(ar)</span><span class="ar"><?= getArabicTitle('Mobile(ar)') ?></span>
															</h4>
														</div>
														<div class="col-md-8">
															<div class="form-group">
																<input value="<?= $mymaster->mobile_ar ?>" dir="rtl" id="mobile_ar" name="mobile_ar" type="text" class="form-control">
																<span class="help-block errorDiv" id="mobile_ar_error"></span>
															</div>
														</div>
													</div>


													<div class="row">
														<div class="col-md-4">
															<h4><span class="en">Phone(en)</span><span class="ar"><?= getArabicTitle('Phone(en)') ?></span>
															</h4>
														</div>
														<div class="col-md-8">
															<div class="form-group">
																<input value="<?= $mymaster->phone ?>" id="phone" name="phone" type="text" class="form-control">
																<span class="help-block errorDiv" id="phone_error"></span>

															</div>
														</div>
													</div>

													<div class="row">
														<div class="col-md-4">
															<h4><span class="en">Phone(ar)</span><span class="ar"><?= getArabicTitle('Phone(ar)') ?></span>
															</h4>
														</div>
														<div class="col-md-8">
															<div class="form-group">
																<input value="<?= $mymaster->phone_ar ?>" dir="rtl" id="phone_ar" name="phone_ar" type="text" class="form-control">
																<span class="help-block errorDiv" id="phone_ar_error"></span>
															</div>
														</div>
													</div>

													<div class="row">
														<div class="col-md-4">
															<h4><span class="en">Address</span><span class="ar"><?= getArabicTitle('Address') ?></span>
															</h4>
														</div>
														<div class="col-md-8">
															<div class="form-group">
																<input value="<?= $mymaster->address ?>" id="address" name="address" type="text" class="form-control">
																<span class="help-block errorDiv" id="address_error"></span>

															</div>
														</div>
													</div>

													<div class="row">
														<div class="col-md-4">
															<h4><span class="en">Address</span><span class="ar"><?= getArabicTitle('Address') ?></span>
															</h4>
														</div>
														<div class="col-md-8">
															<div class="form-group">
																<input value="<?= $mymaster->address_ar ?>" dir="rtl" id="address_ar" name="address_ar" type="text" class="form-control">
																<span class="help-block errorDiv" id="address_ar_error"></span>

															</div>
														</div>
													</div>


													<div class="row">
														<div class="col-md-4">
															<h4><span class="en">VAT / NTN(en)</span><span class="ar"><?= getArabicTitle('VAT / NTN(en)') ?></span></h4>
														</div>
														<div class="col-md-8">
															<div class="form-group">
																<input value="<?= $mymaster->vat ?>" id="vat" name="vat" type="text" class="form-control">
																<span class="help-block errorDiv" id="vat_error"></span>

															</div>
														</div>
													</div>

													<div class="row">
														<div class="col-md-4">
															<h4><span class="en">VAT / NTN(ar)</span><span class="ar"><?= getArabicTitle('VAT / NTN(ar)') ?></span></h4>
														</div>
														<div class="col-md-8">
															<div class="form-group">
																<input value="<?= $mymaster->vat_ar ?>" dir="rtl" id="vat_ar" name="vat_ar" type="text" class="form-control">
																<span class="help-block errorDiv" id="vat_ar_error"></span>

															</div>
														</div>
													</div>


													<div class="row">
														<div class="col-md-4">
															<h4><span class="en">Company Logo</span><span class="ar"><?= getArabicTitle('Company Logo') ?></span></h4>
															<small style="font-size: 12px; color: red;" class="en">extensions allowed (jpg,jpeg,png,gif)</small>
															<small style="font-size: 12px; color: red;" class="ar"><?= getArabicTitle('extensions allowed') ?> (jpg,jpeg,png,gif)</small>


														</div>
														<div class="col-md-8">
															<div class="form-group">
																<div class="input-group">
																	<div class="custom-file">
																		<input id="logo" name="logo" type="file" class="custom-file-input">
																		<label class="custom-file-label" for="logo"><span class="en">Choose file</span><span class="ar"><?= getArabicTitle('Choose file') ?></span></label>
																	</div>
																	<span class="help-block errorDiv" id="logo_error"></span>

																</div>

															</div>
															<?php
															if ($mymaster->logo) {
															?> <br />
																<img src="/<?= $mymaster->logo ?>" class="img-resposive" style="width:150px;">
															<?php
															}

															?>


														</div>
													</div>
													<div class="row justify-content-center mt-5">

														<div class="col-md-2">
															<button type="submit" class="btn btn-block btn-lg btn-outline-danger" id="seles_report_search" onClick="location.reload()" value="Exit"><span class="en">Exit</span><span class="ar"><?= getArabicTitle('Exit') ?></span>
															</button>
														</div>
														<div class="col-md-2">
															<button type="submit" class="btn btn-block btn-lg btn-outline-success" id="seles_report_search" value="Submit"><span class="en">Submit</span><span class="ar"><?= getArabicTitle('Submit') ?></span>
															</button>
														</div>
													</div>
												</form>
												<div id="save_company_info_div"></div>
											</div>
										</div>

										<div id="tab-branches" class="tab-pane">
											<div class="panel-body">

												<div class="row">
													<div class="col-12" id="loadbranches"></div>

												</div>


											</div>
										</div>
										<div id="tab-4" class="tab-pane">
											<div class="panel-body">

												<div class="row">
													<div class="col-12" id="loadEmployees"></div>

												</div>


											</div>
										</div>
									<?php
									}
									?>
									<div id="tab-2" class="tab-pane <?php if ($_SESSION['isAdmin'] == '0') {
																		echo "active";
																	} ?>">
										<div class="panel-body">
											<?php
											$MainQ = RunMain("Select * from " . dbObjectMain . "Logins where code = '" . $_SESSION['storeCode'] . "'");
											$mymaster = myfetchMain($MainQ);
											?>
											<form action="javascript:save_general()" class="form-horizontal form-bordered form-label-stripped" id="add_user_form">

												<div class="row">
													<div class="col-md-4">
														<h4><span class="en">Email</span><span class="ar"><?= getArabicTitle('Email') ?></span></h4>
													</div>
													<div class="col-md-8">
														<div class="form-group">
															<input value="<?= $mymaster->email ?>" type="text" class="form-control" readonly>

														</div>
													</div>
												</div>

												<div class="row">
													<div class="col-md-4">
														<h4><span class="en">Name</span><span class="ar"><?= getArabicTitle('Name') ?></span></h4>
													</div>
													<div class="col-md-8">
														<div class="form-group">
															<input value="<?= $mymaster->name ?>" id="name" name="name" type="text" class="form-control">
															<span class="help-block errorDiv" id="name_error"></span>

														</div>
													</div>
												</div>

												<div class="row">
													<div class="col-md-4">
														<h4><span class="en">Profile Pic</span><span class="ar"><?= getArabicTitle('Profile Pic') ?></span></h4>
														<small style="font-size: 12px; color: red;" class="en">extensions allowed (jpg,jpeg,png,gif)</small>
														<small style="font-size: 12px; color: red;" class="ar"><?= getArabicTitle('extensions allowed') ?> (jpg,jpeg,png,gif)</small>
													</div>
													<div class="col-md-8">
														<div class="form-group">
															<div class="input-group">
																<div class="custom-file">
																	<input id="file" name="file" type="file" class="custom-file-input">
																	<label class="custom-file-label" for="file"><span class="en">Choose file</span><span class="ar"><?= getArabicTitle('Choose file') ?></span></label>
																</div>
																<span class="help-block errorDiv" id="file_error"></span>

															</div>

														</div>
													</div>
												</div>
												<div class="row justify-content-center mt-5">

													<div class="col-md-2">
														<button type="submit" class="btn btn-block btn-lg btn-outline-danger" id="" value="Exit"><span class="en">Exit</span><span class="ar"><?= getArabicTitle('Exit') ?></span>
														</button>
													</div>
													<div class="col-md-2">
														<button type="submit" class="btn btn-block btn-lg btn-outline-success" id="seles_report_search" value="Submit"><span class="en">Submit</span><span class="ar"><?= getArabicTitle('Submit') ?></span>
														</button>
													</div>
												</div>
											</form>
											<div id="save_general"></div>
										</div>
									</div>
									<div id="tab-3" class="tab-pane">
										<div class="panel-body">

											<form action="javascript:change_password()" class="form-horizontal form-bordered form-label-stripped" id="change_pass_form">
												<div class="row">
													<div class="col-md-4">
														<h4><span class="en">Old Password</span><span class="ar"><?= getArabicTitle('Old Password') ?></span>
														</h4>
													</div>
													<div class="col-md-8">
														<div class="form-group">
															<input value="" id="old_pw" name="old_pw" type="text" class="form-control" autocomplete="off">
															<span class="help-block errorDiv" id="old_pw_error"></span>

														</div>
													</div>
												</div>
												<div class="row">

													<div class="col-md-4">
														<h4><span class="en">New Password</span><span class="ar"><?= getArabicTitle('New Password') ?></span>
														</h4>
													</div>
													<div class="col-md-8">
														<div class="form-group">
															<input value="" id="new_pw" name="new_pw" type="text" class="form-control" autocomplete="off">
															<span class="help-block errorDiv" id="new_pw_error"></span>

														</div>
													</div>
												</div>
												<div class="row">
													<div class="col-md-4">
														<h4><span class="en">Confirm Password</span><span class="ar"><?= getArabicTitle('Confirm Password') ?></span>
														</h4>
													</div>
													<div class="col-md-8">
														<div class="form-group">
															<input value="" id="c_pw" name="c_pw" type="text" class="form-control" autocomplete="off">
															<span class="help-block errorDiv" id="c_pw_error"></span>

														</div>
													</div>
												</div>
												<div class="row justify-content-center mt-5">

													<div class="col-md-2">
														<button type="submit" class="btn btn-block btn-lg btn-outline-danger" id="seles_report_search" value="Exit"><span class="en">Exit</span><span class="ar"><?= getArabicTitle('Exit') ?></span>
														</button>
													</div>
													<div class="col-md-2">
														<button type="submit" class="btn btn-block btn-lg btn-outline-success" id="seles_report_search" value="Submit"><span class="en">Submit</span><span class="ar"><?= getArabicTitle('Submit') ?></span>
														</button>
													</div>
												</div>
											</form>
											<div id="change_password"></div>

										</div>
									</div>

								</div>
							</div>
						</div>
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


<script>
	$(".ara").on("click", function() {
		$("span.en").css("display", "none");
		$("span.ar").css("display", "block");
		$(".add_me").addClass("rv");
		$(".this_ar").addClass("tb");
	})

	$(".eng").on("click", function() {
		$("span.en").css("display", "block");
		$("span.ar").css("display", "none");
		$(".add_me").removeClass("rv");
		$(".this_ar").removeClass("tb");

	})
	$(document).ready(function() {
		loadbranches();
	});
</script>
<script src="include/profile/js.js"></script>