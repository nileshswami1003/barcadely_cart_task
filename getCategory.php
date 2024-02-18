<?php
include 'config/db.php'; // Include your database connection file

if (isset($_GET['categoryId'])) {
    $categoryId = $_GET['categoryId'];

    $query = "SELECT * FROM product_categories WHERE cat_id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $categoryId);
    $stmt->execute();

    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $category = $result->fetch_assoc();
        header('Content-Type: application/json');
        echo json_encode($category);
    } else {
        header('Content-Type: application/json');
        echo json_encode(['error' => 'Category not found']);
    }

    $stmt->close();
} else {
    header('Content-Type: application/json');
    echo json_encode(['error' => 'Invalid request']);
}
?>
