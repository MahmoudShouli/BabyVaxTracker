<?php
session_start();

function setSessionMessageAndRedirect($message, $redirectPage)
{
    $_SESSION['message'] = $message;
    $_SESSION['redirect_page'] = $redirectPage;
    header("Location: ../../BackEnd/php/display_message.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $childName = $_POST['childName'];
    $childBirthDate = $_POST['childBirthDate'];
    $childGender = $_POST['childGender'];
    $userID = $_SESSION['USER'];

    require_once '../../BackEnd/php/db_config.php';

    $conn = @new mysqli(DB_HOST,DB_USER,DB_PASS,DB_NAME);
    // Check the connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    $userID=10;
    $userIdentifier = $_SESSION['USER'];
    $sqlUser = "SELECT ID FROM users WHERE email = '$userIdentifier' OR phone = '$userIdentifier'";
    $resultUser = $conn->query($sqlUser);
    if ($resultUser->num_rows > 0) {
        $rowUser = $resultUser->fetch_assoc();
        $userID = $rowUser['ID'];
    }
    // Prepare and bind
    $stmt = $conn->prepare("INSERT INTO children (name, birth_date, gender, userID) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("sssi", $childName, $childBirthDate, $childGender, $userID);

    // Execute
    if ($stmt->execute()) {
        // Set the success message and redirect
        setSessionMessageAndRedirect("Children added successfully.", "../../FrontEnd/html/index.php");
    }

    // Close statement and connection
    $stmt->close();
    $conn->close();
}
?>









<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="Content-Language" content="ar">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BabyVaxTrack</title>
    <link rel="icon" type="image/x-icon" href="../../Resources/images/logo.png">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="../css/signup.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" integrity="sha512-Avb2QiuDEEvB4bZJYdft2mNjVShBftLdPG8FJ0V7irTLQ8Uo0qcPxh4Plq7G5tGm0rU+1SPhVotteLpBERwTkw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<body>



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

<header style="margin-bottom: 30px;">

    <a href="signin.php"><img src="../../Resources/images/logo.png" alt="this is the logo"></a>
</header>









<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">

            <div class="card">
                <div class="card-body">
                    <h2 class="text-center">Registration Form <i class="fa-solid fa-user-plus"></i>
                    </h2>
                    <form action="../../FrontEnd/html/addchildren.php" method="POST" id="form">

                        <div class="form-group">
                            <label for="childName">Child's Name:</label>
                            <input type="text" class="form-control" id="childName" name="childName" required>
                            <div class="error-message" id="childName-error"></div>
                        </div>
                        <div class="form-group">
                            <label for="childBirthDate">Child's Date of Birth:</label>
                            <input type="date" class="form-control" id="childBirthDate" name="childBirthDate" required>
                            <div class="error-message" id="childBirthDate-error"></div>
                        </div>
                        <div class="form-group">
                            <label for="childGender">Child's Gender:</label>
                            <select class="form-control" id="childGender" name="childGender" required>
                                <option value="male">Male</option>
                                <option value="female">Female</option>
                            </select>
                            <div class="error-message" id="childGender-error"></div>
                        </div>
                        <div class="form-group text-center">
                            <button type="submit" class="btn btn-primary">Register</button>
                        </div>
                    </form>                </div>
            </div>
        </div>
    </div>
</div>





<!-- Footer Area -->
<footer id="footer" class="footer ">
    <!-- Footer Top -->
    <div class="footer-top">
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
                                    <li><a href="../html/signin.php"><i class="fa fa-caret-right" aria-hidden="true"></i>Home</a></li>
                                    <li><a href="../html/signin.php#about"><i class="fa fa-caret-right" aria-hidden="true"></i>About Us</a></li>
                                    <li><a href="../html/signin.php#service"><i class="fa fa-caret-right" aria-hidden="true"></i>Services</a></li>
                                </ul>
                            </div>
                            <div class="col-lg-6 col-md-6 col-12">
                                <ul>
                                    <li><a href="../html/signin.php#neews"><i class="fa fa-caret-right" aria-hidden="true"></i>News</a></li>
                                    <li><a href="../html/contact.html"><i class="fa fa-caret-right" aria-hidden="true"></i>Contact Us</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-12">
                    <div class="single-footer">
                        <h2>Open Hours</h2>
                        <ul class="time-sidual">
                            <li class="day">Sunday - Friday <span>8.00 am - 4.00 pm</span></li>
                            <li class="day">Friday <span>10.00 am - 2.00 pm</span></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-12">
                    <div class="single-footer">
                        <h2>Newsletter</h2>
                        <p>subscribe to our newsletter to get all our news in your inbox</p>
                        <form action="" method="get" target="_blank" class="newsletter-inner">
                            <input name="email" placeholder="Email Address" class="common-input" onfocus="this.placeholder = ''"
                                   onblur="this.placeholder = 'Your email address'" required="" type="email">
                            <button class="button"><i class="icofont icofont-paper-plane"></i></button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--/ End Footer Top -->
    <!-- Copyright -->
    <div class="copyright">
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
    document.getElementById("form").addEventListener("submit", function(event) {
        var childName = document.getElementById("childName");
        var childBirthDate = new Date(document.getElementById("childBirthDate").value.trim());
        var childGender = document.getElementById("childGender");
        var isValid = true;

        function showError(input, message) {
            var errorElement = document.getElementById(input.id + "-error");
            errorElement.textContent = message;
            errorElement.style.display = "block";
            input.classList.add("error");
            input.classList.remove("valid");
            isValid = false;
        }

        function clearError(input) {
            var errorElement = document.getElementById(input.id + "-error");
            errorElement.style.display = "none";
            input.classList.remove("error");
            input.classList.add("valid");
        }

        function checkField(input, message) {
            if (!input.value.trim()) {
                showError(input, message);
            } else {
                clearError(input);
            }
        }

        // Check if all fields are filled

        checkField(childName, "Please enter child's name");
        checkField(childGender, "Please select child's gender");




        // Check if child's name contains digits
        if (/\d/.test(childName.value)) {
            showError(childName, "Child's name cannot contain digits");
        } else {
            clearError(childName);
        }



        // Check if the child's birth date is the current date or a future date
        var currentDate = new Date();
        currentDate.setHours(0, 0, 0, 0); // Normalize to start of the day
        if (childBirthDate < currentDate) {
            showError(document.getElementById("childBirthDate"), "Child's birth date must be the current date or a future date");
        } else {
            clearError(document.getElementById("childBirthDate"));
        }



        if (!isValid) {
            event.preventDefault();
        }
    });




    //    var form=document.getElementById('form');
    // form.addEventListener('submit',function (event){
    //     event.preventDefault();
    // })
</script>

</body>
</html>