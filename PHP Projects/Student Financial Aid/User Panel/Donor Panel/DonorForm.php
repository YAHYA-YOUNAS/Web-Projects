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
    <link rel="stylesheet" href="css/DonorForm.css?<?=filemtime("css/DonorForm.css")?>">
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

        <!------------ Main ------------>
        <div class="signup-box"> 
            <h2>Enter Your Details</h2>

            <div class="notification">
                <?php
                    if(isset($_SESSION["error"]) && $_SESSION["error"] != "") {
                        echo "<h3 id='error'>" .$_SESSION["error"]. "</h3>";
                        unset($_SESSION["error"]);
                    } 
                    
                    if(isset($_SESSION["notify"]) && $_SESSION["notify"] != "") {
                        echo "<h3 id='notify'>" .$_SESSION["notify"]. "</h3>";
                        unset($_SESSION["notify"]);
                    }  
                ?>
            </div>
            
            <form action="form.php" method="POST" name="donorForm" enctype="multipart/form-data">
               <div class="user-details">
                    
                    <div class="input-box">
                        <span class="details">Business Name</span>
                        <input type="text" name="business_name" placeholder="Enter your business name" required>
                    </div>
                    
                    <div class="input-box">
                        <span class="details">Address</span>
                        <input type="text" name="address" placeholder="Enter your address " required>
                    </div>
                    
                    <div class="input-box">
                        <span class="details">City</span>
                        <input type="text" name="city" placeholder="Enter your city" required>
                    </div>
                    
                    <div class="input-box">
                        <span class="details">ZIP Code</span>
                        <input type="number" name="zip" placeholder="Enter your ZIP code" required>
                    </div>
                   
                    <div class="input-box">
                        <span class="details">Amount (PKR)</span>
                        <input type="number" name="amount" placeholder="Enter amount" required>
                    </div>

                    <div class="input-box">
                        <span class="details">Payment Method</span>
                        <input type="text" name="payment_method" placeholder="Enter payment method" required>
                    </div>

                    <div class="input-box">
                        <span class="details">Description</span>
                        <textarea cols="30" rows="3" name="description" class="textarea" placeholder="Enter details of your donation" required></textarea>
                    </div>

                    <div id="upload-image">
                        <input type="file" name="image" id="image" required>
                    </div> 

                    <div id="submit-btn">
                        <button type="submit" name="submit" value="Donate">DONATE</button>
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
</body>
</html>

<?php
    } else {
        header('Location: ../DonorLoginForm.php');
    }
?>