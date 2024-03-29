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
        require_once "navbar.php";
        require_once "conn.php";

        $user_id =$_GET['user_id'];
        $res = mysqli_query($conn, "SELECT * FROM students WHERE user_id ='$user_id'"); 
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
            $query=mysqli_query($conn,"UPDATE students SET firstName='$firstName',lastName='$lastName',email='$email',phone = '$phone' WHERE user_id='$user_id'")or die(mysqli_error($conn));
    
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
        
        
    <div class="row mb-5" >
        <div class="col-lg-4">

        </div>
        <div class="col-lg-4 mt-5"style="margin-top:200px;">
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

        

        <input type="submit" class="btn btn-primary mt-5 mx-5" value="UPDATE" name="submit" style="border-radius:30px;">
        <input type="submit" class="btn btn-primary mt-5 " value="RESET"  style="margin-left: 250px; border-radius:30px;">

        

        </form>
        </div>
    </div>
    <?php
        require_once "footer.php";
    ?>
</body>
</html>