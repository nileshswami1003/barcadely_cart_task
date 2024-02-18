<?php

// Include your database connection code
include 'config/db.php'; // Create a file (e.g., db_connection.php) with your database connection code

// Fetch all product data from the database
$sql = "SELECT products.*, product_categories.cat_name
FROM products
INNER JOIN product_categories ON products.prod_cat = product_categories.cat_id";
$result = $conn->query($sql);

// Check if there are any products
if ($result->num_rows > 0) {
    $products = array();

    // Fetch data and store it in an array
    while ($row = $result->fetch_assoc()) {
        $products[] = $row;
    }

    // Close the database connection
    $conn->close();

    // Send the products data as JSON
    header('Content-Type: application/json');
    echo json_encode($products);
} else {
    // No products found
    echo json_encode(array('message' => 'No products found'));
}

?>
