<?php
// print_r($_POST);
// die();
session_start();
error_reporting(0);
include("../../config/connection.php");
// include("../../config/functions.php");
$Bid = addslashes(trim($_POST['Bid']));
$Billno = addslashes(trim($_POST['Billno']));
$sBid = addslashes(trim($_POST['sBid']));
$Bid = !empty($Bid) ? $Bid : '2';
$Billno = !empty($Billno) ? $Billno : '0';
$Billno = (int)$Billno;
$sBid = !empty($sBid) ? $sBid : '1';

$row_count = 1;
$tt = "EXECUTE " . dbObject . "[SPOpenQuantityDetSelectWeb] @Billno=$Billno, @Bid=$Bid, @sBid=$sBid, @SrchBy=1, @FRecNo=1, @ToRecNo=100";
// die();
$detailsSp = Run($tt);
while ($getDetails = myfetch($detailsSp)) {
    // print_r($getDetails);
    // echo $getDetails->$ParaName;
    // die();
    $Pcode = $getDetails->PCode;
    $Pid = $getDetails->Pid;
    $product = $getDetails->PName;
    $unit = $getDetails->ParaName;
    $qty = $getDetails->Qty;
    $Sprice = round($getDetails->Price, 2);
    $vatAmt = round($getDetails->vatAmt, 2);
    $vatPer = $getDetails->vatPer;
    $vatSprice = round($getDetails->vatPTotal, 2);
    $unit_id = $getDetails->uid;
    $oldQty = $getDetails->OldQuantity;    
    $newQty = $getDetails->NewQuantity;
    $netTotal = $getDetails->NetTotal;
    // die();

    $query = Run("Select * from " . dbObject . "Product where Pcode = '" . $Pcode . "'");
    $fetch = myfetch($query);
    $product_name = $fetch->PName;

    $unit_id = getProductUnitName($unit)->ParaID;

?>

    <tr id="row_<?php echo $row_count ?>">
        <td><?= $row_count ?></td>
        <td><input type="hidden" name="code<?php echo $row_count ?>" id="code<?php echo $row_count ?>" value="<?php echo $Pcode ?>"><?php echo $Pcode ?></td>
        <td><input type="hidden" name="product_name<?php echo $row_count ?>" id="product_name<?php echo $row_count ?>" value="<?php echo $product_name ?>"><?php echo $product_name ?></td>
        <td><input type="hidden" name="unit<?php echo $row_count ?>" id="unit<?php echo $row_count ?>" value="<?php echo $unit_id ?>"><?php echo $unit ?></td>
        <td><input type="hidden" name="oldQty<?php echo $row_count ?>" class="t_oldQty" id="oldQty<?php echo $row_count ?>" value="<?php echo $oldQty ?>"><?php echo $oldQty ?></td>
        <td><input type="hidden" name="newQty<?php echo $row_count ?>" class="t_newQty" id="newQty<?php echo $row_count ?>" value="<?php echo $newQty ?>"><?php echo $newQty ?></td>
        <td>
            <input type="hidden" name="Sprice<?php echo $row_count ?>" class="t_Sprice" id="Sprice<?php echo $row_count ?>" value="<?php echo $Sprice ?>"><?php echo $Sprice ?>
        </td>
        <td>
            <input type="hidden" name="netT<?php echo $row_count ?>" id="netT<?php echo $row_count ?>" value="<?php echo $netTotal; ?>" class="tot_Sprice"><?php echo $netTotal; ?>
        </td>

        <td><i class="fa fa-pencil" onclick="edit_row(<?php echo $row_count ?>)"></i>&nbsp;&nbsp;&nbsp;<i class="fa fa-trash" onclick="delete_row(<?php echo $row_count ?>)"></i></td>

        <input type="hidden" name="Pid<?php echo $row_count ?>" id="Pid<?php echo $row_count ?>" value="<?= $Pid ?>">
        <input type="hidden" name="PCode<?php echo $row_count ?>" id="PCode<?php echo $row_count ?>" value="<?php echo $Pcode ?>">
        <input type="hidden" name="unit<?php echo $row_count ?>" id="unit<?php echo $row_count ?>" value="<?php echo $unit ?>">
        <input type="hidden" name="Uid<?php echo $row_count ?>" id="Uid<?php echo $row_count ?>" value="<?php echo $unit_id ?>">
        <input type="hidden" name="autono<?php echo $row_count ?>" id="autono<?php echo $row_count ?>" value="<?php echo $row_count ?>">

    </tr>

    <script>
        $(document).ready(function() {
            // salesTotalCalculation();
            $("#row_count").val(<?php echo $row_count ?>);
        });
    </script>


<?php
    $row_count++;
}
?>