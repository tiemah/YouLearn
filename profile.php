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
        <h2 class="mt-5 text-center">Update Profile</h2>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST">

        <label for="firstname" class="form-label text-dark">First Name:</label>
        <input type="text" name="first_name" class="form-control" pattern="[A-Za-z\s']+" title="Please enter letters only, numbers are not allowed!" required>
      
        <label for="lastname" class=" form-label text-dark mt-3">Last Name:</label>
        <input type="text" name="last_name" class="form-control" pattern="[A-Za-z\s']+" title="Please enter letters only, numbers are not allowed!" required>


        <label for="email" class="form-label text-dark mt-3">E-mail:</label>
        <input type="email" name="email" class="form-control" required>

        <label for="Phone Number" class="form-label text-dark mt-3">Phone number:</label>
        <input type="tel" name="phone" class="form-control" pattern="^(07\d{8}|01\d{8}|\+2547\d{8})$" required>

        

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