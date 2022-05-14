<?php

if (isset($_POST["LOGIN"])) {
        
        $Username = $_POST["Username"];
        $Password = $_POST["Password"];

        require_once 'Database.inc.php';
        require_once 'Sign_up-Login_Functions.php';

        if (emptyLogininput($Username, $Password) !== false) {
                header ("location: ../LOGIN.php?error=There is an empty input");
                exit();
        }

        loginUser($conn, $Username, $Password);
}      
else {
        header("location: ../LOGIN.php?=Users data not found");
        exit();
}