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
        session_start();
        require_once "navbar2.php";
        require_once "styles.php";
        require_once "conn.php"; // Include the file containing database connection details

        // Query to fetch course data from the database
        $query = "SELECT * FROM courses";
        $result = mysqli_query($conn, $query);
    ?>
    
    <div class="row mt-0">
        <div class="col-lg-2 bg-primary mt-5">
            <!-- Sidebar content -->
            <ul class="mt-3">
                <li style="list-style: none;" class="text-light mx-3 mt-4"><i class="bi bi-person"></i>&nbsp;<a href="profile.php" class="text-light">Profile</a></li><br>
                <li style="list-style: none;" class="text-light mx-3"><i class="bi bi-check-square"></i>&nbsp;<a href="enrollment.php" class="text-light">Course enrollment</a></li><br>
                <li style="list-style: none;" class="text-light mx-3"><i class="bi bi-book"></i>&nbsp;View Courses</li><br>
                <li style="list-style: none;" class="text-light mx-3"><i class="bi bi-book"></i>&nbsp;Learning Materials</li><br>
                
            </ul>
        </div>
        <div class="col-lg-10 mt-5">
          <div class="table-responsive">
            <table class="table table-hover">
                <thead class="table-dark">
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Course Title</th>
                        <th scope="col">Course Description</th>
                        <th scope="col">Enroll</th>
                        <th scope="col">View</th>
                        <!-- <th scope="col" colspan="2" class="text-center">Action</th> -->
                    </tr>
                </thead>
                <tbody>
                  <?php
                  if ($result && mysqli_num_rows($result) > 0) {
                      $count = 1;
                      // Loop through the fetched course data
                      while ($row = mysqli_fetch_assoc($result)) {
                          // Output table rows for each course
                          echo '<tr>';
                          echo '<th scope="row">' . $count++ . '</th>';
                          echo '<td>' . $row['course_name'] . '</td>';
                          echo '<td>' . $row['course_description'] . '</td>';
                          echo '<td>';
                          // Form for enrolling into the course
                          echo '<form method="post" action="enroll.php">';
                          echo '<input type="hidden" name="course_id" value="' . $row['course_id'] . '">';
                          echo '<button type="button" class="btn btn-success" name="enroll" style="border-radius: 20px;">Enroll</button>';
                          echo '</form>';
                          echo '</td>';
                          echo '<td><button type="button" class="btn btn-danger" name="discard" style="border-radius: 20px;">Discard</button></td>';
                          echo '</tr>';
                      }
                  } else {
                      echo '<tr><td colspan="4">No courses found.</td></tr>'; // Displayed if no courses are available in the database
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
