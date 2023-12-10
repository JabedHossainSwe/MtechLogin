<?php
session_start();
error_reporting(0);
include("../../config/connection.php");
// include("../../config/functions.php");
if (empty($_SESSION['id'])) {
    printf("<script>location.href='index.php?value=logout'</script>");
    die();
}

$val = $_POST['val'];
$branchs = $_POST['branchs'];
$bid = !empty($branchs) ? $branchs : '0';

$M = "M";
$W = "W";
$D = "D";
$dActive = "";
$wActive = "";
$mActive = "";

if ($val == 'D') {
    $fromDate = date("m/d/Y");
    $toDate = date("m/d/Y");
    $dActive = "active_border";
} elseif ($val == 'W') {
    $fromDate = date("m/d/Y", strtotime("-7 day"));;
    $toDate = date("m/d/Y");
    $wActive = "active_border";
} elseif ($val == 'M') {
    $fromDate = date("m/d/Y", strtotime("-30 day"));;
    $toDate = date("m/d/Y");
    $mActive = "active_border";
}

$StockReportQ = Run("EXEC " . dbObject . "TotalProducts");
$TotalStock = myfetch($StockReportQ)->TotalProducts;

$section = "total_product_sec";

echo '<div class="ibox-tools">
    <div class="align-center">
        <a href="javascript:chartPopup(\'totalProductModal\')"><i class="fa fa-pie-chart"></i></a>
        <a href="javascript:totalProduct(\'' . $section . '\', \'' . $M . '\', \'' . $sec . '\')" class="'.$mActive.'">M</a>
        <a href="javascript:totalProduct(\'' . $section . '\', \'' . $W . '\', \'' . $sec . '\')" class="'.$wActive.'">W</a>
        <a href="javascript:totalProduct(\'' . $section . '\', \'' . $D . '\', \'' . $sec . '\')" class="'.$dActive.'">D</a>
    </div>
</div>
  <div class="ibox">
  <div class="ibox-title">
      <img src="assets/img/total_product.png" alt="">
      <h3><span class="en">Total Product</span><span class="ar">'. getArabicTitle('Total Product') .'</span> </h3>
      <br>
  </div>
  <div class="ibox-content">
    <h1 class="no-margins" id="productValue">' . number_format($TotalStock) . '</h1>
    <small><span class="en">Total Product</span><span class="ar align_center">'. getArabicTitle('Total Product') .'</span> </small>
    </div>
  </div>';
