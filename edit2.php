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
if (isset($_POST['delete_course'])) {
    $course_code = $_POST['course_code'];

    // Perform the deletion query here
    // Example:
    $delete_query = mysqli_query($conn, "DELETE FROM enrollment WHERE course_code = '$course_code'");
    // Check if the deletion was successful
    if ($delete_query) {
        ?>
        <!-- SweetAlert link -->
        <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Function to handle course deletion confirmation
            function confirmDelete(courseCode) {
                swal({
                    title: "Are you sure?",
                    text: "Once deleted, you will not be able to recover this course!",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                })
                .then((willDelete) => {
                    if (willDelete) {
                        // If user confirms deletion, submit the form
                        document.getElementById('delete_course_form_' + courseCode).submit();
                    } else {
                        // If user cancels deletion, show a message
                        swal("Course deletion cancelled!", {
                            icon: "info",
                        });
                    }
                });
            }

            // Attach event listeners to all delete buttons
            const deleteButtons = document.querySelectorAll('.delete-course-btn');
            deleteButtons.forEach(btn => {
                btn.addEventListener('click', function() {
                    const courseCode = this.getAttribute('data-course-code');
                    confirmDelete(courseCode);
                });
            });
        });
        </script>
        <?php
    } else {
        ?>
        <!-- SweetAlert link -->
        <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script> 
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                swal("Oops!", "Failed to drop the course. Please try again", "warning").then(() => {
                    window.location.href = "users.php"; // Redirect to courses page after displaying warning alert
                });
            });
        </script>
        <?php
    }
}

// Updating user details
if (isset($_POST['update'])) {
    $firstName = mysqli_real_escape_string($conn, $_POST['firstName']);
    $lastName = mysqli_real_escape_string($conn, $_POST['lastName']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $phone = mysqli_real_escape_string($conn, $_POST['phone']);
    $role = mysqli_real_escape_string($conn, $_POST['role']);

    if (empty($firstName)) {
        echo "Please enter first name to proceed!";
    } elseif (empty($lastName)) {
        echo "Please enter last name to proceed!";
    } elseif (empty($email)) {
        echo "Please enter email to proceed!";
    } elseif (!is_numeric($phone)) {
        echo "Only numbers are allowed in the phone field!";
    } else {
        $query = mysqli_query($conn, "UPDATE students SET firstName='$firstName', lastName='$lastName', email='$email', phone='$phone', user_role='$role' WHERE email='$email'") or die(mysqli_error($conn));

        if ($query) {
            ?>
            <!-- SweetAlert link -->
            <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script> 
            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    swal("Good job!", "Profile updated successfully!", "success").then(() => {
                        window.location.href = "users.php"; // Redirect to edit user page after displaying sweet alert
                    });
                });
            </script>
            <?php
        }
    }
}

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
    $user_role = $row['user_role'];
    // You can add more fields as needed

    // Query to fetch courses the user has registered for
    $courses_query = "SELECT * FROM enrollment WHERE email = '$email'";
    $courses_result = mysqli_query($conn, $courses_query);
    $courses = []; // Array to store courses

    if ($courses_result && mysqli_num_rows($courses_result) > 0) {
        // Fetch all rows at once
        $courses = mysqli_fetch_all($courses_result, MYSQLI_ASSOC);
    }
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
    <!-- Link to Bootstrap CSS CDN -->
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous"> -->
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
            <li style="list-style: none;" class="text-light mx-3"><i class="bi bi-box-arrow-right"></i>&nbsp;<a href="view-enrollments.php" class="text-light">View Enrollments</a></li><br>
            <li style="list-style: none;" class="text-light mx-3"><i class="bi bi-box-arrow-right"></i>&nbsp;<a href="logout.php" class="text-light">Logout</a></li><br>
        </ul>
    </div>
    <div class="col-lg-10 mt-4">
        <h1>Manage User</h1>
        <!-- Display user details in the form -->
        <form method="post" action="">
            <label for="firstname" class="form-label text-dark">First Name:</label>
            <input type="text" name="firstName" class="form-control" pattern="[A-Za-z\s']+" title="Please enter letters only, numbers are not allowed!" value="<?php echo $firstName; ?>" required>
      
            <label for="lastname" class="form-label text-dark mt-3">Last Name:</label>
            <input type="text" name="lastName" class="form-control" pattern="[A-Za-z\s']+" title="Please enter letters only, numbers are not allowed!" value="<?php echo $lastName; ?>" required>

            <label for="email" class="form-label text-dark mt-3">E-mail:</label>
            <input type="email" name="email" class="form-control" value="<?php echo $email; ?>" required>

            <label for="Phone Number" class="form-label text-dark mt-3">Phone number:</label>
            <input type="tel" name="phone" class="form-control" pattern="^(07\d{8}|01\d{8}|\+2547\d{8})$" value="<?php echo $phone; ?>" required>

            <?php
            // Query to fetch available roles from the database
            $roles_query = "SELECT DISTINCT user_role FROM students";
            $roles_result = mysqli_query($conn, $roles_query);

            // Check if the query was successful and roles exist
            if ($roles_result && mysqli_num_rows($roles_result) > 0) {
                // Fetch all rows at once
                $roles = mysqli_fetch_all($roles_result, MYSQLI_ASSOC);
            }
            ?>
            <label for="role" class="form-check-label text-dark mt-3">Role:</label>
            <select name="role" class="form-control">
                <?php foreach ($roles as $role) : ?>
                    <option value="<?php echo $role['user_role']; ?>" <?php echo ($role['user_role'] === $user_role) ? 'selected' : ''; ?>><?php echo $role['user_role']; ?></option>
                <?php endforeach; ?>
            </select><br>

            <input type="hidden" name="email" value="<?php echo $email; ?>"> <!-- Include email as hidden field -->
            <button type="submit" class="btn btn-primary mt-5" style="border-radius:20px;" name="update">Save Changes</button>
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
                                <form method="post" action="">
                                    <input type="hidden" name="course_code" value="<?php echo $course['course_code']; ?>">
                                    <button type="submit" name="delete_course" class="btn btn-danger btn-sm"><i class="bi bi-trash"></i> Delete</button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                    <?php
                    if (mysqli_num_rows($courses_result) == 0) {
                        echo '<tr><td colspan="4" class="text-dark">No courses found.</td></tr>'; // Displayed if no courses are available in the database
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?php   
require_once "footer.php";
?>
<!-- Bootstrap JS CDN link -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
