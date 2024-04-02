<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Users</title>
    <!-- link to bootstrap css cdn link -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
    <?php
        session_start();
        $email = $_SESSION['login'];
        if(!isset($_SESSION['login'])){
            header("Location:login.php");
        }
        
        require_once "navbar2.php";
        require_once "styles.php";
        require_once "conn.php"; // Include the file containing database connection details

        // Query to fetch user data from the database
        $query = "SELECT * FROM students";
        $result = mysqli_query($conn, $query);
        
        if ($result && mysqli_num_rows($result) > 0) {
            
        } else {
            echo '<div class="alert alert-info" role="alert">No available users.</div>';
        }
    ?>

    <div class="row mt-0">
        <div class="col-lg-2 bg-primary mt-5">
            <!-- Sidebar content -->
            <ul class="mt-3">
                <li style="list-style: none;" class="text-light mx-3 mt-3"><i class="bi bi-house"></i>&nbsp;<a href="admin-dashboard.php" class="text-light">Home</li><br>
                <li style="list-style: none;" class="text-light mx-3"><i class="bi bi-person"></i>&nbsp;<a href="admin-profile.php" class="text-light">Profile</a></li><br>
                <li style="list-style: none;" class="text-light mx-3"><i class="bi bi-person-plus"></i>&nbsp;<a href="add-user.php" class="text-light">Manage users</a></li><br>
                <li style="list-style: none;" class="text-light mx-3"><i class="bi bi-book"></i>&nbsp;<a href="admin-dashboard.php" class="text-light">Manage courses</a></li><br>
                <li style="list-style: none;" class="text-light mx-3"><i class="bi bi-box-arrow-right"></i>&nbsp;<a href="logout.php" class="text-light">Logout</a></li><br>
            </ul>
        </div>
        <div class="col-lg-10 mt-5">
          <div class="table-responsive">
            <table class="table table-hover">
                <thead class="table-dark">
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">First Name</th>
                        <th scope="col">Last Name</th>
                        <th scope="col">Email Address</th>
                        <th scope="col">Phone Number</th>
                        <th scope="col">Manage</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if ($result && mysqli_num_rows($result) > 0) {
                        $count = 1;
                        // Loop through the fetched user data
                        while ($row = mysqli_fetch_assoc($result)) {
                            // Output table rows for each user
                            echo '<tr>';
                            echo '<th scope="row">' . $count++ . '</th>';
                            echo '<td>' . $row['firstName'] . '</td>';
                            echo '<td>' . $row['lastName'] . '</td>';
                            echo '<td>' . $row['email'] . '</td>';
                            echo '<td>' . $row['phone'] . '</td>';
                            echo '<td>';
                            // Edit icon with link to edit-user.php passing user ID
                            echo '<a href="edit-user.php?email=' . base64_encode($row['email']) . '" class="btn btn-primary btn-sm"><i class="bi bi-pencil"></i></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';

                            // echo '</td>';
                            // echo '<td>';
                            // Delete icon with form to submit for delete action
                            echo '<form method="post" class="d-inline" action="delete-user.php">';
                            echo '<input type="hidden" name="id" value="' . $row['id'] . '">';
                            echo '<button type="submit" class="btn btn-danger btn-sm"><i class="bi bi-trash"></i></button>';
                            echo '</form>';
                            echo '</td>';
                            echo '</tr>';
                        }
                    } else {
                        echo '<tr><td colspan="5">No users found.</td></tr>'; // Displayed if no users are available in the database
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

    <!-- bootstrap js cdn link -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
