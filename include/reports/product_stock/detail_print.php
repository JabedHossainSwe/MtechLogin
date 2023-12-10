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
			<th style="font-weight: 500;">ProductCode</th>
			<th style="font-weight: 500;">ProductName</th>
			<th style="font-weight: 500;">Unit</th>
			<th style="font-weight: 500;">Balance</th>
			<th style="font-weight: 500;">OpenQty</th>
			<th style="font-weight: 500;">CarryForwordBalance</th>
			<th style="font-weight: 500;">PurQty</th>
			<th style="font-weight: 500;">PurRetQty</th>
			<th style="font-weight: 500;">StockOut</th>
			<th style="font-weight: 500;">SalesQty</th>
			<th style="font-weight: 500;">SalRetQty</th>
			<th style="font-weight: 500;">TrnsferedtQty</th>
			<th style="font-weight: 500;">TrnsferReceivedQty</th>
			<th style="font-weight: 500;">ProductionQTy</th>
			<th style="font-weight: 500;">ProductionRawMaterialQty</th>
			<th style="font-weight: 500;">ProductinDeComQty</th>
			<th style="font-weight: 500;">ProductionDecomRawmaterialDeCom</th>
			<th style="font-weight: 500;">StockReceivingQty</th>
			<th style="font-weight: 500;">DeliveryQTy</th>
			<th style="font-weight: 500;">AdjustQty</th>
			<th style="font-weight: 500;">SalQtyIn</th>
			<th style="font-weight: 500;">SalQtyOut</th>
			<th style="font-weight: 500;">AvgCost</th>
			<th style="font-weight: 500;">AvgCostTotal</th>
			<th style="font-weight: 500;">SalePrice</th>
			<th style="font-weight: 500;">SalPriceTotal</th>
			<th style="font-weight: 500;">PurPrice</th>
			<th style="font-weight: 500;">PurPriceTotal</th>
			<th style="font-weight: 500;">ProductDesc</th>
		</tr>';

	$detailsSp = Run($query);
	while ($single = myfetch($detailsSp)) {

		$BalanceTot = $BalanceTot + $single->Balance;
		$OpenQtyTot = $OpenQtyTot + $single->OpenQty;
		$CarryForwordBalanceTot = $CarryForwordBalanceTot + $single->CarryForwordBalance;
		$PurQtyTot = $PurQtyTot + $single->PurQty;
		$PurRetQtyTot = $PurRetQtyTot + $single->PurRetQty;
		$StockOutTot = $StockOutTot + $single->StockOut;
		$SalesQtyTot = $SalesQtyTot + $single->SalesQty;
		$SalRetQtyTot = $SalRetQtyTot + $single->SalRetQty;
		$TrnsferedtQtyTot = $TrnsferedtQtyTot + $single->TrnsferedtQty;
		$TrnsferReceivedQtyTot = $TrnsferReceivedQtyTot + $single->TrnsferReceivedQty;
		$ProductionQTyTot = $ProductionQTyTot + $single->ProductionQTy;
		$ProductionRawMaterialQtyTot = $ProductionRawMaterialQtyTot + $single->ProductionRawMaterialQty;
		$ProductinDeComQtyTot = $ProductinDeComQtyTot + $single->ProductinDeComQty;
		$ProductionDecomRawmaterialDeComTot = $ProductionDecomRawmaterialDeComTot + $single->ProductionDecomRawmaterialDeCom;
		$StockReceivingQtyTot = $StockReceivingQtyTot + $single->StockReceivingQty;
		$DeliveryQTyTot = $DeliveryQTyTot + $single->DeliveryQTy;
		$AdjustQtyTot = $AdjustQtyTot + $single->AdjustQty;
		$SalQtyInTot = $SalQtyInTot + $single->SalQtyIn;
		$SalQtyOutTot = $SalQtyOutTot + $single->SalQtyOut;
		$AvgCostTot = $AvgCostTot + $single->AvgCost;
		$AvgCostTotalTot = $AvgCostTotalTot + $single->AvgCostTotal;
		$SalePriceTot = $SalePriceTot + $single->SalePrice;
		$SalPriceTotalTot = $SalPriceTotalTot + $single->SalPriceTotal;
		$PurPriceTot = $PurPriceTot + $single->PurPrice;
		$PurPriceTotalTot = $PurPriceTotalTot + $single->PurPriceTotal;


		$html .= '
		<tr>
			<th style="font-weight: 300;">' . $single->ProductCode . '</th>
			<th style="font-weight: 300;">' . $single->ProductName . '</th>
			<th style="font-weight: 300;">' . $single->UnitName . '</th>
			<th style="font-weight: 300;">' . AmountValue($single->Balance) . '</th>
			<th style="font-weight: 300;">' . AmountValue($single->OpenQty) . '</th>
			<th style="font-weight: 300;">' . AmountValue($single->CarryForwordBalance) . '</th>
			<th style="font-weight: 300;">' . AmountValue($single->PurQty) . '</th>
			<th style="font-weight: 300;">' . AmountValue($single->PurRetQty) . '</th>
			<th style="font-weight: 300;">' . AmountValue($single->StockOut) . '</th>
			<th style="font-weight: 300;">' . AmountValue($single->SalesQty) . '</th>
			<th style="font-weight: 300;">' . AmountValue($single->SalRetQty) . '</th>
			<th style="font-weight: 300;">' . AmountValue($single->TrnsferedtQty) . '</th>
			<th style="font-weight: 300;">' . AmountValue($single->TrnsferReceivedQty) . '</th>
			<th style="font-weight: 300;">' . AmountValue($single->ProductionQTy) . '</th>
			<th style="font-weight: 300;">' . AmountValue($single->ProductionRawMaterialQty) . '</th>
			<th style="font-weight: 300;">' . AmountValue($single->ProductinDeComQty) . '</th>
			<th style="font-weight: 300;">' . AmountValue($single->ProductionDecomRawmaterialDeCom) . '</th>
			<th style="font-weight: 300;">' . AmountValue($single->StockReceivingQty) . '</th>
			<th style="font-weight: 300;">' . AmountValue($single->DeliveryQTy) . '</th>
			<th style="font-weight: 300;">' . AmountValue($single->AdjustQty) . '</th>
			<th style="font-weight: 300;">' . AmountValue($single->SalQtyIn) . '</th>
			<th style="font-weight: 300;">' . AmountValue($single->SalQtyOut) . '</th>
			<th style="font-weight: 300;">' . AmountValue($single->AvgCost) . '</th>
			<th style="font-weight: 300;">' . AmountValue($single->AvgCostTotal) . '</th>
			<th style="font-weight: 300;">' . AmountValue($single->SalePrice) . '</th>
			<th style="font-weight: 300;">' . AmountValue($single->SalPriceTotal) . '</th>
			<th style="font-weight: 300;">' . AmountValue($single->PurPrice) . '</th>
			<th style="font-weight: 300;">' . AmountValue($single->PurPriceTotal) . '</th>
			<th style="font-weight: 300;">' . AmountValue($single->ProductDesc) . '</th>
		</tr>';
	}
	$html .= '
		<tr>
			<th style="font-weight: 600; text-align:center;" colspan="3">Total</th>
			<th style="font-weight: 600;">' . AmountValue($BalanceTot) . '</th>
			<th style="font-weight: 600;">' . AmountValue($OpenQtyTot) . '</th>
			<th style="font-weight: 600;">' . AmountValue($CarryForwordBalanceTot) . '</th>
			<th style="font-weight: 600;">' . AmountValue($PurQtyTot) . '</th>
			<th style="font-weight: 600;">' . AmountValue($PurRetQtyTot) . '</th>
			<th style="font-weight: 600;">' . AmountValue($StockOutTot) . '</th>
			<th style="font-weight: 600;">' . AmountValue($SalesQtyTot) . '</th>
			<th style="font-weight: 600;">' . AmountValue($SalRetQtyTot) . '</th>
			<th style="font-weight: 600;">' . AmountValue($TrnsferedtQtyTot) . '</th>
			<th style="font-weight: 600;">' . AmountValue($TrnsferReceivedQtyTot) . '</th>
			<th style="font-weight: 600;">' . AmountValue($ProductionQTyTot) . '</th>
			<th style="font-weight: 600;">' . AmountValue($ProductionRawMaterialQtyTot) . '</th>
			<th style="font-weight: 600;">' . AmountValue($ProductinDeComQtyTot) . '</th>
			<th style="font-weight: 600;">' . AmountValue($ProductionDecomRawmaterialDeComTot) . '</th>
			<th style="font-weight: 600;">' . AmountValue($StockReceivingQtyTot) . '</th>
			<th style="font-weight: 600;">' . AmountValue($DeliveryQTyTot) . '</th>
			<th style="font-weight: 600;">' . AmountValue($AdjustQtyTot) . '</th>
			<th style="font-weight: 600;">' . AmountValue($SalQtyInTot) . '</th>
			<th style="font-weight: 600;">' . AmountValue($SalQtyOutTot) . '</th>
			<th style="font-weight: 600;">' . AmountValue($AvgCostTot) . '</th>
			<th style="font-weight: 600;">' . AmountValue($AvgCostTotalTot) . '</th>
			<th style="font-weight: 600;">' . AmountValue($SalePriceTot) . '</th>
			<th style="font-weight: 600;">' . AmountValue($SalPriceTotalTot) . '</th>
			<th style="font-weight: 600;">' . AmountValue($PurPriceTot) . '</th>
			<th style="font-weight: 600;">' . AmountValue($PurPriceTotalTot) . '</th>
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
			<th style="font-weight: 500;">' . getArabicTitle('ProductCode') . '</th>
			<th style="font-weight: 500;">' . getArabicTitle('ProductName') . '</th>
			<th style="font-weight: 500;">' . getArabicTitle('Unit') . '</th>
			<th style="font-weight: 500;">' . getArabicTitle('Balance') . '</th>
			<th style="font-weight: 500;">' . getArabicTitle('OpenQty') . '</th>
			<th style="font-weight: 500;">' . getArabicTitle('CarryForwordBalance') . '</th>
			<th style="font-weight: 500;">' . getArabicTitle('PurQty') . '</th>
			<th style="font-weight: 500;">' . getArabicTitle('PurRetQty') . '</th>
			<th style="font-weight: 500;">' . getArabicTitle('StockOut') . '</th>
			<th style="font-weight: 500;">' . getArabicTitle('SalesQty') . '</th>
			<th style="font-weight: 500;">' . getArabicTitle('SalRetQty') . '</th>
			<th style="font-weight: 500;">' . getArabicTitle('TrnsferedtQty') . '</th>
			<th style="font-weight: 500;">' . getArabicTitle('TrnsferReceivedQty') . '</th>
			<th style="font-weight: 500;">' . getArabicTitle('ProductionQTy') . '</th>
			<th style="font-weight: 500;">' . getArabicTitle('ProductionRawMaterialQty') . '</th>
			<th style="font-weight: 500;">' . getArabicTitle('ProductinDeComQty') . '</th>
			<th style="font-weight: 500;">' . getArabicTitle('ProductionDecomRawmaterialDeCom') . '</th>
			<th style="font-weight: 500;">' . getArabicTitle('StockReceivingQty') . '</th>
			<th style="font-weight: 500;">' . getArabicTitle('DeliveryQTy') . '</th>
			<th style="font-weight: 500;">' . getArabicTitle('AdjustQty') . '</th>
			<th style="font-weight: 500;">' . getArabicTitle('SalQtyIn') . '</th>
			<th style="font-weight: 500;">' . getArabicTitle('SalQtyOut') . '</th>
			<th style="font-weight: 500;">' . getArabicTitle('AvgCost') . '</th>
			<th style="font-weight: 500;">' . getArabicTitle('AvgCostTotal') . '</th>
			<th style="font-weight: 500;">' . getArabicTitle('SalePrice') . '</th>
			<th style="font-weight: 500;">' . getArabicTitle('SalPriceTotal') . '</th>
			<th style="font-weight: 500;">' . getArabicTitle('PurPrice') . '</th>
			<th style="font-weight: 500;">' . getArabicTitle('PurPriceTotal') . '</th>
			<th style="font-weight: 500;">' . getArabicTitle('ProductDesc') . '</th>

		</tr>';


	$detailsSp = Run($query);
	while ($single = myfetch($detailsSp)) {
		$BalanceTot = $BalanceTot + $single->Balance;
		$OpenQtyTot = $OpenQtyTot + $single->OpenQty;
		$CarryForwordBalanceTot = $CarryForwordBalanceTot + $single->CarryForwordBalance;
		$PurQtyTot = $PurQtyTot + $single->PurQty;
		$PurRetQtyTot = $PurRetQtyTot + $single->PurRetQty;
		$StockOutTot = $StockOutTot + $single->StockOut;
		$SalesQtyTot = $SalesQtyTot + $single->SalesQty;
		$SalRetQtyTot = $SalRetQtyTot + $single->SalRetQty;
		$TrnsferedtQtyTot = $TrnsferedtQtyTot + $single->TrnsferedtQty;
		$TrnsferReceivedQtyTot = $TrnsferReceivedQtyTot + $single->TrnsferReceivedQty;
		$ProductionQTyTot = $ProductionQTyTot + $single->ProductionQTy;
		$ProductionRawMaterialQtyTot = $ProductionRawMaterialQtyTot + $single->ProductionRawMaterialQty;
		$ProductinDeComQtyTot = $ProductinDeComQtyTot + $single->ProductinDeComQty;
		$ProductionDecomRawmaterialDeComTot = $ProductionDecomRawmaterialDeComTot + $single->ProductionDecomRawmaterialDeCom;
		$StockReceivingQtyTot = $StockReceivingQtyTot + $single->StockReceivingQty;
		$DeliveryQTyTot = $DeliveryQTyTot + $single->DeliveryQTy;
		$AdjustQtyTot = $AdjustQtyTot + $single->AdjustQty;
		$SalQtyInTot = $SalQtyInTot + $single->SalQtyIn;
		$SalQtyOutTot = $SalQtyOutTot + $single->SalQtyOut;
		$AvgCostTot = $AvgCostTot + $single->AvgCost;
		$AvgCostTotalTot = $AvgCostTotalTot + $single->AvgCostTotal;
		$SalePriceTot = $SalePriceTot + $single->SalePrice;
		$SalPriceTotalTot = $SalPriceTotalTot + $single->SalPriceTotal;
		$PurPriceTot = $PurPriceTot + $single->PurPrice;
		$PurPriceTotalTot = $PurPriceTotalTot + $single->PurPriceTotal;

		$html .= '
		<tr>
			<th style="font-weight: 300;">' . $single->ProductCode . '</th>
			<th style="font-weight: 300;">' . $single->ProductName . '</th>
			<th style="font-weight: 300;">' . $single->UnitName . '</th>
			<th style="font-weight: 300;">' . AmountValue($single->Balance) . '</th>
			<th style="font-weight: 300;">' . AmountValue($single->OpenQty) . '</th>
			<th style="font-weight: 300;">' . AmountValue($single->CarryForwordBalance) . '</th>
			<th style="font-weight: 300;">' . AmountValue($single->PurQty) . '</th>
			<th style="font-weight: 300;">' . AmountValue($single->PurRetQty) . '</th>
			<th style="font-weight: 300;">' . AmountValue($single->StockOut) . '</th>
			<th style="font-weight: 300;">' . AmountValue($single->SalesQty) . '</th>
			<th style="font-weight: 300;">' . AmountValue($single->SalRetQty) . '</th>
			<th style="font-weight: 300;">' . AmountValue($single->TrnsferedtQty) . '</th>
			<th style="font-weight: 300;">' . AmountValue($single->TrnsferReceivedQty) . '</th>
			<th style="font-weight: 300;">' . AmountValue($single->ProductionQTy) . '</th>
			<th style="font-weight: 300;">' . AmountValue($single->ProductionRawMaterialQty) . '</th>
			<th style="font-weight: 300;">' . AmountValue($single->ProductinDeComQty) . '</th>
			<th style="font-weight: 300;">' . AmountValue($single->ProductionDecomRawmaterialDeCom) . '</th>
			<th style="font-weight: 300;">' . AmountValue($single->StockReceivingQty) . '</th>
			<th style="font-weight: 300;">' . AmountValue($single->DeliveryQTy) . '</th>
			<th style="font-weight: 300;">' . AmountValue($single->AdjustQty) . '</th>
			<th style="font-weight: 300;">' . AmountValue($single->SalQtyIn) . '</th>
			<th style="font-weight: 300;">' . AmountValue($single->SalQtyOut) . '</th>
			<th style="font-weight: 300;">' . AmountValue($single->AvgCost) . '</th>
			<th style="font-weight: 300;">' . AmountValue($single->AvgCostTotal) . '</th>
			<th style="font-weight: 300;">' . AmountValue($single->SalePrice) . '</th>
			<th style="font-weight: 300;">' . AmountValue($single->SalPriceTotal) . '</th>
			<th style="font-weight: 300;">' . AmountValue($single->PurPrice) . '</th>
			<th style="font-weight: 300;">' . AmountValue($single->PurPriceTotal) . '</th>
			<th style="font-weight: 300;">' . AmountValue($single->ProductDesc) . '</th>
		</tr>';
	}
	$html .= '
		<tr>
			<th style="font-weight: 600; text-align:center;" colspan="3">'.getArabicTitle('Total').'</th>
			<th style="font-weight: 600;">' . AmountValue($BalanceTot) . '</th>
			<th style="font-weight: 600;">' . AmountValue($OpenQtyTot) . '</th>
			<th style="font-weight: 600;">' . AmountValue($CarryForwordBalanceTot) . '</th>
			<th style="font-weight: 600;">' . AmountValue($PurQtyTot) . '</th>
			<th style="font-weight: 600;">' . AmountValue($PurRetQtyTot) . '</th>
			<th style="font-weight: 600;">' . AmountValue($StockOutTot) . '</th>
			<th style="font-weight: 600;">' . AmountValue($SalesQtyTot) . '</th>
			<th style="font-weight: 600;">' . AmountValue($SalRetQtyTot) . '</th>
			<th style="font-weight: 600;">' . AmountValue($TrnsferedtQtyTot) . '</th>
			<th style="font-weight: 600;">' . AmountValue($TrnsferReceivedQtyTot) . '</th>
			<th style="font-weight: 600;">' . AmountValue($ProductionQTyTot) . '</th>
			<th style="font-weight: 600;">' . AmountValue($ProductionRawMaterialQtyTot) . '</th>
			<th style="font-weight: 600;">' . AmountValue($ProductinDeComQtyTot) . '</th>
			<th style="font-weight: 600;">' . AmountValue($ProductionDecomRawmaterialDeComTot) . '</th>
			<th style="font-weight: 600;">' . AmountValue($StockReceivingQtyTot) . '</th>
			<th style="font-weight: 600;">' . AmountValue($DeliveryQTyTot) . '</th>
			<th style="font-weight: 600;">' . AmountValue($AdjustQtyTot) . '</th>
			<th style="font-weight: 600;">' . AmountValue($SalQtyInTot) . '</th>
			<th style="font-weight: 600;">' . AmountValue($SalQtyOutTot) . '</th>
			<th style="font-weight: 600;">' . AmountValue($AvgCostTot) . '</th>
			<th style="font-weight: 600;">' . AmountValue($AvgCostTotalTot) . '</th>
			<th style="font-weight: 600;">' . AmountValue($SalePriceTot) . '</th>
			<th style="font-weight: 600;">' . AmountValue($SalPriceTotalTot) . '</th>
			<th style="font-weight: 600;">' . AmountValue($PurPriceTot) . '</th>
			<th style="font-weight: 600;">' . AmountValue($PurPriceTotalTot) . '</th>
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