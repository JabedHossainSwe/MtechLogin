<?php
error_reporting(0);
// include("../../../config/functions.php");
$UsrId = "";
$selected_lang = addslashes($_POST['selected_lang']);
$branch_all_select = addslashes($_POST['branch_all_select']);
$branchIds = addslashes(implode(",",$_POST['branch']));

if(empty($branchIds)){ $branchIds = "All"; }

$from_bill_no = addslashes($_POST['from_bill_no']);
$to_bill_no = addslashes($_POST['to_bill_no']);
$from_date = addslashes($_POST['from_date']);
$to_date = addslashes($_POST['to_date']);

if($from_date!='')
{
	$from_date = date("Y-m-d",strtotime($from_date));
}


$to_date = addslashes($_POST['to_date']);


if($to_date!='')
{
	$to_date = date("Y-m-d",strtotime($to_date));
}



$customer_id = addslashes($_POST['customer_id']);
$customer_name = addslashes($_POST['customer_name']);
$user_id = addslashes($_POST['user_id']);
$user_name = addslashes($_POST['user_name']);
$from_product_id = addslashes($_POST['from_product_id']);
$from_product_name = addslashes($_POST['from_product_name']);
$to_product_id = addslashes($_POST['to_product_id']);
$product_group_id = addslashes($_POST['product_group_id']);
$product_group_name = addslashes($_POST['product_group_name']);
$amount = addslashes($_POST['amount']);
$report_type = addslashes($_POST['report_type']);
$transaction_type = addslashes($_POST['transaction_type']);
$amount_type = addslashes($_POST['amount_type']);
$OrderBy = addslashes($_POST['OrderBy']);


$GetSalesDet=GetSalesDet($branchIds, $transaction_type, $from_bill_no, $to_bill_no, $from_date, $to_date, $customer_id, $user_id, $UsrId,$from_product_id , $to_product_id, $product_group_id, $amount, $selected_lang,$amount_type,$OrderBy);




?>
<div class="ibox">
	<h2>Report (Detail)</h2>
<div class="ibox-content this_ar">

<div class="table-responsive" >



<table
class="table table-striped table-bordered dt-responsive table-hover dataTables-example">
<thead>
<tr>
<th class="c_width"><span class="en">BranchName</span><span class="ar">المجموع</span></th>
<th><span class="en">BillNo</span><span class="ar">تخفيض</span></th>
<th><span class="en">Bill Date</span><span class="ar">تخفيض٪</span></th>
<th><span class="en">Customer</span><span class="ar">صافي
الإجمالي</span></th>
<th><span class="en">Product Code</span><span class="ar">ضريبة السلع
والخدمات توتلا</span></th>
<th><span class="en">Product Name</span><span class="ar">المبلغ
الإجمالي</span></th>
<th><span class="en">Quantity</span><span class="ar">نوع الفاتورة</span>
</th>
<th><span class="en">Bonus</span><span class="ar">نوع الفاتورة</span>
<th><span class="en">Unit Name</span><span class="ar">نوع الفاتورة</span>
<th><span class="en">Price</span><span class="ar">نوع الفاتورة</span>
<th><span class="en">Total</span><span class="ar">نوع الفاتورة</span>
<th><span class="en">Vat%</span><span class="ar">نوع الفاتورة</span>
<th><span class="en">Vat Amount</span><span class="ar">نوع الفاتورة</span>
<th><span class="en">Vat Total</span><span class="ar">نوع الفاتورة</span>
<th><span class="en">Grand Total </span><span class="ar">نوع الفاتورة</span>
<th><span class="en">Cost Price</span><span class="ar">نوع الفاتورة</span>
<th><span class="en">CostTotal</span><span class="ar">نوع الفاتورة</span>
<th><span class="en">Profit</span><span class="ar">نوع الفاتورة</span>
<th><span class="en">Profit%</span><span class="ar">نوع الفاتورة</span>
<th><span class="en">Inv.Type</span><span class="ar">نوع الفاتورة</span>
<th><span class="en">User</span><span class="ar">نوع الفاتورة</span>



</th>
</tr>
</thead>
<tbody>
<?php
foreach($GetSalesDet as $single)
{
	
?>	

<tr>
<td><span class="text-warp"><?php echo $single->BranchName; ?> </span></td>
<td><?php echo $single->BillNo; ?></td>
<td><?php echo $single->BillDate; ?></td>
<td><?php echo $single->Customer; ?></td>
<td><?php echo $single->ProductCode; ?></td>
<td><?php echo $single->ProductName; ?></td>
<td><?php echo $single->Quantity; ?></td>
<td><?php echo $single->Bonus; ?></td>
<td><?php echo $single->UnitName; ?></td>
<td><?php echo AmountValue($single->Price); ?></td>
<td><?php echo AmountValue($single->NetTotal); ?></td>
<td><?php echo AmountValue($single->VatPerCent); ?></td>
<td><?php echo AmountValue($single->VatAmount); ?></td>
<td><?php echo AmountValue($single->VatTotal); ?></td>
<td><?php echo AmountValue($single->GrandTotal); ?></td>
<td><?php echo AmountValue($single->CurrentPurPrice); ?></td>
<td><?php echo AmountValue($single->CostTotal); ?></td>
<td><?php echo AmountValue($single->Profit); ?></td>
<td><?php echo $single->ProfitPer; ?></td>
<td><?php echo $single->stype; ?></td>
<td><?php echo $single->UserName; ?></td>
</tr>
<?php
}
	?>


</tbody>
<tfoot>
<tr>

<th class="c_width"><span class="en">BranchName(BName)</span><span class="ar">المجموع</span></th>
<th><span class="en">BillNo(BillNo)</span><span class="ar">تخفيض</span></th>
<th><span class="en">Bill Date(BillDate)</span><span class="ar">تخفيض٪</span></th>
<th><span class="en">Customer(Customer)</span><span class="ar">صافي
الإجمالي</span></th>
<th><span class="en">Product Code (ProductCode)</span><span class="ar">ضريبة السلع
والخدمات توتلا</span></th>
<th><span class="en">Product Name(ProductName)</span><span class="ar">المبلغ
الإجمالي</span></th>
<th><span class="en">Quantity(Quantity)</span><span class="ar">نوع الفاتورة</span>
</th>
<th><span class="en">Bonus(Bonus)</span><span class="ar">نوع الفاتورة</span>
<th><span class="en">Unit Name(UnitName)</span><span class="ar">نوع الفاتورة</span>
<th><span class="en">Price(Price)</span><span class="ar">نوع الفاتورة</span>
<th><span class="en">Total(NetTotal)</span><span class="ar">نوع الفاتورة</span>
<th><span class="en">Vat%(VatPerCent)</span><span class="ar">نوع الفاتورة</span>
<th><span class="en">Vat Amount(VatAmount)</span><span class="ar">نوع الفاتورة</span>
<th><span class="en">Vat Total(VatTotal)</span><span class="ar">نوع الفاتورة</span>
<th><span class="en">Grand Total(GrandTotal) </span><span class="ar">نوع الفاتورة</span>
<th><span class="en">Cost Price(CurrentPurPrice) </span><span class="ar">نوع الفاتورة</span>
<th><span class="en">CostTotal(CostTotal) </span><span class="ar">نوع الفاتورة</span>
<th><span class="en">Profit(Profit) </span><span class="ar">نوع الفاتورة</span>
<th><span class="en">Profit%(ProfitPer) </span><span class="ar">نوع الفاتورة</span>
<th><span class="en">Inv.Type(stype) </span><span class="ar">نوع الفاتورة</span>
<th><span class="en">User(UserName)</span><span class="ar">نوع الفاتورة</span>
</tr>
</tfoot>
</table>
</div>

</div>
</div>

<script>
$('.dataTables-example').DataTable({
pageLength: 10,
responsive: true,
dom: '<"html5buttons"B>lTfgitp',
buttons: [{
extend: 'csv'
},
{
extend: 'excel',
title: 'ExampleFile'
},
{
extend: 'pdf',
title: 'ExampleFile'
},

{
extend: 'print',
customize: function (win) {
$(win.document.body).addClass('white-bg');
$(win.document.body).css('font-size', '10px');

$(win.document.body).find('table')
.addClass('compact')
.css('font-size', 'inherit');
}
}
]

});

</script>