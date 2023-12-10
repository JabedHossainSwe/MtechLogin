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

$abc = "EXEC " . dbObject . "[TotalHighExpense]  @BID = $bid,@FromDate = N'$fromDate', @ToDate = N'$toDate'";
$TotalSales = Run($abc);
$records = myfetch($TotalSales);
$val = $records->TotalExpense;
$name = $records->ExpenseName;
$val = !empty($val) ? $val : '0';
$name = !empty($name) ? $name : 'dummy';

$section = "high_expense_sec";

echo '<div class="ibox-tools">
    <div class="align-center">
        <a href="javascript:highExpense(\'' . $section . '\', \'' . $M . '\', \'' . $sec . '\')" class="'.$mActive.'">M</a>
        <a href="javascript:highExpense(\'' . $section . '\', \'' . $W . '\', \'' . $sec . '\')" class="'.$wActive.'">W</a>
        <a href="javascript:highExpense(\'' . $section . '\', \'' . $D . '\', \'' . $sec . '\')" class="'.$dActive.'">D</a>
    </div>
</div>
  <div class="ibox">
  <div class="ibox-title">
      <img src="assets/img/high_expense.png" alt="">
      <h3><span class="en" >High Expense Head</span><span class="ar">'. getArabicTitle('High Expense Head') .'</span> </h3>
      <br>
  </div>
  <div class="ibox-content">
    <h1 class="no-margins">'.number_format($val).'</h1>
    <small><span class="en">' . $name . '</span><span class="ar align_center">' . $name . '</span></small>
    </div>
  </div>';
