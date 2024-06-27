
<?php

require_once "../../BackEnd/php/db_connect.php";

global $conn;

session_start();



if (isset($_SESSION['USER'])) {
    $current_user = $_SESSION['USER']; # now current_user has the email of the current signed-in user

} else {
    header("Location: signin.php");
}

if (substr($current_user, 0, 2) === "05") {
    $query = " SELECT u.user_name, u.city, u.photo, u.ID, u.theme FROM users u  WHERE u.phone = ?";
}
else
    $query = " SELECT u.user_name, u.city, u.photo, u.ID, u.theme FROM users u  WHERE u.email = ?";



$stmt = $conn->prepare($query);
$stmt->bind_param("s", $current_user);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();

$user_name = $row['user_name'];
$city = $row['city'];
$photo_url = $row['photo'];
$current_user_ID = $row['ID'];
$theme = $row['theme'];

    echo "<input id='x' value='$theme' type='hidden'>";
$_SESSION['thm'] = $theme;

$_SESSION['ID'] = $current_user_ID;

?>


<!DOCTYPE html>
<html>
<head>
<title>BabyVaxTrack</title>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://www.w3schools.com/lib/w3-theme-blue-grey.css">
<link rel='stylesheet' href='https://fonts.googleapis.com/css?family=Open+Sans'>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
 <script src="../js/auto-email-sender.js"></script>

 <!-- Favicon -->
 <link rel="icon" href="../../Resources/images/favicon.png">

 <!-- Google Fonts -->
 <link href="https://fonts.googleapis.com/css?family=Poppins:200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i&display=swap" rel="stylesheet">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Comic+Neue:ital,wght@0,300;0,400;0,700;1,300;1,400;1,700&display=swap" rel="stylesheet">

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
<body class="w3-theme-l5" onload = "initialize();"  >

<!-- Navbar -->
<header class="w3-top">
 <div id="header" class="w3-bar w3-theme-d2 w3-left-align w3-large">
     <?php
     if($_SESSION['ROLE']==1)
         echo "<a href='admin_index.php' class='w3-bar-item w3-button w3-padding-large w3-theme-d4'><i class='fa fa-home w3-margin-right'></i></a>";
     else
         echo "<a href='index.php' class='w3-bar-item w3-button w3-padding-large w3-theme-d4'><i class='fa fa-home w3-margin-right'></i></a>";

     if($_SESSION['thm']=='light')
         echo '<a  id="theme-switcher" onclick="changeTheme()"  class="w3-bar-item w3-button w3-padding-large w3-theme-d4"><i class="fa fa-moon-o w3-margin-right"></i></a>';
     else
         echo '<a  id="theme-switcher" onclick="changeTheme()" class="w3-bar-item w3-button w3-padding-large w3-theme-d4"><i class="fa fa-sun-o w3-margin-right"></i></a>';

     ?>
     <H1  class = 'comic-neue-bold' style="color: white; text-align: center; font-style: italic">Posts And Feedback</H1>
 </div>
</header>



<!-- Page Container -->
<div class="w3-container w3-content" style="max-width:1400px;margin-top:80px">
  <!-- The Grid -->
  <div class="w3-row">
    <!-- Left Column -->
    <div class="w3-col m3">
      <!-- Profile -->
      <div class="w3-card w3-round w3-white">
        <section id = "profile" class="w3-container">
         <h4 class="w3-center comic-neue-bold">My Profile</h4>
         <p class="w3-center">

             <?php
                if($photo_url=='../../Resources/images/profilepicanony.png') {
                    echo "<form id='uploadForm' action='../../BackEnd/php/update_photo.php' method='post' enctype='multipart/form-data'>";
                    echo "<button type='button' onclick='openFileInput()' class='w3-button w3-theme' style='margin-right: 10px'>Upload Profile Picture</button>";
                    echo "<input type='file' name='profilePicUpload' id='profilePicUpload' style='display: none;' onchange='uploadProfilePic()'>";
                    echo "<img id='profilepic' src='../../Resources/images/profilepicanony.png' class='w3-circle' style='height:100px;width:100px' alt='Avatar'>";
                    echo "</form>";
                }
                else {
                    echo "<img id='profilepic' src='$photo_url' class='w3-circle' style='height:150px;width:150px;margin-top:10px' alt='Avatar'>";



                }
             ?>

         </p>
         <hr>
            <?php
            echo "<p style='text-transform: capitalize' id='username'><i class='fa fa-user fa-fw w3-margin-right w3-text-theme'></i>".$user_name."</p>";
            echo "<p style='text-transform: capitalize'><i class='fa fa-home fa-fw w3-margin-right w3-text-theme'></i>".$city." , Palestine</p>";
            echo "<p><i class='fa fa-envelope fa-fw w3-margin-right w3-text-theme'></i> ".$current_user."</p>";
            ?>

        </section>
      </div>
      <br>









    <!-- End Left Column -->
    </div>
    
    <!-- Middle Column -->
    <div class="w3-col m7" id="postContainer">
    
      <div class="w3-row-padding">
        <div class="w3-col m12">
          <div class="w3-card w3-round w3-white">
            <section class="w3-container w3-padding">

              <h6 class="w3-opacity">Share your thoughts...</h6><br>
               <textarea name="postContent" class="w3-border w3-padding" id="postarea"></textarea><br>
               <button id = 'postBtn' onclick="publish();" class="w3-button w3-theme" style="margin-top:5px"><i class="fa fa-pencil"></i> Post</button>

            </section>
          </div>
        </div>
      </div><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>

      
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



<!-- Footer Area -->
<footer id="footer" class="footer ">
    <!-- Footer Top -->
    <div id="foot" class="footer-top">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-6 col-12">
                    <div class="single-footer">
                        <h2>Social Media</h2>
                        <!-- Social -->
                        <ul class="social">
                            <li><a href="#"><i class="icofont-facebook"></i></a></li>
                            <li><a href="#"><i class="icofont-instagram"></i></a></li>
                            <li><a href="#"><i class="icofont-twitter"></i></a></li>
                        </ul>
                        <!-- End Social -->
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-12">
                    <div class="single-footer f-link">
                        <h2>Quick Links</h2>
                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-12">
                                <ul>
                                    <li><a href="index.php#header"><i class="fa fa-caret-right" aria-hidden="true"></i>Home</a></li>
                                    <li><a href="index.php#about"><i class="fa fa-caret-right" aria-hidden="true"></i>About Us</a></li>
                                    <li><a href="index.php#service"><i class="fa fa-caret-right" aria-hidden="true"></i>Services</a></li>
                                </ul>
                            </div>
                            <div class="col-lg-6 col-md-6 col-12">
                                <ul>
                                    <li><a href="index.php#news"><i class="fa fa-caret-right" aria-hidden="true"></i>News</a></li>
                                    <li><a href="contact_page.php"><i class="fa fa-caret-right" aria-hidden="true"></i>Contact Us</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-12">
                    <div class="single-footer">
                        <h2>Open Hours</h2>
                        <ul class="time-sidual">
                            <li class="day">Sunday-Thursday: <span>8:00am-4:00 pm</span></li>

                        </ul>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-12">
                    <div class="single-footer">
                        <h2>Newsletter</h2>
                        <a href ="#newsletter" style="color:white;">subscribe to our newsletter to get all our news in your inbox</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--/ End Footer Top -->
    <!-- Copyright -->
    <div id="copy" class="copyright">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-12">
                    <div class="copyright-content">
                        <p>© Copyright 2024  |  All Rights Reserved</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--/ End Copyright -->
</footer>
<!--/ End Footer Area -->




<script>
    document.getElementById('fileToUpload').addEventListener('change', function(event) {
        document.getElementById('uploadForm').submit();
    });
</script>





<script>




            let text = document.getElementById('x').value;

            setTimeout('showCont(text)',100);



            function showCont(theme) {

                let switcher = document.getElementById('theme-switcher');



                if (theme == "dark") {


                    switcher.innerHTML = "<i class='fa fa-sun-o w3-margin-right'></i>";


                    document.body.style.setProperty('background-color', '#191a1c', 'important');


                    const sections = document.querySelectorAll('section');

                    // Apply styles to each paragraph
                    sections.forEach(section => {
                        section.style.setProperty('background-color', '#242527', 'important');
                        // Add more styles as needed
                    });


                    const paragraphs = document.querySelectorAll('p');

                    // Apply styles to each paragraph
                    paragraphs.forEach(paragraph => {
                        paragraph.style.setProperty('color', '#ffffff', 'important');
                        // Add more styles as needed
                    });


                    const h4Elements = document.querySelectorAll('h4');

                    // Apply styles to each <h4> element
                    h4Elements.forEach(h4 => {
                        h4.style.setProperty('color', '#ffffff', 'important');
                    });

                    // Select all <span> elements
                    const spanElements = document.querySelectorAll('span');

                    // Apply styles to each <span> element
                    spanElements.forEach(span => {
                        span.style.setProperty('color', '#ffffff', 'important');
                    });


                    const h1Elements = document.querySelectorAll('h1');

                    // Apply styles to each <h1> element
                    h1Elements.forEach(h1 => {
                        h1.style.setProperty('color', '#ffffff', 'important');
                    });


                    const h6Elements = document.querySelectorAll('h6');

                    // Apply styles to each <h1> element
                    h6Elements.forEach(h6 => {
                        h6.style.setProperty('color', '#ffffff', 'important');
                    });


                    const t = document.querySelectorAll('textarea');

                    // Apply styles to each <h1> element
                    t.forEach(tx => {
                        tx.style.setProperty('background-color', 'rgba(40,36,36,0.07)', 'important');
                        tx.style.setProperty('color', 'rgb(255,255,255)', 'important');
                    });


                    document.getElementById('admin').style.color = 'red';
                    document.getElementById('admin').style.fontWeight = 'normal';


                    document.getElementById('header').style.setProperty('background-color', '#1b3c71', 'important');


                    const anchors = document.querySelectorAll('a');

                    // Apply styles to each <h1> element
                    anchors.forEach(a => {
                        a.style.setProperty('background-color', '#1b3c71', 'important');

                    });


                    const buttons = document.querySelectorAll('button');

                    // Apply styles to each <h1> element
                    buttons.forEach(b => {
                        b.style.setProperty('background-color', '#1b3c71', 'important');

                    });


                    document.getElementById('copy').style.setProperty('background-color', '#1b3c71', 'important');

                    document.getElementById('foot').style.setProperty('background-color', '#1b3c71', 'important');


                } // end of dark

                else if (theme == "light") {


                    switcher.innerHTML = "<i class='fa fa-moon-o w3-margin-right'></i>";


                    document.body.style.setProperty('background-color', '#f5f7f8', 'important');


                    const sections = document.querySelectorAll('section');

                    // Apply styles to each paragraph
                    sections.forEach(section => {
                        section.style.setProperty('background-color', '#ffffff', 'important');
                        // Add more styles as needed
                    });


                    const paragraphs = document.querySelectorAll('p');

                    // Apply styles to each paragraph
                    paragraphs.forEach(paragraph => {
                        paragraph.style.setProperty('color', '#090909', 'important');
                        // Add more styles as needed
                    });


                    const h4Elements = document.querySelectorAll('h4');

                    // Apply styles to each <h4> element
                    h4Elements.forEach(h4 => {
                        h4.style.setProperty('color', '#090909', 'important');
                    });

                    // Select all <span> elements
                    const spanElements = document.querySelectorAll('span');

                    // Apply styles to each <span> element
                    spanElements.forEach(span => {
                        span.style.setProperty('color', '#090909', 'important');
                    });


                    const h1Elements = document.querySelectorAll('h1');

                    // Apply styles to each <h1> element
                    h1Elements.forEach(h1 => {
                        h1.style.setProperty('color', '#ffffff', 'important');
                    });


                    const h6Elements = document.querySelectorAll('h6');

                    // Apply styles to each <h1> element
                    h6Elements.forEach(h6 => {
                        h6.style.setProperty('color', '#090909', 'important');
                    });


                    const t = document.querySelectorAll('textarea');

                    // Apply styles to each <h1> element
                    t.forEach(tx => {
                        tx.style.setProperty('background-color', 'white', 'important');
                        tx.style.setProperty('color', 'black', 'important');
                    });


                    document.getElementById('admin').style.color = 'red';
                    document.getElementById('admin').style.fontWeight = 'normal';


                    document.getElementById('header').style.setProperty('background-color', '#1a76d1', 'important');


                    const anchors = document.querySelectorAll('a');

                    // Apply styles to each <h1> element
                    anchors.forEach(a => {
                        a.style.setProperty('background-color', '#1a76d1', 'important');

                    });


                    const buttons = document.querySelectorAll('button');

                    // Apply styles to each <h1> element
                    buttons.forEach(b => {
                        b.style.setProperty('background-color', '#1a76d1', 'important');

                    });


                    document.getElementById('copy').style.setProperty('background-color', '#1a76d1', 'important');

                    document.getElementById('foot').style.setProperty('background-color', '#1a76d1', 'important');


                }


            }











</script>




<script src = "../js/feedback.js"></script>
<script src = "../js/themes.js"></script>

</body>
</html> 
