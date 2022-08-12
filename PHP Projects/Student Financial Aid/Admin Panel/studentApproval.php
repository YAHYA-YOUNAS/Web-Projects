<?php
    session_start();

    require './queries/connection.php';

    $id = $_GET['id'];

    $sql = $con->query("UPDATE student set student_approval_status= 1 WHERE student_id= '$id'");

    if ($sql) {
        $con->close();
        $_SESSION["approval"] = "Student having id ".$id. " has been approved.";
        header('Location: adminStudents.php');
    } else {
        $_SESSION["error"] = "Unable to approve the student!";
        header('Location: adminStudents.php');
    }

?>