<?php
session_start();
error_reporting(0);
include("../../config/connection.php");
// include("../../config/functions.php");
if (empty($_SESSION['id'])) {
	printf("<script>location.href='index.php?value=logout'</script>");
	die();
}
$lang = $_SESSION['lang'];

$myq2 = Run("Select * from " . dbObject . "SupplierGroup  order by Gid ASC");

?>
<div id="deleteEntry"></div>
<div class="row">
	<div class="col-lg-12">
		<div class="ibox ">
			<div class="ibox-title pb-4 mb-2">
					<h5><span class="en">Supplier Group List</span><span class="ar"><?= getArabicTitle('Supplier Group List') ?></span></h5>

				<div class="ibox-tools d-flex align-items-top">
					<div class="col-md-12">
						<button type="button" onClick="Add()" class="btn btn-block btn-lg btn-outline-primary" id="seles_report_search" value="Add"><span class="en">Add <i class="fa fa-plus icon-font"></i></span><span class="ar">اضافة <i class="fa fa-plus icon-font"></i></span></button>
					</div>
				</div>
			</div>
			<div class="ibox-content">

				<div class="table-responsive">
					<table class="table table-striped table-bordered table-hover dataTables-example">
						<thead>
							<tr>
								<th><span class="en">Id</span><span class="ar"><?= getArabicTitle('ID') ?></span></th>
								<th><span class="en">Code</span><span class="ar"><?= getArabicTitle('Code') ?></span></th>
								<th><span class="en">Name</span><span class="ar"><?= getArabicTitle('Name') ?></span></th>
								<th><span class="en">NameArb</span><span class="ar"><?= getArabicTitle('NameArb') ?></span></th>
								<th><span class="en">Main Group</span><span class="ar"><?= getArabicTitle('Main Group') ?></span></th>
								<th><span class="en">Action</span><span class="ar"><?= getArabicTitle('Action') ?></span></th>
							</tr>
						</thead>
						<tbody>
							<?php
							while ($load = myfetch($myq2)) {
								$id = $load->Gid;
								$main = "";
								if ($load->MainGid == NULL) {
									$main = '<span class="label label-success en">Is Main </span><span class="label label-success ar">'. getArabicTitle('Is Main') .' </span>';
								} else {
									$qp = Run("Select * from " . dbObject . "SupplierGroup where Gid = '" . $load->MainGid . "'");
									$main = myfetch($qp)->NameEng;
								}

							?>
								<tr class="gradeX">
									<td><?= $load->Gid ?> </td>
									<td><?= $load->Code ?> </td>
									<td><?= $load->NameEng ?></td>
									<td><?= $load->NameArb ?></td>
									<td>
										<?= $main ?>
									</td>


									</td>

									<td align="center">



										<a href="javascript:edit('<?= $id ?>');"><i class="fa fa-pencil-square-o"></i> </a>

										&nbsp;

										<a href="javascript:deleteEntry('<?= $id ?>');"><i class="fa fa-times-circle-o"></i> </a>
									</td>

								</tr>

							<?php
							}

							?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>

<script>
	$(document).ready(function() {
		$('.dataTables-example').DataTable({
			pageLength: 10,
			responsive: true,
			dom: '<"html5buttons"B>lTfgitp',
			buttons: [],
			"ordering": false


		});

	});
</script>

<script>
    $(document).ready(function() {
        var lang = document.getElementById("selected_lang").value;
        changeLanguage(lang);
    });
</script>