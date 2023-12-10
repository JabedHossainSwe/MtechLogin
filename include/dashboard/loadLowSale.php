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
$lang = $_POST['lang'];
// if($lang == "1"){
//     $style="display:block; right:10px;";
// }
// else{
//     $style="";
// }

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

$marginQuery = "EXEC  " . dbObject . "TotalSalesLowMargin @BID='" . $bid . "',@FromDate ='" . $fromDate . "',@ToDate ='" . $toDate . "'";
$margins = Run($marginQuery);
$byMarginsData = myfetch($margins);
$byMargins = $byMarginsData->TotalSalesProfit;
 $PNameMargin = $byMarginsData->PName;

$revenue = Run("EXEC  " . dbObject . "TotalSalesLowRevenue @BID='" . $bid . "',@FromDate ='" . $fromDate . "',@ToDate ='" . $toDate . "'");
$byRevenueData = myfetch($revenue);
$byRevenue = $byRevenueData->NetTotal;
 $PNameRevenue = $byRevenueData->PName;

$quantity = Run("EXEC  " . dbObject . "TotalSalesLowQty @BID='" . $bid . "',@FromDate ='" . $fromDate . "',@ToDate ='" . $toDate . "'");
$byQuantityData = myfetch($quantity);
$byQuantity = $byQuantityData->TotalQuantity;
 $PNameQty = $byQuantityData->PName;

$section = "low_sale_sec";

echo '<div class="ibox-tools">
    <div class="align-center">
        <a href="javascript:lowSale(\'' . $section . '\', \'' . $M . '\')" class="' . $mActive . '">M</a>
        <a href="javascript:lowSale(\'' . $section . '\', \'' . $W . '\')" class="' . $wActive . '">W</a>
        <a href="javascript:lowSale(\'' . $section . '\', \'' . $D . '\')" class="' . $dActive . '">D</a>
    </div>
</div>
  <div class="ibox">
  <div class="ibox-title">
      <img src="assets/img/low_scale_product.png" alt="">
      <h3><span class="en">Low Sale Product</span><span class="ar">' . getArabicTitle('Low Sale Product') . '</span> </h3>
      <br>
  </div>
    <div class="ibox-content">
    <div id="myCarouselFour" class="carousel slide" data-bs-ride="carousel">
  <div class="carousel-inner">
    <div class="carousel-item active">';
    if($PNameMargin!='')
    {
    echo '<br/>
    <small>'.$PNameMargin.'</small>
    <br/>';
    }
echo	'<h1 class="no-margins">' . number_format($byMargins) . '</h1>
	<small><span class="en">Best by Margin</span><span class="ar align_center">' . getArabicTitle('Best by Margin') . '</span></small>
    </div>
    <div class="carousel-item">';
    if($PNameRevenue!='')
    {
    echo '<br/>
    <small>'.$PNameRevenue.'</small>
    <br/>';
    }
echo '<h1 class="no-margins">' . number_format($byRevenue) . '</h1>

        <small><span class="en">Best by Revenue</span><span class="ar align_center">' . getArabicTitle('Best by Revenue') . '</span></small>
    </div>
    <div class="carousel-item">';
    if($PNameQty!='')
    {
    echo '<br/>
    <small>'.$PNameQty.'</small>
    <br/>';
    }
echo '<h1 class="no-margins">' . number_format($byQuantity) . '</h1>
 
        <small><span class="en">Best by Qty</span><span class="ar align_center">' . getArabicTitle('Best by Qty') . '</span></small>
    </div>
  </div>
  <button class="carousel-control-prev" type="button" data-bs-target="#myCarouselFour" data-bs-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Previous</span>
  </button>
  <button class="carousel-control-next" type="button" data-bs-target="#myCarouselFour" data-bs-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Next</span>
  </button>
</div>









  </div>
</div>';
