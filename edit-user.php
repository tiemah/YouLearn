<?php
session_start();
require_once "conn.php";
require_once "styles.php";
require_once "navbar.php";

// Retrieve and decode the email parameter
$email = isset($_GET['email']) ? base64_decode($_GET['email']) : '';

// Check if the user is logged in
if (!isset($_SESSION['login'])) {
    header("Location: login.php");
    exit; // Ensure script execution stops after redirection
}




    if(isset($_POST['update'])){
        $firstName = mysqli_real_escape_string($conn, $_POST['firstName']);
        $lastName = mysqli_real_escape_string($conn,$_POST['lastName']);
        $email = mysqli_real_escape_string($conn,$_POST['email']);
        $phone = mysqli_real_escape_string($conn, $_POST['phone']);

        if(empty($firstName)){
            echo "Please enter first name to proceed!";
        }elseif(empty($lastName)){
            echo "Please enter last name to proceed!";
        }elseif(empty($email)){
            echo "Please enter email to proceed!";
        }elseif(!is_numeric($phone)){
            echo "Only numbers are allowed in the phone field!";
        }else{
        $query=mysqli_query($conn,"UPDATE students SET firstName='$firstName',lastName='$lastName',email='$email',phone = '$phone' WHERE email='$email'")or die(mysqli_error($conn));

        if($query){
            ?>
                        <!-- sweetalert link -->
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
    <!-- link to bootstrap css cdn link -->
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous"> -->
</head>
<body>
<div class="row">
    <div class="col-lg-2 bg-primary mt-0">
        <!-- Sidebar content -->
        <ul class="mt-3">
            <li style="list-style: none;" class="text-light mx-3 mt-3"><i class="bi bi-house"></i>&nbsp;<a href="admin-dashboard.php" class="text-light">Home</a></li><br>
            <li style="list-style: none;" class="text-light mx-3"><i class="bi bi-person"></i>&nbsp;<a href="admin-profile.php" class="text-light">Profile</a></li><br>
            <li style="list-style: none;" class="text-light mx-3"><i class="bi bi-person-plus"></i>&nbsp;<a href="add-user.php" class="text-light">Manage users</a></li><br>
            <li style="list-style: none;" class="text-light mx-3"><i class="bi bi-book"></i>&nbsp;<a href="admin-dashboard.php" class="text-light">Manage courses</a></li><br>
            <li style="list-style: none;" class="text-light mx-3"><i class="bi bi-box-arrow-right"></i>&nbsp;<a href="logout.php" class="text-light">Logout</a></li><br>
        </ul>
    </div>
    <div class="col-lg-10 mt-4">
        <h1>Manage User</h1>
        <!-- Display user details in the form -->
        <form method="post" action="">
        <label for="firstname" class="form-label text-dark">First Name:</label>
        <input type="text" name="firstName" class="form-control" pattern="[A-Za-z\s']+" title="Please enter letters only, numbers are not allowed!" value="<?php echo $row['firstName']; ?>" required>
      
        <label for="lastname" class=" form-label text-dark mt-3">Last Name:</label>
        <input type="text" name="lastName" class="form-control" pattern="[A-Za-z\s']+" title="Please enter letters only, numbers are not allowed!" value="<?php echo $row['lastName']; ?>"required>


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
                        <form method="post" action="delete-course.php">
                            <input type="hidden" name="course_id" value="<?php echo $course['id']; ?>">
                            <button type="submit" class="btn btn-danger btn-sm"><i class="bi bi-trash"></i> Delete</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
            </table>
        </div>
    
    </div>
</div>
<?php   
    require_once "footer.php";
?>
<!-- bootstrap js cdn link -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
