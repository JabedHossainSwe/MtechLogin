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
					<h2 class="font-weight-bold"><span class="float-left en">Daily Report</span><span class="float-right ar"><?= getArabicTitle('Daily Report') ?></span></h2>
				</div>
			</div>
			<div class="wrapper wrapper-content animated fadeInRight">
				<div class="row mb-3">
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
							<form action="" id="sales_report_form" method="get" class="ibox-content filter_container">
								<input type="text" id="report_type" name="report_type" value="general" hidden>
								<input type="number" id="selected_lang" name="selected_lang"
									value="<?php !empty($_GET['selected_lang']) ? $_GET['selected_lang'] : '1' ?>" hidden>
								<div class="row">
									<div class="col-6">
										<div class="row">
											<div class="col-md-4">
												<h4><span class="en">Branch Selection</span><span class="ar"><?= getArabicTitle('Branch Selection') ?></span></h4>
											</div>

											<div class="col-md-8">
												<div class="form-group">
													<div>
														<select class="select2_demo_1 form-control" name="Bid" id="Bid">
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
																if ($_GET['Bid'] == '') {
																	if ($getBranches->ismain == '1') {
																		$selected = "Selected";
																	}
																}
																if ($_GET['Bid'] != '') {
																	if ($getBranches->Bid == $_GET['Bid']) {
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
									</div>
									<?php
									$dd = date("Y-m-d");
									if ($_GET['vdate'] != '') {
										$dd = $_GET['vdate'];
									}
									?>

									<div class="col-md-6">
										<div class="row">
											<div class="col-md-4">
												<h4><span class="en">Date</span><span class="ar"><?= getArabicTitle('Date') ?></span></h4>
											</div>
											<div class="col-md-8">
												<div class="form-group">
													<div class="input-group date">
														<span class="input-group-addon">
															<i class="fa fa-calendar"></i></span>
														<input id="vdate" name="vdate" type="date" class="form-control" value="<?php echo $dd; ?>"
															max="<?= date("Y-m-d") ?>" autocomplete="off">
													</div>
												</div>
											</div>
										</div>
									</div>










									<div class="col-12 row justify-content-center mt-5">
										<div class="col-md-2">
											<button type="button" class="btn btn-block btn-lg btn-outline-danger"
												onClick="location.reload()"><span class="en">Exit</span><span class="ar"><?= getArabicTitle('Exit') ?></span>
											</button>
										</div>
										<div class="col-md-2">
											<button type="submit" class="btn btn-block btn-lg btn-outline-success" id="seles_report_search"
												value="Search"><span class="en">Search</span><span class="ar"><?= getArabicTitle('Search') ?></span>
											</button>
										</div>
									</div>
								</div>
							</form>
						</div>
					</div>
				</div>

				<div class="ibox">
					<div class="ibox-content this_ar">

						<div class="table-responsive">


							<div class="row">
								<div class="col-lg-12" id="sales_report">

									<?php
									if ($_SESSION['isAdmin'] == '1') {
										$getBii = Run("Select " . dbObject . "Branch.Bid," . dbObject . "Branch.BName from " . dbObject . "Branch where ismain='1'");
										$bid = myfetch($getBii)->Bid;
									} else {
										$Bracnhes = Run("Select " . dbObject . "Branch.Bid," . dbObject . "Branch.BName from " . dbObject . "Branch
Inner JOIN " . dbObject . "EMP  On " . dbObject . "EMP.BID = " . dbObject . "Branch.Bid
where " . dbObject . "EMP.WebCode = '" . $_SESSION['code'] . "' ");
										$getB = myfetch($Bracnhes);
										$bid = $getB->Bid;

									}


									$Bid = $_GET['Bid'];
									if ($Bid != '') {
										$bid = $Bid;
									}



									//s$SrchBy = !empty($_GET['SrchBy']) ? $_GET['SrchBy']: 0;
									$vdate = !empty($_GET['vdate']) ? $_GET['vdate'] : date("Y-m-d");
									$vdate = date("Y-m-d", strtotime($vdate));



									$qq = "Select sum(nettotal) as TotalSales from DataOut where Bid = '" . $bid . "' and  cast(BillDate as Date) = '" . $vdate . "' and SPType<>0";

									$salesSp = Run($qq);
									$TotalSales = myfetch($salesSp)->TotalSales;
									$TotalSales = !empty($TotalSales) ? $TotalSales : '0';

									$salescashQ = Run("Select sum(nettotal) as salescash from DataOut where Bid = '" . $bid . "' and  cast(BillDate as Date) = '" . $vdate . "' and SPType='1';");
									$salescash = myfetch($salescashQ)->salescash;
									$salescash = !empty($salescash) ? $salescash : '0';

									$salescreditQ = Run("Select sum(nettotal) as salescredit  from DataOut where Bid = '" . $bid . "' and  cast(BillDate as Date) = '" . $vdate . "' and SPType='2'");
									$salescredit = myfetch($salescreditQ)->salescredit;
									$salescredit = !empty($salescredit) ? $salescredit : '0';






									$salesRSp = Run("Select sum(nettotal) as TotalSalesReturn  from DataOutReturn where Bid = '" . $bid . "' and  cast(BillDate as Date) = '" . $vdate . "' and SPType<>0");
									$TotalSalesReturn = myfetch($salesRSp)->TotalSalesReturn;
									$TotalSalesReturn = !empty($TotalSalesReturn) ? $TotalSalesReturn : '0';

									$salescashQ = Run("Select sum(nettotal) as salesreturncash from DataOutReturn where Bid = '" . $bid . "' and  cast(BillDate as Date) = '" . $vdate . "' and SPType='1';");
									$salesreturncash = myfetch($salescashQ)->salesreturncash;
									$salesreturncash = !empty($salesreturncash) ? $salesreturncash : '0';
									$salescreditQ = Run("Select sum(nettotal) as salesreturncredit  from DataOutReturn where Bid = '" . $bid . "' and  cast(BillDate as Date) = '" . $vdate . "' and SPType='2'");
									$salesreturncredit = myfetch($salescreditQ)->salesreturncredit;
									$salesreturncredit = !empty($salesreturncredit) ? $salesreturncredit : '0';

									$Netsales = $TotalSales - $TotalSalesReturn;
									$Netsales = !empty($Netsales) ? $Netsales : '0';


									/////////// Cash REceipt Entry////
									
									$casRecQ = Run("select sum(Receipt.nettotal) as casRec,bank.snameEng,Receipt.bnkid from Receipt
inner join bank on bank.id = Receipt.bnkid where Receipt.Bid = '" . $bid . "' and bank.IsCash=1
and  cast(Receipt.BillDate as Date) = '" . $vdate . "'  group by Receipt.bnkid,Bank.snameEng");
									$casRec = myfetch($casRecQ)->casRec;
									$casRec = !empty($casRec) ? $casRec : '0';

									$cashEntry = ($casRec + $TotalSales) - $TotalSalesReturn;
									$cashEntry = !empty($cashEntry) ? $cashEntry : '0';


									?>

									<div class="row">
										<div class="col-lg-12">
											<div class="widget style1 navy-bg">
												<div class="row">

													<div class="col-12 text-center">
														<span><span class="en">Sales</span><span class="ar"><?= getArabicTitle('Sales') ?></span></span>
														<h2 class="font-bold">(
															<?= AmountValue($TotalSales) ?>)
														</h2>
													</div>
												</div>
											</div>
										</div>
										<div class="col-lg-6">
											<div class="widget style1 navy-bg">
												<div class="row">

													<div class="col-12 text-center">
														<span> <span class="en">Cash</span><span class="ar"><?= getArabicTitle('Cash') ?></span></span>
														<h2 class="font-bold">(
															<?= AmountValue($salescash) ?>)
														</h2>
													</div>
												</div>
											</div>
										</div>
										<div class="col-lg-6">
											<div class="widget style1 navy-bg">
												<div class="row">

													<div class="col-12 text-center">
														<span> <span class="en">Credit</span><span class="ar"><?= getArabicTitle('Credit') ?></span></span>
														<h2 class="font-bold">(
															<?= AmountValue($salescredit) ?>)
														</h2>
													</div>
												</div>
											</div>
										</div>



										<div class="col-lg-12">
											<div class="widget style1 lazur-bg">
												<div class="row">

													<div class="col-12 text-center">
														<span><span class="en">Sales Return</span><span class="ar"><?= getArabicTitle('Sales Return') ?></span></span>
														<h2 class="font-bold">(
															<?= AmountValue($TotalSalesReturn) ?>)
														</h2>
													</div>
												</div>
											</div>
										</div>

										<div class="col-lg-6">
											<div class="widget style1 lazur-bg">
												<div class="row">

													<div class="col-12 text-center">
														<span><span class="en">Cash</span><span class="ar"><?= getArabicTitle('Cash') ?></span></span>
														<h2 class="font-bold">(
															<?= AmountValue($salesreturncash) ?>)
														</h2>
													</div>
												</div>
											</div>
										</div>
										<div class="col-lg-6">
											<div class="widget style1 lazur-bg">
												<div class="row">

													<div class="col-12 text-center">
														<span><span class="en">Credit</span><span class="ar"><?= getArabicTitle('Credit') ?></span></span>
														<h2 class="font-bold">(
															<?= AmountValue($salesreturncredit) ?>)
														</h2>
													</div>
												</div>
											</div>
										</div>

										<div class="col-lg-12">
											<div class="widget style1 yellow-bg">
												<div class="row">

													<div class="col-12 text-center">
														<span><span class="en">Net Sales</span><span class="ar"><?= getArabicTitle('Net Sales') ?></span></span>
														<h2 class="font-bold">(
															<?= AmountValue($Netsales) ?>)
														</h2>
													</div>
												</div>
											</div>
										</div>

										<div class="col-lg-12">
											<div class="widget style1 red-bg">
												<div class="row">

													<div class="col-12 text-center">
														<span><span class="en">Cash</span><span class="ar"><?= getArabicTitle('Cash') ?></span></span>
														<h2 class="font-bold">(
															<?= AmountValue($salescash + $casRec) ?>)
														</h2>
													</div>
												</div>
											</div>
										</div>

										<div class="col-lg-12">
											<div class="widget style1 blue-bg">
												<div class="row">

													<div class="col-12 text-center">
														<span><span class="en">Cash Receipt</span><span class="ar"><?= getArabicTitle('Cash Receipt') ?></span></span>
														<h2 class="font-bold">(
															<?= AmountValue($casRec) ?>)
														</h2>
													</div>
												</div>
											</div>
										</div>





										<?php
										$ReceBnakQ = Run("select sum(Receipt.nettotal) as credit,bank.snameEng,Receipt.bnkid from Receipt
inner join bank on bank.id = Receipt.bnkid where Receipt.Bid = '" . $bid . "' and bank.IsCash=0
and  cast(Receipt.BillDate as Date) = '" . $vdate . "' group by Receipt.bnkid,Bank.snameEng");
										while ($getV = myfetch($ReceBnakQ)) {
											?>
											<div class="col-lg-12">
												<div class="widget style1 navy-bg">
													<div class="row">

														<div class="col-12 text-center">
															<span>
																<?= $getV->snameEng ?>
															</span>
															<h2 class="font-bold">(
																<?= AmountValue($getV)->credit ?>)
															</h2>
														</div>
													</div>
												</div>
											</div>

											<?php
										}

										?>


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




</body>

</html>

<script src="include/reports/sales/js.js"></script>