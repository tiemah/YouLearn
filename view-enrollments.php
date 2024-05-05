<?php
    session_start();
    require_once "conn.php";
    require_once "navbar2.php";
    require_once "styles.php";

    // Check if the user is logged in
    if (!isset($_SESSION['login'])) {
        header("Location: login.php");
        exit; // Ensure script execution stops after redirection
    }

    // Query to fetch enrollment statistics
    $query = "SELECT course_code, COUNT(*) AS enrollments FROM enrollment GROUP BY course_code";
    $result = mysqli_query($conn, $query);

    if ($result && mysqli_num_rows($result) > 0) {
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Enrollments</title>
    <!-- Add Bootstrap CSS -->
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"> -->
    <!-- Add SweetAlert library -->
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <!-- Add your custom styles here -->
    <style>
        /* Add your custom CSS styles */
    </style>
</head>
<body>
    <!-- <div class="container mt-5"> -->
        <!-- <div class="row"> -->
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
                <h1 class="text-center mb-4 mt-4">Enrollment Statistics</h1>
                <table class="table table-striped table-hover">
                    <thead class="table-dark">
                        <tr>
                            <th scope="col">Course Code</th>
                            <th scope="col">No. of enrollments</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            while ($row = mysqli_fetch_assoc($result)) {
                                echo '<tr>';
                                echo '<td>' . $row['course_code'] . '</td>';
                                echo '<td>' . $row['enrollments'] . '</td>';
                                echo '</tr>';
                            }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    <!-- </div> -->
    
    </script>
     <!-- JavaScript Libraries -->
     <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="lib/wow/wow.min.js"></script>
    <script src="lib/easing/easing.min.js"></script>
    <script src="lib/waypoints/waypoints.min.js"></script>
    <script src="lib/owlcarousel/owl.carousel.min.js"></script>

    <!-- Template Javascript -->
    <script src="js/main.js"></script>
</body>
</html>
<?php
    } else {
        echo '<div class="alert alert-info" role="alert">No enrollment data available.</div>';
    }

    // Close database connection
    mysqli_close($conn);
    require_once "footer.php";
?>
