<!DOCTYPE html>
<html>

<head>

<meta charset="utf-8">
<meta name="viewport"
content="initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0,target-densitydpi=device-dpi, user-scalable=no"/>


<title>Dashboard</title>

<link href="assets/css/bootstrap.min.css" rel="stylesheet">
<link href="assets/font-awesome/css/font-awesome.css" rel="stylesheet">
<link href="assets/css/animate.css" rel="stylesheet">
<link href="assets/css/style.css" rel="stylesheet">
<!-- Data Table -->
<link href="assets/css/plugins/dataTables/datatables.min.css" rel="stylesheet">
<!-- Date  -->
<link href="assets/css/plugins/datapicker/datepicker3.css" rel="stylesheet">
<link href="assets/css/plugins/iCheck/custom.css" rel="stylesheet">
<!-- Clock  -->
<link href="assets/css/plugins/clockpicker/clockpicker.css" rel="stylesheet">
<!-- Chosen -->
<link href="assets/css/plugins/chosen/bootstrap-chosen.css" rel="stylesheet">
<!-- Toastr style -->
<link href="assets/css/plugins/toastr/toastr.min.css" rel="stylesheet">
<!-- Select 2 -->
<link href="assets/css/plugins/select2/select2.min.css" rel="stylesheet">
<!-- Swithcer -->
<link href="assets/css/plugins/switchery/switchery.css" rel="stylesheet">
<!-- Animate Css -->
<link href="assets/css/animate.css" rel="stylesheet">

</head>

<body class="pace-done mini-navbar">

<div id="wrapper">
<?php
include("top-header.php");

?>


<div id="page-wrapper" class="gray-bg">
<?php
include("sidebar.php");

?>

<div class="wrapper wrapper-content animated fadeInRight">
<div class="row">
<div class="col-lg-12">

<div class="row">
<div class="col-md-4">

</div>

<div class="col-md-8">
<div class="form-group">
<div>	
<select id="branchs" name="branc"
class="select2_demo_1 form-control" tabindex="4" onChange="loadHomePage(this.value)">
<?php
if($_SESSION['isAdmin']=='1')
{
$Bracnhes = Run("Select * from " . dbObject . "Branch order by BName ASC");
echo '<option value="">All</option>';
}
else
{
$Bracnhes = Run("Select ".dbObject."Branch.Bid,".dbObject."Branch.BName from " . dbObject . "Branch
Inner JOIN ".dbObject."EMP  On ".dbObject ."EMP.BID = ".dbObject."Branch.Bid
where ".dbObject."EMP.WebCode = '".$_SESSION['code']."' "); 
}
$ABoveBranches = $_GET['branch'];
while ($getBranches = myfetch($Bracnhes)) {
$selected = "";

if($_GET['branc']!='')
{
if (($getBranches->Bid == $_GET['branc']) ) {
$selected = "Selected";
}}
?>
<option value="<?php echo $getBranches->Bid; ?>" <?php echo $selected; ?> ><?php echo $getBranches->BName; ?></option>

<?php
}

?>

</select>

</div>
</div>
</div>
</div>
<?php
/// Customers Count/////
$condition = " Where isDeleted = 0";
if ($_GET['branc'] == '') {
	if($_SESSION['isAdmin'] == 0){
		$Bracnhes = Run("Select ".dbObject."Branch.Bid,".dbObject."Branch.BName from " . dbObject . "Branch
Inner JOIN ".dbObject."EMP  On ".dbObject ."EMP.BID = ".dbObject."Branch.Bid
where ".dbObject."EMP.WebCode = '".$_SESSION['code']."' "); 
		$userBranch = myfetch($Bracnhes);
		
		$condition .= " And bid = '$userBranch->Bid'";
	}
	else{
		$condition .= " And bid != ''";
	}
}
if ($_GET['branc'] != '') {
$condition .= " And bid = '" . $_GET['branc'] . "'";
}
$queryForCustomers = Run("Select count(CId) as tlo from " . dbObject . "CustFile  $condition");
$getCustomersCount = myfetch($queryForCustomers)->tlo;

$queryForSuppliers = Run("Select count(CId) as tlo from " . dbObject . "SupplierFile  $condition");
$getSuppliersCount = myfetch($queryForSuppliers)->tlo;

if($_SESSION['isAdmin'] == 1){
	$bid = !empty($_GET['branc']) ? $_GET['branc'] : '0';
}
else{
	$bid = !empty($_GET['branc']) ? $_GET['branc'] : $userBranch->Bid;
}
//// Total 	[TotalReceivables] ////
$TotalReceivables = Run("EXEC  " . dbObject . "TotalReceivables @BID='" . $bid . "'");
$TotalReceivables = myfetch($TotalReceivables)->TotalReceivables;
//// Total 	[TotalReceivables] ////
$TotalPayables = Run("EXEC  " . dbObject . "TotalPayables @BID='" . $bid . "'");
$TotalPayables = myfetch($TotalPayables)->TotalPayables;

$currentDate = date("m/d/Y");
$abc = "EXEC  " . dbObject . "TotalSales @BID='" . $bid . "',@FromDate ='" . $currentDate . "',@ToDate ='" . $currentDate . "'";
$TotalSales = Run($abc);
$TotalSales = myfetch($TotalSales)->TotalSales;

$abc = "EXEC  " . dbObject . "TotalSalesProfit @BID='" . $bid . "',@FromDate ='" . $currentDate . "',@ToDate ='" . $currentDate . "'";
$TotalSalesProfit = Run($abc);
$TotalSalesProfit = myfetch($TotalSalesProfit)->TotalSalesProfit;


$abc = "EXEC  " . dbObject . "TotalExpense @BID='" . $bid . "',@FromDate ='" . $currentDate . "',@ToDate ='" . $currentDate . "'";
$TotalExpense = Run($abc);
$TotalExpense = myfetch($TotalExpense)->TotalExpense;

$date = date("Y-m-d");
 $StockReportQ = Run("select " . dbObject . "GetProductClosingBalanceNew($bid,2023-15-5,'1') as tlo");
$TotalStock = myfetch($StockReportQ)->tlo;



?>


<div class="row">
<div class="col-lg-4">
<div class="ibox ">
<div class="ibox-title">
<h5>Bar Chart Example </h5>
<div class="ibox-tools">
<a class="collapse-link">
<i class="fa fa-chevron-up"></i>
</a>


</div>
</div>
<div class="ibox-content">
<div id="morris-bar-chart"></div>
</div>
</div>
</div>

<div class="col-lg-8">
<div class="row">
<div class="col-lg-4">
<div class="ibox ">
<div class="ibox-title">
<div class="ibox-tools">

<a href="javascript:LoadCalculations('Sale','salesValue','M')"><span
	class="label label-danger float-right">M</span></a>

<a href="javascript:LoadCalculations('Sale','salesValue','W')"><span
	class="label label-warning float-right">W</span></a>
<a href="javascript:LoadCalculations('Sale','salesValue','D')"><span
	class="label label-success float-right">D</span></a>

</div>
<h5>Sale</h5>
</div>
<div class="ibox-content">
<h1 class="no-margins"
id="salesValue"><?= number_format($TotalSales) ?></h1>

<small>Total Sales</small>
</div>
</div>
</div>
<div class="col-lg-4">
<div class="ibox ">
<div class="ibox-title">
<div class="ibox-tools">

<a href="javascript:LoadCalculations('SaleProfit','salesProfitValue','M')"><span
	class="label label-danger float-right">M</span></a>

<a href="javascript:LoadCalculations('SaleProfit','salesProfitValue','W')"><span
	class="label label-warning float-right">W</span></a>
<a href="javascript:LoadCalculations('SaleProfit','salesProfitValue','D')"><span
	class="label label-success float-right">D</span></a>

</div>
<h5>Sales Profit</h5>
</div>
<div class="ibox-content">
<h1 class="no-margins"
id="salesProfitValue"><?= number_format($TotalSalesProfit) ?></h1>

<small>Total Sales</small>
</div>
</div>
</div>
<div class="col-lg-4">
<div class="ibox ">
<div class="ibox-title">
<div class="ibox-tools">

<a href="javascript:LoadCalculations('Expense','ExpenseValue','M')"><span
	class="label label-danger float-right">M</span></a>

<a href="javascript:LoadCalculations('Expense','ExpenseValue','W')"><span
	class="label label-warning float-right">W</span></a>
<a href="javascript:LoadCalculations('Expense','ExpenseValue','D')"><span
	class="label label-success float-right">D</span></a>

</div>
<h5>Expense</h5>
</div>
<div class="ibox-content">
<h1 class="no-margins"
id="ExpenseValue"><?= number_format($TotalExpense) ?></h1>

<small>Total Expense</small>
</div>
</div>
</div>


<div class="col-lg-4">
<div class="ibox ">
<div class="ibox-title">

<h5>Customer</h5>
</div>
<div class="ibox-content">
<div id="carouselExampleControls2" class="carousel slide"
data-ride="carousel">
<div class="carousel-inner" style="text-align: center">
<div class="carousel-item active">
<h1 class="no-margins"><?php echo number_format($getCustomersCount); ?></h1>
<small>Total Customers</small>
</div>
<div class="carousel-item">
<h1 class="no-margins"><?= number_format($TotalReceivables) ?></h1>
<small>Total Recievables</small></div>

</div>
<!--                                                <a class="carousel-control-prev" href="#carouselExampleControls2"-->
<!--                                                   role="button" data-slide="prev"-->
<!--                                                   style="background: cadetblue;opacity: 0.2;">-->
<!--                                                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>-->
<!--                                                    <span class="sr-only">Previous</span>-->
<!--                                                </a>-->
<!--                                                <a class="carousel-control-next" href="#carouselExampleControls2"-->
<!--                                                   role="button" data-slide="next"-->
<!--                                                   style="background: cadetblue;opacity: 0.2;">-->
<!--                                                    <span class="carousel-control-next-icon" aria-hidden="true"></span>-->
<!--                                                    <span class="sr-only">Next</span>-->
<!--                                                </a>-->

</div>
<ol class="carousel-indicators" style="padding-bottom: 5px !important;">
<li data-target="#carouselExampleControls2" style="background: red;height: 10px;width: 10px;border-radius: 50px;" data-slide-to="0" class="active"></li>
<li data-target="#carouselExampleControls2" style="background: black;height: 10px;width: 10px;border-radius: 50px;" data-slide-to="1"></li>
</ol>
</div>
</div>
</div>


<div class="col-lg-4">
<div class="ibox ">
<div class="ibox-title">

<h5>Supplier</h5>
</div>
<div class="ibox-content">
<div id="carouselExampleControls3" class="carousel slide"
data-ride="carousel">
<div class="carousel-inner" style="text-align: center">
<div class="carousel-item active">
<h1 class="no-margins"><?= number_format($getSuppliersCount) ?></h1>
<small>Total Suppliers</small>
</div>
<div class="carousel-item">
<h1 class="no-margins"><?= number_format($TotalPayables) ?></h1>
<small>Total Payables</small></div>


</div>
<!--                                                <a class="carousel-control-prev" href="#carouselExampleControls3"-->
<!--                                                   role="button" data-slide="prev"-->
<!--                                                   style="background: cadetblue;opacity: 0.2;">-->
<!--                                                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>-->
<!--                                                    <span class="sr-only">Previous</span>-->
<!--                                                </a>-->
<!--                                                <a class="carousel-control-next" href="#carouselExampleControls3"-->
<!--                                                   role="button" data-slide="next"-->
<!--                                                   style="background: cadetblue;opacity: 0.2;">-->
<!--                                                    <span class="carousel-control-next-icon" aria-hidden="true"></span>-->
<!--                                                    <span class="sr-only">Next</span>-->
<!--                                                </a>-->
</div>
<ol class="carousel-indicators" style="padding-bottom: 5px !important;">
<li data-target="#carouselExampleControls3" style="background: red;height: 10px;width: 10px;border-radius: 50px;" data-slide-to="0" class="active"></li>
<li data-target="#carouselExampleControls3" style="background: black;height: 10px;width: 10px;border-radius: 50px;" data-slide-to="1"></li>
</ol>
</div>
</div>
</div>


<div class="col-lg-4">
<div class="ibox ">
<div class="ibox-title">

<h5>Stock Report</h5>
</div>
<div class="ibox-content">
<h1 class="no-margins"><?=number_format($TotalStock)?></h1>

<small>Total Value</small>
</div>
</div>
</div>


</div>

</div>


</div>
</div>

</div>

</div>
<?php
include("footer.php");
?>

</div>
</div>


</body>

</html>

<script src="assets/js/plugins/morris/raphael-2.1.0.min.js"></script>
<script src="assets/js/plugins/morris/morris.js"></script>
<script src="include/dashboard/js.js"></script>
<style>
.carousel-control-next {
border-radius: 100%;
}

.carousel-control-prev {
border-radius: 100%;

}
</style>