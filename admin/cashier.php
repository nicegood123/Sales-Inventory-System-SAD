<?php

require '../application/config/connection.php';
require_once '../application/config/functions.php';

session_start();

if (!isset($_SESSION['is_logged_in'])) {
	header("Location:../sign-in.php");
}

if (isset($_POST['add-order'])) {

    if (empty($_SESSION['user_id'])) {
        $user_id = -1;
    } else {
        $user_id = $_SESSION['user_id'];
    }

    $product_id = $_GET['id'];
    $quantity = $_POST['quantity'];

    $data = [
        'cart_code' => 1,
        'user_id' => $user_id,
        'product_id' => $product_id
    ];

    $product = $function->searchInCart($data);

    if (empty($product)) {

        $data = [
            'product_id' => $product_id,
            'user_id' => $user_id,
            'quantity' => $quantity,
        ];

        $query = "INSERT INTO cart (user_id, product_id, quantity, cart_code) VALUES (:user_id, :product_id, :quantity, 1)";
        $function->insert($query, $data);

    } else {

        $quantity += $product['quantity'];
        $data = [
            'quantity' => $quantity,
            'cart_id' => $product['cart_id'],
        ];

        $query = "UPDATE cart SET quantity = :quantity WHERE cart_id = :cart_id";
        $function->update($query, $data);

    }

    //Update Product QuantityInStock
    $data = ['quantity' => $_POST['quantity'], 'id' => $product_id];
    $query = "UPDATE products SET QuantityInStock = (QuantityInStock - :quantity) WHERE id = :id";
    $function->update($query, $data);
  
  }

  //delete products
if (isset($_GET['delete_id'])) {

    $cart_id = $_GET['delete_id'];

    $cart = $function->getData('cart', 'cart_id', $cart_id);

    //Update Product QuantityInStock
    $data = ['quantity' => $cart['quantity'], 'id' => $cart['product_id']];
    $query = "UPDATE products SET QuantityInStock = (QuantityInStock + :quantity) WHERE id = :id";
    $function->update($query, $data);

    $data = ['cart_id' => $cart_id];
    $query = "DELETE FROM cart WHERE cart_id = :cart_id";
    $function->delete($query, $data);

  }


?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title>Cashier | Admin</title>

    <!-- links -->
    <?php include 'sections/links.php'; ?>

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

            <?php echo $_SESSION['message']; $_SESSION['message'] = ''; ?>

            <!-- Multiple Items To Be Open -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="body">
                            <div class="row clearfix">
                                <div class="col-xs-12 ol-sm-12 col-md-12 col-lg-12">
                                    <div class="panel-group" id="accordion_19" role="tablist"
                                        aria-multiselectable="true">
                                        <div class="panel panel-default">
                                            <div class="panel-heading" role="tab" id="headingOne_19">
                                                <h4 class="panel-title">
                                                    <a role="button" data-toggle="collapse" href="#collapseOne_19"
                                                        aria-expanded="true" aria-controls="collapseOne_19">Products</a>
                                                </h4>
                                            </div>
                                            <div id="collapseOne_19" class="panel-collapse collapse" role="tabpanel"
                                                aria-labelledby="headingOne_19">
                                                <div class="panel-body">
                                                    <div class="table-responsive">
                                                        <table
                                                            class="table table-bordered table-striped table-hover dataTable js-basic-example"
                                                            id="products-table">
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
                                                                    <td>PHP
                                                                        <?php echo number_format($row['price'], 2); ?>
                                                                    </td>
                                                                    <td><?php echo $row['QuantityInStock']; ?></td>
                                                                    <td class="text-center">
                                                                        <a data-toggle="modal"
                                                                            data-target="#addModal_<?php echo $row['id']; ?>"
                                                                            class="btn btn-success btn-xs waves-effect">
                                                                            <i class="material-icons"
                                                                                style="font-size:1.6rem;">add</i>
                                                                        </a>
                                                                        <?php include 'cashier-modal.php'; ?>
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
                                                    <a class="collapsed" role="button" data-toggle="collapse"
                                                        href="#collapseTwo_19" aria-expanded="false"
                                                        aria-controls="collapseTwo_19">Cart</a>
                                                </h4>
                                            </div>
                                            <div id="collapseTwo_19" class="panel-collapse collapse in" role="tabpanel"
                                                aria-labelledby="headingTwo_19">
                                                <div class="panel-body">
                                                    <div class="table-responsive">
                                                        <table
                                                            class="table table-bordered table-striped table-hover dataTable js-basic-example"
                                                            id="products-table">
                                                            <thead>
                                                                <tr>
                                                                    <th>Product</th>
                                                                    <th>Price</th>
                                                                    <th>Quantity</th>
                                                                    <th>Total</th>
                                                                    <th class="text-center">Action</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>

                                                                <?php

                                                        $data = ['user_id' => -1, 'cart_code' => 0];
                                                        $query = "SELECT * FROM cart WHERE user_id = :user_id AND cart_code = :cart_code";
                                                        $cart = $function->getRow($query, $data);
                                                        if(!empty($cart)) {
                                                            $_SESSION['cart_id'] = $cart['cart_id'];
                                                        }

                                                        $cart_total = 0;
                                                        $query = "SELECT cart.cart_id, products.id, products.name, products.price, cart.quantity, (products.price * cart.quantity) AS 'total' FROM cart INNER JOIN products ON cart.product_id = products.id WHERE cart_code = 1 ";
                                                        $rows = $function->selectAll($query);

                                                        if (empty($rows)) {
                                                            $_SESSION['user_id'] = -1;
                                                        }

                                                        foreach ($rows as $row) { ?>
                                                                <tr>
                                                                    <td><?php echo $row['name']; ?></td>
                                                                    <td>PHP
                                                                        <?php echo number_format($row['price'], 2); ?>
                                                                    </td>
                                                                    <td class="text-center">
                                                                        <div class="btn-group">
                                                                            <a href="#"
                                                                                class="btn btn-info btn-xs waves-effect">
                                                                                <i class="material-icons"
                                                                                    style="font-size:1.6rem;">remove</i>
                                                                            </a>
                                                                            <a class="btn btn-default btn-xs m-r-5">
                                                                                <i class="material-icons"
                                                                                    style="font-size:1.6rem;"></i>
                                                                                <?php echo $row['quantity']; ?>
                                                                            </a>
                                                                            <a href="#"
                                                                                class="btn btn-info btn-xs waves-effect">
                                                                                <i class="material-icons"
                                                                                    style="font-size:1.6rem;">add</i>
                                                                            </a>
                                                                        </div>
                                                                    </td>
                                                                    <td>PHP
                                                                        <?php echo number_format($row['total'], 2); ?>
                                                                    </td>
                                                                    <td class="text-center">
                                                                        <a href="?delete_id=<?php echo $row['cart_id']; ?>"" class="
                                                                            btn btn-danger btn-xs waves-effect">
                                                                            <i class="material-icons"
                                                                                style="font-size:1.6rem;">clear</i>
                                                                        </a>
                                                                    </td>
                                                                </tr>

                                                                <?php
                                                            $cart_total += $row['total'];
                                                        }
                                                		$_SESSION['cart_total'] = $cart_total;
                                                        ?>

                                                            </tbody>
                                                        </table>
                                                    </div>

                                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 m-t-30">
                                                        <p class="pull-right" id="cart-total">
                                                            <b>Cart Total</b>
                                                            PHP <?php echo number_format($cart_total, 2);  ?>
                                                        </p>
                                                    </div>
                                                    <!-- <input type="submit" class="btn btn-primary pull-right" value="Checkout"> -->

                                                    <button id="proceed-to-checkout" disabled
                                                        class="btn btn-primary pull-right"
                                                        onclick="window.location.href='checkout.php'">
                                                        Proceed to Checkout
                                                    </button>
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

    <!-- scripts -->
    <?php include 'sections/scripts.php'; ?>

    <script>
        $(document).ready(function () {

            var cart_total = $('#cart-total').text();
            if (cart_total.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1') > 0) {
                $('#proceed-to-checkout').removeAttr('disabled');
            } else {
                $('#proceed-to-checkout').attr('disabled', 'disabled');
            }

        });
    </script>

</body>

</html>