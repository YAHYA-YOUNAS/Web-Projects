<?php
    require './queries/connection.php';

    $id = $_GET['id'];

    $result = $con->query("DELETE FROM donor WHERE donor_id= '$id'");

    if ($result) {
        $con->close();
        header('Location: adminDonors.php');
    } 
    else {
        echo "There is problem while deleting record: " . $con->error;
    }

?>