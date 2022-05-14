<?php
session_start();

if (isset($_POST["SIGN-UP"])) {

  $Firstname = $_POST["Firstname"];
  $Lastname = $_POST["Lastname"];
  $Email = $_POST["Email"];
  $Username = $_POST["Username"];
  $Password = $_POST["Password"];
  $RepeatPassword = $_POST["RepeatPassword"];

  require_once 'Database.inc.php';
  require_once 'Sign_up-Login_Functions.php';

  if (emptysignupinput($Firstname, $Lastname, $Email, $Username, $Password, $RepeatPassword) !== false) {
        header ("location: ../SIGN-UP.php?error=There is an empty input");
        exit();
  }
  if (InvalidUsername($Username) !== false) {
        header ("location: ../SIGN-UP.php?error=Invalid Username");
        exit();
  }
  if (InvalidEmail($Email) !== false) {
        header ("location: ../SIGN-UP.php?error=Invalid Email");
        exit();
  }
  if (InvalidPassword($Password) !== false) {
        header ("location: ../SIGN-UP.php?error=Invalid Password");
        exit();
      }
  if (PasswordsdontMatch($Password, $RepeatPassword) !== false) {
        header ("location: ../SIGN-UP.php?error=Passwords don't match");
        exit();
  }
  if (UserdataExists($conn, $Username, $Email) !== false) {
        header ("location: ../SIGN-UP.php?error=The Username is already taken");
        exit();
  }
  
  createUser($conn, $Firstname, $Lastname, $Email, $Username, $Password);
  
} else {
      header ("location: ../SIGN-UP.php");
      exit();
}