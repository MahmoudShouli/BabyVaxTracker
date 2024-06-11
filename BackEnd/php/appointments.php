<?php
// Enable error reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);

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
            // Handle the case where x doesn't match any case
            return null;

    }}



// Retrieve the selected doctor's ID from the database
if (isset($_POST['child']) && isset($_POST['doctor']) && isset($_POST['date'])) {
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
                return 100;
                break;
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





}
?>
