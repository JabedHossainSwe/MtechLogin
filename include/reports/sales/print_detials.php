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
<h2 style="font-size: 1.9rem; text-align: center;">Sale Report  Details</h2>
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
			<th style="font-weight: 500;">ProductCode</th>	
			<th style="font-weight: 500;">ProductName</th>	
			<th style="font-weight: 500;">Quantity</th>	
			<th style="font-weight: 500;">Bonus</th>	
			<th style="font-weight: 500;">UnitName</th>	
			<th style="font-weight: 500;">Price</th>	
			<th style="font-weight: 500;">NetTotal</th>	
			<th style="font-weight: 500;">stype</th>	
			<th style="font-weight: 500;">CostPrice</th>	
			<th style="font-weight: 500;">CostTotal</th>	
			<th style="font-weight: 500;">Profit</th>	
			<th style="font-weight: 500;">ProfitPer</th>	
			<th style="font-weight: 500;">VatPerCent</th>	
			<th style="font-weight: 500;">VatAmount</th>	
			<th style="font-weight: 500;">VatTotal</th>	
			<th style="font-weight: 500;">GrandTotal</th>	
			<th style="font-weight: 500;">AdvTaxPer</th>	
			<th style="font-weight: 500;">AdvTax</th>	
			<th style="font-weight: 500;">GGTotal</th>	
			<th style="font-weight: 500;">UserName</th>	
			<th style="font-weight: 500;">BName</th>
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
$QuantityTot = $QuantityTot+$single->Quantity;
$BonusTot = $BonusTot+$single->Bonus;
$PriceTot = $PriceTot+$single->Price;
$TotalTot = $TotalTot+$single->NetTotal;
$CostPriceTot = $CostPriceTot+$single->CostPrice;
$CostTotalTot = $CostTotalTot+$single->CostTotal;
$ProfitTotal = $ProfitTotal+$single->Profit;
$ProfitPerTotal = $ProfitPerTotal+$single->ProfitPer;
$VatPerCentTotal = $VatPerCentTotal+$single->VatPerCent;
$VatAmountTotal = $VatAmountTotal+$single->VatAmount;
$VatTotalTotal = $VatTotalTotal+$single->VatTotal;
$GrandTotalTotal = $GrandTotalTotal+$single->GrandTotal;
$AdvTaxPerTotal = $AdvTaxPerTotal+$single->AdvTaxPer;
$AdvTaxTotal = $AdvTaxTotal+$single->AdvTax;
$GGTotalTotal = $GGTotalTotal+$single->GGTotal;


$html .='
<tr>
			<th style="font-weight: 300;">'.$single->BillNo.'</th>
			<th style="font-weight: 300;">'.DateValue($single->BillDateTime).'</th>	
			<th style="font-weight: 300;">'.$single->CustSupName.'</th>	
			<th style="font-weight: 300;">'.$single->ProductCode.'</th>	
			<th style="font-weight: 300;">'.$single->ProductName.'</th>	
			<th style="font-weight: 300;">'.AmountValue($single->Quantity).'</th>	
			<th style="font-weight: 300;">'.AmountValue($single->Bonus).'</th>	
			<th style="font-weight: 300;">'.AmountValue($single->UnitName).'</th>	
			<th style="font-weight: 300;">'.AmountValue($single->Price).'</th>	
			<th style="font-weight: 300;">'.AmountValue($single->NetTotal).'</th>	
			<th style="font-weight: 300;">'.AmountValue($single->stype).'</th>	
			<th style="font-weight: 300;">'.AmountValue($single->CostPrice).'</th>	
			<th style="font-weight: 300;">'.AmountValue($single->CostTotal).'</th>	
			<th style="font-weight: 300;">'.AmountValue($single->Profit).'</th>	
			<th style="font-weight: 300;">'.AmountValue($single->ProfitPer).'</th>	
			<th style="font-weight: 300;">'.AmountValue($single->VatPerCent).'</th>	
			<th style="font-weight: 300;">'.AmountValue($single->VatAmount).'</th>	
			<th style="font-weight: 300;">'.AmountValue($single->VatTotal).'</th>	
			<th style="font-weight: 300;">'.AmountValue($single->GrandTotal).'</th>	
			<th style="font-weight: 300;">'.AmountValue($single->AdvTaxPer).'</th>	
			<th style="font-weight: 300;">'.AmountValue($single->AdvTax).'</th>	
			<th style="font-weight: 300;">'.AmountValue($single->GGTotal).'</th>	
			<th style="font-weight: 300;">'.$single->UserName.'</th>	
			<th style="font-weight: 300;">'.$single->BName.'</th>
</tr>';
	$counter++;
	}
$html .='
<tr>
<th style="font-weight: 600; text-align:center;" colspan="5">Total</th>
<th style="font-weight: 600;">'.AmountValue($QuantityTot).'</th>
<th style="font-weight: 600;">'.AmountValue($BonusTot).'</th>
<th style="font-weight: 600;"></th>
<th style="font-weight: 600;">'.AmountValue($PriceTot).'</th>
<th style="font-weight: 600;">'.AmountValue($TotalTot).'</th>
<th style="font-weight: 600;"></th>
<th style="font-weight: 600;">'.AmountValue($CostPriceTot).'</th>
<th style="font-weight: 600;">'.AmountValue($CostTotalTot).'</th>
<th style="font-weight: 600;">'.AmountValue($ProfitTotal).'</th>
<th style="font-weight: 600;">'.AmountValue($ProfitPerTotal).'</th>
<th style="font-weight: 600;">'.AmountValue($VatPerCentTotal).'</th>
<th style="font-weight: 600;">'.AmountValue($VatAmountTotal).'</th>
<th style="font-weight: 600;">'.AmountValue($VatTotalTotal).'</th>
<th style="font-weight: 600;">'.AmountValue($GrandTotalTotal).'</th>
<th style="font-weight: 600;">'.AmountValue($AdvTaxPerTotal).'</th>
<th style="font-weight: 600;">'.AmountValue($AdvTaxTotal).'</th>
<th style="font-weight: 600;">'.AmountValue($GGTotalTotal).'</th>
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
'.getArabicTitle('Sale Report  Details').'
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
			<th style="font-weight: 500;">'.getArabicTitle('ProductCode').'</th>	
			<th style="font-weight: 500;">'.getArabicTitle('ProductName').'</th>	
			<th style="font-weight: 500;">'.getArabicTitle('Quantity').'</th>	
			<th style="font-weight: 500;">'.getArabicTitle('Bonus').'</th>	
			<th style="font-weight: 500;">'.getArabicTitle('UnitName').'</th>	
			<th style="font-weight: 500;">'.getArabicTitle('Price').'</th>	
			<th style="font-weight: 500;">'.getArabicTitle('NetTotal').'</th>	
			<th style="font-weight: 500;">'.getArabicTitle('stype').'</th>	
			<th style="font-weight: 500;">'.getArabicTitle('CostPrice').'</th>	
			<th style="font-weight: 500;">'.getArabicTitle('CostTotal').'</th>	
			<th style="font-weight: 500;">'.getArabicTitle('Profit').'</th>	
			<th style="font-weight: 500;">'.getArabicTitle('ProfitPer').'</th>	
			<th style="font-weight: 500;">'.getArabicTitle('VatPerCent').'</th>	
			<th style="font-weight: 500;">'.getArabicTitle('VatAmount').'</th>	
			<th style="font-weight: 500;">'.getArabicTitle('VatTotal').'</th>	
			<th style="font-weight: 500;">'.getArabicTitle('GrandTotal').'</th>	
			<th style="font-weight: 500;">'.getArabicTitle('AdvTaxPer').'</th>	
			<th style="font-weight: 500;">'.getArabicTitle('AdvTax').'</th>	
			<th style="font-weight: 500;">'.getArabicTitle('GGTotal').'</th>	
			<th style="font-weight: 500;">'.getArabicTitle('UserName').'</th>	
			<th style="font-weight: 500;">'.getArabicTitle('BName').'</th>
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
$QuantityTot = $QuantityTot+$single->Quantity;
$BonusTot = $BonusTot+$single->Bonus;
$PriceTot = $PriceTot+$single->Price;
$TotalTot = $TotalTot+$single->NetTotal;
$CostPriceTot = $CostPriceTot+$single->CostPrice;
$CostTotalTot = $CostTotalTot+$single->CostTotal;
$ProfitTotal = $ProfitTotal+$single->Profit;
$ProfitPerTotal = $ProfitPerTotal+$single->ProfitPer;
$VatPerCentTotal = $VatPerCentTotal+$single->VatPerCent;
$VatAmountTotal = $VatAmountTotal+$single->VatAmount;
$VatTotalTotal = $VatTotalTotal+$single->VatTotal;
$GrandTotalTotal = $GrandTotalTotal+$single->GrandTotal;
$AdvTaxPerTotal = $AdvTaxPerTotal+$single->AdvTaxPer;
$AdvTaxTotal = $AdvTaxTotal+$single->AdvTax;
$GGTotalTotal = $GGTotalTotal+$single->GGTotal;


$html .='
<tr>
			<th style="font-weight: 300;">'.$single->BillNo.'</th>
			<th style="font-weight: 300;">'.DateValue($single->BillDateTime).'</th>	
			<th style="font-weight: 300;">'.$single->CustSupName.'</th>	
			<th style="font-weight: 300;">'.$single->ProductCode.'</th>	
			<th style="font-weight: 300;">'.$single->ProductName.'</th>	
			<th style="font-weight: 300;">'.AmountValue($single->Quantity).'</th>	
			<th style="font-weight: 300;">'.AmountValue($single->Bonus).'</th>	
			<th style="font-weight: 300;">'.AmountValue($single->UnitName).'</th>	
			<th style="font-weight: 300;">'.AmountValue($single->Price).'</th>	
			<th style="font-weight: 300;">'.AmountValue($single->NetTotal).'</th>	
			<th style="font-weight: 300;">'.AmountValue($single->stype).'</th>	
			<th style="font-weight: 300;">'.AmountValue($single->CostPrice).'</th>	
			<th style="font-weight: 300;">'.AmountValue($single->CostTotal).'</th>	
			<th style="font-weight: 300;">'.AmountValue($single->Profit).'</th>	
			<th style="font-weight: 300;">'.AmountValue($single->ProfitPer).'</th>	
			<th style="font-weight: 300;">'.AmountValue($single->VatPerCent).'</th>	
			<th style="font-weight: 300;">'.AmountValue($single->VatAmount).'</th>	
			<th style="font-weight: 300;">'.AmountValue($single->VatTotal).'</th>	
			<th style="font-weight: 300;">'.AmountValue($single->GrandTotal).'</th>	
			<th style="font-weight: 300;">'.AmountValue($single->AdvTaxPer).'</th>	
			<th style="font-weight: 300;">'.AmountValue($single->AdvTax).'</th>	
			<th style="font-weight: 300;">'.AmountValue($single->GGTotal).'</th>	
			<th style="font-weight: 300;">'.$single->UserName.'</th>	
			<th style="font-weight: 300;">'.$single->BName.'</th>
</tr>';
	$counter++;
	}
$html .='
<tr>
<th style="font-weight: 600; text-align:center;" colspan="5">'.getArabicTitle('Total').'</th>
<th style="font-weight: 600;">'.AmountValue($QuantityTot).'</th>
<th style="font-weight: 600;">'.AmountValue($BonusTot).'</th>
<th style="font-weight: 600;"></th>
<th style="font-weight: 600;">'.AmountValue($PriceTot).'</th>
<th style="font-weight: 600;">'.AmountValue($TotalTot).'</th>
<th style="font-weight: 600;"></th>
<th style="font-weight: 600;">'.AmountValue($CostPriceTot).'</th>
<th style="font-weight: 600;">'.AmountValue($CostTotalTot).'</th>
<th style="font-weight: 600;">'.AmountValue($ProfitTotal).'</th>
<th style="font-weight: 600;">'.AmountValue($ProfitPerTotal).'</th>
<th style="font-weight: 600;">'.AmountValue($VatPerCentTotal).'</th>
<th style="font-weight: 600;">'.AmountValue($VatAmountTotal).'</th>
<th style="font-weight: 600;">'.AmountValue($VatTotalTotal).'</th>
<th style="font-weight: 600;">'.AmountValue($GrandTotalTotal).'</th>
<th style="font-weight: 600;">'.AmountValue($AdvTaxPerTotal).'</th>
<th style="font-weight: 600;">'.AmountValue($AdvTaxTotal).'</th>
<th style="font-weight: 600;">'.AmountValue($GGTotalTotal).'</th>
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
$mpdf->Output();
// $mpdf->Output('Sale Invoice Details-'.$language.'-'.$Billno.'.pdf', 'D');	

?>
<script>
$('#printInvoice').html();
</script>
<div class="content_form" >










</div>