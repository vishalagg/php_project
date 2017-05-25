<?php
  session_start();
  if(!isset($_SESSION["login"])){
    header("location:index.php");
  }
  if(isset($_POST['btn'])){
    echo "<script>window.location='logout.php'</script>";
  }
?>
<html>
  <head>
    <title>Profile</title>
    <link href='https://fonts.googleapis.com/css?family=Titillium+Web:400,300,600' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="style.css">
  </head>
  <body>
    <div class="container">
      <?php

        echo "WELCOME ".strtoupper($_SESSION['name']);
      ?>
      <form action="" method="POST">
      <input type="submit" name="btn" value="LogOut" class="btn btn-primary"/>
    </div>
  </body>
</html>
