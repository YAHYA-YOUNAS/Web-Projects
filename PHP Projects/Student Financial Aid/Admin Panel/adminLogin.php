<?php
    session_start();
    require './queries/connection.php';

    if(isset($_POST['submit']) )
    {
        $username = $_POST['username'];
        $password = $_POST['password'];

        $sql = "SELECT admin_name, admin_password FROM admin";
        $result = $con->query($sql);

        if($result->num_rows > 0) {

            while($row = $result->fetch_assoc()) {
                if ($username === $row["admin_name"]) {
                    $name = $row["admin_name"];
                } 
                if ($password === $row["admin_password"]) {
                    $pass = $row["admin_password"];
                }
            }

            if ($username !== $name && $password !== $pass) {
                $_SESSION["error"] = "Username and password are incorrect!";
                header('Location: adminLoginForm.php');
            } 
            else if ($username !== $name && $password === $pass) {
                $_SESSION["username_error"] = "Username is incorrect!";
                header('Location: adminLoginForm.php');
            } 
            else if ($username === $name && $password !== $pass) {
                $_SESSION["password_error"] = "Password is incorrect!";
                header('Location: adminLoginForm.php');
            } 
            else {
                $con->close();
                $_SESSION["username"] = $name;
                header('Location: adminHomePage.php');
            }

        } else {
            $_SESSION["error"] = "Unable to login!";
            header('Location: adminLoginForm.php');
        }
    }
?>