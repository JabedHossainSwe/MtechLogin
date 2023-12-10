<?php


 echo $sql_ = "EXEC  GetSalesGen @bid='".$bid."',@GroupByType='".$GroupByType."',@SpType='".$SpType."',@FBillno='".$FBillno."',@TBillno='".$TBillno."',@dt='".$dt."',@dt2='".$dt2."',@CustSupId='".$CustSupId."',@UsrId='".$UsrId."',@CrAmount='".$amount_type."".$CrAmount."',@LanguageId='".$LanguageId."',@OrderBy='".$OrderBy."',@DataType=1,@FRecNo=0,@ToRecNo=15";
$sql_forms = Run($sql_);
 $tolrec = myfetch($sql_forms)->RecNo;
die();


//$sumQuery = Run("EXEC  GetSalesGen @bid='".$bid."',@GroupByType='".$GroupByType."',@SpType='".$SpType."',@FBillno='".$FBillno."',@TBillno='".$TBillno."',@dt='".$dt."',@dt2='".$dt2."',@CustSupId='".$CustSupId."',@UsrId='".$UsrId."',@CrAmount='".$amount_type."".$CrAmount."',@LanguageId='".$LanguageId."',@OrderBy='".$OrderBy."',@DataType=2,@FRecNo=0,@ToRecNo=15");
//$fetchAllTotals = myfetch($sumQuery);











$pages->default_ipp = 15;
$pages->items_total = $tolrec;	
$pages->mid_range = 9;
$pages->paginate();	

 $newQuery = "EXEC  GetSalesGen @bid='".$bid."',@GroupByType='".$GroupByType."',@SpType='".$SpType."',@FBillno='".$FBillno."',@TBillno='".$TBillno."',@dt='".$dt."',@dt2='".$dt2."',@CustSupId='".$CustSupId."',@UsrId='".$UsrId."',@CrAmount='".$amount_type."".$CrAmount."',@LanguageId='".$LanguageId."',@OrderBy='".$OrderBy."',@DataType=3,".$pages->limit."";
$result	=	Run($newQuery);
//// $querySUm///////////




?>


<div class="row">
<div class="col-lg-12">
<table class="table">
<thead>
<tr>
<th>
<?php

$class= "info";
if($fetchAllTotals->Total<0)
{
$class= "danger";

}
?>	


<button type="button" class="btn btn-<?php echo $class; ?>  m-r-sm"><?php echo AmountValue($fetchAllTotals->Total); ?></button>
Total
</th>
	
<th>
<?php

$class= "info";
if($fetchAllTotals->Discount<0)
{
$class= "danger";

}
?>	


<button type="button" class="btn btn-<?php echo $class; ?>  m-r-sm"><?php echo AmountValue($fetchAllTotals->Discount); ?></button>
Discount
</th>
	

<th>
<?php

$class= "info";
if($fetchAllTotals->NetTotal<0)
{
$class= "danger";

}
?>	


<button type="button" class="btn btn-<?php echo $class; ?>  m-r-sm"><?php echo AmountValue($fetchAllTotals->NetTotal); ?></button>
Net Total
</th>

<th>
<?php

$class= "info";
if($fetchAllTotals->totalVat<0)
{
$class= "danger";

}
?>	


<button type="button" class="btn btn-<?php echo $class; ?>  m-r-sm"><?php echo AmountValue($fetchAllTotals->totalVat); ?></button>
Vat Total
</th>
	</tr>
	<tr>
<th>
<?php

$class= "info";
if($fetchAllTotals->vatPTotal<0)
{
$class= "danger";

}
?>	


<button type="button" class="btn btn-<?php echo $class; ?>  m-r-sm"><?php echo AmountValue($fetchAllTotals->vatPTotal); ?></button>
Grand Total
</th>
	
	

<th>
<?php

$class= "info";
if($fetchAllTotals->totalCost<0)
{
$class= "danger";

}
?>	


<button type="button" class="btn btn-<?php echo $class; ?>  m-r-sm"><?php echo AmountValue($fetchAllTotals->totalCost); ?></button>
Cost Total
</th>	
	
	
<th>
<?php

$class= "info";
if($fetchAllTotals->NProfit<0)
{
$class= "danger";

}
?>	


<button type="button" class="btn btn-<?php echo $class; ?>  m-r-sm"><?php echo AmountValue($fetchAllTotals->NProfit); ?></button>
Profit
	</th>
	<th></th>
</tr>
	
	
	
</thead>
</table>
	
</div>

</div>
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
<th><span class="en">
	NetTotal
	</span><span class="ar">المبلغ
الإجمالي</span></th>
<th><span class="en">VatTotal</span><span class="ar">نوع الفاتورة</span>
</th>
<th><span class="en">Grand Total</span><span class="ar">نوع الفاتورة</span>
<th><span class="en">Cost Total</span><span class="ar">نوع الفاتورة</span>
<th><span class="en">Profit</span><span class="ar">نوع الفاتورة</span>
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
<td><?php if($single->BillNo!='0'){  echo $single->BillNo; } ?></td>
<td><?php if($single->dttime!=''){ echo DateValue($single->dttime);} ?></td>
<td><?php echo $single->CustSupName; ?></td>
<td><?php echo AmountValue($single->Total); ?></td>
<td><?php echo AmountValue($single->Discount); ?></td>

<td><?php echo AmountValue($single->NetTotal); ?></td>
<td><?php echo AmountValue($single->totalVat); ?></td>
<td><?php echo AmountValue($single->vatPTotal); ?></td>
<td><?php echo AmountValue($single->totalCost); ?></td>
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
<script>
    $(document).ready(function () {
        var lang = document.getElementById("selected_lang").value;
        changeLanguage(lang);
    });
</script>