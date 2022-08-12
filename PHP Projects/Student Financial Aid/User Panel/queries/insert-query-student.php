<?php  
    session_start();
    require 'connection.php';
    
    $name = $_POST['name'];
    $dob = $_POST['dob'];
    $email = $_POST['email'];
    $contact = $_POST['contact'];
    $password = $_POST['password'];
    $cPassword = $_POST['cPassword'];

    $sql = "INSERT INTO student(student_name, student_dob, student_email, student_contact, student_password, student_cPassword)
            VALUES('$name', '$dob', '$email', '$contact', '$password', '$cPassword')";

    $result = $con->query($sql);

    if($result) {
        $con->close();
        $_SESSION["notify"] = "New Student Registered.";
        header('Location: StudentSignUpForm.php');
    } 
    else {
        echo "There is problem while inserting values: " . $con->error;
    }



?>