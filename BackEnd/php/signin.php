<?php
require_once '../../BackEnd/php/db_config.php';
session_start();

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
        $row = $result->fetch_assoc();

$_SESSION['USER']=$username;
$_SESSION['ROLE']=$row['roleID'];
        $conn->close();
//echo $_SESSION['USER'];
//echo $_SESSION['ROLE'];

        if($_SESSION['ROLE'] == 1)
            header("Location: ../../FrontEnd/html/admin_index.php");
        elseif ($_SESSION['ROLE'] == 2)
            header("Location: ../../FrontEnd/html/index.php");
       exit();
    } else {
        $conn->close();

        $error_msg= "Invalid username or password.";

        header("Location: ../../FrontEnd/html/signin.php?error_msg=" . urlencode($error_msg));

        exit();
    }
} else {$conn->close();

    $error_msg= "Please fill in all required fields.";
    header("Location: ../../FrontEnd/html/signin.php?error_msg=" . urlencode($error_msg));


    exit();
}



?>
