<?php

session_start();
session_destroy();
header("Location: ../../FrontEnd/html/signin.php");
exit();