<?php
require 'application/config/connection.php';
require_once 'application/config/functions.php';

session_start();

if (isset($_SESSION['is_logged_in'])) {
	header('Location:index.php');
}

$message = "";

if (isset($_POST['signin'])) {
	$email_address = $_POST['email-address'];
	$password = hash("sha512", $_POST['password']);
	$data = ['email' => $email_address, 'password' => $password];

	$query = "SELECT * FROM users WHERE email=:email AND password=:password";
	$result = $function->signin($query, $data);

	if (!empty($result)) {
		$_SESSION['user'] = $result;
		$_SESSION['is_logged_in'] = true;
		if ($_SESSION['user']['type'] == 0) {
			header('Location:index.php');
		} elseif ($_SESSION['user']['type'] == 1) {
			header('Location:admin');
		}

	} else {
		$message = '
		<div class="col-md-12 bs-callout bs-callout-danger">
		<h4>Login Failed</h4>
		The email or password you’ve entered is incorrect.
		</div>
		';

	}
}
