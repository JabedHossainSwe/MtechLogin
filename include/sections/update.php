<?php
session_start();
error_reporting(0);
include("../../config/connection.php");
// include("../../config/functions.php");

$getCurrentEmpData = getCurrentEmpData($_SESSION['storeCode']);
$empid = $getCurrentEmpData->Cid;
$bid = $getCurrentEmpData->BID;

$Cid = addslashes($_POST['Cid']);
$CCode = addslashes($_POST['CCode']);
$CName = addslashes($_POST['CName']);
$Description = addslashes($_POST['Description']);

/// Double Check For Branch Name////
$myq2 = Run("Select count(Cid) as tlo from ".dbObject."Sections where CName='".$CName."' and Cid !='".$Cid."'");
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

//////////// Insertion/////////////
 $qqq = "Update ".dbObject."Sections  set CName='".$CName."',Description='".$Description."',curMbid='".$bid."',dateEdit='".$dateAdd."',empIdEdit='".$empid."' where Cid = '".$Cid."' ";
$insertion = Run($qqq);
?>

<script>
toastr.success('Section Updated Successfully.');
document.getElementById('closed').click();
loadlisting();


</script>


