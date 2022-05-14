<?php
  session_start();

?>

<section class="Sign-up-form">
        <form action="Includes/Sign-up.inc.php" method="POST">
                <input type="text" name="Firstname" placeholder="First name">
                <input type="text" name="Lastname" placeholder="Last name">
                <input type="text" name="Email" placeholder="Email">
                <input type="text" name="Username" placeholder="Username">
                <input type="text" name="Password" placeholder="Password"> 
                <input type="text" name="RepeatPassword" placeholder="Repeat Password">
                <button type="submit" name="SIGN-UP">SIGN UP</button>
        </form>   
        <?php
        if (isset($_GET["error"])) {
                if ($_GET["error"] == "There is an empty input") {
                        echo "<p>Please fill in all fields.<p>";
                }  
                elseif ($_GET["error"] == "Invalid Username") {
                        echo "<p>Please, Choose another Username format.<p>";
                        
                }
                elseif ($_GET["error"] == "Invalid Email") {
                        echo "<p>Please fill in a correct Email.<p>";
                        
                }
                elseif ($_GET["error"] == "Invalid Password") {
                        echo "<p>Please, Choose another Password format..<p>";
                        
                }
                elseif ($_GET["error"] == "Passwords don't match") {
                        echo "<p>Your Passwords did not match.<p>";
                        
                }
                elseif ($_GET["error"] == "The Username is already taken") {
                        echo "<p>Username or Email already taken. Please, choose another.<p>";
                        
                }
                elseif ($_GET["error"] == "The Email is already taken") {
                        echo "<p>Please choose another Email or Login.<p>";
                        
                }
                elseif ($_GET["error"] == "stmtfailed") {
                        echo "<p>Something went wrong, Please try again.<p>";
                        
                }
                elseif ($_GET["error"] == "Signed up Succesfully") {
                        echo "<p>Signed up Succesfully, Now Login.<p>";
                        
                }
        }
        ?>     
        <h2>Already have an account?</h2>
        <a href="LOGIN.php">LOGIN</a>
</section>

