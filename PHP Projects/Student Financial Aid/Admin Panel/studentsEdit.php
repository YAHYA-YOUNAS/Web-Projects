<?php 
    session_start();

    if (isset($_SESSION["username"])) {

        require './queries/connection.php';

        $id = $_GET['id'];

        $result = $con->query("SELECT * FROM student WHERE student_id= '$id'");

        if ($result->num_rows > 0) {
            $record = $result->fetch_assoc();

            $name = $record['student_name'];
            $dob = $record['student_dob'];
            $email = $record['student_email'];
            $contact = $record['student_contact'];
            $password = $record['student_password'];
            $cPassword = $record['student_cPassword'];
            $apply_for = $record['student_applied_for'];
            $cnic = $record['student_cnic'];
            $address = $record['student_address'];
            $profession = $record['student_profession'];
            $income = $record['student_income'];
            $family_income = $record['student_family_income'];
            $expenditure = $record['student_expenditure'];
        } 
        else {
            echo "Unable to find the record!";
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
        <a href="adminStudents.php" class="selected"><span>Students</span></a>
        <a href="adminDonors.php"><span>Donors</span></a> 
        <a href="adminDownloads.php"><span>Downloads</span></a>
        <a href="adminDirector.php"><span>Director</span></a>
        <a href="adminScholarships.php"><span>Scholarships</span></a>
        <a href="adminFeedback.php"><span>Feedback</span></a>
    </div>
    
    <div class="content">
        <h2>Student Info</h2>

         <form action="updateStudent.php" method="POST" name="studentsEditForm">
                
                <div class="user-details">
                   
                    <div class="input-box">
                        <span class="details">ID</span>
                        <input type="number" name="student_id" value="<?php echo $id; ?>" readonly>
                    </div>
                    
                    <div class="input-box">
                        <span class="details">Name</span>
                        <input type="text" name="student_name" value="<?php echo $name; ?>" >
                    </div>
                    
                    <div class="input-box">
                        <span class="details">Date of Birth</span>
                        <input type="date" name="student_dob" value="<?php echo $dob; ?>" >
                    </div>
                    
                    <div class="input-box">
                        <span class="details">Email</span>
                        <input type="email" name="student_email" value="<?php echo $email; ?>" >
                    </div>
                    
                    <div class="input-box">
                        <span class="details">Password</span>
                        <input type="password" name="student_password" value="<?php echo $password; ?>" >
                    </div>

                    <div class="input-box">
                        <span class="details">Confirm Password</span>
                        <input type="password" name="student_cPassword" value="<?php echo $cPassword; ?>" >
                    </div>
                    
                    <div class="input-box">
                        <span class="details">Contact</span>
                        <input type="text" name="student_contact" value="<?php echo $contact; ?>" >
                    </div>
                    
                    <div class="input-box">
                        <span class="details">CNIC</span>
                        <input type="text" name="student_cnic" value="<?php echo $cnic; ?>" >
                    </div>
                    
                    <div class="input-box">
                        <span class="details">Applied For</span>
                        <input type="text" name="student_applied_for" value="<?php echo $apply_for; ?>" >
                    </div>
                    
                    <div class="input-box">
                        <span class="details">Address</span>
                        <input type="text" name="student_address" value="<?php echo $address; ?>" >
                    </div>
                    <div class="input-box">
                        <span class="details">Profession</span>
                        <input type="text" name="student_profession" value="<?php echo $profession; ?>" >
                    </div>
                    <div class="input-box">
                        <span class="details">Income</span>
                        <input type="number" name="student_income" value="<?php echo $income; ?>" >
                    </div>
                    <div class="input-box">
                        <span class="details">Family Income</span>
                        <input type="number" name="student_family_income" value="<?php echo $family_income; ?>" >
                    </div>
                    <div class="input-box">
                        <span class="details">Expenditure</span>
                        <input type="number" name="student_expenditure" value="<?php echo $expenditure; ?>" >
                    </div>

                    <?php if(!empty($apply_for)) { ?>

                        <div id="scholarship-btn">
                            <a href="studentApproval.php?id=<?php echo $id; ?>">
                            <button style="margin: 15% 0 0 -110%" type="button" name="approval">Approve</button></a>
                        
                        </div>

                        <div id="scholarship-btn">
                        <button style="margin: -60px 0 0 100%" type="submit" name="submit">Save</button>
                        </div>

                    <?php } else { ?>
                        <div id="scholarship-btn">
                        <button type="submit" name="submit">Save</button>
                        </div>
                    <?php } ?>
                    
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