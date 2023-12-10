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
  d;
  $(".this_ar").removeClass("tb");
});

function loadlisting() {
  document.getElementById("loadlisting").innerHTML =
    "<div style='background: #fff;text-align:center'><img width='80px' src='assets/img/loaders/loader.gif'/><div>";
  $.post("include/customer_advance/loadlisting.php", {}, function (data) {
    $("#loadlisting").html(data);
  });
}

function Add() {
  document.getElementById("modalContent").innerHTML =
    "<img src='loader/wheel.gif' style='width:10%' />";
  var lang = document.getElementById("selected_lang").value;
  if(lang == 1){
    document.getElementById('modalTitle').innerHTML = "Customer Advance";
  }
  else{
    document.getElementById('modalTitle').innerHTML = "مقدم العميل";
  }
  document.getElementById("helperText").innerHTML = "";
  javascript: $("#myModal2").modal("show", { backdrop: "static" });
  $.post("include/customer_advance/Add.php", {}, function (data) {
    $("#modalContent").html(data);
  });
}

function edit(id) {
  document.getElementById("modalContent").innerHTML =
    "<img src='loader/wheel.gif' style='width:10%' />";
    var lang = document.getElementById("selected_lang").value;
    if(lang == 1){
      document.getElementById('modalTitle').innerHTML = "Customer Advance";
    }
    else{
      document.getElementById('modalTitle').innerHTML = "مقدم العميل";
    }  document.getElementById("helperText").innerHTML = "";
  $("#mdlLg").addClass("modal-lg");

  javascript: $("#myModal2").modal("show", { backdrop: "static" });
  $.post("include/customer_advance/edit.php", { id: id }, function (data) {
    $("#modalContent").html(data);
  });
}

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
      document.getElementById(curr_Id + "_error").innerHTML = "";
    }
  }
  return error;
}

function save() {
  var a = validateEntry();
  if (a == "1") {
    return false;
  }

  document.getElementById("save").innerHTML =
    "<div style='background: #fff;text-align:center'><img width='80px' src='assets/img/loaders/loader.gif'/><div>";
  var myform = document.getElementById("save_form");
  var fd = new FormData(myform);
  $("#cus_area_add_btn").attr("disabled", true);
  $.ajax({
    url: "include/customer_advance/save.php",
    data: fd,
    cache: false,
    processData: false,
    contentType: false,
    type: "POST",
    success: function (dataofconfirm) {
      $("#save").html(dataofconfirm);
      $("#cus_area_add_btn").attr("disabled", false);
    },
  });
}

function update() {
  var a = validateEntry();
  if (a == "1") {
    return false;
  }

  document.getElementById("save").innerHTML =
    "<div style='background: #fff;text-align:center'><img width='80px' src='assets/img/loaders/loader.gif'/><div>";
  var myform = document.getElementById("save_form");
  var fd = new FormData(myform);
  $("#cus_area_update_btn").attr("disabled", true);
  $.ajax({
    url: "include/customer_advance/update.php",
    data: fd,
    cache: false,
    processData: false,
    contentType: false,
    type: "POST",
    success: function (dataofconfirm) {
      $("#save").html(dataofconfirm);
      $("#cus_area_update_btn").attr("disabled", false);
    },
  });
}

function deleteEntry(billno, bid, sbid) {
  var result = confirm("Want to delete?");
  if (result) {
    document.getElementById("deleteEntry").innerHTML =
      "<div style='background: #fff;text-align:center'><img width='80px' src='assets/img/loaders/loader.gif'/><div>";
    $.post(
      "include/customer_advance/deleteEntry.php",
      {
        bid: bid,
        sbid: sbid,
        billno: billno
      },
      function (data) {
        $("#deleteEntry").html(data);
      }
    );
  }
}

$(document).ready(function () {
  var lang = document.getElementById("selected_lang").value;
  changeLanguage(lang);
});

$(".paginate_button").on("click", function () {
  var lang = document.getElementById("selected_lang").value;
  changeLanguage(lang);
});

function changeLanguage(lang){
  if(lang == 2){
    $("#selected_lang").attr('value', '2');
    $("span.en").css("display", "none");
    $("span.ar").css("display", "inline-block");
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