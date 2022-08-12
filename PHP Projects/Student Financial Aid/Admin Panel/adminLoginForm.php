<?php session_start(); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Admin Login</title>
    <link rel="icon" href="images/logo.png">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="css/adminLoginForm.css?<?=filemtime("css/adminLoginForm.css")?>">
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
                    <h2 class="heading">Admin Login</h2>
                </div>
            </div>
        </header>

        <!------------ Main ------------>
        <div class="login-box">
            <img src="images/login.png" class="login-img"> 
            <h2>Login Here</h2>

            <div class="notification">
                <?php
                    if(isset($_SESSION["error"]) && $_SESSION["error"] != "") {
                        echo "<h3>" .$_SESSION["error"]. "</h3>";
                        unset($_SESSION["error"]);
                    } 

                    if(isset($_SESSION["username_error"]) && $_SESSION["username_error"] != "") {
                        echo "<h3>" .$_SESSION["username_error"]. "</h3>";
                        unset($_SESSION["username_error"]);
                    }  

                    if(isset($_SESSION["password_error"]) && $_SESSION["password_error"] != "") {
                        echo "<h3>" .$_SESSION["password_error"]. "</h3>";
                        unset($_SESSION["password_error"]);
                    } 
                ?>
            </div>

            <form action="adminLogin.php" method="POST" name="loginForm">
               
                 <div class="user-details">
                     <div class="input-box">
                        <span class="details">Username</span>
                        <input type="text" name="username" placeholder="Enter your username" required>
                    </div>
                     
                    <div class="input-box">
                        <span class="details">Password</span>
                        <input type="password" name="password" placeholder="Enter your password" required>
                    </div>
                    <div id="login-btn">
                        <button type="submit" name="submit" value="Login">Login</button>
                    </div>
                </div>
                <br>
                <p>Don't Have Account? <a href="adminSignUpForm.php">Signup Here</a></p>
                
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