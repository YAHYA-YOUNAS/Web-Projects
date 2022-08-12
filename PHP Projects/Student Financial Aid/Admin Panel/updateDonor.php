<?php
    session_start();

    require './queries/connection.php';

    if(isset($_POST['submit'])){

        $id= $_POST['donor_id'];
        $name = $_POST['donor_name'];
        $cnic = $_POST['donor_cnic'];
        $email = $_POST['donor_email'];
        $contact = $_POST['donor_contact'];
        $category = $_POST['donor_category'];
        $organization = $_POST['donor_organization'];
        $password = $_POST['donor_password'];
        $cPassword = $_POST['donor_cPassword'];

        $business_name = $_POST['donation_business_name'];
        $address = $_POST['donation_address'];
        $city = $_POST['donation_city'];
        $zip = $_POST['donation_zip'];
        $amount = $_POST['donation_amount'];
        $payment_method = $_POST['donation_payment_method'];
        $image = $_FILES["image"]["tmp_name"];
        $description = $_POST['donation_description'];

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
                    header('Location: adminDonors.php');
                }

                // Allow certain Image formats
                else if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
                    $_SESSION["error"] = "Unable to upload!  Only JPG, JPEG, PNG & GIF files are allowed. <br>";
                    header('Location: adminDonors.php');
                } 
                else {
                    $donorResult = $con->query("UPDATE donor SET donor_name= '$name', donor_cnic= '$cnic', donor_email= '$email', donor_contact= '$contact',
                        donor_category= '$category', donor_organization= '$organization', donor_password= '$password', donor_cPassword= '$cPassword' WHERE donor_id= '$id'");

                    $donationResult = $con->query("UPDATE donation SET donation_business_name= '$business_name', donation_address= '$address', donation_city= '$city',
                        donation_zip= '$zip', donation_amount= '$amount', donation_payment_method= '$payment_method', donation_image= '$imgContent', donation_description= '$description' WHERE donor_id= '$id'");

                    if($donorResult && $donationResult) {
                        $con->close();
                        $_SESSION["notify"] = "Record has been updated successfully.";
                        header('Location: adminDonors.php');
                    } else {
                        $_SESSION["error"] = "Unable to update record!";
                        header('Location: adminDonors.php');
                    }
            
                }

            } else {
                $donorResult = $con->query("UPDATE donor SET donor_name= '$name', donor_cnic= '$cnic', donor_email= '$email', donor_contact= '$contact',
                        donor_category= '$category', donor_organization= '$organization', donor_password= '$password', donor_cPassword= '$cPassword' WHERE donor_id= '$id'");

                $donationResult = $con->query("UPDATE donation SET donation_business_name= '$business_name', donation_address= '$address', donation_city= '$city',
                    donation_zip= '$zip', donation_amount= '$amount', donation_payment_method= '$payment_method', donation_description= '$description' WHERE donor_id= '$id'");

                if($donorResult && $donationResult) {
                    $con->close();
                    $_SESSION["notify"] = "Record has been updated successfully.";
                    header('Location: adminDonors.php');
                } else {
                    $_SESSION["error"] = "Unable to update record: "  . $con->error;
                    header('Location: adminDonors.php');
                }
        
            }

        } else {
            $_SESSION["error"] = "Unable to update! Password and Confirm Password does not match.";
            header('Location: adminDonors.php');
        }
    }
?>