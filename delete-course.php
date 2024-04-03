<?php
// delete-course.php

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['course_code'])) {
    // Include your database connection file
    require_once "conn.php";
    
    // Get the course code from the form data
    $course_code = $_POST['course_code'];

    // Perform the deletion query
    $delete_query = mysqli_query($conn, "DELETE FROM courses WHERE course_code = '$course_code'");
    
    // Check if the deletion was successful
    if($delete_query){
        ?>
        <!-- SweetAlert link -->
        <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script> 
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                swal("Good job!", "Course deleted successfully!", "success").then(() => {
                    window.location.href = "manage-courses.php"; // Redirect to manage courses page after displaying success alert
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
                swal("Oops!", "Failed to delete the course. Please try again", "warning").then(() => {
                    window.location.href = "manage-courses.php"; // Redirect to manage courses page after displaying warning alert
                });
            });
        </script>
        <?php
    }
}
?>
