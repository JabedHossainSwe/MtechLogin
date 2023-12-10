$(document).ready(function () {
  $("#product").select2({
    width: "100%",
    closeOnSelect: true,
    delay: 50,

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
            text: e.Id + "-" + e.CName,
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

function saveVoucher() {
  var myform = document.getElementById("Form_voucher");
  var fd = new FormData(myform);
  document.getElementById("saveVoucher").innerHTML =
    "<img src='loader/wheel.gif' style='width:10%' />";
  $.ajax({
    url: "include/branch_transfer/saveVoucher.php",
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

function validatePurchaseNo() {
  var Bid = $("#Bid").val();
  var purInvNo = $("#purInvNo").val();

  if (purInvNo == "") {
    $("#purInvNo").css("border", "1px solid red");
    return false;
  } else {
    CheckPurchaseBill(Bid, purInvNo);
  }
}

function CheckPurchaseBill(Bid, purInvNo) {
  $.post(
    "include/branch_transfer/CheckPurchaseBill.php",
    {
      Bid: Bid,
      Billno: purInvNo,
    },
    function (data) {
      $("#customerCheck").html(data);
    }
  );
}

function addRow() {
  var product = $("#product").val();
  var Bid = $("#Bid").val();
  var nrows = $("#nrows").val();

  if (product == "") {
    document.getElementById("product").style.border = "1px solid red";
    $("#product").focus();
    return false;
  }

  $("#row_append").innerHTML =
    "<img src='loader/wheel.gif' style='width:10%' />";

  $.post(
    "include/branch_transfer/addRow.php",
    {
      Bid: Bid,
      product: product,
      nrows: nrows,
    },
    function (data) {
      // $("#row_append").html(data);
      var in_html = $("#row_append").html();
      //$("#row_append").html(data);
      $("#row_append").append(data);
      $("#product").each(function () {
        //added a each loop here
        $(this).select2("val", "");
      });
    }
  );
}

function calculateTotQty() {
  var sum = 0;
  $(".totQty").each(function () {
    sum += parseFloat(this.value);
  });

  document.getElementById("totalQtyN").innerHTML = sum;
  calculateFTotal();
}

function delete_row(id) {
  var result = confirm("Want to delete?");
  if (result) {
    $("#row_" + id).remove();
    var totalRowCount = document.getElementById("totalRowCount").innerHTML;
    document.getElementById("totalRowCount").innerHTML = totalRowCount - 1;
    calculateTotQty();
  }
}

function calculateTotal(id) {
  var Qty = $("#Qty" + id).val();
  var Price = $("#Price" + id).val();

  var total = (parseFloat(Qty) * parseFloat(Price)).toFixed(2);

  $("#Total" + id).val(total);
  calculateFTotal();
}

function calculateFTotal() {
  var f_total = 0;

  $(".totalval").each(function () {
    f_total += parseFloat(this.value);
  });

  $("#f_total").val(f_total);
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

function LoadUnitPrice(Uid, vvl, id) {
  if (vvl != "" && Uid != "") {
    var Bid = $("#Bid").val();
    $.post(
      "include/branch_transfer/LoadUnitPrice.php",
      {
        code: vvl,
        Bid: Bid,
        Uid: Uid,
        id: id,
      },
      function (data) {
        $("#saveVoucher").html(data);
      }
    );
  }
}