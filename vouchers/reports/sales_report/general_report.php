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
$GroupByType = addslashes($_POST['GroupByType']);
$OrderBy = addslashes($_POST['OrderBy']);


$GetSalesGen=GetSalesGen($branchIds, $transaction_type, $from_bill_no, $to_bill_no, $from_date, $to_date, $customer_id, $user_id, $UsrId,$from_product_id , $to_product_id, $product_group_id, $amount, $selected_lang,$amount_type,$GroupByType,$OrderBy);

?>
<div class="ibox">
	<h2>General</h2>
<div class="ibox-content this_ar">

<div class="table-responsive" >



<table
class="table table-striped table-bordered dt-responsive table-hover dataTables-example">
<thead>
<tr>
<th class="c_width"><span class="en">BillNo</span><span class="ar">المجموع</span></th>
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
foreach($GetSalesGen as $single)	
{
?>	

<tr>
<td><span class="text-warp"><?php echo $single->Billno; ?></span></td>
<td><?php echo $single->BillDate; ?></td>
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
<td><?php echo $single->stype; ?></td>
<td><?php echo $single->UserName; ?></td>
</tr>
<?php
}
?>	


</tbody>
<tfoot>
<tr>

<th class="c_width"><span class="en">BillNo(Billno)</span><span class="ar">المجموع</span></th>
<th><span class="en">BillDate(BillDate)</span><span class="ar">تخفيض</span></th>
<th><span class="en">Customer(CustSupName)</span><span class="ar">تخفيض٪</span></th>
<th><span class="en">Total(Total)</span><span class="ar">صافي
الإجمالي</span></th>
<th><span class="en">Discount(Dis)</span><span class="ar">ضريبة السلع
والخدمات توتلا</span></th>
<th><span class="en">NetTotal(Nettotal)</span><span class="ar">المبلغ
الإجمالي</span></th>
<th><span class="en">VatTotal(totalVat)</span><span class="ar">نوع الفاتورة</span></th>
<th><span class="en">Grand Total(GTotal)</span><span class="ar">نوع الفاتورة</span>
<th><span class="en">Cost Total(totalCost)</span><span class="ar">نوع الفاتورة</span>
<th><span class="en">Gross Profit(GProfit)</span><span class="ar">نوع الفاتورة</span>
<th><span class="en">Net Profit(NProfit)</span><span class="ar">نوع الفاتورة</span>
<th><span class="en">Branch(BranchName)</span><span class="ar">نوع الفاتورة</span>
<th><span class="en">Inv.Type(stype)</span><span class="ar">نوع الفاتورة</span>
<th><span class="en">User(UserName)</span><span class="ar">نوع الفاتورة</span>

</th>
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