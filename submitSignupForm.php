<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Include your database connection file
    include 'config/db.php';

    // Retrieve form data
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $email = $_POST['email'];
    $cpass = $_POST['cpass'];

    // Validate form data (add additional validation if needed)
    // Check if the email already exists
    $checkEmailQuery = "SELECT * FROM users WHERE user_email = '$email'";
    $result = $conn->query($checkEmailQuery);
    if ($result->num_rows > 0) {
        // Email already exists, return an error
        $response = [
            'success' => false,
            'message' => 'Email already exists. Please choose a different email.'
        ];
    } else {

        // Insert data into the database
        $query = "INSERT INTO users (user_fname, user_lname, user_email, user_pass) VALUES ('$fname', '$lname', '$email', '$cpass')";

        if ($conn->query($query) === TRUE) {
            $response = [
                'success' => true,
                'message' => 'Signup successful!'
            ];
        } else {
            $response = [
                'success' => false,
                'message' => 'Error: ' . $query . '<br>' . $conn->error
            ];
        }

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
