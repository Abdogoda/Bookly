<?php
@include 'config.php';
session_start();
  if(isset($_GET['book_id'])){
    if(isset($_SESSION['user_id'])){
      $user_id = $_SESSION['user_id'];
    $book_id = $_GET['book_id'];
    $origin_book = mysqli_query($conn,"SELECT * FROM books WHERE id = '$book_id'") or die("NO ITEM FOUND TO BE ADDED!?");
    if(mysqli_num_rows($origin_book)>0){
      $origin_book_row = mysqli_fetch_assoc($origin_book);
        $book_name = $origin_book_row['name'];
        $book_image = $origin_book_row['image'];
        $book_price = $origin_book_row['price'];
        $book_category = $origin_book_row['category'];
        $book_description = $origin_book_row['description'];
      $cart_book = mysqli_query($conn,"SELECT * FROM cart WHERE name = '$book_name' AND user_id ='$user_id'") or die("ERROR IN CART TABLE!?");
      if(mysqli_num_rows($cart_book)>0){
        $cart_book_row = mysqli_fetch_assoc($cart_book);
        echo $cart_book_row['quantity'];
      $cart_book_id = $cart_book_row['id'];
      $cart_book_quantity = (int)$cart_book_row['quantity'] + 1;
      echo $cart_book_quantity;
      $cart_book_price = $cart_book_row['price'];
      $cart_book_total = $cart_book_quantity * $cart_book_price;
      mysqli_query($conn , "UPDATE cart SET quantity = '$cart_book_quantity', total = '$cart_book_total' WHERE id = '$cart_book_id' AND user_id ='$user_id'") or die("ERROR IN INCREMENTING!?");
      $message="Product has been incremented to cart successfully!";
    }else{
        $book_quantity = 1;
        $book_total =  $book_price * $book_quantity;
        mysqli_query($conn,"INSERT INTO cart (user_id,name,image,price,quantity,total,category,description) VALUES ('$user_id','$book_name','$book_image','$book_price','$book_quantity', '$book_total','$book_category','$book_description')") or die("ERROR IN ADDING!?");
      }
      $message="Product has been added to cart successfully!";
    }
    // header('location:books.php');
  }else{
      header('location:login.php');
    }
  }
  if(isset($_GET['book_liked_name'])){
      if(isset($_SESSION['user_id'])){
        $user_id = $_SESSION['user_id'];
        $book_liked_name = $_GET['book_liked_name'];
      $select_liked = mysqli_query($conn,"SELECT * FROM liked WHERE name = '$book_liked_name' AND user_id ='$user_id'") or die("ERROR IN LIKED TABLE1!?");
      if(mysqli_num_rows($select_liked)>0){
        mysqli_query($conn,"DELETE FROM liked WHERE name = '$book_liked_name' AND user_id ='$user_id'") or die("ERROR IN LIKED TABLE2!?");
        $message="Product has been deleted successfully!";
      }else{
        $select_books = mysqli_query($conn,"SELECT * FROM books WHERE name = '$book_liked_name'");
        if(mysqli_num_rows($select_books) > 0){
          $row_liked = mysqli_fetch_assoc($select_books);
          $book_liked_image = $row_liked['image'];
          $book_liked_category = $row_liked['category'];
          mysqli_query($conn,"INSERT INTO liked (user_id,name,image,category) VALUES ('$user_id','$book_liked_name','$book_liked_image','$book_liked_category')") or die("ERROR IN LIKED TABLE3!?");
          $message="Product has been added successfully!";
        }
      }
    // header('location:books.php');
  }else{
        header('location:login.php');
      }
  }
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Bookly | Books</title>
  <link rel="stylesheet" href="https://unpkg.com/swiper@7/swiper-bundle.min.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
  <link rel="stylesheet" href="css/style.css">
  <link rel="stylesheet" href="css/books.css">
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
  <section class="books" id="books">
    <h1 class="heading"> <span>our books</span> </h1>
    <div class="books-wrapper">
      <?php
        $select_books = mysqli_query($conn,"SELECT * FROM books");
        if(mysqli_num_rows($select_books) > 0){
            while($row = mysqli_fetch_assoc($select_books)){
           ?>
      <div class="box">
        <div class="icons">
          <a href="books.php?book_id=<?php echo $row['id']?>" class="fas fa-shopping-cart">
            <?php
            if(isset($user_id)){
            $select_cart = mysqli_query($conn,"SELECT * FROM cart WHERE user_id ='$user_id'") or die("NO BOOKS IN CART!");
            if(mysqli_num_rows($select_cart)>0){
              while($book_row = mysqli_fetch_assoc($select_cart)){
                if($book_row['name']==$row['name']){
                  $book_quantity = $book_row['quantity'];
                  ?>
            <span><?php echo $book_quantity?></span>
            <?php
                }
              }
            }}
          ?>
          </a>
          <a href="books.php?book_liked_name=<?php echo $row['name']?>" class="fas fa-heart <?php 
          if(isset($user_id)){
            $liked_name = $row['name'];
            $liked = mysqli_query($conn,"SELECT * FROM liked WHERE name = '$liked_name' AND user_id ='$user_id'") or die("ERROR IN LIKED TABLE!?");
            if(mysqli_num_rows($liked)>0){
              echo "active_liked";
            }else{
              echo "";
            }
          }
          ?>"></a>
          <a href="book_details.php?book_name=<?php echo $row['name']?>" class="fas fa-eye"></a>
        </div>
        <div class="image">
          <a href="book_details.php?book_name=<?php echo $row['name']?>">
            <img src="image/books/<?php echo $row['image']?>" alt="">
          </a>
        </div>
        <div class="content">
          <h3><?php echo $row['name']?></h3>
          <div class="price">$<?php echo $row['price']?> <span>$20.99</span></div>
          <a href="books.php?book_id=<?php echo $row['id']?>" class="btn">add to cart</a>
        </div>
      </div>
      <?php  }}?>
    </div>
  </section>

  <?php 
if(isset($user_id)){
  ?> <script src="js/profile_box.js"></script><?php 
}
?>
</body>

</html>