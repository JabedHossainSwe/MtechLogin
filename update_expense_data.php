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
      $bid = addslashes($_REQUEST['bid']);
      $bno = addslashes($_REQUEST['bno']);
      $QueryMax = Run("Select * from " . dbObject . "ExpenseData where ExpNo = '" . $bno . "' and bid = '" . $bid . "'");
      $getMain = myfetch($QueryMax);
      ?>

      <div class="wrapper wrapper-content animated fadeInRight">
        <form action="javascript:updateExpenseVoucher()" id="saveExpVoucher" method="post" class="ibox-content  ">
          <input type="hidden" name="bid" value="<?= $bid ?>">
          <input type="hidden" name="ExpDate" value="<?= $getMain->ExpDate ?>">
          <div class="row">
            <div class="col-lg-12">
              <div class="ibox">
                <div class="ibox-title">
                  <div class="row">
                    <div class="col-md-9">
                      <h5 class="mr-4"><span class="en">Expense Details</span><span class="ar"><?= getArabicTitle('Expense Details') ?></span></h5>
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
                          <input value="<?= $getMain->ExpNo ?>" id="ExpNo" name="ExpNo" readonly type="text" class="form-control">
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
                          <input value="<?= $getMain->ExpDate ?>" id="ExpDate" name="ExpDate" readonly class="form-control">
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
                              <?php
                              if (isset($_GET['CustID']) && !empty($_GET['CustID'])) {
                              ?>
                                <option value="<?php echo $_GET['CustID']; ?>" selected>
                                  <?php echo getSupplierDetails($_GET['CustID'])->CName; ?>
                                </option>
                              <?php
                              }
                              ?>


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
                          <input type="text" id="remarks" name="Remark" class="form-control" value="<?= $getMain->Remark ?>">
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
                            <button type="button" name="add_row" id="add_row" class="btn btn-info" onclick="addRow()"><span class="en">Add</span><span class="ar"><?= getArabicTitle('Add') ?></span></button>
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
                        <?php
                        $row_count = 1;
                        $QueryDet = Run("Select * from " . dbObject . "ExpenseDataDetail where ExpNo = '" . $bno . "' and bid = '" . $bid . "'");
                        while ($load = myfetch($QueryDet)) {
                          $code = $load->ExpID;
                          $amount = $load->Amount;


                          $query = Run("Select * from " . dbObject . "Expense where GId = '" . $code . "'");
                          $fetch = myfetch($query);
                          $NameEng = $fetch->NameEng;

                          $bnkid = $load->bnkid;
                          $bnQ = Run("Select * from bank where id = '" . $load->bnkid . "'");
                          $bnkName = myfetch($bnQ)->NameEng;

                          $vatAmount = $load->GTotal;

                          $isVat = "No";
                          if ($load->IsVat == 1) {
                            $isVat = "Yes";
                          }

                          $vatPer = $load->VatPer;

                        ?>


                          <tr id="row_<?php echo $row_count ?>">
                            <td><?= $row_count ?></td>
                            <td><input type="hidden" name="code<?php echo $row_count ?>" id="code<?php echo $row_count ?>" value="<?php echo $code ?>"><?php echo $code ?></td>
                            <td>
                              <input type="hidden" name="expense<?php echo $row_count ?>" id="expense<?php echo $row_count ?>" value="<?php echo $NameEng ?>">

                              <?php echo $NameEng ?>
                            </td>
                            <td>
                              <input type="hidden" name="amount<?php echo $row_count ?>" class="t_amount" id="amount<?php echo $row_count ?>" value="<?php echo $amount ?>">
                              <?php echo $amount ?>
                            </td>
                            <td>
                              <input type="hidden" name="vatAmount<?php echo $row_count ?>" class="t_vatAmt" id="vatAmount<?php echo $row_count ?>" value="<?php echo $vatAmount ?>">
                              <?php echo $vatAmount ?>
                            </td>
                            <td>
                              <input type="hidden" name="bnkid<?php echo $row_count ?>" class="" id="bnkid<?php echo $row_count ?>" value="<?php echo $bnkid ?>">
                              <input type="hidden" name="bnkName<?php echo $row_count ?>" class="" id="bnkName<?php echo $row_count ?>" value="<?php echo $bnkName ?>">

                              <?php echo $bnkName ?>
                            </td>
                            <td><input type="hidden" name="isVat<?php echo $row_count ?>" class="" id="isVat<?php echo $row_count ?>" value="<?php echo $isVat ?>"><input type="hidden" name="vatPer<?php echo $row_count ?>" class="t_vatPer" id="vatPer<?php echo $row_count ?>" value="<?php echo $vatPer ?>">
                              <?= $isVat ?>
                            </td>
                            <td><i class="fa fa-pencil" onclick="edit_row(<?php echo $row_count ?>)"></i>&nbsp;&nbsp;&nbsp;<i class="fa fa-trash" onclick="delete_row(<?php echo $row_count ?>)"></i></td>

                          </tr>
                        <?php
                          $row_count++;
                        }
                        ?>

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
                            <input value="<?= $getMain->Amount ?>" id="TAmount" name="TAmount" type="text" readonly class="form-control">
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
                            <input value="<?= $getMain->VatAmount ?>" id="tvatTotal" name="tvatTotal" type="text" readonly class="form-control">
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
                            <input value="<?= $getMain->GTotal ?>" id="GTotal" name="GTotal" type="text" class="form-control" readonly>
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
                      <input type="submit" class="btn btn-block btn-lg btn-outline-success" name="submit" value="Save">
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
          <input type="hidden" name="row_count" id="row_count" value="<?= $row_count - 1 ?>">
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