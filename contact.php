
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
          <h1 class="mb-0 bread">Contact</h1>
          <p class="breadcrumbs"><span class="mr-2"><a href="index.php">Home</a></span> <span>Contact</span></p>
        </div>
      </div>
    </div>
  </div>

  <section class="ftco-section contact-section bg-light">
    <div class="container">
      <div class="row block-9">
        <div class="col-md-7 d-flex">
          <div class="cart-detail bg-white p-3 p-md-4" style="background-image: url('images/login-image.jpg');background-size: cover;">
            <h3 class="mb-4 text-center mt-2" style="color: #e4e8ec; font-weight: bolder;">
              Welcome to XYT Online Store
            </h3>
          </div>
        </div>
        <div class="col-md-5 d-flex">
            <form action="#" class="bg-white p-5 contact-form">
              <div class="form-group">
                <input type="text" class="form-control" placeholder="Your Name">
              </div>
              <div class="form-group">
                <input type="text" class="form-control" placeholder="Your Email">
              </div>
              <div class="form-group">
                <input type="text" class="form-control" placeholder="Subject">
              </div>
              <div class="form-group">
                <textarea name="" id="" cols="30" rows="7" class="form-control" placeholder="Message"></textarea>
              </div>
              <div class="form-group">
                <input type="submit" value="Send Message" class="btn btn-primary py-3 px-5">
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