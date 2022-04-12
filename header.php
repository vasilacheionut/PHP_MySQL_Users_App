<?php
include 'config.php';
?>
<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" integrity="sha384-DyZ88mC6Up2uqS4h/KRgHuoeGwBcD4Ng9SiP4dIRy0EXTlnuz47vAwmeGwVChigm" crossorigin="anonymous" />

  <!-- My Style-->
  <link rel="stylesheet" href="assets/style.css">

  <title>Users App - <?= $title; ?></title>
</head>

<body>
  <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="index.php">Home</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav mr-auto">
        <?php if ($user->is_login()) : ?>
          <li class="nav-item active">
            <a class="nav-link" href="users.php">Users <span class="sr-only">(current)</span></a>
          </li>
        <?php endif; ?>
      </ul>
      <form class="form-inline my-2 my-lg-0" action="index.php" method="post">
        <input class="form-control mr-sm-2" type="search" id='search' name='search' placeholder="Search..." aria-label="Search">
        <button class="btn btn-outline-primary my-2 my-sm-0" type="submit">Search</button>
        <?php if ($user->is_login()) : ?>
          <div class="dropdown">
            <button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown">
              <i class="fa fa-user" aria-hidden="true"> <?php echo $user->getDisplayName(); ?></i>
            </button>
            <div class="dropdown-menu">
              <a class="dropdown-item" href="profile.php">My profile</a>
              <div class="dropdown-divider"></div>
              <a class="btn btn-outline-danger btn-sm btn-block" href="logout.php">Logout</a>
            </div>
          </div>
        <?php else : ?>
          <a class="btn btn-outline-success my-2 my-sm-0" href="login.php">Login</a>
          <a class="btn btn-outline-secondary my-2 my-sm-0" href="register.php">Register</a>
        <?php endif; ?>
      </form>
    </div>
  </nav>

  <div class="container-fluid up-space">
    <!-- Content here -->