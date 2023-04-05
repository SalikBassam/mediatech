<?php 
ob_start(); // start output buffering
require '../dbconnect.php'; // Include file for database connection

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
    <link rel="stylesheet" href="../css/adminMusers.css" />
    <link rel="stylesheet" href="../css/style.css">
    <!-- end css file -->
    <!-- font awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-X9z+0H56JbhTzSjge0w+O/YtwBQ/2cR70Muh+8W/hXwhOdtzj3qJNzwweJYRZfxuwbtCu+bUGIwKInDZp/NnLg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Mediatech</title>
  </head>
<body>
<?php
include "header_admin.php";

?>













    <section id="section2">
            <div id="lineParent">
        <h1>History</h1>
        <hr class="line">
    </div>
        <ul>
            <li class="opt reservations active">Resevations</li>
            <li class="opt borrowed">Borrowed</li>
          </ul>
    </section>
    <div class="tableParent">
    <?php
// Get the search query from the URL parameter
$searchValue = isset($_GET['searchUsers']) ? $_GET['searchUsers'] : '';

if ($searchValue == '') {
    // Query the members table
    $sql = "SELECT * FROM members";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    $members = $stmt->fetchAll(PDO::FETCH_ASSOC);
} else {
    // prepare a statement to search for users
    $stmt = $pdo->prepare("SELECT * FROM members WHERE member_name LIKE :search");
    $stmt->execute([':search' => '%' . $searchValue . '%']);
    // fetch all the results into an array
    $members = $stmt->fetchAll(PDO::FETCH_ASSOC);
}
?>
<form action="archive.php" method="get" id="userstb">
  <input type="text" placeholder="Find a user" id="searchUsers" name="searchUsers">
  <button type="submit" id="searchUserslab" name="submit">Search</button>
</form>


<table class="table table-light table-center text-center m-auto" id="reservations">
        <thead class="table-dark ">
    <tr>
      <th scope="col">#</th>
      <th scope="col">Full name</th>
      <th scope="col">Book Id</th>
      <th scope="col">Book Name</th>
      <th scope="col">Date of reservation</th>
    </tr>
  </thead>
  <tbody>
  <?php
$searchValue = isset($_GET['searchUsers']) ? $_GET['searchUsers'] : '';

// Build the SQL query
$sql = "SELECT * FROM reservation_op INNER JOIN members ON reservation_op.member_id = members.member_id INNER JOIN products ON reservation_op.product_id = products.product_id";
if (!empty($searchValue)) {
    $sql .= " WHERE member_name LIKE :search OR product_title LIKE :search";
}

// Prepare the statement and execute it
$stmt = $pdo->prepare($sql);
if (!empty($searchValue)) {
    $stmt->bindValue(':search', '%' . $searchValue . '%');
}
$stmt->execute();
$reservations = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Display the reservations in the table
foreach ($reservations as $reservation) {
      echo '<tr>';
      echo '<th scope="row">' . $reservation['reservation_id'] . '</th>';
      echo '<td>' . $reservation['member_name'] . '</td>';
      echo '<td>' . $reservation['product_id'] . '</td>';
      echo '<td>' . $reservation['product_title'] . '</td>';
      echo '<td>' . $reservation['reservation_date'] . '</td>';
      echo '</tr>';
    }
?>
  </tbody>
</table>




<table class="table table-light table-center text-center m-auto" id="borrowed">
  <thead class="table-dark ">
    <tr>
      <th scope="col">#</th>
      <th scope="col">Full name</th>
      <th scope="col">Book Id</th>
      <th scope="col">Book Name</th>
      <th scope="col">Borrowing Date</th>
      <th scope="col">Returning Date</th>
    </tr>
  </thead>
  <tbody>
 <tbody>
  <?php
  // Get the search query from the URL parameter
  $searchValue = isset($_GET['searchUsers']) ? $_GET['searchUsers'] : '';
  
  // modify the SQL query based on the search value
  if ($searchValue == '') {
      // Query the borrowing_op table
      $sql = "SELECT b.borrowing_id, m.member_name, p.product_id, p.product_title, b.borrowing_date, b.borrowing_return_date
      FROM borrowing_op b
      INNER JOIN members m ON b.member_id = m.member_id
      INNER JOIN products p ON b.product_id = p.product_id";
      $stmt = $pdo->prepare($sql);
      $stmt->execute();
  } else {
      // prepare a statement to search for borrowing records
      $sql = "SELECT b.borrowing_id, m.member_name, p.product_id, p.product_title, b.borrowing_date, b.borrowing_return_date
      FROM borrowing_op b
      INNER JOIN members m ON b.member_id = m.member_id
      INNER JOIN products p ON b.product_id = p.product_id
      WHERE m.member_name LIKE :search";
      $stmt = $pdo->prepare($sql);
      $stmt->execute([':search' => '%' . $searchValue . '%']);
  }
  $i = 1;
  while ($row = $stmt->fetch()) {
    echo "<tr>";
    echo "<th scope='row'>$i</th>";
    echo "<td>{$row['member_name']}</td>";
    echo "<td>{$row['product_id']}</td>";
    echo "<td>{$row['product_title']}</td>";
    echo "<td>{$row['borrowing_date']}</td>";
    echo "<td>{$row['borrowing_return_date']}</td>";
    echo "<td>";
    echo "</td>";
    echo "</tr>";
    $i++;
  }

  if (isset($_POST['confirm_bor'])) {
    $borrowing_id = $_POST['borrowing_id'];
    // Get the selected row from the borrowing_op table
    $stmt = $pdo->prepare("SELECT * FROM borrowing_op WHERE borrowing_id = ?");
    $stmt->execute([$borrowing_id]);
    $borrowing = $stmt->fetch();

    // Update the product_status to "none"
    $stmt = $pdo->prepare("UPDATE products SET product_status = 'none' WHERE product_id = ?");
    $stmt->execute([$borrowing['product_id']]);

    // Delete the selected row from the borrowing_op table
    $stmt = $pdo->prepare("DELETE FROM borrowing_op WHERE borrowing_id = ?");
    $stmt->execute([$borrowing_id]);

    // Redirect back to the current page
    header("Location: {$_SERVER["PHP_SELF"]}");
    exit();
  }
  ob_end_flush(); // flush output buffer and send output to browser

?>


  </tbody>
</table>
    </div>
      <footer>
        <p> Copyright © 2023  All Rights Reserved. - Bassam Salik</p>
       </footer>
       <script src="../js/archive.js"></script>
</body>