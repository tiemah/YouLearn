<?php
session_start();
require_once "conn.php";
require_once "styles.php";
require_once "navbar2.php";

// Check if the user is logged in
if (!isset($_SESSION['login'])) {
    header("Location: login.php");
    exit;
}

// Handle course deletion
if(isset($_POST['delete_course'])){
    $course_code = $_POST['course_code'];

    // Perform the deletion query here
    $delete_query = mysqli_query($conn, "DELETE FROM courses WHERE course_code = '$course_code'");
    // Check if the deletion was successful
    if($delete_query){
        echo '<script>alert("Course deleted successfully!");</script>';
    } else {
        echo '<script>alert("Failed to delete course. Please try again.");</script>';
    }
}

// Query to fetch courses data from the database
$courses_query = "SELECT * FROM courses";
$courses_result = mysqli_query($conn, $courses_query);

// Check if there are courses available
if ($courses_result && mysqli_num_rows($courses_result) > 0) {
    $courses = mysqli_fetch_all($courses_result, MYSQLI_ASSOC);
} else {
    $courses = [];
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Courses</title>
    <!-- Include SweetAlert library -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>
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
        <!-- Display list of courses -->
        <div class="col-lg-12 mt-4 mx-2">
            <h2>Manage Courses</h2>
            <div class="table-responsive">
            <table class="table table-hover">
                <thead class="table-dark">
                    <tr>
                        <th>Course Code</th>
                        <th>Course Name</th>
                        <th>Course Description</th>
                        <th>Edit course</th>
                        <th>Delete course</th>
                    </tr>
                </thead>
                <tbody>
                <?php foreach ($courses as $course) : ?>
                    <tr>
                        <td><?php echo $course['course_code']; ?></td>
                        <td><?php echo $course['course_name']; ?></td>
                        <td><?php echo $course['course_description']; ?></td>
                        <td>
                            <!-- Edit button -->
                            <a href="edit-course.php?course_code=<?php echo $course['course_code']; ?>" class="btn btn-primary btn-sm">Edit</a></td>
                            <td>
                            <!-- Delete button -->
                    <form method="post" action="delete-course.php" onsubmit="return confirmDelete(this)">
                        <input type="hidden" name="course_code" value="<?php echo $course['course_code']; ?>">
                        <button type="submit" name="delete_course" class="btn btn-danger btn-sm">Delete</button>
                    </form>

                        </td>
                    </tr>
                <?php endforeach; ?>

                </tbody>
            </table>
            </div>
            <a href="add-course.php" class="btn btn-primary" style="border-radius: 20px;">Add Course</a>
        </div>
    </div>
</div>
<?php
    require_once "footer.php";
?>
<script>
    function confirmDelete(form) {
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                // If user confirms, submit the form
                form.submit();
            }
        });
        // Prevent default form submission
        return false;
    }
</script>

</body>
</html>
