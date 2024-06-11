<?php

    require_once "db_connect.php";

    global $conn;

    $postID = $_POST['likeBtn'];

    $query = "UPDATE posts p SET likes_count = likes_count + 1 WHERE p.ID = ?";
    $stmt = $conn ->prepare($query);
    $stmt->bind_param("i", $postID);
    $stmt->execute();

    header("Location: ../../FrontEnd/html/feedback.php");