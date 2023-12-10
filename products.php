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
					<h2 class="font-weight-bold en float-left">List Products</h2>
					<h2 class="font-weight-bold ar float-right"><?= getArabicTitle('List Products') ?></h2>
					<div id="deleteEntry"></div>
				</div>
			</div>
			<div class="wrapper wrapper-content animated fadeInRight">
				<div class="row mb-3">
					<div class="col-md-12  d-flex justify-content-end">
						<a href="add_product.php" class="btn btn-outline-primary btn-actions float-right submit-next mr-2"><span class="en">Add New <i class="fa fa-plus icon-font"></i></span><span class="ar"><i class="fa fa-plus icon-font"></i> <?= getArabicTitle('Add New') ?></a>
						<a href="product_group.php" class="btn btn-outline-primary btn-actions float-right submit-next mr-2"><span class="en">Group</span><span class="ar"><?= getArabicTitle('Group') ?></a>
						<a href="product_type.php" class="btn btn-outline-primary btn-actions float-right submit-next mr-2"><span class="en">Type</span><span class="ar"><?= getArabicTitle('Type') ?></a>
						<a href="product_unit.php" class="btn btn-outline-primary btn-actions float-right submit-next mr-2"><span class="en">Unit</span><span class="ar"><?= getArabicTitle('Unit') ?></a>
					</div>

				</div>
				<div class="row">
					<div class="col-lg-12">
						<div class="ibox">
							<div class="ibox-title">


								<div class="ibox-tools no_envent" style="display: none">
									<a class="collapse-link filter_act">
										<i class="fa fa-chevron-down"></i>
									</a>
								</div>
							</div>
							<form action="products.php" method="get" class="ibox-content filter_container">

								<div class="row">
									<div class="col-sm-12">
										<div class="row">
											<div class="col-sm-4">
												<div class="mb-3">
													<label for="" class="form-label"><span class="en">Code</span><span class="ar"><?= getArabicTitle('Code') ?></label>
													<input type="text" class="form-control" name="CCode" id="CCode" value="<?php echo $_GET['CCode']; ?>">
												</div>
											</div>
											<div class="col-sm-4">
												<div class="mb-3">
													<label for="" class="form-label"><span class="en">Name</span><span class="ar"><?= getArabicTitle('Name') ?></label>
													<input type="text" class="form-control" name="CName" id="CName" value="<?php echo $_GET['CName']; ?>">
												</div>
											</div>
											<div class="col-sm-4">
												<div class="mb-3 mt-4">
													<a class="btn btn-danger btn-actions float-end submit-next" onClick="loadPage('products.php')"><span class="en">Clear</span><span class="ar"><?= getArabicTitle('Clear') ?></a>
													<button type="submit" class="btn btn-success btn-actions float-end submit-next" style="margin-right: 20px;" name="submit"><span class="en">Submit <i class="fa fa-arrow-right icon-font"></i></span><span class="ar"><i class="fa fa-arrow-right icon-font"></i> <?= getArabicTitle('Submit') ?></button>
												</div>
											</div>
										</div>


										<?php
										$condition = 'Where PID <> 0 And IsDeleted=0';
										include('custom_newpagination/paginator.class.php');


										//s$SrchBy = !empty($_GET['SrchBy']) ? $_GET['SrchBy']: 0;
										$CCode = !empty($_GET['CCode']) ? $_GET['CCode'] : 0;
										if ($CCode != 0) {
											$condition .= " And PCode='" . $CCode."'";
										}

										$CName = !empty($_GET['CName']) ? $_GET['CName'] : '';
										if ($CName != '') {
											$condition .= " And PName LIKE '%" . $CName . "%'";
										}


										$pages = new Paginator;

										$rf = Run("Select count(PCode) as totalrec from Product   $condition");
										$tolrec = myfetch($rf)->totalrec;

										$pages->default_ipp = 20;
										$pages->items_total = $tolrec;
										$pages->mid_range = 9;
										$pages->paginate();

										//$initialLimit = ",".$pages->limit;
										$OrderBy = "Order by PCode DESC";

										$qpt = "Select * from Product $condition  $OrderBy " . $pages->limit . "";
										$result = Run($qpt);
										?>
										<div class="mb-3">
											<!-- Listing -->
											<table class="table table-striped table-bordered dt-responsive table-hover ">

												<?php
												if ($pages->items_total > 0) {
												?>
													<thead>
														<tr>
															<th><span class="en">Pid</span><span class="ar"><?= getArabicTitle('Pid') ?></span></th>
															<th><span class="en">Pcode</span><span class="ar"><?= getArabicTitle('Pcode') ?></span></th>
															<th><span class="en">Name</span><span class="ar"><?= getArabicTitle('Name') ?></span></th>
															<th><span class="en">Description</span><span class="ar"><?= getArabicTitle('Description') ?></span></th>
															<th><span class="en">Group</span><span class="ar"><?= getArabicTitle('Group') ?></span></th>
															<th><span class="en">Actions</span><span class="ar"><?= getArabicTitle('Actions') ?></span></th>
														</tr>
													</thead>
													<tbody>
														<?php
														while ($single = myfetch($result)) {

															if (!empty($single->PID)) {
																$qp = Run("Select * from " . dbObject . "ProductGroup where Gid = '" . $single->PGID . "'");
																$groupName = myfetch($qp)->NameEng;
															}
														?>
															<tr>
																<td>
																	<?= $single->PID ?>
																</td>
																<td>
																	<?= $single->PCode ?>
																</td>
																<td>
																	<?= $single->PName ?>
																</td>
																<td>
																	<?= $single->Description ?>
																</td>
																<td>
																	<?= $groupName ?>
																</td>
																<td style="float: left">
																	<a href="update_product.php?PID=<?= $single->PID ?>&BID=<?= $single->bidN ?>" style="width: fit-content;float: left; margin-right: 5px">
																		<span class=""><i class="fa fa-pencil fa-2x" aria-hidden="true"></i></span>
																	</a>
																	<a href="javascript:" onclick="deleteEntry('<?= $single->PID ?>')" style="width: fit-content; float: left">
																		<span class=""><i class="fa fa-trash fa-2x" aria-hidden="true"></i></span>
																	</a>
																</td>
															</tr>
														<?php
															$cnt++;
														}
													} else {
														?>
														<tr>
															<td colspan="4" class="text-center">
																<h2><strong><span class="en">No Record(s) Found..</span><span class="ar"><?= getArabicTitle('No Record(s) Found..') ?></strong></h2>
															</td>
														</tr>
													<?php

													}

													?>


													</tbody>

											</table>

											<!-- /Listing -->

											<div class="clearfix"></div>


											<!-- bottom pagination -->

											<div class="row marginTop">

												<div class="col-sm-12 paddingLeft pagerfwt">

													<?php if ($pages->items_total > 0) { ?>

														<?php echo $pages->display_pages(); ?>

														<?php echo $pages->display_items_per_page(); ?>

														<?php echo $pages->display_jump_menu(); ?>

													<?php } ?>

												</div>

												<div class="clearfix"></div>

											</div>

											<!-- /bottom pagination -->
										</div>

									</div>
									<div class="m-5"></div>

								</div>
							</form>
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

<script src="include/products/js.js"></script>


</html>