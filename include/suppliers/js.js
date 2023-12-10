
function next(e)
{
$(e).parent().parent().parent().parent().addClass('done')
$(e).parent().parent().parent().parent().next().removeClass('slided');
}
function prev(e)
{
$(e).parent().parent().parent().parent().addClass('slided')
$(e).parent().parent().parent().parent().prev().removeClass('done');
}



function customerValidation()
{
    var CName = $("#CName").val();
    var anyaction = false;
    if(CName=='')
    {
        $("#CName").css('border', '2px solid red');
        anyaction = true;
    }
    else
    {
        $("#CName").css('border', '1px solid green');
    }


    if(anyaction)
    {
        return false;
    }

    else{


        var myform = document.getElementById("customer_form");
        var fd = new FormData(myform);
        $('#seles_report_search').attr('disabled', true);
        document.getElementById('customerFormData').innerHTML = "<img width='80px' src='loader/wheel.gif'/>";
        $.ajax({
            url:"include/customers/saveCustomerForm.php",
            data: fd,
            cache: false,
            processData: false,
            contentType: false,
            type: 'POST',
            success: function (data) {
              $('#customerFormData').html(data);  
                $('#seles_report_search').attr('disabled', false);
            }
        });

    }
}


function customerUpdateValidation()
{
    var CName = $("#CName").val();
    var anyaction = false;
    if(CName=='')
    {
        $("#CName").css('border', '2px solid red');
        anyaction = true;
    }
    else
    {
        $("#CName").css('border', '1px solid green');
    }


    if(anyaction)
    {
        return false;
    }

    else{


        var myform = document.getElementById("customer_form");
        var fd = new FormData(myform);
        document.getElementById('customerFormData').innerHTML = "<img width='80px' src='loader/wheel.gif'/>";
        $('#seles_report_search').attr('disabled', true);
        $.ajax({
            url:"include/customers/updateCustomerForm.php",
            data: fd,
            cache: false,
            processData: false,
            contentType: false,
            type: 'POST',
            success: function (data) {
              $('#customerFormData').html(data);
            $('#seles_report_search').attr('disabled', false);
            }
        });

    }
}

function deleteCustomer(CCode,bid)
{
    $.confirm({
        title: 'Confirm!',
        content: 'Are You Sure You Want To Delete?',
        buttons: {
            confirm: function () {
                $.ajax({
                    url:"include/customers/deleteCustomer.php",
                    data: { CCode: CCode, bid : bid} ,
                    type: 'POST',
                    success: function (data) {
                        $('#customerFormData').html(data);
                    }
                })
            },
            cancel: function () {
                $.alert('Canceled!');
            }
// somethingElse: {
//     text: 'Something else',
//     btnClass: 'btn-blue',
//     keys: ['enter', 'shift'],
//     action: function(){
//         $.alert('Something else?');
//     }
// }
        }
    });
}




function loadPage(pg)
{
    location.href=pg;
}


$(document).ready(function () {
$("#salesMan").select2({
width: '100%',
closeOnSelect: true,
placeholder: '',
//minimumInputLength: 2,
ajax: {
url: "Api/listings/getUsers",
dataType: 'json',
quietMillis: 350,
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
text: "Please Select User"
});
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
//templateResult: formatResult
});


});


function loadPage(pg)
{
	location.href=pg;
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