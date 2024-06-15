<?php
    session_start();

    require_once "db_connect.php";

    global $conn;

    if(isset($_POST['likeBtn'])) {


        $postID = $_POST['likeBtn'];

        $query = "UPDATE posts p SET likes_count = likes_count + 1 WHERE p.ID = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("i", $postID);
        $stmt->execute();

        if($_SESSION['ROLE']==1)
            header("Location: ../../FrontEnd/html/admin_feedback.php");
        elseif($_SESSION['ROLE']==2)
            header("Location: ../../FrontEnd/html/feedback.php");
    }
    elseif (isset($_POST['deleteBtn'])) {


        $postID = $_POST['deleteBtn'];



        $query = "DELETE FROM posts WHERE ID = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("i", $postID);
        $stmt->execute();

        if($_SESSION['ROLE']==1)
            header("Location: ../../FrontEnd/html/admin_feedback.php");
        elseif($_SESSION['ROLE']==2)
            header("Location: ../../FrontEnd/html/feedback.php");



    }