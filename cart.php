<?php
@include 'config.php';
session_start();
$user_id = $_SESSION['user_id'];
if(!isset($user_id)){
  header("location:login.php");
}
$user_select = mysqli_query($conn,"SELECT * From user_form WHERE id = '$user_id'");
$user_row = mysqli_fetch_assoc($user_select);
$user_email = $user_row['email'];
if(isset($_GET['delete'])){
  $delete_id = $_GET['delete'];
  mysqli_query($conn,"DELETE FROM cart WHERE id = '$delete_id' AND user_id ='$user_id'") or die("ERROR IN CART DELETE!?");
  $message = "Product Has Been Deleted Successfully!";
}
if(isset($_GET['inc'])){
  $inc_id = $_GET['inc'];
  $select_inc = mysqli_query($conn,"SELECT * FROM cart WHERE id = '$inc_id' AND user_id ='$user_id'") or die("ERROR IN SELECT CART INC!?");
  if(mysqli_num_rows($select_inc)>0){
    $row_inc = mysqli_fetch_assoc($select_inc);
    $inc_quantity = $row_inc['quantity'] + 1;
    mysqli_query($conn,"UPDATE cart SET quantity = '$inc_quantity' WHERE id = '$inc_id' AND user_id ='$user_id'") or die("ERROR IN CART INC!?");
  $message = "Product Has Been Incremented Successfully!";}
  }
  if(isset($_GET['dec'])){
    $dec_id = $_GET['dec'];
    $select_dec = mysqli_query($conn,"SELECT * FROM cart WHERE id = '$dec_id' AND user_id ='$user_id'") or die("ERROR IN SELECT CART DEC!?");
  if(mysqli_num_rows($select_dec)>0){
    $row_dec = mysqli_fetch_assoc($select_dec);
    if($row_dec['quantity'] > 1){
      $dec_quantity = $row_dec['quantity'] - 1;
      mysqli_query($conn,"UPDATE cart SET quantity = '$dec_quantity' WHERE id = '$dec_id' AND user_id ='$user_id'") or die("ERROR IN CART DEC!?");
    $message = "Product Has Been Decremented Successfully!";}
    }else{
      mysqli_query($conn,"DELETE FROM cart WHERE id = '$dec_id' AND user_id ='$user_id'") or die("ERROR IN CART DELETE!?");
    }
    // header('location:cart.php');
  }
  if(isset($_GET['checkout'])){
    mysqli_query($conn,"DELETE FROM cart WHERE user_id ='$user_id'") or die("ERROR IN CART DELETE!?");
  $message = "The Process Is Done Successfully, Check Your Email!";
  }
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Bookly | Cart</title>
  <link rel="stylesheet" href="https://unpkg.com/swiper@7/swiper-bundle.min.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
  <link rel="stylesheet" href="css/style.css">
  <link rel="stylesheet" href="css/cart.css">
</head>

<body>
  <!-- header section  -->
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
  <!-- featured section starts  -->
  <section class="cart" id="cart">
    <h1 class="heading"> <span>your cart</span> </h1>
    <div class="cart-wrapper">
      <table>
        <thead>
          <tr>
            <th>Image</th>
            <th>Name</th>
            <th>Price</th>
            <th>quantity</th>
            <th>total</th>
          </tr>
        </thead>
        <tbody>


          <?php
        $select_books = mysqli_query($conn,"SELECT * FROM cart WHERE user_id ='$user_id'");
        $total = 0;
        if(mysqli_num_rows($select_books) > 0){
            while($row = mysqli_fetch_assoc($select_books)){
              $total += $row['total'];
           ?>
          <tr>
            <td>
              <a href="book_details.php?book_name=<?php echo $row['name']?>">
                <img src="image/books/<?php echo $row['image']?>" alt="">
              </a>
            </td>
            <td><?php echo $row['name']?></td>
            <td><?php echo '$'.$row['price']?></td>
            <td>
              <span><?php echo $row['quantity']?> books</span>
              <div class="quantity">
                <a href="cart.php?inc=<?php echo $row['id']?>" class="btn btn-inc"><i class="fas fa-chevron-up"></i></a>
                <a href="cart.php?dec=<?php echo $row['id']?>" class="btn btn-dec"><i
                    class="fas fa-chevron-down"></i></a>
                <a href="cart.php?delete=<?php echo $row['id']?>"
                  onclick="return confirm('Are You Sure You Want To Delete This Book!?')" class="btn btn-danger">
                  <i class="fas fa-trash"></i></a>
              </div>
            </td>
            <td><?php echo '$'.$row['total']?></td>
          </tr>
          <?php  }}else{
            ?>
          <tr>
            <td colspan="5" class="no-books">NO BOOKS ADDED <a href="books.php" class="btn">back to shop</a></td>
          </tr>
          <?php }?>
        </tbody>
      </table>
    </div>
    <?php
    if($total > 1){
      ?>
    <div class="cart-checkout">
      <h3>order summary</h3>
      <p><b>order subtotal: </b> $<?php echo $total?></p>
      <p><b>shipping: </b> $10</p>
      <?php if($total > 100) echo "<p><b>free ground shopping over $100: </b> -$20</p>"?>
      <p><b>sales tax: </b> -</p>
      <hr>
      <p class="total"><b>order total: <span>$<?php if($total > 100){echo $total+10;}else{echo $total-10;}?></span></b>
      </p>
      <a href="cart.php?checkout" class="btn"
        onclick="return confirm('Are You Sure You Want To Continue, We Will Send Your Shop Details to <?php echo $user_email?>!?')">checkout
        and
        order</a>
      <a href="books.php" class="btn">back to shop</a>
    </div>
    <?php
    }
    ?>
  </section>

  <?php 
if(isset($user_id)){
  ?> <script src="js/profile_box.js"></script><?php 
}
?>
</body>

</html>