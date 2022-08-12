<?php 
    session_start(); 
    
    if (isset($_SESSION["username"])) {

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
        <a href="adminDonors.php"><span>Donors</span></a> 
        <a href="adminDownloads.php"><span>Downloads</span></a>
        <a href="adminDirector.php"><span>Director</span></a>
        <a href="adminScholarships.php" class="selected"><span>Scholarships</span></a>
        <a href="adminFeedback.php"><span>Feedback</span></a>
    </div>
    
    <div class="content">
        <h2>Add New Scholarship</h2>

        <div class="notification">
            <?php
                if(isset($_SESSION["warning"]) && $_SESSION["warning"] != "") {
                    echo "<h3 id='warning'>" .$_SESSION["warning"]. "</h3>";
                    unset($_SESSION["warning"]);
                } 
                if(isset($_SESSION["error"]) && $_SESSION["error"] != "") {
                    echo "<h3 id='error'>" .$_SESSION["error"]. "</h3>";
                    unset($_SESSION["error"]);
                }
            ?>
        </div>
        
        <form action="uploadScholarship.php" method="POST" name="newScholarship" enctype="multipart/form-data">
                
                <div class="user-details">

                    <div class="input-box">
                        <span class="details">Title</span>
                        <input type="text" name="scholarship_title" required>
                    </div>
                    
                     <div class="input-box">
                        <span class="details">Type</span>
                        <input type="text" name="scholarship_type" required>
                    </div>
                
                    <div class="input-box">
                        <span class="details">Due Date</span>
                        <input type="date" name="scholarship_due_date" required>
                    </div>
                    
                     <div class="input-box">
                        <span class="details">Post Date</span>
                        <input type="date" name="scholarship_post_date" required>
                    </div>
                    
                    <div class="input-box">
                        <span class="details">Description</span>
                        <textarea cols="160" rows="3" name="scholarship_description" required></textarea>
                    </div>
                    
                    <label><input type="file" id="upload-btn" name="image" required> </label>
                    
                    <div id="scholarship-btn">
                        <button style="margin: -58px 0 0 200px" type="submit" name="submit">Add</button>
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