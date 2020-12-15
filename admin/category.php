<?php 

require '../application/config/connection.php';
require_once '../application/config/functions.php';
require '../application/controllers/admin/add-category.php';

if (isset($_POST['delete-category'])) {

  $data = ['id' => $_GET['id']];

  $query = "DELETE FROM category WHERE id = :id";
  $function->delete($query, $data);

  $query = "UPDATE products SET category_id = 0 WHERE category_id = :id";
  $function->update($query, $data);

}

if (isset($_POST['edit-category'])) {

    $id = $_GET['id'];

    $data = [
        'id' => $id,
        'name' => $_POST['name']
    ];
  
    $query = "UPDATE category SET name = :name WHERE id = :id";
    $function->update($query, $data);
  
  }

?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title>Category | Admin</title>

    <!-- links -->
    <?php include 'sections/links.php'; ?>

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
                <h2>CATEGORY</h2>
            </div>

            <!-- Exportable Table -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>List of Categories</h2>
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
                                            <th class="text-center">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        <?php

                                    try {
                                        $query = "SELECT * FROM category WHERE id != 0";
                                        $rows = $function->selectAll($query);
                                        foreach ($rows as $row) { ?>

                                        <tr>
                                            <td><?php echo $row['id']; ?></td>
                                            <td><?php echo $row['name']; ?></td>
                                            <td class="text-center js-sweetalert">
                                                <button data-toggle="modal"
                                                    data-target="#editModal_<?php echo $row['id']; ?>"
                                                    class="btn btn-warning btn-xs waves-effect">
                                                    <i class="material-icons" style="font-size:1.6rem;">mode_edit</i>
                                                </button>
                                                <button type="button" class="btn btn-danger btn-xs waves-effect"
                                                    data-toggle="modal"
                                                    data-target="#deleteModal_<?php echo $row['id']; ?>">
                                                    <i class="material-icons" style="font-size:1.6rem;">delete</i>
                                                </button>

                                                <?php include 'category-modal.php'; ?>
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

    <!-- Add Category Modal -->
    <div class="modal fade" id="addModal" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-sm" role="document">
            <div class="modal-content">
                <form method="post">
                    <div class="modal-header">
                        <h4 class="modal-title" id="defaultModalLabel">Add Category</h4>
                    </div>
                    <div class="modal-body">
                        <div class="form-group form-float">
                            <div class="form-line">
                                <input type="text" id="name" name="name" class="form-control">
                                <label class="form-label">Name</label>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-link waves-effect" data-dismiss="modal">CLOSE</button>
                        <button type="submit" name="add-category" class="btn btn-info waves-effect">ADD</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- scripts -->
    <?php include 'sections/scripts.php'; ?>

</body>

</html>