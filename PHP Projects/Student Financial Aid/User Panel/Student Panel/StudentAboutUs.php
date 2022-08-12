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
    <link rel="stylesheet" href="css/StudentAboutUs.css?<?=filemtime("css/StudentAboutUs.css")?>">
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
                    <li><a href="StudentDashboard.php">Home</a></li>
                    <li><a href="StudentScholarships.php">Scholarships</a></li>
                    <li><a href="StudentDownloads.php">Downloads</a></li>
                    <li><a href="StudentDonations.php">Donations</a></li>
                    <li><a href="StudentAboutUs.php">About Us</a></li>
                    <li><a href="StudentContactUs.php">Contacts</a></li>
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
                    <center><h3 class="heading">Our Organization</h3></center>
                    <hr>
                    <p>Since the foundation of Student Financial Aid Office in 2006 with the collaboration of 
                       HEC-Islamabad-Pakistan, the Student Financial Aid (SFA) is committed to its mission to eliminate the 
                       financial barriers to Higher Education for poorly deprived students. The organization is helping many 
                       students to cope with economic challenges through provision of a number of national scholarships.
                       The organization demonstrate a high sense of responsibility in funding the neediest students and 
                       tends to respond to students need on time. The role of local and foreign funding agencies in helping 
                       the university to achieve this target is admirable.
                       Student Finanical Aid has been serving a number of economically deprived students of the province 
                       and the country for getting Higher Education in Comsats University Islamabad.
                       Comsats University Islamabad tries its best to assist the students by providing them with need and 
                       merit based scholarships and interest free loans. With the financial support, the students are 
                       highly encouraged to get into one of the best professional universities in Pakistan.
                    </p>
                </div> 
                <div class="about_img">
                    <img src="images/1.jpg">
                </div> 
                <div class="about_img">
                    <img src="images/about-1.jfif">
                </div> 
                <div class="about_img">
                    <img src="images/about-2.jpg">
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
                    <li><a href="StudentScholarships.php">Scholarships</a></li>
                    <li><a href="StudentDownloads.php">Downloads</a></li>
                    <li><a href="StudentDonations.php">Donations</a></li>
                </ul>
            </div>
            <div class="col_2">
                <ul>
                    <li><a href="StudentAboutUs.php">About Us</a></li>
                    <li><a href="StudentContactUs.php">Contacts</a></li>
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
        header('Location: ../StudentLoginForm.php');
    }
?>