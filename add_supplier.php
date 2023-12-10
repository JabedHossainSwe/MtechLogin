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
        <?php include("top-header.php"); ?>

        <div id="page-wrapper" class="gray-bg">
            <?php
            include("sidebar.php");

            ?>
            <div class="row wrapper border-bottom white-bg page-heading pb-2">
                <div class="col-lg-4">
                    <h2 class="font-weight-bold"><span class="en">Suppliers</span><span class="ar"><?= getArabicTitle('Suppliers') ?></span></h2>


                </div>
            </div>
            <div class="wrapper wrapper-content animated fadeInRight">
                <div class="row mb-3">
                    <div class="col-md-6 col-8">
                        <!-- <button type="button" class="btn btn-w-m btn-default eng">English</button>
                        <button type="button" class="btn btn-w-m btn-default ara">Arabic</button> -->
                    </div>
                    <div class="col-md-6 col-4">
                        <a href="suppliers.php" class="btn btn-success btn-actions float-right submit-next mr-1"><span class="en">List Suppliers</span><span class="ar"><?= getArabicTitle('List Suppliers') ?></span></a>
                        <a href="sup_group.php" class="btn btn-success btn-actions float-right submit-next mr-2"> <span class="en">Group</span><span class="ar"><?= getArabicTitle('Group') ?></span></a>
                    </div>

                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="ibox">
                            <div class="ibox-title">
                                <div class="row">
                                    <div class="col-md-12">
                                        <h5 class="mr-4 float-left en">Add Supplier</h5>
                                        <h5 class="mr-4 float-right ar"><?= getArabicTitle('Add Supplier') ?></h5>
                                    </div>

                                </div>

                                <div class="ibox-tools no_envent">
                                    <div id="save"></div>

                                </div>
                            </div>
                            <div id="editVoucher">
                                <form action="javascript:saveSupplier()" id="save_form" method="post" class="ibox-content filter_container">

                                    <input type="number" id="selected_lang" name="selected_lang" value="<?php !empty($_GET['selected_lang']) ? $_GET['selected_lang'] : '1' ?>" hidden>
                                    <div class="row">

                                        <div class="col-md-6">
                                            <div class="row">
                                                <div class="col-md-3">
                                                    <h4><span class="en">Code</span><span class="ar"><?= getArabicTitle('Code') ?></span></h4>
                                                </div>
                                                <?php
                                                $que = 'SELECT TOP (1) CCode from SupplierFile order by Cid desc';
                                                $execute = Run($que);
                                                $getData = myfetch($execute)->CCode + 1;

                                                $bidValue =  GetMainBranch();
                                                if ($_SESSION['isAdmin'] == 0) {
                                                    $bidValue = $userBranch->Bid;
                                                }
                                                ?>
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <input value="<?php echo $getData; ?>" id="CCode" name="CCode" type="text" class="grpreq form-control">
                                                        <span class="help-block errorDiv" id="CCode_error"></span>

                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <button type="button" class="btn btn-success" onclick="reloadVoucher()"><i class="fa fa-refresh"></i></button>


                                                    <?php
                                                    $qt = "select CCode from SupplierFile where CCode = (select max(CCode) from SupplierFile where CCode < '" . $getData . "' and bid='" . $bidValue . "' and isDeleted = 0) and bid = '" . $bidValue . "' and isDeleted = 0";
                                                    $previousQuery = Run($qt);
                                                    $getPreviousId = myfetch($previousQuery)->CCode;
                                                    if ($getPreviousId != '') { ?>
                                                        <button type="button" class="btn btn-success" onclick="editVoucher('<?= $bidValue ?>','<?= $getPreviousId ?>')"><i class="fa fa-backward"></i></i></button>
                                                    <?php } ?>

                                                    <button type="button" class="btn btn-success" onclick="" disabled><i class="fa fa-forward"></i></i></button>
                                                    <button type="button" class="btn btn-success" onclick="" disabled><i class="fa fa-trash"></i></button>
                                                    <button type="button" class="btn btn-success" onclick="" disabled><i class="fa fa-plus"></i></button>

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
                                                        <input id="CName" value="" name="CName" type="text" class="grpreq form-control" maxlength="400">
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
                                                        <input id="Description" value="" name="Description" type="text" class="form-control" dir="rtl" maxlength="400">
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
                                                        <input id="Address" value="" name="Address" type="text" class="form-control" maxlength="400">
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
                                                        <input id="Contact1" value="" name="Contact1" type="number" class="form-control" maxlength="400">
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
                                                        <input id="Contact2" value="" name="Contact2" type="number" class="form-control" maxlength="400">
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
                                                        <input id="Fax" value="" name="Fax" type="text" class="form-control" maxlength="100">

                                                    </div>
                                                </div>
                                            </div>
                                        </div>








                                        <div class="col-md-4">
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <h4><span class="en">Opening Balance</span><span class="ar"><?= getArabicTitle('Opening Balance') ?></span></h4>
                                                </div>
                                                <div class="col-md-8">
                                                    <div class="form-group">
                                                        <input id="OpenBalance" value="0" name="OpenBalance" type="number" class="form-control">

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
                                                <div class="col-md-8">
                                                    <div class="form-group">
                                                        <input id="openDebit" value="" name="openDebit" type="number" class="form-control">

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
                                                        <select class="grpreq select2_demo_1 form-control" id="grpId" name="grpId">
                                                            <option value="">Please Select</option>
                                                            <?php
                                                            $abc = Run("Select * from " . dbObject . "SupplierGroup  order by Gid ASC");
                                                            while ($loadA = myfetch($abc)) {
                                                            ?>
                                                                <option value="<?= $loadA->Gid ?>"><?= $loadA->NameEng ?></option>
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
                                                        <input id="disPer" value="0" name="disPer" type="number" class="form-control">

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
                                                        <input id="PayDays" value="" name="PayDays" type="text" class="form-control">

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
                                                        <input id="VatNo" value="" name="VatNo" type="text" class="form-control" maxlength="20">

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
                                                        <input id="NoOfAyan" value="" name="NoOfAyan" type="text" class="form-control" maxlength="25">

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
                            </div>
                        </div>
                    </div>
                </div>

                <div id="SalesVoucherDiv"></div>

            </div>

            <?php include("footer.php"); ?>
        </div>
    </div>
    </div>
    </div>


</body>

</html>
<script src="include/suppliers/supCrud.js"></script>
<script src="include/generic/js.js"></script>