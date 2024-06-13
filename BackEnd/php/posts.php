<?php
    require_once "db_connect.php";

    global $conn;

    session_start();

    $userEmail = $_SESSION['USER'];

    $query = "SELECT ID FROM users WHERE users.email = ?";
    $stmt = $conn ->prepare($query);
    $stmt->bind_param("s", $userEmail);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    $userID = $row['ID'];


    $content = $_POST['postContent'];

    $likes = 0;

    $current_time = date('Y-m-d H:i:s');


    $query = "INSERT INTO posts(content, likes_count, time_posted_at, userID) values(?,?,?,?)";
    $stmt = $conn ->prepare($query);
    $stmt->bind_param("sisi", $content, $likes, $current_time, $userID);
    $stmt->execute();

    header("Location: ../../FrontEnd/html/feedback.php");
