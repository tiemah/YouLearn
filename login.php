<?php
session_start();

// Check if the user is already logged in, redirect if necessary
if(isset($_SESSION['login'])){
    // Redirect based on user user_role
    if($_SESSION['user_role'] == 'administrator') {
        header("Location: admin-dashboard.php");
        exit(); // Prevent further execution
    } else {
        header("Location: student-dashboard.php");
        exit(); // Prevent further execution
    }
}

require "conn.php";
require_once "navbar.php";   

if(isset($_POST['submit'])){
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    // Fetch user from database
    $query = "SELECT * FROM students WHERE email='$email'";
    $res = mysqli_query($conn, $query);

    if(mysqli_num_rows($res) > 0) {
        $row = mysqli_fetch_array($res);
        if(password_verify($password, $row['password_hash'])) {
            session_start();
            $_SESSION['login'] = $email;
            if(isset($row['user_role'])) { // Check if the 'user_role' key exists
                $_SESSION['user_role'] = $row['user_role']; // Store user user_role in session
                if($row['user_role'] == 'administrator') {
                    header("Location: admin-dashboard.php"); // Redirect admin to admin dashboard
                } else {
                    header("Location: student-dashboard.php"); // Redirect normal user to student dashboard
                }
            } else {
                echo "user_role not defined for this user"; // Handle the case where 'user_role' key is not defined
            }
        

        }
     else {
        ?>
        <!-- Sweetalert link -->
        <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script> 
        
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                swal("Error", "Invalid credentials!", "error").then(() => {
                    window.location.href = "login.php"; // Redirect login page after displaying sweet alert
                });
            });
        </script>
        <?php
    }
}
}
   

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Login</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">   
</head>
<body>
    <div class="row mt-5">
        <div class="col-lg-4"></div>
        <div class="col-lg-4">
            <h2 class="mt-5 text-center">Login</h2>
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST">
                <label for="email" class="form-label text-dark mt-3">E-mail:</label>
                <input type="email" name="email" class="form-control" placeholder="e.g johndoe@gmail.com" required>
                <label for="password" class="form-label text-dark mt-3">Password:</label>
                <input type="password" name="password" class="form-control" placeholder="e.g 12234@ke" required>
                <input type="submit" class="btn btn-primary mt-5 mx-5" value="LOGIN" name="submit" style="border-radius: 30px;">
                <input type="submit" class="btn btn-primary mt-5" value="RESET" style="margin-left: 200px; border-radius:30px;">
                <p class="text-dark my-5">Not registered? <a href="register.php">Register Today</a></p>    
            </form>
        </div>
    </div>
    <?php require_once "footer.php"; ?>
    <!-- JavaScript Libraries -->
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
