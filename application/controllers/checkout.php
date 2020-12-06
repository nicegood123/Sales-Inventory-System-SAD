<?php
require 'application/config/connection.php';
require_once 'application/config/functions.php';

session_start();
date_default_timezone_set('Asia/Manila');

if (!isset($_SESSION['is_logged_in'])) {
	header("Location:sign-in.php");
}

try {

	//Get user's Info
	$user_id = $_SESSION['user']['id'];
	$user = $function->getData('users', 'id', $user_id);

	//Cart Total
	$delivery = 790.00;
	$data = ['user_id' => $user_id];
	$cart_subtotal = $function->getCartSubtotal($data);
	$total = $cart_subtotal['subtotal'] + $delivery;

	if (isset($_POST['place-order'])) {

		$id = $function->setOrderID('order_id', 'orders');

		//Insert Order
		$order_id = $id;
		$contact = $_POST['contact'];
		$address = $_POST['address'];
		$ordered_date = date("F j, Y, g:i A");

		$data = [
			'order_id' => $order_id,
			'user_id' => $user_id,
			'contact' => $contact,
			'address' => $address,
			'total' => $total,
			'ordered_date' => $ordered_date,
		];

		$query = "INSERT INTO orders (order_id, user_id, contact, address, total, ordered_date) VALUES (:order_id, :user_id, :contact, :address, :total, :ordered_date)";
		$function->insert($query, $data);

		//Set cart code
		$cart_code = $order_id;
		$data = ['cart_code' => $cart_code, 'user_id' => $user_id];

		$query = "UPDATE cart SET cart_code = :cart_code WHERE user_id = :user_id AND cart_code = 0";
		$function->update($query, $data);

		header("Location: order-summary.php?order_id=$order_id");

	}
	
} catch (Exception $e) {
	
}