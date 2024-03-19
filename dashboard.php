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
      require_once "navbar2.php";
      require_once "styles.php";
    ?>
    
    <div class="row mt-5">
        <div class="col-lg-2 bg-primary mt-5">
            <ul class="mt-3">
                <li style="list-style: none;" class="text-dark mx-5 mt-4"><i class="bi bi-person"></i>&nbsp;&nbsp;Profile</li><hr>
                <li style="list-style: none;" class="text-dark mx-5"><i class="bi bi-check-square"></i>&nbsp;&nbsp;Enrollment</li><hr>
                <li style="list-style: none;" class="text-dark mx-5"><i class="bi bi-book"></i>&nbsp;&nbsp;View courses</li><hr>
                <li style="list-style: none;" class="text-dark mx-5">My courses</li><hr>
                <li style="list-style: none;" class="text-dark mx-5">My courses</li><hr>
                <li style="list-style: none;" class="text-dark mx-5">My courses</li><hr>
            </ul>
        </div>
        <div class="col-lg-10 mt-5">
            <table class="table table-hover">
                <thead class="table-dark">
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">Course Title</th>
                    <th scope="col">Course Code</th>
                    <th scope="col">Semester</th>
                    <th scope="col" colspan="2" class="text-center">Action</th>
                    <!-- <th scope="col">Action</th> -->
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <th scope="row">1</th>
                    <td>Engineering and Software Law</td>
                    <td>COM 421</td>
                    <td>Y4S2</td>
                    <td><button type="submit" class="btn btn-success" name="enroll">Enroll</button></td>
                    <td><button type="submit" class="btn btn-danger" name="discard">Discard</button></td>
                  </tr>
                  <tr>
                    <th scope="row">2</th>
                    <td>Neural Networks</td>
                    <td>COM 424</td>
                    <td>Y4S2</td>
                    <td><button type="submit" class="btn btn-success" name="enroll">Enroll</button></td>
                    <td><button type="submit" class="btn btn-danger" name="discard">Discard</button></td>
                  </tr>
                  <tr>
                    <th scope="row">3</th>
                    <td>Neural Networks</td>
                    <td>COM 424</td>
                    <td>Y4S2</td>
                    <td><button type="submit" class="btn btn-success" name="enroll">Enroll</button></td>
                    <td><button type="submit" class="btn btn-danger" name="discard">Discard</button></td>
                  </tr>
                  <tr>
                    <th scope="row">4</th>
                    <td>Neural Networks</td>
                    <td>COM 424</td>
                    <td>Y4S2</td>
                    <td><button type="submit" class="btn btn-success" name="enroll">Enroll</button></td>
                    <td><button type="submit" class="btn btn-danger" name="discard">Discard</button></td>
                  </tr>
                  <tr>
                    <th scope="row">5</th>
                    <td>Neural Networks</td>
                    <td>COM 424</td>
                    <td>Y4S2</td>
                    <td><button type="submit" class="btn btn-success" name="enroll">Enroll</button></td>
                    <td><button type="submit" class="btn btn-danger" name="discard">Discard</button></td>
                  </tr>
                  <tr>
                    <th scope="row">6</th>
                    <td>Neural Networks</td>
                    <td>COM 424</td>
                    <td>Y4S2</td>
                    <td><button type="submit" class="btn btn-success" name="enroll">Enroll</button></td>
                    <td><button type="submit" class="btn btn-danger" name="discard">Discard</button></td>
                  </tr>
                  <tr>
                    <th scope="row">7</th>
                    <td>Neural Networks</td>
                    <td>COM 424</td>
                    <td>Y4S2</td>
                    <td><button type="submit" class="btn btn-success" name="enroll">Enroll</button></td>
                    <td><button type="submit" class="btn btn-danger" name="discard">Discard</button></td>
                  </tr>
                  <tr>
                    <th scope="row">8</th>
                    <td>Neural Networks</td>
                    <td>COM 424</td>
                    <td>Y4S2</td>
                    <td><button type="submit" class="btn btn-success" name="enroll">Enroll</button></td>
                    <td><button type="submit" class="btn btn-danger" name="discard">Discard</button></td>
                  </tr>
                </tbody>
              </table>
        </div>
    </div>
    <?php
       require_once "footer.php";
    ?>
    

    <!-- bootstrap js cdn link -->

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>