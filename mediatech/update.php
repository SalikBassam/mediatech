<?php
require "dbconnect.php";

echo "Product ID: " . $_POST['product_id'] . "<br>";
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  // Retrieve the form data
  $product_id = $_POST['product_id'];
  $product_title = $_POST['product_title'];
  $product_author = $_POST['product_author'];
  $langue = $_POST['langue'];
  $description = $_POST['description'];
  $numPages = $_POST['numPages'];
  $product_condition = $_POST['product_condition'];
  $product_type = $_POST['product_type'];
  $image_path = "./images/" . $_FILES['product_cover_image']['name'];

  // Save the uploaded image to a directory on the server
  if(isset($_FILES['product_cover_image']) && $_FILES['product_cover_image']['error'] == 0){
    // Save the uploaded image to a directory on the server
    move_uploaded_file($_FILES['product_cover_image']['tmp_name'], $image_path);
  }
  // Check if the product ID exists in the database
  $stmt = $pdo->prepare('SELECT * FROM products WHERE product_id = ?');
  $stmt->execute([$product_id]);
  $product = $stmt->fetch();

  if (!$product) {
    // Product not found, show an error message or redirect to an error page
    die('Product not found');
  }

  // Update the product in the database
  $stmt = $pdo->prepare('UPDATE products SET product_title = ?, product_author = ?, langue = ?, description = ?, numPages = ?, product_condition = ?, product_type = ?, product_cover_image=? WHERE product_id = ?');
  $stmt->execute([$product_title, $product_author, $langue, $description, $numPages, $product_condition, $product_type,$image_path, $product_id]);

  // Check if the update was successful
  if ($stmt->rowCount() > 0) {
    echo 'Product updated successfully';
    header("Location: adminMdata.php");
  } else {
    // Update failed, show an error message or redirect to an error page
    echo 'Failed to update product';
  }
}

?>