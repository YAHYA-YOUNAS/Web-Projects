<?php
    require './queries/connection.php';

    $id = $_GET['id'];

    $result = $con->query("DELETE FROM feedback WHERE feedback_id= '$id'");

    if ($result) {
        $con->close();
        header('Location: adminFeedback.php');
    } 
    else {
        echo "There is problem while deleting record: " . $con->error;
    }

?>