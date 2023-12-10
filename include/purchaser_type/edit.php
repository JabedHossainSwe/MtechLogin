<?php
session_start();
error_reporting(0);
include("../../config/connection.php");
// include("../../config/functions.php");
$id = $_POST['id'];
//// Fetch BID And Bcode//<br>
$abc = "Select * from " . dbObject . "Pur_Type where Cid = '" . $id . "' ";
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
              <input id="Cid" name="Cid" type="text" value="<?= $getData->Cid; ?>" class="form-control" readonly>
              <span class="help-block errorDiv" id="Cid_error"></span>

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
              <input id="CCode" name="CCode" type="text" class="form-control" readonly value="<?= $getData->CCode; ?>">
              <span class="help-block errorDiv" id="CCode_error"></span>

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
              <input value="<?= $getData->CName; ?>" id="CName" name="CName" type="text" class="grpreq form-control"
                autocomplete="off">
              <span class="help-block errorDiv" id="CName_error"></span>

            </div>
          </div>
        </div>
      </div>

      <div class="col-12">
        <div class="row">
          <div class="col-md-3">
            <h4><span class="en">Description</span><span class="ar"><?= getArabicTitle('Description') ?></span></h4>
          </div>
          <div class="col-md-9">
            <div class="form-group">
              <input value="<?= $getData->Description; ?>" id="Description" name="Description" type="text"
                class="form-control" autocomplete="off" dir="rtl">
              <span class="help-block errorDiv" id="Description_error"></span>

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
      <button type="button" class="btn btn-block btn-outline-primary" id="product_group_update_btn" onClick="return update()"><span class="en">Save</span><span class="ar"><?= getArabicTitle('Save') ?></span></button>
    </div>

  </div>

</div>
</form>
<div id="save"></div>
<script>
  $(document).ready(function () {
    $(".select2_demo_1").select2({
      width: '100%',
      closeOnSelect: true,
    });
  });

</script>
<style>
.select2-container
{
	  z-index: 99999;
}
</style>

<script>
  $(document).ready(function () {
    var lang = document.getElementById("selected_lang").value;
    changeLanguage(lang);
  });
</script>