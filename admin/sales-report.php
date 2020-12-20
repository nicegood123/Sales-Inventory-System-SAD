<?php
    require '../application/config/connection.php';
    require_once '../application/config/functions.php';
    
    session_start();

    $query = "SELECT orders.order_id, CONCAT(users.firstname, ' ', users.lastname) AS 'name',
    orders.discount, orders.total, orders.payment_method, orders.ordered_date FROM orders
    INNER JOIN users ON orders.user_id = users.id";

    if (isset($_POST['search'])) {
      if (isset($_POST['date-from']) && isset($_POST['date-to'])) {
        $query .= " WHERE DATE_FORMAT(ordered_date,'%m/%d/%Y') BETWEEN '".$_POST['date-from']."' and '".$_POST['date-to'] . '23:59:00' ."'";
      }
    }


    // $sales = "SELECT SUM(total) as 'total_sales' FROM orders";

    // $rows = $function->totalSales($sales);
    // foreach ($rows as $row) {
    //   $total_sales = $row['total_sales'];
    // }

?>

<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <title id="title-sales">Sales Report</title>

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

            </div>
            <div class="body">
              <form method="post">
                <div class="row clearfix">
                  <div class="col-lg-5 col-md-3 col-sm-3 col-xs-6">
                    <div class="input-daterange input-group" id="bs_datepicker_range_container">
                      <div class="form-line">
                        <input type="text" class="form-control" name="date-from" placeholder="Date start...">
                      </div>
                      <span class="input-group-addon">to</span>
                      <div class="form-line">
                        <input type="text" class="form-control" name="date-to" placeholder="Date end...">
                      </div>
                    </div>
                  </div>
                  <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">
                    <button type="submit" name="search" class="btn bg-blue-grey btn-sm waves-effect">Search</button>
                  </div>
                  <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
                    <b id="total"></b>
                  </div>
                </div>
              </form>

              <div class="table-responsive">
                <table class="table table-bordered table-striped table-hover dataTable js-exportable" id="example">
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
                        $total_sales = 0;
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
                      $total_sales += $row['total'];

                          }
                          $_SESSION['total_sales'] = $total_sales;
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

  <script>
    $(document).ready(function () {

      $('#example').DataTable({
        destroy: true,
        paging: false,
        dom: 'Bfrtip',
        buttons: [
          'copy', 'csv', 'excel', 'pdf', 'print'
        ]
      });

      

      var total_sales = 0.00;

      //Iterate all td's in second column
      $('#example tbody tr td:nth-child(4)').each(function () {
        //add item to array
        total_sales += parseFloat($(this).text());
      });

      $('#total').text('PHP ' + total_sales.toFixed(2));
      $('#title-sales').text('Sales Report - PHP ' + total_sales.toFixed(2));
    });
  </script>

</body>

</html>