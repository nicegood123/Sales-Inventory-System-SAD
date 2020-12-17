<?php

require '../application/config/connection.php';
require_once '../application/config/functions.php';

session_start();

if (!isset($_SESSION['is_logged_in'])) {
	header("Location:../sign-in.php");
}

$message = "";

$subtotal = $_SESSION['cart_total'];
$_SESSION['vat'] = $subtotal * 0.12;

if (isset($_POST['apply-changes'])) {

  $_SESSION['payment_method'] = $_POST['payment-method'];

  if (isset($_POST['discounts'])) {
    $discounts = $subtotal * 0.20;
    $_SESSION['vat'] = 0;
    $_SESSION['discounts'] = $discounts;
  } else {
    $_SESSION['discounts'] = 0.00;
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

$total = ($subtotal + $_SESSION['vat']) - $_SESSION['discounts'];
$_SESSION['total'] = $total;


if (isset($_POST['pay-cash'])  || isset($_POST['pay-check'])) {

  try {
    
    $id = $function->setOrderID('order_id', 'orders');

  //Insert Order
  $order_id = $id;
  $user_id = $_SESSION['user_id'];

  $data = [
    'order_id' => $order_id,
    'user_id' => $user_id,
    'discount' => $_SESSION['discounts'],
    'total' => $_SESSION['total'],
    'payment_method' => $_SESSION['payment_method']
  ];

  //Add order
  $query = "INSERT INTO orders (order_id, user_id, discount, total, payment_method) VALUES (:order_id, :user_id, :discount, :total, :payment_method)";
  $function->insert($query, $data);
  $_SESSION['discounts'] = 0.00;
  $_SESSION['total'] = 0.00;
  $_SESSION['payment_method'] = 'Cash Payment';



  //Set cart code
  $cart_code = $order_id;
  $data = [
    'cart_code' => $cart_code, 
    'user_id' => $user_id
    ];

  $query = "UPDATE cart SET cart_code = :cart_code WHERE user_id = :user_id AND cart_code = 1";
  $function->update($query, $data);

  //Update product QuantitySold
  $query = "SELECT products.id, products.QuantitySold, cart.quantity FROM cart INNER JOIN products ON cart.product_id = products.id WHERE user_id = ".$user_id." AND cart_code = ".$cart_code."";

  $rows = $function->selectAll($query);
  foreach ($rows as $row) {
    $data = ['quantity' => $row['quantity'], 'id' => $row['id']];
    $query = "UPDATE products SET QuantitySold = (QuantitySold + :quantity) WHERE id = :id";
    $function->update($query, $data);

  }


  //Add bank info for check payment
  if (isset($_POST['pay-check'])) {
      $bank_name = $_POST['bank-name'];
      $branch = $_POST['branch'];
      $check_number = $_POST['check-number'];
      $check_amount = $_POST['check-amount'];

      $data = [
        'name' => $bank_name,
        'branch' => $branch,
        'check_number' => $check_number,
        'check_amount' => $check_amount
      ];

      $query = "INSERT INTO bank (name, branch, check_number, check_amount) VALUES (:name, :branch, :check_number, :check_amount)";
      $function->insert($query, $data);

  }

  header('Location:cashier.php');

  '<div class="alert alert-success" alert-dismissible" role="alert">
                <strong>Successful Transactions!</strong> You successfully read this important alert message.
              </div>;';

  $_SESSION['message'] = 
              '<div class="alert alert-success alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">×</span>
                </button>
                Successful Transactions!
              </div>';

  } catch (Exception $e) {

  }

}


?>
<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <title>Checkout | Admin</title>

  <!-- links -->
  <?php include 'sections/links.php'; ?>

</head>

<body class="theme-teal">
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
                            <input name="payment-method" type="radio" value="Cash Payment" id="rdo-cash" checked="">
                            <label for="rdo-cash">Cash</label>
                            <input name="payment-method" type="radio" value="Check Payment" id="rdo-check">
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

        <div class="col-lg-4 col-md-12 col-sm-12 col-xs-12" id="invoice">
          <div class="card">
            <div class="header">
              <h2>Invoice
                <button type="button" id="print-invoice" class="btn bg-blue-grey btn-xs pull-right waves-effect">
                  <i class="material-icons">print</i>
                </button>

              </h2>

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
                    <?php echo number_format($_SESSION['vat'], 2); ?>
                  </p>
                  <p>PHP
                    <?php echo number_format($_SESSION['discounts'], 2); ?>
                  </p>
                  <hr>
                  <p id="total">PHP
                    <?php echo number_format($_SESSION['total'], 2); ?>
                  </p>
                </div>
              </div>
            </div>
          </div>
        </div>

        <?php
        $cash_status = 'hidden';
        $check_status = 'hidden';

        if (isset($_POST['apply-changes']) && $_POST['payment-method'] == 'Check Payment') {
          $check_status = '';
        } else { $cash_status = ''; }
        ?>

        <!-- Cash Payment -->
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

              <form method="post">
                <label for="bank_name">Bank Name</label>
                <div class="form-group">
                  <div class="form-line">
                    <input type="text" name="bank-name" id="bank_name" class="form-control"
                      placeholder="Enter bank name" required>
                  </div>
                </div>

                <label for="branch">Branch</label>
                <div class="form-group">
                  <select name="branch" class="form-control show-tick">
                    <option value="Matina">Matina</option>
                    <option value="Maa">Maa</option>
                    <option value="Buhangin">Buhangin</option>
                    <option value="Toril">Toril</option>
                    <option value="Tagum">Tagum</option>
                  </select>
                </div>
                <label for="check_number" class="m-t-10">Check Number</label>
                <div class="form-group">
                  <div class="form-line">
                    <input type="text" name="check-number" id="check-number" class="form-control"
                      placeholder="Enter check number" required>
                  </div>
                </div>
                <label for="bank_name">Check Amount</label>
                <div class="form-group">
                  <div class="form-line">
                    <input type="text" name="check-amount" id="check-amount" class="form-control"
                      placeholder="Enter check amount" required>
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

  <!-- scripts -->
  <?php include 'sections/scripts.php'; ?>

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

      $('#discounts-input, #check-number, #check-amount').bind('input', function () {
        this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');
      });

      $("#pay").submit(function (e) {
        e.preventDefault();
        alert("Form submitted");
      });

      $('#print-invoice').on('click', function () {
        $('body').css('visibility', 'hidden');
        var print_invoice = $('#invoice').css('visibility', 'visible');
        window.print();

        // var newWindow = window.open('redir2.html');
        // newWindow.focus();
        // newWindow.print(print_invoice);
        // newWindow.close();
      });

    });
  </script>

</body>

</html>