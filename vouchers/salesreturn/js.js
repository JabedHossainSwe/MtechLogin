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
      delay: 50,

      data: function (query) {
        // add any default query here
        term: query.terms;
        return query;
      },
      processResults: function (data, params) {
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
    width: "100%",
    closeOnSelect: true,
    placeholder: "",
  });
});

$("#Bid").select2({});

function next(e) {
  $(e).parent().parent().parent().parent().addClass("done");
  $(e).parent().parent().parent().parent().next().removeClass("slided");
}
function prev(e) {
  $(e).parent().parent().parent().parent().addClass("slided");
  $(e).parent().parent().parent().parent().prev().removeClass("done");
}

function checkValidation(e) {
  var branch = document.getElementById("branch").value;
  if (branch == "") {
    alert("please select branch");
    $("#branch").css("border", "1px solid red");
    return false;
  }
  next(e);
}

function setmyValue(vvl, idx) {
  document.getElementById(idx).value = vvl;
}

function checkBankValue() {
  var SPType = $(".SPType:checked").val();
  if (SPType == "1") {
    $("#cashCreditOption").css("display", "block");
  }
  if (SPType == "2") {
    $("#cashCreditOption").css("display", "none");
  }
}

function checkSpBillNo() {
  alert("hi");
  var SPType = $(".sale_bill:checked").val();
  if (SPType == "Yes") {
    $("#checkSpBillNo").css("display", "block");
  }
  if (SPType == "No") {
    $("#checkSpBillNo").css("display", "none");
  }
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
    if (sal_amount1 <= 0) {
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
      url: "vouchers/salesreturn/saveSalesForm.php",
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

function generateRow(e) {
  var anyaction = false;
  var Pcode = $("#Pcode").val();
  var product = $("#product").text();
  var Sprice = $("#Sprice").text();
  var row_count = $("#row_count").val();

  if (row_count <= 1) {
    if (Pcode == "") {
      $("#Pcode").css("border", "1px solid red");
      anyaction = true;
    } else {
      $("#Pcode").css("border", "1px solid green");
    }

    if (product == "") {
      $("#product").css("border", "1px solid red");
      anyaction = true;
    } else {
      $("#product").css("border", "1px solid green");
    }

    if (unit_id == "") {
      $("#unit_id")
        .siblings(".select2-container")
        .css("border", "2px solid red");
      anyaction = true;
    } else {
      $("#unit_id")
        .siblings(".select2-container")
        .css("border", "1px solid green");
    }

    if (Sprice == "0") {
      $("#Sprice").css("border", "1px solid red");
      anyaction = true;
    } else {
      $("#Sprice").css("border", "1px solid green");
    }

    if (anyaction) {
      return false;
    }
  }

  var unit = $("#unit").val();
  var unit_id = $("#unit_id").val();
  var qty = $("#qty").val();
  var Bid = $("#Bid").val();
  var Sprice = $("#Sprice").val();
  var vatSprice = $("#vatSprice").val();
  var vatPer = $("#vatPer").val();
  var vatAmt = $("#vatAmt").val();
  var isVat = $("#isVat").val();

  var in_html = $("#add_row").html();
  // $('#row_append').innerHTML ="<img src='loader/wheel.gif' style='width:10%' />";
  if (Pcode != "") {
    $.post(
      "vouchers/salesreturn/addRow.php",
      {
        Pcode: Pcode,
        product: product,
        unit_id: unit_id,
        unit: unit,
        qty: qty,
        Sprice: Sprice,
        row_count: row_count,
        vatSprice: vatSprice,
        Bid: Bid,
        vatPer: vatPer,
        vatAmt: vatAmt,
        isVat: isVat,
      },
      function (data) {
        // console.log(data);
        $("#add_row").html(data);
        $("#add_row").append(in_html);
        $("#row_count").val(parseInt(row_count) + 1);

        $("#Pcode").val("");
        $("#product").each(function () {
          //added a each loop here
          $(this).select2("val", "");
        });
        $("#unit").val("");
        $("#unit_id").val("");
        $("#qty").val(1);
        $("#Sprice").val(0);
        $("#vatSprice").val(0);
        $("#vatPer").val(0);
        $("#vatAmt").val(0);
        $("#isVat").val("");
      }
    );
  }
  next(e);
}

function editRow(row_count, type) {
  if (type == 0) {
    $(".hide_span_qty" + row_count).css("display", "none");
    $(".hide_Sprice" + row_count).css("display", "none");
    $("#Sprice" + row_count).attr("type", "text");
    $("#qty" + row_count).attr("type", "text");
    $("#action_button" + row_count).html(
      '<a href="#" onClick="editRow(' +
        row_count +
        ',1)"><i class="fa fa-check" aria-hidden="true"></i></a>'
    );
  } else {
    $(".hide_span_qty" + row_count).css("display", "block");
    $(".hide_Sprice" + row_count).css("display", "block");

    $("#qty" + row_count).attr("type", "hidden");
    $("#Sprice" + row_count).attr("type", "hidden");

    $(".hide_Sprice" + row_count).text($("#Sprice" + row_count).val());
    $(".hide_span_qty" + row_count).text($("#qty" + row_count).val());

    $("#action_button" + row_count).html(
      '<a href="#" onClick="editRow(' +
        row_count +
        ',0)"><i class="fa fa-pencil" aria-hidden="true"></i></a>'
    );
  }
}

function rowGst(row_count, type) {
  var price = $("#price" + row_count).val();
  var qty = $("#qty" + row_count).val();
  var total = parseFloat(price) * parseFloat(qty);
  var gst_per = $("#gst_per" + row_count).val();

  if (type == 0) {
    var gst_amount = $("#gst_amount" + row_count).val(
      (parseFloat(total) * parseFloat(gst_per)) / 100
    );
  } else {
    var gst_amount = $("#gst_amount" + row_count).val();
    var gst_per = $("#gst_per" + row_count).val(
      (parseFloat(gst_amount) * 100) / parseFloat(total)
    );
  }

  $("#row_total" + row_count).val(parseFloat(total) + parseFloat(gst_amount));
}

function fetchProductDetails(vvl, Uid) {
  if (Uid === undefined) {
    var Uid = $("#Pcode").val();
  }
  if (vvl != "") {
    var Bid = $("#Bid").val();
    document.getElementById("fetchProductDetails").innerHTML =
      "<img width='80px' src='loader/wheel.gif'/>";

    $.post(
      "vouchers/salesreturn/fetchProductDetails.php",
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
function fetchProductDetailsFromCode(vvl, Uid) {
  if (vvl != "") {
    var Bid = $("#Bid").val();
    //document.getElementById('fetchProductDetails').innerHTML ="<img width='80px' src='loader/wheel.gif'/>";

    $.post(
      "vouchers/salesreturn/fetchProductDetailsFromCode.php",
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
      "vouchers/salesreturn/getProductList.php",
      {
        code: vvl,
      },
      function (data) {
        $("#getProductList").html(data);
      }
    );
  }
}
function loadBanks(vvl) {
  if (vvl != "") {
    document.getElementById("cashCreditOption").innerHTML =
      "<img width='80px' src='loader/wheel.gif'/>";
    $.post(
      "vouchers/salesreturn/loadBanks.php",
      {
        code: vvl,
      },
      function (data) {
        $("#cashCreditOption").html(data);
      }
    );
  }
}

function Discount(row_count) {
  var Discount = $("#Discount" + row_count).val();
  $("#hide_span_dis" + row_count).html(Discount);

  var total_without_tax = $("#total_without_tax" + row_count).val();
  console.log(total_without_tax);
  var n_net_total_without_tax =
    parseFloat(total_without_tax) - parseFloat(Discount);
  console.log(n_net_total_without_tax);

  if (n_net_total_without_tax < 0) {
    n_net_total_without_tax = 0;
  }

  $("#net_total_without_tax" + row_count).val(n_net_total_without_tax);
  $("#hide_span_nettotal_without_tax" + row_count).html(
    n_net_total_without_tax
  );

  var total_without_tax = $("#total_with_tax" + row_count).val();
  var n_net_total_with_tax =
    parseFloat(total_without_tax) - parseFloat(Discount);
  if (n_net_total_with_tax < 0) {
    n_net_total_with_tax = 0;
  }
  $("#net_total_with_tax" + row_count).val(n_net_total_with_tax);
  $("#hide_span_nettotal_with_tax" + row_count).html(n_net_total_with_tax);
}

function deleteRow(row_count) {
  $.confirm({
    title: "Confirm!",
    content: "Are You Sure You Want To Delete?",
    buttons: {
      confirm: function () {
        $("#" + row_count).remove();
        $.alert("Confirmed!");
      },
      cancel: function () {
        $.alert("Canceled!");
      },
      // somethingElse: {
      //     text: 'Something else',
      //     btnClass: 'btn-blue',
      //     keys: ['enter', 'shift'],
      //     action: function(){
      //         $.alert('Something else?');
      //     }
      // }
    },
  });
}

function addMoreRows(e) {
  $("#product").select2("destroy");
  $("#product").val("");
  $("#product").css("border", "1px solid #ced4da");

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
      //templateResult: formatResult
    });
  });

  prev(e);
}

function Pricecalculations(vvl, tp) {
  document.getElementById("fetchProductDetails").innerHTML =
    "<img width='80px' src='loader/wheel.gif'/>";

  var vatAmt = $("#vatAmt").val();
  var vatPer = $("#vatPer").val();
  var qty = $("#qty").val();
  if (vatPer != "0") {
    $.post(
      "vouchers/salesreturn/Pricecalculations.php",
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
    $("#vatSprice").val(vvl * qty);
  }
}

function PricecalculationsRow(vvl, tp, row_count) {
  document.getElementById("fetchProductDetails").innerHTML =
    "<img width='80px' src='loader/wheel.gif'/>";

  var vatAmt = $("#vatAmt" + row_count).val();
  var vatPer = $("#vatPer" + row_count).val();
  var qty = $("#qty" + row_count).val();
  if (vatPer != "0") {
    $.post(
      "vouchers/salesreturn/PricecalculationsRow.php",
      {
        vvl: vvl,
        tp: tp,
        vatPer: vatPer,
        vatAmt: vatAmt,
        qty: qty,
        row_count: row_count,
      },
      function (data) {
        $("#fetchProductDetails").html(data);
      }
    );
  }
  if (vatPer == "0") {
    $("#fetchProductDetails").html("");

    $("#vatSprice" + row_count).val(vvl * qty);
  }
}

function calculateAllTotals(e) {
  var tot_Sprice = 0;
  $(".tot_Sprice").each(function () {
    tot_Sprice += +$(this).val();
  });
  tot_Sprice = tot_Sprice.toFixed(2);

  $("#total").val(tot_Sprice);
  $("#span_total").html(tot_Sprice);

  $("#netTotal").val(tot_Sprice);
  $("#span_netTotal").html(tot_Sprice);

  var tot_rowvatAmt = 0;
  $(".tot_vatAmt").each(function () {
    tot_rowvatAmt += +$(this).val();
  });
  tot_rowvatAmt = tot_rowvatAmt.toFixed(2);

  $("#totVat").val(tot_rowvatAmt);
  $("#span_totVat").html(tot_rowvatAmt);

  var grandTotal = parseFloat(tot_Sprice) + parseFloat(tot_rowvatAmt);

  grandTotal = grandTotal.toFixed(2);

  $("#grandTotal").val(grandTotal);
  $("#disPer").val(0);
  $("#disAmt").val(0);
  $("#span_grandTotal").html(grandTotal);

  next(e);
}

function calculateAllTotalsSimple(tp) {
  var tot_Sprice = 0;
  $(".t_netTotal").each(function () {
    tot_Sprice += +$(this).val();
  });
  tot_Sprice = tot_Sprice.toFixed(2);

  $("#netTotal").val(tot_Sprice);

  var tot_rowvatAmt = 0;
  $(".t_vat_tot").each(function () {
    tot_rowvatAmt += +$(this).val();
  });
  tot_rowvatAmt = tot_rowvatAmt.toFixed(2);

  $("#totVat").val(tot_rowvatAmt);

  var grandTotal = parseFloat(tot_Sprice) + parseFloat(tot_rowvatAmt);

  grandTotal = grandTotal.toFixed(2);

  $("#grandTotal").val(grandTotal);
  $("#" + tp).val(0);
}

function calculateWholeDiscountAmount(vvl) {
  if (vvl == "") {
    vvl = 0;
    document.getElementById("fdisPer").value = vvl;
  }
  calculateAllTotalsSimple("fdisAmt");

  var total = $("#f_total").val();

  var discam = parseFloat(total) * parseFloat(vvl);
  var discamount = discam / 100;
  var dc = discamount.toFixed(2);
  $("#fdisAmt").val(dc);

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
  // console.log(totVat);

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
  $("#span_netTotal").html(nT);

  var totVat = $("#totVat").val();

  var grandTotal = parseFloat(totVat) + parseFloat(nT);
  grandTotal = grandTotal.toFixed(2);
  $("#grandTotal").val(grandTotal);
  $("#span_grandTotal").text(grandTotal);

  // var InitialtotVat = $("#totVat").val();
  var totVat = $("#totVat").val();

  totVat = parseFloat(totVat) * parseFloat(dc);
  var totVatAmtt = totVat / 100;
  var totVatAmtt = totVatAmtt.toFixed(totVatAmtt);

  var bbT = parseFloat(InitialtotVat) - parseFloat(totVatAmtt);
  bbT = bbT.toFixed(2);
  $("#totVat").val(bbT);
  $("#span_totVat").text(bbT);

  var grandTotal = parseFloat(nT) + parseFloat(bbT);

  $("#grandTotal").val(grandTotal);
  $("#sal_amount1").val(grandTotal);
  $("#span_grandTotal").text(grandTotal);

  /// get furhter totals here///
}

function calculateSingleVatTotal(vvl) {
  var price = $("#Sprice").val();
  var vatAmt = $("#vatAmt").val();
  var qty = $("#qty").val();

  var vatPer = $("#vatPer").val();
  var disPer = $("#disPer").val();

  var vatAmtTotal = ((parseFloat(price) * parseFloat(vatPer)) / 100).toFixed(2);
  var vatAmtPer = ((parseFloat(vatAmtTotal) * parseFloat(disPer)) / 100).toFixed(2);
  var vatAmt = ((parseFloat(vatAmtTotal) - parseFloat(vatAmtPer))).toFixed(2);

  $("#vatAmt").val(vatAmt);

  var vatTotal = (parseFloat(qty) * parseFloat(vatAmt)).toFixed(2);
  var total = (parseFloat(qty) * parseFloat(price)).toFixed(2);
  var vatSprice = ((parseFloat(vatTotal) + parseFloat(total))).toFixed(2);
  $("#vattotal").val(vatTotal);
  $("#total").val(total);
  $("#net_total").val(total);
  $("#vatSprice").val(vatSprice);
  $("#disAmt").val(0);
  $("#disPer").val(0);

  // var disPer = $("#disPer").val();
  // var disAmt = ((parseFloat(total) * parseFloat(disPer)) / 100).toFixed(2);
  // $("#disAmt").val(disAmt);


  // Pricecalculations(price, "vatSprice");
}

function calculateDisPer() {
  var qty = $("#qty").val();
  // var price = $("#Sprice").val();
  var disAmt = $("#disAmt").val();
  var total = $("#total").val();
  var vatTotal = $("#vattotal").val();

  var disPer = ((parseFloat(disAmt) / parseFloat(total)) * 100).toFixed(2);
  $("#disPer").val(disPer);

  var net_total = (parseFloat(total) - parseFloat(disAmt)).toFixed(2);
  var vatPlusTotal = (parseFloat(net_total) + parseFloat(vatTotal)).toFixed(2);
  $("#net_total").val(net_total);
  $("#vatSprice").val(vatPlusTotal);
}

function calculateDisAmt() {
  var disPer = $("#disPer").val();
  var total = $("#total").val();
  var vatTotal = $("#vattotal").val();

  var disAmt = ((parseFloat(total) * parseFloat(disPer)) / 100).toFixed(2);
  $("#disAmt").val(disAmt);

  var net_total = (parseFloat(total) - parseFloat(disAmt)).toFixed(2);
  var vatPlusTotal = (parseFloat(net_total) + parseFloat(vatTotal)).toFixed(2);
  $("#net_total").val(net_total);
  $("#vatSprice").val(vatPlusTotal);
}

function qtyPriceTotal(row_count) {
  var vvl = $("#qty" + row_count).val();
  var Sprice = $("#Sprice" + row_count).val();
  if (Sprice == 0) {
    $("#vatSprice" + row_count).val("0");
    $(".hide_vatSprice" + row_count).text(0);
  } else {
    PricecalculationsRow(Sprice, "vatSprice", row_count);
  }

  $("#hide_span_qty" + row_count).html(vvl);
}

function paymentScreen(e) {
  var disPer = parseFloat($("#disPer").val());
  var disAmt = parseFloat($("#disAmt").val());
  var total = parseFloat($("#total").val());
  var anyaction = false;
  if (disPer < 0 || disPer == "NaN") {
    $("#disPer").css("border", "1px solid red");
    anyaction = true;
  } else {
    $("#disPer").css("border", "1px solid green");
  }
  if (disAmt < 0 || disAmt == "NaN") {
    $("#disAmt").css("border", "1px solid red");
    anyaction = true;
  } else {
    $("#disAmt").css("border", "1px solid green");
  }

  if (total == "" || total <= 0) {
    $("#disPer").css("border", "1px solid red");
    $("#disAmt").css("border", "1px solid red");
    anyaction = true;
  } else {
    $("#disPer").css("border", "1px solid green");
    $("#disAmt").css("border", "1px solid green");
  }
  var netTotal = parseFloat($("#netTotal").val());
  if (netTotal == "" || netTotal <= 0) {
    $("#disPer").css("border", "1px solid red");
    $("#disAmt").css("border", "1px solid red");
    anyaction = true;
  } else {
    $("#disPer").css("border", "1px solid green");
    $("#disAmt").css("border", "1px solid green");
  }

  var totVat = parseFloat($("#totVat").val());
  if (totVat < 0) {
    $("#disPer").css("border", "1px solid red");
    $("#disAmt").css("border", "1px solid red");
    anyaction = true;
  } else {
    $("#disPer").css("border", "1px solid green");
    $("#disAmt").css("border", "1px solid green");
  }

  var grandTotal = parseFloat($("#grandTotal").val());
  if (grandTotal <= 0) {
    anyaction = true;
  } else {
    $("#disPer").css("border", "1px solid green");
    $("#disAmt").css("border", "1px solid green");
  }
  if (anyaction) {
    $("#disPer").css("border", "1px solid red");
    $("#disAmt").css("border", "1px solid red");

    return false;
  } else {
    $("#disPer").css("border", "1px solid green");
    $("#disAmt").css("border", "1px solid green");
    $("#payment_screen_total").text(grandTotal);
    $("#payment_screen_remaining").text(0);
    $("#sal_amount1").val(grandTotal);
    var RefNo1 = $("#RefNo1").val();
    if (RefNo1 != "") {
      CalculateRemainings();
    }
    next(e);
  }
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

function AddBank() {
  var Bid = $("#Bid").val();
  var bankrows = $("#bankrows").val();
  var Bank = $("#Bank" + bankrows).val();
  if (Bank == "") {
    $("#Bank" + bankrows).css("border", "2px solid red");
    return false;
  }

  $("#Bank" + bankrows).css("border", "1px solid green");

  var sal_amount = $("#sal_amount" + bankrows).val();
  if (sal_amount == "0" || sal_amount == "") {
    $("#sal_amount" + bankrows).css("border", "2px solid red");
    return false;
  }

  $("#sal_amount" + bankrows).css("border", "1px solid green");

  bankrows = parseFloat(bankrows) + 1;
  var old_data = $("#loadBanks").html();
  $.post(
    "vouchers/salesreturn/loadBanks.php",
    {
      code: Bid,
      nrow: bankrows,
    },
    function (data) {
      $("#loadBanks").append(data);
      $("#bankrows").val(bankrows);
    }
  );
}

////////// Validations//////////
function validateRefrenceNo(e) {
  var salesMan = $("#salesMan").val();
  anyaction = false;
  //if(salesMan == null || salesMan=='' || salesMan=='0')
  //{
  //$('#salesMan').siblings(".select2-container").css('border', '2px solid red');
  //anyaction = true;
  //}
  //else{
  //$('#salesMan').siblings(".select2-container").css('border', '1px solid green');
  //}
  if (anyaction) {
    return false;
  } else {
    next(e);
  }
}

function printInvoice() {
  var anyaction = false;
  var Bid = $("#Bid").val();
  var Billno = $("#Billno").val();
  if (Billno == "") {
    anyaction = true;
    $("#Billno").css("border", "1px solid red");
  }
  var LanguageId = $("#LanguageId").val();
  if (anyaction) {
    return false;
  }

  document.getElementById("printInvoice").innerHTML =
    "<img width='80px' src='loader/wheel.gif'/>";
  $.post(
    "vouchers/salesreturn/printInvoice.php",
    {
      Bid: Bid,
      Billno: Billno,
      LanguageId: LanguageId,
    },
    function (data) {
      $("#printInvoice").html(data);
    }
  );
}

function print(Billno, Bid, LanguageId) {
  document.getElementById("printInvoice").innerHTML =
    "<img width='80px' src='loader/wheel.gif'/>";
  $.post(
    "vouchers/salesreturn/print.php",
    {
      Bid: Bid,
      Billno: Billno,
      LanguageId: LanguageId,
    },
    function (data) {
      $("#printInvoice").html(data);
    }
  );
}

function loadPage(pg) {
  location.href = pg;
}

// $(".i-checks input[name=sale_bill]").on('ifChanged', function (e) {
// 	// $(this).trigger("change", e);
// 	// alert('hi');
// 	validateSaleNo();
// });

function validateSaleNo() {
  var sale_bill = $(".sale_bill:checked").val();
  if (sale_bill == "No") {
    var Bid = $("#Bid").val();
    $.post(
      "vouchers/salesreturn/addReturn.php",
      {
        sale_bill: sale_bill,
        Bid: Bid,
      },
      function (data) {
        //   $("#CheckSaleBill").html(data);
        $("#screen_sec").html(data);
      }
    );

    $("#sale_bill_no").val();
    // $('#new_return').css('display', 'block');
    // next(e);
    // return false;
  }
  if (sale_bill == "Yes") {
    $.post(
      "vouchers/salesreturn/addOld.php",
      {
        sale_bill: sale_bill,
      },
      function (data) {
        //   $("#CheckSaleBill").html(data);
        $("#screen_sec").html(data);
      }
    );
    $("#old_return").css("display", "block");
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
//   document.getElementById("CheckSaleBill").innerHTML =
//     "<img width='80px' src='loader/wheel.gif'/>";
  $.post(
    "vouchers/salesreturn/CheckSaleBill.php",
    {
      Bid: Bid,
      Billno: sale_bill_no,
    },
    function (data) {
      $("#CheckSaleBill").html(data);
    }
  );
}

function loadAllSectionsForSalesReturn(
  Bid,
  Billno,
  sBid,
  LanguageId,
  customer_id
) {
  $(".items_sec").css("display", "block");
  $(".total_sec").css("display", "block");
  $("#customer_id").val(customer_id);

  bill_no_area(Bid, Billno, sBid, LanguageId);
  $("#product_add_section").remove();
  product_add_addRow(Bid, Billno, sBid, LanguageId);
  loadBanksagainstBranchWithBill(Bid,Billno);
}

function bill_no_area(Bid, Billno, sBid, LanguageId) {
  document.getElementById("bill_no_area").innerHTML =
    "<img width='80px' src='loader/wheel.gif'/>";
  $.post(
    "vouchers/salesreturn/sections/sale_bill_no_area.php",
    {
      Bid: Bid,
      Billno: Billno,
      sBid: sBid,
      LanguageId: LanguageId,
    },
    function (data) {
      $("#bill_no_area").html(data);
    }
  );
}

function product_add_addRow(Bid, Billno, sBid, LanguageId) {
  var in_html = $("#row_append").html();
  $.post(
    "vouchers/salesreturn/sections/product_add_addRow.php",
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

    //   $("#product").each(function () {
        //added a each loop here
        // $(this).select2("val", "");
    //   });
    }
  );
}

function sale_return_addRow(Bid, Billno, sBid, LanguageId) {
	// var in_html = $("#row_append").html();
	$.post(
	  "vouchers/salesreturn/sections/sale_return_addRow.php",
	  {
		Bid: Bid,
		Billno: Billno,
		sBid: sBid,
		LanguageId: LanguageId,
	  },
	  function (data) {
		$("#row_append").html(data);
		// $("#row_append").append(in_html);
		// $("#row_count").val(row_count);
  
	  //   $("#product").each(function () {
		  //added a each loop here
		  // $(this).select2("val", "");
	  //   });
	  }
	);
  }

function bank_section(Bid, Billno, sBid, LanguageId) {
  document.getElementById("bank_section").innerHTML =
    "<img width='80px' src='loader/wheel.gif'/>";
  $.post(
    "vouchers/salesreturn/sections/bank_section.php",
    {
      Bid: Bid,
      Billno: Billno,
      sBid: sBid,
      LanguageId: LanguageId,
    },
    function (data) {
      $("#bank_section").html(data);
    }
  );
}

function openPopup(id, bid, email) {
  $("#emailpopup").modal("show");
  $("#bill_id").val(id);
  $("#b_id").val(bid);
  $("#email").val(email);
}

function openPrintPopup(id, bid) {
  $("#printpopup").modal("show");
  $("#bill_id_print").val(id);
  $("#b_id_print").val(bid);
}

function sendemailform() {
  var email = $("#email").val();
  var bill_id = $("#bill_id").val();
  var b_id = $("#b_id").val();
  var LanguageId = $("#email_lang").val();

  $.post(
    "vouchers/salesreturn/send_email.php",
    {
      b_id: b_id,
      bill_id: bill_id,
      LanguageId: LanguageId,
      email: email,
    },
    function (data) {
      console.log(data);
      //$('#sendemailform').html(data);
      if (data == "Email Sent") {
        $("#emailpopup").modal("hide");
        $("#ignismyModal").modal("show");
      }
      // $("#printInvoice").html(data);
    }
  );
}

function Print_details() {
  var bill_id = $("#bill_id_print").val();
  var b_id = $("#b_id_print").val();
  var print_language = $("#print_language").val();

  window.open(
    "vouchers/salesreturn/print.php?Billno=" +
      bill_id +
      "&Bid=" +
      b_id +
      "&LanguageId=" +
      print_language +
      "",
    "_blank" // <- This is what makes it open in a new window.
  );
}

function fetchProductUnits(vvl) {
  if (vvl != "") {
    var Bid = $("#Bid").val();
    document.getElementById("loadUnits").innerHTML =
      "<img width='80px' src='loader/wheel.gif'/>";

    $.post(
      "vouchers/salesreturn/fetchProductUnits.php",
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

function LoadUnitPrice(Uid, vvl) {
  if (vvl != "" && Uid != "") {
    var Bid = $("#Bid").val();
    document.getElementById("fetchProductDetails").innerHTML =
      "<img width='80px' src='loader/wheel.gif'/>";
    $.post(
      "vouchers/salesreturn/LoadUnitPrice.php",
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
function salesTotalCalculation() {
  // var tot_Sprice = 0;
  // $(".t_Sprice").each(function () {
  //   tot_Sprice += +$(this).val();
  // });
  // tot_Sprice = tot_Sprice.toFixed(2);
	
	var t_totMt = 0;
  $(".t_netTotal").each(function () {
    t_totMt += +$(this).val();
  });
  t_totMt = t_totMt.toFixed(2);
	
  $("#f_total").val(t_totMt);

  $("#netTotal").val(t_totMt);

  var tot_rowvatAmt = 0;
  $(".t_vat_tot").each(function () {
    tot_rowvatAmt += +$(this).val();
  });
  tot_rowvatAmt = tot_rowvatAmt.toFixed(2);

  $("#totVat").val(tot_rowvatAmt);

  var grandTotal = parseFloat(t_totMt) + parseFloat(tot_rowvatAmt);

  grandTotal = grandTotal.toFixed(2);

  $("#grandTotal").val(grandTotal);
  $("#sal_amount1").val(grandTotal);
  $(".salAmnt").val(0);
  $("#fdisPer").val(0);
  $("#fdisAmt").val(0);
}

function edit_row(idx) {
  var code = $("#code" + idx).val();
  var product_name = $("#product_name" + idx).val();
  var unit = $("#unit" + idx).val();
  var qty = $("#qty" + idx).val();
  var price = $("#Sprice" + idx).val();
  var vatPer = $("#vatPer" + idx).val();
  var vatAmt = $("#vatAmt" + idx).val();
  var grand_total = $("#vatSprice" + idx).val();
  var total = $("#total" + idx).val();
  var disAmt = $("#disAmt" + idx).val();
  var disPer = $("#disPer" + idx).val();
  var netTotal = $("#netTotal" + idx).val();
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
    setProductUnits(code,unit);
    $("#qty").val(qty);
    $("#Sprice").val(price);
    $("#vatPer").val(vatPer);
    $("#vatAmt").val(vatAmt);
    $("#vatSprice").val(grand_total);
    $("#total").val(total);
    $("#disAmt").val(disAmt);
    $("#disPer").val(disPer);
    $("#net_total").val(netTotal);
    $("#vattotal").val(vatTotal);
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
  var vatPTotal = $("#vatSprice").val();
  var isVat = $("#isVat").val();
  var Bid = $("#Bid").val();
  var total = $("#total").val();
  var disAmt = $("#disAmt").val();
  var disPer = $("#disPer").val();
  var netTotal = $("#net_total").val();
  var vatTotal = $("#vattotal").val();

  // $("#add_sec").css("display", "none");

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
    "vouchers/sales/updateRow.php",
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
      total: total,
      isVat: isVat,
      row_count: idx,
      disAmt: disAmt,
      disPer: disPer,
      netTotal: netTotal,
      vatTotal: vatTotal,
      vatPTotal: vatPTotal,
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
      $("#total").val(0);
      $("#net_total").val(0);
      $("#disAmt").val(0);
      $("#disPer").val(0);
      $("#netTotal").val(0);
      $("#vatTotal").val(0);
      $("#vatSprice").val(0);
      $("#vattotal").val(0);

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
    "include/sales/getProductUnit.php",
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
  $("#f_grand_total").val(parseFloat(f_total_int) - parseFloat(f_dis_amt));
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
  $("#f_grand_total").val(parseFloat(f_total_int) - parseFloat(f_dis_amt));
}

function SaveSalesVoucher() {
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

  var f_grand_total = document.getElementById("grandTotal").value;
  if (f_grand_total == "" || parseFloat(f_grand_total) == 0) {
    $("#grandTotal").css("border", "2px solid red");
    anyaction = true;
  } else {
    $("#grandTotal").css("border", "1px solid green");
  }

  if (anyaction) {
    return false;
  }

  var myform = document.getElementById("sales_report_form");
  var fd = new FormData(myform);

  document.getElementById("SalesVoucherDiv").innerHTML =
    "<div style='background: #fff;text-align:center'><img width='80px' src='assets/img/loaders/loader.gif'/><div>";
  $.ajax({
    url: "vouchers/salesreturn/SaveSalesVoucher.php",
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


function UpdateSalesReturnVoucher() {
	var SPType = $(".SPType:checked").val();
	var anyaction = false;

	var bill_date_time = document.getElementById("bill_date_time").value;
	if (bill_date_time == "") {
	  $("#bill_date_time").css("border", "2px solid red");
	  anyaction = true;
	} else {
	  $("#bill_date_time").css("border", "1px solid green");
	}
  
	var f_grand_total = document.getElementById("grandTotal").value;
	if (f_grand_total == "" || parseFloat(f_grand_total) == 0) {
	  $("#grandTotal").css("border", "2px solid red");
	  anyaction = true;
	} else {
	  $("#grandTotal").css("border", "1px solid green");
	}
  
	if (anyaction) {
	  return false;
	}
  
	var myform = document.getElementById("sales_voucher");
	var fd = new FormData(myform);
  
	document.getElementById("SalesVoucherDiv").innerHTML =
	  "<div style='background: #fff;text-align:center'><img width='80px' src='assets/img/loaders/loader.gif'/><div>";
	$.ajax({
	  url: "vouchers/salesreturn/UpdateSalesReturnVoucher.php",
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

function setProductUnits(vvl,uid) {
  if (vvl != "") {
    var Bid = $("#Bid").val();
    // document.getElementById("loadUnits").innerHTML =
    //   "<img width='80px' src='loader/wheel.gif'/>";

    $.post(
      "vouchers/sales/setProductUnits.php",
      {
        code: vvl,
        Bid: Bid,
        uid: uid,
      },
      function (data) {
        $("#loadUnits").html(data);
      }
    );
  }
}

function addRow() {
  var code = $("#Pcode").val();
  var product = $("#product").val();
  var product_name = $("#product").text();
  var unit = $("#unit_id").val();
  var unit_name = $("#unit_id :selected").text();
  var qty = $("#qty").val();
  var price = $("#Sprice").val();
  var total = $("#total").val();
  var disAmt = $("#disAmt").val();
  var disPer = $("#disPer").val();
  var net_total = $("#net_total").val();
  var vatAmt = $("#vatAmt").val();
  var vatPer = $("#vatPer").val();
  var vattotal = $("#vattotal").val();
  var vatSprice = $("#vatSprice").val();
  var Bid = $("#Bid").val();
  var isVat = $("#isVat").val();


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
    "vouchers/sales/addRow.php",
    {
      Pcode: code,
      product: product_name,
      unit_id: unit,
      unit: unit_name,
      qty: qty,
      Sprice: price,
      total: total,
      disAmt: disAmt,
      disPer: disPer,
      row_count: row_count,
      Bid: Bid,
      vatPer: vatPer,
      vatAmt: vatAmt,
      vatSprice: vatSprice,
      vattotal: vattotal,
      net_total: net_total,
      isVat: isVat,
    },
    function (data) {
      // console.log(data);
      $("#row_append").append(data);
      // $("#row_append").append(in_html);
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
      $("#total").val(0);
      $("#disAmt").val(0);
      $("#disPer").val(0);
      $("#net_total").val(0);
      $("#vatAmt").val(0);
      $("#vatPer").val(0);
      $("#vattotal").val(0);
      $("#vatSprice").val(0);
    }
  );
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
      "vouchers/salesreturn/reloadVoucher.php",
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


function reloadVoucherAgainstBill(Bid,Billno) {

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
      "vouchers/salesreturn/reloadVoucher.php",
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




function editVoucher(Bid, Billno, sBid) {
  document.getElementById("editVoucher").innerHTML =
    "<img width='80px' src='loader/wheel.gif'/>";

  if(sBid == ""){
    var sBid = $("#sBid").val();
  }

  $.post(
    "vouchers/salesreturn/editVoucher.php",
    {
      Bid: Bid,
      Billno: Billno,
      sBid: sBid,
    },
    function (data) {
      $("#editVoucher").html(data);
    }
  );
//   CheckSaleBill(Billno);
}

// function product_add_addRow(Bid, Billno, sBid, LanguageId) {
//   var in_html = $("#row_append").html();
//   $.post(
//     "vouchers/salesreturn/product_add_addRow.php",
//     {
//       Bid: Bid,
//       Billno: Billno,
//       sBid: sBid,
//       LanguageId: LanguageId,
//     },
//     function (data) {
//       $("#row_append").html(data);
//       $("#row_append").append(in_html);
//       // $("#row_count").val(row_count);

//       // $("#product").each(function () {
//       //added a each loop here
//       // $(this).select2("val", "");
//       // });
//     }
//   );
// }

function deleteSaleReturn(Billno, Bid, sBid) {
  // document.getElementById("editVoucher").innerHTML =
  //   "<img width='80px' src='loader/wheel.gif'/>";

  $.post(
    "vouchers/salesreturn/deleteSaleReturn.php",
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
    "include/reports/salesreturn/general_print.php?query=" +
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
    "vouchers/salesreturn/print.php?Billno=" +bill_no +"&Bid=" +Bid +"&LanguageId=" +print_language +"","_blank" // <- This is what makes it open in a new window.
  );
}

function sendemailVoucher() {
  var email = $("#printEmail").val();
  var bill_id = $("#bill_no").val();
  var b_id = $("#Bid").val();
  var LanguageId = $("#PrintPopupVoucher #print_language").val();
  $.post(
    "vouchers/salesreturn/send_email.php",
    {
      b_id: b_id,
      bill_id: bill_id,
      LanguageId: LanguageId,
      email: email,
    },
    function (data) {
      console.log(data);
      //$('#sendemailform').html(data);
      if (data == "Email Sent") {
        $("#PrintPopupVoucher").modal("hide");
        $("#ignismyModal").modal("show");
      }
      // $("#printInvoice").html(data);
    }
  );
}

function loadBanksagainstBrank(bnkVal)
{
if(bnkVal!='')
	{
document.getElementById("loadBanksagainstBrank").innerHTML ="<img width='80px' src='loader/wheel.gif'/>";
	$.post(
    "vouchers/salesreturn/loadBanksagainstBrank.php",
    {
      code: bnkVal,
    },
    function (data) {
      $("#loadBanksagainstBrank").html(data);

    }
  );	
	}
	
	
}
function loadBanksagainstBranchWithBill(Bid,BillNo)
{

document.getElementById("loadBanksagainstBrank").innerHTML ="<img width='80px' src='loader/wheel.gif'/>";
	$.post(
    "vouchers/salesreturn/sections/loadBanksagainstBranchWithBill.php",
    {
      Bid: Bid,
      BillNo: BillNo,
    },
    function (data) {
      $("#loadBanksagainstBrank").html(data);

    }
  );	
	
	
	
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

function loadSubBranch(Bid){
  document.getElementById("loadSubBranch").innerHTML ="<img width='80px' src='loader/wheel.gif'/>";

  if(Bid != ""){
    $.post(
      "vouchers/sales/loadSubBranch.php",
      {
        Bid: Bid,
      },
      function (data) {
        $("#loadSubBranch").html(data);
      }
    );
  }
}