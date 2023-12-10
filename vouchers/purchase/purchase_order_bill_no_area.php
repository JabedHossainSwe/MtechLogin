<?php
session_start();
error_reporting(0);
include("../../config/connection.php");
// include("../../config/functions.php");
$Bid = addslashes(trim($_POST['Bid']));
$Billno = addslashes(trim($_POST['Billno']));

$sBid = "2";
$bQ = Run("Select * from " . dbObject . "Branch where Bid = '" . $Bid . "'");
$getBData = myfetch($bQ);
if ($getBData->ismain == '1') {
$sBid = "1";
}

$LanguageId = $_REQUEST['LanguageId'];
$LanguageId = !empty($LanguageId) ? $LanguageId: '1';
 $ab = "Exec ".dbObject."[SPDatainOrderSelectWeb] @SrchBy=1,@Billno=$Billno,@Bid=$Bid,@sBid=$sBid,@LanguageId=$LanguageId,@FRecNo =0,@ToRecNo =100;";
$storeProcedure = Run($ab);
$myFetch = myfetch($storeProcedure);
$CSID = $myFetch->CSID;
$CSNAME = getSupplierDetails($CSID)->CName;
?>
<script>

$('#bill_date_time').val('<?=date("Y-m-d",strtotime($myFetch->BillDate))?>');
$('#poNo').val('<?=$myFetch->sbBillno?>');
$('#f_total_int').val('<?=$myFetch->Total?>');
$('#f_dis_amt').val('<?=$myFetch->Discount?>');
$('#f_dis_per').val('<?=$myFetch->DisPer?>');
$('#remarks').val('<?=$myFetch->Comments?>');
$('#f_net_total').val('<?=$myFetch->Nettotal?>');
	
	var t_vat_sum = 0;
  $(".t_vattotal").each(function () {
    t_vat_sum += parseFloat(this.value);
  });
	
$('#f_total_vat').val('<?=$myFetch->totalVat?>');
$('#initial_total_vat').val(t_vat_sum);
$('#f_grand_total').val('<?=$myFetch->vatPTotal?>');
$('#sal_amount1').val('<?=$myFetch->vatPTotal?>');
$('#EmpID').val('<?=$myFetch->EmpID?>');
$('#ResEmpID').val('<?=$myFetch->ResEmpID?>');
$('#supplier_id').val('<?=$CSID?>');

var CustCode = '<?= $myFetch->CSID ?>';
var CustName = '<?= $CSNAME ?>';
var newOption = new Option(CustCode + " - " + CustName, CustCode, true, true);
// Append it to the select
$("#supplier_name").append(newOption);
 $("#supplier_name").select2("val", CustCode);

</script>
	

