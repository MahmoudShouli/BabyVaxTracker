<?php
session_start();

// Check if the user is logged in
if (isset($_SESSION['USER']) || isset($_SESSION['ROLE'])) {
    // If the session variables are not set, redirect to the sign-in page
    header("Location: sign.html");
    exit();
}


?>