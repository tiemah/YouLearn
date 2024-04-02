<?php
// Include database connection
require_once "conn.php";
require_once "navbar2.php";
require_once "styles.php";

// Check if form is submitted
if(isset($_POST['add_material'])){
    // Sanitize input
    $course_code = mysqli_real_escape_string($conn, $_POST['course_code']);
    $material_name = mysqli_real_escape_string($conn, $_POST['material_name']);

    // File upload handling
    $targetDir = "uploads/";
    $fileName = basename($_FILES["material_file"]["name"]);
    $targetFilePath = $targetDir . $fileName;
    $fileType = pathinfo($targetFilePath,PATHINFO_EXTENSION);

    // Allow certain file formats
    $allowTypes = array('pdf', 'doc', 'docx', 'txt');
    if(in_array($fileType, $allowTypes)){
        // Upload file to server
        if(move_uploaded_file($_FILES["material_file"]["tmp_name"], $targetFilePath)){
            // Insert material details into database
            $insertQuery = "INSERT INTO learning_materials (course_code, material_name, material_file) VALUES ('$course_code', '$material_name', '$targetFilePath')";
            if(mysqli_query($conn, $insertQuery)){
                echo "Material added successfully.";
            } else{
                echo "Error: " . mysqli_error($conn);
            }
        } else{
            echo "Error uploading file.";
        }
    } else{
        echo "File type not allowed.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add learning material</title>
</head>
<body>
    <div class="row">
        <div class="col-lg-4"></div>
        <div class="col-lg-4">
            <h3 class="mt-5">Add Learning Material</h3><br>
            <form action=""  method="post" enctype="multipart/form-data">
                <!-- Course code -->
                <label for="course_code" class="text-dark">Course Code</label><br>
                <input type="text" id="course_code" name="course_code" class="form-control" required><br>
                
                <!-- Material title -->
                <label for="mat_title" class="text-dark"> Course Title</label><br>
                <input type="text" id="mat_title" name="material_name" class="form-control" required><br>

                <!-- File upload -->
                <label for="fileUpload" class="text-dark">Upload File</label><br>
                <input type="file" id="fileUpload" accept=".pdf,.docx,.pptx" name="material_file" accept=".pdf,.docx,.pptx" required><br>
                <!-- <input type="file" id="fileUpload" name="material_file" accept=".pdf,.docx,.pptx"><br> -->
                <small>Allowed types: .pdf, .docx, .pptx</small><br><br>

                <!-- Submit button -->
                <input type="submit" value="Submit" name="add_material" class="btn btn-primary" style="border-radius: 20px;">
            </form> 
        </div>
    </div>
    <?php
        require_once "footer.php";
    ?>
</body>
</html>