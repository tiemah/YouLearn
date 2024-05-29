<?php
session_start();

if(isset($_SESSION['login'])){
    header("Location:student-dashboard.php");
}

?>

<!DOCTYPE html>
<html lang="en">
<head>

<meta charset="utf-8">
    <title>Register</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    

    

</head>
<body>
    <?php
        require_once "navbar.php";
    ?>
   
   

    
    <div class="row" >
        <div class="col-lg-4">

        </div>
        <div class="col-lg-4 mt-5"style="margin-top:200px;">
        <h2 class="mt-5 text-center">REGISTER</h2>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST">

        <label for="firstname" class="form-label text-dark">First Name:</label>
        <input type="text" name="first_name" class="form-control" pattern="[A-Za-z\s']+" title="Please enter letters only, numbers are not allowed!" required>
      
        <label for="lastname" class=" form-label text-dark mt-3">Last Name:</label>
        <input type="text" name="last_name" class="form-control" pattern="[A-Za-z\s']+" title="Please enter letters only, numbers are not allowed!" required>


        <label for="email" class="form-label text-dark mt-3">E-mail:</label>
        <input type="email" name="email" class="form-control" required>

        <label for="Phone Number" class="form-label text-dark mt-3">Phone number:</label>
        <input type="tel" name="phone" class="form-control" pattern="^(07\d{8}|01\d{8}|\+2547\d{8})$" required>

        <label for="password" class="form-label text-dark mt-3">Password:</label>
        <input type="password" name="password" class="form-control" minlength="4" maxlength="12" required>

        <input type="submit" class="btn btn-primary mt-5 mx-5" value="SUBMIT" name="submit" style="border-radius:30px;">
        <input type="submit" class="btn btn-primary mt-5 " value="RESET"  style="margin-left: 80px; border-radius:30px;">

        <p class="text-dark my-5">Already registered? <a href="login.php">Login </a></p>


        </form>
        </div>
    </div>
    <?php
    require_once "conn.php"; //requiring the file containing the connection to the database
    require_once "footer.php";

    if(isset($_POST['submit'])){
        // cleaning inputs using mysqli_real_escape_string() to prevent SQL injection attacks
        $firstName = mysqli_real_escape_string($conn, $_POST['first_name']);
        $lastName = mysqli_real_escape_string($conn, $_POST['last_name']);
        $email = mysqli_real_escape_string($conn, $_POST['email']);
        $phone = mysqli_real_escape_string($conn, $_POST['phone']);
        $password = mysqli_real_escape_string($conn, $_POST['password']);

        // Check if email already exists in the database
        $email_check_query = "SELECT * FROM students WHERE email='$email' LIMIT 1";
        $email_result = mysqli_query($conn, $email_check_query);
        $email_exists = mysqli_fetch_assoc($email_result);

        // Check if phone number already exists in the database
        $phone_check_query = "SELECT * FROM students WHERE phone='$phone' LIMIT 1";
        $phone_result = mysqli_query($conn, $phone_check_query);
        $phone_exists = mysqli_fetch_assoc($phone_result);

        // If email or phone number already exists, display appropriate SweetAlert notification
        if ($email_exists) {
            ?>
            <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
            <script>
                swal("Oops!", "Email already exists. Please use a different email.", "error");
            </script>
            <?php
        } elseif ($phone_exists) {
            ?>
            <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
            <script>
                swal("Oops!", "Phone number already exists. Please use a different phone number.", "error");
            </script>
            <?php
        } else {
            // If email and phone number don't exist, proceed with registration
            $password_hash = password_hash($password, PASSWORD_DEFAULT);

            $query = mysqli_query($conn, "INSERT INTO students(firstName, lastName, email, phone, password_hash, user_role) VALUES('$firstName', '$lastName', '$email', '$phone', '$password_hash','registered_user')") or die(mysqli_error($conn));

            // Check if the query was successful
            if ($query) {
                ?>
                <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
                <script>
                    swal("Hooray!", "Registered successfully!", "success").then(() => {
                        window.location.href = "login.php"; // Redirect to login page after displaying success alert
                    });
                </script>
                <?php
            } else {
                // Display error message if the query fails
                ?>
                <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
                <script>
                    swal("Oops!", "Failed to register. Please try again later.", "error").then(() => {
                        window.location.href = "register.php"; // Redirect to register page after displaying error alert
                    });
                </script>
                <?php
            }
        }
    }

?>


    
    <!--  bootstrap js link-->
    <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNy
