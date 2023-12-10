<?php
session_start();
error_reporting(0);
include("../../config/connection.php");
// include("../../config/functions.php");

//// Fetch BID And Bcode//<br>
$abc = "Select max(GId) as maxBid,max(Code) as maxBd from " . dbObject . "CustArea ";
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
              <input id="GId" name="GId" type="text" value="<?= $Bid ?>" class="form-control" readonly>
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
              <input id="Code" name="Code" type="text" class="form-control" readonly value="<?= $Bcode ?>">
              <span class="help-block errorDiv" id="Code_error"></span>

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
              <input value="" id="NameEng" name="NameEng" type="text" class="grpreq form-control" autocomplete="off">
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
              <input value="" id="NameArb" name="NameArb" type="text" class="grpreq form-control" autocomplete="off" dir="rtl">
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
      <button type="button" class="btn btn-block btn-outline-primary" id="cus_area_add_btn" onClick="return save()"><span class="en">Save</span><span class="ar"><?= getArabicTitle('Save') ?></span></button>
    </div>
  </div>
</div>
</form>
<div id="save"></div>

<script>
  $(document).ready(function() {
    var lang = document.getElementById("selected_lang").value;
    changeLanguage(lang);
  });
</script>