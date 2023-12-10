<?php
session_start();
error_reporting(0);
include("../../config/connection.php");


$quer = 'select max(Cid) as Cid from SupplierFile';
$executes = Run($quer);
$Cid = myfetch($executes)->Cid+1;

$que = 'SELECT TOP (1) CCode from SupplierFile order by Cid desc';
$execute = Run($que);
$CCode = myfetch($execute)->CCode+1;
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
$NoOfAyan = addslashes(trim($_POST['NoOfAyan']));
$Description = addslashes(trim($_POST['Description']));
$Address = addslashes(trim($_POST['Address']));
$Contact1 = addslashes(trim($_POST['Contact1']));
$Contact2 = addslashes(trim($_POST['Contact2']));
$Fax = addslashes(trim($_POST['Fax']));
$Email = addslashes(trim($_POST['Email']));

$OpenBalance = addslashes(trim($_POST['OpenBalance']));
$OpenBalance = !empty($OpenBalance) ? $OpenBalance: '0';


$grpId = addslashes(trim($_POST['grpId']));
$disPer = addslashes(trim($_POST['disPer']));
$PayDays = addslashes(trim($_POST['PayDays']));
$PayDays = !empty($PayDays) ? $PayDays: '0';


$OpenBalance = !empty($OpenBalance) ? $OpenBalance: '0';
$Salesman = addslashes(trim($_POST['Salesman']));
$VatNo = addslashes(trim($_POST['VatNo']));

$openDebit = addslashes(trim($_POST['openDebit']));
$openDebit = !empty($openDebit) ? $openDebit: '0';

$disPer = $_POST['disPer'];
$disPer = !empty($disPer) ? $disPer: '0';
$openDate = !empty($openDate) ? $openDate: NULL;






   $insertion = "
 
INSERT INTO [SupplierFile]
           ([Cid]
           ,[CCode]
           ,[CName]
           ,[Description]
           ,[Address]
           ,[Contact1]
           ,[Contact2]
           ,[Fax]
           ,[OpenBalance]
           ,[disPer]
           ,[oempid]
           ,[Is_open_bal]
          ,[grpId]
           ,[openDate]
          
           ,[bid]
           ,[PayDays]
           ,[dateEdit]
           ,[dateAdd]
           ,[openDebit]
            ,[VatNo]
          ,[IsDeleted]
           ,[CCodeOld],[sbid],[NoOfAyan]
           )
     VALUES
           ('".$Cid."'
           ,'".$CCode."'
           ,'".$CName."'
           ,'".$Description."'
           ,'".$Address."'
           ,'".$Contact1."'
           ,'".$Contact2."'
           ,'".$Fax."'
           ,'".$OpenBalance."'
           ,'".$disPer."'
           ,'".$Salesman."'
         
           ,'".$Is_Open_bal."'
           ,'".$grpId."'
       
           ,'$openDate'
          
           ,'".$bid."'
           ,'".$PayDays."'
           ,'".$dateEdit."'
           ,'".$dateAdd."'
           ,'".$openDebit."'
            ,'".$VatNo."'
           
           ,'0'
           ,'".$CCode."','".$bid."','".$NoOfAyan."')
 
 ";

$run = Run($insertion);
if($run)
{
	?>
<script>
toastr.success('Supplier Added Successfully.');
location.reload();

</script>
<?php
}
?>


