<?php  require 'connection.php';

    // ------------------------------------- for donor -------------------------------------------------

    $sql = "UPDATE donor SET donor_name= 'Yahya',
            donor_contact= '03161234567' WHERE donor_id= 1";

    $result = $con->query($sql);

    if ($result === TRUE) {
        echo "<h3>Record updated successfully</h3>";
    } 
    else {
        echo "There is problem while updating values: " . $con->error;
    }
    
?>