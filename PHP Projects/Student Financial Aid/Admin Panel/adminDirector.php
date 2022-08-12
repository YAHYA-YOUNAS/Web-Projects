<?php 
    session_start();

    if (isset($_SESSION["username"])) {
    
        require './queries/connection.php';

        $result = $con->query("SELECT * FROM director");

        if($result->num_rows > 0) { 
            $row = $result->fetch_assoc();

            $name = $row["director_name"];
            $message = $row["director_message"];
            $image = $row["director_image"];

        } else {
            echo "Unable to find director's record!";
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
        <a href="adminHomePage.php"><span>Home</span></a>
        <a href="adminGallery.php" ><span>Gallery</span></a>
        <a href="adminStudents.php" ><span>Students</span></a>
        <a href="adminDonors.php" ><span>Donors</span></a> 
        <a href="adminDownloads.php"><span>Downloads</span></a>
        <a href="adminDirector.php" class="selected"><span>Director</span></a>
        <a href="adminScholarships.php"><span>Scholarships</span></a>
        <a href="adminFeedback.php" ><span>Feedback</span></a>
    </div>
    
     <div class="content">

        <form action="updateDirector.php" method="POST" enctype="multipart/form-data">

            <label>
                <input type="file" name="image" id="image" style="display: none;">
                <?php echo '<img src="data:image/jpeg;base64, ' .base64_encode($image). '" class="img"/>'; ?>
            </label>

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
            
                <div class="input-box" id="director-field">
                    <span class="details">Name</span>
                    <input type="text" name="director_name" value="<?php echo $name; ?>" required>
                </div>
                
                <div class="input-box" id="director-field">
                    <span class="details">Message</span>
                    <textarea rows="10" cols="77" name="director_message"><?php echo $message; ?></textarea>
                </div>
            </div>

            <div id="homepage-btn">
                <button type="submit" name="submit">Save</button>
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