
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


<body>
<header>
        <nav>
        <div id="logo"><a href="iindex.php"><img src="./images/logo.png" alt="logo" width="80px"></a></div>
        <div>
          <div class="profileInfo">
            <form action="" method="post">
              <div class="imgPf">
              <p><b><?= $member['member_nickname'];?></b></p>
              <img src="./images/profile.jpg" alt="profile" class="profile" data-bs-toggle="dropdown" aria-expanded="false">
            <ul class="dropdown-menu">
              <li><a class="dropdown-item" href="profile.php">View Profile</a></li>
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
  