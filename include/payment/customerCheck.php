<?php
session_start();
error_reporting(0);
include("../../config/connection.php");
// include("../../config/functions.php");

$getCurrentEmpData = getCurrentEmpData($_SESSION['storeCode']);
$Bid = $getCurrentEmpData->BID;
$customer_id = addslashes($_POST['customer_id']);



// $aab = "select sum(Credit-Debit) as custBalance from V_CustBalance where cid='".$customer_id."' and bid = '".$Bid."'";
//$query1 = Run($aab);
// $custBalance = myfetch($query1)->custBalance;
// $customer_Balance = round($custBalance,2);



$aab = "	EXEC " . dbObject . "GetSupplierBalalance @bid='$Bid',@dt='',@dt2='',@Cids='$customer_id',@LanguageId ='2',@IsIncludingZeroBal ='1',@OrderBy ='CCode',@DataType=3,@FRecNo=0,@ToRecNo=15  ";
$query1 = Run($aab);
$custBalance = myfetch($query1)->Balance;
$customer_Balance = round($custBalance, 2);







?>
<script>
	$(document).ready(function() {
		document.getElementById('cust_balance').value = '<?= $customer_Balance ?>';
		document.getElementById('total').readOnly = false;
	});
</script>
<table class="table table-bordered direction">
	<thead>
		<tr>
			<th>#</th>
			<th><span class="en">Invoice</span><span class="ar"><?= getArabicTitle('Invoice') ?></span></th>
			<th><span class="en">Invoice Date</span><span class="ar"><?= getArabicTitle('Invoice Date') ?></span></th>
			<th><span class="en">Amount</span><span class="ar"><?= getArabicTitle('Amount') ?></span></th>
			<th><span class="en">Total Paid Amount</span><span class="ar"><?= getArabicTitle('Total Paid Amount') ?></span></th>
			<th><span class="en">Paying Amount</span><span class="ar"><?= getArabicTitle('Paying Amount') ?></span></th>
			<th><span class="en">Balance</span><span class="ar"><?= getArabicTitle('Balance') ?></span></th>
		</tr>
	</thead>
	<tbody id="row_append">


		<?php
		$row_count = 1;
		//// QUery TO Get Pending Payments////
		$aaa = "Select Billno,sbBillno,vatPTotal,CSID,Bid,BillDate from DataIn where SPType=2 and CSID = '" . $customer_id . "'  and Bid='" . $Bid . "' and sbBillno Not IN (Select sbBillno from PayablesDetails where invAmount>PaidAmount and CustomerID = '" . $customer_id . "' and Bid = '" . $Bid . "' )";
		$query2 = Run($aaa);
		while ($getDet = myfetch($query2)) {

			//////////// Check Paid Amount/////////
			$paidQuery = Run("Select Sum(prevPaidAmount) as AlreadyPaid from PayablesDetails where salSubInv='" . $getDet->sbBillno . "' and CustomerID = '" . $customer_id . "' and Bid = '" . $Bid . "'");
			$paidAmount = myfetch($paidQuery)->AlreadyPaid;
			$paidAmount = !empty($paidAmount) ? $paidAmount : '0';


			$balance = $getDet->vatPTotal - $paidAmount;

			if ($balance > 0) {

		?>
				<tr id="<?php echo $row_count ?>">
					<th><?= $row_count ?></th>
					<th><?php echo $getDet->sbBillno ?></th>
					<th><?php echo DateValue($getDet->BillDate) ?></th>
					<th><?php echo AmountValue($getDet->vatPTotal) ?></th>
					<th><?= AmountValue($paidAmount) ?></th>
					<th><input type="text" name="payingAmount<?php echo $row_count ?>" id="payingAmount<?php echo $row_count ?>" value="0" onKeyUp="AmtRowCal('<?= $row_count ?>')" value="0" class="payingAmt form-control" max="<?= AmountValue($balance) ?>"></th>
					<th><span id="balanceAmt<?= $row_count ?>"><?= $balance ?></span><input type="hidden" id="Remaining<?= $row_count ?>" readonly name="Remaining<?= $row_count ?>" value="<?= $balance ?>"></p>
						<input type="hidden" id="balance<?= $row_count ?>" readonly name="balance<?= $row_count ?>" value="<?= $balance ?>">
					</th>
				</tr>
				<input type="hidden" id="InvoiceNo<?php echo $row_count ?>" name="InvoiceNo<?php echo $row_count ?>" value="<?= $getDet->Billno ?>">
				<input type="hidden" id="InvoiceDate<?php echo $row_count ?>" name="InvoiceDate<?php echo $row_count ?>" value="<?= $getDet->BillDate ?>">
				<input type="hidden" id="billAmount<?php echo $row_count ?>" name="billAmount<?php echo $row_count ?>" value="<?= $getDet->vatPTotal ?>">
				<input type="hidden" id="sbBillno<?php echo $row_count ?>" name="sbBillno<?php echo $row_count ?>" value="<?= $getDet->sbBillno ?>">






				<input type="hidden" name="autono<?php echo $row_count ?>" id="autono<?php echo $row_count ?>" value="<?php echo $row_count ?>" class="form-control">


		<?php
				$row_count++;
			}
		}
		?>




	</tbody>
</table>
<input type="hidden" id="nrows" name="nrows" value="<?= $row_count ?>">

<script>
	changeLanguage(<?= $_SESSION['lang'] ?>);
</script>
<script>
    $(document).ready(function () {
        var lang = document.getElementById("selected_lang").value;
        changeLanguage(lang);
    });
</script>