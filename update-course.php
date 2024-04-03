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
                    ?>
            <!-- SweetAlert link -->
            <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script> 
            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    swal("Good job!", "Changes updated successfully!", "success").then(() => {
                        window.location.href = "manage-courses.php"; // Redirect to enrollment page after displaying success alert
                    });
                });
            </script>
            <?php
        } else {
            ?>
            <!-- SweetAlert link -->
            <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script> 
            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    swal("Oops!", "Failed to change the course. Please try again", "warning").then(() => {
                        window.location.href = "manage-courses.php"; // Redirect to courses page after displaying warning alert
                    });
                });
            </script>
            <?php
        }
    }



?>
