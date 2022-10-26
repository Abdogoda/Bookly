<?php
@include 'config.php';
$name = $email = $gender = $comment = $website = "";
if (isset($_POST['register'])) {
  $name = mysqli_real_escape_string($conn,$_POST['name']);
  $email = mysqli_real_escape_string($conn,$_POST['email']);
  $phone = mysqli_real_escape_string($conn,$_POST['phone']);
  $address = mysqli_real_escape_string($conn,$_POST['address']);
  $password = mysqli_real_escape_string($conn,md5($_POST['password']));
  $cpassword = mysqli_real_escape_string($conn,md5($_POST['cpassword']));
  $image= $_FILES['image']['name'];
  echo $image;
  $image_tmp_name = $_FILES['image']['tmp_name'];
  $image_tmp_folder = 'image/user_images/'.$image;
  if($password == $cpassword){
    $select = mysqli_query($conn,"SELECT * FROM user_form WHERE email = '$email' AND password = '$password'") or die("Query Failed1");
  if(mysqli_num_rows($select)>0){
    $message = 'User Is Already Exist!';
  }else{
    mysqli_query($conn,"INSERT INTO user_form (name,email,phone,address,password,image) VALUES ('$name','$email','$phone','$address','$password','$image')")or die("Query Failed2");
    move_uploaded_file($image_tmp_name,$image_tmp_folder);
    $message = 'register is done successfully';
    header('location:login.php');
  }
  }else{
    $message = 'Passwords Not Match!';
  }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Bookly | Register</title>
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
  <div class="login-form-container register-form container">
    <form action="" method="POST" enctype="multipart/form-data">
      <h3>sign Up</h3>
      <div class="form-boxes">
        <div class="box">
          <label for="name">username</label>
          <input type="name" name="name" class="box-input" placeholder="enter your name" id="name" required>
        </div>
        <div class="box">
          <label for="email">email</label>
          <input type="email" name="email" class="box-input" placeholder="enter your email" id="email" required>
        </div>
        <div class="box">
          <label for="phone">phone</label>
          <input type="tel" name="phone" class="box-input" placeholder="enter your phone" id="phone" required>
        </div>
        <div class="box">
          <label for="address">address</label>
          <input type="text" name="address" class="box-input" placeholder="enter your address" id="address" required>
        </div>
        <div class="box">
          <label for="password">password</label>
          <input type="password" name="password" class="box-input" placeholder="enter your password" id="password"
            required>
        </div>
        <div class="box">
          <label for="cpassword">confirm password</label>
          <input type="password" name="cpassword" class="box-input" placeholder="confirm your password" id="cpassword"
            required>
        </div>
        <div class="box w-100">
          <label for="image">select image</label>
          <input type="file" name="image" class="box-input" accept="image/png, image/jpg, image/jpeg, image/jifi "
            id="image">
        </div>
      </div>
      <input type="submit" value="sign up" name="register" class="btn">
      <p>already have an account ? <a href="login.php">sign in</a></p>
    </form>
  </div>

  <?php 
if(isset($user_id)){
  ?> <script src="js/profile_box.js"></script><?php 
}
?>
</body>

</html>