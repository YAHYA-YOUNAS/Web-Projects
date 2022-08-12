<?php 
    session_start();

    if (isset($_SESSION["username"])) {

        require './queries/connection.php';

        $name = $_SESSION["username"];

        $sql = "SELECT admin_id FROM admin WHERE admin_name= '$name'";
        $result = $con->query($sql);

        if($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $id = $row["admin_id"];

            $resultArray = $con->query("SELECT * FROM admin where admin_id= '$id'");
            if($resultArray->num_rows > 0) {
                $record = $resultArray->fetch_assoc();

                $_SESSION["id"] = $id;
                $name = $record["admin_name"];
                $cnic = $record["admin_cnic"];
                $email = $record["admin_email"];
                $contact = $record["admin_contact"];
                $password = $record["admin_password"];
                $cPassword = $record["admin_cPassword"];
                $image = $record["admin_image"];

            }
            else {
                echo "Record not found!";
            }
        } else {
            echo "Unable to find the admin!";
        } 
?>

<html>
<head>
    <title>Admin Panel</title>
    <link rel="icon" href="images/logo.png">
    <link rel="stylesheet" href="css/adminStyle.css?<?=filemtime("css/adminStyle.css")?>">
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
        <a href="adminHomePage.php" class="selected"><span>Home</span></a>
        <a href="adminGallery.php"><span>Gallery</span></a>
        <a href="adminStudents.php"><span>Students</span></a>
        <a href="adminDonors.php"><span>Donors</span></a> 
        <a href="adminDownloads.php"><span>Downloads</span></a>
        <a href="adminDirector.php"><span>Director</span></a>
        <a href="adminScholarships.php"><span>Scholarships</span></a>
        <a href="adminFeedback.php"><span>Feedback</span></a>
    </div>
    
    <div class="content">
        <form action="updateProfile.php" method="POST" enctype="multipart/form-data">
        
            <label>
                <input type="file" name="image" id="image" style="display: none;">
                <?php echo '<img src="data:image/jpeg;base64, ' .base64_encode($image). '" class="img"/>'; ?>
            </label><br>

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

            <div class="user-details">
                
                <div class="input-box">
                    <span class="details">Name</span>
                    <input type="text" name="admin_name" value="<?php echo $name; ?>" required>
                </div>

                 <div class="input-box">
                    <span class="details">CNIC</span>
                    <input type="text" name="admin_cnic" value="<?php echo $cnic; ?>" required>
                </div>

                <div class="input-box">
                    <span class="details">Email</span>
                    <input type="email" name="admin_email" value="<?php echo $email; ?>" required>
                </div>

                <div class="input-box">
                    <span class="details">Contact</span>
                    <input type="text" name="admin_contact" value="<?php echo $contact; ?>" required>
                </div>

                <div class="input-box">
                    <span class="details">Password</span>
                    <input type="password" name="admin_password" value="<?php echo $password; ?>" required>
                </div>
                <div class="input-box">
                    <span class="details">Confirm Password</span>
                    <input type="password" name="admin_cPassword" value="<?php echo $cPassword; ?>" required>
                </div>

                <div id="homepage-btn">
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

