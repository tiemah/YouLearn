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
        <div class="col-lg-4"></div>

        <div class="col-lg-4">
            <h2 class="mt-4 text-center">Add Course</h2>
            <form action="" method="POST">
                
                <div class="mt-1">
                <label for="exampleFormControlInput1" class="form-label text-dark">Course Name</label>
                <input type="text" class="form-control" id="exampleFormControlInput1" name="course_name" placeholder="e.g Engineering and Software Law">
                </div><br>
                <div class="mb-3">
                <label for="exampleFormControlTextarea1" class="form-label text-dark">Course Description</label>
                <textarea class="form-control" id="exampleFormControlTextarea1" name="course-description" placeholder="e.g Laws of Software" rows="3"></textarea>
                </div>
                 <div class="buttons mx-5 mt-3">
                <button class="btn btn-primary" name="course-btn" value="submit" style="border-radius: 20px;">Add</button>
                <button class="btn btn-primary" value="reset" style="border-radius: 20px; margin-left:130px;">Reset</button>
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