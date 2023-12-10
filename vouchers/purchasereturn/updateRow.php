<?php
session_start();
error_reporting(0);
include("../../config/connection.php");
$code = addslashes($_POST['code']);
$product = addslashes($_POST['product']);


$query = Run("Select * from ".dbObject."Product where Pcode = '".$code."'");
$fetch = myfetch($query);
$product_name = $fetch->PName;
$Pid = addslashes($_POST['Pid']);
$altCode = addslashes($_POST['altCode']);



$unit = addslashes($_POST['unit']);
$unit_name = addslashes($_POST['unit_name']);
$qty = addslashes($_POST['qty']);
$price = addslashes($_POST['price']);
$total = addslashes($_POST['total']);
$exp_date = addslashes($_POST['exp_date']);
$disPer = addslashes($_POST['disPer']);
$disAmt = addslashes($_POST['disAmt']);
$net_total = addslashes($_POST['net_total']);
$grand_total = addslashes($_POST['grand_total']);
$adv_tax_per = addslashes($_POST['adv_tax_per']);
$adv_amt = addslashes($_POST['adv_amt']);
$g_grand_total = addslashes($_POST['g_grand_total']);
$row_count = addslashes($_POST['row_count']);
$bonus = addslashes($_POST['bonus']);
$cpp = addslashes($_POST['cpp']);
$acp = addslashes($_POST['acp']);
$SPrice = addslashes($_POST['SPrice']);
$lprice = addslashes($_POST['lprice']);
$vatPer = addslashes($_POST['vatPer']);
$vatAmt = addslashes($_POST['vatAmt']);
$vattotal = addslashes($_POST['vattotal']);
$row_count = addslashes($_POST['row_count']);
$vatSprice = addslashes($_POST['vatSprice']);
$SCPer = addslashes($_POST['SCPer']);
$level3 = addslashes($_POST['level3']);
$LSPrice = addslashes($_POST['LSPrice']);
?>

    <td><?=$row_count?></td>
    <td><input type="hidden" name="code<?php echo $row_count ?>" id="code<?php echo $row_count ?>" value="<?php echo $code ?>"><?php echo $code ?></td>
    <td><input type="hidden" name="product_name<?php echo $row_count ?>" id="product_name<?php echo $row_count ?>" value="<?php echo $product_name ?>"><?php echo $product_name ?></td>
    <td><input type="hidden" name="unit_name<?php echo $row_count ?>" id="unit_name<?php echo $row_count ?>" value="<?php echo $unit_name ?>"><?php echo $unit_name ?></td>
    <td><input type="hidden" name="qty<?php echo $row_count ?>" class="t_qty" id="qty<?php echo $row_count ?>" value="<?php echo $qty ?>"><?php echo $qty ?></td>
    <td><input type="hidden" name="bonus<?php echo $row_count ?>" class="t_bonus" id="bonus<?php echo $row_count ?>" value="<?php echo $bonus ?>"><?php echo $bonus ?></td>
    <td><input type="hidden" name="price<?php echo $row_count ?>" class="t_price" id="price<?php echo $row_count ?>" value="<?php echo $price ?>"><?php echo $price ?></td>
    <td><input type="hidden" name="total<?php echo $row_count ?>" class="t_total" id="total<?php echo $row_count ?>" value="<?php echo $total ?>"><?php echo $total ?></td>

    <td><input type="hidden" name="disPer<?php echo $row_count ?>" class="t_disPer" id="disPer<?php echo $row_count ?>" value="<?php echo $disPer ?>"><?php echo $disPer ?></td>
    <td><input type="hidden" name="disAmt<?php echo $row_count ?>" class="t_disAmt" id="disAmt<?php echo $row_count ?>" value="<?php echo $disAmt ?>"><?php echo $disAmt ?></td>
    <td><input type="hidden" name="net_total<?php echo $row_count ?>" class="t_net_total" id="net_total<?php echo $row_count ?>" value="<?php echo $net_total ?>"><?php echo $net_total ?></td>
    
    <td><input type="hidden" name="cpp<?php echo $row_count ?>" class="t_cpp" id="cpp<?php echo $row_count ?>" value="<?php echo $cpp ?>"><?php echo $cpp ?></td>
    <td><input type="hidden" name="acp<?php echo $row_count ?>" class="t_acp" id="acp<?php echo $row_count ?>" value="<?php echo $acp ?>"><?php echo $acp ?></td>
    <td><input type="hidden" name="SPrice<?php echo $row_count ?>" class="t_SPrice" id="SPrice<?php echo $row_count ?>" value="<?php echo $SPrice ?>"><?php echo $SPrice ?></td>
    <td><input type="hidden" name="lprice<?php echo $row_count ?>" class="t_lprice" id="lprice<?php echo $row_count ?>" value="<?php echo $lprice ?>"><?php echo $lprice ?></td>
    <td><input type="hidden" name="vatPer<?php echo $row_count ?>" class="t_vatPer" id="vatPer<?php echo $row_count ?>" value="<?php echo $vatPer ?>"><?php echo $vatPer ?></td>
    <td><input type="hidden" name="vatAmt<?php echo $row_count ?>" class="t_vatAmt" id="vatAmt<?php echo $row_count ?>" value="<?php echo $vatAmt ?>"><?php echo $vatAmt ?></td>
    <td><input type="hidden" name="vattotal<?php echo $row_count ?>" class="t_vattotal" id="vattotal<?php echo $row_count ?>" value="<?php echo $vattotal ?>"><?php echo $vattotal ?></td>
    
    <td><input type="hidden" name="grand_total<?php echo $row_count ?>" class="t_grandtotal" id="grand_total<?php echo $row_count ?>" value="<?php echo $grand_total ?>"><?php echo $grand_total ?></td>
  
    <td>
        <i class="fa fa-pencil" onclick="edit_row(<?php echo $row_count ?>)"></i>&nbsp;&nbsp;&nbsp;<i class="fa fa-trash" onclick="delete_row(<?php echo $row_count ?>)"></i>
        <input type="hidden" id="Pid<?php echo $row_count ?>" name="Pid<?php echo $row_count ?>" value="<?=$Pid;?>" >
        <input type="hidden" id="altCode<?php echo $row_count ?>" name="altCode<?php echo $row_count ?>" value="<?=$altCode;?>" >
        <input type="hidden" id="actPrice<?php echo $row_count ?>" name="actPrice<?php echo $row_count ?>" value="">
        <input type="hidden" id="SCPer<?php echo $row_count ?>" name="SCPer<?php echo $row_count ?>" value="<?=$SCPer?>">
        <!-- <input type="hidden" id="EmpID<?php echo $row_count ?>" name="EmpID<?php echo $row_count ?>" value=""> -->
        <!-- <input type="hidden" id="ResEmpID<?php echo $row_count ?>" name="ResEmpID<?php echo $row_count ?>" value=""> -->
        <input type="hidden" id="CPrice<?php echo $row_count ?>" name="CPrice<?php echo $row_count ?>" value="">
        <input type="hidden" id="IsStockCount<?php echo $row_count ?>" name="IsStockCount<?php echo $row_count ?>" value="">
        <input type="hidden" id="vatPTotal<?php echo $row_count ?>" name="vatPTotal<?php echo $row_count ?>" value="">
        <input type="hidden" id="unit<?php echo $row_count ?>" name="unit<?php echo $row_count ?>"  value="<?php echo $unit ?>">
        <input type="hidden" id="vatSprice<?php echo $row_count ?>" name="vatSprice<?php echo $row_count ?>"  value="<?php echo $vatSprice ?>">
        <input type="hidden" id="LSPrice<?php echo $row_count ?>" name="LSPrice<?php echo $row_count ?>"  value="<?php echo $LSPrice ?>">
        <input type="hidden" id="level3<?php echo $row_count ?>" name="level3<?php echo $row_count ?>"  value="<?php echo $level3 ?>">
    </td>

<script>
    $( document ).ready(function() {
        salesTotalCalculation()
    });
</script>