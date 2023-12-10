<?php
session_start();
error_reporting(0);
include("../../config/connection.php");
$uid = $_POST['uid'];
$nrows = $_POST['nrows'];
if ($uid != '') {

	$qst = Run("Select * from units where ParaID = '" . $uid . "'");
	$mainPara = myfetch($qst);

	$abc = Run("Select * from " . dbObject . "Units where isDeleted=0 and ParentParaID  = '" . $uid . "' order by ParaName ASC");
	$rc = myfetch($abc);
	//print_r($rc);
	if (!empty($rc)) {
		$abc = Run("Select * from " . dbObject . "Units where isDeleted=0 and ParentParaID  = '" . $uid . "' order by ParaName ASC");
		$counter = $nrows + 1;
?>

		<tr class="gradeX" id="<?= $counter ?>">
			<td>
				<select class="select2_demo_1 form-control" id="uid<?= $counter ?>" name="uid<?= $counter ?>" onchange="changeValue('<?= $counter ?>');">
					<option value="">Please Select</option>
					<?php
					while ($loadA = myfetch($abc)) {
					?>
						<option value="<?= $loadA->ParaID ?>"><?= $loadA->ParaCode ?>- <?= $loadA->ParaName ?></option>
					<?php
					}
					?>
				</select>
				<span class="help-block errorDiv" id="uid<?= $counter ?>_error"></span>


			</td>
			<input type="hidden" id="Qty<?= $counter ?>" name="Qty<?= $counter ?>" value="<?= $rc->ParaValue ?>">
			<td><input type="text" id="CostPrice<?= $counter ?>" name="CostPrice<?= $counter ?>" value="0" class="form-control"></td>
			<td><input type="text" id="SPrice<?= $counter ?>" name="SPrice<?= $counter ?>" value="0" onKeyUp="calculatevatValueSP('<?= $counter ?>')" class="form-control">



			</td>
			<td><input type="text" id="LSPrice<?= $counter ?>" name="LSPrice<?= $counter ?>" value="0" class="form-control"></td>
			<td><input type="text" id="PPrice<?= $counter ?>" name="PPrice<?= $counter ?>" value="0" class="form-control"></td>
			<td><input type="text" id="vatValueSP<?= $counter ?>" name="vatValueSP<?= $counter ?>" readonly value="0" class="form-control"></td>


			</td>

			<td><a href="javascript:loadSubUnits(<?= $counter ?>)" style="width: fit-content;float: left; margin-right: 5px" id="addIcon<?= $counter ?>">
					<span class=""><i class="fa fa-plus fa-2x" aria-hidden="true"></i></span>
				</a>
				<a href="javascript:" onclick="deleteCurrentRow('<?= $counter ?>')" style="width: fit-content; float: left">
					<span class=""><i class="fa fa-trash fa-2x" aria-hidden="true"></i></span>
				</a>
			</td>


		</tr>
		<script>
			document.getElementById('addIcon<?php echo $nrows; ?>').innerHTML = '';
		</script>
	<?php
	} else {
	?>
		<script>
			toastr.error('No Sub Units Found.');
		</script>

<?php
		die();
	}
}
?>

<script>
	$(document).ready(function() {
		$(".select2_demo_1").select2({
			width: '100%',
			closeOnSelect: true,
		});
	});
</script>
<style>
	.select2-container {
		z-index: 99999;
	}
</style>
<script>
	document.getElementById('nrows').value = '<?= $counter ?>';
	document.getElementById('Qty' + <?= $nrows ?>).value = '<?= $mainPara->ParaValue ?>';
</script>

<script>
	$(document).ready(function() {
		var lang = document.getElementById("selected_lang").value;
		changeLanguage(lang);
	});
</script>