<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>

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
  
    
    <link rel="stylesheet" href="../css/normalize.css">
        <link rel="stylesheet" href="../css/style.css">
        <link rel="stylesheet" href="../css/responsive.css">
</head>
<body>

<!-- Start Appointment -->
<section class="appointment">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="section-title">
                    <h2>We Are Always Ready to Help You. Book An Appointment</h2>
                    <img src="../../Resources/images/section-img.png" alt="#">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-6 col-md-12 col-12">
                <form id='form' class="form" action="../../BackEnd/php/appointments.php" method="post" onsubmit="return validateForm()">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-12">
                            <p style="font-size: 22px;">choose The Child:</p>
                            <select  style="margin-bottom: 19px;margin-top: 12px;" class="form-control" id="child" name="child">
                                <?php
                                require_once '../../BackEnd/php/db_config.php';
session_start();
                                $conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
                                // Check the connection
                                if ($conn->connect_error) {
                                    die("Connection failed: " . $conn->connect_error);
                                }

                                // Fetch the user ID based on the email or phone in $_SESSION['USER']
                                $userIdentifier = $_SESSION['USER'];
                                $sqlUser = "SELECT ID FROM users WHERE email = '$userIdentifier' OR phone = '$userIdentifier'";
                                $resultUser = $conn->query($sqlUser);

                                // Check if query executed successfully
                                if ($resultUser === false) {
                                    die("Error executing query: " . $conn->error);
                                }

                                if ($resultUser->num_rows > 0) {
                                    $rowUser = $resultUser->fetch_assoc();
                                    $userID = $rowUser['ID'];

                                    // Fetch children's names based on the user's ID
                                    $sqlChildren = "SELECT name FROM children WHERE userID = '$userID'";
                                    $resultChildren = $conn->query($sqlChildren);

                                    // Check if query executed successfully
                                    if ($resultChildren === false) {
                                        die("Error executing query: " . $conn->error);
                                    }

                                    if ($resultChildren->num_rows > 0) {
                                        while ($rowChildren = $resultChildren->fetch_assoc()) {
                                            echo "<option>".$rowChildren['name'] . "</option>";
                                        }
                                    } else {
                                        echo "<option value=''>No children found</option>";
                                    }
                                } else {
                                    echo "<option value=''>User not found</option>";
                                }

                                $conn->close();
                                ?>
                            </select>
                        </div>

                        <div class="col-lg-12 col-md-12 col-12">
                            <p style="font-size: 22px;">choose The Doctor:</p>

                            <div class="form-group">

                                <select style="margin-bottom: 19px;margin-top: 12px;" class="form-control" id="employeeShift" name="doctor">
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
                                    echo "<option>".$row['name'] . "</option>";
                                    }
                                    } else {
                                    echo "<option value=''>No doctors available</option>";
                                    }

                                    $conn->close();
                                    ?>
                                </select>                            </div>
                        </div>
                        <div class="col-lg-12 col-md-12 col-12">
                            <div class="form-group">
                                <p style="font-size: 22px;">choose The Date:</p>

                                <input name='date' style="margin-bottom: 19px;margin-top: 12px;" type="text" placeholder="Day:Hour am/pm" id="datepicker">
                            </div>
                        </div>
                        <div class="col-lg-12 col-md-12 col-12">
                            <div class="form-group">
                                <textarea name="message" placeholder="More information....."></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-5 col-md-4 col-12">
                            <div class="form-group">
                                <div class="button">
                                    <button type="submit" class="btn">Book An Appointment</button>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-7 col-md-8 col-12">
                            <p>( We will confirm by a Text Message )</p>
                        </div>
                    </div>
                </form>
            </div>
            <div class="col-lg-6 col-md-12 ">
                <div class="appointment-image">
                    <img src="../../Resources/images/contact-img.png" alt="#">
                </div>
            </div>
        </div>
    </div>
</section>
<!-- End Appointment -->


<script>
    function validateForm() {
        var child = document.getElementById('child').value;
        var doctor = document.getElementById('employeeShift').value;
        var date = document.getElementById('datepicker').value;
        var message = document.getElementsByName('message')[0].value;

        if (child.trim() == '') {
            alert('Please select a child.');
            return false;
        }

        if (doctor.trim() == '') {
            alert('Please select a doctor.');
            return false;
        }

        if (date.trim() == '') {
            alert('Please enter a date.');
            return false;
        }

        // Validate date format
        var dateRegex = /^(Monday|Tuesday|Wednesday|Thursday|Friday|Saturday|Sunday):([8-9]|1[0-1]) (Am|Pm)$/i;
        if (!dateRegex.test(date)) {
            alert('Please enter a date in the format "Day:Hour Am/Pm" and the hour should be from 8 Am to 4 Pm');
            return false;
        }

        if (message.trim() == '') {
            alert('Please enter a description.');
            return false;
        }

        return true;
    }
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
                                    <li><a href="../html/index.php"><i class="fa fa-caret-right" aria-hidden="true"></i>Home</a></li>
                                    <li><a href="../html/index.php#about"><i class="fa fa-caret-right" aria-hidden="true"></i>About Us</a></li>
                                    <li><a href="../html/index.php#service"><i class="fa fa-caret-right" aria-hidden="true"></i>Services</a></li>
                                </ul>
                            </div>
                            <div class="col-lg-6 col-md-6 col-12">
                                <ul>
                                    <li><a href="../html/index.php#news"><i class="fa fa-caret-right" aria-hidden="true"></i>News</a></li>
                                    <li><a href="../html/contact.html"><i class="fa fa-caret-right" aria-hidden="true"></i>Contact Us</a></li>
                                    <li><a href="../html/schedules.html"><i class="fa fa-caret-right" aria-hidden="true"></i>Schedules</a></li>
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