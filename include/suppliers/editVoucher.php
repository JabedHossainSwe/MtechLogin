<?php
session_start();
error_reporting(0);
include("../../config/connection.php");
// include("../../config/functions.php");
$bid = $_POST['Bid'];
$CCode = $_POST['CCode'];

$qv = "Select * from SupplierFile where CCode = '" . $CCode . "' and bid = '" . $bid . "'";
$q = Run($qv);
$getData = myfetch($q);

?>
<form action="javascript:updateSupplier()" id="save_form" method="post" class="ibox-content  filter_container">

  <input type="number" id="selected_lang" name="selected_lang" value="<?php !empty($_GET['selected_lang']) ? $_GET['selected_lang'] : '1' ?>" hidden>
  <div class="row">

    <div class="col-md-6">
      <div class="row">
        <div class="col-md-3">
          <h4><span class="en">Code</span><span class="ar"><?= getArabicTitle('Code') ?></span></h4>
        </div>

        <div class="col-md-3">
          <div class="form-group">
            <input value="<?php echo $getData->CCode; ?>" id="CCode" name="CCode" type="text" class="grpreq form-control" readonly>
            <input value="<?php echo $getData->Cid; ?>" id="Cid" name="Cid" type="hidden" class="form-control" readonly>
            <span class="help-block errorDiv" id="CCode_error"></span>

          </div>
        </div>

        <div class="col-md-6">
          <button type="button" class="btn btn-success" onclick="reloadVoucher()"><i class="fa fa-refresh"></i></button>

          <?php
          $qt = "select Cid from SupplierFile where Cid = (select max(Cid) from SupplierFile where Cid < '" . $CCode . "' and bid='" . $bid . "' and isDeleted = 0) and bid = '" . $bid . "' and isDeleted = 0";
          $previousQuery = Run($qt);
          $getPreviousId = myfetch($previousQuery)->Cid;
          if ($getPreviousId != '') { ?>
            <button type="button" class="btn btn-success" onclick="editVoucher('<?= $bid ?>','<?= $getPreviousId ?>')"><i class="fa fa-backward"></i></i></button>
          <?php }

          $qt = "select Cid from SupplierFile where Cid = (select max(Cid) from SupplierFile where Cid > '" . $CCode . "' and bid='" . $bid . "' and isDeleted = 0) and bid = '" . $bid . "' and isDeleted = 0";
          $nextQuery = Run($qt);
          $getNextId = myfetch($nextQuery)->Cid;
          if ($getNextId != '') {
          ?>
            <button type="button" class="btn btn-success" onclick="editVoucher('<?= $bid ?>','<?= $getNextId ?>')"><i class="fa fa-forward"></i></i></button>
          <?php } ?>

          <button type="button" class="btn btn-success" onclick="deleteEntry('<?= $CCode ?>')"><i class="fa fa-trash"></i></button>
          <button type="button" class="btn btn-success" onclick="location.reload()"><i class="fa fa-plus"></i></button>

        </div>
      </div>
    </div>


    <div class="col-md-3">
      <div class="row">
        <div class="col-md-4">
          <h4><span class="en">Branch</span><span class="ar"><?= getArabicTitle('Branch') ?></span></h4>
        </div>

        <div class="col-md-8">


          <div>
            <select id="branch" name="bid" class="select2_demo_1 form-control" tabindex="4" required>
              <?php


              if ($_SESSION['isAdmin'] == '1') {
                $Bracnhes = Run("Select * from " . dbObject . "Branch order by BName ASC");
              } else {
                $Bracnhes = Run("Select " . dbObject . "Branch.Bid," . dbObject . "Branch.BName from " . dbObject . "Branch Inner JOIN " . dbObject . "EMP  On " . dbObject . "EMP.BID = " . dbObject . "Branch.Bid where " . dbObject . "EMP.WebCode = '" . $_SESSION['code'] . "' ");
              }




              while ($getBranches = myfetch($Bracnhes)) {
                $selected = "";
                if ($getBranches->Bid == $getData->bid) {
                  $selected = "Selected";
                }


              ?>
                <option value="<?php echo $getBranches->Bid; ?>" <?php echo $selected; ?>><?php echo $getBranches->BName; ?></option>
              <?php
              }

              ?>

            </select>

          </div>
        </div>
      </div>
    </div>
    <div class="col-md-3">
      <div class="row">
        <div class="col-md-4">
          <h4><span class="en">Name </span><span class="ar"><?= getArabicTitle('Name') ?></span></h4>
        </div>
        <div class="col-md-8">
          <div class="form-group">
            <input id="CName" value="<?php echo $getData->CName; ?>" name="CName" type="text" class="grpreq form-control" maxlength="400">
            <span class="help-block errorDiv" id="CName_error"></span>

          </div>
        </div>
      </div>
    </div>
    <div class="col-md-6">
      <div class="row">
        <div class="col-md-4">
          <h4><span class="en">Description</span><span class="ar"><?= getArabicTitle('Description') ?></span>
          </h4>
        </div>
        <div class="col-md-8">
          <div class="form-group">
            <input id="Description" value="<?php echo $getData->Description; ?>" name="Description" type="text" class="grpreq form-control" maxlength="400">
            <span class="help-block errorDiv" id="Description_error"></span>

          </div>
        </div>
      </div>
    </div>
    <div class="col-md-6">
      <div class="row">
        <div class="col-md-4">
          <h4><span class="en">Address</span><span class="ar"><?= getArabicTitle('Address') ?></span></h4>
        </div>
        <div class="col-md-8">
          <div class="form-group">
            <input id="Address" value="<?php echo $getData->Address; ?>" name="Address" type="text" class="grpreq form-control" maxlength="400">
            <span class="help-block errorDiv" id="Address_error"></span>

          </div>
        </div>
      </div>
    </div>

    <div class="col-md-4">
      <div class="row">
        <div class="col-md-4">
          <h4><span class="en">Phone</span><span class="ar"><?= getArabicTitle('Phone') ?></span></h4>
        </div>
        <div class="col-md-8">
          <div class="form-group">
            <input id="Contact1" value="<?php echo $getData->Contact1; ?>" name="Contact1" type="number" class="grpreq form-control" maxlength="400">
            <span class="help-block errorDiv" id="Contact1_error"></span>

          </div>
        </div>
      </div>
    </div>

    <div class="col-md-4">
      <div class="row">
        <div class="col-md-4">
          <h4><span class="en">Mobile</span><span class="ar"><?= getArabicTitle('Mobile') ?></span></h4>
        </div>
        <div class="col-md-8">
          <div class="form-group">
            <input id="Contact2" value="<?php echo $getData->Contact2; ?>" name="Contact2" type="number" class="grpreq form-control" maxlength="400">
            <span class="help-block errorDiv" id="Contact2_error"></span>

          </div>
        </div>
      </div>
    </div>

    <div class="col-md-4">
      <div class="row">
        <div class="col-md-4">
          <h4><span class="en">Fax</span><span class="ar"><?= getArabicTitle('Fax') ?></span></h4>
        </div>
        <div class="col-md-8">
          <div class="form-group">
            <input id="Fax" value="<?php echo $getData->Fax; ?>" name="Fax" type="text" class="form-control" maxlength="100">

          </div>
        </div>
      </div>
    </div>

    <?php
    $OpenBalance = !empty($getData->OpenBalance) ? $getData->OpenBalance : '0';

    ?>
    <div class="col-md-4">
      <div class="row">
        <div class="col-md-4">
          <h4><span class="en">Opening Balance</span><span class="ar"><?= getArabicTitle('Opening Balance') ?></span></h4>
        </div>
        <div class="col-md-8">
          <div class="form-group">
            <input id="OpenBalance" value="<?= $OpenBalance ?>" name="OpenBalance" type="number" class="form-control">

          </div>
        </div>
      </div>
    </div>
    <div class="col-md-4">
      <div class="row">
        <div class="col-md-4">
          <h4><span class="en">Opening Balance Debit</span><span class="ar"><?= getArabicTitle('Opening Balance Debit') ?></span>
          </h4>
        </div>
        <?php
        $openDebit = !empty($getData->openDebit) ? $getData->openDebit : '0';

        ?>
        <div class="col-md-8">
          <div class="form-group">
            <input id="openDebit" value="<?= $openDebit ?>" name="openDebit" type="number" class="form-control">

          </div>
        </div>
      </div>
    </div>
    <div class="col-md-4">
      <div class="row">
        <div class="col-md-4">

          <h4><span class="en">Group</span><span class="ar"><?= getArabicTitle('Group') ?></span></h4>

        </div>
        <div class="col-md-5 pr-0 mr-0">
          <div class="form-group" id="supGroupDiv">
            <select class="select2_demo_1 form-control" id="grpId" name="grpId">
              <option value="">Please Select</option>
              <?php
              $abc = Run("Select * from " . dbObject . "SupplierGroup  order by Gid ASC");
              while ($loadA = myfetch($abc)) {
                $selected = "";
                if ($loadA->Gid == $getData->grpId) {
                  $selected = "Selected";
                }
              ?>
                <option value="<?= $loadA->Gid ?>" <?= $selected ?>><?= $loadA->NameEng ?></option>
              <?php
              }
              ?>
            </select>
            <span class="help-block errorDiv" id="grpId_error"></span>

          </div>
        </div>
        <div class="col-md-3">
          <div class="add_ref_icons d-flex justify-content-around">
            <button onclick="window.open('sup_group.php', '_blank', 'location=yes,height=570,width=600,scrollbars=yes,status=yes');" class="btn btn-info btn-circle" type="button"><i class="fa fa-plus"></i> </button>

            <button onClick="refreshItems('supGroupDiv','grpId','supplier_group')" class="btn btn-warning  btn-circle" type="button"><i class="fa fa-refresh"></i> </button>
          </div>
        </div>
      </div>
    </div>

    <div class="col-md-4">
      <div class="row">
        <div class="col-md-4">
          <h4><span class="en">Dis%</span><span class="ar">%<?= getArabicTitle('Dis') ?></span></h4>
        </div>
        <div class="col-md-8">
          <div class="form-group">
            <input id="disPer" value="<?php echo $getData->disPer ?>" name="disPer" type="number" class="form-control">

          </div>
        </div>
      </div>
    </div>
    <div class="col-md-4">
      <div class="row">
        <div class="col-md-4">
          <h4><span class="en">Due Days</span><span class="ar"><?= getArabicTitle('Due Days') ?></span></h4>
        </div>
        <div class="col-md-8">
          <div class="form-group">
            <input id="PayDays" value="<?php echo $getData->PayDays ?>" name="PayDays" type="text" class="form-control">

          </div>
        </div>
      </div>
    </div>
    <div class="col-md-4">
      <div class="row">
        <div class="col-md-4">
          <h4><span class="en">SalesMan</span><span class="ar"><?= getArabicTitle('SalesMan') ?></span></h4>
        </div>
        <div class="col-md-8">
          <div class="form-group">
            <select class="select2_demo_1 form-select" id="Salesman" name="Salesman">
              <?php
              if ($_SESSION['isAdmin'] == '1') {
                $SalesMan = Run("select  Cid Id,CCode + ' - ' + Cname CName from Emp Where  isnull(IsDeleted,0)=0  order by Cid");
              } else {
                $SalesMan = Run("select  Cid Id,CCode + ' - ' + Cname CName from Emp Where  isnull(IsDeleted,0)=0 and webCode = '" . $_SESSION['code'] . "'  order by Cid");
              }


              while ($getSalesMan = myfetch($SalesMan)) {
                $selected = "";
                if ($getSalesMan->Id == $getData->oempid) {
                  $selected = "Selected";
                }
              ?>
                <option value="<?php echo $getSalesMan->Id; ?>" <?php echo $selected; ?>><?php echo $getSalesMan->CName; ?></option>
              <?php
              }

              ?>
            </select>

          </div>
        </div>
      </div>
    </div>
    <div class="col-md-4">
      <div class="row">
        <div class="col-md-4">
          <h4><span class="en">Vat Number</span><span class="ar"><?= getArabicTitle('Vat Number') ?></span></h4>
        </div>
        <div class="col-md-8">
          <div class="form-group">
            <input id="VatNo" value="<?php echo $getData->VatNo ?>" name="VatNo" type="text" class="form-control" maxlength="20">
          </div>
        </div>
      </div>
    </div>

    <div class="col-md-4">
      <div class="row">
        <div class="col-md-4">
          <h4><span class="en">Lean No</span><span class="ar"><?= getArabicTitle('Lean No') ?></span></h4>
        </div>
        <div class="col-md-8">
          <div class="form-group">
            <input id="NoOfAyan" value="<?php echo $getData->NoOfAyan ?>" name="NoOfAyan" type="text" class="form-control" maxlength="25">
          </div>
        </div>
      </div>
    </div>

    <div class="col-12">
      <div class="row justify-content-center mt-5">
        <div class="col-md-3">
          <button type="button" class="btn btn-block btn-lg btn-outline-danger" onClick="location.reload()"><span class="en">Exit</span><span class="ar"><?= getArabicTitle('Exit') ?></span>
          </button>
        </div>
        <div class="col-md-3">
          <button type="submit" class="btn btn-block btn-lg btn-outline-success" id="seles_report_search" value="Search"><span class="en">Submit</span><span class="ar">يقدم</span>
          </button>
        </div>
      </div>
    </div>
  </div>
</form>

<script src="include/suppliers/supCrud.js"></script>
<script src="include/generic/js.js"></script>
<script>
  $(document).ready(function () {
    var lang = document.getElementById("selected_lang").value;
    changeLanguage(lang);
  });
</script>