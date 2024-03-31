<?php
require "conn.php";

if(isset($_POST['enroll'])){
    // Sanitize user input
    $course_code = mysqli_real_escape_string($conn, $_POST['course_code']);
    $course = mysqli_real_escape_string($conn, $_POST['course']);
    $course_description = mysqli_real_escape_string($conn, $_POST['course_description']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);

    // Check if the user is already enrolled for the course
    $check_query = mysqli_query($conn, "SELECT * FROM enrollment WHERE email = '$email' AND course = '$course'");
    $enrollment_exists = mysqli_num_rows($check_query) > 0;

    if($enrollment_exists){
        // If the user is already enrolled, notify them and prevent enrollment
        ?>
        <!-- SweetAlert link -->
        <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script> 
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                swal("Oops!", "You have already enrolled for this course.", "warning").then(() => {
                    window.location.href = "enrollment.php"; // Redirect to enrollment page after displaying warning alert
                });
            });
        </script>
        <?php
    } else {
        // If the user is not already enrolled, proceed with enrollment
        $query = mysqli_query($conn, "INSERT INTO enrollment (course_code, course, course_description, email) VALUES ('$course_code', '$course', '$course_description', '$email')");

        // Check if the query was successful
        if($query){
            ?>
            <!-- SweetAlert link -->
            <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script> 
            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    swal("Good job!", "Enrolled successfully!", "success").then(() => {
                        window.location.href = "enrollment.php"; // Redirect to enrollment page after displaying success alert
                    });
                });
            </script>
            <?php
        } else {
            // Display error message if the query fails
            ?>
            <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script> 
            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    swal("Oops!", "Failed to enroll. Please try again later.", "error").then(() => {
                        window.location.href = "enrollment.php"; // Redirect to enrollment page after displaying error alert
                    });
                });
            </script>
            <?php
        }
    }
}
?>