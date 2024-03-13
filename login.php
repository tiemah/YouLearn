<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
    <title>Login</title>
    
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <!-- Favicon -->
    <link href="img/favicon.ico" rel="icon">
    <!-- fontawesome -->
    <link rel="stylesheet" href="path/to/font-awesome/css/font-awesome.min.css">


    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link  rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link  href="https://fonts.googleapis.com/css2?family=Heebo:wght@400;500;600&family=Nunito:wght@600;700;800&display=swap" rel="stylesheet">

    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    

   
    


</head>
<body>
    
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
    
</body>
</html>
