<?php require 'application/controllers/add-to-cart.php'; ?>

<!DOCTYPE html>
<html lang="en">

<!-- header and links -->
<?php include 'sections/header.php'; ?>

<body>

	<!-- Top navigation bar -->
	<?php include 'sections/top-navigation-bar.php'; ?>

	<div class="hero-wrap js-fullheight" style="background-image: url('images/bg/main-bg.jpg');">
		<div class="container">
			<div class="row no-gutters slider-text js-fullheight align-items-center justify-content-center">
				<h3 class="v">XYT - Yours Truly</h3>
				<h3 class="vr">Since - 2000</h3>
				<div class="col-md-11 ftco-animate text-center">
					<h1>XYT Company</h1>
					<h2><span>Online Store</span></h2>
				</div>
				<div class="mouse">
					<a href="#" class="mouse-icon">
						<div class="mouse-wheel">
							<span class="ion-ios-arrow-down"></span>
						</div>
					</a>
				</div>
			</div>
		</div>
	</div>
	<div class="goto-here"></div>

	<section class="ftco-section ftco-product">
		<div class="container">
			<div class="row justify-content-center mb-3 pb-3">
				<div class="col-md-12 heading-section text-center ftco-animate">
					<h1 class="big">New</h1>
					<h2 class="mb-4">New Products</h2>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12">
					<div class="product-slider owl-carousel ftco-animate">
						<?php

						try {
							$query = "SELECT * FROM products ORDER BY date_registered DESC LIMIT 6";
							$rows = $function->selectAll($query);
							foreach ($rows as $row) { ?>
								<div class="item">
									<div class="product">
										<a href="product-details.php?product_id=<?php echo $row['id']; ?>" class="img-prod">
											<img class="img-fluid" src="images/products/<?php echo $row['photo']; ?>" alt="No Image Available">
											<span class="status">New</span>
										</a>
										<div class="text pt-3 px-3">
											<h3>
												<a href="product-details.php?product_id=<?php echo $row['id']; ?>"><?php echo $row['name']; ?></a>
											</h3>
											<div class="d-flex">
												<div class="pricing">
													<p class="price">
														<span class="price-sale">PHP <?php echo number_format($row['price'], 2); ?></span>
													</p>
												</div>
											</div>
										</div>
									</div>
								</div>

								<?php
							} 
						} catch (PDOException $e) {
							echo "There is some problem in connection: " . $e->getMessage();
						}

						?>
					</div>
				</div>
			</div>
		</div>
	</section>

	<section class="ftco-section bg-light">
		<div class="container">
			<div class="row justify-content-center mb-3 pb-3">
				<div class="col-md-12 heading-section text-center ftco-animate">
					<h1 class="big">Products</h1>
					<h2 class="mb-4">Our Products</h2>
				</div>
			</div>    		
		</div>
		<div class="container-fluid">

			<?php

			try {

				$query = "SELECT * FROM products LIMIT 8";
				$rows = $function->selectAll($query);
				$counter = 0;

				foreach ($rows as $row) { ?>

					<?php
					$name = $row['name'];
					$name = strlen($name) > 25 ? substr($name,0,25) . "..." :   $name;
					if ($counter % 4 == 0) {
						echo '<div class="row">';
					}
					?>

					<div class="col-sm col-md-6 col-lg ftco-animate">
						<div class="product">

							<a href="product-details.php?product_id=<?php echo $row['id']; ?>" class="img-prod">
								<img class="img-fluid" src="images/products/<?php echo $row['photo']?>" alt="No Image Available">
							</a>
							<div class="text py-3 px-3">
								<h3>
									<a href="product-details.php?product_id=<?php echo $row['id']; ?>"><?php echo $name; ?></a>
								</h3>
								<div class="d-flex">
									<div class="pricing">
										<p class="price">
											<span>PHP <?php echo number_format($row['price'], 2); ?></span>
										</p>
									</div>
								</div>
								<hr>
								<p class="bottom-area justify-content-center d-flex">
									<a href="index.php?add-to-cart=<?php echo $row['id']; ?>" class="add-to-cart">
										<span>Add to cart <i class="ion-ios-add ml-1"></i></span>
									</a>
								</p>
							</div>
						</div>
					</div>

					<?php
					if ($counter % 4 == 3) {
						echo '</div>';
					}
					$counter++;
				} 

			} catch (PDOException $e) {
				echo "There is some problem in connection: " . $e->getMessage();
			}

			?>

			<div class="row">
				<div class="col text-center">
					<a href="shop.php" class="btn btn-primary py-3 px-5">View More</a>
				</div>
			</div>
		</div>
	</section>

	<section class="ftco-section ftco-section-more img" style="background-image: url(images/banner.jpg);">
		<div class="container">
			<div class="row justify-content-center mb-3 pb-3">
				<div class="col-md-12 heading-section ftco-animate">
					<h2>Summer Sale</h2>
				</div>
			</div>
		</div>
	</section>

	<section class="ftco-section testimony-section bg-light">
		<div class="container">
			<div class="row justify-content-center mb-3 pb-3">
				<div class="col-md-12 heading-section text-center ftco-animate">
					<h1 class="big">CEO</h1>
				</div>
			</div>    		
			<div class="row justify-content-center">
				<div class="col-md-8 ftco-animate">
					<div class="row ftco-animate">
						<div class="col-md-12">
							<div class="carousel-testimony owl-carousel ftco-owl">
								<div class="item">
									<div class="testimony-wrap py-4 pb-5">
										<div class="user-img mb-4" style="background-image: url(images/profile/person_4.jpg)">
											<span class="quote d-flex align-items-center justify-content-center">
												<i class="icon-quote-left"></i>
											</span>
										</div>
										<div class="text text-center">
											<p class="name">Gisan Geff Raniego</p>
											<ul class="ftco-footer-social list-unstyled mt-5">
												<li class="ftco-animate"><a><span class="icon-twitter"></span></a></li>
												<li class="ftco-animate"><a href="www.facebook.com/gisangeff.raniego"><span class="icon-facebook"></span></a></li>
												<li class="ftco-animate"><a href="instagram.com/gisangeff"><span class="icon-instagram"></span></a></li>
											</ul>
										</div>
									</div>
								</div>
							</div>
						</div>
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

	<script>
			//Top navigation bar add/remove class
			//To change the navigation style
			$(document).ready(function(){
				$("#ftco-navbar").removeClass("ftco-navbar-light-2");
			});
		</script>

	</body>
	</html>