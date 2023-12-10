<?php
session_start();
error_reporting(0);
include("../../config/connection.php");
// include("../../config/functions.php");

//// Fetch BID And Bcode//<br>
$abc = "Select max(Cid) as maxBid,max(CCode) as maxBd from " . dbObject . "Purchaser ";
$myq2 = Run($abc);
$getData = myfetch($myq2);
$Bid = $getData->maxBid + 1;
$Bcode = $getData->maxBd + 1;
if ($Bcode < 10) {
  $Bcode = "0" . $Bcode;
}

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
              <input id="Cid" name="Cid" type="text" value="<?= $Bid ?>" class="form-control" readonly>
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
              <input id="CCode" name="CCode" type="text" class="form-control" readonly value="<?= $Bcode ?>">
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
              <input value="" id="CName" name="CName" type="text" class="grpreq form-control" autocomplete="off">
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
              <input value="" id="Description" name="Description" type="text" class="form-control" autocomplete="off" dir="rtl">
              <span class="help-block errorDiv" id="Description_error"></span>

            </div>
          </div>
        </div>
      </div>

      <div class="col-12">
        <div class="row">
          <div class="col-md-3">
            <h4><span class="en">Address</span><span class="ar"><?= getArabicTitle('Address') ?></span></h4>
          </div>
          <div class="col-md-9">
            <div class="form-group">
              <input value="" id="Address" name="Address" type="text" class="form-control" autocomplete="off">
              <span class="help-block errorDiv" id="Address_error"></span>

            </div>
          </div>
        </div>
      </div>
      <div class="col-12">
        <div class="row">
          <div class="col-md-3">
            <h4><span class="en">Contact 1</span><span class="ar"><?= getArabicTitle('Contact') ?> 1</span></h4>
          </div>
          <div class="col-md-9">
            <div class="form-group">
              <input value="" id="Contact1" name="Contact1" type="text" class="form-control" autocomplete="off" onkeypress="validateInput(event)">
              <span class="help-block errorDiv" id="Contact1_error"></span>

            </div>
          </div>
        </div>
      </div>
      <div class="col-12">
        <div class="row">
          <div class="col-md-3">
            <h4><span class="en">Contact 2</span><span class="ar"><?= getArabicTitle('Contact') ?> 2</span></h4>
          </div>
          <div class="col-md-9">
            <div class="form-group">
              <input value="" id="Contact2" name="Contact2" type="text" class="form-control" autocomplete="off" onkeypress="validateInput(event)">
              <span class="help-block errorDiv" id="Contact2_error"></span>

            </div>
          </div>
        </div>
      </div>

      <div class="col-12">
        <div class="row">
          <div class="col-md-3">
            <h4><span class="en">Fax</span><span class="ar"><?= getArabicTitle('Fax') ?></span></h4>
          </div>
          <div class="col-md-9">
            <div class="form-group">
              <input value="" id="Fax" name="Fax" type="text" class="form-control" autocomplete="off">
              <span class="help-block errorDiv" id="Fax_error"></span>

            </div>
          </div>
        </div>
      </div>
      <div class="col-12">
        <div class="row">
          <div class="col-md-3">
            <h4><span class="en">Email</span><span class="ar"><?= getArabicTitle('Email') ?></span></h4>
          </div>
          <div class="col-md-9">
            <div class="form-group">
              <input value="" id="Email" name="Email" type="text" class="form-control" autocomplete="off">
              <span class="help-block errorDiv" id="Email_error"></span>

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
      <button type="button" class="btn btn-block btn-outline-primary" id="product_group_add_btn" onClick="return save()"><span class="en">Save</span><span class="ar"><?= getArabicTitle('Save') ?></span></button>
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
  $(document).ready(function () {
    var lang = document.getElementById("selected_lang").value;
    changeLanguage(lang);
  });
</script>