<?php
// Start session if not already started
session_start();
$email = $_SESSION['login'];
if(!isset($_SESSION['login'])){
    header("Location:login.php");
}
// Get the email of logged in user from session
// Check if user is logged in and has admin role
// if (!isset($_SESSION['user_role']) || $_SESSION['user_role'] !== 'administrator') {
    // Redirect user to another page or display an access denied message
    // header("Location: login.php");
    // exit(); // Stop further execution
// }

// Continue rendering the page content for admins
require_once "navbar2.php";
require_once "styles.php";
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
<html>
<head>
    <title>Admin Page</title>
</head>
<body>
    
    <div class="row mt-0">
    <!-- <h1 class="text-center">Welcome, Admin!</h1> -->
    <div class="col-lg-2 bg-primary">
    <ul class="mt-3">
            <li style="list-style: none;" class="text-light mx-3 mt-3"><i class="bi bi-house"></i>&nbsp;<a href="admin-dashboard.php" class="text-light">Home</a></li><br>
            <li style="list-style: none;" class="text-light mx-3"><i class="bi bi-person"></i>&nbsp;<a href="admin-profile.php" class="text-light">Profile</a></li><br>
            <li style="list-style: none;" class="text-light mx-3"><i class="bi bi-person-plus"></i>&nbsp;<a href="users.php" class="text-light">Manage users</a></li><br>
            <li style="list-style: none;" class="text-light mx-3"><i class="bi bi-book"></i>&nbsp;<a href="manage-courses.php" class="text-light">Manage courses</a></li><br>
            <li style="list-style: none;" class="text-light mx-3"><i class="bi bi-box-arrow-right"></i>&nbsp;<a href="view-enrollments.php" class="text-light">View Enrollments</a></li><br>
            <li style="list-style: none;" class="text-light mx-3"><i class="bi bi-box-arrow-right"></i>&nbsp;<a href="logout.php" class="text-light">Logout</a></li><br>
        </ul>
        </div>
        <div class="col-lg-10">
            <!-- Display welcome message with user's first name -->
            <h2 class="mt-3">Welcome, <?php echo $firstName; ?>!</h2>
            
            <!-- Service Start -->
    <div class="container-xxl py-5">
        <div class="container">
            <div class="row g-4">
                <h3 class="text-center">This is YouLearn. </h3>
                <div class="col-lg-3 col-sm-6 wow fadeInUp" data-wow-delay="0.1s">
                    <div class="service-item text-center pt-3">
                        <div class="p-4">
                            <i class="fa fa-3x fa-graduation-cap text-primary mb-4"></i>
                            <h5 class="mb-3">Guaranteed excellence</h5>
                            <p>YouLearn gives you, the learner, an opportunity to excell in your academics.</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6 wow fadeInUp" data-wow-delay="0.3s">
                    <div class="service-item text-center pt-3">
                        <div class="p-4">
                            <i class="fa fa-3x fa-globe text-primary mb-4"></i>
                            <h5 class="mb-3">Online Access</h5>
                            <p>Access all the available learning materials from your tutors at the  comfort of your own home.</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6 wow fadeInUp" data-wow-delay="0.5s">
                    <div class="service-item text-center pt-3">
                        <div class="p-4">
                            <i class="fa fa-3x fa-home text-primary mb-4"></i>
                            <h5 class="mb-3">Home Projects</h5>
                            <p>YouLearn brings the classroom right to the palm of your hands. It is just a click away.</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6 wow fadeInUp" data-wow-delay="0.7s">
                    <div class="service-item text-center pt-3">
                        <div class="p-4">
                            <i class="fa fa-3x fa-book-open text-primary mb-4"></i>
                            <h5 class="mb-3">Vast materials</h5>
                            <p>YouLearn brings you a wide range of verified materials that guarantee your success.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Service End -->
    

        </div>
    </div>

    <?php
        require_once "footer.php";
    ?>
</body>
</html>