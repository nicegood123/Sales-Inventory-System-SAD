<?php
require 'application/config/connection.php';
require_once 'application/config/functions.php';

session_start();

if (!isset($_SESSION['is_logged_in'])) {
  header("Location:sign-in.php");

}

//update product quantity
$cart_id = 0;
$quantity = null;

if (isset($_GET['plus'])) { $cart_id = $_GET['plus']; }
if (isset($_GET['minus'])) { $cart_id = $_GET['minus']; }

$product = $function->getData('cart', 'cart_id', $cart_id);

if (isset($_GET['minus'])) {
  $quantity = $product['quantity'];
  $quantity = $quantity > 1 ? $quantity - 1: $quantity;
}

if (isset($_GET['plus'])) {
  $quantity = $product['quantity'];
  $quantity = $quantity < 10 ? $quantity + 1: $quantity;
}

$data = ['quantity' => $quantity, 'cart_id' => $cart_id];

$query = "UPDATE cart SET quantity = :quantity WHERE cart_id = :cart_id AND cart_code = 0";
$function->update($query, $data);

//delete products
if (isset($_GET['cart_id'])) {

  $cart_id = $_GET['cart_id'];
  $data = ['cart_id' => $cart_id];

  $query = "DELETE FROM cart WHERE cart_id = :cart_id";
  $function->delete($query, $data);

}
