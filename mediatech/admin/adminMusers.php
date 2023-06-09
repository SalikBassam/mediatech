<?php 
ob_start(); // start output buffering
require '../dbconnect.php'; // Include file for database connection

//Cancel a reservation if it has expired
$stmt = $pdo->prepare("UPDATE reservation_op SET reservation_status = 'off' WHERE DATE(NOW()) >= DATE(reservation_expiry_date)");
 $stmt->execute();




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
echo DATE('y-m-d h:i:s');
?>













    <section id="section2">
            <div id="lineParent">
        <h1>All Informations</h1>
        <hr class="line">
    </div>
        <ul>
            <li class="opt users active">Users</li>
            <li class="opt reservations">Resevations</li>
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
<form action="adminMusers.php" method="get" id="userstb">
  <input type="text" placeholder="Find a user" id="searchUsers" name="searchUsers">
  <button type="submit" id="searchUserslab" name="submit">Search</button>
</form>
<table class="table table-light table-center text-center m-auto" id="users">
  <thead class="table-dark ">
    <tr>
      <th scope="col">#</th>
      <th scope="col">Full name</th>
      <th scope="col">CIN</th>
      <th scope="col">Address</th>
      <th scope="col">Phone N°</th>
      <th scope="col">Email</th>
      <th scope="col">Penalties</th>
      <th scope="col">Administration</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($members as $member): ?>
      <tr>
        <th scope="row"><?= $member['member_id'] ?></th>
        <td><?= $member['member_name'] ?></td>
        <td><?= $member['member_cin'] ?></td>
        <td><?= $member['member_address'] ?></td>
        <td><?= $member['member_phone'] ?></td>
        <td><?= $member['member_email'] ?></td>
        <td><?= $member['member_penalties'] ?></td>
        <td>
  <form action="adminMusers.php" method="post">
    <input type="hidden" name="member_id" value="<?php echo $member['member_id']; ?>">
    <select name="admin" id="admin">
      <option value="no" <?php if ($member['member_admin'] === 'no') echo 'selected'; ?>>No</option>
      <option value="yes" <?php if ($member['member_admin'] === 'yes') echo 'selected'; ?>>Yes</option>
    </select>
    <button type="submit" name="submit">Confirm</button>
  </form>
  <?php
if (isset($_POST['submit'])) {
  $admin = $_POST['admin'];
  $member_id = $_POST['member_id'];

  $sql = "UPDATE members SET member_admin = :admin WHERE member_id = :member_id";
  $stmt = $pdo->prepare($sql);
  $stmt->bindValue(':admin', $admin);
  $stmt->bindValue(':member_id', $member_id);
  $stmt->execute();

  header("Location: adminMusers.php"); // Redirect to members page after updating the database
  exit();
}   ?>


  
</td>
      </tr>
    <?php endforeach; ?>
  </tbody>
</table>


<table class="table table-light table-center text-center m-auto" id="reservations">
        <thead class="table-dark ">
    <tr>
      <th scope="col">#</th>
      <th scope="col">Full name</th>
      <th scope="col">Book Id</th>
      <th scope="col">Book Name</th>
      <th scope="col">Date of reservation</th>
      <th scope="col">Confirmation</th>
    </tr>
  </thead>
  <tbody>
  <?php
$searchValue = isset($_GET['searchUsers']) ? $_GET['searchUsers'] : '';

// Build the SQL query
$sql = "SELECT * FROM reservation_op INNER JOIN members ON reservation_op.member_id = members.member_id INNER JOIN products ON reservation_op.product_id = products.product_id WHERE reservation_status='on'";
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
      echo '<td><form action="adminMusers.php" method="post"><input type="hidden" name="reservation_id" value="' . $reservation['reservation_id'] . '"><button type="submit" name="confirm_res">Confirm</button></form></td>';
      echo '</tr>';
    }

if (isset($_POST['confirm_res'])) {
  $reservation_id = $_POST['reservation_id'];

  // Get the selected row from the reservations table
  $stmt = $pdo->prepare("SELECT * FROM reservation_op WHERE reservation_id = ?");
  $stmt->execute([$reservation_id]);
  $reservation = $stmt->fetch();

  $stmt = $pdo->prepare("INSERT INTO borrowing_op (product_id, member_id, borrowing_date, borrowing_return_date) VALUES (?, ?, ?, ?)");
  $stmt->execute([$reservation['product_id'], $reservation['member_id'], date('Y-m-d H:i:s'), date('Y-m-d H:i:s', strtotime('+15 days'))]);  

  // Update the product_status to "Borrowed"
  $stmt = $pdo->prepare("UPDATE products SET product_status = 'Borrowed' WHERE product_id = ?");
  $stmt->execute([$reservation['product_id']]);

  // update the selected row from the reservation_op table
  $stmt = $pdo->prepare("UPDATE reservation_op SET reservation_status='off' WHERE reservation_id = ?");
  $stmt->execute([$reservation_id]);

  // Redirect back to the reservations page
  header("Location: adminMusers.php");
  exit();
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
      <th scope="col">Confirmation</th>
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
      INNER JOIN products p ON b.product_id = p.product_id
      WHERE borrowing_status='on'";
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
    echo "<form action='{$_SERVER["PHP_SELF"]}' method='POST'>";
    echo "<input type='hidden' name='borrowing_id' value='{$row['borrowing_id']}'>";
    echo "<button type='submit' name='confirm_bor'>Confirm</button>";
    echo "</form>";
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

    // update the selected row from the borrowing_op table and date
    $stmt = $pdo->prepare("UPDATE borrowing_op SET borrowing_status='off',actual_return_date=NOW() WHERE borrowing_id = ?");
    $stmt->execute([$borrowing_id]);

//count the penalties
$stmt = $pdo->prepare("UPDATE borrowing_op
JOIN members ON borrowing_op.member_id = members.member_id
SET members.member_penalties = members.member_penalties + 1
WHERE DATE(NOW()) >= DATE(borrowing_op.borrowing_return_date);

");
$stmt->execute();



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
       <script src="../js/adminMusers.js"></script>
</body>