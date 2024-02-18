<?php
include 'config/db.php'; // Include your database connection file

header('Content-Type: application/json'); // Set the content type to JSON

// Fetch all categories
$getCategoriesQuery = "SELECT * FROM product_categories";
$result = $conn->query($getCategoriesQuery);

if ($result) {
    $categories = [];
    while ($row = $result->fetch_assoc()) {
        $categories[] = [
            'cat_id' => $row['cat_id'],
            'cat_name' => $row['cat_name'],
            'cat_desc' => $row['cat_desc'],
            'cat_status' => $row['cat_status']
        ];
    }

    $response = [
        'success' => true,
        'categories' => $categories
    ];

    echo json_encode($response);
} else {
    $response = [
        'success' => false,
        'message' => 'Error fetching categories'
    ];

    echo json_encode($response);
}

$conn->close();
?>
