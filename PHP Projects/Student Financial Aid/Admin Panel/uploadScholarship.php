<?php
    session_start();

    require './queries/connection.php';

    if(isset($_POST['submit'])){

        $title = $_POST['scholarship_title'];
        $type = $_POST['scholarship_type'];
        $postDate = $_POST['scholarship_post_date'];
        $dueDate = $_POST['scholarship_due_date'];
        $image = $_FILES["image"]["tmp_name"];
        $description = $_POST['scholarship_description'];

        $verify = $con->query("SELECT * FROM scholarship WHERE scholarship_title= '$title'");

        if($verify->num_rows > 0) {
            $_SESSION["warning"] = "Scholarship already added!";
            header('Location: newScholarship.php'); 	
        }
        else {

            if($image) {
                // Check if image file is a actual image
                $check = getimagesize($image);
                if($check !== false){
                    $imgContent = addslashes(file_get_contents($image));
                }

                $fileName = $_FILES["image"]["name"];
                $imageFileType = end((explode(".", $fileName)));

                // Check Image size
                if ($_FILES["image"]["size"] > 1000000) {
                    $_SESSION["error"] = "Unable to upload! Select image of size less than 1MB.<br>";
                    header('Location: newScholarship.php');
                }

                // Allow certain Image formats
                else if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
                    $_SESSION["error"] = "Unable to upload!  Only JPG, JPEG, PNG & GIF files are allowed. <br>";
                    header('Location: newScholarship.php');
                } 
                else {
                    $sql = "INSERT INTO scholarship(scholarship_title, scholarship_type, scholarship_post_date, scholarship_due_date, scholarship_image,
                    scholarship_description) VALUES('$title', '$type', '$postDate', '$dueDate', '$imgContent', '$description')";

                    $result = $con->query($sql);
                }

                if($result) {
                    $con->close();
                    header('Location: adminScholarships.php');
                } 
                else {
                    echo "There is problem while adding new scholarship: " . $con->error; 
                }

            }
            
        }
    }
?>