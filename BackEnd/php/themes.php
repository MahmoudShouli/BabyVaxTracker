<?php

    session_start();

    require_once "db_connect.php";

    global $conn;


    $userID = $_SESSION['ID'];

    $new_theme = '';

    $fetch_query = "SELECT theme FROM users WHERE ID = ?";
    $fetch_stmt = $conn->prepare($fetch_query);
    $fetch_stmt->bind_param("i", $userID);
    $fetch_stmt->execute();
    $fetch_stmt->bind_result($theme);
    $fetch_stmt->fetch();
    $fetch_stmt->close();


    if($theme=='light') {

        $new_theme = "dark";

        $post_query = "UPDATE users SET theme = ? WHERE ID = ?";
        $post_stmt = $conn->prepare($post_query);
        $post_stmt->bind_param("si", $new_theme, $userID);
        $post_stmt->execute();
        $post_stmt->close();



    }
    elseif($theme=='dark'){

        $new_theme = "light";

        $post_query = "UPDATE users SET theme = ? WHERE ID = ?";
        $post_stmt = $conn->prepare($post_query);
        $post_stmt->bind_param("si", $new_theme, $userID);
        $post_stmt->execute();
        $post_stmt->close();




    }



    echo $new_theme;