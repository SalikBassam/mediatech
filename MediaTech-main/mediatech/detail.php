<?php
require './dbconnect.php'; // Include file for database connection
// Retrieve the product id from the URL parameter
$product_id = $_GET['product_id'];

// Fetch the product details from the database using the product id
$sql = "SELECT * FROM products WHERE product_id = :product_id";
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':product_id', $product_id, PDO::PARAM_INT);
$stmt->execute();
$product = $stmt->fetch(PDO::FETCH_ASSOC);
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
    <!-- css file -->
    <link rel="stylesheet" href="style.css" />
    <link rel="stylesheet" href="detail.css" />
    <!-- end css file -->
    <!-- font awesome -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.3/css/all.css" integrity="sha384-3E31Tp1gs6z+yYX9GUBd6d1s6UqyJ2uvfieHI8W+QtMgmyzDZMOpFmXWEClCnFji" crossorigin="anonymous">
    <title>Mediatech</title>
  </head>
  <body>
    <header>
        <nav>
        <div id="logo">
          <h1><a href="index.html">LOGO</a></h1>
        </div>
        <div>
            <div class="profileInfo">
                <p><b>User</b></p>
                <img src="./images/profile.jpg" alt="profile" class="profile">
            </div>
        </div>
    </nav>
    </header>
    <!-- ///////////////////start product details -->
    <section>
  <div>
    <div><img src="<?= $product['product_cover_image']; ?>" alt="pdc"></div>
    <div class="dtl">
      <h1><?= $product['product_title']; ?></h1>
      <p><span>Type :</span> <?= $product['product_type']; ?></p>
      <p><span>language :</span> <?= $product['langue']; ?></p>
      <p class="author"><span>By author :</span> <?= $product['product_author']; ?></p>
      <p class="desc"><?= $product['langue']; ?></p>
    </div>
    <div class="reserveNow">
      <p>(The reservation automatically cancels after 24 hours.)</p>
      <button>Reserve Now</button>
    </div>
  </div>
</section>
    <!-- ///////////////////end product details -->
    <footer>
      <p> Copyright © 2023  All Rights Reserved. - Bassam Salik</p>
     </footer>
    </body>