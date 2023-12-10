<?php
session_start();
error_reporting(0);
include("../../config/main_connection.php");
include("../../config/connection.php");
// include("../../config/functions.php");
$id = $_POST['id'];
$MainQ = RunMain("Select * from " . dbObjectMain . "Companies where id = '" . $id . "'");
$myq = myfetchMain($MainQ);
$customer_id = (int) $myq->customer_id;
$query = RunMain("Select max(id) as ttl from " . dbObjectMain . "Logins where companyId='" . $id . "'");
$ttl = myfetchMain($query)->ttl;
if (empty($ttl)) {
  $user_id = "1";
} else {
  $user_id = $ttl + 1;
}

if ($user_id < 10) {
  $user_id = "0" . $user_id;
}
$code = "Mtk" . $customer_id . $user_id;
?>
<div id="error"></div>
<form action="javascript:saveUser('<?= $id ?>')" class="form-horizontal form-bordered form-label-stripped" id="add_user_form_comp" enctype="multipart/form-data">
  <div class="modal-body" id="modalBody">

    <div class="form-body">
      <div class="d-flex col-md-12 m-0 p-0 mb-3">
        <div class="row col-md-6 ">
          <div class="col-md-4">
            <label class="control-label"><span class="en">Code</span><span class="ar"><?= getArabicTitle('Code') ?></span></label>
          </div>
          <div class="col-md-8">
            <input type="hidden" id="id" name="id" value="<?= $id ?>">
            <input type="text" placeholder="Customer Code" id="storeCode" name="storeCode" class="form-control" autocomplete="off" value="<?php echo $code; ?>" readonly>
            <span class="help-block errorDiv" id="storeCode_error"></span>
          </div>
        </div>
        <div class="row col-md-6 ">
          <div class="col-md-4">
            <label class="control-label"><span class="en">Name</span><span class="ar"><?= getArabicTitle('Name') ?></span></label>
          </div>
          <div class="col-md-8">
            <input type="text" placeholder="Name" id="name" name="name" class="form-control" autocomplete="off">
            <span class="help-block errorDiv" id="name_error"></span>
          </div>

        </div>
      </div>
      <div class="d-flex col-md-12 m-0 p-0 mb-3">
        <div class="row col-md-6 ">
          <div class="col-md-4">
            <label class="control-label"><span class="en">Email</span><span class="ar"><?= getArabicTitle('Email') ?></span></label>
          </div>
          <div class="col-md-8">
            <input type="email" placeholder="Login Email" id="email" name="email" class="form-control" autocomplete="off">
            <span class="help-block errorDiv" id="email_error"></span>
          </div>
        </div>
        <div class="row col-md-6 ">
          <div class="col-md-4">
            <label class="control-label "><span class="en">Password</span><span class="ar"><?= getArabicTitle('Password') ?></span></label>
          </div>
          <div class="col-md-8">
            <input type="text" placeholder="Login Password" id="password" name="password" class="form-control" autocomplete="off">
            <span class="help-block errorDiv" id="password_error"></span>
          </div>

        </div>
      </div>
      <div class="d-flex col-md-12 m-0 p-0 mb-3">
        <label class="control-label col-md-3"><span class="en">Description</span><span class="ar"><?= getArabicTitle('Description') ?></span></label>
        <div class="col-md-9">
          <textarea placeholder="Description" id="description" name="description" class="form-control" autocomplete="off"></textarea>
        </div>
      </div>
      <div class="d-flex col-md-12 m-0 p-0 mb-3">
        <div class="row col-md-4 p-0 m-0 ">
          <div class="col-md-3">
            <label class="control-label "><span class="en">Branch</span><span class="ar"><?= getArabicTitle('Branch') ?></span></label>
          </div>
          <div class="col-md-9">
            <select id="branch" name="branch" class="form-control select2_demo_1 ">
              <option value="">Select Option</option>
              <?php
              $Bracnhes = Run("Select * from " . dbObject . "Branch order by BName ASC");
              while ($getB = myfetch($Bracnhes)) {
              ?>
                <option value="<?= $getB->Bid ?>"><?= $getB->BCode ?>
                  - <?= $getB->BDescription ?></option>
              <?php
              }

              ?>
            </select>
            <span class="help-block errorDiv" id="branch_error"></span>
          </div>
        </div>

        <div class="row col-md-4 p-0 m-0">
          <div class="col-md-4 p-0 m-0">
            <label class="control-label "><span class="en">Department</span><span class="ar"><?= getArabicTitle('Department') ?></span></label>
          </div>
          <div class="col-md-8 p-0 m-0">
            <select id="department" name="department" class="select2_demo_1 form-control">
              <option value="">Select Option</option>
              <?php
              $qq = Run("Select * from Dept order by Cid ASC");
              while ($getB = $qq->fetchObject()) {
              ?>
                <option value="<?= $getB->Cid ?>"><?= $getB->CCode ?> - <?= $getB->CName ?></option>
              <?php
              }

              ?>
            </select>
            <span class="help-block errorDiv" id="department_error"></span>
          </div>
        </div>

        <div class="row col-md-4 p-0 m-0">
          <div class="col-md-3  text-center">
            <label class="control-label"><span class="en">Section</span><span class="ar"><?= getArabicTitle('Section') ?></span></label>
          </div>
          <div class="col-md-9 ">
            <select id="section" name="section" class="select2_demo_1 form-control">
              <option value="">Select Option</option>
              <?php
              $qq = Run("Select * from Sections order by Cid ASC");
              while ($getB = $qq->fetchObject()) {
              ?>
                <option value="<?= $getB->Cid ?>"><?= $getB->CCode ?> - <?= $getB->CName ?></option>
              <?php
              }

              ?>
            </select>
            <span class="help-block errorDiv" id="section_error"></span>
          </div>

        </div>
      </div>
      <div class="d-flex col-md-12 m-0 p-0 mb-3">
        <div class="row col-md-3 p-0 m-0">
          <div class="col-md-8">
            <label class="control-label " for="isFixBranch"><span class="en">Is Fix Branch</span><span class="ar"><?= getArabicTitle('Is Fix Branch') ?></span></label>
          </div>
          <div class="col-md-4">
            <input type="checkbox" id="isFixBranch" name="isFixBranch" class="form-control">
          </div>
        </div>

        <div class="row col-md-5 p-0 m-0">
          <div class="col-md-4">
            <label class="control-label "><span class="en">User Type</span><span class="ar"><?= getArabicTitle('User Type') ?></span></label>
          </div>
          <div class="col-md-8">
            <select id="usertype" name="usertype[]" class="select2_demo_1 form-control">
              <option value="0"><span class="en">Please Select Option</span><span class="ar"><?= getArabicTitle('Please Select Option') ?></span></option>
              <option value="1"><span class="en">Order</span><span class="ar"><?= getArabicTitle('Order') ?></span></option>
              <option value="2"><span class="en">Touch Sales</span><span class="ar"><?= getArabicTitle('Touch Sales') ?></span></option>
              <option value="3"><span class="en">Sales</span><span class="ar"><?= getArabicTitle('Sales') ?></span></option>
              <option value="4"><span class="en">Sales Return</span><span class="ar"><?= getArabicTitle('Sales Return') ?></span></option>
              <option value="5"><span class="en">Services</span><span class="ar"><?= getArabicTitle('Services') ?></span></option>
            </select>
            <span class="help-block errorDiv" id="usertype_error"></span>
          </div>

        </div>

        <div class="row col-md-4 p-0 m-0">
          <div class="col-md-4">
            <label class="control-label"><span class="en">Branch Type</span><span class="ar"><?= getArabicTitle('Branch Type') ?></span> </label>
          </div>
          <div class="col-md-8">
            <select id="uiType" name="uiType[]" class="select2_demo_1 form-control" multiple>
              <option value="Laptop"><span class="en">Laptop</span><span class="ar"><?= getArabicTitle('Laptop') ?></span></option>
              <option value="Mobile"><span class="en">Mobile</span><span class="ar"><?= getArabicTitle('Mobile') ?></span></option>
              <option value="Desktop"><span class="en">Desktop</span><span class="ar"><?= getArabicTitle('Desktop') ?></span></option>
            </select>
            <span class="help-block errorDiv" id="uiType_error"></span>
            <span class="help-block errorDiv" id="section_error"></span>
          </div>

        </div>
      </div>
      <div class="d-flex col-md-12 m-0 p-0 mb-3">
        <div class="row col-md-4 p-0 m-0 ">
          <div class="col-md-6">
            <label class="control-label "><span class="en">Is Master</span><span class="ar"><?= getArabicTitle('Is Master') ?></span> </label>
          </div>
          <div class="col-md-6">
            <select id="isMaster" name="isMaster" class="select2_demo_1 form-control">
              <option value="0"><span class="en">No</span><span class="ar"><?= getArabicTitle('No') ?></span></option>

              <option value="1"><span class="en">Yes</span><span class="ar"><?= getArabicTitle('Yes') ?></span></option>
            </select>
            <span class="help-block errorDiv" id="isMaster_error"></span>
          </div>
        </div>

        <div class="row col-md-4 p-0 m-0">
          <div class="col-md-4">
            <label class="control-label"><span class="en">Department</span><span class="ar"><?= getArabicTitle('Department') ?></span></label>
          </div>
          <div class="col-md-8">
            <select id="department" name="department" class="select2_demo_1 form-control">
              <option value="">Select Option</option>
              <?php
              $qq = Run("Select * from Dept order by Cid ASC");
              while ($getB = $qq->fetchObject()) {
              ?>
                <option value="<?= $getB->Cid ?>"><?= $getB->CCode ?> - <?= $getB->CName ?></option>
              <?php
              }

              ?>
            </select>
            <span class="help-block errorDiv" id="department_error"></span>
          </div>

        </div>

        <div class="row col-md-4 p-0 m-0">
          <div class="col-md-4">
            <label class="control-label "><span class="en">Image</span><span class="ar"><?= getArabicTitle('Image') ?></span> <small style="font-size: 10px; color: red;">(jpg,jpeg,png,gif)</small></label>
          </div>
          <div class="col-md-8">
            <input type="file" id="file" name="file" class="form-control" accept="image/png, image/gif, image/jpeg">
            <span class="help-block errorDiv" id="file_error"></span>
          </div>

        </div>
      </div>
    </div>
  </div>
  <div class="modal-footer">
    <div class="col-md-12 d-flex justify-content-center">
      <div class="col-md-3 pr-2">
        <button type="button" class="btn btn-block btn-outline-danger" data-dismiss="modal" id="closed"><span class="en">Close</span><span class="ar"><?= getArabicTitle('Close') ?></span></button>
      </div>
      <div class="col-md-3">
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