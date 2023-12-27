<?php
session_start();
error_reporting(0);
include("../../config/connection.php");


$quer = 'select max(Cid) as Cid from CustFile';
$executes = Run($quer);
$Cid = myfetch($executes)->Cid + 1;

$que = 'SELECT TOP (1) CCode from CustFile order by Cid desc';
$execute = Run($que);
$CCode = myfetch($execute)->CCode + 1;
$Is_Open_bal = '0';
if ($OpenBalance > 0) {
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
$Fax = !empty($Fax) ? $Fax : '0';

$Email = addslashes(trim($_POST['Email']));
$CRNo = addslashes(trim($_POST['CRNo']));
$CRNo = !empty($CRNo) ? $CRNo : '0';

$NANRegAdd = addslashes(trim($_POST['NANRegAdd']));
$NANRegAdd = !empty($NANRegAdd) ? $NANRegAdd : '0';

$sSize = addslashes(trim($_POST['sSize']));
$sSize = !empty($sSize) ? $sSize : '0';

$OpenBalance = addslashes(trim($_POST['OpenBalance']));
$custAreaId = addslashes(trim($_POST['custAreaId']));
$custDisPer = addslashes(trim($_POST['custDisPer']));
$CreditDays = addslashes(trim($_POST['CreditDays']));
$CreditDays = !empty($CreditDays) ? $CreditDays : '0';
$OpenBalance = !empty($OpenBalance) ? $OpenBalance : '0';
$Salesman = addslashes(trim($_POST['Salesman']));
$VatNo = addslashes(trim($_POST['VatNo']));
$VatNo = !empty($VatNo) ? $VatNo : '0';

$BuildNo = addslashes(trim($_POST['BuildNo']));
$BuildNo = !empty($BuildNo) ? $BuildNo : '0';

$StreetName = addslashes(trim($_POST['StreetName']));
$District = addslashes(trim($_POST['District']));
$CityN = addslashes(trim($_POST['CityN']));
$CountryN = addslashes(trim($_POST['CountryN']));
$PostalCode = addslashes(trim($_POST['PostalCode']));
$AdditionalNo = addslashes(trim($_POST['AdditionalNo']));
$Currency = addslashes(trim($_POST['Currency']));

$openDebit = addslashes(trim($_POST['openDebit']));
$openDebit = !empty($openDebit) ? $openDebit : '0';

$CustomerPaymentDiscount = $_POST['CustomerPaymentDiscount'];
$CustomerPaymentDiscount = !empty($CustomerPaymentDiscount) ? $CustomerPaymentDiscount : '0';
$openDate = !empty($openDate) ? $openDate : null;

$sbid = "2";
$bQ = Run("Select * from " . dbObject . "Branch where Bid = '" . $bid . "'");
$getBData = myfetch($bQ);
if ($getBData->ismain == '1') {
  $sbid = "1";
}

$defCode = $Cid . "-S" . $sbid . "-M" . $bid;




echo $insertion = "
 
INSERT INTO [CustFile]
           ([Cid]
           ,[CCode]
           ,[CName]
           ,[Description]
           ,[Address]
           ,[Contact1]
           ,[Contact2]
           ,[Fax]
           ,[OpenBalance]
           ,[CustomerPaymentDiscount]
           ,[Salesman]
           ,[Email]
           ,[Is_Open_bal]
           ,[CreditLimit]
           ,[custAreaId]
           ,[openDate]
           ,[custDisPer]
           ,[bid]
           ,[crdDays]
           ,[dateEdit]
           ,[dateAdd]
           ,[openDebit]
            ,[VatNo]
           ,[sSize]
           ,[IsDeleted]
            ,[CRNo]
           ,[NANRegAdd]
           ,[BuildNo]
           ,[StreetName]
           ,[District]
           ,[CityN]
           ,[CountryN]
           ,[PostalCode]
           ,[AdditionalNo],[CCodeOld],[sbid]
           )
     VALUES
           ('" . $Cid . "'
           ,'" . $CCode . "'
           ,'" . $CName . "'
           ,'" . $Description . "'
           ,'" . $Address . "'
           ,'" . $Contact1 . "'
           ,'" . $Contact2 . "'
           ,'" . $Fax . "'
           ,'" . $OpenBalance . "'
           ,'" . $CustomerPaymentDiscount . "'
           ,'" . $Salesman . "'
           ,'" . $Email . "'
           ,'" . $Is_Open_bal . "'
           ,'" . $CreditDays . "'
           ,'" . $custAreaId . "'
           ,'$openDate'
           ,'" . $custDisPer . "'
           ,'" . $bid . "'
           ,'" . $CreditDays . "'
           ,'" . $dateEdit . "'
           ,'" . $dateAdd . "'
           ,'" . $openDebit . "'
            ,'" . $VatNo . "'
           ,'" . $sSize . "'
           ,'0'
            ,'" . $CRNo . "'
           ,'" . $NANRegAdd . "'
           ,'" . $BuildNo . "'
           ,'" . $StreetName . "'
           ,'" . $District . "'
           ,'" . $CityN . "'
           ,'" . $CountryN . "'
           ,'" . $PostalCode . "'
           ,'" . $AdditionalNo . "','" . $defCode . "','" . $sbid . "')
 
 ";
$run = Run($insertion);
if ($run) {
  ?>
  <script>
    toastr.success('Customer Added Successfully.');
    location.reload();

  </script>
  <?php
}
?>