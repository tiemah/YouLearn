<?php
// Include the database connection
require_once "conn.php";

// Check if the form is submitted
if(isset($_POST['discard'])){
    // Sanitize user input
    $course_code = mysqli_real_escape_string($conn, $_POST['course_code']);
    $course = mysqli_real_escape_string($conn, $_POST['course']);
    $course_description = mysqli_real_escape_string($conn, $_POST['course_description']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);

    // Check if the enrollment record exists
    $check_query = mysqli_query($conn, "SELECT * FROM enrollment WHERE email = '$email' AND course = '$course'");
    $enrollment_exists = mysqli_num_rows($check_query) > 0;

    // Initialize $delete_query variable
    $delete_query = false;

    // If the enrollment record exists, delete it from the database
    if($enrollment_exists){
        // Delete the enrollment record from the database
        $delete_query = mysqli_query($conn, "DELETE FROM enrollment WHERE email = '$email' AND course = '$course'");

        // Check for errors in the delete query
        if(!$delete_query){
            // Display error message and exit
            die('Error: ' . mysqli_error($conn));
        }
    }

    // Check if the deletion was successful
    if($delete_query){
        ?>
        <!-- SweetAlert link -->
        <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script> 
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                swal("Good job!", "Course dropped successfully!", "success").then(() => {
                    window.location.href = "view-courses.php"; // Redirect to enrollment page after displaying success alert
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
                swal("Oops!", "Failed to drop the course. Please try again", "warning").then(() => {
                    window.location.href = "view-courses.php"; // Redirect to courses page after displaying warning alert
                });
            });
        </script>
        <?php
    }
}
?>
