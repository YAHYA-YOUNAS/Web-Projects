<?php
    session_start();

    require './queries/connection.php';

    if(isset($_POST['submit'])){

        $id= $_POST['scholarship_id'];
        $title = $_POST['scholarship_title'];
        $type = $_POST['scholarship_type'];
        $postDate = $_POST['scholarship_post_date'];
        $dueDate = $_POST['scholarship_due_date'];
        $image = $_FILES["image"]["tmp_name"];
        $description = $_POST['scholarship_description'];

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
                header('Location: adminScholarships.php');
            }

            // Allow certain Image formats
            else if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
                $_SESSION["error"] = "Unable to upload!  Only JPG, JPEG, PNG & GIF files are allowed. <br>";
                header('Location: adminScholarships.php');
            }
            else {
                $imageResult = $con->query("UPDATE scholarship SET scholarship_title= '$title', scholarship_type= '$type', scholarship_post_date= '$postDate',
                    scholarship_due_date= '$dueDate', scholarship_image= '$imgContent', scholarship_description= '$description' WHERE scholarship_id= '$id'");
                
                if($imageResult) {
                    $con->close();
                    $_SESSION["notify"] = "Record has been updated successfully.";
                    header('Location: adminScholarships.php');
                } else {
                    $_SESSION["error"] = "Unable to update record!";
                    header('Location: adminScholarships.php');
                }
            }
        } else {
            $result = $con->query("UPDATE scholarship SET scholarship_title= '$title', scholarship_type= '$type', scholarship_post_date= '$postDate',
            scholarship_due_date= '$dueDate', scholarship_description= '$description' WHERE scholarship_id= '$id'");

            if($result) {
                $con->close();
                $_SESSION["notify"] = "Record has been updated successfully.";
                header('Location: adminScholarships.php');
            } else {
                $_SESSION["error"] = "Unable to update record!";
                header('Location: adminScholarships.php');
            }
        }   

    }
?>