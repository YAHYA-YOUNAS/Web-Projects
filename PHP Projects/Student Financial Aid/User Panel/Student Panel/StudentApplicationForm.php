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
    <link rel="stylesheet" href="css/StudentApplicationForm.css?<?=filemtime("css/StudentApplicationForm.css")?>">
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

        <!------------ Main ------------>
        <div class="signup-box"> 
            <h2>Enter Your Details</h2>

            <div class="notification">
                <?php

                    if(isset($_SESSION["error"]) && $_SESSION["error"] != "") {
                        echo "<h3 id='error'>" .$_SESSION["error"]. "</h3>";
                        unset($_SESSION["error"]);
                    } else if(isset($_SESSION["apply_error"]) && $_SESSION["apply_error"] != "") {
                        echo "<h3 id='apply_error'>" .$_SESSION["apply_error"]. "</h3>";
                        unset($_SESSION["apply_error"]);
                    } else if(isset($_SESSION["notify"]) && $_SESSION["notify"] != "") {
                        echo "<h3 id='notify'>" .$_SESSION["notify"]. "</h3>";
                        unset($_SESSION["notify"]);
                    }  
                ?>
            </div>
            
            <form action="ApplicationForm.php" method="POST" name="studentAppForm">
                <div class="user-details">
                    <div class="input-box" id="width">
                        <span class="details">Apply For</span>
                        <select name="applyFor" class="dropdown">
                        <?php
                            require '../queries/connection.php';

                            $sql = $con->query("SELECT scholarship_title FROM scholarship");
                            if($sql->num_rows > 0) {
                                while($row = $sql->fetch_assoc()) { ?>
                                    <option><?php echo $row["scholarship_title"]; ?></option>
                        <?php }
                            } else {
                                echo "No records found!";
                            }
                        ?>
                        
                        </select>
                    </div>
                     
                    <div class="input-box">
                        <span class="details">CNIC</span>
                        <input type="text" name="cnic" placeholder="Without Dashes(-)" required>
                    </div>   
                    
                    <div class="input-box">
                        <span class="details">Address</span>
                        <input type="text" name="address" placeholder="Enter your Address" required>
                    </div>
                    
                    
                    <div class="input-box">
                        <span class="details">Profession</span>
                        <input type="text" name="profession" placeholder="e.g, Student" required>
                    </div>
                    
                    <div class="input-box">
                        <span class="details">Income</span>
                        <input type="number" name="income" placeholder="Enter your income" required>
                    </div>
                    
                    <div class="input-box">
                        <span class="details">Family Income</span>
                        <input type="number" name="familyIncome" placeholder="Enter your family income" required>
                    </div>
                    <div class="input-box">
                        <span class="details">Expenditure</span>
                        <input type="number" name="expenditure" placeholder="Enter your Household Expenditure" required>
                    </div>
                    <div id="submit-btn">
                        <button type="submit" name="submit" value="Submit">SUBMIT</button>
                    </div>
                </div>
            </form>
        </div>
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