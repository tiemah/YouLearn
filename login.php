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
        require_once "navbar.php";
        
    ?>
    
       <div class="row mt-5">
        <div class="col-lg-4"></div>

        <div class="col-lg-4">
            <h2 class="mt-5 text-center">Login</h2>

            <form action="" method="POST">
            

                <label for="email" class="form-label text-dark mt-3">E-mail:</label>
                <input type="email" name="email" class="form-control" placeholder="e.g johndoe@gmail.com"  required>

                <label for="password" class="form-label text-dark mt-3">Password:</label>
                <input type="password" name="password" class="form-control" placeholder="e.g 12234@ke" required>

                <input type="submit" class="btn btn-primary mt-5 " value="SUBMIT" name="submit" style="border-radius: 30px;">
                <input type="submit" class="btn btn-primary mt-5" value="RESET" style="margin-left: 300px; border-radius:30px;">

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
