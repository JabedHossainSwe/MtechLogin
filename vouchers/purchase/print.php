<?php
// use Mpdf\Mpdf;
session_start();
error_reporting(0);
include("../../config/connection.php");
// include("../../config/functions.php");
include("../../config/main_connection.php");
include("../../config/main_functions.php");
include("../../config/templates.php");
$Bid = $_REQUEST['Bid'];
$Bid = !empty($Bid) ? $Bid : '2';

$Billno = $_REQUEST['Billno'];
$Billno = !empty($Billno) ? $Billno : '0';
$GotBill = $Billno;

$LanguageId = $_REQUEST['LanguageId'];
$LanguageId = !empty($LanguageId) ? $LanguageId : '1';
$ff = "Select *,[Discount%] as disper from " . dbObject . "DataIn where Billno = $Billno and Bid = $Bid";

// echo $ff = "Exec " . dbObject . "SPPurchaseSelectWeb @SrchBy=1,@Billno=$Billno,@Bid=$Bid,@sBid=$sbid,@LanguageId=$LanguageId,@FRecNo=0,@ToRecNo=1";
// die();
$storeProcedure = Run($ff);
$myFetch = myfetch($storeProcedure);
$Billno = $myFetch->BillNo;
$SPType = $myFetch->SPType;
$sbid = $myFetch->sbid;
$typ = "Cash";
if ($SPType != '1') {
  $typ = "Credit";
}
if ($Billno == '') {
  echo "No Records Found..";
} else {

  require '../../Lib/mpdf/vendor/autoload.php';
  $sale_invoice = getPurchasePrintTemplateNew($GotBill, $Bid, $LanguageId, $sbid);
  $mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8', 'format' => 'A4']);
  $mpdf->autoScriptToLang = true;
  $mpdf->autoLangToFont = true;

  if ($LanguageId == '2') {
    $mpdf->SetDirectionality('rtl');
  }
  $language = "en";
  if ($LanguageId == '2') {
    $language = "ar";
  }

  $mpdf->WriteHTML($sale_invoice);
  //$mpdf->Output();
  $mpdf->Output('Purchase Invoice-' . $language . '-' . $Billno . '.pdf', 'D');

?>
  <script>
    $('#printInvoice').html();
  </script>
  <div class="content_form">

  </div>
<?php
}
?>