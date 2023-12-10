$(document).ready(function () {
  // Morris.Bar({
  //   element: "morris-bar-chart",
  //   data: [
  //     { y: "2006", a: 60, b: 50 },
  //     { y: "2007", a: 75, b: 65 },
  //     { y: "2008", a: 50, b: 40 },
  //     { y: "2009", a: 75, b: 65 },
  //     { y: "2010", a: 50, b: 40 },
  //     { y: "2011", a: 75, b: 65 },
  //     { y: "2012", a: 100, b: 90 },
  //   ],
  //   xkey: "y",
  //   ykeys: ["a", "b"],
  //   labels: ["Series A", "Series B"],
  //   hideHover: "auto",
  //   resize: true,
  //   barColors: ["#1ab394", "#cacaca"],
  // });
});
$("#branchs").select2({
  width: "100%",
});
function loadHomePage(vvl) {
  if (vvl == "") {
    location.href = "home.php";
  } else {
    location.href = "home.php?branc=" + vvl;
  }
}

function LoadCalculations(tp, dv, vvl) {
  var branchs = document.getElementById("branchs").value;
  document.getElementById(dv).innerHTML =
    "<img src='loader/wheel.gif' style='width:50%;text-align:center' />";
  $.post(
    "include/dashboard/LoadCalculations.php",
    { tp: tp, vvl: vvl, branchs: branchs },
    function (data) {
      $("#" + dv).html(data);
    }
  );
}


$(document).ready(function () {
  var branchs = document.getElementById("branchs").value;
  loadSales('Sale', 'D', 'sales_Sec');
  loadSalesProfit('SaleProfit', 'D', 'sales_profit');
  loadExpese('Expense', 'D', 'expense_sec');
  loadSuppliers('suppliers_sec', 'D');
  loadCustomer('customer_sec');
  loadStockReport('stock_sec', branchs, 1);

  hightSaleSec('hight_sale_sec', 'D');
  totalProduct('total_product_sec', 'D');
  highExpense('high_expense_sec', 'D');
  lowExpense('low_expense_sec', 'D');
  cusNameMax('cus_name_max_sec', 'D');
  supNameMax('sup_name_max_sec', 'D');
  lowSale('low_sale_sec', 'D');
});

function loadAll() {
  var branchs = document.getElementById("branchs").value;

  loadSales('Sale', 'D', 'sales_Sec');
  loadSalesProfit('SaleProfit', 'D', 'sales_profit');
  loadExpese('Expense', 'D', 'expense_sec');
  loadSuppliers('suppliers_sec', 'D');
  loadCustomer('customer_sec');
  loadStockReport('stock_sec', branchs, 1);
  
  hightSaleSec('hight_sale_sec', 'D');
  totalProduct('total_product_sec', 'D');
  highExpense('high_expense_sec', 'D');
  lowExpense('low_expense_sec', 'D');
  cusNameMax('cus_name_max_sec', 'D');
  supNameMax('sup_name_max_sec', 'D');
  lowSale('low_sale_sec', 'D');
}

function loadStock(val){
  var branchs = document.getElementById("branchs").value;

  loadStockReport('stock_sec', branchs, val);
}

function loadSales(tp, val, dv) {
  var branchs = document.getElementById("branchs").value;
  var lang = document.getElementById("selected_lang").value;
  document.getElementById(dv).innerHTML = "<img src='loader/wheel.gif' style='height:60px;text-align:center' />";
  $.post(
    "include/dashboard/LoadCalculations.php",
    { tp: tp, val: val, branchs: branchs },
    function (data) {
      document.getElementById(dv).innerHTML = data;
      changeLanguage(lang);
    }
  );
}

function loadSalesProfit(tp, val, dv) {
  var branchs = document.getElementById("branchs").value;
  var lang = document.getElementById("selected_lang").value;
  document.getElementById(dv).innerHTML = "<img src='loader/wheel.gif' style='height:60px;text-align:center' />";
  $.post(
    "include/dashboard/LoadCalculations.php",
    { tp: tp, val: val, branchs: branchs },
    function (data) {
      document.getElementById(dv).innerHTML = data;
      changeLanguage(lang);
    }
  );
}

function loadExpese(tp, val, dv) {
  var branchs = document.getElementById("branchs").value;
  var lang = document.getElementById("selected_lang").value;
  document.getElementById(dv).innerHTML = "<img src='loader/wheel.gif' style='height:60px;text-align:center' />";
  $.post(
    "include/dashboard/LoadCalculations.php",
    { tp: tp, val: val, branchs: branchs },
    function (data) {
      document.getElementById(dv).innerHTML = data;
      changeLanguage(lang);
    }
  );
}

function loadStockReport(dv, branchs, BidPrice) {
  var lang = document.getElementById("selected_lang").value;
  document.getElementById(dv).innerHTML = "<img src='loader/wheel.gif' style='height:60px;text-align:center' />";
  $.post(
    "include/dashboard/loadStockReport.php",
    { branchs: branchs, BidPrice:BidPrice },
    function (data) {
      document.getElementById(dv).innerHTML = data;
      changeLanguage(lang);
    }
  );
}

function loadSuppliers(dv, val) {
  var branchs = document.getElementById("branchs").value;
  var lang = document.getElementById("selected_lang").value;
  document.getElementById(dv).innerHTML = "<img src='loader/wheel.gif' style='height:60px;text-align:center' />";
  $.post(
    "include/dashboard/loadSuppliers.php",
    { branchs: branchs, val:val },
    function (data) {
      document.getElementById(dv).innerHTML = data;
      changeLanguage(lang);
    }
  );
}

function loadCustomerRecieveable(dv) {
  var branchs = document.getElementById("branchs").value;
  var lang = document.getElementById("selected_lang").value;
  document.getElementById(dv).innerHTML = "<img src='loader/wheel.gif' style='height:60px;text-align:center' />";
  $.post(
    "include/dashboard/loadCustomerRecieveable.php",
    { branchs: branchs},
    function (data) {
      document.getElementById(dv).innerHTML = data;
      changeLanguage(lang);
    }
  );
}

function loadCustomer(dv, val) {
  var branchs = document.getElementById("branchs").value;
  var lang = document.getElementById("selected_lang").value;
  document.getElementById(dv).innerHTML = "<img src='loader/wheel.gif' style='height:60px;text-align:center' />";
  $.post(
    "include/dashboard/loadCustomer.php",
    { branchs: branchs, val:val },
    function (data) {
      document.getElementById(dv).innerHTML = data;
      changeLanguage(lang);
    }
  );
}

function hightSaleSec(dv, val) {
  var branchs = document.getElementById("branchs").value;
  var lang = document.getElementById("selected_lang").value;
  document.getElementById(dv).innerHTML = "<img src='loader/wheel.gif' style='height:60px;text-align:center' />";
  $.post(
    "include/dashboard/loadHightSale.php",
    { val: val, branchs: branchs, lang: lang },
    function (data) {
      document.getElementById(dv).innerHTML = data;
      changeLanguage(lang);
    }
  );
}

function totalProduct(dv, val) {
  var branchs = document.getElementById("branchs").value;
  var lang = document.getElementById("selected_lang").value;
  document.getElementById(dv).innerHTML="<img src='loader/wheel.gif' style='height:60px;text-align:center' />";

  $.post(
    "include/dashboard/loadTotalProduct.php",
    { branchs: branchs, val:val },
    function (data) {
      document.getElementById(dv).innerHTML = data;
      changeLanguage(lang);
    }
  );
}

function highExpense(dv, val) {
  var branchs = document.getElementById("branchs").value;
  var lang = document.getElementById("selected_lang").value;
  document.getElementById(dv).innerHTML="<img src='loader/wheel.gif' style='height:60px;text-align:center' />";

  $.post(
    "include/dashboard/loadHighExpense.php",
    { branchs: branchs, val:val },
    function (data) {
      document.getElementById(dv).innerHTML = data;
      changeLanguage(lang);
    }
  );
}

function lowExpense(dv, val) {
  var branchs = document.getElementById("branchs").value;
  var lang = document.getElementById("selected_lang").value;
  document.getElementById(dv).innerHTML="<img src='loader/wheel.gif' style='height:60px;text-align:center' />";

  $.post(
    "include/dashboard/loadLowExpense.php",
    { branchs: branchs, val: val, lang:lang },
    function (data) {
      document.getElementById(dv).innerHTML = data;
      changeLanguage(lang);
    }
  );
}

function cusNameMax(dv) {
  var branchs = document.getElementById("branchs").value;
  var lang = document.getElementById("selected_lang").value;
  document.getElementById(dv).innerHTML="<img src='loader/wheel.gif' style='height:60px;text-align:center' />";

  $.post(
    "include/dashboard/loadCusNameMax.php",
    { branchs: branchs},
    function (data) {
      document.getElementById(dv).innerHTML = data;
      changeLanguage(lang);
    }
  );
}

function supNameMax(dv, val) {
  var branchs = document.getElementById("branchs").value;
  var lang = document.getElementById("selected_lang").value;
  document.getElementById(dv).innerHTML="<img src='loader/wheel.gif' style='height:60px;text-align:center' />";

  $.post(
    "include/dashboard/loadSupNameMax.php",
    { branchs: branchs, val:val },
    function (data) {
      document.getElementById(dv).innerHTML = data;
      changeLanguage(lang);
    }
  );
}

function lowSale(dv, val) {
  var branchs = document.getElementById("branchs").value;
  var lang = document.getElementById("selected_lang").value;
  document.getElementById(dv).innerHTML = "<img src='loader/wheel.gif' style='height:60px;text-align:center' />";
  $.post(
    "include/dashboard/loadLowSale.php",
    { val:val, branchs:branchs, lang:lang },
    function (data) {
      document.getElementById(dv).innerHTML = data;
      changeLanguage(lang);
    }
  );
}

// function chartPopup(tp)
// {
//     $("." + tp).css("visibility", "visible");

// }

// function chartHide(tp)
// {
//     // $(".chartModel").css("visibility", "hidden");
//     $("." + tp).css("visibility", "hidden");
// }

function changeLanguage(lang){
  if(lang == 2){
    $("#selected_lang").attr('value', '2');
    $("span.en").css("display", "none");
    $("span.ar").css("display", "flex");
    $("#ar").css("display", "contents");
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
    $("span.en").css("display", "inline-block");
    $("span.ar").css("display", "none");
    $("#ar").css("display", "none");
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

function chartPopup(tp) {
  var bid = document.getElementById("branchs").value;
  javascript: $("#chartPopup").modal("show", { backdrop: "static" });

  document.getElementById("chartModel").innerHTML="<img src='loader/wheel.gif' style='width:50%;text-align:center' />";
  $.post("include/dashboard/chartPopup.php", { tp: tp, bid: bid}, function (data) {
    $("#chartModel").html(data);
  });
}

$(document).ready(function(){
  var lang = document.getElementById("selected_lang").value;
  changeLanguage(lang);
});