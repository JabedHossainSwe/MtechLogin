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
			<th style="font-weight: 500;">BillNo</th>
			<th style="font-weight: 500;">Bill Date / Time</th>	
			<th style="font-weight: 500;">Customer</th>	
			<th style="font-weight: 500;">Product Code</th>	
			<th style="font-weight: 500;">Product Name</th>	
			<th style="font-weight: 500;">Quantity</th>	
			<th style="font-weight: 500;">Bonus</th>	
			<th style="font-weight: 500;">Unit</th>	
			<th style="font-weight: 500;">Price</th>	
			<th style="font-weight: 500;">Net Total</th>	
			<th style="font-weight: 500;">SalesType</th>	
			<th style="font-weight: 500;">Cost Price</th>	
			<th style="font-weight: 500;">Cost Total</th>	
			<th style="font-weight: 500;">Profit</th>	
			<th style="font-weight: 500;">Profit %</th>	
			<th style="font-weight: 500;">Vat Amount</th>	
			<th style="font-weight: 500;">Vat Total</th>	
			<th style="font-weight: 500;">Vat %</th>	
			<th style="font-weight: 500;">GrandTotal</th>	
			<th style="font-weight: 500;">UserName</th>	
			<th style="font-weight: 500;">BName</th>	
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
		$QuantityTotal = $QuantityTotal + $single->Quantity;
		$BonusTotal = $BonusTotal + $single->Bonus;
		$PriceTotal = $PriceTotal + $single->Price;
		$NetTotalTotal = $NetTotalTotal + $single->NetTotal;
		$CostPriceTotal = $CostPriceTotal + $single->CostPrice;
		$CostTotalTotal = $CostTotalTotal + $single->CostTotal;
		$ProfitTotal = $ProfitTotal + $single->Profit;
		$ProfitPerTotal = $ProfitPerTotal + $single->ProfitPer;
		$VatAmountTotal = $VatAmountTotal + $single->VatAmount;
		$VatTotalTotal = $VatTotalTotal + $single->VatTotal;
		$VatPerCentTotal = $VatPerCentTotal + $single->VatPerCent;
		$GrandTotalTotal = $GrandTotalTotal + $single->GrandTotal;

		$html .= '
		<tr>
			<th style="font-weight: 300;">' . $single->BillNo.'</th>
			<th style="font-weight: 300;">' . DateValue($single->BillDateTime). '</th>
			<th style="font-weight: 300;">' . $single->CustSupName. '</th>
			<th style="font-weight: 300;">' . AmountValue($single->ProductCode). '</th>
			<th style="font-weight: 300;">' . $single->ProductName. '</th>
			<th style="font-weight: 300;">' . AmountValue($single->Quantity). '</th>
			<th style="font-weight: 300;">' . AmountValue($single->Bonus). '</th>
			<th style="font-weight: 300;">' . $single->UnitName. '</th>
			<th style="font-weight: 300;">' . AmountValue($single->Price). '</th>
			<th style="font-weight: 300;">' . AmountValue($single->NetTotal). '</th>
			<th style="font-weight: 300;">' . $single->stype. '</th>
			<th style="font-weight: 300;">' . AmountValue($single->CostPrice). '</th>
			<th style="font-weight: 300;">' . AmountValue($single->CostTotal). '</th>
			<th style="font-weight: 300;">' . AmountValue($single->Profit). '</th>
			<th style="font-weight: 300;">' . AmountValue($single->ProfitPer). '</th>
			<th style="font-weight: 300;">' . AmountValue($single->VatAmount). '</th>
			<th style="font-weight: 300;">' . AmountValue($single->VatTotal). '</th>
			<th style="font-weight: 300;">' . AmountValue($single->VatPerCent). '</th>
			<th style="font-weight: 300;">' . AmountValue($single->GrandTotal). '</th>
			<th style="font-weight: 300;">' . $single->UserName. '</th>
			<th style="font-weight: 300;">' . $single->BName. '</th>
		</tr>';
		$counter++;
	}
	$html .= '
		<tr>
			<th style="font-weight: 600; text-align:center;" colspan="5">Total</th>
			<th style="font-weight: 600;">' . AmountValue($QuantityTotal) . '</th>
			<th style="font-weight: 600;">' . AmountValue($BonusTotal) . '</th>
			<th style="font-weight: 600;"></th>
			<th style="font-weight: 600;">' . AmountValue($PriceTotal) . '</th>
			<th style="font-weight: 600;">' . AmountValue($NetTotalTotal) . '</th>
			<th style="font-weight: 600;"></th>
			<th style="font-weight: 600;">' . AmountValue($CostPriceTotal) . '</th>
			<th style="font-weight: 600;">' . AmountValue($CostTotalTotal) . '</th>
			<th style="font-weight: 600;">' . AmountValue($ProfitTotal) . '</th>
			<th style="font-weight: 600;">' . AmountValue($ProfitPerTotal) . '</th>
			<th style="font-weight: 600;">' . AmountValue($VatAmountTotal) . '</th>
			<th style="font-weight: 600;">' . AmountValue($VatTotalTotal) . '</th>
			<th style="font-weight: 600;">' . AmountValue($VatPerCentTotal) . '</th>
			<th style="font-weight: 600;">' . AmountValue($GrandTotalTotal) . '</th>
			<th style="font-weight: 600;"></th>
			<th style="font-weight: 600;"></th>

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
			<th style="font-weight: 500;">' . getArabicTitle('BillNo') . '</th>
			<th style="font-weight: 500;">' . getArabicTitle('Bill Date / Time') . '</th>	
			<th style="font-weight: 500;">' . getArabicTitle('Customer') . '</th>	
			<th style="font-weight: 500;">' . getArabicTitle('Product Code') . '</th>	
			<th style="font-weight: 500;">' . getArabicTitle('Product Name') . '</th>	
			<th style="font-weight: 500;">' . getArabicTitle('Quantity') . '</th>	
			<th style="font-weight: 500;">' . getArabicTitle('Bonus') . '</th>	
			<th style="font-weight: 500;">' . getArabicTitle('Unit') . '</th>	
			<th style="font-weight: 500;">' . getArabicTitle('Price') . '</th>	
			<th style="font-weight: 500;">' . getArabicTitle('Net Total') . '</th>	
			<th style="font-weight: 500;">' . getArabicTitle('SalesType') . '</th>	
			<th style="font-weight: 500;">' . getArabicTitle('Cost Price') . '</th>	
			<th style="font-weight: 500;">' . getArabicTitle('Cost Total') . '</th>	
			<th style="font-weight: 500;">' . getArabicTitle('Profit') . '</th>	
			<th style="font-weight: 500;">' . getArabicTitle('Profit %') . '</th>	
			<th style="font-weight: 500;">' . getArabicTitle('Vat Amount') . '</th>	
			<th style="font-weight: 500;">' . getArabicTitle('Vat Total') . '</th>	
			<th style="font-weight: 500;">' . getArabicTitle('Vat %') . '</th>	
			<th style="font-weight: 500;">' . getArabicTitle('GrandTotal') . '</th>	
			<th style="font-weight: 500;">' . getArabicTitle('UserName') . '</th>	
			<th style="font-weight: 500;">' . getArabicTitle('BName') . '</th>
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
		$QuantityTotal = $QuantityTotal + $single->Quantity;
		$BonusTotal = $BonusTotal + $single->Bonus;
		$PriceTotal = $PriceTotal + $single->Price;
		$NetTotalTotal = $NetTotalTotal + $single->NetTotal;
		$CostPriceTotal = $CostPriceTotal + $single->CostPrice;
		$CostTotalTotal = $CostTotalTotal + $single->CostTotal;
		$ProfitTotal = $ProfitTotal + $single->Profit;
		$ProfitPerTotal = $ProfitPerTotal + $single->ProfitPer;
		$VatAmountTotal = $VatAmountTotal + $single->VatAmount;
		$VatTotalTotal = $VatTotalTotal + $single->VatTotal;
		$VatPerCentTotal = $VatPerCentTotal + $single->VatPerCent;
		$GrandTotalTotal = $GrandTotalTotal + $single->GrandTotal;


		$html .= '
		<tr>
			<th style="font-weight: 300;">' . $single->BillNo.'</th>
			<th style="font-weight: 300;">' . DateValue($single->BillDateTime). '</th>
			<th style="font-weight: 300;">' . $single->CustSupName. '</th>
			<th style="font-weight: 300;">' . AmountValue($single->ProductCode). '</th>
			<th style="font-weight: 300;">' . $single->ProductName. '</th>
			<th style="font-weight: 300;">' . AmountValue($single->Quantity). '</th>
			<th style="font-weight: 300;">' . AmountValue($single->Bonus). '</th>
			<th style="font-weight: 300;">' . $single->UnitName. '</th>
			<th style="font-weight: 300;">' . AmountValue($single->Price). '</th>
			<th style="font-weight: 300;">' . AmountValue($single->NetTotal). '</th>
			<th style="font-weight: 300;">' . $single->stype. '</th>
			<th style="font-weight: 300;">' . AmountValue($single->CostPrice). '</th>
			<th style="font-weight: 300;">' . AmountValue($single->CostTotal). '</th>
			<th style="font-weight: 300;">' . AmountValue($single->Profit). '</th>
			<th style="font-weight: 300;">' . AmountValue($single->ProfitPer). '</th>
			<th style="font-weight: 300;">' . AmountValue($single->VatAmount). '</th>
			<th style="font-weight: 300;">' . AmountValue($single->VatTotal). '</th>
			<th style="font-weight: 300;">' . AmountValue($single->VatPerCent). '</th>
			<th style="font-weight: 300;">' . AmountValue($single->GrandTotal). '</th>
			<th style="font-weight: 300;">' . $single->UserName. '</th>
			<th style="font-weight: 300;">' . $single->BName. '</th>
		</tr>';
		$counter++;
	}
	$html .= '
		<tr>
			<th style="font-weight: 600; text-align:center;" colspan="5">Total</th>
			<th style="font-weight: 600;">' . AmountValue($QuantityTotal) . '</th>
			<th style="font-weight: 600;">' . AmountValue($BonusTotal) . '</th>
			<th style="font-weight: 600;"></th>
			<th style="font-weight: 600;">' . AmountValue($PriceTotal) . '</th>
			<th style="font-weight: 600;">' . AmountValue($NetTotalTotal) . '</th>
			<th style="font-weight: 600;"></th>
			<th style="font-weight: 600;">' . AmountValue($CostPriceTotal) . '</th>
			<th style="font-weight: 600;">' . AmountValue($CostTotalTotal) . '</th>
			<th style="font-weight: 600;">' . AmountValue($ProfitTotal) . '</th>
			<th style="font-weight: 600;">' . AmountValue($ProfitPerTotal) . '</th>
			<th style="font-weight: 600;">' . AmountValue($VatAmountTotal) . '</th>
			<th style="font-weight: 600;">' . AmountValue($VatTotalTotal) . '</th>
			<th style="font-weight: 600;">' . AmountValue($VatPerCentTotal) . '</th>
			<th style="font-weight: 600;">' . AmountValue($GrandTotalTotal) . '</th>
			<th style="font-weight: 600;"></th>
			<th style="font-weight: 600;"></th>

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