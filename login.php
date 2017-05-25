<html>
<html>
  <head>
    <meta charset="utf-8">
    <title></title>
  </head>
  <body>
    <?php
      require ("db.php");
      if(isset($_POST['btn'])){
        $mobile = $_POST['mobile'];
        $pass = md5($_POST['password']);
        if(empty($mobile)||empty($pass)){
          $err = "Fill The Required Fields";
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
            $err = "Invalid username/ password";
          }
        }
      }
    ?>
      <form action="" method="post">
         <table cellspacing="9px" border="0px">
            <tr>
                <th>mobile no.:</th>
                <td><input type="text" name="mobile"></td>
            </tr>
            <tr>
                <th>Password:</th>
                <td><input type="password" name="password"></td>
            </tr>
            <tr>
                <th><input type="submit" name="btn" value="logIn"/></th>
            </tr>
     </table>
    </form>
  </body>
</html>
