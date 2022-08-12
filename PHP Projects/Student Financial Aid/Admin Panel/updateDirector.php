<?php
    session_start();
                
    require './queries/connection.php';

    if(isset($_POST["submit"])) {

        $name = $_POST["director_name"];
        $message = $_POST["director_message"];
        $image = $_FILES["image"]["tmp_name"];

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
                header('Location: adminDirector.php');
            }

            // Allow certain Image formats
            else if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
                $_SESSION["error"] = "Unable to upload!  Only JPG, JPEG, PNG & GIF files are allowed. <br>";
                header('Location: adminDirector.php');
            } 
            else {
                $imageResult = $con->query("UPDATE director SET director_name= '$name', director_message= '$message', director_image= '$imgContent'");

                if($imageResult) {
                    $con->close();
                    $_SESSION["notify"] =  "Director's record has been updated successfully.";
                    header('Location: adminDirector.php');
                } else {
                    $_SESSION["error"] = "Unable to update record!";
                    header('Location: adminDirector.php');
                }
            }

        } else {
            $result = $con->query("UPDATE director SET director_name= '$name', director_message= '$message'");

            if($result) {
                $con->close();
                $_SESSION["notify"] =  "Director's record has been updated successfully.";
                header('Location: adminDirector.php');
            } else {
                $_SESSION["error"] = "Unable to update record: "  . $con->error;
                header('Location: adminDirector.php');
            }
        }

    }

?>