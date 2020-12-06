<?php
require 'application/config/connection.php';
require_once 'application/config/functions.php';

session_start();

if (!isset($_SESSION['is_logged_in'])) {
  header("Location:sign-in.php");

}


try {
	if (isset($_GET['order_id'])) {
		$order_id = $_GET['order_id'];
		$data = ['order_id' => $order_id];
		$order_summary = $function->searchinOrders($data);
	}
} catch (Exception $e) {
	
}

