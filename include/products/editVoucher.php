<?php
session_start();
error_reporting(0);
include("../../config/connection.php");
// include("../../config/functions.php");
$Bid = $_POST['Bid'];
$PCode = $_POST['PCode'];

$productQ = Run("Select * from product where PID = '$PCode' and bidM = '$Bid'");
$getProductMain = myfetch($productQ);
if (empty($getProductMain)) {
  echo "You are Not Allowed To Open This Page";
} else { ?>

<form action="javascript:updateProduct()" id="save_form" method="post" class="ibox-content add_me filter_container">

  <input type="number" id="selected_lang" name="selected_lang" value="<?php !empty($_GET['selected_lang']) ? $_GET['selected_lang'] : '1' ?>" hidden>
  <div class="row">

    <div class="col-md-6">
      <div class="row">
        <div class="col-md-3">
          <h4><span class="en">Code</span><span class="ar"><?= getArabicTitle('Code') ?></span></h4>
        </div>

        <div class="col-md-3">
          <div class="form-group">
            <input value="<?php echo $getProductMain->PCode; ?>" id="PCode" name="PCode" type="text" class="grpreq form-control">
            <input value="<?php echo $getProductMain->PID; ?>" id="PID" name="PID" type="hidden" readonly class="grpreq form-control">
            <span class="help-block errorDiv" id="PCode_error"></span>
            <span class="help-block errorDiv" id="PID_error"></span>
          </div>
        </div>
        <div class="col-md-6">
            <button type="button" class="btn btn-success" onclick="reloadVoucher()"><i class="fa fa-refresh"></i></button>

            <?php
            $qt = "select PID from product where PID = (select max(PID) from product where PID < '" . $PCode . "' and bidM='" . $Bid . "' and isDeleted = 0) and bidM = '" . $Bid . "' and isDeleted = 0";
            $previousQuery = Run($qt);
            $getPreviousId = myfetch($previousQuery)->PID;
            if ($getPreviousId != '') { ?>
                <button type="button" class="btn btn-success" onclick="editVoucher('<?= $Bid ?>','<?= $getPreviousId ?>')"><i class="fa fa-backward"></i></i></button>
            <?php
            }
            // echo $qt = "select PID from product where PID = (select max(PID) from product where PID > '" . $PCode . "' and bidM='" . $Bid . "' and isDeleted = 0) and bidM = '" . $Bid . "' and isDeleted = 0";

            $qt = "select PID from product where PID  > '" . $PCode . "' and bidM='" . $Bid . "' and isDeleted = 0";
            $nextQuery = Run($qt);
            $getNextId = myfetch($nextQuery)->PID;
            if ($getNextId != '') {
            ?>
                <button type="button" class="btn btn-success" onclick="editVoucher('<?= $Bid ?>','<?= $getNextId ?>')"><i class="fa fa-forward"></i></i></button>
            <?php } ?>

            <button type="button" class="btn btn-success" onclick="deleteEntry('<?=$PCode?>')"><i class="fa fa-trash"></i></button>
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
            <select id="bidM" name="bidM" class="grpreq select2_demo_1 form-control" tabindex="4" required>
              <?php


              if ($_SESSION['isAdmin'] == '1') {
                $Bracnhes = Run("Select * from " . dbObject . "Branch order by BName ASC");
              } else {
                $Bracnhes = Run("Select " . dbObject . "Branch.Bid," . dbObject . "Branch.BName from " . dbObject . "Branch Inner JOIN " . dbObject . "EMP  On " . dbObject . "EMP.BID = " . dbObject . "Branch.Bid where " . dbObject . "EMP.WebCode = '" . $_SESSION['code'] . "' ");
              }




              while ($getBranches = myfetch($Bracnhes)) {
                $selected = "";
                if ($getBranches->Bid == $getProductMain->bidN) {
                  $selected = "Selected";

              ?>
                  <option value="<?php echo $getBranches->Bid; ?>" <?php echo $selected; ?>><?php echo $getBranches->BName; ?></option>
              <?php
                }
              }
              ?>

            </select>
            <span class="help-block errorDiv" id="bidM_error"></span>

          </div>
        </div>
      </div>
    </div>
    <div class="col-md-3">
      <div class="row">
        <div class="col-md-4">
          <h4><span class="en">Location</span><span class="ar"><?= getArabicTitle('Location') ?></span></h4>
        </div>
        <div class="col-md-8">
          <div class="form-group">
            <input id="Location" value="<?= $getProductMain->Location ?>" name="Location" type="text" class="form-control" maxlength="400">
            <span class="help-block errorDiv" id="Location_error"></span>

          </div>
        </div>
      </div>
    </div>
    <div class="col-md-4">
      <div class="row">
        <div class="col-md-4">
          <h4><span class="en">Name </span><span class="ar"><?= getArabicTitle('Name') ?></span></h4>
        </div>
        <div class="col-md-8">
          <div class="form-group">
            <input id="PName" value="<?= $getProductMain->PName ?>" name="PName" type="text" class="grpreq form-control" maxlength="400">
            <span class="help-block errorDiv" id="PName_error"></span>

          </div>
        </div>
      </div>
    </div>
    <div class="col-md-4">
      <div class="row">
        <div class="col-md-4">
          <h4><span class="en">Description</span><span class="ar"><?= getArabicTitle('Description') ?></span></h4>
        </div>
        <div class="col-md-8">
          <div class="form-group">
            <input id="Description" value="<?= $getProductMain->Description ?>" name="Description" type="text" class="form-control" maxlength="400">
            <span class="help-block errorDiv" id="Description_error"></span>

          </div>
        </div>
      </div>
    </div>

    <div class="col-md-4">
      <div class="row">
        <div class="col-md-4">

          <h4><span class="en">Opening Qty</span><span class="ar"><?= getArabicTitle('Opening Qty') ?></span></h4>


        </div>
        <div class="col-md-8">
          <div class="form-group">
            <?php
            $qp = "select * from OpenStock where Pid = '" . $getProductMain->PID . "' and uid = '" . $getProductMain->uid . "' and bid = '" . $getProductMain->bidM . "'";
            $bQ = Run($qp);
            $openQty = myfetch($bQ)->Qty;
            ?>
            <input id="OpenQty" name="OpenQty" type="number" class="form-control" maxlength="400" value="<?= $openQty ?>">
            <span class="help-block errorDiv" id="OpenQty_error"></span>

          </div>
        </div>

      </div>
    </div>

    <div class="col-md-4">
      <div class="row">
        <div class="col-md-4">

          <h4><span class="en">Section</span><span class="ar"><?= getArabicTitle('Section') ?></span></h4>


        </div>
        <div class="col-md-5 pr-0 mr-0">
          <div class="form-group" id="SectionIddiv">
            <select class="select2_demo_1 form-control" id="SectionId" name="SectionId">
              <option value="">Please Select</option>
              <?php
              $abc = Run("Select * from " . dbObject . "Sections where isDeleted=0 order by CName ASC");
              while ($loadA = myfetch($abc)) {

                $selected = "";
                if ($loadA->Cid == $getProductMain->SectionId) {
                  $selected = "Selected";
                }
              ?>
                <option value="<?= $loadA->Cid ?>" <?= $selected ?>><?= $loadA->CName ?></option>
              <?php
              }
              ?>
            </select>
            <span class="help-block errorDiv" id="SectionId_error"></span>

          </div>
        </div>
        <div class="col-md-3">
          <div class="add_ref_icons d-flex justify-content-around">
            <button onclick="window.open('sections.php', '_blank', 'location=yes,height=570,width=600,scrollbars=yes,status=yes');" class="btn btn-info btn-circle" type="button"><i class="fa fa-plus"></i> </button>

            <button onClick="refreshItems('SectionIddiv','SectionId','sections')" class="btn btn-warning  btn-circle" type="button"><i class="fa fa-refresh"></i> </button>
          </div>
        </div>
      </div>
    </div>

    <div class="col-md-4">
      <div class="row">
        <div class="col-md-4">

          <h4><span class="en">Product Type</span><span class="ar"><?= getArabicTitle('Product Type') ?></span></h4>


        </div>
        <div class="col-md-5 pr-0 mr-0">
          <div class="form-group" id="ProductTypediv">
            <select class="select2_demo_1 form-control" id="ProductType" name="ProductType">
              <option value="">Please Select</option>
              <?php
              $abc = Run("Select * from " . dbObject . "ProductType where isDeleted=0 order by CName ASC");
              while ($loadA = myfetch($abc)) {
                $selected = "";
                if ($loadA->Cid == $getProductMain->ProductType) {
                  $selected = "Selected";
                }
              ?>
                <option value="<?= $loadA->Cid ?>" <?= $selected ?>><?= $loadA->CCode ?>- <?= $loadA->CName ?></option>
              <?php
              }
              ?>
            </select>
            <span class="help-block errorDiv" id="ProductType_error"></span>

          </div>
        </div>
        <div class="col-md-3">
          <div class="add_ref_icons d-flex justify-content-around">
            <button onclick="window.open('product_type.php', '_blank', 'location=yes,height=570,width=600,scrollbars=yes,status=yes');" class="btn btn-info btn-circle" type="button"><i class="fa fa-plus"></i> </button>

            <button onClick="refreshItems('ProductTypediv','ProductType','ProductType')" class="btn btn-warning  btn-circle" type="button"><i class="fa fa-refresh"></i> </button>
          </div>
        </div>
      </div>
    </div>



    <div class="col-md-4">
      <div class="row">
        <div class="col-md-4">

          <h4><span class="en">Supplier</span><span class="ar"><?= getArabicTitle('Supplier') ?></span></h4>


        </div>
        <div class="col-md-5 pr-0 mr-0">
          <div class="form-group" id="suppiddiv">
            <select class="select2_demo_1 form-control" id="suppid" name="suppid">
              <option value="">Please Select</option>
              <?php
              $abc = Run("Select * from " . dbObject . "SupplierFile where isDeleted=0 order by CName ASC");
              while ($loadA = myfetch($abc)) {
                $selected = "";
                if ($loadA->Cid == $getProductMain->suppid) {
                  $selected = "Selected";
                }
              ?>
                <option value="<?= $loadA->Cid ?>" <?= $selected ?>><?= $loadA->CCode ?>- <?= $loadA->CName ?></option>
              <?php
              }
              ?>
            </select>
            <span class="help-block errorDiv" id="suppid_error"></span>

          </div>
        </div>
        <div class="col-md-3">
          <div class="add_ref_icons d-flex justify-content-around">
            <button onclick="window.open('suppliers.php', '_blank', 'location=yes,height=570,width=600,scrollbars=yes,status=yes');" class="btn btn-info btn-circle" type="button"><i class="fa fa-plus"></i> </button>

            <button onClick="refreshItems('suppiddiv','suppid','suppid')" class="btn btn-warning  btn-circle" type="button"><i class="fa fa-refresh"></i> </button>
          </div>
        </div>
      </div>
    </div>


    <div class="col-md-4">
      <div class="row">
        <div class="col-md-4">

          <h4><span class="en">Offer Group</span><span class="ar"><?= getArabicTitle('Offer Group') ?></span></h4>


        </div>
        <div class="col-md-5 pr-0 mr-0">
          <div class="form-group" id="offerGrpIddiv">
            <select class="select2_demo_1 form-control" id="offerGrpId" name="offerGrpId">
              <option value="">Please Select</option>
              <?php
              $abc = Run("Select * from " . dbObject . "OfferProductGroup order by NameEng ASC");
              while ($loadA = myfetch($abc)) {
                $selected = "";
                if ($loadA->Gid == $getProductMain->offerGrpId) {
                  $selected = "Selected";
                }
              ?>
                <option value="<?= $loadA->Gid ?>" <?= $selected ?>><?= $loadA->Code ?>- <?= $loadA->NameEng ?></option>
              <?php
              }
              ?>
            </select>
            <span class="help-block errorDiv" id="offerGrpId_error"></span>

          </div>
        </div>
        <div class="col-md-3">
          <div class="add_ref_icons d-flex justify-content-around">
            <button onclick="window.open('product_offer_group.php', '_blank', 'location=yes,height=570,width=600,scrollbars=yes,status=yes');" class="btn btn-info btn-circle" type="button"><i class="fa fa-plus"></i> </button>

            <button onClick="refreshItems('offerGrpIddiv','offerGrpId','offerGrpId')" class="btn btn-warning  btn-circle" type="button"><i class="fa fa-refresh"></i> </button>
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
          <div class=" form-group" id="PGIDdiv">
            <select class="grpreq select2_demo_1 form-control" id="PGID" name="PGID">
              <option value="">Please Select</option>
              <?php
              $abc = Run("Select * from " . dbObject . "ProductGroup where isDeleted=0 order by NameEng ASC");
              while ($loadA = myfetch($abc)) {
                $selected = "";
                if ($loadA->Gid == $getProductMain->PGID) {
                  $selected = "Selected";
                }
              ?>
                <option value="<?= $loadA->Gid ?>" <?= $selected ?>><?= $loadA->Code ?>- <?= $loadA->NameEng ?></option>
              <?php
              }
              ?>
            </select>
            <span class="help-block errorDiv" id="PGID_error"></span>

          </div>
        </div>
        <div class="col-md-3">
          <div class="add_ref_icons d-flex justify-content-around">
            <button onclick="window.open('product_group.php', '_blank', 'location=yes,height=570,width=600,scrollbars=yes,status=yes');" class="btn btn-info btn-circle" type="button"><i class="fa fa-plus"></i> </button>

            <button onClick="refreshItems('PGIDdiv','PGID','PGID')" class="btn btn-warning  btn-circle" type="button"><i class="fa fa-refresh"></i> </button>
          </div>
        </div>
      </div>
    </div>

    <div class="col-md-4">
      <div class="row">
        <div class="col-md-4">

          <h4><span class="en">Unit</span><span class="ar"><?= getArabicTitle('Unit') ?></span></h4>

        </div>
        <div class="col-md-5 pr-0 mr-0">
          <div class="form-group" id="uiddiv">
            <select class="grpreq select2_demo_1 form-control" id="uid" name="uid">
              <?php
              $abc = Run("Select * from " . dbObject . "Units where isDeleted=0 and (ParentParaID is NUll Or ParentParaID = 0) order by ParaName ASC");
              while ($loadA = myfetch($abc)) {
                $selected = "";
                if ($loadA->ParaID == $getProductMain->uid) {
                  $selected = "Selected";

              ?>
                  <option value="<?= $loadA->ParaID ?>" <?= $selected ?>><?= $loadA->ParaCode ?>- <?= $loadA->ParaName ?></option>
              <?php
                }
              }
              ?>
            </select>
            <span class="help-block errorDiv" id="uid_error"></span>
          </div>
        </div>
        <div class="col-md-3"></div>
      </div>
    </div>

    <div class="col-md-4 toggle_groupbytype">
      <div class="row">
        <div class="col-md-4">
          <h4><span class="en">IsVat</span><span class="ar"><?= getArabicTitle('IsVat') ?></span></h4>

        </div>
        <div class="col-md-8">
          <div class="form-group">
            <input type="checkbox" class="form-control" value="1" id="isVat" name="isVat" <?php if ($getProductMain->IsVat == '1') {echo "Checked";} ?>>
          </div>
        </div>

      </div>
    </div>

    <div class="col-md-4">
      <div class="row">
        <div class="col-md-4">
          <h4><span class="en">VatPer</span><span class="ar"><?= getArabicTitle('VatPer') ?></span></h4>
        </div>
        <div class="col-md-8">
          <div class="form-group">
            <input id="vatPer" value="<?= $getProductMain->vatPer ?>" name="vatPer" type="text" class="grpreq form-control" maxlength="400" readonly>
            <span class="help-block errorDiv" id="vatPer_error"></span>
          </div>
        </div>
      </div>
    </div>

    <div class="col-md-12" id="loadUnitsGrid">
      <?php
      $counter = 1;
      ?>
      <div class="table-responsive">
        <table class="table table-striped table-bordered table-hover dataTables-example">
          <thead>
            <tr id="<?= $counter ?>">
              <th><span class="en">Unit</span><span class="ar"><?= getArabicTitle('Unit') ?></span></th>
              <th><span class="en">CostPrice</span><span class="ar"><?= getArabicTitle('CostPrice') ?></span></th>
              <th><span class="en">Sale Price</span><span class="ar"><?= getArabicTitle('Sale Price') ?></span></th>
              <th><span class="en">Least Sale Price</span><span class="ar"><?= getArabicTitle('Least Sale Price') ?></span></th>
              <th><span class="en">Purchase Price</span><span class="ar"><?= getArabicTitle('Purchase Price') ?></span></th>
              <th><span class="en">Vat Sale Price</span><span class="ar"><?= getArabicTitle('Vat Sale Price') ?></span></th>
              <th><span class="en">Actions</span><span class="ar"><?= getArabicTitle('Actions') ?></span></th>
            </tr>
          </thead>
          <tbody>
            <?php
            $qq = "Select * from ProductPriceCode where Pid = '" . $getProductMain->PID . "' and bid = '" . $getProductMain->bidN . "'";
            $query2 = Run($qq);
            $counter = 1;
            while ($getRec = myfetch($query2)) {
            ?>
              <tr class="gradeX">
                <td>
                  <input type="hidden" id="uid<?= $counter ?>" name="uid<?= $counter ?>" value="<?= $getRec->Uid ?>">
                  <?= getProductUnitDetails($getRec->Uid)->ParaName ?>
                </td>
                <td><input type="text" id="CostPrice<?= $counter ?>" name="CostPrice<?= $counter ?>" value="<?= $getRec->CostPrice ?>" class="form-control"></td>
                <td><input type="text" id="SPrice<?= $counter ?>" name="SPrice<?= $counter ?>" value="<?= $getRec->SPrice ?>" onKeyUp="calculatevatValueSP('<?= $counter ?>')" class="form-control"></td>
                <td><input type="text" id="LSPrice<?= $counter ?>" name="LSPrice<?= $counter ?>" value="<?= $getRec->level2 ?>" class="form-control"></td>
                <td><input type="text" id="PPrice<?= $counter ?>" name="PPrice<?= $counter ?>" value="<?= $getRec->level3 ?>" class="form-control"></td>
                <td><input type="text" id="vatValueSP<?= $counter ?>" name="vatValueSP<?= $counter ?>" readonly value="<?= $getRec->vatSPrice ?>" class="form-control"></td>

                </td>
                <td></td>

              </tr>
            <?php
              $counter++;
            }
            ?>

            <input type="hidden" id="nrows" name="nrows" value="<?= $counter ?>">
          </tbody>
        </table>
        <table class="table table-striped table-bordered table-hover dataTables-example">
          <tbody id="loadSubUnits">

          </tbody>
        </table>
      </div>
    </div>

    <div class="col-12">
      <div class="row justify-content-center mt-5">
        <div class="col-md-3">
          <button type="button" class="btn btn-block btn-lg btn-danger" onClick="location.reload()"><span class="en">Exit</span><span class="ar"><?= getArabicTitle('Exit') ?></span>
          </button>
        </div>
        <div class="col-md-3">
          <button type="submit" class="btn btn-block btn-lg btn-success" id="seles_report_search" value="Search"><span class="en">Submit</span><span class="ar">يقدم</span>
          </button>
        </div>
      </div>
    </div>
  </div>
</form>

<?php } ?>

<script src="js.js"></script>
<script src="../generic/js.js"></script>
<script>
	$(document).ready(function() {
		$("#branch").select2({
			width: '100%',
			closeOnSelect: true,
		});

		$("#SectionId").select2({
			width: '100%',
			closeOnSelect: true,
		});

		$("#ProductType").select2({
			width: '100%',
			closeOnSelect: true,
		});

		$("#suppid").select2({
			width: '100%',
			closeOnSelect: true,
		});

		$("#PGID").select2({
			width: '100%',
			closeOnSelect: true,
		});

		$("#offerGrpId").select2({
			width: '100%',
			closeOnSelect: true,
		});

		$("#uid").select2({
			width: '100%',
			closeOnSelect: true,
		});
	});
</script>

<script>
    $(document).ready(function () {
      var lang = document.getElementById("selected_lang").value;
      changeLanguage(lang);
    });
</script>