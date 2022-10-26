<?php
@include 'config.php';
session_start();
// $email = $password = "";
if (isset($_POST['login'])) {
  $email = mysqli_real_escape_string($conn,$_POST['email']);
  $password = mysqli_real_escape_string($conn,md5($_POST['password']));
  $select = mysqli_query($conn,"SELECT * FROM user_form WHERE email = '$email'") or die("Query Failed1");
  if(mysqli_num_rows($select)>0){
    echo "email found";
    $row = mysqli_fetch_assoc($select);
    if($password == $row['password']){
      $message = 'You Are In!';
      $_SESSION['user_id']= $row['id'];
      header('location:index.php');
    }else{
      $message = 'Your Password Is Not Correct!';
    }
  }else{
    $message = 'Wrong Email Or Password!';
  }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Bookly | Login</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
  <link rel="stylesheet" href="css/style.css">
</head>

<body>
  <header class="header box-shadow">
    <?php 
    @include 'header1.php';
    if(isset($message)){
      ?><div class="header-2 message-container" onclick="this.remove()">
      <h1><?php echo $message?></h1>
    </div><?php
    }
    ?>
  </header>
  <!-- login form  -->
  <div class="login-form-container">
    <form action="" method="POST">
      <h3>sign in</h3>
      <div class="box">
        <label for="email">email</label>
        <input type="email" name="email" class="box-input" placeholder="enter your email" id="email">
      </div>
      <div class="box">
        <label for="password">password</label>
        <input type="password" name="password" class="box-input" placeholder="enter your password" id="password">
      </div>
      <div class="checkbox">
        <input type="checkbox" name="" id="remember-me">
        <label for="remember-me"> remember me</label>
      </div>
      <input type="submit" value="sign in" name="login" class="btn">
      <p>forget password ? <a href="#">click here</a></p>
      <p>don't have an account ? <a href="register.php">create one</a></p>
    </form>
  </div>


  <?php 
if(isset($user_id)){
  ?> <script src="js/profile_box.js"></script><?php 
}
?>
</body>

</html>