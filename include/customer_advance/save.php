<?php
session_start();
error_reporting(0);
include("../../config/connection.php");
// include("../../config/functions.php");
// include("../../config/main_connection.php");

// print_r($_POST);
// die();

$Billno = addslashes($_POST['billNo']);
$billdate = addslashes($_POST['bill_date_time']);
$SuppID = addslashes($_POST['customer_id']);
$Description = addslashes($_POST['remarks']);
$Amount = addslashes($_POST['amount']);
$salBillno = addslashes($_POST['saleInvNo']);
$bnkid = addslashes($_POST['bnkid']);
$bid = addslashes($_POST['bid']);
$isSalAdv = 0;

if ($salBillno != "") {
	$isSalAdv = 1;
}

$sbid = "2";
$bQ = Run("Select * from " . dbObject . "Branch where Bid = '" . $bid . "'");
$getBData = myfetch($bQ);
if ($getBData->ismain == '1') {
	$sbid = "1";
}

$getCurrentEmpData = getCurrentEmpData($_SESSION['storeCode']);
$userId = $getCurrentEmpData->Cid;

$sbBillno = $Billno . '-S' . $sbid . '-M' . $bid;

// $dateAdd = date("Y-m-d H:i:s");
//////////// Insertion/////////////
 $insertion = "Insert into " . dbObject . "Customeradvance (Billno, bid, SuppID, Description, billdate, userId, Amount, bnkid, salBillno, isSalAdv, sbid, IsDeleted, sbBillno, trType) Values ('" . $Billno . "','" . $bid . "','" . $SuppID . "','" . $Description . "','" . $billdate . "','" . $userId . "','" . $Amount . "','" . $bnkid . "','" . $salBillno . "','" . $isSalAdv . "','" . $sbid . "','0','" . $sbBillno . "','11')";

$insertion = Run($insertion);
?>

<script>
	toastr.success('Advance Saved Successfully.');
	document.getElementById('closed').click();
	loadlisting();
</script>