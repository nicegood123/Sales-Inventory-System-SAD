<?php
    require '../application/config/connection.php';
    require_once '../application/config/functions.php';
    
    session_start();

    $total_sales = 0;
    $rows = $function->totalSales();
    foreach ($rows as $row) {
      $total_sales = $row['total_sales'];
    }

?>

<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <title>Sales Report</title>

  <!-- links -->
  <?php include 'sections/links.php'; ?>

</head>

<body class="theme-teal">
  <!-- Page Loader -->
  <?php include 'sections/page-loader.php'; ?>

  <!-- Overlay For Sidebars -->
  <div class="overlay"></div>

  <!-- Top Bar -->
  <?php include 'sections/top-bar.php'; ?>

  <!-- Left Side Bar -->
  <?php include 'sections/left-sidebar/leftsidebar.php'; ?>

  <section class="content">
    <div class="container-fluid">
      <div class="block-header">
        <h2>SALES REPORT</h2>
      </div>
      <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
          <div class="card">
            <div class="header">
              <h2>Sales</h2>
              <p class="pull-right" id="cart-total">
                <b>Total Sales</b>
                PHP <?php echo number_format($total_sales, 2);  ?>
              </p>
            </div>
            <div class="body">
              <div class="table-responsive">
                <table class="table table-bordered table-striped table-hover dataTable js-exportable"
                  id="products-table">
                  <thead>
                    <tr>
                      <th>OrderID</th>
                      <th>Name</th>
                      <th>Discounts</th>
                      <th>Total</th>
                      <th>Payment Method</th>
                      <th>Date Ordered</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    try {

                        $query = "SELECT orders.order_id, CONCAT(users.firstname, ' ', users.lastname) AS 'name',
                        orders.discount, orders.total, orders.payment_method, orders.ordered_date FROM orders
                        INNER JOIN users ON orders.user_id = users.id";

                        $rows = $function->selectAll($query);
                        foreach ($rows as $row) { ?>

                    <tr>
                      <td>
                        <a href="sales-report.php?order_id=<?php echo $row['order_id']; ?>">
                          <?php echo $row['order_id']; ?>
                        </a>
                      </td>
                      <td><?php echo $row['name']; ?></td>
                      <td><?php echo $row['discount']; ?></td>
                      <td><?php echo $row['total']; ?></td>
                      <td><?php echo $row['payment_method']; ?></td>
                      <td><?php echo $row['ordered_date']; ?></td>
                    </tr>

                    <?php
                          }
                        } catch (PDOException $e) {
                            echo "There is some problem in connection: " . $e->getMessage();
                        }

                        ?>
                  </tbody>
                </table>
              </div>




            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- scripts -->
  <?php include 'sections/scripts.php'; ?>

</body>

</html>