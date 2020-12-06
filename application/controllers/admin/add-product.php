<?php

require '../application/config/connection.php';
require_once '../application/config/functions.php';

session_start();
date_default_timezone_set('Asia/Manila');

if (isset($_SESSION['is_logged_in'])) {
  header('Location:index.php');
}

if(isset($_POST['add-product'])) {

  $name = $_POST['name'];
  $description = $_POST['description'];
  $price = $_POST['price'];
  $quantity = $_POST['quantity'];
  $category_id = $_POST['category'];
  $supplier_id = $_POST['supplier'];
  $photo = $_FILES['photo']['name'];

  $folder = '../images/products/';
  $path = $folder . $photo;
  $target_file = $folder.basename($photo);
  $FileType = pathinfo($target_file, PATHINFO_EXTENSION);

  $allowed = array('jpeg', 'png', 'jpg');
  $filename = $photo;

  $extension = pathinfo($filename, PATHINFO_EXTENSION);
  if(!in_array($extension, $allowed)) {
    echo 'Invalid file type.';
  } else {
    move_uploaded_file( $_FILES['photo']['tmp_name'], $path); 

    $data = [
      'name' => $name, 
      'price' => $price, 
      'QuantityInStock' => $quantity, 
      'category_id' => $category_id, 
      'supplier_id' => $supplier_id, 
      'photo' => $photo
    ];

    $query = "INSERT INTO products (name, price, QuantityInStock, category_id, supplier_id, photo, date_registered) VALUES (:name, :price, :QuantityInStock, :category_id, :supplier_id, :photo, now())";
    $function->insert($query, $data);

  }

}

?>