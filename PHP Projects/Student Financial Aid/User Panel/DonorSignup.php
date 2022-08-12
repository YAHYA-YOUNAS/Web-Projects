<?php
    session_start();

    if(isset($_POST['submit']) )
    {
        //require './queries/create-table-query.php';           // create donor table

        if ($_POST['password'] === $_POST['cPassword']) {

            require './queries/insert-query-donor.php';              // insert data
            
        } else {
            $_SESSION["error"] = "Password and confirm password does not match!";
            header('Location: donorSignUpForm.php');
        }
    }
?>