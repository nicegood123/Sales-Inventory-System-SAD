<?php require 'application/controllers/signup.php'; ?>

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
          <h1 class="mb-0 bread">Create Account</h1>
          <p class="breadcrumbs">
            <span class="mr-2"><a href="index.php">Home</a></span>
            <span>Create Account</span>
          </p>
        </div>
      </div>
    </div>
  </div>

  <section class="ftco-section contact-section bg-light">
    <div class="container">
      <div class="row justify-content-center">
        <?php echo $message; ?>
        <div class="col-md-5 mt-4 d-flex">
          <form method="post" class="cart-detail bg-white p-3 p-md-4 contact-form" data-parsley-validate>
            <h3 class="mb-4 billing-heading text-center">Sign Up</h3>

            <div class="form-group">
              <label for="firstname">First Name</label>
              <input type="text" name="firstname" class="form-control" required="" maxlength="15">
            </div>
            <div class="form-group">
              <label for="lastname">Last Name</label>
              <input type="text" name="lastname" class="form-control" required="" maxlength="25">
            </div>
            <div class="form-group">
              <label for="emailaddress">Email Address</label>
              <input type="email" name="email" class="form-control" required="" maxlength="30">
            </div>
            <div class="form-group">
              <label for="password">Password</label>
              <input type="password" name="password" class="form-control" required="" data-parsley-length="[6, 25]">
            </div>
            <div class="form-group">
              <input type="submit" name="signup" value="Create Account" class="btn btn-primary py-3 px-5">
            </div>
          </form>
        </div>
      </div>
    </div>
  </section>

  	<!--Update User's' Info Modal -->
	<div class="modal fade" id="createAccountModal" tabindex="-1" role="dialog" aria-labelledby="createAccountModal" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered" role="document">
			<div class="modal-content">
        <div class="modal-header bs-success">
					<h5 class="modal-title" id="exampleModalLongTitle">Registration Successful</h5>
            <a href="sign-in.php" class="close">&times;</a>
				</div>
				<div class="modal-body">
          <p>
          Thanks!<br>
          Your account has been successfully created. <br>
          </p>
				</div>
			</div>
		</div>
	</div>

  <!-- footer -->
  <?php include 'sections/footer.php'; ?>
  <!-- loader -->
  <?php include 'sections/loader.php'; ?>
  <!-- scripts -->
  <?php include 'sections/scripts.php'; ?>

  <script>
    $(document).ready(function(){
      var text=$('#title').html();
      if (text === 'Registration Successful'){
        $('#createAccountModal').modal({
          backdrop: 'static',
          keyboard: false
        })
      }
    });
  </script>

</body>
</html>