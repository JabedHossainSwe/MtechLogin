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
$sBid = $_REQUEST['sBid'];
$Billno = !empty($Billno) ? $Billno : '0';
$GotBill = $Billno;



$LanguageId = $_REQUEST['LanguageId'];
$LanguageId = !empty($LanguageId) ? $LanguageId : '1';
$ff = "Exec " . dbObject . "SPSalesSelectWeb @SrchBy=1,@Billno=$Billno,@Bid=$Bid,@sBid=$sBid,@LanguageId=$LanguageId,@FRecNo=0,@ToRecNo=1";
$storeProcedure = Run($ff);
$myFetch = myfetch($storeProcedure);
$Billno = $myFetch->Billno;
$SPType = $myFetch->SPType;
$typ = "Cash";
if ($SPType != '1') {
  $typ = "Credit";
}
if ($Billno == '') {
  echo "No Records Found..";
} else {

  require '../../Lib/mpdf/vendor/autoload.php';
  $sale_invoice = getSalePrintTemplateNew($GotBill, $Bid, $LanguageId, $sBid);
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
  $mpdf->Output('Sale Invoice-' . $language . '-' . $Billno . '.pdf', 'D');

?>
  <script>
    $('#printInvoice').html();
  </script>
  <div class="content_form">

  </div>
<?php
}
?>