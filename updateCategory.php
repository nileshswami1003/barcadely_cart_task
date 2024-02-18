<?php
session_start();
include 'config/db.php'; // Include your database connection file

header('Content-Type: application/json'); // Set the content type to JSON

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Check if the user is logged in and has the role of an admin (add more security checks if needed)
    if (isset($_SESSION['user_id']) && isset($_SESSION['user_role']) && $_SESSION['user_role'] === '2') {
        // Retrieve form data
        $categoryId = $_POST['categoryId'];
        $categoryName = strtoupper($_POST['cname']); // Convert to uppercase
        $categoryDesc = strtoupper($_POST['cdesc']); // Convert to uppercase
        $categoryStatus = $_POST['sbxCat'];

        // Validate form data if needed

        // Update the category in the database
        $updateCategoryQuery = "UPDATE product_categories SET cat_name = ?, cat_desc = ?, cat_status = ? WHERE cat_id = ?";
        
        $stmt = $conn->prepare($updateCategoryQuery);
        $stmt->bind_param("ssii", $categoryName, $categoryDesc, $categoryStatus, $categoryId);

        if ($stmt->execute()) {
            $response = [
                'success' => true,
                'message' => 'Category updated successfully'
            ];
        } else {
            $response = [
                'success' => false,
                'message' => 'Error updating category in the database'
            ];
        }

        $stmt->close();
        $conn->close();

        echo json_encode($response); // Send the response back to the AJAX request as JSON
    } else {
        // User is not authorized to update a category
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
