<?php
session_start();
error_reporting(0);
include("../../config/connection.php");
// include("../../config/functions.php");
$ExpNo = addslashes($_POST['ExpNo']);
$ExpDate = addslashes($_POST['ExpDate']);
$CustID = addslashes($_POST['CustID']);
$Remark = addslashes($_POST['Remark']);
$Amount = addslashes($_POST['TAmount']);
$GTotal = addslashes($_POST['GTotal']);
$vatAmount = addslashes($_POST['tvatTotal']);
$bid = addslashes($_POST['bid']);
$vatPer = 15;
$trType = 7;


//$getCurrentEmpData = getCurrentEmpData($_SESSION['storeCode']);
//$UID = $getCurrentEmpData->Cid;
//$bid = $getCurrentEmpData->BID;
//$sbid = "2";
//$bQ = Run("Select * from " . dbObject . "Branch where Bid = '".$bid."'");
//$getBData = myfetch($bQ);
//if($getBData->ismain=='1')
//{
//	$sbid = "1";
//}
//$sbBillno = $ExpNo."-S".$sbid."-M".$bid;


///////////// Main Update/////////////

 $query = "update " . dbObject . "ExpenseData set ExpNo='".$ExpNo."', Remark='".$Remark."', Amount='".$Amount."', ExpDate='".$ExpDate."', CustID='".$CustID."', id='".$ExpNo."', VatPer='".$vatPer."', VatAmount='".$vatAmount."', GTotal='".$GTotal."' where Bid = '".$bid."' and ExpNo = '".$ExpNo."'";

$queryIns = Run($query);

$deleteQuery = "delete from". dbObject ."ExpenseDataDetail where Bid = '".$bid."' and ExpNo = '".$ExpNo."'"; 
$queryIns = Run($deleteQuery);

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
toastr.success('Expense Updated Successfully.');
location.reload();


</script>
