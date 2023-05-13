<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Beli Dek</title>

    <?php
    // require library
    require('library/head.php');
    ?>

    <?php
    // require functions.php file
    require('functions.php');
    ?>

    <?php
    // get data admin
    $admins = $admin->getAdmin($_SESSION['admin']);
    ?>

    <!-- Custom CSS file -->
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <div class="page-wrapper chiller-theme toggled">
        <!-- Primary Navigation -->
        <nav class="navbar fixed-top navbar-expand-lg navbar-dark color-primary-bg" style="height: 60px;">
            <!-- Hamburger Menu -->
            <a id="show-sidebar" class="btn btn-sm btn-light" href="#">
                <i class="fas fa-bars"></i>
            </a>
            <!-- !Hamburger Menu -->
            <a class="navbar-brand" href="index.php">Beli Dek</a>
            <!-- Hamburger Menu for Mobile -->
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <!-- !Hamburger Menu for Mobile -->
            <div class="collapse navbar-collapse d-flex justify-content-end" id="navbarNav">
                <!-- search section -->
                <form class="form-inline" action="" method="post">
                    <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search" name="keyword" autocomplete="off" id="keyword">
                    <button class="btn btn-outline-light my-2 my-sm-0" type="submit" name="search" id="search">Search</button>
                </form>
                <!-- !search section -->

                <!-- profile section -->
                <div class="btn-group">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <img src="./../assets/template/profile.png" width="40" height="40" class="rounded-circle">
                    </a>
                    <div class="dropdown-menu dropdown-menu-right font-rubik" aria-labelledby="navbarDropdownMenuLink">
                        <a class="dropdown-item" href="logout.php">Log out</a>
                    </div>
                </div>
                <!-- !profile section -->
            </div>
        </nav>
        <!-- !Primary Navigation -->
        <!-- Sidebar Navigation -->
        <nav id="sidebar" class="sidebar-wrapper">
            <!-- sidebar-content  -->
            <div class="sidebar-content">
                <!-- sidebar-header  -->
                <div class="sidebar-header">
                    <div class="user-pic">
                        <img class="img-responsive img-rounded" src="./../assets/template/profile.png" alt="User picture">
                    </div>
                    <div class="user-info">
                        <span class="user-name"><strong><?= $admins[0]['admin_fullname'] ? $admins[0]['admin_fullname'] : $admins[0]['admin_username']; ?></strong></span>
                        <span class="user-role">Administrator</span>
                        <span class="user-status">
                            <i class="fa fa-circle"></i>
                            <span>Online</span>
                        </span>
                    </div>
                    <div id="close-sidebar" class="d-flex justify-content-end">
                        <i class="fas fa-times"></i>
                    </div>
                </div>
                <!-- !sidebar-header  -->
                <!-- sidebar-menu  -->
                <div class="sidebar-menu">
                    <ul>
                        <li class="header-menu">
                            <span>General</span>
                        </li>
                        <li>
                            <a href="index.php">
                                <i class="fa fa-tachometer-alt"></i>
                                <span>Dashboard</span>
                            </a>
                        </li>
                        <li>
                            <a href="users.php">
                                <i class="fa fa-users"></i>
                                <span>View Users</span>
                                <span class="badge badge-pill badge-primary"><?= count($users) ?></span>
                            </a>
                        </li>
                        <li class="sidebar-dropdown">
                            <a href="#">
                                <i class="fa fa-cog"></i>
                                <span>Manage Products</span>
                            </a>
                            <div class="sidebar-submenu">
                                <ul>
                                    <li>
                                        <a href="add.php">Add Product</a>
                                    </li>
                                    <li>
                                        <a href="#">Update Product</a>
                                    </li>
                                    <li>
                                        <a href="#">Delete Product</a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        <li>
                            <a href="products.php">
                                <i class="fa fa-eye"></i>
                                <span>View Products</span>
                                <span class="badge badge-pill badge-success"><?= count($product_shuffle) ?></span>
                            </a>
                        </li>
                        <li>
                            <a href="orders.php">
                                <i class="fa fa-shopping-bag"></i>
                                <span>Orders</span>
                                <span class="badge badge-pill badge-warning"><?= count($orders) ?></span>
                            </a>
                        </li>
                        <li class="header-menu">
                            <span>About</span>
                        </li>
                        <li>
                            <a href="#">
                                <i class="fa fa-address-card"></i>
                                <span>About</span>
                                <span class="badge badge-pill badge-info">!</span>
                            </a>
                        </li>
                    </ul>
                </div>
                <!-- !sidebar-menu  -->
            </div>
            <!-- !sidebar-content  -->
        </nav>
        <!-- !Sidebar Navigation -->
        <!-- Page Content -->
        <main class="page-content">