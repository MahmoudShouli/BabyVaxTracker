<?php
    require_once "db_connect.php";

    session_start();

    $user_email = $_SESSION['USER'];


    global $conn;


    $tempFilePath = $_FILES["fileToUpload"]["name"];
    $photo = "../../Resources/images/".$tempFilePath;




    $stmt = $conn->prepare("UPDATE users SET photo = ? WHERE email = ?");
    $stmt->bind_param("ss", $photo, $user_email);
    $stmt->execute();



    header("Location: ../../FrontEnd/html/feedback.php");


