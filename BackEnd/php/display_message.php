<?php
session_start();

// Get the message and target page from the session
$message = isset($_SESSION['message']) ? $_SESSION['message'] : 'No message.';
$redirectPage = isset($_SESSION['redirect_page']) ? $_SESSION['redirect_page'] : 'index.php';

// Clear the session variables
unset($_SESSION['message']);
unset($_SESSION['redirect_page']);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="icon" href="../../Resources/images/favicon.png">
<title>Message</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Message</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f9f9f9;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .message-box {
            width: 20%;
            height: 20%;
            padding: 20px;
            border: 1px solid blue;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
            text-align: center;
            max-width: 400px;
            margin: auto;
            border-radius: 50%;
        }
        .message-box p {
            text-align: center;
            font-size: 18px;
            border: blue;
            color:blue;


        }

        .comic-neue-bold {
            font-family: "Comic Neue", cursive;
            font-weight: 700;
            font-style: normal;
        }

    </style>
    <script>
        setTimeout(function() {
            window.location.href = "<?php echo $redirectPage; ?>";
        }, 1000); // Redirect after 5 seconds
    </script>
</head>
<body>
<div class="message-box comic-neue-bold" >
    <p style="padding-top: 10%;"><?php echo htmlspecialchars($message); ?></p>
    <p>You will be redirected shortly...</p>
</div>
</body>
</html>
