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

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
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

  <style>
    .col-6 {
      max-height: 155px;
      height: 155px;
      overflow: hidden;
      /* margin-bottom: 2vh; */
    }

    .ibox-content {
      padding: 5px;
    }

    .switch {
      /* position: relative; */
      display: inline-block;
      width: 60px;
      height: 34px;
      position: absolute;
      right: 35px;
      top: 4px;
    }

    .switch input {
      opacity: 0;
      width: 0;
      height: 0;
    }

    .slider {
      position: absolute;
      cursor: pointer;
      top: 0;
      left: 0;
      right: 0;
      bottom: 4px;
      background-color: #ccc;
      -webkit-transition: .4s;
      transition: .4s;
    }

    .slider:before {
      position: absolute;
      content: "";
      height: 26px;
      width: 26px;
      left: 4px;
      bottom: 2px;
      background-color: white;
      -webkit-transition: .4s;
      transition: .4s;
    }

    input:checked+.slider {
      background-color: #2196F3;
    }

    input:focus+.slider {
      box-shadow: 0 0 1px #2196F3;
    }

    input:checked+.slider:before {
      -webkit-transform: translateX(26px);
      -ms-transform: translateX(26px);
      transform: translateX(26px);
    }

    /* Rounded sliders */
    .slider.round {
      border-radius: 34px;
    }

    .slider.round:before {
      border-radius: 50%;
    }

    .carousel-control-next-icon {
      background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 16 16' fill='%232196F3'%3e%3cpath d='M4.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L10.293 8 4.646 2.354a.5.5 0 0 1 0-.708z'/%3e%3c/svg%3e");
    }

    .carousel-control-prev-icon {
      background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 16 16' fill='%232196F3'%3e%3cpath d='M11.354 1.646a.5.5 0 0 1 0 .708L5.707 8l5.647 5.646a.5.5 0 0 1-.708.708l-6-6a.5.5 0 0 1 0-.708l6-6a.5.5 0 0 1 .708 0z'/%3e%3c/svg%3e");
    }

    .ibox {
      clear: both;
      margin-bottom: 25px;
      margin-top: 0;
      padding: 0;
      border: 2px solid #0081CB;
      border-radius: 5px;
    }

    .ibox-title {
      -moz-border-bottom-colors: none;
      -moz-border-left-colors: none;
      -moz-border-right-colors: none;
      -moz-border-top-colors: none;
      background-color: transparent !important;
      border-color: white;
      border-image: none;
      border-style: solid solid none;
      border-width: 0 0 2px 0;
      color: #2196F3 !important;
      margin-bottom: 0;
      padding: 0;
      min-height: 35px;
      position: relative;
      clear: both;
      text-align: center;
    }

    .ibox-title img {
      /* border: 1px solid red; */
      height: 25px;
      width: 25px;
      position: absolute;
      left: 5px;
    }

    .float-right {
      float: right !important;
    }

    .ibox-title h3 {
      display: contents;
      font-size: 10px;
      font-weight: bold;
      margin: 0 auto;
      padding: 0;
      text-overflow: ellipsis;
      float: none;
      position: absolute;
      top: 10px;
    }


    .ibox-content {
      background-color: transparent !important;
      color: #2196F3;
      padding: 5px;
      /* border-image: none; */
      /* border-style: solid solid none; */
      /* border-width: 1px 0; */
      text-align: center;
    }

    .ibox-tools {
      display: block;
      float: none;
      margin-top: 5px;
      margin-bottom: 5px;
      position: initial;
      top: 30px;
      right: 10px;
      padding: 0;
      text-align: left;
    }

    a.ara {
      color: #93939396;
      font-size: 20px;
      position: absolute;
      top: 50%;
      right: 40px;
      transform: translateY(-50%);
    }

    a.eng {
      color: #93939396;
      font-size: 20px;
      position: absolute;
      top: 50%;
      right: 110px;
      transform: translateY(-50%);
    }

    .ar {
      display: none;
    }

    .rv .row {
      flex-direction: row-reverse;
    }

    .rv .form-group .form-label {
      text-align: right;
      width: 100%;
    }

    .rv .i-checks span.ar {
      display: inline-block;
    }

    .tb {
      /* display: flex !important; */
      direction: rtl;
      text-align: right;
      margin-right: 5px;
      margin-top: 5px;
    }

    .align-center {
      width: fit-content;
      margin: 0 auto;
    }

    .ibox-tools a {
      cursor: pointer;
      background-color: #2196F3 !important;
      display: inline;
      padding: 0.3em 0.6em 0.3em;
      font-size: 75%;
      font-weight: 700;
      line-height: 1;
      color: #fff !important;
      text-align: center;
      white-space: nowrap;
      vertical-align: baseline;
      border-radius: 0.25em;
    }

    .no-margins {
      margin: 0 !important;
      font-size: 14px;
      font-weight: bold;
    }

    .hidden {
      display: none;
    }

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
    <?php include("top-header.php"); ?>

    <div id="page-wrapper" class="gray-bg">
      <?php include("sidebar.php"); ?>

      <div class="wrapper wrapper-content animated fadeInRight" style="background-color: white;">
        <div class="row">
          <div class="col-lg-12">
            <div class="row">
              <!-- <div class="col-md-4">
                                <button type="button" data-toggle="modal" data-target="#exampleModal"
                                    class="langButton"><img src="assets/img/globe.png" alt=""></button>
                            </div> -->

              <div class="col-md-12">
                <div class="form-group">
                  <div>
                    <select id="branchs" name="branc" class="select2_demo_1 form-control" tabindex="4"
                      onChange="loadAll()">
                      <?php
                      if ($_SESSION['isAdmin'] == '1') {
                        $Bracnhes = Run("Select * from " . dbObject . "Branch order by BName ASC");
                        echo '<option value="">All</option>';
                      } else {
                        $Bracnhes = Run("Select " . dbObject . "Branch.Bid," . dbObject . "Branch.BName from " . dbObject . "Branch Inner JOIN " . dbObject . "EMP  On " . dbObject . "EMP.BID = " . dbObject . "Branch.Bid where " . dbObject . "EMP.WebCode = '" . $_SESSION['code'] . "' ");
                      }
                      $ABoveBranches = $_GET['branch'];
                      while ($getBranches = myfetch($Bracnhes)) {
                        $selected = "";

                        if ($_GET['branc'] != '') {
                          if (($getBranches->Bid == $_GET['branc'])) {
                            $selected = "Selected";
                          }
                        }
                        ?>
                        <option value="<?php echo $getBranches->Bid; ?>" <?php echo $selected; ?>>
                          <?php echo $getBranches->BName; ?>
                        </option>

                      <?php } ?>
                    </select>
                  </div>
                </div>
              </div>
            </div>
            <?php
            /// Customers Count/////
            $condition = " Where isDeleted = 0";
            if ($_GET['branc'] == '') {
              if ($_SESSION['isAdmin'] == 0) {
                $Bracnhes = Run("Select " . dbObject . "Branch.Bid," . dbObject . "Branch.BName from " . dbObject . "Branch Inner JOIN " . dbObject . "EMP  On " . dbObject . "EMP.BID = " . dbObject . "Branch.Bid where " . dbObject . "EMP.WebCode = '" . $_SESSION['code'] . "' ");
                $userBranch = myfetch($Bracnhes);

                $condition .= " And bid = '$userBranch->Bid'";
              } else {
                $condition .= " And bid != ''";
              }
            }
            ?>

            <div class="row">
              <div class="col-lg-4" style="display: none;">
                <div class="ibox ">
                  <div class="ibox-title">
                    <h5>Bar Chart Example </h5>
                    <div class="ibox-tools">
                      <a class="collapse-link">
                        <i class="fa fa-chevron-up"></i>
                      </a>
                    </div>
                  </div>
                  <div class="ibox-content">
                    <div id="morris-bar-chart"></div>
                  </div>
                </div>
              </div>


              <div class="col-lg-12" id="dashboard_sec">
                <div class="row">
                  <h3><span class="en hidden">Sales</span><span class="ar hidden">
                      <?= getArabicTitle('Sales') ?>
                    </span></h3>
                  <div class="row m-0 flexDirection">
                    <div class="col-lg-3" id="sales_Sec">
                    </div>

                    <div class="col-lg-3" id="sales_profit">
                    </div>
                  </div>

                  <h3><span class="en hidden">Expense</span><span class="ar hidden">
                      <?= getArabicTitle('Expense') ?>
                    </span></h3>
                  <div class="row m-0 flexDirection">
                    <div class="col-lg-3" id="expense_sec">
                    </div>

                    <div class="col-lg-3" id="high_expense_sec">
                    </div>

                    <div class="col-lg-3" id="low_expense_sec">
                    </div>
                  </div>

                  <h3><span class="en hidden">Stock</span><span class="ar hidden">
                      <?= getArabicTitle('Stock') ?>
                    </span></h3>
                  <div class="row m-0 flexDirection">
                    <div class="col-lg-3" id="stock_sec">
                    </div>
                  </div>

                  <h3><span class="en hidden">Customer & Supplier</span><span class="ar hidden">
                      <?= getArabicTitle('Customer & Supplier') ?>
                    </span></h3>
                  <div class="row m-0 flexDirection">
                    <div class="col-lg-3" id="suppliers_sec">
                    </div>

                    <div class="col-lg-3" id="customer_sec">
                    </div>


                    <div class="col-lg-3" id="cus_name_max_sec">
                    </div>

                    <div class="col-lg-3" id="sup_name_max_sec">
                    </div>
                  </div>

                  <h3><span class="en hidden">Product</span><span class="ar hidden">
                      <?= getArabicTitle('Product') ?>
                    </span></h3>
                  <div class="row m-0 flexDirection">
                    <div class="col-lg-3" id="hight_sale_sec">
                    </div>

                    <div class="col-lg-3" id="low_sale_sec">
                    </div>

                    <div class="col-lg-3" id="total_product_sec">
                    </div>
                  </div>
                </div>

              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="chartModel saleModal">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle" style="text-align: center">Total Sales Chart</h5>
        <button type="button" class="close" onclick="chartHide('saleModal')">&times;</button>
      </div>
      <div id="salesChart"></div>
    </div>

    <div class="chartModel saleProfitModal">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle" style="text-align: center">Sales Profit Chart</h5>
        <button type="button" class="close" onclick="chartHide('saleProfitModal')">&times;</button>
      </div>
      <div id="salesProfitChart"></div>
    </div>

    <div class="chartModel expenseModal">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle" style="text-align: center">Expense Chart</h5>
        <button type="button" class="close" onclick="chartHide('expenseModal')">&times;</button>
      </div>
      <div id="expenseChart"></div>
    </div>

    <div class="chartModel customerModal">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle" style="text-align: center">Customer Chart</h5>
        <button type="button" class="close" onclick="chartHide('customerModal')">&times;</button>
      </div>
      <div id="customerChart"></div>
    </div>

    <div class="chartModel supplierModal">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle" style="text-align: center">Suppleir Chart</h5>
        <button type="button" class="close" onclick="chartHide('supplierModal')">&times;</button>
      </div>
      <div id="supplierChart"></div>
    </div>

    <div class="chartModel stockReportModal">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle" style="text-align: center">Stock Report Chart</h5>
        <button type="button" class="close" onclick="chartHide('stockReportModal')">&times;</button>
      </div>
      <div id="stockReportChart"></div>
    </div>

    <div class="chartModel highlySaleModal">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle" style="text-align: center">Highly Sale Product Chart
        </h5>
        <button type="button" class="close" onclick="chartHide('highlySaleModal')">&times;</button>
      </div>
      <div id="highlySaleChart"></div>
    </div>

    <div class="chartModel totalProductModal">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle" style="text-align: center">Total Product Chart</h5>
        <button type="button" class="close" onclick="chartHide('totalProductModal')">&times;</button>
      </div>
      <div id="totalProductChart"></div>
    </div>

    <div class="chartModel highExpenseModal">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle" style="text-align: center">High Expense Head Chart
        </h5>
        <button type="button" class="close" onclick="chartHide('highExpenseModal')">&times;</button>
      </div>
      <div id="highExpenseChart"></div>
    </div>

    <div class="chartModel lowExpenseModal">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle" style="text-align: center">Low Expense Head Chart
        </h5>
        <button type="button" class="close" onclick="chartHide('lowExpenseModal')">&times;</button>
      </div>
      <div id="lowExpenseChart"></div>
    </div>

    <div class="chartModel customerNameModal">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle" style="text-align: center">Customer Name with Max
          Balance Chart</h5>
        <button type="button" class="close" onclick="chartHide('customerNameModal')">&times;</button>
      </div>
      <div id="customerNameChart"></div>
    </div>

    <div class="chartModel supplierNameModal">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle" style="text-align: center">Supplier Name with Max
          Balance Chart</h5>
        <button type="button" class="close" onclick="chartHide('supplierNameModal')">&times;</button>
      </div>
      <div id="supplierNameChart"></div>
    </div>

    <div class="chartModel lowSaleModal">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle" style="text-align: center">Low Sale Product Chart
        </h5>
        <button type="button" class="close" onclick="chartHide('lowSaleModal')">&times;</button>
      </div>
      <div id="lowSaleChart"></div>
    </div>


  </div>
  <?php include("footer.php"); ?>

  </div>
  </div>
  <input type="hidden" id="selected_lang" name="selected_lang" value="<?= $_SESSION['lang'] ?>">

</body>

</html>


<script src="include/dashboard/js.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
  integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>