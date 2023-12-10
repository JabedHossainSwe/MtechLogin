<div class="modal inmodal" id="myModal2" role="dialog" aria-hidden="true">
	<div class="modal-dialog" id="mdlLg">
		<div class="modal-content animated flipInY">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only en">Close</span><span class="sr-only ar"><?= getArabicTitle('Close') ?></span></button>
				<h4 class="modal-title" id="modalTitle"></h4>
				<small class="font-bold" id="helperText"></small>
			</div>

			<div id="modalContent">

			</div>
		</div>
	</div>
</div>

<!-- Email Sale Popup -->
<div class="modal fade" id="emailpopup" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLongTitle" style="text-align: center"><span class="en">Send Email</span><span class="ar"><?= getArabicTitle('Send Email') ?></span></h5>
				<!--                <button type="button" class="close" data-dismiss="modal" aria-label="Close">-->
				<!--                    <span aria-hidden="true">&times;</span>-->
				<!--                </button>-->
			</div>
			<div id="sendemailform"></div>
			<form action="javascript:sendemailform()">
				<div class="modal-body">
					<label><span class="en">Email</span><span class="ar"><?= getArabicTitle('Email') ?></span></label>
					<input type="email" name="email" id="email" placeholder="Enter Email" class="form-control" required>
					<input type="hidden" name="bill_id" id="bill_id">
					<input type="hidden" name="b_name" id="b_name">

					<label class="mt-2"><span class="en">Language</span><span class="ar"><?= getArabicTitle('Language') ?></span></label>
					<select class="form-control" name="email_lang" id="email_lang">
						<option value="1">English</option>
						<option value="2">Arabic</option>
					</select>
				</div>
				<div class="modal-footer">
					<!--                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>-->
					<button type="submit" class="btn btn-primary"><span class="en">Send</span><span class="ar"><?= getArabicTitle('Send') ?></span></button>
				</div>
			</form>
		</div>
	</div>
</div>

<!-- Print Sale Report Email Popup -->
<div class="modal fade" id="PrintPopup" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLongTitle" style="text-align: center"><span class="en">Print Bill</span><span class="ar"><?= getArabicTitle('Print Bill') ?></span></h5>

			</div>
			<form action="javascript:Print_report_details()">
				<div class="modal-body">

					<input type="hidden" name="bill_query" id="bill_query">
					<input type="hidden" name="bill_type" id="bill_type">
					<input type="hidden" name="b_group_by" id="b_group_by">

					<label class="mt-2"><span class="en">Language</span><span class="ar"><?= getArabicTitle('Language') ?></span></label>
					<select class="form-control" id="print_language" name="print_language">
						<option value="1">English</option>
						<option value="2">Arabic</option>
					</select>
				</div>
				<div class="modal-footer">
					<button type="submit" class="btn btn-primary"><span class="en">Print</span><span class="ar"><?= getArabicTitle('Print') ?></span></button>
				</div>
			</form>
		</div>
	</div>
</div>


<!-- Print Sale Voucher Popup -->
<div class="modal fade" id="PrintPopupVoucher" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLongTitle" style="text-align: center"><span class="en">Print Bill</span><span class="ar"><?= getArabicTitle('Print Bill') ?></span></h5>

			</div>
			<form action="">
				<div class="modal-body">

					<input type="hidden" name="bill_query" id="bill_query">
					<input type="hidden" name="bill_type" id="bill_type">

					<label class="mt-2"><span class="en">Language</span><span class="ar"><?= getArabicTitle('Language') ?></span></label>
					<select class="form-control" id="print_language" name="print_language">
						<option value="1">English</option>
						<option value="2">Arabic</option>
					</select>

					<div class="row pt-2">
						<div class="col-6">
							<a href="#" onclick="showEmail()" class="btn btn-success d-block"><span class="icons_d"><i class="fa fa-envelope-o pr-2" aria-hidden="true"></i></span> <span class="en">Email</span><span class="ar"><?= getArabicTitle('Email') ?></span></a>
						</div>
						<div class="col-6">
							<a href="javascript:Print_report_details();" class="btn btn-success d-block"><span class="icons_d"><i class="fa fa-print pr-2" aria-hidden="true"></i></span> <span class="en">Print</span><span class="ar"><?= getArabicTitle('Print') ?></span></a>
						</div>

						<div class="col-12 mt-3" id="emailSection" style="display: none;">
							<div class="row">
								<div class="col-md-3">
									<h4><span class="en">Email</span><span class="ar"><?= getArabicTitle('Email') ?></span></h4>
								</div>
								<div class="col-md-9">
									<div class="form-group">
										<input type="email" id="printEmail" name="printEmail" class="form-control">
									</div>
								</div>
							</div>
							<div class="row modal-footer">
								<button type="button" onclick="sendemailVoucher()" class="btn btn-primary"><span class="en">Send</span><span class="ar"><?= getArabicTitle('Send') ?></span></button>
							</div>
						</div>

					</div>

				</div>
			</form>
		</div>
	</div>
</div>


<div class="modal fade" id="ignismyModal" aria-labelledby="exampleModalCenterTitle" role="dialog">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h2><span class="en">Email Notification</span><span class="ar"><?= getArabicTitle('Email Notification') ?></span></h2>
			</div>
			<div class="modal-body">
				<div class="thank-you-pop" style="text-align: center;">
					<img style="height: 50% !important; width: 15% !important;" src="http://goactionstations.co.uk/wp-content/uploads/2017/03/Green-Round-Tick.png" alt="">
					<h1><span class="en">Email Sent!</span><span class="ar"><?= getArabicTitle('Email Sent!') ?></span></h1>
					<!--                            <p>Your submission is received and we will contact you soon</p>-->
					<!--                            <h3 class="cupon-pop">Your Id: <span>12345</span></h3>-->
				</div>
			</div>

		</div>
	</div>
</div>

<!-- Load Stock Popup -->
<div class="modal fade" id="stockModal" aria-labelledby="exampleModalCenterTitle" role="dialog">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h2><span class="en">Choose Option</span><span class="ar"><?= getArabicTitle('Choose Option') ?></span></h2>
			</div>
			<div class="modal-body">
				<button type="button" onclick="loadStock(1)" class="btn btn-secondary" data-dismiss="modal" style="width: 100%;margin-bottom: 8px;"><span class="en">Cost price</span><span class="ar"><?= getArabicTitle('Cost price') ?></span></button>
				<button type="button" onclick="loadStock(2)" class="btn btn-primary" data-dismiss="modal" style="width: 100%;margin-bottom: 8px;"><span class="en">Sale Price</span><span class="ar"><?= getArabicTitle('Sale Price') ?></span></button>
				<button type="button" onclick="loadStock(3)" class="btn btn-danger" data-dismiss="modal" style="width: 100%;margin-bottom: 8px;"><span class="en">Purchase Price</span><span class="ar"><?= getArabicTitle('Purchase Price') ?></span></button>
			</div>

		</div>
	</div>
</div>

<!-- Language Chagne Popup -->
<div class="modal fade" id="exampleModal" aria-labelledby="exampleModalCenterTitle" role="dialog">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h2><span class="en">Choose Option</span><span class="ar"><?= getArabicTitle('Choose Option') ?></span></h2>
			</div>
			<div class="modal-body">
				<button type="button" onclick="changeLanguage(1)" class="btn btn-secondary" data-dismiss="modal" style="width: 100%;margin-bottom: 8px;">English</span></button>
				<button type="button" onclick="changeLanguage(2)" class="btn btn-primary" data-dismiss="modal" style="width: 100%;margin-bottom: 8px;"><span class="en">Arabic</span><span class="ar"><?= getArabicTitle('Arabic') ?></span></button>
			</div>

		</div>
	</div>
</div>

<div class="modal inmodal" id="chartPopup" role="dialog" aria-hidden="true">
	<div class="modal-dialog chartPopup" id="mdlLg" style="max-width: 90%; max-height: 80vh; height: 80vh;">
		<div class="modal-content animated flipInY">
			<div class="modal-header">
				<button type="button" class="close en" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
				<button type="button" class="close ar" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only"><?= getArabicTitle('Close') ?></span></button>
				<h4 class="modal-title" id="modalTitle"></h4>
				<small class="font-bold" id="helperText"></small>
			</div>

			<div class="modal-body" id="chartModel">

			</div>

		</div>
	</div>
</div>

<div class="footer" style="text-align: center; position:fixed;">
	<!-- <div class="float-right">
                10GB of <strong>250GB</strong> Free.
            </div> -->
	<div>
		<span class="en">
			<strong>Copyright</strong> Mteck Reporting &copy; 2022
		</span>
		<span id="ar">
			<?= getArabicTitle('Mteck Reporting') ?> <strong><?= getArabicTitle('Copyright') ?></strong> &copy; 2022
		</span>
	</div>
</div>


<!-- Mainly scripts -->
<script src="assets/js/jquery-3.1.1.min.js"></script>
<script src="assets/js/popper.min.js"></script>
<script src="assets/js/bootstrap.js"></script>
<script src="assets/js/plugins/metisMenu/jquery.metisMenu.js"></script>
<script src="assets/js/plugins/slimscroll/jquery.slimscroll.min.js"></script>

<!-- Custom and plugin javascript -->
<script src="assets/js/inspinia.js"></script>
<script src="assets/js/plugins/pace/pace.min.js"></script>

<!-- Flot -->
<script src="assets/js/plugins/flot/jquery.flot.js"></script>
<script src="assets/js/plugins/flot/jquery.flot.tooltip.min.js"></script>
<script src="assets/js/plugins/flot/jquery.flot.resize.js"></script>

<!-- ChartJS-->


<!-- Datatable -->
<script src="assets/js/plugins/dataTables/datatables.min.js"></script>
<script src="assets/js/plugins/dataTables/dataTables.bootstrap4.min.js"></script>
<script src="assets/js/plugins/select2/select2.full.min.js"></script>

<!-- Date range use moment.js same as full calendar plugin -->
<script src="assets/js/plugins/fullcalendar/moment.min.js"></script>

<!-- Date picker -->
<script src="assets/js/plugins/datapicker/bootstrap-datepicker.js"></script>

<script src="assets/js/plugins/iCheck/icheck.min.js"></script>
<!-- Clock picker -->
<script src="assets/js/plugins/clockpicker/clockpicker.js"></script>
<!-- Chosen -->
<script src="assets/js/plugins/chosen/chosen.jquery.js"></script>
<!-- Toastr script -->
<script src="assets/js/plugins/toastr/toastr.min.js"></script>
<!-- Switchery -->
<script src="assets/js/plugins/switchery/switchery.js"></script>
<script src="assets/js/generic.js"></script>
<!-- Morris -->
<!-- <script src="assets/js/plugins/morris/raphael-2.1.0.min.js"></script>
<script src="assets/js/plugins/morris/morris.js"></script> -->

<!-- Morris demo data-->
<!-- <script src="assets/js/demo/morris-demo.js"></script> -->
<style>
	.errorDiv {
		color: red;
		font-size: x-small;
		font-weight: bold;
	}
</style>

<!-- <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.css"> -->

<!-- <script src="assets/js/plugins/morris/raphael-2.1.0.min.js"></script>
<script src="assets/js/plugins/morris/morris.js"></script>

<script>
	function pageload_dashboard() {
		window.morrisObj = new Morris.Line({
			// ID of the element in which to draw the chart.
			element: 'salesChart',
			// Chart data records -- each entry in this array corresponds to a point on
			// the chart.
			data: [{
					year: '2012',
					value: 5
				},
				{
					year: '2013',
					value: 5
				},
				{
					year: '2010',
					value: 20
				},
				{
					year: '2011',
					value: 10
				},

				{
					year: '2014',
					value: 20
				}
			],
			// The name of the data record attribute that contains x-values.
			xkey: 'year',
			// A list of names of data record attributes that contain y-values.
			ykeys: ['value'],
			// Labels for the ykeys -- will be displayed when you hover over the
			// chart.
			labels: ['Value'],
			resize: true
		});

		window.morrisObj = new Morris.Line({
			// ID of the element in which to draw the chart.
			element: 'salesProfitChart',
			// Chart data records -- each entry in this array corresponds to a point on
			// the chart.
			data: [{
					year: '2012',
					value: 5
				},
				{
					year: '2013',
					value: 5
				},
				{
					year: '2010',
					value: 20
				},
				{
					year: '2011',
					value: 10
				},

				{
					year: '2014',
					value: 20
				}
			],
			// The name of the data record attribute that contains x-values.
			xkey: 'year',
			// A list of names of data record attributes that contain y-values.
			ykeys: ['value'],
			// Labels for the ykeys -- will be displayed when you hover over the
			// chart.
			labels: ['Value'],
			resize: true
		});

		window.morrisObj = new Morris.Line({
			// ID of the element in which to draw the chart.
			element: 'expenseChart',
			// Chart data records -- each entry in this array corresponds to a point on
			// the chart.
			data: [{
					year: '2012',
					value: 5
				},
				{
					year: '2013',
					value: 5
				},
				{
					year: '2010',
					value: 20
				},
				{
					year: '2011',
					value: 10
				},

				{
					year: '2014',
					value: 20
				}
			],
			// The name of the data record attribute that contains x-values.
			xkey: 'year',
			// A list of names of data record attributes that contain y-values.
			ykeys: ['value'],
			// Labels for the ykeys -- will be displayed when you hover over the
			// chart.
			labels: ['Value'],
			resize: true
		});

		window.morrisObj = new Morris.Line({
			// ID of the element in which to draw the chart.
			element: 'customerChart',
			// Chart data records -- each entry in this array corresponds to a point on
			// the chart.
			data: [{
					year: '2012',
					value: 5
				},
				{
					year: '2013',
					value: 5
				},
				{
					year: '2010',
					value: 20
				},
				{
					year: '2011',
					value: 10
				},

				{
					year: '2014',
					value: 20
				}
			],
			// The name of the data record attribute that contains x-values.
			xkey: 'year',
			// A list of names of data record attributes that contain y-values.
			ykeys: ['value'],
			// Labels for the ykeys -- will be displayed when you hover over the
			// chart.
			labels: ['Value'],
			resize: true
		});

		window.morrisObj = new Morris.Line({
			// ID of the element in which to draw the chart.
			element: 'supplierChart',
			// Chart data records -- each entry in this array corresponds to a point on
			// the chart.
			data: [{
					year: '2012',
					value: 5
				},
				{
					year: '2013',
					value: 5
				},
				{
					year: '2010',
					value: 20
				},
				{
					year: '2011',
					value: 10
				},

				{
					year: '2014',
					value: 20
				}
			],
			// The name of the data record attribute that contains x-values.
			xkey: 'year',
			// A list of names of data record attributes that contain y-values.
			ykeys: ['value'],
			// Labels for the ykeys -- will be displayed when you hover over the
			// chart.
			labels: ['Value'],
			resize: true
		});

		window.morrisObj = new Morris.Line({
			// ID of the element in which to draw the chart.
			element: 'stockReportChart',
			// Chart data records -- each entry in this array corresponds to a point on
			// the chart.
			data: [{
					year: '2012',
					value: 5
				},
				{
					year: '2013',
					value: 5
				},
				{
					year: '2010',
					value: 20
				},
				{
					year: '2011',
					value: 10
				},

				{
					year: '2014',
					value: 20
				}
			],
			// The name of the data record attribute that contains x-values.
			xkey: 'year',
			// A list of names of data record attributes that contain y-values.
			ykeys: ['value'],
			// Labels for the ykeys -- will be displayed when you hover over the
			// chart.
			labels: ['Value'],
			resize: true
		});

		window.morrisObj = new Morris.Line({
			// ID of the element in which to draw the chart.
			element: 'highlySaleChart',
			// Chart data records -- each entry in this array corresponds to a point on
			// the chart.
			data: [{
					year: '2012',
					value: 5
				},
				{
					year: '2013',
					value: 5
				},
				{
					year: '2010',
					value: 20
				},
				{
					year: '2011',
					value: 10
				},

				{
					year: '2014',
					value: 20
				}
			],
			// The name of the data record attribute that contains x-values.
			xkey: 'year',
			// A list of names of data record attributes that contain y-values.
			ykeys: ['value'],
			// Labels for the ykeys -- will be displayed when you hover over the
			// chart.
			labels: ['Value'],
			resize: true
		});

		window.morrisObj = new Morris.Line({
			// ID of the element in which to draw the chart.
			element: 'totalProductChart',
			// Chart data records -- each entry in this array corresponds to a point on
			// the chart.
			data: [{
					year: '2012',
					value: 5
				},
				{
					year: '2013',
					value: 5
				},
				{
					year: '2010',
					value: 20
				},
				{
					year: '2011',
					value: 10
				},

				{
					year: '2014',
					value: 20
				}
			],
			// The name of the data record attribute that contains x-values.
			xkey: 'year',
			// A list of names of data record attributes that contain y-values.
			ykeys: ['value'],
			// Labels for the ykeys -- will be displayed when you hover over the
			// chart.
			labels: ['Value'],
			resize: true
		});

		window.morrisObj = new Morris.Line({
			// ID of the element in which to draw the chart.
			element: 'highExpenseChart',
			// Chart data records -- each entry in this array corresponds to a point on
			// the chart.
			data: [{
					year: '2012',
					value: 5
				},
				{
					year: '2013',
					value: 5
				},
				{
					year: '2010',
					value: 20
				},
				{
					year: '2011',
					value: 10
				},

				{
					year: '2014',
					value: 20
				}
			],
			// The name of the data record attribute that contains x-values.
			xkey: 'year',
			// A list of names of data record attributes that contain y-values.
			ykeys: ['value'],
			// Labels for the ykeys -- will be displayed when you hover over the
			// chart.
			labels: ['Value'],
			resize: true
		});

		window.morrisObj = new Morris.Line({
			// ID of the element in which to draw the chart.
			element: 'lowExpenseChart',
			// Chart data records -- each entry in this array corresponds to a point on
			// the chart.
			data: [{
					year: '2012',
					value: 5
				},
				{
					year: '2013',
					value: 5
				},
				{
					year: '2010',
					value: 20
				},
				{
					year: '2011',
					value: 10
				},

				{
					year: '2014',
					value: 20
				}
			],
			// The name of the data record attribute that contains x-values.
			xkey: 'year',
			// A list of names of data record attributes that contain y-values.
			ykeys: ['value'],
			// Labels for the ykeys -- will be displayed when you hover over the
			// chart.
			labels: ['Value'],
			resize: true
		});

		window.morrisObj = new Morris.Line({
			// ID of the element in which to draw the chart.
			element: 'customerNameChart',
			// Chart data records -- each entry in this array corresponds to a point on
			// the chart.
			data: [{
					year: '2012',
					value: 5
				},
				{
					year: '2013',
					value: 5
				},
				{
					year: '2010',
					value: 20
				},
				{
					year: '2011',
					value: 10
				},

				{
					year: '2014',
					value: 20
				}
			],
			// The name of the data record attribute that contains x-values.
			xkey: 'year',
			// A list of names of data record attributes that contain y-values.
			ykeys: ['value'],
			// Labels for the ykeys -- will be displayed when you hover over the
			// chart.
			labels: ['Value'],
			resize: true
		});

		window.morrisObj = new Morris.Line({
			// ID of the element in which to draw the chart.
			element: 'supplierNameChart',
			// Chart data records -- each entry in this array corresponds to a point on
			// the chart.
			data: [{
					year: '2012',
					value: 5
				},
				{
					year: '2013',
					value: 5
				},
				{
					year: '2010',
					value: 20
				},
				{
					year: '2011',
					value: 10
				},

				{
					year: '2014',
					value: 20
				}
			],
			// The name of the data record attribute that contains x-values.
			xkey: 'year',
			// A list of names of data record attributes that contain y-values.
			ykeys: ['value'],
			// Labels for the ykeys -- will be displayed when you hover over the
			// chart.
			labels: ['Value'],
			resize: true
		});

		window.morrisObj = new Morris.Line({
			// ID of the element in which to draw the chart.
			element: 'lowSaleChart',
			// Chart data records -- each entry in this array corresponds to a point on
			// the chart.
			data: [{
					year: '2012',
					value: 5
				},
				{
					year: '2013',
					value: 5
				},
				{
					year: '2010',
					value: 20
				},
				{
					year: '2011',
					value: 10
				},

				{
					year: '2014',
					value: 20
				}
			],
			// The name of the data record attribute that contains x-values.
			xkey: 'year',
			// A list of names of data record attributes that contain y-values.
			ykeys: ['value'],
			// Labels for the ykeys -- will be displayed when you hover over the
			// chart.
			labels: ['Value'],
			resize: true
		});
	}

	$(document).ready(function() {
		pageload_dashboard();
	});
</script> -->