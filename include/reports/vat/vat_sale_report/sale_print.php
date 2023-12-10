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
			<th style="font-weight: 500;">S.N</th>
			<th style="font-weight: 500;">Invoice Date</th>	
			<th style="font-weight: 500;">Sales Total</th>	
			<th style="font-weight: 500;">S.Discount</th>	
			<th style="font-weight: 500;">S.Net Total</th>	
			<th style="font-weight: 500;">S.Vat Total</th>	
			<th style="font-weight: 500;">Grand Total</th>	
			<th style="font-weight: 500;">Return Total</th>	
			<th style="font-weight: 500;">R.Discount</th>	
			<th style="font-weight: 500;">R.Net Total</th>	
			<th style="font-weight: 500;">R.Vat Total</th>	
			<th style="font-weight: 500;">Grand Total</th>		
			<th style="font-weight: 500;">Net Sales Amount</th>	
			<th style="font-weight: 500;">Net Vat Amount</th>	
		</tr>';

		$SalTotalTot = 0;
		$DiscountSalTot = 0;
		$SalNetTotalTot = 0;
		$SalVatTotalTot = 0;
		$VatSalTotalTot = 0;
		$RetTotalTot = 0;
		$DiscountRetTot = 0;
		$RetNetTotalTot = 0;
		$RetVatTotalTot = 0;
		$VatRetTotalTot = 0;
		$NetSalesAmountTot = 0;
		$NetVatAmountTot = 0;
		$counter = 1;

	$detailsSp = Run($query);
	while ($single = myfetch($detailsSp)) {
		$SalTotalTot = $SalTotalTot + $single->SalTotal;
		$DiscountSalTot = $DiscountSalTot + $single->DiscountSal;
		$SalNetTotalTot = $SalNetTotalTot + $single->SalNetTotal;
		$SalVatTotalTot = $SalVatTotalTot + $single->SalVatTotal;
		$VatSalTotalTot = $VatSalTotalTot + $single->VatSalTotal;
		$RetTotalTot = $RetTotalTot + $single->RetTotal;
		$DiscountRetTot = $DiscountRetTot + $single->DiscountRet;
		$RetNetTotalTot = $RetNetTotalTot + $single->RetNetTotal;
		$RetVatTotalTot = $RetVatTotalTot + $single->RetVatTotal;
		$VatRetTotalTot = $VatRetTotalTot + $single->VatRetTotal;
		$NetSalesAmountTot = $NetSalesAmountTot + $single->NetSalesAmount;
		$NetVatAmountTot = $NetVatAmountTot + $single->NetVatAmount;

		$html .= '
		<tr>
			<th style="font-weight: 300;">' . $counter . '</th>
			<th style="font-weight: 300;">' . DateValue($single->BillDate) . '</th>
			<th style="font-weight: 300;">' . AmountValue($single->SalTotal) . '</th>
			<th style="font-weight: 300;">' . AmountValue($single->DiscountSal) . '</th>
			<th style="font-weight: 300;">' . AmountValue($single->SalNetTotal) . '</th>
			<th style="font-weight: 300;">' . AmountValue($single->SalVatTotal) . '</th>
			<th style="font-weight: 300;">' . AmountValue($single->VatSalTotal) . '</th>
			<th style="font-weight: 300;">' . AmountValue($single->RetTotal) . '</th>
			<th style="font-weight: 300;">' . AmountValue($single->DiscountRet) . '</th>
			<th style="font-weight: 300;">' . AmountValue($single->RetNetTotal) . '</th>
			<th style="font-weight: 300;">' . AmountValue($single->RetVatTotal) . '</th>
			<th style="font-weight: 300;">' . AmountValue($single->VatRetTotal) . '</th>
			<th style="font-weight: 300;">' . AmountValue($single->NetSalesAmount) . '</th>
			<th style="font-weight: 300;">' . AmountValue($single->NetVatAmount) . '</th>
		</tr>';
		$counter++;
	}
	$html .= '
		<tr>
			<th style="font-weight: 600; text-align:center;" colspan="2">Total</th>
			<th style="font-weight: 600;">' . AmountValue($SalTotalTot) . '</th>
			<th style="font-weight: 600;">' . AmountValue($DiscountSalTot) . '</th>
			<th style="font-weight: 600;">' . AmountValue($SalNetTotalTot) . '</th>
			<th style="font-weight: 600;">' . AmountValue($SalVatTotalTot) . '</th>
			<th style="font-weight: 600;">' . AmountValue($VatSalTotalTot) . '</th>
			<th style="font-weight: 600;">' . AmountValue($RetTotalTot) . '</th>
			<th style="font-weight: 600;">' . AmountValue($DiscountRetTot) . '</th>
			<th style="font-weight: 600;">' . AmountValue($RetNetTotalTot) . '</th>
			<th style="font-weight: 600;">' . AmountValue($RetVatTotalTot) . '</th>
			<th style="font-weight: 600;">' . AmountValue($VatRetTotalTot) . '</th>
			<th style="font-weight: 600;">' . AmountValue($NetSalesAmountTot) . '</th>
			<th style="font-weight: 600;">' . AmountValue($NetVatAmountTot) . '</th>
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
			<th style="font-weight: 500;">' . getArabicTitle('S.N') . '</th>
			<th style="font-weight: 500;">' . getArabicTitle('Invoice Date') . '</th>	
			<th style="font-weight: 500;">' . getArabicTitle('Sales Total') . '</th>	
			<th style="font-weight: 500;">' . getArabicTitle('S.Discount') . '</th>	
			<th style="font-weight: 500;">' . getArabicTitle('S.Net Total') . '</th>	
			<th style="font-weight: 500;">' . getArabicTitle('S.Vat Total') . '</th>	
			<th style="font-weight: 500;">' . getArabicTitle('Grand Total') . '</th>	
			<th style="font-weight: 500;">' . getArabicTitle('Return Total') . '</th>	
			<th style="font-weight: 500;">' . getArabicTitle('R.Discount') . '</th>	
			<th style="font-weight: 500;">' . getArabicTitle('R.Net Total') . '</th>	
			<th style="font-weight: 500;">' . getArabicTitle('R.Vat Total') . '</th>	
			<th style="font-weight: 500;">' . getArabicTitle('Grand Total') . '</th>		
			<th style="font-weight: 500;">' . getArabicTitle('Net Sales Amount') . '</th>	
			<th style="font-weight: 500;">' . getArabicTitle('Net Vat Amount') . '</th>	
		</tr>';

		$SalTotalTot = 0;
		$DiscountSalTot = 0;
		$SalNetTotalTot = 0;
		$SalVatTotalTot = 0;
		$VatSalTotalTot = 0;
		$RetTotalTot = 0;
		$DiscountRetTot = 0;
		$RetNetTotalTot = 0;
		$RetVatTotalTot = 0;
		$VatRetTotalTot = 0;
		$NetSalesAmountTot = 0;
		$NetVatAmountTot = 0;
		$counter = 1;


	$detailsSp = Run($query);
	while ($single = myfetch($detailsSp)) {
		$SalTotalTot = $SalTotalTot + $single->SalTotal;
		$DiscountSalTot = $DiscountSalTot + $single->DiscountSal;
		$SalNetTotalTot = $SalNetTotalTot + $single->SalNetTotal;
		$SalVatTotalTot = $SalVatTotalTot + $single->SalVatTotal;
		$VatSalTotalTot = $VatSalTotalTot + $single->VatSalTotal;
		$RetTotalTot = $RetTotalTot + $single->RetTotal;
		$DiscountRetTot = $DiscountRetTot + $single->DiscountRet;
		$RetNetTotalTot = $RetNetTotalTot + $single->RetNetTotal;
		$RetVatTotalTot = $RetVatTotalTot + $single->RetVatTotal;
		$VatRetTotalTot = $VatRetTotalTot + $single->VatRetTotal;
		$NetSalesAmountTot = $NetSalesAmountTot + $single->NetSalesAmount;
		$NetVatAmountTot = $NetVatAmountTot + $single->NetVatAmount;

		$html .= '
		<tr>
			<th style="font-weight: 300;">' . $counter . '</th>
			<th style="font-weight: 300;">' . DateValue($single->BillDate) . '</th>
			<th style="font-weight: 300;">' . AmountValue($single->SalTotal) . '</th>
			<th style="font-weight: 300;">' . AmountValue($single->DiscountSal) . '</th>
			<th style="font-weight: 300;">' . AmountValue($single->SalNetTotal) . '</th>
			<th style="font-weight: 300;">' . AmountValue($single->SalVatTotal) . '</th>
			<th style="font-weight: 300;">' . AmountValue($single->VatSalTotal) . '</th>
			<th style="font-weight: 300;">' . AmountValue($single->RetTotal) . '</th>
			<th style="font-weight: 300;">' . AmountValue($single->DiscountRet) . '</th>
			<th style="font-weight: 300;">' . AmountValue($single->RetNetTotal) . '</th>
			<th style="font-weight: 300;">' . AmountValue($single->RetVatTotal) . '</th>
			<th style="font-weight: 300;">' . AmountValue($single->VatRetTotal) . '</th>
			<th style="font-weight: 300;">' . AmountValue($single->NetSalesAmount) . '</th>
			<th style="font-weight: 300;">' . AmountValue($single->NetVatAmount) . '</th>
		</tr>';
		$counter++;
	}
	$html .= '
		<tr>
			<th style="font-weight: 600; text-align:center;" colspan="2">' . getArabicTitle('Total') . '</th>
			<th style="font-weight: 600;">' . AmountValue($SalTotalTot) . '</th>
			<th style="font-weight: 600;">' . AmountValue($DiscountSalTot) . '</th>
			<th style="font-weight: 600;">' . AmountValue($SalNetTotalTot) . '</th>
			<th style="font-weight: 600;">' . AmountValue($SalVatTotalTot) . '</th>
			<th style="font-weight: 600;">' . AmountValue($VatSalTotalTot) . '</th>
			<th style="font-weight: 600;">' . AmountValue($RetTotalTot) . '</th>
			<th style="font-weight: 600;">' . AmountValue($DiscountRetTot) . '</th>
			<th style="font-weight: 600;">' . AmountValue($RetNetTotalTot) . '</th>
			<th style="font-weight: 600;">' . AmountValue($RetVatTotalTot) . '</th>
			<th style="font-weight: 600;">' . AmountValue($VatRetTotalTot) . '</th>
			<th style="font-weight: 600;">' . AmountValue($NetSalesAmountTot) . '</th>
			<th style="font-weight: 600;">' . AmountValue($NetVatAmountTot) . '</th>
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