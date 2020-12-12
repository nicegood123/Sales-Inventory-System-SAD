<?php

require '../application/config/connection.php';
require_once '../application/config/functions.php';

session_start();

if (!isset($_SESSION['is_logged_in'])) {
	header("Location:../sign-in.php");
}


?>
<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <title>Checkout | Admin</title>
  <!-- Favicon-->
  <link rel="icon" href="favicon.ico" type="image/x-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Roboto:400,700&subset=latin,cyrillic-ext" rel="stylesheet"
    type="text/css">
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" type="text/css">

  <!-- Bootstrap Core Css -->
  <link href="plugins/bootstrap/css/bootstrap.css" rel="stylesheet">

  <!-- Waves Effect Css -->
  <link href="plugins/node-waves/waves.css" rel="stylesheet" />

  <!-- Animation Css -->
  <link href="plugins/animate-css/animate.css" rel="stylesheet" />

  <!-- JQuery DataTable Css -->
  <link href="plugins/jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.css" rel="stylesheet">

  <!-- Bootstrap Select Css -->
  <link href="plugins/bootstrap-select/css/bootstrap-select.css" rel="stylesheet" />

  <!-- Custom Css -->
  <link href="css/style.css" rel="stylesheet">

  <!-- AdminBSB Themes. You can choose a theme from css/themes instead of get all themes -->
  <link href="css/themes/all-themes.css" rel="stylesheet" />
</head>

<body class="theme-red">
  <!-- Page Loader -->
  <?php include 'sections/page-loader.php'; ?>

  <!-- Overlay For Sidebars -->
  <div class="overlay"></div>
  <!-- #END# Overlay For Sidebars -->

  <!-- Top Bar -->
  <?php include 'sections/top-bar.php'; ?>

  <section>
    <!-- Left Sidebar -->
    <?php include 'sections/left-sidebar/leftsidebar.php'; ?>

  </section>

  <section class="content">
    <div class="container-fluid">
      <div class="block-header">
        <h2>CHECKOUT</h2>
      </div>


      <div class="row clearfix">
        <div class="col-lg-8 col-md-12 col-sm-12 col-xs-12">
          <div class="card">
            <div class="header">
              <a href="cashier.php" class="btn bg-blue-grey">
                <i class="material-icons" style="font-size:1.6rem;">shopping_cart</i>
                Back to Cart
              </a>
            </div>
            <div class="body">
              <div class="row clearfix">
                <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12">
                  <p>
                    <b>Customer Type</b>
                    <div class="demo-checkbox m-l-30">
                      <input type="checkbox" id="basic_checkbox_1">
                      <label for="basic_checkbox_1">Regular</label>
                      <select class="form-control show-tick" data-live-search="true" disabled>
                        <option>Hot Dog, Fries and a Soda</option>
                      </select>
                    </div>
                  </p>
                </div>
                <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12">
                  <p>
                    <b>Discounts</b>
                    <div class="demo-checkbox m-l-30">
                      <div class="col-xs-11">
                        <input type="checkbox" id="discounts">
                        <label for="discounts">Senior Citizen</label>
                        <input type="text" id="discounts-input" name="name" class="form-control" disabled>
                      </div>
                    </div>
                  </p>
                </div>
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                  <p>
                    <b>Payment Method</b>
                    <div class="demo-checkbox m-l-30">
                      <div class="col-xs-11">
                        <input type="checkbox" id="basic_checkbox_2">
                        <label for="basic_checkbox_2">Senior Citizen</label>
                        <input type="text" id="" name="name" class="form-control" disabled>
                      </div>
                    </div>
                  </p>
                </div>
              </div>
            </div>
          </div>
        </div>

        <?php

          $subtotal = $_SESSION['cart_total'];
          $vat = $subtotal * 0.12;
          $discounts = 0;
          $total = ($subtotal + $vat) - $discounts;
  
        ?>


        <div class="col-lg-4 col-md-12 col-sm-12 col-xs-12">
          <div class="card">
            <div class="header">
              <h2>Invoice</h2>
            </div>
            <div class="body">
              <div class="row clearfix">
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                  <p class="m-l-10">Subtotal</p>
                  <p class="m-l-10">VAT (12%)</p>
                  <p class="m-l-10">Discounts</p>
                  <hr>
                  <p class="m-l-10">
                    <b>Total</b>
                  </p>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                  <p>PHP
                    <?php echo $subtotal; ?>
                  </p>
                  <p id="vat">PHP
                    <?php echo $vat; ?>
                  </p>
                  <p>PHP
                    <?php echo $discounts; ?>
                  </p>
                  <hr>
                  <p>PHP
                    <?php echo $total; ?>
                  </p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>



    </div>
  </section>

  <!-- Jquery Core Js -->
  <script src="plugins/jquery/jquery.min.js"></script>

  <!-- Bootstrap Core Js -->
  <script src="plugins/bootstrap/js/bootstrap.js"></script>

  <!-- Select Plugin Js -->
  <script src="plugins/bootstrap-select/js/bootstrap-select.js"></script>

  <!-- Slimscroll Plugin Js -->
  <script src="plugins/jquery-slimscroll/jquery.slimscroll.js"></script>

  <!-- Bootstrap Notify Plugin Js -->
  <script src="plugins/bootstrap-notify/bootstrap-notify.js"></script>

  <!-- Jquery Spinner Plugin Js -->
  <script src="plugins/jquery-spinner/js/jquery.spinner.js"></script>

  <!-- Waves Effect Plugin Js -->
  <script src="plugins/node-waves/waves.js"></script>

  <!-- Jquery DataTable Plugin Js -->
  <script src="plugins/jquery-datatable/jquery.dataTables.js"></script>
  <script src="plugins/jquery-datatable/skin/bootstrap/js/dataTables.bootstrap.js"></script>
  <script src="plugins/jquery-datatable/extensions/export/dataTables.buttons.min.js"></script>
  <script src="plugins/jquery-datatable/extensions/export/buttons.flash.min.js"></script>
  <script src="plugins/jquery-datatable/extensions/export/jszip.min.js"></script>
  <script src="plugins/jquery-datatable/extensions/export/pdfmake.min.js"></script>
  <script src="plugins/jquery-datatable/extensions/export/vfs_fonts.js"></script>
  <script src="plugins/jquery-datatable/extensions/export/buttons.html5.min.js"></script>
  <script src="plugins/jquery-datatable/extensions/export/buttons.print.min.js"></script>

  <!-- Custom Js -->
  <script src="js/admin.js"></script>
  <script src="js/pages/tables/jquery-datatable.js"></script>

  <script>
    $('#discounts').click(function () {
      if (this.checked) {
        $('#discounts-input').removeAttr('disabled');
      } else {
        $('#discounts-input').attr('disabled', 'disabled');
      }
    });
  </script>

  <script>
    $('#discounts').click(function () {
      var vat = $('#vat').text()
      if (this.checked) {
        $('#vat').text('PHP 0.00')
      } else {
        $('#vat').text(val)
      }
    })
  </script>

</body>

</html>