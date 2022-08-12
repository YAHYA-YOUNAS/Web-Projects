<?php
    require './queries/connection.php';

    $id = $_GET['id'];

    
    $sql= $con->query("SELECT download_source FROM download WHERE download_id= '$id'");
    if($sql->num_rows > 0 ) {
        $row = $sql->fetch_assoc();
        $path = $row["download_source"];

        unlink( $path );    // delete from uploads folder also
        $result = $con->query("DELETE FROM download WHERE download_id= '$id'");

        if ($result) {
            $con->close();
            header('Location: adminDownloads.php');
        } 
        else {
            echo "There is problem while deleting record: " . $con->error;
        }

    } else {
        echo "Record not found!";
    }


?>