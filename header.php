<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Beli Dek</title>

  <?php
  // require library
  require('library/head.php');
  ?>

  <!-- Custom CSS file -->
  <link rel="stylesheet" href="style.css">

  <?php
  // require functions.php file
  require('functions.php');
  ?>
</head>

<body>

  <!-- start #header -->
  <header id="header">

    <!-- Primary Navigation -->
    <nav class="navbar fixed-top navbar-expand-lg navbar-dark color-primary-bg shadow" style="height: 60px;">
      <a class="navbar-brand" href="index.php">Beli Dek</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav m-auto font-rubik">
          <li class="nav-item active">
            <a class="nav-link" href="#">On Sale</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">Products</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">Category <i class="fas fa-chevron-down"></i></a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">Blog</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">Coming Soon</a>
          </li>
        </ul>

        <!-- search section -->
        <form class="form-inline d-flex justify-content-end" action="" method="post">
          <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search" name="keyword" autocomplete="off" id="keyword">
          <button class="btn btn-outline-light my-2 my-sm-0" type="submit" name="search" id="search">Search</button>
        </form>
        <!-- !search section -->

        <!-- profile section -->
        <div class="btn-group">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <img src="assets/template/profile.png" width="40" height="40" class="rounded-circle">
          </a>
          <div class="dropdown-menu dropdown-menu-right font-rubik" aria-labelledby="navbarDropdownMenuLink">
            <?php $users = query("SELECT * FROM users WHERE user_id={$_SESSION['user']}"); ?>
            <?php if ($users[0]['user_fullname']) { ?>
              <a class="dropdown-item" href="#"><?= $users[0]['user_fullname'] ?></a>
              <hr>
            <?php } ?>
            <?php if (!$users[0]['user_fullname']) { ?>
              <a class="dropdown-item" href="profile.php">Complete Profile</a>
              <hr>
            <?php } ?>
            <a class="dropdown-item" href="payment.php">Need to Pay <span class="badge badge-pill badge-warning"><?= count(query("SELECT * FROM payments WHERE user_id = {$_SESSION['user']}")) ?></span></a>
            <a class="dropdown-item" href="logout.php">Log out</a>
          </div>
        </div>
        <!-- !profile section -->

      </div>
    </nav>
    <!-- !Primary Navigation -->

  </header>
  <!-- !start #header -->

  <!-- start #main-site -->
  <main id="main-site">