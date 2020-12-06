<?php require 'application/controllers/cart.php'; ?>

<!DOCTYPE html>
<html lang="en">

<!-- header and links -->
<?php include 'sections/header.php'; ?>

<body>

  <!-- Top navigation bar -->
  <?php include 'sections/top-navigation-bar.php'; ?>

  <div class="hero-wrap hero-bread" style="background-image: url('images/bg/bg-1.jpg');">
    <div class="container">
      <div class="row no-gutters slider-text align-items-center justify-content-center">
        <div class="col-md-9 ftco-animate text-center">
          <h1 class="mb-0 bread">My Cart</h1>
          <p class="breadcrumbs">
            <span class="mr-2"><a href="index.php">Home</a></span> 
            <span>Cart</span>
          </p>
        </div>
      </div>
    </div>
  </div>

  <section class="ftco-section ftco-cart">
    <div class="container">
      <div class="row">
        <div class="col-md-12 ftco-animate">
          <div class="cart-list">
            <table class="table">
              <thead class="thead-primary">
                <tr class="text-center">
                  <th>&nbsp;</th>
                  <th>&nbsp;</th>
                  <th>Product</th>
                  <th>Price</th>
                  <th>Quantity</th>
                  <th>Total</th>
                </tr>
              </thead>
              <tbody>

                <?php

                try {

                  $total = 0;
                  $subtotal = 0;
                  $status = null;
                  $delivery = 790;
                  $user_id = $_SESSION['user']['id'];

                  $query = "SELECT cart.cart_id, products.id, products.name, products.photo, products.price, cart.quantity, (products.price * cart.quantity) AS 'total' FROM cart INNER JOIN products ON cart.product_id = products.id WHERE user_id = ".$user_id." AND cart_code = 0 GROUP BY cart.product_id ORDER BY cart_id";

                  $rows = $function->selectAll($query);
                  foreach ($rows as $row) { ?>

                    <tr class="text-center">
                      <td class="product-remove">
                        <a href="cart.php?cart_id=<?php echo $row['cart_id']; ?>">
                          <span class="ion-ios-close"></span>
                        </a>
                      </td>

                      <td class="image-prod">
                        <a href="product-details.php?product_id=<?php echo $row['id']; ?>" class="img" style="background-image:url(<?php echo 'images/products/' . $row['photo']; ?>);"></a>
                      </td>

                      <td class="product-name">
                        <a href="product-details.php?product_id=<?php echo $row['id']; ?>">
                          <h3><?php echo $row['name']; ?></h3>
                        </a>
                      </td>

                      <td class="price">PHP <?php echo number_format($row['price'], 2); ?></td>

                      <td class="quantity">
                        <div class="input-group mb-3">
                          <span class="input-group-btn mr-2">
                            <a href="cart.php?minus=<?php echo $row['cart_id']; ?>">
                              <button type="button" name="minus" class="quantity-left-minus product-details button">
                                <i class="ion-ios-remove"></i>
                              </button>
                            </a>

                          </span>
                          <input type="text" class="form-control input-number" value="<?php echo $row['quantity']; ?>" disabled>
                          <span class="input-group-btn ml-2">
                           <a href="cart.php?plus=<?php echo $row['cart_id']; ?>">
                            <button type="button" name="plus" class="quantity-right-plus product-details button">
                              <i class="ion-ios-add"></i>
                            </button>
                          </a>
                        </span>
                      </div>
                    </td>

                    <td class="total">PHP <?php echo number_format($row['total'], 2); ?></td>
                  </tr>

                  <?php

                  $subtotal += $row['total'];

                }

                  //Cart Total
                if (empty($subtotal)) {
                  $delivery = 0.00;
                  $status = 'hidden=""';
                }
                $total = $subtotal + $delivery;

              } catch (PDOException $e) {
                echo "There is some problem in connection: " . $e->getMessage();
              }

              ?>

            </tbody>
          </table>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col col-lg-7 col-md-6 mt-5 cart-wrap ftco-animate">
        <div class="cart-total mb-3">
          <h3>Note</h3>
          <p class="d-flex">
            Please check your cart carefully to avoid paying multiple items or unnecessary items.
          </p>
        </div>
      </div>
      <div class="col col-lg-5 col-md-6 mt-5 cart-wrap ftco-animate">
        <div class="cart-total mb-3">
          <h3>Cart Totals</h3>
          <p class="d-flex">
            <span>Subtotal</span>
            <span><?php echo 'PHP ' . number_format($subtotal, 2); ?></span>
          </p>
          <p class="d-flex">
            <span>Delivery</span>
            <span><?php echo 'PHP ' . number_format($delivery, 2); ?></span>
          </p>
          <hr>
          <p class="d-flex total-price">
            <span>Total</span>
            <span>PHP <?php echo number_format($total, 2); ?></span>
          </p>
        </div>
        <p class="text-center">
          <a href="checkout.php" class="btn btn-primary py-3 px-4" <?php echo $status; ?>>Proceed to Checkout</a>
        </p>
      </div>
    </div>
  </div>
</section>

<!-- footer -->
<?php include 'sections/footer.php'; ?>
<!-- loader -->
<?php include 'sections/loader.php'; ?>
<!-- scripts -->
<?php include 'sections/scripts.php'; ?>

</body>
</html>