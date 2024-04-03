<?php
// Include necessary files and start session
session_start();
require_once "conn.php";
require_once "styles.php";
require_once "navbar2.php";

// Check if the user is logged in
if (!isset($_SESSION['login'])) {
    header("Location: login.php");
    exit;
}

// Retrieve course code from query parameter
if (!isset($_GET['course_code'])) {
    // Redirect if course code is not provided
    header("Location: manage-courses.php");
    exit;
}
$course_code = $_GET['course_code'];

// Fetch course details based on course code
$query = "SELECT * FROM courses WHERE course_code = '$course_code'";
$result = mysqli_query($conn, $query);

if (!$result || mysqli_num_rows($result) == 0) {
    // Redirect if course not found
    header("Location: manage-courses.php");
    exit;
}
$row = mysqli_fetch_assoc($result);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Course</title>
</head>
<body>
    <?php
        require_once "navbar2.php";
    ?>
    <div class="row">
    <div class="col-lg-2 bg-primary mt-0">
        <!-- Sidebar content -->
        <ul class="mt-3">
            <li style="list-style: none;" class="text-light mx-3 mt-3"><i class="bi bi-house"></i>&nbsp;<a href="admin-dashboard.php" class="text-light">Home</a></li><br>
            <li style="list-style: none;" class="text-light mx-3"><i class="bi bi-person"></i>&nbsp;<a href="admin-profile.php" class="text-light">Profile</a></li><br>
            <li style="list-style: none;" class="text-light mx-3"><i class="bi bi-person-plus"></i>&nbsp;<a href="users.php" class="text-light">Manage users</a></li><br>
            <li style="list-style: none;" class="text-light mx-3"><i class="bi bi-book"></i>&nbsp;<a href="manage-courses.php" class="text-light">Manage courses</a></li><br>
            <li style="list-style: none;" class="text-light mx-3"><i class="bi bi-box-arrow-right"></i>&nbsp;<a href="logout.php" class="text-light">Logout</a></li><br>
        </ul>
    </div>
    <div class="col-lg-10 mt-2">

        <h2 class="mt-3">Edit Course</h2>
        <form method="post" action="update-course.php">
            <input type="hidden" name="course_code" value="<?php echo $course_code; ?>">
            <div class="mb-3">
                <label for="course_code" class="form-label">Course Code</label>
                <input type="text" class="form-control" id="course_code" name="course_code" value="<?php echo $row['course_code']; ?>">
            </div>
            <div class="mb-3">
                <label for="course_name" class="form-label">Course Name</label>
                <input type="text" class="form-control" id="course_name" name="course_name" value="<?php echo $row['course_name']; ?>">
            </div>
            <div class="mb-3">
                <label for="course_description" class="form-label">Course Description</label>
                <textarea class="form-control" id="course_description" name="course_description" rows="4"><?php echo $row['course_description']; ?></textarea>
            </div>
            <button type="submit" class="btn btn-primary" style="border-radius: 20px;">Save Changes</button>
        </form>
    </div>
    </div>
<?php
    require_once "footer.php";
?>
</body>
</html>
