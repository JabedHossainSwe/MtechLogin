<?php
$servername = $_SERVER['SERVER_NAME'];

if($servername=='localhost')
{
define('API_URL', 'http://localhost/Mtech/Api/');
}
else
{
	define('API_URL', 'http://154.53.40.18:8080/Mtech/Api/');

}




function AmountValue($vv)
{
	if(is_numeric($vv))
	{
	$vv =  number_format($vv,3);
	}
	return $vv;
}

function DateValue($vv)
{
	if(!empty($vv)){
		return date("d M,Y",strtotime($vv));
	}
	else{
		return $vv;
	}

	
}
function DateValueTime($vv)
{
	if(!empty($vv)){
		return date("d M,Y h:i:s",strtotime($vv));
	}
	else{
		return $vv;
	}
}
function getLanguage($user)
{
	return "1";
}

function submit_request($action,$data)
{
$data['PosId'] = "2";
// API URL
$url = API_URL.$action;
// Create a new cURL resource
$ch = curl_init($url);
$payload = json_encode($data);

//echo $url ;
//echo "<br/>";
//echo $payload;
//echo "<br/>";
//	die();

// Attach encoded JSON string to the POST fields
curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);
// Set the content type to application/json
curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
// Return response instead of outputting
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
// Execute the POST request
$result = curl_exec($ch);
//var_dump($result);
// Close cURL resource
curl_close($ch);
$response = json_decode($result);


//print_r($result);


//print_r($response);


return $response;
}


function GetSalesGroup($branchIdsh, $transaction_type, $from_bill_no, $to_bill_no, $from_date, $to_date, $customer_id, $user_id, $UsrId,$from_product_id , $to_product_id, $product_group_id, $amount, $selected_lang,$amount_type)
{
$data = array();
$data['bid']=$branchIdsh;
$data['SpType']=$transaction_type;
$data['FBillno']=$from_bill_no;
$data['TBillno']=$to_bill_no;
$data['dt']=$from_date;
$data['dt2']=$to_date;
$data['CustSupId']=$customer_id;
$data['EmpId']=$user_id;
$data['UsrId']=$UsrId;
$data['FPid']=$from_product_id;
$data['TPrid']=$to_product_id;
$data['PGroupId']=$product_group_id;
$data['CrAmount']=$amount;
$data['LanguageId']=$selected_lang;
$data['amount_type']=$amount_type;
$response = submit_request('reports/getSalesReportGroup',$data);	
return $response->data;	
}




function GetSalesGen($branchIdsh, $transaction_type, $from_bill_no, $to_bill_no, $from_date, $to_date, $customer_id, $user_id, $UsrId,$from_product_id , $to_product_id, $product_group_id, $amount, $selected_lang,$amount_type,$GroupByType,$OrderBy)
{
$data = array();
$data['bid']=$branchIdsh;
$data['SpType']=$transaction_type;
$data['FBillno']=$from_bill_no;
$data['TBillno']=$to_bill_no;
$data['dt']=$from_date;
$data['dt2']=$to_date;
$data['CustSupId']=$customer_id;
$data['EmpId']=$user_id;
$data['UsrId']=$UsrId;
$data['FPid']=$from_product_id;
$data['TPrid']=$to_product_id;
$data['PGroupId']=$product_group_id;
$data['CrAmount']=$amount;
$data['LanguageId']=$selected_lang;
$data['amount_type']=$amount_type;
$data['GroupByType']=$GroupByType;
$data['OrderBy']=$OrderBy;
$response = submit_request('reports/GetSalesGen',$data);	
return $response->data;	
}







function GetSalesDet($branchIdsh, $transaction_type, $from_bill_no, $to_bill_no, $from_date, $to_date, $customer_id, $user_id, $UsrId,$from_product_id , $to_product_id, $product_group_id, $amount, $selected_lang,$amount_type,$OrderBy)
{
$data = array();
$data['bid']=$branchIdsh;
$data['SpType']=$transaction_type;
$data['FBillno']=$from_bill_no;
$data['TBillno']=$to_bill_no;
$data['dt']=$from_date;
$data['dt2']=$to_date;
$data['CustSupId']=$customer_id;
$data['EmpId']=$user_id;
$data['UsrId']=$UsrId;
$data['FPid']=$from_product_id;
$data['TPrid']=$to_product_id;
$data['PGroupId']=$product_group_id;
$data['CrAmount']=$amount;
$data['LanguageId']=$selected_lang;
$data['amount_type']=$amount_type;
$data['OrderBy']=$OrderBy;
$response = submit_request('reports/GetSalesDet',$data);	
return $response->data;	
}







function getBranches()
{
$data = array();
$response = submit_request('reports/getBranches',$data);	
return $response->data;	
}


function getCustomerDetails($id)
{
$query = Run("Select * from ".dbObject."CustFile where Cid = '".$id."'");
$fetch = myfetch($query);
return $fetch;	
}

function getUserDetails($id)
{
$query = Run("Select * from ".dbObject."Emp where Cid = '".$id."'");
$fetch = myfetch($query);
return $fetch;	
}

function getSupplierDetails($id)
{
$query = Run("Select * from ".dbObject."SupplierFile where Cid = '".$id."'");
$fetch = myfetch($query);
return $fetch;	
}

function getSupplierNameDetails($name)
{
$query = Run("Select * from ".dbObject."SupplierFile where CName = '".$name."'");
$fetch = myfetch($query);
return $fetch;	
}


function getExpenseIdDetails($id)
{
$query = Run("Select * from ".dbObject."Expense where GId = '".$id."'");
$fetch = myfetch($query);
return $fetch;	
}



function getProductDetails($id)
{
$query = Run("Select Pid Id,Pcode + ' - ' + Pname CName from ".dbObject."Product where Pid = '".$id."'");
$fetch = myfetch($query);
return $fetch;	
}

function getPurchaseTypeDetails($id)
{
$query = Run("Select * from ".dbObject."Pur_Type where Cid = '".$id."'");
$fetch = myfetch($query);
return $fetch;	
}






function getProductGroupDetails($id)
{
$query = Run("Select Gid  Id,Code + ' - ' + NameArb CName from ".dbObject."productgroup where Gid = '".$id."'");
$fetch = myfetch($query);
return $fetch;	
}
function getProductUnitDetails($id)
{
$query = Run("Select * from ".dbObject."Units where ParaID = '".$id."'");
$fetch = myfetch($query);
return $fetch;	
}

function getProductUnitName($id)
{
$query = Run("Select * from ".dbObject."Units where ParaName = '".$id."'");
$fetch = myfetch($query);
return $fetch;	
}


function getSupplierGroupDetails($id)
{
$query = Run("select TOP 5 Cid Id,CCode + ' - ' + Cname CName  from  ".dbObject."ProductType where Cid = '".$id."'");
$fetch = myfetch($query);
return $fetch;	
}

function GetProductType($id)
{
$query = Run("Select Gid  Id,Code + ' - ' + NameArb CName from ".dbObject."SupplierGroup where Gid = '".$id."'");
$fetch = myfetch($query);
return $fetch;	
}


function GetBranchDetils($id)
{
$query = Run("Select * from ".dbObject."Branch where Bid = '".$id."'");
$fetch = myfetch($query);
return $fetch;	
}

function GetBankDetils($id)
{
$query = Run("Select * from ".dbObject."Bank where id = '".$id."'");
$fetch = myfetch($query);
return $fetch;	
}



function GetBranchId($name)
{
$query = Run("Select * from ".dbObject."Branch where BName = '".$name."'");
$fetch = myfetch($query);
return $fetch->Bid;	
}

function GetMainBranch()
{
$query = Run("Select * from ".dbObject."Branch where isMain = 1");
$fetch = myfetch($query);
return $fetch->Bid;	
}

function ProductStockConditionCriteria()
{
$array = array();
	
array_push($array, ['id' => 1,'name'=>'Balance']);	
array_push($array, ['id' => 2,'name'=>'OpenQty']);		
array_push($array, ['id' => 3,'name'=>'CarryForwordBalance']);
	
array_push($array, ['id' => 4,'name'=>'Purchase']);
	
array_push($array, ['id' => 5,'name'=>'Purchase Return']);	
	
array_push($array, ['id' => 6,'name'=>'Stock Out']);	

array_push($array, ['id' => 7,'name'=>'Sales']);	
array_push($array, ['id' => 8,'name'=>'Sales Return']);	
	
array_push($array, ['id' => 9,'name'=>'BranchTransfer']);	
	
	
array_push($array, ['id' => 10,'name'=>'BranchTransferReceived']);	
		
	
array_push($array, ['id' => 11,'name'=>'Production']);		
	
	
array_push($array, ['id' => 12,'name'=>'Production Rawmeterial']);		

array_push($array, ['id' => 13,'name'=>'Production De-Composit']);	
	
	
array_push($array, ['id' => 14,'name'=>'Production De-Composit Rawmeterial']);	

	
array_push($array, ['id' => 15,'name'=>'StockReceivingQty']);	
	
	
array_push($array, ['id' => 16,'name'=>'DeliveryQTy']);	
		
	
array_push($array, ['id' => 17,'name'=>'SalQtyIn']);	
		
array_push($array, ['id' => 18,'name'=>'SalQtyOut']);	
return $array;	
}
function getCurrentEmpData($webCode)
{
$query  = Run("select * from ".dbObject."Emp where webCode='".$webCode."'");
	return $getdata = myfetch($query);
}

function getArabicTitle($str)
{
$translationsArray = $_SESSION['language_array'];
foreach ($translationsArray as $translation) {
if ($translation['english'] === $str) {
	if(!empty($translation['arabic'])){
		return $translation['arabic'];
	}
	else{
		// Return a default value or handle the case when the Arabic key is not found
		return $str;
	}
}
}
return $str;

}

function EmailSend($to,$subject,$message,$from)
{
$from = "Mtechsols.pak@gmail.com";	
$header = "From:".$from." \r\n";
$header .= "MIME-Version: 1.0\r\n";
$header .= "Content-type: text/html\r\n";
$retval = mail ($to,$subject,$message,$header);
$variable = "Email Sending Error";
if($retval == true) {
$variable = "Email Sent";
}
return $variable;
}
?>