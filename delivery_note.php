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
		.filter_container {
			max-height: 100vh !important;
		}

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
			// Get Max Sale Voucher Id..

			if ($_SESSION['isAdmin'] == 0) {
				$Bracnhes = Run("Select " . dbObject . "Branch.Bid," . dbObject . "Branch.BName from " . dbObject . "Branch Inner JOIN " . dbObject . "EMP  On " . dbObject . "EMP.BID = " . dbObject . "Branch.Bid where " . dbObject . "EMP.WebCode = '" . $_SESSION['code'] . "' ");
				$userBranch = myfetch($Bracnhes);

				$condition = " Where bid = '$userBranch->Bid'";
			} else {
				$condition .= " Where bid = '" . GetMainBranch() . "'";
			}
			$QueryMax = Run("Select max(Billno) as Bno from " . dbObject . "DataDeliveryDetails $condition");
			$getBillNo = myfetch($QueryMax)->Bno + 1;


			$bidValue =  GetMainBranch();
			if ($_SESSION['isAdmin'] == 0) {
				$bidValue = $userBranch->Bid;
			}

			?>

			<div id="editVoucher">
				<form action="javascript:SaveDeliverNote()" id="sales_report_form" method="post" id="sales_voucher" class="ibox-content filter_container">

					<div class="wrapper wrapper-content animated fadeInRight pb-0">
						<!-- <div class="row mb-1">
							<div class="col-md-6 col-8">
								<button type="button" class="btn btn-w-m btn-default eng">English</button>
								<button type="button" class="btn btn-w-m btn-default ara">Arabic</button>
							</div>
							<div class="col-md-6 col-4">
							</div>
						</div> -->

						<div class="row">
							<div class="col-lg-12">
								<div class="ibox">
									<div class="ibox-title">
										<div class="row">
											<div class="col-md-9">
                                                <h5 class="mr-4"><span class="en">Delivery Note Voucher</span><span class="ar"><?= getArabicTitle('Delivery Note Voucher') ?></span></h5>
											</div>
										</div>
										<div class="ibox-tools no_envent" style="display: none">
											<a class="collapse-link filter_act">
												<i class="fa fa-chevron-down"></i>
											</a>
										</div>
									</div>
									<input type="number" id="selected_lang" name="selected_lang" value="<?php !empty($_GET['selected_lang']) ? $_GET['selected_lang'] : '2' ?>" hidden>
									<div class="row">
										<div class="col-6">
											<div class="row">
												<div class="col-md-4">
													<h4><span class="en">Branch</span><span class="ar"><?= getArabicTitle('Branch') ?></span>
													</h4>
												</div>
												<div class="col-md-8">
													<select id="Bid" name="Bid" class="grpreq select2_demo_1 form-control" tabindex="4" required onChange="loadBanksagainstBrank(this.value)">
														<?php
														if ($_SESSION['isAdmin'] == '1') {
															$Bracnhes = Run("Select * from " . dbObject . "Branch order by BName ASC");
														} else {
															$Bracnhes = Run("Select " . dbObject . "Branch.Bid," . dbObject . "Branch.BName from " . dbObject . "Branch Inner JOIN " . dbObject . "EMP  On " . dbObject . "EMP.BID = " . dbObject . "Branch.Bid where " . dbObject . "EMP.WebCode = '" . $_SESSION['code'] . "' ");
														}

														while ($getBranches = myfetch($Bracnhes)) {
															$selected = "";
															if ($getBranches->ismain == '1') {
																$selected = "Selected";
															}
														?>
															<option value="<?php echo $getBranches->Bid; ?>" <?php echo $selected; ?>><?php echo $getBranches->BName; ?></option>
														<?php
														} ?>

													</select>
												</div>
											</div>
										</div>

										<div class="col-6">
											<div class="row">
												<div class="col-md-3">
													<h4><span class="en">Bill No</span><span class="ar"><?= getArabicTitle('Bill No') ?></span></h4>
												</div>
												<div class="col-md-3">
													<div class="form-group">
														<input value="<?= $getBillNo ?>" id="bill_no" name="bill_no" type="text" class="form-control">
													</div>
												</div>

												<div class="col-md-6">
													<button type="button" class="btn btn-success" onclick="reloadVoucher()"><i class="fa fa-refresh"></i></button>


													<?php
													$qt = "select BillNo from DataDeliveryDetails where BillNo = (select max(BillNo) from DataDeliveryDetails where BillNo < '" . $getBillNo . "' and Bid='" . $bidValue . "' and isDeleted = 0) and Bid = '" . $bidValue . "' and isDeleted = 0";
													$previousQuery = Run($qt);
													$getPreviousId = myfetch($previousQuery)->BillNo;
													if ($getPreviousId != '') {
													?>

														<button type="button" class="btn btn-success" onclick="editVoucher('<?= $bidValue ?>','<?= $getPreviousId ?>')"><i class="fa fa-backward"></i></i></button>
													<?php
													}
													?>

													<button type="button" class="btn btn-success" onclick="" disabled><i class="fa fa-forward"></i></i></button>
													<button type="button" class="btn btn-success" onclick="" disabled><i class="fa fa-trash"></i></button>
													<button type="button" class="btn btn-success" onclick="" disabled><i class="fa fa-print"></i></button>
													<button type="button" class="btn btn-success" onclick="" disabled><i class="fa fa-plus"></i></button>

												</div>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-lg-6">
											<div class="row">
												<div class="col-md-4">
													<h4><span class="en">Bill Date/Time</span><span class="ar"><?= getArabicTitle('Bill Date/Time') ?></span></h4>
												</div>
												<div class="col-md-8">
													<div class="form-group">
														<input value="<?= date("Y-m-d H:i:s") ?>" id="bill_date_time" name="bill_date_time" type="datetime-local" class="form-control">
													</div>
												</div>
											</div>
										</div>

										<div class="col-lg-6">
											<div class="row">
												<div class="col-md-4">
													<h4><span class="en">Dev Note Date</span><span class="ar"><?= getArabicTitle('Dev Note Date') ?></span></h4>
												</div>
												<div class="col-md-8">
													<div class="form-group">
														<input value="<?= date("Y-m-d H:i:s") ?>" id="dev_note_date" name="dev_note_date" type="datetime-local" class="form-control">
													</div>
												</div>
											</div>
										</div>

									</div>

									<div class="row">

										<div class="col-lg-6">
											<div class="row">
												<div class="col-md-4">
													<h4><span class="en">Customer</span><span class="ar"><?= getArabicTitle('Customer') ?></span>
													</h4>
												</div>

												<div class="col-md-8">
													<div class="form-group">
														<div>
															<select id="customer_id" name="customer_id" class="select2_demo_1 form-control" tabindex="4" onchange="loadCustArea()">


															</select>
														</div>
													</div>
												</div>
											</div>
										</div>


										<div class="col-6">
											<div class="row">
												<div class="col-md-4">
													<h4><span class="en">Customer Area</span><span class="ar"><?= getArabicTitle('Customer Area') ?></span>
													</h4>
												</div>
												<div class="col-md-8">
													<div class="form-group">
														<input type="text" id="cus_area" name="cus_area" class="form-control">
													</div>
												</div>
											</div>
										</div>

										<div class="col-6">
											<div class="row">
												<div class="col-md-4">
													<h4><span class="en">Remarks</span><span class="ar"><?= getArabicTitle('Remarks') ?></span>
													</h4>
												</div>
												<div class="col-md-8">
													<div class="form-group">
														<input type="text" id="remarks" name="remarks" class="form-control">
													</div>
												</div>
											</div>
										</div>

										<div class="col-lg-6">
											<div class="row">
												<div class="col-md-4">
													<h4><span class="en">Driver</span><span class="ar"><?= getArabicTitle('Driver') ?></span>
													</h4>
												</div>

												<div class="col-md-8">
													<div class="form-group">
														<div>
															<select id="driver" name="driver" class="select2_demo_1 form-control" tabindex="4">


															</select>
														</div>
													</div>
												</div>
											</div>
										</div>

										<div class="col-6">
											<div class="row">
												<div class="col-md-4">
													<h4><span class="en">Mobile No.</span><span class="ar"><?= getArabicTitle('Mobile No.') ?></span>
													</h4>
												</div>
												<div class="col-md-8">
													<div class="form-group">
														<input type="text" id="mobileNo" name="mobileNo" class="form-control">
													</div>
												</div>
											</div>
										</div>

										<div class="col-6">
											<div class="row">
												<div class="col-md-4">
													<h4><span class="en">Fax No.</span><span class="ar"><?= getArabicTitle('Fax No.') ?></span>
													</h4>
												</div>
												<div class="col-md-8">
													<div class="form-group">
														<input type="text" id="faxNo" name="faxNo" class="form-control">
													</div>
												</div>
											</div>
										</div>
									</div>

									<div class="row">
										<div class="col-6">
											<div class="row">
												<div class="col-md-4">
													<h4><span class="en">Sales Man</span><span class="ar"><?= getArabicTitle('Sales Man') ?></span>
													</h4>
												</div>
												<div class="col-md-8">
													<select class="form-control" id="salesMan" name="EmpID" aria-label="sales-men">
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

										<div class="col-6">
											<div class="row">
												<div class="col-md-4">
													<h4><span class="en">Quotation No</span><span class="ar"><?= getArabicTitle('Quotation No') ?></span>
													</h4>
												</div>
												<div class="col-md-6">
													<div class="form-group">
														<input type="text" name="quoNo" id="quoNo" class="form-control">
													</div>
												</div>
												<div class="col-md-2">
													<button type="button" class="btn btn-success" onclick="CheckQuotationBill()"><i class="fa fa-refresh"></i></button>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>

					<div class="row" id="bill_no_area"></div>

					<input type="hidden" name="row_count" id="row_count" value="0">

					<p id="fetchProductDetails"></p>

					<div class="row">
						<div class="col-lg-12">
							<div class="ibox">
								<div class="ibox-content  filter_container">
									<div class="row">
										<table class="table table-bordered">
											<thead>
												<tr>
													<th><span class="en">Code</span><span class="ar"><?= getArabicTitle('Code') ?></span></th>
													<th><span class="en">Name</span><span class="ar"><?= getArabicTitle('Name') ?></span></th>
													<th><span class="en">Unit</span><span class="ar"><?= getArabicTitle('Unit') ?></span></th>
													<th><span class="en">Qty</span><span class="ar"><?= getArabicTitle('Qty') ?></span></th>
													<th><span class="en">Price</span><span class="ar"><?= getArabicTitle('Price') ?></span></th>
													<th><span class="en">Total</span><span class="ar"><?= getArabicTitle('Total') ?></span></th>
													<th><span class="en">Net Total</span><span class="ar"><?= getArabicTitle('Net Total') ?></span></th>
													<th><span class="en">Action</span><span class="ar"><?= getArabicTitle('Action') ?></span></th>
												</tr>
											</thead>
											<tbody>
												<tr>
													<td style="width:8%">
														<input type="text" class="form-control" onkeyup="fetchProductDetailsFromCode(this.value, '')" id="Pcode" name="Pcode">
													</td>
													<td style="width:20%" id="getProductList">
														<select id="product" name="product" class="select2_demo_1 form-control" tabindex="4" onChange="setmyValue(this.value,'Pcode');fetchProductUnits(this.value)">
														</select>
													</td>
													<td style="width:10%" id="loadUnits">

														<select class="form-select" name="unit_id" id="unit_id" aria-label="unit_id" onchange="LoadUnitPrice(this.value,'120')">
															<option value="">Please Select Unit</option>
														</select>
													</td>

													<td style="width: 8%">
														<input type="text" name="qty" id="qty" class="form-control" value="0" onkeyup="calculateSingleVatTotal(this.value);">
													</td>
													<td style="width: 8%">
														<input type="text" name="Sprice" id="Sprice" class="form-control" value="0" onkeyup="calculateSingleVatTotal(this.value, 'vatSprice')">
													</td>
													<td><input type="text" readonly name="total" id="total" class="form-control" value="0"></td>
													<td><input type="text" readonly name="netTotal" id="netTotal" class="form-control" value="0"></td>


													<td id="action_id">
														<button type="button" name="add_row" id="add_row" class="btn btn-info" onclick="addRow()"><span class="en">Add</span><span class="ar"><?= getArabicTitle('Add') ?></span></button>
													</td>
												</tr>

											</tbody>
										</table>
									</div>

									<div style="background: #80808014; height: 150px">
										<table class="table table-bordered">
											<thead>
												<tr>
													<th>#</th>
													<th><span class="en">Code</span><span class="ar"><?= getArabicTitle('Code') ?></span></th>
													<th><span class="en">Name</span><span class="ar"><?= getArabicTitle('Name') ?></span></th>
													<th><span class="en">Unit</span><span class="ar"><?= getArabicTitle('Unit') ?></span></th>
													<th><span class="en">Qty</span><span class="ar"><?= getArabicTitle('Qty') ?></span></th>
													<th><span class="en">Price</span><span class="ar"><?= getArabicTitle('Price') ?></span></th>
													<th><span class="en">Total</span><span class="ar"><?= getArabicTitle('Total') ?></span></th>
													<th><span class="en">Net Total</span><span class="ar"><?= getArabicTitle('Net Total') ?></span></th>
													<th><span class="en">Action</span><span class="ar"><?= getArabicTitle('Action') ?></span></th>
												</tr>
											</thead>
											<tbody id="row_append">

											</tbody>
										</table>

									</div>

								</div>
							</div>
						</div>
					</div>


					<div class="row">
						<div class="col-lg-12">
							<div class="ibox">
								<div class="ibox-content ">
									<div class="row">
										<div class="col-lg-2">
											<div class="row">
												<div class="col-md-4">
													<h4><span class="en">Total/Int</span><span class="ar"><?= getArabicTitle('Total/Int') ?></span></h4>
												</div>
												<div class="col-md-8">
													<div class="form-total_int">
														<input value="0" id="ftotal" name="ftotal" type="text" readonly class="form-control">
													</div>
												</div>
											</div>
										</div>
										<div class="col-lg-2">
											<div class="row">
												<div class="col-md-4">
													<h4><span class="en">Dis%</span><span class="ar"><?= getArabicTitle('Dis%') ?></span></h4>
												</div>
												<div class="col-md-8">
													<div class="form-group">
														<input value="0" id="disPer" name="disPer" type="text" class="form-control" onkeyup="calculateWholeDiscountAmount(this.value)">
													</div>
												</div>
											</div>
										</div>
										<div class="col-lg-2">
											<div class="row">
												<div class="col-md-4">
													<h4><span class="en">Dis Amt</span><span class="ar"><?= getArabicTitle('Dis Amt') ?></span></h4>
												</div>
												<div class="col-md-8">
													<div class="form-group">
														<input value="0" id="disAmt" name="disAmt" type="text" class="form-control" onkeyup="calculateWholeDiscountper(this.value)">
													</div>
												</div>
											</div>
										</div>
										<div class="col-lg-2">
											<div class="row">
												<div class="col-md-4">
													<h4><span class="en">Net Total</span><span class="ar"><?= getArabicTitle('Net Total') ?></span></h4>
												</div>
												<div class="col-md-8">
													<div class="form-group">
														<input value="0" id="fnetTotal" name="fnetTotal" readonly type="text" class="form-control tot_Sprice">
													</div>
												</div>
											</div>
										</div>
									</div>
									<hr>
									<div class="row">
										<div class="col-lg-4">
										</div>
										<div class="col-lg-4">
											<input type="submit" class="btn btn-block btn-lg btn-outline-success en" name="submit" value="Save">
											<input type="submit" class="btn btn-block btn-lg btn-outline-success ar" name="submit" value="<?= getArabicTitle('Save')?>">
										</div>
										<div class="col-lg-4">
											<div class="row">
												<div class="col-lg-8">
												</div>
												<div class="col-lg-4" style="text-align: right">

												</div>
											</div>

										</div>
									</div>
								</div>
							</div>
						</div>
					</div>

				</form>
			</div>
			<?php include("footer.php"); ?>
			<div id="SalesVoucherDiv"></div>
		</div>
	</div>
	</div>
	</div>
	</div>
</body>

</html>

<script src="vouchers/delivery_note/js.js"></script>

<script>
	$(document).ready(function() {
		$("#salesMan").select2({});
		$("#Bid").select2({});
	});
</script>