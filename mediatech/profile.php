<?php 
require "dbconnect.php";
session_start();

// check if user is not logged in, redirect to login page
if (!isset($_SESSION['member_id'])) {
  header("Location: loginSignup.php");
  exit();
}

// handle cancel reservation
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['cancel_reservation'])) {
  $reservation_id = $_POST['reservation_id'];
  $stmt = $pdo->prepare("DELETE FROM reservation_op WHERE reservation_id = ?");
  $stmt->execute([$reservation_id]);
  // redirect to profile page after cancellation
  header("Location: profile.php");
  exit();
}

// Fetch the reservations for the current user
$stmt = $pdo->prepare("SELECT * FROM reservation_op WHERE member_id = ?");
$stmt->execute([$_SESSION['member_id']]);
$reservations = $stmt->fetchAll();

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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css"
      rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD"
      crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN"
      crossorigin="anonymous"></script>
    <!-- end boostrap -->
    <!-- css file -->
    <link rel="stylesheet" href="./css/profile.css" />
    <link rel="stylesheet" href="./css/style.css">
    <!-- end css file -->
    <!-- font awesome -->
    <link rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"
      integrity="sha512-X9z+0H56JbhTzSjge0w+O/YtwBQ/2cR70Muh+8W/hXwhOdtzj3qJNzwweJYRZfxuwbtCu+bUGIwKInDZp/NnLg=="
      crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Mediatech</title>
  </head>
<body>
<?php
include "header.php";
?>
  <section id="productSection">
    <ul>
      <li class="active" id="reserved">Reserved</li>
      <li id="borrowed">Borrowed</li>
    </ul>
    <div id="productCards">
    <?php
// Fetch the reservations for the current user
$stmt = $pdo->prepare("SELECT r.*, p.product_title, p.product_cover_image FROM reservation_op r
                        INNER JOIN products p ON r.product_id = p.product_id
                        WHERE r.member_id = ?");
$stmt->execute(array($_SESSION['member_id']));
$reservations = $stmt->fetchAll();

// Assume the reservations details are stored in $reservations array
foreach ($reservations as $reservation) {
?>
  <div class="productProfile">
    <div><img src="<?php echo $reservation['product_cover_image']; ?>" alt="product"></div>
    <div>
      <p><?php echo $reservation['product_title']; ?></p>
      <p><b><?php echo date('Y/m/d - h:i A', strtotime($reservation['reservation_date'])); ?></b></p>
      <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <input type="hidden" name="reservation_id" value="<?php echo $reservation['reservation_id']; ?>">
        <button type="submit" name="cancel_reservation">Cancel the reservation</button>
      </form>
    </div>
  </div>
<?php } ?>

<?php 

?>

</div>
        </div>
      <div id="productCardsBorrowed">
      <?php
// Fetch the borrowed products for the current user
$stmt = $pdo->prepare("SELECT r.*, p.product_title, p.product_cover_image FROM borrowing_op r
                        INNER JOIN products p ON r.product_id = p.product_id
                        WHERE r.member_id = ?");
$stmt->execute(array($_SESSION['member_id']));
$borrowedProducts = $stmt->fetchAll();
// Assume the borrowed product details are stored in $borrowedProducts array
foreach ($borrowedProducts as $borrowedProduct) {
?>
  <div class="productProfile">
    <div><img src="<?php echo $borrowedProduct['product_cover_image']; ?>" alt="product"></div>
    <div>
      <p><?php echo $borrowedProduct['product_title']; ?></p>
      <p><b><?php echo date('Y/m/d - h:i A', strtotime($borrowedProduct['borrowing_return_date'])); ?></b></p>
    </div>
  </div>
<?php } ?>
        </div>
    </section>
    <footer>
      <p> Copyright © 2023  All Rights Reserved. - Bassam Salik</p>
     </footer>
     <script src="./js/profile.js"></script>
</body>


