<?php
session_start();
error_reporting(0);
include("../../config/connection.php");
// include("../../config/functions.php");
if (empty($_SESSION['id'])) {
	printf("<script>location.href='index.php?value=logout'</script>");
	die();
}

$branchs = $_POST['branchs'];
$bid = !empty($branchs) ? $branchs : '0';
$BidPrice = $_POST['BidPrice'];

$date = date("Y-m-d");
$query = "EXEC  " . dbObject . "TotalStockValue  @bid =$bid, @ToDate ='$date',@StockValueBy ='1', @BidPrice='$BidPrice'";

$StockReportQ = Run($query);
$TotalStock = myfetch($StockReportQ);
foreach ($TotalStock as $single) {
	$stockValue = $single;
}

echo '<div class="ibox-tools">
  <div class="align-center">
  </div>
</div>
  <div class="ibox">
  <div class="ibox-title">
      <img src="assets/img/stock_report.png" alt="">
      <h3><span class="en">Total Stock</span><span class="ar">'. getArabicTitle('Total Stock') .'</span> </h3>
			<button type="button" data-toggle="modal" data-target="#stockModal" class="langButton"><i class="fa fa-tasks" aria-hidden="true"></i></button>
      <br>
  </div>
  <div class="ibox-content">
    <h1 class="no-margins">' . number_format($stockValue) . '</h1>
    <small><span class="en">Total Stock</span><span class="ar align_center">'. getArabicTitle('Total Stock') .'</span> </small>
    </div>
  </div>';
