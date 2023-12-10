<?php
session_start();
error_reporting(0);
include("../../config/connection.php");
// include("../../config/functions.php");
$Bid = $_POST['Bid'];
$Billno = $_POST['Billno'];

$LanguageId = $_REQUEST['LanguageId'];
$LanguageId = !empty($LanguageId) ? $LanguageId : '1';

$query = "Select *,[Discount%] as disper from " . dbObject . "purorder where Billno = $Billno and Bid = $Bid";
$QueryGet = Run("Select *,[Discount%] as disper from " . dbObject . "purorder where Billno = $Billno and Bid = $Bid");
$billData = myfetch($QueryGet);

$sBid = $billData->sbid;
?>

<form action="javascript:UpdatePurchaseOrderVoucher()" id="sales_report_form" method="post" class="ibox-content ">
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
                                <select id="Bid" name="Bid" class="grpreq select2_demo_1 form-control" onChange="loadBanksagainstBrank(this.value)" required>
									<?php
									if ($_SESSION['isAdmin'] == '1') {
										$Bracnhes = Run("Select * from " . dbObject . "Branch order by BName ASC");
									} else {
										$Bracnhes = Run("Select " . dbObject . "Branch.Bid," . dbObject . "Branch.BName from " . dbObject . "Branch Inner JOIN " . dbObject . "EMP  On " . dbObject . "EMP.BID = " . dbObject . "Branch.Bid where " . dbObject . "EMP.WebCode = '" . $_SESSION['code'] . "' ");
									}

									while ($getBranches = myfetch($Bracnhes)) {
										$selected = "";
										if ($getBranches->Bid == $billData->Bid) {
											$selected = "Selected";
										}
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
                            <h4><span class="en">Bill No</span><span class="ar"><?= getArabicTitle('Bill No') ?></span></h4>
                        </div>
                        <div class="col-md-4">
                            <input value="<?= $Billno ?>" id="bill_no" name="bill_no" type="text" class="form-control">
                            <input value="<?= $billData->sbBillno ?>" id="sbBillno" name="sbBillno" readonly type="hidden" class="form-control">
                        </div>
                        <div class="col-6">
                            <button type="button" class="btn btn-success" onclick="reloadVoucher()"><i class="fa fa-refresh"></i></button>

                            <?php
                            $qt = "select BillNo from purorder where BillNo = (select max(BillNo) from purorder where BillNo < '" . $Billno . "' and Bid='" . $Bid . "' and isDeleted = 0) and Bid = '" . $Bid . "' and isDeleted = 0";
                            $previousQuery = Run($qt);
                            $getPreviousId = myfetch($previousQuery)->BillNo;
                            if ($getPreviousId != '') { ?>
                                <button type="button" class="btn btn-success" onclick="editVoucher('<?= $Bid ?>','<?= $getPreviousId ?>')"><i class="fa fa-backward"></i></i></button>
                            <?php }
                            $qt = "select BillNo from purorder where BillNo = (select min(BillNo) from purorder where BillNo > '" . $Billno . "' and Bid='" . $Bid . "' and isDeleted = 0) and Bid = '" . $Bid . "' and isDeleted = 0";
                            $nextQuery = Run($qt);
                            $getNextId = myfetch($nextQuery)->BillNo;
                            if ($getNextId != '') {
                            ?>
                                <button type="button" class="btn btn-success" onclick="editVoucher('<?= $Bid ?>','<?= $getNextId ?>')"><i class="fa fa-forward"></i></i></button>

                            <?php } ?>

                            <button type="button" class="btn btn-success" onclick="deletePO('<?= $Billno ?>', '<?= $Bid ?>', '<?= $sBid ?>')"><i class="fa fa-trash"></i></button>
                            <button type="button" class="btn btn-success" onclick="PrintPopupVoucher('<?= $query ?>', 'Purchase Order Voucher')"><i class="fa fa-print"></i></button>
                            <button type="button" class="btn btn-success" onclick="location.reload()"><i class="fa fa-plus"></i></button>
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
                                <input id="bill_date_time" name="bill_date_time" type="date" value="<?= date("Y-m-d", $billData->BillDate) ?>" class="form-control">
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
                                <input id="supplier_id" name="supplier_id" type="text" class="form-control" value="<?= $billData->CSID ?>" readonly>
                            </div>
                            <div class="col-md-6">
                                <select id="supplier_name" name="supplier_name" class="select2_demo_1 form-control" tabindex="4" onchange="setmyValue(this.value,'supplier_id');">
                                    <?php
                                    if ($billData->CSID != "") { ?>
                                        <option value="<?= $billData->CSID ?>" selected><?= getSupplierDetails($billData->CSID)->CName ?></option>
                                    <?php }
                                    ?>
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
                                <input type="text" value="<?= $billData->Comments ?>" id="remarks" name="remarks" class="form-control">
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
                                <input type="text" id="RefNo1" name="RefNo1" value="<?= $billData->RefNo ?>" class="form-control">
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
                                        <select id="product" class="select2_demo_1 form-control" tabindex="4" onChange="setmyValue(this.value,'code');fetchProductDetails(this.value)">
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
                                        <button type="button" name="add_row" id="add_row" class="btn btn-info" onclick="addRow()">Add</button>
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
                                    <h4><span class="en">Dis%</span><span class="ar"><?= getArabicTitle('Dis%') ?></span></h4>
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
                            <input type="submit" class="btn btn-block btn-lg btn-outline-success ar" name="submit" value="<?= getArabicTitle('Save') ?>">
                        </div>

                    </div>


                </div>
            </div>
        </div>
    </div>

    <div id="fetchProductDetails"></div>
    <!-- <div id="getProductList"></div> -->
    <!-- <div id="loadUnits"></div> -->
    <input type="hidden" name="Bid" id="Bid" value="<?= $Bid ?>">
    <input type="hidden" name="row_count" id="row_count" value="0">
</form>

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
        $("#product").select2({
            width: "100%",
            closeOnSelect: true,
            placeholder: "",
            //minimumInputLength: 2,
            ajax: {
                url: "Api/listings/getProductsWithOutCode",
                dataType: "json",
                type: "POST",
                data: function(query) {
                    // add any default query here
                    term: query.terms;
                    return query;
                },
                processResults: function(data, params) {
                    // Tranforms the top-level key of the response object from 'items' to 'results'
                    var results = [];

                    results.push({
                        id: 0,
                        text: "Please Select Product",
                    });
                    data.data.forEach((e) => {
                        //cName = e.CName.toLowerCase();
                        //terms = params.term.toLowerCase();

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
        $("#f_total_int").val(<?= $billData->Total ?>);
        $("#f_dis_per").val(<?= $billData->disper ?>);
        $("#f_dis_amt").val(<?= $billData->Discount ?>);
        $("#f_net_total").val(<?= $billData->Nettotal ?>);
        $("#f_total_vat").val(<?= $billData->totalVat ?>);
        $("#initial_total_vat").val(<?= $billData->totalVat ?>);
        $("#f_grand_total").val(<?= $billData->vatPTotal ?>);
        PO_return_addRow('<?= $Bid ?>', '<?= $Billno ?>', '<?= $sBid ?>', '<?= $LanguageId ?>');
    });
</script>

<script>
    $(document).ready(function () {
        var lang = document.getElementById("selected_lang").value;
        changeLanguage(lang);
});
</script>