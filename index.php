<?php
@include 'config.php';
session_start();
if(isset($_SESSION['user_id'])){
  $user_id = $_SESSION['user_id'];
  if(isset($_GET['book_id'])){
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
    // header('location:index.php');
  }
  if(isset($_GET['book_liked_name'])){
      $book_liked_name = $_GET['book_liked_name'];
      $select_liked = mysqli_query($conn,"SELECT * FROM liked WHERE name = '$book_liked_name' AND user_id ='$user_id'") or die("ERROR IN LIKED TABLE1!?");
      if(mysqli_num_rows($select_liked)>0){
        mysqli_query($conn,"DELETE FROM liked WHERE name = '$book_liked_name' AND user_id ='$user_id'") or die("ERROR IN LIKED TABLE2!?");
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
    // header('location:index.php');
  }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Bookly</title>
  <link rel="stylesheet" href="https://unpkg.com/swiper@7/swiper-bundle.min.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
  <link rel="stylesheet" href="css/style.css">
</head>

<body>
  <!-- header section  -->
  <header class="header">
    <?php
    @include 'header1.php';
    ?>
    <div class="header-2">
      <nav class="navbar">
        <a href="#home">home</a>
        <a href="books.php">books</a>
        <a href="#featured">featured</a>
        <a href="#arrivals">arrivals</a>
        <a href="#blogs">blogs</a>
        <a href="#reviews">reviews</a>
      </nav>
    </div>
    <?php
        if(isset($message)){
            ?>
    <div class="header-2 message-container" onclick="this.remove()">
      <h1><?php echo $message?></h1>
    </div>
    <?php
        }
    ?>
  </header>
  <!-- bottom navbar  -->
  <nav class="bottom-navbar">
    <a href="#home" class="fas fa-home"></a>
    <a href="#featured" class="fas fa-list"></a>
    <a href="#arrivals" class="fas fa-tags"></a>
    <a href="#reviews" class="fas fa-comments"></a>
    <a href="#blogs" class="fas fa-blog"></a>
  </nav>

  <!-- home section starts  -->
  <section class="home" id="home">
    <div class="row">
      <div class="content">
        <h3>upto 75% off</h3>
        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Magnam deserunt nostrum accusamus. Nam alias sit
          necessitatibus, aliquid ex minima at!</p>
        <a href="books.php" class="btn">shop now</a>
      </div>

      <div class="swiper books-slider">
        <div class="swiper-wrapper">
          <?php
        $select_books = mysqli_query($conn,"SELECT * FROM books ORDER BY RAND() LIMIT 10");
        if(mysqli_num_rows($select_books) > 0){
            while($row = mysqli_fetch_assoc($select_books)){
           ?>
          <a href="book_details.php?book_name=<?php echo $row['name']?>" class="swiper-slide"><img
              src="image/books/<?php echo $row['image']?>" alt="<?php echo $row['name']?>"></a>
          <?php }}?>
        </div>
        <img src="image/stand.png" class="stand" alt="stand_image">
      </div>
    </div>
  </section>

  <!-- icons section starts  -->
  <section class="icons-container">
    <div class="icons">
      <i class="fas fa-shipping-fast"></i>
      <div class="content">
        <h3>free shipping</h3>
        <p>order over $100</p>
      </div>
    </div>
    <div class="icons">
      <i class="fas fa-lock"></i>
      <div class="content">
        <h3>secure payment</h3>
        <p>100 secure payment</p>
      </div>
    </div>
    <div class="icons">
      <i class="fas fa-redo-alt"></i>
      <div class="content">
        <h3>easy returns</h3>
        <p>10 days returns</p>
      </div>
    </div>
    <div class="icons">
      <i class="fas fa-headset"></i>
      <div class="content">
        <h3>24/7 support</h3>
        <p>call us anytime</p>
      </div>
    </div>
  </section>

  <!-- featured section starts  -->
  <section class="featured" id="featured">
    <h1 class="heading"> <span>featured books</span> </h1>
    <div class="swiper featured-slider">
      <div class="swiper-wrapper">
        <?php
        $select_books = mysqli_query($conn,"SELECT * FROM books ORDER BY RAND() LIMIT 15");
        if(mysqli_num_rows($select_books) > 0){
            while($row = mysqli_fetch_assoc($select_books)){
            ?>
        <div class="swiper-slide box">
          <div class="icons">
            <a href="<?php if(isset($_SESSION['user_id'])){echo 'index.php?book_id='.$row["id"];}else{echo 'login.php';} ?>"
              class="fas fa-shopping-cart">
              <?php
            if(isset($_SESSION['user_id'])){
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
          ?></a>
            <a href="<?php if(isset($_SESSION['user_id'])){echo 'index.php?book_liked_name='.$row["name"];}else{echo 'login.php';} ?>"
              class="fas fa-heart <?php 
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
            <a href="<?php if(isset($_SESSION['user_id'])){echo 'index.php?book_id='.$row["id"];}else{echo 'login.php';} ?>"
              class="btn">add to cart</a>
          </div>
        </div>
        <?php  }}?>
      </div>
      <div class="swiper-button-next"></div>
      <div class="swiper-button-prev"></div>
    </div>
  </section>

  <!-- newsletter section starts -->
  <section class="newsletter">
    <form action="">
      <h3>subscribe for latest updates</h3>
      <input type="email" name="" placeholder="enter your email" id="" class="box">
      <input type="submit" value="subscribe" class="btn">
    </form>
  </section>

  <!-- arrivals section starts  -->
  <section class="arrivals" id="arrivals">
    <h1 class="heading"> <span>new arrivals</span> </h1>
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
            <div class="price">$<?php echo $row['price']?> <span>$20.99</span></div>
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
            <div class="price">$<?php echo $row['price']?> <span>$20.99</span></div>
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

  <!-- deal section starts  -->
  <section class="deal">
    <div class="content">
      <h3>deal of the day</h3>
      <h1>upto 50% off</h1>
      <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Unde perspiciatis in atque dolore tempora quaerat at
        fuga dolorum natus velit.</p>
      <a href="books.php" class="btn">shop now</a>
    </div>
    <div class="image">
      <img src="image/deal-img.jpg" alt="">
    </div>
  </section>

  <!-- blogs section starts  -->
  <section class="blogs" id="blogs">
    <h1 class="heading"> <span>our blogs</span> </h1>
    <div class="swiper blogs-slider">
      <div class="swiper-wrapper">
        <div class="swiper-slide box">
          <div class="image">
            <img src="image/blogs/blog-1.jpg" alt="">
          </div>
          <div class="content">
            <h3>blog title goes here</h3>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Optio, odio.</p>
            <a href="#" class="btn">read more</a>
          </div>
        </div>
        <div class="swiper-slide box">
          <div class="image">
            <img src="image/blogs/blog-2.jpg" alt="">
          </div>
          <div class="content">
            <h3>blog title goes here</h3>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Optio, odio.</p>
            <a href="#" class="btn">read more</a>
          </div>
        </div>
        <div class="swiper-slide box">
          <div class="image">
            <img src="image/blogs/blog-3.jpg" alt="">
          </div>
          <div class="content">
            <h3>blog title goes here</h3>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Optio, odio.</p>
            <a href="#" class="btn">read more</a>
          </div>
        </div>
        <div class="swiper-slide box">
          <div class="image">
            <img src="image/blogs/blog-4.jpg" alt="">
          </div>
          <div class="content">
            <h3>blog title goes here</h3>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Optio, odio.</p>
            <a href="#" class="btn">read more</a>
          </div>
        </div>
        <div class="swiper-slide box">
          <div class="image">
            <img src="image/blogs/blog-5.jpg" alt="">
          </div>
          <div class="content">
            <h3>blog title goes here</h3>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Optio, odio.</p>
            <a href="#" class="btn">read more</a>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- reviews section starts  -->
  <section class="reviews" id="reviews">
    <h1 class="heading"> <span>client's reviews</span> </h1>
    <div class="swiper reviews-slider">
      <div class="swiper-wrapper reviews-swiper">
        <div class="swiper-slide box">
          <img src="image/testimonials/pic-1.png" alt="">
          <h3>John Snow</h3>
          <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Aspernatur nihil ipsa placeat. Aperiam at sint,
            eos ex similique facere hic.</p>
          <div class="stars">
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star-half-alt"></i>
          </div>
        </div>
        <div class="swiper-slide box">
          <img src="image/testimonials/pic-2.png" alt="">
          <h3>Emilia Clarck</h3>
          <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Aspernatur nihil ipsa placeat. Aperiam at sint,
            eos ex similique facere hic.</p>
          <div class="stars">
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="far fa-star"></i>
          </div>
        </div>
        <div class="swiper-slide box">
          <img src="image/testimonials/pic-3.png" alt="">
          <h3>Wiliam mark</h3>
          <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Aspernatur nihil ipsa placeat. Aperiam at sint,
            eos ex similique facere hic.</p>
          <div class="stars">
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
          </div>
        </div>
        <div class="swiper-slide box">
          <img src="image/testimonials/pic-4.png" alt="">
          <h3>Thia queen</h3>
          <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Aspernatur nihil ipsa placeat. Aperiam at sint,
            eos ex similique facere hic.</p>
          <div class="stars">
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star-half-alt"></i>
          </div>
        </div>
        <div class="swiper-slide box">
          <img src="image/testimonials/pic-5.png" alt="">
          <h3>Ed Sherien</h3>
          <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Aspernatur nihil ipsa placeat. Aperiam at sint,
            eos ex similique facere hic.</p>
          <div class="stars">
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star-half-alt"></i>
          </div>
        </div>
        <div class="swiper-slide box">
          <img src="image/testimonials/pic-6.png" alt="">
          <h3>Taylor Swift</h3>
          <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Aspernatur nihil ipsa placeat. Aperiam at sint,
            eos ex similique facere hic.</p>
          <div class="stars">
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star-half-alt"></i>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- footer section starts  -->
  <section class="footer">
    <div class="box-container">
      <div class="box">
        <h3>our locations</h3>
        <a href="#"> <i class="fas fa-map-marker-alt"></i> india </a>
        <a href="#"> <i class="fas fa-map-marker-alt"></i> USA </a>
        <a href="#"> <i class="fas fa-map-marker-alt"></i> russia </a>
        <a href="#"> <i class="fas fa-map-marker-alt"></i> france </a>
        <a href="#"> <i class="fas fa-map-marker-alt"></i> japan </a>
        <a href="#"> <i class="fas fa-map-marker-alt"></i> africa </a>
      </div>
      <div class="box">
        <h3>quick links</h3>
        <a href="#"> <i class="fas fa-arrow-right"></i> home </a>
        <a href="#"> <i class="fas fa-arrow-right"></i> featured </a>
        <a href="#"> <i class="fas fa-arrow-right"></i> arrivals </a>
        <a href="#"> <i class="fas fa-arrow-right"></i> reviews </a>
        <a href="#"> <i class="fas fa-arrow-right"></i> blogs </a>
      </div>
      <div class="box">
        <h3>extra links</h3>
        <a href="#"> <i class="fas fa-arrow-right"></i> account info </a>
        <a href="#"> <i class="fas fa-arrow-right"></i> ordered items </a>
        <a href="#"> <i class="fas fa-arrow-right"></i> privacy policy </a>
        <a href="#"> <i class="fas fa-arrow-right"></i> payment method </a>
        <a href="#"> <i class="fas fa-arrow-right"></i> our serivces </a>
      </div>
      <div class="box">
        <h3>contact info</h3>
        <a href="#"> <i class="fas fa-phone"></i> +123-456-7890 </a>
        <a href="#"> <i class="fas fa-phone"></i> +111-222-3333 </a>
        <a href="#"> <i class="fas fa-envelope"></i> abdogoda0a@gmail.com </a>
        <img src="image/worldmap.png" class="map" alt="">
      </div>
    </div>
    <div class="share">
      <a href="#" class="fab fa-facebook-f"></a>
      <a href="#" class="fab fa-twitter"></a>
      <a href="#" class="fab fa-instagram"></a>
      <a href="#" class="fab fa-linkedin"></a>
      <a href="#" class="fab fa-pinterest"></a>
    </div>
  </section>

  <!-- loader  -->
  <div class="loader-container">
    <img src="image/loader-img.gif" alt="">
  </div>

  <script src="https://unpkg.com/swiper@7/swiper-bundle.min.js"></script>
  <script src="js/script.js"></script>
  <script src="js/loader.js"></script>
  <script src="js/swipers.js"></script>
  <?php 
if(isset($user_id)){
  ?> <script src="js/profile_box.js"></script><?php 
}
?>
</body>

</html>