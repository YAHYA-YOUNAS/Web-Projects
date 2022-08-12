<?php
    require './queries/connection.php';

    $id = $_GET['id'];

    $result = $con->query("DELETE FROM student WHERE student_id= '$id'");

    if ($result) {
        $con->close();
        header('Location: adminStudents.php');
    } 
    else {
        echo "There is problem while deleting record: " . $con->error;
    }

?>