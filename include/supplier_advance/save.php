<?php
session_start();
error_reporting(0);
include("../../config/connection.php");
// include("../../config/functions.php");
// include("../../config/main_connection.php");



$Billno = addslashes($_POST['billNo']);
$billdate = addslashes($_POST['bill_date_time']);
$SuppID = addslashes($_POST['supplier_name']);
$Description = addslashes($_POST['remarks']);
$Amount = addslashes($_POST['amount']);
$bnkid = addslashes($_POST['bnkid']);
$bid = addslashes($_POST['bid']);
$IsSuppDis = 1;

if($_POST['IsSuppDis'] == ""){
	$IsSuppDis = 0;
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
$insertion = Run("Insert into " . dbObject . "SupplierAdvance (Billno, bid, SuppID, Description, billdate, userId, Amount, bnkid, IsSuppDis, sbid, IsDeleted, sbBillno, trType) Values ('" . $Billno . "','" . $bid . "','" . $SuppID . "','" . $Description . "','" . $billdate . "','" . $userId . "','" . $Amount . "','" . $bnkid . "', '" . $IsSuppDis . "','" . $sbid . "','0','" . $sbBillno . "','10')");
?>

<script>
	toastr.success('Advance Saved Successfully.');
	document.getElementById('closed').click();
	loadlisting();
</script>