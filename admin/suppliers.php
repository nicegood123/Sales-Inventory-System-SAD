<?php 

require '../application/config/connection.php';
require_once '../application/config/functions.php';
require '../application/controllers/admin/add-supplier.php';


if (isset($_POST['delete-supplier'])) {

    $data = ['id' => $_GET['id']];
  
    $query = "DELETE FROM supplier WHERE id = :id";
    $function->delete($query, $data);
  
    $query = "UPDATE products SET supplier_id = 0 WHERE supplier_id = :id";
    $function->update($query, $data);
  
  }


if (isset($_POST['edit-supplier'])) {

    $id = $_GET['id'];

    $data = [
        'id' => $id,
        'name' => $_POST['name'],
        'address' => $_POST['address'],
        'contact' => $_POST['contact']
    ];
  
    $query = "UPDATE supplier SET name = :name, address = :address, contact = :contact WHERE id = :id";
    $function->update($query, $data);
  
  }


?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title>Suppliers | Admin</title>
    <!-- Favicon-->
    <link rel="icon" href="../favicon.ico" type="image/x-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,700&subset=latin,cyrillic-ext" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" type="text/css">
    
    <!-- Font Awesome Fonts -->
    <link href="fonts/fontawesome-free-5.15.1/css/all.css" rel="stylesheet">

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
                <h2>SUPPLIERS</h2>
            </div>

            <!-- Exportable Table -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>List of Suppliers</h2>
                            <a href="#" class="header-dropdown m-r-5" data-toggle="modal" data-target="#addModal">
                                <i class="material-icons">add</i>
                            </a>
                        </div>
                        <div class="body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Name</th>
                                            <th>Address</th>
                                            <th>Phone Number</th>
                                            <th class="text-center">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                    <?php

                                    try {
                                        $query = "SELECT * FROM supplier WHERE id != 0";
                                        $rows = $function->selectAll($query);
                                        foreach ($rows as $row) { ?>

                                        <tr>
                                            <td><?php echo $row['id']; ?></td>
                                            <td><?php echo $row['name']; ?></td>
                                            <td><?php echo $row['address']; ?></td>
                                            <td><?php echo $row['contact']; ?></td>
                                            <td class="text-center js-sweetalert">
                                                <button data-toggle="modal" data-target="#editModal_<?php echo $row['id']; ?>" class="btn btn-warning btn-xs waves-effect">
                                                    <i class="material-icons" style="font-size:1.6rem;">mode_edit</i>
                                                </button>
                                                <button type="button" class="btn btn-danger btn-xs waves-effect" data-toggle="modal" data-target="#deleteModal_<?php echo $row['id']; ?>">
                                                    <i class="material-icons" style="font-size:1.6rem;">delete</i>
                                                </button>
                              
                                                <?php include 'supplier-modal.php'; ?>
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
            </div>
            <!-- #END# Exportable Table -->
        </div>
    </section>

    <!-- Add Supplier Modal -->
    <div class="modal fade" id="addModal" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-sm" role="document">
            <div class="modal-content">
                <form method="post">
                    <div class="modal-header">
                        <h4 class="modal-title" id="defaultModalLabel">Add Supplier</h4>
                    </div>
                    <div class="modal-body">
                        <div class="form-group form-float">
                            <div class="form-line">
                                <input type="text" id="name" name="name" class="form-control">
                                <label class="form-label">Name</label>
                            </div>
                        </div>
                        <div class="form-group form-float">
                            <div class="form-line">
                                <textarea rows="1" name="address" class="form-control no-resize auto-growth" style="overflow: hidden; overflow-wrap: break-word; height: 35px;"></textarea>
                                <label class="form-label">Address</label>
                            </div>
                        </div>
                        
                        <div class="form-group form-float">
                            <div class="form-line">
                                <input type="text" id="address" name="contact" class="form-control">
                                <label class="form-label">Phone Number</label>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-link waves-effect" data-dismiss="modal">CLOSE</button>
                        <button type="submit" name="add-supplier" class="btn btn-info waves-effect">ADD</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

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
