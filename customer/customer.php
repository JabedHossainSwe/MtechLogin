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


  <style>
  .direction {
    <?php if ($lang==1) {
      echo " direction: ltr;";
    }

    else {
      echo "direction: rtl;";
    }

    ?>
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
        <div class="col-lg-12">
          <h2 class="font-weight-bold"><span class="en float-left">List Customers</span><span class="ar float-right">
            </span></h2>
          <div id="deleteEntry"></div>
        </div>
      </div>
      <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row mb-3">
          <div class="col-md-12 col-12">

            <a href="add_customer.php" class="btn btn-outline-primary btn-actions float-right submit-next mr-2"><span
                class="en">Add New <i class="fa fa-plus icon-font"></i></span><span class="ar"><i
                  class="fa fa-plus icon-font"></i>

              </span></a>


            <a href="customer_area.php" class="btn btn-outline-primary btn-actions float-right submit-next mr-2"><span
                class="en">Area</span><span class="ar">

              </span></a>

            <a href="currency.php" class="btn btn-outline-primary btn-actions float-right submit-next mr-2"><span
                class="en">Currency</span><span class="ar">

              </span></a>
          </div>
        </div>
        <div class="row">
          <div class="col-lg-12">
            <div class="ibox">
              <div class="ibox-title">


                <div class="ibox-tools no_envent" style="display: none">
                  <a class="collapse-link filter_act">
                    <i class="fa fa-chevron-down"></i>
                  </a>
                </div>
              </div>
              <form action="customer.php" method="get" class="ibox-content filter_container">

                <div class="row">
                  <div class="col-sm-12 ">
                    <div class="row d-flex align-items-end">
                      <div class="col-sm-4">
                        <div class="mb-3">
                          <label for="" class="form-label"><span class="en float-left">Code</span><span
                              class="ar float-right">

                            </span></label>
                          <input type="text" class="form-control" name="CCode" id="CCode"
                            value="<?php echo $_GET['CCode']; ?>">
                        </div>
                      </div>
                      <div class="col-sm-4">
                        <div class="mb-3">
                          <label for="" class="form-label"><span class="en float-left">Name</span><span
                              class="ar float-right">

                            </span></label>
                          <input type="text" class="form-control" name="CName" id="CName"
                            value="<?php echo $_GET['CName']; ?>">
                        </div>
                      </div>
                      <div class="col-sm-4">
                        <div class="mb-3">
                          <a href="customer.php" class="btn btn-outline-danger btn-actions float-end submit-next"
                            onClick="loadPage('list_customers.php')"><span class="en float-left">Clear</span><span
                              class="ar float-right">
                            </span></a>
                          <button type="submit" class="btn btn-outline-primary btn-actions float-end submit-next ml-2"
                            name="submit"><span class="en float-left">Submit <i
                                class="fa fa-arrow-right icon-font"></i></span><span class="ar float-right"><i
                                class="fa fa-arrow-right icon-font"></i>

                            </span></button>
                        </div>
                      </div>
                    </div>

                    <div class="mb-3">
                      <!-- Listing -->
                      <table class="table table-striped table-bordered dt-responsive table-hover ">

                        <?php
                        if ($pages->items_total > 0) {
                          ?>
                        <thead>
                          <tr>
                            <th><span class="en">CCode</span><span class="ar">

                              </span></th>
                            <th><span class="en">CName</span><span class="ar">

                              </span></th>
                            <th><span class="en">Actions</span><span class="ar">

                              </span></th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php

                        }

                        ?>


                        </tbody>

                      </table>

                      <!-- /Listing -->

                      <div class="clearfix"></div>


                      <!-- bottom pagination -->

                      <div class="row marginTop">

                        <div class="col-sm-12 paddingLeft pagerfwt">

                          <?php if ($pages->items_total > 0) { ?>

                          <?php echo $pages->display_pages(); ?>

                          <?php echo $pages->display_items_per_page(); ?>

                          <?php echo $pages->display_jump_menu(); ?>

                          <?php } ?>

                        </div>

                        <div class="clearfix"></div>

                      </div>

                      <!-- /bottom pagination -->
                    </div>

                  </div>
                  <div class="m-5"></div>

                </div>
              </form>
            </div>
          </div>
        </div>




      </div>

    </div>
  </div>
  </div>
  </div>


</body>


</html>