<?php
session_start();
$lang = $_SESSION['lang'];
?>
<!DOCTYPE html>
<html>

<head>

<meta charset="utf-8">
<meta name="viewport"
content="initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0,target-densitydpi=device-dpi, user-scalable=no" />


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
<link href="assets/css/custom.css" rel="stylesheet">
<style>
		.direction {
			<?php if ($lang == 1) {
				echo " direction: ltr;";
			} else {
				echo "direction: rtl;";
			} ?>
		}

		.direction-ltr {
			direction: ltr !important;
		}

		.direction-rtl {
			direction: rtl !important;
		}
	</style>
</head>

<body class="pace-done mini-navbar">

<div id="wrapper" class="direction">
<?php
include("top-header.php");

?>





<div id="page-wrapper" class="gray-bg">
<?php
include("sidebar.php");

?>
<div class="row wrapper border-bottom white-bg page-heading pb-2">
<div class="col-lg-12">
<h2 class="font-weight-bold"><span class="en float-left">Expense Statement</span><span class="ar float-right"><?= getArabicTitle('Expense Statement') ?></span></h2>

</div>
</div>
<div class="wrapper wrapper-content animated fadeInRight">
<div class="row mb-3">
<!-- <div class="col-md-6 col-8">
<button type="button" class="btn btn-w-m btn-default eng">English</button>
<button type="button" class="btn btn-w-m btn-default ara">Arabic</button>
</div> -->
<div class="col-12">
<button type="button" class=" btn btn-w-m btn-outline-primary float-right" id="filter"><span class="en">Filters</span><span class="ar"><?= getArabicTitle('Filters') ?></span></button>
</div>

</div>
<div class="row">
<div class="col-lg-12">
<div class="ibox">
<div class="ibox-title">
<div class="row">
<!-- <div class="col-md-9"> -->
<h5 class="mr-4"><span class="en">Filters</span><span class="ar">
<?= getArabicTitle('Filters') ?>
</span></h5>
<!-- </div> -->

</div>

<div class="ibox-tools no_envent" style="display: none">
<a class="collapse-link filter_act">
<i class="fa fa-chevron-down"></i>
</a>
</div>
</div>
<form action="" id="" method="get" class="ibox-content filter_container">
<input type="text" id="report_type" name="report_type" value="general" hidden>
<input type="number" id="selected_lang" name="selected_lang"
value="<?php !empty($_GET['selected_lang']) ? $_GET['selected_lang'] : '1' ?>" hidden>
<div class="row">
<div class="col-6">
<div class="row">
<div class="col-md-3">
<h4><span class="en">Branch Selection</span><span class="ar">
<?= getArabicTitle('Branch Selection') ?>
</span></h4>
</div>
<div class="col-md-2">
<div class="form-group">


<input type="checkbox" id="branch_all_select" name="branch_all_select" <?php if ($_GET['branch_all_select'] == 'on') {
echo "checked";
} ?> class="js-switch" />
</div>
</div>
<div class="col-md-7">
<div class="form-group">
<div>
<select id="branchs" name="branch[]" class="select2_demo_1 form-control" tabindex="4"
multiple>
<?php
$Bracnhes = Run("Select * from " . dbObject . "Branch order by BName ASC");
$ABoveBranches = $_GET['branch'];
while ($getBranches = myfetch($Bracnhes)) {
$selected = "";
if (in_array($getBranches->Bid, $ABoveBranches) && $_GET['branch_all_select'] != 'on') {
$selected = "Selected";
}
?>
<option value="<?php echo $getBranches->Bid; ?>" <?php echo $selected; ?>><?php echo $getBranches->BName; ?></option>

<?php
}

?>

</select>

</div>
</div>
</div>
</div>
</div>
<div class="col-md-6 pt-2 toggle_orderby">
<div class="row">
<div class="col-md-3">
<h4><span class="en">Report Type</span><span class="ar">
<?= getArabicTitle('Report Type') ?>
</span>
</h4>
</div>
<div class="col-md-9">
<div class="row">
<div class="col-md-4 col-6">
<div class="i-checks"><label class="">
<div class="iradio_square-green ">
<div class="iradio_square-green">
<input type="radio" <?php if ($_GET['Rtype'] == 'General' || $_GET['Rtype'] == '') {
echo 'checked="checked"';
} ?> value="General" name="Rtype">
</div>
<ins class="iCheck-helper"></ins>
</div> <i></i> <span class="en">General</span><span class="ar"><?= getArabicTitle('General') ?></span>
</label>
</div>
</div>
<div class="col-md-4 col-6">
<div class="i-checks"><label class="">
<div class="iradio_square-green ">
<div class="iradio_square-green">
<input type="radio" value="Detail" name="Rtype" <?php if ($_GET['Rtype'] == 'Detail') {
echo 'checked="checked"';
} ?>>
</div>
<ins class="iCheck-helper"></ins>
</div> <i></i> <span class="en">Detail </span><span class="ar"><?= getArabicTitle('Detail') ?></span>
</label>
</div>
</div>
</div>
</div>
</div>
</div>


<div class="col-md-3">
<div class="row">
<div class="col-md-5">
<h4><span class="en">From Bill No</span><span class="ar">
<?= getArabicTitle('From Bill No') ?>
</span></h4>
</div>
<div class="col-md-7">
<div class="form-group">
<input value="<?php echo $_GET['from_bill_no']; ?>" id="from_bill_no" name="from_bill_no"
type="text" class="form-control">

</div>
</div>
</div>
</div>
<div class="col-md-3">
<div class="row">
<div class="col-md-5">
<h4><span class="en">To Bill No </span><span class="ar">
<?= getArabicTitle('To Bill No') ?>
</span></h4>
</div>
<div class="col-md-7">
<div class="form-group"><input id="to_bill_no" value="<?php echo $_GET['to_bill_no']; ?>"
name="to_bill_no" type="text" class="form-control"></div>
</div>
</div>
</div>
<div class="col-md-3">
<div class="row">
<div class="col-md-5">
<h4><span class="en">From Date</span><span class="ar">
<?= getArabicTitle('From Date') ?>
</span>
</h4>
</div>
<div class="col-md-7">
<div class="form-group">
<div class="input-group date">
<span class="input-group-addon">
<i class="fa fa-calendar"></i></span>
<input id="from_date" name="from_date" type="text" class="form-control"
value="<?php echo $_GET['from_date'] ?>" autocomplete="off">
</div>
</div>
</div>
</div>
</div>
<div class="col-md-3">
<div class="row">
<div class="col-md-5">
<h4><span class="en">To Date</span><span class="ar">
<?= getArabicTitle('To Date') ?>
</span> </h4>
</div>
<div class="col-md-7">
<div class="form-group">
<div class="input-group date">
<span class="input-group-addon">
<i class="fa fa-calendar"></i></span>
<input id="to_date" name="to_date" type="text" class="form-control"
value="<?php echo $_GET['to_date'] ?>" autocomplete="off">
</div>
</div>
</div>
</div>
</div>










<div class="col-4">
<div class="row">
<div class="col-md-3">
<h4><span class="en">User</span><span class="ar">
<?= getArabicTitle('User') ?>
</span></h4>
</div>
<div class="col-md-2 col-4">
<div class="form-group">
<input type="text" value="<?php echo $_GET['user_id'] ?>" id="user_id" name="user_id" readonly
class="form-control">
</div>
</div>
<div class="col-md-7 col-8">
<div class="form-group">
<div>
<select id="user_name" name="user_name" class="select2_demo_1 form-control" tabindex="4"
onChange="setmyValue(this.value,'user_id')">

<?php
if (isset($_GET['user_id']) && !empty($_GET['user_id'])) {
?>
<option value="<?php echo $_GET['user_id']; ?>" selected> <?php echo getUserDetails($_GET['user_id'])->CCode; ?> -
<?php echo getUserDetails($_GET['user_id'])->CName; ?>
</option>
<?php
}
?>
</select>
</div>
</div>
</div>
</div>
</div>









<div class="col-4">
<div class="row">
<div class="col-md-3">
<h4><span class="en">Supplier</span><span class="ar">
<?= getArabicTitle('Supplier') ?>
</span>
</h4>
</div>
<div class="col-md-2 col-4">
<div class="form-group"><input id="customer_id" name="customer_id" type="text" readonly
class="form-control" value="<?php echo $_GET['customer_id'] ?>"></div>
</div>
<div class="col-md-7 col-8">
<div class="form-group">
<div>
<select id="customer_name" name="customer_name" class="select2_demo_1 form-control"
tabindex="4" onChange="setmyValue(this.value,'customer_id')">
<?php
if (isset($_GET['customer_id']) && !empty($_GET['customer_id'])) {
?>
<option value="<?php echo $_GET['customer_id']; ?>" selected>
<?php echo getCustomerDetails($_GET['customer_name'])->CName; ?>
</option>
<?php
}
?>

</select>


</div>
</div>
</div>
</div>
</div>

<div class="col-4">
<div class="row">
<div class="col-md-3">
<h4><span class="en">Expense Id</span><span class="ar">
<?= getArabicTitle('Expense Id') ?>
</span>
</h4>
</div>
<div class="col-md-2 col-4">
<div class="form-group"><input id="ExpenseId" name="ExpenseId" type="text" readonly
class="form-control" value="<?php echo $_GET['ExpenseId'] ?>"></div>
</div>
<div class="col-md-7 col-8">
<div class="form-group">
<div>

<select id="ExpenseId_Name" name="ExpenseId_Name" class="select2_demo_1 form-control"
tabindex="4" onChange="setmyValue(this.value,'ExpenseId')">
<?php
if (isset($_GET['ExpenseId']) && !empty($_GET['ExpenseId'])) {
?>

<option value="<?php echo $_GET['ExpenseId']; ?>" selected>
<?php echo getExpenseIdDetails($_GET['ExpenseId'])->Code . " - " . getExpenseIdDetails($_GET['ExpenseId'])->NameArb; ?>
</option>
<?php
}
?>


</select>


</div>
</div>
</div>
</div>
</div>







<div class="col-md-6 pt-2 toggle_groupbytype">

<div class="row">
<div class="col-md-3">
<h4><span class="en">Group By Type</span><span class="ar">
<?= getArabicTitle('Group By Type') ?>
</span>
</h4>
</div>
<div class="col-md-9">
<div class="row">
<div class="col-md-4 col-6">
<div class="i-checks"><label class="">
<div class="iradio_square-green ">
<div class="iradio_square-green">
<input type="radio" value="0" <?php if ($_GET['GroupByType'] == '' || $_GET['GroupByType'] == '0') {
echo "Checked";
} ?> name="GroupByType">
</div>
<ins class="iCheck-helper"></ins>
</div> <i></i> <span class="en">None</span><span class="ar"><?= getArabicTitle('None') ?></span>
</label>
</div>
</div>
<div class="col-md-4 col-6">
<div class="i-checks"><label class="">
<div class="iradio_square-green ">
<div class="iradio_square-green">
<input type="radio" value="1" name="GroupByType" <?php if ($_GET['GroupByType'] == '1') {
echo "Checked";
} ?>>
</div>
<ins class="iCheck-helper"></ins>
</div> <i></i> <span class="en">Expense </span><span class="ar"><?= getArabicTitle('Expense') ?></span>
</label>
</div>
</div>
<div class="col-md-4 col-6">
<div class="i-checks"><label class="">
<div class="iradio_square-green ">
<div class="iradio_square-green">
<input type="radio" value="2" name="GroupByType" <?php if ($_GET['GroupByType'] == '2') {
echo "Checked";
} ?>>
</div>
<ins class="iCheck-helper"></ins>
</div> <i></i> <span class="en">Bill Date</span><span class="ar"><?= getArabicTitle('Bill Date') ?></span>
</label>
</div>
</div>
</div>
</div>
</div>
</div>





<div class="col-12 row justify-content-center mt-5">
<div class="col-md-2"><button type="button" class="btn btn-block btn-lg btn-outline-danger"
onClick="location.reload()"><span class="en">Exit</span><span class="ar">
<?= getArabicTitle('Exit') ?>
</span>
</button>
</div>
<div class="col-md-2">
<button type="submit" class="btn btn-block btn-lg btn-outline-success" id="seles_report_search"
value="Search"><span class="en">Search</span><span class="ar"><?= getArabicTitle('Search') ?></span>
</button>
</div>
</div>
</div>
</div>
</form>
</div>
</div>
</div>

<?php
if (isset($_GET['report_type']) && $_GET['report_type'] == 'general') {
?>
<div class="ibox">
<h2><span class="en float-left">General</span><span class="ar float-right"><?= getArabicTitle('General') ?></span></h2>
<div class="ibox-content this_ar">

<div class="table-responsive">


<div class="row">
<div class="col-lg-12" id="sales_report">

<?php
include('newpagination/paginator.class.php');

if (isset($_GET['transaction_type'])) {
$transaction_type = urldecode($_GET['transaction_type']);
$SpType = $transaction_type;

}




////////// Form Filters/////
//////////////// Branches Filter//////////////
if (isset($_GET['branch']) && !empty($_GET['branch'])) {
$branch = $_GET['branch'];
if (empty($branch)) {
$branchesArray = array();
$Bracnhes = Run("Select * from " . dbObject . "Branch order by BName ASC");
while ($getBranches = myfetch($Bracnhes)) {
array_push($branchesArray, $getBranches->Bid);
}
$branchIds = implode(",", $branchesArray);
} else {
$branchIds = implode(",", $branch);
}

$bid = $branchIds;
}
if (empty($_GET['branch'])) {
$branchesArray = array();
$Bracnhes = Run("Select * from " . dbObject . "Branch order by BName ASC");
while ($getBranches = myfetch($Bracnhes)) {
array_push($branchesArray, $getBranches->Bid);
}
$branchIds = implode(",", $branchesArray);
$bid = $branchIds;

}













if (isset($_GET['from_date']) && !empty($_GET['from_date'])) {
$from_date = urldecode($_GET['from_date']);
$from_date = date("Y-m-d", strtotime($from_date));
$dt = $from_date;
}






if (isset($_GET['to_date']) && !empty($_GET['to_date'])) {
$to_date = urldecode($_GET['to_date']);
$to_date = date("Y-m-d", strtotime($to_date));
$dt2 = $to_date;


}



if (isset($_GET['from_bill_no']) && !empty($_GET['from_bill_no'])) {
$from_bill_no = urldecode($_GET['from_bill_no']);
$FBillno = $from_bill_no;


}

if (isset($_GET['to_bill_no']) && !empty($_GET['to_bill_no'])) {
$to_bill_no = urldecode($_GET['to_bill_no']);
$TBillno = $to_bill_no;
}

if (isset($_GET['customer_id']) && !empty($_GET['customer_id'])) {
$customer_id = urldecode($_GET['customer_id']);
$CustSupId = $customer_id;
}

if (isset($_GET['user_id']) && !empty($_GET['user_id'])) {
$user_id = urldecode($_GET['user_id']);
$UsrId = $user_id;
}

if (isset($_GET['ExpenseId']) && !empty($_GET['ExpenseId'])) {
$ExpenseId = urldecode($_GET['ExpenseId']);
$ExpenseId = $ExpenseId;
}





$LanguageId = $_GET['selected_lang'];


$distinct = "";
$GrB = "";
$SpType = !empty($SpType) ? $SpType : '0';
$FBillno = !empty($FBillno) ? $FBillno : '0';
$TBillno = !empty($TBillno) ? $TBillno : '0';

$Rtype = !empty($_GET['Rtype']) ? $_GET['Rtype'] : 'General';
$GroupByType = !empty($_GET['GroupByType']) ? $_GET['GroupByType'] : '0';

$dt = !empty($dt) ? $dt : NULL;
$dt2 = !empty($dt2) ? $dt2 : NULL;
$CustSupId = !empty($CustSupId) ? $CustSupId : '0';
$ExpenseId = !empty($ExpenseId) ? $ExpenseId : '0';
$UsrId = !empty($UsrId) ? $UsrId : '0';


$LanguageId = !empty($LanguageId) ? $LanguageId : '1';



//Main query

$pages = new Paginator;


if ($Rtype == 'General') {
include("include/reports/expense_report/general.php");

}


if ($Rtype != 'General') {
$GroupByType = 0;
include("include/reports/expense_report/detail.php");

}





?>













</div>
</div>

</div>

</div>
</div>
<?php
}
?>





<?php
include("footer.php");
?>
</div>
</div>
</div>
</div>





</body>

</html>
<script src="include/reports/expense_report/js.js"></script>
<?php
if (isset($_GET['report_type']) && $_GET['report_type'] == 'general') {
?>
<script>
$(document).ready(function () {

$(".filter_act").click();
$(".no_envent").toggleClass("displayB");
});
</script>

<?php
}
?>