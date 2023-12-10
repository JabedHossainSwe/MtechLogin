<?php
session_start();
error_reporting(0);
include("../../../config/connection.php");
$Bid = addslashes(trim($_POST['Bid']));
$Billno = addslashes(trim($_POST['Billno']));
$Bid = !empty($Bid) ? $Bid : '2';
$Billno = !empty($Billno) ? $Billno : '0';
$Billno = (int)$Billno;
$sBid = "2";
$bQ = Run("Select * from " . dbObject . "Branch where Bid = '" . $Bid . "'");
$getBData = myfetch($bQ);
if ($getBData->ismain == '1') {
    $sBid = "1";
}
$LanguageId = $_REQUEST['LanguageId'];
$LanguageId = !empty($LanguageId) ? $LanguageId : '1';
?>
<?php
$row_count = 1;
$tt = "EXECUTE " . dbObject . "[SPSalQuotationDetSelectWeb]@Billno=$Billno,@Bid=$Bid,@sBid=$sBid";
$detailsSp = Run($tt);
while ($getDetails = myfetch($detailsSp)) {
    $Pcode = $getDetails->PCode;
    $Pid = $getDetails->pid;
    $product = $getDetails->PName;
    $unit = $getDetails->ParaName;
    $qty = $getDetails->Qty;
    $Sprice = round($getDetails->Price, 2);
    $vatAmt = round($getDetails->vatAmt, 2);
    $vatPer = $getDetails->vatPer;
    $vatSprice = round($getDetails->Price, 2) * $qty;
    $unit_id = $getDetails->Uid;
    $total = $getDetails->Total;
    $netTotal = $getDetails->NetTotal;
    $totalVat = $getDetails->totalVat;
    $discount = $getDetails->Discount;
    $DisPer = $getDetails->DisPer;
    $vatTotal = $getDetails->vatTotal;
    $DisPer = $getDetails->DisPer;
    $vatPTotal = $getDetails->vatPTotal;
    $product_name = $getDetails->pname;
    $disAmt = $getDetails->Discount;
    $disPer = round(($disAmt/$total)*100, 2);

    $sprice = ($getDetails->Price * $getDetails->Qty);
    $abx = "Exec " . dbObject . "GetVatValueFromSalPrice @vatPer=$vatPer,@SPrice=$sprice";
    $NewSp = Run($abx);
    $getV = myfetch($NewSp);
    $vatAmt = round($getV->vatAmt, 2);


?>

    <tr id="row_<?php echo $row_count ?>">
        <td><?= $row_count ?></td>
        <td><input type="hidden" name="code<?php echo $row_count ?>" id="code<?php echo $row_count ?>" value="<?php echo $Pcode ?>"><?php echo $Pcode ?></td>
        <td><input type="hidden" name="product_name<?php echo $row_count ?>" id="product_name<?php echo $row_count ?>" value="<?php echo $product_name ?>"><?php echo $product_name ?></td>
        <td><input type="hidden" name="unit<?php echo $row_count ?>" id="unit<?php echo $row_count ?>" value="<?php echo $unit_id ?>"><?php echo $unit ?></td>
        <td><input type="hidden" name="qty<?php echo $row_count ?>" class="t_qty" id="qty<?php echo $row_count ?>" value="<?php echo $qty ?>"><?php echo $qty ?></td>
        <td>
            <input type="hidden" name="Sprice<?php echo $row_count ?>" class="t_Sprice" id="Sprice<?php echo $row_count ?>" value="<?php echo $Sprice ?>">

            <input type="hidden" name="totMt<?php echo $row_count ?>" class="t_totMt" id="totMt<?php echo $row_count ?>" value="<?php echo $Sprice * $qty ?>">

            <?php echo $Sprice ?>
        </td>

        <td><input type="hidden" name="total<?php echo $row_count ?>" class="t_total" id="total<?php echo $row_count ?>" value="<?php echo $total ?>"><?php echo $total ?></td>
        <td><input type="hidden" name="disAmt<?php echo $row_count ?>" class="t_disAmt" id="disAmt<?php echo $row_count ?>" value="<?php echo $disAmt ?>"><?php echo $disAmt ?></td>
        <td><input type="hidden" name="disPer<?php echo $row_count ?>" class="t_disPer" id="disPer<?php echo $row_count ?>" value="<?php echo $disPer ?>"><?php echo $disPer ?></td>
        <td><input type="hidden" name="netTotal<?php echo $row_count ?>" class="t_netTotal" id="netTotal<?php echo $row_count ?>" value="<?php echo $netTotal ?>"><?php echo $netTotal ?></td>
        <td><input type="hidden" name="vatPer<?php echo $row_count ?>" class="t_vat_per" id="vatPer<?php echo $row_count ?>" value="<?php echo $vatPer ?>"><?php echo $vatPer ?></td>
        <td>
            <input type="hidden" name="vatAmt<?php echo $row_count ?>" class="t_vatAmt" id="vatAmt<?php echo $row_count ?>" value="<?php echo $vatAmt ?>"><?php echo $vatAmt ?>
            <input type="hidden" name="rowvatAmt<?php echo $row_count ?>" id="rowvatAmt<?php echo $row_count ?>" value="<?php echo $vatAmt * $qty ?>" class="form-control tot_rowvatAmt">
        </td>
        <td><input type="hidden" name="vatTotal<?php echo $row_count ?>" class="t_vat_per" id="vatTotal<?php echo $row_count ?>" value="<?php echo $vatTotal ?>"><?php echo $vatTotal ?></td>
        <td>
            <input type="hidden" name="vatSprice<?php echo $row_count ?>" class="t_vatSprice" id="vatSprice<?php echo $row_count ?>" value="<?php echo $vatPTotal ?>"><?php echo $vatPTotal ?>
            <input type="hidden" name="netT<?php echo $row_count ?>" id="netT<?php echo $row_count ?>" value="<?php echo $Sprice * $qty; ?>" class="tot_Sprice">

        </td>

        <td><i class="fa fa-pencil" onclick="edit_row(<?php echo $row_count ?>)"></i>&nbsp;&nbsp;&nbsp;<i class="fa fa-trash" onclick="delete_row(<?php echo $row_count ?>)"></i></td>

        <input type="hidden" name="Pid<?php echo $row_count ?>" id="Pid<?php echo $row_count ?>" value="<?= $Pid ?>">
        <input type="hidden" name="PCode<?php echo $row_count ?>" id="PCode<?php echo $row_count ?>" value="<?php echo $Pcode ?>">
        <input type="hidden" name="unit<?php echo $row_count ?>" id="unit<?php echo $row_count ?>" value="<?php echo $unit ?>">
        <input type="hidden" name="Uid<?php echo $row_count ?>" id="Uid<?php echo $row_count ?>" value="<?php echo $unit_id ?>">
        <input type="hidden" name="autono<?php echo $row_count ?>" id="autono<?php echo $row_count ?>" value="<?php echo $row_count ?>">

    </tr>
<?php
    $row_count++;
}
?>

<script>
    $(document).ready(function() {
        $("#row_count").val(<?php echo $row_count ?>);
    });
</script>