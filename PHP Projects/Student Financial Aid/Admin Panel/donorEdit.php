<?php 
    session_start();

    if (isset($_SESSION["username"])) {

        require './queries/connection.php';

        $id = $_GET['id'];

        $donorResult = $con->query("SELECT * FROM donor WHERE donor_id =$id");
    
        if ($donorResult->num_rows > 0) {
            $record = $donorResult->fetch_assoc();

            $name = $record['donor_name'];
            $cnic = $record['donor_cnic'];
            $email = $record['donor_email'];
            $contact = $record['donor_contact'];
            $category = $record['donor_category'];
            $organization = $record['donor_organization'];
            $password = $record['donor_password'];
            $cPassword = $record['donor_cPassword'];
        } else {
            echo "Record not found!";
        }

        $donationResult = $con->query("SELECT * FROM donation WHERE donor_id =$id");

        if ($donationResult->num_rows > 0) {
            $row = $donationResult->fetch_assoc();

            $business_name = $row['donation_business_name'];
            $address = $row['donation_address'];
            $city = $row['donation_city'];
            $zip = $row['donation_zip'];
            $amount = $row['donation_amount'];
            $payment_method = $row['donation_payment_method'];
            $image = $row['donation_image'];
            $description = $row['donation_description'];
        } 
        else {
            echo "Record not found!";
        }
?>

<html>
<head>
    <title>Admin Panel</title>
    <link rel="icon" href="images/logo.png">
    <link rel="stylesheet" href="css/adminStyle2.css?<?=filemtime("css/adminStyle2.css")?>">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
</head>
<body>
    
    <input type="checkbox" id="check">
    
    <header>
        <label for="check">
            <i class="fas fa-bars" id="sidebar_btn"></i>
        </label>
        <div class="left_area">
            <h2>Admin Panel</h2>
        </div>
        <div class="right_area">
        <a href="logout.php" class="logout_btn">Logout</a>
        </div>
    </header>
    
    <div class="sidebar">
        <h3>Welcome To Admin Panel</h3>
        <hr>
        <a href="adminHomePage.php"><span>Home</span></a>
        <a href="adminGallery.php"><span>Gallery</span></a>
        <a href="adminStudents.php"><span>Students</span></a>
        <a href="adminDonors.php" class="selected"><span>Donors</span></a> 
        <a href="adminDownloads.php"><span>Downloads</span></a>
        <a href="adminDirector.php"><span>Director</span></a>
        <a href="adminScholarships.php"><span>Scholarships</span></a>
        <a href="adminFeedback.php"><span>Feedback</span></a>
    </div>
    
    <div class="content">
        <h2>Donor Info</h2>

        <form action="updateDonor.php" method="POST" name="donorEditForm" enctype="multipart/form-data">

            <label>
                <input type="file" name="image" id="image" style="display: none;">
                <?php echo '<img src="data:image/jpeg;base64, ' .base64_encode($image). '" class="img"/>'; ?>
            </label>
            
            <div class="user-details">
               
                <div class="input-box">
                    <span class="details">ID</span>
                    <input type="number" name="donor_id" value="<?php echo $id; ?>" readonly>
                </div>
                
                <div class="input-box">
                    <span class="details">Name</span>
                    <input type="text" name="donor_name" value="<?php echo $name; ?>">
                </div>
                
                 <div class="input-box">
                    <span class="details">CNIC</span>
                    <input type="text" name="donor_cnic" value="<?php echo $cnic; ?>" >
                </div>
            
                <div class="input-box">
                    <span class="details">Email</span>
                    <input type="email" name="donor_email" value="<?php echo $email; ?>" >
                </div>
                
                <div class="input-box">
                    <span class="details">Password</span>
                    <input type="password" name="donor_password" value="<?php echo $password; ?>" >
                </div>
                <div class="input-box">
                    <span class="details">Confirm Password</span>
                    <input type="password" name="donor_cPassword" value="<?php echo $cPassword; ?>" >
                </div>
                
                <div class="input-box">
                    <span class="details">Contact</span>
                    <input type="text" name="donor_contact" value="<?php echo $contact; ?>" >
                </div>
                
                <div class="input-box">
                    <span class="details">Category</span>
                    <input type="text" name="donor_category" value="<?php echo $category; ?>"  >
                </div>
                
                 <div class="input-box">
                    <span class="details">Organization</span>
                    <input type="text" name="donor_organization" value="<?php echo $organization; ?>" >
                </div>
                 <div class="input-box">
                    <span class="details">Business Name</span>
                    <input type="text" name="donation_business_name" value="<?php echo $business_name; ?>" >
                </div>
                                                      
                <div class="input-box">
                    <span class="details">Address</span>
                    <input type="text" name="donation_address" value="<?php echo $address; ?>" >
                </div>
                
                <div class="input-box">
                    <span class="details">City</span>
                    <input type="text" name="donation_city" value="<?php echo $city; ?>" >
                </div>
                
                <div class="input-box">
                    <span class="details">Zip Code</span>
                    <input type="number" name="donation_zip" value="<?php echo $zip; ?>" >
                </div>
                
                <div class="input-box">
                    <span class="details">Amount</span>
                    <input type="number" name="donation_amount" value="<?php echo $amount; ?>" >
                </div>
                
                <div class="input-box" id="full-field">
                    <span class="details">Payment Method</span>
                    <input type="text" name="donation_payment_method" value="<?php echo $payment_method; ?>" >
                </div>

                <div class="input-box" id="full-field">
                    <span class="details">Description</span>
                    <textarea rows="3" cols="162" name="donation_description"><?php echo $description; ?></textarea>
                </div>
                
                <div id="scholarship-btn">
                    <button type="submit" name="submit">Save</button>
                </div>
                
            </div>
            
        </form>

    </div>
    
</body>
</html>

<?php
    } else {
        header('Location: adminLoginForm.php');
    }
?>