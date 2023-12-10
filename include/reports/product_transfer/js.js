$("#filter").on("click", function () {
$(".filter_act").click();
$(".no_envent").toggleClass("displayB");
})
$(".ara").on("click", function () {
$("#selected_lang").attr('value', '2');
$("span.en").css("display", "none");
$("span.ar").css("display", "block");
$(".add_me").addClass("rv");
$(".this_ar").addClass("tb");
})

$(".eng").on("click", function () {
$("#selected_lang").attr('value', '1')
$("span.en").css("display", "block");
$("span.ar").css("display", "none");
$(".add_me").removeClass("rv");
$(".this_ar").removeClass("tb");

})


var elem = document.querySelector('.js-switch');
var switchery = new Switchery(elem, {
color: '#1AB394'
});
$(".js-switch").siblings(".switchery").css("width", "70px")
.prepend("<span class='text_add'>All</span>").find("small").css("left", "0");

$("#branch_all_select").on('change', function () {
if ($(this).is(':checked')) {
$("#branch").attr("disabled", "disabled");
$("#branch").siblings().find(".select2-selection").css("background", "#e9ecef !important");
// $("#branch").siblings().find(".select2-selection__rendered").find(".select2-selection__choice").remove();
$("#branch").empty().trigger('change')
} else {
$("#branch").removeAttr("disabled", "disabled");
$("#branch").siblings().find(".select2-selection").css("background", "#fff !important")

}
})

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


$("#branch").select2({
width: '100%',
closeOnSelect: true,
placeholder: '',
minimumInputLength: 2,
ajax: {
url: "Api/listings/getBranches",
dataType: 'json',
type: 'POST',
data: function (query) {
// add any default query here
return query;
},
processResults: function (data, params) {
console.log(data.data);
var results = [];

// Tranforms the top-level key of the response object from 'items' to 'results'
data.data.forEach(e => {


cName = e.CName.toLowerCase();
terms = params.term.toLowerCase();


if (cName.includes(terms)) {
results.push({
id: e.Id,
text: e.CName
});

}
});
return {
results: results
};
},
},
templateResult: formatResult
});

function formatResult(d) {
if (d.loading) {
return d.text;
}
// Creating an option of each id and text
$d = $('<option/>').attr({
'value': d.value
}).text(d.text);

return $d;
}

});




$(document).ready(function () {
$("#from_item_name").select2({
width: '100%',
closeOnSelect: true,
placeholder: '',
//minimumInputLength: 2,
ajax: {
url: "Api/listings/getProducts",
dataType: 'json',
type: 'POST',
data: function (query) {
// add any default query here
term:query.terms;
return query;
},
processResults: function (data, params) {

// Tranforms the top-level key of the response object from 'items' to 'results'
var results = [];

results.push({
id: 0,
text: "Please Select Product"
});
data.data.forEach(e => {
//cName = e.CName.toLowerCase();
//terms = params.term.toLowerCase();



results.push({
id: e.Id,
text: e.CName
});


});
return {
results: results
};
},
},
templateResult: formatResult
});

function formatResult(d) {
if (d.loading) {
return d.text;
}
// Creating an option of each id and text
$d = $('<option/>').attr({
'value': d.value
}).text(d.text);

return $d;
}

});


$(document).ready(function () {
$("#product_name").select2({
width: '100%',
closeOnSelect: true,
placeholder: '',
//minimumInputLength: 2,
ajax: {
url: "Api/listings/getProducts",
dataType: 'json',
type: 'POST',
data: function (query) {
// add any default query here
term:query.terms;
return query;
},
processResults: function (data, params) {

// Tranforms the top-level key of the response object from 'items' to 'results'
var results = [];

results.push({
id: 0,
text: "Please Select Product"
});
data.data.forEach(e => {
//cName = e.CName.toLowerCase();
//terms = params.term.toLowerCase();



results.push({
id: e.Id,
text: e.CName
});


});
return {
results: results
};
},
},
templateResult: formatResult
});

function formatResult(d) {
if (d.loading) {
return d.text;
}
// Creating an option of each id and text
$d = $('<option/>').attr({
'value': d.value
}).text(d.text);

return $d;
}

});


$(document).ready(function () {
$("#to_item_name").select2({
width: '100%',
closeOnSelect: true,
placeholder: '',
//minimumInputLength: 2,
ajax: {
url: "Api/listings/getProducts",
dataType: 'json',
type: 'POST',
data: function (query) {
// add any default query here
term:query.terms;
return query;
},
processResults: function (data, params) {

// Tranforms the top-level key of the response object from 'items' to 'results'
var results = [];

results.push({
id: 0,
text: "Please Select Product"
});
data.data.forEach(e => {
// cName = e.CName.toLowerCase();
// terms = params.term.toLowerCase();


// if (cName.includes(terms)) {
results.push({
id: e.Id,
text: e.CName
});

// }
});
return {
results: results
};
},
},
templateResult: formatResult
});

function formatResult(d) {
if (d.loading) {
return d.text;
}
// Creating an option of each id and text
$d = $('<option/>').attr({
'value': d.value
}).text(d.text);

return $d;
}

});









$(document).ready(function () {
$("#suppid_name").select2({
width: '100%',
closeOnSelect: true,
placeholder: '',
//minimumInputLength: 2,
ajax: {
url: "Api/listings/GetSupplierList",
dataType: 'JSON',
type: 'POST',
data: function (query) {
// add any default query here
term:query.terms;
return query;
},
processResults: function (data, params) {

console.log(data);

var results = [];
results.push({
id: 0,
text: "Please Select Customer"
});
// Tranforms the top-level key of the response object from 'items' to 'results'
data.data.forEach(e => {
// cName = e.CName.toLowerCase();
// terms = params.term.toLowerCase();
results.push({
id: e.Id,
text: e.CName
});
});
return {
results: results
};
},
},
templateResult: formatResult
});

function formatResult(d) {
if (d.loading) {
return d.text;
}
// Creating an option of each id and text
$d = $('<option/>').attr({
'value': d.value
}).text(d.text);

return $d;
}

});








$(document).ready(function () {
$("#from_product_name").select2({
width: '100%',
closeOnSelect: true,
placeholder: '',
//minimumInputLength: 2,
ajax: {
url: "Api/listings/getProducts",
dataType: 'json',
type: 'POST',
data: function (query) {
// add any default query here
term:query.terms;
return query;
},
processResults: function (data, params) {

// Tranforms the top-level key of the response object from 'items' to 'results'
var results = [];

results.push({
id: 0,
text: "Please Select Product"
});
data.data.forEach(e => {
// cName = e.CName.toLowerCase();
// terms = params.term.toLowerCase();


// if (cName.includes(terms)) {
results.push({
id: e.Id,
text: e.CName
});

// }
});
return {
results: results
};
},
},
templateResult: formatResult
});

function formatResult(d) {
if (d.loading) {
return d.text;
}
// Creating an option of each id and text
$d = $('<option/>').attr({
'value': d.value
}).text(d.text);

return $d;
}

});






$(document).ready(function () {
$("#to_product_name").select2({
width: '100%',
closeOnSelect: true,
placeholder: '',
//minimumInputLength: 2,
ajax: {
url: "Api/listings/getProducts",
dataType: 'json',
type: 'POST',
data: function (query) {
// add any default query here
term:query.terms;
return query;
},
processResults: function (data, params) {

// Tranforms the top-level key of the response object from 'items' to 'results'
var results = [];

results.push({
id: 0,
text: "Please Select Product"
});
data.data.forEach(e => {
// cName = e.CName.toLowerCase();
// terms = params.term.toLowerCase();


// if (cName.includes(terms)) {
results.push({
id: e.Id,
text: e.CName
});

// }
});
return {
results: results
};
},
},
templateResult: formatResult
});

function formatResult(d) {
if (d.loading) {
return d.text;
}
// Creating an option of each id and text
$d = $('<option/>').attr({
'value': d.value
}).text(d.text);

return $d;
}

});









$(document).ready(function () {
$("#product_group_name").select2({
width: '100%',
closeOnSelect: true,
placeholder: '',
//minimumInputLength: 2,
ajax: {
url: "Api/listings/getProductGroup",
dataType: 'json',
type: 'POST',
data: function (query) {
// add any default query here
term:query.terms;
return query;
},
processResults: function (data, params) {

// Tranforms the top-level key of the response object from 'items' to 'results'
var results = [];
results.push({
id: 0,
text: "Please Select Group"
});
data.data.forEach(e => {
// cName = e.CName.toLowerCase();
// terms = params.term.toLowerCase();


//if (cName.includes(terms)) {
results.push({
id: e.Id,
text: e.CName
});

//}
});
return {
results: results
};
},
},
templateResult: formatResult
});

function formatResult(d) {
if (d.loading) {
return d.text;
}
// Creating an option of each id and text
$d = $('<option/>').attr({
'value': d.value
}).text(d.text);

return $d;
}

});




$(document).ready(function () {
$("#ItemType_name").select2({
width: '100%',
closeOnSelect: true,
placeholder: '',
//minimumInputLength: 2,
ajax: {
url: "Api/listings/GetProductType",
dataType: 'json',
type: 'POST',
data: function (query) {
// add any default query here
term:query.terms;
return query;
},
processResults: function (data, params) {

// Tranforms the top-level key of the response object from 'items' to 'results'
var results = [];
results.push({
id: 0,
text: "Please Select Group"
});
data.data.forEach(e => {
// cName = e.CName.toLowerCase();
// terms = params.term.toLowerCase();


//if (cName.includes(terms)) {
results.push({
id: e.Id,
text: e.CName
});

//}
});
return {
results: results
};
},
},
templateResult: formatResult
});

function formatResult(d) {
if (d.loading) {
return d.text;
}
// Creating an option of each id and text
$d = $('<option/>').attr({
'value': d.value
}).text(d.text);

return $d;
}

});






$(document).ready(function () {
$("#supGids_name").select2({
width: '100%',
closeOnSelect: true,
placeholder: '',
//minimumInputLength: 2,
ajax: {
url: "Api/listings/GetSupplierGroup",
dataType: 'json',
type: 'POST',
data: function (query) {
// add any default query here
term:query.terms;
return query;
},
processResults: function (data, params) {

// Tranforms the top-level key of the response object from 'items' to 'results'
var results = [];
results.push({
id: 0,
text: "Please Select Group"
});
data.data.forEach(e => {
// cName = e.CName.toLowerCase();
// terms = params.term.toLowerCase();


//if (cName.includes(terms)) {
results.push({
id: e.Id,
text: e.CName
});

//}
});
return {
results: results
};
},
},
templateResult: formatResult
});

function formatResult(d) {
if (d.loading) {
return d.text;
}
// Creating an option of each id and text
$d = $('<option/>').attr({
'value': d.value
}).text(d.text);

return $d;
}

});




function ManagecondCriteria()
{
var condCriteria = document.getElementById('condCriteria').value;

document.getElementById('modalContent').innerHTML ="<img src='loader/wheel.gif' style='width:10%' />";

var lang = document.getElementById("selected_lang").value;
if(lang == 1){
document.getElementById('modalTitle').innerHTML = "Condition Criteria";
}
else{
document.getElementById('modalTitle').innerHTML = "حالة البحث";
}	
document.getElementById('helperText').innerHTML="Please Manage Your Condition Critera Accordingly";	

javascript:$('#myModal2').modal('show', {backdrop: 'static'});
	
	
	
	
$.post("include/reports/product_stock/ManagecondCriteria.php",{condCriteria:condCriteria},function(data){
$("#modalContent").html(data);});	


	
	
	
}



function addCondCrit()
{
var cond_typ = document.getElementById('cond_typ').value;
if(cond_typ=='' )
{
document.getElementById('cond_typ').style.border="1px solid Red";			document.getElementById('cond_typ').focus();
return false
}
document.getElementById('cond_typ').style.border="1px solid Green";

	
var cond_op = document.getElementById('cond_op').value;
if(cond_op=='' )
{
document.getElementById('cond_op').style.border="1px solid Red";			document.getElementById('cond_op').focus();
return false
}
document.getElementById('cond_op').style.border="1px solid Green";
	
	
var cond_val = document.getElementById('cond_val').value;
if(cond_val=='' )
{
document.getElementById('cond_val').style.border="1px solid Red";			document.getElementById('cond_val').focus();
return false
}
	
	
	
	
	var condCriteria = document.getElementById('popCnd').value;
document.getElementById('cond_val').style.border="1px solid Green";	

document.getElementById('loadCOndCrit').innerHTML ="<img src='loader/wheel.gif' style='width:10%' />";

	
	
	
	
$.post("include/reports/product_stock/addCondCrit.php",{cond_typ:cond_typ,cond_op:cond_op,cond_val:cond_val,condCriteria:condCriteria},function(data){
$("#loadCOndCrit").html(data);});	
	
}

function resetSelections()
{
if(document.getElementById('popCnd'))
	{
		document.getElementById('popCnd').value='';
	}
}


function setVtc()
{
document.getElementById('condCriteria').value=document.getElementById('popCnd').value;
document.getElementById('closed').click();
}
function validate_form() {}

function PrintPopup(query, type)
{
  javascript:$('#PrintPopup').modal('show', {backdrop: 'static'});

  $("#bill_query").val(query);
  $("#bill_type").val(type);
}

function Print_report_details()
{
  var bill_query = $("#bill_query").val();
  var bill_type = $("#bill_type").val();
  var print_language = $("#print_language").val();

  window.open(
  'include/reports/sales/general_print.php?query='+bill_query+'&LanguageId='+print_language+'&type='+bill_type+'',
  '_blank' // <- This is what makes it open in a new window.
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