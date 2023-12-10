<?php
session_start();
error_reporting(0);
include("../../config/connection.php");
// include("../../config/functions.php");
if(empty($_SESSION['id']))
{
printf("<script>location.href='index.php?value=logout'</script>");
die();
}

$branchs = $_POST['branchs'];
$bid = !empty($branchs) ? $branchs : '0';

$condition = " Where isDeleted = 0";
if ($bid == 0) {
    $condition .= " And bid != ''";
}
if ($bid != 0) {
    $condition .= " And bid = '" . $bid . "'";
}

$queryForCustomers = Run("Select count(CId) as tlo from " . dbObject . "CustFile  $condition");
$getCustomersCount = myfetch($queryForCustomers)->tlo;

$TotalReceivables = Run("EXEC  " . dbObject . "TotalReceivables @BID='" . $bid . "'");
$TotalReceivables = myfetch($TotalReceivables)->TotalReceivables;

echo '<div class="ibox-tools">
    <div class="align-center">
      <a href="javascript:chartPopup(\'customerModal\')"><i class="fa fa-pie-chart"></i></a>
    </div>
</div>
  <div class="ibox">
  <div class="ibox-title">
      <img src="assets/img/customers.png" alt="">
      <h3><span class="en">Customers</span><span class="ar">' . getArabicTitle('Customers') . '</span> </h3>
      <br>
  </div>
    <div class="ibox-content">

        <div id="myCarouselOne" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-inner">
          <div class="carousel-item active">
            <h1 class="no-margins">'. number_format($getCustomersCount) .'</h1>
            <small><span class="en">Total Customers</span><span class="ar align_center">'. getArabicTitle('Total Customers') .'</span></small>
          </div>
          <div class="carousel-item">
            <h1 class="no-margins">'.number_format($TotalReceivables) .'</h1>
            <small><span class="en">Total Recievables</span><span class="ar align_center">'. getArabicTitle('Total Recievables') .'</span></small>
          </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#myCarouselOne" data-bs-slide="prev">
          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
          <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#myCarouselOne" data-bs-slide="next">
          <span class="carousel-control-next-icon" aria-hidden="true"></span>
          <span class="visually-hidden">Next</span>
        </button>
      </div>


    </div>
  </div>';