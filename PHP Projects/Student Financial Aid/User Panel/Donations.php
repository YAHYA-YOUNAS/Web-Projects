<!DOCTYPE html>
<html lang="en">
<head>
    <title>Student Financial Aid</title>
    <link rel="icon" href="images/logo.png">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="css/Donations.css?<?=filemtime("css/Donations.css")?>">
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

        <!------------ Slider ------------>
        <?php 
            include './slider.php';
        ?>

        <!------------ Main ------------>
        <main>
            <div class="content">
                <center><h3 class="heading">Donors</h3></center>
                <hr>

                <?php
                    require './queries/connection.php';

                    $sql = $con->query("SELECT * FROM donation");

                    if($sql->num_rows > 0) {
                        while($row = $sql->fetch_assoc()) { 
                            $donation_business_name = $row["donation_business_name"];
                            $donation_image = $row["donation_image"];
                            $donation_description = $row["donation_description"];
                ?>
                        <div class="donor_img">
                        <?php echo '<img src="data:image/jpeg;base64, ' .base64_encode($donation_image). '"/>'; ?>
                            <p><?php echo $donation_business_name; ?></p>
                        </div>
                        <div class="message">   
                            <p><?php echo $donation_description; ?></p>
                        </div> <br><br><br><br><br><br><br><br><br><br>

                <?php }
                    } else {
                        echo "Records not found!";
                    }

                ?>
                
            </div>

            <!------------ Side Bar ------------>
            <div class="side_bar">
                <div class="news">
                    <h3 class="heading">Latest News</h3>
                    <marquee direction="up" scrollamount="2" id="marquee">
                        <?php include './news.php' ?>
                    </marquee>
                </div>
                <div class="donate-btn">
                    <a href="DonorLoginForm.php"><button type="button">Donate Us</button></a>
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