<?php
session_start();
error_reporting(0);
include("../../config/connection.php");
// include("../../config/functions.php");

$uid = $_POST['uid'];
if ($uid != '') {
	$qst = Run("Select * from units where ParaID = '" . $uid . "'");
	$mainPara = myfetch($qst);
	$counter = 1;

?>
	<div class="ibox-content">

		<div class="table-responsive">
			<table class="table table-striped table-bordered table-hover dataTables-example">
				<thead>
					<tr id="<?= $counter ?>">

						<th><span class="en">Unit</span><span class="ar"><?= getArabicTitle('Unit') ?></span></th>
						<th><span class="en">CostPrice</span><span class="ar"><?= getArabicTitle('CostPrice') ?></span></th>
						<th><span class="en">Sale Price</span><span class="ar"><?= getArabicTitle('Sale Price') ?></span></th>
						<th><span class="en">Least Sale Price</span><span class="ar"><?= getArabicTitle('Least Sale Price') ?></span></th>
						<th><span class="en">Purchase Price</span><span class="ar"><?= getArabicTitle('Purchase Price') ?></span></th>
						<th><span class="en">Vat Sale Price</span><span class="ar"><?= getArabicTitle('Vat Sale Price') ?></span></th>
						<th><span class="en">Actions</span><span class="ar"><?= getArabicTitle('Actions') ?></span></th>

					</tr>
				</thead>
				<tbody>
					<tr class="gradeX">
						<td>
							<input type="hidden" id="uid<?= $counter ?>" name="uid<?= $counter ?>" value="<?= $uid ?>">
							<input type="hidden" id="Qty<?= $counter ?>" name="Qty<?= $counter ?>" value="<?= $mainPara->ParaValue ?>">
							<?= $mainPara->ParaName ?>
						</td>
						<td><input type="text" id="CostPrice<?= $counter ?>" name="CostPrice<?= $counter ?>" value="0" class="form-control"></td>
						<td><input type="text" id="SPrice<?= $counter ?>" name="SPrice<?= $counter ?>" value="0" onKeyUp="calculatevatValueSP('<?= $counter ?>')" class="form-control"></td>
						<td><input type="text" id="LSPrice<?= $counter ?>" name="LSPrice<?= $counter ?>" value="0" class="form-control"></td>
						<td><input type="text" id="PPrice<?= $counter ?>" name="PPrice<?= $counter ?>" value="0" class="form-control"></td>
						<td><input type="text" id="vatValueSP<?= $counter ?>" name="vatValueSP<?= $counter ?>" readonly value="0" class="form-control"></td>


						</td>
						<td></td>


					</tr>
					<?php

					$abc = Run("Select * from " . dbObject . "Units where isDeleted=0 and ParentParaID  = '" . $uid . "' order by ParaName ASC");
					$rc = myfetch($abc);
					if (!empty($rc)) {

						$counter = 2;
					?>
						<tr class="gradeX" id="<?= $counter ?>">
							<td>
								<select class="select2_demo_1 form-control" id="uid<?= $counter ?>" name="uid<?= $counter ?>" onchange="changeValue('<?= $counter ?>');">
									<option value="">Please Select</option>
									<?php
									$abc = Run("Select * from " . dbObject . "Units where isDeleted=0 and ParentParaID  = '" . $uid . "' order by ParaName ASC");

									while ($loadA = myfetch($abc)) {
									?>
										<option value="<?= $loadA->ParaID ?>"><?= $loadA->ParaCode ?>- <?= $loadA->ParaName ?></option>
									<?php
									}
									?>
								</select>
								<span class="help-block errorDiv" id="uid<?= $counter ?>_error"></span>
								<input type="hidden" id="Qty<?= $counter ?>" name="Qty<?= $counter ?>" value="<?= $rc->ParaValue ?>">


							</td>
							<td><input type="text" id="CostPrice<?= $counter ?>" name="CostPrice<?= $counter ?>" value="0" class="form-control"></td>
							<td><input type="text" id="SPrice<?= $counter ?>" name="SPrice<?= $counter ?>" value="0" onKeyUp="calculatevatValueSP('<?= $counter ?>')" class="form-control"></td>
							<td><input type="text" id="LSPrice<?= $counter ?>" name="LSPrice<?= $counter ?>" value="0" class="form-control"></td>
							<td><input type="text" id="PPrice<?= $counter ?>" name="PPrice<?= $counter ?>" value="0" class="form-control"></td>
							<td><input type="text" id="vatValueSP<?= $counter ?>" name="vatValueSP<?= $counter ?>" readonly value="0" class="form-control"></td>


							</td>

							<td>
								<a href="javascript:loadSubUnits(<?= $counter ?>)" style="width: fit-content;float: left; margin-right: 5px">
									<span class=""><i class="fa fa-plus fa-2x" aria-hidden="true"></i></span>
								</a>
								<a href="javascript:" onclick="deleteCurrentRow('<?= $counter ?>')" style="width: fit-content; float: left">
									<span class=""><i class="fa fa-trash fa-2x" aria-hidden="true"></i></span>
								</a>
							</td>

						</tr>
				<?php
					}
				}
				?>
				<input type="hidden" id="nrows" name="nrows" value="<?= $counter ?>">
				</tbody>
			</table>
			<table class="table table-striped table-bordered table-hover dataTables-example">
				<tbody id="loadSubUnits">

				</tbody>
			</table>

			<div class="generate_btn" style="display: none;">
				<a onclick="generatePrice()" class="btn btn-outline-primary btn-actions float-right submit-next mr-2"><span class="en">Generate Price</span><span class="ar"><?= getArabicTitle('Generate Price') ?></span></a>
			</div>

		</div>

	</div>

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
    $(document).ready(function () {
      var lang = document.getElementById("selected_lang").value;
      changeLanguage(lang);
    });
</script>