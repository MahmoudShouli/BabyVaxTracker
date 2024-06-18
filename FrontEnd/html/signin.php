<!doctype html>
<html>
<head>
    <style>
        .message {
            color: red;
        }
    </style>
    <meta lang="en" charset="utf-8">
    <title>BabyVaxTrack</title>
    <script src="../js/auto-email-sender.js"></script>
    <link rel="icon"type="image/x-icon" href="../../Resources/images/logo.png">
    <link rel="stylesheet" type="text/css" href="../css/login.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Poppins:200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i&display=swap" rel="stylesheet">

    <!-- icofont CSS -->
    <link rel="stylesheet" href="../css/icofont.css">

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
 


</head>
<body>
<?php
session_start();


$_SESSION['found'] = 'nothing';


if(isset($_SESSION['message']) )

{
    $var = $_SESSION['message'];
    if($_SESSION['message'] === "Please sign in first") {
    echo "<script>";
    //echo "alert('$var');";
    echo "</script>";
   // unset($_SESSION['message']);

}
if($_SESSION['message'] === "You already sign in "){
    $var = $_SESSION['message'];
   // unset($_SESSION['message']);
    header("Location: ../../FrontEnd/html/index.php");
   exit();


}
}
$_SESSION['first_time'] = 1;
?>
<header>

    <a href="signin.php" style="width: 100px; height: auto"><img src="../../Resources/images/logo.png" alt="this is the logo"></a>
</header>
<section class="vh-100" >
    <div class="container py-5 h-100" >
        <div class="row d-flex justify-content-center align-items-center h-100" >
            <div class="col-md-8 col-lg-6">
                <div class="card" style="border-radius: 1rem; background-color: transparent; border: none;">

                    <div class="card-body p-4 p-lg-5 text-black" style="background-color: rgba(255, 255, 255, 0.9); border-radius: 1rem;margin-bottom: 300px">

                        <form  action="../../BackEnd/php/signin.php" method="POST" id="form">
                            <h5 class="h3 fw-bold mb-5" style="letter-spacing: 1px;">Sign in to your account</h5>

                            <div data-mdb-input-init class="form-outline mb-4">
                                <label class="form-label" for="form2Example17">UserName</label>
                                <input placeholder="Enter The Email or Phone Number" type="text" id="form2Example17" class="form-control form-control-lg" name="username" />
                            </div>

                            <div data-mdb-input-init class="form-outline mb-4">
                                <label class="form-label" for="form2Example27">Password</label>
                                <input placeholder="Enter The Password  " name="password" type="password" id="form2Example27" class="form-control form-control-lg" />
                            </div>

                            <div class="pt-1 mb-4">
                                <button data-mdb-button-init data-mdb-ripple-init class="btn btn-dark btn-lg btn-block" type="submit">Login</button>
                                <br>
                                <div id="em" >

                                </div>
                                </div>

                            <a class="small text-muted" href="resetpassword.php">Forgot password?</a>
                            <p class="mb-5 pb-lg-2" style="color: #393f81;">Don't have an account? <a href="signup.php" style="color: #393f81;">Register here</a></p>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
</section>





</div>
<script>
    // Get the URL parameters
    const urlParams = new URLSearchParams(window.location.search);

    // Get the error message
    const error_msg = urlParams.get('error_msg');

    // Check if the error message is "Please fill in all required fields."
        document.getElementById('em').innerText = error_msg;

</script>





</body>
</html>