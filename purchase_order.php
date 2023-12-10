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
            // Get Max Sale Voucher Id..
            $QueryMax = Run("Select max(Billno) as Bno from " . dbObject . "purorder");
            $getBillNo = myfetch($QueryMax)->Bno + 1;

            $getCurrentEmpData = getCurrentEmpData($_SESSION['storeCode']);
            $bid = $getCurrentEmpData->BID;
            ?>

            <div class="wrapper wrapper-content animated fadeInRight">
                <!-- <div class="row mb-1">
                    <div class="col-md-6 col-8">
                        <button type="button" class="btn btn-w-m btn-default eng">English</button>
                        <button type="button" class="btn btn-w-m btn-default ara">Arabic</button>
                    </div>
                    <div class="col-md-6 col-4">
                    </div>
                </div> -->

                <div id="editVoucher">
                    <form action="javascript:SavePurchaseOrderVoucher()" id="sales_report_form" method="post" class="ibox-content ">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="ibox">
                                    <div class="ibox-title">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <h5 class="mr-4"><span class="en">Purchase Order</span><span class="ar"><?= getArabicTitle('Purchase Order') ?></span></h5>
                                            </div>
                                        </div>
                                    </div>

                                    <!------First Line------>
                                    <div class="row d-flex justify-content-start mb-2 pl-4">
                                        <div class="col-6">
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <h4><span class="en">Branch</span><span class="ar"><?= getArabicTitle('Branch') ?></span>
                                                    </h4>
                                                </div>
                                                <div class="col-md-8">
                                                    <select id="Bid" name="Bid" class="grpreq select2_demo_1 form-control" tabindex="4" required onChange="loadBanksagainstBrank(this.value), getBillNo(this.value)">
                                                        <?php
                                                        if ($_SESSION['isAdmin'] == '1') {
                                                            $Bracnhes = Run("Select * from " . dbObject . "Branch order by BName ASC");
                                                        } else {
                                                            $Bracnhes = Run("Select " . dbObject . "Branch.Bid," . dbObject . "Branch.BName from " . dbObject . "Branch Inner JOIN " . dbObject . "EMP  On " . dbObject . "EMP.BID = " . dbObject . "Branch.Bid where " . dbObject . "EMP.WebCode = '" . $_SESSION['code'] . "' ");
                                                        }

                                                        while ($getBranches = myfetch($Bracnhes)) {
                                                            $selected = "";
                                                            // if ($_GET['branc'] != '') {
                                                            if ($getBranches->ismain == '1') {
                                                                $selected = "Selected";
                                                            }
                                                            // }
                                                        ?>
                                                            <option value="<?php echo $getBranches->Bid; ?>" <?php echo $selected; ?>><?php echo $getBranches->BName; ?></option>
                                                        <?php
                                                        } ?>

                                                    </select>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-6 row">
                                            <div class="col-md-2">
                                                <h4><span class="en">PO. No</span><span class="ar"><?= getArabicTitle('PO. No') ?></span></h4>
                                            </div>
                                            <div class="col-md-4">
                                                <input value="<?= $getBillNo ?>" id="bill_no" name="bill_no" type="text" class="form-control">
                                            </div>
                                            <div class="col-6">
                                                <button type="button" class="btn btn-success" onclick="reloadVoucher()"><i class="fa fa-refresh"></i></button>

                                                <?php
                                                $qt = "select BillNo from purorder where BillNo = (select max(BillNo) from purorder where BillNo < '" . $getBillNo . "' and Bid='" . $bidValue . "' and isDeleted = 0) and Bid = '" . $bidValue . "' and isDeleted = 0";
                                                $previousQuery = Run($qt);
                                                $getPreviousId = myfetch($previousQuery)->BillNo;
                                                if ($getPreviousId != '') { ?>
                                                    <button type="button" class="btn btn-success" onclick="editVoucher('<?= $bidValue ?>','<?= $getPreviousId ?>')"><i class="fa fa-backward"></i></i></button>
                                                <?php } ?>

                                                <button type="button" class="btn btn-success" onclick="" disabled><i class="fa fa-forward"></i></i></button>
                                                <button type="button" class="btn btn-success" onclick="" disabled><i class="fa fa-trash"></i></button>
                                                <button type="button" class="btn btn-success" onclick="" disabled><i class="fa fa-print"></i></button>
                                                <button type="button" class="btn btn-success" onclick="" disabled><i class="fa fa-plus"></i></button>
                                            </div>
                                        </div>
                                    </div>

                                    <!--------Second Line------>
                                    <div class="row d-flex justify-content-start mb-2 pl-4">
                                        <div class="col-md-4">
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <h4><span class="en">Bill Date/Time</span><span class="ar"><?= getArabicTitle('Bill Date/Time') ?></span></h4>
                                                </div>
                                                <div class="col-md-8">
                                                    <input id="bill_date_time" name="bill_date_time" type="date" value="<?= date("Y-m-d") ?>" class="form-control">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="row">
                                                <div class="col-md-3">
                                                    <h4>
                                                        <span class="en">Supplier Id</span><span class="ar">
                                                            <?= getArabicTitle('Supplier Id') ?>
                                                        </span>
                                                    </h4>
                                                </div>
                                                <div class="col-md-3">
                                                    <input id="supplier_id" name="supplier_id" type="text" class="form-control text-center" readonly>
                                                </div>
                                                <div class="col-md-6">
                                                    <select id="supplier_name" name="supplier_name" class="select2_demo_1 form-control" tabindex="4" onchange="setmyValue(this.value,'supplier_id');">
                                                    </select>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-4 row">
                                            <div class="col-md-3">
                                                <h4>
                                                    <span class="en">User</span><span class="ar"><?= getArabicTitle('User') ?></span>
                                                </h4>
                                            </div>
                                            <div class="col-md-9">
                                                <select class="form-control" id="user" name="user" aria-label="sales-men">
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

                                    <div class="row d-flex justify-content-start mb-2 pl-4">
                                        <div class="col-md-4">
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <h4>
                                                        <span class="en">Remarks</span><span class="ar"><?= getArabicTitle('Remarks') ?></span>
                                                    </h4>
                                                </div>
                                                <div class="col-md-8">
                                                    <input type="text" id="remarks" name="remarks" class="form-control">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="row">
                                                <div class="col-md-3">
                                                    <h4>
                                                        <span class="en">Ref No</span><span class="ar"><?= getArabicTitle('Ref No') ?></span>
                                                    </h4>
                                                </div>
                                                <div class="col-md-9">
                                                    <input type="text" id="RefNo1" name="RefNo1" class="form-control">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-12">
                                <div class="ibox">
                                    <div class="ibox-content  filter_container">

                                        <div class="row">
                                            <!-- <div> -->
                                            <table class="table table-bordered m-0">
                                                <thead>
                                                    <tr>
                                                        <th><span class="en">Code</span><span class="ar"><?= getArabicTitle('Code') ?></span></th>
                                                        <th><span class="en">Product</span><span class="ar"><?= getArabicTitle('Product') ?></span></th>
                                                        <th><span class="en">Unit</span><span class="ar"><?= getArabicTitle('Unit') ?></span></th>
                                                        <th><span class="en">Qty</span><span class="ar"><?= getArabicTitle('Qty') ?></span></th>
                                                        <th><span class="en">Price</span><span class="ar"><?= getArabicTitle('Price') ?></span></th>
                                                        <th><span class="en">Total</span><span class="ar"><?= getArabicTitle('Total') ?></span></th>
                                                        <th><span class="en">Alt Code</span><span class="ar"><?= getArabicTitle('Alt Code') ?></span></th>
                                                        <th><span class="en">Vat %</span><span class="ar"><?= getArabicTitle('Vat %') ?></span></th>
                                                        <th><span class="en">Vat Amt</span><span class="ar"><?= getArabicTitle('Vat Amt') ?></span></th>
                                                        <th><span class="en">Vat Total</span><span class="ar"><?= getArabicTitle('Vat Total') ?></span></th>
                                                        <th><span class="en">Vat + Total</span><span class="ar"><?= getArabicTitle('Vat + Total') ?></span></th>
                                                        <th><span class="en">Action</span><span class="ar"><?= getArabicTitle('Action') ?></span></th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td style="width:7%">
                                                            <input type="text" id="code" onkeyup="fetchProductDetailsFromCode(this.value, '')" class="form-control">
                                                        </td>
                                                        <td style="width:18%" id="getProductList">
                                                            <select id="product" class="select2_demo_1 form-control" tabindex="4" onChange="setmyValue(this.value,'code');fetchProductUnits(this.value)">
                                                            </select>
                                                        </td>
                                                        <td style="width:10%" id="loadUnits">
                                                            <select id="unit" class="form-control" tabindex="4">
                                                            </select>
                                                        </td>

                                                        <td style="width: 7%">
                                                            <input type="text" id="qty" class="form-control" value="" onkeyup="salesAddRowCalculations();">
                                                        </td>
                                                        <td style="width: 7%">
                                                            <input type="text" id="price" class="form-control" value="0" onkeyup="salesAddRowCalculations()">

                                                        </td>
                                                        <td style="width: 7%">
                                                            <input type="text" id="total" class="form-control" value="0">

                                                        </td>
                                                        <td style="width: 7%">
                                                            <input type="text" id="altCode" name="altCode" class="form-control" value="0">
                                                        </td>
                                                        <td style="width: 7%">
                                                            <input type="text" id="vatPer" class="form-control" value="0" onkeyup="salesAddRowCalculations()" readonly>
                                                        </td>
                                                        <td style="width: 7%">
                                                            <input type="text" id="vatAmt" class="form-control" value="0" readonly>
                                                        </td>
                                                        <td style="width: 7%">
                                                            <input type="text" id="vattotal" class="form-control" value="0" readonly>
                                                        </td>
                                                        <td style="width: 12%">
                                                            <input type="text" id="vatPTotal" class="form-control" value="0" readonly>
                                                        </td>


                                                        <td id="action_id">
                                                            <button type="button" name="add_row" id="add_row" class="btn btn-info en" onclick="addRow()">Add</button>
                                                            <button type="button" name="add_row" id="add_row" class="btn btn-info ar" onclick="addRow()"><?= getArabicTitle('Add') ?></button>
                                                        </td>
                                                        <input type="hidden" id="Pid" name="Pid" value="">
                                                        <input type="hidden" id="actPrice" name="actPrice" value="">
                                                        <input type="hidden" id="EmpID" name="EmpID" value="">
                                                        <input type="hidden" id="ResEmpID" name="ResEmpID" value="">
                                                        <input type="hidden" id="CPrice" name="CPrice" value="">
                                                        <input type="hidden" id="IsStockCount" name="IsStockCount" value="">
                                                        <!-- <input type="hidden" id="vatPTotal" name="vatPTotal" value=""> -->
                                                        <input type="hidden" id="unit_name" name="unit_name" value="">
                                                        <input type="hidden" id="vatSprice" name="vatSprice" value="">
                                                        <input type="hidden" id="CostPrice" name="CostPrice" value="">
                                                        <input type="hidden" id="LSPrice" name="LSPrice" value="">
                                                    </tr>

                                                </tbody>
                                            </table>
                                            <!-- </div> -->
                                        </div>


                                        <div style="background: #80808014; height: 150px; margin-top:1rem;">
                                            <table class="table table-bordered">
                                                <thead>
                                                    <tr>
                                                        <th>#</th>
                                                        <th><span class="en">Code</span><span class="ar"><?= getArabicTitle('Code') ?></span></th>
                                                        <th><span class="en">Product</span><span class="ar"><?= getArabicTitle('Product') ?></span></th>
                                                        <th><span class="en">Unit</span><span class="ar"><?= getArabicTitle('Unit') ?></span></th>
                                                        <th><span class="en">Qty</span><span class="ar"><?= getArabicTitle('Qty') ?></span></th>
                                                        <th><span class="en">Price</span><span class="ar"><?= getArabicTitle('Price') ?></span></th>
                                                        <th><span class="en">Total</span><span class="ar"><?= getArabicTitle('Total') ?></span></th>
                                                        <th><span class="en">Alt Code</span><span class="ar"><?= getArabicTitle('Alt Code') ?></span></th>
                                                        <th><span class="en">Vat %</span><span class="ar"><?= getArabicTitle('Vat %') ?></span></th>
                                                        <th><span class="en">Vat Amt</span><span class="ar"><?= getArabicTitle('Vat Amt') ?></span></th>
                                                        <th><span class="en">Vat Total</span><span class="ar"><?= getArabicTitle('Vat Total') ?></span></th>
                                                        <th><span class="en">Vat + Total</span><span class="ar"><?= getArabicTitle('Vat + Total') ?></span></th>
                                                        <th><span class="en">Action</span><span class="ar"><?= getArabicTitle('Action') ?></span></th>
                                                    </tr>
                                                </thead>
                                                <tbody id="row_append">

                                                </tbody>
                                            </table>

                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>


                        <div class="row">
                            <div class="col-lg-12">
                                <div class="ibox">
                                    <div class="ibox-content ">
                                        <div class="row">
                                            <div class="col">
                                                <div class="row">
                                                    <div class="col-md-4 d-flex justify-content-end">
                                                        <h4><span class="en">Total</span><span class="ar"><?= getArabicTitle('Total') ?></span></h4>
                                                    </div>
                                                    <div class="col-md-8">
                                                        <div class="form-total_int">
                                                            <input value="0" id="f_total_int" name="f_total_int" type="text" readonly class="form-control">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div class="row">
                                                    <div class="col-md-4 d-flex justify-content-end">
                                                        <h4><span class="en">Dis%</span><span class="ar">%<?= getArabicTitle('Dis') ?></span></h4>
                                                    </div>
                                                    <div class="col-md-8">
                                                        <div class="form-group">
                                                            <input value="0" id="f_dis_per" name="f_dis_per" type="text" class="form-control" onkeyup="salesTotalDiscountCalculation()">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div class="row">
                                                    <div class="col-md-4 d-flex justify-content-end p-0 m-0">
                                                        <h4><span class="en">Dis Amount</span><span class="ar"><?= getArabicTitle('Dis Amount') ?></span></h4>
                                                    </div>
                                                    <div class="col-md-8">
                                                        <div class="form-group">
                                                            <input value="0" id="f_dis_amt" name="f_dis_amt" type="text" class="form-control" onkeyup="salesTotalDiscountCalculationWithAMount()">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div class="row">
                                                    <div class="col-md-4 d-flex justify-content-end m-0 p-0">
                                                        <h4><span class="en">Net Total</span><span class="ar"><?= getArabicTitle('Net Total') ?></span></h4>
                                                    </div>
                                                    <div class="col-md-8">
                                                        <div class="form-group">
                                                            <input value="0" id="f_net_total" name="f_net_total" type="text" class="form-control" onkeyup="salesTotalDiscountCalculationWithAMount()">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div class="row">
                                                    <div class="col-md-4 d-flex justify-content-end m-0 p-0">
                                                        <h4><span class="en">Total VAT</span><span class="ar"><?= getArabicTitle('Total Vat') ?></span></h4>
                                                    </div>
                                                    <div class="col-md-8">
                                                        <div class="form-total_int">
                                                            <input value="0" id="f_total_vat" name="f_total_vat" type="text" readonly class="form-control">
                                                            <input value="0" id="initial_total_vat" name="initial_total_vat" type="hidden" class="form-control">

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row d-flex justify-content-end">
                                            <div class="col-md-10 row d-flex justify-content-end">
                                                <div class="col-md-3">
                                                    <div class="row">
                                                        <div class="col-md-4 d-flex justify-content-end m-0 p-0">
                                                            <h4><span class="en">Grand Total</span><span class="ar"><?= getArabicTitle('Grand Total') ?></span></h4>
                                                        </div>
                                                        <div class="col-md-8">
                                                            <div class="form-total_int">
                                                                <input value="0" id="f_grand_total" name="f_grand_total" type="text" readonly class="form-control">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <hr>
                                        <div class="row d-flex justify-content-center">
                                            <div class="col-lg-3">
                                                <input type="submit" class="btn btn-block btn-lg btn-outline-success en" name="submit" value="Save">
                                                <input type="submit" class="btn btn-block btn-lg btn-outline-success ar" name="submit" value="<?= getArabicTitle('Save')?>">
                                            </div>

                                        </div>


                                    </div>
                                </div>
                            </div>
                        </div>

                        <div id="fetchProductDetails"></div>
                        <!-- <div id="getProductList"></div> -->
                        <!-- <div id="loadUnits"></div> -->
                        <input type="hidden" name="Bid" id="Bid" value="<?= $bid ?>">
                        <input type="hidden" name="row_count" id="row_count" value="0">
                    </form>
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

<script src="vouchers/purchaseorder/js.js"></script>