<?php 
  session_start();
  if($_SESSION['valid'] !== '' )
  {  
      header('location: index.php');
      exit();
  }
if(isset($_POST['move'])){
  // Get values passe from form in login php file
  $username=$_POST['user'];
  $password=$_POST['pass'];
  $_SESSION['valid']='';
  
  // connect to the server & select database
  $link = mysqli_connect("localhost","root", "");
  mysqli_select_db($link, "souqstock");

  // query the database for user
  $result = mysqli_query($link, "select * from users where username = '$username' and password = '$password'") or die("failed to query database". mysql_error());
  $row = mysqli_fetch_array($result);
  
  if ($row['username'] == $username && $row['password'] == $password){
      $_SESSION['valid']='123';
      // echo '<script>alert("'.$_SESSION['valid'].'")</script>';
      header("location: index.php");
      exit();
  } 
  else{
    // echo '<script>alert("'.$_SESSION['valid'].'")</script>';
    $_SESSION['valid']='';
      echo '<script>alert("your username or password must be incorrect!!!!!")</script>';
  }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="style.css">
  </head>
  <body>
<form class="login-box" method="POST">
  <h1>Login</h1>

  <div class="textbox"  >
    <i class="fas fa-user"></i>
    <input type="text" placeholder="Username" id="user" name="user">
  </div>

  <div class="textbox">
    <i class="fas fa-lock"></i>
    <input type="Password" placeholder="Password" id="pass" name="pass">
  </div>

  <input type="submit" class="btn" value="Sign in" name="move">
</form>
  </body>
</html>


