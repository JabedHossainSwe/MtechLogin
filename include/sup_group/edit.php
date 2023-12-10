<?php
session_start();
error_reporting(0);
include("../../config/connection.php");
// include("../../config/functions.php");
$id = $_POST['id'];
//// Fetch BID And Bcode//<br>
$abc = "Select * from " . dbObject . "SupplierGroup where Gid = '" . $id . "' ";
$myq2 = Run($abc);
$getData = myfetch($myq2);


?>
<div class="modal-body" id="modalBody">
	<form id="save_form">
		<div class="row">

			<div class="col-6">
				<div class="row">
					<div class="col-md-3">
						<h4><span class="en">ID</span><span class="ar"><?= getArabicTitle('ID') ?></span></h4>
					</div>
					<div class="col-md-9">
						<div class="form-group">
							<input id="GId" name="GId" type="text" value="<?= $getData->Gid; ?>" class="form-control" readonly>
							<span class="help-block errorDiv" id="GId_error"></span>

						</div>
					</div>
				</div>
			</div>
			<div class="col-6">
				<div class="row">
					<div class="col-md-3">
					<h4><span class="en">Code</span><span class="ar"><?= getArabicTitle('Code') ?></span></h4>
					</div>
					<div class="col-md-9">
						<div class="form-group">
							<input id="Code" name="Code" type="text" class="form-control" readonly value="<?= $getData->Code; ?>">
							<span class="help-block errorDiv" id="Code_error"></span>

						</div>
					</div>
				</div>
			</div>
			<div class="col-12">
				<div class="row">
					<div class="col-md-3">
					<h4><span class="en">Main Group</span><span class="ar"><?= getArabicTitle('Main Group') ?></span></h4>
					</div>
					<div class="col-md-9">
						<div class="form-group">
							<?php
							$qp = "Select * from " . dbObject . "SupplierGroup where MainGid IS NULL and Gid != '" . $id . "' order by NameEng ASC";
							?>
							<select id="MainGid" name="MainGid" class="form-control select2_demo_1 ">
								<option value="">Is Main</option>
								<?php
								$Bracnhes = Run($qp);
								while ($getB = myfetch($Bracnhes)) {
									$selected = "";
									if ($getB->Gid == $getData->MainGid) {
										$selected = "Selected";
									}
								?>
									<option value="<?= $getB->Gid ?>" <?= $selected ?>><?= $getB->Code ?>
										- <?= $getB->NameEng ?></option>
								<?php
								}

								?>
							</select>

						</div>
					</div>
				</div>
			</div>



			<div class="col-12">
				<div class="row">
					<div class="col-md-3">
					<h4><span class="en">Branch</span><span class="ar"><?= getArabicTitle('Branch') ?></span></h4>
					</div>
					<div class="col-md-9">
						<div class="form-group">
							<select id="branch" name="branch" class="form-control select2_demo_1 grpreq">
								<option value="">Select Option</option>
								<?php

								if ($_SESSION['isAdmin'] == '1') {
									$Bracnhes = Run("Select * from " . dbObject . "Branch order by BName ASC");
								} else {
									$Bracnhes = Run("Select " . dbObject . "Branch.Bid," . dbObject . "Branch.BName from " . dbObject . "Branch
Inner JOIN " . dbObject . "EMP  On " . dbObject . "EMP.BID = " . dbObject . "Branch.Bid
where " . dbObject . "EMP.WebCode = '" . $_SESSION['code'] . "' ");
								}

								while ($getB = myfetch($Bracnhes)) {
									$selected = "";
									if ($getB->Bid == $getData->bid) {
										$selected = "Selected";
									}
								?>
									<option value="<?= $getB->Bid ?>" <?= $selected ?>><?= $getB->BCode ?>
										- <?= $getB->BDescription ?></option>
								<?php
								}

								?>
							</select>
							<span class="help-block errorDiv" id="branch_error"></span>

						</div>
					</div>
				</div>
			</div>

			<div class="col-12">
				<div class="row">
					<div class="col-md-3">
					<h4><span class="en">Name</span><span class="ar"><?= getArabicTitle('Name') ?></span></h4>
					</div>
					<div class="col-md-9">
						<div class="form-group">
							<input value="<?= $getData->NameEng; ?>" id="NameEng" name="NameEng" type="text" class="grpreq form-control" autocomplete="off">
							<span class="help-block errorDiv" id="NameEng_error"></span>

						</div>
					</div>
				</div>
			</div>

			<div class="col-12">
				<div class="row">
					<div class="col-md-3">
					<h4><span class="en">NameArb</span><span class="ar"><?= getArabicTitle('NameArb') ?></span></h4>
					</div>
					<div class="col-md-9">
						<div class="form-group">
							<input value="<?= $getData->NameArb; ?>" id="NameArb" name="NameArb" type="text" class="form-control" autocomplete="off" dir="rtl">
							<span class="help-block errorDiv" id="NameArb_error"></span>

						</div>
					</div>
				</div>
			</div>



			<hr />


		</div>
</div>
<div class="modal-footer">
	<div class="col-md-12 d-flex justify-content-center">
		<div class="col-md-4">
			<button type="button" class="btn btn-block btn-outline-danger" data-dismiss="modal" id="closed"><span class="en">Close</span><span class="ar"><?= getArabicTitle('Close') ?></span></button>
		</div>
		<div class="col-md-4">
			<button type="button" class="btn btn-block btn-outline-primary" id="sup_group_update_btn" onClick="return update()"><span class="en">Save</span><span class="ar"><?= getArabicTitle('Save') ?></span></button>
		</div>
	</div>
</div>
</form>
<div id="save"></div>
<script>
	$(document).ready(function() {
		$(".select2_demo_1").select2({
			width: '100%',
			closeOnSelect: true,
		});
	});
</script>
<style>
	.select2-container {
		z-index: 99999;
	}
</style>

<script>
    $(document).ready(function() {
        var lang = document.getElementById("selected_lang").value;
        changeLanguage(lang);
    });
</script>