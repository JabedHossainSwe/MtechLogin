<?php
session_start();
error_reporting(0);
include("../../config/connection.php");
include("../../config/main_connection.php");
// include("../../config/functions.php");
include("../../config/main_functions.php");
$bid = $_POST['Bid'];
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
                                <h4><span class="en">Total VAT</span><span class="ar"><?= getArabicTitle('Total VAT') ?></span></h4>
                            </div>
                            <div class="col-md-8">
                                <div class="form-total_int">
                                    <input value="0" id="f_total_vat" name="f_total_vat" type="text" readonly class="form-control">
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
                        <div class="col-md-3">
                            <div class="row">
                                <div class="col-md-4 d-flex justify-content-end p-0 m-0">
                                    <h4><span class="en">Expense</span><span class="ar"><?= getArabicTitle('Expense') ?></span></h4>
                                </div>
                                <div class="col-md-8">
                                    <div class="form-group">
                                        <input value="0" id="f_expense" name="f_expense" type="text" class="form-control" onkeyup="salesTotalDiscountCalculation()">
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
                <input type="hidden" id="bankrows" name="bankrows" value="<?= $nrow ?>">

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
  var lang = document.getElementById("selected_lang").value;
  changeLanguage(lang);
});
</script>