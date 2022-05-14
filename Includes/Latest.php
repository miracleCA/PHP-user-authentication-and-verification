<?php

if (isset($_POST["Reset-Pwd-submit"])) {
        
        $Selector = bin2hex(random_bytes(8));
        $Token = random_bytes(32);

        $URL = "MY PHP MAIN WEB DEV/Create-new-password.php?Selector=" . $Selector . "&Validator=" . bin2hex($Token);

        $Expires = date("U") + 1800;

        require 'Database.inc.php';

        $UserEmail = $_POST["Reset-Pwd-Email"];

        $sql = "DELETE FROM password_reset WHERE pwdresetEmail=?";
        $stmt = mysqli_stmt_init($conn);
        if (!mysqli_stmt_prepare($stmt, $sql)) {
                header("location: ../LOGIN.php?error=USER NOT FOUND");
                exit();
        } else {
                mysqli_stmt_bind_param($stmt, "s", $UserEmail);
                mysqli_stmt_execute($stmt);
        }

        $sql = "INSERT INTO password_reset (pwdresetEmail, pwdresetSelector, pwdresetToken, pwdresetExpires) VALUES (?, ?, ?, ?);";
        $stmt =mysqli_stmt_init($conn);
        if (!mysqli_stmt_prepare($stmt, $sql)) {
                header("location: ../LOGIN.php?error=Something went wrong");
                exit();
        } else {
                $TokenHash = password_hash($Token, PASSWORD_DEFAULT);
                mysqli_stmt_bind_param($stmt, "ssss", $UserEmail, $Selector, $TokenHash, $Expires);
                mysqli_stmt_execute($stmt);
        }
        mysqli_stmt_close($stmt);
        mysqli_close($conn);

        $To = $UserEmail;

        $Subject = 'Reset your password';

        $Message = '<p>We received password reset request and below is your password reset link.</p><br><p>If you did not make this request, you can ignore this message</p>';
        $Message .= '<p>Here is your Password reset link: <br>';
        $Message .= '<a href=' . $URL . '>' . $URL . '</a></p>';

        $Headers = "From: MAIN WEB DEV <SKILLTECHY@GMAIL.COM>\r\n";
        $Headers .= "Reply-To: SKILLTECHY@GMAIL.COM\r\n";
        $Headers .= "Content-type: text/html\r\n";

        mail($To, $Subject, $Message, $Headers);

        header("location: ../ResetEmailConfirmation.php?error=Successful reset request");

} 
else {
        header("location: ../LOGIN.php?error=1");
}