$('#report_type_option').on('change', function () {
    const selected_value = $(this).find(":selected").val();
    $("#report_type").attr('value', selected_value);
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
  $(".filter").on("click", function () {
    $(".filter_act").click();
    $(".no_envent").toggleClass("displayB");
  });
  $(".ara").on("click", function () {
    $("#selected_lang").attr('value', '2');
    $("span.en").css("display", "none");
    $("span.ar").css("display", "inline-block");
    $(".add_me").addClass("rv");
    $(".this_ar").addClass("tb");
  })
  
  $(".eng").on("click", function () {
    $("#selected_lang").attr('value', '1')
    $("span.en").css("display", "inline-block");
    $("span.ar").css("display", "none");
    $(".add_me").removeClass("rv");
    $(".this_ar").removeClass("tb");
  
  })

  $("#branch_all_select").on('change', function () {
    if ($(this).is(':checked')) {
      $("#branchs").attr("disabled", "disabled");
      $("#branchs").siblings().find(".select2-selection").css("background", "#e9ecef !important");
      // $("#branch").siblings().find(".select2-selection__rendered").find(".select2-selection__choice").remove();
      $("#branchs").empty().trigger('change')
    } else {
      $("#branchs").removeAttr("disabled", "disabled");
      $("#branchs").siblings().find(".select2-selection").css("background", "#fff !important")
  
    }
  })

  $(document).ready(function () {
    $('.i-checks').iCheck({
      checkboxClass: 'icheckbox_square-green',
      radioClass: 'iradio_square-green',
    });
  });
  
  $('.clockpicker').clockpicker({
    donetext: 'Select Time'
  });
  
  var mem = $('.date').datepicker({
    todayBtn: "linked",
    keyboardNavigation: false,
    forceParse: false,
    calendarWeeks: true,
    autoclose: true,
      dateFormat: 'yy-mm-dd',
  });
  
  function setmyValue(vvl, idx) {
    document.getElementById(idx).value = vvl;
  }

  $(document).ready(function () {
	
	
	$("#branchs").select2({
    width: '100%',
    });
	

});

function loadlisting() {
document.getElementById('loadlisting').innerHTML = "<div style='background: #fff;text-align:center'><img width='80px' src='assets/img/loaders/loader.gif'/><div>";
$.post("include/expense/loadlisting.php", {}, function (data) {
$("#loadlisting").html(data);
});
}
function loadExpenseData(vvl) {
document.getElementById('response').innerHTML = "<div style='background: #fff;text-align:center'><img width='80px' src='assets/img/loaders/loader.gif'/><div>";
$.post("include/expense/loadExpenseData.php", {vvl:vvl}, function (data) {
$("#response").html(data);
});
}


function Add() {
document.getElementById('modalContent').innerHTML = "<img src='loader/wheel.gif' style='width:10%' />";
var lang = document.getElementById("selected_lang").value;
if(lang == 1){
  document.getElementById('modalTitle').innerHTML = "Expense Head";
}
else{
  document.getElementById('modalTitle').innerHTML = "رأس المصاريف";
}
document.getElementById('helperText').innerHTML = "";
javascript:$('#myModal2').modal('show', {backdrop: 'static'});
$.post("include/expense/Add.php", {}, function (data) {
$("#modalContent").html(data);
});
}


function edit(id) {
document.getElementById('modalContent').innerHTML = "<img src='loader/wheel.gif' style='width:10%' />";
var lang = document.getElementById("selected_lang").value;
if(lang == 1){
  document.getElementById('modalTitle').innerHTML = "Expense Head";
}
else{
  document.getElementById('modalTitle').innerHTML = "رأس المصاريف";
}document.getElementById('helperText').innerHTML = "";
$("#mdlLg").addClass("modal-lg");

javascript:$('#myModal2').modal('show', {backdrop: 'static'});
$.post("include/expense/edit.php", {id: id}, function (data) {
$("#modalContent").html(data);
});
}





function validateEntry()
{
var error=0;
var vvl = document.getElementsByClassName("grpreq");
for (var i = 0; i < vvl.length; i++) {
var val = $(".grpreq")[i].value;
var curr_Id = $(".grpreq")[i].id;
if(val=='')
{
document.getElementById(curr_Id).style.border="1px solid red";	
document.getElementById(curr_Id+"_error").innerHTML=" * This Field Is Required";
error =1;
}
else{
document.getElementById(curr_Id).style.border="1px solid green";	
document.getElementById(curr_Id+"_error").innerHTML="";
}
}	
return error;

}


function save() {
var a = validateEntry();
if(a=="1")
{
return false;
}

document.getElementById('save').innerHTML = "<div style='background: #fff;text-align:center'><img width='80px' src='assets/img/loaders/loader.gif'/><div>";
var myform = document.getElementById("save_form");
var fd = new FormData(myform);
$('#expense_head_add_btn').attr('disabled', true);
$.ajax({
url:"include/expense/save.php",
data: fd,
cache: false,
processData: false,
contentType: false,
type: 'POST',
success: function (dataofconfirm) {
$("#save").html(dataofconfirm);
$('#expense_head_add_btn').attr('disabled', false);
}
});


}

function update() {
var a = validateEntry();
if(a=="1")
{
return false;
}

document.getElementById('save').innerHTML = "<div style='background: #fff;text-align:center'><img width='80px' src='assets/img/loaders/loader.gif'/><div>";
var myform = document.getElementById("save_form");
var fd = new FormData(myform);
$('#expense_head_update_btn').attr('disabled', true);
$.ajax({
url:"include/expense/update.php",
data: fd,
cache: false,
processData: false,
contentType: false,
type: 'POST',
success: function (dataofconfirm) {
$("#save").html(dataofconfirm);
$('#expense_head_update_btn').attr('disabled', false);
}
});


}


function deleteEntry(id) {
var result = confirm("Want to delete?");
if (result) {
document.getElementById('deleteEntry').innerHTML = "<div style='background: #fff;text-align:center'><img width='80px' src='assets/img/loaders/loader.gif'/><div>";
$.post("include/expense/deleteEntry.php", {id: id}, function (data) {
$("#deleteEntry").html(data);
});
}
}


function calculateVatPrice(vvl)
{
var vatPer = document.getElementById('vatPer').value;

var NewVal = parseFloat(vvl)*parseFloat(vatPer);
var subVal = parseFloat(NewVal)/100;
var amt = parseFloat(subVal)+parseFloat(vvl);
document.getElementById('vatAmount').value = amt;	


}



function addRow()
{
  var code = $("#code").val();
  var expense = $("#expense").text();
  var amount = $("#amount").val();
  var vatAmount = $("#vatAmount").val();
  var vatPer = $("#vatPer").val();
  var isVat = $("#isVat").val();
  var bnkid = $("#bnkid").val();
  





  if(code=='')
  {
    document.getElementById('code').style.border="1px solid red";
    $("#code").focus();
    return false;
  }


if(expense=='')
{
document.getElementById('expense').style.border="1px solid red";
$("#expense").focus();
return false;
}
  if(amount=='' || parseFloat(amount)<=0)
  {
    document.getElementById('amount').style.border="1px solid red";
    $("#amount").focus();
    return false;
  }
  if(vatAmount=='' || parseFloat(vatAmount)<=0)
  {
    document.getElementById('vatAmount').style.border="1px solid red";
    $("#vatAmount").focus();
    return false;
  }
  if(bnkid=='')
  {
    document.getElementById('bnkid').style.border="1px solid red";
    $("#bnkid").focus();
    return false;
  }
var row_count = parseInt($("#row_count").val())+1;
var in_html = $("#row_append").html();
  $('#row_append').innerHTML ="<img src='loader/wheel.gif' style='width:10%' />";
  $.post("include/expense/addRow.php",{
    code:code,
    expense:expense,
    amount:amount,
    vatAmount:vatAmount,
    vatPer:vatPer,
    bnkid:bnkid,
    isVat:isVat,
    
    row_count:row_count

  },function(data){
    // console.log(data);
	$("#row_append").html(data);
	$("#row_append").append(in_html);
	$("#row_count").val(row_count);

	$("#code").val('');
	$("#expense").each(function () { //added a each loop here
	$(this).select2('val', '')
	});

	$("#amount").val('0');
	$("#vatAmount").val(0);
	$("#vatPer").val(0);
	$("#bnkid").each(function () { //added a each loop here
	$(this).select2('val', '')
	});
	$("#isVat").val('');
    

  });

}
function delete_row(id)
{
  var result = confirm("Want to delete?");
  if (result) {
    $("#row_"+id).remove();
  salesTotalCalculation();
  }

}




function edit_row(idx)
{
  var code = $("#code"+idx).val();
  var expense = $("#expense"+idx).val();
  var amount = $("#amount"+idx).val();
  var vatAmount = $("#vatAmount"+idx).val();
  var vatPer = $("#vatPer"+idx).val();
  var bnkid = $("#bnkid"+idx).val();
  var bnkName = $("#bnkName"+idx).val();
  var isVat = $("#isVat"+idx).val();
  


  $("#code").val(code);
  //$("#product").select2("val", "");

  var newOption = new Option(code+" - "+expense, code, true, true);
  // Append it to the select
  $('#expense').html(newOption).trigger('change');

  //$("#unit").val('');
  $("#amount").val(amount);
  $("#vatAmount").val(vatAmount);
  $("#vatPer").val(vatPer);
  $("#isVat").val(isVat);
	$("#bnkid").val('');
  
	// $("#bnkid").val('').trigger("change");
  $('#bnkid').val(bnkName).trigger("change");
 $("#bnkid").select2().select2('val',bnkid);


  

  $("#action_id").html('<button type="button" name="add_row" id="add_row" class="btn btn-info" onclick="updateRow('+idx+')">Update</button>');

}

function updateRow(idx)
{
  var code = $("#code").val();
  var expense = $("#expense").text();
  var amount = $("#amount").val();
  var vatAmount = $("#vatAmount").val();
  var vatPer = $("#vatPer").val();
  var isVat = $("#isVat").val();
  var bnkid = $("#bnkid").val();
  





  if(code=='')
  {
    document.getElementById('code').style.border="1px solid red";
    $("#code").focus();
    return false;
  }


if(expense=='')
{
document.getElementById('expense').style.border="1px solid red";
$("#expense").focus();
return false;
}
  if(amount=='' || parseFloat(amount)<=0)
  {
    document.getElementById('amount').style.border="1px solid red";
    $("#amount").focus();
    return false;
  }
  if(vatAmount=='' || parseFloat(vatAmount)<=0)
  {
    document.getElementById('vatAmount').style.border="1px solid red";
    $("#vatAmount").focus();
    return false;
  }
  if(bnkid=='')
  {
    document.getElementById('bnkid').style.border="1px solid red";
    $("#bnkid").focus();
    return false;
  }

  var row_count = parseInt($("#row_count").val())+1;
  var in_html = $("#row_append").html();
  $('#row_append').innerHTML ="<img src='loader/wheel.gif' style='width:10%' />";

  $.post("include/expense/updateRow.php",{
    code:code,
    expense:expense,
    amount:amount,
    vatAmount:vatAmount,
    vatPer:vatPer,
    bnkid:bnkid,
    isVat:isVat,

    row_count:idx

  },function(data){
    // console.log(data);
    $("#row_"+idx).html(data);


	$("#code").val('');
	$("#expense").each(function () { //added a each loop here
	$(this).select2('val', '')
	});

	$("#amount").val('0');
	$("#vatAmount").val(0);
	$("#vatPer").val(0);
  $("#bnkid").val('').change();
	$("#isVat").val('');

    $("#action_id").html('<button type="button" name="add_row" id="add_row" class="btn btn-info" onclick="addRow()">Add</button>');
  });
}

function salesTotalCalculation()
{
  var t_total_sum =0;
  $(".t_amount").each(function(){
    t_total_sum += parseFloat(this.value);
  });
  $("#TAmount").val(t_total_sum);


  var t_grandtotal =0;
  $(".t_vatPer").each(function(){
    t_grandtotal += parseFloat(this.value);
  });
  $("#tvatTotal").val(t_grandtotal);



  var GTotal = parseFloat(t_grandtotal)+parseFloat(t_total_sum);
	  $("#GTotal").val(GTotal);

}

function SaveExpenseVoucher() {
var SPType = $(".SPType:checked").val();
var anyaction = false;

var ExpDate = document.getElementById('ExpDate').value;
if(ExpDate=='')
{
$('#ExpDate').css('border', '2px solid red');
anyaction = true;
}
else{
$('#ExpDate').css('border', '1px solid green');

}	
var GTotal = document.getElementById('GTotal').value;
if(GTotal=='' || parseFloat(GTotal)==0)
{
$('#GTotal').css('border', '2px solid red');
anyaction = true;
}
else{
$('#GTotal').css('border', '1px solid green');

}


if(anyaction)
{
return false;
}


var myform = document.getElementById("saveExpVoucher");
var fd = new FormData(myform);
fd.append("Bid", "1");

document.getElementById('response').innerHTML = "<div style='background: #fff;text-align:center'><img width='80px' src='assets/img/loaders/loader.gif'/><div>";
$.ajax({
url:"include/expense/SaveExpenseVoucher.php",
data: fd,
cache: false,
processData: false,
contentType: false,
type: 'POST',
success: function (dataofconfirm) {
$("#response").html(dataofconfirm);
}
});

}

function deleteVoucher(bid, billno) {
  var result = confirm("Want to delete?");
  if (result) {
  document.getElementById('deleteEntry').innerHTML = "<div style='background: #fff;text-align:center'><img width='80px' src='assets/img/loaders/loader.gif'/><div>";
  $.post("include/expense/deleteVoucher.php", {bid: bid, billno: billno}, function (data) {
  $("#deleteEntry").html(data);
  });
  }
}

function updateExpenseVoucher() {
  var SPType = $(".SPType:checked").val();
  var anyaction = false;
  
  var ExpDate = document.getElementById('ExpDate').value;
  if(ExpDate=='')
  {
  $('#ExpDate').css('border', '2px solid red');
  anyaction = true;
  }
  else{
  $('#ExpDate').css('border', '1px solid green');
  
  }	
  var GTotal = document.getElementById('GTotal').value;
  if(GTotal=='' || parseFloat(GTotal)==0)
  {
  $('#GTotal').css('border', '2px solid red');
  anyaction = true;
  }
  else{
  $('#GTotal').css('border', '1px solid green');
  
  }
  
  
  if(anyaction)
  {
  return false;
  }
  
  
  var myform = document.getElementById("saveExpVoucher");
  var fd = new FormData(myform);
  fd.append("Bid", "1");
  
  document.getElementById('response').innerHTML = "<div style='background: #fff;text-align:center'><img width='80px' src='assets/img/loaders/loader.gif'/><div>";
  $.ajax({
  url:"include/expense/updateExpenseVoucher.php",
  data: fd,
  cache: false,
  processData: false,
  contentType: false,
  type: 'POST',
  success: function (dataofconfirm) {
  $("#response").html(dataofconfirm);
  }
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