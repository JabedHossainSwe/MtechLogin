<?php
session_start();
$lang = $_SESSION['lang'];
?>
<!DOCTYPE html>
<html>

<head>

  <meta charset="utf-8">
  <meta name="viewport"
    content="initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0,target-densitydpi=device-dpi, user-scalable=no" />


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


    <div id="page-wrapper" class="gray-bg">

      <div class="row wrapper border-bottom white-bg page-heading pb-2">
        <!-- <div class="col-lg-10"> -->
        <h2 class="font-weight-bold"><span class="en float-left">Customers</span><span class="ar float-right"></span>
        </h2>

        <!-- </div> -->
      </div>
      <div class="wrapper wrapper-content animated fadeInRight">
        <!-- <div class="row mb-1">
                    <div class="col-md-6 col-8">
                        <button type="button" class="btn btn-w-m btn-default eng">English</button>
                        <button type="button" class="btn btn-w-m btn-default ara">Arabic</button>
                    </div>
                    <div class="col-md-6 col-4">

                    </div>

                </div> -->
        <div class="row mb-1">
          <div class="col-12">

            <a href="customer.php" class="btn btn-success btn-actions float-right submit-next"
              style="margin-right: 20px;"><span class="en">List Customers</span><span class="ar"></span></a>


            <a href="customer_area.php" class="btn btn-success btn-actions float-right submit-next"
              style="margin-right: 20px;"><span class="en">Area</span><span class="ar"></span> </a>

            <a href="currency.php" class="btn btn-success btn-actions float-right submit-next"
              style="margin-right: 20px;"><span class="en">Currency</span><span class="ar"></span> </a>


          </div>

        </div>
        <div class="row">
          <div class="col-lg-12">
            <div class="ibox">
              <div class="ibox-title">
                <div class="row">
                  <!-- <div class="col-md-9"> -->
                  <h5 class="mr-4"><span class="en">Add Customer</span><span class="ar"></span></h5>
                  <!-- </div> -->

                </div>

                <div class="ibox-tools no_envent">
                  <div id="save"></div>

                </div>
              </div>
              <div id="editVoucher">
                <form action="javascript:saveCustomer()" id="save_form" method="post"
                  class="ibox-content filter_container">

                  <input type="number" id="selected_lang" name="selected_lang"
                    value="<?php !empty($_GET['selected_lang']) ? $_GET['selected_lang'] : '1' ?>" hidden>
                  <div class="row">

                    <div class="col-md-6">
                      <div class="row">
                        <div class="col-md-3">
                          <h4><span class="en">Code</span><span class="ar"></span></h4>
                        </div>

                        <div class="col-md-3">
                          <div class="form-group">
                            <input value="<?php echo $getData; ?>" id="CCode" name="CCode" type="text"
                              class="grpreq form-control">
                            <span class="help-block errorDiv" id="CCode_error"></span>

                          </div>
                        </div>
                        <div class="col-md-6">
                          <button type="button" class="btn btn-success" onclick="reloadVoucher()"><i
                              class="fa fa-refresh"></i></button>

                          <button type="button" class="btn btn-success" onclick="" disabled><i
                              class="fa fa-forward"></i></i></button>
                          <button type="button" class="btn btn-success" onclick="" disabled><i
                              class="fa fa-trash"></i></button>
                          <button type="button" class="btn btn-success" onclick="" disabled><i
                              class="fa fa-plus"></i></button>

                        </div>
                      </div>
                    </div>


                    <div class="col-md-3">
                      <div class="row">
                        <div class="col-md-4">
                          <h4><span class="en">Branch</span><span class="ar"></span></h4>
                        </div>

                        <div class="col-md-8">


                          <div>
                            <select id="branch" name="bid" class="select2_demo_1 form-control" tabindex="4" required>
                            </select>

                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-3">
                      <div class="row">
                        <div class="col-md-4">
                          <h4><span class="en">Name </span><span class="ar"></span></h4>
                        </div>
                        <div class="col-md-8">
                          <div class="form-group">
                            <input id="CName" value="" name="CName" type="text" class="grpreq form-control"
                              maxlength="400">
                            <span class="help-block errorDiv" id="CName_error"></span>

                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="row">
                        <div class="col-md-4">
                          <h4><span class="en">Description</span><span class="ar"></span></h4>
                        </div>
                        <div class="col-md-8">
                          <div class="form-group">
                            <input id="Description" value="" name="Description" type="text" class="form-control"
                              maxlength="400">
                            <span class="help-block errorDiv" id="Description_error"></span>

                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="row">
                        <div class="col-md-4">
                          <h4><span class="en">Address</span><span class="ar"></span></h4>
                        </div>
                        <div class="col-md-8">
                          <div class="form-group">
                            <input id="Address" value="" name="Address" type="text" class="form-control"
                              maxlength="400">
                            <span class="help-block errorDiv" id="Address_error"></span>

                          </div>
                        </div>
                      </div>
                    </div>


                    <div class="col-md-4">
                      <div class="row">
                        <div class="col-md-4">
                          <h4><span class="en">Phone</span><span class="ar"></span></h4>
                        </div>
                        <div class="col-md-8">
                          <div class="form-group">
                            <input id="Contact1" value="" name="Contact1" type="number" class="form-control"
                              maxlength="400">
                            <span class="help-block errorDiv" id="Contact1_error"></span>

                          </div>
                        </div>
                      </div>
                    </div>

                    <div class="col-md-4">
                      <div class="row">
                        <div class="col-md-4">
                          <h4><span class="en">Mobile</span><span class="ar"></span></h4>
                        </div>
                        <div class="col-md-8">
                          <div class="form-group">
                            <input id="Contact2" value="" name="Contact2" type="number" class="form-control"
                              maxlength="400">
                            <span class="help-block errorDiv" id="Contact2_error"></span>

                          </div>
                        </div>
                      </div>
                    </div>

                    <div class="col-md-4">
                      <div class="row">
                        <div class="col-md-4">
                          <h4><span class="en">CR Number</span><span class="ar"></span></h4>
                        </div>
                        <div class="col-md-8">
                          <div class="form-group">
                            <input id="CRNo" value="" name="CRNo" type="number" class="form-control" maxlength="25">

                          </div>
                        </div>
                      </div>
                    </div>

                    <div class="col-md-4">
                      <div class="row">
                        <div class="col-md-4">
                          <h4><span class="en">Nan Reg Add</span><span class="ar"></span></h4>
                        </div>
                        <div class="col-md-8">
                          <div class="form-group">
                            <input id="NANRegAdd" value="" name="NANRegAdd" type="text" class="form-control"
                              maxlength="255">

                          </div>
                        </div>
                      </div>
                    </div>


                    <div class="col-md-4">
                      <div class="row">
                        <div class="col-md-4">
                          <h4><span class="en">Fax</span><span class="ar"></span></h4>
                        </div>
                        <div class="col-md-8">
                          <div class="form-group">
                            <input id="Fax" value="" name="Fax" type="text" class="form-control" maxlength="100">

                          </div>
                        </div>
                      </div>
                    </div>


                    <div class="col-md-4">
                      <div class="row">
                        <div class="col-md-4">
                          <h4><span class="en">Size</span><span class="ar"></span></h4>
                        </div>
                        <div class="col-md-8">
                          <div class="form-group">
                            <input id="sSize" value="" name="sSize" type="text" class="form-control" maxlength="10">

                          </div>
                        </div>
                      </div>
                    </div>


                    <div class="col-md-4">
                      <div class="row">
                        <div class="col-md-4">
                          <h4><span class="en">Email</span><span class="ar"></span></h4>
                        </div>
                        <div class="col-md-8">
                          <div class="form-group">
                            <input id="Email" value="" name="Email" type="email" class=" form-control" maxlength="100">
                            <span class="help-block errorDiv" id="Email_error"></span>

                          </div>
                        </div>
                      </div>
                    </div>


                    <div class="col-md-4">
                      <div class="row">
                        <div class="col-md-4">
                          <h4><span class="en">Opening Balance</span><span class="ar"></span></h4>
                        </div>
                        <div class="col-md-8">
                          <div class="form-group">
                            <input id="OpenBalance" value="0" name="OpenBalance" type="number" class="form-control">

                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="row">
                        <div class="col-md-4">
                          <h4><span class="en">Opening Balance Debit</span><span class="ar"></span></h4>
                        </div>
                        <div class="col-md-8">
                          <div class="form-group">
                            <input id="openDebit" value="0" name="openDebit" type="number" class="grpreq form-control">
                            <span class="help-block errorDiv" id="openDebit_error"></span>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="row">
                        <div class="col-md-4">

                          <h4><span class="en">Cust Area</span><span class="ar"></span></h4>


                        </div>
                        <div class="col-md-5 pr-0 mr-0">
                          <div class="form-group" id="custAreadiv">
                            <select class="grpreq select2_demo_1 form-control" id="custAreaId" name="custAreaId">
                              <option value="">Please Select</option>
                            </select>
                            <span class="help-block errorDiv" id="custAreaId_error"></span>

                          </div>
                        </div>
                        <div class="col-md-3">
                          <div class="add_ref_icons d-flex justify-content-around">
                            <button
                              onclick="window.open('customer_area.php', '_blank', 'location=yes,height=570,width=600,scrollbars=yes,status=yes');"
                              class="btn btn-info btn-circle" type="button"><i class="fa fa-plus"></i> </button>

                            <button onClick="refreshItems('custAreadiv','custAreaId','customer_area')"
                              class="btn btn-warning  btn-circle" type="button"><i class="fa fa-refresh"></i> </button>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="row">
                        <div class="col-md-4">
                          <h4><span class="en">Customer Dis%</span><span class="ar"></span></h4>
                        </div>
                        <div class="col-md-8">
                          <div class="form-group">
                            <input id="custDisPer" value="0" name="custDisPer" type="number" class="form-control">

                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="row">
                        <div class="col-md-4">
                          <h4><span class="en">Credit Days</span><span class="ar"></span></h4>
                        </div>
                        <div class="col-md-8">
                          <div class="form-group">
                            <input id="CreditDays" value="0" name="grpreq CreditDays" type="text" class="form-control">

                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="row">
                        <div class="col-md-4">
                          <h4><span class="en">SalesMan</span><span class="ar"></span></h4>
                        </div>
                        <div class="col-md-8">
                          <div class="form-group">
                            <select class="select2_demo_1 form-select" id="Salesman" name="Salesman">
                            </select>

                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="row">
                        <div class="col-md-4">
                          <h4><span class="en">Vat Number</span><span class="ar"></span></h4>
                        </div>
                        <div class="col-md-8">
                          <div class="form-group">
                            <input id="VatNo" value="" name="VatNo" type="text" class="form-control" maxlength="20">

                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="row">
                        <div class="col-md-4">
                          <h4><span class="en">Building No</span><span class="ar"></span></h4>
                        </div>
                        <div class="col-md-8">
                          <div class="form-group">
                            <input id="BuildNo" value="" name="BuildNo" type="text" class="form-control" maxlength="25">

                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="row">
                        <div class="col-md-4">
                          <h4><span class="en">Street Name</span><span class="ar"></span></h4>
                        </div>
                        <div class="col-md-8">
                          <div class="form-group">
                            <input id="StreetName" value="" name="StreetName" type="text" class="form-control"
                              maxlength="50">

                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="row">
                        <div class="col-md-4">
                          <h4><span class="en">District</span><span class="ar"></span></h4>
                        </div>
                        <div class="col-md-8">
                          <div class="form-group">
                            <input id="District" value="" name="District" type="text" class="form-control"
                              maxlength="50">

                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="row">
                        <div class="col-md-4">
                          <h4><span class="en">City</span><span class="ar"></span></h4>
                        </div>
                        <div class="col-md-8">
                          <div class="form-group">
                            <input id="CityN" value="" name="CityN" type="text" class="form-control" maxlength="50">

                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="row">
                        <div class="col-md-4">
                          <h4><span class="en">Country</span><span class="ar"></span></h4>
                        </div>
                        <div class="col-md-8">
                          <div class="form-group">
                            <input id="CountryN" value="" name="CountryN" type="text" class="form-control"
                              maxlength="50">

                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="row">
                        <div class="col-md-4">
                          <h4><span class="en">Postal Code</span><span class="ar"></span></h4>
                        </div>
                        <div class="col-md-8">
                          <div class="form-group">
                            <input id="PostalCode" value="" name="PostalCode" type="text" class="form-control"
                              maxlength="25">

                          </div>
                        </div>
                      </div>
                    </div>

                    <div class="col-md-6">
                      <div class="row">
                        <div class="col-md-4">
                          <h4><span class="en">Additional No</span><span class="ar"></span></h4>
                        </div>
                        <div class="col-md-8">
                          <div class="form-group">
                            <input id="AdditionalNo" value="" name="AdditionalNo" type="text" class="form-control"
                              maxlength="25">

                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="row">
                        <div class="col-md-4">
                          <h4><span class="en">Currency</span><span class="ar"></span></h4>
                        </div>
                        <div class="col-md-5 pr-0 mr-0">
                          <div class="form-group" id="currencyDiv">


                            <select class="select2_demo_1 form-select" id="Currency" name="Currency">
                              <option value="">Please Select Option</option>
                            </select>
                            <span class="help-block errorDiv" id="Currency_error"></span>


                          </div>
                        </div>
                        <div class="col-md-3">
                          <div class="add_ref_icons d-flex justify-content-around">
                            <button
                              onclick="window.open('currency.php', '_blank', 'location=yes,height=570,width=600,scrollbars=yes,status=yes');"
                              class="btn btn-info btn-circle" type="button"><i class="fa fa-plus"></i> </button>

                            <button onClick="refreshItems('currencyDiv','Currency','currency')"
                              class="btn btn-warning  btn-circle" type="button"><i class="fa fa-refresh"></i> </button>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="col-12">
                      <div class="row justify-content-center mt-5">
                        <div class="col-md-3">
                          <button type="button" class="btn btn-block btn-lg btn-outline-danger"
                            onClick="location.reload()"><span class="en">Exit</span><span class="ar">خروج</span>
                          </button>
                        </div>
                        <div class="col-md-3">
                          <button type="submit" class="btn btn-block btn-lg btn-outline-success"
                            id="seles_report_search" value="Search"><span class="en">Submit</span><span
                              class="ar">يقدم</span>
                          </button>
                        </div>
                      </div>
                    </div>
                  </div>
                </form>
              </div>

            </div>
          </div>
        </div>




      </div>
      <div id="SalesVoucherDiv"></div>



    </div>
  </div>
  </div>
  </div>


</body>

</html>