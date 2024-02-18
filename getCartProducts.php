<?php
// Assume you have a session started where the cart information is stored
session_start();
include 'config/db.php'; // Create a file (e.g., db_connection.php) with your database connection code


// Fetch products from the database based on the product IDs in the cart
$cartProductIds = array_keys($_SESSION['cart']); // Assuming the cart is stored in the session
$cartProductIdsStr = implode(',', $cartProductIds);

// Example SQL query (replace with your actual query)
$sql = "SELECT * FROM products WHERE prod_id IN ($cartProductIdsStr)";

$result = $conn->query($sql);

$products = [];
while ($row = $result->fetch_assoc()) {
    $products[] = $row;
}

// Return the products as JSON
header('Content-Type: application/json');
echo json_encode($products);

$conn->close();

?>
