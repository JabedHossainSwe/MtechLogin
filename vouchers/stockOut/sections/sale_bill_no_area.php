<?php
session_start();
error_reporting(0);
include("../../../config/connection.php");
$Bid = addslashes(trim($_POST['Bid']));
$Billno = addslashes(trim($_POST['Billno']));
$Bid = !empty($Bid) ? $Bid: '2';
$Billno = !empty($Billno) ? $Billno: '0';
$Billno = (int)$Billno;
$sBid = !empty($sBid) ? $sBid: '1';
$LanguageId = $_REQUEST['LanguageId'];
$LanguageId = !empty($LanguageId) ? $LanguageId: '1';
 $ab = "Exec ".dbObject."SPSalesSelectWeb @SrchBy=1,@Billno=$Billno,@Bid=$Bid,@sBid=1,@LanguageId=$LanguageId,@FRecNo=0,@ToRecNo=1";
$storeProcedure = Run($ab);
$myFetch = myfetch($storeProcedure);
?>
<script>
$('#sale_bill_option').addClass('done');
$('#sale_bill_no_area').removeClass('slided');
</script>
<div class="content">
<h2 class="heading_fixed">Sales Return Voucher</h2>
</div>
<div class="content_form">
<div class="form_list">

<div class="mb-3">
<label for="" class="form-label">Date :</label>
<input value="<?=$myFetch->BillDate?>" id="bill_date_time"
name="bill_date_time"  type="datetime-local"
class="form-control"></div>
<div class="mb-3">
<label for="" class="form-label"> Reference no </label>
<input type="text" class="form-control" name="RefNo1" id="RefNo1" readonly value="<?=$myFetch->sbBillno?>">
</div>
<div class="mb-3">
<label for="" class="form-label">Sales Man </label>
<div>
	
<?php
$jk = "select  Cid Id,CCode + ' - ' + Cname CName from Emp Where  isnull(IsDeleted,0)=0 and Cid = '".$myFetch->EmpID."' order by Cid";
$query = Run($jk);	
$loadEMployees = myfetch($query);
?>	
<select class="form-select" id="salesMan" name="EmpID" aria-label="sales-men">
<option value="<?=$loadEMployees->Id?>"><?=$loadEMployees->CName?></option>
</select>
</div>

</div>
</div>
</div>