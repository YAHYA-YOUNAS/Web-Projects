<?php
    session_start();

    require './queries/connection.php';

    if(isset($_POST['submit'])){

        $id = $_SESSION["id"];
        $name = $_POST['admin_name'];
        $cnic = $_POST['admin_cnic'];
        $email = $_POST['admin_email'];
        $contact = $_POST['admin_contact'];
        $password = $_POST['admin_password'];
        $cPassword = $_POST['admin_cPassword'];
        $image = $_FILES["image"]["tmp_name"];

        if ($password === $cPassword) {

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
                    header('Location: adminHomePage.php');
                }

                // Allow certain Image formats
                else if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
                    $_SESSION["error"] = "Unable to upload!  Only JPG, JPEG, PNG & GIF files are allowed. <br>";
                    header('Location: adminHomePage.php');
                } 
                else {
                    $imageResult = $con->query("UPDATE admin SET admin_name= '$name', admin_cnic= '$cnic', admin_email= '$email', admin_contact= '$contact', 
                        admin_password= '$password', admin_cPassword= '$cPassword', admin_image= '$imgContent' WHERE admin_id= '$id'");

                    if($imageResult) {
                        $con->close();
                        $_SESSION["notify"] =  $name. ", your record has been updated successfully.";
                        header('Location: adminHomePage.php');
                    } else {
                        $_SESSION["error"] = "Unable to update record!";
                        header('Location: adminHomePage.php');
                    }
                }
 
            } else {
                $result = $con->query("UPDATE admin SET admin_name= '$name', admin_cnic= '$cnic', admin_email= '$email', admin_contact= '$contact', 
                    admin_password= '$password', admin_cPassword= '$cPassword' WHERE admin_id= '$id'");

                if($result) {
                    $con->close();
                    $_SESSION["notify"] =  $name. ", your record has been updated successfully.";
                    header('Location: adminHomePage.php');
                } else {
                    $_SESSION["error"] = "Unable to update record!";
                    header('Location: adminHomePage.php');
                }

            }
 
        } else {
            $_SESSION["error"] = "Unable to update! Password and Confirm Password does not match.<br>";
            header('Location: adminHomePage.php');
        }
    }
?>