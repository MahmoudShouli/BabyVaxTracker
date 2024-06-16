<!DOCTYPE html>
<html lang="en">
<head>
    <script src="../js/auto-email-sender.js"></script>
    <?php
    require_once '../../BackEnd/php/db_config.php';

    $doctorID =null;



    // bring the value of id from the selec
    if(isset($_POST['submit'])){
        $doctorName = $_POST['employeeShift'];
        switch ($doctorName) {
            case 'Sarah':
                $doctorID = 2;
                break;
            case 'Taima':
                $doctorID = 1;
                break;
            case 'Lama':
                $doctorID = 3;
                break;
            case 'Ali':
                $doctorID = 4;
                break;
            case 'Mahmoud':
                $doctorID = 5;
                break;
            default:
                // Handle the case where an invalid option is selected
                break;
        }
//echo "<h1>".$doctorID."</h1>";

    }




















    //mmmm
    $conn = @new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
    // Check the connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Define the doctorID (you can set this dynamically based on your requirements)

    // Fetch availability data from doctor_dates table
    $sql = "SELECT day, GROUP_CONCAT(isAvailable ORDER BY hour SEPARATOR ',') AS hours
FROM doctor_dates
WHERE doctorID = ?
GROUP BY day
ORDER BY FIELD(day, 'Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday')";

    // Prepare the SQL statement
    $stmt = $conn->prepare($sql);

    // Bind the doctorID parameter
    $stmt->bind_param("i", $doctorID);

    // Execute the SQL statement
    $stmt->execute();

    // Get the result
    $result = $stmt->get_result();

    $availabilityData = array();
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $availabilityData[] = array(
                'day' => $row['day'],
                'hours' => explode(',', $row['hours'])
            );
        }
    }

    $stmt->close();
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
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f4f7f6;
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        header {
            background-color: #4a90e2;
            color: white;
            padding: 10px 0;
            text-align: center;
        }
        .header-logo img {
            max-width: 120px;
        }
        .form-container {
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            margin: 20px auto;
            max-width: 500px;
            padding: 20px;
        }
        .form-container form {
            display: flex;
            flex-direction: column;
            gap: 15px;

        }
        .form-container select, .form-container button {
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;

        }
        .form-container button {
            background-color: #4a90e2;
            color: white;
            cursor: pointer;
            transition: background-color 0.3s;
        }
        .form-container button:hover {
            background-color: #357ab8;
        }

        .available {
            background-color: rgba(0, 128, 0, 0.38);
        }

        .schedule-table table {
            width: 100%;
            border-collapse: collapse;
        }
        .schedule-table th, .schedule-table td {
            padding: 10px;
            text-align: center;
        }
        .schedule-table th {
            background-color: #4a90e2;
            color: white;
        }   .available {
                background-color: #d4edda;
                color: #155724;
            }


    </style>
</head>
<body>
<header>
    <div class="header-logo">
        <a href="../../FrontEnd/html/index.php"><img src="../../Resources/images/logo.png" alt="Logo"></a>
    </div>
</header>

<div class="form-container">
    <form action="../../FrontEnd/html/CTable.php" method="post">
        <label for="employeeShift">Select Doctor:</label>
        <select class="form-control" id="employeeShift" style="           height: 50px !important;" name="employeeShift">
            <?php
            $conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            $sql = "SELECT name FROM doctors";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {

                        echo "<option>" . $row['name'] . "</option>";
                }
            } else {
                echo "<option value=''>No doctors available</option>";
            }

            $conn->close();
            ?>
        </select>
        <button name="submit" type="submit" class="btn">Show Schedule</button>
    </form>
</div>


<div class="container">
    <div class="w-95 w-md-75 w-lg-60 w-xl-55 mx-auto mb-6 ">
        <h2 style="text-align:center; margin-bottom: 30px;
"> <?php
            if(isset($_POST['submit'])){
                echo "<br>".$_POST['employeeShift']."</br>";


            }else {
                echo "<br>".'Employee'."</br>";


            }




            ?> Shift Schedule</h2>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="schedule-table">
                <table class="table bg-white calendar-table" >
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
                        <td style="color:blue;">Sunday</td>
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
                        <td style="color:blue;">Monday</td>
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
                        <td style="color:blue;">Tuesday</td>
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
                        <td style="color:blue;">Wednesday</td>
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
                        <td style="color:blue;">Thursday</td>
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
                        <td style="color:blue;">Friday</td>
                        <td colspan="12" style="font-size: 25px; color: blue">CLOSED</td>

                    </tr>
                    <tr>
                        <td style="color:blue;">Saturday</td>
                        <td colspan="12" style="font-size: 25px;color:blue;">CLOSED</td>

                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<div class="col-lg-2 col-12">
    <div class="get-quote" style="position:relative; left:50vw; margin-top: 20px; ">
        <a href="../html/appointment.php" class="btn">Book Appointment</a>
    </div>
</div><br><br><br>
<script>
    // Availability data fetched by PHP
    const availabilityData = <?php echo json_encode($availabilityData); ?>;

    // Function to update cell background color based on availability
    function updateAvailability() {
        const cells = document.querySelectorAll('.availability-cell');

        cells.forEach((cell, index) => {
            const availability = availabilityData[Math.floor(index / 9)].hours[index % 9];
            if (availability == 1) {
                cell.textContent = 'Unbooked';
                cell.classList.remove('unavailable');
                cell.classList.remove('booked');
                cell.classList.add('available');
                cell.style.color = 'black'
                cell.style.backgroundColor = ''; // Reset background color
            } else if (availability == 2) {
                cell.textContent = 'Booked';
                cell.classList.remove('available');
                cell.classList.remove('unavailable');
                cell.classList.add('booked');
                cell.style.color = 'black'
                cell.style.backgroundColor = 'rgba(255, 0, 0, 0.41)';
            } else if (availability == 3) {
                cell.textContent = 'Unavailable';
                cell.classList.remove('available');
                cell.classList.remove('booked');
                cell.classList.add('unavailable');
                cell.style.color = 'black'
                cell.style.backgroundColor = 'white';
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
                            <li><a href="#"><i class="icofont-facebook" style="color: white"></i></a></li>
                            <li><a href="#"><i class="icofont-instagram" style="color: white"></i></a></li>
                            <li><a href="#"><i class="icofont-twitter" style="color: white"></i></a></li>
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
                                    <li><a href="index.php#header"><i class="fa fa-caret-right" aria-hidden="true" style="color: white"></i>Home</a></li>
                                    <li><a href="index.php#about"><i class="fa fa-caret-right" aria-hidden="true" style="color: white"></i>About Us</a></li>
                                    <li><a href="index.php#service"><i class="fa fa-caret-right" aria-hidden="true" style="color: white"></i>Services</a></li>
                                </ul>
                            </div>
                            <div class="col-lg-6 col-md-6 col-12">
                                <ul>
                                    <li><a href="index.php#news"><i class="fa fa-caret-right" aria-hidden="true" style="color: white"></i>News</a></li>
                                    <li><a href="contact_page.php"><i class="fa fa-caret-right" aria-hidden="true" style="color: white"></i>Contact Us</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-12">
                    <div class="single-footer">
                        <h2>Open Hours</h2>
                        <ul class="time-sidual">
                            <li class="day">Sunday-Thursday: <span style="color: white">8:00am-4:00 pm</span></li>

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


</body>
</html>