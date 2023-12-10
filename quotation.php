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
        .filter_container {
            max-height: 100vh !important;
        }

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
            $QueryMax = Run("Select max(Billno) as Bno from " . dbObject . "Quotation");
            $getBillNo = myfetch($QueryMax)->Bno + 1;

            $bidValue =  GetMainBranch();
            if ($_SESSION['isAdmin'] == 0) {
                $bidValue = $userBranch->Bid;
            }

            ?>
            <div id="editVoucher">
                <form action="javascript:SaveQuotationVoucher()" id="sales_report_form" method="post" id="sales_voucher" class="ibox-content  filter_container">

                    <div class="wrapper wrapper-content animated fadeInRight pb-0">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="ibox">
                                    <div class="ibox-title">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <h5 class="mr-4 en float-left">Quotation</h5>
                                                <h5 class="mr-4 ar float-right"><?= getArabicTitle('Quotation') ?></h5>
                                            </div>
                                        </div>
                                        <div class="ibox-tools no_envent" style="display: none">
                                            <a class="collapse-link filter_act">
                                                <i class="fa fa-chevron-down"></i>
                                            </a>
                                        </div>
                                    </div>
                                    <input type="number" id="selected_lang" name="selected_lang" value="<?php !empty($_GET['selected_lang']) ? $_GET['selected_lang'] : '2' ?>" hidden>
                                    <div class="row">
                                        <div class="col-4">
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <h4><span class="en">Branch</span><span class="ar"><?= getArabicTitle('Branch') ?></span></h4>
                                                </div>
                                                <div class="col-md-8">
                                                    <select id="Bid" name="Bid" class="grpreq select2_demo_1 form-control" tabindex="4" required onChange="">
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
                                        <div class="col-8">
                                            <div class="row">
                                                <div class="col-md-2">
                                                    <h4><span class="en">Bill No</span><span class="ar"><?= getArabicTitle('Bill No') ?></span></h4>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <input value="<?= $getBillNo ?>" id="bill_no" name="bill_no" type="text" class="form-control">
                                                    </div>
                                                </div>

                                                <div class="col-md-6">
                                                    <button type="button" class="btn btn-success" onclick="reloadVoucher()"><i class="fa fa-refresh"></i></button>


                                                    <?php
                                                    $qt = "select BillNo from Quotation where BillNo = (select max(BillNo) from Quotation where BillNo < '" . $getBillNo . "' and Bid='" . $bidValue . "' and isDeleted = 0) and Bid = '" . $bidValue . "' and isDeleted = 0";
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

                                    </div>

                                    <div class="row">
                                        <div class="col-4">
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <h4><span class="en">Remarks</span><span class="ar"><?= getArabicTitle('Remarks') ?></span></h4>
                                                </div>
                                                <div class="col-md-8">
                                                    <div class="form-group">
                                                        <input type="text" id="remarks" name="remarks" class="form-control">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-4">
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <h4><span class="en">Reference</span><span class="ar"><?= getArabicTitle('Reference') ?></span></h4>
                                                </div>
                                                <div class="col-md-8">
                                                    <div class="form-group">
                                                        <input type="text" id="reference" name="reference" class="form-control">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-4">
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <h4><span class="en">User</span><span class="ar"><?= getArabicTitle('User') ?></span></h4>
                                                </div>
                                                <div class="col-md-8">
                                                    <div class="form-group">
                                                        <select class="form-control" id="salesMan" name="user" aria-label="sales-men">
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
                                    </div>

                                    <div class="row">
                                        <div class="col-4">
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <h4><span class="en">S.P.F No</span><span class="ar"><?= getArabicTitle('S.P.F No') ?></span></h4>
                                                </div>
                                                <div class="col-md-8">
                                                    <div class="form-group">
                                                        <input type="text" id="SPFNo" name="SPFNo" class="form-control">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-4">
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <h4><span class="en">Attention</span><span class="ar"><?= getArabicTitle('Attention') ?></span></h4>
                                                </div>
                                                <div class="col-md-8">
                                                    <div class="form-group">
                                                        <input type="text" id="attention" name="attention" class="form-control">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-4">
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <h4><span class="en">Payment Terms</span><span class="ar"><?= getArabicTitle('Payment Terms') ?></span></h4>
                                                </div>
                                                <div class="col-md-8">
                                                    <div class="form-group">
                                                        <input type="text" id="paymentTerms" name="paymentTerms" class="form-control">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-4">
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <h4><span class="en">Delivery Time</span><span class="ar"><?= getArabicTitle('Delivery Time') ?></span></h4>
                                                </div>
                                                <div class="col-md-8">
                                                    <div class="form-group">
                                                        <input value="<?= date("Y-m-d H:i:s") ?>" id="deliveryTime" name="deliveryTime" type="datetime-local" class="form-control">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-4">
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <h4><span class="en">Validity</span><span class="ar"><?= getArabicTitle('Validity') ?></span></h4>
                                                </div>
                                                <div class="col-md-8">
                                                    <div class="form-group">
                                                        <input type="text" id="validity" name="validity" class="form-control">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-4">
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <h4><span class="en">Stock of Br.</span><span class="ar"><?= getArabicTitle('Stock of Br') ?></span></h4>
                                                </div>
                                                <div class="col-md-8">
                                                    <input type="text" name="stockBr" id="stockBr" class="form-control">
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-4">
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <h4><span class="en">Stock Of All</span><span class="ar"><?= getArabicTitle('Stock Of All') ?></span></h4>
                                                </div>
                                                <div class="col-md-8">
                                                    <div class="form-group">
                                                        <input type="text" name="stockAll" id="stockAll" class="form-control">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-lg-4">
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <h4><span class="en">Customer</span><span class="ar"><?= getArabicTitle('Customer') ?></span></h4>
                                                </div>

                                                <div class="col-md-8">
                                                    <div class="form-group">
                                                        <div>
                                                            <select id="customer_id" name="customer_id" class="select2_demo_1 form-control" tabindex="4">


                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-lg-4">
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <h4><span class="en">Bill Date/Time</span><span class="ar"><?= getArabicTitle('Bill Date/Time') ?></span></h4>
                                                </div>
                                                <div class="col-md-8">
                                                    <div class="form-group">
                                                        <input value="<?= date("Y-m-d H:i:s") ?>" id="bill_date_time" name="bill_date_time" type="datetime-local" class="form-control">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <?php
                    $getCurrentEmpData = getCurrentEmpData($_SESSION['storeCode']);
                    $bid = $getCurrentEmpData->BID;
                    ?>

                    <input type="hidden" name="row_count" id="row_count" value="0">



                    <div id="fetchProductDetails"></div>

                    <div class="row">
                        <div class="col-lg-12">
                            <div class="ibox">
                                <div class="ibox-content  filter_container">
                                    <div class="row">
                                        <table class="table table-bordered">
                                            <thead>
                                                <tr>
                                                    <th><span class="en">Code</span><span class="ar"><?= getArabicTitle('Code') ?></span></th>
                                                    <th><span class="en">Name</span><span class="ar"><?= getArabicTitle('Name') ?></span></th>
                                                    <th><span class="en">Unit</span><span class="ar"><?= getArabicTitle('Unit') ?></span></th>
                                                    <th><span class="en">Qty</span><span class="ar"><?= getArabicTitle('Qty') ?></span></th>
                                                    <th><span class="en">Price</span><span class="ar"><?= getArabicTitle('Price') ?></span></th>
                                                    <th><span class="en">Vat Amt</span><span class="ar"><?= getArabicTitle('Vat Amt') ?></span></th>
                                                    <th><span class="en">Vat %</span><span class="ar"><?= getArabicTitle('Vat %') ?></span></th>
                                                    <th><span class="en">Total</span><span class="ar"><?= getArabicTitle('Total') ?></span></th>
                                                    <th><span class="en">Vat + Total</span><span class="ar"><?= getArabicTitle('Vat + Total') ?></span></th>
                                                    <th><span class="en">Action</span><span class="ar"><?= getArabicTitle('Action') ?></span></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td style="width:8%">
                                                        <input type="text" class="form-control" onkeyup="fetchProductDetailsFromCode(this.value, '')" id="Pcode">
                                                    </td>
                                                    <td style="width:20%" id="getProductList">
                                                        <select id="product" class="select2_demo_1 form-control" tabindex="4" onchange="setmyValue(this.value,'Pcode');fetchProductUnits(this.value)">
                                                        </select>
                                                    </td>
                                                    <td style="width:10%" id="loadUnits">
                                                    <?php if ($lang == 1) {
                                                        $placeholder ="Please Select Unit";
                                                    } else {
                                                        $placeholder = getArabicTitle('Please Select Unit');
                                                    } ?>
                                                        <select class="form-select" id="unit_id" aria-label="unit_id" onchange="LoadUnitPrice(this.value,'120')">
                                                            <option value=""><?= $placeholder ?></option>
                                                        </select>
                                                    </td>

                                                    <td style="width: 8%">
                                                        <input type="text" id="qty" class="form-control" value="1" onkeyup="calculateSingleVatTotal(this.value);">
                                                    </td>
                                                    <td style="width: 8%">
                                                        <input type="text" id="Sprice" class="form-control" value="0" onkeyup="Pricecalculations(this.value, 'vatSprice')">
                                                        <input type="hidden" id="isVat" class="form-control" readonly>
                                                    </td>
                                                    <td style="width: 10%">
                                                        <input type="text" id="vatAmt" readonly class="form-control" value="0">
                                                    </td>
                                                    <td><input type="text" readonly id="vatPer" class="form-control" value="0"></td>
                                                    <td><input type="text" readonly id="vatSprice" class="form-control" value="0"></td>
                                                    <td><input type="text" readonly id="vatTotal" class="form-control" value="0"></td>


                                                    <td id="action_id">
                                                        <button type="button" name="add_row" id="add_row" class="btn btn-info en" onclick="addRow()">Add</button>
                                                        <button type="button" name="add_row" id="add_row" class="btn btn-info ar" onclick="addRow()"><?= getArabicTitle('Add') ?></button>
                                                    </td>
                                                </tr>

                                            </tbody>
                                        </table>
                                    </div>

                                    <div style="background: #80808014; height: 150px">
                                        <table class="table table-bordered">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th><span class="en">Code</span><span class="ar"><?= getArabicTitle('Code') ?></span></th>
                                                    <th><span class="en">Name</span><span class="ar"><?= getArabicTitle('Name') ?></span></th>
                                                    <th><span class="en">Unit</span><span class="ar"><?= getArabicTitle('Unit') ?></span></th>
                                                    <th><span class="en">Qty</span><span class="ar"><?= getArabicTitle('Qty') ?></span></th>
                                                    <th><span class="en">Price</span><span class="ar"><?= getArabicTitle('Price') ?></span></th>
                                                    <th><span class="en">Vat %</span><span class="ar"><?= getArabicTitle('Vat %') ?></span></th>
                                                    <th><span class="en">Vat Amt</span><span class="ar"><?= getArabicTitle('Vat Amt') ?></span></th>
                                                    <th><span class="en">Total</span><span class="ar"><?= getArabicTitle('Total') ?></span></th>
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
                                        <div class="col-lg-2">
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <h4><span class="en">Total/Int</span><span class="ar"><?= getArabicTitle('Total/Int') ?></span></h4>
                                                </div>
                                                <div class="col-md-8">
                                                    <div class="form-total_int">
                                                        <input value="0" id="total" name="total" type="text" readonly class="form-control">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-2">
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <h4><span class="en">Dis%</span><span class="ar">%<?= getArabicTitle('Dis') ?></span></h4>
                                                </div>
                                                <div class="col-md-8">
                                                    <div class="form-group">
                                                        <input value="0" id="disPer" name="disPer" type="text" class="form-control" onkeyup="calculateWholeDiscountAmount(this.value)">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-2">
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <h4><span class="en">Dis Amt</span><span class="ar"><?= getArabicTitle('Dis Amt') ?></span></h4>
                                                </div>
                                                <div class="col-md-8">
                                                    <div class="form-group">
                                                        <input value="0" id="disAmt" name="disAmt" type="text" class="form-control" onkeyup="calculateWholeDiscountper(this.value)">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-2">
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <h4><span class="en">Net Total</span><span class="ar"><?= getArabicTitle('Net Total') ?></span></h4>
                                                </div>
                                                <div class="col-md-8">
                                                    <div class="form-group">
                                                        <input value="0" id="netTotal" name="netTotal" readonly type="text" class="form-control tot_Sprice">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-2">
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <h4><span class="en">Total Vat</span><span class="ar"><?= getArabicTitle('Total Vat') ?></span></h4>
                                                </div>
                                                <div class="col-md-8">
                                                    <div class="form-group">
                                                        <input value="0" id="totVat" name="totVat" readonly type="text" class="form-control">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-2">
                                            <div class="row">
                                                <div class="col-md-5">
                                                    <h4><span class="en">Vat + Net Total</span><span class="ar"><?= getArabicTitle('Vat + Net Total') ?></span></h4>
                                                </div>
                                                <div class="col-md-7">
                                                    <div class="form-group">
                                                        <input value="0" id="vatNetTotal" name="vatNetTotal" readonly type="text" class="form-control">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <hr />

                                    <div class="row">
                                        <div class="col-lg-4">
                                        </div>
                                        <div class="col-lg-4">
                                            <input type="submit" class="btn btn-block btn-lg btn-outline-success" name="submit" value="Save">
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="row">
                                                <div class="col-lg-8">
                                                </div>
                                                <div class="col-lg-4" style="text-align: right">

                                                </div>
                                            </div>

                                        </div>
                                    </div>


                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>

            <?php
            include("footer.php");
            ?>
            <div id="SalesVoucherDiv"></div>
        </div>

    </div>
    </div>
    </div>
    </div>


</body>

</html>

<script src="vouchers/quotation/js.js"></script>

<script>
    $(document).ready(function() {
        $("#salesMan").select2({});
        $("#Bid").select2({});
    });
</script>