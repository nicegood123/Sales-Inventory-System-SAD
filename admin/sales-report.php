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
  <!-- Favicon-->
  <link rel="icon" href="favicon.ico" type="image/x-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Roboto:400,700&subset=latin,cyrillic-ext" rel="stylesheet"
    type="text/css">
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" type="text/css">

  <!-- Font Awesome Fonts -->
  <link href="../fonts/fontawesome-free/css/all.min.css" rel="stylesheet">

  <!-- Bootstrap Core Css -->
  <link href="plugins/bootstrap/css/bootstrap.css" rel="stylesheet">

  <!-- Waves Effect Css -->
  <link href="plugins/node-waves/waves.css" rel="stylesheet" />

  <!-- Animation Css -->
  <link href="plugins/animate-css/animate.css" rel="stylesheet" />

  <!-- Sweetalert Css -->
  <link href="plugins/sweetalert/sweetalert.css" rel="stylesheet" />

  <!-- JQuery DataTable Css -->
  <link href="plugins/jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.css" rel="stylesheet">

  <!-- Custom Css -->
  <link href="css/style.css" rel="stylesheet">

  <!-- AdminBSB Themes. You can choose a theme from css/themes instead of get all themes -->
  <link href="css/themes/all-themes.css" rel="stylesheet" />


  <!-- Bootstrap Select Css -->
  <link href="plugins/bootstrap-select/css/bootstrap-select.css" rel="stylesheet" />
</head>

<body class="theme-red">
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
                        INNER JOIN users ON orders.user_id = users.id WHERE ordered_date >=(CURDATE() - INTERVAL 3 DAY)";

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

  <!-- Waves Effect Plugin Js -->
  <script src="plugins/node-waves/waves.js"></script>

  <!-- SweetAlert Plugin Js -->
  <script src="plugins/sweetalert/sweetalert.min.js"></script>

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
  <script src="js/pages/ui/dialogs.js"></script>
  <script src="js/pages/ui/modals.js"></script>
  <script src="js/pages/tables/jquery-datatable.js"></script>

  <!-- Demo Js -->
  <script src="js/demo.js"></script>

</body>

</html>