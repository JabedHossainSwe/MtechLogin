<?php
session_start();
error_reporting(0);
include("../../config/connection.php");
// include("../../config/functions.php");

$queryForMax = Run("Select max(BillNo) as bno from Payables");
$BillNO = myfetch($queryForMax)->bno+1;
$BillDate = addslashes(trim($_POST['bill_date_time']));
$BillDate = !empty($BillDate) ? $BillDate: date("Y-m-d H:i:s");

$Total = !empty($_POST['total']) ? $_POST['total']: 0;
$disPer = !empty($_POST['disPer']) ? $_POST['disPer']: 0;
$CSID = addslashes(trim($_POST['customer_id']));
$CustomerID = !empty($CSID) ? $CSID: 0;

$query = Run("Select * from ".dbObject."SupplierFile where Cid = '".$CustomerID."'");
$CustomerName = myfetch($query)->CName;
$Discount = !empty($_POST['disAmt']) ? $_POST['disAmt']: 0;
$NetTotal = !empty($_POST['netTotal']) ? $_POST['netTotal']: 0;


$getCurrentEmpData = getCurrentEmpData($_SESSION['storeCode']);
$UID = $getCurrentEmpData->Cid;
$Bid = $getCurrentEmpData->BID;

//$aab = "select sum(Credit-Debit) as custBalance from V_CustBalance where cid='".$CustomerID."' and bid = '".$Bid."'";
//$query1 = Run($aab);
//$custBalance = myfetch($query1)->custBalance;
//$customer_Balance = round($custBalance,2);

 $aab = "	EXEC " . dbObject . "GetSupplierBalalance @bid='$Bid',@dt='',@dt2='',@Cids='$CustomerID',@LanguageId ='2',@IsIncludingZeroBal ='1',@OrderBy ='CCode',@DataType=3,@FRecNo=0,@ToRecNo=15  ";

$query1 = Run($aab);
$custBalance = myfetch($query1)->Balance;
$customer_Balance = round($custBalance,2);

$Cbal = $customer_Balance-$Total;





$sbid = "2";
$bQ = Run("Select * from " . dbObject . "Branch where Bid = '".$Bid."'");
$getBData = myfetch($bQ);
if($getBData->ismain=='1')
{
$sbid = "1";
}


$posid = "1";
$RefNo1 = $_POST['RefNo1'];
$RefNo1 = !empty($RefNo1) ? $RefNo1: '0';

$EmpID = $_POST['EmpID'];
$UserID = !empty($EmpID) ? $EmpID: '0';

$salesMan = addslashes(trim($_POST['EmpID']));
$SalesmanID = !empty($salesMan) ? $salesMan: '0';

$bnkid = !empty($_POST['bnkid']) ? $_POST['bnkid']: '0';

$sbBillno = $BillNO."-S".$sbid."-M".$Bid;
$prePareInsert = "INSERT INTO Payables
(BillNo,BillDate,Comment ,Total,CustomerID ,RecNo ,CustomerName,[Discount%],Discount ,NetTotal ,BId,PayType ,UserID,SalesmanID,AccTransID ,AccFiscalYear,AccCompanyId,bnkid,IsPublished,sbid,sbBillno,IsDeleted,Cbal)
VALUES
(".$BillNO.",'".$BillDate."','".$RefNo1."' ,'".$Total."','".$CustomerID."' ,'' ,'".$CustomerName."','".$disPer."','".$Discount."' ,'".$NetTotal."' ,'".$Bid."','1' ,'".$_SESSION['id']."','".$SalesmanID."','' ,'','','".$bnkid."','0','".$sbid."','".$sbBillno."','','".$Cbal."')";
$FIns = Run($prePareInsert);
//////////// Details Data///////////////

$counter =1;
$AutoNo =1;
$nrows = $_POST['nrows'];

while($counter<$nrows)
{
$InvoiceNo =  !empty($_POST['InvoiceNo'.$counter]) ? $_POST['InvoiceNo'.$counter]: '0';	

$InvoiceDate  = !empty($_POST['InvoiceDate'.$counter]) ? $_POST['InvoiceDate'.$counter]: '';		

$billAmount  = !empty($_POST['billAmount'.$counter]) ? $_POST['billAmount'.$counter]: '0';

$salSubInv  = !empty($_POST['sbBillno'.$counter]) ? $_POST['sbBillno'.$counter]: '';

$payingAmount  = !empty($_POST['payingAmount'.$counter]) ? $_POST['payingAmount'.$counter]: '0';



$Remaining  = !empty($_POST['Remaining'.$counter]) ? $_POST['Remaining'.$counter]: '0';




if($payingAmount>0)
{

/// Multiple Insertions//////////

$queryII  = "INSERT INTO [PayablesDetails]
([BillNO],[BillDate],[CustomerID],[InvoiceNo],[InvoiceDate],[PaidAmount],[RecNo],[CustomerName],[AutoNo],[BId],[PayType] ,[UserID],[SalesmanID],[invAmount] ,[IsPublished],[pRetAmt],[sbid],[sbBillno] ,[salSubInv],[IsDeleted],[prevPaidAmount],[balAmount]) 
Values
(".$BillNO.",'".$BillDate."','".$CustomerID."','".$InvoiceNo."','".$InvoiceDate."','".$payingAmount."','','".$CustomerName."','1','".$Bid."','1' ,'".$_SESSION['id']."','".$SalesmanID."','".$billAmount."' ,'0','','".$sbid."','".$sbBillno."' ,'".$salSubInv."','0','".$payingAmount."','".$Remaining."')";
$F2 = Run($queryII);

$AutoNo++;	

}



$counter++;	
}
if($nrows==1)
{
$NetTotal = !empty($_POST['netTotal']) ? $_POST['netTotal']: 0;

$queryII  = "INSERT INTO [PayablesDetails]
([BillNO],[BillDate],[CustomerID],[InvoiceNo],[InvoiceDate],[PaidAmount],[RecNo],[CustomerName],[AutoNo],[Bid],[PayType] ,[UserID],[SalesmanID],[invAmount] ,[IsPublished],[pRetAmt],[sbid],[sbBillno] ,[salSubInv],[IsDeleted]) 
Values
(".$BillNO.",'".$BillDate."','".$CustomerID."','0',NULL,'".$NetTotal."','','".$CustomerName."','".$AutoNo."','".$Bid."','99' ,'".$_SESSION['id']."','".$SalesmanID."','".$billAmount."' ,'0','','".$sbid."','".$sbBillno."' ,'".$salSubInv."','')";
$F2 = Run($queryII);	


}

?>







<script>
toastr.success('Issue Payment Saved Successfully.');
location.reload();


</script>


