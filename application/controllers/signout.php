<?php

session_start();
unset($_SESSION['user']);
unset($_SESSION['is_logged_in']);
session_destroy();

header('Location:../../sign-in.php');
