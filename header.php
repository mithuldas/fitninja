<?php
  session_start();
?>


<!DOCTYPE html>
<html lang='en'>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta charset="utf-8">
<title> FitNinja </title>

<!-- Start Bootstrap dependencies -->
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootswatch/4.5.2/united/bootstrap.min.css">
<link href="css/test.css" rel="stylesheet">

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
<!-- End of Bootstrap dependencies -->
</head>

<body class="text-center">

<nav class="navbar navbar-expand-lg navbar-light navbar-custom fixed-top testtt">
  <a class="navbar-brand" href="index.php">FitNinja</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarColor02" aria-controls="navbarColor02" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarColor02">
    <ul class="navbar-nav mr-auto">

      <li class="nav-item active">
        <a class="nav-link" href="#">Trainers <span class="sr-only">(current)</span></a>
      </li>

    </ul>



    <?php

    if(!isset($_SESSION['uid'])){
    echo'<a href="login.php" class="btn btn-secondary btn-sm btn mr-1">Login</a>
    <a href="signup.php" class="btn btn-primary btn-sm mr-1">Register</a>';
    }

    if(isset($_SESSION['uid'])){
      echo '<a href="includes/logout.php" class="btn btn-secondary btn-sm btn mr-1">Logout</a>';
    }
  ?>
    <a href="profile.php" class="btn profile-btn"></a>



  </div>


</nav>
