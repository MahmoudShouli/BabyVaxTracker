<!doctype html>
<html>
<head>
    <style>
        .message {
            color: red;
        }
    </style>
    <meta lang="en" charset="utf-8">
    <title>BabyVaxTrack</title>
    <link rel="icon"type="image/x-icon" href="../../Resources/images/logo.png">
    <link rel="stylesheet" type="text/css" href="../css/login.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Poppins:200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i&display=swap" rel="stylesheet">

    <!-- icofont CSS -->
    <link rel="stylesheet" href="../css/icofont.css">

     <!-- Favicon -->
     <link rel="icon" href="../../Resources/images/favicon.png">

     <!-- Google Fonts -->
     <link href="https://fonts.googleapis.com/css?family=Poppins:200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i&display=swap" rel="stylesheet">
 
     <!-- Bootstrap CSS -->
     <link rel="stylesheet" href="../css/bootstrap.min.css">
     <!-- Nice Select CSS -->
     <link rel="stylesheet" href="../css/nice-select.css">
     <!-- Font Awesome CSS -->
     <link rel="stylesheet" href="../css/font-awesome.min.css">
     <!-- icofont CSS -->
     <link rel="stylesheet" href="../css/icofont.css">
     <!-- Slicknav -->
     <link rel="stylesheet" href="../css/slicknav.min.css">
     <!-- Owl Carousel CSS -->
     <link rel="stylesheet" href="../css/owl-carousel.css">
     <!-- Datepicker CSS -->
     <link rel="stylesheet" href="../css/datepicker.css">
     <!-- Animate CSS -->
     <link rel="stylesheet" href="../css/animate.min.css">
     <!-- Magnific Popup CSS -->
     <link rel="stylesheet" href="../css/magnific-popup.css">
 
     <!-- Medipro CSS -->
     <link rel="stylesheet" href="../css/normalize.css">
     <link rel="stylesheet" href="../css/style.css">
     <link rel="stylesheet" href="../css/responsive.css">
 


</head>
<body>
<?php
session_start();


if(isset($_SESSION['message']))

{
    $var = $_SESSION['message'];
    if($_SESSION['message'] === "Please sign in first") {
    echo "<script>";
    echo "alert('$var');";
    echo "</script>";
   // unset($_SESSION['message']);

}
if($_SESSION['message'] === "You already sign in "){
    $var = $_SESSION['message'];
   // unset($_SESSION['message']);
    header("Location: ../../FrontEnd/html/index.php");
   exit();


}
}

?>
<header>

    <a href="signin.php"><img src="../../Resources/images/logo.png" alt="this is the logo"></a>
</header>
<section class="vh-100">
    <div class="container py-5 h-100">
        <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col-md-8 col-lg-6">
                <div class="card" style="border-radius: 1rem; background-color: transparent; border: none;">

                    <div class="card-body p-4 p-lg-5 text-black" style="background-color: rgba(255, 255, 255, 0.9); border-radius: 1rem;">

                        <form  action="../../BackEnd/php/signin.php" method="POST" id="form">
                            <h5 class="h3 fw-bold mb-5" style="letter-spacing: 1px;">Sign in to your account</h5>

                            <div data-mdb-input-init class="form-outline mb-4">
                                <label class="form-label" for="form2Example17">UserName</label>
                                <input placeholder="Enter The Email or Phone Number" type="text" id="form2Example17" class="form-control form-control-lg" name="username" />
                            </div>

                            <div data-mdb-input-init class="form-outline mb-4">
                                <label class="form-label" for="form2Example27">Password</label>
                                <input placeholder="Enter The Password  " name="password" type="password" id="form2Example27" class="form-control form-control-lg" />
                            </div>

                            <div class="pt-1 mb-4">
                                <button data-mdb-button-init data-mdb-ripple-init class="btn btn-dark btn-lg btn-block" type="submit">Login</button>
                                <br>
                                <div id="em" >

                                </div>
                                </div>

                            <a class="small text-muted" href="resetpassword.html">Forgot password?</a>
                            <p class="mb-5 pb-lg-2" style="color: #393f81;">Don't have an account? <a href="../html/signup.html" style="color: #393f81;">Register here</a></p>
                            <a href="#!" class="small text-muted">Terms of use.</a>
                            <a href="#!" class="small text-muted">Privacy policy</a>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
</section>





</div>
<script>
    // Get the URL parameters
    const urlParams = new URLSearchParams(window.location.search);

    // Get the error message
    const error_msg = urlParams.get('error_msg');

    // Check if the error message is "Please fill in all required fields."
        document.getElementById('em').innerText = error_msg;

</script>





<!-- Footer Area -->
<footer id="footer" class="footer ">
    <!-- Footer Top -->
    <div class="footer-top">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-6 col-12">
                    <div class="single-footer">
                        <h2>Social Media</h2>
                        <!-- Social -->
                        <ul class="social">
                            <li><a href="#"><i class="icofont-facebook"></i></a></li>
                            <li><a href="#"><i class="icofont-instagram"></i></a></li>
                            <li><a href="#"><i class="icofont-twitter"></i></a></li>
                        </ul>
                        <!-- End Social -->
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-12">
                    <div class="single-footer f-link">
                        <h2>Quick Links</h2>
                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-12">
                                <ul>
                                    <li><a href="../html/signin.php"><i class="fa fa-caret-right" aria-hidden="true"></i>Home</a></li>
                                    <li><a href="../html/signin.php#about"><i class="fa fa-caret-right" aria-hidden="true"></i>About Us</a></li>
                                    <li><a href="../html/signin.php#service"><i class="fa fa-caret-right" aria-hidden="true"></i>Services</a></li>
                                </ul>
                            </div>
                            <div class="col-lg-6 col-md-6 col-12">
                                <ul>
                                    <li><a href="../html/signin.php#neews"><i class="fa fa-caret-right" aria-hidden="true"></i>News</a></li>
                                    <li><a href="../html/contact.html"><i class="fa fa-caret-right" aria-hidden="true"></i>Contact Us</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-12">
                    <div class="single-footer">
                        <h2>Open Hours</h2>
                        <ul class="time-sidual">
                            <li class="day">Sunday - Friday <span>8.00 am - 4.00 pm</span></li>
                            <li class="day">Friday <span>10.00 am - 2.00 pm</span></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-12">
                    <div class="single-footer">
                        <h2>Newsletter</h2>
                        <p>subscribe to our newsletter to get all our news in your inbox</p>
                        <form action="" method="get" target="_blank" class="newsletter-inner">
                            <input name="email" placeholder="Email Address" class="common-input" onfocus="this.placeholder = ''"
                                   onblur="this.placeholder = 'Your email address'" required="" type="email">
                            <button class="button"><i class="icofont icofont-paper-plane"></i></button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--/ End Footer Top -->
    <!-- Copyright -->
    <div class="copyright">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-12">
                    <div class="copyright-content">
                        <p>© Copyright 2024  |  All Rights Reserved</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--/ End Copyright -->
</footer>
<!--/ End Footer Area -->

</body>
</html>