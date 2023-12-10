<?php
session_start();
error_reporting(0);
include("../../config/connection.php");
// include("../../config/functions.php");
$PCode = $_POST['PCode'];

/////////// Duplication Check/////////
$getQ = Run("Select count(PCode) as tlo from " . dbObject . "Product where PCode = '".$PCode."'");
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



$bidM = addslashes($_POST['bidM']);
$sbid = "2";
$bQ = Run("Select * from " . dbObject . "Branch where Bid = '".$bidM."'");
$getBData = myfetch($bQ);
if($getBData->ismain=='1')
{
	$sbid = "1";
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

$query_pid = Run("select max(PID) as pid from " . dbObject . "Product");
$max_pid = myfetch($query_pid);
$pid = $max_pid->pid+1;


//////////////////////// Product Main Insertion Goes Here///////////insert for all branches////

$CodeDef = $pid."-S".$sbid."-M".$bidM."-B".$bidM;
	////////Get EmpId////
$getCurrentEmpData = getCurrentEmpData($_SESSION['storeCode']);
$empid = $getCurrentEmpData->Cid;
//////////
  $ins_product = "insert into " . dbObject . "Product (PID,PCode,PName,Description,PGID,Location,ProductType,uid,SectionId,Pdate,suppid,empid,offerGrpId,defUid,bidN,bidNs,vatPer,IsVat,parentId,defBidSub,bidM,IsDeleted,CurBid,CodeDef,IsMain,IsExpiry,OGID,reordQty,isSteel,fValue,sizeId) values ('".$pid."','".$PCode."','".$PName."','".$Description."','".$PGID."','".$Location."','".$ProductType."','".$uid."',NULL,'".$date."','".$suppid."','".$empid."',NULL,'".$uid."','".$bidM."','".$sbid."','".$vatPer."','".$isVat."','1','".$bidM."','".$bidM."','0','".$bidM."','".$CodeDef."','0','0','0','0','0','0','0')" ;
$inn = Run($ins_product);




while($cnt<=$nrows)
{
$uid = $_POST['uid'.$cnt];
if($uid!='')
{
$CostPrice = addslashes($_POST['CostPrice'.$cnt]);	
// $CostPrice = 0;	
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


$sbid = "1";
  $ins_product_price_code = " insert into " . dbObject . "ProductPriceCode (Pid,Uid,PPrice,SPrice,LSPrice,PPCode,CostPrice,level2,level3,bid,vatSPrice,vatPPrice,IsVat,VatPer,sbid,IsDeleted,IsInactive)values ('".$pid."','".$uid."','0','0','0','".$PCode."','0','0','0','".$loadBranches->Bid."','0','0','".$isVat."','".$vatPer."','".$sbid."','0','0')";
$inn = Run($ins_product_price_code);
}
}
///////////// Price InserTion Goes Here


	

}
	
	$cnt++;
	
}

	$Bracnhes = Run("Select * from " . dbObject . "Branch order by BName ASC");
while($loadBranches = myfetch($Bracnhes))
{
$sbid = "2";
$bQ = Run("Select * from " . dbObject . "Branch where Bid = '".$loadBranches->Bid."'");
$getBData = myfetch($bQ);
if($getBData->ismain=='1')
{
$sbid = "1";
}
	
	
if($loadBranches->Bid==$bidM)
{
 $ins = "INSERT INTO " . dbObject . "OpenStock (Bid ,Pid  ,UID  ,Qty ,sbid ,IsDeleted) Values ('".$loadBranches->Bid."','".$pid."','".$mainUid."','".$OpenQty."','".$sbid."','0')";
$insertion = Run($ins);	
}
else
{
 $ins = "INSERT INTO " . dbObject . "OpenStock 
 (Bid ,Pid  ,UID  ,Qty ,sbid ,IsDeleted) Values
 ('".$loadBranches->Bid."','".$pid."','".$mainUid."','0','1','0')";
	$insertion = Run($ins);	

}

}
	

	

?>

<script>
toastr.success('Product Saved Successfully.');
location.reload();

</script>


