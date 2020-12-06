<?php
require 'application/config/connection.php';
require_once 'application/config/functions.php';

session_start();

try {

	if (isset($_SESSION['is_logged_in'])) {
		if (isset($_GET['add-to-cart'])) {

			$product_id = $_GET['add-to-cart'];
			$user_id =  $_SESSION['user']['id'];
			$quantity = 1;

			$data = [
				'cart_code' => 0,
				'user_id' => $user_id,
				'product_id' => $product_id
			];

			$product = $function->searchInCart($data);
			if (empty($product)) {

				$data = [
					'product_id' => $product_id,
					'user_id' => $user_id,
					'quantity' => $quantity,
				];

				$query = "INSERT INTO cart (user_id, product_id, quantity) VALUES (:user_id, :product_id, :quantity)";
				$function->insert($query, $data);

			} else {

				$quantity = $product['quantity'] + 1;
				$data = [
					'quantity' => $quantity,
					'user_id' => $user_id,
					'product_id' => $product_id
				];

				$query = "UPDATE cart SET quantity = :quantity WHERE cart_code = 0 AND user_id = :user_id AND product_id = :product_id";
				$function->update($query, $data);

			}
		}

	} elseif (!isset($_SESSION['is_logged_in']) && isset($_GET['add-to-cart'])) {
		header("Location: sign-in.php");
	}

} catch (Exception $e) {
	echo "Wala na add :(" . $e;
}
