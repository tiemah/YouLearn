<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Course</title>
</head>
<body>
    <?php
        require_once "navbar2.php";
        require_once "styles.php";
    ?>
    <div class="row mb-5">
    <div class="row mt-0">
        <div class="col-lg-2 bg-primary">
        <ul class="mt-3">
            <li style="list-style: none;" class="text-light mx-3 mt-3"><i class="bi bi-house"></i>&nbsp;<a href="admin-dashboard.php" class="text-light">Home</a></li><br>
            <li style="list-style: none;" class="text-light mx-3"><i class="bi bi-person"></i>&nbsp;<a href="admin-profile.php" class="text-light">Profile</a></li><br>
            <li style="list-style: none;" class="text-light mx-3"><i class="bi bi-person-plus"></i>&nbsp;<a href="users.php" class="text-light">Manage users</a></li><br>
            <li style="list-style: none;" class="text-light mx-3"><i class="bi bi-book"></i>&nbsp;<a href="manage-courses.php" class="text-light">Manage courses</a></li><br>
            <li style="list-style: none;" class="text-light mx-3"><i class="bi bi-box-arrow-right"></i>&nbsp;<a href="view-enrollments.php" class="text-light">View Enrollments</a></li><br>
            <li style="list-style: none;" class="text-light mx-3"><i class="bi bi-box-arrow-right"></i>&nbsp;<a href="logout.php" class="text-light">Logout</a></li><br>
        </ul>
                </div>

        <div class="col-lg-10">
            <h2 class="mt-4 text-center">Add Course</h2>
            <form action="courseAdd.php" method="POST" enctype="multipart/form-data">
                
                <div class="mt-1">
                <label for="exampleFormControlInput1" class="form-label text-dark">Course Code</label>
                <input type="text" class="form-control" id="exampleFormControlInput1" name="course_code" placeholder="e.g COM 424"><br>
                
                <label for="exampleFormControlInput1" class="form-label text-dark">Course Name</label>
                <input type="text" class="form-control" id="exampleFormControlInput2" name="course_name" placeholder="e.g Engineering and Software Law">
                <br>
                <div class="mb-3">
                <label for="exampleFormControlTextarea1" class="form-label text-dark">Course Description</label>
                <textarea class="form-control" id="exampleFormControlTextarea1" name="course_description" placeholder="e.g Laws of Software" rows="3"></textarea>
                </div>
                <!-- Input field for uploading PDF file
                <label for="pdfFile" class="text-dark">Upload File</label><br>
                <input type="file" id="pdfFile" name="pdfFile"><br><br> -->

                 <div class="buttons mx-5 mt-3">
                <button class="btn btn-primary" name="course-btn" value="submit" style="border-radius: 20px;">Add</button>
                <!-- <button class="btn btn-primary" value="reset" style="border-radius: 20px; margin-left:130px;">Reset</button> -->
                 </div>
            </form>
        </div>
    </div>

    <?php
        require_once "footer.php";
    ?>
    <!-- JavaScript Libraries -->
 <script type="text/javascript" src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    
    
</body>
</html>