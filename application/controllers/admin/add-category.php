<?php

session_start();
date_default_timezone_set('Asia/Manila');

if (!isset($_SESSION['is_logged_in'])) {
	header("Location:../sign-in.php");
}

if(isset($_POST['add-category'])) {

  $name = $_POST['name'];
  $data = ['name' => $name,];

  $query = "INSERT INTO category (name) VALUES (:name)";
  $function->insert($query, $data);

}
?>