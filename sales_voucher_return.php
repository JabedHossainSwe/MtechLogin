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
			max-height: fit-content;
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

			$QueryMax = Run("Select max(Billno) as Bno from " . dbObject . "DataOutReturn $condition");
			$getBillNo = myfetch($QueryMax)->Bno + 1;

			$bidValue =  GetMainBranch();
			if ($_SESSION['isAdmin'] == 0) {
				$bidValue = $userBranch->Bid;
			}

			?>

			<div class="row wrapper border-bottom white-bg page-heading pb-2">
				<div class="col-lg-12">
					<h2 class="font-weight-bold"><span class="en">Sales Return</span><span class="ar"><?= getArabicTitle('Sales Return') ?></span></h2>
				</div>
			</div>

			<div class="wrapper wrapper-content animated fadeInRight">
				<!-- <div class="row mb-1">
					<div class="col-md-6 col-8">
						<button type="button" class="btn btn-w-m btn-default eng">English</button>
						<button type="button" class="btn btn-w-m btn-default ara">Arabic</button>
					</div>
					<div class="col-md-6 col-4">

					</div>
				</div> -->

				<hr>
				<!-- <form> -->
				<div id="editVoucher">
					<form id="sales_voucher" method="post" class="ibox-content  filter_container">
						<div class="row">
							<div class="col-lg-12">
								<div class="ibox">
									<div class="row">
										<div class="col-lg-6">
											<div class="row">
												<div class="col-md-4">
													<h4><span class="en">Branch</span><span class="ar"><?= getArabicTitle('Branch') ?></span>
												</div>

												<div class="col-md-8">
													<div class="form-group">
														<div>
															<select class="select2_demo_1 form-control" name="Bid" id="Bid" onChange="loadSubBranch(this.value), loadBanksagainstBrank(this.value)">
																<?php

																if ($_SESSION['isAdmin'] == '1') {
																	$Bracnhes = Run("Select * from " . dbObject . "Branch order by BName ASC");
																} else {
																	$Bracnhes = Run("Select " . dbObject . "Branch.Bid," . dbObject . "Branch.BName from " . dbObject . "Branch Inner JOIN " . dbObject . "EMP  On " . dbObject . "EMP.BID = " . dbObject . "Branch.Bid where " . dbObject . "EMP.WebCode = '" . $_SESSION['code'] . "' ");
																}

																while ($getBranches = myfetch($Bracnhes)) {
																	$selected = "";
																	// if ($_GET['branc'] != '') {
																	if ($getBranches->ismain == '1') {
																		$selected = "Selected";
																	}
																	// }
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
												<div class="col-md-4">
													<h4><span class="en">Sub Branch</span><span class="ar"><?= getArabicTitle('Sub Branch ') ?></span></h4>
												</div>
												<div class="col-md-8">
													<div class="form-group" id="loadSubBranch">
														<select id="sBid" name="sBid" class="grpreq select2_demo_1 form-control" tabindex="4" required>
															<?php
	
															if ($_SESSION['isAdmin'] == '1') {
																$Bracnhes = Run("Select * from " . dbObject . "Branch where ismain = 1 order by BName ASC");
															} else {
																$Bracnhes = Run("Select " . dbObject . "Branch.Bid," . dbObject . "Branch.BName from " . dbObject . "Branch Inner JOIN " . dbObject . "EMP  On " . dbObject . "EMP.BID = " . dbObject . "Branch.Bid where " . dbObject . "EMP.WebCode = '" . $_SESSION['code'] . "' ");
															}
	
															$Branch = myfetch($Bracnhes)->Bid;
															$subBranches = Run("Select * from " . dbObject . "BranchSub where Bid = '$Branch'");
															$j = 1;
	
															while ($subBranch = myfetch($subBranches)) {
																$selected = "";
																if ($j == 1) {
																	$selected = "Selected";
																}
															?>
																<option value="<?php echo $subBranch->sbid; ?>" <?php echo $selected; ?>><?php echo $subBranch->sBName; ?></option>
															<?php
															$j++;
															} ?>
	
														</select>
													</div>
												</div>
											</div>
										</div>
									</div>
									
									<div class="row">
										<div class="col-lg-6">
											<div class="row">
												<div class="col-md-3">
													<h4><span class="en">Bill No</span><span class="ar"><?= getArabicTitle('Bill No') ?></span>
												</div>
												<div class="col-md-3">
													<div class="form-group">
														<input value="<?= $getBillNo ?>" id="bill_no" name="bill_no" type="text" class="form-control">
													</div>
												</div>
												<div class="col-md-6">
													<button type="button" class="btn btn-success" onclick="reloadVoucher()"><i class="fa fa-refresh"></i></button>
	
													<?php
													$qt = "select BillNo from dataoutreturn where BillNo = (select max(BillNo) from dataoutreturn where BillNo < '" . $getBillNo . "' and Bid='" . $bidValue . "' and isDeleted = 0) and Bid = '" . $bidValue . "' and isDeleted = 0";
													$previousQuery = Run($qt);
													$getPreviousId = myfetch($previousQuery)->BillNo;
													if ($getPreviousId != '') { ?>
														<button type="button" class="btn btn-success" onclick="editVoucher('<?= $bidValue ?>','<?= $getPreviousId ?>')"><i class="fa fa-backward"></i></i></button>
													<?php } ?>
													<button type="button" class="btn btn-success" onclick="" disabled><i class="fa fa-forward"></i></i></button>
													<button type="button" class="btn btn-success" onclick="" disabled><i class="fa fa-trash"></i></button>
													<button type="button" class="btn btn-success" onclick="" disabled><i class="fa fa-print"></i></button>
													<button type="button" class="btn btn-success" onclick="" disabled><i class="fa fa-plus"></i></button>
	
												</div>
											</div>
										</div>

										<div class="col-lg-6">
											<div class="row">
												<div class="col-md-4">
													<h4><span class="en">Bill Date/Time</span><span class="ar"><?= getArabicTitle('Bill Date/Time') ?></span>
												</div>
												<div class="col-md-8">
													<div class="form-group">
														<input value="<?= date("Y-m-d H:i:s") ?>" id="bill_date_time" name="bill_date_time" type="datetime-local" class="form-control">
													</div>
												</div>
											</div>
										</div>
									</div>

									<div class="row">
										<div class="col-lg-6">
											<div class="row">
												<div class="col-md-4">
													<h4><span class="en">Sale Bill</span><span class="ar"><?= getArabicTitle('Sale Bill') ?></span>
												</div>
												<div class="col-md-4 col-4">
													<div class="i-checks"><label class="">
															<div class="iradio_square-green ">
																<div class="iradio_square-green">
																	<input class="form-check-input sale_bill" type="radio" name="sale_bill" id="Yes" value="Yes">
																</div>
																<ins class="iCheck-helper"></ins>
															</div>
															<i></i> <span class="en">Yes</span><span class="ar"><?= getArabicTitle('Yes') ?></span>
														</label>
													</div>
												</div>
	
												<div class="col-md-4 col-4">
													<div class="i-checks"><label class="">
															<div class="iradio_square-green ">
																<div class="iradio_square-green">
																	<input class="form-check-input sale_bill" type="radio" name="sale_bill" id="No" value="No" checked>
																</div>
																<ins class="iCheck-helper"></ins>
															</div>
															<i></i> <span class="en">No</span><span class="ar"><?= getArabicTitle('No') ?></span>
														</label>
													</div>
												</div>
											</div>
										</div>

										<div class="col-6">
											<div class="row">
												<div class="col-md-4">
													<h4><span class="en">Sale Bill No</span><span class="ar"><?= getArabicTitle('Sale Bill No') ?></span>
												</div>
												<div class="col-md-6">
													<div class="form-group">
														<input type="number" class="form-control" name="sale_bill_no" id="sale_bill_no">
													</div>
												</div>
												<div class="col-md-2">
													<button type="button" class="btn btn-success" onclick="validateSaleNo(this)"><i class="fa fa-refresh" aria-hidden="true"></i></button>

												</div>
											</div>
										</div>
									</div>

									<div class="row">
										<div class="col-lg-6">
											<div class="row">
												<div class="col-md-6 col-6">
													<div class="i-checks"><label class="">
															<div class="iradio_square-green ">
																<div class="iradio_square-green">
																	<input type="radio" value="1" class="SPType" checked name="SPType">
																</div>
																<ins class="iCheck-helper"></ins>
															</div>
															<i></i> <span class="en">Cash</span><span class="ar"><?= getArabicTitle('Cash') ?></span>
														</label>
													</div>
												</div>


												<div class="col-md-6 col-6">
													<div class="i-checks"><label class="">
															<div class="iradio_square-green ">
																<div class="iradio_square-green">
																	<input type="radio" value="2" <?php if ($_GET['SPType'] == '1') {
																										echo "Checked";
																									} ?> name="SPType" class="SPType">
																</div>
																<ins class="iCheck-helper"></ins>
															</div>
															<i></i> <span class="en">Credit</span><span class="ar"><?= getArabicTitle('Credit') ?></span>
														</label>
													</div>
												</div>


											</div>
										</div>

										<div class="col-6">
											<div class="row">
												<div class="col-md-4">
													<h4><span class="en">Sales Man</span><span class="ar"><?= getArabicTitle('Sales Man') ?></span>
												</div>
												<div class="col-md-8">
													<select class="select2_demo_1 form-select" id="salesMan" name="EmpID" aria-label="sales-men">
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

									<div class="row">
										<div class="col-lg-6">
											<div class="row">
												<div class="col-md-4">
													<h4><span class="en">Reference No</span><span class="ar"><?= getArabicTitle('Reference No') ?></span>
												</div>
												<div class="col-md-8">
													<div class="form-group">
														<input value="" id="RefNo1" name="RefNo1" type="text" readonly class="form-control">
													</div>
												</div>
											</div>
										</div>

										<div class="col-lg-6">
											<div class="row">
												<div class="col-md-4">
													<h4><span class="en">Customer</span><span class="ar"><?= getArabicTitle('Customer') ?></span>
												</div>
												<div class="col-md-8">
													<div class="form-group">
														<select name="customer_id" id="customer_id" name="customer_id">

														</select>
													</div>
												</div>
											</div>
										</div>
									</div>

									<div class="row" id="bill_no_area">
									</div>
								</div>
							</div>
						</div>

						<?php
						$getCurrentEmpData = getCurrentEmpData($_SESSION['storeCode']);
						$bid = $getCurrentEmpData->BID;
						?>


						<input type="hidden" name="row_count" id="row_count" value="0">
						<input type="hidden" value="0" name="openStock" id="openStock" class="form-control">
						<!-- <input type="hidden" name="unit" id="unit" readonly class="form-control"> -->


						<p id="fetchProductDetails"></p>

						<div id="CheckSaleBill">
						</div>

						<div id="saveSalesForm"></div>

						<div id="product_add_addRow">
						</div>

						<div id="screen_sec">
							<div class="row items_sec">
								<div class="col-lg-12">
									<div class="ibox">
										<div class="ibox-content  filter_container">
											<div class="row" id="add_sec" style="display:block; overflow-x:scroll;">
												<div style="width: 120rem;">
													<table class="table table-bordered">
														<thead>
															<tr>
																<th><span class="en">Code</span><span class="ar"><?= getArabicTitle('Code') ?></span></th>
																<th><span class="en">Name</span><span class="ar"><?= getArabicTitle('Name') ?></span></th>
																<th><span class="en">Unit</span><span class="ar"><?= getArabicTitle('Unit') ?></span></th>
																<th><span class="en">Qty</span><span class="ar"><?= getArabicTitle('Qty') ?></span></th>
																<th><span class="en">Price</span><span class="ar"><?= getArabicTitle('Price') ?></span></th>
																<th><span class="en">Total</span><span class="ar"><?= getArabicTitle('Total') ?></span></th>
																<th><span class="en">Dis Amt</span><span class="ar"><?= getArabicTitle('Dis Amt') ?></span></th>
																<th><span class="en">Dis Per</span><span class="ar"><?= getArabicTitle('Dis Per') ?></span></th>
																<th><span class="en">Net Total</span><span class="ar"><?= getArabicTitle('Net Total') ?></span></th>
																<th><span class="en">Vat Amt</span><span class="ar"><?= getArabicTitle('Vat Amt') ?></span></th>
																<th><span class="en">Vat %</span><span class="ar"><?= getArabicTitle('Vat %') ?></span></th>
																<th><span class="en">Vat Total</span><span class="ar"><?= getArabicTitle('Vat Total') ?></span></th>
																<th><span class="en">Vat + Total</span><span class="ar"><?= getArabicTitle('Vat + Total') ?></span></th>
																<th><span class="en">Action</span><span class="ar"><?= getArabicTitle('Action') ?></span></th>
															</tr>
														</thead>
														<tbody>
															<tr>
																<td style="width:5%">
																	<input type="text" class="form-control" onkeyup="fetchProductDetailsFromCode(this.value, '')" id="Pcode" name="Pcode">
																</td>
																<td style="width:10%" id="getProductList">
																	<select id="product" name="product" class="select2_demo_1 form-control" tabindex="4" onChange="setmyValue(this.value,'Pcode');fetchProductUnits(this.value)">
																	</select>
																</td>
																<td style="width:5%" id="loadUnits">
																	<select class="form-select" name="unit_id" id="unit_id" aria-label="unit_id" onchange="LoadUnitPrice(this.value,'120')">
																		<option value="">Please Select Unit</option>
																	</select>
																</td>

																<td style="width: 5%">
																	<input type="text" name="qty" id="qty" class="form-control" value="0" onkeyup="calculateSingleVatTotal(this.value);">
																</td>
																<td style="width: 5%">
																	<input type="text" name="Sprice" id="Sprice" class="form-control" value="0" onkeyup="calculateSingleVatTotal(this.value, 'vatSprice')">
																	<input type="hidden" name="isVat" id="isVat" value="1" class="form-control" readonly>
																</td>

																<td style="width: 5%">
																	<input type="text" id="total" class="form-control" value="0" readonly>
																</td>

																<td style="width: 5%">
																	<input type="text" id="disAmt" class="form-control" value="0" onkeyup="calculateDisPer();">
																</td>

																<td style="width: 5%">
																	<input type="text" id="disPer" class="form-control" value="0" onkeyup="calculateDisAmt();">
																</td>

																<td style="width: 5%">
																	<input type="text" id="net_total" class="form-control" value="0" readonly>
																</td>

																<td style="width: 5%">
																	<input type="text" name="vatAmt" id="vatAmt" readonly class="form-control" value="0">
																</td>

																<td style="width: 5%">
																	<input type="text" readonly name="vatPer" id="vatPer" class="form-control" value="0">
																</td>

																<td style="width: 5%">
																	<input type="text" id="vattotal" class="form-control" value="0" readonly>
																</td>

																<td style="width: 5%">
																	<input type="text" readonly name="vatSprice" id="vatSprice" class="form-control" value="0">
																</td>

																<td id="action_id" style="width: 5%">
																	<button type="button" name="add_row" id="add_row" class="btn btn-info en" onclick="addRow()">Add</button>
																	<button type="button" name="add_row" id="add_row" class="btn btn-info ar" onclick="addRow()"><?= getArabicTitle('Add') ?></button>
																</td>
															</tr>

														</tbody>
													</table>
												</div>

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
															<th><span class="en">Dis Amt</span><span class="ar"><?= getArabicTitle('Dis Amt') ?></span></th>
															<th><span class="en">Dis Per</span><span class="ar"><?= getArabicTitle('Dis Per') ?></span></th>
															<th><span class="en">Net Total</span><span class="ar"><?= getArabicTitle('Net Total') ?></span></th>
															<th><span class="en">Vat %</span><span class="ar"><?= getArabicTitle('Vat %') ?></span></th>
															<th><span class="en">Vat Amt</span><span class="ar"><?= getArabicTitle('Vat Amt') ?></span></th>
															<th><span class="en">Vat Total</span><span class="ar"><?= getArabicTitle('Vat Total') ?></span></th>
															<th><span class="en">Vat + Total</span><span class="ar"><?= getArabicTitle('Vat + Total') ?></span></th>
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


							<div class="row total_sec">
								<div class="col-lg-12">
									<div class="ibox">
										<div class="ibox-content  pl-0 pr-0">
											<div class="row">
												<div class="col-lg-2">
													<div class="row">
														<div class="col-md-4">
															<h4><span class="en">Total/Int</span><span class="ar"><?= getArabicTitle('Total/Int') ?></span>
														</div>
														<div class="col-md-8">
															<div class="form-total_int">
																<input value="0" id="f_total" name="f_total" type="text" readonly class="form-control">
															</div>
														</div>
													</div>
												</div>
												<div class="col-lg-2">
													<div class="row">
														<div class="col-md-4">
															<h4><span class="en">Dis%</span><span class="ar"><?= getArabicTitle('Dis%') ?></span>
														</div>
														<div class="col-md-8">
															<div class="form-group">
																<input value="0" id="fdisPer" name="fdisPer" type="text" class="form-control" onkeyup="calculateWholeDiscountAmount(this.value)">
															</div>
														</div>
													</div>
												</div>
												<div class="col-lg-2">
													<div class="row">
														<div class="col-md-4">
															<h4><span class="en">Dis Amt</span><span class="ar"><?= getArabicTitle('Dis Amt') ?></span>
														</div>
														<div class="col-md-8">
															<div class="form-group">
																<input value="0" id="fdisAmt" name="fdisAmt" type="text" class="form-control" onkeyup="calculateWholeDiscountper(this.value)">
															</div>
														</div>
													</div>
												</div>
												<div class="col-lg-2">
													<div class="row">
														<div class="col-md-4">
															<h4><span class="en">Net Total</span><span class="ar"><?= getArabicTitle('Net Total') ?></span>
														</div>
														<div class="col-md-8">
															<div class="form-group">
																<input value="0" id="netTotal" name="netTotal" readonly type="text" class="form-control tot_Sprice">
															</div>
														</div>
													</div>
												</div>
												<div class="col-lg-2">
													<div class="row">
														<div class="col-md-4">
															<h4><span class="en">Total Vat</span><span class="ar"><?= getArabicTitle('Total Vat') ?></span>
														</div>
														<div class="col-md-8">
															<div class="form-group">
																<input value="0" id="totVat" name="totVat" readonly type="text" class="form-control">
															</div>
														</div>
													</div>
												</div>
												<div class="col-lg-2">
													<div class="row">
														<div class="col-md-5">
															<h4><span class="en">Grand Total</span><span class="ar"><?= getArabicTitle('Grand Total') ?></span>
															</h4>
														</div>
														<div class="col-md-7">
															<div class="form-group">
																<input value="0" id="grandTotal" name="grandTotal" readonly type="text" class="form-control">
															</div>
														</div>
													</div>
												</div>
											</div>

											<hr />
											<?php
											$code = $bid;
											$nrow = 1;
											?>
											<div id="loadBanksagainstBrank">
												<label for="" class="form-label add_icon"><span class="en">Banks</span><span class="ar"><?= getArabicTitle('Banks') ?></span></label>

												<table class="tabel table-bordered table-striped" style="width: 100%; margin-top: 10px;">
													<thead>
														<tr>
															<th align="center">#</th>
															<th align="center"><span class="en">Banks</span><span class="ar"><?= getArabicTitle('Banks') ?></span></th>
															<th align="center"><span class="en">Amount</span><span class="ar"><?= getArabicTitle('Amount') ?></span></th>
														</tr>
													</thead>
													<tbody>

														<?php
														$nrow = 1;
														$Bracnhes = Run("exec " . dbObject . "GetPaymentType @bid='$code'");
														while ($getBranches = myfetch($Bracnhes)) {
														?>
															<tr>
																<td align="center"><input type="hidden" id="Bank<?= $nrow ?>" name="Bank<?= $nrow ?>" class="form-control" value="<?php echo $getBranches->id; ?>" readonly> <input type="hidden" id="BankName<?= $nrow ?>" name="BankName<?= $nrow ?>" class="form-control" value="<?php echo $getBranches->snameEng; ?>" readonly>
																	<?= $nrow ?></td>
																<td align="center">

																	<?php echo $getBranches->snameEng; ?>

																</td>
																<td>
																	<input type="text" id="sal_amount<?= $nrow ?>" name="sal_amount<?= $nrow ?>" class="form-control <?php if ($nrow != 1) {
																																											echo 'salAmnt';
																																										} ?>" value="0" onKeyUp="CalculateRemainings()" <?php if ($nrow == 1) {
																																																							echo 'readonly';
																																																						} ?>>
																</td>
															</tr>

														<?php
															$nrow++;
														}

														?>
													</tbody>
												</table>
												<input type="hidden" id="bankrows" name="bankrows" value="<?= $nrow ?>">
											</div>
											<hr>
											<div class="row">
												<div class="col-lg-4">
												</div>
												<div class="col-lg-4">
													<input type="button" class="btn btn-block btn-lg btn-outline-success en" name="submit" value="Finish & Save" onclick="customerValidation(this);">
													<input type="button" class="btn btn-block btn-lg btn-outline-success ar" name="submit" value="<?= getArabicTitle('Finish & Save') ?>" onclick="customerValidation(this);">
													
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
						</div>

					</form>
				</div>
			</div>

			<div id="SalesVoucherDiv"></div>
			<?php
			include("footer.php");
			?>
		</div>
	</div>
	</div>
	</div>


</body>

</html>

<script src="vouchers/salesreturn/js.js"></script>
<script>
	$(document).ready(function() {

		$(".filter_act").click();
		$(".no_envent").toggleClass("displayB");
		// validateSaleNo();
	});
</script>