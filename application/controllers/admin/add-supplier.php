<?php

session_start();
date_default_timezone_set('Asia/Manila');

if (isset($_SESSION['is_logged_in'])) {
  header('Location:index.php');
}

$message = "";

if(isset($_POST['add-supplier'])) {

  $id = $function->setID('id', 'supplier');
  $name = $_POST['name'];
  $address = $_POST['address'];
  $contact = $_POST['contact'];

  $data = [
    'id' => $id,
    'name' => $name,
    'address' => $address,
    'contact' => $contact
  ];

  try {
    $query = "INSERT INTO supplier (id, name, address, contact) VALUES (:id, :name, :address, :contact)";
    $function->insert($query, $data);

    $message = '
    <div class="col-md-10 bs-callout bs-callout-success">
    <h4 id="title">Registration Successful</h4>
    Thanks! Supplier has been successfully added.
    </div>
    ';
  } catch (Exception $e) {
    $message = '
    <div class="col-md-10 bs-callout bs-callout-danger">
    <h4>Registration Failed</h4>
    Wala na add si supplier. huhu
    </div>
    ';
  }

}