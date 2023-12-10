<?php
session_start();
error_reporting(0);
include("../../config/main_connection.php");
include("../../config/connection.php");
if($_POST)
{

$id = addslashes($_POST['id']);


$status = addslashes($_POST['status']);	
$updation = "
update ".dbObjectMain."Logins set
status='".$status."' where id = '".$id."'
";
$insert = RunMain($updation)	;
}
?>
<script>
toastr.success('User Status Updated Successfully.');
document.getElementById('closed').click();
loadEmployees();


</script>