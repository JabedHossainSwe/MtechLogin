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

$condition = " Where isDeleted = 0";
if ($bid == 0) {
    $condition .= " And bid != ''";
}
if ($bid != 0) {
    $condition .= " And bid = '" . $bid . "'";
}

$queryForSuppliers = Run("Select count(CId) as tlo from " . dbObject . "SupplierFile  $condition");
$getSuppliersCount = myfetch($queryForSuppliers)->tlo;

$TotalPayables = Run("EXEC  " . dbObject . "TotalPayables @BID='" . $bid . "'");
$TotalPayables = myfetch($TotalPayables)->TotalPayables;

$section = "suppliers_sec";
$M = "M";
$W = "W";
$D = "D";

echo '<div class="ibox-tools">
  <div class="align-center">
    <a href="javascript:chartPopup(\'supplierModal\')"><i class="fa fa-pie-chart"></i></a>
  </div>
</div>
  <div class="ibox">
  <div class="ibox-title">
      <img src="assets/img/supliers.png" alt="">
      <h3><span class="en">Suppliers</span><span class="ar">' . getArabicTitle('Suppliers') . '</span> </h3>
      <br>
  </div>
    <div class="ibox-content">


        <div id="myCarousel" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-inner">
          <div class="carousel-item active">
            <h1 class="no-margins">' . number_format($getSuppliersCount) . '</h1>
            <small><span class="en">Total Suppliers</span><span class="ar align_center">'. getArabicTitle('Total Suppliers') .'</span> </small>
          </div>
          <div class="carousel-item">
            <h1 class="no-margins">' . number_format($TotalPayables) . '</h1>
            <small><span class="en">Total Payables</span><span class="ar align_center">'. getArabicTitle('Total Payables') .'</span> </small>
          </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#myCarousel" data-bs-slide="prev">
          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
          <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#myCarousel" data-bs-slide="next">
          <span class="carousel-control-next-icon" aria-hidden="true"></span>
          <span class="visually-hidden">Next</span>
        </button>
      </div>
    </div>
  </div>';
