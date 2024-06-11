<?php
session_start();
// Enable error reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);
$childid=1;
// Remove session_start() if not needed

$doctorId = 1;

require_once '../../BackEnd/php/db_config.php';
$conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Define the function to get the row index for the day
function getRowIndexForHour($hour)
{
    switch ($hour) {
        case 8:
            return 0;
            break;
        case 9:
            return 1;
            break;
        case 10:
            return 2;
            break;
        case 11:
            return 3;
            break;
        case 12:
            return 4;
            break;
        case 1:
            return 5;
            break;
        case 2:
            return 6;
            break;
        case 3:
            return 7;
            break;
        case 4:
            return 8;
            break;
        default:
            exit();

            // Handle the case where x doesn't match any case
            return null;

    }}



// Retrieve the selected doctor's ID from the database message
if (isset($_POST['child']) && isset($_POST['doctor']) && isset($_POST['date'])&& isset($_POST['message'])) {
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
        default:
            exit();

            // Handle the case where an invalid option is selected
            break;
    }
    function getRowIndexForDay($day)
    {

        switch (($day)) {
            case 'Sunday':
                return 1;
                break;
            case 'Monday':
                return 10;
                break;
            case 'Tuesday':
                return 19;
                break;
            case 'Wednesday':
                return 28;
                break;
            case 'Thursday':
                return 37;
                break;
            default:
                exit();
                return 100;


        }

    }

    // Assume $_POST['date'] is set and has the value like "Monday:8 Am"
    $dateString = $_POST['date'];

// Split the string into day and time parts
    list($day, $time) = explode(':', $dateString);

// Trim any whitespace around the day and time
    $day = trim($day);
    $time = trim($time);

// Use a regular expression to extract the hour part
    preg_match('/(\d+)\s*(Am|Pm)/i', $time, $matches);
    $hour = $matches[1]; // Extract the hour part



    //echo "Day: " . getRowIndexForDay($day). "\n";
   // echo "Hour: " . getRowIndexForHour($hour) . "\n";
    $finalIndex =  getRowIndexForDay($day)+(($doctorId-1)*45)+getRowIndexForHour($hour);

    //($day, $hour);

    //echo "<h1>" . "The row index to be affected is: " . $finalIndex . "</h1>";

    //  echo "<h1>"."ali loves taima " ."</h1>";



// to get the id of the children :
    $userIdentifier = $_SESSION['USER'];
    $sqlUser = "SELECT ID FROM users WHERE email = '$userIdentifier' OR phone = '$userIdentifier'";
    $resultUser = $conn->query($sqlUser);
if ($resultUser->num_rows > 0) {
    $rowUser = $resultUser->fetch_assoc();
    $userID = $rowUser['ID'];
    $childName=$_POST['child'];
    // Fetch children's names based on the user's ID
    $stmt = $conn->prepare("SELECT id FROM children WHERE userID = ? AND name = ?");
    $stmt->bind_param("is", $userID, $childName);

// Execute the statement
    $stmt->execute();

// Get the result
    $resultChildren = $stmt->get_result();

    if ($resultChildren->num_rows > 0) {
        // Output data of each row
        while ($row = $resultChildren->fetch_assoc()) {
            $childid=$row['id'];
        }
    } else {
        echo "No child found with the specified name.";
    }}

$message=$_POST['message'];
// so now i have $row["id"] it's the id of the child ,$doctorId,$finalIndex,$message
    $type = 'vaccine';
    $dateID = $finalIndex;
    $doctorID = $doctorId;
    $childID =  $childid;
    $description = $message;

// Prepare and bind
    //$stmt = $conn->prepare("INSERT INTO appointments (dateID, doctorID, childID, type, description) VALUES (?, ?, ?, ?, ?)");
   // $stmt->bind_param("iiiss", $dateID, $doctorID, $childID, $type, $description);

// Execute the statement
    if ($stmt->execute()) {
        echo "New appointment record created successfully.";
    } else {
        echo "Error: " . $stmt->error;
    }


// Assuming you already have the necessary variables set
    $finalIndex = $finalIndex; // Your finalIndex value

// Update the row in the doctor_dates table
$sqlUpdate = "UPDATE doctor_dates SET isAvailable = '2' WHERE id = ?";
$stmtUpdate = $conn->prepare($sqlUpdate);
$stmtUpdate->bind_param("i", $finalIndex);

// Execute the statement
if ($stmtUpdate->execute()) {
    echo "Row updated successfully.";
} else {
    echo "Error updating row: " . $stmtUpdate->error;
}

// Close the statement
$stmtUpdate->close();

}
?>
