<?php
    session_start();

    require './queries/connection.php';

    if(isset($_POST['submit'])){

        $id= $_POST['student_id'];
        $name = $_POST['student_name'];
        $dob = $_POST['student_dob'];
        $email = $_POST['student_email'];
        $contact = $_POST['student_contact'];
        $password = $_POST['student_password'];
        $cPassword = $_POST['student_cPassword'];
        $apply_for = $_POST['student_applied_for'];
        $cnic = $_POST['student_cnic'];
        $address = $_POST['student_address'];
        $profession = $_POST['student_profession'];
        $income = $_POST['student_income'];
        $family_income = $_POST['student_family_income'];
        $expenditure = $_POST['student_expenditure'];

        if ($password === $cPassword) {

            $result = $con->query("UPDATE student SET student_name= '$name', student_dob= '$dob', student_email= '$email', student_contact= '$contact',
                        student_password= '$password', student_cPassword= '$cPassword', student_applied_for= '$apply_for', student_cnic= '$cnic',
                        student_address= '$address', student_profession= '$profession', student_income= '$income', student_family_income= '$family_income',
                        student_expenditure= '$expenditure' WHERE student_id= '$id'");

            if($result) {
                $con->close();
                $_SESSION["notify"] = "Record has been updated successfully.";
                header('Location: adminStudents.php');
            } else {
                $_SESSION["error"] = "Unable to update record!: " .$con->error;
                header('Location: adminStudents.php');
            }

        } else {
            $_SESSION["error"] = "Unable to update! Password and Confirm Password does not match.";
            header('Location: adminStudents.php');
        }
    }
?>