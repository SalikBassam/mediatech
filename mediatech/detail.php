<?php
session_start();

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
    <link rel="stylesheet" href="./css/style.css" />
    <link rel="stylesheet" href="./css/detail.css" />
    <!-- end css file -->
    <!-- font awesome -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.3/css/all.css" integrity="sha384-3E31Tp1gs6z+yYX9GUBd6d1s6UqyJ2uvfieHI8W+QtMgmyzDZMOpFmXWEClCnFji" crossorigin="anonymous">
    <title>Mediatech</title>
  </head>
  <body>
    <header>
        <nav>
        <div id="logo">
          <h1><a href="iindex.php"><img src="./images/logo.png" alt="logo" width="80px"></a></h1>
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
      <p class="desc"><?= $product['description']; ?></p>
    </div>
    <div class="reserveNow">
      <p>(The reservation automatically cancels after 24 hours.)</p>
      <?php
// Check if the "Reserve" button has been clicked
$reservation_status = "";

if (isset($_POST['reserve'])) {
  // Get the number of items already borrowed by the user
  $sql = "SELECT COUNT(*) as num_borrowed FROM borrowing_op WHERE member_id = :member_id";
  $stmt = $pdo->prepare($sql);
  $stmt->bindValue(':member_id', $_SESSION['member_id']);
  $stmt->execute();
  $borrowed_items = $stmt->fetch(PDO::FETCH_ASSOC);

  // Get the number of items already reserved by the user
  $sql = "SELECT COUNT(*) as num_reservations FROM reservation_op WHERE member_id = :member_id";
  $stmt = $pdo->prepare($sql);
  $stmt->bindValue(':member_id', $_SESSION['member_id']);
  $stmt->execute();
  $reservations = $stmt->fetch(PDO::FETCH_ASSOC);

  // If the user has already borrowed or reserved three items, do not allow further reservations
  if ($borrowed_items['num_borrowed'] + $reservations['num_reservations'] >= 3) {
    $reservation_status = "Cannot reserve";
  }  else {
    // Insert a new row into the reservation_op table to record the reservation
    $reservation_date = date('Y-m-d H:i:s');
    $reservation_expiry_date = date('Y-m-d H:i:s', strtotime('+1 day')); // set expiration date to 5 minutes from now
    $sql = "INSERT INTO reservation_op (member_id, product_id, reservation_date, reservation_expiry_date) VALUES (:member_id, :product_id, :reservation_date, :reservation_expiry_date)";
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':member_id', $_SESSION['member_id']);
    $stmt->bindValue(':product_id', $product_id);
    $stmt->bindValue(':reservation_date', $reservation_date);
    $stmt->bindValue(':reservation_expiry_date', $reservation_expiry_date);
    $stmt->execute();

    // Set $reservation_status to "Reserved" to display the "Reserved" message
    $reservation_status = "Reserved";
  }
}

// Get the number of items already reserved by the user
$sql = "SELECT COUNT(*) as num_reservations FROM reservation_op WHERE member_id = :member_id";
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':member_id', $_SESSION['member_id']);
$stmt->execute();
$reservations = $stmt->fetch(PDO::FETCH_ASSOC);

$num_reservations = $reservations['num_reservations'];

// Get the number of items already borrowed by the user
$sql = "SELECT COUNT(*) as num_borrowed FROM borrowing_op WHERE member_id = :member_id";
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':member_id', $_SESSION['member_id']);
$stmt->execute();
$borrowed_items = $stmt->fetch(PDO::FETCH_ASSOC);

$num_borrowings = $borrowed_items['num_borrowed'];



// // Cancel a reservation if it has expired
// if ($reservation && strtotime($reservation['reservation_expiry_date']) < time()) {
//   $sql = "DELETE FROM reservation_op WHERE reservation_id = :reservation_id";
//   $stmt = $pdo->prepare($sql);
//   $stmt->bindValue(':reservation_id', $reservation['reservation_id']);
//   $stmt->execute();
// }

// Check if the product is borrowed
$sql = "SELECT * FROM products WHERE product_id = :product_id AND product_status = 'Borrowed'";
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':product_id', $product_id);
$stmt->execute();
$borrowed_product = $stmt->fetch(PDO::FETCH_ASSOC);

// Check if the product is reserved
$sql = "SELECT * FROM reservation_op WHERE product_id = :product_id";
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':product_id', $product_id);
$stmt->execute();
$reservation = $stmt->fetch(PDO::FETCH_ASSOC);

// Display "Reserve Now" button or "Reserved" or "Cannot reserve" message depending on reservation status, number of existing reservations and borrowings, and product status
if (($borrowed_items['num_borrowed'] + $reservations['num_reservations'] >= 3)) {
  echo '<p>You have already reserved the maximum number of items.</p>';
}// Display "Reserve Now" button or "Reserved" or "Cannot reserve" message depending on reservation status, number of existing reservations and borrowings, and product status
elseif ($num_reservations >= 3) {
  echo '<p>You have already reserved the maximum number of items.</p>';
} else if ($num_borrowings >= 3) {
  echo '<p>You have already borrowed the maximum number of items.</p>';
} else if ($reservation_status === "Reserved" || $reservation) {
  echo '<p>This item has already been reserved.</p>';
} else if ($borrowed_product) {
  echo '<p>This item has already been borrowed.</p>';
} else {
  echo '<form action="" method="post">
          <input type="hidden" name="product_id" value="' . $product_id . '">';
  if ($num_reservations > 0) {
    echo '<p>You have already reserved ' . $num_reservations . ' item(s). You can reserve ' . (3 - $num_reservations) . ' more item(s).</p>';
  }
  echo '<button type="submit" name="reserve">Reserve Now</button>
        </form>';
}
?>









      
    </div>
  </div>
</section>
    <!-- ///////////////////end product details -->
    <footer>
      <p> Copyright © 2023  All Rights Reserved. - Bassam Salik</p>
     </footer>
    </body>