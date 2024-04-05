<?php
// Include database connection and start session if not already started
require_once "conn.php";
session_start();

// Check if the material ID is provided in the URL
if(isset($_GET['course_code'])) {
    $course_code = $_GET['course_code'];

    // Query to fetch the material data from the database
    $query = "SELECT material_filedata FROM learning_materials WHERE course_code = ?";

    // Prepare the SQL statement
    $stmt = mysqli_prepare($conn, $query);

    // Check if the SQL statement preparation was successful
    if ($stmt === false) {
        die(mysqli_error($conn)); // Display any error message if there's an issue with the SQL query
    }

    // Bind the course code parameter to the SQL statement
    mysqli_stmt_bind_param($stmt, "s", $course_code);

    // Execute the SQL statement
    $result = mysqli_stmt_execute($stmt);

    // Check if the SQL statement execution was successful
    if ($result === false) {
        die(mysqli_error($conn)); // Display any error message if there's an issue with executing the SQL query
    }

    // Bind the result variable to the statement
    mysqli_stmt_bind_result($stmt, $material_filedata);

    // Fetch the result
    mysqli_stmt_fetch($stmt);

    // Close the statement
    mysqli_stmt_close($stmt);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Materials</title>
</head>
<body>
    <div>
        <h1>Course Code: <?php echo htmlspecialchars($course_code); ?></h1>
        <h2>Material Content</h2>
        <!-- Embed the PDF content -->
        <?php
        // Check if material file data exists
        if ($material_filedata) {
            echo '<embed src="data:application/pdf;base64,' . base64_encode($material_filedata) . '" type="application/pdf" width="100%" height="600px">';
        } else {
            echo '<p>No material available for this course.</p>';
        }
        ?>
    </div>
</body>
</html>
