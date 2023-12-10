// Toast Type
// toastr.success('You clicked Success toast');

// toastr.info('You clicked Info toast')

// toastr.error('You clicked Error Toast')

// toastr.warning('You clicked Warning Toast')

// var count = 1;
// document.getElementById('branch_all').onclick = function() {
//    alert("button was clicked " + (count++) + " times");
// };

window.onkeydown = (e) => {
  switch (e.key) {
    //F10
    case "F10":
      AddPurchase();
      break;
  }
};

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
  //fetchProductDetailsFromCode(vvl, "");
}

function fetchSupplierDetails(vvl) {
  if (vvl != "") {
    var Bid = $("#Bid").val();
    //document.getElementById('fetchProductDetails').innerHTML ="<img width='80px' src='loader/wheel.gif'/>";

    $.post(
      "vouchers/purchase/fetchSupplierDetails.php",
      {
        Cid: vvl,
      },
      function (data) {
        $("#fetchProductDetails").html(data);
      }
    );
  }
}

$(document).ready(function () {
  $("#supplier_name").select2({
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
        results.push({
          id: 0,
          text: "Please Select Group",
        });
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
  var code = $("#code").val();
  var product = $("#product").val();
  var product_name = $("#product").text();
  var unit = $("#unit").val();

  var unit_name = $("#unit").children("option").filter(":selected").text();
  console.log(unit_name);
  var qty = $("#qty").val();
  var bonus = $("#bonus").val();
  var price = $("#price").val();
  var total = $("#total").val();
  var disPer = $("#disPer").val();
  var disAmt = $("#disAmt").val();
  var net_total = $("#net_total").val();
  var cpp = $("#cpp").val();
  var acp = $("#acp").val();
  var SPrice = $("#SPrice").val();
  var lprice = $("#lprice").val();
  var vatPer = $("#vatPer").val();
  var vatAmt = $("#vatAmt").val();
  var vattotal = $("#vattotal").val();
  var grand_total = $("#grand_total").val();
  var Pid = $("#Pid").val();
  var altCode = $("#altCode").val();
  var actPrice = $("#actPrice").val();
  var SCPer = $("#SCPer").val();
  var EmpID = $("#EmpID").val();
  var ResEmpID = $("#ResEmpID").val();
  var CPrice = $("#CPrice").val();
  var IsStockCount = $("#IsStockCount").val();
  var vatPTotal = $("#vatPTotal").val();
  var vatSprice = $("#vatSprice").val();
  var CostPrice = $("#CostPrice").val();
  var LSPrice = $("#LSPrice").val();

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

  if (disPer == "") {
    document.getElementById("disPer").style.border = "1px solid red";
    $("#disPer").focus();
    return false;
  }
  if (disAmt == "") {
    document.getElementById("disAmt").style.border = "1px solid red";
    $("#disAmt").focus();
    return false;
  }

  if (grand_total == "") {
    document.getElementById("grand_total").style.border = "1px solid red";
    $("#grand_total").focus();
    return false;
  }

  var row_count = parseInt($("#row_count").val()) + 1;

  var in_html = $("#row_append").html();

  $("#row_append").innerHTML =
    "<img src='loader/wheel.gif' style='width:10%' />";

  $.post(
    "vouchers/purchase/addRow.php",
    {
      code: code,
      product: product,
      product_name: product_name,
      unit: unit,
      unit_name: unit_name,
      qty: qty,
      bonus: bonus,
      price: price,
      total: total,
      disPer: disPer,
      disAmt: disAmt,
      net_total: net_total,
      cpp: cpp,
      acp: acp,
      SPrice: SPrice,
      lprice: lprice,
      vatPer: vatPer,
      vatAmt: vatAmt,
      vattotal: vattotal,
      grand_total: grand_total,
      Pid: Pid,
      altCode: altCode,
      actPrice: actPrice,
      SCPer: SCPer,
      EmpID: EmpID,
      ResEmpID: ResEmpID,
      CPrice: CPrice,
      IsStockCount: IsStockCount,
      vatPTotal: vatPTotal,
      vatSprice: vatSprice,
      LSPrice: LSPrice,
      CostPrice: CostPrice,

      row_count: row_count,
    },
    function (data) {
      // console.log(data);
      $("#row_append").append(data);
      // $("#row_append").append(in_html);
      $("#row_count").val(row_count);

      // console.log(row);

      $("#code").val("");
      $("#product").each(function () {
        //added a each loop here
        $(this).select2("val", "");
      });

      product_name = "";
      $("#unit").val("");
      $("#qty").val(0);
      $("#bonus").val(0);
      $("#price").val(0);
      $("#total").val(0);
      $("#disPer").val(0);
      $("#disAmt").val(0);
      $("#net_total").val(0);
      $("#cpp").val(0);
      $("#acp").val(0);
      $("#SPrice").val(0);
      $("#lprice").val(0);
      $("#vatPer").val(0);
      $("#vatAmt").val(0);
      $("#vattotal").val(0);
      $("#grand_total").val(0);
      $("#Pid").val("");
      $("#altCode").val("");
      $("#actPrice").val("");
      $("#SCPer").val("");
      $("#EmpID").val("");
      $("#ResEmpID").val("");
      $("#CPrice").val("");
      $("#IsStockCount").val("");
      $("#vatPTotal").val("");
      $("#vatSprice").val("");
      $("#CostPrice").val("");
      $("#LSPrice").val("");
    }
  );
}

function findRowTotal() {}

function edit_row(idx) {
  document.getElementById("modalContent").innerHTML =
    "<img src='loader/wheel.gif' style='width:10%' />";
  // document.getElementById("modalTitle").innerHTML = "Edit Product";
  // document.getElementById("helperText").innerHTML = "";
  // $("#mdlLg").addClass("modal-lg");

  // javascript: $("#myModal2").modal("show", { backdrop: "static" });
  // $.post("vouchers/purchase/AddPurchase.php", {}, function (data) {
  // $("#modalContent").html(data);

  $(document).ready(function () {
    var code = $("#code" + idx).val();
    var product = $("#product" + idx).val();
    var product_name = $("#product_name" + idx).val();
    var unit = $("#unit" + idx).val();
    var qty = $("#qty" + idx).val();
    var price = $("#price" + idx).val();
    var total = $("#total" + idx).val();
    var disPer = $("#disPer" + idx).val();
    var disAmt = $("#disAmt" + idx).val();
    var net_total = $("#net_total" + idx).val();
    var grand_total = $("#grand_total" + idx).val();
    var unit_name = $("#unit_name" + idx).val();
    var bonus = $("#bonus" + idx).val();
    var cpp = $("#cpp" + idx).val();
    var acp = $("#acp" + idx).val();
    var SPrice = $("#SPrice" + idx).val();
    var lprice = $("#lprice" + idx).val();
    var vatPer = $("#vatPer" + idx).val();
    var vatAmt = $("#vatAmt" + idx).val();
    var vattotal = $("#vattotal" + idx).val();
    var grand_total = $("#grand_total" + idx).val();
    var Pid = $("#Pid" + idx).val();
    var altCode = $("#altCode" + idx).val();
    var actPrice = $("#actPrice" + idx).val();
    var SCPer = $("#SCPer" + idx).val();
    var EmpID = $("#EmpID" + idx).val();
    var ResEmpID = $("#ResEmpID" + idx).val();
    var CPrice = $("#CPrice" + idx).val();
    var IsStockCount = $("#IsStockCount" + idx).val();
    var vatPTotal = $("#vatPTotal" + idx).val();
    var vatSprice = $("#vatSprice" + idx).val();
    var LSPrice = $("#LSPrice" + idx).val();
    var CostPrice = $("#CostPrice" + idx).val();

    $("#code").val(code);
    //$("#product").select2("val", "");

    // var newOption = new Option(code + " - " + product_name, code, true, true);
    // Append it to the select
    // $("#product").html(newOption).trigger("change");

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

    // fetchProductUnits(code);

    // $("#unit").val('unit_name');
    $("#qty").val(qty);
    $("#price").val(price);
    $("#total").val(total);
    $("#disPer").val(disPer);
    $("#disAmt").val(disAmt);
    $("#net_total").val(net_total);
    $("#grand_total").val(grand_total);
    // $("#unit").text(unit_name);
    $("#bonus").val(bonus);
    $("#cpp").val(cpp);
    $("#acp").val(acp);
    $("#SPrice").val(SPrice);
    $("#lprice").val(lprice);
    $("#vatPer").val(vatPer);
    $("#vatAmt").val(vatAmt);
    $("#vattotal").val(vattotal);
    $("#Pid").val(Pid);
    $("#altCode").val(altCode);
    $("#actPrice").val(actPrice);
    $("#SCPer").val(SCPer);
    $("#EmpID").val(EmpID);
    $("#ResEmpID").val(ResEmpID);
    $("#CPrice").val(CPrice);
    $("#IsStockCount").val(IsStockCount);
    $("#vatPTotal").val(vatPTotal);
    $("#vatSprice").val(vatSprice);
    $("#CostPrice").val(CostPrice);
    $("#LSPrice").val(LSPrice);
    $("#unit_name").val(unit_name);
    setProductUnits(code, unit);

    $("#action_id").html(
      '<button type="button" name="add_row" id="add_row" class="btn btn-info"  data-dismiss="modal" onclick="updateRow(' +
        idx +
        ')">Update</button>'
    );
  });
  // });
}

function updateRow(idx) {
  var code = $("#code").val();
  var product = $("#product").val();
  var product_name = $("#product").text();
  var unit = $("#unit").val();
  console.log(unit);

  var unit_name = $("#unit").children("option").filter(":selected").text();
  var qty = $("#qty").val();
  var price = $("#price").val();
  var total = $("#total").val();
  var disPer = $("#disPer").val();
  var disAmt = $("#disAmt").val();
  var net_total = $("#net_total").val();
  var grand_total = $("#grand_total").val();
  var bonus = $("#bonus").val();
  var cpp = $("#cpp").val();
  var acp = $("#acp").val();
  var SPrice = $("#SPrice").val();
  var lprice = $("#lprice").val();
  var vatPer = $("#vatPer").val();
  var vatAmt = $("#vatAmt").val();
  var vattotal = $("#vattotal").val();
  var Pid = $("#Pid").val();
  var altCode = $("#altCode").val();
  var actPrice = $("#actPrice").val();
  var SCPer = $("#SCPer").val();
  var EmpID = $("#EmpID").val();
  var ResEmpID = $("#ResEmpID").val();
  var CPrice = $("#CPrice").val();
  var IsStockCount = $("#IsStockCount").val();
  var vatPTotal = $("#vatPTotal").val();
  var vatSprice = $("#vatSprice").val();
  var LSPrice = $("#LSPrice").val();
  var CostPrice = $("#CostPrice").val();

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
  if (disPer == "") {
    document.getElementById("disPer").style.border = "1px solid red";
    $("#disPer").focus();
    return false;
  }
  if (disAmt == "") {
    document.getElementById("disAmt").style.border = "1px solid red";
    $("#disAmt").focus();
    return false;
  }
  if (grand_total == "") {
    document.getElementById("grand_total").style.border = "1px solid red";
    $("#grand_total").focus();
    return false;
  }

  var row_count = parseInt($("#row_count").val()) + 1;
  var in_html = $("#row_append").html();
  $("#row_append").innerHTML =
    "<img src='loader/wheel.gif' style='width:10%' />";

  $.post(
    "vouchers/purchase/updateRow.php",
    {
      code: code,
      product: product,
      product_name: product_name,
      unit: unit,
      unit_name: unit_name,
      qty: qty,
      price: price,
      total: total,
      disPer: disPer,
      disAmt: disAmt,
      net_total: net_total,
      grand_total: grand_total,
      bonus: bonus,
      cpp: cpp,
      acp: acp,
      SPrice: SPrice,
      lprice: lprice,
      vatPer: vatPer,
      vatAmt: vatAmt,
      vattotal: vattotal,
      Pid: Pid,
      altCode: altCode,
      actPrice: actPrice,
      SCPer: SCPer,
      EmpID: EmpID,
      ResEmpID: ResEmpID,
      CPrice: CPrice,
      IsStockCount: IsStockCount,
      vatPTotal: vatPTotal,
      vatSprice: vatSprice,
      CostPrice: CostPrice,
      LSPrice: LSPrice,

      row_count: idx,
    },
    function (data) {
      // console.log(data);
      $("#row_" + idx).html(data);

      $("#code").val("");
      $("#product").select2("val", "");

      $("#unit").val("");
      $("#qty").val(0);
      $("#price").val(0);
      $("#total").val(0);
      $("#disPer").val(0);
      $("#disAmt").val(0);
      $("#net_total").val(0);
      $("#grand_total").val(0);
      $("#bonus").val(0);
      $("#cpp").val(0);
      $("#acp").val(0);
      $("#SPrice").val(0);
      $("#lprice").val(0);
      $("#vatPer").val(0);
      $("#vatAmt").val(0);
      $("#vattotal").val(0);
      $("#Pid").val(0);
      $("#altCode").val(0);
      $("#actPrice").val("");
      $("#SCPer").val("");
      $("#EmpID").val("");
      $("#ResEmpID").val("");
      $("#CPrice").val("");
      $("#IsStockCount").val("");
      $("#vatPTotal").val("");
      $("#vatSprice").val("");
      $("#LSPrice").val("");
      $("#CostPrice").val("");

      $("#action_id").html(
        '<button type="button" name="add_row" id="add_row" class="btn btn-info" onclick="addRow()">Add</button>'
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
  // document.getElementById("getProductUnit").innerHTML ="<div style='background: #fff;text-align:center'><img width='80px' src='assets/img/loaders/loader.gif'/><div>";

  var Bid = $("#Bid").val();

  $.post(
    "vouchers/purchase/fetchProductUnits.php",
    {
      code: code,
      Bid: Bid,
    },
    function (data) {
      $("#getProductUnit").html(data);
    }
  );
}

function salesAddRowCalculations() {
  var qty = $("#qty").val();
  var price = $("#price").val();
  var vatPer = $("#vatPer").val();
  var disPer = $("#disPer").val();

  var vatAmtTotal = ((parseFloat(price) * parseFloat(vatPer)) / 100).toFixed(2);
  var vatAmtPer = (
    (parseFloat(vatAmtTotal) * parseFloat(disPer)) /
    100
  ).toFixed(2);
  var vatAmt = (parseFloat(vatAmtTotal) - parseFloat(vatAmtPer)).toFixed(2);

  $("#vatAmt").val(vatAmt);

  var vatTotal = (parseFloat(qty) * parseFloat(vatAmt)).toFixed(2);
  var total = (parseFloat(qty) * parseFloat(price)).toFixed(2);
  $("#total").val(total);

  var disPer = $("#disPer").val();
  var disAmt = ((parseFloat(total) * parseFloat(disPer)) / 100).toFixed(2);
  $("#disAmt").val(disAmt);

  var net_total = (parseFloat(total) - parseFloat(disAmt)).toFixed(2);
  var vatPlusTotal = (parseFloat(net_total) + parseFloat(vatTotal)).toFixed(2);
  $("#net_total").val(net_total);
  $("#f_total_int").val(net_total);
  $("#sal_amount1").val(net_total);
  $("#grand_total").val(vatPlusTotal);
  $("#SCPer").val(0);
  $("#SPrice").val(price);
  $("#vattotal").val(vatTotal);

  // var adv_tax_per = $("#adv_tax_per").val();

  // var disAmt = (parseFloat(net_total) * parseFloat(vatPer)) / 100;
  // $("#vatAmt").val(disAmt);

  // var g_grand_total = parseFloat(net_total) - parseFloat(disAmt);
  // $("#grand_total").val(g_grand_total);
}

function calculateDisPer() {
  var qty = $("#qty").val();
  var price = $("#price").val();
  var acp = $("#acp").val();
  var disAmt = $("#disAmt").val();
  var vatAmt = $("#vatAmt").val();

  var vatTotal = (parseFloat(qty) * parseFloat(vatAmt)).toFixed(2);
  var total = (parseFloat(qty) * parseFloat(price)).toFixed(2);
  $("#total").val(total);

  // var disPer = $("#disPer").val();
  // var disAmt = ((parseFloat(total) * parseFloat(disPer)) / 100).toFixed(2);
  var disPer = ((parseFloat(disAmt) / parseFloat(total)) * 100).toFixed(2);
  // $("#disAmt").val(disAmt);
  $("#disPer").val(disPer);

  var net_total = (parseFloat(total) - parseFloat(disAmt)).toFixed(2);
  var vatPlusTotal = (parseFloat(net_total) + parseFloat(vatTotal)).toFixed(2);
  $("#net_total").val(net_total);
  $("#f_total_int").val(net_total);
  $("#sal_amount1").val(net_total);
  $("#grand_total").val(vatPlusTotal);
  $("#SCPer").val(0);
  $("#SPrice").val(price);
  $("#vattotal").val(vatTotal);

  // var adv_tax_per = $("#adv_tax_per").val();

  // var disAmt = (parseFloat(net_total) * parseFloat(vatPer)) / 100;
  // $("#vatAmt").val(disAmt);

  // var g_grand_total = parseFloat(net_total) - parseFloat(disAmt);
  // $("#grand_total").val(g_grand_total);
}

function salesTotalCalculation() {
  var t_total_sum = 0;
  var t_vat_sum = 0;
  var t_vat_sum = 0;
  var ft_gtTotal = 0;
  $(".t_net_total").each(function () {
    t_total_sum += parseFloat(this.value);
  });
  t_total_sum = t_total_sum.toFixed(2);

  $(".t_vattotal").each(function () {
    t_vat_sum += parseFloat(this.value);
  });
  t_vat_sum = t_vat_sum.toFixed(2);

  $(".t_grandtotal").each(function () {
    ft_gtTotal += parseFloat(this.value);
  });
  ft_gtTotal = ft_gtTotal.toFixed(2);

  $("#f_total_int").val(t_total_sum);
  $("#sal_amount1").val(t_total_sum);
  $("#f_total_vat").val(t_vat_sum);
  $("#initial_total_vat").val(t_vat_sum);
  $("#f_grand_total").val(ft_gtTotal);

  var t_gst_total = 0;
  $(".t_gst_total").each(function () {
    t_gst_total += parseFloat(this.value);
  });
  t_gst_total = t_gst_total.toFixed(2);

  $("#f_gst_total").val(t_gst_total);

  var t_grandtotal = 0;
  $(".t_grandtotal").each(function () {
    t_grandtotal += parseFloat(this.value);
  });
  t_grandtotal = t_grandtotal.toFixed(2);

  $("#f_net_total").val(t_total_sum);

  $("#f_grand_total").val(t_grandtotal);
  $("#sal_amount1").val(t_grandtotal);
  $("#f_dis_per").val(0);
  $("#f_dis_amt").val(0);
}

function salesTotalDiscountCalculation() {
  var f_dis_per = $("#f_dis_per").val();
  if (f_dis_per == "") {
    $("#f_dis_amt").val(0);
    $("#f_dis_per").val(0);
    return false;
  }
  var f_total_int = $("#f_total_int").val();
  var f_net_total = $("#f_net_total").val();
  var initial_total_vat = $("#initial_total_vat").val();

  var f_dis_amts = (
    (parseFloat(f_dis_per) * parseFloat(f_total_int)) /
    100
  ).toFixed(2);

  var f_dis_amtForVat = (
    (parseFloat(f_dis_per) * parseFloat(initial_total_vat)) /
    100
  ).toFixed(2);

  var vatAfterDiscount =
    parseFloat(initial_total_vat) - parseFloat(f_dis_amtForVat);
  vatAfterDiscount = vatAfterDiscount.toFixed(2);

  $("#f_total_vat").val(vatAfterDiscount);
  $("#f_dis_amt").val(f_dis_amts);

  var f_total_int = $("#f_total_int").val();
  var f_dis_amt = $("#f_dis_amt").val();

  var f_net_total = (parseFloat(f_total_int) - parseFloat(f_dis_amt)).toFixed(
    2
  );
  var f_gst_total = (parseFloat(f_total_int) - parseFloat(f_dis_amt)).toFixed(
    2
  );
  var f_grand_total = (parseFloat(f_total_int) - parseFloat(f_dis_amt)).toFixed(
    2
  );

  f_grand_total =
    parseFloat(f_grand_total) + parseFloat($("#f_total_vat").val());

  $("#f_net_total").val(f_net_total);
  $("#f_gst_total").val(f_gst_total);
  $("#f_grand_total").val(f_grand_total);
  $("#sal_amount1").val(f_grand_total);
}

function salesTotalDiscountCalculationWithAMount() {
  var f_total_int = $("#f_total_int").val();
  var f_dis_amt = $("#f_dis_amt").val();
  if (f_dis_amt == "") {
    f_dis_amt = 0;
    $("#f_dis_amt").val(0);
  }
  var initial_total_vat = $("#initial_total_vat").val();

  var f_dis_persentage =
    (parseFloat(f_dis_amt) * 100) / parseFloat(f_total_int);

  $("#f_dis_per").val(f_dis_persentage.toFixed(2));
  $("#f_net_total").val(parseFloat(f_total_int) - parseFloat(f_dis_amt));
  var f_dis_per = $("#f_dis_per").val();
  var f_dis_amtForVat = (
    (parseFloat(f_dis_per) * parseFloat(initial_total_vat)) /
    100
  ).toFixed(2);
  var vatAfterDiscount =
    parseFloat(initial_total_vat) - parseFloat(f_dis_amtForVat);
  vatAfterDiscount = vatAfterDiscount.toFixed(2);

  $("#f_total_vat").val(vatAfterDiscount);

  var ggTotal = parseFloat(f_total_int) - parseFloat(f_dis_amt);

  ggTotal = parseFloat(ggTotal) + parseFloat($("#f_total_vat").val());
  $("#f_grand_total").val(ggTotal);
  $("#sal_amount1").val(ggTotal);
}

function SaveSalesVoucher() {
  var SPType = $(".SPType:checked").val();
  var anyaction = false;
  if (SPType == "2") {
    var supplier_name = document.getElementById("supplier_name").value;
    if (supplier_name == "") {
      $("#supplier_name")
        .siblings(".select2-container")
        .css("border", "2px solid red");
      anyaction = true;
    } else {
      $("#supplier_name")
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
  var f_total_int = document.getElementById("f_total_int").value;
  if (f_total_int == "" || parseFloat(f_total_int) == 0) {
    $("#f_total_int").css("border", "2px solid red");
    anyaction = true;
  } else {
    $("#f_total_int").css("border", "1px solid green");
  }

  // var f_grand_total = document.getElementById("f_grand_total").value;
  // if (f_grand_total == "" || parseFloat(f_grand_total) == 0) {
  //   $("#f_grand_total").css("border", "2px solid red");
  //   anyaction = true;
  // } else {
  //   $("#f_grand_total").css("border", "1px solid green");
  // }

  if (anyaction) {
    return false;
  }

  var myform = document.getElementById("sales_report_form");
  var fd = new FormData(myform);

  document.getElementById("SalesVoucherDiv").innerHTML =
    "<div style='background: #fff;text-align:center'><img width='80px' src='assets/img/loaders/loader.gif'/><div>";
  $.ajax({
    url: "vouchers/purchase/SaveSalesVoucher.php",
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
      "vouchers/purchase/fetchProductDetailsFromCode.php",
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
    // document.getElementById("getProductList").innerHTML = "<img width='80px' src='loader/wheel.gif'/>";

    $.post(
      "vouchers/purchase/getProductList.php",
      {
        code: vvl,
      },
      function (data) {
        $("#getProductList").html(data);
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
      "vouchers/purchase/fetchProductUnits.php",
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

function fetchProductDetails(vvl, Uid) {
  if (vvl != "") {
    var Bid = $("#Bid").val();
    var product_name = $("#product").text();
    $("#product").text(product_name);
    // document.getElementById("fetchProductDetails").innerHTML = "<img width='80px' src='loader/wheel.gif'/>";

    $.post(
      "vouchers/purchase/fetchProductDetails.php",
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

function LoadUnitPrice(Uid, vvl) {
  if (vvl != "" && Uid != "") {
    var Bid = $("#Bid").val();
    // document.getElementById('fetchProductDetails').innerHTML ="<img width='80px' src='loader/wheel.gif'/>";
    $.post(
      "vouchers/purchase/LoadUnitPrice.php",
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
      "vouchers/purchase/Pricecalculations.php",
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
    $("#vatSPrice").val(totVal);
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
      "vouchers/purchase/PricecalculationsRow.php",
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
    var totVal = vvl * qty;
    totVal = totVal.toFixed(2);
    $("#vatSPrice" + row_count).val(totVal);
  }
}

function AddPurchase() {
  document.getElementById("modalContent").innerHTML =
    "<img src='loader/wheel.gif' style='width:10%' />";
  document.getElementById("modalTitle").innerHTML = "Add Product";
  document.getElementById("helperText").innerHTML = "";
  $("#mdlLg").addClass("modal-lg");

  javascript: $("#myModal2").modal("show", { backdrop: "static" });
  $.post("vouchers/purchase/AddPurchase.php", {}, function (data) {
    $("#modalContent").html(data);
  });
}

function calculateSPrice() {
  var SCPer = $("#SCPer").val();
  var price = $("#price").val();
  if (SCPer == "") {
    SCPer = 0;
  }

  var SPrice = (parseFloat(price) * parseFloat(SCPer)) / 100;

  SPrice = parseFloat(price) + parseFloat(SPrice);

  $("#SPrice").val(SPrice);
}

$(document).ready(function () {
  $("#PurType_name").select2({
    width: "100%",
    closeOnSelect: true,
    placeholder: "",
    //minimumInputLength: 2,
    ajax: {
      url: "Api/listings/GetPurTypeList",
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
          text: "Please Select Purchase Type",
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
$(document).ready(function () {
  $("#Pur_name").select2({
    width: "100%",
    closeOnSelect: true,
    placeholder: "",
    //minimumInputLength: 2,
    ajax: {
      url: "Api/listings/GetPurPurchaserList",
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
      "vouchers/purchase/reloadVoucher.php",
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
  // document.getElementById("editVoucher").innerHTML ="<img width='80px' src='loader/wheel.gif'/>";

  $.post(
    "vouchers/purchase/editVoucher.php",
    {
      Bid: Bid,
      Billno: Billno,
    },
    function (data) {
      $("#editVoucher").html(data);
    }
  );
}

function deletePurchase(Billno, Bid, sBid) {
	
var result = confirm("Are You Sure You Want to DELETE?");
if (result) {
//Logic to delete the item

document.getElementById("editVoucher").innerHTML =
"<img width='80px' src='loader/wheel.gif'/>";

$.post(
"vouchers/purchase/deletePurchase.php",
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
}
function PrintPopupVoucher(query, type) {
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
    "vouchers/purchase/print.php?Billno=" +
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
  var LanguageId = $("#print_language").val();
  $.post(
    "vouchers/purchase/send_email.php",
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

function purchase_return_addRow(Bid, Billno, sBid, LanguageId) {
  // var in_html = $("#row_append").html();
  $.post(
    "vouchers/purchase/purchase_return_addRow.php",
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

function updatePurchaseVoucher() {
  var SPType = $(".SPType:checked").val();
  var anyaction = false;

  var bill_date_time = document.getElementById("bill_date_time").value;
  if (bill_date_time == "") {
    $("#bill_date_time").css("border", "2px solid red");
    anyaction = true;
  } else {
    $("#bill_date_time").css("border", "1px solid green");
  }

  var f_grand_total = document.getElementById("f_grand_total").value;
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
    url: "vouchers/purchase/updatePurchaseVoucher.php",
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

function loadBanksagainstBrank(bnkVal) {
  if (bnkVal != "") {
    document.getElementById("loadBanksagainstBrank").innerHTML =
      "<img width='80px' src='loader/wheel.gif'/>";
    $.post(
      "vouchers/purchase/loadBanksagainstBrank.php",
      {
        code: bnkVal,
      },
      function (data) {
        $("#loadBanksagainstBrank").html(data);
      }
    );
  }
}
function loadBanksagainstBranchWithBill(Bid, BillNo, sBid) {
  $.post(
    "vouchers/purchase/loadBanksagainstBranchWithBill.php",
    {
      Bid: Bid,
      BillNo: BillNo,
      sBid: sBid,
    },
    function (data) {
      $("#loadBanksagainstBrank").html(data);
    }
  );
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
      "vouchers/purchase/reloadVoucher.php",
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

function setProductUnits(vvl, uid) {
  if (vvl != "") {
    var Bid = $("#Bid").val();
    // document.getElementById("loadUnits").innerHTML =
    //   "<img width='80px' src='loader/wheel.gif'/>";

    $.post(
      "vouchers/purchase/setProductUnits.php",
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

$(".SPType").on("ifChanged", SPType);

function SPType(){
  var SPType = $(".SPType:checked").val();
  if(SPType == 2){
    $("#loadBanksagainstBrank").css("display", "none");
  }
  else{
    $("#loadBanksagainstBrank").css("display", "block");
  }
}

function ACPcalculations() {
  var Bid = $("#Bid").val();
  var IsFree = 0;
  var Pid = $("#Pid").val();
  var uid = $("#unit").val();
  var PPrice = $("#price").val();
  var NetTotal = $("#net_total").val();
  var qty = $("#qty").val();
  if (qty == "") {
    qty = 1;
  }
  var bonus = $("#bonus").val();
  var QTY = parseFloat(qty) + parseFloat(bonus);
  var IsDisEffectOnCost = 0;
  var prcDiscount = 0;
  var ExpenseTotal = 0;
  var InvTotalCost = 0;
  var CurRCostTotal = 0;
  var InvDisPer = 0;
  var SavedQtyAtEditTime = 0;

  $.post(
    "vouchers/purchase/ACPcalculations.php",
    {
      Bid: Bid,
      IsFree: IsFree,
      Pid: Pid,
      uid: uid,
      prc: PPrice,
      NetTotal: NetTotal,
      qty: QTY,
      IsDisEffectOnCost: IsDisEffectOnCost,
      prcDiscount: prcDiscount,
      ExpenseTotal: ExpenseTotal,
      InvTotalCost: InvTotalCost,
      CurRCostTotal: CurRCostTotal,
      InvDisPer: InvDisPer,
      SavedQtyAtEditTime: SavedQtyAtEditTime,
    },
    function (data) {
      $("#fetchProductDetails").html(data);
    }
  );
}

function CheckPurchaseOrderBill() {
  var Bid = $("#Bid").val();
  var Billno = $("#poNo").val();
  var anyaction = false;

  if (Bid == "") {
    $("#Bid").css("border", "2px solid red");
    anyaction = true;
  }

  if (Billno == "") {
    $("#poNo").css("border", "2px solid red");
    anyaction = true;
  }

  if (anyaction) {
    return false;
  } else {
    $.post(
      "vouchers/purchase/CheckPurchaseOrderBill.php",
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

function loadAllSectionsForPurchaseOrder(
  Bid,
  Billno,
  sBid,
  LanguageId,
  customer_id
) {
  $(".items_sec").css("display", "block");
  $(".total_sec").css("display", "block");
  $("#customer_id").val(customer_id);

  purchase_order_bill_no_area(Bid, Billno, sBid, LanguageId);
  $("#product_add_section").remove();
  purchase_order_product_add_addRow(Bid, Billno, sBid, LanguageId);
  // bank_section(Bid,Billno,sBid,LanguageId);
}

function purchase_order_bill_no_area(Bid, Billno, sBid, LanguageId) {
  document.getElementById("bill_no_area").innerHTML =
    "<img width='80px' src='loader/wheel.gif'/>";
  $.post(
    "vouchers/purchase/purchase_order_bill_no_area.php",
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

function purchase_order_product_add_addRow(Bid, Billno, sBid, LanguageId) {
  var in_html = $("#row_append").html();
  $.post(
    "vouchers/purchase/purchase_order_product_add_addRow.php",
    {
      Bid: Bid,
      Billno: Billno,
      sBid: sBid,
      LanguageId: LanguageId,
    },
    function (data) {
      $("#row_append").html(data);
      // $("#row_append").append(in_html);
    }
  );
}

function CalculateRemainings() {
  var salAmnt = 0;
  $(".salAmnt").each(function () {
    salAmnt += +$(this).val();
  });

  var grandTotal = $("#f_grand_total").val();

  var aa = parseFloat(grandTotal) - parseFloat(salAmnt);
  aa.toFixed(2);
  $("#sal_amount1").val(aa);

  // $('#payment_screen_remaining').text(aa);
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

function getBillNo(Bid) {
  $.post(
    "vouchers/purchase/getBillNo.php",
    {
      Bid: Bid
    },
    function (data) {
      $("#fetchProductDetails").html(data);
    }
  );
}