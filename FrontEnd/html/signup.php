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
$_SESSION['found'] = 'nothing';
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









<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">

            <div class="card">
                <div class="card-body">
                    <h2 class="text-center">Registration Form <i class="fa-solid fa-user-plus"></i></h2>
                    <form action="../../BackEnd/php/signup.php" method="POST" id="form">
                        <div class="row">
                            <!-- First Column -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="parentName">Parent's Name:</label>
                                    <input type="text" class="form-control" id="parentName" name="parentName" required>
                                    <div class="error-message" id="parentName-error"></div>
                                </div>
                                <div class="form-group">
                                    <label for="parentEmail">Parent's Email:</label>
                                    <input type="email" class="form-control" id="parentEmail" name="parentEmail" required>
                                    <div class="error-message" id="parentEmail-error"></div>
                                </div>
                                <div class="form-group">
                                    <label for="parentPhone">Parent's Phone:</label>
                                    <input type="tel" class="form-control" id="parentPhone" name="parentPhone" required>
                                    <div class="error-message" id="parentPhone-error"></div>
                                </div>
                                <div class="form-group">
                                    <label for="password">Password:</label>
                                    <input type="password" class="form-control" id="password" name="password" required>
                                    <div class="error-message" id="password-error"></div>
                                </div>
                                <div class="form-group">
                                    <label for="confirmPassword">Confirm Password:</label>
                                    <input type="password" class="form-control" id="confirmPassword" name="confirmPassword" required>
                                    <div class="error-message" id="confirmPassword-error"></div>
                                </div>
                            </div>
                            <!-- Second Column -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="city">City:</label>
                                    <input type="text" class="form-control" id="city" name="city" required>
                                    <div class="error-message" id="city-error"></div>
                                </div>
                                <div class="form-group">
                                    <label for="gender">Parent's Gender:</label>
                                    <select class="form-control" id="gender" name="gender" required>
                                        <option value="father">Father</option>
                                        <option value="mother">Mother</option>
                                    </select>
                                    <div class="error-message" id="gender-error"></div>
                                </div>
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
                            </div>
                        </div>
                        <div class="form-group text-center">
                            <button type="submit" class="btn btn-primary">Register</button>
                            <a href="signin.php" class="btn btn-primary" style="color:white">Sign In</a>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
</div>
<br><br>



<script>

    sessionStorage.setItem('theme','light');


    document.getElementById("form").addEventListener("submit", function(event) {
        var parentName = document.getElementById("parentName");
        var parentEmail = document.getElementById("parentEmail");
        var parentPhone = document.getElementById("parentPhone");
        var password = document.getElementById("password");
        var confirmPassword = document.getElementById("confirmPassword");
        var city = document.getElementById("city");
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
        checkField(parentName, "Please enter parent's name");
        checkField(parentEmail, "Please enter parent's email");
        checkField(parentPhone, "Please enter parent's phone number");
        checkField(password, "Please enter a password");
        checkField(confirmPassword, "Please confirm your password");
        checkField(city, "Please enter a city");
        checkField(childName, "Please enter child's name");
        checkField(childGender, "Please select child's gender");

        // Check if parent's name contains digits
        if (/\d/.test(parentName.value)) {
            showError(parentName, "Parent's name cannot contain digits");
        } else {
            clearError(parentName);
        }

        // Check if city name contains digits
        if (/\d/.test(city.value)) {
            showError(city, "City name cannot contain digits");
        } else {
            clearError(city);
        }

        // Check if child's name contains digits
        if (/\d/.test(childName.value)) {
            showError(childName, "Child's name cannot contain digits");
        } else {
            clearError(childName);
        }

        // Check if phone number contains non-digit characters
        if (/\D/.test(parentPhone.value)) {
            showError(parentPhone, "Phone number must contain only digits");
        } else {
            clearError(parentPhone);
        }

        // Check if password and confirmPassword match
        if (password.value !== confirmPassword.value) {
            showError(confirmPassword, "Password and Confirm Password must match");
        } else {
            clearError(confirmPassword);
        }

        // Check if the child's birth date is the current date or a future date
        var currentDate = new Date();
        currentDate.setHours(0, 0, 0, 0); // Normalize to start of the day
        if (childBirthDate < currentDate) {
            showError(document.getElementById("childBirthDate"), "Child's birth date must be the current date or a future date");
        } else {
            clearError(document.getElementById("childBirthDate"));
        }

        // Check if parent's name has at least 2 names
        var parentNameParts = parentName.value.split(" ");
        if (parentNameParts.length < 2) {
            showError(parentName, "Parent's name must have at least 2 names");
        } else {
            clearError(parentName);
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

<!-- Bootstrap JS and dependencies -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>