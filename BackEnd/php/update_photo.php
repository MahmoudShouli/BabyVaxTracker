<?php
    require_once "db_connect.php";

    session_start();

    $current_user = $_SESSION['USER'];

    $userID = $_SESSION['ID'];

    global $conn;


    if ($_FILES['profilePicUpload']['error'] > 0)
    {
        echo 'Problem: ';
    switch ($_FILES['profilePicUpload']['error'])
    {
        case 1: echo 'File exceeded upload_max_filesize';
    break;
        case 2: echo 'File exceeded max_file_size';
    break;
        case 3: echo 'File only partially uploaded';
    break;
        case 4: echo 'No file uploaded';
    break;
        case 6: echo 'Cannot upload file: No temp directory specified';
            break;
        case 7: echo 'Upload failed: Cannot write to disk';
            break;
    }
    exit;
    }



    $picName = $userID.$_FILES['profilePicUpload']['name'];
    // put the file where we’d like it
    $photo = '../../Resources/images/'.$picName ;
    if (is_uploaded_file($_FILES['profilePicUpload']['tmp_name']))
    {
        if (!move_uploaded_file($_FILES['profilePicUpload']['tmp_name'], $photo))
        {
            echo 'Problem: Could not move file to destination directory';
    exit;
    }
    }
    else
    {
        echo 'Problem: Possible file upload attack. Filename:' ;
    echo $_FILES['profilePicUpload']['name'];
    exit;
    }
    echo 'File uploaded successfully<br><br>';


    $fetch_query = "SELECT user_name, city, email FROM users WHERE ID = ?";
    $fetch_stmt = $conn->prepare($fetch_query);
    $fetch_stmt->bind_param("i", $userID);
    $fetch_stmt->execute();
    $fetch_stmt->bind_result($uName, $city, $email);
    $fetch_stmt->fetch();
    $fetch_stmt->close();

    //    $tempFilePath = $_FILES["fileToUpload"]["name"];
    //    $photo = "../../Resources/images/".$tempFilePath;


    if (substr($current_user, 0, 2) === "05") {
        $stmt = $conn->prepare("UPDATE users SET photo = ? WHERE phone = ?");
    }
    else
        $stmt = $conn->prepare("UPDATE users SET photo = ? WHERE email = ?");



    $stmt->bind_param("ss", $photo, $current_user);
    $stmt->execute();


//    $response = array(
//        'namee' => $uName,
//        'city' => $city,
//        'email' => $email,
//        'photoURL' => $photo
//    );
//
//    echo json_encode($response);

    //header("Location: ../../FrontEnd/html/feedback.php");


