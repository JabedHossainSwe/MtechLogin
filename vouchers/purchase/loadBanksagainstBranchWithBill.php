<?php
session_start();
error_reporting(0);
include("../../config/connection.php");
// include("../../config/functions.php");
$code = addslashes(trim($_POST['Bid']));
$sbid = addslashes(trim($_POST['sBid']));
$Bid = $code;


$BillNo = addslashes(trim($_POST['BillNo']));
$condition .= " Where bid = '" . $code . "'";





$nrow = 1;
?>
<label for="" class="form-label add_icon en float-left">Banks</label>
<label for="" class="form-label add_icon ar float-right"><?= getArabicTitle('Banks') ?></label>

<table class="tabel table-bordered table-striped" style="width: 100%; margin-top: 10px;">
	<thead>
		<tr>
			<th align="center">#</th>
			<th align="center"><span class="en">Bank</span><span class="ar"><?= getArabicTitle('Bank') ?></span></th>
			<th align="center"><span class="en">Amount</span><span class="ar"><?= getArabicTitle('Amount') ?></span></th>
		</tr>
	</thead>
	<tbody>

		<?php
		$nrow = 1;
		$Bracnhes = Run("exec " . dbObject . "GetPaymentType @bid='$code'");
		while ($getBranches = myfetch($Bracnhes)) {
			$qq = "select d.paytype,b.snameArb,b.snameEng,d.remAmount ,d.amount from DataInPayment d,Bank b 
	Where b.id=d.paytype  and billno='" . $BillNo . "' and d.bid='" . $Bid . "' and d.sbid='" . $sbid . "' and b.mbid='" . $Bid . "' and b.id='" . $getBranches->id . "'   order by d.id";
			$query2 = Run($qq);
			$getD = myfetch($query2);
		?>
			<tr>
				<td align="center"><input type="hidden" id="Bank<?= $nrow ?>" name="Bank<?= $nrow ?>" class="form-control" value="<?php echo $getBranches->id; ?>" readonly> <input type="hidden" id="BankName<?= $nrow ?>" name="BankName<?= $nrow ?>" class="form-control" value="<?php echo $getBranches->snameEng; ?>" readonly>
					<?= $nrow ?></td>
				<td align="center">

					<?php echo $getBranches->snameEng; ?>

				</td>
				<td>
					<input type="text" id="sal_amount<?= $nrow ?>" name="sal_amount<?= $nrow ?>" class="form-control <?php if ($nrow != 1) {
																															echo 'salAmnt';
																														} ?>  " value="<?= round($getD->amount, 2) ?>" onKeyUp="CalculateRemainings()" <?php if ($nrow == 1) {
																		echo 'readonly';
																	} ?>>
				</td>
			</tr>

		<?php
			$nrow++;
		}

		?>
	</tbody>
</table>
<input type="hidden" id="bankrows" name="bankrows" value="<?= $nrow ?>">

<script>
    $(document).ready(function() {
        var lang = document.getElementById("selected_lang").value;
        changeLanguage(lang);
    });
</script>