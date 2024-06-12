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
            padding: 20px;
            border: 1px solid #ccc;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
            text-align: center;
            max-width: 400px;
            margin: auto;
        }
        .message-box p {
            font-size: 18px;
            margin: 10px 0;
        }
    </style>
    <script>
        setTimeout(function() {
            window.location.href = "<?php echo $redirectPage; ?>";
        }, 5000); // Redirect after 5 seconds
    </script>
</head>
<body>
<div class="message-box">
    <p><?php echo htmlspecialchars($message); ?></p>
    <p>You will be redirected shortly...</p>
</div>
</body>
</html>
