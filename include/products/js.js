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

function deleteEntry(id) {
  var result = confirm("Want to delete?");
  if (result) {
    document.getElementById("deleteEntry").innerHTML =
      "<div style='background: #fff;text-align:center'><img width='80px' src='assets/img/loaders/loader.gif'/><div>";
    $.post("include/products/deleteEntry.php", { id: id }, function (data) {
      $("#deleteEntry").html(data);
    });
  }
}

function loadUnitsGrid(uid) {
  document.getElementById("loadUnitsGrid").innerHTML =
    "<div style='background: #fff;text-align:center'><img width='80px' src='assets/img/loaders/loader.gif'/><div>";
  $.post("include/products/loadUnitsGrid.php", { uid: uid }, function (data) {
    $("#loadUnitsGrid").html(data);
  });
}

function loadSubUnits(cnt) {
  var nrows = $("#nrows").val();
  var uid = $("#uid" + cnt).val();
  if (uid == "") {
    toastr.error("Please Select Unit.");
    return false;
  }

  var in_html = $("#loadSubUnits").innerHTML;
  //document.getElementById('loadSubUnits').innerHTML = "<div style='background: #fff;text-align:center'><img width='80px' src='assets/img/loaders/loader.gif'/><div>";
  $.post(
    "include/products/loadSubUnits.php",
    { uid: uid, nrows: nrows },
    function (data) {
      $("#loadSubUnits").append(data);
      //$("#loadSubUnits").append(in_html);
    }
  );
}

function calculatevatValueSP(cnt) {
  var currentVal = document.getElementById("SPrice" + cnt).value;
  var vatPer = document.getElementById("vatPer").value;
  if (document.getElementById("isVat").checked) {
    var newVal = parseFloat(currentVal) * parseFloat(vatPer);
    var NewP = parseFloat(newVal) / 100;

    var totPrice = parseFloat(currentVal) + parseFloat(NewP);
    var Fprice = totPrice.toFixed(2);
    document.getElementById("vatValueSP" + cnt).value = Fprice;
  } else {
    document.getElementById("vatValueSP" + cnt).value = currentVal;
  }
}

function deleteCurrentRow(cnt) {
  $("#" + cnt).remove();

  if(cnt == 2){
    $(".generate_btn").css("display", "none");
  }
}

function saveProduct() {
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
    url: "include/products/save.php",
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

function updateProduct() {
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
    url: "include/products/update.php",
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


function reloadVoucher() {
	var Bid = $("#bidM").val();
	var PCode = $("#PCode").val();
	var anyaction = false;
  
	if (Bid == "") {
	  $("#Bid").css("border", "2px solid red");
	  anyaction = true;
	}
  
	if (PCode == "") {
	  $("#PCode").css("border", "2px solid red");
	  anyaction = true;
	}
  
	if (anyaction) {
	  return false;
	} else {
	  $.post(
		"include/products/reloadVoucher.php",
		{
		  Bid: Bid,
		  PCode: PCode,
		},
		function (data) {
		  $("#SalesVoucherDiv").html(data);
		}
	  );
	}
  }

  function editVoucher(Bid, PCode) {
	document.getElementById("editVoucher").innerHTML =
	  "<img width='80px' src='loader/wheel.gif'/>";
  
	$.post(
	  "include/products/editVoucher.php",
	  {
		Bid: Bid,
		PCode: PCode,
	  },
	  function (data) {
		$("#editVoucher").html(data);
	  }
	);
  }

  function generatePrice(){
    var nrows = $("#nrows").val();

    var CostPricel = $("#CostPrice"+nrows).val();
    var SPricel = $("#SPrice"+nrows).val();
    var LSPricel = $("#LSPrice"+nrows).val();
    var PPricel = $("#PPrice"+nrows).val();

    var anyaction = false;
  
    if (CostPricel == "" || CostPricel == 0) {
      $("#CostPrice"+nrows).css("border", "2px solid red");
      anyaction = true;
    }
    
    if (SPricel == "" || SPricel == 0) {
      $("#SPrice"+nrows).css("border", "2px solid red");
      anyaction = true;
    }

    if (LSPricel == "" || LSPricel == 0) {
      $("#LSPrice"+nrows).css("border", "2px solid red");
      anyaction = true;
    }

    if (PPricel == "" || PPricel == 0) {
      $("#PPrice"+nrows).css("border", "2px solid red");
      anyaction = true;
    }
    
    if (anyaction) {
      return false;
    }

    var CostPrice = (CostPricel/$("#Qty"+nrows).val()).toFixed(2);
    var SPrice = (SPricel/$("#Qty"+nrows).val()).toFixed(2);
    var LSPrice = (LSPricel/$("#Qty"+nrows).val()).toFixed(2);
    var PPrice = (PPricel/$("#Qty"+nrows).val()).toFixed(2);

    for(let i=1; i<nrows; i++){
      var Qty = $("#Qty" + i).val();
      $("#CostPrice" + i).val((CostPrice*Qty).toFixed(2));
      $("#SPrice" + i).val((SPrice*Qty).toFixed(2));
      $("#LSPrice" + i).val((LSPrice*Qty).toFixed(2));
      $("#PPrice" + i).val((PPrice*Qty).toFixed(2));

      calculatevatValueSP(i)
    }
  }

  function changeValue(i){
    var uid = $("#uid" + i).val();

    if(uid != 0){
      $(".generate_btn").css("display", "block");
    }else{
      $(".generate_btn").css("display", "none");
    }
    $.post(
      "include/products/getQuantity.php",
      {
      uid: uid,
      },
      function (data) {
        $("#Qty" + i).val(data);
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

  function loadPage(pg)
  {
    location.href=pg;
  }