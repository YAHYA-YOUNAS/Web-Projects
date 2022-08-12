<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Admin SignUp</title>
    <link rel="icon" href="images/logo.png">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="css/adminSignupForm.css?<?=filemtime("css/adminSignupForm.css")?>">
</head>
<body>
    <div class="background">
        <!------------ Header ------------>
        <header>
            <div class="head">
                <div class="logo">
                    <img src="images/logo.png" height="100px" width="150px">
                </div>
                <div class="title">
                    <h2 class="heading">Admin Registration</h2>
                </div>
            </div>
        </header>
        <!------------ Main ------------>
        <div class="signup-box">
            <img src="images/signup.png" class="signup-img"> 
            <h2>Signup Here</h2>
            
            <div class="notification">
                <?php
                    if(isset($_SESSION["name_error"]) && $_SESSION["name_error"] != "") {
                        echo "<h3 id='name-error'>" .$_SESSION["name_error"]. "</h3>";
                        unset($_SESSION["name_error"]);
                    }  

                    if(isset($_SESSION["notify"]) && $_SESSION["notify"] != "") {
                        echo "<h3 id='notify'>" .$_SESSION["notify"]. "</h3>";
                        unset($_SESSION["notify"]);
                    }

                    if(isset($_SESSION["error"]) && $_SESSION["error"] != "") {
                        echo "<h3 id='error'>" .$_SESSION["error"]. "</h3>";
                        unset($_SESSION["error"]);
                    }
                ?>
            </div>
            
            <form action="adminSignUp.php" method="POST" name="signupForm">
                
                <div class="user-details">
                    
                    <div class="input-box">
                        <span class="details">Name</span>
                        <input type="text" name="name" placeholder="Enter your full name" required>
                    </div>
                    <div class="input-box">
                        <span class="details">CNIC</span>
                        <input type="text" name="cnic" placeholder="Without Dashes (-)" required>
                    </div>
                    
                    <div class="input-box">
                        <span class="details">Email</span>
                        <input type="email" name="email" placeholder="Enter your email" required>
                    </div>
                    
                    <div class="input-box">
                        <span class="details">Contact</span>
                        <input type="text" name="contact" placeholder="Enter your number" required>
                    </div>
                    
                    <div class="input-box">
                        <span class="details">Password</span>
                        <input type="password" name="password" placeholder="Enter your password" required>
                    </div>
                    
                    <div class="input-box">
                        <span class="details">Confirm Password</span>
                        <input type="password" name="cPassword" placeholder="Confirm your password" required>
                    </div>
                    <div id="signup-btn">
                        <button type="submit" name="submit" value="Signup">SIGNUP</button>
                    </div>
                    
                </div>
                <br>
                <p>Already Have An Account? <a href="adminLoginForm.php">Login Here</a></p>
                
            </form>
        </div>
    </div>

    <!------------ Footer ------------>
    <footer>
        <div class="rights">
            <p class="para">All Rights Reserved &copy; 2021-2022<p>
        </div>
    </footer>
</body>
</html>