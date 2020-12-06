<?php require 'application/controllers/signin.php'; ?>

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
          <h1 class="mb-0 bread">Sign In Account</h1>
          <p class="breadcrumbs"><span class="mr-2"><a href="index.php">Home</a></span> <span>Sign In</span></p>
        </div>
      </div>
    </div>
  </div>

  <section class="ftco-section contact-section bg-light">
    <div class="container">
      <div class="row block-9">
        <?php echo $message; ?>
        <div class="col-md-7 d-flex">
          <div class="cart-detail bg-white p-3 p-md-4" style="background-image: url('images/login-image.jpg');background-size: cover;">
            <h3 class="mb-4 text-center mt-2" style="color: #e4e8ec; font-weight: bolder;">
              Welcome to Gisan Online Guitar Store
            </h3>
          </div>
        </div>
        <div class="col-md-5 d-flex">
          <form method="post" class="cart-detail bg-white p-3 p-md-4 contact-form" data-parsley-validate>
            <h3 class="mb-4 billing-heading text-center">Sign In</h3>
            <div class="form-group">
              <label for="emailaddress">Email Address</label>
              <input type="email" name="email-address" class="form-control" required="">
            </div>
            <div class="form-group">
              <label for="password">Password</label>
              <input type="password" name="password" class="form-control" required="">
            </div>
            <div class="form-group">
              <input type="submit" name="signin" value="Sign In" class="btn btn-primary py-3 px-5">
            </div>
            <div class="form-group">
              <p class="breadcrumbs text-center">
                New to our Shop? 
                <span class="mr-2">
                  <a href="sign-up.php">Create Account</a>
                </span>
              </p>
            </div>
          </form>
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