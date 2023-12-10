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
$CRNo = addslashes(trim($_POST['CRNo']));
$NANRegAdd = addslashes(trim($_POST['NANRegAdd']));
$sSize = addslashes(trim($_POST['sSize']));
$sSize = addslashes(trim($_POST['sSize']));
$OpenBalance = addslashes(trim($_POST['OpenBalance']));
$custAreaId = addslashes(trim($_POST['custAreaId']));
$custDisPer = addslashes(trim($_POST['custDisPer']));
$CreditDays = addslashes(trim($_POST['CreditDays']));
$CreditDays = addslashes(trim($_POST['CreditDays']));
$OpenBalance = !empty($OpenBalance) ? $OpenBalance: '0';
$Salesman = addslashes(trim($_POST['Salesman']));
$VatNo = addslashes(trim($_POST['VatNo']));
$BuildNo = addslashes(trim($_POST['BuildNo']));
$StreetName = addslashes(trim($_POST['StreetName']));
$District = addslashes(trim($_POST['District']));
$CityN = addslashes(trim($_POST['CityN']));
$CountryN = addslashes(trim($_POST['CountryN']));
$PostalCode = addslashes(trim($_POST['PostalCode']));
$AdditionalNo = addslashes(trim($_POST['AdditionalNo']));
$Currency = addslashes(trim($_POST['Currency']));

$openDebit = addslashes(trim($_POST['openDebit']));
$openDebit = !empty($openDebit) ? $openDebit: '0';

$CustomerPaymentDiscount = $_POST['CustomerPaymentDiscount'];
$CustomerPaymentDiscount = !empty($CustomerPaymentDiscount) ? $CustomerPaymentDiscount: '0';
$openDate = !empty($openDate) ? $openDate: null;






  $insertion = "
 
update [CustFile] set 
          
           [CName]='".$CName."'
           ,[Description]='".$Description."'
           ,[Address]='".$Address."'
           ,[Contact1]='".$Contact1."'
           ,[Contact2]='".$Contact2."'
           ,[Fax]='".$Fax."'
           ,[OpenBalance]='".$OpenBalance."'
           ,[CustomerPaymentDiscount]='".$CustomerPaymentDiscount."'
           ,[Salesman]='".$Salesman."'
           ,[Email]='".$Email."'
           ,[Is_Open_bal]='".$Is_Open_bal."'
           ,[CreditLimit]='".$CreditDays."'
           ,[custAreaId]='".$custAreaId."'
           ,[openDate]='$openDate'
           ,[custDisPer]='".$custDisPer."'
           ,[bid]='".$bid."'
           ,[crdDays]='".(int)$CreditDays."'
           ,[dateEdit]='".$dateEdit."'
         
           ,[openDebit]='".$openDebit."'
            ,[VatNo]='".$VatNo."'
           ,[sSize]='".$sSize."'
           
            ,[CRNo]='".$CRNo."'
           ,[NANRegAdd]='".$NANRegAdd."'
           ,[BuildNo]='".$BuildNo."'
           ,[StreetName]='".$StreetName."'
           ,[District]='".$District."'
           ,[CityN]='".$CityN."'
           ,[CountryN]='".$CountryN."'
           ,[PostalCode]='".$PostalCode."'
           ,[AdditionalNo]='".$AdditionalNo."'
           
		   where Cid = '".$Cid."' and CCode = '".$CCode."'
    
          
    
     
            
 
 ";

$run = Run($insertion);
if($run)
{
	?>
<script>
toastr.success('Customer Updated Successfully.');
	var pg = "update_customer.php?CCode=<?=$CCode?>&bid=<?=$bid?>"
loadPage(pg)

</script>
<?php
}
?>


