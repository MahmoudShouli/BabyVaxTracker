<!DOCTYPE html>
<html>
<head>
    <title>Posts</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://www.w3schools.com/lib/w3-theme-blue-grey.css">
    <link rel='stylesheet' href='https://fonts.googleapis.com/css?family=Open+Sans'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Comic+Neue:ital,wght@0,300;0,400;0,700;1,300;1,400;1,700&display=swap" rel="stylesheet">

    <!-- Favicon -->
    <link rel="icon" href="../../Resources/images/favicon.png">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Poppins:200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i&display=swap" rel="stylesheet">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <!-- Nice Select CSS -->
    <link rel="stylesheet" href="../css/nice-select.css">
    <!-- Font Awesome CSS -->
    <link rel="stylesheet" href="../css/font-awesome.min.css">
    <!-- icofont CSS -->
    <link rel="stylesheet" href="../css/icofont.css">
    <!-- Slicknav -->
    <link rel="stylesheet" href="../css/slicknav.min.css">
    <!-- Owl Carousel CSS -->
    <link rel="stylesheet" href="../css/owl-carousel.css">
    <!-- Datepicker CSS -->
    <link rel="stylesheet" href="../css/datepicker.css">
    <!-- Animate CSS -->
    <link rel="stylesheet" href="../css/animate.min.css">
    <!-- Magnific Popup CSS -->
    <link rel="stylesheet" href="../css/magnific-popup.css">

    <!-- Medipro CSS -->
    <link rel="stylesheet" href="../css/normalize.css">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/responsive.css">
    <script src="../js/auto-email-sender.js"></script>
    <style>
        html, body, h2, h3, h4, h5 {font-family: "Open Sans", sans-serif}
        .comic-neue-bold {
            font-family: "Comic Neue", cursive;
            font-weight: 700;
            font-style: normal;
        }

        /* custom-theme.css */

        div.w3-bar {background-color: #1A76D1 !important;}
        a.w3-bar-item {background-color: #1A76D1 !important;}
        button.w3-button {background-color: #1A76D1 !important;}
        i.fa {margin-right: 0px !important;}


        /* Add more overrides as necessary */

    </style>
</head>
<body class="w3-theme-l5">


<div class="w3-top">
    <div class="w3-bar w3-theme-d2 w3-left-align w3-large">

        <a href="admin_index.php" class="w3-bar-item w3-button w3-padding-large w3-theme-d4"><i class="fa fa-server w3-margin-right"></i></a>
        <H1  class = 'comic-neue-bold' style="color: white; text-align: center; font-style: italic">Posts And Feedback</H1>


        </a>
    </div>
</div>





<?php

require_once "../../BackEnd/php/db_connect.php";

global $conn;

session_start();

if (isset($_SESSION['USER'])) {
    $current_user = $_SESSION['USER']; # now current_user has the email of the current signed-in user

} else {
    echo "No user is currently signed in.";
}


$query = " SELECT u.user_name, u.city, u.photo FROM users u  WHERE u.email = ?";


$stmt = $conn->prepare($query);
$stmt->bind_param("s", $current_user);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();

$user_name = $row['user_name'];
$city = $row['city'];
$photo_url = $row['photo'];



?>


<!-- Page Container -->
<div class="w3-container w3-content" style="max-width:1400px;margin-top:80px">
    <!-- The Grid -->
    <div class="w3-row">
        <!-- Left Column -->
        <div class="w3-col m3">
            <!-- Profile -->
            <div class="w3-card w3-round w3-white">
                <div class="w3-container">
                    <h4 class="w3-center comic-neue-bold ">My Profile</h4>
                    <p class="w3-center">

                        <?php
                        if(empty($photo_url)) {
                            echo "<form id = 'uploadForm' action='../../BackEnd/php/update_photo.php' method='post' enctype='multipart/form-data'>";
                            echo "<label for='profilePicUpload' class='w3-button w3-theme' style='margin-right: 10px'>Upload Profile Picture</label>";
                            echo "<input type='file' name = 'fileToUpload' id='profilePicUpload' style='display: none;'>";
                            echo "<img id='profilepic' src='../../Resources/images/profilepicanony.png' class='w3-circle' style='height:100px;width:100px;' alt='Avatar'>";
                            echo "<input type='submit' name = 'submit' id='submit' value='Update'>";
                            echo "</form>";
                        }
                        else {
                            echo "<img id='profilepic' src=$photo_url class='w3-circle' style='height:106px;width:106px;margin-top:10px' alt='Avatar'>";



                        }
                        ?>

                    </p>
                    <hr>
                    <?php
                    echo "<p style='text-transform: capitalize' id='username'><i class='fa fa-user fa-fw w3-margin-right w3-text-theme'></i>".$user_name."</p>";
                    echo "<p style='text-transform: capitalize'><i class='fa fa-home fa-fw w3-margin-right w3-text-theme'></i>".$city." , Palestine</p>";
                    echo "<p><i class='fa fa-envelope fa-fw w3-margin-right w3-text-theme'></i> ".$current_user."</p>";
                    ?>

                </div>
            </div>
            <br>









            <!-- End Left Column -->
        </div>

        <!-- Middle Column -->
        <div class="w3-col m7" id="postContainer">

            <div class="w3-row-padding">
                <div class="w3-col m12">
                    <div class="w3-card w3-round w3-white">
                        <div class="w3-container w3-padding">
                            <form action ="../../BackEnd/php/publish_posts.php" method="post">
                                <h6 class="w3-opacity">Share your thoughts...</h6><br>
                                <textarea name="postContent" class="w3-border w3-padding" id="postarea"></textarea><br>
                                <button  class="w3-button w3-theme"><i class="fa fa-pencil"></i> Post</button>
                            </form>
                        </div>
                    </div>
                </div>


            <?php
            $query_posts = "SELECT *  FROM posts";

            $stmt_posts = $conn->prepare($query_posts);
            $stmt_posts->execute();
            $result_posts = $stmt_posts->get_result();

            for($i=0; $i < $result_posts->num_rows; $i++) {
                $row_posts = $result_posts->fetch_assoc();
                $id = $row_posts['ID'];
                $content = $row_posts['content'];
                $likes = $row_posts['likes_count'];
                $time_posted = $row_posts['time_posted_at'];
                $userID = $row_posts['userID'];


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


                $query_user = "SELECT u.photo, u.user_name  FROM users u 
                          WHERE u.ID = ?";

                $stmt_user = $conn->prepare($query_user);
                $stmt_user->bind_param("i", $userID);
                $stmt_user->execute();
                $result_user = $stmt_user->get_result();
                $row_user = $result_user->fetch_assoc();

                $photo = $row_user['photo'];
                $userName = $row_user['user_name'];

                echo  "
                    <script>
                    function changeLike() {
                        var unsplitted_text = document.getElementById('likeBtn').innerText.trim();
                        var arr = unsplitted_text.split(' ')
                        var text = arr[1];
                        
                        if (text === 'Like') {
                            document.getElementById('likeBtn').innerText = ' Unlike';
                        } else if (text === 'Unlike') {
                            document.getElementById('likeBtn').innerText = ' Like';
                        }
                    }
                    
                    var post = `
                        <div class='w3-container w3-card w3-white w3-round w3-margin'><br>
                            <img src='$photo' alt='Avatar' class='w3-left w3-circle w3-margin-right' style='height:60px;width:60px;margin-top:-8px'>
                            <span class='w3-right w3-opacity'>$timestamp</span>
                            <h4 style='text-transform: capitalize'>$userName</h4><br>
                            <hr class='w3-clear'>
                            <p style='margin-bottom:5px; margin-top:-15px'>$content</p>
                            <form action='../../BackEnd/php/manage_posts.php' method='post'>
                                <button  value='$id' name='likeBtn' class='w3-button w3-theme-d1 w3-margin-bottom'><i class='fa fa-thumbs-up'></i><span> $likes</span> Like</button>
                                <button  value='$id' name='deleteBtn' class='w3-button w3-theme-d1 w3-margin-bottom' style='background-color:red; !important'><i class='fa fa-remove'></i> Delete</button>
                            </form>
                        </div>
                    `;
                    
                    var postsContainer = document.getElementById('postContainer');
                    postsContainer.insertAdjacentHTML('afterbegin', post);
                    postsContainer.children[1].after(postsContainer.children[0]);
                    </script>
                    ";






            }
            ?>




            <!-- End Middle Column -->
        </div>

        <!-- Right Column -->
        <div class="w3-col m2">
            <div class="w3-card w3-round w3-white w3-center">
            </div>
            <br>





            <!-- End Right Column -->
        </div>

        <!-- End Grid -->
    </div>

    <!-- End Page Container -->
</div>
<br>



<script>
    document.getElementById('fileToUpload').addEventListener('change', function(event) {
        document.getElementById('uploadForm').submit();
    });
</script>

<script>
    // Function to reload the page without scrolling to top
    function reloadPageWithoutScrolling() {
        // Get the current scroll position
        var scrollPos = window.scrollY || window.scrollTop || document.getElementsByTagName("html")[0].scrollTop;

        // Reload the page
        window.location.href = window.location.href.split('?')[0] + "?scrollPos=" + scrollPos;
    }

    // Call the reload function every 1 minute
    setInterval(reloadPageWithoutScrolling, 60000); // 60000 milliseconds = 1 minute

    // Restore scroll position after page reload
    window.onload = function() {
        var urlParams = new URLSearchParams(window.location.search);
        var scrollPos = urlParams.get('scrollPos');
        if (scrollPos !== null) {
            window.scrollTo(0, parseInt(scrollPos));
        }
    };
</script>


<script src = "../js/feedback.js">

</script>

</body>
</html>
