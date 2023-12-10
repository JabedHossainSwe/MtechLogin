<?php
session_start();
error_reporting(0);
include("../../config/connection.php");
$Pcode = addslashes(trim($_POST['Pcode']));
$query = Run("Select * from " . dbObject . "Product where Pcode = '" . $Pcode . "'");
$fetch = myfetch($query);
$product_name = $fetch->PName;

$Bid = addslashes(trim($_POST['Bid']));
$unit = addslashes($_POST['unit']);
$unit_id = addslashes($_POST['unit_id']);
$qty = addslashes($_POST['qty']);

$row_count = addslashes($_POST['row_count']);

$region = $_SESSION['region'];
if ($region == '1') {
    $sp = "EXECUTE " . dbObject . "GetProductSearchByCode @pCode='$Pcode' ,@bid='$Bid'";
}
if ($region == "2") {
    $sp = "EXECUTE " . dbObject . "Getproductsearchbycodeweb @pCode='$Pcode' ,@bid='$Bid'";
}

$QueryMax = Run($sp);
$getDetails = myfetch($QueryMax);
$product = $getDetails->pname;
$Pid = $getDetails->pid;
?>

<tr id="row_<?php echo $row_count ?>">
    <td><?= $row_count ?></td>
    <td><input type="hidden" name="code<?php echo $row_count ?>" id="code<?php echo $row_count ?>" value="<?php echo $Pcode ?>"><?php echo $Pcode ?></td>
    <td><input type="hidden" name="product_name<?php echo $row_count ?>" id="product_name<?php echo $row_count ?>" value="<?php echo $product_name ?>"><?php echo $product_name ?></td>
    <td><input type="hidden" name="unit<?php echo $row_count ?>" id="unit<?php echo $row_count ?>" value="<?php echo $unit_id ?>"><?php echo $unit ?></td>
    <td><input type="hidden" name="qty<?php echo $row_count ?>" class="t_qty" id="qty<?php echo $row_count ?>" value="<?php echo $qty ?>"><?php echo $qty ?></td>
    <td><i class="fa fa-pencil" onclick="edit_row(<?php echo $row_count ?>)"></i>&nbsp;&nbsp;&nbsp;<i class="fa fa-trash" onclick="delete_row(<?php echo $row_count ?>)"></i></td>

    <input type="hidden" name="Pid<?php echo $row_count ?>" id="Pid<?php echo $row_count ?>" value="<?= $Pid ?>">
    <input type="hidden" name="PCode<?php echo $row_count ?>" id="PCode<?php echo $row_count ?>" value="<?php echo $Pcode ?>">
    <input type="hidden" name="unit<?php echo $row_count ?>" id="unit<?php echo $row_count ?>" value="<?php echo $unit ?>">
    <input type="hidden" name="Uid<?php echo $row_count ?>" id="Uid<?php echo $row_count ?>" value="<?php echo $unit_id ?>">
    <input type="hidden" name="autono<?php echo $row_count ?>" id="autono<?php echo $row_count ?>" value="<?php echo $row_count ?>">

</tr>

<script>
    $(document).ready(function() {
        salesTotalCalculation()
    });
</script>