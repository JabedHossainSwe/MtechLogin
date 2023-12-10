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
		<?php include("top-header.php"); ?>

		<div id="page-wrapper" class="gray-bg">
			<?php include("sidebar.php");

			$queryForMax = Run("Select max(BillNo) as bno from " . dbObject . "DataOutDetailTransfer");
			$BillNO = myfetch($queryForMax)->bno + 1;
			?>

			<div class="wrapper wrapper-content animated fadeInRight">

				<form action="javascript:saveVoucher()" id="Form_voucher" method="post" class="ibox-content  ">

					<div class="row">
						<div class="col-lg-12">
							<div class="ibox">
								<div class="ibox-title">
									<div class="row">
										<div class="col-md-12">
											<h5 class="mr-4"><span class="en">Transfer Branch</span><span class="ar"><?= getArabicTitle('Transfer Branch') ?></span></h5>
										</div>
									</div>
								</div>

								<!------First Line------>
								<div class="row d-flex justify-content-start mb-1">
									<!------Bill Number------>
									<div class="col-md-4 row">
										<div class="col-md-5">
											<h4><span class="en">Bill No</span><span class="ar"><?= getArabicTitle('Bill No') ?></span></h4>
										</div>
										<div class="form-group col-md-7">
											<input value="<?= $BillNO ?>" id="bill_no" name="bill_no" readonly type="text" class="form-control">
										</div>
									</div>
									<!------Bill Date------>
									<div class="col-md-4">
										<div class="row">
											<div class="col-md-4">
												<h4><span class="en">Bill Date</span><span class="ar"><?= getArabicTitle('Bill Date') ?></span></h4>
											</div>
											<div class="col-md-8">
												<div class="form-group">
													<input value="<?= date("Y-m-d") ?>" id="bill_date_time" name="bill_date_time" type="date" class="form-control">
												</div>
											</div>
										</div>
									</div>
									<!------Ref No.------>
									<div class="col-md-4 row">
										<div class="col-md-5 text-center">
											<h4><span class="en">Reference No</span><span class="ar"><?= getArabicTitle('Reference No') ?></span></h4>
										</div>
										<div class="form-group col-md-7">
											<input value="" id="RefNo1" name="RefNo1" type="text" class="form-control">
										</div>
									</div>
								</div>

								<!------Second Line------>
								<div class="row d-flex justify-content-start mb-1">
									<!--Select Branch  -->
									<div class="col-lg-6 row">
										<div class="col-md-4">
											<h4><span class="en">Select Branch</span><span class="ar"><?= getArabicTitle('Select Branch') ?></span>
											</h4>
										</div>

										<div class="col-md-8">
											<div class="form-group">
												<div>
													<select class="select2_demo_1 form-control" name="Bid" id="Bid" aria-label="sales-men">
														<?php

														if ($_SESSION['isAdmin'] == '1') {
															$Bracnhes = Run("Select * from " . dbObject . "Branch order by BName ASC");
														} else {
															$Bracnhes = Run("Select " . dbObject . "Branch.Bid," . dbObject . "Branch.BName from " . dbObject . "Branch
															Inner JOIN " . dbObject . "EMP  On " . dbObject . "EMP.BID = " . dbObject . "Branch.Bid
															where " . dbObject . "EMP.WebCode = '" . $_SESSION['code'] . "' ");
														}

														while ($getBranches = myfetch($Bracnhes)) {
															$selected = "";
															if ($_GET['branc'] != '') {
																if ($getBranches->ismain == '1') {
																	$selected = "Selected";
																}
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

									<!------Saleman------>
									<div class="col-md-6 row">
										<div class="col-md-2 text-center d-flex justify-content-start">
											<h4><span class="en">Saleman</span><span class="ar">
													<?= getArabicTitle('Saleman') ?>
												</span>
											</h4>
										</div>

										<div class="col-md-8">
											<div class="form-group">
												<div>
													<select id="salesMan" name="EmpID" class="select2_demo_1 form-control" tabindex="4" onChange="">
														<?php
														if ($_SESSION['isAdmin'] == '1') {
															$SalesMan = Run("select  Cid Id,CCode + ' - ' + Cname CName from Emp Where  isnull(IsDeleted,0)=0  order by Cid");
														} else {
															$SalesMan = Run("select  Cid Id,CCode + ' - ' + Cname CName from Emp Where  isnull(IsDeleted,0)=0 and webCode = '" . $_SESSION['code'] . "'  order by Cid");
														}


														while ($getSalesMan = myfetch($SalesMan)) {
															$selected = "";

														?>
															<option value="<?php echo $getSalesMan->Id; ?>" <?php echo $selected; ?>><?php echo $getSalesMan->CName; ?></option>
														<?php
														}

														?>
													</select>
												</div>
											</div>
										</div>

										<div class="col-md-2">
											<button type="button" class="btn btn-success" onclick="CheckBranchBill(this)"><i class="fa fa-refresh" aria-hidden="true"></i></button>
										</div>
									</div>
								</div>
							</div>
						</div>

						<div class="row col-md-12">
							<div class="col-lg-12">
								<div class="ibox">
									<div class="ibox-content ">

										<div style="background: #80808014;" id="customerCheck">

											<table class="table table-bordered">
												<thead>
													<tr>
														<th><span class="en">Item Code</span><span class="ar"><?= getArabicTitle('Item Code') ?></span></th>
														<th><span class="en">Item Name</span><span class="ar"><?= getArabicTitle('Item Name') ?></span></th>
														<th><span class="en">Unit</span><span class="ar"><?= getArabicTitle('Unit') ?></span></th>
														<th><span class="en">Qty</span><span class="ar"><?= getArabicTitle('Qty') ?></span></th>
														<th><span class="en">Price</span><span class="ar"><?= getArabicTitle('Price') ?></span></th>
														<th><span class="en">Total</span><span class="ar"><?= getArabicTitle('Total') ?></span></th>
													</tr>
												</thead>
												<tbody id="row_append">

												</tbody>
												<tfoot>

													<tr>
														<th>Total Row Count</th>
														<th id="totalRowCount">0</th>
														<th>Total Quantity</th>
														<th id="totalQtyN">0</th>
													</tr>

												</tfoot>
											</table>

											<input type="hidden" name="nrows" id="nrows" value="0">
										</div>

									</div>
								</div>
							</div>

							<div class="col-lg-12 col-md-12">
								<div class="ibox">
									<div class="ibox-content ">
										<div class="row d-flex justify-content-center">
											<div class="col-lg-3">
												<input type="submit" class="btn btn-block btn-lg btn-outline-success" name="submit" value="Save">
											</div>

										</div>


									</div>
								</div>
							</div>
						</div>

						<input type="hidden" name="f_total" id="f_total" value="">
				</form>
			</div>

			</form>
			<div id="saveVoucher"></div>
			<?php include("footer.php"); ?>
		</div>
	</div>
	</div>
	</div>


</body>

</html>

<script src="include/branch_receiving/js.js"></script>
<script>
	$(document).ready(function() {
		$("#salesMan").select2({});
		$("#Bid").select2({});
	});
</script>