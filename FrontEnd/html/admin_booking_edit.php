
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
    <title>Appointments Management</title>
    <script>
        function showPara(displayStyle, color, text) {
            var para = document.getElementById('para1');
            para.style.display = displayStyle;
            para.style.color = color;
            para.innerText = text;
        }
    </script>

    <style>

        .form-group {
            margin-bottom: 1em;
        }

        label {
            display: block;
            margin-bottom: 0.5em;
        }

        select, input[type="text"], input[type="submit"] {
            width: 100%;
            padding: 0.5em;
        }

        .message {
            padding: 1em;
            margin-bottom: 1em;
        }

        .message.success {
            background-color: #d4edda;
            border-color: #c3e6cb;
            color: #155724;
        }

        .message.error {
            background-color: #f8d7da;
            border-color: #f5c6cb;
            color: #721c24;
        }


    </style>
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
<body style="background-image: url('../../Resources/images/adminbg.png');   background-size: cover;
        background-position: center;">





<!-- Header Area -->
<header class="header"  >
    <!-- Topbar -->
    <div class="topbar" style="background-color:  #f2f2f2">
        <div class="container">
            <div class="row">

                <div class="col-lg-6 col-md-7 col-12">
                    <!-- Top Contact -->

                    <a style="text-align: left; color:blue; font-style: oblique; font-size: larger" href="admin_index.php"><i class=" fa fa-server"></i> Control Panel </a>

                    <!-- End Top Contact -->
                </div>
            </div>
        </div>
    </div>
    <!-- End Topbar -->

</header>
<!-- End Header Area -->
<!--/***********************************************************************-->
<?php
session_start();
require_once '../../BackEnd/php/db_config.php';
$conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

function getRowIndexForHour($hour)
{
    switch ($hour) {
        case 8: return 0;
        case 9: return 1;
        case 10: return 2;
        case 11: return 3;
        case 12: return 4;
        case 1: return 5;
        case 2: return 6;
        case 3: return 7;
        case 4: return 8;
        default: return null;
    }
}

function getRowIndexForDay($day)
{
    switch ($day) {
        case 'Sunday': return 1;
        case 'Monday': return 10;
        case 'Tuesday': return 19;
        case 'Wednesday': return 28;
        case 'Thursday': return 37;
        default: return 100;
    }
}

if (isset($_POST['doctor'], $_POST['date'], $_POST['status'])) {
    $doctorName = $_POST['doctor'];
    switch ($doctorName) {
        case 'Sarah':
            $doctorId = 2;
            break;
        case 'Taima':
            $doctorId = 1;
            break;
        case 'Lama':
            $doctorId = 3;
            break;
        case 'Ali':
            $doctorId = 4;
            break;
        case 'Mahmoud':
            $doctorId = 5;
            break;
    }

    $dateString = $_POST['date'];
    list($day, $time) = explode(':', $dateString);
    $day = trim($day);
    $time = trim($time);
    preg_match('/(\d+)\s*(Am|Pm)/i', $time, $matches);
    $hour = $matches[1];

    $finalIndex = getRowIndexForDay($day) + (($doctorId - 1) * 45) + getRowIndexForHour($hour);
    $status = ($_POST['status'] == '0') ? 1 : 3;

    // Check if isAvailable is 2
    $sqlCheckAvailability = "SELECT isAvailable FROM doctor_dates WHERE id = ?";
    $stmtCheckAvailability = $conn->prepare($sqlCheckAvailability);
    $stmtCheckAvailability->bind_param("i", $finalIndex);
    $stmtCheckAvailability->execute();
    $resultCheckAvailability = $stmtCheckAvailability->get_result();

    if ($resultCheckAvailability->num_rows > 0) {
        $row = $resultCheckAvailability->fetch_assoc();
        if ($row['isAvailable'] == 2) {
            // Delete the row in the appointments table where dateID matches $finalIndex
            $sqlDeleteAppointment = "DELETE FROM appointments WHERE dateID = ?";
            $stmtDeleteAppointment = $conn->prepare($sqlDeleteAppointment);
            $stmtDeleteAppointment->bind_param("i", $finalIndex);
            $stmtDeleteAppointment->execute();

            if ($stmtDeleteAppointment->affected_rows > 0) {
                echo "<script>showPara('block', 'green', 'Updated successfully')</script>";
            }
        } else {
            echo "<script>
        document.addEventListener('DOMContentLoaded', function() {
            showPara('block', 'red', 'No match found');
        });
    </script>";
        }
    }

    $stmtCheckAvailability->close();

    // Update availability status
    $sqlUpdate = "UPDATE doctor_dates SET isAvailable = ? WHERE id = ?";
    $stmtUpdate = $conn->prepare($sqlUpdate);
    $stmtUpdate->bind_param("ii", $status, $finalIndex);

    if ($stmtUpdate->execute()) {
        echo "<script>
        document.addEventListener('DOMContentLoaded', function() {
            showPara('block', 'green', 'Updated successfully');
        });
    </script>";
    } else {
        echo "<script>
        document.addEventListener('DOMContentLoaded', function() {
            showPara('block', 'red', 'Failed to update');
        });
    </script>";
    }

    $stmtUpdate->close();
}


$conn->close();
?>
<div class="container" style="margin-top: 10%; color:blue;  ">
    <div class="row justify-content-center">
        <div class="col-md-8">

            <div class="card"  style="background-color:  #f2f2f2">
                <div class="card-body">
                    <h2 class="text-center" style="margin-bottom: 3%">Appointments Management</h2>
<form action="admin_booking_edit.php" method="post">
    <div class="form-group">
        <label for="doctor">Choose The Doctor:</label>
        <select style="" id="doctor" name="doctor" required>
            <?php
            require_once '../../BackEnd/php/db_config.php';
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
    </div>
    <div class="form-group">
        <label for="date">Date (e.g., 'Sunday:8 Am'):</label>
        <input type="text" id="date" name='date' required>
    </div>
    <div class="form-group">
        <label for="status">New Status:</label>
        <select id="status" name="status" required>
            <option value="0">Unbooked</option>
            <option value="1">Unavailable</option>
        </select>
    </div>
    <input type="submit" value="Update Availability" name="submit">
    <p id="para1" style="color: green; display:none "></p>





</form>
                </div>
            </div>

        </div>
    </div>
</div>
</body>
</html>
