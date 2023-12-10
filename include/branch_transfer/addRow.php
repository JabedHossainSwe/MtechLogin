<?php
session_start();
error_reporting(0);
include("../../config/connection.php");
$Bid = addslashes(trim($_POST['Bid']));
$products = $_POST['product'];
$i = $_POST['nrows'];

foreach ($products as $product) {
    $i++;
    $sp = "EXECUTE ".dbObject."Getproductsearchbycodeweb @pCode='$product' ,@bid='$Bid'";

    $QueryMax = Run($sp);
    $getDetails = myfetch($QueryMax);

    // print_r($getDetails);
    // die();
    $Pid = $getDetails->pid;
    $Uid = $getDetails->UID;
    //$Uid = 2;
    $que = "Select ppc.uid, paraname from productpricecode ppc, units U, product P where ppc.pid=p.pid and ppc.uid=u.paraid and ppc.bid='" . $Bid . "' and pcode='" . $product . "'";
    $qst = Run($que);

?>
    <tr id="row_<?= $i ?>">
        <td>
            <input type="text" class="form-control" name="Pcode<?= $i ?>" id="Pcode<?= $i ?>" value="<?= $getDetails->pcode ?>" readonly>
        </td>
        <td>
            <input type="text" class="form-control" name="Pname<?= $i ?>" id="Pname<?= $i ?>" value="<?= $getDetails->pname ?>" readonly>
        </td>
        <td>
            <select style="max-width: 100%;" class="form-select" name="Uid<?= $i ?>" id="Uid<?= $i ?>" aria-label="unit" onChange="LoadUnitPrice(this.value,'<?= $product ?>', <?= $i ?>)">
                <option value="">Please Select Unit</option>
                <?php
                while ($loadUnits = myfetch($qst)) {
                    $selected = "";

                    if ($Uid == $loadUnits->uid) {
                        $selected = "Selected";
                    }
                    ?>
                    <option value="<?= $loadUnits->uid ?>" <?= $selected ?>><?= $loadUnits->paraname ?></option>
                <?php
                }
                ?>


            </select>
        </td>
        <td>
            <input type="text" class="form-control totQty" id="Qty<?= $i ?>" name="Qty<?= $i ?>" value="1" onkeyup="calculateTotQty(); calculateTotal(<?= $i ?>);">
        </td>
        <td>
            <input type="text" class="form-control" id="Price<?= $i ?>" name="Price<?= $i ?>" value="<?= $getDetails->CostPrice ?>" onkeyup="calculateTotal(<?= $i ?>);">
        </td>
        <td>
            <input type="text" class="form-control totalval" id="Total<?= $i ?>" name="Total<?= $i ?>" value="<?= $getDetails->CostPrice ?>">
        </td>
        <td>
            <input type="text" class="form-control" id="AltCode<?= $i ?>" name="AltCode<?= $i ?>" value="<?= $getDetails->pBarcode ?>">
        </td>
        <td>
            <i class="fa fa-trash" onclick="delete_row(<?= $i ?>)"></i>
        </td>
    </tr>
    <input type="hidden" id="Pid<?= $i ?>" name="Pid<?= $i ?>" value=<?= $Pid ?>>
    <input type="hidden" id="Sprice<?= $i ?>" name="Sprice<?= $i ?>" value=<?= $getDetails->SPrice ?>>
    <input type="hidden" id="vatSprice<?= $i ?>" name="vatSprice<?= $i ?>" value=<?= $getDetails->vatSprice ?>>
    <input type="hidden" id="LeastSPrice<?= $i ?>" name="LeastSPrice<?= $i ?>" value=<?= $getDetails->level2 ?>>
<?php
  
}


?>


<script>

$(document).ready(function(){
   
    document.getElementById('nrows').value='<?=$i?>';
    document.getElementById('totalRowCount').innerHTML='<?=$i?>';
    calculateTotQty();
});
</script>