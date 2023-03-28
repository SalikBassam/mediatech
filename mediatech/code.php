<?php
session_start(); // Start session for storing user information

require './dbconnect.php'; // Include file for database connection

// Sign up form submission
if(isset($_POST['signup_submit'])){
  // Get user input values from form
  $name = $_POST['Name'];
  $address = $_POST['Address'];
  $email = $_POST['Email'];
  $phone = $_POST['Phone'];
  $cin = $_POST['CIN'];
  $dob = $_POST['BirthDate'];
  $username = $_POST['username2'];
  $password = $_POST['password2'];

  // Check if email, CIN, or username already exists in the database
  $stmt = $pdo->prepare("SELECT * FROM members WHERE member_email = :email OR member_cin = :cin OR member_nickname = :username");
  $stmt->bindParam(':email', $email);
  $stmt->bindParam(':cin', $cin);
  $stmt->bindParam(':username', $username);
  $stmt->execute();

  // If any of them already exists, display an error message and stop execution
  if($stmt->rowCount() > 0){
      $error_message2 = 'The email, CIN, or username already exists.<br> Please use a different one or try to SingIn.';
  } else {
      // Hash password before storing it in the database
      $hashed_password = password_hash($password, PASSWORD_DEFAULT);

      // Prepare SQL statement for inserting new member data
      $stmt = $pdo->prepare("INSERT INTO members (member_name, member_address, member_email, member_phone, member_cin, member_dob, member_type, member_nickname, member_password, member_account_date)
      VALUES (:name, :address, :email, :phone, :cin, :dob, 'user', :username, :password, NOW())");

      // Bind parameters to the statement
      $stmt->bindParam(':name', $name);
      $stmt->bindParam(':address', $address);
      $stmt->bindParam(':email', $email);
      $stmt->bindParam(':phone', $phone);
      $stmt->bindParam(':cin', $cin);
      $stmt->bindParam(':dob', $dob);
      $stmt->bindParam(':username', $username);
      $stmt->bindParam(':password', $hashed_password);

      // Execute statement and check for errors
      if($stmt->execute()){
          // Redirect to login page if sign up is successful
          $success_message = "You signup successfully!";
      } else {
          // Display error message if sign up fails
          $error_message = 'Failed to sign up. Please try again.';
      }
  }
}

// Login form submission
if(isset($_POST['login_submit'])){
  $username = $_POST['username'];
  $password = $_POST['password'];

  // Prepare SQL statement for selecting member data
  $stmt = $pdo->prepare("SELECT * FROM members WHERE member_nickname = :username");

  // Bind parameters to the statement
  $stmt->bindParam(':username', $username);

  // Execute statement and check for errors
  if($stmt->execute()){
    // Fetch member data from the database
    $member = $stmt->fetch();

    if($member && password_verify($password, $member['member_password'])) {
      $_SESSION['member_id'] = $member['member_id'];
      $_SESSION['member_name'] = $member['member_name'];
      $_SESSION['member_type'] = $member['member_type'];

      // Check if member is admin and redirect accordingly
      if($member['member_admin'] == "yes") {
        header('Location: admin.php');
        exit();
      } else {
        header('Location: iindex.php');
        exit();
      }
    } else {
      // Prepare SQL statement for selecting admin data
      $admin_stmt = $pdo->prepare("SELECT * FROM admins WHERE admin_username = :username");

      // Bind parameters to the statement
      $admin_stmt->bindParam(':username', $username);

      // Execute statement and check for errors
      if($admin_stmt->execute()){
        // Fetch admin data from the database
        $admin = $admin_stmt->fetch();

        if($admin && password_verify($password, $admin['admin_password'])) {
          $_SESSION['admin_id'] = $admin['admin_id'];
          $_SESSION['admin_full_name'] = $admin['admin_full_name'];
          header('Location: admin.php');
          exit();
        } else {
          // Display error message if login fails
          $error_message = 'Invalid username or password. Please try again.';
        }
      }
    }
  }
}
?>


         
