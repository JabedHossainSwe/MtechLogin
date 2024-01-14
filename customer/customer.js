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
    url: "save.php",
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
