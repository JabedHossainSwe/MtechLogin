<?php
session_start();
error_reporting(0);
include("../../config/connection.php");
$Bid = addslashes(trim($_POST['Bid']));
$Billno = addslashes(trim($_POST['Billno']));
$Billno = !empty($Billno) ? $Billno: '0';
$Bid = !empty($Bid) ? $Bid: '2';
$Billno = (int)$Billno;

$sBid = "2";
$bQ = Run("Select * from " . dbObject . "Branch where Bid = '" . $Bid . "'");
$getBData = myfetch($bQ);
if ($getBData->ismain == '1') {
$sBid = "1";
}

$LanguageId = $_REQUEST['LanguageId'];
$LanguageId = !empty($LanguageId) ? $LanguageId: '1';
$exe = "Exec ".dbObject."[SPDatainOrderSelectWeb] @SrchBy=1,@Billno=$Billno,@Bid=$Bid,@sBid=$sBid,@LanguageId=$LanguageId,@FRecNo =0,@ToRecNo =100;";
$storeProcedure = Run($exe);
$myFetch = myfetch($storeProcedure);
$Billno = $myFetch->BillNo;
$CustCode = $myFetch->CSID;
if($Billno=='')
{
?>	
<script>
$('#poNo').css('border', '1px solid red');
</script>	
<?php
die();
}
else
{
?>	
<script>

loadAllSectionsForPurchaseOrder('<?=$Bid?>','<?=$Billno?>','<?=$sBid?>','<?=$LanguageId?>','<?=$CustCode?>');
	
	
$('#poNo').css('border', '2px solid green');
</script>	
<?php	
	
}
?>
