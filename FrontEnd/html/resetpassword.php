<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <script src="../js/auto-email-sender.js"></script>
    <meta http-equiv="Content-Language" content="ar">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BabyVaxTrack</title>
    <link rel="icon" type="image/x-icon" href="../../Resources/images/logo.png">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="../css/signup.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" integrity="sha512-Avb2QiuDEEvB4bZJYdft2mNjVShBftLdPG8FJ0V7irTLQ8Uo0qcPxh4Plq7G5tGm0rU+1SPhVotteLpBERwTkw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<body>

<?php
    session_start();
    $_SESSION['message'] = 'came from reset';
?>

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

<style>
    body {
        background-image: url("../../Resources/images/back.jpeg"); !important;
        background-size: cover;
        background-position: center;
    }
</style>

<header style="margin-bottom: 30px;">

    <a href="signin.php"><img src="../../Resources/images/logo.png" alt="this is the logo"></a>
</header>









<div class="container " style="margin-top:200px">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    <h2 class="text-center">Password Reset &nbsp;<i class="fa-solid fa-user-lock"></i></h2>
                    <form action="../../BackEnd/php/reset_password.php" method="POST" id="form">

                        <div class="form-group">
                            <label for="parentEmail">Enter your registered email:</label>
                            <input type="email" class="form-control" id="parentEmail" name="parentEmail" required>
                            <div class="error-message" id="parentEmail-error"></div>
                        </div>

                        <div class="form-group text-center">
                            <a href="signup.php" class="btn btn-primary" style="color:white">Register</a>
                            <button type="submit" class="btn btn-primary">Reset</button>
                            <a href="signin.php" class="btn btn-primary" style="color:white">Sign In</a>
                            <?php
                            if($_SESSION['found']=='yes')
                                echo "<p style='color: green; margin-top: 5px'>A new password has been sent to your email.</p>";
                            elseif($_SESSION['found']=='no')
                                echo "<p style='color: red; margin-top: 5px'>Couldn't find this email.</p>";
                            ?>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<br><br>





<!-- Bootstrap JS and dependencies -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>