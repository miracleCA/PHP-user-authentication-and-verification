<section class="Login-form">
        <h2>If you have signed up.</h2>
        <h3>You need to Login to access the website and your profile page.</h3>
        <form action="Includes/Login.inc.PHP" method="post">
                <input type="text" name="Username" placeholder="Username or Email">
                <input type="text" name="Password" placeholder="Password"> 
                <button type="submit" name="LOGIN">LOGIN</button>
        </form> 
        <a href="Forgot-password.php">Forgot Password?</a>
        <?php
        if (isset($_GET["error"])) {
                if ($_GET["error"] == "There is an empty input") {
                        echo "<p>Please fill in all fields.<p>";
                }  
                elseif ($_GET["error"] == "Username or Email not found") {
                        echo "<p>Please, fill in a correct Username or Email.<p>";
                        
                }
                elseif ($_GET["error"] == "Incorrectpassword") {
                        echo "<p>Please, fill in a correct Password.<p>";
                        
                }
                elseif ($_GET["error"] == "Users data not found") {
                        echo "<p>Please, fill in a valid User data.<p>";
                        
                }
                
        }
        ?>    
        <div class="row">
                <h2 style="float: left; margin-right: 10px;">Not Signed Up yet?</h2>
                <a style="line-height: 73px; float: left; margin-left: 5px;" href="SIGN-UP.php">SIGN UP</a>
        </div>
        
        
</section>