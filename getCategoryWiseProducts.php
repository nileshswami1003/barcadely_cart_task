<?php
// Include your database connection code
include 'config/db.php';

// Check if the category_name is provided in the GET request
if (isset($_GET['category_name']) && $_GET['category_name'] !== "ALL") {
    $category_name = $_GET['category_name'];

    // Fetch products based on the selected category name
    $sql = "SELECT p.*
    FROM products p
    JOIN product_categories c ON p.prod_cat = c.cat_id
    WHERE c.cat_name = '$category_name'";
    $result = $conn->query($sql);

    $products = array();

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $products[] = $row;
        }
    }

    // Return products as JSON
    echo json_encode($products);
} else if($_GET['category_name'] == "ALL"){

    // $category_name = $_GET['category_name'];

    // Fetch products based on the selected category name
    $sql = "SELECT * FROM products";
    $result = $conn->query($sql);

    $products = array();

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $products[] = $row;
        }
    }

    // Return products as JSON
    echo json_encode($products);

} else {
    // No category_name provided in the GET request
    echo json_encode(array('error' => 'No Category provided'));
}
?>
