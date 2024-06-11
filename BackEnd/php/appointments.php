<?php
require_once '../../BackEnd/php/db_config.php';

$conn = @new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Escape user inputs for security
    $name = $conn->real_escape_string($_POST['name']);
    $email = $conn->real_escape_string($_POST['email']);
    $phone = $conn->real_escape_string($_POST['phone']);
    $child = $conn->real_escape_string($_POST['child']);
    $doctor = $conn->real_escape_string($_POST['doctor']);
    $dayHour = $conn->real_escape_string($_POST['dayHour']);
    $message = $conn->real_escape_string($_POST['message']);

    // Attempt insert query execution
    $sql = "INSERT INTO appointments (name, email, phone, child, doctor, day_hour, message) VALUES ('$name', '$email', '$phone', '$child', '$doctor', '$dayHour', '$message')";
    if ($conn->query($sql) === TRUE) {
        echo "Appointment booked successfully.";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Close connection
$conn->close();
?>
