<?php
session_start();
error_reporting(0);
include("../../config/connection.php");
// include("../../config/functions.php");
?>



<div class="modal-body " id="modalBody">
    <div class="form-body p-0 m-0">

        <!------First Line------>
        <div class="row d-flex justify-content-between mb-2">
            <div class="col-md-4 row">
                <div class="col-md-4 p-0 m-0">
                    <h4><span class="en">Code</span><span class="ar"><?= getArabicTitle('Code') ?></span></h4>
                </div>
                <div class="form-group col-md-8 p-0 m-0">
                    <input type="text" id="code" onkeyup="fetchProductDetailsFromCode(this.value, '')" class="form-control">
                </div>
            </div>

            <div class="col-md-4 row">
                <div class="col-md-4 p-0 m-0">
                    <h4><span class="en">Product</span><span class="ar"><?= getArabicTitle('Product') ?></span></h4>
                </div>
                <div class="form-group col-md-8 p-0 m-0" id="getProductList">
                    <select id="product" class="select2_demo_1 form-control" tabindex="4" onChange="setmyValue(this.value,'code');fetchProductDetails(this.value)">
                    </select>
                </div>
            </div>

            <div class="col-md-4 row">
                <div class="col-md-4 p-0 m-0">
                    <h4><span class="en">Unit</span><span class="ar"><?= getArabicTitle('Unit') ?></span></h4>
                </div>
                <div class="form-group col-md-8 p-0 m-0" id="loadUnits">
                    <select id="unit" class="form-control" tabindex="4">
                    </select>
                </div>
            </div>
        </div>

        <!------Second Line------>
        <div class="row d-flex justify-content-between mb-2">
            <div class="col-md-4 row">
                <div class="col-md-4 p-0 m-0">
                    <h4><span class="en">Qty</span><span class="ar"><?= getArabicTitle('Qty') ?></span></h4>
                </div>
                <div class="form-group col-md-8 p-0 m-0">
                    <input type="text" id="qty" class="form-control" value="" onkeyup="salesAddRowCalculations();">
                </div>
            </div>

            <div class="col-md-4 row">
                <div class="col-md-4 p-0 m-0">
                    <h4><span class="en">Bonus</span><span class="ar"><?= getArabicTitle('Bonus') ?></span></h4>
                </div>
                <div class="form-group col-md-8 p-0 m-0">
                    <input type="text" id="bonus" class="form-control" value="0">
                </div>
            </div>

            <div class="col-md-4 row">
                <div class="col-md-4 p-0 m-0">
                    <h4><span class="en">Price</span><span class="ar"><?= getArabicTitle('Price') ?></span></h4>
                </div>
                <div class="form-group col-md-8 p-0 m-0">
                    <input type="text" id="price" class="form-control" value="0" onkeyup="salesAddRowCalculations()">
                </div>
            </div>
        </div>

        <!------Third Line------>
        <div class="row d-flex justify-content-between mb-2">
            <div class="col-md-4 row">
                <div class="col-md-4 p-0 m-0">
                    <h4><span class="en">Total</span><span class="ar"><?= getArabicTitle('Total') ?></span></h4>
                </div>
                <div class="form-group col-md-8 p-0 m-0">
                    <input type="text" id="total" class="form-control" value="0">
                </div>
            </div>

            <div class="col-md-4 row">
                <div class="col-md-4 p-0 m-0">
                    <h4><span class="en">Disc %</span><span class="ar">% <?= getArabicTitle('Disc') ?></span></h4>
                </div>
                <div class="form-group col-md-8 p-0 m-0">
                    <input type="text" id="disPer" class="form-control" value="0" onkeyup="salesAddRowCalculations()">
                </div>
            </div>

            <div class="col-md-4 row">
                <div class="col-md-4 p-0 m-0">
                    <h4><span class="en">Disc.</span><span class="ar">.<?= getArabicTitle('Disc') ?></span></h4>
                </div>
                <div class="form-group col-md-8 p-0 m-0">
                    <input type="text" id="disAmt" class="form-control" value="0" onkeyup="salesTotalDiscountCalculationWithAMount()">
                </div>
            </div>
        </div>

        <!------Fourth Line------>
        <div class="row d-flex justify-content-between mb-2">
            <div class="col-md-4 row">
                <div class="col-md-4 p-0 m-0">
                    <h4><span class="en">Net Total</span><span class="ar"><?= getArabicTitle('Net Total') ?></span></h4>
                </div>
                <div class="form-group col-md-8 p-0 m-0">
                    <input type="text" id="net_total" class="form-control" value="0" readonly onkeyup="salesAddRowCalculations()">
                </div>
            </div>

            <div class="col-md-4 row">
                <div class="col-md-4 p-0 m-0">
                    <h4><span class="en">CPP</span><span class="ar">CPP<?= getArabicTitle('Grand Total') ?></span></h4>
                </div>
                <div class="form-group col-md-8 p-0 m-0">
                    <input type="text" id="cpp" class="form-control" value="0" readonly>
                </div>
            </div>

            <div class="col-md-4 row">
                <div class="col-md-4 p-0 m-0">
                    <h4><span class="en">ACP</span><span class="ar">ACP<?= getArabicTitle('Grand Total') ?></span></h4>
                </div>
                <div class="form-group col-md-8 p-0 m-0">
                    <input type="text" id="acp" class="form-control" value="0" readonly>
                </div>
            </div>
        </div>


        <!------Fifth Line------>
        <div class="row d-flex justify-content-between mb-2">
        <div class="col-md-4 row">
                <div class="col-md-4 p-0 m-0">
                    <h4><span class="en">SC %</span><span class="ar">% <?= getArabicTitle('SC') ?></span></h4>
                </div>
                <div class="form-group col-md-8 p-0 m-0">
                    <input type="text" id="SCPer" class="form-control" value="0" onkeyup="calculateSPrice()">
                </div>
            </div>

            <div class="col-md-4 row">
                <div class="col-md-4 p-0 m-0">
                    <h4><span class="en">S. Price</span><span class="ar"><?= getArabicTitle('S. Price') ?></span></h4>
                </div>
                <div class="form-group col-md-8 p-0 m-0">
                    <input type="text" id="SPrice" class="form-control" value="0">
                </div>
            </div>

            <div class="col-md-4 row">
                <div class="col-md-4 p-0 m-0">
                    <h4><span class="en">L. Price</span><span class="ar"><?= getArabicTitle('L. Price') ?></span></h4>
                </div>
                <div class="form-group col-md-8 p-0 m-0">
                    <input type="text" id="lprice" class="form-control" value="0">
                </div>
            </div>

            
        </div>

        <!------Sisth Line------>
        <div class="row d-flex justify-content-between mb-2">

        <div class="col-md-4 row">
                <div class="col-md-4 p-0 m-0">
                    <h4><span class="en">Vat %</span><span class="ar">% <?= getArabicTitle('Vat') ?></span></h4>
                </div>
                <div class="form-group col-md-8 p-0 m-0">
                    <input type="text" id="vatPer" class="form-control" value="0" onkeyup="salesAddRowCalculations()" readonly>
                </div>
            </div>

            <div class="col-md-4 row">
                <div class="col-md-4 p-0 m-0">
                    <h4><span class="en">Vat Amt</span><span class="ar"><?= getArabicTitle('Vat Amt') ?></span></h4>
                </div>
                <div class="form-group col-md-8 p-0 m-0">
                    <input type="text" id="vatAmt" class="form-control" value="0" readonly>
                </div>
            </div>

            <div class="col-md-4 row">
                <div class="col-md-4 p-0 m-0">
                    <h4><span class="en">Vat Total</span><span class="ar"><?= getArabicTitle('Vat Total') ?></span></h4>
                </div>
                <div class="form-group col-md-8 p-0 m-0">
                    <input type="text" id="vattotal" class="form-control" value="0" readonly>
                </div>
            </div>

            
        </div>

        <!------Seventh Line------>
        <div class="row d-flex justify-content-between mb-2">
        <div class="col-md-6 row offset-md-3">
                <div class="col-md-4 p-0 m-0">
                    <h4><span class="en">Vat + Total</span><span class="ar"><?= getArabicTitle('Vat + Total') ?></span></h4>
                </div>
                <div class="form-group col-md-8 p-0 m-0">
                    <input type="text" id="grand_total" class="form-control" value="0" readonly>
                </div>
            </div>
        </div>

        <div class="col-lg-2 ml-auto mr-auto mb-3" id="action_id">
            <button type="button" name="add_row" id="add_row" class="btn btn-info" onclick="addRow()" data-dismiss="modal"><span class="en">Add</span><span class="ar"><?= getArabicTitle('Add') ?></span></button>
        </div>
    </div>


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
    <input type="hidden" id="level3" name="level3" value="">
</div>


<script>
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
</script>

<style>
.select2-dropdown
{
	  z-index: 99999;
}
</style>