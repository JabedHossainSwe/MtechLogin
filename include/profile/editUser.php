<?php
session_start();
error_reporting(0);
include("../../config/main_connection.php");
include("../../config/connection.php");
// include("../../config/functions.php");
$id = $_POST['id'];
$qst = RunMain("Select * from " . dbObjectMain . "Logins where id = '" . $id . "'");
$myq = myfetchMain($qst);
$companyId = $myq->companyId;
$code = $myq->code;
$OtherDataBaseQuery = Run("Select * from Emp where webcode = '" . $code . "'");
$getData = $OtherDataBaseQuery->fetchObject();
$DeptID = $getData->DeptID;
$Pass = $getData->Pass;
$BID = $getData->BID;
$Description = $getData->Description;
$FixedBranch = $getData->FixedBranch;
$IsAdmin = $getData->IsAdmin;
$SectionId = $getData->SectionId;
$userType = $getData->userType;
$uiType = $getData->uiType;
$IsSuperVisor = $getData->IsSuperVisor;
$IsWorker = $getData->IsWorker;
$isLogedin = $getData->IsLogedin;
$isWeb = $getData->isWeb;


?>
<div id="error"></div>
<form action="javascript:updateUser('<?= $id ?>')" class="form-horizontal form-bordered form-label-stripped" id="update_user_form_comp" enctype="multipart/form-data">
	<div class="modal-body " id="modalBody">
		<div class="form-body p-0 m-0">
			<div class=" d-flex col-md-12 p-0 m-0 mb-3">
				<div class="row col-md-6 p-0 m-0">
					<label class="control-label col-md-4" style="text-align: left;"><span class="en">Email</span><span class="ar"><?= getArabicTitle('Email') ?></span></label>
					<div class="col-md-8">
						<input type="email" placeholder="Login Email" id="email" name="email" class="form-control" autocomplete="off" value="<?= $myq->email; ?>">
						<span class="help-block errorDiv" id="email_error"></span>
					</div>
				</div>
				<div class="row col-md-6 p-0 m-0">
					<label class="control-label col-md-4" style="text-align: left;"><span class="en">Password</span><span class="ar"><?= getArabicTitle('Password') ?></span></label>
					<div class="col-md-8">
						<input type="text" placeholder="Login Password" id="password" name="password" class="form-control" autocomplete="off" value="<?= $Pass ?>">
						<span class="help-block errorDiv" id="password_error"></span>
					</div>

				</div>
			</div>
			<div class=" d-flex col-md-12 p-0 m-0 mb-3">
				<div class="row col-md-6 p-0 m-0">
					<label class="control-label col-md-4" style="text-align: left;"><span class="en">Code</span><span class="ar"><?= getArabicTitle('Code') ?></span></label>
					<div class="col-md-8">
						<input type="hidden" id="id" name="id" value="<?= $id ?>">
						<input type="text" placeholder="Customer Code" id="storeCode" name="storeCode" class="form-control" autocomplete="off" value="<?= $myq->code; ?>" readonly>
						<span class="help-block errorDiv" id="storeCode_error"></span>
					</div>

				</div>
				<div class="row col-md-6 p-0 m-0">
					<label class="control-label col-md-4" style="text-align: left;"><span class="en">Name</span><span class="ar"><?= getArabicTitle('Name') ?></span></label>
					<div class="col-md-8">
						<input type="text" placeholder="Name" id="name" name="name" class="form-control" autocomplete="off" value="<?= $myq->name; ?>">
						<span class="help-block errorDiv" id="name_error"></span>
					</div>

				</div>
			</div>
			<div class=" d-flex col-md-12 p-0 m-0 mb-3">
				<label class="control-label col-md-3" style="text-align: left;"><span class="en">Description</span><span class="ar"><?= getArabicTitle('Description') ?></span></label>
				<div class="col-md-9">
					<textarea placeholder="Description" id="description" name="description" class="form-control" autocomplete="off"><?= $Description; ?></textarea>

				</div>

			</div>
			<div class=" d-flex col-md-12 p-0 m-0 mb-3">
				<div class="row col-4 p-0 m-0">
					<div class="col-md-3 p-0 m-0">
						<label class="control-label"><span class="en">Branch</span><span class="ar"><?= getArabicTitle('Branch') ?></span></label>
					</div>
					<div class="col-md-9 p-0 m-0">
						<select id="branch" name="branch" class="form-control select2_demo_1 ">
							<option value="">Select Option</option>
							<?php
							$Bracnhes = Run("Select * from " . dbObject . "Branch order by BName ASC");
							while ($getB = myfetch($Bracnhes)) {
								$selected = "";
								if ($getB->Bid == $BID) {
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

				<div class="row col-4 p-0 m-0">
					<div class="col-md-4 p-0 m-0 pl-2">
						<label class="control-label"><span class="en">Department</span><span class="ar"><?= getArabicTitle('Department') ?></span></label>
					</div>
					<div class="col-md-8">
						<select id="department" name="department" class="select2_demo_1 form-control">
							<option value="">Select Option</option>
							<?php
							$qq = Run("Select * from Dept order by Cid ASC");
							while ($getB = $qq->fetchObject()) {
								$selected = "";
								if ($getB->Cid == $DeptID) {
									$selected = "Selected";
								}
							?>
								<option value="<?= $getB->Cid ?>" <?= $selected ?>><?= $getB->CCode ?> - <?= $getB->CName ?></option>
							<?php
							}

							?>
						</select>
						<span class="help-block errorDiv" id="department_error"></span>
					</div>

				</div>

				<div class="row col-4 p-0 m-0">
					<div class="col-md-4 m-0 p-0 pl-2">
						<label class="control-label "><span class="en">Section</span><span class="ar"><?= getArabicTitle('Section') ?></span></label>
					</div>
					<div class="col-md-8">
						<select id="section" name="section" class="select2_demo_1 form-control">
							<option value="">Select Option</option>
							<?php
							$qq = Run("Select * from Sections order by Cid ASC");
							while ($getB = $qq->fetchObject()) {
								$selected = "";
								if ($getB->Cid == $SectionId) {
									$selected = "Selected";
								}
							?>
								<option value="<?= $getB->Cid ?>" <?= $selected ?>><?= $getB->CCode ?> - <?= $getB->CName ?></option>
							<?php
							}
							?>
						</select>
						<span class="help-block errorDiv" id="section_error"></span>
					</div>
				</div>
			</div>
			<div class=" d-flex col-md-12 p-0 m-0 mb-3">
				<div class="row col-md-2 p-0 m-0">
					<div class="col-md-9 p-0 m-0">
						<label class="control-label" for="isFixBranch"><span class="en">Is Fix Branch</span><span class="ar"><?= getArabicTitle('Is Fix Branch') ?></span></label>
					</div>
					<div class="col-md-3 p-0 m-0">
						<input type="checkbox" id="isFixBranch" name="isFixBranch" class="form-control" <?php if ($FixedBranch != 0) {
																											echo "Checked";
																										} ?>>
					</div>
				</div>

				<div class="row col-md-5 p-0 m-0">
					<div class="col-md-4 p-0 m-0 pl-2">
						<label class="control-label"><span class="en">User Type</span><span class="ar"><?= getArabicTitle('User Type') ?></span></label>
					</div>
					<div class="col-md-8 p-0 m-0">
						<select id="usertype" name="usertype[]" class="select2_demo_1 form-control">
							<option value="0" <?php if ($userType == 0) {
													echo "Selected";
												} ?>>Please Select Option</option>
							<option value="1" <?php if ($userType == 1) {
													echo "Selected";
												} ?>>Order</option>
							<option value="2" <?php if ($userType == 2) {
													echo "Selected";
												} ?>>Touch Sales</option>
							<option value="3" <?php if ($userType == 3) {
													echo "Selected";
												} ?>>Sales</option>
							<option value="4" <?php if ($userType == 4) {
													echo "Selected";
												} ?>>Sales Return</option>
							<option value="5" <?php if ($userType == 5) {
													echo "Selected";
												} ?>>Services</option>
						</select>
						<span class="help-block errorDiv" id="usertype_error"></span>

					</div>


				</div>

				<div class="row col-md-5 p-0 m-0">
					<div class="col-md-4 p-0 m-0 pl-2">
						<label class="control-label " style="text-align: left"><span class="en">UI Type</span><span class="ar"><?= getArabicTitle('UI Type') ?></span> </label>
					</div>
					<div class="col-md-8 p-0 m-0">
						<select id="uiType" name="uiType[]" class="select2_demo_1 form-control" multiple>
							<option value="Laptop" <?php if (in_array("Laptop", explode(",", $uiType), TRUE)) {
														echo "Selected";
													} ?>>
								Laptop</option>
							<option value="Mobile" <?php if (in_array("Mobile", explode(",", $uiType), TRUE)) {
														echo "Selected";
													} ?>>
								Mobile</option>
							<option value="Desktop" <?php if (in_array("Desktop", explode(",", $uiType), TRUE)) {
														echo "Selected";
													} ?>>
								Desktop</option>
						</select>
						<span class="help-block errorDiv" id="uiType_error"></span>
					</div>
				</div>

			</div>
			<div class=" d-flex col-md-12 p-0 m-0 mb-3">
				<div class="row col-md-4 p-0 m-0">
					<div class="col-md-6 p-0 m-0">
						<label class="control-label "><span class="en">Is Master</span><span class="ar"><?= getArabicTitle('Is Master') ?></span></label>
					</div>
					<div class="col-md-6 p-0 m-0">
						<select id="isMaster" name="isMaster" class="select2_demo_1 form-control">
							<option value="0" <?php if ($myq->isAdmin == 0) {
													echo "Selected";
												} ?>>No</option>

							<option value="1" <?php if ($myq->isAdmin == 1) {
													echo "Selected";
												} ?>>Yes</option>
						</select>
						<span class="help-block errorDiv" id="isMaster_error"></span>
					</div>
				</div>

				<div class="row col-md-4 p-0 m-0">
					<div class="col-md-4">
						<label class="control-label" style="text-align: left;"><span class="en">Type</span><span class="ar"><?= getArabicTitle('Type') ?></span></label>
					</div>
					<div class="col-md-8">
						<select id="Type" name="Type[]" class="select2_demo_1 form-control" multiple>
							<option value="isAdmin" <?php if ($IsAdmin == "1") {
														echo "Selected";
													} ?>>isAdmin</option>
							<option value="isAccountant" <?php if ($isLogedin == "1") {
																echo "Selected";
															} ?>>isAccountant</option>
							<option value="isSuperVisor" <?php if ($IsSuperVisor == 1) {
																echo "Selected";
															} ?>>isSuperVisor</option>
							<option value="isWorker" <?php if ($isWorker == "1") {
															echo "Selected";
														} ?>>isWorker</option>
							<option value="isWeb" <?php if ($isWeb == "1") {
														echo "Selected";
													} ?>>isWeb</option>

						</select>
						<span class="help-block errorDiv" id="Type_error"></span>

					</div>
				</div>

				<div class="row col-md-4 p-0 m-0">
					<div class="col-md-3 p-0 m-0 pr-2">
						<label class="control-label"><span class="en">Image</span><span class="ar"><?= getArabicTitle('Image') ?></span><small style="font-size: 10px; color: red;">(jpg,jpeg,png,gif)</small></label>
					</div>
					<div class="col-md-9">
						<input type="file" id="file_up" name="file" class="form-control" accept="image/png, image/gif, image/jpeg">
						<span class="help-block errorDiv" id="file_error"></span>
					</div>
				</div>
			</div>
		</div>

	</div>

	<div class="modal-footer">
		<div class=" d-flex col-md-12 justify-content-center">
			<div class="row col-md-3 ">
				<button type="button" class="btn btn-block btn-outline-danger" data-dismiss="modal" id="closed"><span class="en">Close</span><span class="ar"><?= getArabicTitle('Close') ?></span></button>
			</div>
			<div class="row col-md-3 ml-2">
				<button type="submit" id="ajaxStart" class="btn btn-block btn-outline-primary"><span class="en">Save</span><span class="ar"><?= getArabicTitle('Save') ?></span></button>
			</div>
		</div>



	</div>

</form>
<div id="saveBranch"></div>
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