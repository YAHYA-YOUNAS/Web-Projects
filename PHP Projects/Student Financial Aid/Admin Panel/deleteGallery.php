<?php
    require './queries/connection.php';

    $id = $_GET['id'];

    $sql= $con->query("SELECT gallery_source FROM gallery WHERE gallery_id= '$id'");
    if($sql->num_rows > 0 ) {
        $row = $sql->fetch_assoc();
        $path = $row["gallery_source"];

        unlink( $path );    // delete from uploads folder also
        $result = $con->query("DELETE FROM gallery WHERE gallery_id= '$id'");
    
        if ($result) {
            $con->close();
            header('Location: adminGallery.php');
        } 
        else {
            echo "There is problem while deleting record: " . $con->error;
        }

    } else {
        echo "No record found!";
    }

?>