// Toast Type
// toastr.success('You clicked Success toast');

// toastr.info('You clicked Info toast')

// toastr.error('You clicked Error Toast')

// toastr.warning('You clicked Warning Toast')

// var count = 1;
// document.getElementById('branch_all').onclick = function() {
//    alert("button was clicked " + (count++) + " times");
// };
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
  $(".add_me").addClass("rv");
  $(".this_ar").addClass("tb");
});

$(".eng").on("click", function () {
  $("#selected_lang").attr("value", "1");
  $("span.en").css("display", "block");
  $("span.ar").css("display", "none");
  $(".add_me").removeClass("rv");
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
    width: "100%",
    closeOnSelect: true,
    placeholder: "",
    //minimumInputLength: 2,
    ajax: {
      url: "Api/listings/getCustomers",
      dataType: "JSON",
      type: "POST",
      data: function (query) {
        // add any default query here
        term: query.terms;
        return query;
      },
      processResults: function (data, params) {
        console.log(data);

        var results = [];
        if(document.getElementById("selected_lang").value == 1){
          results.push({
            id: 0,
            text: "Please Select"
          });
        }
        else{
          results.push({
            id: 0,
            text: "الرجاء التحديد"
          });
        }
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

        if(document.getElementById("selected_lang").value == 1){
          results.push({
            id: 0,
            text: "Please Select"
          });
        }
        else{
          results.push({
            id: 0,
            text: "الرجاء التحديد"
          });
        }
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
  $("#product_group_name").select2({
    width: "100%",
    closeOnSelect: true,
    placeholder: "",
    //minimumInputLength: 2,
    ajax: {
      url: "Api/listings/getProductGroup",
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
        if(document.getElementById("selected_lang").value == 1){
          results.push({
            id: 0,
            text: "Please Select"
          });
        }
        else{
          results.push({
            id: 0,
            text: "الرجاء التحديد"
          });
        }
        data.data.forEach((e) => {
          // cName = e.CName.toLowerCase();
          // terms = params.term.toLowerCase();

          //if (cName.includes(terms)) {
          results.push({
            id: e.Id,
            text: e.CName,
          });

          //}
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
  $("#unit").select2({
    width: "100%",
    closeOnSelect: true,
    placeholder: "",
  });
});

// function validateInput(arr){
//   arr.forEach( (arrs) => {
//     if($("#"+arrs).val() == ""){
//       // console.log($("#"+arrs).localName());
//         toastr.error('Feild required');
//         $("#"+arrs).css("border-color","#c85c57");
//         $("#"+arrs).focus();
//         return false;
//     }else{
//       console.log($("#"+arrs).val())
//     }
//   })
// }

function addRow() {
  var code = $("#Pcode").val();
  var product = $("#product").val();
  var product_name = $("#product").text();
  var unit = $("#unit_id").val();
  var unit_name = $("#unit_id :selected").text();
  var qty = $("#qty").val();
  var price = $("#Sprice").val();
  var vatAmt = $("#vatAmt").val();
  var vatPer = $("#vatPer").val();
  var total = $("#vatSprice").val();
  var Bid = $("#Bid").val();
  var isVat = $("#isVat").val();
  var vatTotal = $("#vatTotal").val();

  // var gst_total = $("#gst_total").val();
  // var grand_total = $("#grand_total").val();

  if (code == "" || code == 0) {
    document.getElementById("Pcode").style.border = "1px solid red";
    $("#Pcode").focus();
    return false;
  }

  if (product == "") {
    document.getElementById("product").style.border = "1px solid red";
    $("#product").focus();
    return false;
  }

  if (unit == "") {
    document.getElementById("unit_id").style.border = "1px solid red";
    $("#unit_id").focus();
    return false;
  }

  if (qty == "") {
    document.getElementById("qty").style.border = "1px solid red";
    $("#qty").focus();
    return false;
  }

  if (price == "") {
    document.getElementById("Sprice").style.border = "1px solid red";
    $("#Sprice").focus();
    return false;
  }

  if (total == "") {
    document.getElementById("vatSprice").style.border = "1px solid red";
    $("#vatSprice").focus();
    return false;
  }

  if (vatPer == "") {
    document.getElementById("vatPer").style.border = "1px solid red";
    $("#vatPer").focus();
    return false;
  }

  if (vatAmt == "") {
    document.getElementById("vatAmt").style.border = "1px solid red";
    $("#vatAmt").focus();
    return false;
  }

  var row_count = parseInt($("#row_count").val()) + 1;

  var in_html = $("#row_append").html();

  $("#row_append").innerHTML =
    "<img src='loader/wheel.gif' style='width:10%' />";

  $.post(
    "vouchers/quotation/addRow.php",
    {
      Pcode: code,
      product: product_name,
      unit_id: unit,
      unit: unit_name,
      qty: qty,
      Sprice: price,
      row_count: row_count,
      Bid: Bid,
      vatPer: vatPer,
      vatAmt: vatAmt,
      vatSprice: total,
      isVat: isVat,
      vatTotal: vatTotal,
    },
    function (data) {
      // console.log(data);
      $("#row_append").html(data);
      $("#row_append").append(in_html);
      $("#row_count").val(row_count);

      $("#product").each(function () {
        //added a each loop here
        $(this).select2("val", "");
      });

      product_name = "";
      $("#Pcode").val();
      $("#product").val("");
      $("#unit_id").val("");
      $("#qty").val(0);
      $("#Sprice").val(0);
      $("#vatAmt").val(0);
      $("#vatPer").val(0);
      $("#vatSprice").val(0);
      $("#vatTotal").val(0);
    }
  );
}

function findRowTotal() {}

function edit_row(idx) {
  var code = $("#code" + idx).val();
  var product_name = $("#product_name" + idx).val();
  var unit = $("#unit" + idx).val();
  var qty = $("#qty" + idx).val();
  var price = $("#Sprice" + idx).val();
  var vatPer = $("#vatPer" + idx).val();
  var vatAmt = $("#vatAmt" + idx).val();
  var grand_total = $("#vatSprice" + idx).val();
  var vatTotal = $("#vatTotal" + idx).val();

  $("#add_sec").css("display", "block");

  $("#Pcode").val(code);
  //$("#product").select2("val", "");

  var newOption = new Option(code + " - " + product_name, code, true, true);
  // Append it to the select
  $("#product").append(newOption);
  // $("#product").select2("val", code);

  $("#product").select2("destroy");
  $("#product").val(code).select2();

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
    // $("#unit_id").val(unit);
    setProductUnits(code, unit);
    $("#qty").val(qty);
    $("#Sprice").val(price);
    $("#vatPer").val(vatPer);
    $("#vatAmt").val(vatAmt);
    $("#vatSprice").val(grand_total);
    $("#vatTotal").val(vatTotal);
  });

  $("#action_id").html(
    '<button type="button" name="add_row" id="add_row" class="btn btn-info" onclick="updateRow(' +
      idx +
      ')">Update</button>'
  );
}

function updateRow(idx) {
  var code = $("#Pcode").val();
  var product = code;
  var product_name = $("#product").text();
  var unit = $("#unit_id").val();
  var unit_name = $("#unit_id :selected").text();
  var qty = $("#qty").val();
  var price = $("#Sprice").val();
  var vatAmt = $("#vatAmt").val();
  var vatPer = $("#vatPer").val();
  var total = $("#vatSprice").val();
  var vatTotal = $("#vatTotal").val();
  var isVat = $("#isVat").val();
  var Bid = $("#Bid").val();

  $("#add_sec").css("display", "none");

  if (code == "") {
    document.getElementById("code").style.border = "1px solid red";
    $("#code").focus();
    return false;
  }
  if (product == "") {
    document.getElementById("product").style.border = "1px solid red";
    $("#product").focus();
    return false;
  }
  if (qty == "") {
    document.getElementById("qty").style.border = "1px solid red";
    $("#qty").focus();
    return false;
  }
  if (price == "") {
    document.getElementById("price").style.border = "1px solid red";
    $("#price").focus();
    return false;
  }
  if (total == "") {
    document.getElementById("total").style.border = "1px solid red";
    $("#total").focus();
    return false;
  }
  if (vatPer == "") {
    document.getElementById("vatPer").style.border = "1px solid red";
    $("#vatPer").focus();
    return false;
  }
  if (vatAmt == "") {
    document.getElementById("vatAmt").style.border = "1px solid red";
    $("#vatAmt").focus();
    return false;
  }

  // var row_count = parseInt($("#row_count").val()) + 1;
  var in_html = $("#row_append").html();
  $("#row_append").innerHTML =
    "<img src='loader/wheel.gif' style='width:10%' />";

  $.post(
    "vouchers/quotation/updateRow.php",
    {
      Pcode: code,
      product: product_name,
      unit_id: unit,
      unit: unit_name,
      qty: qty,
      Sprice: price,
      Bid: Bid,
      vatPer: vatPer,
      vatAmt: vatAmt,
      vatSprice: total,
      vatTotal: vatTotal,
      isVat: isVat,
      row_count: idx,
    },
    function (data) {
      // console.log(data);
      $("#row_" + idx).html(data);

      $("#code").val("");
      $("#product").select2("val", "");

      $("#unit_id").val("");
      $("#qty").val(0);
      $("#Sprice").val(0);
      $("#vatPer").val(0);
      $("#vatAmt").val(0);
      $("#vatSprice").val(0);
      $("#vatTotal").val(0);

      $("#action_id").html(
        '<button type="button" name="add_row" id="add_row" class="btn btn-info" onclick="addRow()" >Add</button>'
      );
    }
  );
}

function delete_row(id) {
  var result = confirm("Want to delete?");
  if (result) {
    $("#row_" + id).remove();
    salesTotalCalculation();
  }
}

function getProductUnit(code) {
  document.getElementById("getProductUnit").innerHTML =
    "<div style='background: #fff;text-align:center'><img width='80px' src='assets/img/loaders/loader.gif'/><div>";

  $.post(
    "vouchers/quotation/getProductUnit.php",
    {
      code: code,
    },
    function (data) {
      $("#getProductUnit").html(data);
    }
  );
}

function salesAddRowCalculations() {
  var qty = $("#qty").val();
  var price = $("#price").val();
  var total = parseFloat(qty) * parseFloat(price);
  $("#total").val(total);

  var gst_per = $("#gst_per").val();
  var gst_amt = (parseFloat(total) * parseFloat(gst_per)) / 100;
  $("#gst_amt").val(gst_amt);

  var gst_total = parseFloat(total) + parseFloat(gst_amt);
  $("#gst_total").val(gst_total);
  $("#grand_total").val(gst_total);

  var adv_tax_per = $("#adv_tax_per").val();

  var gst_amt = (parseFloat(gst_total) * parseFloat(adv_tax_per)) / 100;
  $("#adv_amt").val(gst_amt);

  var g_grand_total = parseFloat(gst_amt) + parseFloat(gst_total);
  $("#g_grand_total").val(g_grand_total);
}

function salesTotalDiscountCalculation() {
  var f_dis_per = $("#f_dis_per").val();
  var f_total_int = $("#f_total_int").val();
  var f_net_total = $("#f_net_total").val();

  var f_dis_amts = (parseFloat(f_dis_per) * parseFloat(f_total_int)) / 100;
  $("#f_dis_amt").val(f_dis_amts);

  var f_total_int = $("#f_total_int").val();
  var f_dis_amt = $("#f_dis_amt").val();

  $("#f_net_total").val(parseFloat(f_total_int) - parseFloat(f_dis_amt));
  $("#f_gst_total").val(parseFloat(f_total_int) - parseFloat(f_dis_amt));
  // $("#f_grand_total").val(parseFloat(f_total_int) - parseFloat(f_dis_amt));
}

function salesTotalDiscountCalculationWithAMount() {
  var f_total_int = $("#f_total_int").val();
  var f_net_total = $("#f_net_total").val();
  var f_dis_amtss = $("#f_dis_amt").val();

  var f_dis_persentage =
    (parseFloat(f_dis_amtss) * 100) / parseFloat(f_net_total);
  $("#f_dis_per").val(f_dis_persentage);

  var f_total_int = $("#f_total_int").val();
  var f_dis_amt = $("#f_dis_amt").val();

  $("#f_net_total").val(parseFloat(f_total_int) - parseFloat(f_dis_amt));
  $("#f_gst_total").val(parseFloat(f_total_int) - parseFloat(f_dis_amt));
  // $("#f_grand_total").val(parseFloat(f_total_int) - parseFloat(f_dis_amt));
}

function SaveQuotationVoucher() {
  var SPType = $(".SPType:checked").val();
  var anyaction = false;
  if (SPType == "1") {
    var customer_id = document.getElementById("customer_id").value;
    if (customer_id == "") {
      $("#customer_id")
        .siblings(".select2-container")
        .css("border", "2px solid red");
      anyaction = true;
    } else {
      $("#customer_id")
        .siblings(".select2-container")
        .css("border", "1px solid green");
    }
  }
  var bill_date_time = document.getElementById("bill_date_time").value;
  if (bill_date_time == "") {
    $("#bill_date_time").css("border", "2px solid red");
    anyaction = true;
  } else {
    $("#bill_date_time").css("border", "1px solid green");
  }

  if (anyaction) {
    return false;
  }

  var myform = document.getElementById("sales_report_form");
  var fd = new FormData(myform);

  document.getElementById("SalesVoucherDiv").innerHTML =
    "<div style='background: #fff;text-align:center'><img width='80px' src='assets/img/loaders/loader.gif'/><div>";
  $.ajax({
    url: "vouchers/quotation/SaveQuotationVoucher.php",
    data: fd,
    cache: false,
    processData: false,
    contentType: false,
    type: "POST",
    success: function (dataofconfirm) {
      $("#SalesVoucherDiv").html(dataofconfirm);
    },
  });
}

function fetchProductDetailsFromCode(vvl, Uid) {
  if (vvl != "") {
    var Bid = $("#Bid").val();
    //document.getElementById('fetchProductDetails').innerHTML ="<img width='80px' src='loader/wheel.gif'/>";

    $.post(
      "vouchers/quotation/fetchProductDetailsFromCode.php",
      {
        code: vvl,
        Bid: Bid,
        Uid: Uid,
      },
      function (data) {
        $("#fetchProductDetails").html(data);
      }
    );
  }
}

function fetchProductUnits(vvl) {
  if (vvl != "") {
    var Bid = $("#Bid").val();
    document.getElementById("loadUnits").innerHTML =
      "<img width='80px' src='loader/wheel.gif'/>";

    $.post(
      "vouchers/quotation/fetchProductUnits.php",
      {
        code: vvl,
        Bid: Bid,
      },
      function (data) {
        $("#loadUnits").html(data);
      }
    );
  }
}

function setProductUnits(vvl, unit) {
  if (vvl != "") {
    var Bid = $("#Bid").val();
    // document.getElementById("loadUnits").innerHTML =
    //   "<img width='80px' src='loader/wheel.gif'/>";

    $.post(
      "vouchers/quotation/setProductUnits.php",
      {
        code: vvl,
        Bid: Bid,
        uid: unit,
      },
      function (data) {
        $("#loadUnits").html(data);
      }
    );
  }
}

function fetchProductDetails(vvl, Uid) {
  if (vvl != "") {
    var Bid = $("#Bid").val();
    document.getElementById("fetchProductDetails").innerHTML =
      "<img width='80px' src='loader/wheel.gif'/>";

    $.post(
      "vouchers/quotation/fetchProductDetails.php",
      {
        code: vvl,
        Bid: Bid,
        Uid: Uid,
      },
      function (data) {
        $("#fetchProductDetails").html(data);
      }
    );
  }
}

function Pricecalculations(vvl, tp) {
  document.getElementById("fetchProductDetails").innerHTML =
    "<img width='80px' src='loader/wheel.gif'/>";

  var vatAmt = $("#vatAmt").val();
  var vatPer = $("#vatPer").val();
  var qty = $("#qty").val();
  if (vatPer != "0") {
    $.post(
      "vouchers/quotation/Pricecalculations.php",
      {
        vvl: vvl,
        tp: tp,
        vatPer: vatPer,
        vatAmt: vatAmt,
        qty: qty,
      },
      function (data) {
        $("#fetchProductDetails").html(data);
      }
    );
  }
  if (vatPer == "0") {
    $("#fetchProductDetails").html("");
    var totVal = vvl * qty;
    totVal = totVal.toFixed(2);
    $("#vatSprice").val(totVal);
  }
}

function calculateSingleVatTotal(vvl) {
  var Sprice = $("#Sprice").val();
  Pricecalculations(Sprice, "vatSprice");
}

function LoadUnitPrice(Uid, vvl) {
  if (vvl != "" && Uid != "") {
    var Bid = $("#Bid").val();
    document.getElementById("fetchProductDetails").innerHTML =
      "<img width='80px' src='loader/wheel.gif'/>";
    $.post(
      "vouchers/quotation/LoadUnitPrice.php",
      {
        code: vvl,
        Bid: Bid,
        Uid: Uid,
      },
      function (data) {
        $("#fetchProductDetails").html(data);
      }
    );
  }
}

function getProductList(vvl) {
  if (vvl != "") {
    document.getElementById("getProductList").innerHTML =
      "<img width='80px' src='loader/wheel.gif'/>";

    $.post(
      "vouchers/quotation/getProductList.php",
      {
        code: vvl,
      },
      function (data) {
        $("#getProductList").html(data);
      }
    );
  }
}

function salesTotalCalculation() {
  var tot_Sprice = 0;
  $(".t_Sprice").each(function () {
    tot_Sprice += +$(this).val();
  });
  tot_Sprice = tot_Sprice.toFixed(2);

  $("#total").val(tot_Sprice);

  $("#netTotal").val(tot_Sprice);

  var tot_rowvatAmt = 0;
  $(".t_vatAmt").each(function () {
    tot_rowvatAmt += +$(this).val();
  });
  tot_rowvatAmt = tot_rowvatAmt.toFixed(2);

  $("#totVat").val(tot_rowvatAmt);

  var vatNetTotal = parseFloat(tot_Sprice) + parseFloat(tot_rowvatAmt);

  vatNetTotal = vatNetTotal.toFixed(2);

  $("#vatNetTotal").val(vatNetTotal);
  $("#sal_amount1").val(vatNetTotal);
  $(".salAmnt").val(0);
  $("#disPer").val(0);
  $("#disAmt").val(0);
}

function calculateWholeDiscountAmount(vvl) {
  if (vvl == "") {
    vvl = 0;
    document.getElementById("disPer").value = vvl;
  }
  calculateAllTotalsSimple("disAmt");

  var total = $("#total").val();

  var discam = parseFloat(total) * parseFloat(vvl);
  var discamount = discam / 100;
  var dc = discamount.toFixed(2);
  $("#disAmt").val(dc);

  var nT = parseFloat(total) - parseFloat(dc);
  nT = nT.toFixed(2);
  $("#netTotal").val(nT);

  var totVat = $("#totVat").val();

  var grandTotal = parseFloat(totVat) + parseFloat(nT);
  grandTotal = grandTotal.toFixed(2);
  $("#grandTotal").val(grandTotal);
  $("#sal_amount1").val(grandTotal);
  $(".salAmnt").val(0);

  var InitialtotVat = $("#totVat").val();

  console.log(InitialtotVat);

  var totVat = $("#totVat").val();
  console.log(totVat);

  totVat = parseFloat(totVat) * parseFloat(vvl);
  var totVatAmtt = totVat / 100;
  var totVatAmtt = totVatAmtt.toFixed(2);

  var bbT = parseFloat(InitialtotVat) - parseFloat(totVatAmtt);
  bbT = bbT.toFixed(2);

  $("#totVat").val(bbT);

  var grandTotal = parseFloat(nT) + parseFloat(bbT);

  $("#grandTotal").val(grandTotal);
  $("#sal_amount1").val(grandTotal);
  $(".salAmnt").val(0);
  $("#vatNetTotal").val(parseFloat(nT) + parseFloat(bbT));

  /// get furhter totals here///
}

function calculateWholeDiscountper(vvl) {
  if (vvl == "") {
    vvl = 0;
    document.getElementById("disAmt").value = vvl;
  }
  calculateAllTotalsSimple("disPer");
  var total = $("#total").val();

  var discam = parseFloat(vvl) / parseFloat(total);
  discam = discam * 100;
  var dc = discam.toFixed(2);
  $("#disPer").val(dc);

  var nT = parseFloat(total) - parseFloat(vvl);
  nT = nT.toFixed(2);
  $("#netTotal").val(nT);

  var totVat = $("#totVat").val();

  var grandTotal = parseFloat(totVat) + parseFloat(nT);
  grandTotal = grandTotal.toFixed(2);
  $("#grandTotal").val(grandTotal);
  $("#sal_amount1").val(grandTotal);
  $(".salAmnt").val(0);

  var InitialtotVat = $("#totVat").val();
  var totVat = $("#totVat").val();

  totVat = parseFloat(totVat) * parseFloat(dc);
  var totVatAmtt = totVat / 100;
  var totVatAmtt = totVatAmtt.toFixed(totVatAmtt);

  var bbT = parseFloat(InitialtotVat) - parseFloat(totVatAmtt);
  bbT = bbT.toFixed(2);
  $("#totVat").val(bbT);

  var grandTotal = parseFloat(nT) + parseFloat(bbT);

  $("#grandTotal").val(grandTotal);
  $("#sal_amount1").val(grandTotal);
  $(".salAmnt").val(0);

  /// get furhter totals here///
}

function calculateAllTotalsSimple(tp) {
  var tot_Sprice = 0;
  $(".tot_Sprice").each(function () {
    tot_Sprice += +$(this).val();
  });
  tot_Sprice = tot_Sprice.toFixed(2);

  $("#netTotal").val(tot_Sprice);

  var tot_rowvatAmt = 0;
  $(".t_vatAmt").each(function () {
    tot_rowvatAmt += +$(this).val();
  });
  tot_rowvatAmt = tot_rowvatAmt.toFixed(2);

  $("#totVat").val(tot_rowvatAmt);

  var grandTotal = parseFloat(tot_Sprice) + parseFloat(tot_rowvatAmt);

  grandTotal = grandTotal.toFixed(2);

  $("#grandTotal").val(grandTotal);
  $("#" + tp).val(0);
}

function CalculateRemainings() {
  var salAmnt = 0;
  $(".salAmnt").each(function () {
    salAmnt += +$(this).val();
  });

  var grandTotal = $("#grandTotal").val();

  var aa = parseFloat(grandTotal) - parseFloat(salAmnt);
  aa.toFixed(2);
  $("#sal_amount1").val(aa);

  // $('#payment_screen_remaining').text(aa);
}

function validateSaleNo(e) {
  var sale_bill = $(".sale_bill:checked").val();
  if (sale_bill == "No") {
    next(e);
  }
  if (sale_bill == "Yes") {
    var sale_bill_no = $("#sale_bill_no").val();
    if (sale_bill_no == "") {
      $("#sale_bill_no").css("border", "1px solid red");
      return false;
    }
    $("#sale_bill_no").css("border", "1px solid green");
    CheckSaleBill(sale_bill_no);
  }
}

function CheckSaleBill(sale_bill_no) {
  var Bid = $("#Bid").val();
  document.getElementById("CheckSaleBill").innerHTML =
    "<img width='80px' src='loader/wheel.gif'/>";
  $.post(
    "vouchers/quotation/CheckSaleBill.php",
    {
      Bid: Bid,
      Billno: sale_bill_no,
    },
    function (data) {
      $("#CheckSaleBill").html(data);
    }
  );
}

function product_add_addRow(Bid, Billno, sBid, LanguageId) {
  var in_html = $("#row_append").html();
  $.post(
    "vouchers/quotation/sections/product_add_addRow.php",
    {
      Bid: Bid,
      Billno: Billno,
      sBid: sBid,
      LanguageId: LanguageId,
    },
    function (data) {
      $("#row_append").html(data);
      $("#row_append").append(in_html);
      // $("#row_count").val(row_count);

      $("#product").each(function () {
        //added a each loop here
        $(this).select2("val", "");
      });
    }
  );
}

function loadBanks(vvl) {
  if (vvl != "") {
    document.getElementById("cashCreditOption").innerHTML =
      "<img width='80px' src='loader/wheel.gif'/>";
    $.post(
      "vouchers/quotation/loadBanks.php",
      {
        code: vvl,
      },
      function (data) {
        $("#cashCreditOption").html(data);
      }
    );
  }
}

function sale_bill_no_area(Bid, Billno, sBid, LanguageId) {
  document.getElementById("sale_bill_no_area").innerHTML =
    "<img width='80px' src='loader/wheel.gif'/>";
  $.post(
    "vouchers/quotation/sections/sale_bill_no_area.php",
    {
      Bid: Bid,
      Billno: Billno,
      sBid: sBid,
      LanguageId: LanguageId,
    },
    function (data) {
      $("#sale_bill_no_area").html(data);
    }
  );
}

function saveFinalStep(SBBillno, Bid) {
  $.post(
    "vouchers/quotation/saveFinalStep.php",
    {
      SBBillno: SBBillno,
      Bid: Bid,
    },
    function (data) {
      $("#saveFinalStep").html(data);
    }
  );
}

function customerValidation(e) {
  var SPType = $(".SPType:checked").val();
  var anyaction = false;
  if (SPType == "2") {
    var customer_id = document.getElementById("customer_id").value;
    console.log(customer_id);
    if (customer_id == "") {
      $("#customer_id")
        .siblings(".select2-container")
        .css("border", "2px solid red");
      anyaction = true;
    } else {
      $("#customer_id")
        .siblings(".select2-container")
        .css("border", "1px solid green");
    }
  }
  if (SPType == "1") {
    var sal_amount1 = parseFloat($("#sal_amount1").val());
    if (sal_amount1 < 0) {
      $("#sal_amount1").css("border", "1px solid red");
      anyaction = true;
    } else {
      $("#sal_amount1").css("border", "1px solid green");
    }
  }
  if (anyaction) {
    return false;
  } else {
    $("#finishSave").attr("disabled", true);
    var myform = document.getElementById("sales_voucher");
    var fd = new FormData(myform);
    // document.getElementById("saveSalesForm").innerHTML =
    //   "<img width='80px' src='loader/wheel.gif'/>";
    $.ajax({
      url: "vouchers/quotation/updateSalesForm.php",
      data: fd,
      cache: false,
      processData: false,
      contentType: false,
      type: "POST",
      success: function (dataofconfirm) {
        $("#saveSalesForm").html(dataofconfirm);
        $("#finishSave").attr("disabled", false);

        // next(e);
      },
    });
  }
}

function reloadVoucher() {
  var Bid = $("#Bid").val();
  var Billno = $("#bill_no").val();
  var anyaction = false;

  if (Bid == "") {
    $("#Bid").css("border", "2px solid red");
    anyaction = true;
  }

  if (Billno == "") {
    $("#Billno").css("border", "2px solid red");
    anyaction = true;
  }

  if (anyaction) {
    return false;
  } else {
    $.post(
      "vouchers/quotation/reloadVoucher.php",
      {
        Bid: Bid,
        Billno: Billno,
      },
      function (data) {
        $("#SalesVoucherDiv").html(data);
      }
    );
  }
}

function editVoucher(Bid, Billno) {

  $.post(
    "vouchers/quotation/editVoucher.php",
    {
      Bid: Bid,
      Billno: Billno,
    },
    function (data) {
      $("#editVoucher").html(data);
    }
  );
}

function deleteQuotation(Billno, Bid, sBid) {
  document.getElementById("editVoucher").innerHTML =
    "<img width='80px' src='loader/wheel.gif'/>";

  $.post(
    "vouchers/quotation/deleteQuotation.php",
    {
      Billno: Billno,
      Bid: Bid,
      sBid: sBid,
    },
    function (data) {
      $("#editVoucher").html(data);
    }
  );
}

function PrintPopupVoucher(query, type)
{
  javascript: $("#PrintPopupVoucher").modal("show", { backdrop: "static" });

  $("#PrintPopupVoucher #bill_query").val(query);
  $("#PrintPopupVoucher #bill_type").val(type);
}

function Print_voucher_details() {
  var bill_query = $("#bill_query").val();
  var bill_type = $("#bill_type").val();
  var print_language = $("#print_language").val();

  window.open(
    "include/reports/purchase/general_print.php?query=" +
      bill_query +
      "&LanguageId=" +
      print_language +
      "&type=" +
      bill_type +
      "",
    "_blank" // <- This is what makes it open in a new window.
  );
}

function showEmail() {
  $("#emailSection").css("display", "block");
}

function Print_report_details() {
  var bill_no = $("#bill_no").val();
  var Bid = $("#Bid").val();
  var print_language = $("#PrintPopupVoucher #print_language").val();

  window.open(
    "vouchers/quotation/print.php?Billno=" +
      bill_no +
      "&Bid=" +
      Bid +
      "&LanguageId=" +
      print_language +
      "",
    "_blank" // <- This is what makes it open in a new window.
  );
}

function sendemailVoucher() {
  var email = $("#printEmail").val();
  var bill_id = $("#bill_no").val();
  var b_id = $("#Bid").val();
  var LanguageId = $("#PrintPopupVoucher #print_language").val();

  $.post(
    "vouchers/quotation/send_email.php",
    {
      b_id: b_id,
      bill_id: bill_id,
      LanguageId: LanguageId,
      email: email,
    },
    function (data) {
      console.log(data);
      if (data == "Email Sent") {
        $("#PrintPopupVoucher").modal("hide");
        $("#ignismyModal").modal("show");
      }
    }
  );
}

function quotation_return_addRow(Bid, Billno, sBid, LanguageId) {
  // var in_html = $("#row_append").html();
  $.post(
    "vouchers/quotation/sections/quotation_return_addRow.php",
    {
      Bid: Bid,
      Billno: Billno,
      sBid: sBid,
      LanguageId: LanguageId,
    },
    function (data) {
      $("#row_append").html(data);
    }
  );
}

function UpdateQuotationVoucher() {
  var SPType = $(".SPType:checked").val();
  var anyaction = false;

  var bill_date_time = document.getElementById("bill_date_time").value;
  if (bill_date_time == "") {
    $("#bill_date_time").css("border", "2px solid red");
    anyaction = true;
  } else {
    $("#bill_date_time").css("border", "1px solid green");
  }

  var vatNetTotal = document.getElementById("vatNetTotal").value;
  if (vatNetTotal == "" || parseFloat(vatNetTotal) == 0) {
    $("#vatNetTotal").css("border", "2px solid red");
    anyaction = true;
  } else {
    $("#vatNetTotal").css("border", "1px solid green");
  }

  if (anyaction) {
    return false;
  }

  var myform = document.getElementById("sales_report_form");
  var fd = new FormData(myform);

  document.getElementById("SalesVoucherDiv").innerHTML =
    "<div style='background: #fff;text-align:center'><img width='80px' src='assets/img/loaders/loader.gif'/><div>";
  $.ajax({
    url: "vouchers/quotation/UpdateQuotationVoucher.php",
    data: fd,
    cache: false,
    processData: false,
    contentType: false,
    type: "POST",
    success: function (dataofconfirm) {
      $("#SalesVoucherDiv").html(dataofconfirm);
    },
  });
}

function reloadVoucherAgainstBill(Bid, Billno) {
  var anyaction = false;

  if (Bid == "") {
    $("#Bid").css("border", "2px solid red");
    anyaction = true;
  }

  if (Billno == "") {
    $("#Billno").css("border", "2px solid red");
    anyaction = true;
  }

  if (anyaction) {
    return false;
  } else {
    $.post(
      "vouchers/quotation/editVoucher.php",
      {
        Bid: Bid,
        Billno: Billno,
      },
      function (data) {
        $("#editVoucher").html(data);
      }
    );
  }
}

$(document).ready(function () {
  var lang = document.getElementById("selected_lang").value;
  changeLanguage(lang);
});

function changeLanguage(lang){
  if(lang == 2){
    $("#selected_lang").attr('value', '2');
    $(".en").css("display", "none");
    $(".ar").css("display", "inline-block");
    $(".metismenu .en").css("display", "none");
    $(".metismenu .ar").css("display", "contents");
    $(".add_me").addClass("rv");
    $(".ar").addClass("tb");
    $(".alignChange").css("display", "contents");
    $(".alignChange").css("right", "5px");
    $(".flexDirection").css("flex-direction", "row-reverse");
    $(".align_center").css("display", "block");
    $(".align_center").css("text-align", "center");
    $(".direction").addClass("direction-rtl");
    $(".direction").removeClass("direction-ltr");
    $(".metismenu").addClass("pr-0");
    $(".nav-second-level").css("left", "-196px");
    $(".nav-second-level").css("right", "auto");
  }
  else{
    $("#selected_lang").attr('value', '1')
    $(".en").css("display", "inline-block");
    $(".ar").css("display", "none");
    $(".metismenu .en").css("display", "contents");
    $(".metismenu .ar").css("display", "none");
    $(".add_me").removeClass("rv");
    $(".ar").removeClass("tb");
    $(".alignChange").css("display", "block");
    $(".alignChange").css("right", "10px");
    $(".flexDirection").css("flex-direction", "row");
    $(".direction").addClass("direction-ltr");
    $(".direction").removeClass("direction-rtl");
    $(".metismenu").removeClass("pr-0");
    $(".nav-second-level").css("right", "-192px");
    $(".nav-second-level").css("left", "auto");
  }
  $.post("changeLanguage.php", { lang: lang });
}