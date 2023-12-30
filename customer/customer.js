function addCustomer() {
  var a = validateEntry();
  if (a == "1") {
    return false;
  }
  document.getElementById("add").innerHTML =
    "<div style='background: #fff;text-align:center'><img width='80px' src='assets/images/loaders/loader.gif'/><div>";
  var myform = document.getElementById("add_form");
  var fd = new FormData(myform);
  $("#add_customer").attr("disabled", true);
  $.ajax({
    url: "./add.php",
    data: fd,
    cache: false,
    processData: false,
    contentType: false,
    type: "POST",
    success: function (dataofconfirm) {
      $("#add").html(dataofconfirm);
      $("#add_customer").attr("disabled", false);
    },
  });
}
