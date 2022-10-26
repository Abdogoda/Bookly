<?php 
@include 'config.php';
session_start();
$book_name = $_GET['book_name'];
$select_book = mysqli_query($conn,"SELECT * FROM books WHERE name='$book_name'") or die("ERROR IN FETCHING DATA FROM BOOKS!");
if(mysqli_num_rows($select_book)>0){
  $book_row = mysqli_fetch_assoc($select_book);
  $book_image = $book_row['image'];
  $book_id = $book_row['id'];
  $book_price = $book_row['price'];
  $book_category = $book_row['category'];
  $book_description = $book_row['description'];
  if($_SESSION['user_id']){
    $user_id = $_SESSION['user_id'];
    $select_book_cart = mysqli_query($conn,"SELECT * FROM cart WHERE name='$book_name' AND user_id ='$user_id'") or die("ERROR IN FETCHING DATA FROM CART!");
    if(mysqli_num_rows($select_book_cart)>0){
      $book_cart_row = mysqli_fetch_assoc($select_book_cart);
      $book_quantity = $book_cart_row['quantity'];
      $book_total = $book_cart_row['total'];
    }
    $select_book_liked = mysqli_query($conn,"SELECT * FROM liked WHERE name='$book_name' AND user_id ='$user_id'") or die("ERROR IN FETCHING DATA FROM LIKED!");
    if(mysqli_num_rows($select_book_liked)>0){
      $book_liked = true;
    }
  }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Bookly | <?php echo $book_name?></title>
  <link rel="stylesheet" href="https://unpkg.com/swiper@7/swiper-bundle.min.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
  <link rel="stylesheet" href="css/style.css">
  <link rel="stylesheet" href="css/book.css">
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
    <div class="book_box">
      <div class="book_image"><img src="image/books/<?php echo $book_image?>" alt="<?php echo $book_name?>"></div>
      <div class="book_info">
        <h1><?php echo $book_name?> <a href="#"
            class="fas fa-heart <?php if(isset($_SESSION['user_id'])) echo 'book-liked'?>"></a>
        </h1>
        <h5>category: <?php echo $book_category?></h5>
        <p><b>price: </b>$<?php echo $book_price?></p>
        <p><?php if(isset($book_quantity)) echo $book_quantity." books"?></p>
        <p><?php if(isset($book_total)) echo "<b>total price: </b>$".$book_total?></p>
        <p><?php echo $book_description?></p>
        <a href="add_to_cart.php?book_id=<?php echo $book_id?>" class="btn">Add To Cart</a>
      </div>
    </div>
  </section>
  <section class="arrivals" id="arrivals">
    <h1 class="heading"> <span>most relative</span> </h1>
    <div class="swiper arrivals-slider">
      <div class="swiper-wrapper">
        <?php
        $select_books = mysqli_query($conn,"SELECT * FROM books WHERE category='$book_category'");
        if(mysqli_num_rows($select_books) > 0){
            while($row = mysqli_fetch_assoc($select_books)){
           ?>
        <a href="book_details.php?book_name=<?php echo $row['name']?>" class="swiper-slide box">
          <div class="image">
            <img src="image/books/<?php echo $row['image']?>" alt="book_image">
          </div>
          <div class="content">
            <h3><?php echo $row['name']?></h3>
            <div class="price"><?php echo $row['category']?></div>
            <div class="stars">
              <i class="fas fa-star"></i>
              <i class="fas fa-star"></i>
              <i class="fas fa-star"></i>
              <i class="fas fa-star"></i>
              <i class="fas fa-star-half-alt"></i>
            </div>
          </div>
        </a>
        <?php }}?>
      </div>
    </div>
  </section>

  <script src="https://unpkg.com/swiper@7/swiper-bundle.min.js"></script>
  <?php 
if(isset($user_id)){
  ?> <script src="js/profile_box.js"></script><?php 
}
?>
</body>

</html>