<?php

ob_start(); 
session_start();
include('../classes/super_admin.php');

$objSuperAdmin=new super_admin();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin | Authentication</title>
    <!--Favicon -->
    <link rel="icon" href="../../assets/img/logo/favicon.png" type="image/x-icon" />

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="../plugins/fontawesome-free/css/all.min.css">
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="../plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="../dist/css/adminlte.min.css">
    <style>
        .lockscreen-name {
            font-weight: 600;
            text-align: center;
        }

        .text-black {
            color: black ! important;
        }

        .text-black:hover {
            color: #FF4800 !important;
        }

        .lockscreen-footer a:hover {
            color: #FF4800 !important;
        }
    </style>
</head>
<body class="hold-transition register-page">