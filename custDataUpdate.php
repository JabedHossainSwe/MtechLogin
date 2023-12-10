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
			<table class="table table-bordered">
				<thead>
					<tr>
						<th><span class="en">Sr#</span><span class="ar"><?= getArabicTitle('Sr#') ?></span></th>
						<th><span class="en">BillNo</span><span class="ar"><?= getArabicTitle('BillNo') ?></span></th>
						<th><span class="en">Bid</span><span class="ar"><?= getArabicTitle('Bid') ?></span></th>
						<th><span class="en">TotalCost</span><span class="ar"><?= getArabicTitle('TotalCost') ?></span></th>
						<th><span class="en">TotalCostNew</span><span class="ar"><?= getArabicTitle('TotalCostNew') ?></span></th>
					</tr>
				</thead>
				<tbody>
					<?php
					include("sidebar.php");
					$counter = 1;
					/// Customer Query//
					$qqqq = "select * from " . dbObject . "DataOutReturn";
					$custQuery = Run($qqqq);
					while ($loadDataout = myfetch($custQuery)) {
						$Billno = $loadDataout->BillNo;
						$Bid = $loadDataout->Bid;
						$sbid = "2";
						$bQ = Run("Select * from " . dbObject . "Branch where Bid = '" . $Bid . "'");
						$getBData = myfetch($bQ);
						if ($getBData->ismain == '1') {
							$sbid = "1";
						}
						$sbBillno = $Billno . "-S" . $sbid . "-M" . $Bid;


						$updater = Run("update " . dbObject . "DataOutReturn set sbid = '" . $sbid . "',sbBillno='" . $sbBillno . "' where  BillNo = '" . $Billno . "' and Bid = '" . $Bid . "'");
						$updater = Run("update " . dbObject . "DataOutReturnDetail set sbid = '" . $sbid . "',sbBillno='" . $sbBillno . "' where  BillNo = '" . $Billno . "' and Bid = '" . $Bid . "'");


						$counter++;
					}
					?></tbody>
			</table>
		</div>
	</div>
	</div>


</body>

</html>

<script src="include/sales/js.js"></script>
<script>

</script>>>