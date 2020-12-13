<?php

require '../application/config/connection.php';
require_once '../application/config/functions.php';

session_start();

if (!isset($_SESSION['is_logged_in'])) {
	header("Location:../sign-in.php");
}


$subtotal = $_SESSION['cart_total'];
$vat = $subtotal * 0.12;
$discounts = 0.00;

if (isset($_POST['payment-method'])) {
    $payment_method = $_POST['payment-method'];
} else {
  $payment_method = 'Cash Payment';
}

if (isset($_POST['apply-changes'])) {


  if (isset($_POST['discounts'])) {
    $discounts = $subtotal * 0.20;
    $vat = 0;
    $_SESSION['discounts'] = $discounts;
  }
  
  if (isset($_POST['type'])) {
    $user_id = $_POST['name'];
  } else {
    $user_id = -1;
  }

  $_SESSION['user_id'] = $user_id;


  $data = [
    'user_id' => $user_id
  ];

  $query = "UPDATE cart SET user_id = :user_id WHERE cart_code = 1";
  $function->update($query, $data);

}

$total = ($subtotal + $vat) - $discounts;

if (isset($_POST['pay-cash'])) {
  $id = $function->setOrderID('order_id', 'orders');
  // $cart = $function->getData('cart', 'cart_id', $_SESSION['cart_id']);

  //Insert Order
  $order_id = $id;
  $user_id = $_SESSION['user_id'];

  $data = [
    'order_id' => $order_id,
    'user_id' => $user_id,
    'total' => $total,
    'payment_method' => $payment_method
  ];


  //Add order
  $query = "INSERT INTO orders (order_id, user_id, total, payment_method) VALUES (:order_id, :user_id, :total, :payment_method)";
  $function->insert($query, $data);

  //Set cart code
  $cart_code = $order_id;
  $data = [
    'cart_code' => $cart_code, 
    'user_id' => $user_id,
    'discount' => $_SESSION['discounts']
    ];

  $query = "UPDATE cart SET discount = :discount, cart_code = :cart_code WHERE user_id = :user_id AND cart_code = 1";
  $function->update($query, $data);

  //Update product QuantitySold
  $query = "SELECT products.id, products.QuantitySold, cart.quantity FROM cart INNER JOIN products ON cart.product_id = products.id WHERE user_id = ".$user_id." AND cart_code = ".$cart_code."";

  $rows = $function->selectAll($query);
  foreach ($rows as $row) {
    $data = ['quantity' => $row['quantity'], 'id' => $row['id']];
    $query = "UPDATE products SET QuantitySold = (QuantitySold + :quantity) WHERE id = :id";
    $function->update($query, $data);

  }


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
              <form method="post">
                <div class="row clearfix">
                  <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12">
                    <p>
                      <b>Customer Type</b>
                      <div class="demo-checkbox m-l-30">
                        <input type="checkbox" id="type" name="type[]">
                        <label for="type">Regular</label>
                        <select class="form-control show-tick" id="name" name="name" data-live-search="true">
                          <?php
                          $query = "SELECT * FROM users WHERE type = 0";
                          $rows = $function->selectAll($query);
                          foreach ($rows as $row): ?>
                          <option value="<?php echo $row['id']; ?>">
                            <?php echo $row['id']. ' - ' . $row['firstname'] . ' ' . $row['lastname']; ?>
                          </option>
                          <?php endforeach; ?>
                        </select>
                      </div>
                    </p>
                  </div>
                  <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12">
                    <p>
                      <b>Discounts</b>
                      <div class="demo-checkbox m-l-30">
                        <div class="col-xs-11">
                          <input type="checkbox" id="discounts" name="discounts[]">
                          <label for="discounts">Senior Citizen</label>
                          <input type="text" id="discounts-input" maxlength="8" name="senior-id" class="form-control"
                            required disabled>
                        </div>
                      </div>
                    </p>
                  </div>
                  <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <p>
                      <b>Payment Method</b>
                      <div class="demo-checkbox m-l-30">
                        <div class="col-xs-11">
                          <div class="demo-radio-button">
                            <input name="payment-method" type="radio" value="cash" id="rdo-cash" checked="">
                            <label for="rdo-cash">Cash</label>
                            <input name="payment-method" type="radio" value="check" id="rdo-check">
                            <label for="rdo-check">Check Payment</label>
                          </div>
                        </div>
                      </div>
                    </p>
                    <button type="submit" name="apply-changes" class="btn btn-primary pull-right">
                      <i class="material-icons" style="font-size:1.6rem;">refresh</i>
                      Apply Changes
                    </button>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>

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
                    <?php echo number_format($subtotal, 2); ?>
                  </p>
                  <p id="vat">PHP
                    <?php echo number_format($vat, 2); ?>
                  </p>
                  <p>PHP
                    <?php echo number_format($discounts, 2); ?>
                  </p>
                  <hr>
                  <p id="total">PHP
                    <?php echo number_format($total, 2); ?>
                  </p>
                </div>
              </div>
            </div>
          </div>
        </div>

        <?php
        $cash_status = 'hidden';
        $check_status = 'hidden';

        if (isset($_POST['apply-changes']) && $_POST['payment-method'] == 'check') {
          $check_status = '';
        } else { $cash_status = ''; }
        ?>

        <!-- CASH Payment -->
        <div class="col-lg-4 col-md-12 col-sm-12 col-xs-12" <?php echo $cash_status; ?>>
          <div class="card">
            <div class="header">
              <h2>Payment</h2>
            </div>
            <div class="body">
              <form method="post">
                <label for="cash">Cash</label>
                <div class="form-group">
                  <div class="form-line">
                    <input type="text" name="cash" id="cash" class="form-control" placeholder="Enter cash" required>
                  </div>
                </div>
                <label for="cash">Change</label>
                <div class="form-group">
                  <div class="form-line">
                    <input type="text" name="change" id="change" value="0.00" class="form-control" disabled>
                  </div>
                  <br>
                  <input type="submit" name="pay-cash" id="pay" value="Pay" class="btn btn-primary pull-right" disabled>
                </div>
              </form>
            </div>
          </div>
        </div>

        <!-- Check Payment -->
        <div class="col-lg-4 col-md-12 col-sm-12 col-xs-12" <?php echo $check_status; ?>>
          <div class="card">
            <div class="header">
              <h2>Payment</h2>
            </div>
            <div class="body">

              <form>
                <label for="bank_name">Bank Name</label>
                <div class="form-group">
                  <div class="form-line">
                    <input type="text" name="bank-name" id="bank_name" class="form-control"
                      placeholder="Enter bank name" required>
                  </div>
                </div>

                <label for="branch">Branch</label>
                <div class="form-group">
                  <select class="form-control show-tick">
                    <option value="10">Matina</option>
                    <option value="20">20</option>
                    <option value="30">30</option>
                    <option value="40">40</option>
                    <option value="50">50</option>
                  </select>
                </div>
                <label for="check_number" class="m-t-10">Check Number</label>
                <div class="form-group">
                  <div class="form-line">
                    <input type="text" name="check-number" id="check_number" class="form-control"
                      placeholder="Enter check number" required>
                  </div>
                  <br>
                  <input type="submit" name="pay-check" id="pay-check" value="Pay" class="btn btn-primary pull-right">
                </div>
              </form>
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
    $(document).ready(function () {
      $('#name').attr('disabled', 'disabled');

      $('#type').click(function () {
        if (this.checked) {
          $('#name').removeAttr('disabled');
        } else {
          $('#name').attr('disabled', 'disabled');
        }
      });

      $('#cash').bind('input', function () {
        this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');
        var total = $('#total').text().replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');
        var cash = $(this).val();
        var change = cash - total;
        $('#change').val(change.toFixed(2));

        if (change >= 0) {
          $('#pay').removeAttr('disabled');
        } else {
          $('#pay').attr('disabled', 'disabled');
        }

        if (!$('#cash').val()) {
          $('#change').val('0.00');
        }

      });

      $('#discounts-input').bind('input', function () {
        this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');
      });

    });
  </script>

</body>

</html>