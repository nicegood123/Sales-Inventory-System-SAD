<?php
require 'application/config/connection.php';
require_once 'application/config/functions.php';

session_start();

//Get product Info
if (isset($_GET['product_id'])) {
	$product_id = $_GET['product_id'];
	$row = $function->getData('products', 'id', $product_id);
} 

if (isset($_SESSION['is_logged_in'])) {

	$user_id =  $_SESSION['user']['id'];

  //add product to cart
	if (isset($_POST['add-to-cart'])) {

		$data = [
			'cart_code' => 1,
			'user_id' => $user_id,
			'product_id' => $product_id
		];
		$product = $function->searchInCart($data);

		if (empty($product)) {

			$quantity = $_POST['quantity'];
			$data = [
				'product_id' => $product_id,
				'user_id' => $user_id,
				'quantity' => $quantity
			];

			$query = "INSERT INTO cart (user_id, product_id, quantity) VALUES (:user_id, :product_id, :quantity)";
			$function->insert($query, $data);

		} else {

			$quantity = $_POST['quantity'] + $product['quantity'];
			$data = [
				'quantity' => $quantity,
				'user_id' => $user_id,
				'product_id' => $product_id
			];

			$query = "UPDATE cart SET quantity = :quantity WHERE cart_code = 1 AND user_id = :user_id AND product_id = :product_id";
			$function->update($query, $data);

		}
		header('Location: cart.php');

	} 

} else {
	if (isset($_POST['add-to-cart'])) {
		header('Location: sign-in.php');
	}
}