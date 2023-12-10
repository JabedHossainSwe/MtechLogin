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
$tt = "EXECUTE [SPInventoryDetSelectWeb] @SrchBy=1, @Billno=$Billno, @Bid=$Bid, @sBid=$sBid, @FRecNo=1, @ToRecNo=100";
// die();
$detailsSp = Run($tt);
while ($getDetails = myfetch($detailsSp)) {
    $Pcode = $getDetails->PCode;
    $Pid = $getDetails->Pid;
    $product = $getDetails->PName;
    $unit = $getDetails->ParaName;
    $qty = $getDetails->Qty;
    $Sprice = round($getDetails->Price, 2);
    $vatAmt = round($getDetails->vatAmt, 2);
    $vatPer = $getDetails->vatPer;
    $vatSprice = round($getDetails->vatPTotal, 2);
    $unit_id = $getDetails->Uid;

    $compQty = $getDetails->ComputerQty;
    $phyQty = $getDetails->PhysicalQty;
    $moreQty = $getDetails->MoreQty;
    $lessQty = $getDetails->LessQty;
    $moreTotal = $getDetails->MoreTotal;
    $lessTotal = $getDetails->LessTotal;
    $netTotal = $getDetails->NetTotal;
    

    $query = Run("Select * from " . dbObject . "Product where Pcode = '" . $Pcode . "'");
    $fetch = myfetch($query);
    $product_name = $fetch->PName;

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
    $Pid = $getDetails->Pid;

?>

    <tr id="row_<?php echo $row_count ?>">
        <td><?= $row_count ?></td>
        <td><input type="hidden" name="code<?php echo $row_count ?>" id="code<?php echo $row_count ?>" value="<?php echo $Pcode ?>"><?php echo $Pcode ?></td>
        <td><input type="hidden" name="product_name<?php echo $row_count ?>" id="product_name<?php echo $row_count ?>" value="<?php echo $product_name ?>"><?php echo $product_name ?></td>
        <td><input type="hidden" name="unit<?php echo $row_count ?>" id="unit<?php echo $row_count ?>" value="<?php echo $unit_id ?>"><?php echo $unit ?></td>
        <td><input type="hidden" name="compQty<?php echo $row_count ?>" class="t_compQty" id="compQty<?php echo $row_count ?>" value="<?php echo $compQty ?>"><?php echo $compQty ?></td>
        <td><input type="hidden" name="phyQty<?php echo $row_count ?>" class="t_phyQty" id="phyQty<?php echo $row_count ?>" value="<?php echo $phyQty ?>"><?php echo $phyQty ?></td>
        <td><input type="hidden" name="moreQty<?php echo $row_count ?>" class="t_moreQty" id="moreQty<?php echo $row_count ?>" value="<?php echo $moreQty ?>"><?php echo $moreQty ?></td>
        <td><input type="hidden" name="lessQty<?php echo $row_count ?>" class="t_lessQty" id="lessQty<?php echo $row_count ?>" value="<?php echo $lessQty ?>"><?php echo $lessQty ?></td>
        <td><input type="hidden" name="Sprice<?php echo $row_count ?>" class="t_Sprice" id="Sprice<?php echo $row_count ?>" value="<?php echo $Sprice ?>"><?php echo $Sprice ?></td>
        <td><input type="hidden" name="moreTotal<?php echo $row_count ?>" id="moreTotal<?php echo $row_count ?>" value="<?php echo $moreTotal; ?>" class="tot_moreTotal"><?php echo $moreTotal; ?></td>
        <td><input type="hidden" name="lessTotal<?php echo $row_count ?>" id="lessTotal<?php echo $row_count ?>" value="<?php echo $lessTotal; ?>" class="tot_lessTotal"><?php echo $lessTotal; ?></td>
        <td><input type="hidden" name="netTotal<?php echo $row_count ?>" id="netTotal<?php echo $row_count ?>" value="<?php echo $netTotal; ?>" class="tot_Sprice"><?php echo $netTotal; ?></td>

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