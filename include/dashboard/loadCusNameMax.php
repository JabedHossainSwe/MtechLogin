<?php
session_start();
error_reporting(0);
include("../../config/connection.php");
include("../../config/main_connection.php");
// include("../../config/functions.php");
include("../../config/main_functions.php");
if (empty($_SESSION['id'])) {
    printf("<script>location.href='index.php?value=logout'</script>");
    die();
}

$branchs = $_POST['branchs'];
$bid = !empty($branchs) ? $branchs : '0';

$query = "EXEC dbo.CustomerMaxBalance @BID='" . $bid . "'";
$stmt = Run($query);

$rows = myfetch($stmt);
$CName = $rows->CName;
$TotalStock = $rows->TotalReceivables;

echo '<div class="ibox-tools">
<div class="align-center">
  <a style="background-color: transparent !important;"></a>
</div>
</div>
  <div class="ibox">
  <div class="ibox-title">
      <h3><span class="en">Customer Max Balance</span><span class="ar">'. getArabicTitle('Customer Name with Max Balance') .'</span> </h3>
      <br>
  </div>
  <div class="ibox-content">
    <h1 class="no-margins" id="cusNameMaxValue">'. number_format($TotalStock).'</h1>
    <small><span class="en">'.$CName . '</span> <span class="ar align_center">'.$CName . '</span> </small>
    </div>
  </div>';