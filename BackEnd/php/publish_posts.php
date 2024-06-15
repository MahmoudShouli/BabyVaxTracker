<?php
    require_once "db_connect.php";

    global $conn;

    session_start();

    $current_user = $_SESSION['USER'];

    if (substr($current_user, 0, 2) === "05") {
        $query = "SELECT ID FROM users WHERE users.phone = ?";
    }
    else
        $query = "SELECT ID FROM users WHERE users.email = ?";


    $stmt = $conn ->prepare($query);
    $stmt->bind_param("s", $current_user);
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


    if($_SESSION['ROLE']==1)
        header("Location: ../../FrontEnd/html/admin_feedback.php");
    elseif($_SESSION['ROLE']==2)
        header("Location: ../../FrontEnd/html/feedback.php");
