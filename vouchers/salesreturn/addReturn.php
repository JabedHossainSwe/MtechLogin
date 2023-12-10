<?php
session_start();
error_reporting(0);

include("../../config/connection.php");
include("../../config/main_connection.php");
// include("../../config/functions.php");
include("../../config/main_functions.php");
include("../../config/templates.php");

$bid = $_POST['Bid'];

$QueryMax = Run("Select max(Billno) as Bno from " . dbObject . "DataOutReturn");
$getBillNo = myfetch($QueryMax)->Bno + 1;
?>
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

                                <td style="width: 8%">
                                    <input type="text" name="qty" id="qty" class="form-control" value="1" onkeyup="calculateSingleVatTotal(this.value);">
                                </td>
                                <td style="width: 8%">
                                    <input type="text" name="Sprice" id="Sprice" class="form-control" value="0" onkeyup="Pricecalculations(this.value, 'vatSprice')">
                                    <input type="hidden" name="isVat" id="isVat" class="form-control" readonly>
                                </td>
                                <td style="width: 10%">
                                    <input type="text" name="vatAmt" id="vatAmt" readonly class="form-control" value="0">
                                </td>
                                <td><input type="text" readonly name="vatPer" id="vatPer" class="form-control" value="0"></td>
                                <td><input type="text" readonly name="vatSprice" id="vatSprice" class="form-control" value="0"></td>


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
                                <h4><span class="en">Dis%</span><span class="ar"><?= getArabicTitle('Dis%') ?></span></h4>
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
                                <h4><span class="en">Grand Total</span><span class="ar"><?= getArabicTitle('Grand Total') ?></span></h4>
                            </div>
                            <div class="col-md-7">
                                <div class="form-group">
                                    <input value="0" id="grandTotal" name="grandTotal" readonly type="text" class="form-control">
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
                <div class="row">
                    <div class="col-lg-4">
                    </div>
                    <div class="col-lg-4">
                        <input type="button" class="btn btn-block btn-lg btn-outline-success en" name="submit" value="Save" onclick="customerValidation(this);">
                        <input type="button" class="btn btn-block btn-lg btn-outline-success ar" name="submit" value="<?= getArabicTitle('Save') ?>" onclick="customerValidation(this);">
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

<script>
$("#report_type_option").on("change", function () {
	const selected_value = $(this).find(":selected").val();
	$("#report_type").attr("value", selected_value);
	if (selected_value == "group") {
	  $(".toggle_groupbytype,.toggle_orderby").css("display", "none");
	} else {
	  $(".toggle_groupbytype,.toggle_orderby").css("display", "block");
	}
  });
  
  $("#filter").on("click", function () {
	$(".filter_act").click();
	$(".no_envent").toggleClass("displayB");
  });
  $(".ara").on("click", function () {
	$("#selected_lang").attr("value", "2");
	$("span.en").css("display", "none");
	$("span.ar").css("display", "block");
	$(".this_ar").addClass("tb");
  });
  
  $(".eng").on("click", function () {
	$("#selected_lang").attr("value", "1");
	$("span.en").css("display", "block");
	$("span.ar").css("display", "none");
	$(".this_ar").removeClass("tb");
  });
  
  $(document).ready(function () {
	$(".i-checks").iCheck({
	  checkboxClass: "icheckbox_square-green",
	  radioClass: "iradio_square-green",
	});
  });
  
  $(".clockpicker").clockpicker({
	donetext: "Select Time",
  });
  
  var mem = $(".date").datepicker({
	todayBtn: "linked",
	keyboardNavigation: false,
	forceParse: false,
	calendarWeeks: true,
	autoclose: true,
	dateFormat: "yy-mm-dd",
  });

  function setmyValue(vvl, idx) {
	document.getElementById(idx).value = vvl;
  }

$(document).ready(function () {
$("#customer_id").select2({
width: '100%',
closeOnSelect: true,
placeholder: '',
//minimumInputLength: 2,
ajax: {
url: "Api/listings/getCustomers",
dataType: 'JSON',
type: 'POST',
delay: 50,

data: function (query) {
// add any default query here
term:query.terms;
return query;
},
processResults: function (data, params) {

console.log(data);

var results = [];
results.push({
id: 0,
text: "Please Select Customer"
});
// Tranforms the top-level key of the response object from 'items' to 'results'
data.data.forEach(e => {
// cName = e.CName.toLowerCase();
// terms = params.term.toLowerCase();
results.push({
id: e.Id,
text: e.CName
});
});
return {
results: results
};
},
},
//templateResult: formatResult
});


});












$(document).ready(function () {
	$("#product").select2({
	  width: "100%",
	  closeOnSelect: true,
	  placeholder: "",
	  //minimumInputLength: 2,
	  ajax: {
		url: "Api/listings/getProductsWithOutCode",
		dataType: "json",
		type: "POST",
		data: function (query) {
		  // add any default query here
		  term: query.terms;
		  return query;
		},
		processResults: function (data, params) {
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




$(document).ready(function () {
	
$("#salesMan").select2({
width: '100%',
closeOnSelect: true,
placeholder: '',

});



});
</script>

<script>
    $(document).ready(function () {
        var lang = document.getElementById("selected_lang").value;
        changeLanguage(lang);
    });
</script>