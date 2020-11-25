<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $data['title'] . ' | Account Management' ?></title>
    <link rel="stylesheet" href="<?php echo APP_URL . '/' . 'public/css/fa/css/font-awesome.min.css' ?>">
    <link rel="stylesheet" href="<?php echo APP_URL . '/' . 'public/css/bootstrap.min.css' ?>">
    <link rel="stylesheet" href="<?php echo APP_URL . '/' . 'public/css/select2.min.css' ?>">
    <link rel="stylesheet" href="<?php echo APP_URL . '/' . 'public/css/bootstrap-datepicker.min.css' ?>">
    <link rel="stylesheet" href="<?php echo APP_URL . '/' . 'public/css/bootstrap-timepicker.min.css' ?>">
    <link rel="stylesheet" href="<?php echo APP_URL . '/' . 'public/css/style.css' ?>">
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-success">
        <a class="navbar-brand" href="/">ACC Management</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item <?php echo strpos($_SERVER['REQUEST_URI'], 'price-list') !== FALSE ? 'active' : '' ?>">
                    <a class="nav-link" href="/price-list">Price List</a>
                </li>
                <li class="nav-item <?php echo strpos($_SERVER['REQUEST_URI'], 'transaction') !== FALSE ? 'active' : '' ?>">
                    <a class="nav-link" href="/transaction">Transaction</a>
                </li>
            </ul>
        </div>
    </nav>

    <div class="my-4">
        <div class="row container-fluid mx-auto">