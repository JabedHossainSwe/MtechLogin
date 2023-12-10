<?php
session_start();
error_reporting(0);
include("../../config/connection.php");
// include("../../config/functions.php");
$ExpNo = addslashes($_POST['ExpNo']);
$ExpDate = date("Y-m-d 00:00:00");
$CustID = addslashes($_POST['CustID']);
$Remark = addslashes($_POST['Remark']);
$Amount = addslashes($_POST['TAmount']);
$GTotal = addslashes($_POST['GTotal']);
$vatAmount = addslashes($_POST['tvatTotal']);
$vatPer = 15;
$trType = 7;

$getCurrentEmpData = getCurrentEmpData($_SESSION['storeCode']);
$UID = $getCurrentEmpData->Cid;
$bid = $getCurrentEmpData->BID;
$sbid = "2";
$bQ = Run("Select * from " . dbObject . "Branch where Bid = '".$bid."'");
$getBData = myfetch($bQ);
if($getBData->ismain=='1')
{
	$sbid = "1";
}
$sbBillno = $ExpNo."-S".$sbid."-M".$bid;


///////////// Main insertion/////////////
 $query = "Insert Into " . dbObject . "ExpenseData 
(Bid,ExpNo,Remark,Amount,ExpDate ,UID ,CustID,id,VatPer,VatAmount,GTotal,sbid ,sbBillno,IsDeleted,trType)
VALUES ('".$bid."','".$ExpNo."','".$Remark."','".$Amount."','".$ExpDate."','".$UID."','".$CustID."','".$ExpNo."','".$vatPer."','".$vatAmount."','".$GTotal."','".$sbid."','".$sbBillno."','0','".$trType."')";
$queryIns = Run($query);


$cnt = 1;
$row_count = $_POST['row_count'];
while($cnt<=$row_count)
{
$code = addslashes($_POST['code'.$cnt]);
	if(!empty($code))
	{
	$expense = addslashes($_POST['expense'.$cnt]);
	$amount = addslashes($_POST['amount'.$cnt]);
	$vatAmount = addslashes($_POST['vatAmount'.$cnt]);
	$bnkid = addslashes($_POST['bnkid'.$cnt]);
	$isVat = addslashes($_POST['isVat'.$cnt]);
	$vatPer = addslashes($_POST['vatPer'.$cnt]);
	$vatPer = addslashes($_POST['vatPer'.$cnt]);
	$isVatV=0;
		if($isVat!='No')
		{
			$isVatV=1;
		}
		
		
		//// Detail Table Insertion///
		
 $insertion = "
INSERT INTO " . dbObject . "ExpenseDataDetail
(Bid ,ExpNo  ,ExpID ,Remark ,Amount ,ExpDate  ,UID ,CustID ,bnkid ,id ,IsVat  ,VatPer ,VatAmount,GTotal ,sbid ,sbBillno,IsDeleted)
VALUES ('".$bid."','".$ExpNo."','".$code."','".$Remark."','".$amount."','".$ExpDate."','".$UID."','".$CustID."','".$bnkid."','".$ExpNo."','".$isVatV."','".$vatPer."','".$vatAmount."','".$vatAmount."','".$sbid."','".$sbBillno."','0')"	;	
$mainIt = Run($insertion);
	
	}
	
$cnt++;
}

?>

<script>
toastr.success('Expense Saved Successfully.');
location.reload();


</script>
