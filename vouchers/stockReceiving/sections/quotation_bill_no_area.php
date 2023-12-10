<?php
session_start();
error_reporting(0);
include("../../../config/connection.php");
$Bid = addslashes(trim($_POST['Bid']));
$Billno = addslashes(trim($_POST['Billno']));
$Bid = !empty($Bid) ? $Bid: '2';
$Billno = !empty($Billno) ? $Billno: '0';
$Billno = (int)$Billno;

$sBid = "2";
$bQ = Run("Select * from " . dbObject . "Branch where Bid = '" . $Bid . "'");
$getBData = myfetch($bQ);
if ($getBData->ismain == '1') {
$sBid = "1";
}

$LanguageId = $_REQUEST['LanguageId'];
$LanguageId = !empty($LanguageId) ? $LanguageId: '1';
   $ab = "Exec ".dbObject."[SPSalQuotationSelectWeb] @SrchBy=1,@Billno=$Billno,@Bid=$Bid,@sBid =$sBid,@LanguageId =$LanguageId,@FRecNo=0,@ToRecNo=100";
 $storeProcedure = Run($ab);
$myFetch = myfetch($storeProcedure);
 $comments = $myFetch->Comments;

 $abx = "select Cid from ".dbObject."CustFile where isdeleted=0 and CCode = '$myFetch->CustCode'";
$NewSp = Run($abx);
$getV = myfetch($NewSp);
$Cid = $getV->Cid;
?>
<script>
$( document ).ready(function() {
document.getElementById('total').value='<?=$myFetch->Total?>'
$("#f_total").val(<?= $myFetch->Total ?>);
$("#fdisPer").val(<?= $myFetch->DisPer ?>);
$("#fdisAmt").val(<?= $myFetch->Discount ?>);
$("#netTotal").val(<?= $myFetch->Nettotal ?>);
$("#totVat").val(<?= $myFetch->totalVat ?>);
$("#grandTotal").val(<?= $myFetch->vatPTotal ?>);
$("#sal_amount1").val(<?= $myFetch->vatPTotal ?>);
$("#remarks").val('<?= $myFetch->Comments ?>');
	
var CustCode = '<?= $Cid ?>';
var CustName = '<?= $myFetch->CustName ?>';
var newOption = new Option(CustCode + " - " + CustName, CustCode, true, true);
// Append it to the select
$("#customer_id").append(newOption);
 $("#customer_id").select2("val", CustCode);
calculateWholeDiscountper(<?= $myFetch->Discount ?>);
});
</script>
	
<?php
$jk = "select  Cid Id,CCode + ' - ' + Cname CName from Emp Where  isnull(IsDeleted,0)=0 and Cid = '".$myFetch->EmpID."' order by Cid";
$query = Run($jk);	
$loadEMployees = myfetch($query);
?>	

<script>
    $("#salesMan").val('<?=$loadEMployees->Id?>').change();
</script>
