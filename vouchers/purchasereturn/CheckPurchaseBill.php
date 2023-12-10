<?php
session_start();
error_reporting(0);
include("../../config/connection.php");
$Bid = addslashes(trim($_POST['Bid']));
$Billno = addslashes(trim($_POST['Billno']));
$Billno = !empty($Billno) ? $Billno: '0';
$Bid = !empty($Bid) ? $Bid: '2';
$Billno = (int)$Billno;
$LanguageId = $_REQUEST['LanguageId'];
$LanguageId = !empty($LanguageId) ? $LanguageId: '1';
$sBid = "2";
$bQ = Run("Select * from " . dbObject . "Branch where Bid = '" . $Bid . "'");
$getBData = myfetch($bQ);
if ($getBData->ismain == '1') {
  $sBid = "1";
}


// $exe = "Exec ".dbObject."SPSalesSelectWeb @SrchBy=1,@Billno=$Billno,@Bid=$Bid,@sBid=1,@LanguageId=$LanguageId,@FRecNo=0,@ToRecNo=1";

$exe = "Exec ".dbObject."SPPurchaseSelectWeb @SrchBy=1 ,@Billno=$Billno,@Bid=$Bid,@sBid=$sBid,@LanguageId=$LanguageId,@FRecNo=0,@ToRecNo=1";
// die();

 $storeProcedure = Run($exe);
$myFetch = myfetch($storeProcedure);
$Billno = $myFetch->BillNo;
$CustCode = $myFetch->CustCode;
if($Billno=='')
{
?>	
<script>
// $('#purchase_bill_no').css('border', '1px solid red');
return false;
</script>	
<?php
die();
}
else
{
?>	
<script>
return true;
// loadAllSectionsForPurchaseReturn('<?=$Bid?>','<?=$Billno?>','<?=$sBid?>','<?=$LanguageId?>','<?=$CustCode?>');
	
	
// $('#purchase_bill_no').css('border', '2px solid green');
</script>	
<?php	
	
}
?>

