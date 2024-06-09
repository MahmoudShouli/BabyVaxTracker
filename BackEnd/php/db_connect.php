<?php
     require_once "db_config.php";

     $conn = new mysqli(DB_HOST,DB_USER,DB_PASS,DB_NAME);

     if($conn->error) {
            die("Connection failed.".$conn->error);
     }
