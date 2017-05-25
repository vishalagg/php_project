<?php
    require ("db.php");
    // for signup
    function filter($data){
     $data=strtolower($data);
     $data=htmlspecialchars($data);
     $data=addslashes($data);
     $data=trim($data);
     return($data);
   }
  if(isset($_POST['btn1'])){
    $fname = filter($_POST['name']);
    $lname = filter($_POST['lname']);
    $mobile = filter($_POST['mobile']);
    $pass = md5($_POST['password']);
    $cpass = md5($_POST['cpassword']);
    $name = $fname." ".$lname;
    if(empty($name)||empty($mobile)||empty($pass)){
      $err1 = "*FILL THE REQUIRED FIELDS";
    }
    else{
      if(!is_numeric($mobile)){
        $err4 = "*Please Enter valid Number";
      }
      else if($pass!=$cpass){
        $err6 = "*Password didn't match";
      }
      else{
      $query = "INSERT INTO user(name,mobile,password) VALUES('$name',$mobile,'$pass')";

      $run = mysqli_query($conn,$query);
      if(!$run){
        die ("query not executing");
      }
      $succ ="Congratulation, Your Account Has Been Created Successfully.";
      }
    }
  }
  //for login
    if(isset($_POST['btn2'])){
    $mobile = $_POST['mobile'];
    $pass = md5($_POST['password']);
    if(empty($mobile)||empty($pass)){
      $err2 = "*Fill Both The Fields";
    }
    else if(!is_numeric($mobile)){
      $err5 = "*Please Enter valid Number";
    }
    else{
      $query="SELECT * FROM user WHERE mobile=$mobile AND password='$pass'";
      $run = mysqli_query($conn,$query);
      if(!$run){
        die ("query not executing");
      }
      else if(mysqli_num_rows($run)>0){
        session_start();
        $_SESSION["login"]="1";
        $row = mysqli_fetch_assoc($run);
        $_SESSION['name'] = $row['name'];
        $_SESSION['mobile'] = $row['mobile'];
        echo "<script>window.location='profile.php'</script>";
      }
      else{
        $err3 = "Invalid username/ password";
      }
    }
  }
?>

<html>
    <head>
        <title>singup page.</title>
        <link href='https://fonts.googleapis.com/css?family=Titillium+Web:400,300,600' rel='stylesheet' type='text/css'>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css">
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

        <link rel="stylesheet" href="style.css">
    </head>
    <body>
    <div class="container">
    <div class="login">
      <form action="" method="post" class="form-inline">
        <div class="form-group">
            <label>Mobile:</label>
            <input type="text" name="mobile" class="form-control" placeholder="*Mobile No.">
        </div>
        <div class="form-group">
              <label for="pwd">Password:</label>
              <input type="password" name="password" class="form-control" id="pwd" placeholder="*Password">
        </div>
              &nbsp<input type="submit" name="btn2" value="logIn" class="btn btn-primary"/>
      </form>
    </div>
    <div class="error">
      <?php
        if(isset($err2)){
          echo $err2;
        }
        else if(isset($err3)){
          echo $err3;
        }
        else if(isset($err5)){
          echo $err5;
        }
      ?>
    </div>
     <div class="signup">
        <form action="" method="post">
          <div class="header"><h1 class="lab"><label>SignUp</label></h1></div>
          <div class="success">
            <?php
              if(isset($succ)){
                echo $succ;
              }
            ?>
          </div>
          <div class="error">
            <?php
              if(isset($err1)){
                echo $err1;
              }
            ?>
          </div>
          <div class="fname form-group col-sm-6">
              <label>First Name</label>
              <input type="text" name="name" class="form-control" placeholder="*First Name">
          </div>
          <div class="lname form-group col-sm-6">
              <label>Last Name</label>
              <input type="text" name="lname" class="form-control" placeholder="Last Name">
          </div>
          <div class="form-group">
              <label>Mobile no.</label>
              <input type="text" name="mobile" class="form-control" placeholder="*Mobile no.">
          </div>
          <div class="Error">
            <?php
              if(isset($err4)){
                echo $err4;
              }
            ?>
          </div>
          <div class="form-group">
              <label for="pwd">Password</label>
              <input type="password" name="password" class="form-control" id="pwd" placeholder="*Password">
          </div>
          <div class="form-group">
              <label for="pwd">Confirm Password</label>
              <input type="password" name="cpassword" class="form-control" id="pwd" placeholder="*Confirm Password">
          </div>
          <div class="error">
            <?php
              if(isset($err6)){
                echo $err6;
              }
            ?>
          </div>
              <input type="submit" name="btn1" value="Submit" class="btn btn-primary" id="btn1"/>
       </form>
      </div>
    </div>
    </body>
</html>
