<?php require 'application/controllers/add-to-cart.php'; ?>

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
                    <h1 class="mb-0 bread">Products</h1>
                    <p class="breadcrumbs">
                        <span class="mr-2"><a href="index.php">Home</a></span> 
                        <span>Products</span>
                    </p>
                </div>
            </div>
        </div>
    </div>

    <section class="ftco-section bg-light">
        <div class="container-fluid">
            <div class="row">
                <div class="col text-center">
                    <div class="row d-flex justify-content-center py-5">
                        <div class="col-md-10 text-center heading-section ftco-animate">
                            <div class="row d-flex justify-content-center">
                                <div class="col-md-9">
                                    <form method="post" class="subscribe-form">
                                        <div class="form-group d-flex">
                                            <input type="text" name="search-product" class="form-control" placeholder="Search product here">
                                            <input type="submit" name="search" value="Search" class="submit px-3">
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <?php

                try {

                    $page = 1;
                    $hide = null;
                    $total_no_per_page = 8;

                    $total_products = $function->rowCount('products');
                    $total_pages = ceil($total_products/$total_no_per_page);

                    if (isset($_GET['page-no'])) {
                        $page = $_GET['page-no'];
                    } elseif (isset($_GET['prev'])) {
                        $page = $_GET['prev'] - 1;
                        if ($page == 0) {
                            $page++;
                        }
                    } elseif (isset($_GET['next'])) {
                        $page = $_GET['next'] + 1;
                        if (($page - 1) == $total_pages) {
                            $page--;
                        }
                    }

                    $startAt = ($page - 1) * $total_no_per_page;

                    if (isset($_POST['search'])) {
                        $product_name = $_POST['search-product'];
                        if (!empty($product_name)) {
                            $hide = 'hidden';
                            $query = "SELECT * FROM products WHERE QuantityInStock > 0 AND name LIKE '%" . $product_name . "%'";
                        } else {
                            $page = 1;
                            $query = "SELECT * FROM products WHERE QuantityInStock > 0 LIMIT ". $total_no_per_page ."";
                        }
                    } else {
                        $query = "SELECT * FROM products WHERE QuantityInStock > 0 LIMIT ". $startAt .", ". $total_no_per_page ."";
                    }

                    $rows = $function->selectAll($query);
                    foreach ($rows as $row) {
                        $name = $row['name'];
                        $name = strlen($name) > 25 ? substr($name,0,25) . "..." :   $name;
                        ?>
                        <div class="col-sm col-md-6 col-lg-3 ftco-animate">
                            <div class="product">
                                <a href="product-details.php?product_id=<?php echo $row['id']; ?>" class="img-prod">
                                    <img class="img-fluid" src="images/products/<?php echo $row['photo']; ?>" alt="image Not Available">
                                </a>
                                <div class="text py-3 px-3">
                                    <h3>
                                        <a href="product-details.php?product_id=<?php echo $row['id']; ?>"><?php echo $name; ?></a>
                                    </h3>
                                    <div class="d-flex">
                                        <div class="pricing">
                                            <p class="price">
                                                <span class="price-sale">PHP <?php echo number_format($row['price'], 2); ?></span>
                                            </p>
                                        </div>
                                    </div>
                                    <hr>
                                    <p class="bottom-area justify-content-center d-flex">
                                        <a href="shop.php?add-to-cart=<?php echo $row['id'] ?>" class="add-to-cart">
                                            <span>Add to cart <i class="ion-ios-add ml-1"></i></span>
                                        </a>
                                    </p>
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
            <div class="row mt-5" <?php echo $hide; ?>>
                <div class="col text-center">
                    <div class="block-27">
                        <ul>
                            <li><a href="<?php echo "?prev=$page"; ?>">&lt;</a></li>

                            <?php
                            for ($i=1; $i <= $total_pages; $i++) {

                                $status = $i == $page ? 'class="active"' : null; ?>

                                <li <?php echo $status; ?>>
                                    <a href="<?php echo "?page-no=$i"; ?>"><?php echo $i; ?></a>
                                </li>
                            <?php } ?>

                            <li><a href="<?php echo "?next=$page"; ?>">&gt;</a></li>
                        </ul>
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