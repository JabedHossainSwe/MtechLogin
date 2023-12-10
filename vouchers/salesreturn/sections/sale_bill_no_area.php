<?php
session_start();
error_reporting(0);
include("../../../config/connection.php");
$Bid = addslashes(trim($_POST['Bid']));
$Billno = addslashes(trim($_POST['Billno']));
$sBid = addslashes(trim($_POST['sBid']));
$Bid = !empty($Bid) ? $Bid: '2';
$Billno = !empty($Billno) ? $Billno: '0';
$Billno = (int)$Billno;
$LanguageId = $_REQUEST['LanguageId'];
$LanguageId = !empty($LanguageId) ? $LanguageId: '1';
$ab = "Exec ".dbObject."SPSalesSelectWeb @SrchBy=1,@Billno=$Billno,@Bid=$Bid,@sBid=$sBid,@LanguageId=$LanguageId,@FRecNo=0,@ToRecNo=1";
$storeProcedure = Run($ab);
$myFetch = myfetch($storeProcedure);
?>
<script>
// $('#sale_bill_option').addClass('done');
// $('#sale_bill_no_area').removeClass('slided');

// $('#bill_date_time').val('<?=$myFetch->BillDate?>');
$('#RefNo1').val('<?=$myFetch->sbBillno?>');
$('#f_total').val('<?=$myFetch->Total?>');
$('#fdisPer').val('<?=$myFetch->DisPer?>');
$('#fdisAmt').val('<?=$myFetch->Discount?>');
$('#netTotal').val('<?=$myFetch->Nettotal?>');
$('#totVat').val('<?=round($myFetch->totalVat, 2)?>');
$('#grandTotal').val('<?=$myFetch->totalVat + $myFetch->Nettotal?>');
$('#sal_amount1').val('<?=$myFetch->totalVat + $myFetch->Nettotal?>');

</script>
	
<?php
$jk = "select  Cid Id,CCode + ' - ' + Cname CName from Emp Where  isnull(IsDeleted,0)=0 and Cid = '".$myFetch->EmpID."' order by Cid";
$query = Run($jk);	
$loadEMployees = myfetch($query);
?>	

<script>
    $("#salesMan").val('<?=$loadEMployees->Id?>').change();
</script>
