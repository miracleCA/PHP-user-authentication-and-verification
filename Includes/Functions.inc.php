<?php

function emptysignupinput($Firstname, $Lastname, $Email, $Username, $Password, $RepeatPassword) {
        $result;
        if (empty($Firstname) || empty($Lastname) || empty($Username) || empty($Email) || empty($Password) || empty($RepeatPassword)) {
                $result = true;
        } 
        else {
                $result = false;
        }
        return $result;
}

function InvalidUsername($Username) {
        $result;
        if (!preg_match("/^[A-Za-z0-9]*$/", $Username)) {
                $result = true;
        } 
        else {
                $result = false;
        }
        return $result;
}

function InvalidEmail($Email) {
        $result;
        if (!filter_var($Email, FILTER_VALIDATE_EMAIL)) {
                $result = true; 
        } 
        else {
                $result = false;
        }
        return $result;
}

function InvalidPassword($Password) {
        $result;
        if (!preg_match("/^[A-Za-z0-9.!@#,&%-_?;:`~]*$/", $Password)) {
                $result = true;
        } 
        else {
                $result = false;
        }
        return $result;
}

function PasswordsdontMatch($Password, $RepeatPassword) {
        $result;
        if ($Password !== $RepeatPassword) {
                $result = true;
        } 
        else {
                $result = false;
        }
        return $result;
}

function UserdataExists($conn, $Username, $Email) {
        $sql = "SELECT * FROM users WHERE usersUsername = ? OR usersEmail = ?;";
        $stmt = mysqli_stmt_init($conn);
        if (!mysqli_stmt_prepare($stmt, $sql)) {
                header ("location: ../SIGN-UP.php?error=stmtfailed");
                exit();
        }

        mysqli_stmt_bind_param($stmt, "ss", $Username, $Email);
        mysqli_stmt_execute($stmt);

        $resultData = mysqli_stmt_get_result($stmt);

        if ($row = mysqli_fetch_assoc($resultData)) {
                return $row;
        }
        else {
                $result = false;
                return $result;
        }
        mysqli_stmt_close($stmt);
}
function  createUser($conn, $Firstname, $Lastname, $Email, $Username, $Password) {
        $sql = "INSERT INTO users (usersFirstname, usersLastname, usersEmail, usersUsername, usersPassword) VALUES (?, ?, ?, ?,?);";
        $stmt = mysqli_stmt_init($conn);
        if (!mysqli_stmt_prepare($stmt, $sql)) {
                header ("location: ../SIGN-UP.php?error=stmtfailed");
                exit();
                
                $hashedPassword = password_hash($Password, PASSWORD_DEFAULT);
                
                mysqli_stmt_bind_param($stmt, "sssss", $Firstname, $Lastname, $Email, $Username, $hashedPassword);
                mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
        header ("location: ../Index.php?error=Signed up Succesfully");
        exit();
} 
}

function emptyLogininput($Username, $Password) {
        $result;
        if (empty($Username) || empty($Password)) {
                $result = true;
         } else {
                        $result = false;
                }
                return $result;
}
function loginUser($conn, $Username, $Password) {
        $Userdatacheck = UserdataExists($conn, $Username, $Username);

        if ($Userdatacheck === false) {
                header("location: ../LOGIN.php?error=Username or Email not found");
                exit();
        }

        $PasswordHash = $Userdatacheck["usersPassword"];
        $CheckPasswordmatch = password_verify($Password, $PasswordHash);

        if ($CheckPasswordmatch === false) {
                header("location: ../LOGIN.php?error=Incorrectpassword");
                exit();
        }
        elseif ($CheckPasswordmatch === true) {
                session_start();
                $_SESSION["usersId"] = $Userdatacheck["usersId"];
                $_SESSION["usersUsername"] = $Userdatacheck["usersUsername"];
                header("location: ../Index.php");
                exit();
        }
}