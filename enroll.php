<?php
require "conn.php";

if(isset($_POST['enroll'])){
    // Sanitize user input
    $course = mysqli_real_escape_string($conn, $_POST['course']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);

    // Perform the query
    $query = mysqli_query($conn, "INSERT INTO enrollment (email, course) VALUES ('$email', '$course')");

    // Check if the query was successful
    if($query){
        ?>
        <!-- SweetAlert link -->
        <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script> 
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                swal("Good job!", "Enrolled successfully!", "success").then(() => {
                    window.location.href = "enrollment.php"; // Redirect to enrollment page after displaying sweet alert
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
?>
