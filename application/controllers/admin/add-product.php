<?php
date_default_timezone_set('Asia/Manila');

session_start();

if (!isset($_SESSION['is_logged_in'])) {
	header("Location:../sign-in.php");
}

if(isset($_POST['add-product'])) {

  $name = $_POST['name'];
  $description = $_POST['description'];
  $price = $_POST['price'];
  $quantity = $_POST['quantity'];
  $category_id = $_POST['category'];
  $supplier_id = $_POST['supplier'];
  $photo = $_FILES['photo']['name'];

  $directory = '../images/products/';
  $path = $directory . $photo;
  $target_file = $directory.basename($photo);
  $FileType = pathinfo($target_file, PATHINFO_EXTENSION);


  if(empty($photo)) {
    $photo = 'default.png';
  }

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

    $query = "INSERT INTO products (name, price, QuantityInStock, category_id, supplier_id, photo, date_added) VALUES (:name, :price, :QuantityInStock, :category_id, :supplier_id, :photo, now())";
    $function->insert($query, $data);

  }

}

?>