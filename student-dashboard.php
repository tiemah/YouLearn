<?php
session_start();

// Check if user is logged in
if (!isset($_SESSION['login'])) {
    header("Location: login.php");
    exit(); // Stop further execution
}

// Include database connection
require_once "conn.php";

// Retrieve user's first name from the database
$email = $_SESSION['login'];
$query = "SELECT firstname FROM students WHERE email = '$email'";
$result = mysqli_query($conn, $query);

if ($result && mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    $firstName = $row['firstname'];
} else {
    $firstName = ''; // Set default value if first name not found
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Dashboard</title>
    <!-- link to bootstrap css cdn link -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>

    <?php
    require_once "navbar2.php";
    require_once "styles.php";
    ?>

    <div class="row mt-0">
        <div class="col-lg-2 bg-primary">
            <ul class="mt-3">
                <li style="list-style: none;" class="text-light mx-3 mt-3"><i class="bi bi-house"></i>&nbsp;<a href="student-dashboard.php" class="text-light">Dashboard</li><br>
                <li style="list-style: none;" class="text-light mx-3"><i class="bi bi-person"></i>&nbsp;<a href="profile.php" class="text-light">Profile</a></li><br>
                <li style="list-style: none;" class="text-light mx-3"><i class="bi bi-check-square"></i>&nbsp;<a href="enrollment.php" class="text-light">Course enrollment</a></li><br>
                <li style="list-style: none;" class="text-light mx-3"><i class="bi bi-book"></i>&nbsp;<a href="view-courses.php" class="text-light">View Courses</a></li><br>
                <li style="list-style: none;" class="text-light mx-3"><i class="bi bi-box-arrow-right"></i>&nbsp;<a href="logout.php" class="text-light">Logout</a></li><br>

            </ul>
        </div>
        <div class="col-lg-10">
            <!-- Display welcome message with user's first name -->
            <h2 class="mt-3">Welcome, <?php echo $firstName; ?>!</h2>
            <!-- Rest of your HTML content -->
        </div>
    </div>

    <?php
    require_once "footer.php";
    ?>

    <!-- bootstrap js cdn link -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>
