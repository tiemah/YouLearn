<?php
// Include necessary files and start session
session_start();
require_once "conn.php";

// Check if the user is logged in
if (!isset($_SESSION['login'])) {
    header("Location: login.php");
    exit;
}

// Check if form is submitted and course code is provided
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['course_code'])) {
    // Retrieve form data
    $course_code = $_POST['course_code'];
    $course_name = $_POST['course_name'];
    $course_description = $_POST['course_description'];

    // Update course details in the database
    $query = "UPDATE courses SET course_name = '$course_name', course_description = '$course_description' WHERE course_code = '$course_code'";
    $result = mysqli_query($conn, $query);

    if ($result) {
        // Course details updated successfully
        $_SESSION['success_msg'] = "Course details updated successfully.";
    } else {
        // Error occurred while updating course details
        $_SESSION['error_msg'] = "Failed to update course details. Please try again.";
    }
} else {
    // Redirect if form is not submitted or course code is not provided
    header("Location: manage-courses.php");
    exit;
}

// Redirect back to the manage-courses.php page
header("Location: manage-courses.php");
exit;
?>
