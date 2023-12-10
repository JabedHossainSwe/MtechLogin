$("#report_type_option").on("change", function () {
  const selected_value = $(this).find(":selected").val();
  $("#report_type").attr("value", selected_value);
  if (selected_value == "group") {
    $(".toggle_groupbytype,.toggle_orderby").css("display", "none");
  } else {
    $(".toggle_groupbytype,.toggle_orderby").css("display", "block");
  }
});

$(document).ready(function () {
  $("#customer_id").select2({
    width: "100%",
    closeOnSelect: true,
    placeholder: "",
    //minimumInputLength: 2,
    ajax: {
      url: "Api/listings/getCustomers",
      dataType: "JSON",
      type: "POST",
      data: function (query) {
        // add any default query here
        term: query.terms;
        return query;
      },
      processResults: function (data, params) {
        console.log(data);

        var results = [];
        results.push({
          id: 0,
          text: "Please Select Customer",
        });
        // Tranforms the top-level key of the response object from 'items' to 'results'
        data.data.forEach((e) => {
          // cName = e.CName.toLowerCase();
          // terms = params.term.toLowerCase();
          results.push({
            id: e.Id,
            text: e.CName,
          });
        });
        return {
          results: results,
        };
      },
    },
    templateResult: formatResult,
  });

  function formatResult(d) {
    if (d.loading) {
      return d.text;
    }
    // Creating an option of each id and text
    $d = $("<option/>")
      .attr({
        value: d.value,
      })
      .text(d.text);

    return $d;
  }
});

$("#filter").on("click", function () {
  $(".filter_act").click();
  $(".no_envent").toggleClass("displayB");
});
$(".ara").on("click", function () {
  $("#selected_lang").attr("value", "1");
  $("span.en").css("display", "none");
  $("span.ar").css("display", "block");
  $(".add_me").addClass("rv");
  $(".this_ar").addClass("tb");
});

$(".eng").on("click", function () {
  $("#selected_lang").attr("value", "2");
  $("span.en").css("display", "block");
  $("span.ar").css("display", "none");
  $(".add_me").removeClass("rv");
  $(".this_ar").removeClass("tb");
});

$("#branch_all_select").on("change", function () {
  if ($(this).is(":checked")) {
    $("#branch").attr("disabled", "disabled");
    $("#branch")
      .siblings()
      .find(".select2-selection")
      .css("background", "#e9ecef !important");
    // $("#branch").siblings().find(".select2-selection__rendered").find(".select2-selection__choice").remove();
    $("#branch").empty().trigger("change");
  } else {
    $("#branch").removeAttr("disabled", "disabled");
    $("#branch")
      .siblings()
      .find(".select2-selection")
      .css("background", "#fff !important");
  }
});

$(document).ready(function () {
  $(".i-checks").iCheck({
    checkboxClass: "icheckbox_square-green",
    radioClass: "iradio_square-green",
  });
});

$(".clockpicker").clockpicker({
  donetext: "Select Time",
});

var mem = $(".date").datepicker({
  todayBtn: "linked",
  keyboardNavigation: false,
  forceParse: false,
  calendarWeeks: true,
  autoclose: true,
  dateFormat: "yy-mm-dd",
});

function setmyValue(vvl, idx) {
  document.getElementById(idx).value = vvl;
}

$(document).ready(function () {
  $("#branchs").select2({
    width: "100%",
  });

  $("#branch").select2({
    width: "100%",
    closeOnSelect: true,
    placeholder: "",
    minimumInputLength: 2,
    ajax: {
      url: "Api/listings/getBranches",
      dataType: "json",
      type: "POST",
      data: function (query) {
        // add any default query here
        return query;
      },
      processResults: function (data, params) {
        console.log(data.data);
        var results = [];

        // Tranforms the top-level key of the response object from 'items' to 'results'
        data.data.forEach((e) => {
          cName = e.CName.toLowerCase();
          terms = params.term.toLowerCase();

          if (cName.includes(terms)) {
            results.push({
              id: e.Id,
              text: e.CName,
            });
          }
        });
        return {
          results: results,
        };
      },
    },
    templateResult: formatResult,
  });

  function formatResult(d) {
    if (d.loading) {
      return d.text;
    }
    // Creating an option of each id and text
    $d = $("<option/>")
      .attr({
        value: d.value,
      })
      .text(d.text);

    return $d;
  }
});

$(document).ready(function () {
  $("#SpName").select2({
    width: "100%",
    closeOnSelect: true,
    placeholder: "",
    //minimumInputLength: 2,
    ajax: {
      url: "Api/listings/GetSupplierList",
      dataType: "JSON",
      type: "POST",
      data: function (query) {
        // add any default query here
        term: query.terms;
        return query;
      },
      processResults: function (data, params) {
        console.log(data);

        var results = [];
        results.push({
          id: 0,
          text: "Please Select Customer",
        });
        // Tranforms the top-level key of the response object from 'items' to 'results'
        data.data.forEach((e) => {
          // cName = e.CName.toLowerCase();
          // terms = params.term.toLowerCase();
          results.push({
            id: e.Id,
            text: e.CName,
          });
        });
        return {
          results: results,
        };
      },
    },
    templateResult: formatResult,
  });

  function formatResult(d) {
    if (d.loading) {
      return d.text;
    }
    // Creating an option of each id and text
    $d = $("<option/>")
      .attr({
        value: d.value,
      })
      .text(d.text);

    return $d;
  }
});

function loadAllSupplersMultiSelect() {
  document.getElementById("loadAllSupplersMultiSelect").innerHTML =
    "<img src='assets/loader/wheel.gif' style='width:20%;text-align:center' />";
  $.post(
    "include/reports/supplier/Ajax/loadAllSupplersMultiSelect.php",
    {},
    function (data) {
      $("#loadAllSupplersMultiSelect").html(data);
    }
  );
}

$(document).ready(function () {
  $("#user_name").select2({
    width: "100%",
    closeOnSelect: true,
    placeholder: "",
    //minimumInputLength: 2,
    ajax: {
      url: "Api/listings/getUsers",
      dataType: "json",
      type: "POST",
      data: function (query) {
        // add any default query here
        term: query.terms;
        return query;
      },
      processResults: function (data, params) {
        // Tranforms the top-level key of the response object from 'items' to 'results'
        var results = [];

        results.push({
          id: 0,
          text: "Please Select User",
        });
        data.data.forEach((e) => {
          //cName = e.CName.toLowerCase();
          // terms = params.term.toLowerCase();

          results.push({
            id: e.Id,
            text: e.CName,
          });
        });
        return {
          results: results,
        };
      },
    },
    templateResult: formatResult,
  });

  function formatResult(d) {
    if (d.loading) {
      return d.text;
    }
    // Creating an option of each id and text
    $d = $("<option/>")
      .attr({
        value: d.value,
      })
      .text(d.text);

    return $d;
  }
});

function validate_form() {}

function PrintPopup(query, type) {
  javascript: $("#PrintPopup").modal("show", { backdrop: "static" });

  $("#bill_query").val(query);
  $("#bill_type").val(type);
}

function Print_report_details() {
  var bill_query = $("#bill_query").val();
  var bill_type = $("#bill_type").val();
  var print_language = $("#print_language").val();

  window.open(
    "include/reports/sales/general_print.php?query=" +
      bill_query +
      "&LanguageId=" +
      print_language +
      "&type=" +
      bill_type +
      "",
    "_blank" // <- This is what makes it open in a new window.
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