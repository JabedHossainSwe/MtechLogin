// Toast Type
// toastr.success('You clicked Success toast');

// toastr.info('You clicked Info toast')

// toastr.error('You clicked Error Toast')

// toastr.warning('You clicked Warning Toast')

// var count = 1;
// document.getElementById('branch_all').onclick = function() {
//    alert("button was clicked " + (count++) + " times");
// };
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
    $("#branchs").attr("disabled", "disabled");
    $("#branchs").siblings().find(".select2-selection").css("background", "#e9ecef !important");
    // $("#branch").siblings().find(".select2-selection__rendered").find(".select2-selection__choice").remove();
     $("#branchs").select2('val', '')
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
  $("#customer_name").select2({
    width: '100%',
    closeOnSelect: true,
    placeholder: '',
    //minimumInputLength: 2,
    ajax: {
      url: "Api/listings/getCustomers",
      dataType: 'JSON',
      type: 'POST',
      data: function (query) {
		   query.bid = $('#branchs').val().toString();
        // add any default query here
		  term:query.terms;
        return query;
      },
      processResults: function (data, params) {
		  
		  console.log(data);
		  
        var results = [];
        if(document.getElementById("selected_lang").value == 1){
          results.push({
            id: 0,
            text: "Please Select"
          });
        }
        else{
          results.push({
            id: 0,
            text: "الرجاء التحديد"
          });
        }
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
  $("#user_name").select2({
    width: '100%',
    closeOnSelect: true,
    placeholder: '',
    //minimumInputLength: 2,
    ajax: {
      url: "Api/listings/getUsers",
      dataType: 'json',
      type: 'POST',
 data: function (query) {
	  query.bid = $('#branchs').val().toString();
        // add any default query here
		  term:query.terms;
        return query;
      },
      processResults: function (data, params) {

        // Tranforms the top-level key of the response object from 'items' to 'results'
        var results = [];
		  
		  
        if(document.getElementById("selected_lang").value == 1){
          results.push({
            id: 0,
            text: "Please Select"
          });
        }
        else{
          results.push({
            id: 0,
            text: "الرجاء التحديد"
          });
        }
        data.data.forEach(e => {
          //cName = e.CName.toLowerCase();
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
		  
        if(document.getElementById("selected_lang").value == 1){
          results.push({
            id: 0,
            text: "Please Select"
          });
        }
        else{
          results.push({
            id: 0,
            text: "الرجاء التحديد"
          });
        }
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

        if(document.getElementById("selected_lang").value == 1){
          results.push({
            id: 0,
            text: "Please Select"
          });
        }
        else{
          results.push({
            id: 0,
            text: "الرجاء التحديد"
          });
        }
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
        if(document.getElementById("selected_lang").value == 1){
          results.push({
            id: 0,
            text: "Please Select"
          });
        }
        else{
          results.push({
            id: 0,
            text: "الرجاء التحديد"
          });
        }
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
  $("#PurName").select2({
    width: '100%',
    closeOnSelect: true,
    placeholder: '',
    //minimumInputLength: 2,
    ajax: {
      url: "Api/listings/GetPurTypeList",
      dataType: 'json',
      type: 'POST',
      		data: function (query) {
						  query.bid = $('#branchs').val().toString();

		// add any default query here
		term:query.terms;
		return query;
		},
      processResults: function (data, params) {

        // Tranforms the top-level key of the response object from 'items' to 'results'
        var results = [];
        if(document.getElementById("selected_lang").value == 1){
          results.push({
            id: 0,
            text: "Please Select"
          });
        }
        else{
          results.push({
            id: 0,
            text: "الرجاء التحديد"
          });
        }
        data.data.forEach(e => {
   
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
  $("#PurChaser_Name").select2({
    width: '100%',
    closeOnSelect: true,
    placeholder: '',
    //minimumInputLength: 2,
    ajax: {
      url: "Api/listings/GetPurPurchaserList",
      dataType: 'json',
      type: 'POST',
      		data: function (query) {
						  query.bid = $('#branchs').val().toString();

		// add any default query here
		term:query.terms;
		return query;
		},
      processResults: function (data, params) {

        // Tranforms the top-level key of the response object from 'items' to 'results'
        var results = [];
        if(document.getElementById("selected_lang").value == 1){
          results.push({
            id: 0,
            text: "Please Select"
          });
        }
        else{
          results.push({
            id: 0,
            text: "الرجاء التحديد"
          });
        }
        data.data.forEach(e => {
   
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





function validate_form() {

  const input = ["form_bill_no", "to_bill_no"];
  if ($("#branch_all_select").is(':checked')) {
    $("#branch").siblings().find(".select2-selection").css("border-color", " #e5e6e7");
  } else {
    var branch = $("#branch").val();
    if (branch == "") {
      toastr.error('Please Select Branches');
      $("#branch").focus();
      $("#branch").siblings().find(".select2-selection").css("border-color", " #c85c57");
      return false;

    } else {
      $("#branch").siblings().find(".select2-selection").css("border-color", " #e5e6e7");
    }
  }
  if($("#report_type").val() != "group"){
      if($("#from_date").val() == ""){
   $("#from_date").focus();
   $("#from_date").css("border-color","#c85c57");
   toastr.error('Please Select From Date');
   return false;
  }else{
   $("#from_date").css("border-color","#e5e6e7");  
  }
  if($("#to_date").val() == ""){
   $("#to_date").focus();
   $("#to_date").css("border-color","#c85c57");
   toastr.error('Please Select To Date');
   return false;
  }else{
   $("#to_date").css("border-color","#e5e6e7");  
  }


      
  }




  var selected = $("#report_type").val();

  var url = "";
  if (selected == 'general') // done
  {
    url = "vouchers/reports/sales_report/general_report.php"
  }


  if (selected == 'details') // done
  {
    url = "vouchers/reports/sales_report/detail_report.php"
  }

  if (selected == 'group') {
    url = "vouchers/reports/sales_report/group_report.php"
  }

  if (selected == 'summery_by_date') {
    url = "vouchers/reports/sales_report/summary_by_date.php"
  }

  document.getElementById('filter').click();

  var myform = document.getElementById("sales_report_form");
  var fd = new FormData(myform);

  document.getElementById('sales_report').innerHTML = "<div style='background: #fff;text-align:center'><img width='80px' src='assets/img/loaders/loader.gif'/><div>";
  $.ajax({
    url: url,

    data: fd,

    cache: false,

    processData: false,

    contentType: false,

    type: 'POST',

    success: function (dataofconfirm) {

      $("#sales_report").html(dataofconfirm);

    }

  });


}

function PrintPopup(query, type, group)
{
  javascript:$('#PrintPopup').modal('show', {backdrop: 'static'});

  $("#bill_query").val(query);
  $("#bill_type").val(type);
  $("#b_group_by").val(group);
}

function Print_report_details()
{
  var bill_query = $("#bill_query").val();
  var bill_type = $("#bill_type").val();
  var group_by = $("#b_group_by").val();
  var print_language = $("#print_language").val();

  if(group_by == 'purchaseGeneralNone'){
    window.open(
    'include/reports/purchase/purchase_general/report_none_print.php?query='+bill_query+'&LanguageId='+print_language+'&type='+bill_type+'','_blank' // <- This is what makes it open in a new window.
    );
  }
  else if(group_by == 'purchaseGeneralSupplier'){
    window.open(
    'include/reports/purchase/purchase_general/report_supplier_print.php?query='+bill_query+'&LanguageId='+print_language+'&type='+bill_type+'','_blank' // <- This is what makes it open in a new window.
    );
  }
  else if(group_by == 'purchaseGeneralDate'){
    window.open(
    'include/reports/purchase/purchase_general/report_date_print.php?query='+bill_query+'&LanguageId='+print_language+'&type='+bill_type+'','_blank' // <- This is what makes it open in a new window.
    );
  }
  else if(group_by == 'purchaseDetailNone'){
    window.open(
    'include/reports/purchase/purchase_detail/report_none_print.php?query='+bill_query+'&LanguageId='+print_language+'&type='+bill_type+'','_blank' // <- This is what makes it open in a new window.
    );
  }
  else if(group_by == 'purchaseDetailProduct'){
    window.open(
    'include/reports/purchase/purchase_detail/report_product_print.php?query='+bill_query+'&LanguageId='+print_language+'&type='+bill_type+'','_blank' // <- This is what makes it open in a new window.
    );
  }
  else if(group_by == 'purchaseGroup'){
    window.open(
    'include/reports/purchase/purchase_group/report_print.php?query='+bill_query+'&LanguageId='+print_language+'&type='+bill_type+'','_blank' // <- This is what makes it open in a new window.
    );
  }
  else if(group_by == 'purchaseReturnNone'){
    window.open(
    'include/reports/purchase/purchase_return_general/report_none_print.php?query='+bill_query+'&LanguageId='+print_language+'&type='+bill_type+'','_blank' // <- This is what makes it open in a new window.
    );
  }
  else if(group_by == 'purchaseReturnSupplier'){
    window.open(
    'include/reports/purchase/purchase_return_general/report_supplier_print.php?query='+bill_query+'&LanguageId='+print_language+'&type='+bill_type+'','_blank' // <- This is what makes it open in a new window.
    );
  }
  else if(group_by == 'purchaseReturnDate'){
    window.open(
    'include/reports/purchase/purchase_return_general/report_date_print.php?query='+bill_query+'&LanguageId='+print_language+'&type='+bill_type+'','_blank' // <- This is what makes it open in a new window.
    );
  }
  else if(group_by == 'purchaseReturnDetailNone'){
    window.open(
    'include/reports/purchase/purchase_return_detail/report_none_print.php?query='+bill_query+'&LanguageId='+print_language+'&type='+bill_type+'','_blank' // <- This is what makes it open in a new window.
    );
  }
  else if(group_by == 'purchaseReturnDetailProduct'){
    window.open(
    'include/reports/purchase/purchase_return_detail/report_product_print.php?query='+bill_query+'&LanguageId='+print_language+'&type='+bill_type+'','_blank' // <- This is what makes it open in a new window.
    );
  }
  else if(group_by == 'purchaseReturnGroup'){
    window.open(
    'include/reports/purchase/purchase_return_group/report_print.php?query='+bill_query+'&LanguageId='+print_language+'&type='+bill_type+'','_blank' // <- This is what makes it open in a new window.
    );
  }

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