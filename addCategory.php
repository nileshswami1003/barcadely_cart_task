<?php
session_start();
include 'config/db.php'; // Include your database connection file

header('Content-Type: application/json'); // Set the content type to JSON

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Check if the user is logged in and has the role of an admin (add more security checks if needed)
    if (isset($_SESSION['user_id']) && isset($_SESSION['user_role']) && $_SESSION['user_role'] === '2') {
        // Retrieve form data
        $categoryName = strtoupper($_POST['cname']); // Convert to uppercase
        $categoryDesc = $_POST['cdesc'];
        $categoryStatus = $_POST['sbxCat'];

        // Validate form data if needed

        // Add the new category to the database
        $addCategoryQuery = "INSERT INTO product_categories (cat_name, cat_desc, cat_status) VALUES (?, ?, ?)";
        
        $stmt = $conn->prepare($addCategoryQuery);
        $stmt->bind_param("ssi", $categoryName, $categoryDesc, $categoryStatus);

        if ($stmt->execute()) {
            $response = [
                'success' => true,
                'message' => 'Category added successfully'
            ];
        } else {
            $response = [
                'success' => false,
                'message' => 'Error adding category to the database'
            ];
        }

        $stmt->close();
        $conn->close();

        echo json_encode($response); // Send the response back to the AJAX request as JSON
    } else {
        // User is not authorized to add a category
        $response = [
            'success' => false,
            'message' => 'Unauthorized access'
        ];
        
        echo json_encode($response); // Send the response back to the AJAX request as JSON
    }
} else {
    // Invalid request method
    $response = [
        'success' => false,
        'message' => 'Invalid request method'
    ];

    echo json_encode($response); // Send the response back to the AJAX request as JSON
}
?>
