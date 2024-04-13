<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Contact</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    
</head>
<?php
require_once "conn.php";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if all required fields are set
    if (isset($_POST['message-btn'])) {
        $name = $_POST['name'];
        $email = $_POST['email'];
        $subject = $_POST['subject'];
        $message = $_POST['message'];

        $query = mysqli_query($conn, "INSERT INTO contact(name, email, subject, message) VALUES('$name', '$email', '$subject', '$message')") or die(mysqli_error($conn));

        if($query){
            ?>
            <!-- SweetAlert link -->
            <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script> 
            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    swal("Success!", "Message sent successfully!", "success").then(() => {
                        window.location.href = "contact.php";
                    });
                });
            </script>
            <?php
        } else {
            ?>
            <!-- SweetAlert link -->
            <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script> 
            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    swal("Oops!", "Failed to send the message. Please try again", "warning").then(() => {
                        window.location.href = "contact.php";
                    });
                });
            </script>
            <?php
        }
    }
}
?>
<body>

    <!-- Contact Start -->
    <div class="container-xxl py-5">
        <div class="container">
            <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
                <h6 class="section-title bg-white text-center text-primary px-3">Contact Us</h6>
                <h1 class="mb-5">Contact For Any Query</h1>
            </div>
            <div class="row g-4">
                <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                    <h5>Get In Touch</h5>
                    <p class="mb-4">Need any assistance? Or have any feedback? Don't hesitate. Reach out to us today!</p>
                    <div class="d-flex align-items-center mb-3">
                        <div class="d-flex align-items-center justify-content-center flex-shrink-0 bg-primary" style="width: 50px; height: 50px;">
                            <i class="fa fa-map-marker-alt text-white"></i>
                        </div>
                        <div class="ms-3">
                            <h5 class="text-primary">Office</h5>
                            <p class="mb-0">123 Street, Uasin Gishu, Kenya </p>
                        </div>
                    </div>
                    <div class="d-flex align-items-center mb-3">
                        <div class="d-flex align-items-center justify-content-center flex-shrink-0 bg-primary" style="width: 50px; height: 50px;">
                            <i class="fa fa-phone-alt text-white"></i>
                        </div>
                        <div class="ms-3">
                            <h5 class="text-primary">Mobile</h5>
                            <p class="mb-0"><a href="tel: 0792899313" class="text-dark">+254 792899313</a></p>
                        </div>
                    </div>
                    <div class="d-flex align-items-center">
                        <div class="d-flex align-items-center justify-content-center flex-shrink-0 bg-primary" style="width: 50px; height: 50px;">
                            <i class="fa fa-envelope-open text-white"></i>
                        </div>
                        <div class="ms-3">
                            <h5 class="text-primary">Email</h5>
                            <p class="mb-0"><a href="mailto:doreentiema87@gmail.com" class="text-dark">doreentiema87@gmail.com</a></p>
                        </div>
                    </div>
                </div>
                
                <div class="col-lg-8 col-md-12 wow fadeInUp" data-wow-delay="0.5s">
                    <form action="" method="post"> 
                        <div class="row g-3">
                            <div class="col-md-6">
                                
                                    <label for="name">Your Name</label>
                                    <input type="text" class="form-control" id="name" placeholder="e.g Jane" name="name" required>
                                    
                                
                            </div>
                            <div class="col-md-6">
                                
                                    <label for="email">Your Email</label>
                                    <input type="email" class="form-control" id="email" placeholder="e.g janedoe@gmail.com" name="email" required>
                                    
                                
                            </div>
                            <div class="col-12">
                                
                                    <label for="subject">Subject</label>
                                    <input type="text" class="form-control" id="subject" placeholder="Your subject" name= "subject" required>
                                   
                                
                            </div>
                            <div class="col-12">
                                
                                <label for="message">Message</label>
                                    <textarea class="form-control" placeholder="Leave a message here" id="message" style="height: 150px" name= "message" required></textarea>
                                   
                                
                            </div>
                            <div class="col-12">
                                <button class="btn btn-primary w-100 py-3" type="submit"  name="message-btn">Send Message</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Contact End -->


   <?php
   require_once "footer.php";
?>


    <!-- Back to Top -->
    <!-- <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a> -->


    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="lib/wow/wow.min.js"></script>
    <script src="lib/easing/easing.min.js"></script>
    <script src="lib/waypoints/waypoints.min.js"></script>
    <script src="lib/owlcarousel/owl.carousel.min.js"></script>

    <!-- Template Javascript -->
    <script src="js/main.js"></script>
</body>

</html>