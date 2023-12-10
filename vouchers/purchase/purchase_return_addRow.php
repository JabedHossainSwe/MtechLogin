<?php
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
$LanguageId = $_REQUEST['LanguageId'];
$LanguageId = !empty($LanguageId) ? $LanguageId : '1';
?>
<?php
$row_count = 1;
// $tt = "EXECUTE " . dbObject . "SPSalDetSelectWeb @Billno=$Billno,@Bid=$Bid,@sBid=$sBid";
// $tt = "EXECUTE " . dbObject . "SPSalReturnDetailSelectWeb @Billno=$Billno,@Bid=$Bid,@sBid=$sBid";
// $tt = "EXECUTE " . dbObject . "SPSalReturnDetailSelectWeb @Billno=$Billno,@Bid=$Bid,@sBid=$sBid,@SrchBy=1,@FRecNo=0,@ToRecNo=100";
 $tt = "EXECUTE " . dbObject . " SPPurchaseDetSelectWeb @Billno=$Billno,@Bid=$Bid,@sBid=$sBid";
// die();
// die();
$detailsSp = Run($tt);
while ($getDetails = myfetch($detailsSp)) {
	// print_r($getDetails);
	// die();
	$Pcode = $getDetails->PCode;
	$Pid = $getDetails->Pid;
	$unit_name = $getDetails->ParaName;
	$bonus = $getDetails->Bonus;
	$price = $getDetails->Price;
	$total = $getDetails->Total;
	$disPer = $getDetails->disPer;
	$disAmt = $getDetails->Discount;
	$net_total = $getDetails->NetTotal;
	$cpp = $getDetails->Cpp;
	$acp = $getDetails->ACP;
	$Sprice = $getDetails->sPrice;
	$product = $getDetails->PName;
	$vatPer = $getDetails->vatPer;
	$vatAmt = $getDetails->vatAmt;
	$vattotal = $getDetails->vatTotal;
	$grand_total = $getDetails->vatTotal + $getDetails->NetTotal;
	$altCode = $getDetails->altCode;
	$actPrice = $getDetails->actPrice;
	$SCPer = $getDetails->SCPer;
	$CPrice = $getDetails->costprice;
	$lprice = $getDetails->leastSPrice;
	$vatPTotal = $getDetails->vatPTotal;
	$Uid = $getDetails->Uid;
	$vatSPrice = $getDetails->vatSPrice;
	$LSPrice = $getDetails->leastSPrice;
	$qty = $getDetails->Qty;


	$query = Run("Select * from " . dbObject . "Product where Pcode = '" . $Pcode . "'");
	$fetch = myfetch($query);
	$product_name = $fetch->PName;
?>

	<tr id="row_<?php echo $row_count ?>">
		<td><?= $row_count ?></td>
		<td><input type="hidden" name="code<?php echo $row_count ?>" id="code<?php echo $row_count ?>" value="<?php echo $Pcode ?>"><?php echo $Pcode ?></td>
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
		<td><input type="hidden" name="SCPer<?php echo $row_count ?>" class="t_SCPer" id="SCPer<?php echo $row_count ?>" value="<?php echo $SCPer ?>"><?php echo $SCPer ?></td>
		<td><input type="hidden" name="SPrice<?php echo $row_count ?>" class="t_SPrice" id="SPrice<?php echo $row_count ?>" value="<?php echo $Sprice ?>"><?php echo $Sprice ?></td>
		<td><input type="hidden" name="lprice<?php echo $row_count ?>" class="t_lprice" id="lprice<?php echo $row_count ?>" value="<?php echo $lprice ?>"><?php echo $lprice ?></td>
		<td><input type="hidden" name="vatPer<?php echo $row_count ?>" class="t_vatPer" id="vatPer<?php echo $row_count ?>" value="<?php echo $vatPer ?>"><?php echo $vatPer ?></td>
		<td><input type="hidden" name="vatAmt<?php echo $row_count ?>" class="t_vatAmt" id="vatAmt<?php echo $row_count ?>" value="<?php echo round($vatAmt, 2) ?>"><?php echo round($vatAmt, 2) ?></td>
		<td><input type="hidden" name="vattotal<?php echo $row_count ?>" class="t_vattotal" id="vattotal<?php echo $row_count ?>" value="<?php echo round($vattotal, 2) ?>"><?php echo round($vattotal, 2) ?></td>
		<td><input type="hidden" name="grand_total<?php echo $row_count ?>" class="t_grandtotal" id="grand_total<?php echo $row_count ?>" value="<?php echo $grand_total ?>"><?php echo $grand_total ?></td>
		<td>
			<i class="fa fa-pencil" onclick="edit_row(<?php echo $row_count ?>)"></i>&nbsp;&nbsp;&nbsp;<i class="fa fa-trash" onclick="delete_row(<?php echo $row_count ?>)"></i>
			<input type="hidden" id="Pid<?php echo $row_count ?>" name="Pid<?php echo $row_count ?>" value="<?= $Pid; ?>">
			<input type="hidden" id="altCode<?php echo $row_count ?>" name="altCode<?php echo $row_count ?>" value="<?= $altCode; ?>">
			<input type="hidden" id="actPrice<?php echo $row_count ?>" name="actPrice<?php echo $row_count ?>" value="<?=$actPrice?>">
			<input type="hidden" id="EmpID<?php echo $row_count ?>" name="EmpID<?php echo $row_count ?>" value="">
			<input type="hidden" id="ResEmpID<?php echo $row_count ?>" name="ResEmpID<?php echo $row_count ?>" value="">
			<input type="hidden" id="CPrice<?php echo $row_count ?>" name="CPrice<?php echo $row_count ?>" value="<?=$CPrice?>">
			<input type="hidden" id="IsStockCount<?php echo $row_count ?>" name="IsStockCount<?php echo $row_count ?>" value="">
			<input type="hidden" id="vatPTotal<?php echo $row_count ?>" name="vatPTotal<?php echo $row_count ?>" value="<?=$vatPTotal?>">
			<input type="hidden" id="unit<?php echo $row_count ?>" name="unit<?php echo $row_count ?>" value="<?php echo $Uid ?>">
			<input type="hidden" id="vatSprice<?php echo $row_count ?>" name="vatSprice<?php echo $row_count ?>" value="<?php echo $vatSPrice ?>">
			<input type="hidden" id="CostPrice<?php echo $row_count ?>" name="CostPrice<?php echo $row_count ?>" value="<?php echo $CPrice ?>">
			<input type="hidden" id="LSPrice<?php echo $row_count ?>" name="LSPrice<?php echo $row_count ?>" value="<?php echo $LSPrice ?>">

		</td>

	</tr>

	<?php
	$row_count++;
}
?>

	<script>
		$(document).ready(function() {
			//salesTotalCalculation();
			document.getElementById('row_count').value='<?php echo $row_count-1 ?>';
			// $("#row_count").val(<?php echo $row_count-1 ?>);
		});

		$(document).ready(function() {
			$("#product").select2({
				width: "100%",
				closeOnSelect: true,
				placeholder: "",
				//minimumInputLength: 2,
				ajax: {
					url: "Api/listings/getProductsWithOutCode",
					dataType: "json",
					type: "POST",
					data: function(query) {
						// add any default query here
						term: query.terms;
						return query;
					},
					processResults: function(data, params) {
						// Tranforms the top-level key of the response object from 'items' to 'results'
						var results = [];

						results.push({
							id: 0,
							text: "Please Select Product",
						});
						data.data.forEach((e) => {
							//cName = e.CName.toLowerCase();
							//terms = params.term.toLowerCase();

							results.push({
								id: e.Id,
								text: e.CName,
							});
						});
						return {
							results: results,
						};
					},
				},
				templateResult: formatResult,
			});

			function formatResult(d) {
				if (d.loading) {
					return d.text;
				}
				// Creating an option of each id and text
				$d = $("<option/>")
					.attr({
						value: d.value,
					})
					.text(d.text);

				return $d;
			}
		});
	$(document).ready(function() {	
	var t_vat_sum = 0;	
$(".t_vattotal").each(function () {
t_vat_sum += parseFloat(this.value);
});
document.getElementById('initial_total_vat').value = t_vat_sum;
  var initial_total_vat = $("#initial_total_vat").val();


  var f_dis_per = $("#f_dis_per").val();
  if (f_dis_per == "") {
    $("#f_dis_amt").val(0);
    $("#f_dis_per").val(0);
    return false;
  }
  var f_dis_amtForVat = (
    (parseFloat(f_dis_per) * parseFloat(initial_total_vat)) /
    100
  ).toFixed(2);

  var vatAfterDiscount =
    parseFloat(initial_total_vat) - parseFloat(f_dis_amtForVat);
  vatAfterDiscount = vatAfterDiscount.toFixed(2);

  $("#f_total_vat").val(vatAfterDiscount);	
  //$("#initial_total_vat").val(vatAfterDiscount);	
			});
		
	</script>

<script>
    $(document).ready(function() {
        var lang = document.getElementById("selected_lang").value;
        changeLanguage(lang);
    });
</script>

