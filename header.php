<?php
session_start();
error_reporting(0);
include("config/connection.php");
include("config/main_connection.php");

if(empty($_SESSION['id']))
{
printf("<script>location.href='index.php?value=logout'</script>");
die();
}


 $page_url = basename($_SERVER['PHP_SELF']);
 $_SESSION['is_completed'];

///// Get Main Database Records//////
$myq2 = RunMain("Select * from ".dbObjectMain."Logins where email = '".$_SESSION['email']."'");

$mymaster = myfetchMain($myq2);
?>

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
<!-- orris -->
<link href="assets/css/plugins/morris/morris-0.4.3.min.css" rel="stylesheet">

<!-- Hello -->
<!-- Custom Css  !!!!! must be putt below every link  -->
<link href="assets/css/custom.css" rel="stylesheet">

<nav class="navbar navbar-expand-lg navbar-static-top" role="navigation">

<a href="home.php" class="navbar-brand">Mteck Reporting</a>
<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar" aria-expanded="false"
aria-label="Toggle navigation">
<i class="fa fa-reorder"></i>
</button>

<div class="navbar-collapse collapse" id="navbar">
<ul class="nav navbar-nav mr-auto">
<li class="active">
<a aria-expanded="false" role="button" href="home.php"> Dashboard</a>
</li>
<li class="dropdown">
<a aria-expanded="false" role="button" href="#" class="dropdown-toggle"
data-toggle="dropdown">Reports</a>
<ul role="menu" class="dropdown-menu">
<?php /*?><li><a href="report.php">Account Report</a></li>
<li><a href="report.php">Quotation Report </a></li><?php */?>
<li><a href="sale_report_type.php">Sales Report </a></li>
<?php /*?><li><a href="report.php">Missing Pos Invoice </a></li>
<li><a href="report.php">Sales Quantity Movement Summery Report</a></li><?php */?>
<li><a href="sale_return_report_type.php">Sales Return</a></li>
<?php /*?><li><a href="report.php">Stock Receiving Report </a></li>
<li><a href="report.php">Purchase Order Report </a></li><?php */?>
<li><a href="purchase_report_type.php">Purchase Report </a></li>
<li><a href="purchase_return_report_type.php">Purchase Return Report </a></li>
<?php /*?><li><a href="report.php">Stock Report </a></li>
<li><a href="report.php">Product List </a></li>
<li><a href="report.php">Product Promotion </a></li><?php */?>
<li><a href="supplier_issue_report.php">Issue Payments Report </a></li>
<li><a href="customer_issue_report.php">Issue Reciept Report </a></li>
<li><a href="supplier_account_statement.php">Supplier Account Statement</a></li>
<li><a href="supplier_balance_report.php">All Suppliers Balance Report </a></li>
<?php /*?><li><a href="report.php">Suppliers Detail Balance Report </a></li>
<li><a href="report.php">Customer Account Statemnet </a></li><?php */?>
<li><a href="customer_balance_report.php">All Customers Balance Report </a></li>
<?php /*?><li><a href="report.php">Customer Detail Balance Report </a></li>
<li><a href="report.php">Transfer And Redeye Report </a></li>
<li><a href="report.php">Product Transaction </a></li><?php */?>
<li><a href="expense_report.php">Expense Report </a></li>
	
<li><a href="product_stock_report.php">Product Stock Report </a></li>	
<li><a href="sale_profit_calculation.php">Sale Profit Calculation </a></li>		
	
<?php /*?><li><a href="report.php">Delivery Note Report </a></li><?php */?>
</ul>
</li>
<li class="dropdown">
<a aria-expanded="false" role="button" href="#" class="dropdown-toggle" data-toggle="dropdown"> Vat
Reports</a>
<ul role="menu" class="dropdown-menu">
<li><a href="report.php">Vat Report</a></li>
<li><a href="report.php">Vat Detail Report</a></li>
<li><a href="report.php">Vat Report(Sales)</a></li>
<li><a href="report.php">Vat Report(Purchase)</a></li>
</ul>
</li>
</ul>
</div>
<div class="dropdown profile-element">
<img alt="image" class="rounded-circle" src="/<?=$mymaster->img?>">
<a data-toggle="dropdown" class="dropdown-toggle" href="#">
<span class="block m-t-xs font-bold"><?=$mymaster->name?></span>
</a>
<ul class="dropdown-menu animated fadeInRight m-t-xs">
<li><a class="dropdown-item" href="profile.php">Profile</a></li>
<li class="dropdown-divider"></li>
<li><a class="dropdown-item" href="logout.php">Logout</a></li>
</ul>
</div>
</nav>