<?php
require_once '../../BackEnd/php/db_config.php';
$conn = @new mysqli(DB_HOST,DB_USER,DB_PASS,DB_NAME);
// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Form data validation
if (!empty($_POST['username']) && !empty($_POST['password'])) {
    // Get username (email or phone)
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Check if the username exists in the users table
    $sql = "SELECT * FROM users WHERE (email = '$username' OR phone = '$username') AND password = '$password'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // User authenticated successfully
        header("Location: ../../FrontEnd/html/index.html");
        exit();
    } else {
        echo "Invalid username or password.";
    }
} else {
    echo "Please fill in all required fields.";
}

// Close the database connection
$conn->close();
?>
