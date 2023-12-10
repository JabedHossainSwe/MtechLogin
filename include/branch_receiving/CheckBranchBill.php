<?php
session_start();
error_reporting(0);
include("../../config/connection.php");
$Bid = addslashes(trim($_POST['Bid']));
$Billno = addslashes(trim($_POST['RefNo1']));
$Billno = !empty($Billno) ? $Billno : '0';
$Bid = !empty($Bid) ? $Bid : '2';
$Billno = (int)$Billno;

$sbid = "2";
$bQ = Run("Select * from " . dbObject . "Branch where Bid = '" . $Bid . "'");
$getBData = myfetch($bQ);
if ($getBData->ismain == '1') {
    $sbid = "1";
}


$exe = "SELECT * FROM " . dbObject . "datain WHERE BillNo = $Billno AND Bid = $Bid";
echo $exe = "EXECUTE " . dbObject . "[SPBranchTrnsReceivingDetSelectWeb] @Billno=$Billno ,@Bid=$Bid ,@sBid=$sbid,@BidF=2";
die();

$storeProcedure = Run($exe);
$myFetch = myfetch($storeProcedure);
$Billno = $myFetch->BillNo;
// $CustCode = $myFetch->CustCode;
if ($Billno == '') { ?>
    <script>
        $('#purInvNo').css('border', '2px solid red');
    </script>
<?php die();
} else { ?>
    <script>
        $('#purInvNo').css('border', '2px solid green');
    </script>

    <?php
        echo $exe = "SELECT * FROM " . dbObject . "dataindetail WHERE BillNo = $Billno AND Bid = $Bid";
        $storeProcedure = Run($exe);
    ?>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th><span class="en">Item Code</span><span class="ar"><?= getArabicTitle('Item Code') ?></span></th>
                <th><span class="en">Item Name</span><span class="ar"><?= getArabicTitle('Item Name') ?></span></th>
                <th><span class="en">Unit</span><span class="ar"><?= getArabicTitle('Unit') ?></span></th>
                <th><span class="en">Qty</span><span class="ar"><?= getArabicTitle('Qty') ?></span></th>
                <th><span class="en">Price</span><span class="ar"><?= getArabicTitle('Price') ?></span></th>
                <th><span class="en">Total</span><span class="ar"><?= getArabicTitle('Total') ?></span></th>
                <th><span class="en">Alt Code</span><span class="ar"><?= getArabicTitle('Alt Code') ?></span></th>
                <th><span class="en">Action</span><span class="ar"><?= getArabicTitle('Action') ?></span></th>
            </tr>
        </thead>
        <tbody id="row_append">
            <?php
            $i = 1;
            $totlQty = 0;
            while ($item = myfetch($storeProcedure)) {
                $query = Run("Select * from " . dbObject . "Product where Pid = '" . $item->Pid . "'");
                $fetch = myfetch($query);

                $units = Run("Select * from " . dbObject . "Units where ParaID = '" . $item->Uid . "' ");
                $unit = myfetch($units);
            ?>

                <tr id="row_<?= $i ?>">
                    <td><?= $fetch->PCode ?></td>
                    <td><?= $fetch->PName ?></td>
                    <td><?= $unit->ParaName ?></td>
                    <td><?= $item->Qty ?></td>
                    <td><?= $item->Price ?></td>
                    <td><?= $item->Price * $item->Qty ?></td>
                    <td><?= $item->pBarcode ?></td>
                    <td><i class="fa fa-trash" onclick="delete_row(<?= $i ?>)"></i></td>
                </tr>

                <input type="hidden" id="Pcode<?= $i ?>" name="Pcode<?= $i ?>" value=<?= $fetch->PCode ?>>
                <input type="hidden" id="Pid<?= $i ?>" name="Pid<?= $i ?>" value=<?= $item->Pid ?>>
                <input type="hidden" id="Qty<?= $i ?>" name="Qty<?= $i ?>" value=<?= $item->Qty ?>>
                <input type="hidden" id="Uid<?= $i ?>" name="Uid<?= $i ?>" value=<?= $item->Uid ?>>
                <input type="hidden" id="Total<?= $i ?>" name="Total<?= $i ?>" value=<?= $item->Price * $item->Qty ?>>
                <input type="hidden" id="AltCode<?= $i ?>" name="AltCode<?= $i ?>" value=<?= $item->altCode ?>>
                <input type="hidden" id="Price<?= $i ?>" name="Price<?= $i ?>" value=<?= $item->Price ?>>
                <input type="hidden" id="Sprice<?= $i ?>" name="Sprice<?= $i ?>" value=<?= $item->sPrice ?>>
                <input type="hidden" id="vatSprice<?= $i ?>" name="vatSprice<?= $i ?>" value=<?= $item->vatSPrice ?>>
                <input type="hidden" id="LeastSPrice<?= $i ?>" name="LeastSPrice<?= $i ?>" value=<?= $item->leastSPrice ?>>

                <!-- echo $Billno = $item->BillNo; -->
        <?php
                $totlQty = $totlQty + $item->Qty;
                $i++;
            }
        }
        ?>
        <input type="hidden" id="nrows" name="nrows" value=<?= $i ?>>

        </tbody>
        <tfoot>

            <tr>
                <th>Total Row Count</th>
                <th><?= $i - 1 ?></th>
                <th>Total Quantity</th>
                <th><?= $totlQty ?></th>
            </tr>

        </tfoot>
    </table>
    <script>
    $(document).ready(function () {
        var lang = document.getElementById("selected_lang").value;
        changeLanguage(lang);
    });
    </script>