<?php
require "conn.php";
if(isset($_POST['enroll'])){

$course = $_POST['course'];
$email = $_POST['email'];


$query = mysqli_query($conn, "INSERT INTO enrollment(email, course) VALUES('$email', '$course')") or die(mysqli_error($conn));

}

if($query){
    ?>
                <!-- sweetalert link -->
                <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script> 
                
                <script>
                    document.addEventListener('DOMContentLoaded', function() {
                        swal("Good job!", "Enrolled successfully!", "success").then(() => {
                            window.location.href = "enrollment.php"; // Redirect to add-course page after displaying sweet alert
                        });
                    });
                </script>
    <?php
}
            ?>