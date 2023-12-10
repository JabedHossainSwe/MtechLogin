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
<h2 class="font-weight-bold"><span class="en float-left">Product Stock</span><span class="ar float-right"><?= getArabicTitle('Product Stock') ?></span></h2>

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
<div class="col-md-5">
<h4><span class="en">Order By</span><span class="ar">
<?= getArabicTitle('Order By') ?>
</span>
</h4>
</div>
<div class="col-md-7">
<div class="row">
<div class="col-md-6 col-6">
<div class="i-checks"><label class="">
<div class="iradio_square-green ">
	<div class="iradio_square-green">
		<input type="radio" value="0" name="OrderBy" <?php if ($_GET['OrderBy'] == '0' || $_GET['OrderBy'] == '') {
			echo 'checked="checked"';
		} ?>>
	</div>
	<ins class="iCheck-helper"></ins>
</div> <i></i> <span class="en">Pcode </span><span class="ar"><?= getArabicTitle('Pcode') ?></span>
</label>
</div>
</div>
<div class="col-md-6 col-6">
<div class="i-checks"><label class="">
<div class="iradio_square-green ">
	<div class="iradio_square-green">
		<input type="radio" <?php if ($_GET['OrderBy'] == '1') {
			echo 'checked="checked"';
		} ?>
			value="1" name="OrderBy">
	</div>
	<ins class="iCheck-helper"></ins>
</div> <i></i> <span class="en">PName</span><span class="ar"><?= getArabicTitle('PName') ?></span>
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
<div class="col-3">
<div class="row">
<div class="col-md-5">
<h4><span class="en">From Item</span><span class="ar">
<?= getArabicTitle('From Item') ?>
</span></h4>
</div>

<div class="col-md-7 col-8">
<div class="form-group">
<input id="FItemCode" name="FItemCode" type="hidden" class="form-control"
value="<?php echo $_GET['FItemCode'] ?>" readonly>
<div>
<select id="from_item_name" name="from_item_name" class="select2_demo_1 form-control"
tabindex="4" onChange="setmyValue(this.value,'FItemCode')">
<?php
if (isset($_GET['FItemCode']) && !empty($_GET['FItemCode'])) {
?>
<option value="<?php echo $_GET['FItemCode']; ?>" selected> <?php echo getProductDetails($_GET['FItemCode'])->CName; ?> -
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
<div class="col-3">
<div class="row">
<div class="col-md-5">
<h4><span class="en">To Item</span><span class="ar">
<?= getArabicTitle('To Item') ?>
</span>
</h4>
</div>

<div class="col-md-7 col-8">
<div class="form-group">
<input id="TItemCode" name="TItemCode" type="hidden" class="form-control" readonly
value="<?php echo $_GET['TItemCode'] ?>">

<div>
<select id="to_item_name" name="to_item_name" class="select2_demo_1 form-control"
onChange="setmyValue(this.value,'TItemCode')">
<option value="">Select</option>
<?php
if (isset($_GET['TItemCode']) && !empty($_GET['TItemCode'])) {
?>
<option value="<?php echo $_GET['TItemCode']; ?>" selected> <?php echo getProductDetails($_GET['TItemCode'])->CName; ?> -
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
<div class="col-md-4">
<h4><span class="en">Item Type</span><span class="ar">
<?= getArabicTitle('Item Type') ?>
</span>
</h4>
</div>

<div class="col-md-8 col-8">
<div class="form-group">
<input id="ItemType" name="ItemType" type="hidden" class="form-control" readonly
value="<?php echo $_GET['ItemType'] ?>">
<div>
<select id="ItemType_name" name="ItemType_name" class="select2_demo_1 form-control"
onChange="setmyValue(this.value,'ItemType')">
<option value="">Select</option>
<?php
if (isset($_GET['ItemType']) && !empty($_GET['ItemType'])) {
?>
<option value="<?php echo $_GET['ItemType']; ?>" selected> <?php echo GetProductType($_GET['ItemType'])->CName; ?> -
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
<div class="col-md-4">
<h4><span class="en">Supplier</span><span class="ar">
<?= getArabicTitle('Supplier') ?>
</span></h4>
</div>

<div class="col-8">
<div class="form-group">
<input id="suppid" name="suppid" type="hidden" class="form-control" readonly
value="<?php echo $_GET['suppid'] ?>">
<div id="">
<select id="suppid_name" name="suppid_name" class="select2_demo_1 form-control"
onChange="setmyValue(this.value,'suppid')">
<option value="">Select</option>
<?php
if (isset($_GET['suppid']) && !empty($_GET['suppid'])) {
$sp = $_GET['suppid'];
$getSupplierDetails = getSupplierDetails($sp);

?>
<option value="<?= $getSupplierDetails->Cid ?>" selected><?= $getSupplierDetails->CCode . ' - ' . $getSupplierDetails->CName ?></option>

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
<div class="col-md-4">
<h4><span class="en">Supplier Group</span><span class="ar">
<?= getArabicTitle('Supplier Group') ?>
</span></h4>
</div>

<div class="col-8">
<div class="form-group">
<input id="supGids" name="supGids" type="hidden" class="form-control" readonly
value="<?php echo $_GET['supGids'] ?>">
<div id="">
<select id="supGids_name" name="supGids_name" class="select2_demo_1 form-control"
onChange="setmyValue(this.value,'supGids')">
<option value="">Select</option>
<?php
if (isset($_GET['supGids']) && !empty($_GET['supGids'])) {
$sp = $_GET['supGids'];
$getSupplierDetails = getSupplierGroupDetails($sp);

?>
<option value="<?= $getSupplierDetails->Cid ?>" selected><?= $getSupplierDetails->CName ?>
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







<div class="col-6">
<div class="row">
<div class="col-md-4">
<h4><span class="en">Product Group</span><span class="ar">
<?= getArabicTitle('Product Group') ?>
</span></h4>
</div>
<?php



?>
<div class="col-md-8 col-8">
<div class="form-group">

<div>
<select id="product_group_name" name="Gids[]" data-placeholder="Product Group"
class="select2_demo_1 form-control" multiple>
<?php


if (isset($_GET['Gids']) && !empty($_GET['Gids'])) {


foreach ($_GET['Gids'] as $ss) {


	?>
	<option value="<?php echo $ss; ?>" selected> <?php echo getProductGroupDetails($ss)->CName; ?>
	</option>
<?php
}
}
?>
</select>
</div>
</div>
</div>
</div>
</div>


<div class="col-6">
<div class="row">
<div class="col-md-4">
<h4><span class="en">Products</span><span class="ar">
<?= getArabicTitle('Products') ?>
</span></h4>
</div>

<div class="col-md-8 col-8">
<div class="form-group">

<div>
<select id="product_name" name="Pids[]" data-placeholder="Product"
class="select2_demo_1 form-control" multiple>
<?php


if (isset($_GET['Pids']) && !empty($_GET['Pids'])) {

foreach ($_GET['Pids'] as $ss) {
	?>
	<option value="<?php echo $ss; ?>" selected> <?php echo getProductDetails($ss)->CName; ?>
	</option>
<?php
}
}
?>
</select>
</div>
</div>
</div>
</div>
</div>






<div class="col-12">
<div class="row">
<div class="col-md-4">
<h4><span class="en">Condition Criteria</span><span class="ar">
<?= getArabicTitle('Condition Criteria') ?>
</span>
</h4>
</div>
<div class="col-md-4 col-4">
<div class="form-group">
<button type="button" class="btn btn-block btn-success" onClick="ManagecondCriteria();"
value="Manage"><span class="en">Manage</span><span class="ar">
<?= getArabicTitle('Manage') ?>
</span>
</button>
</div>
</div>
<div class="col-md-4 col-4">
<div class="form-group">
<textarea id="condCriteria" name="condCriteria" placeholder="Condition Criteria"
readonly><?= $_GET['condCriteria'] ?></textarea>
</div>
</div>
</div>
</div>





<div class="col-md-4">
<div class="row">
<div class="col-md-5">
<h4><span class="en">Purchase Invoice</span><span class="ar">
<?= getArabicTitle('Purchase Invoice') ?>
</span></h4>
</div>
<div class="col-md-7">
<div class="form-group">
<input value="" id="PurInv" name="PurInv" type="text" class="form-control">

</div>
</div>
</div>
</div>



<div class="col-md-8 pt-2 toggle_groupbytype">

<div class="row">

<div class="col-md-12">
<div class="row">
<div class="col-md-3 col-6">
<div class="i-checks"><label class="">
<div class="iradio_square-green ">
	<div class="iradio_square-green">
		<input type="checkbox" value="1" <?php if ($_GET['Ismultiunit'] == '1') {
			echo "Checked";
		} ?> name="Ismultiunit">
	</div>
	<ins class="iCheck-helper"></ins>
</div> <i></i> <span class="en">Multi Unit</span><span class="ar"><?= getArabicTitle('Multi Unit') ?></span>
</label>
</div>
</div>
<?php /*?><div class="col-md-4 col-6">
<div class="i-checks"><label class="">
<div class="iradio_square-green ">
<div class="iradio_square-green">
<input type="checkbox" value="1"
name="ProdGrpCombine" <?php if($_GET['ProdGrpCombine']=='1'){ echo "Checked"; } ?>>
</div>
<ins class="iCheck-helper"></ins>
</div> <i></i> <span class="en">Product Group Combination</span><span
class="ar"><?= getArabicTitle('Product Group Combination') ?></span>
</label>
</div>
</div><?php */?>


<div class="col-md-3 col-6">
<div class="i-checks"><label class="">
<div class="iradio_square-green ">
	<div class="iradio_square-green">
		<input type="checkbox" value="1" name="IsDelvEffectStock" <?php if ($_GET['IsDelvEffectStock'] == '1') {
			echo "Checked";
		} ?>>
	</div>
	<ins class="iCheck-helper"></ins>
</div> <i></i> <span class="en">Effect Stock</span><span class="ar"><?= getArabicTitle('Effect Stock') ?></span>
</label>
</div>
</div>


<div class="col-md-3 col-6">
<div class="i-checks"><label class="">
<div class="iradio_square-green ">
	<div class="iradio_square-green">
		<input type="checkbox" value="1" name="IsPurEfctStock" <?php if ($_GET['IsPurEfctStock'] == '1') {
			echo "Checked";
		} ?>>
	</div>
	<ins class="iCheck-helper"></ins>
</div> <i></i> <span class="en">Purchase Effect Stock</span><span class="ar"><?= getArabicTitle('Purchase Effect Stock') ?></span>
</label>
</div>
</div>


<div class="col-md-3 col-6">
<div class="i-checks"><label class="">
<div class="iradio_square-green ">
	<div class="iradio_square-green">
		<input type="checkbox" value="1" name="IsMultiProduction" <?php if ($_GET['IsMultiProduction'] == '1') {
			echo "Checked";
		} ?>>
	</div>
	<ins class="iCheck-helper"></ins>
</div> <i></i> <span class="en">Multi Production</span><span class="ar"><?= getArabicTitle('Multi Production') ?></span>
</label>
</div>
</div>



</div>
</div>
</div>
</div>



<div class="col-md-4">
<div class="row">
<div class="col-md-5">
<h4><span class="en">Promotion Bill No</span><span class="ar">
<?= getArabicTitle('Promotion Bill No') ?>
</span></h4>
</div>
<div class="col-md-7">
<div class="form-group">
<input value="<?php echo $_GET['PromotionBillNo']; ?>" id="PromotionBillNo"
name="PromotionBillNo" type="text" class="form-control">

</div>
</div>
</div>
</div>

<div class="col-4">
<div class="row">
<div class="col-md-5">
<h4><span class="en">From Product</span><span class="ar">
<?= getArabicTitle('From Product') ?>
</span></h4>
</div>

<div class="col-md-7 col-8">
<div class="form-group">
<input id="from_product_id" name="from_product_id" type="hidden" class="form-control"
value="<?php echo $_GET['from_product_id'] ?>" readonly>
<div>
<select id="from_product_name" name="from_product_name" class="select2_demo_1 form-control"
tabindex="4" onChange="setmyValue(this.value,'from_product_id')">
<?php
if (isset($_GET['from_product_id']) && !empty($_GET['from_product_id'])) {
?>
<option value="<?php echo $_GET['from_product_id']; ?>" selected> <?php echo getProductDetails($_GET['from_product_id'])->CName; ?> -
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
<div class="col-md-5">
<h4><span class="en">To Product</span><span class="ar">
<?= getArabicTitle('To Product') ?>
</span>
</h4>
</div>

<div class="col-md-7 col-8">
<div class="form-group">
<input id="to_product_id" name="to_product_id" type="hidden" class="form-control" readonly
value="<?php echo $_GET['to_product_id'] ?>">

<div>
<select id="to_product_name" name="to_product_name" class="select2_demo_1 form-control"
onChange="setmyValue(this.value,'to_product_id')">
<option value="">Select</option>
<?php
if (isset($_GET['to_product_id']) && !empty($_GET['to_product_id'])) {
?>
<option value="<?php echo $_GET['to_product_id']; ?>" selected> <?php echo getProductDetails($_GET['to_product_id'])->CName; ?> -
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
</form>
</div>
</div>
</div>

<?php
if (isset($_GET['report_type']) && $_GET['report_type'] == 'general') {
?>
<div class="ibox">
<h2> <span class="en float-left">Product Stock Report</span><span class="ar float-right"><?= getArabicTitle('Product Stock Report') ?></span></h2>
<div class="ibox-content this_ar">

<div class="table-responsive">


<div class="row">
<div class="col-lg-12" id="sales_report">

<?php
include('newpagination/paginator.class.php');

/// ORder By Clauses///////
if (isset($_GET['OrderBy']) && !empty($_GET['OrderBy'])) {
$OrderByx = urldecode($_GET['OrderBy']);
$OrderBy = $OrderByx;
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






$LanguageId = !empty($_REQUEST['LanguageId']) ? $_REQUEST['LanguageId'] : '1';
$OrderBy = !empty($OrderBy) ? $OrderBy : '';
$dt = !empty($dt) ? $dt : NULL;
$dt2 = !empty($dt2) ? $dt2 : NULL;
$FItemCode = !empty($_REQUEST['FItemCode']) ? $_REQUEST['FItemCode'] : '';
$TItemCode = !empty($_REQUEST['TItemCode']) ? $_REQUEST['TItemCode'] : '';
$ItemType = !empty($_REQUEST['ItemType']) ? $_REQUEST['ItemType'] : 0;
$suppid = !empty($_REQUEST['suppid']) ? $_REQUEST['suppid'] : 0;
$supGids = !empty($_REQUEST['supGids']) ? $_REQUEST['supGids'] : 0;
$Gids = implode(",", $_GET['Gids'])
;
$Gids = !empty($Gids) ? $Gids : '';
$condCriteria = !empty($_REQUEST['condCriteria']) ? $_REQUEST['condCriteria'] : '';
$PurInv = !empty($_REQUEST['PurInv']) ? $_REQUEST['PurInv'] : '';
$Ismultiunit = !empty($_REQUEST['Ismultiunit']) ? $_REQUEST['Ismultiunit'] : 0;
$ProdGrpCombine = !empty($_REQUEST['ProdGrpCombine']) ? $_REQUEST['ProdGrpCombine'] : '';
$IsDelvEffectStock = !empty($_REQUEST['IsDelvEffectStock']) ? $_REQUEST['IsDelvEffectStock'] : 0;
$IsPurEfctStock = !empty($_REQUEST['IsPurEfctStock']) ? $_REQUEST['IsPurEfctStock'] : '1';
$IsMultiProduction = !empty($_REQUEST['IsMultiProduction']) ? $_REQUEST['IsMultiProduction'] : 0;
$PromotionBillNo = !empty($_REQUEST['PromotionBillNo']) ? $_REQUEST['PromotionBillNo'] : '';
$FPid = !empty($_REQUEST['from_product_id']) ? $_REQUEST['from_product_id'] : 0;

$TPid = !empty($_REQUEST['to_product_id']) ? $_REQUEST['to_product_id'] : 0;

$pids = implode(",", $_GET['Pids'])
;
$pids = !empty($pids) ? $pids : '';
$CBid = !empty($_REQUEST['CBid']) ? $_REQUEST['CBid'] : '1';
$CrPrice = !empty($_REQUEST['CrPrice']) ? $_REQUEST['CrPrice'] : '';
$OrderBy = !empty($_REQUEST['OrderBy']) ? $_REQUEST['OrderBy'] : '0';







//Main query

$pages = new Paginator;



include("include/reports/product_stock/index.php");



?>













</div>
</div>

</div>

</div>
</div>
<?php
}
?>


</div>


<?php
include("footer.php");
?>
</div>
</div>
</div>
</div>





</body>

</html>
<script src="include/reports/product_stock/js.js"></script>
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