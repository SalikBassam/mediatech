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
    <link rel="stylesheet" href="./css/logingSignup.css" />
    <link rel="stylesheet" href="./css/style.css">
    <!-- end css file -->
    <!-- font awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-X9z+0H56JbhTzSjge0w+O/YtwBQ/2cR70Muh+8W/hXwhOdtzj3qJNzwweJYRZfxuwbtCu+bUGIwKInDZp/NnLg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Mediatech</title>
  </head>
<body>

  <div class="login-block">
  <?php if(isset($success_message)): ?>
        <p class="success"><?php echo $success_message; ?></p>
    <?php endif; ?>
    <form action="" method="post">
    <h1>Login To our Library</h1>
    <img src="./images/user-solid.svg" class="icon" style="width:15px;"><input type="text" value="" placeholder="Username" name="username" id="username" />
    <p class="error" id="usernameError"></p>
    <img src="./images/key-solid.svg" class="icon" style="width:15px;"><input type="password" value="" placeholder="Password" name="password" id="password" /><img src="./images/eye-slash-solid.svg" class="eye" style="width:15px;" onclick="togglePasswordVisibility2()">
    <p class="error" id="passwordError"></p>
    <p>You don't have an account ? <span class="gotosignup" onclick="toggleSignup()">Signup Now</span></p>
    <?php if(isset($error_message)): ?>
        <p class="error2"><?php echo $error_message; ?></p>
    <?php endif; ?>
    <?php if(isset($error_message2)): ?>
        <p class="error2"><?php echo $error_message2; ?></p>
    <?php endif; ?>
    <br>
    <button onclick="validateLogin()" name="login_submit">Submit</button>
    </form>
  </div>
  <form action="" method="post">
  <div class="signup-block" style="display: none;">
    <h1>Sign up To our Library</h1>
    <div class="inputOrga">
    <div>
    <input type="text" value="<?php echo isset($_POST['Name']) ? $_POST['Name'] : '' ?>" placeholder="Full Name" name="Name" id="Name" required/>
    <p class="error" id="nameError"></p>
    <input type="text" value="<?php echo isset($_POST['Address']) ? $_POST['Address'] : '' ?>" placeholder="Address" name="Address" id="Address" />
    <p class="error" id="addressError"></p>
    <input type="email" value="<?php echo isset($_POST['Email']) ? $_POST['Email'] : '' ?>" placeholder="Email" name="Email" id="Email" />
    <p class="error" id="emailError"></p>
    <input type="number" value="<?php echo isset($_POST['Phone']) ? $_POST['Phone'] : '' ?>" placeholder="Phone" name="Phone" id="Phone" />
    <p class="error" id="phoneError"></p>
    <input type="text" value="<?php echo isset($_POST['CIN']) ? $_POST['CIN'] : '' ?>" placeholder="CIN" name="CIN" id="CIN" />
    <p class="error" id="cinError"></p>
    <input type="date" value="<?php echo isset($_POST['BirthDate']) ? $_POST['BirthDate'] : '' ?>" placeholder="Birth Date" id="BirthDate" name="BirthDate" />
    <p class="error" id="birthDateError"></p>
  </div>
  <div>
    <input type="text" value="" placeholder="Username" name="username2" id="username2"/>
    <p class="error" id="usernameError2"></p>
    <input type="password" value="" placeholder="Password" name="password2" id="password2" /><img src="./images/eye-slash-solid.svg" class="eye" style="width:15px;" onclick="togglePasswordVisibility()">
    <p class="error" id="passwordError2"></p>
    <input type="password" value="" placeholder="Retry Password" name="retryPassword" id="retryPassword" />
    <p class="error" id="retryPasswordError"></p>
    <div class="termsP">
      <input type="checkbox" name="terms" id="terms">
    <label for="terms">Read these terms before you signup</label>
  </div>

</div>
</div>
    <p class="return" onclick="toggleSignup1()"></p>
    <p>You have an account ? <span class="gotologin" onclick="toggleLogin()">Login Here</span></p>
    <?php if(isset($error_message2)): ?>
        <p class="error2"><?php echo $error_message2; ?></p>
    <?php endif; ?>
    <br>
    <button onclick="validateSignup()" name="signup_submit">Submit</button>
  </div>
</form>
<script src="./js/main.js"></script>
</body>
</html>