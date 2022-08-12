<?php  
    session_start();
    require 'connection.php';

    $name = $_POST['name'];
    $cnic = $_POST['cnic'];
    $email = $_POST['email'];
    $contact = $_POST['contact'];
    $category = $_POST['category'];
    $organization = $_POST['organization'];
    $password = $_POST['password'];
    $cPassword = $_POST['cPassword'];

    $sql = "INSERT INTO donor(donor_name, donor_cnic, donor_email, donor_contact, donor_category, donor_organization, donor_password, donor_cPassword)
            VALUES('$name', '$cnic', '$email', '$contact', '$category', '$organization', '$password', '$cPassword')";

    $result = $con->query($sql);

    if($result) {
        $con->close();
        $_SESSION["notify"] = "New Donor Registered.";
        header('Location: DonorSignUpForm.php');
    } 
    else {
        echo "There is problem while inserting values: " . $con->error;
    }

?>