function save_general() {


    var error = "0";
    var name = document.getElementById('name').value;
    if (name == '') {
        document.getElementById('name').focus();

        document.getElementById('name_error').innerHTML = "* Please Enter  Name To Continue.";
        document.getElementById('name').style.border = "1px Solid Red";
        error = "1";
    } else {
        document.getElementById('name_error').innerHTML = "";
        document.getElementById('name').style.border = "1px Solid Green";
        error = "0";

    }

    var fileInput =
        document.getElementById('file');
    var file_upload = 1;
    var filePath = fileInput.value;
    if (filePath == '') {
        var file_upload = 0;

    }
    if (filePath != '') {
// Allowing file type
        var allowedExtensions =
            /(\.jpg|\.jpeg|\.png|\.gif)$/i;

        if (!allowedExtensions.exec(filePath)) {

            document.getElementById('file').focus();


            document.getElementById('file_error').innerHTML = "* Invalid file type.";
            document.getElementById('file').style.border = "1px Solid Red";


            fileInput.value = '';
            error = "1";
        } else {

// Image preview
            if (fileInput.files && fileInput.files[0]) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    document.getElementById(
                        'imagePreview').innerHTML =
                        '<img src="' + e.target.result
                        + '" style="width:100px;"/>';
                };

                reader.readAsDataURL(fileInput.files[0]);
                document.getElementById('file_error').innerHTML = "";
                document.getElementById('file').style.border = "1px Solid Green";
                error = "0";


            }
        }
    }


    if (error == "1") {
        return false;
    }

    var myform = document.getElementById("add_user_form");
    var fd = new FormData(myform);
    fd.append("file_upload", file_upload);

    document.getElementById('save_general').innerHTML = "<div style='background: #fff;text-align:center'><img width='80px' src='assets/img/loaders/loader.gif'/><div>";
    $.ajax({
        url: "include/profile/save_general.php",
        data: fd,
        cache: false,
        processData: false,
        contentType: false,
        type: 'POST',
        success: function (dataofconfirm) {
            $("#save_general").html(dataofconfirm);
        }
    });
}

function save_company_info() {
    var error = "0";


    var cname = document.getElementById('cname').value;
    if (cname == '') {
        document.getElementById('cname').focus();

        document.getElementById('cname_error').innerHTML = "* Please Enter Company Name To Continue.";
        document.getElementById('cname').style.border = "1px Solid Red";
        error = "1";
    } else {
        document.getElementById('cname_error').innerHTML = "";
        document.getElementById('cname').style.border = "1px Solid Green";
        error = "0";
    }


    var mobile = document.getElementById('mobile').value;
    if (mobile == '') {
        document.getElementById('mobile').focus();

        document.getElementById('mobile_error').innerHTML = "* Please Enter  Mobile To Continue.";
        document.getElementById('mobile').style.border = "1px Solid Red";
        error = "1";
    } else {
        document.getElementById('mobile_error').innerHTML = "";
        document.getElementById('mobile').style.border = "1px Solid Green";
        error = "0";
    }


    var phone = document.getElementById('phone').value;
    if (phone == '') {
        document.getElementById('phone').focus();

        document.getElementById('phone_error').innerHTML = "* Please Enter Phone To Continue.";
        document.getElementById('phone').style.border = "1px Solid Red";
        error = "1";
    } else {
        document.getElementById('phone_error').innerHTML = "";
        document.getElementById('phone').style.border = "1px Solid Green";
        error = "0";
    }


    var address = document.getElementById('address').value;
    if (address == '') {
        document.getElementById('address').focus();

        document.getElementById('address_error').innerHTML = "* Please Enter Address To Continue.";
        document.getElementById('address').style.border = "1px Solid Red";
        error = "1";
    } else {
        document.getElementById('address_error').innerHTML = "";
        document.getElementById('address').style.border = "1px Solid Green";
        error = "0";
    }


    var vat = document.getElementById('vat').value;
    if (vat == '') {
        document.getElementById('vat').focus();

        document.getElementById('vat_error').innerHTML = "* Please Enter VAT/NTN To Continue.";
        document.getElementById('vat').style.border = "1px Solid Red";
        error = "1";
    } else {
        document.getElementById('vat_error').innerHTML = "";
        document.getElementById('vat').style.border = "1px Solid Green";
        error = "0";
    }


    var fileInput =
        document.getElementById('logo');
    var file_upload = 1;
    var filePath = fileInput.value;
    if (filePath == '') {
        var file_upload = 0;

    }
    if (filePath != '') {
// Allowing file type
        var allowedExtensions =
            /(\.jpg|\.jpeg|\.png|\.gif)$/i;

        if (!allowedExtensions.exec(filePath)) {

            document.getElementById('logo').focus();


            document.getElementById('logo_error').innerHTML = "* Invalid file type.";
            document.getElementById('logo').style.border = "1px Solid Red";


            fileInput.value = '';
            error = "1";
        } else {

// Image preview
            if (fileInput.files && fileInput.files[0]) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    document.getElementById(
                        'imagePreview').innerHTML =
                        '<img src="' + e.target.result
                        + '" style="width:100px;"/>';
                };

                reader.readAsDataURL(fileInput.files[0]);
                document.getElementById('logo_error').innerHTML = "";
                document.getElementById('logo').style.border = "1px Solid Green";
                error = "0";


            }
        }
    }


    if (error == "1") {
        return false;
    }

    $('#seles_report_search').attr('disabled', true);
    var myform = document.getElementById("save_company_info_form");
    var fd = new FormData(myform);
    fd.append("file_upload", file_upload);

    document.getElementById('save_company_info_div').innerHTML = "<div style='background: #fff;text-align:center'><img width='80px' src='assets/img/loaders/loader.gif'/><div>";
    $.ajax({
        url: "include/profile/save_company_info.php",
        data: fd,
        cache: false,
        processData: false,
        contentType: false,
        type: 'POST',
        success: function (dataofconfirm) {
            $("#save_company_info_div").html(dataofconfirm);
            $("#seles_report_search").attr("disabled", false);
        }
    });
}

function change_password() {
    var error = "0";
    var old_pw = document.getElementById('old_pw').value;
    if (old_pw == '') {
        document.getElementById('old_pw').focus();

        document.getElementById('old_pw_error').innerHTML = "* Please Enter Old Password To Continue.";
        document.getElementById('old_pw').style.border = "1px Solid Red";
        error = "1";
    } else {
        document.getElementById('old_pw_error').innerHTML = "";
        document.getElementById('old_pw').style.border = "1px Solid Green";
        error = "0";
    }


    var new_pw = document.getElementById('new_pw').value;
    if (new_pw == '') {
        document.getElementById('new_pw').focus();

        document.getElementById('new_pw_error').innerHTML = "* Please Enter Old Password To Continue.";
        document.getElementById('new_pw').style.border = "1px Solid Red";
        error = "1";
    } else {
        document.getElementById('new_pw_error').innerHTML = "";
        document.getElementById('new_pw').style.border = "1px Solid Green";
        error = "0";
    }


    var c_pw = document.getElementById('c_pw').value;
    if (c_pw == '') {
        document.getElementById('c_pw').focus();

        document.getElementById('c_pw_error').innerHTML = "* Please Enter Old Password To Continue.";
        document.getElementById('c_pw').style.border = "1px Solid Red";
        error = "1";
    } else {
        document.getElementById('c_pw_error').innerHTML = "";
        document.getElementById('c_pw').style.border = "1px Solid Green";
        error = "0";
    }


    if (new_pw != c_pw) {
        document.getElementById('c_pw').focus();

        document.getElementById('c_pw_error').innerHTML = "* New Password Does not Match With Confirm Password.";
        document.getElementById('c_pw').style.border = "1px Solid Red";
        error = "1";

    }


    if (error == "1") {
        return false;
    }

    var myform = document.getElementById("change_pass_form");
    var fd = new FormData(myform);

    $("#seles_report_search").attr("disabled", true);
    document.getElementById('change_password').innerHTML = "<div style='background: #fff;text-align:center'><img width='80px' src='assets/img/loaders/loader.gif'/><div>";
    $.ajax({
        url: "include/profile/change_password.php",
        data: fd,
        cache: false,
        processData: false,
        contentType: false,
        type: 'POST',
        success: function (dataofconfirm) {
            $("#change_password").html(dataofconfirm);
            $("#seles_report_search").attr("disabled", false);
        }
    });
}


function loadbranches() {
    document.getElementById('loadbranches').innerHTML = "<div style='background: #fff;text-align:center'><img width='80px' src='assets/img/loaders/loader.gif'/><div>";
    $.post("include/profile/loadbranches.php", {}, function (data) {
        $("#loadbranches").html(data);
    });
}

function loadEmployees() {
    document.getElementById('loadEmployees').innerHTML = "<div style='background: #fff;text-align:center'><img width='80px' src='assets/img/loaders/loader.gif'/><div>";
    $.post("include/profile/loadEmployees.php", {}, function (data) {
        $("#loadEmployees").html(data);
    });
}

function AddBranch() {
    document.getElementById('modalContent').innerHTML = "<img src='loader/wheel.gif' style='width:10%' />";
    var lang = document.getElementById("selected_lang").value;
    if(lang == 1){
    document.getElementById('modalTitle').innerHTML = "Branch";
    }
    else{
    document.getElementById('modalTitle').innerHTML = "الفرع";
    }
    document.getElementById('helperText').innerHTML = "";
    javascript:$('#myModal2').modal('show', {backdrop: 'static'});
    $.post("include/profile/AddBranch.php", {}, function (data) {
        $("#modalContent").html(data);
    });
}
function AddUser(id) {
    document.getElementById('modalContent').innerHTML = "<img src='loader/wheel.gif' style='width:10%' />";
    var lang = document.getElementById("selected_lang").value;
    if(lang == 1){
    document.getElementById('modalTitle').innerHTML = "User";
    }
    else{
    document.getElementById('modalTitle').innerHTML = "المستخدم";
    }
    document.getElementById('helperText').innerHTML = "";
    javascript:$('#myModal2').modal('show', {backdrop: 'static'});
	 $("#mdlLg").addClass("modal-lg");
	
    $.post("include/profile/Adduser.php",{id:id}, function (data) {
        $("#modalContent").html(data);
    });
}


function editUser(id) {
    document.getElementById('modalContent').innerHTML = "<img src='loader/wheel.gif' style='width:10%' />";
    var lang = document.getElementById("selected_lang").value;
    if(lang == 1){
    document.getElementById('modalTitle').innerHTML = "User";
    }
    else{
    document.getElementById('modalTitle').innerHTML = "المستخدم";
    }
       document.getElementById('helperText').innerHTML = "";
		 $("#mdlLg").addClass("modal-lg");

    javascript:$('#myModal2').modal('show', {backdrop: 'static'});
    $.post("include/profile/editUser.php", {id: id}, function (data) {
        $("#modalContent").html(data);
    });
}
function ChangeStatus(id) {
    document.getElementById('modalContent').innerHTML = "<img src='loader/wheel.gif' style='width:10%' />";
    var lang = document.getElementById("selected_lang").value;
    if(lang == 1){
    document.getElementById('modalTitle').innerHTML = "User";
    }
    else{
    document.getElementById('modalTitle').innerHTML = "المستخدم";
    }
        document.getElementById('helperText').innerHTML = "";
    javascript:$('#myModal2').modal('show', {backdrop: 'static'});
    $.post("include/profile/ChangeStatus.php", {id: id}, function (data) {
        $("#modalContent").html(data);
    });
}



function editBranch(Bid) {
    document.getElementById('modalContent').innerHTML = "<img src='loader/wheel.gif' style='width:10%' />";
    var lang = document.getElementById("selected_lang").value;
    if(lang == 1){
    document.getElementById('modalTitle').innerHTML = "Branch";
    }
    else{
    document.getElementById('modalTitle').innerHTML = "الفرع";
    }
        document.getElementById('helperText').innerHTML = "";
    javascript:$('#myModal2').modal('show', {backdrop: 'static'});
    $.post("include/profile/editBranch.php", {Bid: Bid}, function (data) {
        $("#modalContent").html(data);
    });
}


function saveChangeStatus(id)
{
	document.getElementById('error').innerHTML = "<div style='background: #fff;text-align:center'><img width='80px' src='assets/img/loaders/loader.gif'/><div>";
var status = document.getElementById('status').value;
    $.post("include/profile/saveChangeStatus.php", {
        id: id,
        status: status,
    }, function (data) {
        $("#error").html(data);
    });
}

function saveBranch() {
    var error = "0";
    var bname = document.getElementById('bname').value;
    if (bname == '') {
        document.getElementById('bname').focus();

        document.getElementById('bname_error').innerHTML = "* Please Enter  Name To Continue.";
        document.getElementById('bname').style.border = "1px Solid Red";
        error = "1";
    } else {
        document.getElementById('bname_error').innerHTML = "";
        document.getElementById('bname').style.border = "1px Solid Green";
        error = "0";

    }
    error2 = "0"
    var StartInvoiceNo = document.getElementById('StartInvoiceNo').value;
    if (StartInvoiceNo == '' || parseFloat(StartInvoiceNo) < 0) {
        document.getElementById('StartInvoiceNo').focus();

        document.getElementById('StartInvoiceNo_error').innerHTML = "* Please Enter Proper Starting Invoice.";
        document.getElementById('StartInvoiceNo').style.border = "1px Solid Red";
        error2 = "1";
    } else {
        document.getElementById('StartInvoiceNo_error').innerHTML = "";
        document.getElementById('StartInvoiceNo').style.border = "1px Solid Green";
        error2 = "0";

    }


    if (error == "1" || error2 == "1") {
        return false;
    }

    var Bid = document.getElementById('Bid').value;
    var BCode = document.getElementById('BCode').value;
    var BDescription = document.getElementById('BDescription').value;

    document.getElementById('saveBranch').innerHTML = "<div style='background: #fff;text-align:center'><img width='80px' src='assets/img/loaders/loader.gif'/><div>";

    $('#saveBranchBtn').attr('disabled', true);
    $.post("include/profile/saveBranch.php", {
        Bid: Bid,
        BCode: BCode,
        BDescription: BDescription,
        BName: bname,
        StartInvoiceNo: StartInvoiceNo
    }, function (data) {
        $("#saveBranch").html(data);
        $('#saveBranchBtn').attr('disabled', false);
    });


}

function updateBranch(Bid) {
    var error = "0";
    var bname = document.getElementById('bname').value;
    if (bname == '') {
        document.getElementById('bname').focus();

        document.getElementById('bname_error').innerHTML = "* Please Enter  Name To Continue.";
        document.getElementById('bname').style.border = "1px Solid Red";
        error = "1";
    } else {
        document.getElementById('bname_error').innerHTML = "";
        document.getElementById('bname').style.border = "1px Solid Green";
        error = "0";

    }
    var error2 = "0";
    var StartInvoiceNo = document.getElementById('StartInvoiceNo').value;
    if (StartInvoiceNo == '' || parseFloat(StartInvoiceNo) < 0) {
        document.getElementById('StartInvoiceNo').focus();

        document.getElementById('StartInvoiceNo_error').innerHTML = "* Please Enter Proper Starting Invoice.";
        document.getElementById('StartInvoiceNo').style.border = "1px Solid Red";
        error2 = "1";
    } else {
        document.getElementById('StartInvoiceNo_error').innerHTML = "";
        document.getElementById('StartInvoiceNo').style.border = "1px Solid Green";
        error2 = "0";

    }
    if (error == "1" || error2 == "1") {
        return false;
    }
    var BDescription = document.getElementById('BDescription').value;
    var ismain = document.getElementById('ismain').value;


    document.getElementById('updateBranch').innerHTML = "<div style='background: #fff;text-align:center'><img width='80px' src='assets/img/loaders/loader.gif'/><div>";
    $("#updateBranchBtn").attr("disabled", true);
    $.post("include/profile/updateBranch.php", {
        Bid: Bid,
        BDescription: BDescription,
        BName: bname,
        StartInvoiceNo: StartInvoiceNo,
        ismain: ismain
    }, function (data) {
        $("#updateBranch").html(data);
        $("#updateBranchBtn").attr("disabled", false);
    });
}


function deleteBranch(id) {
    var result = confirm("Want to delete?");
    if (result) {
        document.getElementById('deleteBranch').innerHTML = "<div style='background: #fff;text-align:center'><img width='80px' src='assets/img/loaders/loader.gif'/><div>";

        $.post("include/profile/deleteBranch.php", {Bid: id}, function (data) {
            $("#deleteBranch").html(data);
        });
    }
}

function saveUser()
{

var id = document.getElementById('id').value;
if(id=='')	
{
document.getElementById('id').focus();
toastr.error("Sorry No Id Found.", "Error");
return false;
}

var error="0";
var name = document.getElementById('name').value;
if(name=='')	
{
document.getElementById('name').focus();

document.getElementById('name_error').innerHTML="* Please Enter Name To Continue.";
document.getElementById('name').style.border="1px Solid Red";
error="1";
}
else{
document.getElementById('name_error').innerHTML="";
document.getElementById('name').style.border="1px Solid Green";
error="0";

}
	
var email = document.getElementById('email').value;
if(email=='')	
{
document.getElementById('email').focus();

document.getElementById('email_error').innerHTML="* Please Enter Email To Continue.";
document.getElementById('email').style.border="1px Solid Red";
error="1";
}
else{
document.getElementById('email_error').innerHTML="";
document.getElementById('email').style.border="1px Solid Green";
error="0";
}	
	
var password = document.getElementById('password').value;
if(password=='')	
{
document.getElementById('password').focus();

document.getElementById('password_error').innerHTML="* Please Enter Password To Continue.";
document.getElementById('password').style.border="1px Solid Red";
error="1";
}
else{
document.getElementById('password_error').innerHTML="";
document.getElementById('password').style.border="1px Solid Green";
error="0";
}	

var branch = document.getElementById('branch').value;
if(branch=='')	
{
document.getElementById('branch').focus();

document.getElementById('branch_error').innerHTML="* Please Select Branch To Continue.";
document.getElementById('branch').style.border="1px Solid Red";
error="1";
}
else{
document.getElementById('branch_error').innerHTML="";
document.getElementById('branch').style.border="1px Solid Green";
error="0";
}	
	

var department = document.getElementById('department').value;
if(department=='')	
{
document.getElementById('department').focus();

document.getElementById('department_error').innerHTML="* Please Select Department To Continue.";
document.getElementById('department').style.border="1px Solid Red";
error="1";
}
else{
document.getElementById('department_error').innerHTML="";
document.getElementById('department').style.border="1px Solid Green";
error="0";
}	
	


var usertype = document.getElementById('usertype').value;
if(usertype=='')	
{
document.getElementById('usertype').focus();

document.getElementById('usertype_error').innerHTML="* Please Select User Type To Continue.";
document.getElementById('usertype').style.border="1px Solid Red";
error="1";
}
else{
document.getElementById('usertype_error').innerHTML="";
document.getElementById('usertype').style.border="1px Solid Green";
error="0";
}	

var uiType = document.getElementById('uiType').value;
if(uiType=='')	
{
document.getElementById('uiType').focus();

document.getElementById('uiType_error').innerHTML="* Please Select UI Type To Continue.";
document.getElementById('uiType').style.border="1px Solid Red";
error="1";
}
else{
document.getElementById('uiType_error').innerHTML="";
document.getElementById('uiType').style.border="1px Solid Green";
error="0";
}
	
	var Type = document.getElementById('Type').value;
if(Type=='')	
{
document.getElementById('Type').focus();

document.getElementById('Type_error').innerHTML="* Please Select Type To Continue.";
document.getElementById('Type').style.border="1px Solid Red";
error="1";
}
else{
document.getElementById('Type_error').innerHTML="";
document.getElementById('Type').style.border="1px Solid Green";
error="0";
}	
		
	

var fileInput =
document.getElementById('file');
var file_upload=1;
var filePath = fileInput.value;
if(filePath=='')
{
var file_upload=0;

}
if(filePath!='')
{
// Allowing file type
var allowedExtensions =
/(\.jpg|\.jpeg|\.png|\.gif)$/i;

if (!allowedExtensions.exec(filePath)) {

document.getElementById('file').focus();



document.getElementById('file_error').innerHTML="* Invalid file type.";
document.getElementById('file').style.border="1px Solid Red";		



fileInput.value = '';
error="1";
}
else
{

// Image preview
if (fileInput.files && fileInput.files[0]) {

document.getElementById('file_error').innerHTML="";
document.getElementById('file').style.border="1px Solid Green";		
error="0";




}
}
}
	if(error=="1")
{
return false;
}
	var myform = document.getElementById("add_user_form_comp");
var fd = new FormData(myform);
	fd.append("file_upload", file_upload);
    $("#ajaxStart").attr("disabled", true);

document.getElementById('error').innerHTML = "<img src='loader/wheel.gif' style='width:20%; />";
$.ajax({
url:"include/profile/saveUser.php",
data: fd,
cache: false,
processData: false,
contentType: false,
type: 'POST',
success: function (dataofconfirm) {
$("#error").html(dataofconfirm);
            $("#ajaxStart").attr("disabled", false);
	
}
});
	
	
}

function updateUser(idx)
{
var id = document.getElementById('id').value;
if(id=='')	
{
document.getElementById('id').focus();
toastr.error("Sorry No Id Found.", "Error");
return false;
}

var error="0";
var name = document.getElementById('name').value;
if(name=='')	
{
document.getElementById('name').focus();

document.getElementById('name_error').innerHTML="* Please Enter Name To Continue.";
document.getElementById('name').style.border="1px Solid Red";
error="1";
}
else{
document.getElementById('name_error').innerHTML="";
document.getElementById('name').style.border="1px Solid Green";
error="0";

}
	
var email = document.getElementById('email').value;
if(email=='')	
{
document.getElementById('email').focus();

document.getElementById('email_error').innerHTML="* Please Enter Email To Continue.";
document.getElementById('email').style.border="1px Solid Red";
error="1";
}
else{
document.getElementById('email_error').innerHTML="";
document.getElementById('email').style.border="1px Solid Green";
error="0";
}	
	
var password = document.getElementById('password').value;
if(password=='')	
{
document.getElementById('password').focus();

document.getElementById('password_error').innerHTML="* Please Enter Password To Continue.";
document.getElementById('password').style.border="1px Solid Red";
error="1";
}
else{
document.getElementById('password_error').innerHTML="";
document.getElementById('password').style.border="1px Solid Green";
error="0";
}	

var branch = document.getElementById('branch').value;
if(branch=='')	
{
document.getElementById('branch').focus();

document.getElementById('branch_error').innerHTML="* Please Select Branch To Continue.";
document.getElementById('branch').style.border="1px Solid Red";
error="1";
}
else{
document.getElementById('branch_error').innerHTML="";
document.getElementById('branch').style.border="1px Solid Green";
error="0";
}	
	

var department = document.getElementById('department').value;
if(department=='')	
{
document.getElementById('department').focus();

document.getElementById('department_error').innerHTML="* Please Select Department To Continue.";
document.getElementById('department').style.border="1px Solid Red";
error="1";
}
else{
document.getElementById('department_error').innerHTML="";
document.getElementById('department').style.border="1px Solid Green";
error="0";
}	
	


var usertype = document.getElementById('usertype').value;
if(usertype=='')	
{
document.getElementById('usertype').focus();

document.getElementById('usertype_error').innerHTML="* Please Select User Type To Continue.";
document.getElementById('usertype').style.border="1px Solid Red";
error="1";
}
else{
document.getElementById('usertype_error').innerHTML="";
document.getElementById('usertype').style.border="1px Solid Green";
error="0";
}	

var uiType = document.getElementById('uiType').value;
if(uiType=='')	
{
document.getElementById('uiType').focus();

document.getElementById('uiType_error').innerHTML="* Please Select UI Type To Continue.";
document.getElementById('uiType').style.border="1px Solid Red";
error="1";
}
else{
document.getElementById('uiType_error').innerHTML="";
document.getElementById('uiType').style.border="1px Solid Green";
error="0";
}
	
	var Type = document.getElementById('Type').value;
if(Type=='')	
{
document.getElementById('Type').focus();

document.getElementById('Type_error').innerHTML="* Please Select Type To Continue.";
document.getElementById('Type').style.border="1px Solid Red";
error="1";
}
else{
document.getElementById('Type_error').innerHTML="";
document.getElementById('Type').style.border="1px Solid Green";
error="0";
}	
		
	

var fileInput =
document.getElementById('file_up');
var file_upload=1;
var filePath = fileInput.value;
	console.log("Asad");
	console.log(filePath);
if(filePath=='')
{
var file_upload=0;
}
if(filePath!='')
{
// Allowing file type
var allowedExtensions =
/(\.jpg|\.jpeg|\.png|\.gif)$/i;

if (!allowedExtensions.exec(filePath)) {

document.getElementById('file_up').focus();



document.getElementById('file_error').innerHTML="* Invalid file type.";
document.getElementById('file_up').style.border="1px Solid Red";		



fileInput.value = '';
error="1";
}
else
{

// Image preview
if (fileInput.files && fileInput.files[0]) {

document.getElementById('file_error').innerHTML="";
document.getElementById('file_up').style.border="1px Solid Green";		
error="0";




}
}
}
	if(error=="1")
{
return false;
}
	var myform = document.getElementById("update_user_form_comp");
var fd = new FormData(myform);
	fd.append("file_upload", file_upload);
    $("#ajaxStart").attr("disabled", true);

document.getElementById('error').innerHTML = "<img src='loader/wheel.gif' style='width:20%; />";
$.ajax({
url:"include/profile/updateUser.php",
data: fd,
cache: false,
processData: false,
contentType: false,
type: 'POST',
success: function (dataofconfirm) {
$("#error").html(dataofconfirm);
            $("#ajaxStart").attr("disabled", false);
	
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


