<?php

    session_start();

    $charset = "0123456789";
    $password = "";
    $charsetLength = strlen($charset);
    for ($i = 0; $i < 6; $i++) {
        $randomIndex = rand(0, $charsetLength - 1);
        $password .= $charset[$randomIndex];
    }


    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;

    require '../../PhpMailer/src/Exception.php';
    require '../../PhpMailer/src/PHPMailer.php';
    require '../../PhpMailer/src/SMTP.php';

    $mail = new PHPMailer(true);

    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;
    $mail->Username='communicraftt@gmail.com';
    $mail->Password = 'wywsxddlhdkqbaor';
    $mail->SMTPSecure = 'tls';
    $mail->Port = 587;

    $mail->setFrom('communicraftt@gmail.comm','BabyVaxTracker');

    $email = $_POST['parentEmail'];
    echo $email;

    $mail->addAddress($email); // Add a recipient

    // Content
    $mail->isHTML(true); // Set email format to HTML
    $mail->Subject = 'New Password';
    $mail->Body    = $password;

    try {
        // Your PHPMailer setup and email sending code here
        $mail->send();
        //exit();
        echo 'Message has been sent';
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }

    require_once "db_connect.php";

    global $conn;

    $query = "UPDATE users SET password = ?  WHERE users.email = ?";
    $stmt = $conn ->prepare($query);
    $stmt->bind_param("ss", $password,$email);
    $stmt->execute();
    if ($stmt->affected_rows > 0) {
        $_SESSION['found'] = 'yes';
    } else {
        $_SESSION['found'] = 'no';
    }

    header("Location: ../../FrontEnd/html/resetpassword.php");
