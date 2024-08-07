<!doctype html>
<html class="no-js" lang="zxx">
<head>
    <!-- Meta Tags -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="keywords" content="Site keywords here">
    <meta name="description" content="">
    <meta name='copyright' content=''>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Title -->
    <title>BabyVaxTrack</title>

    <!-- Favicon -->
    <link rel="icon" href="../../Resources/images/favicon.png">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Poppins:200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i&display=swap" rel="stylesheet">
    <script src="../js/auto-email-sender.js"></script>
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

    <style>
        .comic-neue-bold {
            font-family: "Comic Neue", cursive;
            font-weight: 700;
            font-style: normal;
        }
    </style>

</head>
<body>
<?php
session_start();


$_SESSION['contact'] = 'nothing';


// Check if the user is logged in
if (!isset($_SESSION['USER']) || !isset($_SESSION['ROLE']) || $_SESSION['ROLE'] !== '2'){

//ali turabi
    $_SESSION['message'] = "Please sign in first";
    header("Location: ../../FrontEnd/html/signin.php");
    exit();
}
else {
    $_SESSION['message'] = "You already sign in ";


}

?>
<!-- Preloader -->
<div class="preloader">
    <div class="loader">
        <div class="loader-outter"></div>
        <div class="loader-inner"></div>

        <div class="indicator">
            <svg width="16px" height="12px">
                <polyline id="back" points="1 6 4 6 6 11 10 1 12 6 15 6"></polyline>
                <polyline id="front" points="1 6 4 6 6 11 10 1 12 6 15 6"></polyline>
            </svg>
        </div>
    </div>
</div>
<!-- End Preloader -->



<!-- Header Area -->
<header  class="header" >
    <!-- Topbar -->
    <div id = "header" class="topbar">
        <a href="../../BackEnd/php/tosignout.php" style="color:mediumblue; font-weight: bold; font-size: large;text-align: left; padding-left: 5% !important; padding-top:10px !important; ">Sign Out</a>
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-5 col-12">
                    <!-- Contact -->
                    <ul class="top-link">

                        <li><a href="#about">About</a></li>
                        <li><a href="../../FrontEnd/html/CTable.php">Schedules</a></li>
                        <li><a href="../../FrontEnd/html/booking.php">Booking Details</a></li>
                        <li><a href="../../FrontEnd/html/addchildren.php">Add Children</a></li>


                    </ul>
                    <!-- End Contact -->
                </div>
                <div class="col-lg-6 col-md-7 col-12">
                    <!-- Top Contact -->
                    <ul class="top-contact" style="font-size:14px;  ">
                        <?php
                        require_once "../../BackEnd/php/db_connect.php";

                        global $conn;




                        if (isset($_SESSION['USER'])) {

                            $user_name = $_SESSION['USER'];
                            if (substr($user_name, 0, 2) === "05") {
                                $query = "SELECT user_name FROM users WHERE users.phone = ?";
                            }
                            else
                                $query = "SELECT user_name FROM users WHERE users.email = ?";

                            $stmt = $conn ->prepare($query);
                            $stmt->bind_param("s", $user_name);
                            $stmt->execute();
                            $result = $stmt->get_result();
                            $row = $result->fetch_assoc();
                            $userName = $row['user_name'];
                            echo "                        <li><i  class = 'comic-neue-bold' style='text-transform: capitalize; font-size: x-large'>Hi, $userName!</i></li>";
                        } else {
                            echo "                        <li><i>Hi, Guest</i></li>";
                        }
                        ?>


                        <!--                        <li><i class="fa fa-phone"></i>0593021843</li>-->
<!--                        <li><i class="fa fa-envelope"></i><a href="mailto:support@yourmail.com">babyvaxtracker-support@gmail.com</a></li>-->
                    </ul>
                    <!-- End Top Contact -->
                </div>
            </div>
        </div>
    </div>
    <!-- End Topbar -->
    <!-- Header Inner -->
    <div class="header-inner">
        <div class="container">
            <div class="inner">
                <div class="row">
                    <div class="col-lg-3 col-md-3 col-12">
                        <!-- Start Logo -->
                        <div class="logo">
                            <a href="../html/signin.php"><img src="../../Resources/images/logo.png" alt="#"></a>
                        </div>
                        <!-- End Logo -->
                        <!-- Mobile Nav -->
                        <div class="mobile-nav"></div>
                        <!-- End Mobile Nav -->
                    </div>
                    <div class="col-lg-7 col-md-9 col-12">
                        <!-- Main Menu -->
                        <div class="main-menu">
                            <nav class="navigation">
                                <ul class="nav menu">
                                    <li><a href="#header">Home </a></li>
                                    <li><a href="#service">Services </a></li>
                                    <?php
                                    if($_SESSION['ROLE']==2)
                                        echo '<li><a href="../html/feedback.php">Profile</a></li>';
                                    elseif ($_SESSION['ROLE']==1)
                                        echo '<li><a href="../html/admin_feedback.php">Profile</a></li>';
                                    ?>
                                    <li><a href="contact_page.php">Contact Us</a></li>
                                </ul>
                            </nav>
                        </div>
                        <!--/ End Main Menu -->
                    </div>
                    <div class="col-lg-2 col-12">
                        <div class="get-quote">
                            <a href="../html/appointment.php" class="btn">Book Appointment</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--/ End Header Inner -->
</header>
<!-- End Header Area -->

<!-- Slider Area -->
<section class="slider">
    <div class="hero-slider">
        <!-- Start Single Slider -->
        <div class="single-slider" style="background-image:url('../../Resources/images/sliderone.jpg')">
            <div class="container">
                <div class="row">
                    <div class="col-lg-7">
                        <div class="text">
                            <h1>We Provide The Best <span>Vaccines</span> For Your Babies!</h1>
                            <p>Look at the best and latest vaccines news for your babies health. </p>
                            <div class="button">
                                <a href="#news" class="btn">Learn More</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Single Slider -->
        <!-- Start Single Slider -->
        <div class="single-slider" style="background-image:url('../../Resources/images/slider.jpg')">
            <div class="container">
                <div class="row">
                    <div class="col-lg-7">
                        <div class="text">
                            <h1>Look At The <span>Schedules</span> And Book A Time That Suits You!</h1>
                            <p>We offer a flexible shcedule with different doctors, take a look and book! </p>
                            <div class="button">
                                <a href="../html/appointment.php" class="btn">Get Appointment</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Start End Slider -->
        <!-- Start Single Slider -->
        <div class="single-slider" style="background-image:url('../../Resources/images/slider3.jpg')">
            <div class="container">
                <div class="row">
                    <div class="col-lg-7">
                        <div class="text">
                            <h1>See What Other <span>People</span> Think!</h1>
                            <p>Scroll through the reviews and feedback of previous experiences. </p>
                            <div class="button">
                                <a href="../html/feedback.php" class="btn">Feedback and Reviews</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Single Slider -->
    </div>
</section>
<!--/ End Slider Area -->

<!-- Start Schedule Area -->
<section class="schedule">
    <div class="container">
        <div class="schedule-inner">
            <div class="row">
                
                <div class="col-lg-4 col-md-12 col-12">
                    <!-- single-schedule -->
                    <div class="single-schedule last">
                        <div class="inner">
                            <div class="icon">
                                <i class="icofont-ui-clock"></i>
                            </div>
                            <div class="single-content">
                                <h4>Opening Hours</h4>
                                <ul class="time-sidual">
                                    <li class="day">Sunday - Thursday <span>8:00 am - 4:00 pm</span></li><br>

                                    <li class="day"><span><br><br></span></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-12">
                    <!-- single-schedule -->
                    <div class="single-schedule middle">
                        <div class="inner">
                            <div class="icon">
                                <i class="icofont-prescription"></i>
                            </div>
                            <div class="single-content">
                                <h4>Doctors Timetable</h4>
                                <p>Check when each doctor is available and when not</p>
                                <a href="CTable.php">GO<i class="fa fa-long-arrow-right"></i></a>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</section>
<!--/End Start schedule Area -->

<!-- Start Feautes -->
<section class="Feautes section">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="section-title">
                    <h2>We Are Always Ready to Help You & Your Family</h2>
                    <img src="../../Resources/images/section-img.png" alt="#">
                </div>
            </div>
        </div>

    </div>
</section>
<!--/ End Feautes -->

<!-- Start Fun-facts -->
<div id="fun-facts" class="fun-facts section overlay">
    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-md-6 col-12">
                <!-- Start Single Fun -->
                <div class="single-fun">
                    <i class="icofont icofont-home"></i>
                    <div class="content">
                        <span class="counter">30</span>
                        <p>Rooms</p>
                    </div>
                </div>
                <!-- End Single Fun -->
            </div>
            <div class="col-lg-3 col-md-6 col-12">
                <!-- Start Single Fun -->
                <div class="single-fun">
                    <i class="icofont icofont-user-alt-3"></i>
                    <div class="content">
                        <span class="counter">6</span>
                        <p>Specialist Doctors</p>
                    </div>
                </div>
                <!-- End Single Fun -->
            </div>
            <div class="col-lg-3 col-md-6 col-12">
                <!-- Start Single Fun -->
                <div class="single-fun">
                    <i class="icofont-simple-smile"></i>
                    <div class="content">
                        <span class="counter">600</span>
                        <p>Happy Patients</p>
                    </div>
                </div>
                <!-- End Single Fun -->
            </div>
            <div class="col-lg-3 col-md-6 col-12">
                <!-- Start Single Fun -->
                <div class="single-fun">
                    <i class="icofont icofont-table"></i>
                    <div class="content">
                        <span class="counter">20</span>
                        <p>Years of Experience</p>
                    </div>
                </div>
                <!-- End Single Fun -->
            </div>
        </div>
    </div>
</div>
<!--/ End Fun-facts -->

<!-- Start Why choose -->
<section class="why-choose section" >
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="section-title">
                    <h2 id="about">We are for the community, from the commuinty!</h2>
                    <img src="../../Resources/images/section-img.png" alt="#">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-6 col-12">
                <!-- Start Choose Left -->
                <div class="choose-left">
                    <h3 >Who We Are</h3>
                    <p>Found in 2004, BabyVaxTracker is a health center dedicated to help ease the procedure of tracking vaccines for babies.</p>
                    <p>Parents can look at the latest vaccine news and book an appointment to give a vaccine to their child. </p>
                    <div class="row">
                        <div class="col-lg-6">
                            <ul class="list">
                                <li><i class="fa fa-caret-right"></i>COVID-19 Vaccines </li>
                                <li><i class="fa fa-caret-right"></i>Pneumococcal Conjugate Vaccine (PCV20)</li>
                                <li><i class="fa fa-caret-right"></i>Meningococcal Vaccine (MenABCWY)</li>
                            </ul>
                        </div>
                        <div class="col-lg-6">
                            <ul class="list">
                                <li><i class="fa fa-caret-right"></i>Chikungunya Vaccine </li>
                                <li><i class="fa fa-caret-right"></i>Human Papillomavirus (HPV) Vaccine</li>
                                <li><i class="fa fa-caret-right"></i>Varicella (Chickenpox) Vaccine</li>
                            </ul>
                        </div>
                    </div>
                </div>
                <!-- End Choose Left -->
            </div>
            <div class="col-lg-6 col-12">
                <!-- Start Choose Rights -->
                <div class="choose-right">
                    <div class="video-image">
                        <!-- Video Animation -->
                        <div class="promo-video">
                            <div class="waves-block">
                                <div class="waves wave-1"></div>
                                <div class="waves wave-2"></div>
                                <div class="waves wave-3"></div>
                            </div>
                        </div>
                        <!--/ End Video Animation -->
                        <a href="https://www.youtube.com/watch?v=_bt8Zcp2riU" class="video video-popup mfp-iframe"><i class="fa fa-play"></i></a>
                    </div>
                </div>
                <!-- End Choose Rights -->
            </div>
        </div>
    </div>
</section>
<!--/ End Why choose -->

<!-- Start Call to action -->
<section class="call-action overlay" data-stellar-background-ratio="0.5">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-12">
                <div class="content">
                    <h2>Do you need Emergency Medical Care? Contact us. </h2>
                    <p>If your baby needs immediate medical care, reach us!</p>
                    <div class="button">
                        <a href="contact_page.php" class="btn">Contact Now</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!--/ End Call to action -->





<!-- Pricing Table -->
<section id="service" class="pricing-table section">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="section-title">
                    <h2>We Provide You The Best Treatment In Resonable Price</h2>
                    <img src="../../Resources/images/section-img.png" alt="#">
                    <p>We make sure our services are affordable by everyone who needs them</p>
                </div>
            </div>
        </div>
        <div class="row">
            <!-- Single Table -->
            <div class="col-lg-4 col-md-12 col-12">
                <div class="single-table">
                    <!-- Table Head -->
                    <div class="table-head">
                        <div class="icon">
                            <i class="icofont-injection-syringe"></i>
                        </div>
                        <h4 class="title">Get Vaccinated</h4>
                        <div class="price">
                        </div>
                    </div>
                    <!-- Table List -->
                    <ul class="table-list">
                        <li><i class="icofont icofont-ui-check"></i>Checked by WHO</li>
                        <li><i class="icofont icofont-ui-check"></i>Long lasting</li>
                        <li><i class="icofont icofont-ui-check"></i>Reminders and Alerts</li><br><br>
                    </ul>
                    <div class="table-bottom">
                        <a class="btn" href="../html/appointment.php">Book Now</a>
                    </div>
                    <!-- Table Bottom -->
                </div>
            </div>
            <!-- End Single Table-->
            <!-- Single Table -->
            <div class="col-lg-4 col-md-12 col-12">
                <div class="single-table">
                    <!-- Table Head -->
                    <div class="table-head">
                        <div class="icon">
                            <i class="icofont-doctor"></i>
                        </div>
                        <h4 class="title"> Consultation</h4>
                        <div class="price">
                        </div>
                    </div>
                    <!-- Table List -->
                    <ul class="table-list">
                        <li><i class="icofont icofont-ui-check"></i> sever complications</li>
                        <li><i class="icofont icofont-ui-check"></i>Growth and Development Monitoring</li><br><br><br>
                    </ul>
                        <div class="table-bottom">
                            <a class="btn" href="../html/appointment.php">Book Now</a>
                        </div>
                        <!-- Table Bottom -->
                </div>
            </div>
            <!-- End Single Table-->
            <!-- Single Table -->
            <div class="col-lg-4 col-md-12 col-12">
                <div class="single-table">
                    <!-- Table Head -->
                    <div class="table-head">
                        <div class="icon">
                            <i class="icofont-people"></i>
                        </div>
                        <h4 class="title">Community Support</h4>
                        <div class="price">

                        </div>
                    </div>
                    <!-- Table List -->
                    <ul class="table-list">
                        <li><i class="icofont icofont-ui-check"></i>Share your thoughts and ideas.</li>
                        <li><i class="icofont icofont-ui-check"></i>Reviews and Feedback</li><br><br><br><br>
                    </ul>
                    <div class="table-bottom">
                        <a class="btn" href="../html/feedback.php">Visit</a>
                    </div>
                    <!-- Table Bottom -->
                </div>
            </div>
            <!-- End Single Table-->
        </div>
    </div>
</section>
<!--/ End Pricing Table -->



<!-- Start Blog Area -->
<section id="news" class="blog section" id="blog">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="section-title">
                    <h2>Keep up with Our Most Recent News.</h2>
                    <img src="../../Resources/images/section-img.png" alt="#">
                    <p>Read these articles about the latest vaccines.</p>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-4 col-md-6 col-12">
                <!-- Single Blog -->
                <div class="single-news">
                    <div class="news-head">
                        <img src="../../Resources/images/blog1.jpg" alt="#">
                    </div>
                    <div class="news-body">
                        <div class="news-content">
                            <div class="date">May 31, 2024</div>
                            <h2><a href="https://www.sciencedaily.com/releases/2024/05/240531145023.htm">Antibodies May Aid Effort to Fight Influenza B</a></h2><br><br><br><br>
                        </div>
                    </div>
                </div>
                <!-- End Single Blog -->
            </div>
            <div class="col-lg-4 col-md-6 col-12">
                <!-- Single Blog -->
                <div class="single-news">
                    <div class="news-head">
                        <img src="../../Resources/images/blog2.jpg" alt="#">
                    </div>
                    <div class="news-body">
                        <div class="news-content">
                            <div class="date">May 29, 2024</div>
                            <h2><a href="https://www.sciencedaily.com/releases/2024/05/240529031235.htm">Bird Flu: Diverse Range of Vaccines Platforms 'Crucial' for Enhancing Human Pandemic Preparedness</a></h2><br>
                        </div>
                    </div>
                </div>
                <!-- End Single Blog -->
            </div>
            <div class="col-lg-4 col-md-6 col-12">
                <!-- Single Blog -->
                <div class="single-news">
                    <div class="news-head">
                        <img src="../../Resources/images/blog3.jpg" alt="#">
                    </div>
                    <div class="news-body">
                        <div class="news-content">
                            <div class="date">May 17, 2024</div>
                            <h2><a href="https://www.sciencedaily.com/releases/2024/05/240517164126.htm">Repeat COVID-19 Vaccinations Elicit Antibodies That Neutralize Variants, Other Viruses</a></h2><br>
                        </div>
                    </div>
                </div>
                <!-- End Single Blog -->
            </div>
        </div>
    </div>
</section>
<!-- End Blog Area -->

<!-- Start clients -->
<div class="clients overlay">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-12">
                <div class="owl-carousel clients-slider">
                    <div class="single-clients">
                        <img src="../../Resources/images/client1.png" alt="#">
                    </div>
                    <div class="single-clients">
                        <img src="../../Resources/images/client2.png" alt="#">
                    </div>
                    <div class="single-clients">
                        <img src="../../Resources/images/client3.png" alt="#">
                    </div>
                    <div class="single-clients">
                        <img src="../../Resources/images/client4.png" alt="#">
                    </div>
                    <div class="single-clients">
                        <img src="../../Resources/images/client5.png" alt="#">
                    </div>
                    <div class="single-clients">
                        <img src="../../Resources/images/client1.png" alt="#">
                    </div>
                    <div class="single-clients">
                        <img src="../../Resources/images/client2.png" alt="#">
                    </div>
                    <div class="single-clients">
                        <img src="../../Resources/images/client3.png" alt="#">
                    </div>
                    <div class="single-clients">
                        <img src="../../Resources/images/client4.png" alt="#">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--/Ens clients -->


<!-- Start Newsletter Area -->
<section class="newsletter section">
    <div class="container">
        <div class="row " id="newsletter">
            <div class="col-lg-6  col-12">
                <!-- Start Newsletter Form -->
                <div class="subscribe-text ">
                    <h6>Sign up for newsletter</h6>
                    <p class="">If you subscribe, you will recieve our latest updates on your email</p>
                </div>
                <!-- End Newsletter Form -->
            </div>
            <div class="col-lg-6  col-12">
                <!-- Start Newsletter Form -->
                <?php

                $userEmail = $_SESSION['USER'];

                $query = "SELECT subscribed FROM users WHERE users.email = ?";
                $stmt = $conn ->prepare($query);
                $stmt->bind_param("s", $userEmail);
                $stmt->execute();
                $result = $stmt->get_result();
                $row = $result->fetch_assoc();
                $sub = $row['subscribed'];
                if ($sub == 1) {
                    echo '<div class="subscribe-form">
                    <form action="../../BackEnd/php/subscribe.php" method="post" class="newsletter-inner">
                        <input name="EMAIL" placeholder="Subscribed ✓"" class="common-input" required="" type="email" ">
                        <button class="btn" disabled>Subscribe</button>
                    </form>
                  </div>';

                }
                else {
                    echo '<div class="subscribe-form">
                    <form action="../../BackEnd/php/subscribe.php" method="post" class="newsletter-inner">
                        <input name="EMAIL" placeholder="your email address"" class="common-input" required="" type="email" ">
                        <button class="btn" >Subscribe</button>
                    </form>
                  </div>';
                }
                ?>
                <!-- End Newsletter Form -->
            </div>
        </div>
    </div>
</section>
<!-- /End Newsletter Area -->

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
                                    <li><a href="#header"><i class="fa fa-caret-right" aria-hidden="true"></i>Home</a></li>
                                    <li><a href="#about"><i class="fa fa-caret-right" aria-hidden="true"></i>About Us</a></li>
                                    <li><a href="#service"><i class="fa fa-caret-right" aria-hidden="true"></i>Services</a></li>
                                </ul>
                            </div>
                            <div class="col-lg-6 col-md-6 col-12">
                                <ul>
                                    <li><a href="#news"><i class="fa fa-caret-right" aria-hidden="true"></i>News</a></li>
                                    <li><a href="contact_page.php"><i class="fa fa-caret-right" aria-hidden="true"></i>Contact Us</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-12">
                    <div class="single-footer">
                        <h2>Open Hours</h2>
                        <ul class="time-sidual">
                            <li class="day">Sunday-Thursday: <span>8:00am-4:00 pm</span></li>

                        </ul>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-12">
                    <div class="single-footer">
                        <h2>Newsletter</h2>
                        <a href ="#newsletter" style="color:white;">subscribe to our newsletter to get all our news in your inbox</a>
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

<!-- jquery Min JS -->
<script src="../js/jquery.min.js"></script>
<!-- jquery Migrate JS -->
<script src="../js/jquery-migrate-3.0.0.js"></script>
<!-- jquery Ui JS -->
<script src="../js/jquery-ui.min.js"></script>
<!-- Easing JS -->
<script src="../js/easing.js"></script>
<!-- Color JS -->
<script src="../js/colors.js"></script>
<!-- Popper JS -->
<script src="../js/popper.min.js"></script>
<!-- Bootstrap Datepicker JS -->
<script src="../js/bootstrap-datepicker.js"></script>
<!-- Jquery Nav JS -->
<script src="../js/jquery.nav.js"></script>
<!-- Slicknav JS -->
<script src="../js/slicknav.min.js"></script>
<!-- ScrollUp JS -->
<script src="../js/jquery.scrollUp.min.js"></script>
<!-- Niceselect JS -->
<script src="../js/niceselect.js"></script>
<!-- Tilt Jquery JS -->
<script src="../js/tilt.jquery.min.js"></script>
<!-- Owl Carousel JS -->
<script src="../js/owl-carousel.js"></script>
<!-- counterup JS -->
<script src="../js/jquery.counterup.min.js"></script>
<!-- Steller JS -->
<script src="../js/steller.js"></script>
<!-- Wow JS -->
<script src="../js/wow.min.js"></script>
<!-- Magnific Popup JS -->
<script src="../js/jquery.magnific-popup.min.js"></script>
<!-- Counter Up CDN JS -->
<script src="http://cdnjs.cloudflare.com/ajax/libs/waypoints/2.0.3/waypoints.min.js"></script>
<!-- Bootstrap JS -->
<script src="../js/bootstrap.min.js"></script>
<!-- Main JS -->
<script src="../js/main.js"></script>
</body>
</html>