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

  <title>Customer Area</title>

  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;700&display=swap" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
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
        <h2 class="font-weight-bold"><span class="en float-left">Customer Area</span><span class="ar float-right">
          </span></h2>
        <!-- </div> -->
      </div>
      <div class="wrapper wrapper-content animated fadeInRight">

        <div class="row">
          <div class="col-lg-12" id="loadlisting">
          </div>
        </div>

      </div>


    </div>
  </div>
  </div>
  </div>


</body>

<script src="include/customer_area/js.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
  integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
  </script>

</html>