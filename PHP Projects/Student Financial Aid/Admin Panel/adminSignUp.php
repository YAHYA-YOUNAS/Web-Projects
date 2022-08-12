<?php
    session_start();
    
    if(isset($_POST['submit']) )
    {
        if ($_POST['password'] === $_POST['cPassword']) {      

            require './queries/insert-query.php';                // insert data

        } else {
            $_SESSION["error"] = "Password and confirm password does not match!";
            header('Location: adminSignUpForm.php');
        }

    }
?>