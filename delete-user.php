<?php
session_start();
require_once "conn.php";

// Check if the user is logged in
if (!isset($_SESSION['login'])) {
    header("Location: login.php");
    exit; // Ensure script execution stops after redirection
}

// Check if the user ID is provided in the request
if (!isset($_POST['email'])) {
    echo "User email not provided.";
    exit;
}

$email = $_POST['email'];

// Perform the deletion query
$delete_query = mysqli_query($conn, "DELETE FROM students WHERE email = '$email'");

// Check if the deletion was successful
if($delete_query){
    ?>
    <!-- SweetAlert link -->
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script> 
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            swal("Good job!", "User deleted successfully!", "success").then(() => {
                window.location.href = "manage-users.php"; // Redirect to manage users page after displaying success alert
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
            swal("Oops!", "Failed to delete the user. Please try again", "warning").then(() => {
                window.location.href = "manage-users.php"; // Redirect to manage users page after displaying warning alert
            });
        });
    </script>
    <?php
}

?>
