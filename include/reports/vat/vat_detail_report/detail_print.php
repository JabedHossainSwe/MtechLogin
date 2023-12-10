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
		<h2 style="font-size: 0.6rem ; padding-left: 5px;"> MOB:' . $getLoginUserCompanyData->mobile . ' <br> <br> ' . $getLoginUserCompanyData->email . ' VAT#: ' . $getLoginUserCompanyData->vat . '
		</h2>

		</th>
		<th style="vertical-align: middle; width: 33%;">
		<img style="text-align: center;" width="80px" height="80px"
		src="http://217.76.50.216/' . $getLoginUserCompanyData->logo . '" 
		alt="">
		</th>
		<th style="vertical-align: middle; text-align: right; width: 33%;">
		<h2 style="font-size: 0.8rem; text-align: right;">' . $type . '</h2>
		</th>
		</table>
		<table border="1" style="width: 100%; font-size: 1rem; border-collapse: collapse;">
		<tr>
			<th style="font-weight: 500;">Description</th>
			<th style="font-weight: 500;">Customer/Supplier</th>
			<th style="font-weight: 500;">Vat Number</th>
			<th style="font-weight: 500;">Bill No</th>
			<th style="font-weight: 500;">Bill Date</th>
			<th style="font-weight: 500;">Total</th>
			<th style="font-weight: 500;">Discount</th>
			<th style="font-weight: 500;">Net Total</th>
			<th style="font-weight: 500;">Vat Amount</th>
			<th style="font-weight: 500;">Grand Total</th>
		</tr>';

	// $TotalAmountTotal = 0;
	// $VatDisTotalTotal = 0;
	// $TotalAmtVatableTotal = 0;
	// $NetAmountTotal = 0;
	// $totalVatTotal = 0;
	// $counter = 1;

	$detailsSp = Run($query);
	while ($single = myfetch($detailsSp)) {
		// $TotalAmountTotal = $TotalAmountTotal + $single->TotalAmount;
		// $VatDisTotalTotal = $VatDisTotalTotal + $single->VatDisTotal;
		// $TotalAmtVatableTotal = $TotalAmtVatableTotal + $single->TotalAmtVatable;
		// $NetAmountTotal = $NetAmountTotal + $single->NetAmount;
		// $totalVatTotal = $totalVatTotal + $single->totalVat;

		$html .= '
		<tr>
			<th style="font-weight: 300;">' . $single->TrnsTypeDesc . '</th>
			<th style="font-weight: 300;">' . $single->CustSuppName . '</th>
			<th style="font-weight: 300;">' . $single->VatNo . '</th>
			<th style="font-weight: 300;">' . $single->sbBillno . '</th>
			<th style="font-weight: 300;">' . DateValue($single->Billdate) . '</th>
			<th style="font-weight: 300;">' . AmountValue($single->TotalAmount) . '</th>
			<th style="font-weight: 300;">' . AmountValue($single->VatDisTotal) . '</th>
			<th style="font-weight: 300;">' . AmountValue($single->TotalAmtVatable) . '</th>
			<th style="font-weight: 300;">' . AmountValue($single->NetAmount) . '</th>
			<th style="font-weight: 300;">' . AmountValue($single->totalVat) . '</th>
		</tr>';
		// $counter++;
	}
	// <tr>
	// <th style="font-weight: 600; text-align:center;" colspan="5">Total</th>
	// <th style="font-weight: 600;">' . AmountValue($TotalAmountTotal) . '</th>
	// <th style="font-weight: 600;">' . AmountValue($VatDisTotalTotal) . '</th>
	// <th style="font-weight: 600;">' . AmountValue($TotalAmtVatableTotal) . '</th>
	// <th style="font-weight: 600;">' . AmountValue($NetAmountTotal) . '</th>
	// <th style="font-weight: 600;">' . AmountValue($totalVatTotal) . '</th>
	// </tr>
	$html .= '
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
			<th style="font-weight: 500;">' . getArabicTitle('Description') . '</th>
			<th style="font-weight: 500;">' . getArabicTitle('Customer/Supplier') . '</th>
			<th style="font-weight: 500;">' . getArabicTitle('Vat Number') . '</th>
			<th style="font-weight: 500;">' . getArabicTitle('Bill No') . '</th>
			<th style="font-weight: 500;">' . getArabicTitle('Bill Date') . '</th>
			<th style="font-weight: 500;">' . getArabicTitle('Total') . '</th>
			<th style="font-weight: 500;">' . getArabicTitle('Discount') . '</th>
			<th style="font-weight: 500;">' . getArabicTitle('Net Total') . '</th>
			<th style="font-weight: 500;">' . getArabicTitle('Vat Amount') . '</th>
			<th style="font-weight: 500;">' . getArabicTitle('Grand Total') . '</th>
		</tr>';

	$detailsSp = Run($query);
	while ($single = myfetch($detailsSp)) {

		$html .= '
		<tr>
			<th style="font-weight: 300;">' . getArabicTitle($single->TrnsTypeDesc) . '</th>
			<th style="font-weight: 300;">' . $single->CustSuppName . '</th>
			<th style="font-weight: 300;">' . $single->VatNo . '</th>
			<th style="font-weight: 300;">' . $single->sbBillno . '</th>
			<th style="font-weight: 300;">' . DateValue($single->Billdate) . '</th>
			<th style="font-weight: 300;">' . AmountValue($single->TotalAmount) . '</th>
			<th style="font-weight: 300;">' . AmountValue($single->VatDisTotal) . '</th>
			<th style="font-weight: 300;">' . AmountValue($single->TotalAmtVatable) . '</th>
			<th style="font-weight: 300;">' . AmountValue($single->NetAmount) . '</th>
			<th style="font-weight: 300;">' . AmountValue($single->totalVat) . '</th>
		</tr>';
	}
	$html .= '
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