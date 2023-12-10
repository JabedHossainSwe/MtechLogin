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
$type = $_REQUEST['type'];


$html='';

$servername = $_SERVER['SERVER_NAME'];


$getLoginUserCompanyData = getLoginUserCompanyData($_SESSION['id']);

$html .='<style> 
	body{
		background-image: url("http://217.76.50.216/'.$getLoginUserCompanyData->logo.'.");
		background-repeat: no-repeat;
		background-position: center;
		background-size: cover;
	}
	
	#Sale-Inovice{
		background-color: rgba(255, 255, 255, 0.7);
	}
	</style>';




///// Language Id 1 For English ///
if($LanguageId==1)
{
	

$html .='<div id="Sale-Inovice" style="-webkit-print-color-adjust:exact !important;
print-color-adjust:exact !important; border: 5px solid rgba(143, 192, 235, 0.5); margin: 8px;">
<table style="width: 100%; text-align: start;" border="0">
<tr>
<th style="width: 100%; text-align: center; font-size: 0.8rem; background-color: rgb(143, 192, 235);"
colspan="5">
<h1>'.$getLoginUserCompanyData->name.'</h1>
</th>

</tr>
<tr class="row">
<th style="text-align: start; vertical-align: middle; width: 33%;">
<h2 style="font-size: 0.6rem ; padding-left: 5px;"> MOB:'.$getLoginUserCompanyData->mobile.' <br> '.$getLoginUserCompanyData->email.' VAT#: '.$getLoginUserCompanyData->vat.'
</h2>

</th>
<th style="vertical-align: middle; width: 33%;">
<img style="text-align: center;" width="80px" height="80px"
src="http://217.76.50.216/'.$getLoginUserCompanyData->logo.'" 
alt="">
</th>
<th style="vertical-align: middle; text-align: right; width: 33%;">
<h2 style="font-size: 0.8rem;">'.getArabicTitle($type).'</h2>


</th>
</table>
<table border="1" style="width: 100%; font-size: 1rem; border-collapse: collapse;">';
}
else if($LanguageId == 2){
	$html .='<div id="Sale-Inovice" style="-webkit-print-color-adjust:exact !important;
	print-color-adjust:exact !important; border: 5px solid rgba(143, 192, 235, 0.5); margin: 8px;">
	<table style="width: 100%; text-align: start;" border="0">
	<tr>
	<th style="width: 100%; text-align: center; font-size: 0.8rem; background-color: rgb(143, 192, 235);"
	colspan="5">
	<h1>'.$getLoginUserCompanyData->name_ar.'</h1>
	</th>

	</tr>
	<tr class="row">
	<th style="text-align: start; vertical-align: middle;  width: 33%;" >
	<h2 style="font-size: 0.6rem ; padding-right: 5px;">MOB:'.$getLoginUserCompanyData->mobile_ar.' <br> '.$getLoginUserCompanyData->email_ar.' VAT#: '.$getLoginUserCompanyData->vat_ar.'
	</h2>

	</th>
	<th style="vertical-align: middle; width: 33%;">
	<img style="text-align: center;" width="80px" height="80px"
	src="http://217.76.50.216/'.$getLoginUserCompanyData->logo.'" 
	alt="">
	</th>
	<th style="vertical-align: middle; text-align: left; width: 33%;">
	<h2 style="font-size: 0.8rem;">'.getArabicTitle($type).'</h2>
	</th>
	</table>

	<table border="1" style="width: 100%; font-size: 1rem; border-collapse: collapse;">';

}

$detailsSp = Run($query);	
$cnt =1;

$sum = array();
while($single  =   myfetch($detailsSp)){
if($cnt==1)
{
$html .=
'<tr>';
foreach($single as $dt=>$dv)
{
	if($LanguageId==1)
	{
		$html .= '<th style="font-weight: 500;">'.$dt.'</th>';
	}
	else if($LanguageId == 2){
		$html .= '<th style="font-weight: 500;">'.getArabicTitle($dt).'</th>';
	}
}

$html .='
</tr>';
}
	
	
	
$html .= '<tr>';
	
	foreach($single as $key=>$value)
	{
		if(is_numeric($value) || $value == 0){
			$sum[$key] = $sum[$key] + $value;
		}
		else{
			$sum[$key] = '';
		}

		
		if (strpos($value, ':') !== false) 
		{
			$value = DateValue($value);
		}	
			
			
		if (strpos($value, '.') !== false) 
		{
			$value = AmountValue($value);
		}	


		$html.= '<th style="font-weight: 300;">'.$value.'</th>';

	}
$html .='
</tr>';
$cnt++;




}

array_shift($sum);

$i = 1;
$html .= '<tr> <th style="font-weight: 600;">Total</th>';
foreach($sum as $val){

	if(is_numeric($val)){	
		$html .= '<th style="font-weight: 600;">'.AmountValue($val).'</th>';
	}
	else{
		$html .= '<th style="font-weight: 600;"></th>';
	}
}
$html .= '</tr></table>';


$html.='<style>
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

if($LanguageId == 1){
	$address = $getLoginUserCompanyData->address;
	$align = 'left';
}
else{
	$address = $getLoginUserCompanyData->address_ar;
	$align = 'right';
}

$html .='<div style="text-align:'.$align.';">
	<p style="">'.$address.'</p>
</div>';

// $html;
// die();
//   echo $sale_invoice = getSalePrintTemplate($Billno,$Bid,$LanguageId);
	require '../../../Lib/mpdf/vendor/autoload.php';
	
	$mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8', 'format' => 'A4-L']);
	$mpdf->autoScriptToLang = true;
	$mpdf->autoLangToFont = true;
	$mpdf->SetDisplayMode('fullpage');
	if($LanguageId=='2')
	{
		$mpdf->SetDirectionality('rtl');
	}
	$language = "en";
	if($LanguageId=='2')
	{
		$language = "ar";
		
	}
	
	$sale_invoice = $html;
	$mpdf->WriteHTML($sale_invoice);
	// $mpdf->Output();
	$mpdf->Output($type.' '.$language.'.pdf', 'D');	
?>
<script>
$('#printInvoice').html();
</script>
<div class="content_form" >










</div>