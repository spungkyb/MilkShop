<?php

//proses login register
require_once "class.php";
$user = new USER();

if ($_GET['aksi'] == 'register') {
    $user->register($_POST['username'], $_POST['email'], $_POST['password']);
    header("location:login.php");
} elseif ($_GET['aksi'] == 'login') {
    session_start();
    $user->login($_POST['username'], $_POST['password']);
    $_SESSION['user_name'] = $_POST['username'];
} elseif ($_GET['aksi'] == 'keluar') {
    session_start();
    session_destroy();
    header('location:login.php');
}
