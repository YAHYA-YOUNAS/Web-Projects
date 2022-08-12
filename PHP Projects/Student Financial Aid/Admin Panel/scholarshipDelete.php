<?php
    require './queries/connection.php';

    $id = $_GET['id'];

    $result = $con->query("DELETE FROM scholarship WHERE scholarship_id= '$id'");

    if ($result) {
        $con->close();
        header('Location: adminScholarships.php');
    } 
    else {
        echo "There is problem while deleting record: " . $con->error;
    }

?>