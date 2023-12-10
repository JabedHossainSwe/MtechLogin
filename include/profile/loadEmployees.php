<?php
session_start();
error_reporting(0);
include("../../config/main_connection.php");
include("../../config/connection.php");
// include("../../config/functions.php");
if (empty($_SESSION['id'])) {
	printf("<script>location.href='index.php?value=logout'</script>");
	die();
}
$id = $_SESSION['companyId'];
$gg = "Select * from " . dbObjectMain . "Logins where companyId = '" . $_SESSION['companyId'] . "'";
$myq2 = RunMain($gg);
$getCnt =  count(colfetch($myq2));

$gg2 = "Select * from " . dbObjectMain . "Companies where id = '" . $_SESSION['companyId'] . "'";
$compD = RunMain($gg2);
$CompF = myfetchMain($compD);
$allowedLogins = $CompF->allowedLogins;
?>
<div id="deleteBranch"></div>
<div class="row">
	<div class="col-lg-12">
		<div class="ibox ">
			<div class="ibox-title">
				<h5 class="en float-left">Logins List</h5>
				<h5 class="ar float-right"><?= getArabicTitle('Logins List')?></h5>
				<div style="top:6px!important;" class="ibox-tools">
					<div class="col-md-12">

						<?php
						if ($getCnt < $allowedLogins) {
						?>

							<button type="button" onClick="AddUser('<?= $id ?>')" class="btn btn-block btn-lg btn-outline-primary" id="seles_report_search" value="Add"><span class="en">Add</span><span class="ar">اضافة </span>
							</button>
					</div>
				<?php
						}
				?>

				</div>
			</div>
			<div class="ibox-content">

				<div class="table-responsive">
					<table class="table table-striped table-bordered table-hover dataTables-example2">
						<thead>
							<tr>
								<th><span class="en">Sr#</span><span class="ar"><?= getArabicTitle('Sr#') ?></span></th>
								<th><span class="en">Logo</span><span class="ar"><?= getArabicTitle('Logo') ?></span></th>
								<th><span class="en">Name</span><span class="ar"><?= getArabicTitle('Name') ?></span></th>
								<th><span class="en">Code</span><span class="ar"><?= getArabicTitle('Code') ?></span></th>
								<th><span class="en">Email</span><span class="ar"><?= getArabicTitle('Email') ?></span></th>
								<th><span class="en">IsAdmin</span><span class="ar"><?= getArabicTitle('IsAdmin') ?></span></th>
								<th><span class="en">Status</span><span class="ar"><?= getArabicTitle('Status') ?></span></th>
								<th><span class="en">Added By</span><span class="ar"><?= getArabicTitle('Added By') ?></span></th>
								<th><span class="en">Action</span><span class="ar"><?= getArabicTitle('Action') ?></span></th>

							</tr>
						</thead>
						<tbody>
							<?php
							$counter = 1;
							$gg = "Select * from " . dbObjectMain . "Logins where companyId = '" . $_SESSION['companyId'] . "'";
							$myq2 = RunMain($gg);
							while ($rl = myfetch($myq2)) {
								$addedBy = $rl->addedBy;


								$status = '
<a href="javascript:ChangeStatus(' . $rl->id . ');" class="">
<span class="label label-success">Active </span> </a>
';

								$ad = '
<a href="javascript:;" >
<span class="label label-success">Yes</span> </a>
';


								$completed = '';


								if ($rl->status != '1') {
									$status = '
<a href="javascript:ChangeStatus(' . $rl->id . ');" >
<span class="label label-danger">InActive</span></a>
';
								}

								if ($rl->isAdmin != '1') {
									$ad = '
<a href="javascript:;" >
<span class="label label-danger">No</span> </a>
';
								}


							?>

								<tr>
									<td>
										<?php echo $counter; ?>
									</td>
									<td style="width: 5%;" class="sorting_1">


										<img alt="" src="/<?= $rl->img ?>" style="width: 30px">


									</td>
									<td><?php echo $rl->name; ?></td>
									<td><?php echo $rl->code; ?></td>
									<td><?php echo $rl->email; ?></td>
									<td><?php echo $ad; ?></td>
									<td><?php echo $status; ?></td>
									<td><?php echo $addedBy; ?></td>
									<td align="center">



										<a href="javascript:editUser('<?= $rl->id ?>');"><i class="fa fa-pencil-square-o"></i> </a>

										&nbsp;
										<?php
										if ($rl->id != $_SESSION['id']) {
											/*
	?>
	<a href="javascript:deleteUser('<?=$rl->id?>');"><i class="fa fa-times-circle-o"></i> </a>
	<?php
	*/
										}
										?>
									</td>
								</tr>

							<?php
								$counter++;
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
		$('.dataTables-example2').DataTable({
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