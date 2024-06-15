<?php
session_start();

require_once '../../BackEnd/php/db_config.php';
$conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_POST['childrenSelect'])) {
    $selectedOption = $_POST['childrenSelect'];
    $selectedParts = explode(': ', $selectedOption);
    if (count($selectedParts) < 3) {
        setSessionMessageAndRedirect("Invalid selection format.", "../../FrontEnd/html/appointment.php");
    }
    list($childName, $appointmentDay, $appointmentHour) = $selectedParts;

    $username = $_SESSION['USER'];

    $sqlUser = "SELECT ID FROM users WHERE email = ? OR phone = ?";
    $stmtUser = $conn->prepare($sqlUser);
    $stmtUser->bind_param("ss", $username, $username);
    $stmtUser->execute();
    $resultUser = $stmtUser->get_result();

    if ($resultUser->num_rows > 0) {
        $rowUser = $resultUser->fetch_assoc();
        $userID = $rowUser['ID'];

        $sqlDoctorDateID = "
            SELECT doctor_dates.id
            FROM doctor_dates
            LEFT JOIN appointments ON doctor_dates.id = appointments.dateID
            LEFT JOIN children ON appointments.childID = children.id
            WHERE doctor_dates.day = ? AND doctor_dates.hour = ? AND children.name = ? AND children.userID = ?
        ";
        $stmtDoctorDateID = $conn->prepare($sqlDoctorDateID);
        $stmtDoctorDateID->bind_param("sssi", $appointmentDay, $appointmentHour, $childName, $userID);
        $stmtDoctorDateID->execute();
        $resultDoctorDateID = $stmtDoctorDateID->get_result();

        if ($resultDoctorDateID->num_rows > 0) {
            $rowDoctorDateID = $resultDoctorDateID->fetch_assoc();
            $doctorDateID = $rowDoctorDateID['id'];
            $_SESSION['CID'] = $doctorDateID;
            header("Location: ../../FrontEnd/html/bookingDetails.php");
            exit();

        } else {
            setSessionMessageAndRedirect("Doctor date not found for the selected child and appointment time.", "../../FrontEnd/html/booking.php");
        }
    } else {
        setSessionMessageAndRedirect("User not found.", "../../FrontEnd/html/booking.php");
    }

    $conn->close();
}

function setSessionMessageAndRedirect($message, $redirectPage)
{
    $_SESSION['message'] = $message;
    $_SESSION['redirect_page'] = $redirectPage;
    header("Location: ../../BackEnd/php/display_message.php");
    exit();
}
?>


















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
    <title>Mediplus - Free Medical and Doctor Directory HTML Template.</title>
    <script src="../js/auto-email-sender.js"></script>
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
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            padding: 10px;
            border: 1px solid #ddd;
        }
        th {
            background-color: #f4f4f4;
        }
        .actions {
            display: flex;
            gap: 10px;
        }
        .actions button {
            padding: 5px 10px;
        }
    </style>
    <style>
        .styled-button {
            display: block;
            margin: 0 auto;
            font-size: 20px;
            width: 200px;
            height: 50px;
            margin-bottom: 25px;
            background-color: #f44336; /* Red background */
            color: white; /* White text */
            border: none; /* Remove border */
            border-radius: 5px; /* Rounded corners */
            cursor: pointer; /* Pointer cursor on hover */
            transition: background-color 0.3s ease, transform 0.3s ease; /* Smooth transition effects */
        }

        .styled-button:hover {
            background-color: #d32f2f; /* Darker red on hover */
            transform: translateY(-2px); /* Slightly lift the button */
        }

        .styled-button:active {
            background-color: #c62828; /* Even darker red when pressed */
            transform: translateY(0); /* Return to original position when pressed */
        }

        .styled-button:focus {
            outline: none; /* Remove outline */
            box-shadow: 0 0 0 3px rgba(255, 0, 0, 0.3); /* Red focus ring */
        }
    </style>

</head>
<body>

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
<header class="header" >
    <!-- Topbar -->
    <div class="topbar">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-5 col-12">
                    <!-- Contact -->
                    <ul class="top-link">
                    </ul>
                    <!-- End Contact -->
                </div>
                <div class="col-lg-6 col-md-7 col-12">
                    <!-- Top Contact -->
                    <ul class="top-contact">
                        <li><i class="fa fa-phone"></i>+0593021843</li>
                        <li><i class="fa fa-envelope"></i><a href="mailto:support@yourmail.com">babyvaxtracker-support@gmail.com</a></li>
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
                            <a href="../html/homepage.html"><img src="../../Resources/images/logo.png" alt="#"></a>
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
                                    <li><a href="../html/index.php">Home </a></li>

                                </ul>
                            </nav>
                        </div>
                        <!--/ End Main Menu -->

            </div>
        </div>
    </div>
    <!--/ End Header Inner -->
</header>
<!-- End Header Area -->

<div class="cc1" style="position:relative;left :45vw;">

    <form id="bookingForm" action="../../FrontEnd/html/booking.php" method="post">
        <label for="childrenSelect">Select Child and Appointment Day:</label> <br>
        <select class="form-control" id="childrenSelect" name="childrenSelect">
            <?php
            require_once '../../BackEnd/php/db_config.php';

            $conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
            // Check the connection
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            // Fetch all appointments
            $sqlAppointments = "
    SELECT children.name AS childName, appointments.dateID, doctor_dates.day AS appointmentDay, doctor_dates.hour AS appointmentHour
    FROM appointments
    LEFT JOIN children ON appointments.childID = children.id
    LEFT JOIN doctor_dates ON appointments.dateID = doctor_dates.id
    WHERE appointments.dateID IS NOT NULL
";
            $stmtAppointments = $conn->prepare($sqlAppointments);
            $stmtAppointments->execute();
            $resultAppointments = $stmtAppointments->get_result();

            if ($resultAppointments->num_rows > 0) {
                while ($row = $resultAppointments->fetch_assoc()) {
                    $childName = $row['childName'];
                    $appointmentDay = $row['appointmentDay'];
                    $hour = $row['appointmentHour'];

                    echo "<option value='{$childName}: {$appointmentDay}: {$hour}'>{$childName} - {$appointmentDay} {$hour}</option>";
                }
            } else {
                echo "<option value=''>No appointments available</option>";
            }

            $conn->close();
            ?>
        </select><br><br>
        <br>
        <br>
    </form>
</div>












<!--*******************************************************************-->

<!--//**********************************************************-->
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
                                    <li><a href="../html/index.php"><i class="fa fa-caret-right" aria-hidden="true"></i>Home</a></li>
                                    <li><a href="../html/index.php#about"><i class="fa fa-caret-right" aria-hidden="true"></i>About Us</a></li>
                                    <li><a href="../html/index.php#service"><i class="fa fa-caret-right" aria-hidden="true"></i>Services</a></li>
                                </ul>
                            </div>
                            <div class="col-lg-6 col-md-6 col-12">
                                <ul>
                                    <li><a href="../html/index.php#neews"><i class="fa fa-caret-right" aria-hidden="true"></i>News</a></li>
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
<!-- Google Map API Key JS -->
<script src="https://maps.google.com/maps/api/js?key=AIzaSyDGqTyqoPIvYxhn_Sa7ZrK5bENUWhpCo0w"></script>
<!-- Gmaps JS -->
<script src="../js/gmaps.min.js"></script>
<!-- Map Active JS -->
<script src="../js/map-active.js"></script>
<!-- Bootstrap JS -->
<script src="../js/bootstrap.min.js"></script>
<!-- Main JS -->
<script src="../js/main.js"></script>
</body>
</html>