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
					<h2 class="font-weight-bold"><span class="float-left en">Suppliers</span><span class="float-right ar"><?= getArabicTitle('Suppliers') ?></span></h2>
					<div id="deleteEntry"></div>
				</div>
			</div>
			<div class="wrapper wrapper-content animated fadeInRight">
				<div class="row mb-3">
					<div class="col-md-12 col-12">

						<a href="add_supplier.php" class="btn btn-outline-primary btn-actions float-right submit-next ml-2"> <span class="en">Add New <i class="fa fa-plus icon-font"></i></span><span class="ar"><i class="fa fa-plus icon-font"></i> <?= getArabicTitle('Add New') ?></span></a>

						<a href="sup_group.php" class="btn btn-outline-primary btn-actions float-right submit-next ml-2"><span class="en">Group</span><span class="ar"><?= getArabicTitle('Group') ?></span> </a>

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
							<form action="suppliers.php" method="get" class="ibox-content  filter_container">

								<div class="row">
									<div class="col-sm-12">
										<div class="row d-flex align-items-end">
											<div class="col-sm-4">
												<div class="mb-3">
													<label for="" class="form-label"><span class="en">Code</span><span class="ar"><?= getArabicTitle('Code') ?></span></label>
													<input type="text" class="form-control" name="CCode" id="CCode" value="<?php echo $_GET['CCode']; ?>">
												</div>
											</div>
											<div class="col-sm-4">
												<div class="mb-3">
													<label for="" class="form-label"><span class="en">Name</span><span class="ar"><?= getArabicTitle('Name') ?></span></label>
													<input type="text" class="form-control" name="CName" id="CName" value="<?php echo $_GET['CName']; ?>">
												</div>
											</div>
											<div class="col-sm-4">
												<div class="mb-3">
													<a href="suppliers.php" class="btn btn-outline-danger btn-actions float-end submit-next" onClick="loadPage('suppliers.php')"> <span class="en">Clear</span><span class="ar"><?= getArabicTitle('Clear') ?></span></a>
													<button type="submit" class="btn btn-outline-primary btn-actions float-end submit-next mr-2" name="submit"> <span class="en">Submit <i class="fa fa-arrow-right icon-font"></i></span><span class="ar"><i class="fa fa-arrow-right icon-font"></i> <?= getArabicTitle('Submit') ?></span> </button>
												</div>
											</div>
										</div>


										<?php
										$condition = 'Where Cid <> 0 And IsDeleted=0';
										include('custom_newpagination/paginator.class.php');


										//s$SrchBy = !empty($_GET['SrchBy']) ? $_GET['SrchBy']: 0;
										$CCode = !empty($_GET['CCode']) ? $_GET['CCode'] : 0;
										if ($CCode != 0) {
											$condition .= " And CCode=" . $CCode;
										}

										$CName = !empty($_GET['CName']) ? $_GET['CName'] : '';
										if ($CName != '') {
											$condition .= " And CName LIKE '%" . $CName . "%'";
										}


										$pages = new Paginator;
										$qp = "Select count(CCode) as totalrec from SupplierFile   $condition";
										$rf = Run($qp);
										$tolrec = myfetch($rf)->totalrec;

										$pages->default_ipp = 20;
										$pages->items_total = $tolrec;
										$pages->mid_range = 9;
										$pages->paginate();

										//$initialLimit = ",".$pages->limit;
										$OrderBy = "Order by CCode DESC";

										$qpt = "Select * from SupplierFile $condition  $OrderBy " . $pages->limit . "";
										$result = Run($qpt);
										?>
										<div class="mb-3">
											<!-- Listing -->
											<table class="table table-striped table-bordered dt-responsive table-hover direction">

												<?php
												if ($pages->items_total > 0) {
												?>
													<thead>
														<tr>
															<th><span class="en">CCode</span><span class="ar"><?= getArabicTitle('CCode') ?></span></th>
															<th><span class="en">CName</span><span class="ar"><?= getArabicTitle('CName') ?></span></th>
															<th><span class="en">Group</span><span class="ar"><?= getArabicTitle('Group') ?></span></th>
															<th><span class="en">Action</span><span class="ar"><?= getArabicTitle('Action') ?></span></th>
														</tr>
													</thead>
													<tbody>
														<?php

														while ($single = myfetch($result)) {
															$supplQ = Run("Select * from SupplierGroup where Gid = '" . $single->grpId . "'");
															$getSupplierGroup = myfetch($supplQ);
															$grp = $getSupplierGroup->NameEng;
															if ($grp == "") {
																$grp = $getSupplierGroup->NameArb;
															}
														?>
															<tr>
																<td>
																	<?= $single->CCode ?>
																</td>
																<td>
																	<?= $single->CName ?>
																</td>
																<td>
																	<?= $grp ?>
																</td>
																<td style="float: left">
																	<a href="update_supplier.php?CCode=<?= $single->CCode ?>&bid=<?= $single->bid ?>" style="width: fit-content;float: left; margin-right: 5px">
																		<span class=""><i class="fa fa-pencil fa-2x" aria-hidden="true"></i></span>
																	</a>
																	<a href="javascript:" onclick="deleteEntry('<?= $single->CCode ?>','<?= $single->bid ?>')" style="width: fit-content; float: left">
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
																<h2 ><strong><span class="en">No Record(s) Found...</span><span class="ar"><?= getArabicTitle('No Record(s) Found...') ?></span></strong></h2>
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

<script src="include/customers/custCrud.js"></script>
<script src="include/suppliers/supCrud.js"></script>


</html>