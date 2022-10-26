<?php
@include 'config.php';
session_start();
$user_id = $_SESSION['user_id'];
if(isset($_GET['logout'])){
  unset($user_id);
  session_destroy();
  header("location:index.php");
}
?>
<div class="header-1">

  <a href="index.php" class="logo"> <i class="fas fa-book"></i> bookly </a>

  <form action="" class="search-form">
    <input type="search" name="search_key" placeholder="search here..." id="search-box">
    <label for="search-box" class="fas fa-search"></label>
  </form>

  <div class="icons">
    <a href="liked.php" class="fas fa-heart"></a>
    <a href="cart.php" class="fas fa-shopping-cart ">
      <?php
      if(isset($user_id)){
        $select_cart = mysqli_query($conn,"SELECT * FROM cart WHERE user_id ='$user_id'") or die("NO BOOKS IN CART!");
        if(mysqli_num_rows($select_cart)>0){
          ?>
      <span><?php echo mysqli_num_rows($select_cart)?></span>
      <?php
        }}
      ?>
    </a>
    <a href="<?php if(isset($user_id)){echo "#";}else{echo "login.php";}?>" id="login-btn"
      class="fas fa-user <?php if(isset($user_id)) echo "active-user"?>"></a>
  </div>
  <?php if(isset($user_id)){
    $select = mysqli_query($conn,"SELECT * FROM user_form WHERE id = '$user_id'") or die("No Users!");
    if(mysqli_num_rows($select)>0){
      $row = mysqli_fetch_assoc($select);
    }
    ?>
  <div class="profile-box">
    <i class="fas fa-times profile-box-close"></i>
    <div class="info">
      <img src="<?php echo "image/user_images/".$row['image']?>" alt="<?php echo $row['name']?>">
      <div class="info-text">
        <h3><?php echo $row['name']?></h3>
        <p><?php echo $row['email']?></p>
        <a href="profile.php">edit Profile</a>
      </div>
    </div>
    <div class="action">
      <a href="login.php" class="btn">sign in</a>
      <a href="index.php?logout" onclick="return confirm('Are You Sure You Want To Logout!?')"
        class="btn btn-danger">logout</a>
    </div>
  </div>
  <?php }?>
</div>