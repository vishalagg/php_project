<?php

    $host="localhost";
    $user="root";
    $pass="vishal123";
    $db="login";

    $conn =  mysqli_connect($host,$user,$pass,$db);
    if(!$conn){
      die("not connected");
    }
?>
