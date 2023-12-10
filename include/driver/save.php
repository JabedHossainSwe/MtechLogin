<?php
session_start();
error_reporting(0);
include("../../config/connection.php");
// include("../../config/functions.php");
$code = $_POST['Code'];
$nameEng = $_POST['Name'];
$nameArb = '';

$quer = 'select max(id) as id from driver';
$executes = Run($quer);
$id = myfetch($executes)->id+1;

$ins_product = "insert into " . dbObject . "driver (Id, Code,NameArb,NameEng) values ('" . $id . "','" . $code . "','" . $nameArb . "','" . $nameEng . "')";
$inn = Run($ins_product);

if($inn){
?>

<script>
	toastr.success('Driver Added Successfully.');
	location.reload();
</script>

<?php
}
?>