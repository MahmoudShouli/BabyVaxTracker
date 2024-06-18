<?php
    session_start();

    require_once "db_connect.php";

    global $conn;

    if(isset($_POST['likeBtn'])) {




        $postID = $_POST['likeBtn'];

        $post_query = "UPDATE posts p SET likes_count = likes_count + 1 WHERE p.ID = ?";
        $post_stmt = $conn->prepare($post_query);
        $post_stmt->bind_param("i", $postID);
        $post_stmt->execute();


        if (isset($_SESSION['USER'])) {
            $current_user = $_SESSION['USER']; # now current_user has the email of the current signed-in user

        } else {
            echo "No user is currently signed in.";
        }

        if (substr($current_user, 0, 2) === "05") {
            $user_query = " SELECT u.user_name, u.city, u.photo, u.ID FROM users u  WHERE u.phone = ?";
        }
        else
            $user_query = " SELECT u.user_name, u.city, u.photo, u.ID FROM users u  WHERE u.email = ?";



        $user_stmt = $conn->prepare($user_query);
        $user_stmt->bind_param("s", $current_user);
        $user_stmt->execute();
        $user_result = $user_stmt->get_result();
        $user_row = $user_result->fetch_assoc();

        $current_user_ID = $user_row['ID'];

        $x = 1;

        $query2 = "SELECT * FROM liked_unliked_posts p WHERE p.postID = ? AND p.userID = ?  ";
        $stmt2 = $conn->prepare($query2);
        $stmt2->bind_param("ii", $postID, $current_user_ID);
        $stmt2->execute();
        $result2 = $stmt2->get_result();


        if($result2->num_rows==0) {

            $interaction_query = "INSERT INTO liked_unliked_posts(postID, userID, isLiked) values(?,?,?)  ";
            $interaction_stmt = $conn->prepare($interaction_query);
            $interaction_stmt->bind_param("iii", $postID, $current_user_ID, $x);
            $interaction_stmt->execute();

        }

        elseif ($result2->num_rows>0){
            $X = 1;
            $interaction_query = "UPDATE liked_unliked_posts p SET p.isLiked = ? WHERE p.postID = ? AND p.userID = ?  ";
            $interaction_stmt = $conn->prepare($interaction_query);
            $interaction_stmt->bind_param("iii", $x, $postID, $current_user_ID);
            $interaction_stmt->execute();
        }



        if($_SESSION['ROLE']==1)
            header("Location: ../../FrontEnd/html/admin_feedback.php");
        elseif($_SESSION['ROLE']==2)
            header("Location: ../../FrontEnd/html/feedback.php");


    }
    elseif (isset($_POST['deleteBtn'])) {


        $postID = $_POST['deleteBtn'];



        $post_query = "DELETE FROM posts WHERE ID = ?";
        $post_stmt = $conn->prepare($post_query);
        $post_stmt->bind_param("i", $postID);
        $post_stmt->execute();

        if($_SESSION['ROLE']==1)
            header("Location: ../../FrontEnd/html/admin_feedback.php");
        elseif($_SESSION['ROLE']==2)
            header("Location: ../../FrontEnd/html/feedback.php");



    }

    elseif (isset($_POST['unlikeBtn'])) {



        $postID = $_POST['unlikeBtn'];

        $post_query = "UPDATE posts p SET likes_count = likes_count - 1 WHERE p.ID = ?";
        $post_stmt = $conn->prepare($post_query);
        $post_stmt->bind_param("i", $postID);
        $post_stmt->execute();


        if (isset($_SESSION['USER'])) {
            $current_user = $_SESSION['USER']; # now current_user has the email of the current signed-in user

        } else {
            echo "No user is currently signed in.";
        }

        if (substr($current_user, 0, 2) === "05") {
            $user_query = " SELECT u.user_name, u.city, u.photo, u.ID FROM users u  WHERE u.phone = ?";
        }
        else
            $user_query = " SELECT u.user_name, u.city, u.photo, u.ID FROM users u  WHERE u.email = ?";



        $user_stmt = $conn->prepare($user_query);
        $user_stmt->bind_param("s", $current_user);
        $user_stmt->execute();
        $user_result = $user_stmt->get_result();
        $user_row = $user_result->fetch_assoc();

        $current_user_ID = $user_row['ID'];

        $x = 0;

        $interaction_query = "UPDATE liked_unliked_posts p SET p.isLiked = ? WHERE p.postID = ? AND p.userID = ?  ";
        $interaction_stmt = $conn->prepare($interaction_query);
        $interaction_stmt->bind_param("iii", $x, $postID,$current_user_ID);
        $interaction_stmt->execute();




        if($_SESSION['ROLE']==1)
            header("Location: ../../FrontEnd/html/admin_feedback.php");
        elseif($_SESSION['ROLE']==2)
            header("Location: ../../FrontEnd/html/feedback.php");




    }