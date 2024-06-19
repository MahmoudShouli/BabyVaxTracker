<?php
    session_start();

    require_once "db_connect.php";

    global $conn;



    if (isset($_POST['action'])) {
        $action = $_POST['action'];

        if($action=='init'){


            $userID = $_SESSION['ID'];  //current user ID

            $query1 = "SELECT roleID  FROM users WHERE users.ID = ?";

            $stmt1 = $conn->prepare($query1);
            $stmt1->bind_param("i", $userID);
            $stmt1->execute();
            $result1 = $stmt1->get_result();
            $stmt1->close();

            $row1 = $result1->fetch_assoc();
            $id = $row1['roleID'];

            $isCurAdmin = false;

            if($id == 1){
                $isCurAdmin = true; // will send

            }elseif($id == 0){
                $isCurAdmin = false;
            }




            $arrayPosts = [];

            $query_posts = "SELECT *  FROM posts";

            $stmt_posts = $conn->prepare($query_posts);
            $stmt_posts->execute();
            $result_posts = $stmt_posts->get_result();
            $stmt_posts->close();

            $index = 0;
            while($row_posts=$result_posts->fetch_assoc()) {



                $postID = $row_posts['ID']; //will send
                $time_posted = $row_posts['time_posted_at'];


                $current_time = date('H:i:s');

                // Create DateTime objects
                $time_posted_dt = new DateTime($time_posted);
                $current_time_dt = new DateTime($current_time);

                // Calculate the difference
                $interval = $current_time_dt->diff($time_posted_dt);

                // Get differences
                $year_difference = $interval->y;
                $month_difference = $interval->m;
                $day_difference = $interval->d;
                $hour_difference = $interval->h;
                $minute_difference = $interval->i;
                $second_difference = $interval->s;



                //will send timestamp
                // Format the difference
                if ($year_difference == 0 && $month_difference == 0 && $day_difference == 0 && $hour_difference == 0 && $minute_difference == 0) {
                    $timestamp = "just now!";
                } elseif ($year_difference == 0 && $month_difference == 0 && $day_difference == 0 && $hour_difference == 0) {
                    $timestamp = "$minute_difference minutes ago";
                } elseif ($year_difference == 0 && $month_difference == 0 && $day_difference == 0) {
                    $timestamp = "$hour_difference hours ago";
                } elseif ($year_difference == 0 && $month_difference == 0) {
                    $timestamp = "$day_difference days ago";
                } elseif ($year_difference == 0) {
                    $timestamp = "$month_difference ago";
                } else {
                    $timestamp = "$year_difference years  ago";
                }







                $content = $row_posts['content']; //will send

                $query_role = "SELECT u.roleID, u.user_name, u.ID, u.photo, p.likes_count
                FROM posts p
                JOIN users u ON p.userID = u.ID
                WHERE p.ID = ?;
                ";

                $stmt_role = $conn->prepare($query_role);
                $stmt_role->bind_param("i", $postID);
                $stmt_role->execute();
                $result_role = $stmt_role->get_result();
                $stmt_role->close();
                $row_role = $result_role->fetch_assoc();

                $user_name = $row_role['user_name']; // will send
                $roleID = $row_role['roleID'];
                $uID = $row_role['ID'];
                $photo = $row_role['photo']; // will send
                $likes = $row_role['likes_count']; // will send


                // check if the post is owned by user
                if($uID == $userID)
                    $isOwned = true;   // will send
                else
                    $isOwned = false;

                // check if the owner of the post is an admin
                if($roleID == 1)
                    $isAdmin = true;   // will send
                else
                    $isAdmin = false;



                $query_interaction = "SELECT isLiked  FROM liked_unliked_posts p WHERE p.postID = ? AND p.userID = ?";

                $stmt_interaction = $conn->prepare($query_interaction);
                $stmt_interaction->bind_param("ii", $postID, $userID);
                $stmt_interaction->execute();
                $result_interaction = $stmt_interaction->get_result();
                $stmt_interaction->close();
                $row_interaction = $result_interaction->fetch_assoc();


                if($result_interaction->num_rows>0){
                    $isLiked = $row_interaction['isLiked']; // will send
                }
                else{
                    $isLiked=0;
                }


                $arrayPosts["post".$index] = [

                    'postID' => $postID,
                    'isCurAdmin' => $isCurAdmin,
                    'timestampp' => $timestamp,
                    'contentt' => $content,
                    'usernamee' => $user_name,
                    'photo' => $photo,
                    'likes'=> $likes,
                    'isOwned' => $isOwned,
                    'isAdmin' => $isAdmin,
                    'isLiked' => $isLiked
                ];


                $index++;
            }

            header('Content-Type: application/json');
            echo json_encode($arrayPosts);



        }

        if($action=='post'){

            $userID = $_SESSION['ID'];

            $query = "SELECT user_name,photo,roleID FROM users WHERE ID = ?";
            $stmt = $conn ->prepare($query);
            $stmt->bind_param("i",  $userID);
            $stmt->execute();
            $result = $stmt->get_result();
            $row = $result->fetch_assoc();
            $user_name = $row['user_name'];
            $photo = $row['photo'];
            $roleID = $row['roleID'];

            if($roleID==1){
                $isAdmin = true;
            } else $isAdmin = false;


            $content = $_POST['content'];

            $likes = 0;

            $current_time = date('Y-m-d H:i:s');


            $query = "INSERT INTO posts(content, likes_count, time_posted_at, userID) values(?,?,?,?)";
            $stmt = $conn ->prepare($query);
            $stmt->bind_param("sisi", $content, $likes, $current_time, $userID);
            $stmt->execute();

            $postID = $conn->insert_id;



            $response = array(
                'user_name' => $user_name,
                'photo' => $photo,
                'isAdmin' => $isAdmin,
                'postID' => $postID
            );

            echo json_encode($response);





        } // end of post

        elseif ($action=='Like'){

            $postID = $_POST['postID'];

            $post_query = "UPDATE posts p SET likes_count = likes_count + 1 WHERE p.ID = ?";
            $post_stmt = $conn->prepare($post_query);
            $post_stmt->bind_param("i", $postID);
            $post_stmt->execute();
            $post_stmt->close();

            $fetch_query = "SELECT likes_count FROM posts WHERE ID = ?";
            $fetch_stmt = $conn->prepare($fetch_query);
            $fetch_stmt->bind_param("i", $postID);
            $fetch_stmt->execute();
            $fetch_stmt->bind_result($updated_likes_count);
            $fetch_stmt->fetch();
            $fetch_stmt->close();



            $userID = $_SESSION['ID'];



            $x = 1;

            $query2 = "SELECT * FROM liked_unliked_posts p WHERE p.postID = ? AND p.userID = ?";
            $stmt2 = $conn->prepare($query2);
            if (!$stmt2) {
                die('Prepare failed: ' . $conn->error);
            }

            $stmt2->bind_param("ii", $postID, $userID);
            $stmt2->execute();
            $result2 = $stmt2->get_result();


            if($result2->num_rows==0) {

                $interaction_query = "INSERT INTO liked_unliked_posts(postID, userID, isLiked) values(?,?,?)  ";
                $interaction_stmt = $conn->prepare($interaction_query);
                $interaction_stmt->bind_param("iii", $postID, $userID, $x);
                $interaction_stmt->execute();
                $interaction_stmt->close();

            }

            elseif ($result2->num_rows>0){
                $x = 1;
                $interaction_query = "UPDATE liked_unliked_posts p SET p.isLiked = ? WHERE p.postID = ? AND p.userID = ?  ";
                $interaction_stmt = $conn->prepare($interaction_query);
                $interaction_stmt->bind_param("iii", $x, $postID, $userID);
                $interaction_stmt->execute();
                $interaction_stmt->close();
            }

            $stmt2->close();


            $response = array(
                'likes' => $updated_likes_count
            );

            echo json_encode($response);



        } // end of like

        elseif ($action=='Unlike'){

            $postID = $_POST['postID'];

            $post_query = "UPDATE posts p SET likes_count = likes_count - 1 WHERE p.ID = ?";
            $post_stmt = $conn->prepare($post_query);
            $post_stmt->bind_param("i", $postID);
            $post_stmt->execute();
            $post_stmt->close();

            $fetch_query = "SELECT likes_count FROM posts WHERE ID = ?";
            $fetch_stmt = $conn->prepare($fetch_query);
            $fetch_stmt->bind_param("i", $postID);
            $fetch_stmt->execute();
            $fetch_stmt->bind_result($updated_likes_count);
            $fetch_stmt->fetch();
            $fetch_stmt->close();


            $userID = $_SESSION['ID'];



            $x = 0;

            $query2 = "SELECT * FROM liked_unliked_posts p WHERE p.postID = ? AND p.userID = ?";
            $stmt2 = $conn->prepare($query2);
            if (!$stmt2) {
                die('Prepare failed: ' . $conn->error);
            }

            $stmt2->bind_param("ii", $postID, $userID);
            $stmt2->execute();
            $result2 = $stmt2->get_result();




            $interaction_query = "UPDATE liked_unliked_posts p SET p.isLiked = ? WHERE p.postID = ? AND p.userID = ?  ";
            $interaction_stmt = $conn->prepare($interaction_query);
            $interaction_stmt->bind_param("iii", $x, $postID, $userID);
            $interaction_stmt->execute();
            $interaction_stmt->close();


            $stmt2->close();



            $response = array(
                'likes' => $updated_likes_count
            );

            echo json_encode($response);





        }// end of unlike
        elseif ($action=='delete'){

            $postID = $_POST['postID'];

            $post_query = "DELETE FROM posts WHERE ID = ?";
            $post_stmt = $conn->prepare($post_query);
            $post_stmt->bind_param("i", $postID);
            $post_stmt->execute();




        } // end of delete





    }