<?php
session_start();
error_reporting(0);
include("../../config/connection.php");
// include("../../config/functions.php");
$Bid = $_POST['Bid'];
$Billno = $_POST['Billno'];
$LanguageId = $_REQUEST['LanguageId'];
$LanguageId = !empty($LanguageId) ? $LanguageId : '1';

// echo "Select *,[Discount%] as disper from " . dbObject . "DataOutReturn where Billno = $Billno and Bid = $Bid";
// die();
$qq = "Select *,[Discount%] as disper from " . dbObject . "DataIn where Billno = $Billno and Bid = $Bid";

//$qq = "Exec [dbo].SPDatainOrderSelectWeb @SrchBy =0,@Billno=$Billno,@Bid=$Bid,@sBid =$sBid, @LanguageId =1,@FRecNo =1,@ToRecNo =1";
$QueryGet = Run($qq);
$billData = myfetch($QueryGet);
$sBid = $billData->sbid;
// print_r($billData);
?>

<form action="javascript:updatePurchaseVoucher()" id="sales_report_form" method="post" class="ibox-content">
	<div class="row direction">
		<div class="col-lg-12">
			<div class="ibox">
				<div class="ibox-title">
					<div class="row">
						<div class="col-md-12">
							<h5 class="mr-4 float-left en">Purchase Voucher</h5>
							<h5 class="mr-4 float-right ar"><?= getArabicTitle('Purchase Voucher') ?></h5>
						</div>
					</div>
				</div>



				<!------First Line------>
				<div class="row d-flex justify-content-start mb-2 pl-4">


					<div class="col-6">
						<div class="row">
							<div class="col-md-4">
								<h4><span class="en">Branch</span><span class="ar"><?= getArabicTitle('Branch') ?></span></h4>
							</div>
							<div class="col-md-8">
								<select id="Bid" name="Bid" class="grpreq select2_demo_1 form-control" onChange="loadBanksagainstBrank(this.value)" required>
									<?php
									if ($_SESSION['isAdmin'] == '1') {
										$Bracnhes = Run("Select * from " . dbObject . "Branch order by BName ASC");
									} else {
										$Bracnhes = Run("Select " . dbObject . "Branch.Bid," . dbObject . "Branch.BName from " . dbObject . "Branch Inner JOIN " . dbObject . "EMP  On " . dbObject . "EMP.BID = " . dbObject . "Branch.Bid where " . dbObject . "EMP.WebCode = '" . $_SESSION['code'] . "' ");
									}

									while ($getBranches = myfetch($Bracnhes)) {
										$selected = "";
										if ($getBranches->Bid == $billData->Bid) {
											$selected = "Selected";
										}
									?>
										<option value="<?php echo $getBranches->Bid; ?>" <?php echo $selected; ?>><?php echo $getBranches->BName; ?></option>
									<?php
									} ?>

								</select>
							</div>
						</div>
					</div>

					<!-- <div class="col-md-8 d-flex justify-content-start"> -->

					<div class="col-md-6 row">
						<div class="col-3">
							<h4><span class="en">Bill No</span><span class="ar"><?= getArabicTitle('Bill No') ?></span></h4>
						</div>
						<div class="form-group col-3">
							<input value="<?= $Billno ?>" id="bill_no" name="bill_no" type="text" class="form-control">
							<input value="<?= $billData->sbBillno ?>" id="sbBillno" name="sbBillno" readonly type="hidden" class="form-control">
						</div>

						<div class="col-6">
							<button type="button" class="btn btn-success" onclick="reloadVoucher()"><i class="fa fa-refresh"></i></button>

							<?php
							$qt = "select BillNo from datain where BillNo = (select max(BillNo) from 
datain where BillNo < '" . $Billno . "' and Bid='" . $Bid . "' and isDeleted = 0) 
and Bid = '" . $Bid . "' and isDeleted = 0";
							$previousQuery = Run($qt);
							$getPreviousId = myfetch($previousQuery)->BillNo;
							if ($getPreviousId != '') { ?>
								<button type="button" class="btn btn-success" onclick="editVoucher('<?= $Bid ?>','<?= $getPreviousId ?>')"><i class="fa fa-backward"></i></i></button>
							<?php }
							$qt = "select BillNo from datain where BillNo = (select min(BillNo) from datain where BillNo > '" . $Billno . "' and Bid='" . $Bid . "' and isDeleted = 0) and Bid = '" . $Bid . "' and isDeleted = 0";
							$nextQuery = Run($qt);
							$getNextId = myfetch($nextQuery)->BillNo;
							if ($getNextId != '') {
							?>
								<button type="button" class="btn btn-success" onclick="editVoucher('<?= $Bid ?>','<?= $getNextId ?>')"><i class="fa fa-forward"></i></i></button>

							<?php } ?>

							<button type="button" class="btn btn-success" onclick="deletePurchase('<?= $Billno ?>', '<?= $Bid ?>', '<?= $sBid ?>')"><i class="fa fa-trash"></i></button>
							<button type="button" class="btn btn-success" onclick="PrintPopupVoucher('<?= $Bid ?>', 'Purchase Voucher')"><i class="fa fa-print"></i></button>
							<button type="button" class="btn btn-success" onclick="location.reload()"><i class="fa fa-plus"></i></button>
						</div>
					</div>


				</div>

				<!--------Second Line------>
				<div class="row d-flex justify-content-start mb-2 pl-4">
					<div class="col-4">
						<div class="row d-flex justify-content-evenly">

							<div class="col-md-6 col-6">
								<div class="i-checks"><label class="">
										<div class="iradio_square-green ">
											<div class="iradio_square-green">
												<input type="radio" value="1" class="SPType" name="SPType" onchange="SPType();" <?php if ($billData->SPType == 1) {
																												echo "checked";
																											} ?>>
											</div>
											<ins class="iCheck-helper"></ins>
										</div>
										<i></i> <span class="en">Cash</span><span class="ar"><?= getArabicTitle('Cash') ?></span>
									</label>
								</div>
							</div>

							<div class="col-md-6 col-6">
								<div class="i-checks"><label class="">
										<div class="iradio_square-green ">
											<div class="iradio_square-green">
												<input type="radio" value="2" class="SPType" name="SPType" onchange="SPType();" <?php if ($billData->SPType == 2) {
																												echo "checked";
																											} ?>>
											</div>
											<ins class="iCheck-helper"></ins>
										</div>
										<i></i> <span class="en">Credit</span><span class="ar"><?= getArabicTitle('Credit') ?></span>
									</label>
								</div>
							</div>



						</div>
					</div>

					<div class="col-4">
						<div class="row">
							<div class="col-4">
								<h4><span class="en">Purchaser</span><span class="ar"><?= getArabicTitle('Purchaser') ?></h4>
							</div>
							<div class="col-2">
								<div class="form-group"><input id="Pur_id" name="Pur_id" type="text" value="<?= $billData->Pur_id ?>" class="form-control" readonly></div>
							</div>
							<div class="col-6">
								<div class="form-group">
									<div>
										<select id="Pur_name" name="Pur_name" class="select2_demo_1 form-control" tabindex="4" onChange="setmyValue(this.value,'Pur_id');">
												<?php
												if ($billData->Pur_id != 0) { 
														$getPur = Run("select * from Purchaser where cid = $billData->Pur_id");
													?>
													<option value="<?= $billData->Pur_id ?>" selected><?= myfetch($getPur)->CName ?></option>
												<?php }
												?>
										</select>
									</div>
								</div>
							</div>
						</div>

					</div>
					<!-----First CHild---->
					<div class="col-4">
						<div class="row">
							<div class="col-4">
								<h4><span class="en">Bill Date/Time</span><span class="ar"><?= getArabicTitle('Bill Date/Time') ?></span></h4>
							</div>
							<div class="col-8">
								<div class="form-group">
									<input id="bill_date_time" name="bill_date_time" type="datetime-local" value="<?= date($billData->CompDate) ?>" class="form-control">
								</div>
							</div>
						</div>
					</div>

				</div>
				<div class="row d-flex justify-content-start mb-2 pl-4">

					<!-------Sec CHild-------->

					<div class="col-4">
						<div class="row">
							<div class="col-4">
								<h4><span class="en">Purchase Type</span><span class="ar"><?= getArabicTitle('Purchase Type') ?></span></h4>
							</div>
							<div class="col-2">
								<div class="form-group"><input id="PurType" name="PurType" type="text" class="form-control" readonly value="<?php if ($billData->purType != 0) {
																																				echo $billData->purType;
																																			} ?>"></div>
							</div>
							<div class="col-6">
								<div class="form-group">
									<div>
										<select id="PurType_name" name="PurType_name" class="select2_demo_1 form-control" tabindex="4" onChange="setmyValue(this.value,'PurType');">
											<?php
											if ($billData->purType != 0) { ?>
												<option value="<?= $billData->purType ?>"><?= getPurchaseTypeDetails($billData->purType)->CName ?></option>
											<?php }
											?>

										</select>
									</div>
								</div>
							</div>
						</div>

					</div>
					<!-------Thrid CHild-->
					<div class="col-md-4">
						<div class="row">
							<div class="col-4">
								<h4><span class="en">Ref. No</span><span class="ar"><?= getArabicTitle('Ref. No') ?></span>
								</h4>
							</div>
							<div class="col-8">
								<div class="form-group">
									<input type="text" id="RefNo1" name="RefNo1" value="<?= $billData->RefNo ?>" class="form-control">
								</div>
							</div>
						</div>
					</div>
					<!---------FOurth CHild-->
					<div class="col-md-4">
						<div class="row">
							<div class="col-4">
								<h4><span class="en">P.O No.</span><span class="ar"><?= getArabicTitle('P.O No.') ?></span>
								</h4>
							</div>
							<div class="col-8">
								<div class="form-group">
									<input type="text" id="poNo" name="poNo" class="form-control" value="<?= $billData->poNo ?>">
								</div>
							</div>
						</div>
					</div>
				</div>

				<!--------third Line------>
				<div class="row d-flex justify-content-start mb-2 pl-4">
					<div class="col-4">
						<div class="row">
							<div class="col-4">
								<h4><span class="en">Supplier Id</span><span class="ar">
										<?= getArabicTitle('From Product') ?>
									</span>
								</h4>
							</div>
							<div class="col-2">
								<div class="form-group">
									<input id="supplier_id" name="supplier_id" type="text" class="form-control" value="<?php
																														echo $billData->CSID;
																														?>" readonly>
								</div>
							</div>
							<div class="col-6">
								<div class="form-group">
									<div>
										<select id="supplier_name" name="supplier_name" class="select2_demo_1 form-control" tabindex="4" onchange="setmyValue(this.value,'supplier_id');">
											<?php
											if ($billData->CSID != "") { ?>
												<option value="<?= $billData->CSID ?>"><?= $billData->CSID ?> - <?= getSupplierDetails($billData->CSID)->CName ?></option>
											<?php }
											?>
										</select>
									</div>
								</div>
							</div>
						</div>
					</div>
					<!--------Dis %------>
					<div class="col-4">
						<div class="row">
							<div class="col-4">
								<h4><span class="en">Dis %</span><span class="ar">% <?= getArabicTitle('Dis') ?></span>
								</h4>
							</div>
							<div class="col-8">
								<div class="form-group">
									<input type="text" id="dis_per" name="dis_per" class="form-control" value="<?= $billData->SupDisPer ?>">
								</div>
							</div>

						</div>
					</div>

					<!--------Due ------>
					<div class="col-4">
						<div class="row">
							<div class="col-4">
								<h4><span class="en">Due</span><span class="ar"><?= getArabicTitle('Due') ?></span>
								</h4>
							</div>
							<div class="col-8">
								<div class="form-group">
									<input type="text" id="due" name="due" class="form-control" value="<?= $billData->dueDays ?>">
								</div>
							</div>

						</div>
					</div>
				</div>


				<!--------Fourth Line------>
				<div class="row d-flex justify-content-start mb-2 pl-4">

					<!-------- Due Date------>

					<div class="col-6">
						<div class="row">
							<div class="col-4">
								<h4><span class="en">Due Date</span><span class="ar"><?= getArabicTitle('Due Date') ?></span>
								</h4>
							</div>
							<div class="col-8">
								<div class="form-group">
									<input value="" id="due_date" name="due_date" type="date" class="form-control">
								</div>
							</div>

						</div>
					</div>

					<!--------Remarks------>
					<div class="col-6">
						<div class="row">
							<div class="col-4">
								<h4><span class="en">Remarks</span><span class="ar"><?= getArabicTitle('Remarks') ?></span>
								</h4>
							</div>
							<div class="col-8">
								<div class="form-group">
									<input type="text" id="remarks" name="remarks" class="form-control" value="<?= $billData->Comments ?>">
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>


	<!-- <div class="row">
<div class="col-md-2 ml-auto mr-auto mb-3">
<button type="button" onclick="AddPurchase()" class="btn btn-block btn-lg btn-outline-primary" id="seles_report_search" value="Add"><span class="en">Add</span><span class="ar">Add</span></button>
</div>
</div> -->


	<div class="row">
		<div class="col-lg-12">
			<div class="ibox">
				<div class="ibox-content  filter_container">

					<div class="row" style="display:block; overflow-x:scroll;">
						<div>
							<table class="table table-bordered m-0">
								<thead>
									<tr>
										<th><span class="en">Code</span><span class="ar"><?= getArabicTitle('Code') ?></span></th>
										<th><span class="en">Product</span><span class="ar"><?= getArabicTitle('Product') ?></span></th>
										<th><span class="en">Unit</span><span class="ar"><?= getArabicTitle('Unit') ?></span></th>
										<th><span class="en">Qty</span><span class="ar"><?= getArabicTitle('Qty') ?></span></th>
										<th><span class="en">Bonus</span><span class="ar"><?= getArabicTitle('Bonus') ?></span></th>
										<th><span class="en">Price</span><span class="ar"><?= getArabicTitle('Price') ?></span></th>
										<th><span class="en">Total</span><span class="ar"><?= getArabicTitle('Total') ?></span></th>
										<th><span class="en">Disc %</span><span class="ar">% <?= getArabicTitle('Disc') ?></span></th>
										<th><span class="en">Disc.</span><span class="ar"><?= getArabicTitle('Disc.') ?></span></th>
										<th><span class="en">Net Total</span><span class="ar"><?= getArabicTitle('Net Total') ?></span></th>
										<th><span class="en">CCP</span><span class="ar"><?= getArabicTitle('CCP') ?></span></th>
										<th><span class="en">ACP</span><span class="ar"><?= getArabicTitle('ACP') ?></span></th>
										<th><span class="en">SC %</span><span class="ar">% <?= getArabicTitle('SC') ?></span></th>
										<th><span class="en">S. Price</span><span class="ar"><?= getArabicTitle('S. Price') ?></span></th>
										<th><span class="en">L. Price</span><span class="ar"><?= getArabicTitle('L. Price') ?></span></th>
										<th><span class="en">Vat %</span><span class="ar">% <?= getArabicTitle('Vat') ?></span></th>
										<th><span class="en">Vat Amt</span><span class="ar"><?= getArabicTitle('Vat Amt') ?></span></th>
										<th><span class="en">Vat Total</span><span class="ar"><?= getArabicTitle('Vat Total') ?></span></th>
										<th><span class="en">Vat + Total</span><span class="ar"><?= getArabicTitle('Vat + Total') ?></span></th>
										<th><span class="en">Action</span><span class="ar"><?= getArabicTitle('Action') ?></span></th>
									</tr>
								</thead>
								<tbody>
									<tr>
										<td style="width:4%">
											<input type="text" id="code" onkeyup="fetchProductDetailsFromCode(this.value, '')" class="form-control">
										</td>
										<td style="width:10%" id="getProductList">
											<select id="product" class="select2_demo_1 form-control" tabindex="4" onChange="setmyValue(this.value,'code');fetchProductDetailsFromCode(this.value)">
											</select>
										</td>
										<td style="width:5%" id="loadUnits">

											<select id="unit" class="form-control" tabindex="4">
											</select>
										</td>

										<td style="width: 5%">
											<input type="text" id="qty" class="form-control" value="" onkeyup="salesAddRowCalculations();">

										</td>
										<td style="width: 5%">
											<input type="text" id="bonus" class="form-control" value="0">

										</td>
										<td style="width: 5%">
											<input type="text" id="price" class="form-control" value="0" onkeyup="salesAddRowCalculations()">

										</td>
										<td style="width: 5%">
											<input type="text" id="total" class="form-control" value="0">

										</td>
										<td style="width: 5%">
											<input type="text" id="disPer" class="form-control" value="0" onkeyup="salesAddRowCalculations()">
										</td>

										<td style="width: 5%">
											<input type="text" id="disAmt" class="form-control" value="0" onkeyup="calculateDisPer()">

										</td>
										<td style="width: 5%">
											<input type="text" id="net_total" class="form-control" value="0" readonly>
										</td>
										<td style="width: 5%">
											<input type="text" id="cpp" class="form-control" value="0" readonly>
										</td>
										<td style="width: 5%">
											<input type="text" id="acp" class="form-control" value="0" readonly>
										</td>
										<td style="width: 5%">
											<input type="text" id="SCPer" class="form-control" value="0" onkeyup="calculateSPrice()">
										</td>
										<td style="width: 5%">
											<input type="text" id="SPrice" class="form-control" value="0">

										</td>
										<td style="width: 5%">
											<input type="text" id="lprice" class="form-control" value="0">

										</td>
										<td style="width: 5%">
											<input type="text" id="vatPer" class="form-control" value="0" onkeyup="salesAddRowCalculations()" readonly>

										</td>
										<td style="width: 5%">
											<input type="text" id="vatAmt" class="form-control" value="0" readonly>

										</td>
										<td style="width: 5%">
											<input type="text" id="vattotal" class="form-control" value="0" readonly>

										</td>
										<td style="width: 18%">
											<input type="text" id="grand_total" class="form-control" value="0" readonly>

										</td>


										<td id="action_id">
											<button type="button" name="add_row" id="add_row" class="btn btn-info" onclick="addRow()">Add</button>
										</td>
										<input type="hidden" id="Pid" name="Pid" value="">
										<input type="hidden" id="altCode" name="altCode" value="">
										<input type="hidden" id="actPrice" name="actPrice" value="">
										<input type="hidden" id="EmpID" name="EmpID" value="">
										<input type="hidden" id="ResEmpID" name="ResEmpID" value="">
										<input type="hidden" id="CPrice" name="CPrice" value="">
										<input type="hidden" id="IsStockCount" name="IsStockCount" value="">
										<input type="hidden" id="vatPTotal" name="vatPTotal" value="">
										<input type="hidden" id="unit_name" name="unit_name" value="">
										<input type="hidden" id="vatSprice" name="vatSprice" value="">
										<input type="hidden" id="CostPrice" name="CostPrice" value="">
										<input type="hidden" id="LSPrice" name="LSPrice" value="">
									</tr>

								</tbody>
							</table>
						</div>
					</div>


					<div style=" height: fit-content; margin-top:1rem;">
						<table class="table table-bordered">
							<thead>
								<tr>
									<th>#</th>
									<th><span class="en">Code</span><span class="ar"><?= getArabicTitle('Code') ?></span></th>
									<th><span class="en">Product</span><span class="ar"><?= getArabicTitle('Product') ?></span></th>
									<th><span class="en">Unit</span><span class="ar"><?= getArabicTitle('Unit') ?></span></th>
									<th><span class="en">Qty</span><span class="ar"><?= getArabicTitle('Qty') ?></span></th>
									<th><span class="en">Bonus</span><span class="ar"><?= getArabicTitle('Bonus') ?></span></th>
									<th><span class="en">Price</span><span class="ar"><?= getArabicTitle('Price') ?></span></th>
									<th><span class="en">Total</span><span class="ar"><?= getArabicTitle('Total') ?></span></th>
									<th><span class="en">Disc %</span><span class="ar">% <?= getArabicTitle('Disc') ?></span></th>
									<th><span class="en">Disc.</span><span class="ar"><?= getArabicTitle('Disc.') ?></span></th>
									<th><span class="en">Net Total</span><span class="ar"><?= getArabicTitle('Net Total') ?></span></th>
									<th><span class="en">CCP</span><span class="ar"><?= getArabicTitle('CCP') ?></span></th>
									<th><span class="en">ACP</span><span class="ar"><?= getArabicTitle('ACP') ?></span></th>
									<th><span class="en">SC %</span><span class="ar">% <?= getArabicTitle('SC') ?></span></th>
									<th><span class="en">S. Price</span><span class="ar"><?= getArabicTitle('S. Price') ?></span></th>
									<th><span class="en">L. Price</span><span class="ar"><?= getArabicTitle('L. Price') ?></span></th>
									<th><span class="en">Vat %</span><span class="ar">% <?= getArabicTitle('Vat') ?></span></th>
									<th><span class="en">Vat Amt</span><span class="ar"><?= getArabicTitle('Vat Amt') ?></span></th>
									<th><span class="en">Vat Total</span><span class="ar"><?= getArabicTitle('Vat Total') ?></span></th>
									<th><span class="en">Vat + Total</span><span class="ar"><?= getArabicTitle('Vat + Total') ?></span></th>
									<th><span class="en">Action</span><span class="ar"><?= getArabicTitle('Action') ?></span></th>
								</tr>
							</thead>
							<tbody id="row_append">

							</tbody>
						</table>

					</div>

				</div>
			</div>
		</div>
	</div>


	<div class="row">
		<div class="col-lg-12">
			<div class="ibox">
				<div class="ibox-content ">
					<div class="row">
						<div class="col">
							<div class="row">
								<div class="col-md-4 d-flex justify-content-end">
									<h4><span class="en">Total</span><span class="ar"><?= getArabicTitle('Total') ?></span></h4>
								</div>
								<div class="col-md-8">
									<div class="form-total_int">
										<input id="f_total_int" name="f_total_int" type="text" readonly value="<?= round($billData->Total, 2) ?>" class="form-control">
									</div>
								</div>
							</div>
						</div>
						<div class="col">
							<div class="row">
								<div class="col-md-4 d-flex justify-content-end">
									<h4><span class="en">Dis%</span><span class="ar">%<?= getArabicTitle('Dis') ?></span></h4>
								</div>
								<div class="col-md-8">
									<div class="form-group">
										<input id="f_dis_per" name="f_dis_per" type="text" class="form-control" value="<?= round($billData->disper, 2) ?>" onkeyup="salesTotalDiscountCalculation()">
									</div>
								</div>
							</div>
						</div>
						<div class="col">
							<div class="row">
								<div class="col-md-4 d-flex justify-content-end p-0 m-0">
									<h4><span class="en">Dis Amount</span><span class="ar"><?= getArabicTitle('Dis Amount') ?></span></h4>
								</div>
								<div class="col-md-8">
									<div class="form-group">
										<input id="f_dis_amt" name="f_dis_amt" type="text" class="form-control" value="<?= round($billData->Discount, 2) ?>" onkeyup="salesTotalDiscountCalculationWithAMount()">
									</div>
								</div>
							</div>
						</div>
						<div class="col">
							<div class="row">
								<div class="col-md-4 d-flex justify-content-end m-0 p-0">
									<h4><span class="en">Net Total</span><span class="ar"><?= getArabicTitle('Net Total') ?></span></h4>
								</div>
								<div class="col-md-8">
									<div class="form-group">
										<input id="f_net_total" name="f_net_total" type="text" class="form-control" value="<?= round($billData->Nettotal, 2) ?>" onkeyup="salesTotalDiscountCalculationWithAMount()">
									</div>
								</div>
							</div>
						</div>
						<div class="col">
							<div class="row">
								<div class="col-md-4 d-flex justify-content-end m-0 p-0">
									<h4><span class="en">Total VAT</span><span class="ar"><?= getArabicTitle('Total Vat') ?></span></h4>
								</div>
								<div class="col-md-8">
									<div class="form-total_int">
										<input id="f_total_vat" name="f_total_vat" type="text" readonly value="<?= round($billData->totalVat, 2) ?>" class="form-control">
										<input id="initial_total_vat" name="initial_total_vat" type="hidden" readonly value="<?= round($billData->totalVat, 2) ?>" class="form-control">
										<input value="<?= round($billData->totalVat, 2) ?>" id="initial_total_vat" name="initial_total_vat" type="hidden" class="form-control">

									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="row d-flex justify-content-end">
						<div class="col-md-10 row d-flex justify-content-end">
							<div class="col-md-3">
								<div class="row">
									<div class="col-md-4 d-flex justify-content-end m-0 p-0">
										<h4><span class="en">Grand Total</span><span class="ar"><?= getArabicTitle('Grand Total') ?></span></h4>
									</div>
									<div class="col-md-8">
										<div class="form-total_int">
											<input id="f_grand_total" name="f_grand_total" type="text" value="<?= round($billData->vatPTotal, 2) ?>" readonly class="form-control">
										</div>
									</div>
								</div>
							</div>
							<div class="col-md-3">
								<div class="row">
									<div class="col-md-4 d-flex justify-content-end p-0 m-0">
										<h4><span class="en">Expense</span><span class="ar"><?= getArabicTitle('Expense') ?></span></h4>
									</div>
									<div class="col-md-8">
										<div class="form-group">
											<input id="f_expense" name="f_expense" type="text" class="form-control" value="<?= round($billData->totalexpense, 2) ?>" onkeyup="salesTotalDiscountCalculation()">
										</div>
									</div>
								</div>
							</div>

						</div>
					</div>

					<hr />

					<?php
					$code = $Bid;
					$nrow = 1;
					?>
					<div id="loadBanksagainstBrank">

						<label for="" class="form-label add_icon en">Banks</label>
						<label for="" class="form-label add_icon ar"><?= getArabicTitle('Banks') ?></label>

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
																																				} ?>  " value="0" onKeyUp="CalculateRemainings()" <?php if ($nrow == 1) {
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
						<hr>
					</div>
					<div class="row d-flex justify-content-center">
						<div class="col-lg-3">
							<input type="submit" class="btn btn-block btn-lg btn-outline-success en" name="submit" value="Update">
							<input type="submit" class="btn btn-block btn-lg btn-outline-success ar" name="submit" value="<?= getArabicTitle('Update') ?>">
						</div>

					</div>


				</div>
			</div>
		</div>
	</div>

	<div id="fetchProductDetails"></div>
	<!-- <div id="getProductList"></div> -->
	<!-- <div id="loadUnits"></div> -->
	<!-- <input type="hidden" name="Bid" id="Bid" value="<?= $bid ?>"> -->
	<input type="hidden" name="row_count" id="row_count" value="0">
</form>


<div id="printInvoice"></div>

<script>
	$(document).ready(function() {
		$(".i-checks").iCheck({
			checkboxClass: "icheckbox_square-green",
			radioClass: "iradio_square-green",
		});
	});

	$(".clockpicker").clockpicker({
		donetext: "Select Time",
	});

	$(document).ready(function() {
		$("#Pur_name").select2({
			width: "100%",
			closeOnSelect: true,
			placeholder: "",
			//minimumInputLength: 2,
			ajax: {
				url: "Api/listings/GetPurPurchaserList",
				dataType: "JSON",
				type: "POST",
				data: function(query) {
					// add any default query here
					term: query.terms;
					return query;
				},
				processResults: function(data, params) {
					console.log(data);

					var results = [];
					results.push({
						id: 0,
						text: "Please Select Customer",
					});
					// Tranforms the top-level key of the response object from 'items' to 'results'
					data.data.forEach((e) => {
						// cName = e.CName.toLowerCase();
						// terms = params.term.toLowerCase();
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
		$("#PurType_name").select2({
			width: "100%",
			closeOnSelect: true,
			placeholder: "",
			//minimumInputLength: 2,
			ajax: {
				url: "Api/listings/GetPurTypeList",
				dataType: "JSON",
				type: "POST",
				data: function(query) {
					// add any default query here
					term: query.terms;
					return query;
				},
				processResults: function(data, params) {
					console.log(data);

					var results = [];
					results.push({
						id: 0,
						text: "Please Select Customer",
					});
					// Tranforms the top-level key of the response object from 'items' to 'results'
					data.data.forEach((e) => {
						// cName = e.CName.toLowerCase();
						// terms = params.term.toLowerCase();
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
		$("#supplier_name").select2({
			width: "100%",
			closeOnSelect: true,
			placeholder: "",
			//minimumInputLength: 2,
			ajax: {
				url: "Api/listings/GetSupplierList",
				dataType: "JSON",
				type: "POST",
				data: function(query) {
					// add any default query here
					term: query.terms;
					return query;
				},
				processResults: function(data, params) {
					console.log(data);

					var results = [];
					results.push({
						id: 0,
						text: "Please Select Customer",
					});
					// Tranforms the top-level key of the response object from 'items' to 'results'
					data.data.forEach((e) => {
						// cName = e.CName.toLowerCase();
						// terms = params.term.toLowerCase();
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

		purchase_return_addRow('<?= $Bid ?>', '<?= $Billno ?>', '<?= $sBid ?>', '<?= $LanguageId ?>');
	});
	loadBanksagainstBranchWithBill('<?= $Bid ?>', '<?= $Billno ?>', '<?= $sBid ?>')
</script>
<script>
	$(document).ready(function() {
		$("#Bid").select2({});
	});
</script>

<script>
    $(document).ready(function() {
        var lang = document.getElementById("selected_lang").value;
        changeLanguage(lang);

		$("#sal_amount1").val(<?= $billData->vatPTotal ?>);

		$(".SPType").on("ifChanged", SPType);
        SPType();

    });
</script>