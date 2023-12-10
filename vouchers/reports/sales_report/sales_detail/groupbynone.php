<?php
$qqst = "SELECT  count(sdet.BillNo) as tol FROM (Product INNER JOIN (Emp INNER JOIN (DataoutDetail sdet  LEFT JOIN CustFile ON sdet.CSID = CustFile.Cid) ON Emp.Cid = sdet.EmpID)
 ON Product.PID = sdet.PID) INNER JOIN Units ON sdet.Uid = Units.ParaID LEFT JOIN ProductGroup ON Product.PGID = ProductGroup.Gid Inner Join Branch  On sdet.bid=Branch.bid
".$condition." ";
$pages->default_ipp = 15;


$sql_forms = Run($qqst);

$tolrec = myfetch($sql_forms);	

$pages->items_total = $tolrec->tol;

$pages->mid_range = 9;

$pages->paginate();	




 $qq = "
Select Branch.BName BranchName,sdet.BillNo, sdet.SPType, 
CAST(CONVERT(VARCHAR(10),sdet.billdate,121) AS DATETIME) + space(1) + sdet.CompTime as BillDate, 
sdet.bid,sdet.vatPer VatPerCent,sdet.vatAmt VatAmount,sdet.vatTotal VatTotal,sdet.vatPTotal GrandTotal, 
sdet.ResEmpID,sdet.EmpID,emp.CName UserName,sdet.CPrice CostPrice,sdet.Bonus Bonus,sdet.UID,sdet.PID,
Product.PCode ProductCode, Product.PName ProductName,Product.PGID, ProductGroup.NameArb as ProductGroup ,sdet.Qty Quantity, sdet.Price Price, 
sdet.NetTotal NetTotal, CustFile.CName as Customer, Units.ParaName UnitName, sdet.CSID,
sdet.cpp CurrentPurPrice,sdet.cst CostTotal,sdet.csp Profit, 
case When (sdet.cst=0) then (0) When (sdet.cst Is Null) Then (0) Else round((sdet.csp/sdet.cst)*100,2) End as ProfitPer,
sdet.AdvPer,sdet.AdvAmt,sdet.GGTotal,sdet.bid

 FROM (Product INNER JOIN (Emp INNER JOIN (DataoutDetail sdet  LEFT JOIN CustFile ON sdet.CSID = CustFile.Cid) ON Emp.Cid = sdet.EmpID)
 ON Product.PID = sdet.PID) INNER JOIN Units ON sdet.Uid = Units.ParaID LEFT JOIN ProductGroup ON Product.PGID = ProductGroup.Gid
 Inner Join Branch  On sdet.bid=Branch.bid 

 ".$condition."  $OrderBy ".$pages->limit."";

$result	=	Run($qq);

// QUERY END



//// $querySUm///////////
 $sumQuery = "Select SUM(sdet.Qty) as ToQuantity,
 SUM(sdet.Bonus) as ToBonus,SUM(sdet.Price) as ToPrice,SUM(sdet.Discount) as ToDiscount,SUM(sdet.vatPer) as TovatPer,SUM(sdet.vatAmt) as TovatAmt,SUM(sdet.vatTotal) as TovatTotal,SUM(sdet.vatPTotal) as TovatPTotal,SUM(sdet.CPrice) as ToCPrice,SUM(sdet.cst) as Tocst
 ,SUM(sdet.csp) as Tocsp
 
 
FROM (Product INNER JOIN (Emp INNER JOIN (DataoutDetail sdet LEFT JOIN CustFile ON sdet.CSID = CustFile.Cid) ON Emp.Cid = sdet.EmpID) 
ON Product.PID = sdet.PID) INNER JOIN Units ON sdet.Uid = Units.ParaID 
Inner Join Branch On sdet.bid=Branch.bid  
".$condition."";
$takeQuery = Run($sumQuery);
$fetchAllTotals = myfetch($takeQuery);




?>	

<div class="clearfix"></div>

<div class="row">
<div class="col-lg-12">
<table class="table">
<thead>
<tr>
<th>
<?php

$class= "info";
if($fetchAllTotals->ToQuantity<0)
{
$class= "danger";

}
?>	
	
	
<button type="button" class="btn btn-<?php echo $class; ?>  m-r-sm"><?php echo AmountValue($fetchAllTotals->ToQuantity); ?></button>
Quantity
</th>
<th>
<?php

$class= "info";
if($fetchAllTotals->ToBonus<0)
{
$class= "danger";

}
?>	
	
	
<button type="button" class="btn btn-<?php echo $class; ?>  m-r-sm"><?php echo AmountValue($fetchAllTotals->ToBonus); ?></button>
Bonus
</th>
<th>
	
<?php

$class= "info";
if($fetchAllTotals->ToPrice<0)
{
$class= "danger";

}
?>	
	
	
<button type="button" class="btn btn-<?php echo $class; ?> m-r-sm"><?php echo AmountValue($fetchAllTotals->ToPrice); ?></button>
Price
</th>
<th>
	
<?php

$class= "info";
if($fetchAllTotals->ToDiscount<0)
{
$class= "danger";

}
?>	
	
	
<button type="button" class="btn btn-<?php echo $class; ?> m-r-sm"><?php echo AmountValue($fetchAllTotals->ToDiscount); ?></button>
Discount
</th>	
<th>
<?php

$class= "info";
if($fetchAllTotals->TovatAmt<0)
{
$class= "danger";

}
?>	
	
	
<button type="button" class="btn btn-<?php echo $class; ?>  m-r-sm"><?php echo AmountValue($fetchAllTotals->TovatAmt); ?></button>
VatAmount
</th>	
	
</tr>
	
<tr>


<th>
	
<?php

$class= "info";
if($fetchAllTotals->TovatTotal<0)
{
$class= "danger";

}
?>	
	
	
<button type="button" class="btn btn-<?php echo $class; ?> m-r-sm"><?php echo AmountValue($fetchAllTotals->TovatTotal); ?></button>
Vat Total
</th>
<th>
	
<?php

$class= "info";
if($fetchAllTotals->TovatPTotal<0)
{
$class= "danger";

}
?>	
	
	
<button type="button" class="btn btn-<?php echo $class; ?> m-r-sm"><?php echo AmountValue($fetchAllTotals->TovatPTotal); ?></button>
GrandTotal
</th>	
	
<th>
<?php

$class= "info";
if($fetchAllTotals->ToCPrice<0)
{
$class= "danger";

}
?>	
	
	
<button type="button" class="btn btn-<?php echo $class; ?>  m-r-sm"><?php echo AmountValue($fetchAllTotals->ToCPrice); ?></button>
Cost Price
</th>
	
	
	<th>
<?php

$class= "info";
if($fetchAllTotals->Tocst<0)
{
$class= "danger";

}
?>	
	
	
<button type="button" class="btn btn-<?php echo $class; ?>  m-r-sm"><?php echo AmountValue($fetchAllTotals->Tocst); ?></button>
Cost Total
</th>
	
	<th>
	
<?php

$class= "info";
if($fetchAllTotals->Tocsp<0)
{
$class= "danger";

}
?>	
	
	
<button type="button" class="btn btn-<?php echo $class; ?> m-r-sm"><?php echo AmountValue($fetchAllTotals->Tocsp); ?></button>
Profit
</th>
</tr>	

	

	
	
	
</thead>
</table>
	
</div>

</div>

<!-- Listing -->

<table class="table table-striped table-bordered dt-responsive table-hover ">

<thead>
<tr>

<th><span class="en">BillNo</span><span class="ar">تخفيض</span></th>
<th><span class="en">Bill Date</span><span class="ar">تخفيض٪</span></th>

<th><span class="en">Product Code</span><span class="ar">ضريبة السلع
والخدمات توتلا</span></th>
<th><span class="en">Product Name</span><span class="ar">المبلغ
الإجمالي</span></th>
	
	<th><span class="en">Product Group</span><span class="ar">المبلغ
الإجمالي</span></th>
<th><span class="en">Quantity</span><span class="ar">نوع الفاتورة</span>
</th>
<th><span class="en">Bonus</span><span class="ar">نوع الفاتورة</span>
<th><span class="en">Unit Name</span><span class="ar">نوع الفاتورة</span>
<th><span class="en">Price</span><span class="ar">نوع الفاتورة</span>
<th><span class="en">Discount</span><span class="ar">نوع الفاتورة</span>
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

<th><span class="en">Customer</span><span class="ar">صافي
الإجمالي</span></th>
<th class=""><span class="en">BranchName</span><span class="ar">المجموع</span></th>
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
<td><?php echo $single->BillNo; ?></td>
<td><?php echo DateValue($single->BillDate); ?></td>
<td><?php echo $single->ProductCode; ?></td>
<td><?php echo $single->ProductName; ?></td>
<td><?php echo $single->ProductGroup; ?></td>
<td><?php echo $single->Quantity; ?></td>
<td><?php echo $single->Bonus; ?></td>
<td><?php echo $single->UnitName; ?></td>
<td><?php echo AmountValue($single->Price); ?></td>
<td><?php echo AmountValue($single->Discount); ?></td>

<td><?php echo AmountValue($single->NetTotal); ?></td>




<td><?php echo AmountValue($single->VarPercent); ?></td>
<td><?php echo AmountValue($single->VatAmount); ?></td>
<td><?php echo AmountValue($single->VatTotal); ?></td>
<td><?php echo AmountValue($single->GrandTotal); ?></td>
<td><?php echo AmountValue($single->CostPrice); ?></td>
<td><?php echo AmountValue($single->CostTotal); ?></td>
<td><?php echo AmountValue($single->Profit); ?></td>
<td><?php echo AmountValue($single->ProfitPer); ?></td>
<td><?php echo $stype; ?></td>
<td><?php echo $single->UserName; ?></td>
<td><?php echo $single->CustSupName; ?></td>

<td><?php echo $single->BranchName; ?></td>

</tr>


<?php


}


}
else
{
?>
<tr>
<td colspan="23" class="text-center">
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









