<?php
session_start();
error_reporting(0);
include("../../config/main_connection.php");

include("../../config/connection.php");
if(empty($_SESSION['id']))
{
printf("<script>location.href='index.php?value=logout'</script>");
die();
}

$old_pw = addslashes($_POST['old_pw']);
$new_pw = addslashes($_POST['new_pw']);

$customer_code = $_SESSION['customer_code'];
$qp = Run("Select * from " . dbObjectMain . "Logins where code = '" . $_SESSION['storeCode'] . "'");
 $getUserData = myfetchMain($qp);
 $password = $getUserData->password;
if($password!=$old_pw)
{
?>	
	<script>
document.getElementById('old_pw').focus();

document.getElementById('old_pw_error').innerHTML="* Old Password Missmatch.";
document.getElementById('old_pw').style.border="1px Solid Red";
</script>
<?php
	die();
}
else
{
$qu = RunMain("update ".dbObjectMain."Logins set password = '".$new_pw."' where code = '" . $_SESSION['storeCode'] . "' ");
$qu2 = Run("update emp set Pass = '".$new_pw."' where WebCode = '".$_SESSION['storeCode']."'");


	printf("<script>location.href='profile.php?value=password'</script>");
die();
}



?>
