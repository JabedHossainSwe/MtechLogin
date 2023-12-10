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
			<th style="font-weight: 500;">GroupName</th>
			<th style="font-weight: 500;">QTY</th>	
			<th style="font-weight: 500;">NetTotal</th>	
			<th style="font-weight: 500;">CostTot</th>	
			<th style="font-weight: 500;">SrTotal</th>	
			<th style="font-weight: 500;">SrCost</th>	
			<th style="font-weight: 500;">totalCost</th>	
			<th style="font-weight: 500;">StkOutTotal</th>	
			<th style="font-weight: 500;">NetSale</th>	
			<th style="font-weight: 500;">GCost</th>	
			<th style="font-weight: 500;">GProfit</th>	
			<th style="font-weight: 500;">StockLoss</th>	
			<th style="font-weight: 500;">NetProfit</th>	
			<th style="font-weight: 500;">ProfitPer</th>	
			<th style="font-weight: 500;">vatAmt</th>	
			<th style="font-weight: 500;">vatAmtSR</th>	
			<th style="font-weight: 500;">NetVat</th>	
			<th style="font-weight: 500;">GrandTotal</th>	
			<th style="font-weight: 500;">AdvAmt</th>
			<th style="font-weight: 500;">GGTotal</th>
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

$GroupNameTot = $GroupNameTot+$single->GroupName;
$QTYTot = $QTYTot+$single->QTY;
$NetTotalTot = $NetTotalTot+$single->NetTotal;
$CostTotTot = $CostTotTot+$single->CostTot;
$SrTotalTot = $SrTotalTot+$single->SrTotal;
$SrCostTot = $SrCostTot+$single->SrCost;
$totalCostTot = $totalCostTot+$single->totalCost;
$StkOutTotalTot = $StkOutTotalTot+$single->StkOutTotal;
$NetSaleTot = $NetSaleTot+$single->NetSale;
$GCostTot = $GCostTot+$single->GCost;
$GProfitTot = $GProfitTot+$single->GProfit;
$StockLossTot = $StockLossTot+$single->StockLoss;
$NetProfitTot = $NetProfitTot+$single->NetProfit;
$ProfitPerTot = $ProfitPerTot+$single->ProfitPer;
$vatAmtTot = $vatAmtTot+$single->vatAmt;
$vatAmtSRTot = $vatAmtSRTot+$single->vatAmtSR;
$NetVatTot = $NetVatTot+$single->NetVat;
$GrandTotalTot = $GrandTotalTot+$single->GrandTotal;
$AdvAmtTot = $AdvAmtTot+$single->AdvAmt;
$GGTotalTot = $GGTotalTot+$single->GGTotal;


$html .='
<tr>
		
			<th style="font-weight: 300;">'.$single->GroupName.'</th>
			<th style="font-weight: 300;">'.AmountValue($single->QTY).'</th>	
			<th style="font-weight: 300;">'.AmountValue($single->NetTotal).'</th>	
			<th style="font-weight: 300;">'.AmountValue($single->CostTot).'</th>	
			<th style="font-weight: 300;">'.AmountValue($single->SrTotal).'</th>	
			<th style="font-weight: 300;">'.AmountValue($single->SrCost).'</th>	
			<th style="font-weight: 300;">'.AmountValue($single->totalCost).'</th>	
			<th style="font-weight: 300;">'.AmountValue($single->StkOutTotal).'</th>	
			<th style="font-weight: 300;">'.AmountValue($single->NetSale).'</th>	
			<th style="font-weight: 300;">'.AmountValue($single->GCost).'</th>	
			<th style="font-weight: 300;">'.AmountValue($single->GProfit).'</th>	
			<th style="font-weight: 300;">'.AmountValue($single->StockLoss).'</th>	
			<th style="font-weight: 300;">'.AmountValue($single->NetProfit).'</th>	
			<th style="font-weight: 300;">'.AmountValue($single->ProfitPer).'</th>	
			<th style="font-weight: 300;">'.AmountValue($single->vatAmt).'</th>	
			<th style="font-weight: 300;">'.AmountValue($single->vatAmtSR).'</th>	
			<th style="font-weight: 300;">'.AmountValue($single->NetVat).'</th>	
			<th style="font-weight: 300;">'.AmountValue($single->GrandTotal).'</th>	
			<th style="font-weight: 300;">'.AmountValue($single->AdvAmt).'</th>
			<th style="font-weight: 300;">'.AmountValue($single->GGTotal).'</th>
</tr>';
	$counter++;
	}
$html .='
<tr>
<th style="font-weight: 600; text-align:center;">Total</th>
<th style="font-weight: 600;">'.AmountValue($QTYTot).'</th>
<th style="font-weight: 600;">'.AmountValue($NetTotalTot).'</th>
<th style="font-weight: 600;">'.AmountValue($CostTotTot).'</th>
<th style="font-weight: 600;">'.AmountValue($SrTotalTot).'</th>
<th style="font-weight: 600;">'.AmountValue($SrCostTot).'</th>
<th style="font-weight: 600;">'.AmountValue($totalCostTot).'</th>
<th style="font-weight: 600;">'.AmountValue($StkOutTotalTot).'</th>
<th style="font-weight: 600;">'.AmountValue($NetSaleTot).'</th>
<th style="font-weight: 600;">'.AmountValue($GCostTot).'</th>
<th style="font-weight: 600;">'.AmountValue($GProfitTot).'</th>
<th style="font-weight: 600;">'.AmountValue($StockLossTot).'</th>
<th style="font-weight: 600;">'.AmountValue($NetProfitTot).'</th>
<th style="font-weight: 600;">'.AmountValue($ProfitPerTot).'</th>
<th style="font-weight: 600;">'.AmountValue($vatAmtTot).'</th>
<th style="font-weight: 600;">'.AmountValue($vatAmtSRTot).'</th>
<th style="font-weight: 600;">'.AmountValue($NetVatTot).'</th>
<th style="font-weight: 600;">'.AmountValue($GrandTotalTot).'</th>
<th style="font-weight: 600;">'.AmountValue($AdvAmtTot).'</th>
<th style="font-weight: 600;">'.AmountValue($GGTotalTot).'</th>

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
				<th style="font-weight: 500;">'.getArabicTitle('GroupName').'</th>
				<th style="font-weight: 500;">'.getArabicTitle('QTY').'</th>	
				<th style="font-weight: 500;">'.getArabicTitle('NetTotal').'</th>	
				<th style="font-weight: 500;">'.getArabicTitle('CostTot').'</th>	
				<th style="font-weight: 500;">'.getArabicTitle('SrTotal').'</th>	
				<th style="font-weight: 500;">'.getArabicTitle('SrCost').'</th>	
				<th style="font-weight: 500;">'.getArabicTitle('totalCost').'</th>	
				<th style="font-weight: 500;">'.getArabicTitle('StkOutTotal').'</th>	
				<th style="font-weight: 500;">'.getArabicTitle('NetSale').'</th>	
				<th style="font-weight: 500;">'.getArabicTitle('GCost').'</th>	
				<th style="font-weight: 500;">'.getArabicTitle('GProfit').'</th>	
				<th style="font-weight: 500;">'.getArabicTitle('StockLoss').'</th>	
				<th style="font-weight: 500;">'.getArabicTitle('NetProfit').'</th>	
				<th style="font-weight: 500;">'.getArabicTitle('ProfitPer').'</th>	
				<th style="font-weight: 500;">'.getArabicTitle('vatAmt').'</th>	
				<th style="font-weight: 500;">'.getArabicTitle('vatAmtSR').'</th>	
				<th style="font-weight: 500;">'.getArabicTitle('NetVat').'</th>	
				<th style="font-weight: 500;">'.getArabicTitle('GrandTotal').'</th>	
				<th style="font-weight: 500;">'.getArabicTitle('AdvAmt').'</th>
				<th style="font-weight: 500;">'.getArabicTitle('GGTotal').'</th>
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
		$GroupNameTot = $GroupNameTot+$single->GroupName;
		$QTYTot = $QTYTot+$single->QTY;
		$NetTotalTot = $NetTotalTot+$single->NetTotal;
		$CostTotTot = $CostTotTot+$single->CostTot;
		$SrTotalTot = $SrTotalTot+$single->SrTotal;
		$SrCostTot = $SrCostTot+$single->SrCost;
		$totalCostTot = $totalCostTot+$single->totalCost;
		$StkOutTotalTot = $StkOutTotalTot+$single->StkOutTotal;
		$NetSaleTot = $NetSaleTot+$single->NetSale;
		$GCostTot = $GCostTot+$single->GCost;
		$GProfitTot = $GProfitTot+$single->GProfit;
		$StockLossTot = $StockLossTot+$single->StockLoss;
		$NetProfitTot = $NetProfitTot+$single->NetProfit;
		$ProfitPerTot = $ProfitPerTot+$single->ProfitPer;
		$vatAmtTot = $vatAmtTot+$single->vatAmt;
		$vatAmtSRTot = $vatAmtSRTot+$single->vatAmtSR;
		$NetVatTot = $NetVatTot+$single->NetVat;
		$GrandTotalTot = $GrandTotalTot+$single->GrandTotal;
		$AdvAmtTot = $AdvAmtTot+$single->AdvAmt;
		$GGTotalTot = $GGTotalTot+$single->GGTotal;


	$html .='
	<tr>
		<th style="font-weight: 300;">'.$single->GroupName.'</th>
		<th style="font-weight: 300;">'.AmountValue($single->QTY).'</th>	
		<th style="font-weight: 300;">'.AmountValue($single->NetTotal).'</th>	
		<th style="font-weight: 300;">'.AmountValue($single->CostTot).'</th>	
		<th style="font-weight: 300;">'.AmountValue($single->SrTotal).'</th>	
		<th style="font-weight: 300;">'.AmountValue($single->SrCost).'</th>	
		<th style="font-weight: 300;">'.AmountValue($single->totalCost).'</th>	
		<th style="font-weight: 300;">'.AmountValue($single->StkOutTotal).'</th>	
		<th style="font-weight: 300;">'.AmountValue($single->NetSale).'</th>	
		<th style="font-weight: 300;">'.AmountValue($single->GCost).'</th>	
		<th style="font-weight: 300;">'.AmountValue($single->GProfit).'</th>	
		<th style="font-weight: 300;">'.AmountValue($single->StockLoss).'</th>	
		<th style="font-weight: 300;">'.AmountValue($single->NetProfit).'</th>	
		<th style="font-weight: 300;">'.AmountValue($single->ProfitPer).'</th>	
		<th style="font-weight: 300;">'.AmountValue($single->vatAmt).'</th>	
		<th style="font-weight: 300;">'.AmountValue($single->vatAmtSR).'</th>	
		<th style="font-weight: 300;">'.AmountValue($single->NetVat).'</th>	
		<th style="font-weight: 300;">'.AmountValue($single->GrandTotal).'</th>	
		<th style="font-weight: 300;">'.AmountValue($single->AdvAmt).'</th>
		<th style="font-weight: 300;">'.AmountValue($single->GGTotal).'</th>
	</tr>';
		$counter++;
		}
	$html .='
	<tr>
		<th style="font-weight: 600; text-align:center;">Total</th>
		<th style="font-weight: 600;">'.AmountValue($QTYTot).'</th>
		<th style="font-weight: 600;">'.AmountValue($NetTotalTot).'</th>
		<th style="font-weight: 600;">'.AmountValue($CostTotTot).'</th>
		<th style="font-weight: 600;">'.AmountValue($SrTotalTot).'</th>
		<th style="font-weight: 600;">'.AmountValue($SrCostTot).'</th>
		<th style="font-weight: 600;">'.AmountValue($totalCostTot).'</th>
		<th style="font-weight: 600;">'.AmountValue($StkOutTotalTot).'</th>
		<th style="font-weight: 600;">'.AmountValue($NetSaleTot).'</th>
		<th style="font-weight: 600;">'.AmountValue($GCostTot).'</th>
		<th style="font-weight: 600;">'.AmountValue($GProfitTot).'</th>
		<th style="font-weight: 600;">'.AmountValue($StockLossTot).'</th>
		<th style="font-weight: 600;">'.AmountValue($NetProfitTot).'</th>
		<th style="font-weight: 600;">'.AmountValue($ProfitPerTot).'</th>
		<th style="font-weight: 600;">'.AmountValue($vatAmtTot).'</th>
		<th style="font-weight: 600;">'.AmountValue($vatAmtSRTot).'</th>
		<th style="font-weight: 600;">'.AmountValue($NetVatTot).'</th>
		<th style="font-weight: 600;">'.AmountValue($GrandTotalTot).'</th>
		<th style="font-weight: 600;">'.AmountValue($AdvAmtTot).'</th>
		<th style="font-weight: 600;">'.AmountValue($GGTotalTot).'</th>

	</tr>
	</table>
	</div>';
}


echo $html;
die();
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
$mpdf->Output('Sale Invoice Group-'.$language.'-'.$Billno.'.pdf', 'D');	

?>
<script>
$('#printInvoice').html();
</script>
<div class="content_form" >










</div>