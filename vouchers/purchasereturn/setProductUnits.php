<?php
session_start();
error_reporting(0);
include("../../config/connection.php");
$code = addslashes(trim($_POST['code']));
$Bid = addslashes(trim($_POST['Bid']));
$uidB = addslashes(trim($_POST['uid']));

$region = $_SESSION['region'];
if ($region == '1') {
$sp = "EXECUTE " . dbObject . "GetProductSearchByCode @pCode='$code' ,@bid='$Bid'";
$sp2 = "EXECUTE " . dbObject . "GetProductSearchByCodeUnitWeb  @pCode='$code' ,@bid='$Bid',@uid='" . $Uid . "'";
}
if ($region == "2") {
$sp = "EXECUTE " . dbObject . "Getproductsearchbycodeweb @pCode='$code' ,@bid='$Bid'";
$sp2 = "EXECUTE " . dbObject . "GetProductSearchByCodeUnitWeb  @pCode='$code' ,@bid='$Bid',@uid='" . $Uid . "'";
}

$QueryMax = Run($sp);
$getDetails = myfetch($QueryMax);
$Pid = $getDetails->pid;
$Uid = $getDetails->UID;
//$Uid = 2;
$que = "Select ppc.uid, paraname from productpricecode ppc, units U, 
product P where ppc.pid=p.pid and ppc.uid=u.paraid and ppc.bid='" . $Bid . "' and pcode='" . $code . "'";
$qst = Run($que);

if ($region == '1') {
$sp2 = "EXECUTE " . dbObject . "GetProductSearchByCodeUnitWeb  @pCode='$code' ,@bid='$Bid',@uid='" . $Uid . "'";
}
if ($region == "2") {
$sp2 = "EXECUTE " . dbObject . "GetProductSearchByCodeUnitWeb  @pCode='$code' ,@bid='$Bid',@uid='" . $Uid . "'";
}


$QueryMax2 = Run($sp2);
$getDetails2 = myfetch($QueryMax2);
$IsVat = $getDetails2->IsVat;
?>
<select class="form-select" name="unit" id="unit" aria-label="unit" onChange="LoadUnitPrice(this.value,'<?=$code?>')">
<option value="">Please Select Unit</option>
<?php
while ($loadUnits = myfetch($qst)) {
$selected = "";

if ($uidB == $loadUnits->uid) {
$selected = "Selected";
?>
<script>
$("#unit_name").val('<?= $loadUnits->paraname ?>');
</script>
<?php
}
?>
<option value="<?= $loadUnits->uid ?>" <?= $selected ?>><?= $loadUnits->paraname ?></option>
<?php
}


?>

</select>


<script>
$(document).ready(function() {
$("#isVat").val('<?= $IsVat ?>');

});
</script>