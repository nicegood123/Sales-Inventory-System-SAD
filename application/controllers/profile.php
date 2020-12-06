<?php
require 'application/config/connection.php';
require_once 'application/config/functions.php';

session_start();

if (!isset($_SESSION['is_logged_in'])) {
	header("Location:sign-in.php");

}

try {

	//get user info
	$message = '';
	$user_id = $_SESSION['user']['id'];
	$user = $function->getData('users', 'id', $user_id);

	if (isset($_POST['change-password'])) {

		//change password
		$current_password = hash("sha512", $_POST['current-password']);
		$new_password = hash("sha512", $_POST['new-password']);
		$confirm_password = hash("sha512", $_POST['confirm-password']);

		if ($current_password == $user['password']) {
			if ($new_password == $confirm_password) {
				if ($current_password != $new_password) {
					$data = ['password' => $new_password, 'user_id' => $user_id];
					$query = "UPDATE users SET password = :password WHERE id = :user_id";
					$function->update($query, $data);
				} else {
					$message = '
					<div class="col-md-12 bs-callout bs-callout-danger">
					<h4>Change Password Failed</h4>
					New password should not be the same with current password.
					</div>';
				}
			} else {
				$message = '
				<div class="col-md-12 bs-callout bs-callout-danger">
				<h4>Change Password Failed</h4>
				Confirmation password is incorrect. Please try again.
				</div>';
			}
		} else {
			$message = '
			<div class="col-md-12 bs-callout bs-callout-danger">
			<h4>Change Password Failed</h4>
			The current password you’ve entered is incorrect.
			</div>';
		}

	}

	//Update user's info
	if (isset($_POST['update-info'])) {

		$firstname = $_POST['firstname'];
		$lastname = $_POST['lastname'];
		$email = $_POST['email'];
		$contact = $_POST['contact'];
		$address = $_POST['address'];

		$data = [
			'user_id' => $user_id,
			'firstname' => $firstname,
			'lastname' => $lastname,
			'email' => $email,
			'contact' => $contact,
			'address' => $address
		];

		$query = "UPDATE users SET firstname = :firstname, lastname = :lastname, email = :email, contact = :contact, address = :address WHERE id = :user_id";
		$function->update($query, $data);

		header("Location: profile.php");
	}









	


} catch (Exception $e) {
	echo "maly sdf lmali";
}