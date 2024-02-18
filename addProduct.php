<?php
include 'config/db.php'; // Create a file (e.g., db_connection.php) with your database connection code

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Get form data
    $productName = $_POST['pname'];
    $categoryId = $_POST['sbxCat'];
    $productPrice = $_POST['pprice'];

    // File upload handling (if needed)
    $targetDirectory = "uploads/"; // Specify your upload directory
    $updatedFileName = $_POST['updatedFileName']; // Retrieve the updated file name from the hidden input field
    $targetFile = $targetDirectory . basename($updatedFileName);

    if (move_uploaded_file($_FILES['pimage']['tmp_name'], $targetFile)) {
        // File uploaded successfully
        // Insert data into the database
        $sql = "INSERT INTO products (prod_name, prod_price, prod_cat, prod_img) VALUES (?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sdis", $productName, $productPrice, $categoryId,$updatedFileName);
        
        if ($stmt->execute()) {
            // Data inserted successfully
            $response = array('status' => 'success', 'message' => 'Product added successfully');
        } else {
            // Error in inserting data
            $response = array('status' => 'error', 'message' => 'Error adding product');
        }

        $stmt->close();
    } else {
        // File upload failed
        $response = array('status' => 'error', 'message' => 'Error uploading product image');
    }

    // Close database connection
    $conn->close();

    // Send JSON response
    header('Content-Type: application/json');
    echo json_encode($response);
} else {
    // Invalid request method
    header('HTTP/1.1 400 Bad Request');
    echo 'Invalid request method';
}

?>
