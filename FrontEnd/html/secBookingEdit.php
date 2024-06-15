
<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="UTF-8">
    <title>Update Doctor Availability</title>
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
    <script src="../js/auto-email-sender.js"></script>
</head>
<body>

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
                echo "<div class='message success'>Appointment deleted successfully.</div>";
            } else {
                echo "<div class='message error'>No matching appointment found to delete.</div>";
            }
        } else {
            echo "<div class='message error'>There is no appointment at this time </div>";
        }
    } else {
        echo "<div class='message error'>No matching record found in doctor_date.</div>";
    }

    $stmtCheckAvailability->close();

    // Update availability status
    $sqlUpdate = "UPDATE doctor_dates SET isAvailable = ? WHERE id = ?";
    $stmtUpdate = $conn->prepare($sqlUpdate);
    $stmtUpdate->bind_param("ii", $status, $finalIndex);

    if ($stmtUpdate->execute()) {
        echo "<div class='message success'>Availability updated successfully.</div>";
    } else {
        echo "<div class='message error'>Error updating availability: " . $stmtUpdate->error . "</div>";
    }

    $stmtUpdate->close();
}
$conn->close();
?>

<h2>Update Doctor Availability</h2>
<form action="../../FrontEnd/html/secBookingEdit.php" method="post">
    <div class="form-group">
        <label for="doctor">Choose The Doctor:</label>
        <select id="doctor" name="doctor" required>
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
        <label for="status">Status:</label>
        <select id="status" name="status" required>
            <option value="0">Unbooked</option>
            <option value="1">Unavailable</option>
        </select>
    </div>
    <input type="submit" value="Update Availability" name="submit">
</form>
</body>
</html>
