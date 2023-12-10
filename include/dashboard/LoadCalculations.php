<?php
session_start();
error_reporting(0);
include("../../config/connection.php");
// include("../../config/functions.php");
if (empty($_SESSION['id'])) {
  printf("<script>location.href='index.php?value=logout'</script>");
  die();
}

$tp = $_POST['tp'];
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


if ($tp == 'Sale') {
  $abc = "EXEC  " . dbObject . "TotalSales @BID='" . $bid . "',@FromDate ='" . $fromDate . "',@ToDate ='" . $toDate . "'";
  $TotalSales = Run($abc);
  $val = myfetch($TotalSales)->TotalSales;


  $section = "Sale";
  $sec = "sales_Sec";

  $response = '
  <div class="ibox-tools">
    <div class="align-center">
      <a href="javascript:chartPopup(\'sales\')"><i class="fa fa-pie-chart"></i></a>
      <a href="javascript:loadSales(\'' . $section . '\', \'M\', \'' . $sec . '\')" class="'.$mActive.'">M</a>
      <a href="javascript:loadSales(\'' . $section . '\', \'W\', \'' . $sec . '\')" class="'.$wActive.'">W</a>
      <a href="javascript:loadSales(\'' . $section . '\', \'D\', \'' . $sec . '\')" class="'.$dActive.'">D</a>
    </div>
</div>
  <div class="ibox">
  <div class="ibox-title">
      <img src="assets/img/sales.png" alt="">
      <h3><span class="en">Sales</span><span class="ar">'. getArabicTitle('Sales') .'</span> </h3>
      <br>
  </div>
  <div class="ibox-content">
    <h1 class="no-margins" id="salesValue">'.number_format($val,2).'</h1>
    <small><span class="en">Total Sales</span><span class="ar align_center">'. getArabicTitle('Total Sales') .'</span> </small>
    </div>
  </div>';

}
elseif ($tp == 'SaleProfit') {
  $abc = "EXEC  " . dbObject . "TotalSalesProfit @BID='" . $bid . "',@FromDate ='" . $fromDate . "',@ToDate ='" . $toDate . "'";
  $TotalSales = Run($abc);
  $val = myfetch($TotalSales)->TotalSalesProfit;

  $section = "SaleProfit";
  $sec = "sales_profit";

  $response = '
<div class="ibox-tools">
    <div class="align-center">
      <a href="javascript:chartPopup(\'saleProfitModal\')"><i class="fa fa-pie-chart"></i></a>
      <a href="javascript:loadSalesProfit(\'' . $section . '\', \'' . $M . '\', \'' . $sec . '\')" class="'.$mActive.'">M</a>
      <a href="javascript:loadSalesProfit(\'' . $section . '\', \'' . $W . '\', \'' . $sec . '\')" class="'.$wActive.'">W</a>
      <a href="javascript:loadSalesProfit(\'' . $section . '\', \'' . $D . '\', \'' . $sec . '\')" class="'.$dActive.'">D</a>
    </div>
</div>
  <div class="ibox">
  <div class="ibox-title">
      <img src="assets/img/sales_profit.png" alt="">
      <h3><span class="en">Sales Profit</span><span class="ar">'. getArabicTitle('Sales Profit') .'</span> </h3>
      <br>
  </div>
  <div class="ibox-content">
    <h1 class="no-margins" id="salesProfitValue">'.number_format($val,2).'</h1>
    <small><span class="en">Total Sales</span><span class="ar align_center">'. getArabicTitle('Total Sales') .'</span> </small>
    </div>
  </div>
';
}
elseif ($tp == 'Expense') {
  $abc = "EXEC  " . dbObject . "TotalExpense @BID='" . $bid . "',@FromDate ='" . $fromDate . "',@ToDate ='" . $toDate . "'";
  $TotalSales = Run($abc);
  $val = myfetch($TotalSales)->TotalExpense;

  $section = "Expense";
  $sec = "expense_sec";

  $response = '
<div class="ibox-tools">
    <div class="align-center">
      <a href="javascript:chartPopup(\'expenseModal\')"><i class="fa fa-pie-chart"></i></a>
      <a href="javascript:loadExpese(\'' . $section . '\', \'' . $M . '\', \'' . $sec . '\')" class="'.$mActive.'">M</a>
      <a href="javascript:loadExpese(\'' . $section . '\', \'' . $W . '\', \'' . $sec . '\')" class="'.$wActive.'">W</a>
      <a href="javascript:loadExpese(\'' . $section . '\', \'' . $D . '\', \'' . $sec . '\')" class="'.$dActive.'">D</a>
    </div>
</div>
  <div class="ibox">
  <div class="ibox-title">
      <img src="assets/img/expense.png" alt="">
      <h3><span class="en">Expense</span><span class="ar">'. getArabicTitle('Expense') .'</span> </h3>
      <br>
  </div>
  <div class="ibox-content">
    <h1 class="no-margins" id="ExpenseValue">'.number_format($val,2).'</h1>
    <small><span class="en">Total Expense</span><span class="ar align_center">'. getArabicTitle('Total Expense') .'</span> </small>
    </div>
  </div>
';
}

echo $response;
