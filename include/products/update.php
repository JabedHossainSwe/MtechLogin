<?php
session_start();
error_reporting(0);
include("../../config/connection.php");
// include("../../config/functions.php");

$PCode = $_POST['PCode'];
$PID = $_POST['PID'];
$pid = $PID;
$bidM = addslashes($_POST['bidM']);
$Bid = $bidM;

/////////// Duplication Check/////////
 $qq ="Select count(PCode) as tlo from " . dbObject . "Product where PCode = '".$PCode."' and PID != '".$PID."' and BidM!='".$bidM."'";
$getQ = Run($qq);
$getCnt = myfetch($getQ)->tlo;
if($getCnt>0)
{
?>
<script>
document.getElementById('PCode').style.border="1px solid red";
document.getElementById('PCode_error').innerHTML="PCode Already Exists.";
</script>
<?php
die();	
}





$date = date("Y-m-d h:i:s");
$Location = addslashes($_POST['Location']);
$PName = addslashes($_POST['PName']);
$Description = addslashes($_POST['Description']);
// $SectionId = addslashes($_POST['SectionId']);
$SectionId = 'NULL';
$ProductType = addslashes($_POST['ProductType']);
$suppid = addslashes($_POST['suppid']);
// $offerGrpId = addslashes($_POST['offerGrpId']);
$offerGrpId = 'NULL';
$PGID = addslashes($_POST['PGID']);
$uid = addslashes($_POST['uid']);
$OpenQty = addslashes($_POST['OpenQty']);
$mainUid = $uid;
$isVat = addslashes($_POST['isVat']);
$vatPer = addslashes($_POST['vatPer']);
$nrows = addslashes($_POST['nrows']);
$cnt = 1;

	////////Get EmpId////
$getCurrentEmpData = getCurrentEmpData($_SESSION['storeCode']);
$empid = $getCurrentEmpData->Cid;
//////////
$ins_product = "update " . dbObject . "Product set PCode = '".$PCode."',PName='".$PName."',Description='".$Description."',PGID='".$PGID."',Location='".$Location."',ProductType='".$ProductType."',uid='".$uid."',SectionId=NULL,suppid='".$suppid."',offerGrpId=NULL,vatPer='".$vatPer."',IsVat='".$isVat."',dateEdit='".$date."',empIdEdit='".$empid."' where PID = '".$PID."' and bidM = '".$bidM."'" ;
$inn = Run($ins_product);

$delete = Run("delete from " . dbObject . "ProductPriceCode where PID = '".$PID."'");


while($cnt<=$nrows)
{
$uid = $_POST['uid'.$cnt];
if($uid!='')
{
$CostPrice = addslashes($_POST['CostPrice'.$cnt]);	
$SPrice = addslashes($_POST['SPrice'.$cnt]);	
$LSPrice = addslashes($_POST['LSPrice'.$cnt]);	
 $PPrice = addslashes($_POST['PPrice'.$cnt]);	
$vatValueSP = addslashes($_POST['vatValueSP'.$cnt]);

if($isVat==1)
{
$varPercent  = ($vatPer*$PPrice)/100;
  $vatPPrice = $PPrice + $varPercent;
}
else{
$vatPPrice = $PPrice;
}
	
$Bracnhes = Run("Select * from " . dbObject . "Branch order by BName ASC");
while($loadBranches = myfetch($Bracnhes))
{

if($loadBranches->Bid==$bidM)
{
 $ins_product_price_code = "insert into " . dbObject . "ProductPriceCode (Pid,Uid,PPrice,SPrice,LSPrice,PPCode,CostPrice,level2,level3,bid,vatSPrice,vatPPrice,IsVat,VatPer,sbid,IsDeleted,IsInactive)values ('".$pid."','".$uid."','".$CostPrice."','".$SPrice."','0','".$PCode."','".$CostPrice."','".$LSPrice."','".$PPrice."','".$bidM."','".$vatValueSP."','".$vatPPrice."','".$isVat."','".$vatPer."','".$sbid."','0','0')";
$inn = Run($ins_product_price_code);
}
else
{

$sbid = "2";
$bQ = Run("Select * from " . dbObject . "Branch where Bid = '".$loadBranches->Bid."'");
$getBData = myfetch($bQ);
if($getBData->ismain=='1')
{
$sbid = "1";
}
echo $ins_product_price_code = " insert into " . dbObject . "ProductPriceCode (Pid,Uid,PPrice,SPrice,LSPrice,PPCode,CostPrice,level2,level3,bid,vatSPrice,vatPPrice,IsVat,VatPer,sbid,IsDeleted,IsInactive)values ('".$pid."','".$uid."','0','0','0','".$PCode."','0','0','0','".$loadBranches->Bid."','0','0','".$isVat."','".$vatPer."','".$sbid."','0','0')";
$inn = Run($ins_product_price_code);
}
}
///////////// Price InserTion Goes Here


	

}
	
	$cnt++;
	
}


 $ins = "update  " . dbObject . "OpenStock set Qty= '".$OpenQty."' where Bid = '".$bidM."' And Pid ='".$PID."'  And UID  = '".$mainUid."'";
$insertion = Run($ins);	




	
	

?>

<script>
toastr.success('Product Updated Successfully.');
location.reload();

</script>


