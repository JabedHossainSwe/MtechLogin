<?php
$qqst = "Select Gid,GroupName,sum(qty) as qty,sum(Nettotal) as nettotal,sum(CTotal) as cTotal,
sum(Srqty) as Srqty,sum(SrTotal) as SrTotal,sum(SrCost) as SrCost,sum(StkOutqty) as StkOutqty,
sum(StkOutTotal) as StkOutTotal,sum(StkOutCost) as StkOutCost,sum(vatAmt) as vatAmt,sum(vatPTotal) as vatPTotal,
sum(vatAmtsr) as vatAmtsr,sum(vatPTotalsr) as vatPTotalsr from TempData Where posid=2 and reptype='S'
Group By Gid,GroupName Order By GroupName";	
$sql_forms = Run($qqst);
$tolrec = rcount($sql_forms);		

$pages->default_ipp = 15;
$pages->items_total = $tolrec;	
$pages->mid_range = 9;
$pages->paginate();	


 $qq = "Select Gid,GroupName,sum(qty) as qty,sum(Nettotal) as nettotal,sum(CTotal) as cTotal,
sum(Srqty) as Srqty,sum(SrTotal) as SrTotal,sum(SrCost) as SrCost,sum(StkOutqty) as StkOutqty,
sum(StkOutTotal) as StkOutTotal,sum(StkOutCost) as StkOutCost,sum(vatAmt) as vatAmt,sum(vatPTotal) as vatPTotal,
sum(vatAmtsr) as vatAmtsr,sum(vatPTotalsr) as vatPTotalsr from TempData Where posid=2 and reptype='S'
Group By Gid,GroupName Order By GroupName"
.$pages->limit;



//echo $qq;
	
	
	
	
	
	
	
	
$result	=	Run($qq);



//// $querySUm///////////
 $sumQuery = "Select SUM(qty) as ToQty,SUM(nettotal) as Tonetotal,SUM(cTotal) as TocTotal,SUM(Srqty) as ToSrqty,SUM(SrTotal) as ToSrTotal,SUM(SrCost) as ToSrCost,SUM(StkOutqty) as ToStkOutqty,SUM(StkOutTotal) as ToStkOutTotal,SUM(StkOutCost) as ToStkOutCost,
 SUM(vatAmt) as TovatAmt,SUM(vatPTotal) as TovatPTotal,SUM(vatAmtsr) as TovatAmtsr,SUM(vatPTotalsr) as TovatPTotalsr
 
 

 from TempData Where posid=2 and reptype='S'";
$takeQuery = Run($sumQuery);
$fetchAllTotals = myfetch($takeQuery);




?>
<!-- Listing -->
<div class="row">
<div class="col-lg-12">
<table class="table">
<thead>
<tr>
<th>
<?php

$class= "info";
if($fetchAllTotals->ToQty<0)
{
$class= "danger";

}
?>	
	
	
<button type="button" class="btn btn-<?php echo $class; ?>  m-r-sm"><?php echo AmountValue($fetchAllTotals->ToQty); ?></button>
Qty
</th>
<th>
<?php

$class= "info";
if($fetchAllTotals->Tonetotal<0)
{
$class= "danger";

}
?>	
	
	
<button type="button" class="btn btn-<?php echo $class; ?>  m-r-sm"><?php echo AmountValue($fetchAllTotals->Tonetotal); ?></button>
Net Total
</th>
<th>
	
<?php

$class= "info";
if($fetchAllTotals->TocTotal<0)
{
$class= "danger";

}
?>	
	
	
<button type="button" class="btn btn-<?php echo $class; ?> m-r-sm"><?php echo AmountValue($fetchAllTotals->TocTotal); ?></button>
cTotal
</th>
<th>
	
<?php

$class= "info";
if($fetchAllTotals->ToSrqty<0)
{
$class= "danger";

}
?>	
	
	
<button type="button" class="btn btn-<?php echo $class; ?> m-r-sm"><?php echo AmountValue($fetchAllTotals->ToSrqty); ?></button>
Srqty
</th>	
	
	
</tr>
<tr>
<th>
	
	
<?php

$class= "info";
if($fetchAllTotals->ToSrTotal<0)
{
$class= "danger";

}
?>		
	
	
<button type="button" class="btn btn-<?php echo $class; ?> m-r-sm"><?php echo AmountValue($fetchAllTotals->ToSrTotal); ?></button>
SrTotal
</th>	

<th>
<?php

$class= "info";
if($fetchAllTotals->ToSrCost<0)
{
$class= "danger";

}
?>	
	
<button type="button" class="btn btn-<?php echo $class; ?> m-r-sm"><?php echo AmountValue($fetchAllTotals->ToSrCost); ?></button>
SrCost</th>		
	
<th>
<?php

$class= "info";
if($fetchAllTotals->ToStkOutqty<0)
{
$class= "danger";

}
?>	
	
<button type="button" class="btn btn-<?php echo $class; ?> m-r-sm"><?php echo AmountValue($fetchAllTotals->ToStkOutqty); ?></button>
Stock Out Qty</th>
	
<th>
	
<?php

$class= "info";
if($fetchAllTotals->ToStkOutTotal<0)
{
$class= "danger";

}
?>		
	
<button type="button" class="btn btn-<?php echo $class; ?> m-r-sm"><?php echo AmountValue($fetchAllTotals->ToStkOutTotal); ?></button>
Stock Out Total</th>	
	
</tr>	
	
	<tr>
<th>
	
	
<?php

$class= "info";
if($fetchAllTotals->ToStkOutCost<0)
{
$class= "danger";

}
?>		
	
	
<button type="button" class="btn btn-<?php echo $class; ?> m-r-sm"><?php echo AmountValue($fetchAllTotals->ToStkOutCost); ?></button>
Stock Out Cost
</th>	

<th>
<?php

$class= "info";
if($fetchAllTotals->TovatAmt<0)
{
$class= "danger";

}
?>	
	
<button type="button" class="btn btn-<?php echo $class; ?> m-r-sm"><?php echo AmountValue($fetchAllTotals->TovatAmt); ?></button>
Vat Amount</th>		
	
<th>
<?php

$class= "info";
if($fetchAllTotals->TovatPTotal<0)
{
$class= "danger";

}
?>	
	
<button type="button" class="btn btn-<?php echo $class; ?> m-r-sm"><?php echo AmountValue($fetchAllTotals->TovatPTotal); ?></button>
Vat P Total</th>
	
	
	
</tr>
</thead>
</table>
	
</div>

</div>
<table class="table table-striped table-bordered dt-responsive table-hover ">

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
if($pages->items_total>0){
while($single  =   myfetch($result)){ 


?>
<tr>
<td><span class="text-warp"><?php echo $single->GroupName; ?> </span></td>
<td><?php echo $single->qty; ?></td>
<td><?php echo AmountValue($single->nettotal); ?></td>
<td><?php echo AmountValue($single->cTotal); ?></td>
<td><?php echo AmountValue($single->Srqty); ?></td>
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


}
else
{
?>
<tr>
<td colspan="11" class="text-center"><h2><strong><span class="en">No Record(s) Found..</span><span class="ar"><?= getArabicTitle('No Record(s) Found..') ?></span></strong></h2></td>
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
