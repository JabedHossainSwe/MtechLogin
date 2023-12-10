<?php
session_start();
error_reporting(0);
include("../../config/connection.php");


$CCode = $_POST['CCode'];
$bid = $_POST['bid'];




  $insertion = "
 
update [CustFile] set 
          
           [IsDeleted] = '1'
           
		   where bid = '".$bid."' and CCode = '".$CCode."'
    
          
    
     
            
 
 ";

$run = Run($insertion);
if($run)
{
	?>
<script>
toastr.success('Customer Deleted Successfully.');
	location.reload();

</script>
<?php
}
?>


