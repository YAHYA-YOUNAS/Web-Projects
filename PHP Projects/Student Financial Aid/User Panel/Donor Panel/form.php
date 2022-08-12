<?php
    session_start();

    require '../queries/connection.php';    // importing connection

    $name = $_SESSION['username'];          // storing name of current donor

    if (isset($_POST['submit'])) 
    {
            // get all form variables

        $business_name = $_POST['business_name'];
        $address = $_POST['address'];
        $city = $_POST['city'];
        $zip = $_POST['zip'];
        $amount = $_POST['amount'];
        $payment_method = $_POST['payment_method'];
        $description = $_POST['description'];
        $image = $_FILES["image"]["tmp_name"];

        // select id from the database of current donor

        $sql = "SELECT donor_id FROM donor WHERE donor_name= '$name'";
        $result = $con->query($sql);

        if($result->num_rows > 0) {
            $result_array = $result->fetch_assoc();     // get record of the current donor
            $id = $result_array["donor_id"];            // storing id of current donor

            // Check if image file is a actual image
            $check = getimagesize($image);
            if($check !== false) {
                $imgContent = addslashes(file_get_contents($image));
            }

            $fileName = $_FILES["image"]["name"];               // storing real name of image
            $imageFileType = end((explode(".", $fileName)));        // get extenstion of image

            // Check Image size
            if ($_FILES["image"]["size"] > 1000000) {
                $_SESSION["error"] = "Unable to upload! Select image of size less than 1MB.";
                header('Location: DonorForm.php');
            }

            // Allow certain Image formats
            else if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
                $_SESSION["error"] = "Unable to upload!  Only JPG, JPEG, PNG & GIF files are allowed.";
                header('Location: DonorForm.php');
            }

            else {

                $insertion = "INSERT INTO donation(donation_business_name, donation_address, donation_city, donation_zip, donation_amount,          
                        donation_payment_method, donation_image, donation_description, donor_id) VALUES('$business_name','$address','$city',
                        '$zip','$amount','$payment_method','$imgContent','$description','$id')";

                $data = $con->query($insertion);

                if($data) {
                    $con->close();
                    $_SESSION["notify"] = "Thank You <b>" .strtoupper($_SESSION['username']). "</b> for your donation!";
                    header('Location: DonorForm.php');
                } else {
                    $_SESSION["error"] = "Unable to donate! there is a problem in donation!";
                    header('Location: DonorForm.php');
                }
            }           

        } else {
            $_SESSION["error"] = "Unable to donate!";
            header('Location: DonorForm.php');
        }
    }

?>