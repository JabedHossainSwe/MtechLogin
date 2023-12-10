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
  $("#branch").select2({
    width: "100%",
    closeOnSelect: true,
  });

  $("#Salesman").select2({
    width: "100%",
    closeOnSelect: true,
  });
  $("#custAreaId").select2({
    width: "100%",
    closeOnSelect: true,
  });
  $("#Currency").select2({
    width: "100%",
    closeOnSelect: true,
  });
});

function validateEntry() {
  var error = 0;
  var vvl = document.getElementsByClassName("grpreq");
  for (var i = 0; i < vvl.length; i++) {
    var val = $(".grpreq")[i].value;
    var curr_Id = $(".grpreq")[i].id;
    if (val == "") {
      document.getElementById(curr_Id).style.border = "1px solid red";

      document.getElementById(curr_Id + "_error").innerHTML =
        " * This Field Is Required";
      error = 1;
    } else {
      document.getElementById(curr_Id).style.border = "1px solid green";
      console.log(curr_Id);
      document.getElementById(curr_Id + "_error").innerHTML = "";
    }
  }
  return error;
}

function saveCustomer() {
  var a = validateEntry();
  if (a == "1") {
    return false;
  }
  document.getElementById("save").innerHTML =
    "<div style='background: #fff;text-align:center'><img width='80px' src='assets/img/loaders/loader.gif'/><div>";
  var myform = document.getElementById("save_form");
  var fd = new FormData(myform);
  $("#seles_report_search").attr("disabled", true);
  $.ajax({
    url: "include/customers/save.php",
    data: fd,
    cache: false,
    processData: false,
    contentType: false,
    type: "POST",
    success: function (dataofconfirm) {
      $("#save").html(dataofconfirm);
      $("#seles_report_search").attr("disabled", false);
    },
  });
}
function updateCustomer() {
  var a = validateEntry();
  if (a == "1") {
    return false;
  }
  document.getElementById("save").innerHTML =
    "<div style='background: #fff;text-align:center'><img width='80px' src='assets/img/loaders/loader.gif'/><div>";
  var myform = document.getElementById("save_form");
  var fd = new FormData(myform);
  $("#seles_report_search").attr("disabled", true);
  $.ajax({
    url: "include/customers/update.php",
    data: fd,
    cache: false,
    processData: false,
    contentType: false,
    type: "POST",
    success: function (dataofconfirm) {
      $("#save").html(dataofconfirm);
      $("#seles_report_search").attr("disabled", false);
    },
  });
}

function loadPage(pg) {
  location.href = pg;
}

function deleteEntry(CCode, bid) {
  var result = confirm("Want to delete?");
  if (result) {
    document.getElementById("deleteEntry").innerHTML =
      "<div style='background: #fff;text-align:center'><img width='80px' src='assets/img/loaders/loader.gif'/><div>";
    $.post(
      "include/customers/deleteEntry.php",
      { CCode: CCode, bid: bid },
      function (data) {
        $("#deleteEntry").html(data);
      }
    );
  }
}

function reloadVoucher() {
  var Bid = $("#branch").val();
  var CCode = $("#CCode").val();
  var anyaction = false;

  if (Bid == "") {
    $("#Bid").css("border", "2px solid red");
    anyaction = true;
  }

  if (CCode == "") {
    $("#CCode").css("border", "2px solid red");
    anyaction = true;
  }

  if (anyaction) {
    return false;
  } else {
    $.post(
      "include/customers/reloadVoucher.php",
      {
        Bid: Bid,
        CCode: CCode,
      },
      function (data) {
        $("#SalesVoucherDiv").html(data);
      }
    );
  }
}

function editVoucher(Bid, CCode) {
  document.getElementById("editVoucher").innerHTML =
    "<img width='80px' src='loader/wheel.gif'/>";

  $.post(
    "include/customers/editVoucher.php",
    {
      Bid: Bid,
      CCode: CCode,
    },
    function (data) {
      $("#editVoucher").html(data);
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