<?php
session_start();
error_reporting(0);
include("../../config/connection.php");

$Cid = $_POST['Cid'];

$CCode = $_POST['CCode'];
$Is_Open_bal = '0';
if($OpenBalance>0)
{
	$Is_Open_bal = '1';
	$openDate = date("Y-m-d H:i:s");
}
	$dateAdd = date("Y-m-d H:i:s");
	$dateEdit = date("Y-m-d H:i:s");
	$isDeleted = 0;

$bid = addslashes(trim($_POST['bid']));
$CName = addslashes(trim($_POST['CName']));
$Description = addslashes(trim($_POST['Description']));
$Address = addslashes(trim($_POST['Address']));
$Contact1 = addslashes(trim($_POST['Contact1']));
$Contact2 = addslashes(trim($_POST['Contact2']));
$Fax = addslashes(trim($_POST['Fax']));
$Email = addslashes(trim($_POST['Email']));

$OpenBalance = addslashes(trim($_POST['OpenBalance']));
$grpId = addslashes(trim($_POST['grpId']));
$disPer = addslashes(trim($_POST['disPer']));
$PayDays = addslashes(trim($_POST['PayDays']));
$OpenBalance = !empty($OpenBalance) ? $OpenBalance: '0';
$Salesman = addslashes(trim($_POST['Salesman']));
$VatNo = addslashes(trim($_POST['VatNo']));

$openDebit = addslashes(trim($_POST['openDebit']));
$openDebit = !empty($openDebit) ? $openDebit: '0';

$disPer = $_POST['disPer'];
$disPer = !empty($disPer) ? $disPer: '0';
$openDate = !empty($openDate) ? $openDate: NULL;

$NoOfAyan = addslashes(trim($_POST['NoOfAyan']));





  $insertion = "
 
update [SupplierFile] set 
          
           [CName]='".$CName."'
           ,[Description]='".$Description."'
           ,[Address]='".$Address."'
           ,[Contact1]='".$Contact1."'
           ,[Contact2]='".$Contact2."'
           ,[Fax]='".$Fax."'
           ,[OpenBalance]='".$OpenBalance."'
           ,[disPer]='".$disPer."'
           ,[oempid]='".$Salesman."'
           
           ,[Is_open_bal]='".$Is_Open_bal."'
           ,[grpId]='".$grpId."'
          
           ,[openDate]='$openDate'
           ,[PayDays]='".$PayDays."'
           ,[bid]='".$bid."'
          
           ,[dateEdit]='".$dateEdit."'
         
           ,[openDebit]='".$openDebit."'
            ,[VatNo]='".$VatNo."',[NoOfAyan]='".$NoOfAyan."'
           
           
		   where Cid = '".$Cid."' and CCode = '".$CCode."'
    
          
    
     
            
 
 ";

$run = Run($insertion);
if($run)
{
	?>
<script>
toastr.success('Supplier Updated Successfully.');
	var pg = "update_supplier.php?CCode=<?=$CCode?>&bid=<?=$bid?>"
loadPage(pg)

</script>
<?php
}
?>


