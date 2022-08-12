<?php session_start(); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Student Financial Aid</title>
    <link rel="icon" href="images/logo.png">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="css/DonorLoginForm.css?<?=filemtime("css/DonorLoginForm.css")?>">
    <script src="jquery.js"></script>
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
                    <h1 class="heading">Student Financial Aid</h1>
                </div>
            </div>
        </header>
        <!------------ Navigation Bar ------------>
        <nav>
            <div class="nav">  
                <ul>
                    <li><a href="HomePage.php">Home</a></li> 
                    <li><a href="Scholarships.php">Scholarships</a></li>
                    <li><a href="Downloads.php">Downloads</a></li>
                    <li><a href="Donations.php">Donations</a></li>
                    <li><a href="AboutUs.php">About Us</a></li>
                    <li><a href="ContactUs.php">Contacts</a></li>
                    <li>
                        <div class="dropdown">
                            <a class="dropbtn">Login</a>
                            <div class="dropdown-content">
                                <a href="../Admin Panel/adminLoginForm.php">Admin</a>
                                <a href="DonorLoginForm.php">Donor</a>
                                <a href="StudentLoginForm.php">Student</a>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
        </nav>

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

                    else if(isset($_SESSION["username_error"]) && $_SESSION["username_error"] != "") {
                        echo "<h3>" .$_SESSION["username_error"]. "</h3>";
                        unset($_SESSION["username_error"]);
                    }  

                    else if(isset($_SESSION["password_error"]) && $_SESSION["password_error"] != "") {
                        echo "<h3>" .$_SESSION["password_error"]. "</h3>";
                        unset($_SESSION["password_error"]);
                    } 
                    
                ?>
            </div>
            
            <form action="DonorLogin.php" method="POST" name="donorLoginForm">
               
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
                <p>Forget Password? <a href="#">Click Here</a> </p>
                <p>Don't Have Account? <a href="DonorSignupForm.php">Signup Here</a></p>
                
            </form>
        </div>
    </div>

    <!------------ Footer ------------>
    <footer>
        <div class="footer">
            <h4>Links:</h4>
            <div class="col_1">
                <ul>
                    <li><a href="Scholarships.php">Scholarships</a></li>
                    <li><a href="Downloads.php">Downloads</a></li>
                    <li><a href="Donations.php">Donations</a></li>
                </ul>
            </div>
            <div class="col_2">
                <ul>
                    <li><a href="AboutUs.php">About Us</a></li>
                    <li><a href="ContactUs.php">Contacts</a></li>
                    <li><a href="#">Login</a></li>
                </ul>
            </div>
            <div class="col_3">
                <form action="Feedback.php" method="POST" name="feedbackForm">
                    <textarea id="feedback" name="feedback" rows="4" cols="25" placeholder="Your Feedback about our services"></textarea>
                    <div id="btn"> 
                        <button type="submit" name="submit" value="Submit" class="button">Submit</button>
                    </div>
                </form>
            </div>
        </div>
        <div class="rights">
            <p class="para">All Rights Reserved &copy; 2021-2022<p>
        </div>
    </footer>

    <script>
    
        // Jquery
        $(".dropdown").on({
            mouseenter:function() {
                $(this).css("background-color", "black");
            },
            mouseleave:function() {
                $(this).css("background-color", "brown");
            }
        });

    </script>
</body>
</html>