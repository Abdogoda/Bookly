<?php
@include 'config.php';
session_start();
$user_id = $_SESSION['user_id'];
if(!isset($user_id)){
  header("location:login.php");
}
if(isset($_GET['remove'])){
    $book_liked_id = $_GET['remove'];
    mysqli_query($conn,"DELETE FROM liked WHERE id = '$book_liked_id' AND user_id ='$user_id'") or die("ERROR IN LIKED TABLE2!?");  
    $message = "Product Has Been Deleted Successfully!";
    // header('location:liked.php');
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Bookly | Liked</title>
  <link rel="stylesheet" href="https://unpkg.com/swiper@7/swiper-bundle.min.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
  <link rel="stylesheet" href="css/style.css">
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
  <!-- arrivals section starts  -->
  <section class="arrivals" id="arrivals">
    <h1 class="heading"> <span>You like</span> </h1>
    <div class="swiper arrivals-slider">
      <div class="swiper-wrapper">
        <?php
        $select_books = mysqli_query($conn,"SELECT * FROM liked WHERE user_id ='$user_id'");
        if(mysqli_num_rows($select_books) > 0){
            while($row = mysqli_fetch_assoc($select_books)){
           ?>
        <div class="swiper-slide box">
          <div class="image">
            <a href="book_details.php?book_name=<?php echo $row['name']?>"><img
                src="image/books/<?php echo $row['image']?>" alt="book_image"></a>
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
            <a href="liked.php?remove=<?php echo $row['id']?>" class="btn btn-danger"
              onclick="return confirm('Are You Sure You Want To Remove This Book From Likes!?')"
              style="font-size: 1rem; padding:0.7rem;">Remove From Likes</a>
          </div>
        </div>
        <?php }}else{
          ?>
        <div class="no_books"
          style="text-align: center; font-size:2rem; width:100%;display:flex;flex-direction:column;gap:1rem">NO BOOKS
          LIKED <a href="books.php" class="btn">back to shop</a></div>
        <?php }?>
      </div>
    </div>
  </section>
  <section class="arrivals" id="arrivals">
    <h1 class="heading"> <span>You may like</span> </h1>
    <div class="swiper arrivals-slider">
      <div class="swiper-wrapper">
        <?php
        $select_books = mysqli_query($conn,"SELECT * FROM books ORDER BY RAND() LIMIT 15");
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
  <script src="js/swipers.js"></script>
  <?php 
if(isset($user_id)){
  ?> <script src="js/profile_box.js"></script><?php 
}
?>
</body>

</html>