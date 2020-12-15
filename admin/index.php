<?php

session_start();
if (!isset($_SESSION['is_logged_in'])) {
	header("Location:../sign-in.php");
}

$_SESSION['message'] = '';
$_SESSION['discounts'] = 0.00;
$_SESSION['payment_method'] = 'Cash Payment';
// $_SESSION['total_sales'] = 0;


?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title>Home | Admin</title>

    <!-- links -->
    <?php include 'sections/links.php'; ?>

</head>

<body class="theme-red">
    <!-- Page Loader -->
    <?php include 'sections/page-loader.php'; ?>

    <!-- Overlay For Sidebars -->
    <div class="overlay"></div>

    <!-- Top Bar -->
    <?php include 'sections/top-bar.php'; ?>

    <!-- Left Side Bar -->
    <?php include 'sections/left-sidebar/leftsidebar.php'; ?>

    <section class="content">
        <div class="container-fluid">
            <div class="block-header">
                <h2>DASHBOARD</h2>
            </div>




        </div>
    </section>

    <!-- scripts -->
    <?php include 'sections/scripts.php'; ?>

</body>

</html>