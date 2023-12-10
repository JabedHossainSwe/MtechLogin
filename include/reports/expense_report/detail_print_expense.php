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
			<th style="font-weight: 500;">BillNo</th>
			<th style="font-weight: 500;">Bill Date</th>
			<th style="font-weight: 500;">Expense</th>
			<th style="font-weight: 500;">Amount</th>
			<th style="font-weight: 500;">VatAmount</th>
			<th style="font-weight: 500;">GTotal</th>
			<th style="font-weight: 500;">Remark</th>
			<th style="font-weight: 500;">Bank</th>
			<th style="font-weight: 500;">Supplier</th>
			<th style="font-weight: 500;">User</th>
			<th style="font-weight: 500;">Branch</th>
		</tr>';

	$detailsSp = Run($query);
	while ($single = myfetch($detailsSp)) {
		$AmountTot = $AmountTot + $single->Amount;
		$VatAmountTot = $VatAmountTot + $single->VatAmount;
		$GTotalTot = $GTotalTot + $single->GTotal;


		$html .= '
		<tr>
			<th style="font-weight: 300;">' . $single->Billno . '</th>
			<th style="font-weight: 300;">' . DateValue($single->BillDateTime) . '</th>
			<th style="font-weight: 300;">' . $single->ExpenseName . '</th>
			<th style="font-weight: 300;">' . AmountValue($single->Amount) . '</th>
			<th style="font-weight: 300;">' . AmountValue($single->VatAmount) . '</th>
			<th style="font-weight: 300;">' . AmountValue($single->GTotal) . '</th>
			<th style="font-weight: 300;">' . $single->Remark . '</th>
			<th style="font-weight: 300;">' . $single->BankName . '</th>
			<th style="font-weight: 300;">' . $single->SupName . '</th>
			<th style="font-weight: 300;">' . $single->UserName . '</th>
			<th style="font-weight: 300;">' . $single->BranchName . '</th>
		</tr>';
	}
	$html .= '
		<tr>
			<th style="font-weight: 600; text-align:center;" colspan="3">Total</th>
			<th style="font-weight: 600;">' . AmountValue($AmountTot) . '</th>
			<th style="font-weight: 600;">' . AmountValue($VatAmountTot) . '</th>
			<th style="font-weight: 600;">' . AmountValue($GTotalTot) . '</th>
			<th style="font-weight: 600;"></th>
			<th style="font-weight: 600;"></th>
			<th style="font-weight: 600;"></th>
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
			<th style="font-weight: 500;">' . getArabicTitle('Bill Date') . '</th>
			<th style="font-weight: 500;">' . getArabicTitle('Expense') . '</th>
			<th style="font-weight: 500;">' . getArabicTitle('Amount') . '</th>
			<th style="font-weight: 500;">' . getArabicTitle('VatAmount') . '</th>
			<th style="font-weight: 500;">' . getArabicTitle('GTotal') . '</th>
			<th style="font-weight: 500;">' . getArabicTitle('Remark') . '</th>
			<th style="font-weight: 500;">' . getArabicTitle('Bank') . '</th>
			<th style="font-weight: 500;">' . getArabicTitle('Supplier') . '</th>
			<th style="font-weight: 500;">' . getArabicTitle('User') . '</th>
			<th style="font-weight: 500;">' . getArabicTitle('Branch') . '</th>

		</tr>';


	$detailsSp = Run($query);
	while ($single = myfetch($detailsSp)) {
		$AmountTot = $AmountTot + $single->Amount;
		$VatAmountTot = $VatAmountTot + $single->VatAmount;
		$GTotalTot = $GTotalTot + $single->GTotal;

		$html .= '
		<tr>
			<th style="font-weight: 300;">' . $single->Billno . '</th>
			<th style="font-weight: 300;">' . DateValue($single->BillDateTime) . '</th>
			<th style="font-weight: 300;">' . $single->ExpenseName . '</th>
			<th style="font-weight: 300;">' . AmountValue($single->Amount) . '</th>
			<th style="font-weight: 300;">' . AmountValue($single->VatAmount) . '</th>
			<th style="font-weight: 300;">' . AmountValue($single->GTotal) . '</th>
			<th style="font-weight: 300;">' . $single->Remark . '</th>
			<th style="font-weight: 300;">' . $single->BankName . '</th>
			<th style="font-weight: 300;">' . $single->SupName . '</th>
			<th style="font-weight: 300;">' . $single->UserName . '</th>
			<th style="font-weight: 300;">' . $single->BranchName . '</th>
		</tr>';
	}
	$html .= '
		<tr>
			<th style="font-weight: 600; text-align:center;" colspan="3">'.getArabicTitle('Total').'</th>
			<th style="font-weight: 600;">' . AmountValue($AmountTot) . '</th>
			<th style="font-weight: 600;">' . AmountValue($VatAmountTot) . '</th>
			<th style="font-weight: 600;">' . AmountValue($GTotalTot) . '</th>
			<th style="font-weight: 600;"></th>
			<th style="font-weight: 600;"></th>
			<th style="font-weight: 600;"></th>
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