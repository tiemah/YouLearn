<?php
require "conn.php";
if(isset($_POST['enroll'])){

$course = $_POST['course'];
$email = $_POST['email'];


$query = mysqli_query($conn, "INSERT INTO enrollment(email, course) VALUES('$email', '$course')") or die(mysqli_error($conn));

}

if($query){

?>

<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script> 
            
            <script>
                swal("Good job!", "Enrollment successful!", "success");
                </script>

<?php
                
                
            }
        
 header("Location:enrollment.php");
        
            ?>