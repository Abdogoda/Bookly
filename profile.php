<?php
@include 'config.php';
session_start();
$user_id = $_SESSION['user_id'];
if(!isset($user_id)){
  header("location:login.php");
}
$user_select = mysqli_query($conn,"SELECT * FROM user_form WHERE id = '$user_id'") or die("ERROR IN FETCHING USER!");
if(mysqli_num_rows($user_select)>0){
  $user_row = mysqli_fetch_assoc($user_select);
  $user_name = $user_row['name'];
  $user_email = $user_row['email'];
  $user_phone = $user_row['phone'];
  $user_address = $user_row['address'];
  $user_image = $user_row['image'];
}
if(isset($_POST['update'])){
  $name = $_POST['name'];
  $email = $_POST['email'];
  $phone = $_POST['phone'];
  $address = $_POST['address'];
  $image= $_FILES['image']['name'];
  $image_tmp_name = $_FILES['image']['tmp_name'];
  $image_tmp_folder = 'image/user_images/'.$image;
  mysqli_query($conn,"UPDATE user_form SET name='$name',email='$email',phone='$phone',address='$address',image='$image' WHERE id='$user_id'") or die("ERROR IN UPDATE USER!");
  move_uploaded_file($image_tmp_name,$image_tmp_folder);
  $message = "User Updated Successfully!";
  header("location:profile.php");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Bookly | <?php echo $name?></title>
  <link rel="stylesheet" href="https://unpkg.com/swiper@7/swiper-bundle.min.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
  <link rel="stylesheet" href="css/style.css">
  <link rel="stylesheet" href="css/profile.css">
</head>

<body>
  <header class="header">
    <?php
    @include 'header1.php';
        if(isset($message)){
            ?>
    <div class="header-2 message-container" onclick="this.remove()">
      <h1><?php echo $message?></h1>
    </div>
    <?php
        }
    ?>
  </header>
  <section>
    <div class="user-box">
      <div class="image"><img src="image/user_images/<?php echo $user_image?>" alt="<?php echo $user_name?>"></div>
      <form action="" method="post" enctype="multipart/form-data">
        <div class="input-boxs">
          <div class="input-box">
            <label for="name">your name</label>
            <input type="text" name="name" id="name" value="<?php echo $user_name?>">
          </div>
          <div class="input-box">
            <label for="email">your email</label>
            <input type="email" name="email" id="email" value="<?php echo $user_email?>">
          </div>
          <div class="input-box">
            <label for="phone">your phone</label>
            <input type="tel" name="phone" id="phone" value="<?php echo $user_phone?>">
          </div>
          <div class="input-box">
            <label for="address">your address</label>
            <input type="text" name="address" id="address" value="<?php echo $user_address?>">
          </div>
          <div class="input-box w-100">
            <label for="image">select image</label>
            <input type="file" name="image" accept="image/png, image/jpg, image/jpeg, image/jifi" id="image"
              value="<?php echo $user_image?>">
          </div>
        </div>
        <button type="submit" class="btn" name="update">save changes</button>
      </form>
    </div>
  </section>

  <?php 
if(isset($user_id)){
  ?> <script src="js/profile_box.js"></script><?php 
}
?>
</body>

</html>