<?php 
    session_start(); 

    if (isset($_SESSION["username"])) {
    
        require '../queries/connection.php';

        // Director Table

        $result = $con->query("SELECT * FROM director");

        if($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            
            $director_name = $row["director_name"];
            $director_message = $row["director_message"];
            $director_image = $row["director_image"];

        } else {
            echo "Record not found!";
        }
    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Student Financial Aid | Donor Dashboard</title>
    <link rel="icon" href="images/logo.png">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="css/DonorDashboard.css?<?=filemtime("css/DonorDashboard.css")?>">
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
                <div class="dir_img">
                <?php echo '<img src="data:image/jpeg;base64, ' .base64_encode($director_image). '"/>'; ?>
                    <hr>
                    <p><?php echo $director_name ?></p>
                </div>
                <div class="message">   
                    <center><h3 class="heading">Message From Director</h3></center>
                    <hr>
                    <p><?php echo $director_message ?></p>
                </div>
            </div>

            <!------------ Side Bar ------------>
            <div class="side_bar">
                <div class="news">
                    <h3 class="heading">Latest News</h3>
                    <marquee direction="up" scrollamount="2" id="marquee">
                        <?php include './news.php' ?>
                    </marquee>
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