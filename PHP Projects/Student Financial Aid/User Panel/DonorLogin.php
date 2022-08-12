<?php
    session_start();
    require './queries/connection.php';

    if(isset($_POST['submit']) )
    {
        $username = $_POST['username'];
        $password = $_POST['password'];

        $sql = "SELECT donor_name, donor_password FROM donor";
        $result = $con->query($sql);

        if($result->num_rows > 0) {

            while($row = $result->fetch_assoc()) {
                if ($username === $row["donor_name"]) {
                    $name = $row["donor_name"];
                } 
                if ($password === $row["donor_password"]) {
                    $pass = $row["donor_password"];
                }
            }

            if ($username !== $name && $password !== $pass) {
                $_SESSION["error"] = "Username and password are incorrect!";
                header('Location: DonorLoginForm.php');
            } 
            else if ($username !== $name && $password === $pass) {
                $_SESSION["username_error"] = "Username is incorrect!";
                header('Location: DonorLoginForm.php');
            } 
            else if ($username === $name && $password !== $pass) {
                $_SESSION["password_error"] = "Password is incorrect!";
                header('Location: DonorLoginForm.php');
            } 
            else {
                $con->close();
                $_SESSION["username"] = $name;
                header('Location: ./Donor Panel/DonorDashboard.php');
            }

        } else {
            $_SESSION["error"] = "Donor not found!";
            header('Location: DonorLoginForm.php');
        }

    }
?>