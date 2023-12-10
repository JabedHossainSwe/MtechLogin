<?php
session_start();
error_reporting(0);
include("../../config/connection.php");

//// Fetch BID And Bcode//<br>
$abc = "Select max(bid) as maxBid from " . dbObject . "BankDeposit ";
$myq2 = Run($abc);
$getData = myfetch($myq2);
$Bid = $getData->maxBid + 1;

?>
<div class="modal-body" id="modalBody">
  <form id="save_form">
    <div class="row">

      <div class="col-6">
        <div class="row">
          <div class="col-md-3">
            <h4><span class="en">Entery No</span><span class="ar"><?= getArabicTitle('Entery No') ?></span></h4>
          </div>
          <div class="col-md-9">
            <div class="form-group">
              <input id="GId" name="GId" type="text" value="<?= $Bid ?>" class="form-control" readonly>
              <span class="help-block errorDiv" id="GId_error"></span>
            </div>
          </div>
        </div>
      </div>
      <div class="col-lg-6">
        <div class="row">
          <div class="col-md-4">
            <h4><span class="en">Date</span><span class="ar"><?= getArabicTitle('Date') ?></span></h4>
          </div>
          <div class="col-md-8">
            <div class="form-group">
              <input value="<?= date("Y-m-d H:i:s") ?>" id="bill_date_time" name="bill_date_time" type="datetime-local" class="form-control">
            </div>
          </div>
        </div>
      </div>
      <div class="col-lg-12">
        <div class="row">
          <div class="col-md-3">
            <h4><span class="en">Banks</span><span class="ar"><?= getArabicTitle('Banks') ?></span></h4>
          </div>
          <div class="col-md-9">
            <div class="form-group">
              <input id="" name="" type="text" class="form-control">
            </div>
          </div>
        </div>
      </div>
      <div class="col-12">
        <div class="row">
          <div class="col-md-3">
            <h4><span class="en">Remarks</span><span class="ar"><?= getArabicTitle('Remarks') ?></span></h4>
          </div>
          <div class="col-md-9">
            <div class="form-group">
              <input id="remarks" name="remarks" type="text" class="form-control">
              <span class="help-block errorDiv" id="remarks_error"></span>

            </div>
          </div>
        </div>
      </div>

      <div class="col-12">
        <div class="row">
          <div class="col-md-3">
            <h4><span class="en">Amount</span><span class="ar"><?= getArabicTitle('Amount') ?></span></h4>
          </div>
          <div class="col-md-9">
            <div class="form-group">
              <input value="" id="amount" name="amount" type="text" class="grpreq form-control" autocomplete="off">
              <span class="help-block errorDiv" id="amount_error"></span>

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
    $(document).ready(function () {
        var lang = document.getElementById("selected_lang").value;
        changeLanguage(lang);
    });
</script>