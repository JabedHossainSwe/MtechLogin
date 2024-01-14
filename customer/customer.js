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