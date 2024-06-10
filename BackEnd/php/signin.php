<?php
require_once '../../BackEnd/php/db_config.php';
$conn = @new mysqli(DB_HOST,DB_USER,DB_PASS,DB_NAME);
// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Initialize error messages
$error_msg = "";

// Form data validation
if (!empty($_POST['username']) && !empty($_POST['password'])) {
    // Get username (email or phone)
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Check if the username exists in the users table
    $sql = "SELECT * FROM users WHERE (email = '$username' OR phone = '$username') AND password = '$password'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $conn->close();

        header("Location: ../../FrontEnd/html/index.html");
        exit();
    } else {
        $conn->close();

        $error_msg= "Invalid username or password.";

        header("Location: ../../FrontEnd/html/signin.html?error_msg=" . urlencode($error_msg));

        exit();
    }
} else {$conn->close();

    $error_msg= "Please fill in all required fields.";
    header("Location: ../../FrontEnd/html/signin.html?error_msg=" . urlencode($error_msg));


    exit();
}



?>
