<?php
 use Mpdf\Mpdf;
session_start();
error_reporting(0);
include("../../../config/connection.php");
// include("../../../config/functions.php");
include("../../../config/main_connection.php");
include("../../../config/main_functions.php");
include("../../../config/templates.php");
$query = urldecode($_REQUEST['query']);
$LanguageId = $_REQUEST['LanguageId'];


$html='';

$servername = $_SERVER['SERVER_NAME'];
$barCode = "http://217.76.50.216/MtechMobile/vouchers/sales/QrCodes/Sale-$Billno.png";

if($servername=='localhost')
{
$barCode = "http://localhost/MtechMobile/vouchers/sales/QrCodes/Sale-$Billno.png";
}


$getLoginUserCompanyData = getLoginUserCompanyData($_SESSION['id']);


///// Language Id 1 For English ///
if($LanguageId==1)
{


$html .='<div id="Sale-Inovice" style="-webkit-print-color-adjust:exact !important;
print-color-adjust:exact !important; border: 5px solid rgba(143, 192, 235, 0.5); margin: 8px;">
<table style="width: 100%; text-align: start;" border="0">
<tr>
<th style="width: 100%; text-align: center; font-size: 1.3rem; background-color: rgb(143, 192, 235);"
colspan="5">
<h1>'.$getLoginUserCompanyData->name.'</h1>
</th>

</tr>
<tr>
<th style="text-align: start; vertical-align: top; width: 30%;">
<h2 style="font-size: 1rem ; padding-left: 5px;">'.$getLoginUserCompanyData->address.'
<br> MOB:'.$getLoginUserCompanyData->mobile.' <br> '.$getLoginUserCompanyData->email.' <br> VAT#: '.$getLoginUserCompanyData->vat.'
</h2>

</th>
<th style="vertical-align: top; width: 30%; ">
<h2 style="font-size: 1.9rem; text-align: center;">Sale Report General</h2>
<img style="text-align: left;margin-top:25px" width="80px" height="90px"
src="http://217.76.50.216/'.$getLoginUserCompanyData->logo.'" 
alt="">
</th>
<th colspan="3" style="vertical-align: top; width: 38%;">';

$html .='	
</th>
</table>
<br>
<br>
<table border="1" style="width: 100%; font-size: 1rem; border-collapse: collapse;">
<tr>
			<th style="font-weight: 500;">BillNo</th>
			<th style="font-weight: 500;">BillDateTime</th>	
			<th style="font-weight: 500;">CustSupName</th>	
			<th style="font-weight: 500;">Total</th>	
			<th style="font-weight: 500;">Discount</th>	
			<th style="font-weight: 500;">NetTotal</th>	
			<th style="font-weight: 500;">totalCost</th>	
			<th style="font-weight: 500;">NProfit</th>	
			<th style="font-weight: 500;">ProfitPer</th>	
			<th style="font-weight: 500;">totalVat</th>	
			<th style="font-weight: 500;">vatPTotal</th>	
			<th style="font-weight: 500;">stype</th>	
			<th style="font-weight: 500;">GrossProfitWithTax</th>	
			<th style="font-weight: 500;">AdvAmt</th>	
			<th style="font-weight: 500;">GGTotal</th>	
			<th style="font-weight: 500;">GSTExtVaue</th>	
			<th style="font-weight: 500;">GrandTotal</th>	
			<th style="font-weight: 500;">UserName</th>	
			<th style="font-weight: 500;">BranchName</th>
</tr>';

$counter =1;
$qtyTot = 0;
$PriceTot = 0;
$TotalTot = 0;
$vatperTot = 0;
$vatamtTot = 0;
$GrTotal = 0;

$detailsSp = Run($query);	
while($single = myfetch($detailsSp))
{
$TotalTot = $TotalTot+$single->Total;
$DiscountTot = $DiscountTot+$single->Discount;
$NetTotalTot = $NetTotalTot+$single->NetTotal;
$totalCostTot = $totalCostTot+$single->totalCost;
$NProfitTot = $NProfitTot+$single->NProfit;
$ProfitPerTot = $ProfitPerTot+$single->ProfitPer;
$totalVatTotal = $totalVatTotal+$single->totalVat;
$vatPTotalTotal = $vatPTotalTotal+$single->vatPTotal;
$GrossProfitWithTaxTotal = $GrossProfitWithTaxTotal+$single->GrossProfitWithTax;
$AdvAmtTotal = $AdvAmtTotal+$single->AdvAmt;
$GGTotalTotal = $GGTotalTotal+$single->GGTotal;
$GSTExtVaueTotal = $GSTExtVaueTotal+$single->GSTExtVaue;
$GrandTotalTotal = $GrandTotalTotal+$single->GrandTotal;


$html .='
<tr>
			<th style="font-weight: 300;">'.$single->BillNo.'</th>
			<th style="font-weight: 300;">'.DateValue($single->BillDateTime).'</th>	
			<th style="font-weight: 300;">'.$single->CustSupName.'</th>	
			<th style="font-weight: 300;">'.AmountValue($single->Total).'</th>	
			<th style="font-weight: 300;">'.AmountValue($single->Discount).'</th>	
			<th style="font-weight: 300;">'.AmountValue($single->NetTotal).'</th>	
			<th style="font-weight: 300;">'.AmountValue($single->totalCost).'</th>	
			<th style="font-weight: 300;">'.AmountValue($single->NProfit).'</th>	
			<th style="font-weight: 300;">'.AmountValue($single->ProfitPer).'</th>	
			<th style="font-weight: 300;">'.AmountValue($single->totalVat).'</th>	
			<th style="font-weight: 300;">'.AmountValue($single->vatPTotal).'</th>	
			<th style="font-weight: 300;">'.$single->stype.'</th>	
			<th style="font-weight: 300;">'.AmountValue($single->GrossProfitWithTax).'</th>	
			<th style="font-weight: 300;">'.AmountValue($single->AdvAmt).'</th>	
			<th style="font-weight: 300;">'.AmountValue($single->GGTotal).'</th>	
			<th style="font-weight: 300;">'.AmountValue($single->GSTExtVaue).'</th>	
			<th style="font-weight: 300;">'.AmountValue($single->GrandTotal).'</th>	
			<th style="font-weight: 300;">'.$single->UserName.'</th>	
			<th style="font-weight: 300;">'.$single->BranchName.'</th>
</tr>';
	$counter++;
	}
$html .='
<tr>
<th style="font-weight: 600; text-align:center;" colspan="3">Total</th>
<th style="font-weight: 600;">'.AmountValue($TotalTot).'</th>
<th style="font-weight: 600;">'.AmountValue($DiscountTot).'</th>
<th style="font-weight: 600;">'.AmountValue($NetTotalTot).'</th>
<th style="font-weight: 600;">'.AmountValue($totalCostTot).'</th>
<th style="font-weight: 600;">'.AmountValue($NProfitTot).'</th>
<th style="font-weight: 600;">'.AmountValue($ProfitPerTot).'</th>
<th style="font-weight: 600;">'.AmountValue($totalVatTotal).'</th>
<th style="font-weight: 600;">'.AmountValue($vatPTotalTotal).'</th>
<th style="font-weight: 600;"></th>
<th style="font-weight: 600;">'.AmountValue($GrossProfitWithTaxTotal).'</th>
<th style="font-weight: 600;">'.AmountValue($AdvAmtTotal).'</th>
<th style="font-weight: 600;">'.AmountValue($GGTotalTotal).'</th>
<th style="font-weight: 600;">'.AmountValue($GSTExtVaueTotal).'</th>
<th style="font-weight: 600;">'.AmountValue($GrandTotalTotal).'</th>
<th style="font-weight: 600;"></th>
<th style="font-weight: 600;"></th>

</tr>
</table>
</div>';	
}





/// Language 2 For Arabic
if($LanguageId == 2){
	$html .='<div id="Sale-Inovice" style="-webkit-print-color-adjust:exact !important;
	print-color-adjust:exact !important; border: 5px solid rgba(143, 192, 235, 0.5); margin: 8px;">
	<table style="width: 100%; text-align: start;" border="0">
	<tr>
	<th style="width: 100%; text-align: center; font-size: 1.3rem; background-color: rgb(143, 192, 235);"
	colspan="5">
	<h1>'.$getLoginUserCompanyData->name_ar.'</h1>
	</th>

	</tr>
	<tr>
	<th style="text-align: start; vertical-align: top; width: 30%;">
	<h2 style="font-size: 1rem ; padding-left: 5px;">'.$getLoginUserCompanyData->address_ar.'
	<br> MOB:'.$getLoginUserCompanyData->mobile_ar.' <br> '.$getLoginUserCompanyData->email_ar.' <br> VAT#: '.$getLoginUserCompanyData->vat_ar.'
	</h2>

	</th>
	<th style="vertical-align: top; width: 30%; ">
	<h2 style="font-size: 1.9rem; text-align: center;">
	'.getArabicTitle('Sale Report General').'
	</h2>
	<img style="text-align: left;margin-top:25px" width="80px" height="90px"
	src="http://217.76.50.216/'.$getLoginUserCompanyData->logo_ar.'" 
	alt="">
	</th>
	<th colspan="3" style="vertical-align: top; width: 38%;">';

	$html .='	
	</th>
	</table>
	<br>
	<br>
	<table border="1" style="width: 100%; font-size: 1rem; border-collapse: collapse;">
	<tr>
				<th style="font-weight: 500;">'.getArabicTitle('BillNo').'</th>
				<th style="font-weight: 500;">'.getArabicTitle('BillDateTime').'</th>	
				<th style="font-weight: 500;">'.getArabicTitle('CustSupName').'</th>	
				<th style="font-weight: 500;">'.getArabicTitle('Total').'</th>	
				<th style="font-weight: 500;">'.getArabicTitle('Discount').'</th>	
				<th style="font-weight: 500;">'.getArabicTitle('NetTotal').'</th>	
				<th style="font-weight: 500;">'.getArabicTitle('totalCost').'</th>	
				<th style="font-weight: 500;">'.getArabicTitle('NProfit').'</th>	
				<th style="font-weight: 500;">'.getArabicTitle('ProfitPer').'</th>	
				<th style="font-weight: 500;">'.getArabicTitle('totalVat').'</th>	
				<th style="font-weight: 500;">'.getArabicTitle('vatPTotal').'</th>	
				<th style="font-weight: 500;">'.getArabicTitle('stype').'</th>	
				<th style="font-weight: 500;">'.getArabicTitle('GrossProfitWithTax').'</th>	
				<th style="font-weight: 500;">'.getArabicTitle('AdvAmt').'</th>	
				<th style="font-weight: 500;">'.getArabicTitle('GGTotal').'</th>	
				<th style="font-weight: 500;">'.getArabicTitle('GSTExtVaue').'</th>	
				<th style="font-weight: 500;">'.getArabicTitle('GrandTotal').'</th>	
				<th style="font-weight: 500;">'.getArabicTitle('UserName').'</th>	
				<th style="font-weight: 500;">'.getArabicTitle('BranchName').'</th>
	</tr>';

	$counter =1;
	$qtyTot = 0;
	$PriceTot = 0;
	$TotalTot = 0;
	$vatperTot = 0;
	$vatamtTot = 0;
	$GrTotal = 0;

	$detailsSp = Run($query);	
	while($single = myfetch($detailsSp))
	{
		$TotalTot = $TotalTot+$single->Total;
		$DiscountTot = $DiscountTot+$single->Discount;
		$NetTotalTot = $NetTotalTot+$single->NetTotal;
		$totalCostTot = $totalCostTot+$single->totalCost;
		$NProfitTot = $NProfitTot+$single->NProfit;
		$ProfitPerTot = $ProfitPerTot+$single->ProfitPer;
		$totalVatTotal = $totalVatTotal+$single->totalVat;
		$vatPTotalTotal = $vatPTotalTotal+$single->vatPTotal;
		$GrossProfitWithTaxTotal = $GrossProfitWithTaxTotal+$single->GrossProfitWithTax;
		$AdvAmtTotal = $AdvAmtTotal+$single->AdvAmt;
		$GGTotalTotal = $GGTotalTotal+$single->GGTotal;
		$GSTExtVaueTotal = $GSTExtVaueTotal+$single->GSTExtVaue;
		$GrandTotalTotal = $GrandTotalTotal+$single->GrandTotal;


	$html .='
	<tr>
	<th style="font-weight: 300;">'.$single->BillNo.'</th>
	<th style="font-weight: 300;">'.DateValue($single->BillDateTime).'</th>	
	<th style="font-weight: 300;">'.$single->CustSupName.'</th>	
	<th style="font-weight: 300;">'.AmountValue($single->Total).'</th>	
	<th style="font-weight: 300;">'.AmountValue($single->Discount).'</th>	
	<th style="font-weight: 300;">'.AmountValue($single->NetTotal).'</th>	
	<th style="font-weight: 300;">'.AmountValue($single->totalCost).'</th>	
	<th style="font-weight: 300;">'.AmountValue($single->NProfit).'</th>	
	<th style="font-weight: 300;">'.AmountValue($single->ProfitPer).'</th>	
	<th style="font-weight: 300;">'.AmountValue($single->totalVat).'</th>	
	<th style="font-weight: 300;">'.AmountValue($single->vatPTotal).'</th>	
	<th style="font-weight: 300;">'.$single->stype.'</th>	
	<th style="font-weight: 300;">'.AmountValue($single->GrossProfitWithTax).'</th>	
	<th style="font-weight: 300;">'.AmountValue($single->AdvAmt).'</th>	
	<th style="font-weight: 300;">'.AmountValue($single->GGTotal).'</th>	
	<th style="font-weight: 300;">'.AmountValue($single->GSTExtVaue).'</th>	
	<th style="font-weight: 300;">'.AmountValue($single->GrandTotal).'</th>	
	<th style="font-weight: 300;">'.$single->UserName.'</th>	
	<th style="font-weight: 300;">'.$single->BranchName.'</th>
	</tr>';
		$counter++;
		}
	$html .='
	<tr>
	<th style="font-weight: 600; text-align:center;" colspan="3">Total</th>
	<th style="font-weight: 600;">'.AmountValue($TotalTot).'</th>
	<th style="font-weight: 600;">'.AmountValue($DiscountTot).'</th>
	<th style="font-weight: 600;">'.AmountValue($NetTotalTot).'</th>
	<th style="font-weight: 600;">'.AmountValue($totalCostTot).'</th>
	<th style="font-weight: 600;">'.AmountValue($NProfitTot).'</th>
	<th style="font-weight: 600;">'.AmountValue($ProfitPerTot).'</th>
	<th style="font-weight: 600;">'.AmountValue($totalVatTotal).'</th>
	<th style="font-weight: 600;">'.AmountValue($vatPTotalTotal).'</th>
	<th style="font-weight: 600;"></th>
	<th style="font-weight: 600;">'.AmountValue($GrossProfitWithTaxTotal).'</th>
	<th style="font-weight: 600;">'.AmountValue($AdvAmtTotal).'</th>
	<th style="font-weight: 600;">'.AmountValue($GGTotalTotal).'</th>
	<th style="font-weight: 600;">'.AmountValue($GSTExtVaueTotal).'</th>
	<th style="font-weight: 600;">'.AmountValue($GrandTotalTotal).'</th>
	<th style="font-weight: 600;"></th>
	<th style="font-weight: 600;"></th>

	</tr>
	</table>
	</div>';
}


$html;

//   echo $sale_invoice = getSalePrintTemplate($Billno,$Bid,$LanguageId);
	require '../../../Lib/mpdf/vendor/autoload.php';
   $sale_invoice = $html;

$mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8', 'format' => 'A4']);
		$mpdf->autoScriptToLang = true;
	$mpdf->autoLangToFont = true;
// $mpdf->setAutoTopMargin('stretch');
if($LanguageId=='2')
{
$mpdf->SetDirectionality('rtl');
}
$language = "en";
if($LanguageId=='2')
{
$language = "ar";

}

$mpdf->WriteHTML($sale_invoice);
// $mpdf->Output();
$mpdf->Output('Sale Invoice General-'.$language.'-'.$Billno.'.pdf', 'D');	

?>
<script>
$('#printInvoice').html();
</script>
<div class="content_form" >










</div>