<?php require 'application/controllers/order-summary.php'; ?>

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
          <h1 class="mb-0 bread">Order Summary</h1>
          <p class="breadcrumbs">
            <span class="mr-2"><a href="index.php">Home</a></span> 
            <span>Order Summary</span>
          </p>
        </div>
      </div>
    </div>
  </div>

  <section class="ftco-section ftco-cart">
    <div class="container">
      <div class="row">
        <div class="col col-lg-12 col-md-6 mt-5 cart-wrap ftco-animate">
          <div class="cart-total">
            <h3>Order Summary</h3>
            <hr>
            <div class="row">
              <div class="col-md-6">
                <div class="info mb-5">
                  <p style="color: #4f4f4f;"><b>Billing Details</b></p>
                  <p><span>Name </span><b><?php echo $order_summary['firstname'] . ' ' . $order_summary['lastname']; ?></b></p>
                  <p><span>Contact </span><b><?php echo $order_summary['contact']; ?></b></p>
                  <p><span>Email Address </span><b><?php echo $order_summary['email']; ?></b></p>
                  <p><span>Address </span><b><?php echo $order_summary['address']; ?></b></p>
                </div>
              </div>
              <div class="col-md-6">
                <div class="info">
                  <p style="color: #4f4f4f;"><b>Order Info</b></p>
                  <div class="row">
                   <div class="col-md-6">
                    <p><span>Order ID </span><b><?php echo $order_summary['order_id']; ?></b></p>
                    <p><span>Payment Method </span><b>Cash on Delivery</b></p>
                    <p><span>Date Ordered </span><b><?php echo $order_summary['ordered_date']; ?></b></p>
                   <p><span>Total </span><b>PHP <?php echo number_format($order_summary['total'], 2); ?></b></p>
                  </div>
               </div>
             </div>
           </div>
         </div>
       </div>
     </div>
   </div>

   <div class="row">
    <div class="col-md-12 mt-5 ftco-animate">
      <div class="cart-list">
        <table class="table">
          <thead class="thead-primary">
            <tr class="text-center">
              <th>&nbsp;</th>
              <th>Product</th>
              <th>Price</th>
              <th>Quantity</th>
            </tr>
          </thead>
          <tbody>

            <?php

            try {

              $order_id = $_GET['order_id'];

              $query = "SELECT cart.cart_id, products.id, products.name, products.photo, products.price, cart.quantity, (products.price * cart.quantity) AS 'total' FROM cart INNER JOIN products ON cart.product_id = products.id WHERE cart_code = ". $order_id ." GROUP BY cart.product_id ORDER BY cart_id";

              $rows = $function->selectAll($query);
              foreach ($rows as $row) { ?>

                <tr class="text-center">
                  <td class="image-prod">
                    <a class="img" style="background-image:url(<?php echo 'images/products/' . $row['photo']; ?>);"></a>
                  </td>
                  <td class="product-name">
                    <h3><?php echo $row['name']; ?></h3>
                  </td>
                  <td class="price">PHP <?php echo number_format($row['price'], 2); ?></td>
                  <td class="quantity">
                    <div class="input-group">
                      <input type="text" class="form-control" value="<?php echo $row['quantity']; ?>" disabled>
                    </div>
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
</section>

<!-- footer -->
<?php include 'sections/footer.php'; ?>
<!-- loader -->
<?php include 'sections/loader.php'; ?>
<!-- scripts -->
<?php include 'sections/scripts.php'; ?>

</body>
</html>