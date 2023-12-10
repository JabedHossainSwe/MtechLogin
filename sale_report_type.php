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

			?>

			<div class="wrapper wrapper-content animated fadeInRight">
				<div class="row wrapper border-bottom white-bg page-heading pb-2">
					<div class="col-lg-12">
						<h2 class="font-weight-bold en float-left">Sales Report Types</h2>
						<h2 class="font-weight-bold ar float-right"><?= getArabicTitle('Sales Report Types') ?></h2>
					</div>
				</div>
				<div class="wrapper wrapper-content animated fadeInRight">
					<div class="row mb-1">



						<div class="col-lg-4">
							<a href="sale_report_general.php">
								<div class="widget style1 navy-bg">
									<div class="row">
										<div class="col-4">
											<i class="fa fa-cloud fa-5x"></i>
										</div>
										<div class="col-8 text-right">
											<h2 class="font-bold"><span class="en">General</span><span class="ar"><?= getArabicTitle('General') ?></span></h2>
										</div>
									</div>
								</div>
							</a>
						</div>



						<div class="col-lg-4">
							<a href="sale_report_detail.php">

								<div class="widget style1 lazur-bg">
									<div class="row">
										<div class="col-4">
											<i class="fa fa-user-o fa-5x"></i>
										</div>
										<div class="col-8 text-right">
											<h2 class="font-bold"><span class="en">Detail</span><span class="ar"><?= getArabicTitle('Detail') ?></span></h2>
										</div>
									</div>
								</div>
							</a>
						</div>
						<div class="col-lg-4">
							<a href="sale_report_group.php">

								<div class="widget style1 yellow-bg">
									<div class="row">
										<div class="col-4">
											<i class="fa fa-shield  sic fa-5x"></i>
										</div>
										<div class="col-8 text-right">
											<h2 class="font-bold"><span class="en">Group</span><span class="ar"><?= getArabicTitle('Group') ?></span></h2>
										</div>
									</div>
								</div>
							</a>
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

<script src="assets/js/plugins/morris/raphael-2.1.0.min.js"></script>
<script src="assets/js/plugins/morris/morris.js"></script>
<script>
	$(document).ready(function() {
		Morris.Bar({
			element: 'morris-bar-chart',
			data: [{
					y: '2006',
					a: 60,
					b: 50
				},
				{
					y: '2007',
					a: 75,
					b: 65
				},
				{
					y: '2008',
					a: 50,
					b: 40
				},
				{
					y: '2009',
					a: 75,
					b: 65
				},
				{
					y: '2010',
					a: 50,
					b: 40
				},
				{
					y: '2011',
					a: 75,
					b: 65
				},
				{
					y: '2012',
					a: 100,
					b: 90
				}
			],
			xkey: 'y',
			ykeys: ['a', 'b'],
			labels: ['Series A', 'Series B'],
			hideHover: 'auto',
			resize: true,
			barColors: ['#1ab394', '#cacaca'],
		});
	});
	$("#branchs").select2({
		width: '100%',
	});
</script>