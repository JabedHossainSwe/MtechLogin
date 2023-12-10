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
      url: "Api/listings/GetSupplierList",
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

function customerCheck(customer_id) {
  document.getElementById("customerCheck").innerHTML =
    "<img src='loader/wheel.gif' style='width:10%' />";
  $.post(
    "include/payment/customerCheck.php",
    {
      customer_id: customer_id,
    },
    function (data) {
      $("#customerCheck").html(data);
    }
  );
}
$(document).ready(function () {
  $("#bnkid").select2({
    width: "100%",
    closeOnSelect: true,
    placeholder: "",
  });
});

function AmtRowCal(row_count) {
  var payingAmount = $("#payingAmount" + row_count).val();
  var Remaining = $("#Remaining" + row_count).val();
  var balance = $("#balance" + row_count).val();
  if (parseFloat(payingAmount) > parseFloat(balance)) {
    $("#payingAmount" + row_count).val(0);
    $("#Remaining" + row_count).val(balance);

    $("#balanceAmt" + row_count).text(balance);
  } else {
    var Rem = parseFloat(balance) - parseFloat(payingAmount);
    $("#Remaining" + row_count).val(Rem);
    $("#balanceAmt" + row_count).text(Rem);
  }
  getAllTotals();
}

function getAllTotals() {
  var sum = 0;
  $(".payingAmt").each(function () {
    sum += +$(this).val();
  });
  $("#total").val(sum);
  $("#netTotal").val(sum);
  $("#span_netTotal").text(sum);
  $("#disPer").val(0);
  $("#disAmt").val(0);
}

function gridCalculation() {
  var cnt = 1;
  var row_count = $("#nrows").val();
  while (cnt < row_count) {
    var balance = $("#balance" + cnt).val();
    $("#payingAmount" + cnt).val(0);
    $("#Remaining" + cnt).val(balance);
    cnt++;
  }
}

function mainCalculation() {
  var row_count = $("#nrows").val();
  var total = $("#total").val();
  var cnt = 1;
  var customer_balance = $("#customer_balance").val();
  if (parseFloat(total) >= parseFloat(customer_balance)) {
    var advance = parseFloat(total) - parseFloat(customer_balance);
    $("#advance").val(advance);
    $("#span_Advance").val(advance);

    while (cnt < row_count) {
      var balance = $("#balance" + cnt).val();
      $("#payingAmount" + cnt).val(balance);
      $("#Remaining" + cnt).val(0);
      cnt++;
    }
  } else {
    $("#advance").val(0);
    $("#span_Advance").val(0);
    while (cnt < row_count) {
      var balance = $("#balance" + cnt).val();
      var baki = $("#baki").val();
      if (parseFloat(baki) == parseFloat(balance)) {
        $("#payingAmount" + cnt).val(baki);
        $("#Remaining" + cnt).val(0);
        $("#baki").val(0);
        return false;
      }

      if (parseFloat(baki) > parseFloat(balance)) {
        var balance = $("#balance" + cnt).val();
        var Remaining = parseFloat($("#Remaining" + cnt).val());
        var CurrentBaki = parseFloat(baki) - parseFloat(balance);
        $("#baki").val(CurrentBaki);
        $("#payingAmount" + cnt).val(balance);
        $("#Remaining" + cnt).val(0);
      }

      if (parseFloat(baki) < parseFloat(balance)) {
        var balance = $("#balance" + cnt).val();
        var Remaining = parseFloat($("#Remaining" + cnt).val());
        var CurrentBaki = parseFloat(baki) - parseFloat(balance);
        var Rem = parseFloat(balance) - parseFloat(baki);
        $("#baki").val(0);
        $("#payingAmount" + cnt).val(baki);
        $("#Remaining" + cnt).val(Rem);
        return false;
      }
      cnt++;
    }
  }
}

function TotVal(vvl) {
  $("#disPer").val(0);
  $("#disAmt").val(0);
  $("#netTotal").val(vvl);
  $("#span_netTotal").text(vvl);
  calculateAdvance();
}

function calculateWholeDiscountAmount(vvl) {
  var total = $("#total").val();
  var discam = parseFloat(total) * parseFloat(vvl);
  var discamount = discam / 100;
  var dc = discamount.toFixed(2);
  $("#disAmt").val(dc);
  var nT = parseFloat(total) - parseFloat(dc);
  nT = nT.toFixed(2);
  $("#netTotal").val(nT);
  $("#span_netTotal").html(nT);
  calculateAdvance();
}

function calculateWholeDiscountper(vvl) {
  var total = $("#total").val();
  var discam = parseFloat(vvl) / parseFloat(total);
  discam = discam * 100;
  var dc = discam.toFixed(2);
  $("#disPer").val(dc);
  var nT = parseFloat(total) - parseFloat(vvl);
  nT = nT.toFixed(2);
  $("#netTotal").val(nT);
  $("#span_netTotal").html(nT);
  calculateAdvance();
}

function calculateAdvance() {
  var cust_balance = $("#cust_balance").val();
  var netTotal = $("#netTotal").val();
  var Advance = parseFloat(netTotal) - parseFloat(cust_balance);
  Advance = Advance.toFixed(2);
  if (parseFloat(Advance) > 0) {
    $("#span_Advance").text(Advance);
    $("#Advance").val(Advance);
  }
}

function saveVoucher() {
  var netTotal = $("#total").val();
  if (parseFloat(netTotal) < 1) {
    $("#total").css("border", "1px solid red");
    anyaction = true;
  } else {
    $("#total").css("border", "1px solid green");
    anyaction = false;
  }
  if (anyaction) {
    return false;
  }
  var myform = document.getElementById("Form_voucher");
  var fd = new FormData(myform);
  document.getElementById("saveVoucher").innerHTML =
    "<img src='loader/wheel.gif' style='width:10%' />";
  $.ajax({
    url: "include/payment/saveVoucher.php",
    data: fd,
    cache: false,
    processData: false,
    contentType: false,
    type: "POST",
    success: function (dataofconfirm) {
      $("#saveVoucher").html(dataofconfirm);
    },
  });
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