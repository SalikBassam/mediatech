<?php
require "dbconnect.php";


if (isset($_POST['delete'])) {
    $productId = $_POST['delete'];
    $stmt = $pdo->prepare('DELETE FROM products WHERE product_id = ?');
    $stmt->execute([$productId]);
    // Redirect the user to the products page after deletion
    header('Location: adminMData.php');
    exit;
}
?>