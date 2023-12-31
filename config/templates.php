<?php

function getReceiptPrintTemplate($Billno, $Bid, $LanguageId)
{

	$getLoginUserCompanyData = getLoginUserCompanyData($_SESSION['id']);
	//print_r($getLoginUserCompanyData);
	$mainQ = Run("Select *,[Discount%] as DDper from Receipt where BillNO = '" . $Billno . "' and BId = '" . $Bid . "' ");
	$mainFetch = myfetch($mainQ);

	$bankq = Run("Select * from Bank where id = '" . $mainFetch->PayType . "'");
	$bankDet = myfetch($bankq);


	$Empquery = Run("Select * from " . dbObject . "Emp where Cid = '" . $mainFetch->SalesmanID . "'");
	$SalManfetch = myfetch($Empquery);

	$qu = RunMain("Select * from " . dbObjectMain . "Users where id = '" . $mainFetch->UserID . "' ");
	$getUserData = myfetchMain($qu);

	$html = '<style>
* {
box-sizing: border-box;
}
.table-bordered td,
.table-bordered th {
border: 1px solid #ddd;
padding: 10px;
word-break: break-all;
}
body {
font-family: Arial, Helvetica, sans-serif;
margin: 0;
padding: 0;
font-size: 16px;
}
.h4-14 h4 {
font-size: 12px;
margin-top: 0;
margin-bottom: 5px;
}
.img {
margin-left: "auto";
margin-top: "auto";
height: 30px;
}
pre,
p {
/* width: 99%; */
/* overflow: auto; */
/* bpicklist: 1px solid #aaa; */
padding: 0;
margin: 0;
}
table {
font-family: arial, sans-serif;
width: 100%;
border-collapse: collapse;
padding: 1px;
}
.hm-p p {
text-align: left;
padding: 1px;
padding: 5px 4px;
}
td,
th {
text-align: left;
padding: 8px 6px;
}
.table-b td,
.table-b th {
border: 1px solid #ddd;
}
th {
/* background-color: #ddd; */
}
.hm-p td,
.hm-p th {
padding: 3px 0px;
}
.main-pd-wrapper {
box-shadow: 0 0 10px #ddd;
background-color: #fff;
border-radius: 10px;
padding: 15px;
}
.table-bordered td,
.table-bordered th {
border: 1px solid #ddd;
padding: 10px;
font-size: 14px;
}
.invoice-items {
font-size: 14px;
border-top: 1px dashed #ddd;
}
.invoice-items td {
/* padding: 14px 0; */
padding: 8px 6px;
}
.amount-sec td,th {
width: 33%;
font-size: 14px;
}
</style>';

	$html .= '<section class="main-pd-wrapper" style="width: 450px; margin: auto">
<div style="text-align: center;  margin: auto; line-height: 1.5; font-size: 14px; color: #4a4a4a;">
<p style="font-weight: bold; color: #000; margin-top: 15px; font-size: 18px; padding: 10px 0; background: #aacbfe;">
' . $getLoginUserCompanyData->name . ' 
</p>';

	$html .= '
</div><table style="width: 100%;    ">
<thead>
<tr style="   ">
<th style="text-align: left;">Bill No</th>
<th style="text-align: center;">Date</th>
<th style="text-align: right;">Customer</th>
</tr>
</thead><tbody style="width:100%;">
<tr class=" amount-sec" style="   ">
<td style="text-align:  left;">' . $mainFetch->sbBillno . '</td>
<td style="text-align: center;">' . DateValue($mainFetch->BillDate) . '</td>
<td style="text-align: right;">' . $mainFetch->CustomerName . '</td>
</tr>
</tbody><thead>
<tr class="amount-sec" style="   ">
<th style="text-align: left;">Salesmen</th>
<th style="text-align: center;">Bank</th>
<th style="text-align: right;">User</th>
</tr>
</thead><tbody style="width:100%;">
<tr class=" amount-sec" style="   ">
<td style="text-align: left;"> <span>' . $SalManfetch->CName . '</span></td>
<td style="text-align: center;">' . $bankDet->NameEng . '</td>
<td style="text-align: right;">' . $getUserData->name . '</td>
</tr>
</tbody> 
</table><hr style="border: 1px dashed rgb(131, 131, 131); margin: 10px auto;"><table style="width: 100%;    ">
<thead>
<tr style="   ">
<th style="text-align: left;">Invoice No</th>
<th style="text-align: center;">Invoice date</th>
<th style="text-align: right;">Bill Amount</th>
<th style="text-align: right;">Paid Amount</th>
<th style="text-align: right;">Remaining</th>
</tr>
</thead>
<tbody style="width:100%;">';




	$q = "Select * from RecieptDetails where BillNo ='" . $Billno . "' and Bid = '" . $Bid . "'";
	$query2 = Run($q);
	while ($loadDetails = myfetch($query2)) {
		$rem  = $loadDetails->billAmount - $loadDetails->PaidAmount;
		if ($rem < 0) {
			$rem = 0;
		}
		$salSubInv = $loadDetails->salSubInv;
		$salSubInv  = !empty($salSubInv) ? $salSubInv : '0';
		$InvoiceDate = !empty($loadDetails->InvoiceDate) ? DateValue($loadDetails->InvoiceDate) : '';
		$html .= '<tr class=" amount-sec" style="   ">
<td style="text-align:  left;">' . $loadDetails->InvoiceNo . '</td>
<td style="text-align: left;">' . $InvoiceDate . '</td>
<td style="text-align: center;">' . AmountValue($loadDetails->billAmount) . '</td>
<td style="text-align: center;">' . AmountValue($loadDetails->PaidAmount) . '</td>
<td style="text-align: center;">' . AmountValue($rem) . '</td>
</tr>';
	}






	$html .= '
</tbody>
</table>
<hr style="border: 1px dashed rgb(131, 131, 131); margin: 10px auto;"><table style="width: 100%; background: #aacbfe; border-radius: 4px;    ">
<thead>
<tr style="   ">
<th style="text-align: left;">Total</th>
<th style="text-align: center;">Disc%</th>
<th style="text-align: center;">Disc Amt.</th>
<th style="text-align: right;">Net Total</th>
</tr>
</thead>
<tbody style="width:100%;"><tr class=" amount-sec" style="   ">
<td style="text-align:  left;">' . AmountValue($mainFetch->Total) . '</td>
<td style="text-align: center;">' . AmountValue($mainFetch->DDper) . '</td>
<td style="text-align: center;">' . AmountValue($mainFetch->Discount) . '</td>
<td style="text-align: right;">' . AmountValue($mainFetch->NetTotal) . '</td>
</tr>


</tbody>

<thead>
<tr style="   ">
<th style="text-align: right;" colspan="2">Current Balance</th>
<th style="text-align: left;" colspan="2">' . AmountValue($mainFetch->Cbal) . '</th>

</tr>
</thead>
</table>
</section>';
	return $html;
}





function getSalePrintTemplateNew($Billno, $Bid, $LanguageId, $sBid)
{
	$html = '';

	$servername = $_SERVER['SERVER_NAME'];
	$companyId = $_SESSION['companyId'];
	$barCode = "http://217.76.50.216/Mtech/vouchers/sales/QrCodes/Sale-$Billno-$Bid-$companyId.png";

	if ($servername == 'localhost') {
		$barCode = "http://localhost/Mtech/vouchers/sales/QrCodes/Sale-$Billno-$Bid-$companyId.png";
	}



	$getLoginUserCompanyData = getLoginUserCompanyData($_SESSION['id']);


	///// Language Id 1 For English ///
	if ($LanguageId == 1) {
		$Bid = $Bid;
		$sbid = $sBid;
		$Bid = !empty($Bid) ? $Bid : '1';
		$Billno = $Billno;
		$Billno = !empty($Billno) ? $Billno : '0';
		$sbid = !empty($sbid) ? $sbid : '1';
		$LanguageId = $LanguageId;
		$LanguageId = !empty($LanguageId) ? $LanguageId : '1';




		$sp = "Exec " . dbObject . "SPSalesSelectWeb @SrchBy=1,@Billno=$Billno,@Bid=$Bid,@sBid=$sbid,@LanguageId=$LanguageId,@FRecNo=0,@ToRecNo=1";

		$tt = "EXECUTE " . dbObject . "SPSalDetSelectWeb @Billno=$Billno,@Bid=$Bid,@sBid=$sbid";
		$storeProcedure = Run($sp);
		$myFetch = myfetch($storeProcedure);
		$Billno = $myFetch->Billno;
		$Bno = $myFetch->Billno;
		$paY = Run("EXECUTE " . dbObject . "SPSalPaymentSelectWeb @Billno=$myFetch->Billno,@Bid=$Bid,@sBid=$sbid");


		$SPType = $myFetch->SPType;
		$CSID = $myFetch->CSID;
		$customer = '';
		if ($CSID != '') {
			$customer = getCustomerDetails($CSID)->CName;
		}
		$typ = "Cash";
		if ($SPType != '1') {
			$typ = "Credit";
		}














		$html .= '<div id="Sale-Inovice" style="-webkit-print-color-adjust:exact !important;
print-color-adjust:exact !important; border: 5px solid rgba(143, 192, 235, 0.5); margin: 8px;">
<table style="width: 100%; text-align: start;" border="0">
<tr>
<th style="width: 100%; text-align: center; font-size: 1.3rem; background-color: rgb(143, 192, 235);"
colspan="5">
<h1>' . $getLoginUserCompanyData->name . '</h1>
</th>

</tr>
<tr>
<th style="text-align: start; vertical-align: top; width: 30%;">
<h2 style="font-size: 1rem ; padding-left: 5px;">' . $getLoginUserCompanyData->address . '
<br> MOB:' . $getLoginUserCompanyData->mobile . ' <br> ' . $getLoginUserCompanyData->email . ' <br> VAT#: ' . $getLoginUserCompanyData->vat . '
</h2>
<img style="padding-left: 30px;" width="90px" height="90px"
src="' . $barCode . '"
alt="">
</th>
<th style="vertical-align: top; width: 30%; ">
<h2 style="font-size: 1.9rem; text-align: center;">Sale Invoice  ' . $myFetch->sbBillno . '</h2>
<img style="text-align: left;margin-top:25px" width="80px" height="90px"
src="http://217.76.50.216/' . $getLoginUserCompanyData->logo . '" 
alt="">
</th>
<th colspan="3" style="vertical-align: top; width: 38%;">';
		if ($myFetch->SPType == '1') {





			$html .= '
<h1 style="font-size: 1.5rem;">Payment Details</h1>
<table border="3" style="width: 100%; font-size: 1rem;">
<tr style="background-color: rgb(213, 226, 240); font-weight: 500;">
<th>Name</th>
<th>Amount</th>
<th>Remaining</th>
</tr>
';
			while ($getPayment = myfetch($paY)) {
				$html .= '<tr>
<th style="font-weight: 400;">' . $getPayment->snameArb . '</th>
<th style="font-weight: 300;">' . AmountValue($getPayment->amount) . '</th>
<th style="font-weight: 300;">' . AmountValue($getPayment->remAmount) . '</th>

</tr>';
			}
			$html .= '
</table>';
		}
		$html .= '	
</th>
</table>
<br>
<table style="width: 100%; font-size: 1rem; border: 1px solid black; border-collapse:collapse;" border="1">
<tr>
<th style="font-weight: 600;">Inv Date</th>
<th style="font-weight: 600;">Inv Type</th>
<th style="font-weight: 600;">Inv # </th>
<th style="font-weight: 600;">Refrence # </th>
<th style="font-weight: 600;">Customer</th>
<th style="font-weight: 600;">Branch </th>
</tr>
<tr>
<th style="font-weight: 300;">' . DateValue($myFetch->BillDate) . '</th>
<th style="font-weight: 300;">' . $typ . '</th>
<th style="font-weight: 300;">' . $myFetch->sbBillno . '</th>
<th style="font-weight: 300;">' . $myFetch->RefNo1 . ' </th>
<th style="font-weight: 300;">' . $customer . ' </th>
<th style="font-weight: 300;">' . $myFetch->BranchName . '</th>
</tr>

</table>
<br>
<table border="1" style="width: 100%; font-size: 1rem; border-collapse: collapse;">
<tr>
<th style="font-weight: 500;">#</th>
<th style="font-weight: 500;">Item</th>
<th style="font-weight: 500;">Unit</th>
<th style="font-weight: 500;">Qty</th>
<th style="font-weight: 500;">Price</th>
<th style="font-weight: 500;">Total</th>
<th style="font-weight: 500;">Vat%</th>
<th style="font-weight: 500;">Vat Amt</th>
<th style="font-weight: 500;">Grand Total</th>
</tr>';

		$counter = 1;
		$qtyTot = 0;
		$PriceTot = 0;
		$TotalTot = 0;
		$vatperTot = 0;
		$vatamtTot = 0;
		$GrTotal = 0;

		$detailsSp = Run($tt);
		while ($getDetails = myfetch($detailsSp)) {
			$qtyTot = $qtyTot + $getDetails->Qty;
			$PriceTot = $PriceTot + $getDetails->Price;
			$TotalTot = $TotalTot + $getDetails->Total;
			$vatperTot = $vatperTot + $getDetails->vatPer;
			$vatamtTot = $vatamtTot + $getDetails->vatAmt;
			$GrTotal = $GrTotal + $getDetails->vatPTotal;


			$html .= '
<tr>
<th style="font-weight: 300;">' . $counter . '</th>
<th style="font-weight: 300;">'
	. $getDetails->PCode . '-' . $getDetails->PName . ' 
	<br>
	' . $getDetails->ProdDesc . ' 
</th>

<th style="font-weight: 300;">' . $getDetails->UnitName . '</th>
<th style="font-weight: 300;">' . $getDetails->Qty . '</th>
<th style="font-weight: 300;">' . AmountValue($getDetails->Price) . '</th>
<th style="font-weight: 300;">' . AmountValue($getDetails->Total) . '</th>
<th style="font-weight: 300;">' . AmountValue($getDetails->vatPer) . '</th>
<th style="font-weight: 300;">' . AmountValue($getDetails->vatAmt) . '</th>
<th style="font-weight: 300;">' . AmountValue($getDetails->vatPTotal) . '</th>
</tr>';
			$counter++;
		}
		$html .= '
<tr>
<th colspan="7" rowspan="5">PAYMENT TERMS</th>
<th style="font-weight: 600;">Total</th>
<th style="font-weight: 300;">' . AmountValue($myFetch->Total) . '</th>
</tr>
<tr>
<th style="font-weight: 600;">Discount %</th>
<th style="font-weight: 300;">' . AmountValue($myFetch->DisPer) . '</th>
</tr>
<tr>
<th style="font-weight: 600;">Discount</th>
<th style="font-weight: 300;">' . AmountValue($myFetch->Discount) . '</th>
</tr>
<tr>
<th style="font-weight: 600;">Net Total</th>
<th style="font-weight: 300;">' . AmountValue($myFetch->Nettotal) . '</th>
</tr>
<tr>
<th style="font-weight: 600;">Vat</th>
<th style="font-weight: 300;">' . AmountValue($myFetch->totalVat) . '</th>
</tr>
<tr>
<th colspan="7"> </th>
<th>Grand Total</th>
<th>' . AmountValue($myFetch->vatPTotal) . '</th>
</tr>
</table>
</div>';
	}





	/// Language 2 For Arabic

	if ($LanguageId == 2) {
		$Bid = $Bid;
		$sbid = $sBid;
		$Bid = !empty($Bid) ? $Bid : '1';
		$Billno = $Billno;
		$Billno = !empty($Billno) ? $Billno : '0';
		$sbid = !empty($sbid) ? $sbid : '1';




		$LanguageId = $LanguageId;
		$LanguageId = !empty($LanguageId) ? $LanguageId : '1';
		$sp = "Exec " . dbObject . "SPSalesSelectWeb @SrchBy=1,@Billno=$Billno,@Bid=$Bid,@sBid=$sbid,@LanguageId=$LanguageId,@FRecNo=0,@ToRecNo=1";
		$tt = "EXECUTE " . dbObject . "SPSalDetSelectWeb @Billno=$Billno,@Bid=$Bid,@sBid=$sbid";
		$paY = Run("EXECUTE " . dbObject . "SPSalPaymentSelectWeb @Billno=$Billno,@Bid=$Bid,@sBid=$sbid");


		$storeProcedure = Run($sp);
		$myFetch = myfetch($storeProcedure);
		$Billno = $myFetch->Billno;
		$SPType = $myFetch->SPType;
		$CSID = $myFetch->CSID;
		$customer = '';
		if ($CSID != '') {
			$customer = getCustomerDetails($CSID)->CName;
		}
		$typ = "Cash";
		if ($SPType != '1') {
			$typ = "Credit";
		}














		$html .= '<div id="Sale-Inovice" style="-webkit-print-color-adjust:exact !important;
print-color-adjust:exact !important; border: 5px solid rgba(143, 192, 235, 0.5); margin: 8px;">
<table style="width: 100%; text-align: start;" border="0" dir="rtl">
<tr>
<th style="width: 100%; text-align: center; font-size: 1.3rem; background-color: rgb(143, 192, 235);"
colspan="5">
<h1>' . $getLoginUserCompanyData->name_ar . '</h1>
</th>

</tr>
<tr>
<th style="text-align: start; vertical-align: top; width: 32%;">
<h2 style="font-size: 1rem ; padding-left: 5px;">' . $getLoginUserCompanyData->address_ar . '
<br> ' . $getLoginUserCompanyData->mobile_ar . ' <br> <span style="font-size:0.8em;">' . $getLoginUserCompanyData->email . '</span> <br>
: ' . $getLoginUserCompanyData->vat_ar . '
</h2>
<img style="padding-left: 30px;" width="90px" height="90px"
src="' . $barCode . '"
alt="">
</th>
<th style="vertical-align: top; width: 30%; ">
<h2 style="font-size: 1.9rem; text-align: center;">فاتورة مبيعات  ' . $myFetch->sbBillno . '</h2>
<img style="text-align: left;margin-top:25px" width="80px" height="90px"
src="http://217.76.50.216/' . $getLoginUserCompanyData->logo . '" 
alt="">
</th>
<th colspan="3" style="vertical-align: top; width: 38%;">';
		if ($myFetch->SPType == '1') {





			$html .= '
<h1 style="font-size: 1.5rem;">بيانات الدفع</h1>
<table border="3" style="width: 100%; font-size: 1rem;" dir="rtl">
<tr style="background-color: rgb(213, 226, 240); font-weight: 500;">
<th>اسم</th>
<th>كمية</th>
<th>متبقي</th>
</tr>
';
			while ($getPayment = myfetch($paY)) {
				$html .= '<tr>
<th style="font-weight: 400;">' . $getPayment->snameArb . '</th>
<th style="font-weight: 300;">' . AmountValue($getPayment->amount) . '</th>
<th style="font-weight: 300;">' . AmountValue($getPayment->remAmount) . '</th>

</tr>';
			}
			$html .= '
</table>';
		}
		$html .= '	
</th>
</table>
<br>
<table style="width: 100%; font-size: 1rem; border: 1px solid black; border-collapse:collapse;" border="1" dir="rtl">
<tr>
<th style="font-weight: 600;">التاريخ</th>
<th style="font-weight: 600;">نوع الفاتورة
</th>
<th style="font-weight: 600;">رقم الفاتورة</th>
<th style="font-weight: 600;">رقم المرجع  </th>
<th style="font-weight: 600;">عميل</th>
<th style="font-weight: 600;">الفرع </th>
</tr>
<tr>
<th style="font-weight: 300;">' . DateValue($myFetch->BillDate) . '</th>
<th style="font-weight: 300;">' . $typ . '</th>
<th style="font-weight: 300;">' . $myFetch->sbBillno . '</th>
<th style="font-weight: 300;">' . $myFetch->RefNo1 . ' </th>
<th style="font-weight: 300;">' . $customer . ' </th>
<th style="font-weight: 300;">' . $myFetch->BranchName . '</th>
</tr>

</table>
<br>
<table border="1" style="width: 100%; font-size: 1rem; border-collapse: collapse;">
<tr>
<th style="font-weight: 500;">#</th>
<th style="font-weight: 500;">منتج</th>
<th style="font-weight: 500;">وحدة</th>

<th style="font-weight: 500;">الكمية</th>
<th style="font-weight: 500;">السعر</th>
<th style="font-weight: 500;">الاجمالي</th>
<th style="font-weight: 500;">الضريبة%</th>
<th style="font-weight: 500;">الضريبة</th>
<th style="font-weight: 500;">المجموع الإجمالي</th>
</tr>';

		$counter = 1;
		$qtyTot = 0;
		$PriceTot = 0;
		$TotalTot = 0;
		$vatperTot = 0;
		$vatamtTot = 0;
		$GrTotal = 0;

		$detailsSp = Run($tt);
		while ($getDetails = myfetch($detailsSp)) {
			$qtyTot = $qtyTot + $getDetails->Qty;
			$PriceTot = $PriceTot + $getDetails->Price;
			$TotalTot = $TotalTot + $getDetails->Total;
			$vatperTot = $vatperTot + $getDetails->vatPer;
			$vatamtTot = $vatamtTot + $getDetails->vatAmt;
			$GrTotal = $GrTotal + $getDetails->vatPTotal;


			$html .= '
<tr>
<th style="font-weight: 300;">' . $counter . '</th>
<th style="font-weight: 300;">'
 . $getDetails->PCode . '-' . $getDetails->PName . ' 
 <br>
 ' . $getDetails->ProdDesc . 
 '</th>
<th style="font-weight: 300;">' . $getDetails->UnitName . '</th>

<th style="font-weight: 300;">' . $getDetails->Qty . '</th>
<th style="font-weight: 300;">' . AmountValue($getDetails->Price) . '</th>
<th style="font-weight: 300;">' . AmountValue($getDetails->Total) . '</th>
<th style="font-weight: 300;">' . AmountValue($getDetails->vatPer) . '</th>
<th style="font-weight: 300;">' . AmountValue($getDetails->vatAmt) . '</th>
<th style="font-weight: 300;">' . AmountValue($getDetails->vatPTotal) . '</th>
</tr>';
			$counter++;
		}
		$html .= '
<tr>
<th colspan="7" rowspan="5">شروط الدفع</th>
<th style="font-weight: 600;">الاجمالي</th>
<th style="font-weight: 300;">' . AmountValue($myFetch->Total) . '</th>
</tr>
<tr>
<th style="font-weight: 600;">خصم %</th>
<th style="font-weight: 300;">' . AmountValue($myFetch->DisPer) . '</th>
</tr>
<tr>
<th style="font-weight: 600;">الخصم</th>
<th style="font-weight: 300;">' . AmountValue($myFetch->Discount) . '</th>
</tr>
<tr>
<th style="font-weight: 600;">الصافي</th>
<th style="font-weight: 300;">' . AmountValue($myFetch->Nettotal) . '</th>
</tr>
<tr>
<th style="font-weight: 600;">اجمالي الضريبة</th>
<th style="font-weight: 300;">' . AmountValue($myFetch->totalVat) . '</th>
</tr>
<tr>
<th colspan="7"></th>
<th>المجموع الإجمالي</th>
<th>' . AmountValue($myFetch->vatPTotal) . '</th>
</tr>
</table>
</div>';
	}











	return $html;
}






function getSaleReturnPrintTemplateNew($Billno, $Bid, $LanguageId)
{
	$html = '';

	$servername = $_SERVER['SERVER_NAME'];
	$companyId = $_SESSION['companyId'];
	$barCode = "http://217.76.50.216/Mtech/vouchers/salesreturn/QrCodes/SaleReturn-$Billno-$Bid-$companyId.png";

	if ($servername == 'localhost') {
		$barCode = "http://localhost/Mtech/vouchers/salesreturn/QrCodes/SaleReturn-$Billno-$Bid-$companyId.png";
	}


	$getLoginUserCompanyData = getLoginUserCompanyData($_SESSION['id']);


	///// Language Id 1 For English ///
	if ($LanguageId == 1) {
		$Bid = $Bid;
		$Bid = !empty($Bid) ? $Bid : '1';
		$Billno = $Billno;
		$Billno = !empty($Billno) ? $Billno : '0';
		$LanguageId = $LanguageId;
		$LanguageId = !empty($LanguageId) ? $LanguageId : '1';
		$sbid = "2";
		$bQ = Run("Select * from " . dbObject . "Branch where Bid = '" . $Bid . "'");
		$getBData = myfetch($bQ);
		if ($getBData->ismain == '1') {
			$sbid = "1";
		}




		$abc = "Exec " . dbObject . "SPSalesReturnSelectWeb @SrchBy=1,@Billno=$Billno,@Bid=$Bid,@sBid=$sbid,@LanguageId=$LanguageId,@FRecNo=0,@ToRecNo=100";

		$paY = Run("EXECUTE " . dbObject . "SPSalRetPaymentSelectWeb @Billno=$Billno,@Bid=$Bid,@sBid=$sbid");

		$tt = "EXECUTE " . dbObject . "SPSalReturnDetailSelectWeb @Billno=$Billno,@Bid=$Bid,@sBid=$sbid,@SrchBy=1,@FRecNo=0,@ToRecNo=100";
		$storeProcedure = Run($abc);
		$myFetch = myfetch($storeProcedure);
		$Billno = $myFetch->Billno;
		$SPType = $myFetch->SPType;
		$CSID = $myFetch->CSID;
		$customer = '';
		if ($CSID != '') {
			$customer = getCustomerDetails($CSID)->CName;
		}
		$typ = "Cash";
		if ($SPType != '1') {
			$typ = "Credit";
		}














		$html .= '<div id="Sale-Inovice" style="-webkit-print-color-adjust:exact !important;
print-color-adjust:exact !important; border: 5px solid rgba(143, 192, 235, 0.5); margin: 8px;">
<table style="width: 100%; text-align: start;" border="0">
<tr>
<th style="width: 100%; text-align: center; font-size: 1.3rem; background-color: rgb(143, 192, 235);"
colspan="5">
<h1>' . $getLoginUserCompanyData->name . '</h1>
</th>

</tr>
<tr>
<th style="text-align: start; vertical-align: top; width: 30%;">
<h2 style="font-size: 1rem ; padding-left: 5px;">' . $getLoginUserCompanyData->address . '
<br> MOB:' . $getLoginUserCompanyData->mobile . ' <br> ' . $getLoginUserCompanyData->email . ' <br> VAT#: ' . $getLoginUserCompanyData->vat . '
</h2>
<img style="padding-left: 30px;" width="90px" height="90px"
src="' . $barCode . '"
alt="">
</th>
<th style="vertical-align: top; width: 30%; ">
<h2 style="font-size: 1.9rem; text-align: center;">Sale Return  ' . $myFetch->sbBillno . '</h2>
<img style="text-align: left;margin-top:25px" width="80px" height="90px"
src="http://217.76.50.216/' . $getLoginUserCompanyData->logo . '" 
alt="">
</th>
<th colspan="3" style="vertical-align: top; width: 38%;">';



		if ($myFetch->SPType == '1') {





			$html .= '
<h1 style="font-size: 1.5rem;">Payment Details</h1>
<table border="3" style="width: 100%; font-size: 1rem;">
<tr style="background-color: rgb(213, 226, 240); font-weight: 500;">
<th>Name</th>
<th>Amount</th>
<th>Remaining</th>
</tr>
';

			while ($getPayment = myfetch($paY)) {
				$html .= '<tr>
<th style="font-weight: 400;">' . $getPayment->snameArb . '</th>
<th style="font-weight: 300;">' . AmountValue($getPayment->amount) . '</th>
<th style="font-weight: 300;">' . AmountValue($getPayment->remAmount) . '</th>

</tr>';
			}
			$html .= '
</table>';
		}

		$html .= '	
</th>
</table>
<br>
<table style="width: 100%; font-size: 1rem; border: 1px solid black; border-collapse:collapse;" border="1">
<tr>
<th style="font-weight: 600;">Inv Date</th>
<th style="font-weight: 600;">Inv Type</th>
<th style="font-weight: 600;">Inv # </th>
<th style="font-weight: 600;">Refrence # </th>
<th style="font-weight: 600;">Customer</th>
<th style="font-weight: 600;">Branch </th>
</tr>
<tr>
<th style="font-weight: 300;">' . DateValue($myFetch->BillDate) . '</th>
<th style="font-weight: 300;">' . $typ . '</th>
<th style="font-weight: 300;">' . $myFetch->sbBillno . '</th>
<th style="font-weight: 300;">' . $myFetch->RefNo . ' </th>
<th style="font-weight: 300;">' . $customer . ' </th>
<th style="font-weight: 300;">' . $myFetch->BranchName . '</th>
</tr>

</table>
<br>
<table border="1" style="width: 100%; font-size: 1rem; border-collapse: collapse;">
<tr>
<th style="font-weight: 500;">#</th>
<th style="font-weight: 500;">Item</th>
<th style="font-weight: 500;">Unit</th>
<th style="font-weight: 500;">Qty</th>
<th style="font-weight: 500;">Price</th>
<th style="font-weight: 500;">Total</th>
<th style="font-weight: 500;">Vat%</th>
<th style="font-weight: 500;">Vat Amt</th>
<th style="font-weight: 500;">Grand Total</th>
</tr>';

		$counter = 1;
		$qtyTot = 0;
		$PriceTot = 0;
		$TotalTot = 0;
		$vatperTot = 0;
		$vatamtTot = 0;
		$GrTotal = 0;




		$detailsSp = Run($tt);
		while ($getDetails = myfetch($detailsSp)) {
			$qtyTot = $qtyTot + $getDetails->Qty;
			$PriceTot = $PriceTot + $getDetails->Price;
			$TotalTot = $TotalTot + $getDetails->Total;
			$vatperTot = $vatperTot + $getDetails->vatPer;
			$vatamtTot = $vatamtTot + $getDetails->vatAmt;
			$GrTotal = $GrTotal + $getDetails->vatPTotal;


			$html .= '
<tr>
<th style="font-weight: 300;">' . $counter . '</th>
<th style="font-weight: 300;">' . $getDetails->PCode . '-' . $getDetails->PName . '</th>
<th style="font-weight: 300;">' . $getDetails->ParaName . '</th>

<th style="font-weight: 300;">' . $getDetails->Qty . '</th>
<th style="font-weight: 300;">' . AmountValue($getDetails->Price) . '</th>
<th style="font-weight: 300;">' . AmountValue($getDetails->Total) . '</th>
<th style="font-weight: 300;">' . AmountValue($getDetails->vatPer) . '</th>
<th style="font-weight: 300;">' . AmountValue($getDetails->vatAmt) . '</th>
<th style="font-weight: 300;">' . AmountValue($getDetails->vatPTotal) . '</th>
</tr>';
			$counter++;
		}
		$html .= '
<tr>
<th colspan="7" rowspan="5">PAYMENT TERMS</th>
<th style="font-weight: 600;">Total</th>
<th style="font-weight: 300;">' . AmountValue($myFetch->Total) . '</th>
</tr>
<tr>
<th style="font-weight: 600;">Discount %</th>
<th style="font-weight: 300;">' . AmountValue($myFetch->DisPer) . '</th>
</tr>
<tr>
<th style="font-weight: 600;">Discount</th>
<th style="font-weight: 300;">' . AmountValue($myFetch->Discount) . '</th>
</tr>
<tr>
<th style="font-weight: 600;">Net Total</th>
<th style="font-weight: 300;">' . AmountValue($myFetch->NetTotal) . '</th>
</tr>
<tr>
<th style="font-weight: 600;">Vat</th>
<th style="font-weight: 300;">' . AmountValue($myFetch->totalVat) . '</th>
</tr>
<tr>
<th colspan="7"> </th>
<th>Grand Total</th>
<th>' . AmountValue($myFetch->vatPTotal) . '</th>
</tr>
</table>
</div>';
	}





	/// Language 2 For Arabic

	if ($LanguageId == 2) {
		$Bid = $Bid;
		$Bid = !empty($Bid) ? $Bid : '1';
		$Billno = $Billno;
		$Billno = !empty($Billno) ? $Billno : '0';
		$LanguageId = $LanguageId;
		$LanguageId = !empty($LanguageId) ? $LanguageId : '1';

		$sbid = "2";
		$bQ = Run("Select * from " . dbObject . "Branch where Bid = '" . $Bid . "'");
		$getBData = myfetch($bQ);
		if ($getBData->ismain == '1') {
			$sbid = "1";
		}




		$abc = "Exec " . dbObject . "SPSalesReturnSelectWeb @SrchBy=1,@Billno=$Billno,@Bid=$Bid,@sBid=$sbid,@LanguageId=$LanguageId,@FRecNo=0,@ToRecNo=1";

		$storeProcedure = Run($abc);
		$myFetch = myfetch($storeProcedure);
		$SPType = $myFetch->SPType;
		$CSID = $myFetch->CSID;
		$customer = '';
		if ($CSID != '') {
			$customer = getCustomerDetails($CSID)->CName;
		}
		$typ = "Cash";
		if ($SPType != '1') {
			$typ = "Credit";
		}














		$html .= '<div id="Sale-Inovice" style="-webkit-print-color-adjust:exact !important;
print-color-adjust:exact !important; border: 5px solid rgba(143, 192, 235, 0.5); margin: 8px;">
<table style="width: 100%; text-align: start;" border="0" dir="rtl">
<tr>
<th style="width: 100%; text-align: center; font-size: 1.3rem; background-color: rgb(143, 192, 235);"
colspan="5">
<h1>' . $getLoginUserCompanyData->name . '</h1>
</th>

</tr>
<tr>
<th style="text-align: start; vertical-align: top; width: 30%;">
<h2 style="font-size: 1rem ; padding-left: 5px;">' . $getLoginUserCompanyData->address_ar . '
<br> ' . $getLoginUserCompanyData->mobile_ar . ' <br> <span style="font-size:0.8em;">' . $getLoginUserCompanyData->email . '</span> <br>
: ' . $getLoginUserCompanyData->vat_ar . '
</h2>
<img style="padding-left: 30px;" width="90px" height="90px"
src="' . $barCode . '"
alt="">
</th>
<th style="vertical-align: top; width: 30%; ">
<h2 style="font-size: 1.9rem; text-align: center;">
بيع فاتورة مرتجعة  ' . $myFetch->sbBillno . '</h2>
<img style="text-align: left;margin-top:25px" width="80px" height="90px"
src="http://217.76.50.216/' . $getLoginUserCompanyData->logo . '" 
alt="">
</th>
<th colspan="3" style="vertical-align: top; width: 38%;">';
		if ($myFetch->SPType == '1') {
			$paY = Run("EXECUTE " . dbObject . "SPSalRetPaymentSelectWeb @Billno=$Billno,@Bid=$Bid,@sBid=$sbid");




			$html .= '
<h1 style="font-size: 1.5rem;">بيانات الدفع</h1>
<table border="3" style="width: 100%; font-size: 1rem;" dir="rtl">
<tr style="background-color: rgb(213, 226, 240); font-weight: 500;">
<th>اسم</th>
<th>كمية</th>
<th>متبقي</th>
</tr>
';
			while ($getPayment = myfetch($paY)) {
				$html .= '<tr>
<th style="font-weight: 400;">' . $getPayment->snameArb . '</th>
<th style="font-weight: 300;">' . AmountValue($getPayment->amount) . '</th>
<th style="font-weight: 300;">' . AmountValue($getPayment->remAmount) . '</th>

</tr>';
			}
			$html .= '
</table>';
		}
		$html .= '	
</th>
</table>
<br>
<table style="width: 100%; font-size: 1rem; border: 1px solid black; border-collapse:collapse;" border="1" dir="rtl">
<tr>
<th style="font-weight: 600;">التاريخ</th>
<th style="font-weight: 600;">نوع الفاتورة
</th>
<th style="font-weight: 600;">رقم الفاتورة</th>
<th style="font-weight: 600;">رقم المرجع  </th>
<th style="font-weight: 600;">عميل</th>
<th style="font-weight: 600;">الفرع </th>
</tr>
<tr>
<th style="font-weight: 300;">' . DateValue($myFetch->BillDate) . '</th>
<th style="font-weight: 300;">' . $typ . '</th>
<th style="font-weight: 300;">' . $myFetch->sbBillno . '</th>
<th style="font-weight: 300;">' . $myFetch->RefNo . ' </th>
<th style="font-weight: 300;">' . $customer . ' </th>
<th style="font-weight: 300;">' . $myFetch->BranchName . '</th>
</tr>

</table>
<br>
<table border="1" style="width: 100%; font-size: 1rem; border-collapse: collapse;" dir="rtl">
<tr>
<th style="font-weight: 500;">#</th>
<th style="font-weight: 500;">منتج</th>
<th style="font-weight: 500;">وحدة</th>

<th style="font-weight: 500;">الكمية</th>
<th style="font-weight: 500;">السعر</th>
<th style="font-weight: 500;">الاجمالي</th>
<th style="font-weight: 500;">الضريبة%</th>
<th style="font-weight: 500;">الضريبة</th>
<th style="font-weight: 500;">المجموع الإجمالي</th>
</tr>';

		$counter = 1;
		$qtyTot = 0;
		$PriceTot = 0;
		$TotalTot = 0;
		$vatperTot = 0;
		$vatamtTot = 0;
		$GrTotal = 0;
		$tt = "EXECUTE " . dbObject . "SPSalReturnDetailSelectWeb @Billno=$myFetch->BillNo,@Bid=$Bid,@sBid=$sbid,@SrchBy=1,@FRecNo=0,@ToRecNo=1";

		$detailsSp = Run($tt);
		while ($getDetails = myfetch($detailsSp)) {
			$qtyTot = $qtyTot + $getDetails->Qty;
			$PriceTot = $PriceTot + $getDetails->Price;
			$TotalTot = $TotalTot + $getDetails->Total;
			$vatperTot = $vatperTot + $getDetails->vatPer;
			$vatamtTot = $vatamtTot + $getDetails->vatAmt;
			$GrTotal = $GrTotal + $getDetails->vatPTotal;


			$html .= '
<tr>
<th style="font-weight: 300;">' . $counter . '</th>
<th style="font-weight: 300;">' . $getDetails->PCode . '-' . $getDetails->PName . '</th>
<th style="font-weight: 300;">' . $getDetails->ParaName . '</th>

<th style="font-weight: 300;">' . $getDetails->Qty . '</th>
<th style="font-weight: 300;">' . AmountValue($getDetails->Price) . '</th>
<th style="font-weight: 300;">' . AmountValue($getDetails->Total) . '</th>
<th style="font-weight: 300;">' . AmountValue($getDetails->vatPer) . '</th>
<th style="font-weight: 300;">' . AmountValue($getDetails->vatAmt) . '</th>
<th style="font-weight: 300;">' . AmountValue($getDetails->vatPTotal) . '</th>
</tr>';
			$counter++;
		}
		$html .= '
<tr>
<th colspan="7" rowspan="5">شروط الدفع</th>
<th style="font-weight: 600;">الاجمالي</th>
<th style="font-weight: 300;">' . AmountValue($myFetch->Total) . '</th>
</tr>
<tr>
<th style="font-weight: 600;">خصم %</th>
<th style="font-weight: 300;">' . AmountValue($myFetch->DisPer) . '</th>
</tr>
<tr>
<th style="font-weight: 600;">الخصم</th>
<th style="font-weight: 300;">' . AmountValue($myFetch->Discount) . '</th>
</tr>
<tr>
<th style="font-weight: 600;">الصافي</th>
<th style="font-weight: 300;">' . AmountValue($myFetch->NetTotal) . '</th>
</tr>
<tr>
<th style="font-weight: 600;">اجمالي الضريبة</th>
<th style="font-weight: 300;">' . AmountValue($myFetch->totalVat) . '</th>
</tr>
<tr>
<th colspan="7"></th>
<th>المجموع الإجمالي</th>
<th>' . AmountValue($myFetch->vatPTotal) . '</th>
</tr>
</table>
</div>';
	}











	return $html;
}


function getPurchasePrintTemplateNew($Billno, $Bid, $LanguageId, $sbid)
{
	$html = '';

	$servername = $_SERVER['SERVER_NAME'];
	$companyId = $_SESSION['companyId'];
	// $barCode = "http://217.76.50.216/Mtech/vouchers/purchase/QrCodes/Sale-$Billno-$Bid-$companyId.png";

	// if ($servername == 'localhost') {
	// 	$barCode = "http://localhost/Mtech/vouchers/purchase/QrCodes/Sale-$Billno-$Bid-$companyId.png";
	// }

	$getLoginUserCompanyData = getLoginUserCompanyData($_SESSION['id']);

	///// Language Id 1 For English ///
	if ($LanguageId == 1) {
		$Bid = !empty($Bid) ? $Bid : '1';
		$Billno = !empty($Billno) ? $Billno : '0';
		$LanguageId = !empty($LanguageId) ? $LanguageId : '1';

		//$sp = "Exec " . dbObject . "SPSalesSelectWeb @SrchBy=1,@Billno=$Billno,@Bid=$Bid,@sBid=$sbid,@LanguageId=$LanguageId,@FRecNo=0,@ToRecNo=1";

		$sp = "Select *,[Discount%] as disper from " . dbObject . "DataIn where Billno = $Billno and Bid = $Bid";


		$tt = "EXECUTE " . dbObject . "SPPurchaseDetSelectWeb @Billno=$Billno,@Bid=$Bid,@sBid=$sbid";
		$storeProcedure = Run($sp);
		$myFetch = myfetch($storeProcedure);
		$Billno = $myFetch->Billno;
		$Bno = $myFetch->Billno;
		$paY = Run("EXECUTE " . dbObject . "SPPurPaymentSelectWeb @Billno=$myFetch->BillNo,@Bid=$Bid,@sBid=$sbid");
		$SPType = $myFetch->SPType;
		$CSID = $myFetch->CSID;
		$customer = '';
		if ($CSID != '') {
			$customer = getSupplierDetails($CSID)->CName;
		}
		$typ = "Cash";
		if ($SPType != '1') {
			$typ = "Credit";
		}

		$html .= '<div id="Sale-Inovice" style="-webkit-print-color-adjust:exact !important;
print-color-adjust:exact !important; border: 5px solid rgba(143, 192, 235, 0.5); margin: 8px;">
<table style="width: 100%; text-align: start;" border="0">
<tr>
<th style="width: 100%; text-align: center; font-size: 1.3rem; background-color: rgb(143, 192, 235);"
colspan="5">
<h1>' . $getLoginUserCompanyData->name . '</h1>
</th>

</tr>
<tr>
<th style="text-align: start; vertical-align: top; width: 30%;">
<h2 style="font-size: 1rem ; padding-left: 5px;">' . $getLoginUserCompanyData->address . '
<br> MOB:' . $getLoginUserCompanyData->mobile . ' <br> ' . $getLoginUserCompanyData->email . ' <br> VAT#: ' . $getLoginUserCompanyData->vat . '
</h2>

</th>
<th style="vertical-align: top; width: 30%; ">
<h2 style="font-size: 1.9rem; text-align: center;">Purchase Invoice  ' . $myFetch->sbBillno . '</h2>
<img style="text-align: left;margin-top:25px" width="80px" height="90px"
src="http://217.76.50.216/' . $getLoginUserCompanyData->logo . '" 
alt="">
</th>
<th colspan="3" style="vertical-align: top; width: 38%;">';
		if ($myFetch->SPType == '1') {

			$html .= '
<h1 style="font-size: 1.5rem;">Payment Details</h1>
<table border="3" style="width: 100%; font-size: 1rem;">
<tr style="background-color: rgb(213, 226, 240); font-weight: 500;">
<th>Name</th>
<th>Amount</th>
<th>Remaining</th>
</tr>
';
			while ($getPayment = myfetch($paY)) {
				$html .= '<tr>
<th style="font-weight: 400;">' . $getPayment->snameArb . '</th>
<th style="font-weight: 300;">' . AmountValue($getPayment->amount) . '</th>
<th style="font-weight: 300;">' . AmountValue($getPayment->remAmount) . '</th>

</tr>';
			}
			$html .= '
</table>';
		}
		$html .= '	
</th>
</table>
<br>
<table style="width: 100%; font-size: 1rem; border: 1px solid black; border-collapse:collapse;" border="1">
<tr>
<th style="font-weight: 600;">Inv Date</th>
<th style="font-weight: 600;">Inv Type</th>
<th style="font-weight: 600;">Inv # </th>
<th style="font-weight: 600;">Refrence # </th>
<th style="font-weight: 600;">Supplier</th>
<th style="font-weight: 600;">Branch </th>
</tr>
<tr>
<th style="font-weight: 300;">' . DateValue($myFetch->BillDate) . '</th>
<th style="font-weight: 300;">' . $typ . '</th>
<th style="font-weight: 300;">' . $myFetch->sbBillno . '</th>
<th style="font-weight: 300;">' . $myFetch->RefNo . ' </th>
<th style="font-weight: 300;">' . $customer . ' </th>
<th style="font-weight: 300;">' . GetBranchDetils($Bid)->BName . '</th>
</tr>

</table>
<br>
<table border="1" style="width: 100%; font-size: 1rem; border-collapse: collapse;">
<tr>
<th style="font-weight: 500;">#</th>
<th style="font-weight: 500;">Item</th>
<th style="font-weight: 500;">Unit</th>
<th style="font-weight: 500;">Qty</th>
<th style="font-weight: 500;">Price</th>
<th style="font-weight: 500;">Total</th>
<th style="font-weight: 500;">Vat%</th>
<th style="font-weight: 500;">Vat Amt</th>
<th style="font-weight: 500;">Grand Total</th>
</tr>';

		$counter = 1;
		$qtyTot = 0;
		$PriceTot = 0;
		$TotalTot = 0;
		$vatperTot = 0;
		$vatamtTot = 0;
		$GrTotal = 0;

		$detailsSp = Run($tt);
		while ($getDetails = myfetch($detailsSp)) {


			$html .= '
<tr>
<th style="font-weight: 300;">' . $counter . '</th>
<th style="font-weight: 300;">' . $getDetails->PCode . '-' . $getDetails->PName . '</th>

<th style="font-weight: 300;">' . $getDetails->ParaName . '</th>
<th style="font-weight: 300;">' . $getDetails->Qty . '</th>
<th style="font-weight: 300;">' . AmountValue($getDetails->Price) . '</th>
<th style="font-weight: 300;">' . AmountValue($getDetails->Total) . '</th>
<th style="font-weight: 300;">' . AmountValue($getDetails->vatPer) . '</th>
<th style="font-weight: 300;">' . AmountValue($getDetails->vatAmt) . '</th>
<th style="font-weight: 300;">' . AmountValue($getDetails->Total + $getDetails->vatAmt) . '</th>
</tr>';
			$counter++;
		}
		$html .= '
<tr>
<th colspan="7" rowspan="5">PAYMENT TERMS</th>
<th style="font-weight: 600;">Total</th>
<th style="font-weight: 300;">' . AmountValue($myFetch->Total) . '</th>
</tr>
<tr>
<th style="font-weight: 600;">Discount %</th>
<th style="font-weight: 300;">' . AmountValue($myFetch->disper) . '</th>
</tr>
<tr>
<th style="font-weight: 600;">Discount</th>
<th style="font-weight: 300;">' . AmountValue($myFetch->Discount) . '</th>
</tr>
<tr>
<th style="font-weight: 600;">Net Total</th>
<th style="font-weight: 300;">' . AmountValue($myFetch->Nettotal) . '</th>
</tr>
<tr>
<th style="font-weight: 600;">Vat</th>
<th style="font-weight: 300;">' . AmountValue($myFetch->totalVat) . '</th>
</tr>
<tr>
<th colspan="7"> </th>
<th>Grand Total</th>
<th>' . AmountValue($myFetch->vatPTotal) . '</th>
</tr>
</table>
</div>';
	}

	/// Language 2 For Arabic

	if ($LanguageId == 2) {
		$Bid = !empty($Bid) ? $Bid : '1';
		$Billno = !empty($Billno) ? $Billno : '0';
		$sBid = !empty($sBid) ? $sBid : '1';



		$LanguageId = $LanguageId;
		$LanguageId = !empty($LanguageId) ? $LanguageId : '1';
		// $sp = "Exec " . dbObject . "SPSalesSelectWeb @SrchBy=1,@Billno=$Billno,@Bid=$Bid,@sBid=$sbid,@LanguageId=$LanguageId,@FRecNo=0,@ToRecNo=1";
		$sp = "Select *,[Discount%] as disper from " . dbObject . "DataIn where Billno = $Billno and Bid = $Bid";

		// $tt = "EXECUTE " . dbObject . "SPSalDetSelectWeb @Billno=$Billno,@Bid=$Bid,@sBid=$sbid";
		$tt = "EXECUTE " . dbObject . "SPPurchaseDetSelectWeb @Billno=$Billno,@Bid=$Bid,@sBid=$sbid";

		// $paY = Run("EXECUTE " . dbObject . "SPSalPaymentSelectWeb @Billno=$Billno,@Bid=$Bid,@sBid=$sbid");
		$paY = Run("EXECUTE " . dbObject . "SPPurPaymentSelectWeb @Billno=$Billno,@Bid=$Bid,@sBid=$sbid");


		$storeProcedure = Run($sp);
		$myFetch = myfetch($storeProcedure);
		$Billno = $myFetch->Billno;
		$SPType = $myFetch->SPType;
		$CSID = $myFetch->CSID;
		$customer = '';
		if ($CSID != '') {
			$customer = getSupplierDetails($CSID)->CName;
		}
		$typ = "Cash";
		if ($SPType != '1') {
			$typ = "Credit";
		}

		$html .= '<div id="Sale-Inovice" style="-webkit-print-color-adjust:exact !important;
print-color-adjust:exact !important; border: 5px solid rgba(143, 192, 235, 0.5); margin: 8px;">
<table style="width: 100%; text-align: start;" border="0" dir="rtl">
<tr>
<th style="width: 100%; text-align: center; font-size: 1.3rem; background-color: rgb(143, 192, 235);"
colspan="5">
<h1>' . $getLoginUserCompanyData->name_ar . '</h1>
</th>

</tr>
<tr>
<th style="text-align: start; vertical-align: top; width: 32%;">
<h2 style="font-size: 1rem ; padding-left: 5px;">' . $getLoginUserCompanyData->address_ar . '
<br> ' . $getLoginUserCompanyData->mobile_ar . ' <br> <span style="font-size:0.8em;">' . $getLoginUserCompanyData->email . '</span> <br>
: ' . $getLoginUserCompanyData->vat_ar . '
</h2>
</th>
<th style="vertical-align: top; width: 30%; ">
<h2 style="font-size: 1.9rem; text-align: center;">فاتورة مبيعات  ' . $myFetch->sbBillno . '</h2>
<img style="text-align: left;margin-top:25px" width="80px" height="90px"
src="http://217.76.50.216/' . $getLoginUserCompanyData->logo . '" 
alt="">
</th>
<th colspan="3" style="vertical-align: top; width: 38%;">';
		if ($myFetch->SPType == '1') {

			$html .= '
<h1 style="font-size: 1.5rem;">بيانات الدفع</h1>
<table border="3" style="width: 100%; font-size: 1rem;" dir="rtl">
<tr style="background-color: rgb(213, 226, 240); font-weight: 500;">
<th>اسم</th>
<th>كمية</th>
<th>متبقي</th>
</tr>
';
			while ($getPayment = myfetch($paY)) {
				$html .= '<tr>
<th style="font-weight: 400;">' . $getPayment->snameArb . '</th>
<th style="font-weight: 300;">' . AmountValue($getPayment->amount) . '</th>
<th style="font-weight: 300;">' . AmountValue($getPayment->remAmount) . '</th>

</tr>';
			}
			$html .= '
</table>';
		}
		$html .= '	
</th>
</table>
<br>
<table style="width: 100%; font-size: 1rem; border: 1px solid black; border-collapse:collapse;" border="1" dir="rtl">
<tr>
<th style="font-weight: 600;">التاريخ</th>
<th style="font-weight: 600;">نوع الفاتورة
</th>
<th style="font-weight: 600;">رقم الفاتورة</th>
<th style="font-weight: 600;">رقم المرجع  </th>
<th style="font-weight: 600;">عميل</th>
<th style="font-weight: 600;">الفرع </th>
</tr>
<tr>
<th style="font-weight: 300;">' . DateValue($myFetch->BillDate) . '</th>
<th style="font-weight: 300;">' . $typ . '</th>
<th style="font-weight: 300;">' . $myFetch->sbBillno . '</th>
<th style="font-weight: 300;">' . $myFetch->RefNo . ' </th>
<th style="font-weight: 300;">' . $customer . ' </th>
<th style="font-weight: 300;">' . GetBranchDetils($Bid)->BName . '</th>
</tr>


</table>
<br>
<table border="1" style="width: 100%; font-size: 1rem; border-collapse: collapse;">
<tr>
<th style="font-weight: 500;">#</th>
<th style="font-weight: 500;">منتج</th>
<th style="font-weight: 500;">وحدة</th>

<th style="font-weight: 500;">الكمية</th>
<th style="font-weight: 500;">السعر</th>
<th style="font-weight: 500;">الاجمالي</th>
<th style="font-weight: 500;">الضريبة%</th>
<th style="font-weight: 500;">الضريبة</th>
<th style="font-weight: 500;">المجموع الإجمالي</th>
</tr>';

		$counter = 1;
		$qtyTot = 0;
		$PriceTot = 0;
		$TotalTot = 0;
		$vatperTot = 0;
		$vatamtTot = 0;
		$GrTotal = 0;

		$detailsSp = Run($tt);
		while ($getDetails = myfetch($detailsSp)) {


			$html .= '
<tr>
<th style="font-weight: 300;">' . $counter . '</th>
<th style="font-weight: 300;">' . $getDetails->PCode . '-' . $getDetails->PName . '</th>
<th style="font-weight: 300;">' . $getDetails->ParaName . '</th>

<th style="font-weight: 300;">' . $getDetails->Qty . '</th>
<th style="font-weight: 300;">' . AmountValue($getDetails->Price) . '</th>
<th style="font-weight: 300;">' . AmountValue($getDetails->Total) . '</th>
<th style="font-weight: 300;">' . AmountValue($getDetails->vatPer) . '</th>
<th style="font-weight: 300;">' . AmountValue($getDetails->vatAmt) . '</th>
<th style="font-weight: 300;">' . AmountValue($getDetails->Total + $getDetails->vatAmt) . '</th>
</tr>';
			$counter++;
		}
		$html .= '
<tr>
<th colspan="7" rowspan="5">شروط الدفع</th>
<th style="font-weight: 600;">الاجمالي</th>
<th style="font-weight: 300;">' . AmountValue($myFetch->Total) . '</th>
</tr>
<tr>
<th style="font-weight: 600;">خصم %</th>
<th style="font-weight: 300;">' . AmountValue($myFetch->disper) . '</th>
</tr>
<tr>
<th style="font-weight: 600;">الخصم</th>
<th style="font-weight: 300;">' . AmountValue($myFetch->Discount) . '</th>
</tr>
<tr>
<th style="font-weight: 600;">الصافي</th>
<th style="font-weight: 300;">' . AmountValue($myFetch->Nettotal) . '</th>
</tr>
<tr>
<th style="font-weight: 600;">اجمالي الضريبة</th>
<th style="font-weight: 300;">' . AmountValue($myFetch->totalVat) . '</th>
</tr>
<tr>
<th colspan="7"></th>
<th>المجموع الإجمالي</th>
<th>' . AmountValue($myFetch->vatPTotal) . '</th>
</tr>
</table>
</div>';
	}

	return $html;
}

function getPurchaseReturnPrintTemplateNew($Billno, $Bid, $LanguageId)
{
	$html = '';

	$servername = $_SERVER['SERVER_NAME'];
	$companyId = $_SESSION['companyId'];
	$barCode = "http://217.76.50.216/Mtech/vouchers/purchasereturn/QrCodes/Sale-$Billno-$Bid-$companyId.png";

	if ($servername == 'localhost') {
		$barCode = "http://localhost/Mtech/vouchers/purchasereturn/QrCodes/Sale-$Billno-$Bid-$companyId.png";
	}

	$getLoginUserCompanyData = getLoginUserCompanyData($_SESSION['id']);

	///// Language Id 1 For English ///
	if ($LanguageId == 1) {
		$Bid = $Bid;
		$Bid = !empty($Bid) ? $Bid : '1';
		$Billno = $Billno;
		$Billno = !empty($Billno) ? $Billno : '0';
		$sBid = !empty($sBid) ? $sBid : '1';
		$LanguageId = $LanguageId;
		$LanguageId = !empty($LanguageId) ? $LanguageId : '1';
		$sbid = "2";
		$bQ = Run("Select * from " . dbObject . "Branch where Bid = '" . $Bid . "'");
		$getBData = myfetch($bQ);
		if ($getBData->ismain == '1') {
			$sbid = "1";
		}

		//$sp = "Exec " . dbObject . "SPSalesSelectWeb @SrchBy=1,@Billno=$Billno,@Bid=$Bid,@sBid=$sbid,@LanguageId=$LanguageId,@FRecNo=0,@ToRecNo=1";

		$sp = "Select *,[Discount%] as disper from " . dbObject . "DataInReturn where Billno = $Billno and Bid = $Bid";


		$tt = "EXECUTE " . dbObject . "SPPurchaseReturnDetSelectWeb @Billno=$Billno,@Bid=$Bid,@sBid=$sbid";
		$storeProcedure = Run($sp);
		$myFetch = myfetch($storeProcedure);
		$Billno = $myFetch->BillNo;
		$Bno = $myFetch->Billno;
		$paY = Run("EXECUTE " . dbObject . "SPPurchaseReturnSelectWeb @SrchBy=0, @Billno=$Billno,@Bid=$Bid,@sBid=$sbid, @FRecNo=0, @ToRecNo=100");

		$SPType = $myFetch->SPType;
		$CSID = $myFetch->CSID;
		$customer = '';
		if ($CSID != '') {
			$customer = getSupplierDetails($CSID)->CName;
		}
		$typ = "Cash";
		if ($SPType != '1') {
			$typ = "Credit";
		}

		$html .= '<div id="Sale-Inovice" style="-webkit-print-color-adjust:exact !important;
print-color-adjust:exact !important; border: 5px solid rgba(143, 192, 235, 0.5); margin: 8px;">
<table style="width: 100%; text-align: start;" border="0">
<tr>
<th style="width: 100%; text-align: center; font-size: 1.3rem; background-color: rgb(143, 192, 235);"
colspan="5">
<h1>' . $getLoginUserCompanyData->name . '</h1>
</th>

</tr>
<tr>
<th style="text-align: start; vertical-align: top; width: 30%;">
<h2 style="font-size: 1rem ; padding-left: 5px;">' . $getLoginUserCompanyData->address . '
<br> MOB:' . $getLoginUserCompanyData->mobile . ' <br> ' . $getLoginUserCompanyData->email . ' <br> VAT#: ' . $getLoginUserCompanyData->vat . '
</h2>

</th>
<th style="vertical-align: top; width: 30%; ">
<h2 style="font-size: 1.9rem; text-align: center;">Purchase Return Invoice  ' . $myFetch->sbBillno . '</h2>
<img style="text-align: left;margin-top:25px" width="80px" height="90px"
src="http://217.76.50.216/' . $getLoginUserCompanyData->logo . '" 
alt="">
</th>
<th colspan="3" style="vertical-align: top; width: 38%;">';
		if ($myFetch->SPType == '1') {

			$html .= '
<h1 style="font-size: 1.5rem;">Payment Details</h1>
<table border="3" style="width: 100%; font-size: 1rem;">
<tr style="background-color: rgb(213, 226, 240); font-weight: 500;">
<th>Name</th>
<th>Amount</th>
<th>Remaining</th>
</tr>
';
			while ($getPayment = myfetch($paY)) {
				$html .= '<tr>
<th style="font-weight: 400;">' . $getPayment->snameArb . '</th>
<th style="font-weight: 300;">' . AmountValue($getPayment->amount) . '</th>
<th style="font-weight: 300;">' . AmountValue($getPayment->remAmount) . '</th>

</tr>';
			}
			$html .= '
</table>';
		}
		$html .= '	
</th>
</table>
<br>
<table style="width: 100%; font-size: 1rem; border: 1px solid black; border-collapse:collapse;" border="1">
<tr>
<th style="font-weight: 600;">Inv Date</th>
<th style="font-weight: 600;">Inv Type</th>
<th style="font-weight: 600;">Inv # </th>
<th style="font-weight: 600;">Refrence # </th>
<th style="font-weight: 600;">Supplier</th>
<th style="font-weight: 600;">Branch </th>
</tr>
<tr>
<th style="font-weight: 300;">' . DateValue($myFetch->BillDate) . '</th>
<th style="font-weight: 300;">' . $typ . '</th>
<th style="font-weight: 300;">' . $myFetch->sbBillno . '</th>
<th style="font-weight: 300;">' . $myFetch->RefNo . ' </th>
<th style="font-weight: 300;">' . $customer . ' </th>
<th style="font-weight: 300;">' . GetBranchDetils($Bid)->BName . '</th>
</tr>

</table>
<br>
<table border="1" style="width: 100%; font-size: 1rem; border-collapse: collapse;">
<tr>
<th style="font-weight: 500;">#</th>
<th style="font-weight: 500;">Item</th>
<th style="font-weight: 500;">Unit</th>
<th style="font-weight: 500;">Qty</th>
<th style="font-weight: 500;">Price</th>
<th style="font-weight: 500;">Total</th>
<th style="font-weight: 500;">Vat%</th>
<th style="font-weight: 500;">Vat Amt</th>
<th style="font-weight: 500;">Grand Total</th>
</tr>';

		$counter = 1;
		$qtyTot = 0;
		$PriceTot = 0;
		$TotalTot = 0;
		$vatperTot = 0;
		$vatamtTot = 0;
		$GrTotal = 0;

		$detailsSp = Run($tt);
		while ($getDetails = myfetch($detailsSp)) {
			$qtyTot = $qtyTot + $getDetails->Qty;
			$PriceTot = $PriceTot + $getDetails->Price;
			$TotalTot = $TotalTot + $getDetails->Total;
			$vatperTot = $vatperTot + $getDetails->vatPer;
			$vatamtTot = $vatamtTot + $getDetails->vatAmt;
			$GrTotal = $GrTotal + $getDetails->vatPTotal;


			$html .= '
<tr>
<th style="font-weight: 300;">' . $counter . '</th>
<th style="font-weight: 300;">' . $getDetails->PCode . '-' . $getDetails->PName . '</th>

<th style="font-weight: 300;">' . $getDetails->ParaName . '</th>
<th style="font-weight: 300;">' . $getDetails->QTY . '</th>
<th style="font-weight: 300;">' . AmountValue($getDetails->Price) . '</th>
<th style="font-weight: 300;">' . AmountValue($getDetails->Total) . '</th>
<th style="font-weight: 300;">' . AmountValue($getDetails->vatPer) . '</th>
<th style="font-weight: 300;">' . AmountValue($getDetails->vatAmt) . '</th>
<th style="font-weight: 300;">' . AmountValue($getDetails->vatPTotal) . '</th>
</tr>';
			$counter++;
		}
		$html .= '
<tr>
<th colspan="7" rowspan="5">PAYMENT TERMS</th>
<th style="font-weight: 600;">Total</th>
<th style="font-weight: 300;">' . AmountValue($myFetch->Total) . '</th>
</tr>
<tr>
<th style="font-weight: 600;">Discount %</th>
<th style="font-weight: 300;">' . AmountValue($myFetch->disper) . '</th>
</tr>
<tr>
<th style="font-weight: 600;">Discount</th>
<th style="font-weight: 300;">' . AmountValue($myFetch->Discount) . '</th>
</tr>
<tr>
<th style="font-weight: 600;">Net Total</th>
<th style="font-weight: 300;">' . AmountValue($myFetch->Nettotal) . '</th>
</tr>
<tr>
<th style="font-weight: 600;">Vat</th>
<th style="font-weight: 300;">' . AmountValue($myFetch->totalVat) . '</th>
</tr>
<tr>
<th colspan="7"> </th>
<th>Grand Total</th>
<th>' . AmountValue($myFetch->vatPTotal) . '</th>
</tr>
</table>
</div>';
	}

	/// Language 2 For Arabic

	if ($LanguageId == 2) {
		$Bid = $Bid;
		$Bid = !empty($Bid) ? $Bid : '1';
		$Billno = $Billno;
		$Billno = !empty($Billno) ? $Billno : '0';
		$sBid = !empty($sBid) ? $sBid : '1';
		$sbid = "2";
		$bQ = Run("Select * from " . dbObject . "Branch where Bid = '" . $Bid . "'");
		$getBData = myfetch($bQ);
		if ($getBData->ismain == '1') {
			$sbid = "1";
		}



		$LanguageId = $LanguageId;
		$LanguageId = !empty($LanguageId) ? $LanguageId : '1';
		// $sp = "Exec " . dbObject . "SPSalesSelectWeb @SrchBy=1,@Billno=$Billno,@Bid=$Bid,@sBid=$sbid,@LanguageId=$LanguageId,@FRecNo=0,@ToRecNo=1";
		$sp = "Select *,[Discount%] as disper from " . dbObject . "DataInReturn where Billno = $Billno and Bid = $Bid";

		// $tt = "EXECUTE " . dbObject . "SPSalDetSelectWeb @Billno=$Billno,@Bid=$Bid,@sBid=$sbid";
		$tt = "EXECUTE " . dbObject . "SPPurchaseReturnDetSelectWeb @Billno=$Billno,@Bid=$Bid,@sBid=$sbid";

		// $paY = Run("EXECUTE " . dbObject . "SPSalPaymentSelectWeb @Billno=$Billno,@Bid=$Bid,@sBid=$sbid");
		$paY = Run("EXECUTE " . dbObject . "SPPurchaseReturnSelectWeb @SrchBy=0, @Billno=$Billno,@Bid=$Bid,@sBid=$sbid, @FRecNo=0, @ToRecNo=100");

		$storeProcedure = Run($sp);
		$myFetch = myfetch($storeProcedure);
		$Billno = $myFetch->Billno;
		$SPType = $myFetch->SPType;
		$CSID = $myFetch->CSID;
		$customer = '';
		if ($CSID != '') {
			$customer = getSupplierDetails($CSID)->CName;
		}
		$typ = "Cash";
		if ($SPType != '1') {
			$typ = "Credit";
		}

		$html .= '<div id="Sale-Inovice" style="-webkit-print-color-adjust:exact !important;
print-color-adjust:exact !important; border: 5px solid rgba(143, 192, 235, 0.5); margin: 8px;">
<table style="width: 100%; text-align: start;" border="0" dir="rtl">
<tr>
<th style="width: 100%; text-align: center; font-size: 1.3rem; background-color: rgb(143, 192, 235);"
colspan="5">
<h1>' . $getLoginUserCompanyData->name_ar . '</h1>
</th>

</tr>
<tr>
<th style="text-align: start; vertical-align: top; width: 32%;">
<h2 style="font-size: 1rem ; padding-left: 5px;">' . $getLoginUserCompanyData->address_ar . '
<br> ' . $getLoginUserCompanyData->mobile_ar . ' <br> <span style="font-size:0.8em;">' . $getLoginUserCompanyData->email . '</span> <br>
: ' . $getLoginUserCompanyData->vat_ar . '
</h2>
</th>
<th style="vertical-align: top; width: 30%; ">
<h2 style="font-size: 1.9rem; text-align: center;">فاتورة مبيعات  ' . $myFetch->sbBillno . '</h2>
<img style="text-align: left;margin-top:25px" width="80px" height="90px"
src="http://217.76.50.216/' . $getLoginUserCompanyData->logo . '" 
alt="">
</th>
<th colspan="3" style="vertical-align: top; width: 38%;">';
		if ($myFetch->SPType == '1') {

			$html .= '
<h1 style="font-size: 1.5rem;">بيانات الدفع</h1>
<table border="3" style="width: 100%; font-size: 1rem;" dir="rtl">
<tr style="background-color: rgb(213, 226, 240); font-weight: 500;">
<th>اسم</th>
<th>كمية</th>
<th>متبقي</th>
</tr>
';
			while ($getPayment = myfetch($paY)) {
				$html .= '<tr>
<th style="font-weight: 400;">' . $getPayment->snameArb . '</th>
<th style="font-weight: 300;">' . AmountValue($getPayment->amount) . '</th>
<th style="font-weight: 300;">' . AmountValue($getPayment->remAmount) . '</th>

</tr>';
			}
			$html .= '
</table>';
		}
		$html .= '	
</th>
</table>
<br>
<table style="width: 100%; font-size: 1rem; border: 1px solid black; border-collapse:collapse;" border="1" dir="rtl">
<tr>
<th style="font-weight: 600;">التاريخ</th>
<th style="font-weight: 600;">نوع الفاتورة
</th>
<th style="font-weight: 600;">رقم الفاتورة</th>
<th style="font-weight: 600;">رقم المرجع  </th>
<th style="font-weight: 600;">عميل</th>
<th style="font-weight: 600;">الفرع </th>
</tr>
<tr>
<th style="font-weight: 300;">' . DateValue($myFetch->BillDate) . '</th>
<th style="font-weight: 300;">' . $typ . '</th>
<th style="font-weight: 300;">' . $myFetch->sbBillno . '</th>
<th style="font-weight: 300;">' . $myFetch->RefNo . ' </th>
<th style="font-weight: 300;">' . $customer . ' </th>
<th style="font-weight: 300;">' . GetBranchDetils($Bid)->BName . '</th>
</tr>


</table>
<br>
<table border="1" style="width: 100%; font-size: 1rem; border-collapse: collapse;">
<tr>
<th style="font-weight: 500;">#</th>
<th style="font-weight: 500;">منتج</th>
<th style="font-weight: 500;">وحدة</th>

<th style="font-weight: 500;">الكمية</th>
<th style="font-weight: 500;">السعر</th>
<th style="font-weight: 500;">الاجمالي</th>
<th style="font-weight: 500;">الضريبة%</th>
<th style="font-weight: 500;">الضريبة</th>
<th style="font-weight: 500;">المجموع الإجمالي</th>
</tr>';

		$counter = 1;
		$qtyTot = 0;
		$PriceTot = 0;
		$TotalTot = 0;
		$vatperTot = 0;
		$vatamtTot = 0;
		$GrTotal = 0;

		$detailsSp = Run($tt);
		while ($getDetails = myfetch($detailsSp)) {
			$qtyTot = $qtyTot + $getDetails->Qty;
			$PriceTot = $PriceTot + $getDetails->Price;
			$TotalTot = $TotalTot + $getDetails->Total;
			$vatperTot = $vatperTot + $getDetails->vatPer;
			$vatamtTot = $vatamtTot + $getDetails->vatAmt;
			$GrTotal = $GrTotal + $getDetails->vatPTotal;


			$html .= '
<tr>
<th style="font-weight: 300;">' . $counter . '</th>
<th style="font-weight: 300;">' . $getDetails->PCode . '-' . $getDetails->PName . '</th>
<th style="font-weight: 300;">' . $getDetails->ParaName . '</th>

<th style="font-weight: 300;">' . $getDetails->QTY . '</th>
<th style="font-weight: 300;">' . AmountValue($getDetails->Price) . '</th>
<th style="font-weight: 300;">' . AmountValue($getDetails->Total) . '</th>
<th style="font-weight: 300;">' . AmountValue($getDetails->vatPer) . '</th>
<th style="font-weight: 300;">' . AmountValue($getDetails->vatAmt) . '</th>
<th style="font-weight: 300;">' . AmountValue($getDetails->vatPTotal) . '</th>
</tr>';
			$counter++;
		}
		$html .= '
<tr>
<th colspan="7" rowspan="5">شروط الدفع</th>
<th style="font-weight: 600;">الاجمالي</th>
<th style="font-weight: 300;">' . AmountValue($myFetch->Total) . '</th>
</tr>
<tr>
<th style="font-weight: 600;">خصم %</th>
<th style="font-weight: 300;">' . AmountValue($myFetch->disper) . '</th>
</tr>
<tr>
<th style="font-weight: 600;">الخصم</th>
<th style="font-weight: 300;">' . AmountValue($myFetch->Discount) . '</th>
</tr>
<tr>
<th style="font-weight: 600;">الصافي</th>
<th style="font-weight: 300;">' . AmountValue($myFetch->Nettotal) . '</th>
</tr>
<tr>
<th style="font-weight: 600;">اجمالي الضريبة</th>
<th style="font-weight: 300;">' . AmountValue($myFetch->totalVat) . '</th>
</tr>
<tr>
<th colspan="7"></th>
<th>المجموع الإجمالي</th>
<th>' . AmountValue($myFetch->vatPTotal) . '</th>
</tr>
</table>
</div>';
	}

	return $html;
}


function getQuotationPrintTemplate($Billno, $Bid, $LanguageId)
{
	$html = '';

	$servername = $_SERVER['SERVER_NAME'];
	$companyId = $_SESSION['companyId'];

	$getLoginUserCompanyData = getLoginUserCompanyData($_SESSION['id']);


	///// Language Id 1 For English ///
	if ($LanguageId == 1) {
		$Bid = $Bid;
		$Bid = !empty($Bid) ? $Bid : '1';
		$Billno = $Billno;
		$Billno = !empty($Billno) ? $Billno : '0';
		$sBid = !empty($sBid) ? $sBid : '1';
		$LanguageId = $LanguageId;
		$LanguageId = !empty($LanguageId) ? $LanguageId : '1';
		$sbid = "2";
		$bQ = Run("Select * from " . dbObject . "Branch where Bid = '" . $Bid . "'");
		$getBData = myfetch($bQ);
		if ($getBData->ismain == '1') {
			$sbid = "1";
		}

		$sp = "Exec " . dbObject . "SPSalQuotationSelectWeb @SrchBy=1,@Billno=$Billno,@Bid=$Bid,@sBid=$sbid,@LanguageId=$LanguageId,@FRecNo=0,@ToRecNo=100";

		$tt = "EXECUTE " . dbObject . "SPSalQuotationDetSelectWeb @Billno=$Billno,@Bid=$Bid,@sBid=$sbid";
		$storeProcedure = Run($sp);
		$myFetch = myfetch($storeProcedure);
		$Billno = $myFetch->Billno;
		$Bno = $myFetch->Billno;
		// $paY = Run("EXECUTE " . dbObject . "SPSalPaymentSelectWeb @Billno=$myFetch->Billno,@Bid=$Bid,@sBid=$sbid");


		$SPType = $myFetch->SPType;
		$CSID = $myFetch->CSID;
		$customer = '';
		if ($CSID != '') {
			$customer = getCustomerDetails($CSID)->CName;
		}
		$typ = "Cash";
		if ($SPType != '1') {
			$typ = "Credit";
		}


		$html .= '<div id="Sale-Inovice" style="-webkit-print-color-adjust:exact !important;
print-color-adjust:exact !important; border: 5px solid rgba(143, 192, 235, 0.5); margin: 8px;">
<table style="width: 100%; text-align: start;" border="0">
<tr>
<th style="width: 100%; text-align: center; font-size: 1.3rem; background-color: rgb(143, 192, 235);"
colspan="5">
<h1>' . $getLoginUserCompanyData->name . '</h1>
</th>

</tr>
<tr>
<th style="text-align: start; vertical-align: top; width: 30%;">
<h2 style="font-size: 1rem ; padding-left: 5px;">' . $getLoginUserCompanyData->address . '
<br> MOB:' . $getLoginUserCompanyData->mobile . ' <br> ' . $getLoginUserCompanyData->email . ' <br> VAT#: ' . $getLoginUserCompanyData->vat . '
</h2>
</th>
<th style="vertical-align: top; width: 30%; ">
<h2 style="font-size: 1.9rem; text-align: center;">Sale Invoice  ' . $myFetch->sbBillno . '</h2>
</th>
<th colspan="3" style="vertical-align: top; width: 38%;">
<img style="text-align: left;" width="80px" height="90px"
src="http://217.76.50.216/' . $getLoginUserCompanyData->logo . '" 
alt="">
';

		if ($myFetch->SPType == '1') {


			$html .= '
<h1 style="font-size: 1.5rem;">Payment Details</h1>
<table border="3" style="width: 100%; font-size: 1rem;">
<tr style="background-color: rgb(213, 226, 240); font-weight: 500;">
<th>Name</th>
<th>Amount</th>
<th>Remaining</th>
</tr>
';
// 			while ($getPayment = myfetch($paY)) {
// 				$html .= '<tr>
// <th style="font-weight: 400;">' . $getPayment->snameArb . '</th>
// <th style="font-weight: 300;">' . AmountValue($getPayment->amount) . '</th>
// <th style="font-weight: 300;">' . AmountValue($getPayment->remAmount) . '</th>

// </tr>';
// 			}
			$html .= '
</table>';
		}
		$html .= '	
</th>
</table>
<br>
<table style="width: 100%; font-size: 1rem; border: 1px solid black; border-collapse:collapse;" border="1">
<tr>
<th style="font-weight: 600;">Inv Date</th>
<th style="font-weight: 600;">Inv Type</th>
<th style="font-weight: 600;">Inv # </th>
<th style="font-weight: 600;">Refrence # </th>
<th style="font-weight: 600;">Customer</th>
<th style="font-weight: 600;">Branch </th>
</tr>
<tr>
<th style="font-weight: 300;">' . DateValue($myFetch->BillDate) . '</th>
<th style="font-weight: 300;">' . $typ . '</th>
<th style="font-weight: 300;">' . $myFetch->sbBillno . '</th>
<th style="font-weight: 300;">' . $myFetch->RefNo . ' </th>
<th style="font-weight: 300;">' . $customer . ' </th>
<th style="font-weight: 300;">' . $myFetch->BranchName . '</th>
</tr>

</table>
<br>
<table border="1" style="width: 100%; font-size: 1rem; border-collapse: collapse;">
<tr>
<th style="font-weight: 500;">#</th>
<th style="font-weight: 500;">Item</th>
<th style="font-weight: 500;">Unit</th>
<th style="font-weight: 500;">Qty</th>
<th style="font-weight: 500;">Price</th>
<th style="font-weight: 500;">Total</th>
<th style="font-weight: 500;">Vat%</th>
<th style="font-weight: 500;">Vat Amt</th>
<th style="font-weight: 500;">Grand Total</th>
</tr>';

		$counter = 1;
		$qtyTot = 0;
		$PriceTot = 0;
		$TotalTot = 0;
		$vatperTot = 0;
		$vatamtTot = 0;
		$GrTotal = 0;

		$detailsSp = Run($tt);
		while ($getDetails = myfetch($detailsSp)) {
			$qtyTot = $qtyTot + $getDetails->Qty;
			$PriceTot = $PriceTot + $getDetails->Price;
			$TotalTot = $TotalTot + $getDetails->Total;
			$vatperTot = $vatperTot + $getDetails->vatPer;
			$vatamtTot = $vatamtTot + $getDetails->vatAmt;
			$GrTotal = $GrTotal + $getDetails->vatPTotal;


			$html .= '
<tr>
<th style="font-weight: 300;">' . $counter . '</th>
<th style="font-weight: 300;">' . $getDetails->PCode . '-' . $getDetails->pname . '</th>

<th style="font-weight: 300;">' . $getDetails->ParaName . '</th>
<th style="font-weight: 300;">' . $getDetails->Qty . '</th>
<th style="font-weight: 300;">' . AmountValue($getDetails->Price) . '</th>
<th style="font-weight: 300;">' . AmountValue($getDetails->Total) . '</th>
<th style="font-weight: 300;">' . AmountValue($getDetails->vatPer) . '</th>
<th style="font-weight: 300;">' . AmountValue($getDetails->vatAmt) . '</th>
<th style="font-weight: 300;">' . AmountValue($getDetails->vatPTotal) . '</th>
</tr>';
			$counter++;
		}
		$html .= '
<tr>
<th colspan="7" rowspan="5">PAYMENT TERMS</th>
<th style="font-weight: 600;">Total</th>
<th style="font-weight: 300;">' . AmountValue($myFetch->Total) . '</th>
</tr>
<tr>
<th style="font-weight: 600;">Discount %</th>
<th style="font-weight: 300;">' . AmountValue($myFetch->DisPer) . '</th>
</tr>
<tr>
<th style="font-weight: 600;">Discount</th>
<th style="font-weight: 300;">' . AmountValue($myFetch->Discount) . '</th>
</tr>
<tr>
<th style="font-weight: 600;">Net Total</th>
<th style="font-weight: 300;">' . AmountValue($myFetch->Nettotal) . '</th>
</tr>
<tr>
<th style="font-weight: 600;">Vat</th>
<th style="font-weight: 300;">' . AmountValue($myFetch->totalVat) . '</th>
</tr>
<tr>
<th colspan="7"> </th>
<th>Grand Total</th>
<th>' . AmountValue($myFetch->vatPTotal) . '</th>
</tr>
</table>
</div>';
	}


	/// Language 2 For Arabic

	if ($LanguageId == 2) {
		$Bid = $Bid;
		$Bid = !empty($Bid) ? $Bid : '1';
		$Billno = $Billno;
		$Billno = !empty($Billno) ? $Billno : '0';
		$sBid = !empty($sBid) ? $sBid : '1';
		$sbid = "2";
		$bQ = Run("Select * from " . dbObject . "Branch where Bid = '" . $Bid . "'");
		$getBData = myfetch($bQ);
		if ($getBData->ismain == '1') {
			$sbid = "1";
		}

		$LanguageId = $LanguageId;
		$LanguageId = !empty($LanguageId) ? $LanguageId : '1';
		$sp = "Exec " . dbObject . "SPSalQuotationSelectWeb @SrchBy=1,@Billno=$Billno,@Bid=$Bid,@sBid=$sbid,@LanguageId=$LanguageId,@FRecNo=0,@ToRecNo=100";
		$tt = "EXECUTE " . dbObject . "SPSalQuotationDetSelectWeb @Billno=$Billno,@Bid=$Bid,@sBid=$sbid";
		// $paY = Run("EXECUTE " . dbObject . "SPSalPaymentSelectWeb @Billno=$Billno,@Bid=$Bid,@sBid=$sbid");


		$storeProcedure = Run($sp);
		$myFetch = myfetch($storeProcedure);
		$Billno = $myFetch->Billno;
		$SPType = $myFetch->SPType;
		$CSID = $myFetch->CSID;
		$customer = '';
		if ($CSID != '') {
			$customer = getCustomerDetails($CSID)->CName;
		}
		$typ = "Cash";
		if ($SPType != '1') {
			$typ = "Credit";
		}

		$html .= '<div id="Sale-Inovice" style="-webkit-print-color-adjust:exact !important;
print-color-adjust:exact !important; border: 5px solid rgba(143, 192, 235, 0.5); margin: 8px;">
<table style="width: 100%; text-align: start;" border="0" dir="rtl">
<tr>
<th style="width: 100%; text-align: center; font-size: 1.3rem; background-color: rgb(143, 192, 235);"
colspan="5">
<h1>' . $getLoginUserCompanyData->name_ar . '</h1>
</th>

</tr>
<tr>
<th style="text-align: start; vertical-align: top; width: 32%;">
<h2 style="font-size: 1rem ; padding-left: 5px;">' . $getLoginUserCompanyData->address_ar . '
<br> ' . $getLoginUserCompanyData->mobile_ar . ' <br> <span style="font-size:0.8em;">' . $getLoginUserCompanyData->email . '</span> <br>
: ' . $getLoginUserCompanyData->vat_ar . '
</h2>
</th>
<th style="vertical-align: top; width: 30%; ">
<h2 style="font-size: 1.9rem; text-align: center;">فاتورة مبيعات  ' . $myFetch->sbBillno . '</h2>
</th>
<th colspan="3" style="vertical-align: top; width: 38%;">
<img style="text-align: left;" width="80px" height="90px"
src="http://217.76.50.216/' . $getLoginUserCompanyData->logo . '" 
alt="">';
		if ($myFetch->SPType == '1') {


			$html .= '
<h1 style="font-size: 1.5rem;">بيانات الدفع</h1>
<table border="3" style="width: 100%; font-size: 1rem;" dir="rtl">
<tr style="background-color: rgb(213, 226, 240); font-weight: 500;">
<th>اسم</th>
<th>كمية</th>
<th>متبقي</th>
</tr>
';
// 			while ($getPayment = myfetch($paY)) {
// 				$html .= '<tr>
// <th style="font-weight: 400;">' . $getPayment->snameArb . '</th>
// <th style="font-weight: 300;">' . AmountValue($getPayment->amount) . '</th>
// <th style="font-weight: 300;">' . AmountValue($getPayment->remAmount) . '</th>

// </tr>';
// 			}
			$html .= '
</table>';
		}
		$html .= '	
</th>
</table>
<br>
<table style="width: 100%; font-size: 1rem; border: 1px solid black; border-collapse:collapse;" border="1" dir="rtl">
<tr>
<th style="font-weight: 600;">التاريخ</th>
<th style="font-weight: 600;">نوع الفاتورة
</th>
<th style="font-weight: 600;">رقم الفاتورة</th>
<th style="font-weight: 600;">رقم المرجع  </th>
<th style="font-weight: 600;">عميل</th>
<th style="font-weight: 600;">الفرع </th>
</tr>
<tr>
<th style="font-weight: 300;">' . DateValue($myFetch->BillDate) . '</th>
<th style="font-weight: 300;">' . $typ . '</th>
<th style="font-weight: 300;">' . $myFetch->sbBillno . '</th>
<th style="font-weight: 300;">' . $myFetch->RefNo . ' </th>
<th style="font-weight: 300;">' . $customer . ' </th>
<th style="font-weight: 300;">' . $myFetch->BranchName . '</th>
</tr>

</table>
<br>
<table border="1" style="width: 100%; font-size: 1rem; border-collapse: collapse;">
<tr>
<th style="font-weight: 500;">#</th>
<th style="font-weight: 500;">منتج</th>
<th style="font-weight: 500;">وحدة</th>

<th style="font-weight: 500;">الكمية</th>
<th style="font-weight: 500;">السعر</th>
<th style="font-weight: 500;">الاجمالي</th>
<th style="font-weight: 500;">الضريبة%</th>
<th style="font-weight: 500;">الضريبة</th>
<th style="font-weight: 500;">المجموع الإجمالي</th>
</tr>';

		$counter = 1;
		$qtyTot = 0;
		$PriceTot = 0;
		$TotalTot = 0;
		$vatperTot = 0;
		$vatamtTot = 0;
		$GrTotal = 0;

		$detailsSp = Run($tt);
		while ($getDetails = myfetch($detailsSp)) {
			$qtyTot = $qtyTot + $getDetails->Qty;
			$PriceTot = $PriceTot + $getDetails->Price;
			$TotalTot = $TotalTot + $getDetails->Total;
			$vatperTot = $vatperTot + $getDetails->vatPer;
			$vatamtTot = $vatamtTot + $getDetails->vatAmt;
			$GrTotal = $GrTotal + $getDetails->vatPTotal;


			$html .= '
<tr>
<th style="font-weight: 300;">' . $counter . '</th>
<th style="font-weight: 300;">' . $getDetails->PCode . '-' . $getDetails->pname . '</th>
<th style="font-weight: 300;">' . $getDetails->ParaName . '</th>

<th style="font-weight: 300;">' . $getDetails->Qty . '</th>
<th style="font-weight: 300;">' . AmountValue($getDetails->Price) . '</th>
<th style="font-weight: 300;">' . AmountValue($getDetails->Total) . '</th>
<th style="font-weight: 300;">' . AmountValue($getDetails->vatPer) . '</th>
<th style="font-weight: 300;">' . AmountValue($getDetails->vatAmt) . '</th>
<th style="font-weight: 300;">' . AmountValue($getDetails->vatPTotal) . '</th>
</tr>';
			$counter++;
		}
		$html .= '
<tr>
<th colspan="7" rowspan="5">شروط الدفع</th>
<th style="font-weight: 600;">الاجمالي</th>
<th style="font-weight: 300;">' . AmountValue($myFetch->Total) . '</th>
</tr>
<tr>
<th style="font-weight: 600;">خصم %</th>
<th style="font-weight: 300;">' . AmountValue($myFetch->DisPer) . '</th>
</tr>
<tr>
<th style="font-weight: 600;">الخصم</th>
<th style="font-weight: 300;">' . AmountValue($myFetch->Discount) . '</th>
</tr>
<tr>
<th style="font-weight: 600;">الصافي</th>
<th style="font-weight: 300;">' . AmountValue($myFetch->Nettotal) . '</th>
</tr>
<tr>
<th style="font-weight: 600;">اجمالي الضريبة</th>
<th style="font-weight: 300;">' . AmountValue($myFetch->totalVat) . '</th>
</tr>
<tr>
<th colspan="7"></th>
<th>المجموع الإجمالي</th>
<th>' . AmountValue($myFetch->vatPTotal) . '</th>
</tr>
</table>
</div>';
	}

	return $html;
}


function getPOPrintTemplate($Billno, $Bid, $LanguageId, $sBid)
{
	$html = '';

	$servername = $_SERVER['SERVER_NAME'];
	$companyId = $_SESSION['companyId'];

	$getLoginUserCompanyData = getLoginUserCompanyData($_SESSION['id']);

	///// Language Id 1 For English ///
	if ($LanguageId == 1) {
		$Bid = !empty($Bid) ? $Bid : '1';
		$Billno = !empty($Billno) ? $Billno : '0';
		$sbid = !empty($sBid) ? $sBid : '1';
		$LanguageId = !empty($LanguageId) ? $LanguageId : '1';

		$sp = "Exec " . dbObject . "SPDatainOrderSelectWeb @SrchBy=1,@Billno=$Billno,@Bid=$Bid,@sBid=$sbid,@LanguageId=$LanguageId,@FRecNo=0,@ToRecNo=100";

		$tt = "EXECUTE " . dbObject . "SPDataInOrderDetSelectWeb @Billno=$Billno,@Bid=$Bid,@sBid=$sbid";
		$storeProcedure = Run($sp);
		$myFetch = myfetch($storeProcedure);
		$Billno = $myFetch->Billno;
		$Bno = $myFetch->Billno;

		$SPType = $myFetch->SPType;
		$CSID = $myFetch->CSID;
		$customer = '';
		if ($CSID != '') {
			$customer = getSupplierDetails($CSID)->CName;
		}
		$typ = "Cash";
		if ($SPType != '1') {
			$typ = "Credit";
		}

		$html .= '<div id="Sale-Inovice" style="-webkit-print-color-adjust:exact !important;
print-color-adjust:exact !important; border: 5px solid rgba(143, 192, 235, 0.5); margin: 8px;">
<table style="width: 100%; text-align: start;" border="0">
<tr>
<th style="width: 100%; text-align: center; font-size: 1.3rem; background-color: rgb(143, 192, 235);"
colspan="5">
<h1>' . $getLoginUserCompanyData->name . '</h1>
</th>

</tr>
<tr>
<th style="text-align: start; vertical-align: top; width: 30%;">
<h2 style="font-size: 1rem ; padding-left: 5px;">' . $getLoginUserCompanyData->address . '
<br> MOB:' . $getLoginUserCompanyData->mobile . ' <br> ' . $getLoginUserCompanyData->email . ' <br> VAT#: ' . $getLoginUserCompanyData->vat . '
</h2>

</th>
<th style="vertical-align: top; width: 30%; ">
<h2 style="font-size: 1.9rem; text-align: center;">Purchase Invoice  ' . $myFetch->sbBillno . '</h2>

</th>
<th colspan="3" style="vertical-align: top; width: 38%;">
<img style="text-align: left;" width="80px" height="90px"
src="http://217.76.50.216/' . $getLoginUserCompanyData->logo . '" 
alt="">';
		if ($myFetch->SPType == '1') {

			$html .= '
<h1 style="font-size: 1.5rem;">Payment Details</h1>
<table border="3" style="width: 100%; font-size: 1rem;">
<tr style="background-color: rgb(213, 226, 240); font-weight: 500;">
<th>Name</th>
<th>Amount</th>
<th>Remaining</th>
</tr>
';
		}
		$html .= '	
</th>
</table>
<br>
<table style="width: 100%; font-size: 1rem; border: 1px solid black; border-collapse:collapse;" border="1">
<tr>
<th style="font-weight: 600;">Inv Date</th>
<th style="font-weight: 600;">Inv Type</th>
<th style="font-weight: 600;">Inv # </th>
<th style="font-weight: 600;">Refrence # </th>
<th style="font-weight: 600;">Supplier</th>
<th style="font-weight: 600;">Branch </th>
</tr>
<tr>
<th style="font-weight: 300;">' . DateValue($myFetch->BillDate) . '</th>
<th style="font-weight: 300;">' . $typ . '</th>
<th style="font-weight: 300;">' . $myFetch->sbBillno . '</th>
<th style="font-weight: 300;">' . $myFetch->RefNo . ' </th>
<th style="font-weight: 300;">' . $customer . ' </th>
<th style="font-weight: 300;">' . GetBranchDetils($Bid)->BName . '</th>
</tr>

</table>
<br>
<table border="1" style="width: 100%; font-size: 1rem; border-collapse: collapse;">
<tr>
<th style="font-weight: 500;">#</th>
<th style="font-weight: 500;">Item</th>
<th style="font-weight: 500;">Unit</th>
<th style="font-weight: 500;">Qty</th>
<th style="font-weight: 500;">Price</th>
<th style="font-weight: 500;">Total</th>
<th style="font-weight: 500;">Vat%</th>
<th style="font-weight: 500;">Vat Amt</th>
<th style="font-weight: 500;">Grand Total</th>
</tr>';

		$counter = 1;
		$qtyTot = 0;
		$PriceTot = 0;
		$TotalTot = 0;
		$vatperTot = 0;
		$vatamtTot = 0;
		$GrTotal = 0;

		$detailsSp = Run($tt);
		while ($getDetails = myfetch($detailsSp)) {
			$qtyTot = $qtyTot + $getDetails->Qty;
			$PriceTot = $PriceTot + $getDetails->Price;
			$TotalTot = $TotalTot + $getDetails->Total;
			$vatperTot = $vatperTot + $getDetails->vatPer;
			$vatamtTot = $vatamtTot + $getDetails->vatAmt;
			$GrTotal = $GrTotal + $getDetails->vatPTotal;


			$html .= '
<tr>
<th style="font-weight: 300;">' . $counter . '</th>
<th style="font-weight: 300;">' . $getDetails->PCode . '-' . $getDetails->PName . '</th>

<th style="font-weight: 300;">' . $getDetails->UnitName . '</th>
<th style="font-weight: 300;">' . $getDetails->Qty . '</th>
<th style="font-weight: 300;">' . AmountValue($getDetails->Price) . '</th>
<th style="font-weight: 300;">' . AmountValue($getDetails->Total) . '</th>
<th style="font-weight: 300;">' . AmountValue($getDetails->vatPer) . '</th>
<th style="font-weight: 300;">' . AmountValue($getDetails->vatAmt) . '</th>
<th style="font-weight: 300;">' . AmountValue($getDetails->vatPTotal) . '</th>
</tr>';
			$counter++;
		}
		$html .= '
<tr>
<th colspan="7" rowspan="5">PAYMENT TERMS</th>
<th style="font-weight: 600;">Total</th>
<th style="font-weight: 300;">' . AmountValue($myFetch->Total) . '</th>
</tr>
<tr>
<th style="font-weight: 600;">Discount %</th>
<th style="font-weight: 300;">' . AmountValue($myFetch->DisPer) . '</th>
</tr>
<tr>
<th style="font-weight: 600;">Discount</th>
<th style="font-weight: 300;">' . AmountValue($myFetch->Discount) . '</th>
</tr>
<tr>
<th style="font-weight: 600;">Net Total</th>
<th style="font-weight: 300;">' . AmountValue($myFetch->Nettotal) . '</th>
</tr>
<tr>
<th style="font-weight: 600;">Vat</th>
<th style="font-weight: 300;">' . AmountValue($myFetch->totalVat) . '</th>
</tr>
<tr>
<th colspan="7"> </th>
<th>Grand Total</th>
<th>' . AmountValue($myFetch->vatPTotal) . '</th>
</tr>
</table>
</div>';
	}

	/// Language 2 For Arabic

	if ($LanguageId == 2) {
		$Bid = !empty($Bid) ? $Bid : '1';
		$Billno = !empty($Billno) ? $Billno : '0';
		$sbid = !empty($sBid) ? $sBid : '1';

		$LanguageId = $LanguageId;
		$LanguageId = !empty($LanguageId) ? $LanguageId : '1';

		$sp = "Exec " . dbObject . "SPDatainOrderSelectWeb @SrchBy=1,@Billno=$Billno,@Bid=$Bid,@sBid=$sbid,@LanguageId=$LanguageId,@FRecNo=0,@ToRecNo=100";

		$tt = "EXECUTE " . dbObject . "SPDataInOrderDetSelectWeb @Billno=$Billno,@Bid=$Bid,@sBid=$sbid";

		$storeProcedure = Run($sp);
		$myFetch = myfetch($storeProcedure);
		$Billno = $myFetch->Billno;
		$SPType = $myFetch->SPType;
		$CSID = $myFetch->CSID;
		$customer = '';
		if ($CSID != '') {
			$customer = getSupplierDetails($CSID)->CName;
		}
		$typ = "Cash";
		if ($SPType != '1') {
			$typ = "Credit";
		}

		$html .= '<div id="Sale-Inovice" style="-webkit-print-color-adjust:exact !important;
print-color-adjust:exact !important; border: 5px solid rgba(143, 192, 235, 0.5); margin: 8px;">
<table style="width: 100%; text-align: start;" border="0" dir="rtl">
<tr>
<th style="width: 100%; text-align: center; font-size: 1.3rem; background-color: rgb(143, 192, 235);"
colspan="5">
<h1>' . $getLoginUserCompanyData->name_ar . '</h1>
</th>

</tr>
<tr>
<th style="text-align: start; vertical-align: top; width: 32%;">
<h2 style="font-size: 1rem ; padding-left: 5px;">' . $getLoginUserCompanyData->address_ar . '
<br> ' . $getLoginUserCompanyData->mobile_ar . ' <br> <span style="font-size:0.8em;">' . $getLoginUserCompanyData->email . '</span> <br>
: ' . $getLoginUserCompanyData->vat_ar . '
</h2>
</th>
<th style="vertical-align: top; width: 30%; ">
<h2 style="font-size: 1.9rem; text-align: center;">فاتورة مبيعات  ' . $myFetch->sbBillno . '</h2>
</th>
<th colspan="3" style="vertical-align: top; width: 38%;">
<img style="text-align: left;" width="80px" height="90px"
src="http://217.76.50.216/' . $getLoginUserCompanyData->logo . '" 
alt="">';
		if ($myFetch->SPType == '1') {

			$html .= '
<h1 style="font-size: 1.5rem;">بيانات الدفع</h1>
<table border="3" style="width: 100%; font-size: 1rem;" dir="rtl">
<tr style="background-color: rgb(213, 226, 240); font-weight: 500;">
<th>اسم</th>
<th>كمية</th>
<th>متبقي</th>
</tr>
';
		}
		$html .= '	
</th>
</table>
<br>
<table style="width: 100%; font-size: 1rem; border: 1px solid black; border-collapse:collapse;" border="1" dir="rtl">
<tr>
<th style="font-weight: 600;">التاريخ</th>
<th style="font-weight: 600;">نوع الفاتورة
</th>
<th style="font-weight: 600;">رقم الفاتورة</th>
<th style="font-weight: 600;">رقم المرجع  </th>
<th style="font-weight: 600;">عميل</th>
<th style="font-weight: 600;">الفرع </th>
</tr>
<tr>
<th style="font-weight: 300;">' . DateValue($myFetch->BillDate) . '</th>
<th style="font-weight: 300;">' . $typ . '</th>
<th style="font-weight: 300;">' . $myFetch->sbBillno . '</th>
<th style="font-weight: 300;">' . $myFetch->RefNo . ' </th>
<th style="font-weight: 300;">' . $customer . ' </th>
<th style="font-weight: 300;">' . GetBranchDetils($Bid)->BName . '</th>
</tr>


</table>
<br>
<table border="1" style="width: 100%; font-size: 1rem; border-collapse: collapse;">
<tr>
<th style="font-weight: 500;">#</th>
<th style="font-weight: 500;">منتج</th>
<th style="font-weight: 500;">وحدة</th>

<th style="font-weight: 500;">الكمية</th>
<th style="font-weight: 500;">السعر</th>
<th style="font-weight: 500;">الاجمالي</th>
<th style="font-weight: 500;">الضريبة%</th>
<th style="font-weight: 500;">الضريبة</th>
<th style="font-weight: 500;">المجموع الإجمالي</th>
</tr>';

		$counter = 1;
		$qtyTot = 0;
		$PriceTot = 0;
		$TotalTot = 0;
		$vatperTot = 0;
		$vatamtTot = 0;
		$GrTotal = 0;

		$detailsSp = Run($tt);
		while ($getDetails = myfetch($detailsSp)) {
			$qtyTot = $qtyTot + $getDetails->Qty;
			$PriceTot = $PriceTot + $getDetails->Price;
			$TotalTot = $TotalTot + $getDetails->Total;
			$vatperTot = $vatperTot + $getDetails->vatPer;
			$vatamtTot = $vatamtTot + $getDetails->vatAmt;
			$GrTotal = $GrTotal + $getDetails->vatPTotal;


			$html .= '
<tr>
<th style="font-weight: 300;">' . $counter . '</th>
<th style="font-weight: 300;">' . $getDetails->PCode . '-' . $getDetails->PName . '</th>
<th style="font-weight: 300;">' . $getDetails->UnitName . '</th>

<th style="font-weight: 300;">' . $getDetails->Qty . '</th>
<th style="font-weight: 300;">' . AmountValue($getDetails->Price) . '</th>
<th style="font-weight: 300;">' . AmountValue($getDetails->Total) . '</th>
<th style="font-weight: 300;">' . AmountValue($getDetails->vatPer) . '</th>
<th style="font-weight: 300;">' . AmountValue($getDetails->vatAmt) . '</th>
<th style="font-weight: 300;">' . AmountValue($getDetails->vatPTotal) . '</th>
</tr>';
			$counter++;
		}
		$html .= '
<tr>
<th colspan="7" rowspan="5">شروط الدفع</th>
<th style="font-weight: 600;">الاجمالي</th>
<th style="font-weight: 300;">' . AmountValue($myFetch->Total) . '</th>
</tr>
<tr>
<th style="font-weight: 600;">خصم %</th>
<th style="font-weight: 300;">' . AmountValue($myFetch->DisPer) . '</th>
</tr>
<tr>
<th style="font-weight: 600;">الخصم</th>
<th style="font-weight: 300;">' . AmountValue($myFetch->Discount) . '</th>
</tr>
<tr>
<th style="font-weight: 600;">الصافي</th>
<th style="font-weight: 300;">' . AmountValue($myFetch->Nettotal) . '</th>
</tr>
<tr>
<th style="font-weight: 600;">اجمالي الضريبة</th>
<th style="font-weight: 300;">' . AmountValue($myFetch->totalVat) . '</th>
</tr>
<tr>
<th colspan="7"></th>
<th>المجموع الإجمالي</th>
<th>' . AmountValue($myFetch->vatPTotal) . '</th>
</tr>
</table>
</div>';
	}

	return $html;
}

function getOpeningQuantityemplateNew($Billno, $Bid, $LanguageId)
{
	$html = '';

	$servername = $_SERVER['SERVER_NAME'];
	$companyId = $_SESSION['companyId'];

	$getLoginUserCompanyData = getLoginUserCompanyData($_SESSION['id']);

	///// Language Id 1 For English ///
	if ($LanguageId == 1) {
		$Bid = $Bid;
		$Bid = !empty($Bid) ? $Bid : '1';
		$Billno = $Billno;
		$Billno = !empty($Billno) ? $Billno : '0';
		$sBid = !empty($sBid) ? $sBid : '1';
		$LanguageId = $LanguageId;
		$LanguageId = !empty($LanguageId) ? $LanguageId : '1';
		$sbid = "2";
		$bQ = Run("Select * from " . dbObject . "Branch where Bid = '" . $Bid . "'");
		$getBData = myfetch($bQ);
		if ($getBData->ismain == '1') {
			$sbid = "1";
		}

		$sp = "Exec " . dbObject . "SPOpenQuantitySelectWeb @SrchBy=1,@Billno=$Billno,@Bid=$Bid,@sBid=$sbid,@LanguageId=$LanguageId,@FRecNo=0,@ToRecNo=100";

		$tt = "EXECUTE " . dbObject . "SPOpenQuantityDetSelectWeb @Billno=$Billno,@Bid=$Bid,@sBid=$sbid, @SrchBy=1,@FRecNo=0,@ToRecNo=100";
		$storeProcedure = Run($sp);
		$myFetch = myfetch($storeProcedure);
		$Billno = $myFetch->Billno;
		$Bno = $myFetch->Billno;

		$SPType = $myFetch->SPType;
		$CSID = $myFetch->CSID;
		$customer = '';
		if ($CSID != '') {
			$customer = getSupplierDetails($CSID)->CName;
		}
		$typ = "Cash";
		if ($SPType != '1') {
			$typ = "Credit";
		}

		$html .= '<div id="Sale-Inovice" style="-webkit-print-color-adjust:exact !important;
print-color-adjust:exact !important; border: 5px solid rgba(143, 192, 235, 0.5); margin: 8px;">
<table style="width: 100%; text-align: start;" border="0">
<tr>
<th style="width: 100%; text-align: center; font-size: 1.3rem; background-color: rgb(143, 192, 235);"
colspan="5">
<h1>' . $getLoginUserCompanyData->name . '</h1>
</th>

</tr>
<tr>
<th style="text-align: start; vertical-align: top; width: 30%;">
<h2 style="font-size: 1rem ; padding-left: 5px;">' . $getLoginUserCompanyData->address . '
<br> MOB:' . $getLoginUserCompanyData->mobile . ' <br> ' . $getLoginUserCompanyData->email . ' <br> VAT#: ' . $getLoginUserCompanyData->vat . '
</h2>

</th>
<th style="vertical-align: top; width: 30%; ">
<h2 style="font-size: 1.9rem; text-align: center;">Opening Quantity Invoice  ' . $myFetch->sbBillno . '</h2>

</th>
<th colspan="3" style="vertical-align: top; width: 38%;">
<img style="text-align: left;" width="80px" height="90px"
src="http://217.76.50.216/' . $getLoginUserCompanyData->logo . '" 
alt="">';
		if ($myFetch->SPType == '1') {

			$html .= '
<h1 style="font-size: 1.5rem;">Payment Details</h1>
<table border="3" style="width: 100%; font-size: 1rem;">
<tr style="background-color: rgb(213, 226, 240); font-weight: 500;">
<th>Name</th>
<th>Amount</th>
<th>Remaining</th>
</tr>
';
		}
		$html .= '	
</th>
</table>
<br>
<table style="width: 100%; font-size: 1rem; border: 1px solid black; border-collapse:collapse;" border="1">
<tr>
<th style="font-weight: 600;">Inv Date</th>
<th style="font-weight: 600;">Inv Type</th>
<th style="font-weight: 600;">Inv # </th>
<th style="font-weight: 600;">Branch </th>
</tr>
<tr>
<th style="font-weight: 300;">' . DateValue($myFetch->BillDate) . '</th>
<th style="font-weight: 300;">' . $typ . '</th>
<th style="font-weight: 300;">' . $myFetch->sbBillno . '</th>
<th style="font-weight: 300;">' . GetBranchDetils($Bid)->BName . '</th>
</tr>

</table>
<br>
<table border="1" style="width: 100%; font-size: 1rem; border-collapse: collapse;">
<tr>
<th style="font-weight: 500;">#</th>
<th style="font-weight: 500;">Item</th>
<th style="font-weight: 500;">Unit</th>
<th style="font-weight: 500;">Qty</th>
<th style="font-weight: 500;">Price</th>
<th style="font-weight: 500;">Total</th>
<th style="font-weight: 500;">&emsp;&emsp;&emsp;&emsp;</th>
<th style="font-weight: 500;">&emsp;&emsp;&emsp;&emsp;</th>
<th style="font-weight: 500;">&emsp;&emsp;&emsp;&emsp;</th>
<th style="font-weight: 500;">&emsp;&emsp;&emsp;&emsp;</th>
</tr>';

		$counter = 1;
		$qtyTot = 0;
		$PriceTot = 0;
		$TotalTot = 0;
		$vatperTot = 0;
		$vatamtTot = 0;
		$GrTotal = 0;

		$detailsSp = Run($tt);
		while ($getDetails = myfetch($detailsSp)) {
			$qtyTot = $qtyTot + $getDetails->Qty;
			$PriceTot = $PriceTot + $getDetails->Price;
			$TotalTot = $TotalTot + $getDetails->Total;
			$vatperTot = $vatperTot + $getDetails->vatPer;
			$vatamtTot = $vatamtTot + $getDetails->vatAmt;
			$GrTotal = $GrTotal + $getDetails->vatPTotal;


			$html .= '
<tr>
<th style="font-weight: 300;">' . $counter . '</th>
<th style="font-weight: 300;">' . $getDetails->PCode . '-' . $getDetails->PName . '</th>

<th style="font-weight: 300;">' . $getDetails->ParaName . '</th>
<th style="font-weight: 300;">' . $getDetails->NewQuantity . '</th>
<th style="font-weight: 300;">' . AmountValue($getDetails->Price) . '</th>
<th style="font-weight: 300;">' . AmountValue($getDetails->NetTotal) . '</th>
<th style="font-weight: 300;">&emsp;&emsp;&emsp;&emsp;</th>
<th style="font-weight: 300;">&emsp;&emsp;&emsp;&emsp;</th>
<th style="font-weight: 300;">&emsp;&emsp;&emsp;&emsp;</th>
<th style="font-weight: 300;">&emsp;&emsp;&emsp;&emsp;</th>
</tr>';
			$counter++;
		}
		$html .= '
<tr>
<th colspan="7" rowspan="5">PAYMENT TERMS</th>
<th style="font-weight: 600;">Total</th>
<th style="font-weight: 300;">' . AmountValue($myFetch->NetTotal) . '</th>
</tr>
<tr>
<th> </th>
<th>Grand Total</th>
<th>' . AmountValue($myFetch->NetTotal) . '</th>
</tr>
</table>
</div>';
	}

	/// Language 2 For Arabic

	if ($LanguageId == 2) {
		$Bid = $Bid;
		$Bid = !empty($Bid) ? $Bid : '1';
		$Billno = $Billno;
		$Billno = !empty($Billno) ? $Billno : '0';
		$sBid = !empty($sBid) ? $sBid : '1';
		$sbid = "2";
		$bQ = Run("Select * from " . dbObject . "Branch where Bid = '" . $Bid . "'");
		$getBData = myfetch($bQ);
		if ($getBData->ismain == '1') {
			$sbid = "1";
		}

		$LanguageId = $LanguageId;
		$LanguageId = !empty($LanguageId) ? $LanguageId : '1';

		$sp = "Exec " . dbObject . "SPOpenQuantitySelectWeb @SrchBy=1,@Billno=$Billno,@Bid=$Bid,@sBid=$sbid,@LanguageId=$LanguageId,@FRecNo=0,@ToRecNo=100";

		$tt = "EXECUTE " . dbObject . "SPOpenQuantityDetSelectWeb @Billno=$Billno,@Bid=$Bid,@sBid=$sbid, @SrchBy=1,@FRecNo=0,@ToRecNo=100";

		$storeProcedure = Run($sp);
		$myFetch = myfetch($storeProcedure);
		$Billno = $myFetch->Billno;
		$SPType = $myFetch->SPType;
		$CSID = $myFetch->CSID;
		$customer = '';
		if ($CSID != '') {
			$customer = getSupplierDetails($CSID)->CName;
		}
		$typ = "Cash";
		if ($SPType != '1') {
			$typ = "Credit";
		}

		$html .= '<div id="Sale-Inovice" style="-webkit-print-color-adjust:exact !important;
print-color-adjust:exact !important; border: 5px solid rgba(143, 192, 235, 0.5); margin: 8px;">
<table style="width: 100%; text-align: start;" border="0" dir="rtl">
<tr>
<th style="width: 100%; text-align: center; font-size: 1.3rem; background-color: rgb(143, 192, 235);"
colspan="5">
<h1>' . $getLoginUserCompanyData->name_ar . '</h1>
</th>

</tr>
<tr>
<th style="text-align: start; vertical-align: top; width: 32%;">
<h2 style="font-size: 1rem ; padding-left: 5px;">' . $getLoginUserCompanyData->address_ar . '
<br> ' . $getLoginUserCompanyData->mobile_ar . ' <br> <span style="font-size:0.8em;">' . $getLoginUserCompanyData->email . '</span> <br>
: ' . $getLoginUserCompanyData->vat_ar . '
</h2>
</th>
<th style="vertical-align: top; width: 30%; ">
<h2 style="font-size: 1.9rem; text-align: center;">فاتورة مبيعات  ' . $myFetch->sbBillno . '</h2>
</th>
<th colspan="3" style="vertical-align: top; width: 38%;">
<img style="text-align: left;" width="80px" height="90px"
src="http://217.76.50.216/' . $getLoginUserCompanyData->logo . '" 
alt="">';
		if ($myFetch->SPType == '1') {

			$html .= '
<h1 style="font-size: 1.5rem;">بيانات الدفع</h1>
<table border="3" style="width: 100%; font-size: 1rem;" dir="rtl">
<tr style="background-color: rgb(213, 226, 240); font-weight: 500;">
<th>اسم</th>
<th>كمية</th>
<th>متبقي</th>
</tr>
';
		}
		$html .= '	
</th>
</table>
<br>
<table style="width: 100%; font-size: 1rem; border: 1px solid black; border-collapse:collapse;" border="1" dir="rtl">
<tr>
<th style="font-weight: 600;">التاريخ</th>
<th style="font-weight: 600;">نوع الفاتورة
</th>
<th style="font-weight: 600;">رقم الفاتورة</th>
<th style="font-weight: 600;">الفرع </th>
</tr>
<tr>
<th style="font-weight: 300;">' . DateValue($myFetch->BillDate) . '</th>
<th style="font-weight: 300;">' . $typ . '</th>
<th style="font-weight: 300;">' . $myFetch->sbBillno . '</th>
<th style="font-weight: 300;">' . GetBranchDetils($Bid)->BName . '</th>
</tr>


</table>
<br>
<table border="1" style="width: 100%; font-size: 1rem; border-collapse: collapse;">
<tr>
<th style="font-weight: 500;">#</th>
<th style="font-weight: 500;">منتج</th>
<th style="font-weight: 500;">وحدة</th>

<th style="font-weight: 500;">الكمية</th>
<th style="font-weight: 500;">السعر</th>
<th style="font-weight: 500;">الاجمالي</th>
<th style="font-weight: 500;">&emsp;&emsp;&emsp;&emsp;</th>
<th style="font-weight: 500;">&emsp;&emsp;&emsp;&emsp;</th>
<th style="font-weight: 500;">&emsp;&emsp;&emsp;&emsp;</th>
<th style="font-weight: 500;">&emsp;&emsp;&emsp;&emsp;</th>
</tr>';

		$counter = 1;
		$qtyTot = 0;
		$PriceTot = 0;
		$TotalTot = 0;
		$vatperTot = 0;
		$vatamtTot = 0;
		$GrTotal = 0;

		$detailsSp = Run($tt);
		while ($getDetails = myfetch($detailsSp)) {
			$qtyTot = $qtyTot + $getDetails->Qty;
			$PriceTot = $PriceTot + $getDetails->Price;
			$TotalTot = $TotalTot + $getDetails->Total;
			$vatperTot = $vatperTot + $getDetails->vatPer;
			$vatamtTot = $vatamtTot + $getDetails->vatAmt;
			$GrTotal = $GrTotal + $getDetails->vatPTotal;


			$html .= '
<tr>
<th style="font-weight: 300;">' . $counter . '</th>
<th style="font-weight: 300;">' . $getDetails->PCode . '-' . $getDetails->PName . '</th>
<th style="font-weight: 300;">' . $getDetails->ParaName . '</th>

<th style="font-weight: 300;">' . $getDetails->NewQuantity . '</th>
<th style="font-weight: 300;">' . AmountValue($getDetails->Price) . '</th>
<th style="font-weight: 300;">' . AmountValue($getDetails->NetTotal) . '</th>
<th style="font-weight: 300;">&emsp;&emsp;&emsp;&emsp;</th>
<th style="font-weight: 300;">&emsp;&emsp;&emsp;&emsp;</th>
<th style="font-weight: 300;">&emsp;&emsp;&emsp;&emsp;</th>
<th style="font-weight: 300;">&emsp;&emsp;&emsp;&emsp;</th>
</tr>';
			$counter++;
		}
		$html .= '
<tr>
<th colspan="7" rowspan="5">شروط الدفع</th>
<tr>
<th style="font-weight: 600;">اجمالي الضريبة</th>
<th style="font-weight: 300;">' . AmountValue($myFetch->NetTotal) . '</th>
</tr>
<tr>
<th></th>
<th>المجموع الإجمالي</th>
<th>' . AmountValue($myFetch->NetTotal) . '</th>
</tr>
</table>
</div>';
	}

	return $html;
}


function getInventoryDataTemplate($Billno, $Bid, $LanguageId)
{
	$html = '';

	$servername = $_SERVER['SERVER_NAME'];
	$companyId = $_SESSION['companyId'];

	$getLoginUserCompanyData = getLoginUserCompanyData($_SESSION['id']);

	///// Language Id 1 For English ///
	if ($LanguageId == 1) {
		$Bid = $Bid;
		$Bid = !empty($Bid) ? $Bid : '1';
		$Billno = $Billno;
		$Billno = !empty($Billno) ? $Billno : '0';
		$sBid = !empty($sBid) ? $sBid : '1';
		$LanguageId = $LanguageId;
		$LanguageId = !empty($LanguageId) ? $LanguageId : '1';
		$sbid = "2";
		$bQ = Run("Select * from " . dbObject . "Branch where Bid = '" . $Bid . "'");
		$getBData = myfetch($bQ);
		if ($getBData->ismain == '1') {
			$sbid = "1";
		}

		$sp = "Exec " . dbObject . "SPInventolrySelectWeb @SrchBy=1,@Billno=$Billno,@Bid=$Bid,@sBid=$sbid,@LanguageId=$LanguageId,@FRecNo=0,@ToRecNo=100";

		$tt = "EXECUTE " . dbObject . "[SPInventoryDetSelectWeb] @Billno=$Billno,@Bid=$Bid,@sBid=$sbid, @SrchBy=0,@FRecNo=0,@ToRecNo=100";
		$storeProcedure = Run($sp);
		$myFetch = myfetch($storeProcedure);
		$Billno = $myFetch->Billno;
		$Bno = $myFetch->Billno;

		$SPType = $myFetch->SPType;
		$CSID = $myFetch->CSID;
		$customer = '';
		if ($CSID != '') {
			$customer = getSupplierDetails($CSID)->CName;
		}
		$typ = "Cash";
		if ($SPType != '1') {
			$typ = "Credit";
		}

		$html .= '<div id="Sale-Inovice" style="-webkit-print-color-adjust:exact !important;
print-color-adjust:exact !important; border: 5px solid rgba(143, 192, 235, 0.5); margin: 8px;">
<table style="width: 100%; text-align: start;" border="0">
<tr>
<th style="width: 100%; text-align: center; font-size: 1.3rem; background-color: rgb(143, 192, 235);"
colspan="5">
<h1>' . $getLoginUserCompanyData->name . '</h1>
</th>

</tr>
<tr>
<th style="text-align: start; vertical-align: top; width: 30%;">
<h2 style="font-size: 1rem ; padding-left: 5px;">' . $getLoginUserCompanyData->address . '
<br> MOB:' . $getLoginUserCompanyData->mobile . ' <br> ' . $getLoginUserCompanyData->email . ' <br> VAT#: ' . $getLoginUserCompanyData->vat . '
</h2>

</th>
<th style="vertical-align: top; width: 30%; ">
<h2 style="font-size: 1.9rem; text-align: center;">Inventory Data Invoice  ' . $myFetch->sbBillno . '</h2>

</th>
<th colspan="3" style="vertical-align: top; width: 38%;">
<img style="text-align: left;" width="80px" height="90px"
src="http://217.76.50.216/' . $getLoginUserCompanyData->logo . '" 
alt="">';
		if ($myFetch->SPType == '1') {

			$html .= '
<h1 style="font-size: 1.5rem;">Payment Details</h1>
<table border="3" style="width: 100%; font-size: 1rem;">
<tr style="background-color: rgb(213, 226, 240); font-weight: 500;">
<th>Name</th>
<th>Amount</th>
<th>Remaining</th>
</tr>
';
		}
		$html .= '	
</th>
</table>
<br>
<table style="width: 100%; font-size: 1rem; border: 1px solid black; border-collapse:collapse;" border="1">
<tr>
<th style="font-weight: 600;">Inv Date</th>
<th style="font-weight: 600;">Inv Type</th>
<th style="font-weight: 600;">Inv # </th>
<th style="font-weight: 600;">Branch </th>
</tr>
<tr>
<th style="font-weight: 300;">' . DateValue($myFetch->BillDate) . '</th>
<th style="font-weight: 300;">' . $typ . '</th>
<th style="font-weight: 300;">' . $myFetch->sbBillno . '</th>
<th style="font-weight: 300;">' . GetBranchDetils($Bid)->BName . '</th>
</tr>

</table>
<br>
<table border="1" style="width: 100%; font-size: 1rem; border-collapse: collapse;">
<tr>
<th style="font-weight: 500;">#</th>
<th style="font-weight: 500;">Item</th>
<th style="font-weight: 500;">Unit</th>
<th style="font-weight: 500;">Computer Qty</th>
<th style="font-weight: 500;">Physical Qty</th>
<th style="font-weight: 500;">Price</th>
<th style="font-weight: 500;">More Total</th>
<th style="font-weight: 500;">Less Total</th>
<th style="font-weight: 500;">Net Total</th>
</tr>';

		$counter = 1;
		$qtyTot = 0;
		$PriceTot = 0;
		$TotalTot = 0;
		$vatperTot = 0;
		$vatamtTot = 0;
		$GrTotal = 0;

		$detailsSp = Run($tt);
		while ($getDetails = myfetch($detailsSp)) {
			$qtyTot = $qtyTot + $getDetails->Qty;
			$PriceTot = $PriceTot + $getDetails->Price;
			$TotalTot = $TotalTot + $getDetails->Total;
			$vatperTot = $vatperTot + $getDetails->vatPer;
			$vatamtTot = $vatamtTot + $getDetails->vatAmt;
			$GrTotal = $GrTotal + $getDetails->vatPTotal;


			$html .= '
<tr>
<th style="font-weight: 300;">' . $counter . '</th>
<th style="font-weight: 300;">' . $getDetails->PCode . '-' . $getDetails->PName . '</th>

<th style="font-weight: 300;">' . $getDetails->ParaName . '</th>
<th style="font-weight: 300;">' . $getDetails->MoreQty . '</th>
<th style="font-weight: 300;">' . $getDetails->LessQty . '</th>
<th style="font-weight: 300;">' . AmountValue($getDetails->Price) . '</th>
<th style="font-weight: 300;">' . AmountValue($getDetails->MoreTotal) . '</th>
<th style="font-weight: 300;">' . AmountValue($getDetails->LessTotal) . '</th>
<th style="font-weight: 300;">' . AmountValue($getDetails->NetTotal) . '</th>
</tr>';
			$counter++;
		}
		$html .= '
<tr>
<th colspan="7" rowspan="5">PAYMENT TERMS</th>
<th style="font-weight: 600;">Total</th>
<th style="font-weight: 300;">' . AmountValue($myFetch->Total) . '</th>
</tr>
<tr>
<th> </th>
<th>Grand Total</th>
<th>' . AmountValue($myFetch->NetTotal) . '</th>
</tr>
</table>
</div>';
	}

	/// Language 2 For Arabic

	if ($LanguageId == 2) {
		$Bid = $Bid;
		$Bid = !empty($Bid) ? $Bid : '1';
		$Billno = $Billno;
		$Billno = !empty($Billno) ? $Billno : '0';
		$sBid = !empty($sBid) ? $sBid : '1';
		$sbid = "2";
		$bQ = Run("Select * from " . dbObject . "Branch where Bid = '" . $Bid . "'");
		$getBData = myfetch($bQ);
		if ($getBData->ismain == '1') {
			$sbid = "1";
		}

		$LanguageId = $LanguageId;
		$LanguageId = !empty($LanguageId) ? $LanguageId : '1';

		$sp = "Exec " . dbObject . "SPInventolrySelectWeb @SrchBy=1,@Billno=$Billno,@Bid=$Bid,@sBid=$sbid,@LanguageId=$LanguageId,@FRecNo=0,@ToRecNo=100";

		$tt = "EXECUTE " . dbObject . "[SPInventoryDetSelectWeb] @Billno=$Billno,@Bid=$Bid,@sBid=$sbid, @SrchBy=0,@FRecNo=0,@ToRecNo=100";

		$storeProcedure = Run($sp);
		$myFetch = myfetch($storeProcedure);
		$Billno = $myFetch->Billno;
		$SPType = $myFetch->SPType;
		$CSID = $myFetch->CSID;
		$customer = '';
		if ($CSID != '') {
			$customer = getSupplierDetails($CSID)->CName;
		}
		$typ = "Cash";
		if ($SPType != '1') {
			$typ = "Credit";
		}

		$html .= '<div id="Sale-Inovice" style="-webkit-print-color-adjust:exact !important;
print-color-adjust:exact !important; border: 5px solid rgba(143, 192, 235, 0.5); margin: 8px;">
<table style="width: 100%; text-align: start;" border="0" dir="rtl">
<tr>
<th style="width: 100%; text-align: center; font-size: 1.3rem; background-color: rgb(143, 192, 235);"
colspan="5">
<h1>' . $getLoginUserCompanyData->name_ar . '</h1>
</th>

</tr>
<tr>
<th style="text-align: start; vertical-align: top; width: 32%;">
<h2 style="font-size: 1rem ; padding-left: 5px;">' . $getLoginUserCompanyData->address_ar . '
<br> ' . $getLoginUserCompanyData->mobile_ar . ' <br> <span style="font-size:0.8em;">' . $getLoginUserCompanyData->email . '</span> <br>
: ' . $getLoginUserCompanyData->vat_ar . '
</h2>
</th>
<th style="vertical-align: top; width: 30%; ">
<h2 style="font-size: 1.9rem; text-align: center;">فاتورة مبيعات  ' . $myFetch->sbBillno . '</h2>
</th>
<th colspan="3" style="vertical-align: top; width: 38%;">
<img style="text-align: left;" width="80px" height="90px"
src="http://217.76.50.216/' . $getLoginUserCompanyData->logo . '" 
alt="">';
		if ($myFetch->SPType == '1') {

			$html .= '
<h1 style="font-size: 1.5rem;">بيانات الدفع</h1>
<table border="3" style="width: 100%; font-size: 1rem;" dir="rtl">
<tr style="background-color: rgb(213, 226, 240); font-weight: 500;">
<th>اسم</th>
<th>كمية</th>
<th>متبقي</th>
</tr>
';
		}
		$html .= '	
</th>
</table>
<br>
<table style="width: 100%; font-size: 1rem; border: 1px solid black; border-collapse:collapse;" border="1" dir="rtl">
<tr>
<th style="font-weight: 600;">التاريخ</th>
<th style="font-weight: 600;">نوع الفاتورة
</th>
<th style="font-weight: 600;">رقم الفاتورة</th>
<th style="font-weight: 600;">الفرع </th>
</tr>
<tr>
<th style="font-weight: 300;">' . DateValue($myFetch->BillDate) . '</th>
<th style="font-weight: 300;">' . $typ . '</th>
<th style="font-weight: 300;">' . $myFetch->sbBillno . '</th>
<th style="font-weight: 300;">' . GetBranchDetils($Bid)->BName . '</th>
</tr>


</table>
<br>
<table border="1" style="width: 100%; font-size: 1rem; border-collapse: collapse;">
<tr>
<th style="font-weight: 500;">#</th>
<th style="font-weight: 500;">منتج</th>
<th style="font-weight: 500;">وحدة</th>

<th style="font-weight: 500;">الكمية</th>
<th style="font-weight: 500;">السعر</th>
<th style="font-weight: 500;">الاجمالي</th>
<th style="font-weight: 500;">الضريبة%</th>
<th style="font-weight: 500;">الضريبة</th>
<th style="font-weight: 500;">المجموع الإجمالي</th>
</tr>';

		$counter = 1;
		$qtyTot = 0;
		$PriceTot = 0;
		$TotalTot = 0;
		$vatperTot = 0;
		$vatamtTot = 0;
		$GrTotal = 0;

		$detailsSp = Run($tt);
		while ($getDetails = myfetch($detailsSp)) {
			$qtyTot = $qtyTot + $getDetails->Qty;
			$PriceTot = $PriceTot + $getDetails->Price;
			$TotalTot = $TotalTot + $getDetails->Total;
			$vatperTot = $vatperTot + $getDetails->vatPer;
			$vatamtTot = $vatamtTot + $getDetails->vatAmt;
			$GrTotal = $GrTotal + $getDetails->vatPTotal;


			$html .= '
			<tr>
			<th style="font-weight: 300;">' . $counter . '</th>
			<th style="font-weight: 300;">' . $getDetails->PCode . '-' . $getDetails->PName . '</th>
			
			<th style="font-weight: 300;">' . $getDetails->ParaName . '</th>
			<th style="font-weight: 300;">' . $getDetails->MoreQty . '</th>
			<th style="font-weight: 300;">' . $getDetails->LessQty . '</th>
			<th style="font-weight: 300;">' . AmountValue($getDetails->Price) . '</th>
			<th style="font-weight: 300;">' . AmountValue($getDetails->MoreTotal) . '</th>
			<th style="font-weight: 300;">' . AmountValue($getDetails->LessTotal) . '</th>
			<th style="font-weight: 300;">' . AmountValue($getDetails->NetTotal) . '</th>
			</tr>';
			$counter++;
		}
		$html .= '
<tr>
<th colspan="7" rowspan="5">شروط الدفع</th>
<th style="font-weight: 600;">الاجمالي</th>
<th style="font-weight: 300;">' . AmountValue($myFetch->Total) . '</th>
</tr>
<tr>
<th colspan="7"></th>
<th>المجموع الإجمالي</th>
<th>' . AmountValue($myFetch->NetTotal) . '</th>
</tr>
</table>
</div>';
	}

	return $html;
}

function getDNPrintTemplateNew($Billno, $Bid, $LanguageId)
{
	$html = '';

	$servername = $_SERVER['SERVER_NAME'];
	$companyId = $_SESSION['companyId'];
	$getLoginUserCompanyData = getLoginUserCompanyData($_SESSION['id']);

	///// Language Id 1 For English ///
	if ($LanguageId == 1) {
		$Bid = $Bid;
		$Bid = !empty($Bid) ? $Bid : '1';
		$Billno = $Billno;
		$Billno = !empty($Billno) ? $Billno : '0';
		$sBid = !empty($sBid) ? $sBid : '1';
		$LanguageId = $LanguageId;
		$LanguageId = !empty($LanguageId) ? $LanguageId : '1';
		$sbid = "2";
		$bQ = Run("Select * from " . dbObject . "Branch where Bid = '" . $Bid . "'");
		$getBData = myfetch($bQ);
		if ($getBData->ismain == '1') {
			$sbid = "1";
		}

		$sp = "Exec " . dbObject . "SPDataDeliverySelectWeb @SrchBy=1,@Billno=$Billno,@Bid=$Bid,@sBid=$sbid,@LanguageId=$LanguageId,@FRecNo=1,@ToRecNo=100";

		$tt = "EXECUTE " . dbObject . "SPDataDeliveryDetailSelectWeb @SrchBy=0, @Billno=$Billno,@Bid=$Bid,@sBid=$sbid,@FRecNo=1,@ToRecNo=100";
		$storeProcedure = Run($sp);
		$myFetch = myfetch($storeProcedure);
		$Billno = $myFetch->BillNo;
		$Bno = $myFetch->BillNo;
		// die();

		$SPType = $myFetch->SPType;
		$CSID = $myFetch->CSID;
		$customer = '';
		if ($CSID != '') {
			$customer = getCustomerDetails($CSID)->CName;
		}
		$typ = "Cash";
		if ($SPType != '1') {
			$typ = "Credit";
		}

		$html .= '<div id="Sale-Inovice" style="-webkit-print-color-adjust:exact !important;
print-color-adjust:exact !important; border: 5px solid rgba(143, 192, 235, 0.5); margin: 8px;">
<table style="width: 100%; text-align: start;" border="0">
<tr>
<th style="width: 100%; text-align: center; font-size: 1.3rem; background-color: rgb(143, 192, 235);"
colspan="5">
<h1>' . $getLoginUserCompanyData->name . '</h1>
</th>

</tr>
<tr>
<th style="text-align: start; vertical-align: top; width: 30%;">
<h2 style="font-size: 1rem ; padding-left: 5px;">' . $getLoginUserCompanyData->address . '
<br> MOB:' . $getLoginUserCompanyData->mobile . ' <br> ' . $getLoginUserCompanyData->email . ' <br> VAT#: ' . $getLoginUserCompanyData->vat . '
</h2>
</th>
<th style="vertical-align: top; width: 30%; ">
<h2 style="font-size: 1.9rem; text-align: center;">Sale Invoice  ' . $myFetch->sbBillno . '</h2>
</th>
<th colspan="3" style="vertical-align: top; width: 38%;">';
		if ($myFetch->SPType == '1') {

			$html .= '
<h1 style="font-size: 1.5rem;">Payment Details</h1>
<table border="3" style="width: 100%; font-size: 1rem;">
<tr style="background-color: rgb(213, 226, 240); font-weight: 500;">
<th>Name</th>
<th>Amount</th>
<th>Remaining</th>
</tr>
';
			$html .= '
</table>';
		}
		$html .= '	
</th>
</table>
<br>
<table style="width: 100%; font-size: 1rem; border: 1px solid black; border-collapse:collapse;" border="1">
<tr>
<th style="font-weight: 600;">Inv Date</th>
<th style="font-weight: 600;">Inv Type</th>
<th style="font-weight: 600;">Inv # </th>
<th style="font-weight: 600;">Refrence # </th>
<th style="font-weight: 600;">Customer</th>
<th style="font-weight: 600;">Branch </th>
</tr>
<tr>
<th style="font-weight: 300;">' . DateValue($myFetch->BillDate) . '</th>
<th style="font-weight: 300;">' . $typ . '</th>
<th style="font-weight: 300;">' . $myFetch->sbBillno . '</th>
<th style="font-weight: 300;">' . $myFetch->RefNo . ' </th>
<th style="font-weight: 300;">' . $customer . ' </th>
<th style="font-weight: 300;">' . $myFetch->BranchName . '</th>
</tr>

</table>
<br>
<table border="1" style="width: 100%; font-size: 1rem; border-collapse: collapse;">
<tr>
<th style="font-weight: 500;">#</th>
<th style="font-weight: 500;">Item</th>
<th style="font-weight: 500;">Unit</th>
<th style="font-weight: 500;">Qty</th>
<th style="font-weight: 500;">Price</th>
<th style="font-weight: 500;">Total</th>
<th style="font-weight: 500;">Net Total</th>
<th style="font-weight: 500;"></th>
<th style="font-weight: 500;"></th>
</tr>';

		$counter = 1;
		$qtyTot = 0;
		$PriceTot = 0;
		$TotalTot = 0;
		$vatperTot = 0;
		$vatamtTot = 0;
		$GrTotal = 0;

		$detailsSp = Run($tt);
		while ($getDetails = myfetch($detailsSp)) {
			$qtyTot = $qtyTot + $getDetails->Qty;
			$PriceTot = $PriceTot + $getDetails->Price;
			$TotalTot = $TotalTot + $getDetails->Total;
			// $vatperTot = $vatperTot + $getDetails->vatPer;
			// $vatamtTot = $vatamtTot + $getDetails->vatAmt;
			$GrTotal = $GrTotal + $getDetails->vatPTotal;


			$html .= '
<tr>
<th style="font-weight: 300;">' . $counter . '</th>
<th style="font-weight: 300;">' . $getDetails->PCode . '-' . $getDetails->PName . '</th>

<th style="font-weight: 300;">' . $getDetails->ParaName . '</th>
<th style="font-weight: 300;">' . $getDetails->Qty . '</th>
<th style="font-weight: 300;">' . AmountValue($getDetails->Price) . '</th>
<th style="font-weight: 300;">' . AmountValue($getDetails->Total) . '</th>
<th style="font-weight: 300;">' . AmountValue($getDetails->NetTotal) . '</th>
<th style="font-weight: 300;"></th>
<th style="font-weight: 300;"></th>
</tr>';
			$counter++;
		}
		$html .= '
<tr>
<th colspan="7" rowspan="5">PAYMENT TERMS</th>
<th style="font-weight: 600;">Total</th>
<th style="font-weight: 300;">' . AmountValue($myFetch->Total) . '</th>
</tr>
<tr>
<th style="font-weight: 600;">Discount %</th>
<th style="font-weight: 300;">' . AmountValue($myFetch->DisPer) . '</th>
</tr>
<tr>
<th style="font-weight: 600;">Discount</th>
<th style="font-weight: 300;">' . AmountValue($myFetch->Discount) . '</th>
</tr>
<tr>
<th style="font-weight: 600;">Net Total</th>
<th style="font-weight: 300;">' . AmountValue($myFetch->Nettotal) . '</th>
</tr>
</table>
</div>';
	}

	/// Language 2 For Arabic

	if ($LanguageId == 2) {
		$Bid = $Bid;
		$Bid = !empty($Bid) ? $Bid : '1';
		$Billno = $Billno;
		$Billno = !empty($Billno) ? $Billno : '0';
		$sBid = !empty($sBid) ? $sBid : '1';
		$sbid = "2";
		$bQ = Run("Select * from " . dbObject . "Branch where Bid = '" . $Bid . "'");
		$getBData = myfetch($bQ);
		if ($getBData->ismain == '1') {
			$sbid = "1";
		}

		$LanguageId = $LanguageId;
		$LanguageId = !empty($LanguageId) ? $LanguageId : '1';
		$sp = "Exec " . dbObject . "SPDataDeliverySelectWeb @SrchBy=1,@Billno=$Billno,@Bid=$Bid,@sBid=$sbid,@LanguageId=$LanguageId,@FRecNo=1,@ToRecNo=100";
		$tt = "EXECUTE " . dbObject . "SPDataDeliveryDetailSelectWeb @SrchBy=0, @Billno=$Billno,@Bid=$Bid,@sBid=$sbid,@FRecNo=1,@ToRecNo=100";


		$storeProcedure = Run($sp);
		$myFetch = myfetch($storeProcedure);
		$Billno = $myFetch->Billno;
		$SPType = $myFetch->SPType;
		$CSID = $myFetch->CSID;
		$customer = '';
		if ($CSID != '') {
			$customer = getCustomerDetails($CSID)->CName;
		}
		$typ = "Cash";
		if ($SPType != '1') {
			$typ = "Credit";
		}

		$html .= '<div id="Sale-Inovice" style="-webkit-print-color-adjust:exact !important;
print-color-adjust:exact !important; border: 5px solid rgba(143, 192, 235, 0.5); margin: 8px;">
<table style="width: 100%; text-align: start;" border="0" dir="rtl">
<tr>
<th style="width: 100%; text-align: center; font-size: 1.3rem; background-color: rgb(143, 192, 235);"
colspan="5">
<h1>' . $getLoginUserCompanyData->name_ar . '</h1>
</th>

</tr>
<tr>
<th style="text-align: start; vertical-align: top; width: 32%;">
<h2 style="font-size: 1rem ; padding-left: 5px;">' . $getLoginUserCompanyData->address_ar . '
<br> ' . $getLoginUserCompanyData->mobile_ar . ' <br> <span style="font-size:0.8em;">' . $getLoginUserCompanyData->email . '</span> <br>
: ' . $getLoginUserCompanyData->vat_ar . '
</h2>
</th>
<th style="vertical-align: top; width: 30%; ">
<h2 style="font-size: 1.9rem; text-align: center;">فاتورة مبيعات  ' . $myFetch->sbBillno . '</h2>
</th>
<th colspan="3" style="vertical-align: top; width: 38%;">';
		if ($myFetch->SPType == '1') {

			$html .= '
<h1 style="font-size: 1.5rem;">بيانات الدفع</h1>
<table border="3" style="width: 100%; font-size: 1rem;" dir="rtl">
<tr style="background-color: rgb(213, 226, 240); font-weight: 500;">
<th>اسم</th>
<th>كمية</th>
<th>متبقي</th>
</tr>
';
			$html .= '
</table>';
		}
		$html .= '	
</th>
</table>
<br>
<table style="width: 100%; font-size: 1rem; border: 1px solid black; border-collapse:collapse;" border="1" dir="rtl">
<tr>
<th style="font-weight: 600;">التاريخ</th>
<th style="font-weight: 600;">نوع الفاتورة
</th>
<th style="font-weight: 600;">رقم الفاتورة</th>
<th style="font-weight: 600;">رقم المرجع  </th>
<th style="font-weight: 600;">عميل</th>
<th style="font-weight: 600;">الفرع </th>
</tr>
<tr>
<th style="font-weight: 300;">' . DateValue($myFetch->BillDate) . '</th>
<th style="font-weight: 300;">' . $typ . '</th>
<th style="font-weight: 300;">' . $myFetch->sbBillno . '</th>
<th style="font-weight: 300;">' . $myFetch->RefNo . ' </th>
<th style="font-weight: 300;">' . $customer . ' </th>
<th style="font-weight: 300;">' . $myFetch->BranchName . '</th>
</tr>

</table>
<br>
<table border="1" style="width: 100%; font-size: 1rem; border-collapse: collapse;">
<tr>
<th style="font-weight: 500;">#</th>
<th style="font-weight: 500;">منتج</th>
<th style="font-weight: 500;">وحدة</th>

<th style="font-weight: 500;">الكمية</th>
<th style="font-weight: 500;">السعر</th>
<th style="font-weight: 500;">الاجمالي</th>
<th style="font-weight: 500;">صافي المجموع</th>
<th style="font-weight: 500;"></th>
<th style="font-weight: 500;"></th>
</tr>';

		$counter = 1;
		$qtyTot = 0;
		$PriceTot = 0;
		$TotalTot = 0;
		$vatperTot = 0;
		$vatamtTot = 0;
		$GrTotal = 0;

		$detailsSp = Run($tt);
		while ($getDetails = myfetch($detailsSp)) {
			$qtyTot = $qtyTot + $getDetails->Qty;
			$PriceTot = $PriceTot + $getDetails->Price;
			$TotalTot = $TotalTot + $getDetails->Total;
			// $vatperTot = $vatperTot + $getDetails->vatPer;
			// $vatamtTot = $vatamtTot + $getDetails->vatAmt;
			$GrTotal = $GrTotal + $getDetails->NetTotal;


			$html .= '
<tr>
<th style="font-weight: 300;">' . $counter . '</th>
<th style="font-weight: 300;">' . $getDetails->PCode . '-' . $getDetails->PName . '</th>
<th style="font-weight: 300;">' . $getDetails->ParaName . '</th>

<th style="font-weight: 300;">' . $getDetails->Qty . '</th>
<th style="font-weight: 300;">' . AmountValue($getDetails->Price) . '</th>
<th style="font-weight: 300;">' . AmountValue($getDetails->Total) . '</th>
<th style="font-weight: 300;">' . AmountValue($getDetails->NetTotal) . '</th>
<th style="font-weight: 300;"></th>
<th style="font-weight: 300;"></th>
</tr>';
			$counter++;
		}
		$html .= '
<tr>
<th colspan="7" rowspan="5">شروط الدفع</th>
<th style="font-weight: 600;">الاجمالي</th>
<th style="font-weight: 300;">' . AmountValue($myFetch->Total) . '</th>
</tr>
<tr>
<th style="font-weight: 600;">خصم %</th>
<th style="font-weight: 300;">' . AmountValue($myFetch->DisPer) . '</th>
</tr>
<tr>
<th style="font-weight: 600;">الخصم</th>
<th style="font-weight: 300;">' . AmountValue($myFetch->Discount) . '</th>
</tr>
<tr>
<th style="font-weight: 600;">الصافي</th>
<th style="font-weight: 300;">' . AmountValue($myFetch->Nettotal) . '</th>
</tr>
</table>
</div>';
	}

	return $html;
}
