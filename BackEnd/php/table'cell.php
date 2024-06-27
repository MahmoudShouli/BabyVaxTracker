<?php
require_once '../../BackEnd/php/db_config.php';

$conn = @new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if Ali's ID exists in the doctors table
$result = $conn->query("SELECT ID FROM doctors WHERE ID = 5");

if ($result->num_rows == 0) {
    // Ali's ID does not exist, insert Ali as a new doctor
    $conn->query("INSERT INTO doctors (ID, name, email) VALUES (5, 'Ali', 'ali@gmail.com')");
}

// Insert availability data for Doctor Ali
$id = 181; // Assuming this is the first availability record for Ali
for ($day = 0; $day <= 4; $day++) { // Sunday (0) to Thursday (4)
    for ($hour = 8; $hour <= 16; $hour++) { // 8 AM to 4 PM
        $dayName = date('l', strtotime('Sunday +'.$day.' days'));
        $hourFormat = sprintf("%02d", $hour) . ':00:00';
        $amOrPm = ($hour < 12) ? 'AM' : 'PM';
        $isAvailable = 1; // Assuming all slots are initially available

        $sql = "INSERT INTO doctor_dates (id, day, hour, am_or_pm, isAvailable, doctorID) 
                VALUES ('$id', '$dayName', '$hourFormat', '$amOrPm', '$isAvailable', 5)";

        if ($conn->query($sql) !== TRUE) {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }

        $id++;
    }
}

$conn->close();
?>
