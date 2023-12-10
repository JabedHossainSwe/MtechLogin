<?php
session_start();
error_reporting(0);
include("../../config/connection.php");
// include("../../config/functions.php");
include("../../config/main_functions.php");
$lang = $_SESSION['lang'];

//// Fetch BID And Bcode//<br>
$abc = "Select max(Billno) as maxBid from " . dbObject . "SupplierAdvance ";
$myq2 = Run($abc);
$getData = myfetch($myq2);

$Billno = $getData->maxBid + 1;

$getCurrentEmpData = getCurrentEmpData($_SESSION['storeCode']);
$bid = $getCurrentEmpData->BID;
?>
<div class="modal-body" id="modalBody">
  <form id="save_form">
    <div class="row">

      <div class="col-12">
        <div class="row">
          <div class="col-md-3">
            <h4><span class="en">Bill No</span><span class="ar"><?= getArabicTitle('Bill No') ?></span></h4>
          </div>
          <div class="col-md-9">
            <div class="form-group">
              <input id="billNo" name="billNo" type="text" value="<?= $Billno ?>" class="form-control" readonly>
              <span class="help-block errorDiv" id="billNo_error"></span>
            </div>
          </div>
        </div>
      </div>

      <input type="hidden" name="bid" id="bid" value="<?= $Bid ?>">


      <div class="col-12">
        <div class="row">
          <div class="col-md-3">
            <h4><span class="en">Date</span><span class="ar"><?= getArabicTitle('Date') ?></span></h4>
          </div>
          <div class="col-md-9">
            <div class="form-group">
              <input id="bill_date_time" name="bill_date_time" type="date" value="<?= date("Y-m-d") ?>" class="form-control">
              <span class="help-block errorDiv" id="bill_date_time_error"></span>
            </div>
          </div>
        </div>
      </div>

      <div class="col-12">
        <div class="row">
          <div class="col-md-3">
            <h4><span class="en">Supplier</span><span class="ar"><?= getArabicTitle('Supplier') ?></span></h4>
          </div>
          <div class="col-md-9">
            <div class="form-group">
              <select id="supplier_name" name="supplier_name" class="grpreq select2_demo_1 form-control">
              </select>
              <span class="help-block errorDiv" id="supplier_name_error"></span>
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
              <input value="" id="remarks" name="remarks" type="text" class=" form-control" autocomplete="off">
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
              <input id="amount" name="amount" type="text" value="" class="grpreq form-control">
              <span class="help-block errorDiv" id="amount_error"></span>

            </div>
          </div>
        </div>
      </div>

      <div class="col-12">
        <div class="row">
          <div class="col-md-3">
            <h4><span class="en">Select</span><span class="ar"><?= getArabicTitle('Select') ?></span></h4>
          </div>
          <div class="col-md-9">
            <div class="form-group">
              <div>
                <select id="bnkid" name="bnkid" class="select2_demo_1 form-control" tabindex="4" onChange="">
                  <?php
                  $getCurrentEmpData = getCurrentEmpData($_SESSION['storeCode']);
                  $Bid = $getCurrentEmpData->BID;

                  $Bracnhes = Run("exec " . dbObject . "GetPaymentType @bid='$Bid'");
                  while ($getBanks = myfetch($Bracnhes)) {
                    $selected = "";
                  ?>
                    <option value="<?php echo $getBanks->id; ?>" <?php echo $selected; ?>><?php echo $getBanks->snameEng; ?></option>
                  <?php
                  }
                  ?>
                </select>
                <span class="help-block errorDiv" id="bnkid_error"></span>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="col-md-12">
        <div class="i-checks"><label class="">
            <div class="iradio_square-green ">
              <div class="iradio_square-green">
                <input type="checkbox" value="1" class="IsSuppDis" name="IsSuppDis">
              </div>
              <ins class="iCheck-helper"></ins>
            </div>
            <i></i> <span class="en">Save</span><span class="ar"><?= getArabicTitle('Save') ?></span>
          </label>
        </div>
      </div>

      <input type="hidden" name="bid" id="bid" value="<?= $Bid ?>">

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
    $("#supplier_name").select2({
      width: "100%",
      closeOnSelect: true,
      placeholder: "",
      //minimumInputLength: 2,
      ajax: {
        url: "Api/listings/GetSupplierList",
        dataType: "JSON",
        type: "POST",
        data: function(query) {
          // add any default query here
          term: query.terms;
          return query;
        },
        processResults: function(data, params) {
          console.log(data);

          var results = [];
          results.push({
            id: 0,
            text: "Please Select Customer",
          });
          // Tranforms the top-level key of the response object from 'items' to 'results'
          data.data.forEach((e) => {
            // cName = e.CName.toLowerCase();
            // terms = params.term.toLowerCase();
            results.push({
              id: e.Id,
              text: e.CName,
            });
          });
          return {
            results: results,
          };
        },
      },
      templateResult: formatResult,
    });

    function formatResult(d) {
      if (d.loading) {
        return d.text;
      }
      // Creating an option of each id and text
      $d = $("<option/>")
        .attr({
          value: d.value,
        })
        .text(d.text);

      return $d;
    }
  });

  $(document).ready(function() {
    $(".i-checks").iCheck({
      checkboxClass: "icheckbox_square-green",
      radioClass: "iradio_square-green",
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