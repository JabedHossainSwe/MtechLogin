<?php
session_start();
error_reporting(0);
include("../../config/connection.php");
// include("../../config/functions.php");


$Cid = addslashes($_POST['Cid']);
$CCode = addslashes($_POST['CCode']);
$CName = addslashes($_POST['CName']);
$Description = addslashes($_POST['Description']);

if($Description=='')
{
	$Description = $CName;
}
/// Double Check For Branch Name////
$myq2 = Run("Select count(Cid) as tlo from ".dbObject."Pur_Type where CName='".$CName."' and Cid !='".$Cid."'");
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
 $qqq = "Update ".dbObject."Pur_Type  set CName='".$CName."',Description='".$Description."',dateEdit='".$dateAdd."',empIdEdit='".$empid."' where Cid = '".$Cid."' ";
$insertion = Run($qqq);
?>

<script>
toastr.success('Type Updated Successfully.');
document.getElementById('closed').click();
loadlisting();


</script>


