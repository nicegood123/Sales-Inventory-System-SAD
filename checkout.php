<?php require 'application/controllers/checkout.php'; ?>

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
					<h1 class="mb-0 bread">Checkout</h1>
					<p class="breadcrumbs">
						<span class="mr-2"><a href="index.php">Home</a></span> <span>Checkout</span>
					</p>
				</div>
			</div>
		</div>
	</div>

	<section class="ftco-section">
		<div class="container">
			<div class="row justify-content-center">
				<div class="col-xl-8 ftco-animate">
					<form method="post" class="billing-form bg-light p-3 p-md-5" id="billing-form" data-parsley-validate>
						<h3 class="mb-4 billing-heading">Billing Details</h3>
						<div class="row align-items-end">
							<div class="col-md-6">
								<div class="form-group">
									<label for="firstname">First Name</label>
									<input type="text" name="firstname" class="form-control" value="<?php echo $user['firstname']; ?>" disabled>
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label for="lastname">Last Name</label>
									<input type="text" name="lastname" class="form-control" value="<?php echo $user['lastname']; ?>" disabled>
								</div>
							</div>
							<div class="w-100"></div>
							<div class="w-100"></div>
							<div class="col-md-12">
								<div class="form-group">
									<label for="address">Address</label>
									<input type="text" name="address" class="form-control" value="<?php echo $user['address']; ?>" required="">
								</div>
							</div>
							<div class="w-100"></div>
							<div class="w-100"></div>
							<div class="col-md-6">
								<div class="form-group">
									<label for="contact">Phone</label>
									<input type="text" name="contact" class="form-control" value="<?php echo $user['contact']; ?>" required="">
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label for="emailaddress">Email Address</label>
									<input type="text" name="email-address" class="form-control" value="<?php echo $user['email']; ?>" disabled>
								</div>
							</div>
							<div class="w-100"></div>
						</div>
					</form>

					<!-- END -->

					<div class="row mt-5 pt-3 d-flex">
						<div class="col-md-6 d-flex">
							<div class="cart-detail cart-total bg-light p-3 p-md-4">
								<h3 class="billing-heading mb-4">Cart Total</h3>
								<p class="d-flex">
									<span>Subtotal</span>
									<span>PHP <?php echo number_format($cart_subtotal['subtotal'], 2); ?></span>
								</p>
								<p class="d-flex">
									<span>Delivery</span>
									<span>PHP <?php echo number_format($delivery, 2); ?></span>
								</p>
								<hr>
								<p class="d-flex total-price">
									<span>Total</span>
									<span>PHP <?php echo number_format($total, 2); ?></span>
								</p>
							</div>
						</div>
						<div class="col-md-6">
							<div class="cart-detail bg-light p-3 p-md-4">
								<h3 class="billing-heading mb-4">Payment Method</h3>
								<div class="form-group">
									<div class="col-md-12">
										<div class="radio">
											<label>
												<input type="radio" name="optradio" class="mr-2" checked="">
												Cash on Delivery
											</label>
										</div>
									</div>
								</div>
								<div class="form-group">
									<div class="col-md-12">
										<div class="radio">
											<label>
												<input type="radio" name="optradio" class="mr-2" disabled="">
												Check Payment (Not Available)
											</label>
										</div>
									</div>
								</div>
								<div class="form-group">
									<div class="col-md-12">
										<div class="radio">
											<label>
												<input type="radio" name="optradio" class="mr-2" disabled="">
												Paypal (Not Available)
											</label>
										</div>
									</div>
								</div>
								<div class="form-group">
									<div class="col-md-12">
										<div class="checkbox">
											<label>
												<input type="checkbox" id="terms-and-conditions" value="check" class="mr-2">
												I have read and accept the terms and conditions
											</label>
										</div>
									</div>
								</div>
								<input type="submit" name="place-order" id="place-order" disabled="" class="btn btn-primary py-3 px-4" form="billing-form" value="Place an Order">
							</div>
						</div>
					</div>
				</div> <!-- .col-md-8 -->
			</div>
		</div>
	</section> <!-- .section -->

	<!-- footer -->
	<?php include 'sections/footer.php'; ?>
	<!-- loader -->
	<?php include 'sections/loader.php'; ?>
	<!-- scripts -->
	<?php include 'sections/scripts.php'; ?>

	<script>
		$('#terms-and-conditions').click(function() {
			if (this.checked) {
				$('#place-order').removeAttr('disabled');
			} else {
				$('#place-order').attr('disabled', 'disabled');
			}
		});
	</script>

</body>
</html>