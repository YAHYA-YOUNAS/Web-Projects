<?php

    session_start();
    require './queries/connection.php';

    if(isset($_POST['submit']) )
    {
        
        $username = $_POST['username'];
        $password = $_POST['password'];

        $sql = "SELECT student_name, student_password FROM student";
        $result = $con->query($sql);

        if($result->num_rows > 0) {

            while($row = $result->fetch_assoc()) {
                if ($username === $row["student_name"]) {
                    $name = $row["student_name"];
                } 
                if ($password === $row["student_password"]) {
                    $pass = $row["student_password"];
                }
            }

            if ($username !== $name && $password !== $pass) {
                $_SESSION["error"] = "Username and password are incorrect!";
                header('Location: StudentLoginForm.php');
            } 
            else if ($username !== $name && $password === $pass) {
                $_SESSION["username_error"] = "Username is incorrect!";
                header('Location: StudentLoginForm.php');
            } 
            else if ($username === $name && $password !== $pass) {
                $_SESSION["password_error"] = "Password is incorrect!";
                header('Location: StudentLoginForm.php');
            } 
            else {
                $con->close();
                $_SESSION["username"] = $name;
                header('Location: ./Student Panel/StudentDashboard.php');
            }

        } else {
            $_SESSION["error"] = "Unable to login!";
            header('Location: StudentLoginForm.php');
        }
    }
?>