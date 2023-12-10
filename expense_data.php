<?php
session_start();
$lang = $_SESSION['lang'];
?>
<!DOCTYPE html>
<html>

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0,target-densitydpi=device-dpi, user-scalable=no" />


  <title>Dashboard</title>

  <link href="assets/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/font-awesome/css/font-awesome.css" rel="stylesheet">
  <link href="assets/css/animate.css" rel="stylesheet">
  <link href="assets/css/style.css" rel="stylesheet">
  <!-- Data Table -->
  <link href="assets/css/plugins/dataTables/datatables.min.css" rel="stylesheet">
  <!-- Date  -->
  <link href="assets/css/plugins/datapicker/datepicker3.css" rel="stylesheet">
  <link href="assets/css/plugins/iCheck/custom.css" rel="stylesheet">
  <!-- Clock  -->
  <link href="assets/css/plugins/clockpicker/clockpicker.css" rel="stylesheet">
  <!-- Chosen -->
  <link href="assets/css/plugins/chosen/bootstrap-chosen.css" rel="stylesheet">
  <!-- Toastr style -->
  <link href="assets/css/plugins/toastr/toastr.min.css" rel="stylesheet">
  <!-- Select 2 -->
  <link href="assets/css/plugins/select2/select2.min.css" rel="stylesheet">
  <!-- Swithcer -->
  <link href="assets/css/plugins/switchery/switchery.css" rel="stylesheet">
  <!-- Animate Css -->
  <link href="assets/css/animate.css" rel="stylesheet">
  <link href="assets/css/custom.css" rel="stylesheet">
	<style>
		.direction {
			<?php if ($lang == 1) {
				echo " direction: ltr;";
			} else {
				echo "direction: rtl;";
			} ?>
		}

		.direction-ltr {
			direction: ltr !important;
		}

		.direction-rtl {
			direction: rtl !important;
		}
	</style>
</head>

<body class="pace-done mini-navbar">

  <div id="wrapper" class="direction">
    <?php
    include("top-header.php");

    ?>


    <div id="page-wrapper" class="gray-bg">
      <?php
      include("sidebar.php");
      $QueryMax = Run("Select max(ExpNo) as Bno from " . dbObject . "ExpenseData");
      $getBillNo = myfetch($QueryMax)->Bno + 1;

      ?>

      <div class="wrapper wrapper-content animated fadeInRight">
        <form action="javascript:SaveExpenseVoucher()" id="saveExpVoucher" method="post" class="ibox-content  ">
          <div class="row">
            <div class="col-lg-12">
              <div class="ibox">
                <div class="ibox-title">
                  <div class="row">
                    <div class="col-md-9">
                        <h5 class="mr-4 float-left en">Expense Details</h5>
												<h5 class="mr-4 float-right ar"><?= getArabicTitle('Expense Details') ?></h5>
                    </div>
                  </div>
                  <div class="ibox-tools no_envent" style="display: none">
                    <a class="collapse-link filter_act">
                      <i class="fa fa-chevron-down"></i>
                    </a>
                  </div>
                </div>

                <input type="number" id="selected_lang" name="selected_lang" value="<?php !empty($_GET['selected_lang']) ? $_GET['selected_lang'] : '2' ?>" hidden>
                <div class="row">
                  <div class="col-lg-6">
                    <div class="row">
                      <div class="col-md-4">
                        <h4><span class="en">Bill No</span><span class="ar"><?= getArabicTitle('Bill No') ?></span></h4>
                      </div>
                      <div class="col-md-8">
                        <div class="form-group">
                          <input value="<?= $getBillNo ?>" id="ExpNo" name="ExpNo" readonly type="text" class="form-control">
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-lg-6">
                    <div class="row">
                      <div class="col-md-4">
                        <h4><span class="en">Bill Date/Time</span><span class="ar"><?= getArabicTitle('Bill Date/Time') ?></span></h4>
                      </div>
                      <div class="col-md-8">
                        <div class="form-group">
                          <input type="date" value="<?= date("Y-m-d") ?>" id="ExpDate" name="ExpDate" class="form-control">
                        </div>
                      </div>
                    </div>
                  </div>



                </div>
                <div class="row">

                  <div class="col-lg-6">
                    <div class="row">
                      <div class="col-md-3">
                        <h4><span class="en">Supplier</span><span class="ar"><?= getArabicTitle('Supplier') ?></span></h4>
                      </div>

                      <div class="col-md-9">
                        <div class="form-group">
                          <div>
                            <select id="supplier_id" name="CustID" class="select2_demo_1 form-control" tabindex="4">


                            </select>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>


                  <div class="col-6">
                    <div class="row">
                      <div class="col-md-4">
                        <h4><span class="en">Remarks</span><span class="ar"><?= getArabicTitle('Remarks') ?></span></h4>
                      </div>
                      <div class="col-md-8">
                        <div class="form-group">
                          <input type="text" id="remarks" name="Remark" class="form-control">
                        </div>
                      </div>
                    </div>
                  </div>
                </div>


              </div>
            </div>
          </div>


          <div class="row">
            <div class="col-lg-12">
              <div class="ibox">
                <div class="ibox-content  filter_container">
                  <div class="row">
                    <table class="table table-bordered">
                      <thead>
                        <tr>
                          <th><span class="en">Code</span><span class="ar"><?= getArabicTitle('Code') ?></span></th>
                          <th><span class="en">Expense</span><span class="ar"><?= getArabicTitle('Expense') ?></span></th>
                          <th><span class="en">Amount</span><span class="ar"><?= getArabicTitle('Amount') ?></span></th>
                          <th><span class="en">VatAmount</span><span class="ar"><?= getArabicTitle('VatAmount') ?></span></th>
                          <th><span class="en">Bank</span><span class="ar"><?= getArabicTitle('Bank') ?></span></th>
                          <th><span class="en">IsVat</span><span class="ar"><?= getArabicTitle('IsVat') ?></span></th>
                          <th><span class="en">Action</span><span class="ar"><?= getArabicTitle('Action') ?></span></th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                          <td style="width:12%">
                            <input type="text" name="code" id="code" class="form-control" readonly>
                          </td>
                          <td style="width:25%">
                            <select id="expense" name="expense" class="select2_demo_1 form-control" tabindex="4" onChange="setmyValue(this.value,'code');loadExpenseData(this.value)">
                            </select>
                          </td>

                          <td style="width: 15%">
                            <input type="text" name="amount" id="amount" class="form-control" value="0" readonly onKeyUp="calculateVatPrice(this.value)">
                          </td>
                          <td style="width: 10%">
                            <input type="text" name="vatAmount" id="vatAmount" class="form-control" value="0" readonly>
                            <input type="hidden" name="vatPer" id="vatPer" class="form-control" value="0" readonly>
                          </td>
                          <td style="width: 25%">
                            <select id="bnkid" name="bnkid" class="select2_demo_1 form-control" tabindex="4">
                              <option value="">Please Select</option>
                              <?php
                              $getCurrentEmpData = getCurrentEmpData($_SESSION['storeCode']);
                              $bid = $getCurrentEmpData->BID;
                              $bankQ = "exec " . dbObject . "GetPaymentType @bid='$bid'";
                              $Bracnhes = Run($bankQ);
                              while ($getBranches = myfetch($Bracnhes)) {
                              ?>
                                <option value="<?php echo $getBranches->id; ?>"><?php echo $getBranches->snameEng; ?></option>
                              <?php
                              }
                              ?>
                            </select>
                          </td>
                          <td><input type="text" readonly name="isVat" id="isVat" class="form-control" readyonly></td>





                          <td id="action_id">
                            <button type="button" name="add_row" id="add_row" class="btn btn-info" onclick="addRow()">Add
                            </button>
                          </td>
                        </tr>







                      </tbody>
                    </table>
                  </div>

                  <div style="background: #80808014; height: 150px">
                    <table class="table table-bordered">
                      <thead>
                        <tr>
                          <th>#</th>
                          <th><span class="en">Code</span><span class="ar"><?= getArabicTitle('Code') ?></span></th>
                          <th><span class="en">Expense</span><span class="ar"><?= getArabicTitle('Expense') ?></span></th>
                          <th><span class="en">Amount</span><span class="ar"><?= getArabicTitle('Amount') ?></span></th>
                          <th><span class="en">VatAmount</span><span class="ar"><?= getArabicTitle('VatAmount') ?></span></th>
                          <th><span class="en">Bank</span><span class="ar"><?= getArabicTitle('Bank') ?></span></th>
                          <th><span class="en">IsVat</span><span class="ar"><?= getArabicTitle('IsVat') ?></span></th>
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
                    <div class="col-lg-4">
                      <div class="row">
                        <div class="col-md-4">
                          <h4><span class="en">Total Amount</span><span class="ar"><?= getArabicTitle('Total Amount') ?></span></h4>
                        </div>
                        <div class="col-md-8">
                          <div class="form-total_int">
                            <input value="0" id="TAmount" name="TAmount" type="text" readonly class="form-control">
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="col-lg-4">
                      <div class="row">
                        <div class="col-md-4">
                          <h4><span class="en">Vat Total</span><span class="ar"><?= getArabicTitle('Vat Total') ?></span></h4>
                        </div>
                        <div class="col-md-8">
                          <div class="form-total_int">
                            <input value="0" id="tvatTotal" name="tvatTotal" type="text" readonly class="form-control">
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="col-lg-4">
                      <div class="row">
                        <div class="col-md-4">
                          <h4><span class="en">Grand Total</span><span class="ar"><?= getArabicTitle('Grand Total') ?></span></h4>
                        </div>
                        <div class="col-md-8">
                          <div class="form-group">
                            <input value="0" id="GTotal" name="GTotal" type="text" class="form-control" readonly>
                          </div>
                        </div>
                      </div>
                    </div>




                  </div>

                  <hr />
                  <div class="row">
                    <div class="col-lg-4">
                    </div>
                    <div class="col-lg-4">
                      <input type="submit" class="btn btn-block btn-lg btn-outline-success en" name="submit" value="Save">
                      <input type="submit" class="btn btn-block btn-lg btn-outline-success ar" name="submit" value="<?= getArabicTitle('Save') ?>">
                    </div>
                    <div class="col-lg-4">
                      <div class="row">
                        <div class="col-lg-8">
                        </div>
                        <div class="col-lg-4" style="text-align: right">

                        </div>
                      </div>

                    </div>
                  </div>


                </div>
              </div>
            </div>
          </div>
          <input type="hidden" name="row_count" id="row_count" value="0">
        </form>
      </div>

      <div id="response"></div>
      <?php
      include("footer.php");
      ?>
    </div>
  </div>
  </div>
  </div>


</body>

</html>

<script src="include/expense/js.js"></script>
<script>
  $(document).ready(function() {
    $("#supplier_id").select2({
      width: '100%',
      closeOnSelect: true,
      placeholder: '',
      //minimumInputLength: 2,
      ajax: {
        url: "Api/listings/GetSupplierList",
        dataType: 'JSON',
        type: 'POST',
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
            text: "Please Select Customer"
          });
          // Tranforms the top-level key of the response object from 'items' to 'results'
          data.data.forEach(e => {
            // cName = e.CName.toLowerCase();
            // terms = params.term.toLowerCase();
            results.push({
              id: e.Id,
              text: e.CName
            });
          });
          return {
            results: results
          };
        },
      },
      templateResult: formatResult
    });

    function formatResult(d) {
      if (d.loading) {
        return d.text;
      }
      // Creating an option of each id and text
      $d = $('<option/>').attr({
        'value': d.value
      }).text(d.text);

      return $d;
    }



    $("#expense").select2({
      width: '100%',
      closeOnSelect: true,
      placeholder: '',
      //minimumInputLength: 2,
      ajax: {
        url: "Api/listings/GetExpenseList",
        dataType: 'JSON',
        type: 'POST',
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
            text: "Please Select Customer"
          });
          // Tranforms the top-level key of the response object from 'items' to 'results'
          data.data.forEach(e => {
            // cName = e.CName.toLowerCase();
            // terms = params.term.toLowerCase();
            results.push({
              id: e.Id,
              text: e.CName
            });
          });
          return {
            results: results
          };
        },
      },
      templateResult: formatResult
    });

    function formatResult(d) {
      if (d.loading) {
        return d.text;
      }
      // Creating an option of each id and text
      $d = $('<option/>').attr({
        'value': d.value
      }).text(d.text);

      return $d;
    }
    $("#bnkid").select2({
      width: '100%',
      closeOnSelect: true,

    });




  });
</script>