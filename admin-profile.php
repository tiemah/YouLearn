<!DOCTYPE html>
<html lang="en">
<head>

<meta charset="utf-8">
    <title>Update profile</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">
</head>
<body>
    <?php
    
        require_once "navbar2.php";
        require_once "conn.php";
        session_start(); 
        $email = $_SESSION['login'];
        if(!isset($_SESSION['login'])){
            header("Location:login.php");
        }
        
        
        $res = mysqli_query($conn, "SELECT * FROM students WHERE email='$email'"); 
        $row = mysqli_fetch_array($res);

        if(isset($_POST['submit'])){
            $firstName = mysqli_real_escape_string($conn, $_POST['firstName']);
            $lastName = mysqli_real_escape_string($conn,$_POST['lastName']);
            $email = mysqli_real_escape_string($conn,$_POST['email']);
            $phone = mysqli_real_escape_string($conn, $_POST['phone']);

            if(empty($firstName)){
                echo "Please enter first name to proceed!";
            }elseif(empty($lastName)){
                echo "Please enter last name to proceed!";
            }elseif(empty($email)){
                echo "Please enter email to proceed!";
            }elseif(!is_numeric($phone)){
                echo "Only numbers are allowed in the email field!";
            }else{
            $query=mysqli_query($conn,"UPDATE students SET firstName='$firstName',lastName='$lastName',email='$email',phone = '$phone' WHERE email='$email'")or die(mysqli_error($conn));
    
            if($query){
                ?>
                            <!-- sweetalert link -->
                            <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script> 
                            
                            <script>
                                document.addEventListener('DOMContentLoaded', function() {
                                    swal("Good job!", "Profile updated successfully!", "success").then(() => {
                                        window.location.href = "profile.php"; // Redirect to add-course page after displaying sweet alert
                                    });
                                });
                            </script>
                <?php
                        }
                    }
                }
                ?>
        
        
    <!-- <div class="row mb-5" > -->
    <div class="row mt-0">
        <div class="col-lg-2 bg-primary mt-0">
            <!-- Sidebar content -->
            <ul class="mt-3">
                <li style="list-style: none;" class="text-light mx-3 mt-3"><i class="bi bi-house"></i>&nbsp;<a href="admin-dashboard.php" class="text-light">Home</li><br>
                <li style="list-style: none;" class="text-light mx-3"><i class="bi bi-person"></i>&nbsp;<a href="admin-profile.php" class="text-light">Profile</a></li><br>
                <li style="list-style: none;" class="text-light mx-3"><i class="bi bi-check-square"></i>&nbsp;<a href="users.php" class="text-light">Manage users</a></li><br>
                <li style="list-style: none;" class="text-light mx-3"><i class="bi bi-book"></i>&nbsp;<a href="courses.php" class="text-light">Manage courses</a></li><br>
                <!-- <li style="list-style: none;" class="text-light mx-3"><i class="bi bi-book"></i>&nbsp;<a href="courses.php" class="text-light">Manage courses</a></li><br> -->

                <li style="list-style: none;" class="text-light mx-3"><i class="bi bi-box-arrow-right"></i>&nbsp;<a href="logout.php" class="text-light">Logout</a></li><br>
                
            </ul>
        </div>
            
        <div class="col-lg-10 mt-3">
        <h2 class="mt-5 text-center">Update Profile</h2>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST">

        <label for="firstname" class="form-label text-dark">First Name:</label>
        <input type="text" name="firstName" class="form-control" pattern="[A-Za-z\s']+" title="Please enter letters only, numbers are not allowed!" value="<?php echo $row['firstName']; ?>" required>
      
        <label for="lastname" class=" form-label text-dark mt-3">Last Name:</label>
        <input type="text" name="lastName" class="form-control" pattern="[A-Za-z\s']+" title="Please enter letters only, numbers are not allowed!" value="<?php echo $row['lastName']; ?>"required>


        <label for="email" class="form-label text-dark mt-3">E-mail:</label>
        <input type="email" name="email" class="form-control" value="<?php echo $row['email']; ?>" required>

        <label for="Phone Number" class="form-label text-dark mt-3">Phone number:</label>
        <input type="tel" name="phone" class="form-control" pattern="^(07\d{8}|01\d{8}|\+2547\d{8})$" value="<?php echo $row['phone']; ?>" required>

        

        <input type="submit" class="btn btn-primary mt-3 mb-3" value="Save Changes" name="submit" style="border-radius:30px;">
        <!-- <input type="submit" class="btn btn-primary mt-5 " value="Reset"  style="margin-left: 250px; border-radius:30px;"> -->

        

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