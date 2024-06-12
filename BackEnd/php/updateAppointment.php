<?php
session_start();
//$_SESSION['CID'];
//$_SESSION['appID']
//    echo "<h1>". $_SESSION['CID'] . "</h1>";
//    echo "br"."<h1>".$_SESSION['appID'] ."</h1>";

require_once '../../BackEnd/php/db_config.php';
session_start();

// Check if the required session variables are set
if (!isset($_SESSION['CID']) || !isset($_SESSION['appID'])) {
    die("Session variables CID or appID not set.");
}

$sessionID = $_SESSION['CID'];
$appointmentID = $_SESSION['appID'];

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



?>