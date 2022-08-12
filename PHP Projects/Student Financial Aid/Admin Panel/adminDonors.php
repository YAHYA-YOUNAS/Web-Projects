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
        <a href="adminDonors.php" class="selected"><span>Donors</span></a> 
        <a href="adminDownloads.php"><span>Downloads</span></a>
        <a href="adminDirector.php"><span>Director</span></a>
        <a href="adminScholarships.php"><span>Scholarships</span></a>
        <a href="adminFeedback.php" ><span>Feedback</span></a>
    </div>
    
    <div class="content">
        <h2>Donors Information</h2>
        
        <div class="notification">
            <?php
                if(isset($_SESSION["error"]) && $_SESSION["error"] != "") {
                    echo "<h3 id='error'>" .$_SESSION["error"]. "</h3>";
                    unset($_SESSION["error"]);
                }

                else if(isset($_SESSION["notify"]) && $_SESSION["notify"] != "") {
                    echo "<h3 id='notify'>" .$_SESSION["notify"]. "</h3>";
                    unset($_SESSION["notify"]);
                }
            ?>
        </div>

        <table >
            
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>CNIC</th>
                <th>Email</th>
                <th>Contact</th>
                <th></th>
            </tr>
            <?php
                require './queries/connection.php';
                $result = $con->query("SELECT * FROM donor");
                if($result->num_rows > 0 ) {
                    while($row = $result->fetch_assoc()) { ?>
                        <tr>
                            <td><?php echo $row['donor_id']; ?></td>
                            <td><?php echo $row['donor_name']; ?></td>
                            <td><?php echo $row['donor_cnic']; ?></td>
                            <td><?php echo $row['donor_email']; ?></td>
                            <td><?php echo $row['donor_contact']; ?></td>
                            <td><a href="donorEdit.php?id=<?php echo $row['donor_id']; ?>" class="links">Edit</a> /
                                <a href="donorDelete.php?id=<?php echo $row['donor_id']; ?>" class="links">Delete</a></td>
                        </tr>

            <?php } } else { ?> 
            <h3 style="color:red;margin-left: 45%;"><?php echo "Records not found!"; }?></h3>
            
        </table>
        
    </div>
   
</body>
</html>

<?php
    } else {
        header('Location: adminLoginForm.php');
    }
?>