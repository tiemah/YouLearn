<?php
    // Include database connection
    require_once "conn.php";

    // Query to fetch enrollment statistics
    $query = "SELECT course_code, COUNT(*) AS enrollments FROM enrollment GROUP BY course_code";
    $result = mysqli_query($conn, $query);

    // Check if query was successful
    if ($result && mysqli_num_rows($result) > 0) {
        // Display table header
        echo "<table border='1'>";
        echo "<tr><th>Course Code</th><th>Enrollments</th></tr>";

        // Loop through the fetched data and display in a table
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>";
            echo "<td>" . $row['course_code'] . "</td>";
            echo "<td>" . $row['enrollments'] . "</td>";
            echo "</tr>";
        }

        echo "</table>";
    } else {
        // Display message if no enrollments found
        echo "No enrollments found.";
    }

    // Close database connection
    mysqli_close($conn);
?>
