<?php
session_start();
error_reporting(0);
include("../../config/connection.php");
// include("../../config/functions.php");
$Bid = $_POST['Bid'];
$Billno = $_POST['Billno'];

$sBid = "2";
$bQ = Run("Select * from " . dbObject . "Branch where Bid = '" . $Bid . "'");
$getBData = myfetch($bQ);
if ($getBData->ismain == '1') {
    $sBid = "1";
}

$LanguageId = $_REQUEST['LanguageId'];
$LanguageId = !empty($LanguageId) ? $LanguageId : '1';

$QueryGet = Run("Exec " . dbObject . "SPOpenQuantitySelectWeb @SrchBy=1, @Billno=$Billno, @Bid=$Bid, @sBid=$sBid, @LanguageId=1, @FRecNo=1, @ToRecNo=100");
$billData = myfetch($QueryGet);
// print_r($billData);
?>

<form action="javascript:UpdateQuantityVoucher()" id="sales_report_form" method="post" id="sales_voucher" class="ibox-content  filter_container">

    <div class="wrapper wrapper-content animated fadeInRight pb-0">
        <div class="row">
            <div class="col-lg-12">
                <div class="ibox">
                    <div class="ibox-title">
                        <div class="row">
                            <div class="col-md-9">
                                <h5 class="mr-4"><span class="en">Opening Quantity Voucher</span><span class="ar"><?= getArabicTitle('Opening Quantity Voucher') ?></span></h5>
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
                                    <select id="Bid" name="Bid" class="grpreq select2_demo_1 form-control" tabindex="4" required>
                                        <?php
                                        if ($_SESSION['isAdmin'] == '1') {
                                            $Bracnhes = Run("Select * from " . dbObject . "Branch order by BName ASC");
                                        } else {
                                            $Bracnhes = Run("Select " . dbObject . "Branch.Bid," . dbObject . "Branch.BName from " . dbObject . "Branch Inner JOIN " . dbObject . "EMP  On " . dbObject . "EMP.BID = " . dbObject . "Branch.Bid where " . dbObject . "EMP.WebCode = '" . $_SESSION['code'] . "' ");
                                        }

                                        while ($getBranches = myfetch($Bracnhes)) {
                                            $selected = "";
                                            if ($getBranches->Bid == $billData->Bid) {
                                                $selected = "selected";

                                        ?>
                                                <option value="<?php echo $getBranches->Bid; ?>" <?php echo $selected; ?>><?php echo $getBranches->BName; ?></option>
                                        <?php
                                            }
                                        } ?>

                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="col-4">
                            <div class="row">
                                <div class="col-md-3">
                                    <h4><span class="en">Bill No</span><span class="ar"><?= getArabicTitle('Bill No') ?></span></h4>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <input value="<?= $Billno ?>" id="bill_no" name="bill_no" type="text" class="form-control">
                                    </div>
                                </div>
                                <div class="col-6">
                                    <button type="button" class="btn btn-success" onclick="reloadVoucher()"><i class="fa fa-refresh"></i></button>

                                    <?php
                                    $qt = "select BillNo from OpeningQuantity where BillNo = (select max(BillNo) from OpeningQuantity where BillNo < '" . $Billno . "' and Bid='" . $Bid . "' and isDeleted = 0) and Bid = '" . $Bid . "' and isDeleted = 0";
                                    $previousQuery = Run($qt);
                                    $getPreviousId = myfetch($previousQuery)->BillNo;
                                    if ($getPreviousId != '') { ?>
                                        <input type="hidden" name="prv_billno" id="prv_billno" value="<?= $getPreviousId ?>">
                                        <button type="button" class="btn btn-success" onclick="editVoucher('prv')"><i class="fa fa-backward"></i></i></button>
                                    <?php }
                                    $qt = "select BillNo from OpeningQuantity where BillNo = (select min(BillNo) from OpeningQuantity where BillNo > '" . $Billno . "' and Bid='" . $Bid . "' and isDeleted = 0) and Bid = '" . $Bid . "' and isDeleted = 0";
                                    $nextQuery = Run($qt);
                                    $getNextId = myfetch($nextQuery)->BillNo;
                                    if ($getNextId != '') {
                                    ?>
                                        <input type="hidden" name="nxt_billno" id="nxt_billno" value="<?= $getNextId ?>">
                                        <button type="button" class="btn btn-success" onclick="editVoucher('nxt')"><i class="fa fa-forward"></i></i></button>

                                    <?php } ?>

                                    <button type="button" class="btn btn-success" onclick="deleteOpeningQuantity('<?= $Billno ?>', '<?= $Bid ?>', '<?= $sBid ?>')"><i class="fa fa-trash"></i></button>
                                    <button type="button" class="btn btn-success" onclick="PrintPopupVoucher('<?= $Bid ?>', 'Sales Voucher')"><i class="fa fa-print"></i></button>
                                    <button type="button" class="btn btn-success" onclick="location.reload()"><i class="fa fa-plus"></i></button>
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
                                        <input value="<?= date($billData->BillDate) ?>" id="bill_date_time" name="bill_date_time" type="datetime-local" class="form-control">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-4 text-center">
                            <div class="i-checks"><label class="">
                                    <div class="iradio_square-green ">
                                        <div class="iradio_square-green">
                                            <input type="radio" value="1" class="isExp" name="isExp" <?php if ($billData->IsExpiry == '1') {
                                                                                                            echo "selected";
                                                                                                        } ?>>
                                        </div>
                                        <ins class="iCheck-helper"></ins>
                                    </div>
                                    <i></i> <span class="en">Is Expiry</span><span class="ar"><?= getArabicTitle('Is Expiry') ?></span>
                                </label>
                            </div>
                        </div>

                        <div class="col-8">
                            <div class="row">
                                <div class="col-md-4">
                                    <h4><span class="en">Remarks</span><span class="ar"><?= getArabicTitle('Remarks') ?></span></h4>
                                </div>
                                <div class="col-md-8">
                                    <div class="form-group">
                                        <input type="text" value="<?= $billData->Comments ?>" id="remarks" name="remarks" class="form-control">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <input type="hidden" name="row_count" id="row_count" value="0">

    <p id="fetchProductDetails"></p>

    <div class="row">
        <div class="col-lg-12">
            <div class="ibox">
                <div class="ibox-content  filter_container">
                    <div class="row">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th><span class="en">Item Code</span><span class="ar"><?= getArabicTitle('Item Code') ?></span></th>
                                    <th><span class="en">Item Name</span><span class="ar"><?= getArabicTitle('Item Name') ?></span></th>
                                    <th><span class="en">Unit</span><span class="ar"><?= getArabicTitle('Unit') ?></span></th>
                                    <th><span class="en">Old Quantity</span><span class="ar"><?= getArabicTitle('Old Quantity') ?></span></th>
                                    <th><span class="en">New Quantity</span><span class="ar"><?= getArabicTitle('New Quantity') ?></span></th>
                                    <th><span class="en">Price</span><span class="ar"><?= getArabicTitle('Price') ?></span></th>
                                    <th><span class="en">Net Total</span><span class="ar"><?= getArabicTitle('Net Total') ?></span></th>
                                    <th><span class="en">Action</span><span class="ar"><?= getArabicTitle('Action') ?></span></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td style="width:8%">
                                        <input type="text" class="form-control" onkeyup="fetchProductDetailsFromCode(this.value, '')" id="Pcode" name="Pcode">
                                    </td>

                                    <td style="width:20%" id="getProductList">
                                        <select id="product" name="product" class="select2_demo_1 form-control" tabindex="4" onChange="setmyValue(this.value,'Pcode');fetchProductUnits(this.value)">
                                        </select>
                                    </td>

                                    <td style="width:10%" id="loadUnits">

                                        <select class="form-select" name="unit_id" id="unit_id" aria-label="unit_id" onchange="LoadUnitPrice(this.value,'120')">
                                            <option value="">Please Select Unit</option>
                                        </select>
                                    </td>

                                    <td style="width: 12%">
                                        <input type="text" name="oldQty" id="oldQty" class="form-control" value="0" readonly>
                                    </td>

                                    <td style="width: 12%">
                                        <input type="text" name="newQty" id="newQty" class="form-control" value="0" onkeyup="calculateSingleVatTotal(this.value);">
                                    </td>

                                    <td style="width: 12%">
                                        <input type="text" name="Sprice" id="Sprice" class="form-control" value="0" onkeyup="Pricecalculations(this.value, 'vatSprice')">
                                        <input type="hidden" name="isVat" id="isVat" class="form-control" readonly>
                                    </td>

                                    <td style="width: 12%">
                                        <input type="text" readonly name="netTotal" id="netTotal" class="form-control" value="0">
                                    </td>


                                    <td id="action_id">
                                        <button type="button" name="add_row" id="add_row" class="btn btn-info" onclick="addRow()">Add
                                        </button>
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
                                    <th><span class="en">Old Qty</span><span class="ar"><?= getArabicTitle('Old Qty') ?></span></th>
                                    <th><span class="en">New Qty</span><span class="ar"><?= getArabicTitle('New Qty') ?></span></th>
                                    <th><span class="en">Price</span><span class="ar"><?= getArabicTitle('Price') ?></span></th>
                                    <th><span class="en">Net Total</span><span class="ar"><?= getArabicTitle('Net Total') ?></span></th>
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
                    </div>

                    <hr>
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

<div id="printInvoice"></div>

<script>
    $(document).ready(function() {
        $(".i-checks").iCheck({
            checkboxClass: "icheckbox_square-green",
            radioClass: "iradio_square-green",
        });
    });

    $(".clockpicker").clockpicker({
        donetext: "Select Time",
    });

    $(document).ready(function() {
        $("#total").val(<?= date($billData->NetTotal) ?>);
        product_add_addRow('<?= $Bid ?>', '<?= $Billno ?>', '<?= $sBid ?>', '<?= $LanguageId ?>');
    });
</script>