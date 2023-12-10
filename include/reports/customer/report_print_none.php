<?php

use Mpdf\Mpdf;

session_start();
error_reporting(0);
include("../../../config/connection.php");
// include("../../../config/functions.php");
include("../../../config/main_connection.php");
include("../../../config/main_functions.php");
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
			<th style="font-weight: 500;">Bill No</th>
			<th style="font-weight: 500;">Bill Date</th>
			<th style="font-weight: 500;">Customer</th>
			<th style="font-weight: 500;">Comments</th>
			<th style="font-weight: 500;">Total</th>
			<th style="font-weight: 500;">Discount</th>
			<th style="font-weight: 500;">Discount%</th>
			<th style="font-weight: 500;">NetTotal</th>
			<th style="font-weight: 500;">Branch</th>
		</tr>';

	$detailsSp = Run($query);
	while ($single = myfetch($detailsSp)) {
			$TotalTotal = $TotalTotal + $single->Total;
			$DiscountTotal = $DiscountTotal + $single->Discount;
			$disperTotal = $disperTotal + $single->DisPer;
			$NetTotalTotal = $NetTotalTotal + $single->NetTotal;


		$html .= '
		<tr>
			<th style="font-weight: 300;">' . $single->billno . '</th>
			<th style="font-weight: 300;">' . DateValue($single->billdate) . '</th>
			<th style="font-weight: 300;">' . $single->CustSupName . '</th>
			<th style="font-weight: 300;">' . $single->Notes . '</th>
			<th style="font-weight: 300;">' . AmountValue($single->Total) . '</th>
			<th style="font-weight: 300;">' . AmountValue($single->Discount) . '</th>
			<th style="font-weight: 300;">' . AmountValue($single->DisPer) . '</th>
			<th style="font-weight: 300;">' . AmountValue($single->NetTotal) . '</th>
			<th style="font-weight: 300;">' . $single->BrachName . '</th>
		</tr>';
	}
	$html .= '
		<tr>
			<th style="font-weight: 600; text-align:center;" colspan="4">Total</th>
			<th style="font-weight: 600;">' . AmountValue($TotalTotal) . '</th>
			<th style="font-weight: 600;">' . AmountValue($DiscountTotal) . '</th>
			<th style="font-weight: 600;">' . AmountValue($disperTotal) . '</th>
			<th style="font-weight: 600;">' . AmountValue($NetTotalTotal) . '</th>
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
			<th style="font-weight: 500;">' . getArabicTitle('Bill No') . '</th>
			<th style="font-weight: 500;">' . getArabicTitle('Bill Date') . '</th>
			<th style="font-weight: 500;">' . getArabicTitle('Customer') . '</th>
			<th style="font-weight: 500;">' . getArabicTitle('Comments') . '</th>
			<th style="font-weight: 500;">' . getArabicTitle('Total') . '</th>
			<th style="font-weight: 500;">' . getArabicTitle('Discount') . '</th>
			<th style="font-weight: 500;">' . getArabicTitle('Discount%') . '</th>
			<th style="font-weight: 500;">' . getArabicTitle('NetTotal') . '</th>
			<th style="font-weight: 500;">' . getArabicTitle('Branch') . '</th>
		</tr>';


	$detailsSp = Run($query);
	while ($single = myfetch($detailsSp)) {
			$TotalTotal = $TotalTotal + $single->Total;
			$DiscountTotal = $DiscountTotal + $single->Discount;
			$disperTotal = $disperTotal + $single->disper;
			$NetTotalTotal = $NetTotalTotal + $single->NetTotal;

		$html .= '
		<tr>
			<th style="font-weight: 300;">' . $single->billno . '</th>
			<th style="font-weight: 300;">' . DateValue($single->billdate) . '</th>
			<th style="font-weight: 300;">' . $single->CustSupName . '</th>
			<th style="font-weight: 300;">' . $single->Notes . '</th>
			<th style="font-weight: 300;">' . AmountValue($single->Total) . '</th>
			<th style="font-weight: 300;">' . AmountValue($single->Discount) . '</th>
			<th style="font-weight: 300;">' . AmountValue($single->DisPer) . '</th>
			<th style="font-weight: 300;">' . AmountValue($single->NetTotal) . '</th>
			<th style="font-weight: 300;">' . $single->BrachName . '</th>
		</tr>';
	}
	$html .= '
		<tr>
			<th style="font-weight: 600; text-align:center;" colspan="4">'.getArabicTitle('Total').'</th>
			<th style="font-weight: 600;">' . AmountValue($TotalTotal) . '</th>
			<th style="font-weight: 600;">' . AmountValue($DiscountTotal) . '</th>
			<th style="font-weight: 600;">' . AmountValue($disperTotal) . '</th>
			<th style="font-weight: 600;">' . AmountValue($NetTotalTotal) . '</th>
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


require '../../../Lib/mpdf/vendor/autoload.php';
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