<?php
session_start();
require_once "conn.php";
require_once "styles.php";
require_once "navbar2.php";

// Retrieve and decode the email parameter
$email = isset($_GET['email']) ? base64_decode($_GET['email']) : '';

// Check if the user is logged in
if (!isset($_SESSION['login'])) {
    header("Location: login.php");
    exit; // Ensure script execution stops after redirection
}

// Handle course deletion
if(isset($_POST['delete_course'])){
    $course_code = $_POST['course_code'];

    // Perform the deletion query
    $delete_query = mysqli_query($conn, "DELETE FROM enrollment WHERE course_code = '$course_code'");

    // Check if the deletion was successful
    if($delete_query){
        // If successful, display success message
        echo '<script>
                swal("Success!", "Course deleted successfully!", "success").then(() => {
                    window.location.href = "edit-user.php?email=' . urlencode($email) . '";
                });
            </script>';
        exit;
    } else {
        // If deletion failed, display error message
        echo '<script>
                swal("Error!", "Failed to delete course. Please try again.", "error");
            </script>';
        exit;
    }
}

// Rest of the code to display user details and enrolled courses

// Query to fetch user data using email
$query = "SELECT * FROM students WHERE email = '$email'";
$result = mysqli_query($conn, $query);

// Check if the query was successful and user exists
if ($result && mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    // Extract user details
    $firstName = $row['firstName'];
    $lastName = $row['lastName'];
    $phone = $row['phone'];
    // You can add more fields as needed

    // Query to fetch courses the user has registered for
    $courses_query = "SELECT * FROM enrollment WHERE email = '$email'";
    $courses_result = mysqli_query($conn, $courses_query);
    $courses = []; // Array to store courses

    if ($courses_result && mysqli_num_rows($courses_result) > 0) {
        // Fetch all rows at once
        $courses = mysqli_fetch_all($courses_result, MYSQLI_ASSOC);
    }

    // Close the database connection
    mysqli_close($conn);
} else {
    // Handle case when user is not found
    echo "User not found";
    exit(); // Stop further execution
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit User</title>
    <!-- Include SweetAlert2 library -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>
<div class="row">
    <!-- Sidebar content -->
    <div class="col-lg-2 bg-primary mt-0">
        <ul class="mt-3">
            <li style="list-style: none;" class="text-light mx-3 mt-3"><i class="bi bi-house"></i>&nbsp;<a href="admin-dashboard.php" class="text-light">Home</a></li><br>
            <li style="list-style: none;" class="text-light mx-3"><i class="bi bi-person"></i>&nbsp;<a href="admin-profile.php" class="text-light">Profile</a></li><br>
            <li style="list-style: none;" class="text-light mx-3"><i class="bi bi-person-plus"></i>&nbsp;<a href="users.php" class="text-light">Manage users</a></li><br>
            <li style="list-style: none;" class="text-light mx-3"><i class="bi bi-book"></i>&nbsp;<a href="manage-courses.php" class="text-light">Manage courses</a></li><br>
            <li style="list-style: none;" class="text-light mx-3"><i class="bi bi-box-arrow-right"></i>&nbsp;<a href="logout.php" class="text-light">Logout</a></li><br>
        </ul>
    </div>

    <!-- Main content -->
    <div class="col-lg-10 mt-4">
        <h1>Manage User</h1>
        <!-- Display user details in the form -->
        <form method="post" action="">
            <label for="firstname" class="form-label text-dark">First Name:</label>
            <input type="text" name="firstName" class="form-control" pattern="[A-Za-z\s']+" title="Please enter letters only, numbers are not allowed!" value="<?php echo $row['firstName']; ?>" required>
          
            <label for="lastname" class="form-label text-dark mt-3">Last Name:</label>
            <input type="text" name="lastName" class="form-control" pattern="[A-Za-z\s']+" title="Please enter letters only, numbers are not allowed!" value="<?php echo $row['lastName']; ?>" required>

            <label for="email" class="form-label text-dark mt-3">E-mail:</label>
            <input type="email" name="email" class="form-control" value="<?php echo $row['email']; ?>" required>

            <label for="Phone Number" class="form-label text-dark mt-3">Phone number:</label>
            <input type="tel" name="phone" class="form-control" pattern="^(07\d{8}|01\d{8}|\+2547\d{8})$" value="<?php echo $row['phone']; ?>" required>

            <input type="hidden" name="email" value="<?php echo $email; ?>"> <!-- Include email as hidden field -->
            <button type="submit" class="btn btn-primary mt-4" style="border-radius:20px;" name="update">Save Changes</button>
        </form>
    </div>

    <!-- Display list of courses the user has registered for -->
    <div class="col-lg-12 mt-4 mx-2">
        <h2>Enrolled Courses</h2>
        <div class="table-responsive">
            <table class="table table-hover">
                <thead class="table-dark">
                    <tr>
                        <th>Course Code</th>
                        <th>Course Title</th>
                        <th>Course Description</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($courses as $course) : ?>
                        <tr>
                            <td><?php echo $course['course_code']; ?></td>
                            <td><?php echo $course['course']; ?></td>
                            <td><?php echo $course['course_description']; ?></td>
                            
                            <td>
                                <!-- Form for deleting the course -->
                                <form method="post" action="" name="delete_course_form">

                                    <input type="hidden" name="course_code" value="<?php echo $course['course_code']; ?>">
                                    <button type="button" class="btn btn-danger btn-sm delete-course-btn" data-course-code="<?php echo $course['course_code']; ?>"><i class="bi bi-trash"></i> Delete</button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Custom JavaScript -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Function to handle course deletion confirmation
        function confirmDelete(form) {
            Swal.fire({
                title: "Are you sure?",
                text: "Once deleted, you will not be able to recover this course!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes, delete it!"
            }).then((result) => {
                if (result.isConfirmed) {
                    // If user confirms deletion, submit the form
                    form.submit();
                }
            });
        }

        // Attach event listeners to all delete buttons
        const deleteButtons = document.querySelectorAll('.delete-course-btn');
        deleteButtons.forEach(btn => {
            btn.addEventListener('click', function() {
                const form = this.closest('form');
                confirmDelete(form);
            });
        });
    });
</script>


</body>
</html>
