<?php 
    
    session_start(); 

    if (isset($_SESSION["username"])) {

        require '../queries/connection.php';

        $name = $_SESSION["username"];                      // get name of current student

        $sql = $con->query("SELECT student_id FROM student WHERE student_name= '$name'");           // get id of current student
        if($sql->num_rows > 0) {
            $row = $sql->fetch_assoc();
            $id = $row["student_id"];                       // store id of current student
            
            $result = $con->query("SELECT student_applied_for, student_approval_status FROM student WHERE student_id= '$id'");       // check if student apply in scholarship
        
            if($result->num_rows > 0) {
                $record = $result->fetch_assoc();
                $applied_for = $record["student_applied_for"];    // store scholarship title of current student
                $status = $record["student_approval_status"];    
                
                if (empty($applied_for)) {
                    $_SESSION["noRecordFound"] =  "<b>" .$name. "</b>, you have not applied for any scholarship yet!";
                } else {
                    $scholarshipResult = $con->query("SELECT scholarship_title, scholarship_image, scholarship_description FROM scholarship WHERE scholarship_title= '$applied_for'");    // get fields of scholarship based on scholarship title of current student
                    
                    if ($scholarshipResult->num_rows > 0 ) {
                        $scholarshipRecord = $scholarshipResult->fetch_assoc();

                        $title = $scholarshipRecord["scholarship_title"];
                        $image = $scholarshipRecord["scholarship_image"];
                        $description = $scholarshipRecord["scholarship_description"];
        
                    } else {
                        echo "Unable to find record!";
                    }
                }
            } else {
                echo "Student scholarship record not found!";
            }

        } else {
            echo "Student record not found!";
        }
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
    <link rel="stylesheet" href="css/StudentEnrolledScholarships.css?<?=filemtime("css/StudentEnrolledScholarships.css")?>">
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
                <center><h3 class="heading">You are enrolled in:</h3></center>
                <hr>

                <div class="scholarship_img">
                    <?php if (isset($_SESSION["noRecordFound"]) && $_SESSION["noRecordFound"] !== '') { } else { 
                            echo '<img src="data:image/jpeg;base64, ' .base64_encode($image). '"/>'; 
                        } ?>
                        <br><br>
                        <p><?php if (isset($_SESSION["noRecordFound"]) && $_SESSION["noRecordFound"] !== '') { } else { 
                            echo $title;
                        } ?></p>
                </div>
                <div class="message">
                    <?php if (isset($_SESSION["noRecordFound"]) && $_SESSION["noRecordFound"] !== '') { 
                        echo $_SESSION["noRecordFound"]; 
                    } else { ?>
                       <a id="myBtn" class="status">Check Status</a>
                       <p><?php echo $description; ?> </p>
                    <?php } ?>

                </div>

                <!-- The Modal -->
                <div id="myModal" class="modal">

                    <!-- Modal content -->
                    <div class="modal-content">
                        <span class="close">&times;</span>
                        <p id="approval">
                            <?php if($status == false) {
                                echo "<p style='color: Grey; font-weight: bold;'>Approval Pending...</p>";
                            } else {
                                echo "<p style='color: green; font-weight: bold;'>Congratulations! $name. Your application for $title Scholarship has been approved.</p>";
                            } ?>
                        </p>
                    </div>
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

        // Modal Code

        var modal = document.getElementById("myModal");

        var btn = document.getElementById("myBtn");

        var span = document.getElementsByClassName("close")[0];

        // When the user clicks the button, open the modal 
        btn.onclick = function() {
            modal.style.display = "block";
        }

        // When the user clicks on <span> (x), close the modal
        span.onclick = function() {
            modal.style.display = "none";
        }

        // When the user clicks anywhere outside of the modal, close it
        window.onclick = function(event) {
            if (event.target == modal) {
                modal.style.display = "none";
            }
        }
    </script>
</body>
</html>

<?php
    } else {
        header('Location: ../StudentLoginForm.php');
    }
?>