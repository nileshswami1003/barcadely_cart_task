<?php

include 'config/db.php';

// Check if the request is a POST request and contains productIds
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['productIds'])) {
    $productIds = $_POST['productIds'];


    // Use prepared statement to prevent SQL injection
    $placeholders = implode(',', array_fill(0, count($productIds), '?'));
    $sql = "SELECT * FROM products WHERE prod_id IN ($placeholders)";

    // Prepare the statement
    $stmt = $conn->prepare($sql);

    // Bind parameters
    $types = str_repeat('s', count($productIds)); // Assuming product_id is a string; adjust if needed
    $stmt->bind_param($types, ...$productIds);

    // Execute the query
    $stmt->execute();

    // Get result
    $result = $stmt->get_result();

    // Fetch product details
    $productDetails = $result->fetch_all(MYSQLI_ASSOC);

    // Simulate a delay to mimic server processing
    usleep(500000); // 500ms delay

    // Send the JSON response
    header('Content-Type: application/json');
    echo json_encode($productDetails);
} else {
    // Invalid request, return an error or handle accordingly
    http_response_code(400);
    echo json_encode(['error' => 'Invalid request']);
}

// Close the connection
$conn->close();

?>