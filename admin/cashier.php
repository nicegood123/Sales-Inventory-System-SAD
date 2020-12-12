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
    <title>Home | cashier</title>
    <!-- Favicon-->
    <link rel="icon" href="favicon.ico" type="image/x-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,700&subset=latin,cyrillic-ext" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" type="text/css">

    <!-- Bootstrap Core Css -->
    <link href="plugins/bootstrap/css/bootstrap.css" rel="stylesheet">

    <!-- Waves Effect Css -->
    <link href="plugins/node-waves/waves.css" rel="stylesheet" />

    <!-- Animation Css -->
    <link href="plugins/animate-css/animate.css" rel="stylesheet" />

    <!-- JQuery DataTable Css -->
    <link href="plugins/jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.css" rel="stylesheet">

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
                <h2>CASHIER</h2>
            </div>

            <!-- Multiple Items To Be Open -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="body">
                            <div class="row clearfix">
                                <div class="col-xs-12 ol-sm-12 col-md-12 col-lg-12">
                                    <div class="panel-group" id="accordion_19" role="tablist" aria-multiselectable="true">
                                        <div class="panel panel-default">
                                            <div class="panel-heading" role="tab" id="headingOne_19">
                                                <h4 class="panel-title">
                                                    <a role="button" data-toggle="collapse" href="#collapseOne_19" aria-expanded="true" aria-controls="collapseOne_19">Products</a>
                                                </h4>
                                            </div>
                                            <div id="collapseOne_19" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne_19">
                                                <div class="panel-body">
                                                <div class="table-responsive">
                                                    <table class="table table-bordered table-striped table-hover dataTable js-basic-example" id="products-table">
                                                        <thead>
                                                            <tr>
                                                                <th>Product Name</th>
                                                                <th>Price</th>
                                                                <th>Quantity</th>
                                                                <th class="text-center">Actions</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>

                                                        <?php
                                                        try {

                                                            $query = "SELECT * FROM products WHERE QuantityInStock > 0";
                                                            $rows = $function->selectAll($query);
                                                            foreach ($rows as $row) { ?>

                                                            <tr>
                                                                <td><?php echo $row['name']; ?></td>
                                                                <td><?php echo $row['price']; ?></td>
                                                                <td><?php echo $row['QuantityInStock']; ?></td>
                                                                <td class="text-center">
                                                                    <a href="#" class="btn btn-success btn-xs waves-effect">
                                                                        <i class="material-icons" style="font-size:1.6rem;">add</i>
                                                                    </a>
                                                                </td>
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
                                        <div class="panel panel-default">
                                            <div class="panel-heading" role="tab" id="headingTwo_19">
                                                <h4 class="panel-title">
                                                    <a class="collapsed" role="button" data-toggle="collapse" href="#collapseTwo_19" aria-expanded="false" aria-controls="collapseTwo_19">Orders</a>
                                                </h4>
                                            </div>
                                            <div id="collapseTwo_19" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingTwo_19">
                                                <div class="panel-body">
                                                  <div class="table-responsive">
                                                    <table class="table table-bordered table-striped table-hover dataTable js-basic-example" id="products-table">
                                                        <thead>
                                                            <tr>
                                                                <th>Product</th>
                                                                <th>Price</th>
                                                                <th>Quantity</th>
                                                                <th>Total</th>
                                                                <th></th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr>
                                                              <td>
                                                          
                                                                <?php echo 'name'; ?></td>
                                                              <td><?php echo 'price'; ?></td>
                                                              <td class="text-center">
                                                                <div class="btn-group">
                                                                  <a href="#" class="btn btn-info btn-xs waves-effect">
                                                                    <i class="material-icons" style="font-size:1.6rem;">remove</i>
                                                                  </a>
                                                                  <a class="btn btn-default btn-xs waves-effect">
                                                                    <i class="material-icons" style="font-size:1.6rem;">12</i>
                                                                  </a>
                                                                  <a href="#" class="btn btn-info btn-xs waves-effect">
                                                                    <i class="material-icons" style="font-size:1.6rem;">add</i>
                                                                  </a>
                                                                </div>
                                                              </td>
                                                              <td><?php echo 'Total'; ?></td>
                                                              <td>
                                                                <a href="#" class="btn btn-danger btn-xs waves-effect">
                                                                  <i class="material-icons" style="font-size:1.6rem;">clear</i>
                                                                </a>  
                                                              </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                  </div>


                                                  <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 m-t-30">
                                                    <p class="pull-right">
                                                        <b>Cart Total</b>
                                                        PHP 123,123.12
                                                    </p>
                                                  </div>
                                                  <input type="submit" class="btn btn-primary pull-right" value="Checkout">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- #END# Multiple Items To Be Open -->
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

</body>

</html>
