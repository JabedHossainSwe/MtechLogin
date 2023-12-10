<?php
session_start();
$lang = $_SESSION['lang'];
?>
<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0,target-densitydpi=device-dpi, user-scalable=no" />


    <title>Dashboard</title>

    <link href="assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/font-awesome/css/font-awesome.css" rel="stylesheet">
    <link href="assets/css/animate.css" rel="stylesheet">
    <link href="assets/css/style.css" rel="stylesheet">
    <!-- Data Table -->
    <link href="assets/css/plugins/dataTables/datatables.min.css" rel="stylesheet">
    <!-- Date  -->
    <link href="assets/css/plugins/datapicker/datepicker3.css" rel="stylesheet">
    <link href="assets/css/plugins/iCheck/custom.css" rel="stylesheet">
    <!-- Clock  -->
    <link href="assets/css/plugins/clockpicker/clockpicker.css" rel="stylesheet">
    <!-- Chosen -->
    <link href="assets/css/plugins/chosen/bootstrap-chosen.css" rel="stylesheet">
    <!-- Toastr style -->
    <link href="assets/css/plugins/toastr/toastr.min.css" rel="stylesheet">
    <!-- Select 2 -->
    <link href="assets/css/plugins/select2/select2.min.css" rel="stylesheet">
    <!-- Swithcer -->
    <link href="assets/css/plugins/switchery/switchery.css" rel="stylesheet">
    <!-- Animate Css -->
    <link href="assets/css/animate.css" rel="stylesheet">
    <link href="assets/css/custom.css" rel="stylesheet">
    <style>
        .direction {
            <?php if ($lang == 1) {
                echo " direction: ltr;";
            } else {
                echo "direction: rtl;";
            } ?>
        }

        .direction-ltr {
            direction: ltr !important;
        }

        .direction-rtl {
            direction: rtl !important;
        }
    </style>
</head>

<body class="pace-done mini-navbar">

    <div id="wrapper" class="direction">
        <?php
        include("top-header.php");

        ?>


        <div id="page-wrapper" class="gray-bg">
            <?php
            include("sidebar.php");

            ?>
            <div class="row wrapper border-bottom white-bg page-heading pb-2">
                <div class="col-lg-12">
                    <h2 class="font-weight-bold en float-left">Products</h2>
                    <h2 class="font-weight-bold ar float-right"><?= getArabicTitle('Products') ?></h2>
                </div>
            </div>
            <div class="wrapper wrapper-content animated fadeInRight">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="ibox">
                            <div class="ibox-title">
                                <div class="row">
                                    <div class="col-md-12">
                                        <h5 class="mr-4"><span class="en">Add Product</span><span class="ar"><?= getArabicTitle('Add Product') ?></span></h5>
                                    </div>

                                </div>

                                <div class="ibox-tools no_envent">
                                    <div id="save"></div>

                                </div>
                            </div>
                            <div id="editVoucher">
                                <form action="javascript:saveProduct()" id="save_form" method="post" class="ibox-content filter_container">

                                    <input type="number" id="selected_lang" name="selected_lang" value="<?php !empty($_GET['selected_lang']) ? $_GET['selected_lang'] : '1' ?>" hidden>
                                    <div class="row">

                                        <div class="col-md-4">
                                            <div class="row">
                                                <div class="col-md-3">
                                                    <h4><span class="en">Code</span><span class="ar"><?= getArabicTitle('Code') ?></span></h4>
                                                </div>
                                                <?php
                                                $que = 'SELECT TOP (1) PCode from Product order by PID desc';
                                                $execute = Run($que);
                                                $getData = myfetch($execute)->PCode + 1;

                                                $bidValue =  GetMainBranch();
                                                if ($_SESSION['isAdmin'] == 0) {
                                                    $bidValue = $userBranch->Bid;
                                                }
                                                ?>
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <input value="<?php echo $getData; ?>" id="PCode" name="PCode" type="number" class="grpreq form-control">
                                                        <span class="help-block errorDiv" id="PCode_error"></span>

                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <button type="button" class="btn btn-success" onclick="reloadVoucher()"><i class="fa fa-refresh"></i></button>


                                                    <?php
                                                    $qt = "select PID from product where PID = (select max(PID) from product where PID < '" . $getData . "' and bidN='" . $bidValue . "' and isDeleted = 0) and bidN = '" . $bidValue . "' and isDeleted = 0";
                                                    $previousQuery = Run($qt);
                                                    $getPreviousId = myfetch($previousQuery)->PID;
                                                    if ($getPreviousId != '') { ?>
                                                        <button type="button" class="btn btn-success" onclick="editVoucher('<?= $bidValue ?>','<?= $getPreviousId ?>')"><i class="fa fa-backward"></i></i></button>
                                                    <?php } ?>

                                                    <button type="button" class="btn btn-success" onclick="" disabled><i class="fa fa-forward"></i></i></button>
                                                    <button type="button" class="btn btn-success" onclick="" disabled><i class="fa fa-trash"></i></button>
                                                    <button type="button" class="btn btn-success" onclick="" disabled><i class="fa fa-plus"></i></button>

                                                </div>
                                            </div>
                                        </div>


                                        <div class="col-md-4">
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
                                                                if ($_GET['branc'] != '') {
                                                                    if ($getBranches->ismain == '1') {
                                                                        $selected = "Selected";
                                                                    }
                                                                }
                                                            ?>
                                                                <option value="<?php echo $getBranches->Bid; ?>" <?php echo $selected; ?>><?php echo $getBranches->BName; ?></option>
                                                            <?php
                                                            }

                                                            ?>

                                                        </select>
                                                        <span class="help-block errorDiv" id="bidM_error"></span>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <h4><span class="en">Location</span><span class="ar"><?= getArabicTitle('Location') ?></span></h4>
                                                </div>
                                                <div class="col-md-8">
                                                    <div class="form-group">
                                                        <input id="Location" value="" name="Location" type="text" class="form-control" maxlength="400">
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
                                                        <input id="PName" value="" name="PName" type="text" class="grpreq form-control" maxlength="400">
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
                                                        <input id="Description" value="" name="Description" type="text" class="form-control" maxlength="400">
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
                                                        <input id="OpenQty" name="OpenQty" type="number" class="form-control" maxlength="400">
                                                        <span class="help-block errorDiv" id="OpenQty_error"></span>

                                                    </div>
                                                </div>

                                            </div>
                                        </div>

                                        <div class="col-md-4" style="display: none;">
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
                                                            ?>
                                                                <option value="<?= $loadA->Cid ?>"><?= $loadA->CName ?></option>
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
                                                            ?>
                                                                <option value="<?= $loadA->Cid ?>"><?= $loadA->CCode ?>- <?= $loadA->CName ?></option>
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
                                                            ?>
                                                                <option value="<?= $loadA->Cid ?>"><?= $loadA->CCode ?>- <?= $loadA->CName ?></option>
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


                                        <div class="col-md-4" style="display: none;">
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
                                                            ?>
                                                                <option value="<?= $loadA->Gid ?>"><?= $loadA->Code ?>- <?= $loadA->NameEng ?></option>
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

                                                                $query = Run("Select isnull(count(maingid),0) as tlo from ProductGroup where  maingid = '" . $loadA->Gid . "'");
                                                                $geCount = myfetch($query)->tlo;
                                                                if ($geCount == 0) { ?>
                                                                    <option value="<?= $loadA->Gid ?>"><?= $loadA->Code ?>- <?= $loadA->NameEng ?></option>
                                                                <?php }
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
                                                        <select class="grpreq select2_demo_1 form-control" id="uid" name="uid" onChange="loadUnitsGrid(this.value);">
                                                            <option value="">Please Select</option>
                                                            <?php
                                                            $abc = Run("Select * from " . dbObject . "Units where isDeleted=0 and (ParentParaID is NUll Or ParentParaID = 0) order by ParaName ASC");
                                                            while ($loadA = myfetch($abc)) {
                                                            ?>
                                                                <option value="<?= $loadA->ParaID ?>"><?= $loadA->ParaCode ?>- <?= $loadA->ParaName ?></option>
                                                            <?php
                                                            }
                                                            ?>
                                                        </select>
                                                        <span class="help-block errorDiv" id="uid_error"></span>

                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="add_ref_icons d-flex justify-content-around">
                                                        <button onclick="window.open('product_unit.php', '_blank', 'location=yes,height=570,width=600,scrollbars=yes,status=yes');" class="btn btn-info btn-circle" type="button"><i class="fa fa-plus"></i> </button>

                                                        <button onClick="refreshItems('uiddiv','uid','uid')" class="btn btn-warning  btn-circle" type="button"><i class="fa fa-refresh"></i> </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>


                                        <div class="col-md-4 toggle_groupbytype">
                                            <div class="row">
                                                <div class="col-md-4">

                                                    <h4><span class="en">IsVat</span><span class="ar"><?= getArabicTitle('IsVat') ?></span></h4>


                                                </div>
                                                <div class="col-md-8">
                                                    <div class="form-group">
                                                        <input type="checkbox" class="form-control" value="1" id="isVat" name="isVat">
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
                                                        <input id="vatPer" value="15" name="vatPer" type="text" class="grpreq form-control" maxlength="400" readonly>
                                                        <span class="help-block errorDiv" id="vatPer_error"></span>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-12" id="loadUnitsGrid">


                                        </div>




                                        <div class="col-12 row justify-content-center mt-5">
                                            <div class="col-md-2">
                                                <button type="button" class="btn btn-block btn-lg btn-outline-danger" onClick="location.reload()"><span class="en">Exit</span><span class="ar">خروج</span>
                                                </button>
                                            </div>
                                            <div class="col-md-2">
                                                <button type="submit" class="btn btn-block btn-lg btn-outline-success" id="seles_report_search" value="Search"><span class="en">Submit</span><span class="ar">يقدم</span>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div id="SalesVoucherDiv"></div>

            <?php
            include("footer.php");
            ?>
        </div>
    </div>
    </div>
    </div>


</body>

</html>
<script src="include/products/js.js"></script>
<script src="include/generic/js.js"></script>
<script>
    $(document).ready(function() {
        $("#bidM").select2({
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