<?php
session_start();
error_reporting(0);
include("../../config/connection.php");
if (empty($_SESSION['id'])) {
  printf("<script>location.href='index.php?value=logout'</script>");
  die();
}

$tp = $_POST['tp'];
// $bid = $_POST['bid'];
$bid = 0;
// $data = [];
$ToDate = date("m/d/Y");
$now = date('m/d/Y');
$month = date("m", strtotime($now));
$year = date("Y", strtotime($now));
$FromDate = date('m/d/Y', mktime(0, 0, 0, $month, 1, $year));

if ($tp = "sales") {
  $fetchData = Run("EXEC ".dbObject."[TotalSalesDateWise] @BID = $bid, @FromDate = N'$FromDate', @ToDate = N'$ToDate'");
  $data = "[";
  while ($row = myfetch($fetchData)) {
    $data .= "{ year: '" . $row->BILLDATE . "', value: " . $row->TotalSales . " },";
  }
  $data .= "]";
}
else if ($tp = "saleProfit") {
  $fetchData = Run("EXEC ".dbObject."[TotalSalesProfitDateWise] @BID = $bid, @FromDate = N'$FromDate', @ToDate = N'$ToDate'");
  $data = "[";
  while ($row = myfetch($fetchData)) {
    $data .= "{ year: '" . $row->BILLDATE . "', value: " . $row->TotalSalesProfit . " },";
  }
  $data .= "]";
}
else if ($tp = "expense") {
  $fetchData = Run("EXEC ".dbObject."[TotalExpenseDateWise] @BID = $bid, @FromDate = N'$FromDate', @ToDate = N'$ToDate'");
  $data = "[";
  while ($row = myfetch($fetchData)) {
    $data .= "{ year: '" . $row->BILLDATE . "', value: " . $row->TotalExpense . " },";
  }
  $data .= "]";
}


// else if ($tp = "customerModal") {
//   // $fetchData = Run("EXEC ".dbObject."[TotalSalesDateWise] @BID = $bid, @FromDate = N'$FromDate', @ToDate = N'$ToDate'");
//   $data = "[";
//   while ($row = myfetch($fetchData)) {
//     $data .= "{ year: '" . $row->BILLDATE . "', value: " . $row->TotalSales . " },";
//   }
//   $data .= "]";
// }
// else if ($tp = "supplier") {
//   // $fetchData = Run("EXEC ".dbObject."[TotalSalesDateWise] @BID = $bid, @FromDate = N'$FromDate', @ToDate = N'$ToDate'");
//   $data = "[";
//   while ($row = myfetch($fetchData)) {
//     $data .= "{ year: '" . $row->BILLDATE . "', value: " . $row->TotalSales . " },";
//   }
//   $data .= "]";
// }
// else if ($tp = "totalProduct") {
//   // $fetchData = Run("EXEC ".dbObject."[TotalSalesDateWise] @BID = $bid, @FromDate = N'$FromDate', @ToDate = N'$ToDate'");
//   $data = "[";
//   while ($row = myfetch($fetchData)) {
//     $data .= "{ year: '" . $row->BILLDATE . "', value: " . $row->TotalSales . " },";
//   }
//   $data .= "]";
// }


$fetchData = Run("EXEC " . dbObject . "[TotalSalesDateWise] @BID = 1, @FromDate = N'07/01/2023', @ToDate = N'07/30/2023'");

$data = "[";
while ($row = myfetch($fetchData)) {
  $data .= "{ year: '" . $row->BILLDATE . "', value: " . $row->TotalSales . " },";
}
$data .= "]";
?>

<div class="row">
  <div class="col-lg-12">
    <div class="ibox ">

      <div class="ibox-content">
        <div id="morris-one-line-chart"></div>
      </div>
    </div>
  </div>
</div>
<style>
  #morris-one-line-chart {
    width: 100%;
    height: 775px;
  }
</style>
<script>
  function pageload_dashboard() {
    window.morrisObj = new Morris.Line({
      // ID of the element in which to draw the chart.
      element: 'morris-one-line-chart',
      // Chart data records -- each entry in this array corresponds to a point on
      // the chart.
      data: <?= $data ?>,
      // The name of the data record attribute that contains x-values.
      xkey: 'year',
      // A list of names of data record attributes that contain y-values.
      ykeys: ['value'],
      // Labels for the ykeys -- will be displayed when you hover over the
      // chart.
      labels: ['Value'],
      resize: false
    });
  }
  $(document).ready(function() {
    window.setTimeout(function() {
      pageload_dashboard();

    }, 1000);
    var parentDivWidth = $("#morris-one-line-chart").parent("div").width();
    $("#morris-one-line-chart").css("min-width", parentDivWidth);
    $("#morris-one-line-chart > svg:nth-child(1)").css("min-width", parentDivWidth);



  });
</script>


<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.css">

<script src="assets/js/plugins/morris/raphael-2.1.0.min.js"></script>
<script src="assets/js/plugins/morris/morris.js"></script>