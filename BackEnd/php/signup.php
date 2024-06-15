<?php
require_once '../../BackEnd/php/db_config.php';
$conn = @new mysqli(DB_HOST,DB_USER,DB_PASS,DB_NAME);
// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Form data validation
if (!empty($_POST['parentName']) && !empty($_POST['parentEmail']) && !empty($_POST['parentPhone']) &&
    !empty($_POST['password']) && !empty($_POST['city']) && !empty($_POST['gender']) &&
    !empty($_POST['childName']) && !empty($_POST['childBirthDate']) && !empty($_POST['childGender'])) {

    // Form data
    $parentName = $_POST['parentName'];
    $parentEmail = $_POST['parentEmail'];
    $parentPhone = $_POST['parentPhone'];
    $password = $_POST['password'];
    $city = $_POST['city'];
    $gender = $_POST['gender'];
    $childName = $_POST['childName'];
    $childBirthDate = $_POST['childBirthDate'];
    $childGender = $_POST['childGender'];

    // Insert into users table
    $sql1 = "INSERT INTO users (user_name, password, email, phone, gender, city, roleID,subscribed) 
            VALUES ('$parentName', '$password', '$parentEmail', '$parentPhone', '$gender', '$city', 2,0)";

    // Execute the SQL statement
    if ($conn->query($sql1) === TRUE) {
        $userID = $conn->insert_id; // Get the ID of the inserted user
        echo "New user added successfully!";

        // Insert into children table
        $sql2 = "INSERT INTO children (name, birth_date, gender, userID) 
                VALUES ('$childName', '$childBirthDate', '$childGender', '$userID')";

        // Execute the second SQL statement
        if ($conn->query($sql2) === TRUE) {
            echo "New child added successfully!";
        } else {
            echo "Error: " . $sql2 . "<br>" . $conn->error;
        }
    } else {
        echo "Error: " . $sql1 . "<br>" . $conn->error;
    }

} else {
    echo "Please fill in all required fields.";
}

// Close the database connection
$conn->close();

header("Location: ../../FrontEnd/html/index.php");
exit; // Ensure that no other code is executed after the redirect
?>
