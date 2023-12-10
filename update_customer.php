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
            $CCode = $_GET['CCode'];
            $bid = $_GET['bid'];
            $qv = "Select * from CustFile where CCode = '" . $CCode . "' and bid = '" . $bid . "'";
            $q = Run($qv);
            $getData = myfetch($q);
            ?>
            <div class="row wrapper border-bottom white-bg page-heading pb-2">
                <!-- <div class="col-lg-10"> -->
					<h2 class="font-weight-bold"><span class="en float-left">Customers</span><span class="ar float-right"><?= getArabicTitle('Customers') ?></span></h2>

                <!-- </div> -->
            </div>
            <div class="wrapper wrapper-content animated fadeInRight">
                <!-- <div class="row mb-1">
                    <div class="col-md-6 col-8">
                        <button type="button" class="btn btn-w-m btn-default eng">English</button>
                        <button type="button" class="btn btn-w-m btn-default ara">Arabic</button>
                    </div>
                    <div class="col-md-6 col-4">

                    </div>

                </div> -->
                <div class="row mb-1">
                    <div class="col-12">
                        <a href="customer.php" class="btn btn-success btn-actions float-right submit-next" style="margin-right: 20px;"><span class="en">List Customers</span><span class="ar"><?= getArabicTitle('List Customers') ?></span></a>
                        <a href="customer_area.php" class="btn btn-success btn-actions float-right submit-next" style="margin-right: 20px;"><span class="en">Area</span><span class="ar"><?= getArabicTitle('Area') ?></span> </a>
                        <a href="currency.php" class="btn btn-success btn-actions float-right submit-next" style="margin-right: 20px;"><span class="en">Currency</span><span class="ar"><?= getArabicTitle('Currency') ?></span></a>
                    </div>

                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="ibox">
                            <div class="ibox-title">
                                <div class="row">
                                    <!-- <div class="col-md-9"> -->
                                        <h5 class="mr-4"><span class="en float-left">Add Customer</span><span class="ar float-right"><?= getArabicTitle('Add Customer') ?></span></h5>
                                    <!-- </div> -->

                                </div>

                                <div class="ibox-tools no_envent">
                                    <div id="save"></div>

                                </div>
                            </div>
                            <form action="javascript:updateCustomer()" id="save_form" method="post" class="ibox-content filter_container">

                                <input type="number" id="selected_lang" name="selected_lang" value="<?php !empty($_GET['selected_lang']) ? $_GET['selected_lang'] : '1' ?>" hidden>
                                <div class="row">

                                    <div class="col-md-4">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <h4><span class="en">Code</span><span class="ar"><?= getArabicTitle('Code') ?></span></h4>
                                            </div>

                                            <div class="col-md-8">
                                                <div class="form-group">
                                                    <input value="<?php echo $getData->CCode; ?>" id="CCode" name="CCode" type="text" class="grpreq form-control" readonly>
                                                    <input value="<?php echo $getData->Cid; ?>" id="Cid" name="Cid" type="hidden" class="form-control" readonly>
                                                    <span class="help-block errorDiv" id="CCode_error"></span>

                                                </div>
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
                                                    <select id="branch" name="bid" class="select2_demo_1 form-control" tabindex="4" required>
                                                        <?php


                                                        if ($_SESSION['isAdmin'] == '1') {
                                                            $Bracnhes = Run("Select * from " . dbObject . "Branch order by BName ASC");
                                                        } else {
                                                            $Bracnhes = Run("Select " . dbObject . "Branch.Bid," . dbObject . "Branch.BName from " . dbObject . "Branch
Inner JOIN " . dbObject . "EMP  On " . dbObject . "EMP.BID = " . dbObject . "Branch.Bid
where " . dbObject . "EMP.WebCode = '" . $_SESSION['code'] . "' ");
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
                                    <div class="col-md-4">
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
                                            </div>
                                            <div class="col-md-8">
                                                <div class="form-group">
                                                    <input id="Description" value="<?php echo $getData->Description; ?>" name="Description" type="text" class="form-control" maxlength="400">
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
                                                    <input id="Address" value="<?php echo $getData->Address; ?>" name="Address" type="text" class="form-control" maxlength="400">
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
                                                    <input id="Contact1" value="<?php echo $getData->Contact1; ?>" name="Contact1" type="number" class="form-control" maxlength="400">
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
                                                    <input id="Contact2" value="<?php echo $getData->Contact2; ?>" name="Contact2" type="number" class="form-control" maxlength="400">
                                                    <span class="help-block errorDiv" id="Contact2_error"></span>

                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <h4><span class="en">CR Number</span><span class="ar"><?= getArabicTitle('CR Number') ?></span></h4>
                                            </div>
                                            <div class="col-md-8">
                                                <div class="form-group">
                                                    <input id="CRNo" value="<?php echo $getData->CRNo; ?>" name="CRNo" type="number" class="form-control" maxlength="25">

                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <h4><span class="en">Nan Reg Add</span><span class="ar"><?= getArabicTitle('Nan Reg Add') ?></span></h4>
                                            </div>
                                            <div class="col-md-8">
                                                <div class="form-group">
                                                    <input id="NANRegAdd" value="<?php echo $getData->NANRegAdd; ?>" name="NANRegAdd" type="text" class="form-control" maxlength="255">

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


                                    <div class="col-md-4">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <h4><span class="en">Size</span><span class="ar"><?= getArabicTitle('Size') ?></span></h4>
                                            </div>
                                            <div class="col-md-8">
                                                <div class="form-group">
                                                    <input id="sSize" value="<?php echo $getData->sSize; ?>" name="sSize" type="text" class="form-control" maxlength="10">

                                                </div>
                                            </div>
                                        </div>
                                    </div>


                                    <div class="col-md-4">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <h4><span class="en">Email</span><span class="ar"><?= getArabicTitle('Email') ?></span></h4>
                                            </div>
                                            <div class="col-md-8">
                                                <div class="form-group">
                                                    <input id="Email" value="<?php echo $getData->Email; ?>" name="Email" type="email" class=" form-control" maxlength="100">
                                                    <span class="help-block errorDiv" id="Email_error"></span>

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
                                                <h4><span class="en">Opening Balance Debit</span><span class="ar"><?= getArabicTitle('Opening Balance Debit') ?></span></h4>
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

                                                <h4><span class="en">Cust Area</span><span class="ar"><?= getArabicTitle('Cust Area') ?></span></h4>


                                            </div>
                                            <div class="col-md-5 pr-0 mr-0">
                                                <div class="form-group" id="custAreadiv">
                                                    <select class="grpreq select2_demo_1 form-control" id="custAreaId" name="custAreaId">
                                                        <option value="">Please Select</option>
                                                        <?php
                                                        $abc = Run("Select * from " . dbObject . "CustArea order by NameEng ASC");
                                                        while ($loadA = myfetch($abc)) {
                                                            $selected = "";
                                                            if ($loadA->GId == $getData->custAreaId) {
                                                                $selected = "Selected";
                                                            }
                                                        ?>
                                                            <option value="<?= $loadA->GId ?>" <?= $selected ?>><?= $loadA->NameEng ?></option>
                                                        <?php
                                                        }
                                                        ?>
                                                    </select>
                                                    <span class="help-block errorDiv" id="custAreaId_error"></span>

                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="add_ref_icons d-flex justify-content-around">
                                                    <button onclick="window.open('customer_area.php', '_blank', 'location=yes,height=570,width=600,scrollbars=yes,status=yes');" class="btn btn-info btn-circle" type="button"><i class="fa fa-plus"></i> </button>

                                                    <button onClick="refreshItems('custAreadiv','custAreaId','customer_area')" class="btn btn-warning  btn-circle" type="button"><i class="fa fa-refresh"></i> </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <h4><span class="en">Customer Dis%</span><span class="ar"><?= getArabicTitle('Customer Dis') ?></span></h4>
                                            </div>
                                            <div class="col-md-8">
                                                <?php
                                                $custDisPer = !empty($getData->custDisPer) ? $getData->custDisPer : '0';

                                                ?>
                                                <div class="form-group">
                                                    <input id="custDisPer" value="<?= $custDisPer ?>" name="custDisPer" type="number" class="form-control">

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <h4><span class="en">Credit Days</span><span class="ar"><?= getArabicTitle('Credit Days') ?></span></h4>
                                            </div>
                                            <?php
                                            $CreditLimit = !empty($getData->CreditLimit) ? $getData->CreditLimit : '0';

                                            ?>
                                            <div class="col-md-8">
                                                <div class="form-group">
                                                    <input id="CreditDays" value="<?= $CreditLimit ?>" name="CreditDays" type="text" class="form-control">

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
                                                            if ($getSalesMan->Id == $getData->Salesman) {
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
                                                <h4><span class="en">Building No</span><span class="ar"><?= getArabicTitle('Building No') ?></span></h4>
                                            </div>
                                            <div class="col-md-8">
                                                <div class="form-group">
                                                    <input id="BuildNo" value="<?php echo $getData->BuildNo ?>" name="BuildNo" type="text" class="form-control" maxlength="25">

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <h4><span class="en">Street Name</span><span class="ar"><?= getArabicTitle('Street Name') ?></span></h4>
                                            </div>
                                            <div class="col-md-8">
                                                <div class="form-group">
                                                    <input id="StreetName" value="<?php echo $getData->StreetName ?>" name="StreetName" type="text" class="form-control" maxlength="50">

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <h4><span class="en">District</span><span class="ar"><?= getArabicTitle('District') ?></span></h4>
                                            </div>
                                            <div class="col-md-8">
                                                <div class="form-group">
                                                    <input id="District" value="<?php echo $getData->District ?>" name="District" type="text" class="form-control" maxlength="50">

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <h4><span class="en">City</span><span class="ar"><?= getArabicTitle('City') ?></span></h4>
                                            </div>
                                            <div class="col-md-8">
                                                <div class="form-group">
                                                    <input id="CityN" value="<?php echo $getData->CityN ?>" name="CityN" type="text" class="form-control" maxlength="50">

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <h4><span class="en">Country</span><span class="ar"><?= getArabicTitle('Country') ?></span></h4>
                                            </div>
                                            <div class="col-md-8">
                                                <div class="form-group">
                                                    <input id="CountryN" value="<?php echo $getData->CountryN ?>" name="CountryN" type="text" class="form-control" maxlength="50">

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <h4><span class="en">Postal Code</span><span class="ar"><?= getArabicTitle('Postal Code') ?></span></h4>
                                            </div>
                                            <div class="col-md-8">
                                                <div class="form-group">
                                                    <input id="PostalCode" value="<?php echo $getData->PostalCode ?>" name="PostalCode" type="text" class="form-control" maxlength="25">

                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <h4><span class="en">Additional No</span><span class="ar"><?= getArabicTitle('Additional No') ?></span></h4>
                                            </div>
                                            <div class="col-md-8">
                                                <div class="form-group">
                                                    <input id="AdditionalNo" value="<?php echo $getData->AdditionalNo ?>" name="AdditionalNo" type="text" class="form-control" maxlength="25">

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <h4><span class="en">Currency</span><span class="ar"><?= getArabicTitle('Currency') ?></span></h4>
                                            </div>
                                            <div class="col-md-5 pr-0 mr-0">
                                                <div class="form-group" id="currencyDiv">


                                                    <select class=" select2_demo_1 form-select" id="Currency" name="Currency">
                                                        <option value="">Please Select Option</option>
                                                        <?php

                                                        $SalesMan = Run("select  * from Currency   order by CurrencyName ASC");


                                                        while ($getSalesMan = myfetch($SalesMan)) {
                                                            $selected = "";

                                                        ?>
                                                            <option value="<?php echo $getSalesMan->CurrencyID; ?>" <?php echo $selected; ?>><?php echo $getSalesMan->CurrencyName; ?></option>
                                                        <?php
                                                        }

                                                        ?>
                                                    </select>
                                                    <span class="help-block errorDiv" id="Currency_error"></span>


                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="add_ref_icons d-flex justify-content-around">
                                                    <button onclick="window.open('currency.php', '_blank', 'location=yes,height=570,width=600,scrollbars=yes,status=yes');" class="btn btn-info btn-circle" type="button"><i class="fa fa-plus"></i> </button>

                                                    <button onClick="refreshItems('currencyDiv','Currency','currency')" class="btn btn-warning  btn-circle" type="button"><i class="fa fa-refresh"></i> </button>
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


            <?php
            include("footer.php");
            ?>
        </div>
    </div>
    </div>
    </div>


</body>

</html>
<script src="include/customers/custCrud.js"></script>
<script src="include/generic/js.js"></script>