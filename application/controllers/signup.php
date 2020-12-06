<?php
require 'application/config/connection.php';
require_once 'application/config/functions.php';

session_start();
date_default_timezone_set('Asia/Manila');

if (isset($_SESSION['is_logged_in'])) {
  header('Location:index.php');
}

$message = "";

if(isset($_POST['signup'])) {

  $id = $function->setID('id', 'users');
  $firstname = $_POST['firstname'];
  $lastname = $_POST['lastname'];
  $hashed_password = hash("sha512", $_POST['password']);
  $email = $_POST['email'];
  $date_registered = date("F j, Y, g:i A");

  $data = [
    'id' => $id,
    'firstname' => $firstname,
    'lastname' => $lastname,
    'email' => $email,
    'password' => $hashed_password,
    'date_registered' => $date_registered,
  ];

  try {
    $query = "INSERT INTO users (id, firstname, lastname, email, password, date_registered) VALUES (:id, :firstname, :lastname, :email, :password, :date_registered)";
    $function->insert($query, $data);

    $message = '
    <div class="col-md-10 bs-callout bs-callout-success">
    <h4 id="title">Registration Successful</h4>
    Thanks! Your account has been successfully created.
    </div>
    ';
  } catch (Exception $e) {
    $message = '
    <div class="col-md-10 bs-callout bs-callout-danger">
    <h4>Registration Failed</h4>
    Sorry, that email address is already used. Please try another email address.
    </div>
    ';
  }

}