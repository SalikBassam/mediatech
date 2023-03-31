<?php
require "dbconnect.php";

if (isset($_POST['delete'])) {
    $productId = $_POST['delete'];
   
       // Delete the related rows in the reservation_op table first
       $stmt = $pdo->prepare('DELETE FROM reservation_op WHERE product_id = ?');
       $stmt->execute([$productId]);
        

    // Delete the related rows in the borrowing_op table first
    $stmt = $pdo->prepare('DELETE FROM borrowing_op WHERE product_id = ?');
    $stmt->execute([$productId]);
    
    // Delete the product from the products table
    $stmt = $pdo->prepare('DELETE FROM products WHERE product_id = ?');
    $stmt->execute([$productId]);
    
    // Redirect the user to the products page after deletion
    header('Location: adminMData.php');
    exit;
}
?>