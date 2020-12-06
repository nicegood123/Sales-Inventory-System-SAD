<?php require 'application/controllers/profile.php'; ?>

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
					<h1 class="mb-0 bread">Profile</h1>
					<p class="breadcrumbs"><span class="mr-2"><a href="index.php">Home</a></span> <span>Profile</span></p>
				</div>
			</div>
		</div>
	</div>

	<section class="ftco-section contact-section bg-light">
		<div class="container">
			<div class="row justify-content-center">
				<?php echo $message; ?>
				<div class="col-md-7 d-flex">
					<div class="info bg-white p-4">
						<h3 class="mb-4 billing-heading">Personal Information</h3>
						<p><span><b>Name: </b></span><?php echo $user['firstname'] . ' ' . $user['lastname']; ?></p>
						<p><span><b>Email Address: </b></span><?php echo $user['email']; ?></p>
						<p><span><b>Contact: </b></span><?php echo $user['contact']; ?></p>
						<p><span><b>Address: </b></span><?php echo $user['address']; ?></p>
						<hr class="mt-5">
						<h3 class="billing-heading text-center">
							<a href="" data-toggle="modal" data-target="#updateModal">Edit</a>
						</h3>
					</div>
				</div>
				<div class="col-md-5 d-flex">
					<form method="post" class="cart-detail bg-white p-3 p-md-4 contact-form" data-parsley-validate>
						<h3 class="mb-4 billing-heading">Change Password</h3>
						<div class="form-group">
							<input type="password" name="current-password" class="form-control" required="" placeholder="Current Password">
						</div>
						<div class="form-group">
							<input type="password" name="new-password" id="new_password" type="password" class="form-control" required="" data-parsley-length="[6, 25]" placeholder="New Password">
						</div>
						<div class="form-group">
							<input type="password" name="confirm-password" class="form-control" required="" data-parsley-equalto="#new_password" data-parsley-length="[6, 25]" placeholder="Confirm Password">
						</div>
						<div class="form-group">
							<input type="submit" name="change-password" value="Save Changes" class="btn btn-primary py-3 px-5">
						</div>
					</form>
				</div>
			</div>

			<div class="row bg-white mt-5">
				<div class="cart-detail p-3 p-md-4 contact-form">
					<h3 class="billing-heading">List of Orders</h3>
				</div>
				<div class="col-md-12 ftco-animate">
					<div class="cart-list">
						<table class="table">
							<thead class="thead-primary">
								<tr class="text-center">
									<th>Order ID</th>
									<th>Total</th>
									<th>Payment Method</th>
									<th>Date Ordered</th>
								</tr>
							</thead>
							<tbody>

								<?php 
								//user list of order
								$query = "SELECT * FROM orders WHERE user_id = ". $user_id ."";
								$rows = $function->selectAll($query);

								foreach ($rows as $row): ?>
									<tr class="text-center">
										<td>
											<a href="order-summary.php?order_id=<?php echo $row['order_id']; ?>"><?php echo $row['order_id']; ?></a>
										</td>
										<td>PHP <?php echo number_format($row['total'], 2); ?></td>
										<td>Cash on Delivery</td>
										<td><?php echo $row['ordered_date']; ?></td>
									</tr>
								<?php endforeach; ?>

							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</section>

	<!--Update User's' Info Modal -->
	<div class="modal fade" id="updateModal" tabindex="-1" role="dialog" aria-labelledby="updateModal" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLongTitle">Personal Information</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<form method="post" class="contact-form" id="user-info-form" data-parsley-validate>
						<div class="form-group">
							<input type="text" name="firstname" value="<?php echo $user['firstname']; ?>" class="form-control" placeholder="First Name" required="" maxlength="15">
						</div>
						<div class="form-group">
							<input type="text" name="lastname" value="<?php echo $user['lastname']; ?>" class="form-control" placeholder="Last Name" required="" maxlength="25">
						</div>
						<div class="form-group">
							<input type="text" name="email" value="<?php echo $user['email']; ?>" class="form-control" placeholder="Email Address" required="" maxlength="30">
						</div>
						<div class="form-group">
							<input type="text" name="contact" value="<?php echo $user['contact']; ?>" class="form-control" placeholder="Contact" maxlength="13">
						</div>
						<div class="form-group">
							<input type="text" name="address" value="<?php echo $user['address']; ?>" class="form-control" placeholder="Address" maxlength="80">
						</div>
					</form>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary py-2 px-4 mr-auto" data-dismiss="modal">Close</button>
					<button type="submit" name="update-info" class="btn btn-primary py-2 px-3" form="user-info-form">Save Changes</button>
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

</body>
</html>