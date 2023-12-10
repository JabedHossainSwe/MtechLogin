<?php
session_start();
error_reporting(0);
include("../../config/connection.php");
$Bid = addslashes(trim($_POST['Bid']));
$Billno = addslashes(trim($_POST['Billno']));
$Billno = !empty($Billno) ? $Billno : '0';
$Bid = !empty($Bid) ? $Bid : '2';
$Billno = (int)$Billno;
$sBid = !empty($sBid) ? $sBid : '1';
$LanguageId = $_REQUEST['LanguageId'];
$LanguageId = !empty($LanguageId) ? $LanguageId : '1';
$exe = "Exec " . dbObject . "SPDataDeliverySelectWeb @SrchBy=1,@Billno=$Billno,@Bid=$Bid,@sBid=1,@LanguageId=$LanguageId,@FRecNo=0,@ToRecNo=1";
$storeProcedure = Run($exe);
$myFetch = myfetch($storeProcedure);
$Billno = $myFetch->BillNo;
$CustCode = $myFetch->CustCode;
if ($Billno == '') {
?>
    <script>
        $('#delivery').css('border', '1px solid red');
    </script>
<?php
    die();
} else {
?>
    <script>
        editVoucherDelivery('<?= $Bid ?>', '<?= $Billno ?>');
        $('#delivery').css('border', '2px solid green');
    </script>
<?php

}
?>