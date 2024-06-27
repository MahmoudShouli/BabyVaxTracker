<?php
require_once '../../BackEnd/php/db_config.php';
$conn = @new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
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

    // Check if email or phone number already exists
    $checkQuery = "SELECT * FROM users WHERE email = ? OR phone = ?";
    $stmt = $conn->prepare($checkQuery);
    $stmt->bind_param("ss", $parentEmail, $parentPhone);
    $stmt->execute();
    $checkResult = $stmt->get_result();
    if ($checkResult->num_rows > 0) {
        $existingUser = $checkResult->fetch_assoc();
        if ($existingUser['email'] === $parentEmail) {
            setSessionMessageAndRedirect("Email already in use.", "../../FrontEnd/html/signup.php");
        } elseif ($existingUser['phone'] === $parentPhone) {
            setSessionMessageAndRedirect("Phone number already in use.", "../../FrontEnd/html/signup.php");
        }
    }

    // Insert into users table
    $sql1 = "INSERT INTO users (user_name, password, email, phone, gender,photo, city, roleID,subscribed,theme) 
            VALUES (?, ?, ?, ?, ?, '../../Resources/images/profilepicanony.png', ?, 2,0,'light')";
    $stmt1 = $conn->prepare($sql1);
    $stmt1->bind_param("ssssss", $parentName, $password, $parentEmail, $parentPhone, $gender, $city);

    // Execute the SQL statement
    if ($stmt1->execute()) {
        $userID = $stmt1->insert_id; // Get the ID of the inserted user

        // Insert into children table
        $sql2 = "INSERT INTO children (name, birth_date, gender, userID) 
                VALUES (?, ?, ?, ?)";
        $stmt2 = $conn->prepare($sql2);
        $stmt2->bind_param("sssi", $childName, $childBirthDate, $childGender, $userID);

        // Execute the second SQL statement
        if ($stmt2->execute()) {
            setSessionMessageAndRedirect("New user added successfully!", "../../FrontEnd/html/signin.php");
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

function setSessionMessageAndRedirect($message, $redirectPage)
{
    session_start();
    $_SESSION['message'] = $message;
    $_SESSION['redirect_page'] = $redirectPage;
    header("Location: ../../BackEnd/php/display_message.php");
    exit();
}

?>