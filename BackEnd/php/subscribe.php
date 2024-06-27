<?php

    require_once "db_connect.php";

    global $conn;

    session_start();


    $userEmail = $_SESSION['USER'];

    $query = "
    
    UPDATE users
    SET subscribed = 1
    WHERE users.email = ?
    
    ";

    $stmt = $conn->prepare($query);
    $stmt->bind_param("s",$userEmail);
    $stmt->execute();

    $_SESSION['subscribed'] = 1;

    header("Location: ../../FrontEnd/html/index.php");
