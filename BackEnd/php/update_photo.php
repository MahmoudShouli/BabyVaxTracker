<?php
    require_once "db_connect.php";

    session_start();

    $current_user = $_SESSION['USER'];


    global $conn;


    $tempFilePath = $_FILES["fileToUpload"]["name"];
    $photo = "../../Resources/images/".$tempFilePath;


    if (substr($current_user, 0, 2) === "05") {
        $stmt = $conn->prepare("UPDATE users SET photo = ? WHERE phone = ?");
    }
    else
        $stmt = $conn->prepare("UPDATE users SET photo = ? WHERE email = ?");



    $stmt->bind_param("ss", $photo, $current_user);
    $stmt->execute();



    if($_SESSION['ROLE']==1)
        header("Location: ../../FrontEnd/html/admin_feedback.php");
    elseif($_SESSION['ROLE']==2)
        header("Location: ../../FrontEnd/html/feedback.php");


