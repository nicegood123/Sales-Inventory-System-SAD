<?php
$default_nav_item_status = null;
$nav_item_status = 'hidden';

$total_items = 0;

if (isset($_SESSION['is_logged_in'])) {
	$default_nav_item_status = 'hidden';
	$nav_item_status = null;

	$user_id = $_SESSION['user']['id'];

	$data = ['user_id' => $user_id];
	$query = "SELECT * FROM cart WHERE user_id = :user_id AND cart_code = 0 GROUP BY product_id";
	$total_items = $function->itemCount($query, $data);
}

?>

<nav class="navbar navbar-expand-lg navbar-dark ftco_navbar bg-dark ftco-navbar-light ftco-navbar-light-2" id="ftco-navbar">
	<div class="container">
		<a class="navbar-brand" href="index.php">XYT Company</a>
		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ftco-nav" aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
			<span class="oi oi-menu"></span> Menu
		</button>

		<div class="collapse navbar-collapse" id="ftco-nav">
			<ul class="navbar-nav ml-auto">
				<li class="nav-item">
					<a href="shop.php" class="nav-link">
						Shop
					</a>
				</li>
				<li class="nav-item">
					<a href="profile.php" class="nav-link" <?php echo $nav_item_status; ?>>
						<?php echo $_SESSION['user']['firstname'] . ' ' . $_SESSION['user']['lastname']; ?>
					</a>
				</li>
				<li class="nav-item">
					<a href="application/controllers/signout.php" class="nav-link" <?php echo $nav_item_status; ?>>
						Sign Out
					</a>
				</li>
				<li class="nav-item">
					<a href="sign-in.php" class="nav-link" <?php echo $default_nav_item_status; ?>>
						Sign In
					</a>
				</li>
				<li class="nav-item">
					<a href="sign-up.php" class="nav-link" <?php echo $default_nav_item_status; ?>>
						Create Account
					</a>
				</li>
				<li class="nav-item cta cta-colored">
					<a href="cart.php" class="nav-link">
						<span class="icon-shopping_cart"></span>[<?php echo $total_items; ?>]
					</a>
				</li>
			</ul>
		</div>
	</div>
</nav>
<!-- END nav -->
