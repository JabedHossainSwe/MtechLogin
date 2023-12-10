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



			$queryForMax = Run("Select max(BillNO) as bno from " . dbObject . "Receipt");
			$BillNO = myfetch($queryForMax)->bno + 1;
			?>

			<div class="wrapper wrapper-content animated fadeInRight">
				<!-- <div class="row mb-1"> -->
					<!-- <div class="col-md-6 col-8">
<button type="button" class="btn btn-w-m btn-default eng">English</button>
<button type="button" class="btn btn-w-m btn-default ara">Arabic</button>
</div> -->
					<!-- <div class="col-12"> -->
					<!-- </div> -->
				<!-- </div> -->

				<form action="javascript:saveVoucher()" id="Form_voucher" method="post" class="ibox-content ">

					<div class="row">
						<div class="col-lg-12">
							<div class="ibox">
								<div class="ibox-title">
									<div class="row">
										<div class="col-md-12">
											<h5 class="en float-left">Issuing Receipt</h5>
											<h5 class="ar float-right"><?= getArabicTitle('Issuing Receipt') ?></h5>
										</div>
									</div>
								</div>

								<!------First Line------>
								<div class="row d-flex justify-content-start mb-1">
									<!------Bill Number------>
									<div class="col-md-3 row">
										<div class="col-md-5 text-center">
											<h4><span class="en">Bill No</span><span class="ar"><?= getArabicTitle('Bill No') ?></span></h4>
										</div>
										<div class="form-group col-md-7">
											<input value="<?= $BillNO ?>" id="bill_no" name="bill_no" readonly type="text" class="form-control">
										</div>
									</div>
									<!------Bill Date------>
									<div class="col-md-3">
										<div class="row">
											<div class="col-md-4">
												<h4><span class="en">Bill Date</span><span class="ar"><?= getArabicTitle('Bill Date') ?></span></h4>
											</div>
											<div class="col-md-8">
												<div class="form-group">
													<input value="<?= date("Y-m-d H:i:s") ?>" id="bill_date_time" name="bill_date_time" type="datetime-local" class="form-control">
												</div>
											</div>
										</div>
									</div>
									<!------Customer------>
									<div class="col-md-6 ml-1 row  ">
										<div class="col-md-2 text-center d-flex justify-content-start">
											<h4><span class="en">Customer</span><span class="ar"><?= getArabicTitle('Customer') ?></span></h4>
										</div>

										<div class="col-md-10">
											<div class="form-group">
												<div>
													<select id="customer_id" name="customer_id" class="select2_demo_1 form-control" tabindex="4" onChange="customerCheck(this.value)">
													</select>
												</div>
											</div>
										</div>


									</div>
								</div>

								<!------Second Line------>
								<div class="row d-flex justify-content-start mb-1">
									<!------Ref No.------>
									<div class="col-md-3 row">
										<div class="col-md-5 text-center">
											<h4><span class="en">Ref No</span><span class="ar"><?= getArabicTitle('Ref No') ?></span></h4>
										</div>
										<div class="form-group col-md-7">
											<input value="" id="RefNo1" name="RefNo1" type="text" class="form-control">
										</div>
									</div>
									<!------Balance------>
									<div class="col-md-3">
										<div class="row">
											<div class="col-md-4">
												<h4><span class="en">Balance</span><span class="ar"><?= getArabicTitle('Balance') ?></span></h4>
											</div>
											<div class="col-md-8">
												<div class="form-group">
													<input id="cust_balance" name="cust_balance" type="text" class="form-control" readonly>
												</div>
											</div>
										</div>
									</div>
									<!------Saleman------>
									<div class="col-md-6 ml-1 row ">
										<div class="col-md-2 text-center d-flex justify-content-start">
											<h4><span class="en">Saleman</span><span class="ar"><?= getArabicTitle('Saleman') ?></span></h4>
										</div>

										<div class="col-md-10">
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


									</div>
								</div>

								<!------First Line------>
								<div class="row d-flex justify-content-start mb-1">
									<!------Bill Number------>
									<div class="col-md-6 row">
										<div class="row col-md-12">
											<div class="col-md-2">
												<h4><span class="en">Remarks</span><span class="ar"><?= getArabicTitle('Remarks') ?></span>
												</h4>
											</div>
											<div class="col-md-10">
												<div class="form-group ml-2">
													<input type="text" id="remarks" name="remarks" class="form-control">
												</div>
											</div>
										</div>

									</div>
									<div class="col-md-6 ml-1 row ">
										<div class="col-md-2 text-center d-flex justify-content-start">
											<h4><span class="en">Bank</span><span class="ar"><?= getArabicTitle('Bank') ?></span></h4>
										</div>

										<div class="col-md-10">
											<div class="form-group">
												<div>
													<select id="bnkid" name="bnkid" class="select2_demo_1 form-control" tabindex="4" onChange="">
														<?php
														$getCurrentEmpData = getCurrentEmpData($_SESSION['storeCode']);
														$Bid = $getCurrentEmpData->BID;

														$Bracnhes = Run("exec " . dbObject . "GetPaymentType @bid='$Bid'");
														while ($getBanks = myfetch($Bracnhes)) {
															$selected = "";
														?>
															<option value="<?php echo $getBanks->id; ?>" <?php echo $selected; ?>><?php echo $getBanks->snameEng; ?></option>
														<?php
														}

														?>
													</select>
												</div>
											</div>
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


										</div>

									</div>
								</div>
							</div>

							<div class="col-lg-12 col-md-12">
								<div class="ibox">
									<div class="ibox-content ">
										<div class="row">
											<div class="col">
												<div class="row">
													<div class="col-md-4 d-flex justify-content-end">
														<h4><span class="en">Total</span><span class="ar"><?= getArabicTitle('Total') ?></span></h4>
													</div>
													<div class="col-md-8">
														<div class="form-total_int">
															<input value="0" id="total" name="total" type="text" class="form-control" readonly onkeyup="baki.value=this.value;TotVal(this.value);gridCalculation();mainCalculation();">
														</div>
													</div>
												</div>
											</div>
											<div class="col">
												<div class="row">
													<div class="col-md-4 d-flex justify-content-end">
														<h4><span class="en">Dis%</span><span class="ar"><?= getArabicTitle('Dis%') ?></span></h4>
													</div>
													<div class="col-md-8">
														<div class="form-group">
															<input value="0" id="disPer" name="disPer" type="text" class="form-control" onkeyup="calculateWholeDiscountAmount(this.value)">
														</div>
													</div>
												</div>
											</div>
											<div class="col">
												<div class="row">
													<div class="col-md-4 d-flex justify-content-end p-0 m-0">
														<h4><span class="en">Dis Amount </span><span class="ar"><?= getArabicTitle('Dis Amount') ?></span></h4>
													</div>
													<div class="col-md-8">
														<div class="form-group">
															<input value="0" id="disAmt" name="disAmt" type="text" class="form-control" onkeyup="calculateWholeDiscountper(this.value)">
														</div>
													</div>
												</div>
											</div>
											<div class="col">
												<div class="row">
													<div class="col-md-4 d-flex justify-content-end m-0 p-0">
														<h4><span class="en">Net Total</span><span class="ar"><?= getArabicTitle('Net Total') ?></span></h4>
													</div>
													<div class="col-md-8">
														<div class="form-group">
															<input value="0" id="netTotal" name="netTotal" type="text" class="form-control" readonly>
															<span id="span_netTotal" style="visibility: hidden">0</span>

															<span id="span_Advance" style="visibility: hidden">0</span>
															<input type="hidden" id="Advance" name="Advance" value="0">

															<input type="hidden" id="baki" name="baki" value="0">
														</div>
													</div>
												</div>
											</div>

										</div>
										<hr />
										<div class="row d-flex justify-content-center">
											<div class="col-lg-3">
												<input type="submit" class="btn btn-block btn-lg btn-outline-success en" name="submit" value="Save">
												<input type="submit" class="btn btn-block btn-lg btn-outline-success ar" name="submit" value="<?= getArabicTitle('Save') ?>">
											</div>

										</div>


									</div>
								</div>
							</div>
						</div>
						<input type="hidden" name="row_count" id="row_count" value="0">
				</form>
			</div>

			</form>
			<div id="saveVoucher"></div>
			<?php
			include("footer.php");
			?>
		</div>
	</div>
	</div>
	</div>


</body>

</html>

<script src="include/receipt/js.js"></script>
<script>

</script>