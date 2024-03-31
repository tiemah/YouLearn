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
<?php
    // After the user successfully logs in
    session_start(); // Start the session
    $_SESSION['user_id'] = $user_id; // Store the user ID in the session variable

    require "conn.php";
    require_once "navbar.php";   

        if(isset($_POST['submit'])){
            $email=$_POST['email'];
            $password=$_POST['password'];

            $res=mysqli_query($conn,"SELECT * FROM students WHERE email='$email'") or die(mysqli_error($conn));

            if(mysqli_num_rows($res)>0){
            $row=mysqli_fetch_array($res);

            if(password_verify($password,$row['password_hash'])){
                header("Location:student-dashboard.php");
            }else{
                // $_SESSION['error_msg']='Invalid login credentials';
                echo "invalid credentials";
            }
            }else{
            //   $_SESSION['error_msg']='Invalid login credentials';
            echo "invalid credentials";
            } 
        }

?>

    
       <div class="row mt-5">
        <div class="col-lg-4"></div>

        <div class="col-lg-4">
            <h2 class="mt-5 text-center">Login</h2>

            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST">
            

                <label for="email" class="form-label text-dark mt-3">E-mail:</label>
                <input type="email" name="email" class="form-control" placeholder="e.g johndoe@gmail.com"  required>

                <label for="password" class="form-label text-dark mt-3">Password:</label>
                <input type="password" name="password" class="form-control" placeholder="e.g 12234@ke" required>

                <input type="submit" class="btn btn-primary mt-5 mx-5" value="LOGIN" name="submit" style="border-radius: 30px;">
                <input type="submit" class="btn btn-primary mt-5" value="RESET" style="margin-left: 200px; border-radius:30px;">

                <p class="text-dark my-5">Not registered? <a href="register.php">Register Today</a></p>    
        </form>
        </div>
    </div>
    <?php
        require_once "footer.php"; 
    ?>
    

 <!-- JavaScript Libraries -->
 <script type="text/javascript" src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    
    
</body>
</html>
