<?php

use Mpdf\Mpdf;

session_start();
error_reporting(0);
include("../../../../config/connection.php");
// include("../../../../config/functions.php");
include("../../../../config/main_connection.php");
include("../../../../config/main_functions.php");
include("../../../../config/templates.php");
$query = urldecode($_REQUEST['query']);
$LanguageId = $_REQUEST['LanguageId'];
$type = $_REQUEST['type'];


$html = '';

$servername = $_SERVER['SERVER_NAME'];
$barCode = "http://217.76.50.216/MtechMobile/vouchers/sales/QrCodes/Sale-$Billno.png";

if ($servername == 'localhost') {
	$barCode = "http://localhost/MtechMobile/vouchers/sales/QrCodes/Sale-$Billno.png";
}


$getLoginUserCompanyData = getLoginUserCompanyData($_SESSION['id']);

$html .= '<style> 
	body{
		background-image: url("http://217.76.50.216/' . $getLoginUserCompanyData->logo . '.");
		background-repeat: no-repeat;
		background-position: center;
		background-size: cover;
	}
	
	#Sale-Inovice{
		background-color: rgba(255, 255, 255, 0.7);
	}
	</style>';


///// Language Id 1 For English ///
if ($LanguageId == 1) {


	$html .= '<div id="Sale-Inovice" style="-webkit-print-color-adjust:exact !important;
		print-color-adjust:exact !important; border: 5px solid rgba(143, 192, 235, 0.5); margin: 8px;">
		<table style="width: 100%; text-align: start;" border="0">
		<tr>
		<th style="width: 100%; text-align: center; font-size: 0.8rem; background-color: rgb(143, 192, 235);"
		colspan="5">
		<h1>' . $getLoginUserCompanyData->name . '</h1>
		</th>

		</tr>
		<tr class="row">
		<th style="text-align: start; vertical-align: middle; width: 33%;">
		<h2 style="font-size: 0.6rem ; padding-left: 5px;"> MOB:' . $getLoginUserCompanyData->mobile . ' <br> ' . $getLoginUserCompanyData->email . ' VAT#: ' . $getLoginUserCompanyData->vat . '
		</h2>

		</th>
		<th style="vertical-align: middle; width: 33%;">
		<img style="text-align: center;" width="80px" height="80px"
		src="http://217.76.50.216/' . $getLoginUserCompanyData->logo . '" 
		alt="">
		</th>
		<th style="vertical-align: middle; text-align: right; width: 33%;">
		<h2 style="font-size: 0.8	rem; text-align: center;">' . $type . '</h2>
		</th>
		</table>
		<table border="1" style="width: 100%; font-size: 1rem; border-collapse: collapse;">
		<tr>
			<th style="font-weight: 500;">Product Group</th>
			<th style="font-weight: 500;">QTY</th>	
			<th style="font-weight: 500;">NetTotal</th>	
			<th style="font-weight: 500;">Total Cost</th>	
			<th style="font-weight: 500;">SrTotal</th>	
			<th style="font-weight: 500;">SrCost</th>	
			<th style="font-weight: 500;">StkOutTotal</th>	
			<th style="font-weight: 500;">NetSale</th>	
			<th style="font-weight: 500;">GCost</th>	
			<th style="font-weight: 500;">GProfit</th>	
			<th style="font-weight: 500;">StockLoss</th>	
			<th style="font-weight: 500;">NetProfit</th>	
			<th style="font-weight: 500;">Profit%</th>	
			<th style="font-weight: 500;">vatAmt</th>	
			<th style="font-weight: 500;">vatAmtSR</th>	
			<th style="font-weight: 500;">NetVat</th>	
			<th style="font-weight: 500;">(Vat+Sales)</th>	
			<th style="font-weight: 500;">AdvAmt</th>	
			<th style="font-weight: 500;">GGTotal</th>	
		</tr>';

	$counter = 1;
	$qtyTot = 0;
	$PriceTot = 0;
	$TotalTot = 0;
	$vatperTot = 0;
	$vatamtTot = 0;
	$GrTotal = 0;

	$detailsSp = Run($query);
	while ($single = myfetch($detailsSp)) {
		
		$QTYTotal = $QTYTotal +  $single->QTY;
		$NetTotalTotal = $NetTotalTotal +  $single->NetTotal;
		$CostTotTotal = $CostTotTotal +  $single->CostTot;
		$SrTotalTotal = $SrTotalTotal +  $single->SrTotal;
		$SrCostTotal = $SrCostTotal +  $single->SrCost;
		$StkOutTotalTotal = $StkOutTotalTotal +  $single->StkOutTotal;
		$NetSaleTotal = $NetSaleTotal +  $single->NetSale;
		$GCostTotal = $GCostTotal +  $single->GCost;
		$GProfitTotal = $GProfitTotal +  $single->GProfit;
		$StockLossTotal = $StockLossTotal +  $single->StockLoss;
		$NetProfitTotal = $NetProfitTotal +  $single->NetProfit;
		$ProfitPerTotal = $ProfitPerTotal +  $single->ProfitPer;
		$vatAmtTotal = $vatAmtTotal +  $single->vatAmt;
		$vatAmtSRTotal = $vatAmtSRTotal +  $single->vatAmtSR;
		$NetVatTotal = $NetVatTotal +  $single->NetVat;
		$GrandTotalTotal = $GrandTotalTotal +  $single->GrandTotal;
		$AdvAmtTotal = $AdvAmtTotal +  $single->AdvAmt;
		$GGTotalTotal = $GGTotalTotal +  $single->GGTotal;


		$html .= '
		<tr>
			<th style="font-weight: 300;">' . $single->GroupName . '</th>
			<th style="font-weight: 300;">' . AmountValue($single->QTY) . '</th>
			<th style="font-weight: 300;">' . AmountValue($single->NetTotal) . '</th>
			<th style="font-weight: 300;">' . AmountValue($single->CostTot) . '</th>
			<th style="font-weight: 300;">' . AmountValue($single->SrTotal) . '</th>
			<th style="font-weight: 300;">' . AmountValue($single->SrCost) . '</th>
			<th style="font-weight: 300;">' . AmountValue($single->StkOutTotal) . '</th>
			<th style="font-weight: 300;">' . AmountValue($single->NetSale) . '</th>
			<th style="font-weight: 300;">' . AmountValue($single->GCost) . '</th>
			<th style="font-weight: 300;">' . AmountValue($single->GProfit) . '</th>
			<th style="font-weight: 300;">' . AmountValue($single->StockLoss) . '</th>
			<th style="font-weight: 300;">' . AmountValue($single->NetProfit) . '</th>
			<th style="font-weight: 300;">' . AmountValue($single->ProfitPer) . '</th>
			<th style="font-weight: 300;">' . AmountValue($single->vatAmt) . '</th>
			<th style="font-weight: 300;">' . AmountValue($single->vatAmtSR) . '</th>
			<th style="font-weight: 300;">' . AmountValue($single->NetVat) . '</th>
			<th style="font-weight: 300;">' . AmountValue($single->GrandTotal) . '</th>
			<th style="font-weight: 300;">' . AmountValue($single->AdvAmt) . '</th>
			<th style="font-weight: 300;">' . AmountValue($single->GGTotal) . '</th>
		</tr>';
		$counter++;
	}
	$html .= '
		<tr>
			<th style="font-weight: 600; text-align:center;" colspan="1">Total</th>
			<th style="font-weight: 600;">' . AmountValue($QTYTotal) . '</th>
			<th style="font-weight: 600;">' . AmountValue($NetTotalTotal) . '</th>
			<th style="font-weight: 600;">' . AmountValue($CostTotTotal) . '</th>
			<th style="font-weight: 600;">' . AmountValue($SrTotalTotal) . '</th>
			<th style="font-weight: 600;">' . AmountValue($SrCostTotal) . '</th>
			<th style="font-weight: 600;">' . AmountValue($StkOutTotalTotal) . '</th>
			<th style="font-weight: 600;">' . AmountValue($NetSaleTotal) . '</th>
			<th style="font-weight: 600;">' . AmountValue($GCostTotal) . '</th>
			<th style="font-weight: 600;">' . AmountValue($GProfitTotal) . '</th>
			<th style="font-weight: 600;">' . AmountValue($StockLossTotal) . '</th>
			<th style="font-weight: 600;">' . AmountValue($NetProfitTotal) . '</th>
			<th style="font-weight: 600;">' . AmountValue($ProfitPerTotal) . '</th>
			<th style="font-weight: 600;">' . AmountValue($vatAmtTotal) . '</th>
			<th style="font-weight: 600;">' . AmountValue($vatAmtSRTotal) . '</th>
			<th style="font-weight: 600;">' . AmountValue($NetVatTotal) . '</th>
			<th style="font-weight: 600;">' . AmountValue($GrandTotalTotal) . '</th>
			<th style="font-weight: 600;">' . AmountValue($AdvAmtTotal) . '</th>
			<th style="font-weight: 600;">' . AmountValue($GGTotalTotal) . '</th>

		</tr>
		</table>
		</div>';
}





/// Language 2 For Arabic
if ($LanguageId == 2) {
	$html .= '<div id="Sale-Inovice" style="-webkit-print-color-adjust:exact !important;
	print-color-adjust:exact !important; border: 5px solid rgba(143, 192, 235, 0.5); margin: 8px;">
	<table style="width: 100%; text-align: start;" border="0">
	<tr>
	<th style="width: 100%; text-align: center; font-size: 0.8rem; background-color: rgb(143, 192, 235);"
	colspan="5">
	<h1>' . $getLoginUserCompanyData->name . '</h1>
	</th>

	</tr>
	<tr>
	<th style="text-align: start; vertical-align: middle; width: 33%;">
	<h2 style="font-size: 0.6rem ; padding-left: 5px;">
	MOB:' . $getLoginUserCompanyData->mobile . ' <br> ' . $getLoginUserCompanyData->email . ' <br> VAT#: ' . $getLoginUserCompanyData->vat . '
	</h2>

	</th>

	<th colspan="3" style="vertical-align: middle; width: 33%;">
	<img width="80px" height="80px" src="http://217.76.50.216/' . $getLoginUserCompanyData->logo . '" alt="">
	</th>

	<th style="vertical-align: middle; width: 33%; ">
		<h2 style="font-size: 0.8rem; text-align: right;">
		' . getArabicTitle($type) . '
		</h2>
	
	</th>

	</table>
	<table border="1" style="width: 100%; font-size: 1rem; border-collapse: collapse;">
		<tr>
			<th style="font-weight: 500;">' . getArabicTitle('Product Group') . '</th>
			<th style="font-weight: 500;">' . getArabicTitle('QTY') . '</th>	
			<th style="font-weight: 500;">' . getArabicTitle('NetTotal') . '</th>	
			<th style="font-weight: 500;">' . getArabicTitle('Total Cost') . '</th>	
			<th style="font-weight: 500;">' . getArabicTitle('SrTotal') . '</th>	
			<th style="font-weight: 500;">' . getArabicTitle('SrCost') . '</th>	
			<th style="font-weight: 500;">' . getArabicTitle('StkOutTotal') . '</th>	
			<th style="font-weight: 500;">' . getArabicTitle('NetSale') . '</th>	
			<th style="font-weight: 500;">' . getArabicTitle('GCost') . '</th>	
			<th style="font-weight: 500;">' . getArabicTitle('GProfit') . '</th>	
			<th style="font-weight: 500;">' . getArabicTitle('StockLoss') . '</th>	
			<th style="font-weight: 500;">' . getArabicTitle('NetProfit') . '</th>	
			<th style="font-weight: 500;">' . getArabicTitle('Profit%') . '</th>	
			<th style="font-weight: 500;">' . getArabicTitle('vatAmt') . '</th>	
			<th style="font-weight: 500;">' . getArabicTitle('vatAmtSR') . '</th>	
			<th style="font-weight: 500;">' . getArabicTitle('NetVat') . '</th>	
			<th style="font-weight: 500;">' . getArabicTitle('(Vat+Sales)') . '</th>	
			<th style="font-weight: 500;">' . getArabicTitle('AdvAmt') . '</th>	
			<th style="font-weight: 500;">' . getArabicTitle('GGTotal') . '</th>
		</tr>';

	$counter = 1;
	$qtyTot = 0;
	$PriceTot = 0;
	$TotalTot = 0;
	$vatperTot = 0;
	$vatamtTot = 0;
	$GrTotal = 0;

	$detailsSp = Run($query);
	while ($single = myfetch($detailsSp)) {
		$QTYTotal = $QTYTotal +  $single->QTY;
		$NetTotalTotal = $NetTotalTotal +  $single->NetTotal;
		$CostTotTotal = $CostTotTotal +  $single->CostTot;
		$SrTotalTotal = $SrTotalTotal +  $single->SrTotal;
		$SrCostTotal = $SrCostTotal +  $single->SrCost;
		$StkOutTotalTotal = $StkOutTotalTotal +  $single->StkOutTotal;
		$NetSaleTotal = $NetSaleTotal +  $single->NetSale;
		$GCostTotal = $GCostTotal +  $single->GCost;
		$GProfitTotal = $GProfitTotal +  $single->GProfit;
		$StockLossTotal = $StockLossTotal +  $single->StockLoss;
		$NetProfitTotal = $NetProfitTotal +  $single->NetProfit;
		$ProfitPerTotal = $ProfitPerTotal +  $single->ProfitPer;
		$vatAmtTotal = $vatAmtTotal +  $single->vatAmt;
		$vatAmtSRTotal = $vatAmtSRTotal +  $single->vatAmtSR;
		$NetVatTotal = $NetVatTotal +  $single->NetVat;
		$GrandTotalTotal = $GrandTotalTotal +  $single->GrandTotal;
		$AdvAmtTotal = $AdvAmtTotal +  $single->AdvAmt;
		$GGTotalTotal = $GGTotalTotal +  $single->GGTotal;


		$html .= '
		<tr>
			<th style="font-weight: 300;">' . $single->GroupName . '</th>
			<th style="font-weight: 300;">' . AmountValue($single->QTY) . '</th>
			<th style="font-weight: 300;">' . AmountValue($single->NetTotal) . '</th>
			<th style="font-weight: 300;">' . AmountValue($single->CostTot) . '</th>
			<th style="font-weight: 300;">' . AmountValue($single->SrTotal) . '</th>
			<th style="font-weight: 300;">' . AmountValue($single->SrCost) . '</th>
			<th style="font-weight: 300;">' . AmountValue($single->StkOutTotal) . '</th>
			<th style="font-weight: 300;">' . AmountValue($single->NetSale) . '</th>
			<th style="font-weight: 300;">' . AmountValue($single->GCost) . '</th>
			<th style="font-weight: 300;">' . AmountValue($single->GProfit) . '</th>
			<th style="font-weight: 300;">' . AmountValue($single->StockLoss) . '</th>
			<th style="font-weight: 300;">' . AmountValue($single->NetProfit) . '</th>
			<th style="font-weight: 300;">' . AmountValue($single->ProfitPer) . '</th>
			<th style="font-weight: 300;">' . AmountValue($single->vatAmt) . '</th>
			<th style="font-weight: 300;">' . AmountValue($single->vatAmtSR) . '</th>
			<th style="font-weight: 300;">' . AmountValue($single->NetVat) . '</th>
			<th style="font-weight: 300;">' . AmountValue($single->GrandTotal) . '</th>
			<th style="font-weight: 300;">' . AmountValue($single->AdvAmt) . '</th>
			<th style="font-weight: 300;">' . AmountValue($single->GGTotal) . '</th>
		</tr>';
		$counter++;
	}
	$html .= '
		<tr>
			<th style="font-weight: 600; text-align:center;" colspan="1">Total</th>
			<th style="font-weight: 600;">' . AmountValue($QTYTotal) . '</th>
			<th style="font-weight: 600;">' . AmountValue($NetTotalTotal) . '</th>
			<th style="font-weight: 600;">' . AmountValue($CostTotTotal) . '</th>
			<th style="font-weight: 600;">' . AmountValue($SrTotalTotal) . '</th>
			<th style="font-weight: 600;">' . AmountValue($SrCostTotal) . '</th>
			<th style="font-weight: 600;">' . AmountValue($StkOutTotalTotal) . '</th>
			<th style="font-weight: 600;">' . AmountValue($NetSaleTotal) . '</th>
			<th style="font-weight: 600;">' . AmountValue($GCostTotal) . '</th>
			<th style="font-weight: 600;">' . AmountValue($GProfitTotal) . '</th>
			<th style="font-weight: 600;">' . AmountValue($StockLossTotal) . '</th>
			<th style="font-weight: 600;">' . AmountValue($NetProfitTotal) . '</th>
			<th style="font-weight: 600;">' . AmountValue($ProfitPerTotal) . '</th>
			<th style="font-weight: 600;">' . AmountValue($vatAmtTotal) . '</th>
			<th style="font-weight: 600;">' . AmountValue($vatAmtSRTotal) . '</th>
			<th style="font-weight: 600;">' . AmountValue($NetVatTotal) . '</th>
			<th style="font-weight: 600;">' . AmountValue($GrandTotalTotal) . '</th>
			<th style="font-weight: 600;">' . AmountValue($AdvAmtTotal) . '</th>
			<th style="font-weight: 600;">' . AmountValue($GGTotalTotal) . '</th>
		</tr>
	</table>
	</div>';
}

$html .= '<style>
.head{
width: 100%;
margin: 8px;
display: flex;
padding-top: 10px;
justify-content: space-between;
vertical-align: top;
}

.table{
width: 90%;
table-layout: auto;
}
table, td, th {
font-size: 16px;
border-collapse: collapse;
padding:8px;
}
thead{
font-size: 5px;
}
table { width: 100%;}
table  thead tr th label {
font-size: 16px;
}
</style>';


$html;
require '../../../../Lib/mpdf/vendor/autoload.php';
$sale_invoice = $html;

$mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8', 'format' => 'A4']);
$mpdf->autoScriptToLang = true;
$mpdf->autoLangToFont = true;
// $mpdf->setAutoTopMargin('stretch');
if ($LanguageId == '2') {
	$mpdf->SetDirectionality('rtl');
}
$language = "en";
if ($LanguageId == '2') {
	$language = "ar";
}

$mpdf->WriteHTML($sale_invoice);
// $mpdf->Output();
$mpdf->Output($type . '-' . $language . '.pdf', 'D');

?>
<script>
	$('#printInvoice').html();
</script>
<div class="content_form">
</div>