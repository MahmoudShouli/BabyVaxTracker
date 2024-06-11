<!DOCTYPE html>
<html lang="en">
<head>
    <?php
require_once '../../BackEnd/php/db_config.php';

$conn = @new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
    }

    // Fetch availability data from doctor_dates table
    $sql = "SELECT day, GROUP_CONCAT(isAvailable ORDER BY hour SEPARATOR ',') AS hours
    FROM doctor_dates
    WHERE doctorID = 1
    GROUP BY day
    ORDER BY FIELD(day, 'Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday')";

    $result = $conn->query($sql);

    $availabilityData = array();
    if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
    $availabilityData[] = array(
    'day' => $row['day'],
    'hours' => explode(',', $row['hours'])
    );
    }
    }

    $conn->close();
    ?>

    <meta charset="utf-8">
    <meta http-equiv="Content-Language" content="ar">
    <title>BabyVaxTrack</title>
    <link rel="icon" type="image/x-icon" href="../../Resources/images/logo.png">
    <link rel="stylesheet" type="text/css" href="../css/table.css">

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
        .available {
            background-color: rgba(0, 128, 0, 0.38);
        }
        .unavailable {
            background-color: rgba(255, 0, 0, 0.41);
        }
    </style>
</head>
<body>
<header class="d-flex justify-content-between align-items-center py-3">
    <a href="index.html"><img src="../../Resources/images/logo.png" alt="this is the logo"></a>

    <div class="cc1" style="position:relative; right:800px;">
        <form action ="../../BackEnd/php/schedules.php" method="post">
            <label for="employeeShift">Select Doctor :</label> <br>
            <select class="form-control" id="employeeShift" name="employeeShift">
                <?php
                require_once '../../BackEnd/php/db_config.php';

                $conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
                // Check the connection
                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }

                // Fetch doctors data from the doctors table
                $sql = "SELECT name FROM doctors";
                $result = $conn->query($sql);

                // Check if query executed successfully
                if ($result === false) {
                    die("Error executing query: " . $conn->error);
                }

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<option>" ."dr.". $row['name'] . "</option>";
                    }
                } else {
                    echo "<option value=''>No doctors available</option>";
                }

                $conn->close();
                ?>
            </select><br><br>
            <button type="submit" class="btn" style="margin-top: -25px !important;">Show Schedule </button>
        </form>
    </div>

</header>





<div class="container">
    <div class="w-95 w-md-75 w-lg-60 w-xl-55 mx-auto mb-6 ">
        <h2 style="text-align:center; margin-bottom: 30px;
"> Employee Shift Schedule</h2>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="schedule-table">
                <table class="table bg-white calendar-table">
                    <thead>
                    <tr>
                        <th>Day</th>
                        <th>8 AM</th>
                        <th>9 AM</th>
                        <th>10 AM</th>
                        <th>11 AM</th>
                        <th>12 PM</th>
                        <th>1 PM</th>
                        <th>2 PM</th>
                        <th>3 PM</th>
                        <th>4 PM</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td>Sunday</td>
                        <td class="availability-cell"></td>
                        <td class="availability-cell"></td>
                        <td class="availability-cell"></td>
                        <td class="availability-cell"></td>
                        <td class="availability-cell"></td>
                        <td class="availability-cell"></td>
                        <td class="availability-cell"></td>
                        <td class="availability-cell"></td>
                        <td class="availability-cell"></td>
                    </tr>
                    <tr>
                        <td>Monday</td>
                        <td class="availability-cell"></td>
                        <td class="availability-cell"></td>
                        <td class="availability-cell"></td>
                        <td class="availability-cell"></td>
                        <td class="availability-cell"></td>
                        <td class="availability-cell"></td>
                        <td class="availability-cell"></td>
                        <td class="availability-cell"></td>
                        <td class="availability-cell"></td>
                    </tr>
                    <tr>
                        <td>Tuesday</td>
                        <td class="availability-cell"></td>
                        <td class="availability-cell"></td>
                        <td class="availability-cell"></td>
                        <td class="availability-cell"></td>
                        <td class="availability-cell"></td>
                        <td class="availability-cell"></td>
                        <td class="availability-cell"></td>
                        <td class="availability-cell"></td>
                        <td class="availability-cell"></td>
                    </tr>
                    <tr>
                        <td>Wednesday</td>
                        <td class="availability-cell"></td>
                        <td class="availability-cell"></td>
                        <td class="availability-cell"></td>
                        <td class="availability-cell"></td>
                        <td class="availability-cell"></td>
                        <td class="availability-cell"></td>
                        <td class="availability-cell"></td>
                        <td class="availability-cell"></td>
                        <td class="availability-cell"></td>
                    </tr>
                    <tr>
                        <td>Thursday</td>
                        <td class="availability-cell"></td>
                        <td class="availability-cell"></td>
                        <td class="availability-cell"></td>
                        <td class="availability-cell"></td>
                        <td class="availability-cell"></td>
                        <td class="availability-cell"></td>
                        <td class="availability-cell"></td>
                        <td class="availability-cell"></td>
                        <td class="availability-cell"></td>
                    </tr>
                    <tr>
                        <td>Friday</td>
                        <td colspan="12" style="font-size: 25px;">There is no work today</td>

                    </tr>
                    <tr>
                        <td>Saturday</td>
                        <td colspan="12" style="font-size: 25px;">There is no work today</td>

                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<div class="col-lg-2 col-12">
    <div class="get-quote" style="position:relative; left:50vw; margin-top: 20px; ">
        <a href="../html/appointment.html" class="btn">Book Appointment</a>
    </div>
</div>
<script>
    // Availability data fetched by PHP
    const availabilityData = <?php echo json_encode($availabilityData); ?>;

    // Function to update cell background color based on availability
    function updateAvailability() {
        const cells = document.querySelectorAll('.availability-cell');

        cells.forEach((cell, index) => {
            const availability = availabilityData[Math.floor(index / 9)].hours[index % 9];
            if (availability == 1) {
                cell.classList.remove('unavailable');
                cell.classList.add('available');
            } else {
                cell.classList.remove('available');
                cell.classList.add('unavailable');
            }
        });
    }

    // Initial update
    updateAvailability();
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
{day}={0.001010101