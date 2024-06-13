<?php
session_start();
// Enable error reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);

//*************************************************************
$sessionID = $_SESSION['CID'];
$appointmentID = $_SESSION['appID'];
require_once '../../BackEnd/php/db_config.php';

$conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Delete row from the appointments table
$sqlDeleteAppointment = "DELETE FROM appointments WHERE ID = ?";
$stmtDeleteAppointment = $conn->prepare($sqlDeleteAppointment);
$stmtDeleteAppointment->bind_param("i", $appointmentID);

if ($stmtDeleteAppointment->execute() === FALSE) {
    die("Error deleting appointment: " . $conn->error);
}

// Update isAvailable column in the doctor_dates table
$sqlUpdateDoctorDates = "UPDATE doctor_dates SET isAvailable = 1 WHERE id = ?";
$stmtUpdateDoctorDates = $conn->prepare($sqlUpdateDoctorDates);
$stmtUpdateDoctorDates->bind_param("i", $sessionID);

if ($stmtUpdateDoctorDates->execute() === FALSE) {
    die("Error updating doctor_dates: " . $conn->error);
}

//*************************************************************
$childid = 1;
$doctorId = 1;

// Define the function to get the row index for the day
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

if (isset($_POST['child'], $_POST['doctor'], $_POST['date'], $_POST['message'])) {
    $doctorName = $_POST['doctor'];
    switch ($doctorName) {
        case 'Sarah': $doctorId = 2; break;
        case 'Taima': $doctorId = 1; break;
        case 'Lama': $doctorId = 3; break;
        case 'Ali': $doctorId = 4; break;
        case 'Mahmoud': $doctorId = 5; break;
    }

    $dateString = $_POST['date'];
    list($day, $time) = explode(':', $dateString);
    $day = trim($day);
    $time = trim($time);
    preg_match('/(\d+)\s*(Am|Pm)/i', $time, $matches);
    $hour = $matches[1];

    $finalIndex = getRowIndexForDay($day) + (($doctorId - 1) * 45) + getRowIndexForHour($hour);
    $_SESSION['CID']=$finalIndex;
    $sqlCheck = "SELECT isAvailable FROM doctor_dates WHERE id = ?";
    $stmtCheck = $conn->prepare($sqlCheck);
    $stmtCheck->bind_param("i", $finalIndex);

    if ($stmtCheck->execute()) {
        $result = $stmtCheck->get_result();
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            if ($row['isAvailable'] == '1') {
                $userIdentifier = $_SESSION['USER'];
                $sqlUser = "SELECT ID FROM users WHERE email = '$userIdentifier' OR phone = '$userIdentifier'";
                $resultUser = $conn->query($sqlUser);
                if ($resultUser->num_rows > 0) {
                    $rowUser = $resultUser->fetch_assoc();
                    $userID = $rowUser['ID'];
                    $childName = $_POST['child'];

                    $stmt = $conn->prepare("SELECT id FROM children WHERE userID = ? AND name = ?");
                    $stmt->bind_param("is", $userID, $childName);
                    $stmt->execute();
                    $resultChildren = $stmt->get_result();
                    if ($resultChildren->num_rows > 0) {
                        $row = $resultChildren->fetch_assoc();
                        $childid = $row['id'];
                    } else {
                        setSessionMessageAndRedirect("No child found with the specified name.", "errorPage.php");
                    }
                }

                $message = $_POST['message'];
                $type = 'vaccine';
                $dateID = $finalIndex;
                $doctorID = $doctorId;
                $childID = $childid;
                $description = $message;

                $stmt = $conn->prepare("INSERT INTO appointments (dateID, doctorID, childID, type, description) VALUES (?, ?, ?, ?, ?)");
                $stmt->bind_param("iiiss", $dateID, $doctorID, $childID, $type, $description);

                if ($stmt->execute()) {
                    $sqlUpdate = "UPDATE doctor_dates SET isAvailable = '2' WHERE id = ?";
                    $stmtUpdate = $conn->prepare($sqlUpdate);
                    $stmtUpdate->bind_param("i", $finalIndex);

                    if ($stmtUpdate->execute()) {
                        setSessionMessageAndRedirect("New appointment record created successfully.", "../../FrontEnd/html/booking.php");
                    } else {
                        setSessionMessageAndRedirect("Error updating row: " . $stmtUpdate->error, "../../FrontEnd/html/bookingDetails.php");
                    }
                } else {
                    setSessionMessageAndRedirect("Error: " . $stmt->error, "../../FrontEnd/html/bookingDetails.php");
                }
            } else {
                setSessionMessageAndRedirect("The date is already booked.", "../../FrontEnd/html/bookingDetails.php");
            }
        } else {
            setSessionMessageAndRedirect("The date is not available.", "../../FrontEnd/html/bookingDetails.php");
        }
    }
}

function setSessionMessageAndRedirect($message, $redirectPage)
{
    $_SESSION['message'] = $message;
    $_SESSION['redirect_page'] = $redirectPage;
    header("Location: ../../BackEnd/php/display_message.php");
    exit();
}
?>

