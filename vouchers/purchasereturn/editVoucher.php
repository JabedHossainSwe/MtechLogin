<?php
session_start();
error_reporting(0);
include("../../config/connection.php");
// include("../../config/functions.php");
$Bid = $_POST['Bid'];
$Billno = $_POST['Billno'];

// $sBid = "2";
// $bQ = Run("Select * from " . dbObject . "Branch where Bid = '" . $bid . "'");
// $getBData = myfetch($bQ);
// if ($getBData->ismain == '1') {
//     $sBid = "1";
// }

$LanguageId = $_REQUEST['LanguageId'];
$LanguageId = !empty($LanguageId) ? $LanguageId : '1';

// echo "Select *,[Discount%] as disper from " . dbObject . "DataOutReturn where Billno = $Billno and Bid = $Bid";
// die();
$QueryGet = Run("Select *,[Discount%] as disper from " . dbObject . "DataInReturn where Billno = $Billno and Bid = $Bid");
$billData = myfetch($QueryGet);
$sBid = $billData->sbid;
// print_r($billData);
// die();
?>
<form action="javascript:UpdatePurchaseReturn()" id="sales_report_form" method="post" class="ibox-content">
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox">
                <div class="ibox-title">
                    <div class="row">
                        <div class="col-md-12">
                            <h5 class="mr-4"><span class="en">Purchase Return Voucher</span><span class="ar"><?= getArabicTitle('Purchase Return Voucher') ?></span></h5>
                        </div>
                    </div>
                </div>

                <!------First Line------>
                <div class="row">

                    <div class="col-lg-6">
                        <div class="row">
                            <div class="col-md-4">
                                <h4><span class="en">Branch</span><span class="ar"><?= getArabicTitle('Branch') ?></span>
                                </h4>
                            </div>

                            <div class="col-md-8">
                                <div class="form-group">
                                    <div>
                                        <select class="select2_demo_1 form-control" name="Bid" id="Bid" aria-label="sales-men">
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
                                                if ($getBranches->Bid == $billData->Bid) {
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
                    </div>

                    <div class="col-md-6 row">
                        <div class="col-md-3 p-0 m-0">
                            <h4><span class="en">Bill No</span><span class="ar"><?= getArabicTitle('Bill No') ?></span></h4>
                        </div>
                        <div class="form-group col-md-3 p-0 m-0">
                            <input value="<?= $Billno ?>" id="bill_no" name="bill_no" type="text" class="form-control">
                            <input value="<?= $billData->sbBillno ?>" id="sbBillno" name="sbBillno" readonly type="hidden" class="form-control">
                        </div>

                        <div class="col-6">
                            <button type="button" class="btn btn-success" onclick="reloadVoucher()"><i class="fa fa-refresh"></i></button>

                            <?php
                            $qt = "select BillNo from datainreturn where BillNo = (select max(BillNo) from 
											datainreturn where BillNo < '" . $Billno . "' and Bid='" . $Bid . "' and isDeleted = 0) 
											and Bid = '" . $Bid . "' and isDeleted = 0";
                            $previousQuery = Run($qt);
                            $getPreviousId = myfetch($previousQuery)->BillNo;
                            if ($getPreviousId != '') { ?>
                                <button type="button" class="btn btn-success" onclick="editVoucher('<?= $Bid ?>','<?= $getPreviousId ?>')"><i class="fa fa-backward"></i></i></button>
                            <?php } 
                            $qt = "select BillNo from datainreturn where BillNo = (select min(BillNo) from datainreturn where BillNo > '" . $Billno . "' and Bid='" . $Bid . "' and isDeleted = 0) and Bid = '" . $Bid . "' and isDeleted = 0";
                            $nextQuery = Run($qt);
                            $getNextId = myfetch($nextQuery)->BillNo;
                            if ($getNextId != '') {
                            ?>
                                <button type="button" class="btn btn-success" onclick="editVoucher('<?= $Bid ?>','<?= $getNextId ?>')"><i class="fa fa-forward"></i></i></button>

                            <?php } ?>

                            <button type="button" class="btn btn-success" onclick="deletePurchase('<?= $Billno ?>', '<?= $Bid ?>', '<?= $sBid ?>')"><i class="fa fa-trash"></i></button>
                            <button type="button" class="btn btn-success" onclick="PrintPopupVoucher('<?=$Bid?>', 'Purchase Return Voucher')"><i class="fa fa-print"></i></button>
                            <button type="button" class="btn btn-success" onclick="location.reload()"><i class="fa fa-plus"></i></button>
                        </div>
                    </div>


                </div>

                <!--------Second Line------>
                <div class="row">
                    <div class="col-md-6 text-center">
                        <div class="row d-flex justify-content-evenly">

                            <div class="col-md-6 col-4">
                                <div class="i-checks"><label class="">
                                        <div class="iradio_square-green ">
                                            <div class="iradio_square-green">
                                                <input type="radio" value="1" class="SPType" name="SPType" <?php if ($billData->SPType == 1) { echo "checked"; } ?>>
                                            </div>
                                            <ins class="iCheck-helper"></ins>
                                        </div>
                                        <i></i> <span class="en">Cash</span><span class="ar"><?= getArabicTitle('Cash') ?></span>
                                    </label>
                                </div>
                            </div>

                            <div class="col-md-6 col-4">
                                <div class="i-checks"><label class="">
                                        <div class="iradio_square-green ">
                                            <div class="iradio_square-green">
                                                <input type="radio" value="2" class="SPType" name="SPType" <?php if ($billData->SPType == 2) { echo "checked"; } ?>>
                                            </div>
                                            <ins class="iCheck-helper"></ins>
                                        </div>
                                        <i></i> <span class="en">Credit</span><span class="ar"><?= getArabicTitle('Credit') ?></span>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="row">
                            <div class="col-md-4">
                                <h4><span class="en">Purchaser</span><span class="ar">
                                        <?= getArabicTitle('Purchaser') ?>
                                    </span></h4>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group"><input id="Pur_id" name="Pur_id" type="text" class="form-control" value="" readonly></div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <div>
                                        <select id="Pur_name" name="Pur_name" class="select2_demo_1 form-control" tabindex="4" onChange="setmyValue(this.value,'Pur_id');">

                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="row">
                            <div class="col-md-4 p-0 m-0">
                                <h4><span class="en">Bill Date/Time</span><span class="ar"><?= getArabicTitle('Bill Date/Time') ?></span></h4>
                            </div>
                            <div class="col-md-8 p-0 m-0">
                                <div class="form-group">
                                    <input id="bill_date_time" name="bill_date_time" type="date" value="<?= date($billData->BillDate) ?>" class="form-control">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="row">
                            <div class="col-md-4">
                                <h4><span class="en">Purchase Type</span><span class="ar">
                                        <?= getArabicTitle('Purchase Type') ?>
                                    </span></h4>
                            </div>
                            <div class="col-md-2 pl-0">
                                <div class="form-group"><input id="PurType" name="PurType" type="text" class="form-control" value="<?php if ($billData->purType != 0) { echo $billData->purType; } ?>" readonly></div>
                            </div>
                            <div class="col-md-6 pl-0">
                                <div class="form-group">
                                    <div>
                                        <select id="PurType_name" name="PurType_name" class="select2_demo_1 form-control" tabindex="4" onChange="setmyValue(this.value,'PurType');">
                                            <?php
                                            if ($billData->purType != 0) { ?>
                                                <option value="<?= $billData->purType ?>"><?= getPurchaseTypeDetails($billData->purType)->CName ?></option>
                                            <?php }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

                <!--------third Line------>
                <div class="row">

                    <!-------Thrid CHild-->
                    <div class="col-md-4">
                        <div class="row">
                            <div class="col-md-4">
                                <h4><span class="en">Ref. No</span><span class="ar"><?= getArabicTitle('Ref. No') ?></span>
                                </h4>
                            </div>
                            <div class="col-md-8">
                                <div class="form-group">
                                    <input type="text" id="RefNo1" name="RefNo1" class="form-control" value="<?= $billData->RefNo ?>">
                                </div>
                            </div>
                        </div>
                    </div>
                    <!---------FOurth CHild-->
                    <div class="col-md-4">
                        <div class="row">
                            <div class="col-md-4 p-0 m-0">
                                <h4><span class="en">P.O No.</span><span class="ar"><?= getArabicTitle('P.O No.') ?></span>
                                </h4>
                            </div>
                            <div class="col-md-8 m-0 p-0 m-0">
                                <div class="form-group">
                                    <input type="text" id="poNo" name="poNo" class="form-control" value="<?= $billData->poNo ?>">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 row ">
                        <div class="col-md-3">
                            <h4><span class="en">Supplier Id</span><span class="ar">
                                    <?= getArabicTitle('Supplier Id') ?>
                                </span>
                            </h4>
                        </div>
                        <div class="col-md-2 pl-0">
                            <div class="form-group"><input id="supplier_id" name="supplier_id" type="text" class="form-control text-center" value="<?php if($billData->SupplierName != ""){echo getSupplierNameDetails($billData->SupplierName)->Cid;}?>" readonly></div>
                        </div>
                        <div class="col-md-7 m-0 p-0 col-8 ">
                            <div class="form-group">
                                <div>

                                    <select id="supplier_name" name="supplier_name" class="select2_demo_1 form-control" tabindex="4" onchange="setmyValue(this.value,'supplier_id'); fetchSupplierDetails(this.value);">
                                        <?php
                                            if($billData->SupplierName != ""){ ?>
                                                <option value="<?= getSupplierNameDetails($billData->SupplierName)->Cid ?>"><?=$billData->SupplierName?></option>
                                            <?php }
                                        ?>
                                    </select>
                                </div>
                            </div>
                        </div>


                    </div>

                </div>

                <!--------fourth Line------>
                <div class="row">
                    <!--------Dis %------>
                    <div class="col-md-4">
                        <div class="row">
                            <div class="col-md-4">
                                <h4><span class="en">Dis %</span><span class="ar">% <?= getArabicTitle('Dis') ?></span>
                                </h4>
                            </div>
                            <div class="col-md-8">
                                <div class="form-group">
                                    <input type="text" id="dis_per" name="dis_per" class="form-control" value="<?= $billData->disper ?>">
                                </div>
                            </div>

                        </div>
                    </div>

                    <!--------Due ------>
                    <div class="col-md-4">
                        <div class="row">
                            <div class="col-md-4 p-0 m-0">
                                <h4><span class="en">Due</span><span class="ar"><?= getArabicTitle('Due') ?></span>
                                </h4>
                            </div>
                            <div class="col-md-8 p-0 m-0">
                                <div class="form-group m-0 p-0">
                                    <input type="text" id="due" name="due" class="form-control" value="<?= $billData->dueDays ?>">
                                </div>
                            </div>

                        </div>
                    </div>

                    <!-------- Due Date------>
                    <div class="col-md-4">
                        <div class="row ">
                            <div class="col-md-4">
                                <h4><span class="en">Due Date</span><span class="ar"><?= getArabicTitle('Due Date') ?></span>
                                </h4>
                            </div>
                            <div class="col-md-8 m-0 p-0 ">
                                <div class="form-group m-0 p-0">
                                    <input value="" id="due_date" name="due_date" type="date" class="form-control">
                                </div>
                            </div>

                        </div>
                    </div>


                </div>

                <!--------fifth Line------>
                <div class="row">
                    <!--------Remarks------>
                    <div class="col-md-4">
                        <div class="row">
                            <div class="col-md-4">
                                <h4><span class="en">Remarks</span><span class="ar"><?= getArabicTitle('Remarks') ?></span>
                                </h4>
                            </div>
                            <div class="col-md-8">
                                <div class="form-group">
                                    <input type="text" id="remarks" name="remarks" class="form-control" value="<?= $billData->Comments ?>">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="row">
                            <div class="col-md-4 p-0">
                                <h4><span class="en">Purchase Bill</span><span class="ar"><?= getArabicTitle('Purchase Bill') ?></span>
                                </h4>
                            </div>
                            <div class="col-md-4 col-4">
                                <div class="i-checks"><label class="">
                                        <div class="iradio_square-green ">
                                            <div class="iradio_square-green">
                                                <input class="form-check-input purchase_bill" type="radio" name="purchase_bill" id="Yes" value="Yes">
                                            </div>
                                            <ins class="iCheck-helper"></ins>
                                        </div>
                                        <i></i> <span class="en">Yes</span><span class="ar"><?= getArabicTitle('Yes') ?></span>
                                    </label>
                                </div>
                            </div>

                            <div class="col-md-4 col-4">
                                <div class="i-checks"><label class="">
                                        <div class="iradio_square-green ">
                                            <div class="iradio_square-green">
                                                <input class="form-check-input purchase_bill" type="radio" name="purchase_bill" id="No" checked value="No">
                                            </div>
                                            <ins class="iCheck-helper"></ins>
                                        </div>
                                        <i></i> <span class="en">No</span><span class="ar"><?= getArabicTitle('No') ?></span>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="row">
                            <div class="col-md-4">
                                <h4><span class="en">Purchase Bill No</span><span class="ar"><?= getArabicTitle('Purchase Bill No') ?></span>
                                </h4>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <input type="number" class="form-control" name="purchase_bill_no" id="purchase_bill_no">
                                </div>
                            </div>
                            <div class="col-md-2">
                                <button type="button" class="btn btn-success" onclick="validateSaleNo(this)"><i class="fa fa-refresh" aria-hidden="true"></i></button>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-12" class="m-0" id="addRow" style="display:none; overflow-x:scroll;">
            <div class="" style="width: 120rem;">
                <table class="table table-bordered m-0 direction">
                    <thead>
                        <tr>
                            <th><span class="en">Code</span><span class="ar"><?= getArabicTitle('Code') ?></span></th>
                            <th><span class="en">Product</span><span class="ar"><?= getArabicTitle('Product') ?></span></th>
                            <th><span class="en">Unit</span><span class="ar"><?= getArabicTitle('Unit') ?></span></th>
                            <th><span class="en">Qty</span><span class="ar"><?= getArabicTitle('Qty') ?></span></th>
                            <th><span class="en">Bonus</span><span class="ar"><?= getArabicTitle('Bonus') ?></span></th>
                            <th><span class="en">Price</span><span class="ar"><?= getArabicTitle('Price') ?></span></th>
                            <th><span class="en">Total</span><span class="ar"><?= getArabicTitle('Total') ?></span></th>
                            <th><span class="en">Disc %</span><span class="ar"><?= getArabicTitle('Disc %') ?></span></th>
                            <th><span class="en">Disc.</span><span class="ar"><?= getArabicTitle('Disc.') ?></span></th>
                            <th><span class="en">Net Total</span><span class="ar"><?= getArabicTitle('Net Total') ?></span></th>
                            <th><span class="en">CCP</span><span class="ar"><?= getArabicTitle('CCP') ?></span></th>
                            <th><span class="en">ACP</span><span class="ar"><?= getArabicTitle('ACP') ?></span></th>
                            <th><span class="en">SC %</span><span class="ar"><?= getArabicTitle('SC %') ?></span></th>
                            <th><span class="en">S. Price</span><span class="ar"><?= getArabicTitle('S. Price') ?></span></th>
                            <th><span class="en">L. Price</span><span class="ar"><?= getArabicTitle('L. Price') ?></span></th>
                            <th><span class="en">Vat %</span><span class="ar">% <?= getArabicTitle('Vat') ?></span></th>
                            <th><span class="en">Vat Amt</span><span class="ar"><?= getArabicTitle('Vat Amt') ?></span></th>
                            <th><span class="en">Vat Total</span><span class="ar"><?= getArabicTitle('Vat Total') ?></span></th>
                            <th><span class="en">Vat + Total</span><span class="ar"><?= getArabicTitle('Vat + Total') ?></span></th>
                            <th><span class="en">Action</span><span class="ar"><?= getArabicTitle('Action') ?></span></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td style="width:4%">
                                <input type="text" id="code" onkeyup="fetchProductDetailsFromCode(this.value, '')" class="form-control">
                            </td>
                            <td style="width:10%" id="getProductList">
                                <select id="product" class="select2_demo_1 form-control" tabindex="4" onChange="setmyValue(this.value,'code');fetchProductDetails(this.value)">
                                </select>
                            </td>
                            <td style="width:5%" id="loadUnits">

                                <select id="unit" class="form-control" tabindex="4">
                                </select>
                            </td>

                            <td style="width: 5%">
                                <input type="text" id="qty" class="form-control" value="" onkeyup="salesAddRowCalculations();">

                            </td>
                            <td style="width: 5%">
                                <input type="text" id="bonus" class="form-control" value="0">

                            </td>
                            <td style="width: 5%">
                                <input type="text" id="price" class="form-control" value="0" onkeyup="salesAddRowCalculations()">

                            </td>
                            <td style="width: 5%">
                                <input type="text" id="total" class="form-control" value="0">

                            </td>
                            <td style="width: 5%">
                                <input type="text" id="disPer" class="form-control" value="0" onkeyup="salesAddRowCalculations()">
                            </td>

                            <td style="width: 5%">
                                <input type="text" id="disAmt" class="form-control" value="0" onkeyup="calculateDisPer()">

                            </td>
                            <td style="width: 5%">
                                <input type="text" id="net_total" class="form-control" value="0" readonly>
                            </td>
                            <td style="width: 5%">
                                <input type="text" id="cpp" class="form-control" value="0" readonly>
                            </td>
                            <td style="width: 5%">
                                <input type="text" id="acp" class="form-control" value="0" readonly>
                            </td>
                            <td style="width: 5%">
                                <input type="text" id="SCPer" class="form-control" value="0" onkeyup="calculateSPrice()">
                            </td>
                            <td style="width: 5%">
                                <input type="text" id="SPrice" class="form-control" value="0">

                            </td>
                            <td style="width: 5%">
                                <input type="text" id="lprice" class="form-control" value="0">

                            </td>
                            <td style="width: 5%">
                                <input type="text" id="vatPer" class="form-control" value="0" onkeyup="salesAddRowCalculations()" readonly>

                            </td>
                            <td style="width: 5%">
                                <input type="text" id="vatAmt" class="form-control" value="0" readonly>

                            </td>
                            <td style="width: 5%">
                                <input type="text" id="vattotal" class="form-control" value="0" readonly>

                            </td>
                            <td style="width: 18%">
                                <input type="text" id="grand_total" class="form-control" value="0" readonly>

                            </td>


                            <td id="action_id">
                                <button type="button" name="add_row" id="add_row" class="btn btn-info" onclick="addRow()">Add</button>
                            </td>
                            <input type="hidden" id="Pid" name="Pid" value="">
                            <input type="hidden" id="altCode" name="altCode" value="">
                            <input type="hidden" id="actPrice" name="actPrice" value="">
                            <input type="hidden" id="EmpID" name="EmpID" value="">
                            <input type="hidden" id="ResEmpID" name="ResEmpID" value="">
                            <input type="hidden" id="CPrice" name="CPrice" value="">
                            <input type="hidden" id="IsStockCount" name="IsStockCount" value="">
                            <input type="hidden" id="vatPTotal" name="vatPTotal" value="">
                            <input type="hidden" id="unit_name" name="unit_name" value="">
                            <input type="hidden" id="vatSprice" name="vatSprice" value="">
                            <input type="hidden" id="CostPrice" name="CostPrice" value="">
                            <input type="hidden" id="LSPrice" name="LSPrice" value="">
                        </tr>

                    </tbody>
                </table>
            </div>
        </div>


        <div id="screen_sec" style="width: 100%;">
            <div class="row">
                <div class="col-lg-12">
                    <div class="ibox">
                        <div class="ibox-content filter_container">


                            <div style="background: #80808014; height: 150px; width: fit-content;">
                                <table class="table table-bordered direction">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th><span class="en">Code</span><span class="ar"><?= getArabicTitle('Code') ?></span></th>
                                            <th><span class="en">Product</span><span class="ar"><?= getArabicTitle('Product') ?></span></th>
                                            <th><span class="en">Unit</span><span class="ar"><?= getArabicTitle('Unit') ?></span></th>
                                            <th><span class="en">Qty</span><span class="ar"><?= getArabicTitle('Qty') ?></span></th>
                                            <th><span class="en">Bonus</span><span class="ar"><?= getArabicTitle('Bonus') ?></span></th>
                                            <th><span class="en">Price</span><span class="ar"><?= getArabicTitle('Price') ?></span></th>
                                            <th><span class="en">Total</span><span class="ar"><?= getArabicTitle('Total') ?></span></th>
                                            <th><span class="en">Disc %</span><span class="ar"><?= getArabicTitle('Disc %') ?></span></th>
                                            <th><span class="en">Disc.</span><span class="ar"><?= getArabicTitle('Disc.') ?></span></th>
                                            <th><span class="en">Net Total</span><span class="ar"><?= getArabicTitle('Net Total') ?></span></th>
                                            <th><span class="en">CCP</span><span class="ar"><?= getArabicTitle('CCP') ?></span></th>
                                            <th><span class="en">ACP</span><span class="ar"><?= getArabicTitle('ACP') ?></span></th>
                                            <th><span class="en">S. Price</span><span class="ar"><?= getArabicTitle('S. Price') ?></span></th>
                                            <th><span class="en">L. Price</span><span class="ar"><?= getArabicTitle('L. Price') ?></span></th>
                                            <th><span class="en">Vat %</span><span class="ar">% <?= getArabicTitle('Vat') ?></span></th>
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
                        <div class="ibox-content">
                            <div class="row">
                                <div class="col">
                                    <div class="row">
                                        <div class="col-md-4 d-flex justify-content-end">
                                            <h4><span class="en">Total</span><span class="ar"><?= getArabicTitle('Total') ?></span></h4>
                                        </div>
                                        <div class="col-md-8">
                                            <div class="form-total_int">
                                                <input value="<?= $billData->Total ?>" id="f_total_int" name="f_total_int" type="text" readonly class="form-control">
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
                                                <input value="<?= $billData->disper ?>" id="f_dis_per" name="f_dis_per" type="text" class="form-control" onkeyup="salesTotalDiscountCalculation()">
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
                                                <input value="<?= $billData->Discount ?>" id="f_dis_amt" name="f_dis_amt" type="text" class="form-control" onkeyup="salesTotalDiscountCalculationWithAMount()">
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
                                                <input value="<?= $billData->Nettotal ?>" id="f_net_total" name="f_net_total" type="text" class="form-control" onkeyup="salesTotalDiscountCalculationWithAMount()">
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
                                                <input value="<?= round($billData->totalVat, 2) ?>" id="f_total_vat" name="f_total_vat" type="text" readonly class="form-control">
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
                                                    <input value="<?= round($billData->vatPTotal, 2) ?>" id="f_grand_total" name="f_grand_total" type="text" readonly class="form-control">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="row">
                                            <div class="col-md-4 d-flex justify-content-end p-0 m-0">
                                                <h4><span class="en">Expense</span><span class="ar"><?= getArabicTitle('Expense') ?></span></h4>
                                            </div>
                                            <div class="col-md-8">
                                                <div class="form-group">
                                                    <input value="<?= $billData->totalexpense ?>" id="f_expense" name="f_expense" type="text" class="form-control" onkeyup="salesTotalDiscountCalculation()">
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>

                            <hr />

                            <?php
                            $code = $bid;
                            $nrow = 1;
                            ?>

                            <div id="loadBanksagainstBrank">

                                <!-- <label for="" class="form-label add_icon"><span class="en">Banks</span><span class="ar"><?= getArabicTitle('Banks') ?></span></label>

                                <table class="tabel table-bordered table-striped direction" style="width: 100%; margin-top: 10px;">
                                    <thead>
                                        <tr>
                                            <th align="center">#</th>
                                            <th align="center"><span class="en">Bank</span><span class="ar"><?= getArabicTitle('Bank') ?></span></th>
                                            <th align="center"><span class="en">Amount</span><span class="ar"><?= getArabicTitle('Amount') ?></span></th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        <?php
                                        $nrow = 1;
                                        $Bracnhes = Run("exec " . dbObject . "GetPaymentType @bid='$code'");
                                        while ($getBranches = myfetch($Bracnhes)) {
                                        ?>
                                            <tr>
                                                <td align="center"><input type="hidden" id="Bank<?= $nrow ?>" name="Bank<?= $nrow ?>" class="form-control" value="<?php echo $getBranches->id; ?>" readonly> <input type="hidden" id="BankName<?= $nrow ?>" name="BankName<?= $nrow ?>" class="form-control" value="<?php echo $getBranches->snameEng; ?>" readonly>
                                                    <?= $nrow ?></td>
                                                <td align="center">

                                                    <?php echo $getBranches->snameEng; ?>

                                                </td>
                                                <td>
                                                    <input type="text" id="sal_amount<?= $nrow ?>" name="sal_amount<?= $nrow ?>" class="form-control <?php if ($nrow != 1) {
                                                                                                                                                            echo 'salAmnt';
                                                                                                                                                        } ?>  " value="0" onKeyUp="CalculateRemainings()" <?php if ($nrow == 1) {
                                                                                                                                                                                                                echo 'readonly';
                                                                                                                                                                                                            } ?>>
                                                </td>
                                            </tr>

                                        <?php
                                            $nrow++;
                                        }

                                        ?>
                                    </tbody>
                                </table>
                                <input type="hidden" id="bankrows" name="bankrows" value="<?= $nrow ?>"> -->
                                <hr>
                            </div>

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
        </div>


        <div id="fetchProductDetails"></div>
        <!-- <div id="getProductList"></div> -->
        <!-- <div id="loadUnits"></div> -->
        <input type="hidden" name="Bid" id="Bid" value="<?= $bid ?>">
        <input type="hidden" name="row_count" id="row_count" value="0">
</form>

<script>
    $(document).ready(function() {
        $(".i-checks").iCheck({
            checkboxClass: "icheckbox_square-green",
            radioClass: "iradio_square-green",
        });
    });

    $(document).ready(function() {
        $("#Pur_name").select2({
            width: "100%",
            closeOnSelect: true,
            placeholder: "",
            //minimumInputLength: 2,
            ajax: {
                url: "Api/listings/GetPurPurchaserList",
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
                        text: "Please Select Purchaser",
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
        $("#PurType_name").select2({
            width: "100%",
            closeOnSelect: true,
            placeholder: "",
            //minimumInputLength: 2,
            ajax: {
                url: "Api/listings/GetPurTypeList",
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
                        text: "Please Select Purchaser",
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
                        text: "Please Select Supplier",
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
        purchase_return_addRow('<?= $Bid ?>', '<?= $Billno ?>', '<?= $sBid ?>', '<?= $LanguageId ?>');
        loadBanksagainstBranchWithBill('<?= $Bid ?>', '<?= $Billno ?>', '<?= $sBid ?>');
    });
</script>

<script>
    $(document).ready(function () {
        var lang = document.getElementById("selected_lang").value;
        changeLanguage(lang);

        $(".SPType").on("ifChanged", SPType);
        SPType();
});
</script>