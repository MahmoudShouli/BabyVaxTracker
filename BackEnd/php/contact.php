<?php

    session_start();

    $correctEmail = $_SESSION['USER'];
    $email = $_POST['email'];

    if($email == $correctEmail)
        $_SESSION['contact'] = 'yes';
    else
        $_SESSION['contact'] = 'no';

    $subject = $_POST['subject'];
    $message = $_POST['message'];

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;

    require '../../PhpMailer/src/Exception.php';
    require '../../PhpMailer/src/PHPMailer.php';
    require '../../PhpMailer/src/SMTP.php';

    $mail = new PHPMailer(true);

    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;
    $mail->Username= $correctEmail;
    $mail->Password = 'tglzeigpalmanspa';
    $mail->SMTPSecure = 'tls';
    $mail->Port = 587;

    $mail->setFrom($correctEmail);



    $mail->addAddress("communicraftt@gmail.com"); // Add a recipient

    // Content
    $mail->isHTML(true); // Set email format to HTML
    $mail->Subject = $subject;
    $mail->Body    = $message;

    try {
        // Your PHPMailer setup and email sending code here
        $mail->send();
        //exit();
        echo 'Message has been sent';

    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }


    header("Location: ../../FrontEnd/html/contact_page.php");