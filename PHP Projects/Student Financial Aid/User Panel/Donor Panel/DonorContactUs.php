<?php 
    session_start(); 

    if (isset($_SESSION["username"])) {
    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Student Financial Aid</title>
    <link rel="icon" href="images/logo.png">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="css/DonorContactUs.css?<?=filemtime("css/DonorContactUs.css")?>">
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
                    <h2 class="heading">WELCOME <?php echo strtoupper($_SESSION["username"]); ?>!</h2>
                </div>
            </div>
        </header>
        <!------------ Navigation Bar ------------>
        <nav>
            <div class="nav">  
                <ul>
                    <li><a href="DonorDashboard.php">Home</a></li>
                    <li><a href="DonorScholarships.php">Scholarships</a></li>
                    <li><a href="DonorForm.php">Donate</a></li>
                    <li><a href="DonorDonations.php">Donations</a></li>
                    <li><a href="DonorAboutUs.php">About Us</a></li>
                    <li><a href="DonorContactUs.php">Contacts</a></li>
                    <li><a href="logout.php" id="logout">Logout</a></li>
                </ul>
            </div>
        </nav>

        <!------------ Slider ------------>
        <?php 
            include './slider.php';
        ?>

        <!------------ Main ------------>
        <main>
            <div class="content">
                <div class="message">   
                    <center><h3 class="heading">Contact Us At:</h3></center>
                    <hr>
                    <label>Email: </label><span>sfa@cuiatk.edu.pk</span> <br>
                    <label>Skype: </label><span>sfacuiatk.12345</span> <br>
                    <label>Phone: </label><span>051-1234567</span> <br>
                    <label>Mobile: </label><span>0123456789</span> <br>
                    <label>Address: </label><span>Comsats University Islamabad Near Officers Colony Kamra Road Attock City</span> <br>
                </div>
            </div>
            
            <!------------ Side Bar ------------>
            <div class="side_bar"> 
                <div class="staff">
                    <h3 class="heading">Staff</h3> <br>
                    <label>Mobile:</label> <span>0123456789</span> <br>
                    <label>Phone:</label> <span>051-1234567</span> <br>
                    <label>Email:</label> <span>abcd@cuiatk.edu.pk</span> <br>
                </div>
                <div class="social" >
                    <center><h3 class="heading">Follow Us</h3></center>
                    <center> <a href="#"><img src="images/fb.png"></a>
                    <a href="#"><img src="images/twitter.png"></a>
                    <a href="#"><img  src="images/linkedin.png"></a></center> 
                </div>  
            </div>
        </main>
    </div>

    <!------------ Footer ------------>
    <footer>
        <div class="footer">
            <h4>Links:</h4>
            <div class="col_1">
                <ul>
                    <li><a href="DonorScholarships.php">Scholarships</a></li>
                    <li><a href="DonorForm.php">Donate</a></li>
                    <li><a href="DonorDonations.php">Donations</a></li>
                </ul>
            </div>
            <div class="col_2">
                <ul>
                    <li><a href="DonorAboutUs.php">About Us</a></li>
                    <li><a href="DonorContactUs.php">Contacts</a></li>
                    <li><a href="logout.php">Logout</a></li>
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

    <!------------ Script ------------>
    <script>
        var myIndex = 0;
        carousel();
        
        function carousel() {
            var i;
            var x = document.getElementsByClassName("mySlides");
            for (i = 0; i < x.length; i++) {
                x[i].style.display = "none";  
            }
            myIndex++;
            if (myIndex > x.length) {myIndex = 1}    
            x[myIndex-1].style.display = "block";  
            setTimeout(carousel, 9000);    
        }
    </script>
</body>
</html>

<?php
    } else {
        header('Location: ../DonorLoginForm.php');
    }
?>