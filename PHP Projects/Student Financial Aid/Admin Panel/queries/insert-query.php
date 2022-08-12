<?php  
    session_start();
    
    require 'connection.php';

    $name = $_POST['name'];
    $cnic = $_POST['cnic'];
    $email = $_POST['email'];
    $contact = $_POST['contact'];
    $password = $_POST['password'];
    $cPassword = $_POST['cPassword'];

    $verifyName = "SELECT * FROM admin WHERE admin_name= '$name'";
    $output = $con->query($verifyName);

    if($output->num_rows > 0) {
        $_SESSION["name_error"] = "Admin already registered!"; 	
        header('Location: adminSignUpForm.php');
    }
    else {
        $sql = "INSERT INTO admin(admin_name, admin_cnic, admin_email, admin_contact, admin_password, admin_cPassword)
            VALUES('$name', '$cnic', '$email', '$contact', '$password', '$cPassword')";

        $result = $con->query($sql);

        if($result) {
            $con->close();
            $_SESSION["notify"] = "New Admin Registered.";
            header('Location: adminSignUpForm.php');
        } 
        else {
            echo "There is problem while inserting values: " . $con->error;
        }
    }
?>