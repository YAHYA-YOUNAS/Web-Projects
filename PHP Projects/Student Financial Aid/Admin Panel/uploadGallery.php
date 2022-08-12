<?php
    session_start();

    require './queries/connection.php';

    if(isset($_POST["submit"])) {

        $target_dir ="uploads/images/";
        $target_file = $target_dir . basename($_FILES["image"]["name"]);
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        // Check if file is an actual image
        $check = getimagesize($_FILES["image"]["tmp_name"]);
        if ($check == false) {
            $_SESSION["error"] = "File is not an image.";
            header('Location: adminGallery.php');
        }

        // Check if file already exists
        else if (file_exists($target_file)) {
            $_SESSION["error"] = "Image already exists.";
            header('Location: adminGallery.php');
        }

        // Check file size
        else if ($_FILES["image"]["size"] > 1000000) {
            $_SESSION["error"] = "Unable to upload! Kindly upload image of size less than 1MB.";
            header('Location: adminGallery.php');
        }

        // Allow certain file formats
        else if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
            $_SESSION["error"] = "Unable to upload! Only JPG, JPEG, PNG & GIF image formats are allowed.";
            header('Location: adminGallery.php');
        }
        // if everything is ok, try to upload file
        else {
            if(move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
                $result = $con->query("INSERT INTO gallery(gallery_source) VALUES('$target_file')");
                if ($result) {
                    $con->close();
                    header('Location: adminGallery.php');
                } else {
                    $_SESSION["error"] = "Unable to insert image source in database!";
                    header('Location: adminGallery.php');
                }
            } else {
                $_SESSION["error"] = "There was an error uploading your file. ";
                header('Location: adminGallery.php');
            }
        }
    }
    
?>