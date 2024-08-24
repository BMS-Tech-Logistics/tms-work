<?php
    session_start();
    unset($_SESSION['id']);
    unset($_SESSION['user_name']);
    unset($_SESSION['full_name']);
    unset($_SESSION['profile_pic']);
    unset($_SESSION['is_loged']);
    header('location:auth/login.php');
    session_destroy();
    exit;

?>