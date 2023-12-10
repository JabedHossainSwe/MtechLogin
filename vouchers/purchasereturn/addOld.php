<?php
session_start();
error_reporting(0);
include("../../config/connection.php");
include("../../config/main_connection.php");
// include("../../config/functions.php");
include("../../config/main_functions.php");
// include("../../Lib/qrCode/qrlib.php");

// $bid = $_POST['Bid'];
// $billNo = $_POST['billNo'];

// $sbid = "2";
// $bQ = Run("Select * from " . dbObject . "Branch where Bid = '" . $bid . "'");
// $getBData = myfetch($bQ);
// if ($getBData->ismain == '1') {
//   $sbid = "1";
// }

// echo "EXECUTE " . dbObject . " [SPPurchaseDetSelectWeb] @Billno= '" . $billNo . "' ,@Bid= '" . $bid . "' ,@sBid= '" . $sbid . "'";
// die();
// // $getPurchse = Run("Select * from " . dbObject . "Branch where Bid = '" . $bid . "'");
// echo $getPurchse = Run("EXECUTE " . dbObject . " [SPPurchaseDetSelectWeb] @Billno= '" . $billNo . "' ,@Bid= '" . $bid . "' ,@sBid= '" . $sbid . "'");
// $fetchPurchse = myfetch($getPurchse);

// print_r($fetchPurchse);
// die();

$Bid = addslashes(trim($_POST['Bid']));
$Billno = addslashes(trim($_POST['billNo']));
$Billno = !empty($Billno) ? $Billno : '0';
$Bid = !empty($Bid) ? $Bid : '2';
$Billno = (int)$Billno;
$LanguageId = $_REQUEST['LanguageId'];
$LanguageId = !empty($LanguageId) ? $LanguageId : '1';
$sBid = "2";
$bQ = Run("Select * from " . dbObject . "Branch where Bid = '" . $Bid . "'");
$getBData = myfetch($bQ);
if ($getBData->ismain == '1') {
    $sBid = "1";
}


// $exe = "Exec ".dbObject."SPSalesSelectWeb @SrchBy=1,@Billno=$Billno,@Bid=$Bid,@sBid=1,@LanguageId=$LanguageId,@FRecNo=0,@ToRecNo=1";

$exe = "Exec " . dbObject . "SPPurchaseSelectWeb @SrchBy=1 ,@Billno=$Billno,@Bid=$Bid,@sBid=$sBid,@LanguageId=$LanguageId,@FRecNo=0,@ToRecNo=1";

$storeProcedure = Run($exe);
$myFetch = myfetch($storeProcedure);
if($myFetch){
// print_r($myFetch);
// die();
$Billno = $myFetch->BillNo;
$SPType = $myFetch->SPType;
$RefNo = $myFetch->RefNo;
$Total = $myFetch->Total;
$Discount = $myFetch->Discount;
$Comments = $myFetch->Comments;
$Nettotal = $myFetch->Nettotal;
$totalexpense = $myFetch->totalexpense;
$SupDisPer = $myFetch->SupDisPer;
$purType = $myFetch->purType;
$dueDays = $myFetch->dueDays;
$totalVat = $myFetch->totalVat;
$vatPTotal = $myFetch->vatPTotal;
$EmpID = $myFetch->EmpID;
$ResEmpID = $myFetch->ResEmpID;
$disper = "Discount%";
$DiscountPer = $myFetch->$disper;
$Pur_id = $myFetch->Pur_id;

$getPur = "select * from Purchaser where Cid = $Pur_id";
$fetchPur = Run($getPur);
$PurData = myfetch($fetchPur);
$PurName = $PurData->CName;
}
else{
    ?>
    <script>
        $("#purchase_bill_no").css("border", "2px solid red");
    </script>
    <?php
    die();
}

?>
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
                                <th><span class="en">Disc %</span><span class="ar">% <?= getArabicTitle('Disc') ?></span></th>
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

                            <?php
                            $nrow = 1;

                            $storeProcedure = Run("EXECUTE " . dbObject . " [SPPurchaseDetSelectWeb] @Billno=$Billno,@Bid=$Bid,@sBid=$sBid");
                            while ($item = myfetch($storeProcedure)) {
                                // print_r($item);
                                // die();
                            ?>
                                <tr id="row_<?= $nrow ?>">
                                    <td><?= $nrow ?></td>
                                    <td><input type="hidden" name="code<?= $nrow ?>" id="code<?= $nrow ?>" value="<?=$item->PCode?>"><?=$item->PCode?></td>
                                    <td><input type="hidden" name="product_name<?= $nrow ?>" id="product_name<?= $nrow ?>" value="<?=$item->PName?>"><?=$item->PName?></td>
                                    <td><input type="hidden" name="unit_name<?= $nrow ?>" id="unit_name<?= $nrow ?>" value="<?=$item->ParaName?>"><?=$item->ParaName?></td>
                                    <td><input type="hidden" name="qty<?= $nrow ?>" class="t_qty" id="qty<?= $nrow ?>" value="<?=$item->Qty?>"><?=$item->Qty?></td>
                                    <td><input type="hidden" name="bonus<?= $nrow ?>" class="t_bonus" id="bonus<?= $nrow ?>" value="<?=$item->Bonus?>"><?=$item->Bonus?></td>
                                    <td><input type="hidden" name="price<?= $nrow ?>" class="t_price" id="price<?= $nrow ?>" value="<?=$item->Price?>"><?=$item->Price?></td>
                                    <td><input type="hidden" name="total<?= $nrow ?>" class="t_total" id="total<?= $nrow ?>" value="<?=$item->Total?>"><?=$item->Total?></td>

                                    <td><input type="hidden" name="disPer<?= $nrow ?>" class="t_disPer" id="disPer<?= $nrow ?>" value="<?=$item->disPer?>"><?=$item->disPer?></td>
                                    <td><input type="hidden" name="disAmt<?= $nrow ?>" class="t_disAmt" id="disAmt<?= $nrow ?>" value="<?=$item->Discount?>"><?=$item->Discount?></td>
                                    <td><input type="hidden" name="net_total<?= $nrow ?>" class="t_net_total" id="net_total<?= $nrow ?>" value="<?=$item->NetTotal?>"><?=$item->NetTotal?></td>

                                    <td><input type="hidden" name="cpp<?= $nrow ?>" class="t_cpp" id="cpp<?= $nrow ?>" value="<?=$item->Cpp?>"><?=$item->Cpp?></td>
                                    <td><input type="hidden" name="acp<?= $nrow ?>" class="t_acp" id="acp<?= $nrow ?>" value="<?=round($item->ACP, 2)?>"><?=round($item->ACP, 2)?></td>
                                    <td><input type="hidden" name="SPrice<?= $nrow ?>" class="t_SPrice" id="SPrice<?= $nrow ?>" value="<?=$item->sPrice?>"><?=$item->sPrice?></td>
                                    <td><input type="hidden" name="lprice<?= $nrow ?>" class="t_lprice" id="lprice<?= $nrow ?>" value="<?=$item->leastSPrice?>"><?=$item->leastSPrice?></td>
                                    <td><input type="hidden" name="vatPer<?= $nrow ?>" class="t_vatPer" id="vatPer<?= $nrow ?>" value="<?=$item->vatPer?>"><?=$item->vatPer?></td>
                                    <td><input type="hidden" name="vatAmt<?= $nrow ?>" class="t_vatAmt" id="vatAmt<?= $nrow ?>" value="<?= round($item->vatAmt, 2)?>"><?=round($item->vatAmt, 2)?></td>
                                    <td><input type="hidden" name="vattotal<?= $nrow ?>" class="t_vattotal" id="vattotal<?= $nrow ?>" value="<?= round($item->vatTotal, 2)?>"><?= round($item->vatTotal, 2)?></td>

                                    <td><input type="hidden" name="grand_total<?= $nrow ?>" class="t_grandtotal" id="grand_total<?= $nrow ?>" value="<?=$item->vatTotal + $item->Total?>"><?=$item->vatTotal + $item->Total?></td>

                                    <td>
                                        <i class="fa fa-pencil" onclick="edit_row(<?= $nrow ?>)"></i>&nbsp;&nbsp;&nbsp;<i class="fa fa-trash" onclick="delete_row(<?= $nrow ?>)"></i>
                                        <input type="hidden" id="Pid<?= $nrow ?>" name="Pid<?= $nrow ?>" value="<?=$item->Pid?>">
                                        <input type="hidden" id="altCode<?= $nrow ?>" name="altCode<?= $nrow ?>" value="<?=$item->altCode?>">
                                        <input type="hidden" id="actPrice<?= $nrow ?>" name="actPrice<?= $nrow ?>" value="<?=$item->actPrice?>">
                                        <input type="hidden" id="SCPer<?= $nrow ?>" name="SCPer<?= $nrow ?>" value="<?=$item->SCPer?>">
                                        <!-- <input type="hidden" id="EmpID<?= $nrow ?>" name="EmpID<?= $nrow ?>" value="<?=$EmpID?>"> -->
                                        <!-- <input type="hidden" id="ResEmpID<?= $nrow ?>" name="ResEmpID<?= $nrow ?>" value="<?=$ResEmpID?>"> -->
                                        <input type="hidden" id="CPrice<?= $nrow ?>" name="CPrice<?= $nrow ?>" value="">
                                        <input type="hidden" id="IsStockCount<?= $nrow ?>" name="IsStockCount<?= $nrow ?>" value="">
                                        <input type="hidden" id="vatPTotal<?= $nrow ?>" name="vatPTotal<?= $nrow ?>" value="<?=$vatPTotal?>">
                                        <input type="hidden" id="unit<?= $nrow ?>" name="unit<?= $nrow ?>" value="1">
                                        <input type="hidden" id="vatSprice<?= $nrow ?>" name="vatSprice<?= $nrow ?>" value="<?=$item->vatSPrice?>">
                                        <input type="hidden" id="CostPrice<?= $nrow ?>" name="CostPrice<?= $nrow ?>" value="<?=$item->costprice?>">
                                        <input type="hidden" id="LSPrice<?= $nrow ?>" name="LSPrice<?= $nrow ?>" value="<?=$item->leastSPrice?>">
                                    </td>
                                </tr>

                                <script>
                                    $(document).ready(function() {
                                        // salesTotalCalculation()
                                    });
                                </script>

                            <?php
                                $nrow++;
                            }
                            ?>
                            

                        </tbody>
                    </table>

                    <input type="hidden" id="EmpID" name="EmpID" value="<?=$EmpID?>">
                    <input type="hidden" id="ResEmpID" name="ResEmpID" value="<?=$ResEmpID?>">
                                        
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
                                    <input value="<?= AmountValue($Total) ?>" id="f_total_int" name="f_total_int" type="text" readonly="" class="form-control">
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
                                    <input value="<?= AmountValue($DiscountPer) ?>" id="f_dis_per" name="f_dis_per" type="text" class="form-control" onkeyup="salesTotalDiscountCalculation()">
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
                                    <input value="<?= round($Discount, 2) ?>" id="f_dis_amt" name="f_dis_amt" type="text" class="form-control" onkeyup="salesTotalDiscountCalculationWithAMount()">
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
                                    <input value="<?= AmountValue($Nettotal) ?>" id="f_net_total" name="f_net_total" type="text" class="form-control" onkeyup="salesTotalDiscountCalculationWithAMount()">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="row">
                            <div class="col-md-4 d-flex justify-content-end m-0 p-0">
                                <h4><span class="en">Total VAT</span><span class="ar"><?= getArabicTitle('Total VAT') ?></span></h4>
                            </div>
                            <div class="col-md-8">
                                <div class="form-total_int">
                                    <input value="<?= round($totalVat, 2) ?>" id="f_total_vat" name="f_total_vat" type="text" readonly="" class="form-control">
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
                                        <input value="<?= AmountValue($vatPTotal)?>" id="f_grand_total" name="f_grand_total" type="text" readonly="" class="form-control">
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
                                        <input value="<?= AmountValue($totalexpense) ?>" id="f_expense" name="f_expense" type="text" class="form-control" onkeyup="salesTotalDiscountCalculation()">
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

                <hr>


                <label for="" class="form-label add_icon"><span class="en">Banks</span><span class="ar"><?= getArabicTitle('Banks') ?></span></label>

                <table class="tabel table-bordered table-striped direction" style="width: 100%; margin-top: 10px;">
                    <thead>
                        <tr>
                            <th align="center">#</th>
                            <th align="center"><span class="en">Bank</span><span class="ar"><?= getArabicTitle('Bank') ?></span></th>
                            <th align="center"><span class="en">Amount</span><span class="ar"><?= getArabicTitle('Amount') ?></span></th>
                        </tr>
                    </thead>
                    <tbody>

                        <tr>
                            <td align="center"><input type="hidden" id="Bank1" name="Bank1" class="form-control" value="7" readonly=""> <input type="hidden" id="BankName1" name="BankName1" class="form-control" value="cash" readonly="">
                                1</td>
                            <td align="center">

                                cash
                            </td>
                            <td>
                                <input type="text" id="sal_amount1" name="sal_amount1" class="form-control" value="<?= $vatPTotal?>" onkeyup="CalculateRemainings()" readonly="">
                            </td>
                        </tr>

                        <tr>
                            <td align="center"><input type="hidden" id="Bank2" name="Bank2" class="form-control" value="8" readonly=""> <input type="hidden" id="BankName2" name="BankName2" class="form-control" value="test" readonly="">
                                2</td>
                            <td align="center">

                                test
                            </td>
                            <td>
                                <input type="text" id="sal_amount2" name="sal_amount2" class="form-control salAmnt  " value="0" onkeyup="CalculateRemainings()">
                            </td>
                        </tr>

                    </tbody>
                </table>
                <input type="hidden" id="bankrows" name="bankrows" value="3">

                <hr>
                <div class="row d-flex justify-content-center">
                    <div class="col-lg-3">
                        <input type="submit" class="btn btn-block btn-lg btn-outline-success" name="submit" value="Save">
                    </div>

                </div>


            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function () {
        $("#purchase_bill_no").css("border", "2px solid green");
        $("#RefNo1").val('<?= $RefNo ?>');
        $("#remarks").val('<?= $Comments ?>');
        $("#due").val(<?= $dueDays ?>);
        $("#dis_per").val(<?= $SupDisPer ?>);
        $("#PurType").val('<?= $purType ?>');
        $("#supplier_id").val('<?= $myFetch->CustCode ?>');
        $("#Pur_id").val('<?= $Pur_id ?>');

        var code = <?= $Pur_id ?>;
        var product_name = '<?= $PurName ?>';

        var newOption = new Option(code + " - " + product_name, code, true, true);
        // Append it to the select
        $("#Pur_name").append(newOption);
        $("#Pur_name").select2("destroy");
        $("#Pur_name").val(code).select2();
        

        var code = <?= $purType ?>;
        var product_name = '<?= $myFetch->PurchaseTypeName ?>';

        var newOption = new Option(code + " - " + product_name, code, true, true);
        // Append it to the select
        $("#PurType_name").append(newOption);
        $("#PurType_name").select2("destroy");
        $("#PurType_name").val(code).select2();

        var code = <?= $myFetch->CustCode ?>;
        var product_name = '<?= $myFetch->CustName ?>';

        var newOption = new Option(code + " - " + product_name, code, true, true);
        // Append it to the select
        $("#supplier_name").append(newOption);
        $("#supplier_name").select2("destroy");
        $("#supplier_name").val(code).select2();
    });
</script>

        <!-- // var option = "<option value="<?= $myFetch->purType ?>"><?= getPurchaseTypeDetails($myFetch->purType)->CName ?></option>"; -->
        <!-- // $("#PurType_name").html(option); -->
    <!-- }); -->
<!-- </script> -->

<script>
    $(document).ready(function () {
        var lang = document.getElementById("selected_lang").value;
        changeLanguage(lang);
        $("#row_count").val('<?= $nrow-1 ?>');
});
</script>