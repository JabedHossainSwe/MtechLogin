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


$GetSalesGroup=GetSalesGroup($branchIds, $transaction_type, $from_bill_no, $to_bill_no, $from_date, $to_date, $customer_id, $user_id, $UsrId,$from_product_id , $to_product_id, $product_group_id, $amount, $selected_lang,$amount_type);

?>
<div class="ibox">
	<h2>Group Report</h2>
<div class="ibox-content this_ar">

<div class="table-responsive" >



<table
class="table table-striped table-bordered dt-responsive table-hover dataTables-example">
<thead>
<tr>
<th class="c_width"><span class="en">GroupName</span><span class="ar">المجموع</span></th>
<th><span class="en">qty</span><span class="ar">تخفيض</span></th>
<th><span class="en">nettotal</span><span class="ar">تخفيض٪</span></th>
<th><span class="en">cTotal</span><span class="ar">صافي
الإجمالي</span></th>
<th><span class="en">Srqty</span><span class="ar">ضريبة السلع
والخدمات توتلا</span></th>
<th><span class="en">SrTotal</span><span class="ar">المبلغ
الإجمالي</span></th>
<th><span class="en">SrCost</span><span class="ar">نوع الفاتورة</span>
</th>
<th><span class="en">StkOutqty</span><span class="ar">نوع الفاتورة</span>
<th><span class="en">StkOutTotal</span><span class="ar">نوع الفاتورة</span>
<th><span class="en">StkOutCost</span><span class="ar">نوع الفاتورة</span>
<th><span class="en">vatAmt</span><span class="ar">نوع الفاتورة</span>
<th><span class="en">vatPTotal</span><span class="ar">نوع الفاتورة</span>
<th><span class="en">vatAmtsr</span><span class="ar">نوع الفاتورة</span>
<th><span class="en">vatPTotalsr</span><span class="ar">نوع الفاتورة</span>

</th>
</tr>
</thead>
<tbody>
<?php
foreach($GetSalesGroup as $single)
{
?>	
	
<tr>
<td><span class="text-warp"><?php echo $single->GroupName; ?> </span></td>
<td><?php echo $single->qty; ?></td>
<td><?php echo AmountValue($single->nettotal); ?></td>
<td><?php echo AmountValue($single->cTotal); ?></td>
<td><?php echo $single->Srqty; ?></td>
<td><?php echo AmountValue($single->SrTotal); ?></td>
<td><?php echo AmountValue($single->SrCost); ?></td>
<td><?php echo $single->StkOutqty; ?></td>
<td><?php echo AmountValue($single->StkOutTotal); ?></td>
<td><?php echo AmountValue($single->StkOutCost); ?></td>
<td><?php echo AmountValue($single->vatAmt); ?></td>
<td><?php echo AmountValue($single->vatPTotal); ?></td>
<td><?php echo $single->vatAmtsr; ?></td>
<td><?php echo AmountValue($single->vatPTotalsr); ?></td>

</tr>	
	
	
	
<?php	
}
	
?>	





</tbody>
<tfoot>
<tr>

<th class="c_width"><span class="en">GroupName</span><span class="ar">المجموع</span></th>
<th><span class="en">qty</span><span class="ar">تخفيض</span></th>
<th><span class="en">nettotal</span><span class="ar">تخفيض٪</span></th>
<th><span class="en">cTotal</span><span class="ar">صافي
الإجمالي</span></th>
<th><span class="en">Srqty</span><span class="ar">ضريبة السلع
والخدمات توتلا</span></th>
<th><span class="en">SrTotal</span><span class="ar">المبلغ
الإجمالي</span></th>
<th><span class="en">SrCost</span><span class="ar">نوع الفاتورة</span>
</th>
<th><span class="en">StkOutqty</span><span class="ar">نوع الفاتورة</span>
<th><span class="en">StkOutTotal</span><span class="ar">نوع الفاتورة</span>
<th><span class="en">StkOutCost</span><span class="ar">نوع الفاتورة</span>
<th><span class="en">vatAmt</span><span class="ar">نوع الفاتورة</span>
<th><span class="en">vatPTotal</span><span class="ar">نوع الفاتورة</span>
<th><span class="en">vatAmtsr</span><span class="ar">نوع الفاتورة</span>
<th><span class="en">vatPTotalsr</span><span class="ar">نوع الفاتورة</span>

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