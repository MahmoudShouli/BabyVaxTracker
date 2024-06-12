<?php
session_start();

// Check if CID is set in the session
if (!isset($_SESSION['CID'])) {
    die("Error: No CID set in the session.");
}

require_once '../../BackEnd/php/db_config.php';
$conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$cid = $_SESSION['CID'];

// Fetch doctor names
$sqlDoctors = "SELECT ID, name FROM doctors";
$resultDoctors = $conn->query($sqlDoctors);
$doctorNames = [];
if ($resultDoctors === false) {
    die("Error fetching doctors: " . $conn->error);
} elseif ($resultDoctors->num_rows > 0) {
    while ($row = $resultDoctors->fetch_assoc()) {
        $doctorNames[$row['ID']] = $row['name'];
    }
} else {
    echo "No doctors found.";
}

// Fetch child names
$sqlChildren = "SELECT id, name FROM children";
$resultChildren = $conn->query($sqlChildren);
$childNames = [];
if ($resultChildren === false) {
    die("Error fetching children: " . $conn->error);
} elseif ($resultChildren->num_rows > 0) {
    while ($row = $resultChildren->fetch_assoc()) {
        $childNames[$row['id']] = $row['name'];
    }
} else {
    echo "No children found.";
}

// Fetch data from the doctor_dates table where id equals $_SESSION['CID']
$sqlDoctorDates = "SELECT * FROM doctor_dates WHERE id = ?";
$stmtDoctorDates = $conn->prepare($sqlDoctorDates);
if ($stmtDoctorDates === false) {
    die("Error preparing statement: " . $conn->error);
}
$stmtDoctorDates->bind_param("i", $cid);
$stmtDoctorDates->execute();
$resultDoctorDates = $stmtDoctorDates->get_result();
if ($resultDoctorDates === false) {
    die("Error executing statement: " . $stmtDoctorDates->error);
}

// Fetch data from the appointments table where dateID equals $_SESSION['CID']
$sqlAppointments = "SELECT * FROM appointments WHERE dateID = ?";
$stmtAppointments = $conn->prepare($sqlAppointments);
if ($stmtAppointments === false) {
    die("Error preparing statement: " . $conn->error);
}
$stmtAppointments->bind_param("i", $cid);
$stmtAppointments->execute();
$resultAppointments = $stmtAppointments->get_result();
if ($resultAppointments === false) {
    die("Error executing statement: " . $stmtAppointments->error);
}

if (isset($_POST['subdel'])) {
    if ($resultAppointments->num_rows > 0) {
        while ($row = $resultAppointments->fetch_assoc()) {
            $idToDelete = $row['ID'];  // Get the ID to delete

            // Prepare the SQL DELETE statement
            $sqlDeleteAppointment = "DELETE FROM appointments WHERE ID = ?";
            $stmtDeleteAppointment = $conn->prepare($sqlDeleteAppointment);
            if ($stmtDeleteAppointment === false) {
                die("Error preparing statement: " . $conn->error);
            }
            $stmtDeleteAppointment->bind_param("i", $idToDelete);

            // Execute the statement
            if ($stmtDeleteAppointment->execute()) {
                echo "Record with ID $idToDelete deleted successfully.";
            } else {
                echo "Error deleting record: " . $stmtDeleteAppointment->error;
            }

            // Close the statement
            $stmtDeleteAppointment->close();

            // Prepare the SQL UPDATE statement
            $sqlUpdateAvailability = "UPDATE doctor_dates SET isAvailable = 1 WHERE id = ?";
            $stmtUpdateAvailability = $conn->prepare($sqlUpdateAvailability);
            if ($stmtUpdateAvailability === false) {
                die("Error preparing statement: " . $conn->error);
            }
            $stmtUpdateAvailability->bind_param("i", $cid);

            // Execute the statement
            if ($stmtUpdateAvailability->execute()) {
                echo "Record with ID $cid updated successfully.";
            } else {
                echo "Error updating record: " . $stmtUpdateAvailability->error;
            }

            // Close the statement
            $stmtUpdateAvailability->close();
        }
    } else {
        echo "No appointments found to delete.";
    }

    if (isset($stmtDeleteAppointment) && $stmtDeleteAppointment instanceof mysqli_stmt) {
        $stmtDeleteAppointment->close();
    }

    $conn->close();
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
                    <div class="col-lg-2 col-12">
                        <div class="get-quote">
                            <a href="appointment.html" class="btn">Book Appointment</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--/ End Header Inner -->
</header>
<!-- End Header Area -->













<!--*******************************************************************-->
<h1>Appointments</h1>
<table>
    <thead>
    <tr>
        <!--        <th>ID</th>-->
        <!--        <th>Date ID</th>-->
        <th>Doctor Name</th>
        <th>Child Name</th>
        <th>Type</th>
        <th>Description</th>
        <th>Actions</th>
    </tr>
    </thead>
    <tbody>
    <?php if ($resultAppointments->num_rows > 0): ?>
        <?php while ($row = $resultAppointments->fetch_assoc()): ?>
            <tr>
                <!--                <td>--><?php //echo $row['ID']; ?><!--</td>-->
                <!--                <td>--><?php //echo $row['dateID']; ?><!--</td>-->
                <td><?php echo isset($doctorNames[$row['doctorID']]) ? $doctorNames[$row['doctorID']] : 'Unknown'; ?></td>
                <td><?php echo isset($childNames[$row['childID']]) ? $childNames[$row['childID']] : 'Unknown'; ?></td>
                <td><?php echo $row['type']; ?></td>
                <td><?php echo $row['description']; ?></td>
                <td class="actions">
                    <form method="POST" action="edit_appointment.php" style="display:inline;">
                        <input type="hidden" name="id" value="<?php echo $row['ID']; ?>">
                        <button type="submit">Edit</button>
                    </form>

                    </form>
                </td>
            </tr>
        <?php endwhile; ?>
    <?php else: ?>
        <tr>
            <td colspan="7">No appointments found</td>
        </tr>
    <?php endif; ?>
    </tbody>
</table>

<h1>Doctor Dates</h1>
<table>
    <thead>
    <tr>
        <!--        <th>ID</th>-->
        <th>Day</th>
        <th>Hour</th>
        <th>AM/PM</th>
        <!--        <th>Is Available</th>-->
        <th>Doctor Name</th>
        <th>Actions</th>
    </tr>
    </thead>
    <tbody>
    <?php if ($resultDoctorDates->num_rows > 0): ?>
        <?php while ($row = $resultDoctorDates->fetch_assoc()): ?>
            <tr>
                <!--                <td>--><?php //echo $row['id']; ?><!--</td>-->
                <td><?php echo $row['day']; ?></td>
                <td><?php echo $row['hour']; ?></td>
                <td><?php echo $row['am_or_pm']; ?></td>
                <!--                <td>--><?php //echo $row['isAvailable']; ?><!--</td>-->
                <td><?php echo isset($doctorNames[$row['doctorID']]) ? $doctorNames[$row['doctorID']] : 'Unknown'; ?></td>
                <td class="actions">
                    <form method="POST" action="edit_doctor_date.php" style="display:inline;">
                        <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                        <button type="submit">Edit</button>
                    </form>

                </td>
            </tr>
        <?php endwhile; ?>
    <?php else: ?>
        <tr>
            <td colspan="7">No doctor dates found</td>
        </tr>
    <?php endif; ?>
    </tbody>
</table>

<form method="POST" action="../../FrontEnd/html/bookingDetails.php" >
    <input type="hidden" name="id" value="<?php echo $row['ID']; ?>">
    <button name="subdel" id="db" class="styled-button" type="submit">Delete</button>
</form>


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