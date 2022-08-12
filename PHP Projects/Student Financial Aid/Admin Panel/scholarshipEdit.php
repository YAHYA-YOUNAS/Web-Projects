<?php 
    session_start();

    if (isset($_SESSION["username"])) {

        require './queries/connection.php';

        $id = $_GET['id'];

        $result = $con->query("SELECT * FROM scholarship WHERE scholarship_id= '$id'");

        if ($result->num_rows > 0) {
            $record = $result->fetch_assoc();

            $title = $record['scholarship_title'];
            $type = $record['scholarship_type'];
            $postDate = $record['scholarship_post_date'];
            $dueDate = $record['scholarship_due_date'];
            $image = $record['scholarship_image'];
            $description = $record['scholarship_description'];
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
        <a href="adminStudents.php"><span>Students</span></a>
        <a href="adminDonors.php"><span>Donors</span></a> 
        <a href="adminDownloads.php"><span>Downloads</span></a>
        <a href="adminDirector.php"><span>Director</span></a>
        <a href="adminScholarships.php" class="selected"><span>Scholarships</span></a>
        <a href="adminFeedback.php"><span>Feedback</span></a>
    </div>
    
    <div class="content">
        <h2>Scholarship Info</h2>

        <div class="notification">
            <?php
                if(isset($_SESSION["error"]) && $_SESSION["error"] != "") {
                    echo "<h3 id='error'>" .$_SESSION["error"]. "</h3>";
                    unset($_SESSION["error"]);
                }
            ?>
        </div>
        
        <form action="updateScholarship.php" method="POST" name="scholarshipEditForm" enctype="multipart/form-data">
                
                <label>
                    <input type="file" name="image" id="image" style="display: none;">
                    <?php echo '<img src="data:image/jpeg;base64, ' .base64_encode($image). '" class="img"/>'; ?>
                </label>

                <div class="user-details">

                    <div class="input-box">
                        <span class="details">ID</span>
                        <input type="text" name="scholarship_id" value="<?php echo $id; ?>" readonly>
                    </div>
                    
                    <div class="input-box">
                        <span class="details">Title</span>
                        <input type="text" name="scholarship_title" value="<?php echo $title; ?>" >
                    </div>
                    
                     <div class="input-box">
                        <span class="details">Type</span>
                        <input type="text" name="scholarship_type" value="<?php echo $type; ?>" >
                    </div>
                
                    <div class="input-box">
                        <span class="details">Due Date</span>
                        <input type="date" name="scholarship_due_date" value="<?php echo $dueDate; ?>" >
                    </div>
                    
                     <div class="input-box" id="full-field">
                        <span class="details">Post Date</span>
                        <input type="date" name="scholarship_post_date" value="<?php echo $postDate; ?>">
                    </div>
                    
                    <div class="input-box">
                        <span class="details">Description</span>
                        <textarea cols="160" rows="3" name="scholarship_description"><?php echo $description; ?></textarea>
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