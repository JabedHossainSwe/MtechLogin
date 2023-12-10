<?php
session_start();
error_reporting(0);
include("../../../config/connection.php");
$Bid = addslashes(trim($_POST['Bid']));
$Billno = addslashes(trim($_POST['Billno']));
$Bid = !empty($Bid) ? $Bid : '2';
$Billno = !empty($Billno) ? $Billno : '0';
$Billno = (int)$Billno;
$sBid = !empty($sBid) ? $sBid : '1';
$LanguageId = $_REQUEST['LanguageId'];
$LanguageId = !empty($LanguageId) ? $LanguageId : '1';
?>
<?php
$row_count = 1;
$tt = "EXECUTE " . dbObject . "SPSalDetSelectWeb @Billno=$Billno,@Bid=$Bid,@sBid=$sBid";
$detailsSp = Run($tt);
while ($getDetails = myfetch($detailsSp)) {
	$Pcode = $getDetails->PCode;
	$Pid = $getDetails->pid;
	$product = $getDetails->PName;
	$unit = $getDetails->UnitName;
	$qty = $getDetails->Qty;
	$Sprice = round($getDetails->Price, 2);
	$vatAmt = round($getDetails->vatAmt, 2);
	$vatPer = $getDetails->vatPer;
	$vatSprice = round($getDetails->vatPTotal, 2);
	$unit_id = $getDetails->uid;

	$query = Run("Select * from " . dbObject . "Product where Pcode = '" . $Pcode . "'");
	$fetch = myfetch($query);
	$product_name = $fetch->PName;

	$region = $_SESSION['region'];
	if($region=='1')
	{
	$sp = "EXECUTE ".dbObject."GetProductSearchByCode @pCode='$Pcode' ,@bid='$Bid'";
	}
	if($region=="2")
	{
	$sp = "EXECUTE ".dbObject."Getproductsearchbycodeweb @pCode='$Pcode' ,@bid='$Bid'";
	}
		
	$QueryMax = Run($sp);
	$getDetails = myfetch($QueryMax);
	$product = $getDetails->pname;
	$Pid = $getDetails->pid;

	//// ALl Hidden Fields Calculations///
	$total_with_tax = $qty*$vatSprice;
	$total_without_tax = $qty*$Sprice;
	$NetTotalWithTax = $total_with_tax;
	$NetTotalWithOutTax = $total_without_tax;

?>

<tr id="row_<?php echo $row_count ?>">
    <td><?=$row_count?></td>
    <td><input type="hidden" name="code<?php echo $row_count ?>" id="code<?php echo $row_count ?>" value="<?php echo $Pcode ?>"><?php echo $Pcode ?></td>
    <td><input type="hidden" name="product_name<?php echo $row_count ?>" id="product_name<?php echo $row_count ?>" value="<?php echo $product_name ?>"><?php echo $product_name ?></td>
    <td><input type="hidden" name="unit<?php echo $row_count ?>" id="unit<?php echo $row_count ?>" value="<?php echo $unit_id ?>"><?php echo $unit_id ?></td>
    <td><input type="hidden" name="qty<?php echo $row_count ?>" class="t_qty" id="qty<?php echo $row_count ?>" value="<?php echo $qty ?>"><?php echo $qty ?></td>
    <td>
        <input type="hidden" name="Sprice<?php echo $row_count ?>" class="t_Sprice" id="Sprice<?php echo $row_count ?>" value="<?php echo $Sprice ?>"><?php echo $Sprice ?>
		
				    <input type="hidden" name="totMt<?php echo $row_count ?>" class="t_totMt" id="totMt<?php echo $row_count ?>" value="<?php echo $Sprice*$qty ?>">

    </td>
 
    <td><input type="hidden" name="vatPer<?php echo $row_count ?>" class="t_vat_per" id="vatPer<?php echo $row_count ?>" value="<?php echo $vatPer ?>"><?php echo $vatPer ?></td>
	   <td>
        <input type="hidden" name="vatAmt<?php echo $row_count ?>" class="t_vatAmt" id="vatAmt<?php echo $row_count ?>" value="<?php echo $vatAmt ?>"><?php echo $vatAmt ?>
        <input type="hidden" name="rowvatAmt<?php echo $row_count ?>" id="rowvatAmt<?php echo $row_count ?>" value="<?php echo $vatAmt*$qty ?>" class="form-control tot_rowvatAmt" >
    </td>
    <td>
        <input type="hidden" name="vatSprice<?php echo $row_count ?>" class="t_vatSprice" id="vatSprice<?php echo $row_count ?>" value="<?php echo $vatSprice ?>"><?php echo $vatSprice ?>
        <input type="hidden" name="netT<?php echo $row_count ?>" id="netT<?php echo $row_count ?>" value="<?php echo $Sprice*$qty;?>" class="tot_Sprice"  >

    </td>
  
    <td><i class="fa fa-pencil" onclick="edit_row(<?php echo $row_count ?>)"></i>&nbsp;&nbsp;&nbsp;<i class="fa fa-trash" onclick="delete_row(<?php echo $row_count ?>)"></i></td>

    <input type="hidden" name="Pid<?php echo $row_count ?>" id="Pid<?php echo $row_count ?>" value="<?=$Pid?>">
    <input type="hidden" name="PCode<?php echo $row_count ?>" id="PCode<?php echo $row_count ?>" value="<?php echo $Pcode ?>">
    <input type="hidden" name="unit<?php echo $row_count ?>" id="unit<?php echo $row_count ?>" value="<?php echo $unit ?>">
    <input type="hidden" name="Uid<?php echo $row_count ?>" id="Uid<?php echo $row_count ?>" value="<?php echo $unit_id ?>">
    <input type="hidden" name="autono<?php echo $row_count ?>" id="autono<?php echo $row_count ?>" value="<?php echo $row_count ?>">

</tr>

<script>
    $( document ).ready(function() {
        salesTotalCalculation();
		$("#row_count").val(<?php echo $row_count ?>);
    });
</script>


<?php
	$row_count++;
}
?>