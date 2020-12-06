<?php

  require_once '../application/config/connection.php';
  require_once '../application/config/functions.php';


if (isset($_POST['delete-category'])) {

  $data = ['id' => $_GET['id']];

  $query = "DELETE FROM category WHERE id = :id";
  $function->delete($query, $data);

  header('location:category.php');

}


?>

