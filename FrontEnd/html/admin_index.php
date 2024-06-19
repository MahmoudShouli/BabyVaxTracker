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
    <script src="../js/auto-email-sender.js"></script>

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
if (!isset($_SESSION['USER']) || !isset($_SESSION['ROLE']) || $_SESSION['ROLE'] !== '1'){

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
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-5 col-12">
                    <!-- Contact -->
                    <ul class="top-link">
                        <li><a href="../../BackEnd/php/tosignout.php" style="color:mediumblue; font-weight: bold; font-size: large">Sign Out</a></li>

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
                            echo "                        <li><i  class = 'comic-neue-bold' style='text-transform: capitalize; font-size: x-large'>Hi,Admin $userName!</i></li>";
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

</header>
<!-- End Header Area -->









<!-- Pricing Table -->
<section id="service" class="pricing-table section">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="section-title">
                    <h2>Welcome to your admin managing page.</h2>
                    <img src="../../Resources/images/section-img.png" alt="#">
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
                            <i class="icofont-ui-calendar"></i>
                        </div>
                        <h4 class="title">See Appointments</h4>
                        <div class="price">
                        </div>
                    </div>
                    <!-- Table List -->
                    <ul class="table-list">
                        <li>Look at all the appointment in our system.</li>

                    </ul>
                    <div class="table-bottom">
                        <a class="btn" href="admin_booking.php">Go</a>
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
                            <i class="icofont-ui-settings"></i>
                        </div>
                        <h4 class="title"> Manage Appointments</h4>
                        <div class="price">
                        </div>
                    </div>
                    <!-- Table List -->
                    <ul class="table-list">
                        <li>update the availability of the appointments</li>

                    </ul>
                    <div class="table-bottom">
                        <a class="btn" href="admin_booking_edit.php">Go</a>
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
                        <h4 class="title">Manage Posts</h4>
                        <div class="price">

                        </div>
                    </div>
                    <!-- Table List -->
                    <ul class="table-list">
                        <li>Delete the posts you find inappropriate</li>

                    </ul>
                    <div class="table-bottom">
                        <a class="btn" href="../html/feedback.php">Go</a>
                    </div>
                    <!-- Table Bottom -->
                </div>
            </div>
            <!-- End Single Table-->
        </div>
    </div>
</section>
<!--/ End Pricing Table -->






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