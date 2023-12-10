function saveDriver() {
    var anyaction = false;

    var Code = document.getElementById("Code").value;
    if (Code == "") {
      $("#Code").css("border", "2px solid red");
      anyaction = true;
    } else {
      $("#Code").css("border", "1px solid green");
    }
  
    var Name = document.getElementById("Name").value;
    if (Name == "" || parseFloat(Name) == 0) {
      $("#Name").css("border", "2px solid red");
      anyaction = true;
    } else {
      $("#Name").css("border", "1px solid green");
    }
  
    if (anyaction) {
      return false;
    }
  
    var myform = document.getElementById("save_driver_form");
    var fd = new FormData(myform);
  
    document.getElementById("SalesVoucherDiv").innerHTML = "<div style='background: #fff;text-align:center'><img width='80px' src='assets/img/loaders/loader.gif'/><div>";
    $.ajax({
      url: "include/driver/save.php",
      data: fd,
      cache: false,
      processData: false,
      contentType: false,
      type: "POST",
      success: function (dataofconfirm) {
        $("#SalesVoucherDiv").html(dataofconfirm);
      },
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