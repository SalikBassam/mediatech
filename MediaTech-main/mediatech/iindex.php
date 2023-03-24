<?php
session_start(); // Start session for storing user information

require './dbconnect.php'; // Include file for database connection

// Check if user is logged in, redirect to login page if not
if(!isset($_SESSION['member_id'])){
    header('Location: logingSignup.php');
    exit();
}

// Get user ID from session
$member_id = $_SESSION['member_id'];

// Prepare SQL statement for selecting member data
$stmt = $pdo->prepare("SELECT member_nickname FROM members WHERE member_id = :member_id");

// Bind parameters to the statement
$stmt->bindParam(':member_id', $member_id);

// Execute statement and check for errors
if($stmt->execute()){
    // Fetch member data from the database
    $member = $stmt->fetch();
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <!-- google font -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,500;0,600;0,700;1,500&family=Open+Sans:ital,wght@0,400;0,500;0,600;1,600&display=swap"
      rel="stylesheet"
    />
    <!-- end google font -->
    <!-- start boostrap -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
<!-- end boostrap -->
    <!-- css file -->
    <link rel="stylesheet" href="style.css" />
    <!-- end css file -->
    <!-- font awesome -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.3/css/all.css" integrity="sha384-3E31Tp1gs6z+yYX9GUBd6d1s6UqyJ2uvfieHI8W+QtMgmyzDZMOpFmXWEClCnFji" crossorigin="anonymous">
    <title>Mediatech</title>
  </head>
  <body>



            

    <header>
        <nav>
        <div id="logo"><h1>LOGO</h1></div>
        <div>
          <div class="profileInfo">
            <form action="" method="post">
              <div class="imgPf">
              <p><b><?= $member['member_nickname'];?></b></p>
              <img src="./images/profile.jpg" alt="profile" class="profile" data-bs-toggle="dropdown" aria-expanded="false">
            <ul class="dropdown-menu">
              <li><a class="dropdown-item" href="profile.html">View Profile</a></li>
              <li><button class="dropdown-item" name="logout" onclick="logout()">Logout</button></li>
            </ul>
          </form>
          </div>
      </div>
    </nav>
    </header>
              <?php 
} else {
  // Display error message if query fails
  echo 'Failed to retrieve member information. Please try again.';
}

// Logout function
function logout() {
  // Unset all session variables
  session_unset();
  // Destroy the session
  session_destroy();
  // Redirect to the login page
  header("Location: logingSignup.php");
  exit();
}

// Check if the logout button was clicked
if (isset($_POST['logout'])) {
  // Call the logout function
  logout();
}
?>

    <!-- start section 1 -->
    <section id="section1">
<div class="kk">
    <div class="backgroundInfo">
        <p>It's chapteron</p>
        <h1>We love literature</h1>
        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Aliquid voluptate inventore quas, laborum optio reprehenderit praesentium praesentium </p>
        <a href="#section2"><button>Discover More</button></a>
    </div>
    <div>
    <img src="./images/bg.png" alt="" class="bg">
</div>
</div>
    </section>
    <!-- end section 1 -->
    <!-- start section 2 -->
    <section id="section2">
      <div id="searchparent">
        <div>
<ul>
  <li class="active">All</li>
  <li>Books</li>
  <li>Novels</li>
  <li>Magazines</li>
  <li>Cassettes</li>
  <li>CDs</li>
  <li>DVD</li>
</ul>
</div>
<div class="searchChild">
  <img src="./images/magnifying-glass-solid.svg" alt="" class="searchIcon">
<input type="search" name="search" id="search" placeholder="Search for a book or author " >
</div>
</div>
<div id="productCards">
<?php
// Get the items from the database using the selected sort order
$sql = "SELECT * FROM	products";
$items = $pdo->query($sql);

foreach($items AS $item){
?>
<div class="product">
<a href="detail.php?product_id=<?= $item['product_id']; ?>">    <div class="overlayout">Reserve Now</div>
    <div><img src="<?= $item['product_cover_image']; ?>" alt="product"></div>
    <div>
      <p><?= $item['product_author']; ?></p>
      <p><?= $item['product_title']; ?></p>
    </div>
  </a>
</div>
<?php
}
?>
</div>
    </section>
    <!-- end section 2 -->
    <footer>
     <p> Copyright © 2023  All Rights Reserved. - Bassam Salik</p>
    </footer>
  </body>
  <script src="homepage.js"></script>
</html>
