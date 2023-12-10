<!DOCTYPE html>
<html>

<head>

<meta charset="utf-8">
<meta name="viewport"
content="initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0,target-densitydpi=device-dpi, user-scalable=no" />


<title>Sales Report</title>




</head>

<body class="top-navigation">

<div id="wrapper">
<div id="page-wrapper" class="gray-bg">
<div class="row border-bottom white-bg justify-content-between">
<?php
include("header.php");

?>
</div>
<div class="row wrapper border-bottom white-bg page-heading pb-2">
<div class="col-lg-10">
<h2 class="font-weight-bold">Sales Report</h2>

</div>
</div>
<div class="wrapper wrapper-content animated fadeInRight">
<div class="row mb-1">
<div class="col-md-6 col-8">
<button type="button" class="btn btn-w-m btn-default eng">English</button>
<button type="button" class="btn btn-w-m btn-default ara">Arabic</button>
</div>
<div class="col-md-6 col-4">
<button type="button" class="btn btn-w-m btn-success float-right" id="filter">Filters</button>
</div>

</div>
<div class="row">
<div class="col-lg-12">
<div class="ibox">
<div class="ibox-title">
<div class="row">
<div class="col-md-9">
<h5 class="mr-4"><span class="en">Filters</span><span class="ar">Filters</span></h5>
</div>
<div class="col-md-3">
<div class="form-group m-0">
<select class="form-control" id="report_type_option" name="report_type_option">
<option value="general">General</option>
<option value="details">Details</option>
<option value="group">Group</option>
<?php /*?><option value="summery_by_date">Summery By Date</option><?php */?>
</select>
</div>
</div>
</div>

<div class="ibox-tools no_envent" style="display: none">
<a class="collapse-link filter_act">
<i class="fa fa-chevron-down"></i>
</a>
</div>
</div>
<form action="" id="sales_report_form" method="get"
class="ibox-content filter_container">
<input type="text" id="report_type" name="report_type" value="general" hidden>
<input type="number" id="selected_lang" name="selected_lang" value="1" hidden>
<div class="row">
<div class="col-12">
<div class="row">
<div class="col-md-2">
<h4><span class="en">Branch Selection</span><span class="ar">Branch
Selection</span></h4>
</div>
<div class="col-md-2">
<div class="form-group">


<input type="checkbox" id="branch_all_select"
name="branch_all_select" <?php if($_GET['branch_all_select']=='on'){ echo "checked"; } ?>  class="js-switch" />
</div>
</div>
<div class="col-md-8">
<div class="form-group">
<div>
<select id="branchs" name="branch[]"
class="select2_demo_1 form-control" tabindex="4" multiple>
<?php
$Bracnhes = Run("Select * from Branch order by BName ASC");
$ABoveBranches  = $_GET['branch'];
while($getBranches = myfetch($Bracnhes))
{
$selected ="";
if (in_array($getBranches->Bid, $ABoveBranches) && $_GET['branch_all_select']!='on')
{
$selected = "Selected";
}
?>
<option value="<?php echo $getBranches->Bid; ?>" <?php echo $selected; ?>  ><?php echo $getBranches->BName; ?></option>	

<?php
}

?>	

</select>

</div>
</div>
</div>
</div>
</div>
<div class="col-md-6">
<div class="row">
<div class="col-md-4">
<h4><span class="en">From Bill No</span><span class="ar">From Bill
No</span></h4>
</div>
<div class="col-md-8">
<div class="form-group">
<input value="<?php echo $_GET['from_bill_no']; ?>" id="from_bill_no"
name="from_bill_no" type="text" class="form-control">

</div>
</div>
</div>
</div>
<div class="col-md-6">
<div class="row">
<div class="col-md-4">
<h4><span class="en">To Bill No </span><span class="ar"></span></h4>
</div>
<div class="col-md-8">
<div class="form-group"><input id="to_bill_no" value="<?php echo $_GET['to_bill_no']; ?>"
name="to_bill_no" type="text" class="form-control"></div>
</div>
</div>
</div>
<div class="col-md-6">
<div class="row">
<div class="col-md-4">
<h4><span class="en">From Date</span><span class="ar">From Date</span>
</h4>
</div>
<div class="col-md-8">
<div class="form-group">
<div class="input-group date">
<span class="input-group-addon">
<i class="fa fa-calendar"></i></span>
<input id="from_date" name="from_date" type="text"
class="form-control" value="<?php echo $_GET['from_date'] ?>" autocomplete="off">
</div>
</div>
</div>
</div>
</div>
<div class="col-md-6">
<div class="row">
<div class="col-md-4">
<h4><span class="en">To Date</span><span class="ar">To Date</span> </h4>
</div>
<div class="col-md-8">
<div class="form-group">
<div class="input-group date">
<span class="input-group-addon">
<i class="fa fa-calendar"></i></span>
<input id="to_date" name="to_date" type="text"
class="form-control" value="<?php echo $_GET['to_date'] ?>"  autocomplete="off">
</div>
</div>
</div>
</div>
</div>
<div class="col-6">
<div class="row">
<div class="col-md-4">
<h4><span class="en">Customer</span><span class="ar">Customer</span>
</h4>
</div>
<div class="col-md-2 col-4">
<div class="form-group"><input id="customer_id" name="customer_id"
type="text" class="form-control" value="<?php echo $_GET['customer_id'] ?>" ></div>
</div>
<div class="col-md-6 col-8">
<div class="form-group">
<div>
<select id="customer_name" name="customer_name"
class="select2_demo_1 form-control" tabindex="4"
onChange="setmyValue(this.value,'customer_id')">
<?php
if(isset($_GET['customer_id']) && !empty($_GET['customer_id']))
{
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
<div class="col-6">
<div class="row">
<div class="col-md-4">
<h4><span class="en">User</span><span class="ar">User</span></h4>
</div>
<div class="col-md-2 col-4">
<div class="form-group">
<input type="text" value="<?php echo $_GET['user_id'] ?>" id="user_id" name="user_id"
class="form-control" ></div>
</div>
<div class="col-md-6 col-8">
<div class="form-group">
<div>
<select id="user_name" name="user_name"
class="select2_demo_1 form-control" tabindex="4"
onChange="setmyValue(this.value,'user_id')">

<?php
if(isset($_GET['user_id']) && !empty($_GET['user_id']))
{
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
<div class="col-6">
<div class="row">
<div class="col-md-4">
<h4><span class="en">From Product</span><span class="ar">From
Product</span></h4>
</div>
<div class="col-md-2 col-4">
<div class="form-group"><input id="from_product_id"
name="from_product_id" type="text" class="form-control"
value="<?php echo $_GET['from_product_id'] ?>"></div>
</div>
<div class="col-md-6 col-8">
<div class="form-group">
<div>
<select id="from_product_name" name="from_product_name"
class="select2_demo_1 form-control" tabindex="4"
onChange="setmyValue(this.value,'from_product_id')">

</select>
</div>
</div>
</div>
</div>
</div>
<div class="col-6">
<div class="row">
<div class="col-md-4">
<h4><span class="en">To Product</span><span class="ar">To Product</span>
</h4>
</div>
<div class="col-md-2 col-4">
<div class="form-group"><input id="to_product_id" name="to_product_id"
type="text" class="form-control" value="<?php echo $_GET['to_product_id'] ?>"></div>
</div>
<div class="col-md-6 col-8">
<div class="form-group">
<div>
<select id="to_product_name" name="to_product_name"
class="select2_demo_1 form-control"
onChange="setmyValue(this.value,'to_product_id')">
<option value="">Select</option>

</select>
</div>
</div>
</div>
</div>
</div>
<div class="col-6">
<div class="row">
<div class="col-md-4">
<h4><span class="en">Product Group</span><span class="ar">Product
Group</span></h4>
</div>
<div class="col-md-2 col-4">
<div class="form-group"><input id="product_group_id"
name="product_group_id" type="text" class="form-control"
value="<?php echo $_GET['product_group_id'] ?>"></div>
</div>
<div class="col-md-6 col-8">
<div class="form-group">
<div>
<select id="product_group_name" name="product_group_name"
data-placeholder="Product Group"
class="select2_demo_1 form-control"
onChange="setmyValue(this.value,'product_group_id')">

</select>
</div>
</div>
</div>
</div>
</div>
<div class="col-md-6">
<div class="row">
<div class="col-md-4">
<h4><span class="en">Amount</span><span class="ar">Amount</span> </h4>
</div>
<div class="col-md-2 col-6">
<div class="form-group">
<select name="amount_type" id="amount_type" class="form-control">
<option value="=" <?php if($_GET['amount_type'] == '='){echo "Selected";}?> > = </option>
<option value=">" <?php if($_GET['amount_type'] == '>'){echo "Selected";}?>> > </option>
<option value="<" <?php if($_GET['amount_type'] == '<'){echo "Selected";}?>>
< </option> <option value="<>" <?php if($_GET['amount_type'] == '<>'){echo "Selected";}?>> !=
</option>

</select>


</div>
</div>
<div class="col-md-6 col-6">
<div class="form-group"><input id="amount" name="amount" type="text"
class="form-control" value="<?php echo $_GET['amount'];?>"></div>
</div>
</div>
</div>
<div class="col-md-12 pt-2 toggle_orderby">
<div class="row">
<div class="col-md-2">
<h4><span class="en">Order By</span><span class="ar">Order By</span>
</h4>
</div>
<div class="col-md-10">
<div class="row">
<div class="col-md-3 col-6">
<div class="i-checks"><label class="">
<div class="iradio_square-green ">
<div class="iradio_square-green">
<input type="radio" <?php if($_GET['OrderBy']=='Billno'){ echo 'checked="checked"'; } ?>  
value="Billno" name="OrderBy">
</div>
<ins class="iCheck-helper"></ins>
</div> <i></i> <span class="en">Bill Number</span><span
class="ar">تفاصيل</span>
</label>
</div>
</div>
<div class="col-md-3 col-6">
<div class="i-checks"><label class="">
<div class="iradio_square-green ">
<div class="iradio_square-green">
<input type="radio" value="Billdate"
name="OrderBy" <?php if($_GET['OrderBy']=='Billdate' || $_GET['OrderBy']==''){ echo 'checked="checked"'; } ?>>
</div>
<ins class="iCheck-helper"></ins>
</div> <i></i> <span class="en">Bill Date </span><span
class="ar">تفاصيل</span>
</label>
</div>
</div>
</div>
</div>
</div>
</div>
<div class="col-md-12 pt-2 toggle_groupbytype">
<div class="row">
<div class="col-md-2">
<h4><span class="en">Group By Type</span><span class="ar">Group By Type</span>
</h4>
</div>
<div class="col-md-10">
<div class="row">
<div class="col-md-3 col-6">
<div class="i-checks"><label class="">
<div class="iradio_square-green ">
<div class="iradio_square-green">
<input type="radio" 
value="" <?php if($_GET['GroupByType']==''){ echo "Checked"; } ?> name="GroupByType">
</div>
<ins class="iCheck-helper"></ins>
</div> <i></i> <span class="en">Group By None</span><span
class="ar">تفاصيل</span>
</label>
</div>
</div>
<div class="col-md-3 col-6">
<div class="i-checks"><label class="">
<div class="iradio_square-green ">
<div class="iradio_square-green">
<input type="radio" value="CSID"
name="GroupByType" <?php if($_GET['GroupByType']=='CSID'){ echo "Checked"; } ?>>
</div>
<ins class="iCheck-helper"></ins>
</div> <i></i> <span class="en">Group by Customer </span><span
class="ar">تفاصيل</span>
</label>
</div>
</div>
<div class="col-md-3 col-6">
<div class="i-checks"><label class="">
<div class="iradio_square-green ">
<div class="iradio_square-green">
<input type="radio" value="BillDate"
name="GroupByType" <?php if($_GET['GroupByType']=='BillDate'){ echo "Checked"; } ?>>
</div>
<ins class="iCheck-helper"></ins>
</div> <i></i> <span class="en">Group by Bill Date</span><span
class="ar">تفاصيل</span>
</label>
</div>
</div>
</div>
</div>
</div>
</div>
<div class="col-md-12 pt-2">
<div class="row">
<div class="col-md-2">
<h4><span class="en">Transaction Type</span><span class="ar">Transaction
Type</span></h4>
</div>
<div class="col-md-10">
<div class="row">
<div class="col-md-3 col-6">
<div class="i-checks"><label class="">
<div class="iradio_square-green ">
<div class="iradio_square-green">
<input type="radio" <?php if($_GET['transaction_type']=='1'){echo "Checked"; } ?> value="1"
name="transaction_type">
</div>
<ins class="iCheck-helper"></ins>
</div> <i></i> <span class="en">Cash </span><span
class="ar">تفاصيل</span>
</label>
</div>
</div>
<div class="col-md-3 col-6">
<div class="i-checks"><label class="">
<div class="iradio_square-green ">
<div class="iradio_square-green">
<input type="radio" value="2"
name="transaction_type" <?php if($_GET['transaction_type']=='2'){echo "Checked"; } ?>>
</div>
<ins class="iCheck-helper"></ins>
</div> <i></i> <span class="en">Credit </span><span
class="ar">تفاصيل</span>
</label>
</div>
</div>
<div class="col-md-3 col-6">
<div class="i-checks"><label class="">
<div class="iradio_square-green ">
<div class="iradio_square-green">
<input type="radio" value="All"
name="transaction_type"  <?php if($_GET['transaction_type']=='All' || $_GET['transaction_type']==''){echo "Checked"; } ?> >
</div>
<ins class="iCheck-helper"></ins>
</div> <i></i> <span class="en">All</span><span
class="ar">تفاصيل</span>
</label>
</div>
</div>
</div>
</div>
</div>
</div>

<div class="col-12">
<div class="row justify-content-center mt-5">
<div class="col-md-3"><button type="button"
class="btn btn-block btn-lg btn-danger"><span
class="en">Exit</span><span class="ar"><?= getArabicTitle('Exit') ?></span>
</button>
</div>
<div class="col-md-3">
<button type="submit"
class="btn btn-block btn-lg btn-success"
id="seles_report_search"><span class="en">Search</span><span
class="ar">البحث </span>
</button>
</div>
</div>
</div>
</div>
</form>
</div>
</div>
</div>


<div class="ibox">
<h2>General</h2>
<div class="ibox-content this_ar">

<div class="table-responsive" >


<div class="row">
<div class="col-lg-12" id="sales_report">

<?php
include('pagination/paginator.class.php');
$condition		=	" where sale.IsDeleted='0'";

/// ORder By Clauses///////
$OrderBy = "Order by sale.Billno ASC";
if( isset($_GET['OrderBy']) && !empty($_GET['OrderBy']) )
{
$OrderByx= urldecode($_GET['OrderBy']);
$OrderBy = "Order by sale.$OrderByx ASC";
}

////////// Form Filters/////
//////////////// Branches Filter//////////////
if(isset($_GET['branch']) && !empty($_GET['branch']) )
{	
$branch = $_GET['branch'];
if(empty($branch))
{
$branchesArray = array();
$Bracnhes = Run("Select * from Branch order by BName ASC");
while($getBranches = myfetch($Bracnhes))
{
array_push($branchesArray,$getBranches->Bid);	
}
$branchIds = implode(",",$branchesArray);
}
else
{
$branchIds = implode(",",$branch);
}

$condition .=" AND sale.Bid IN ($branchIds) "; 

}

if(isset($_GET['from_date']) && !empty($_GET['from_date']) )
{
$from_date= urldecode($_GET['from_date']);
$from_date = date("Y-m-d",strtotime($from_date));	
$condition .=" AND sale.BillDate >='".$from_date."'  "; 
}




if( isset($_GET['to_date']) && !empty($_GET['to_date']) )
{
$to_date= urldecode($_GET['to_date']);
$to_date = date("Y-m-d",strtotime($to_date));	
$condition .=" AND sale.BillDate <='".$to_date."'  "; 
}



if( isset($_GET['from_bill_no']) && !empty($_GET['from_bill_no']) )
{
$from_bill_no= urldecode($_GET['from_bill_no']);
$condition .=" AND sale.Billno >='".$from_bill_no."'  "; 
}

if( isset($_GET['to_bill_no']) && !empty($_GET['to_bill_no']) )
{
$to_bill_no= urldecode($_GET['to_bill_no']);
$condition .=" AND sale.Billno <='".$to_bill_no."'  "; 
}

if( isset($_GET['customer_id']) && !empty($_GET['customer_id']) )
{
$customer_id= urldecode($_GET['customer_id']);
$condition .=" AND sale.CSID ='".$customer_id."'  "; 
}

if( isset($_GET['user_id']) && !empty($_GET['user_id']) )
{
$user_id= urldecode($_GET['user_id']);
$condition .=" AND sale.EMPID ='".$user_id."'  "; 
}


if( isset($_GET['amount']) && !empty($_GET['amount']) )
{
$amount= urldecode($_GET['amount']);
$condition .=" AND sale.GTotal ".$_GET['amount_type']."  '".$amount."'  "; 
}

if( isset($_GET['transaction_type']) && !empty($_GET['transaction_type']) )
{
$transaction_type= urldecode($_GET['transaction_type']);
if($transaction_type!='All')
{
$condition .=" AND sale.SPtype ='".$transaction_type."'  "; 
}
}

$distinct = "";
$GrB = "";
if( isset($_GET['GroupByType']) && !empty($_GET['GroupByType']) )
{
$GroupByType= urldecode($_GET['GroupByType']);
$distinct =" distinct(sale.".$GroupByType."), "; 
$GrB = "group by  sale.$GroupByType";

}



//Main query

$pages = new Paginator;

$qqst = "SELECT count(sale.Billno) as tol FROM dataout  sale
left join CustFile on CustFile.Cid = sale.CSID
left join Branch on Branch.Bid = sale.Bid
left join Emp on Emp.Cid = sale.EMPID   ".$condition."  $GrB";
$pages->default_ipp = 15;


$sql_forms = Run($qqst);

$tolrec = myfetch($sql_forms);	

$pages->items_total = $tolrec->tol;

$pages->mid_range = 9;

$pages->paginate();	




$qq = "SELECT $distinct sale.*,CustFile.CName as CustSupName, Branch.BName as BranchName,Emp.CName as UserName FROM dataout sale
left join CustFile on CustFile.Cid = sale.CSID
left join Branch on Branch.Bid = sale.Bid
left join Emp on Emp.Cid = sale.EMPID ".$condition."  $OrderBy ".$pages->limit."";

$result	=	Run($qq);

// QUERY END

?>	

<div class="clearfix"></div>



<!-- Listing -->

<table class="table table-striped table-bordered dt-responsive table-hover ">

<thead>
<tr>
<th ><span class="en">BillNo</span><span class="ar">المجموع</span></th>
<th><span class="en">BillDate</span><span class="ar">تخفيض</span></th>
<th><span class="en">Customer</span><span class="ar">تخفيض٪</span></th>
<th><span class="en">Total</span><span class="ar">صافي
الإجمالي</span></th>
<th><span class="en">Discount</span><span class="ar">ضريبة السلع
والخدمات توتلا</span></th>
<th><span class="en">NetTotal</span><span class="ar">المبلغ
الإجمالي</span></th>
<th><span class="en">VatTotal</span><span class="ar">نوع الفاتورة</span>
</th>
<th><span class="en">Grand Total</span><span class="ar">نوع الفاتورة</span>
<th><span class="en">Cost Total</span><span class="ar">نوع الفاتورة</span>
<th><span class="en">Gross Profit</span><span class="ar">نوع الفاتورة</span>
<th><span class="en">Net Profit</span><span class="ar">نوع الفاتورة</span>
<th><span class="en">Branch</span><span class="ar">نوع الفاتورة</span>
<th><span class="en">Inv.Type</span><span class="ar">نوع الفاتورة</span>
<th><span class="en">User</span><span class="ar">نوع الفاتورة</span>

</th>
</tr>
</thead>

<tbody>
<?php
if($pages->items_total>0){
while($single  =   myfetch($result)){ 
$stype = "";
if($single->SPType=='1')
{
$stype = "Cash";
}

if($single->SPType=='2')
{
$stype = "Credit";
}

?>
<tr>
<td><?php echo $single->Billno; ?></td>
<td><?php echo DateValue($single->BillDate); ?></td>
<td><?php echo $single->CustSupName; ?></td>
<td><?php echo AmountValue($single->Total); ?></td>
<td><?php echo AmountValue($single->Dis); ?></td>
<td><?php echo AmountValue($single->Nettotal); ?></td>
<td><?php echo AmountValue($single->totalVat); ?></td>
<td><?php echo AmountValue($single->GTotal); ?></td>
<td><?php echo AmountValue($single->totalCost); ?></td>
<td><?php echo AmountValue($single->GProfit); ?></td>
<td><?php echo AmountValue($single->NProfit); ?></td>
<td><?php echo $single->BranchName; ?></td>
<td><?php echo $stype; ?></td>
<td><?php echo $single->UserName; ?></td>
</tr>


<?php


}


}
else
{
?>
<tr>
<td colspan="14" class="text-center">
<h2><strong><span class="en">No Record(s) Found..</span><span class="ar"><?= getArabicTitle('No Record(s) Found..') ?></span></strong></h2>
</td>
</tr>
<?php

}

?>	


</tbody>

</table>

<!-- /Listing -->

<div class="clearfix"></div>



<!-- bottom pagination -->

<div class="row marginTop">

<div class="col-sm-12 paddingLeft pagerfwt">

<?php if($pages->items_total > 0) { ?>

<?php echo $pages->display_pages();?>

<?php echo $pages->display_items_per_page();?>

<?php echo $pages->display_jump_menu(); ?>

<?php }?>

</div>

<div class="clearfix"></div>

</div>

<!-- /bottom pagination -->



<div class="clearfix"></div>

<div class="clearfix"></div>










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

<script src="vouchers/reports/sales_report/sales_report.js"></script>

</body>

</html>