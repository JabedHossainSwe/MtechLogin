<?php
session_start();
error_reporting(0);
include("../../config/connection.php");
// include("../../config/functions.php");

//// Fetch BID And Bcode//<br>
$abc = "Select max(CurrencyID) as maxBid from " . dbObject . "Currency ";
$myq2 = Run($abc);
$getData = myfetch($myq2);
$idx = $getData->maxBid + 1;


?>
<div class="modal-body" id="modalBody">
  <form id="save_form">
    <div class="row">

      <div class="col-12">
        <div class="row">
          <div class="col-md-3">
            <h4><span class="en">ID</span><span class="ar"><?= getArabicTitle('ID') ?></span></h4>
          </div>
          <div class="col-md-9">
            <div class="form-group">
              <input id="CurrencyID" name="CurrencyID" type="text" value="<?= $idx ?>" class="form-control" readonly>
              <span class="help-block errorDiv" id="CurrencyID_error"></span>

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
              <input id="CurrencyName" name="CurrencyName" type="text" class="grepreq form-control" value="">
              <span class="help-block errorDiv" id="CurrencyName_error"></span>

            </div>
          </div>
        </div>
      </div>

      <div class="col-12">
        <div class="row">
          <div class="col-md-3">
            <h4><span class="en">Rate</span><span class="ar"><?= getArabicTitle('Rate') ?></span></h4>
          </div>
          <div class="col-md-9">
            <div class="form-group">
              <input value="" id="CurrencyRate" name="CurrencyRate" type="text" class="grpreq form-control" autocomplete="off">
              <span class="help-block errorDiv" id="CurrencyRate_error"></span>

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
      <button type="button" class="btn btn-block btn-outline-primary" id="currency_add_btn" onClick="return save()"><span class="en">Save</span><span class="ar"><?= getArabicTitle('Save') ?></span></button>
    </div>
  </div>
</div>
</form>
<div id="save"></div>

<script>
  $(document).ready(function () {
    var lang = document.getElementById("selected_lang").value;
    changeLanguage(lang);
  });
</script>