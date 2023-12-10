<?php


	
$qqst = "SELECT count(Branch.BName) as tol
FROM Branch INNER JOIN DataOut ON Branch.Bid = DataOut.Bid LEFT OUTER JOIN
Emp ON DataOut.EmpID = Emp.Cid LEFT OUTER JOIN CustFile ON DataOut.CSID = CustFile.Cid  
$condition
Group by DataOut.bid,Branch.BName, ISNULL(CustFile.CName,null), ISNULL(DataOut.CSID,0) order by Branch.BName ASC";	
	$sql_forms = Run($qqst);
$tolrec = rcount($sql_forms);	

$pages->default_ipp = 15;
$pages->items_total = $tolrec;	
$pages->mid_range = 9;
$pages->paginate();	

$qq = "Select sum(ISNULL(DataOut.GGTotal,0)) as GGTotal,
sum(ISNULL(DataOut.totalVat,0)) as totalVat, sum(ISNULL(DataOut.vatPTotal,0)) as GTotal,0 as SPType,
0 as BillNo, null as BillDate, sum(ISNULL(DataOut.Total,0)) as Total,sum(ISNULL(DataOut.Discount,0)) as Discount,
sum(ISNULL(DataOut.NetTotal,0)) as NetTotal, ISNULL(CustFile.CName,null) AS CustSupName,ISNULL(DataOut.CSID,0) AS CSID,
sum(ISNULL(DataOut.totalCost,0)) as totalCost,sum(ISNULL(DataOut.GProfit,0)) as GProfit,
sum(ISNULL(DataOut.vatPTotal,0) - ISNULL(DataOut.totalCost,0)) as GrossProfitWithTax,
Branch.BName BranchName  
FROM Branch INNER JOIN DataOut ON Branch.Bid = DataOut.Bid LEFT OUTER JOIN
Emp ON DataOut.EmpID = Emp.Cid LEFT OUTER JOIN CustFile ON DataOut.CSID = CustFile.Cid 

$condition

Group by DataOut.bid,Branch.BName, ISNULL(CustFile.CName,null), ISNULL(DataOut.CSID,0)
order by Branch.BName ASC"
.$pages->limit;
//echo $qq;
	
$result	=	Run($qq);





//// $querySUm///////////
 $sumQuery = "Select SUM(DataOut.Total) as ToToal,SUM(DataOut.Discount) as DisTotal,SUM(DataOut.NetTotal) as ToNetTotal ,SUM(DataOut.totalVat) as ToVatTotal ,SUM(DataOut.vatPTotal) as ToGTotal,SUM(DataOut.totalCost) as ToCostTotal,SUM(DataOut.GProfit) as ToGProTotal ,SUM(DataOut.vatPTotal-DataOut.totalCost) as ToGProTaxTotal

FROM Branch INNER JOIN DataOut ON Branch.Bid = DataOut.Bid 
LEFT OUTER JOIN Emp ON DataOut.EmpID = Emp.Cid
LEFT OUTER JOIN CustFile ON DataOut.CSID = CustFile.Cid 
$condition ";
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
if($fetchAllTotals->ToToal<0)
{
$class= "danger";

}
?>	
	
	
<button type="button" class="btn btn-<?php echo $class; ?>  m-r-sm"><?php echo AmountValue($fetchAllTotals->ToToal); ?></button>
Total
</th>
<th>
<?php

$class= "info";
if($fetchAllTotals->DisTotal<0)
{
$class= "danger";

}
?>	
	
	
<button type="button" class="btn btn-<?php echo $class; ?>  m-r-sm"><?php echo AmountValue($fetchAllTotals->DisTotal); ?></button>
Discount
</th>
<th>
	
<?php

$class= "info";
if($fetchAllTotals->ToNetTotal<0)
{
$class= "danger";

}
?>	
	
	
<button type="button" class="btn btn-<?php echo $class; ?> m-r-sm"><?php echo AmountValue($fetchAllTotals->ToNetTotal); ?></button>
NetTotal
</th>
<th>
	
<?php

$class= "info";
if($fetchAllTotals->ToVatTotal<0)
{
$class= "danger";

}
?>	
	
	
<button type="button" class="btn btn-<?php echo $class; ?> m-r-sm"><?php echo AmountValue($fetchAllTotals->ToVatTotal); ?></button>
VatTotal
</th>	
	
	
</tr>
<tr>
<th>
	
	
<?php

$class= "info";
if($fetchAllTotals->ToGTotal<0)
{
$class= "danger";

}
?>		
	
	
<button type="button" class="btn btn-<?php echo $class; ?> m-r-sm"><?php echo AmountValue($fetchAllTotals->ToGTotal); ?></button>
Grand Total
</th>	

<th>
<?php

$class= "info";
if($fetchAllTotals->ToCostTotal<0)
{
$class= "danger";

}
?>	
	
<button type="button" class="btn btn-<?php echo $class; ?> m-r-sm"><?php echo AmountValue($fetchAllTotals->ToCostTotal); ?></button>
Cost Total
</th>		
	
<th>
<?php

$class= "info";
if($fetchAllTotals->ToGProTotal<0)
{
$class= "danger";

}
?>	
	
<button type="button" class="btn btn-<?php echo $class; ?> m-r-sm"><?php echo AmountValue($fetchAllTotals->ToGProTotal); ?></button>
Gross Profit
</th>
	
<th>
	
<?php

$class= "info";
if($fetchAllTotals->ToGProTaxTotal<0)
{
$class= "danger";

}
?>		
	
<button type="button" class="btn btn-<?php echo $class; ?> m-r-sm"><?php echo AmountValue($fetchAllTotals->ToGProTaxTotal); ?></button>
Gross Profit Including Tax
</th>	
	
</tr>	
	
	
</thead>
</table>
	
</div>

</div>
<table class="table table-striped table-bordered dt-responsive table-hover ">

<thead>
<tr>

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
<th><span class="en">Gross Profit</span><span class="ar">نوع الفاتورة</span>
<th><span class="en">Gross Profit Including Tax</span><span class="ar">نوع الفاتورة</span>
<th><span class="en">Branch</span><span class="ar">نوع الفاتورة</span>


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

<td><?php echo $single->CustSupName; ?></td>
<td><?php echo AmountValue($single->Total); ?></td>
<td><?php echo AmountValue($single->Discount); ?></td>

<td><?php echo AmountValue($single->NetTotal); ?></td>
<td><?php echo AmountValue($single->totalVat); ?></td>
<td><?php echo AmountValue($single->GTotal); ?></td>
<td><?php echo AmountValue($single->totalCost); ?></td>
<td><?php echo AmountValue($single->GProfit); ?></td>
<td><?php echo AmountValue($single->GrossProfitWithTax); ?></td>
<td><?php echo $single->BranchName; ?></td>

</tr>


<?php


}


}
else
{
?>
<tr>
<td colspan="9" class="text-center"><h2><strong><span class="en">No Record(s) Found..</span><span class="ar"><?= getArabicTitle('No Record(s) Found..') ?></span></strong></h2></td>
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
