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

// echo "Select *,[Discount%] as disper from " . dbObject . "DataOutReturn where Billno = $Billno and Bid = $Bid";
// die();
$QueryGet = Run("Select *,[Discount%] as disper from " . dbObject . "DataOutReturn where Billno = $Billno and Bid = $Bid");
$billData = myfetch($QueryGet);
// print_r($billData);
?>

<form action="javascript:UpdateSalesReturnVoucher()" id="sales_voucher" method="post" class="ibox-content  filter_container">
  <div class="row">
    <div class="col-lg-12">
      <div class="ibox">
        <div class="row">
          <div class="col-lg-6">
            <div class="row">
              <div class="col-md-4">
                <h4><span class="en">Branch</span><span class="ar"><?= getArabicTitle('Branch') ?></span></h4>
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
                      ?>
                          <option value="<?php echo $getBranches->Bid; ?>" <?php echo $selected; ?>><?php echo $getBranches->BName; ?></option>
                      <?php
                        }
                      }
                      ?>
                    </select>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div class="col-lg-6">
            <div class="row">
              <div class="col-md-3">
                <h4><span class="en">Bill No</span><span class="ar"><?= getArabicTitle('Bill No') ?></span></h4>
              </div>
              <div class="col-md-3">
                <div class="form-group">
                  <input value="<?= $Billno ?>" id="bill_no" name="bill_no" type="text" class="form-control">
                  <input value="<?= $billData->sbBillno ?>" id="sbBillno" name="sbBillno" type="hidden" class="form-control">
                </div>
              </div>
              <div class="col-md-6">
                <button type="button" class="btn btn-success" onclick="reloadVoucher()"><i class="fa fa-refresh"></i></button>

                <?php
                $qt = "select BillNo from dataoutreturn where BillNo = (select max(BillNo) from 
dataoutreturn where BillNo < '" . $Billno . "' and Bid='" . $Bid . "' and isDeleted = 0) 
and Bid = '" . $Bid . "' and isDeleted = 0";
                $previousQuery = Run($qt);
                $getPreviousId = myfetch($previousQuery)->BillNo;
                if ($getPreviousId != '') {
                ?>

                  <button type="button" class="btn btn-success" onclick="editVoucher('<?= $Bid ?>','<?= $getPreviousId ?>')"><i class="fa fa-backward"></i></i></button>
                <?php
                }
                $qt = "select BillNo from dataoutreturn where BillNo = (select min(BillNo) from dataoutreturn where BillNo > '" . $Billno . "' and Bid='" . $Bid . "' and isDeleted = 0) and Bid = '" . $Bid . "' and isDeleted = 0";
                $nextQuery = Run($qt);
                $getNextId = myfetch($nextQuery)->BillNo;
                if ($getNextId != '') {
                ?>
                  <button type="button" class="btn btn-success" onclick="editVoucher('<?= $Bid ?>','<?= $getNextId ?>')"><i class="fa fa-forward"></i></i></button>

                <?php } ?>
                <button type="button" class="btn btn-success" onclick="deleteSaleReturn('<?= $Billno ?>', '<?= $Bid ?>', '<?= $sBid ?>')"><i class="fa fa-trash"></i></button>
                <button type="button" class="btn btn-success" onclick="PrintPopupVoucher('<?= $Bid ?>', 'Sales Voucher')"><i class="fa fa-print"></i></button>
                <button type="button" class="btn btn-success" onclick="location.reload()"><i class="fa fa-plus"></i></button>

              </div>
            </div>
          </div>

        </div>

        <div class="row">
          <div class="col-lg-6">
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

          <div class="col-lg-6">
            <div class="row">
              <div class="col-md-4">
                <h4><span class="en">Sale Bill</span><span class="ar"><?= getArabicTitle('Sale Bill') ?></span></h4>
              </div>
              <div class="col-md-4 col-4">
                <div class="i-checks"><label class="">
                    <div class="iradio_square-green ">
                      <div class="iradio_square-green">
                        <input class="form-check-input sale_bill" type="radio" name="sale_bill" id="Yes" <?php if (!empty($billData->RefNo)) {
                                                                                                            echo "Checked";
                                                                                                          } ?> value="Yes">
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
                        <input class="form-check-input sale_bill" type="radio" name="sale_bill" id="No" <?php if (empty($billData->RefNo)) {
                                                                                                          echo "Checked";
                                                                                                        } ?> value="No">
                      </div>
                      <ins class="iCheck-helper"></ins>
                    </div>
                    <i></i> <span class="en">No</span><span class="ar"><?= getArabicTitle('No') ?></span>
                  </label>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-4">
            <div class="row">
              <div class="col-md-4">
                <h4><span class="en">Sale Bill No</span><span class="ar"><?= getArabicTitle('Sale Bill No') ?></span></h4>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <input type="number" class="form-control" value="<?= $billData->RefNo ?>" name="sale_bill_no" id="sale_bill_no">
                </div>
              </div>
              <div class="col-md-2">
                <button type="button" class="btn btn-success" onclick="validateSaleNo(this)"><i class="fa fa-refresh" aria-hidden="true"></i></button>

              </div>
            </div>
          </div>

          <div class="col-lg-4">
            <div class="row">
              <div class="col-md-6 col-6">
                <div class="i-checks"><label class="">
                    <div class="iradio_square-green ">
                      <div class="iradio_square-green">
                        <input type="radio" value="1" class="SPType" <?php if ($billData->SPType == 1) {
                                                                        echo "checked";
                                                                      } ?> name="SPType">
                      </div>
                      <ins class="iCheck-helper"></ins>
                    </div>
                    <i></i> <span class="en">Cash</span><span class="ar"><?= getArabicTitle('Cash') ?></span>
                  </label>
                </div>
              </div>


              <div class="col-md-6 col-6">
                <div class="i-checks"><label class="">
                    <div class="iradio_square-green ">
                      <div class="iradio_square-green">
                        <input type="radio" value="2" <?php if ($billData->SPType == 2) {
                                                        echo "checked";
                                                      } ?> name="SPType" class="SPType">
                      </div>
                      <ins class="iCheck-helper"></ins>
                    </div>
                    <i></i> <span class="en">Credit</span><span class="ar"><?= getArabicTitle('Credit') ?></span>
                  </label>
                </div>
              </div>


            </div>
          </div>

          <div class="col-4">
            <div class="row">
              <div class="col-md-4">
                <h4><span class="en">Sales Man</span><span class="ar"><?= getArabicTitle('Sales Man') ?></span></h4>
              </div>
              <div class="col-md-8">
                <select class="select2_demo_1 form-control" id="salesMan" name="EmpID" aria-label="sales-men">
                  <?php
                  if ($_SESSION['isAdmin'] == '1') {
                    $SalesMan = Run("select  Cid Id,CCode + ' - ' + Cname CName from Emp Where  isnull(IsDeleted,0)=0  order by Cid");
                  } else {
                    $SalesMan = Run("select  Cid Id,CCode + ' - ' + Cname CName from Emp Where  isnull(IsDeleted,0)=0 and webCode = '" . $_SESSION['code'] . "'  order by Cid");
                  }

                  while ($getSalesMan = myfetch($SalesMan)) {
                    $selected = "";

                    if ($getSalesMan->Id == $billData->EmpID) {
                      $selected = "selected";
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

        <div class="row">
          <div class="col-lg-6">
            <div class="row">
              <div class="col-md-4">
                <h4><span class="en">Reference No</span><span class="ar"><?= getArabicTitle('Reference No') ?></span></h4>
              </div>
              <div class="col-md-8">
                <div class="form-group">
                  <input id="RefNo1" name="RefNo1" type="text" value="<?= $billData->sbBillno ?>" readonly class="form-control">
                </div>
              </div>
            </div>
          </div>

          <div class="col-lg-6">
            <div class="row">
              <div class="col-md-4">
                <h4><span class="en">Customer</span><span class="ar"><?= getArabicTitle('Customer') ?></span></h4>
              </div>
              <div class="col-md-8">
                <div class="form-group">
                  <select name="customer_id" id="customer_id" name="customer_id" class="form-control">
                    <option value="<?= $billData->CSID ?>" selected><?= getCustomerDetails($billData->CSID)->CName ?></option>
                  </select>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="row" id="bill_no_area">
        </div>

        <!-- <div class="row justify-content-end mt-1">
<div class="col-md-2">
<button type="button" class="btn btn-block btn-lg btn-outline-success" id="seles_report_search" onclick="validateSaleNo(this)"><span class="en">Submit</span><span class="ar"><?= getArabicTitle('Search') ?></span>
</button>
</div>
</div> -->
      </div>
    </div>
  </div>

  <?php
  $getCurrentEmpData = getCurrentEmpData($_SESSION['storeCode']);
  $Bid = $getCurrentEmpData->BID;
  ?>


  <input type="hidden" name="row_count" id="row_count" value="0">
  <input type="hidden" value="0" name="openStock" id="openStock" class="form-control">
  <!-- <input type="hidden" name="unit" id="unit" readonly class="form-control"> -->


  <p id="fetchProductDetails"></p>

  <div id="CheckSaleBill"></div>

  <div id="saveSalesForm"></div>

  <div id="product_add_addRow">
  </div>

  <div id="screen_sec">
    <div class="row">
      <div class="col-lg-12">
        <div class="ibox">
          <div class="ibox-content  filter_container">
            <div class="row" style="display:block; overflow-x:scroll;">
              <div style="width: 120rem;">
                <table class="table table-bordered">
                  <thead>
                    <tr>
                      <th><span class="en">Code</span><span class="ar"><?= getArabicTitle('Code') ?></span></th>
                      <th><span class="en">Name</span><span class="ar"><?= getArabicTitle('Name') ?></span></th>
                      <th><span class="en">Unit</span><span class="ar"><?= getArabicTitle('Unit') ?></span></th>
                      <th><span class="en">Qty</span><span class="ar"><?= getArabicTitle('Qty') ?></span></th>
                      <th><span class="en">Price</span><span class="ar"><?= getArabicTitle('Price') ?></span></th>
                      <th><span class="en">Total</span><span class="ar"><?= getArabicTitle('Total') ?></span></th>
                      <th><span class="en">Dis Amt</span><span class="ar"><?= getArabicTitle('Dis Amt') ?></span></th>
                      <th><span class="en">Dis Per</span><span class="ar"><?= getArabicTitle('Dis Per') ?></span></th>
                      <th><span class="en">Net Total</span><span class="ar"><?= getArabicTitle('Net Total') ?></span></th>
                      <th><span class="en">Vat %</span><span class="ar"><?= getArabicTitle('Vat %') ?></span></th>
                      <th><span class="en">Vat Amt</span><span class="ar"><?= getArabicTitle('Vat Amt') ?></span></th>
                      <th><span class="en">Vat Total</span><span class="ar"><?= getArabicTitle('Vat Total') ?></span></th>
                      <th><span class="en">Vat + Total</span><span class="ar"><?= getArabicTitle('Vat + Total') ?></span></th>
                      <th><span class="en">Action</span><span class="ar"><?= getArabicTitle('Action') ?></span></th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td style="width:8%">
                        <input type="text" class="form-control" onkeyup="fetchProductDetailsFromCode(this.value, '')" id="Pcode" name="Pcode">
                      </td>
                      <td style="width:15%" id="getProductList">
                        <select id="product" name="product" class="select2_demo_1 form-control" tabindex="4" onChange="setmyValue(this.value,'Pcode');fetchProductUnits(this.value)">
                        </select>
                      </td>
                      <td style="width:5%" id="loadUnits">

                        <select class="form-select" name="unit_id" id="unit_id" aria-label="unit_id" onchange="LoadUnitPrice(this.value,'120')">
                          <option value="">Please Select Unit</option>
                        </select>
                      </td>

                      <td style="width: 8%">
                        <input type="text" name="qty" id="qty" class="form-control" value="1" onkeyup="calculateSingleVatTotal(this.value);">
                      </td>
                      <td style="width: 8%">
                        <input type="text" name="Sprice" id="Sprice" class="form-control" value="0" onkeyup="calculateSingleVatTotal(this.value, 'vatSprice')">
                        <input type="hidden" name="isVat" id="isVat" class="form-control" readonly>
                      </td>
                      <td style="width: 5%">
                        <input type="text" id="total" class="form-control" value="0" readonly>

                      </td>

                      <td style="width: 5%">
                        <input type="text" id="disAmt" class="form-control" value="0" onkeyup="calculateDisPer();">
                      </td>

                      <td style="width: 5%">
                        <input type="text" id="disPer" class="form-control" value="0" onkeyup="calculateDisAmt();">
                      </td>

                      <td style="width: 5%">
                        <input type="text" id="net_total" class="form-control" value="0" readonly>
                      </td>
                      <td style="width: 5%"><input type="text" readonly name="vatPer" id="vatPer" class="form-control" value="0"></td>
                      <td style="width: 5%">
                        <input type="text" name="vatAmt" id="vatAmt" readonly class="form-control" value="0">
                      </td>

                      <td style="width: 5%">
                        <input type="text" id="vattotal" class="form-control" value="0" readonly>

                      </td>
                      <td style="width: 10%"><input type="text" readonly name="vatSprice" id="vatSprice" class="form-control" value="0"></td>


                      <td id="action_id">
                        <button type="button" name="add_row" id="add_row" class="btn btn-info en" onclick="addRow()">Add</button>
                        <button type="button" name="add_row" id="add_row" class="btn btn-info ar" onclick="addRow()"><?= getArabicTitle('Add') ?></button>
                      </td>
                    </tr>

                  </tbody>
                </table>
              </div>
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
                    <th><span class="en">Total</span><span class="ar"><?= getArabicTitle('Total') ?></span></th>
                    <th><span class="en">Dis Amt</span><span class="ar"><?= getArabicTitle('Dis Amt') ?></span></th>
                    <th><span class="en">Dis Per</span><span class="ar"><?= getArabicTitle('Dis Per') ?></span></th>
                    <th><span class="en">Net Total</span><span class="ar"><?= getArabicTitle('Net Total') ?></span></th>
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


    <div class="row total_sec">
      <div class="col-lg-12">
        <div class="ibox">
          <div class="ibox-content  pl-0 pr-0">
            <div class="row">
              <div class="col-lg-2">
                <div class="row">
                  <div class="col-md-4">
                    <h4><span class="en">Total/Int</span><span class="ar"><?= getArabicTitle('Total/Int') ?></span></h4>
                  </div>
                  <div class="col-md-8">
                    <div class="form-total_int">
                      <input value="<?= $billData->Total ?>" id="f_total" name="f_total" type="text" readonly class="form-control">
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-lg-2">
                <div class="row">
                  <div class="col-md-4">
                    <h4><span class="en">Dis%</span><span class="ar"><?= getArabicTitle('Dis') ?></span></h4>
                  </div>
                  <div class="col-md-8">
                    <div class="form-group">
                      <input value="<?= $billData->disper ?>" id="fdisPer" name="fdisPer" type="text" class="form-control" onkeyup="calculateWholeDiscountAmount(this.value)">
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
                      <input value="<?= $billData->Discount ?>" id="fdisAmt" name="fdisAmt" type="text" class="form-control" onkeyup="calculateWholeDiscountper(this.value)">
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
                      <input value="<?= $billData->NetTotal ?>" id="netTotal" name="netTotal" readonly type="text" class="form-control tot_Sprice">
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
                      <input value="<?= $billData->totalVat ?>" id="totVat" name="totVat" readonly type="text" class="form-control">
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-lg-2">
                <div class="row">
                  <div class="col-md-5">
                    <h4><span class="en">Grand Total</span><span class="ar"><?= getArabicTitle('Grand Total') ?></span></h4>
                  </div>
                  <div class="col-md-7">
                    <div class="form-group">
                      <input value="<?= $billData->vatPTotal ?>" id="grandTotal" name="grandTotal" readonly type="text" class="form-control">
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <hr />
            <?php
            $code = $Bid;
            $nrow = 1;
            ?>
            <div id="loadBanksagainstBrank">

              <label for="" class="form-label add_icon"><span class="en">Banks</span><span class="ar"><?= getArabicTitle('Banks') ?></span></label>

              <table class="tabel table-bordered table-striped" style="width: 100%; margin-top: 10px;">
                <thead>
                  <tr>
                    <th align="center">#</th>
                    <th align="center"><span class="en">Banks</span><span class="ar"><?= getArabicTitle('Banks') ?></span></th>
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
                                                                                                                          } ?>" value="0" onKeyUp="CalculateRemainings()" <?php if ($nrow == 1) {
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
              <input type="hidden" id="bankrows" name="bankrows" value="<?= $nrow ?>">
            </div>
            <hr>
            <div class="row">
              <div class="col-lg-4">
              </div>
              <div class="col-lg-4">
                <input type="submit" class="btn btn-block btn-lg btn-outline-success en" name="submit" value="Update">
                <input type="submit" class="btn btn-block btn-lg btn-outline-success ar" name="submit" value="<?= getArabicTitle('Update') ?>">
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
    $("#customer_id").select2({
      width: "100%",
      closeOnSelect: true,
      placeholder: "",
      //minimumInputLength: 2,
      ajax: {
        url: "Api/listings/getCustomers",
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
    // product_add_addRow('<?= $Bid ?>', '<?= $Billno ?>', '<?= $sBid ?>', '<?= $LanguageId ?>');
    sale_return_addRow('<?= $Bid ?>', '<?= $Billno ?>', '<?= $sBid ?>', '<?= $LanguageId ?>');
    loadBanksagainstBranchWithBill('<?= $Bid ?>', '<?= $Billno ?>')

  });
</script>

<script>
  $(document).ready(function () {
      var lang = document.getElementById("selected_lang").value;
      changeLanguage(lang);
  });
</script>