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

$abc = "EXEC  " . dbObject . "SupplierMaxBalance @BID='" . $bid . "'";
$TotalSales = Run($abc);
$val = myfetch($TotalSales);
$CName = $val->CName;
$TotalPayables = $val->TotalPayables;

echo '<div class="ibox-tools">
    <div class="align-center">
      <a style="background-color: transparent !important;"></a>
    </div>
</div>
  <div class="ibox">
  <div class="ibox-title">
      <h3><span class="en">Supplier Max Balance</span><span class="ar">'. getArabicTitle('Supplier Name with Max Balance') .'</span> </h3>
      <br>
  </div>
  <div class="ibox-content">
    <h1 class="no-margins" id="supNameMaxValue">' . number_format($TotalPayables).'</h1>
    <small><span class="en">'.$CName . '</span><span class="ar align_center">'.$CName . '</span> </small>
    </div>
  </div>';