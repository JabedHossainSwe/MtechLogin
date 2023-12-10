<?php
session_start();
$lang = $_SESSION['lang'];
?>
<!DOCTYPE html>
<html>

<head>

<meta charset="utf-8">
<meta name="viewport" content="initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0,target-densitydpi=device-dpi, user-scalable=no" />


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
<?php include("top-header.php"); ?>

<div id="page-wrapper" class="gray-bg">
<?php
include("sidebar.php");
// Get Max Sale Voucher Id..
if ($_SESSION['isAdmin'] == 0) {
$Bracnhes = Run("Select " . dbObject . "Branch.Bid," . dbObject . "Branch.BName from " . dbObject . "Branch Inner JOIN " . dbObject . "EMP  On " . dbObject . "EMP.BID = " . dbObject . "Branch.Bid where " . dbObject . "EMP.WebCode = '" . $_SESSION['code'] . "' ");
$userBranch = myfetch($Bracnhes);

$condition = " Where bid = '$userBranch->Bid'";
} else {
$condition .= " Where bid = '" . GetMainBranch() . "'";
}

$QueryMax = Run("Select max(Billno) as Bno from " . dbObject . "DataIn $condition");
$getBillNo = myfetch($QueryMax)->Bno + 1;

$getCurrentEmpData = getCurrentEmpData($_SESSION['storeCode']);
$bid = $getCurrentEmpData->BID;

$bidValue =  GetMainBranch();
if ($_SESSION['isAdmin'] == 0) {
$bidValue = $userBranch->Bid;
}
?>

<div class="wrapper wrapper-content animated fadeInRight">
<!-- <div class="row mb-1">
<div class="col-md-6 col-8">
<button type="button" class="btn btn-w-m btn-default eng">English</button>
<button type="button" class="btn btn-w-m btn-default ara">Arabic</button>
</div>
<div class="col-md-6 col-4">
</div>
</div> -->

<div id="editVoucher">
<form action="javascript:SaveSalesVoucher()" id="sales_report_form" method="post" class="ibox-content">
<div class="row direction">
<div class="col-lg-12">
<div class="ibox">
<div class="ibox-title">
<div class="row">
<div class="col-md-12">
<h5 class="mr-4 float-left en">Purchase Voucher</h5>
<h5 class="mr-4 float-right ar"><?= getArabicTitle('Purchase Voucher') ?></h5>
</div>
</div>
</div>



<!------First Line------>
<div class="row d-flex justify-content-start mb-2 pl-4">


<div class="col-6">
<div class="row">
<div class="col-md-4">
<h4><span class="en">Branch</span><span class="ar"><?= getArabicTitle('Branch') ?></span>
</h4>
</div>
<div class="col-md-8">
<select id="Bid" name="Bid" class="grpreq select2_demo_1 form-control" tabindex="4" required onChange="loadBanksagainstBrank(this.value), getBillNo(this.value)">
	<?php
	if ($_SESSION['isAdmin'] == '1') {
		$Bracnhes = Run("Select * from " . dbObject . "Branch order by BName ASC");
	} else {
		$Bracnhes = Run("Select " . dbObject . "Branch.Bid," . dbObject . "Branch.BName from " . dbObject . "Branch Inner JOIN " . dbObject . "EMP  On " . dbObject . "EMP.BID = " . dbObject . "Branch.Bid where " . dbObject . "EMP.WebCode = '" . $_SESSION['code'] . "' ");
	}

	while ($getBranches = myfetch($Bracnhes)) {
		$selected = "";
		// if ($_GET['branc'] != '') {
		if ($getBranches->ismain == '1') {
			$selected = "Selected";
		}
		// }
	?>
		<option value="<?php echo $getBranches->Bid; ?>" <?php echo $selected; ?>><?php echo $getBranches->BName; ?></option>
	<?php
	} ?>

</select>
</div>
</div>
</div>

<!-- <div class="col-md-8 d-flex justify-content-start"> -->

<div class="col-md-6 row">
<div class="col-3">
<h4><span class="en">Bill No</span><span class="ar"><?= getArabicTitle('Bill No') ?></span></h4>
</div>
<div class="form-group col-3">
<input value="<?= $getBillNo ?>" id="bill_no" name="bill_no" type="text" class="form-control">
</div>

<div class="col-6">
<button type="button" class="btn btn-success" onclick="reloadVoucher()"><i class="fa fa-refresh"></i></button>

<?php
$qt = "select BillNo from datain where BillNo = (select max(BillNo) from datain where BillNo < '" . $getBillNo . "' and Bid='" . $bidValue . "' and isDeleted = 0) and Bid = '" . $bidValue . "' and isDeleted = 0";
$previousQuery = Run($qt);
$getPreviousId = myfetch($previousQuery)->BillNo;
if ($getPreviousId != '') { ?>
<button type="button" class="btn btn-success" onclick="editVoucher('<?= $bidValue ?>','<?= $getPreviousId ?>')"><i class="fa fa-backward"></i></i></button>
<?php } ?>

<button type="button" class="btn btn-success" onclick="" disabled><i class="fa fa-forward"></i></i></button>
<button type="button" class="btn btn-success" onclick="" disabled><i class="fa fa-trash"></i></button>
<button type="button" class="btn btn-success" onclick="" disabled><i class="fa fa-print"></i></button>
<button type="button" class="btn btn-success" onclick="" disabled><i class="fa fa-plus"></i></button>
</div>
</div>


</div>

<!--------Second Line------>
<div class="row d-flex justify-content-start mb-2 pl-4">
<div class="col-4">
<div class="row d-flex justify-content-evenly">

<div class="col-md-6 col-6">
<div class="i-checks"><label class="">
		<div class="iradio_square-green ">
			<div class="iradio_square-green">
				<input type="radio" value="1" class="SPType" name="SPType" checked>
			</div>
			<ins class="iCheck-helper"></ins>
		</div>
		<i></i> <span class="en">Cash</span><span class="ar"><?= getArabicTitle('Cash') ?></span>
	</label>
</div>
</div>

<div class="col-md-6 col-6">
<div class="i-checks"><label class="">
		<div class="iradio_square-green ">
			<div class="iradio_square-green">
				<input type="radio" value="2" class="SPType" name="SPType">
			</div>
			<ins class="iCheck-helper"></ins>
		</div>
		<i></i> <span class="en">Credit</span><span class="ar"><?= getArabicTitle('Credit') ?></span>
	</label>
</div>
</div>



</div>
</div>

<div class="col-4">
<div class="row">
<div class="col-4">
<h4><span class="en">Purchaser</span><span class="ar"><?= getArabicTitle('Purchaser') ?></span></h4>
</div>
<div class="col-2">
<div class="form-group"><input id="Pur_id" name="Pur_id" type="text" class="form-control" value="" readonly></div>
</div>
<div class="col-6">
<div class="form-group">
	<div>
		<select id="Pur_name" name="Pur_name" class="select2_demo_1 form-control" tabindex="4" onChange="setmyValue(this.value,'Pur_id');">

			?>
		</select>
	</div>
</div>
</div>
</div>

</div>
<!-----First CHild---->
<div class="col-4">
<div class="row">
<div class="col-4">
<h4><span class="en">Bill Date/Time</span><span class="ar"><?= getArabicTitle('Bill Date/Time') ?></span></h4>
</div>
<div class="col-8">
<div class="form-group">
	<input id="bill_date_time" name="bill_date_time" type="date" value="<?= date("Y-m-d") ?>" class="form-control">
</div>
</div>
</div>
</div>

</div>
<div class="row d-flex justify-content-start mb-2 pl-4">

<!-------Sec CHild-------->

<div class="col-4">
<div class="row">
<div class="col-4">
<h4><span class="en">Purchase Type</span><span class="ar"><?= getArabicTitle('Purchase Type') ?></span></h4>
</div>
<div class="col-2">
<div class="form-group"><input id="PurType" name="PurType" type="text" class="form-control" value="" readonly></div>
</div>
<div class="col-6">
<div class="form-group">
	<div>
		<select id="PurType_name" name="PurType_name" class="select2_demo_1 form-control" tabindex="4" onChange="setmyValue(this.value,'PurType');">

			?>
		</select>
	</div>
</div>
</div>
</div>

</div>

<!--------Remarks------>
<div class="col-4">
<div class="row">
<div class="col-4">
<h4><span class="en">Remarks</span><span class="ar"><?= getArabicTitle('Remarks') ?></span>
</h4>
</div>
<div class="col-8">
<div class="form-group">
	<input value="" type="text" id="remarks" name="remarks" class="form-control">
</div>
</div>
</div>
</div>

<!---------FOurth CHild-->
<div class="col-md-4">
<div class="row">
<div class="col-4">
<h4><span class="en">P.O No.</span><span class="ar"><?= getArabicTitle('P.O No.') ?></span>
</h4>
</div>
<div class="col-6">
<div class="form-group">
	<input type="text" id="poNo" name="poNo" class="form-control">
</div>
</div>
<div class="col-md-2">
<button type="button" class="btn btn-success" onclick="CheckPurchaseOrderBill()"><i class="fa fa-refresh"></i></button>
</div>
</div>
</div>
</div>

<!--------third Line------>
<div class="row d-flex justify-content-start mb-2 pl-4">
<div class="col-4">
<div class="row">
<div class="col-4">
<h4><span class="en">Supplier Id</span><span class="ar"><?= getArabicTitle('Supplier Id') ?></span>
</h4>
</div>
<div class="col-2">
<div class="form-group"><input id="supplier_id" name="supplier_id" type="text" class="form-control" readonly></div>
</div>
<div class="col-6">
<div class="form-group">
	<div>
		<select id="supplier_name" name="supplier_name" class="select2_demo_1 form-control" tabindex="4" onchange="setmyValue(this.value,'supplier_id');">
		</select>
	</div>
</div>
</div>
</div>
</div>
<!--------Dis %------>
<div class="col-4">
<div class="row">
<div class="col-4">
<h4><span class="en">Dis %</span><span class="ar">%<?= getArabicTitle('Dis') ?></span>
</h4>
</div>
<div class="col-8">
<div class="form-group">
	<input type="text" id="dis_per" name="dis_per" class="form-control">
</div>
</div>

</div>
</div>

<!--------Due ------>
<div class="col-4">
<div class="row">
<div class="col-4">
<h4><span class="en">Due</span><span class="ar"><?= getArabicTitle('Due') ?></span>
</h4>
</div>
<div class="col-8">
<div class="form-group">
	<input type="number" id="due" name="due" class="form-control">
</div>
</div>

</div>
</div>
</div>


<!--------Fourth Line------>
<div class="row d-flex justify-content-start mb-2 pl-4">

<!-------- Due Date------>

<div class="col-4">
<div class="row">
<div class="col-4">
<h4><span class="en">Due Date</span><span class="ar"><?= getArabicTitle('Due Date') ?></span>
</h4>
</div>
<div class="col-8">
<div class="form-group">
	<input value="" id="due_date" name="due_date" type="date" class="form-control">
</div>
</div>

</div>
</div>

<!-------Thrid CHild-->
<div class="col-md-4">
<div class="row">
<div class="col-4">
<h4><span class="en">Ref. No</span><span class="ar"><?= getArabicTitle('Ref. No') ?></span></h4>
</div>
<div class="col-8">
<div class="form-group">
	<input type="text" id="RefNo1" name="RefNo1" class="form-control">
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>

<div id="bill_no_area"></div>

<div class="row">
<div class="col-lg-12">
<div class="ibox">
<div class="ibox-content filter_container">

<div class="row" style="display:block; overflow-x:scroll;">
<div style="width: 120rem;">
<table class="table table-bordered m-0 direction">
<thead>
	<tr>
		<th><span class="en">Code</span><span class="ar"><?= getArabicTitle('Code') ?></span></th>
		<th><span class="en">Product</span><span class="ar"><?= getArabicTitle('Product') ?></span></th>
		<th><span class="en">Unit</span><span class="ar"><?= getArabicTitle('Unit') ?></span></th>
		<th><span class="en">Qty</span><span class="ar"><?= getArabicTitle('Qty') ?></span></th>
		<th><span class="en">Bonus</span><span class="ar"><?= getArabicTitle('Bonus') ?></span></th>
		<th><span class="en">Price</span><span class="ar"><?= getArabicTitle('Price') ?></span></th>
		<th><span class="en">Total</span><span class="ar"><?= getArabicTitle('Total') ?></span></th>
		<th><span class="en">Disc %</span><span class="ar">% <?= getArabicTitle('Disc') ?></span></th>
		<th><span class="en">Disc.</span><span class="ar"><?= getArabicTitle('Disc.') ?></span></th>
		<th><span class="en">Net Total</span><span class="ar"><?= getArabicTitle('Net Total') ?></span></th>
		<th><span class="en">CCP</span><span class="ar"><?= getArabicTitle('CCP') ?></span></th>
		<th><span class="en">ACP</span><span class="ar"><?= getArabicTitle('ACP') ?></span></th>
		<th><span class="en">SC %</span><span class="ar">% <?= getArabicTitle('SC') ?></span></th>
		<th><span class="en">S. Price</span><span class="ar"><?= getArabicTitle('S. Price') ?></span></th>
		<th><span class="en">L. Price</span><span class="ar"><?= getArabicTitle('L. Price') ?></span></th>
		<th><span class="en">Vat %</span><span class="ar">% <?= getArabicTitle('Vat') ?></span></th>
		<th><span class="en">Vat Amt</span><span class="ar"><?= getArabicTitle('Vat Amt') ?></span></th>
		<th><span class="en">Vat Total</span><span class="ar"><?= getArabicTitle('Vat Total') ?></span></th>
		<th><span class="en">Vat + Total</span><span class="ar"><?= getArabicTitle('Vat + Total') ?></span></th>
		<th><span class="en">Action</span><span class="ar"><?= getArabicTitle('Action') ?></span></th>

	</tr>
</thead>
<tbody>
	<tr>
		<td style="width:4%">
			<input type="text" id="code" onkeyup="fetchProductDetailsFromCode(this.value, '')" class="form-control">
		</td>
		<td style="width:10%" id="getProductList">
			<select id="product" class="select2_demo_1 form-control" tabindex="4" onChange="setmyValue(this.value,'code'); fetchProductDetailsFromCode(this.value, '')">
			</select>
		</td>
		<td style="width:5%" id="loadUnits">

			<select id="unit" class="form-control" tabindex="4">
			</select>
		</td>

		<td style="width: 5%">
			<input type="text" id="qty" class="form-control" value="" onkeyup="salesAddRowCalculations();ACPcalculations();">

		</td>
		<td style="width: 5%">
			<input type="text" id="bonus" class="form-control" value="0" onkeyup="ACPcalculations();">

		</td>
		<td style="width: 5%">
			<input type="text" id="price" class="form-control" value="0" onkeyup="salesAddRowCalculations();ACPcalculations();">

		</td>
		<td style="width: 5%">
			<input type="text" id="total" class="form-control" value="0">

		</td>
		<td style="width: 5%">
			<input type="text" id="disPer" class="form-control" value="0" onkeyup="salesAddRowCalculations();ACPcalculations();">
		</td>

		<td style="width: 5%">
			<input type="text" id="disAmt" class="form-control" value="0" onkeyup="calculateDisPer();ACPcalculations();">

		</td>
		<td style="width: 5%">
			<input type="text" id="net_total" class="form-control" value="0" readonly>
		</td>
		<td style="width: 5%">
			<input type="text" id="cpp" class="form-control" value="0" readonly>
		</td>
		<td style="width: 5%">
			<input type="text" id="acp" class="form-control" value="0" readonly>
		</td>
		<td style="width: 5%">
			<input type="text" id="SCPer" class="form-control" value="0" onkeyup="calculateSPrice()">
		</td>
		<td style="width: 5%">
			<input type="text" id="SPrice" class="form-control" value="0">

		</td>
		<td style="width: 5%">
			<input type="text" id="lprice" class="form-control" value="0">

		</td>
		<td style="width: 5%">
			<input type="text" id="vatPer" class="form-control" value="0" onkeyup="salesAddRowCalculations()" readonly>

		</td>
		<td style="width: 5%">
			<input type="text" id="vatAmt" class="form-control" value="0" readonly>

		</td>
		<td style="width: 5%">
			<input type="text" id="vattotal" class="form-control" value="0" readonly>

		</td>
		<td style="width: 18%">
			<input type="text" id="grand_total" class="form-control" value="0" readonly>

		</td>


		<td id="action_id">
			<button type="button" name="add_row" id="add_row" class="btn btn-info" onclick="addRow()">Add</button>
		</td>
		<input type="hidden" id="Pid" name="Pid" value="">
		<input type="hidden" id="altCode" name="altCode" value="">
		<input type="hidden" id="actPrice" name="actPrice" value="">
		<input type="hidden" id="EmpID" name="EmpID" value="">
		<input type="hidden" id="ResEmpID" name="ResEmpID" value="">
		<input type="hidden" id="CPrice" name="CPrice" value="">
		<input type="hidden" id="IsStockCount" name="IsStockCount" value="">
		<input type="hidden" id="vatPTotal" name="vatPTotal" value="">
		<input type="hidden" id="unit_name" name="unit_name" value="">
		<input type="hidden" id="vatSprice" name="vatSprice" value="">
		<input type="hidden" id="CostPrice" name="CostPrice" value="">
		<input type="hidden" id="LSPrice" name="LSPrice" value="">
	</tr>

</tbody>
</table>
</div>
</div>


<div style="background: #80808014;   margin-top:1rem;">
<table class="table table-bordered direction">
<thead>
<tr>
	<th>#</th>
	<th><span class="en">Code</span><span class="ar"><?= getArabicTitle('Code') ?></span></th>
	<th><span class="en">Product</span><span class="ar"><?= getArabicTitle('Product') ?></span></th>
	<th><span class="en">Unit</span><span class="ar"><?= getArabicTitle('Unit') ?></span></th>
	<th><span class="en">Qty</span><span class="ar"><?= getArabicTitle('Qty') ?></span></th>
	<th><span class="en">Bonus</span><span class="ar"><?= getArabicTitle('Bonus') ?></span></th>
	<th><span class="en">Price</span><span class="ar"><?= getArabicTitle('Price') ?></span></th>
	<th><span class="en">Total</span><span class="ar"><?= getArabicTitle('Total') ?></span></th>
	<th><span class="en">Disc %</span><span class="ar">% <?= getArabicTitle('Disc') ?></span></th>
	<th><span class="en">Disc.</span><span class="ar"><?= getArabicTitle('Disc.') ?></span></th>
	<th><span class="en">Net Total</span><span class="ar"><?= getArabicTitle('Net Total') ?></span></th>
	<th><span class="en">CCP</span><span class="ar"><?= getArabicTitle('CCP') ?></span></th>
	<th><span class="en">ACP</span><span class="ar"><?= getArabicTitle('ACP') ?></span></th>
	<th><span class="en">SC %</span><span class="ar">% <?= getArabicTitle('SC') ?></span></th>
	<th><span class="en">S. Price</span><span class="ar"><?= getArabicTitle('S. Price') ?></span></th>
	<th><span class="en">L. Price</span><span class="ar"><?= getArabicTitle('L. Price') ?></span></th>
	<th><span class="en">Vat %</span><span class="ar">% <?= getArabicTitle('Vat') ?></span></th>
	<th><span class="en">Vat Amt</span><span class="ar"><?= getArabicTitle('Vat Amt') ?></span></th>
	<th><span class="en">Vat Total</span><span class="ar"><?= getArabicTitle('Vat Total') ?></span></th>
	<th><span class="en">Vat + Total</span><span class="ar"><?= getArabicTitle('Vat + Total') ?></span></th>
	<th><span class="en">Action</span><span class="ar"><?= getArabicTitle('Action') ?></span></th>
</tr>
</thead>
<tbody id="row_append">

</tbody>
</table>

</div>

</div>
</div>
</div>
</div>


<div class="row">
<div class="col-lg-12">
<div class="ibox">
<div class="ibox-content direction">
<div class="row">
<div class="col">
<div class="row">
<div class="col-md-4 d-flex justify-content-end">
	<h4><span class="en">Total</span><span class="ar"><?= getArabicTitle('Total') ?></span></h4>
</div>
<div class="col-md-8">
	<div class="form-total_int">
		<input value="0" id="f_total_int" name="f_total_int" type="text" readonly class="form-control">
	</div>
</div>
</div>
</div>
<div class="col">
<div class="row">
<div class="col-md-4 d-flex justify-content-end">
	<h4><span class="en">Dis%</span><span class="ar">%<?= getArabicTitle('Dis') ?></span></h4>
</div>
<div class="col-md-8">
	<div class="form-group">
		<input value="0" id="f_dis_per" name="f_dis_per" type="text" class="form-control" onkeyup="salesTotalDiscountCalculation()">
	</div>
</div>
</div>
</div>
<div class="col">
<div class="row">
<div class="col-md-4 d-flex justify-content-end p-0 m-0">
	<h4><span class="en">Dis Amount</span><span class="ar"><?= getArabicTitle('Dis Amount') ?></span></h4>
</div>
<div class="col-md-8">
	<div class="form-group">
		<input value="0" id="f_dis_amt" name="f_dis_amt" type="text" class="form-control" onkeyup="salesTotalDiscountCalculationWithAMount()">
	</div>
</div>
</div>
</div>
<div class="col">
<div class="row">
<div class="col-md-4 d-flex justify-content-end m-0 p-0">
	<h4><span class="en">Net Total</span><span class="ar"><?= getArabicTitle('Net Total') ?></span></h4>
</div>
<div class="col-md-8">
	<div class="form-group">
		<input value="0" id="f_net_total" name="f_net_total" type="text" class="form-control" onkeyup="salesTotalDiscountCalculationWithAMount()">
	</div>
</div>
</div>
</div>
<div class="col">
<div class="row">
<div class="col-md-4 d-flex justify-content-end m-0 p-0">
	<h4><span class="en">Total VAT</span><span class="ar"><?= getArabicTitle('Total Vat') ?></span></h4>
</div>
<div class="col-md-8">
	<div class="form-total_int">
		<input value="0" id="f_total_vat" name="f_total_vat" type="text" readonly class="form-control">
		<input value="0" id="initial_total_vat" name="initial_total_vat" type="hidden" class="form-control">
	</div>
</div>
</div>
</div>
</div>
<div class="row d-flex justify-content-end">
<div class="col-md-10 row d-flex justify-content-end">
<div class="col-md-3">
<div class="row">
	<div class="col-md-4 d-flex justify-content-end m-0 p-0">
		<h4><span class="en">Grand Total</span><span class="ar"><?= getArabicTitle('Grand Total') ?></span></h4>
	</div>
	<div class="col-md-8">
		<div class="form-total_int">
			<input value="0" id="f_grand_total" name="f_grand_total" type="text" readonly class="form-control">
		</div>
	</div>
</div>
</div>
<div class="col-md-3">
<div class="row">
	<div class="col-md-4 d-flex justify-content-end p-0 m-0">
		<h4><span class="en">Expense</span><span class="ar"><?= getArabicTitle('Expense') ?></span></h4>
	</div>
	<div class="col-md-8">
		<div class="form-group">
			<input value="0" id="f_expense" name="f_expense" type="text" class="form-control" onkeyup="salesTotalDiscountCalculation()">
		</div>
	</div>
</div>
</div>

</div>
</div>

<hr />

<?php
$code = $bid;
$nrow = 1;
?>
<div id="loadBanksagainstBrank">

<label for="" class="form-label add_icon en">Banks</label>
<label for="" class="form-label add_icon ar"><?= getArabicTitle('Banks') ?></label>

<table class="tabel table-bordered table-striped" style="width: 100%; margin-top: 10px;">
<thead>
<tr>
	<th align="center">#</th>
	<th align="center"><span class="en">Bank</span><span class="ar"><?= getArabicTitle('Bank') ?></span></th>
	<th align="center"><span class="en">Amount</span><span class="ar"><?= getArabicTitle('Amount') ?></span></th>
</tr>
</thead>
<tbody>

<?php
$nrow = 1;
$banQ = "exec " . dbObject . "GetPaymentType @bid='$code'";
$Bracnhes = Run($bankQ);
while ($getBranches = myfetch($Bracnhes)) {
?>
	<tr>
		<td align="center"><input type="hidden" id="Bank<?= $nrow ?>" name="Bank<?= $nrow ?>" class="form-control" value="<?php echo $getBranches->id; ?>" readonly> <input type="hidden" id="BankName<?= $nrow ?>" name="BankName<?= $nrow ?>" class="form-control" value="<?php echo $getBranches->snameEng; ?>" readonly>
			<?= $nrow ?></td>
		<td align="center">

			<?php echo $getBranches->snameEng; ?>

		</td>
		<td>
			<input type="text" id="sal_amount<?= $nrow ?>" name="sal_amount<?= $nrow ?>" class="form-control <?php if ($nrow != 1) {
																													echo 'salAmnt';
																												} ?>  " value="0" onKeyUp="CalculateRemainings()" <?php if ($nrow == 1) {
		echo 'readonly';
	} ?>>
		</td>
	</tr>

<?php
	$nrow++;
}

?>
</tbody>
</table>
<input type="hidden" id="bankrows" name="bankrows" value="<?= $nrow ?>">
<hr>
</div>
<div class="row d-flex justify-content-center">
<div class="col-lg-3">
<input type="submit" class="btn btn-block btn-lg btn-outline-success en" name="submit" value="Save">
<input type="submit" class="btn btn-block btn-lg btn-outline-success ar" name="submit" value="<?= getArabicTitle('Save')?>">
</div>

</div>


</div>
</div>
</div>
</div>

<div id="fetchProductDetails"></div>
<!-- <div id="getProductList"></div> -->
<!-- <div id="loadUnits"></div> -->
<!-- <input type="hidden" name="Bid" id="Bid" value="<?= $bid ?>"> -->
<input type="hidden" name="row_count" id="row_count" value="0">
</form>
</div>
</div>

<div id="SalesVoucherDiv"></div>
<?php
include("footer.php");
?>
</div>
</div>
</div>
</div>


</body>

</html>

<script src="vouchers/purchase/js.js"></script>

<script>
$(document).ready(function() {
$("#Bid").select2({});
	var bid = document.getElementById('Bid').value;
	loadBanksagainstBrank(bid);
});
	
</script>>>