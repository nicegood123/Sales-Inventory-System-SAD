<?php require '../application/controllers/admin/add-product.php'; ?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title>Products | Admin</title>
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
                <h2>PRODUCTS</h2>
            </div>

            <!-- Exportable Table -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>List of Products</h2>
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
                                            <th>Image</th>
                                            <th>Product Name</th>
                                            <th>Quantity</th>
                                            <th>Category</th>
                                            <th>Supplier</th>
                                            <th>Date Registered</th>
                                            <th class="text-center">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                    <?php
                                    try {

                                        $query = "SELECT products.id, products.photo, products.name, products.QuantityInStock, category.name as 'category_name', supplier.name as 'supplier_name', products.date_registered FROM products INNER JOIN category ON products.category_id = category.id INNER JOIN supplier ON products.supplier_id = supplier.id";
                                        $rows = $function->selectAll($query);
                                        foreach ($rows as $row) { ?>

                                        <tr>
                                            <td><?php echo $row['id']; ?></td>
                                            <td class="text-center">
                                                <img src="../images/products/<?php echo $row['photo']; ?>" width="70" height="70" />
                                            </td>
                                            <td><?php echo $row['name']; ?></td>
                                            <td><?php echo $row['QuantityInStock']; ?></td>
                                            <td><?php echo $row['category_name']; ?></td>
                                            <td><?php echo $row['supplier_name']; ?></td>
                                            <td><?php echo $row['date_registered']; ?></td>
                                            <td class="text-center js-sweetalert">
                                                <button type="button" class="btn btn-info btn-xs waves-effect">
                                                    <i class="material-icons" style="font-size:1.6rem;" data-toggle="modal" data-target="#infoModal">info_outline</i>
                                                </button>    
                                                <button type="button" class="btn btn-warning btn-xs waves-effect">
                                                    <i class="material-icons" style="font-size:1.6rem;" data-toggle="modal" data-target="#editModal">mode_edit</i>
                                                </button>
                                                <button type="button" class="btn btn-danger btn-xs waves-effect" data-toggle="modal" data-target="#deleteModal">
                                                    <i class="material-icons" style="font-size:1.6rem;">delete</i>
                                                </button>
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

    <!-- Add Product Modal -->
    <div class="modal fade" id="addModal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form method="post" id="product_form" enctype="multipart/form-data">
                    <div class="modal-header">
                        <h4 class="modal-title" id="defaultModalLabel">Add Product</h4>
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
                                <textarea rows="1" name="description" class="form-control no-resize auto-growth" style="overflow: hidden; overflow-wrap: break-word; height: 35px;"></textarea>
                                <label class="form-label">Description</label>
                            </div>
                        </div>
                        <div class="form-group form-float">
                            <div class="form-line">
                                <input type="text" name="price" class="form-control">
                                <label class="form-label">Price</label>
                            </div>
                        </div>
                        <div class="form-group form-float">
                            <div class="form-line">
                                <input type="text" name="quantity" class="form-control">
                                <label class="form-label">Quantity</label>
                            </div>
                        </div>
                        <label class="form-label">Category</label>
                        <div class="form-line">
                            <select name="category" class="form-control show-tick">
                                <?php
                                    $query = "SELECT * FROM category";
                                    $rows = $function->selectAll($query);
                                    foreach ($rows as $row): ?>
                                        <option value="<?php echo $row['id']; ?>">
                                            <?php echo $row['name']; ?>
                                        </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="form-group form-float">
                            <label class="form-label">Supplier</label>
                            <select name="supplier" class="form-control show-tick">
                                <?php
                                    $query = "SELECT * FROM supplier";
                                    $rows = $function->selectAll($query);
                                    foreach ($rows as $row): ?>
                                        <option value="<?php echo $row['id']; ?>">
                                            <?php echo $row['name']; ?>
                                        </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="form-group form-float">
                            <label class="form-label">Image</label>
                            <input type="file" name="photo" class="form-control">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-link waves-effect" data-dismiss="modal">CLOSE</button>
                        <input type="submit" name="add-product" class="btn btn-info waves-effect" value="ADD">
                        <!-- <button type="hidden" name="operation" id="operation" class="btn btn-info waves-effect">ADD</button> -->
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Edit Product Modal -->
    <div class="modal fade" id="editModal" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-sm" role="document">
            <div class="modal-content">
                <form>
                    <div class="modal-header">
                        <h4 class="modal-title" id="defaultModalLabel">Edit Product</h4>
                    </div>
                    <div class="modal-body">
                        <div class="form-group form-float">
                            <div class="form-line">
                                <input type="text" id="name" class="form-control">
                                <label class="form-label">Name</label>
                            </div>
                        </div>
                        <div class="form-group form-float">
                            <div class="form-line">
                                <textarea rows="1" class="form-control no-resize auto-growth" style="overflow: hidden; overflow-wrap: break-word; height: 35px;"></textarea>
                                <label class="form-label">Description</label>
                            </div>
                        </div>
                        <div class="form-group form-float">
                            <div class="form-line">
                                <input type="text" id="price" class="form-control">
                                <label class="form-label">Price</label>
                            </div>
                        </div>
                        <div class="form-group form-float">
                            <div class="form-line">
                                <input type="text" id="price" class="form-control">
                                <label class="form-label">Quantity</label>
                            </div>
                        </div>
                        <div class="form-group form-float">
                            <div class="form-line">
                                <select class="form-control show-tick">
                                    <option>Category</option>
                                    <option value="10">Motorcycle Parts</option>
                                    <option value="20">Auto Parts</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group form-float">
                            <div class="form-line">
                                <select class="form-control show-tick">
                                    <option>Supplier</option>
                                    <option value="">Galaxy and Global hardwares</option>
                                    <option value="">SamYa</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group form-float">
                            <label class="form-label">Image</label>
                            <input type="file" class="form-control" id="customFile">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-link waves-effect" data-dismiss="modal">CLOSE</button>
                        <button type="button" class="btn btn-info waves-effect">SAVE CHANGES</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Delete Product Modal -->
    <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-sm" role="document">
            <div class="modal-content">
                <form>
                    <div class="modal-header">
                        <h4 class="modal-title" id="defaultModalLabel">Delete</h4>
                    </div>
                    <div class="modal-body">
                        <p>Are you sure you want to delete this data?</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-link waves-effect" data-dismiss="modal">Cancel</button>
                        <button type="button" class="btn btn-info waves-effect">Yes</button>
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
    <script>
        $('#editModal').on('hidden.bs.modal', function (e) {           
            location.reload();
            $('#editModal').show();
        })
    </script>

</body>

</html>
