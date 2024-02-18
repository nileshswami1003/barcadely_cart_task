<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Include your database connection file
    include 'config/db.php';

    // Retrieve form data
    $email = $_POST['email'];
    $pass = $_POST['pass'];

    // Validate form data (add additional validation if needed)

    // Check if the user exists
    $checkUserQuery = "SELECT * FROM users WHERE user_email = '$email' AND user_pass = '$pass'";
    $result = $conn->query($checkUserQuery);

    if ($result->num_rows > 0) {
        // User exists, login successful
        $user = $result->fetch_assoc();

        // Store user information in session
        $_SESSION['user_id'] = $user['user_id'];
        $_SESSION['user_email'] = $user['user_email'];
        $_SESSION['user_role'] = $user['user_role'];

        $response = [
            'success' => true,
            'message' => 'Signin successful',
            'role' => $user['user_role'] // Include the user's role in the response
        ];

    } else {
        // User does not exist or invalid credentials
        $response = [
            'success' => false,
            'message' => 'Invalid email or password'
        ];
    }

    // Close the database connection
    $conn->close();

    // Send response back to the AJAX request as JSON
    header('Content-Type: application/json');
    echo json_encode($response);

} else {
    // Redirect or handle other types of requests (GET, etc.)
    $response = [
        'success' => false,
        'message' => 'Invalid request method'
    ];

    header('Content-Type: application/json');
    echo json_encode($response);
}
?>
