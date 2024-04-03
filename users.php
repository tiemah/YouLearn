<?php
session_start();
require_once "conn.php";
require_once "styles.php";
require_once "navbar2.php";

// Check if the user is logged in
if (!isset($_SESSION['login'])) {
    header("Location: login.php");
    exit; // Ensure script execution stops after redirection
}

// Define pagination variables
$records_per_page = 10; // Number of records to display per page
$page = isset($_GET['page']) && is_numeric($_GET['page']) ? $_GET['page'] : 1; // Current page number
$offset = ($page - 1) * $records_per_page; // Calculate offset for query

// Query to fetch total number of users for pagination
$total_users_query = "SELECT COUNT(*) AS total FROM students";
$total_users_result = mysqli_query($conn, $total_users_query);
$total_users = mysqli_fetch_assoc($total_users_result)['total'];

// Query to fetch users for the current page
$query = "SELECT * FROM students LIMIT $offset, $records_per_page";
$result = mysqli_query($conn, $query);

if ($result && mysqli_num_rows($result) > 0) {
    ?>
    <div class="row mt-0">
        <div class="col-lg-2 bg-primary mt-5">
            <!-- Sidebar content -->
            <ul class="mt-3">
                <li style="list-style: none;" class="text-light mx-3 mt-3"><i class="bi bi-house"></i>&nbsp;<a href="admin-dashboard.php" class="text-light">Home</li><br>
                <li style="list-style: none;" class="text-light mx-3"><i class="bi bi-person"></i>&nbsp;<a href="admin-profile.php" class="text-light">Profile</a></li><br>
                <li style="list-style: none;" class="text-light mx-3"><i class="bi bi-person-plus"></i>&nbsp;<a href="users.php" class="text-light">Manage users</a></li><br>
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
                        $count = $offset + 1; // Counter for displaying row numbers
                        while ($row = mysqli_fetch_assoc($result)) {
                            echo '<tr>';
                            echo '<th scope="row">' . $count++ . '</th>';
                            echo '<td>' . $row['firstName'] . '</td>';
                            echo '<td>' . $row['lastName'] . '</td>';
                            echo '<td>' . $row['email'] . '</td>';
                            echo '<td>' . $row['phone'] . '</td>';
                            echo '<td>';
                            // Edit link
                            echo '<a href="edit-user.php?email=' . base64_encode($row['email']) . '" class="btn btn-primary btn-sm"><i class="bi bi-pencil"></i></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
                            // Delete form
                            echo '<form method="post" class="d-inline" action="delete-user.php">';
                            // echo '<input type="hidden" name="id" value="' . $row['id'] . '">';
                            echo '<button type="submit" class="btn btn-danger btn-sm"><i class="bi bi-trash"></i></button>';
                            echo '</form>';
                            echo '</td>';
                            echo '</tr>';
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <?php
    // Pagination links
    if ($total_users > $records_per_page) {
        $total_pages = ceil($total_users / $records_per_page);
        ?>
        <div class="row">
            <div class="col-lg-12">
                <nav aria-label="Page navigation">
                    <ul class="pagination justify-content-center">
                        <?php if ($page > 1) : ?>
                            <li class="page-item">
                                <a class="page-link" href="users.php?page=<?php echo $page - 1; ?>" aria-label="Previous">
                                    <span aria-hidden="true">&laquo;</span>
                                </a>
                            </li>
                        <?php endif; ?>
                        <?php for ($i = 1; $i <= $total_pages; $i++) : ?>
                            <li class="page-item <?php echo $page == $i ? 'active' : ''; ?>">
                                <a class="page-link" href="users.php?page=<?php echo $i; ?>"><?php echo $i; ?></a>
                            </li>
                        <?php endfor; ?>
                        <?php if ($page < $total_pages) : ?>
                            <li class="page-item">
                                <a class="page-link" href="users.php?page=<?php echo $page + 1; ?>" aria-label="Next">
                                    <span aria-hidden="true">&raquo;</span>
                                </a>
                            </li>
                        <?php endif; ?>
                    </ul>
                </nav>
            </div>
        </div>
    <?php
    }
} else {
    echo '<div class="alert alert-info" role="alert">No available users.</div>';
}

require_once "footer.php";
?>

<!-- bootstrap js cdn link -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
