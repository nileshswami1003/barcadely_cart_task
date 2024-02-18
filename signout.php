<?php
session_start();

// Destroy the session
session_destroy();

// Redirect to the login page with a logout message
header('Location: signin.php?message=' . urlencode('You have been successfully signed out.'));
exit();
?>
