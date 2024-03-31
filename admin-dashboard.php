<?php
// Start session if not already started
session_start();

// Check if user is logged in and has admin role
if (!isset($_SESSION['user_role']) || $_SESSION['user_role'] !== 'administrator') {
    // Redirect user to another page or display an access denied message
    header("Location: access_denied.php");
    exit(); // Stop further execution
}

// Continue rendering the page content for admins
?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin Page</title>
</head>
<body>
    <h1>Welcome, Admin!</h1>
    <!-- Admin-only content here -->
</body>
</html>