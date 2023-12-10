<?php
session_start();
error_reporting(0);
include("../../config/connection.php");
// include("../../config/functions.php");


$Cid = addslashes($_POST['Cid']);
$CCode = addslashes($_POST['CCode']);
$CName = addslashes($_POST['CName']);
$Description = addslashes($_POST['Description']);
$Email = addslashes($_POST['Email']);
$Fax = addslashes($_POST['Fax']);
$Contact2 = addslashes($_POST['Contact2']);
$Contact1 = addslashes($_POST['Contact1']);
$Address = addslashes($_POST['Address']);
if($Description=='')
{
	$Description = $CName;
}
/// Double Check For Branch Name////
$myq2 = Run("Select count(Cid) as tlo from ".dbObject."Purchaser where CName='".$CName."' and Cid !='".$Cid."'");
if(myfetch($myq2)->tlo>0)
{
?>
<script>
document.getElementById('CName').focus();
document.getElementById('CName_error').innerHTML="* Name Already Exsists.";
document.getElementById('CName').style.border="1px Solid Red";
</script>
<?php
	die();
}
?>
<script>
document.getElementById('CName_error').innerHTML="";
document.getElementById('CName').style.border="1px Solid Green";
</script>

<?php
$dateAdd = date("Y-m-d H:i:s");
$getCurrentEmpData = getCurrentEmpData($_SESSION['storeCode']);
$empid = $getCurrentEmpData->Cid;
$bid = $getCurrentEmpData->BID;
//////////// Insertion/////////////
 $qqq = "Update ".dbObject."Purchaser  set CName='".$CName."',Description='".$Description."',Address='".$Address."',Contact1='".$Contact1."',Contact2='".$Contact2."',Email='".$Email."',Fax = '".$Fax."' where Cid = '".$Cid."' ";
$insertion = Run($qqq);
?>

<script>
toastr.success('Purchaser Updated Successfully.');
document.getElementById('closed').click();
loadlisting();


</script>


