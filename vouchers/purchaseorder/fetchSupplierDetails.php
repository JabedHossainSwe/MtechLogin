<?php
session_start();
error_reporting(0);
include("../../config/connection.php");
$Cid = addslashes(trim($_POST['Cid']));

$sp = "select * from ".dbObject."SupplierFile where Cid='$Cid'";
$QueryMax = Run($sp);
$getDetails = myfetch($QueryMax);

 $disPer = $getDetails->disPer;
if($disPer=='.00')
{
$disPer = 0;	
}
$PayDays = $getDetails->PayDays;

$todayDate = Date('Y-m-d');
$dueDate = Date('Y-m-d', strtotime($todayDate. ' + '.$PayDays.' days'));

	?>

<script>
    $("#dis_per").val('<?php echo $disPer ?>');
    $("#due").val('<?php echo $PayDays ?>');
    $("#due_date").val('<?php echo $dueDate ?>');
</script>	







